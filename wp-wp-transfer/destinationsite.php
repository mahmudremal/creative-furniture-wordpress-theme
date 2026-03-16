<?php
/**
 * Plugin Name: EximEnd Destination Site
 * Description: Imports WooCommerce products, posts, media, users, and reviews from a target site.
 * Version: 1.3
 * Author: Remal Mahmud
 */

if (!defined('ABSPATH')) {
    exit;
}

class EximEnd_Destination_Site_V2 {

    private $source_id_meta_key = 'src_site_obj_id';

    public function __construct() {
        add_action('admin_menu', [$this,'add_admin_menu']);
        add_action('wp_ajax_exim_import_items', [$this,'ajax_import_items']);
        add_filter('wp_get_attachment_url', [$this,'override_attachment_url'],10,2);
        add_filter('wp_calculate_image_srcset', [$this,'disable_srcset_if_remote'],10,5);
    }

    public function add_admin_menu(){
        add_menu_page('EximEnd Importer','EximEnd Importer','manage_options','eximend-importer',[$this,'render_admin_page'],'dashicons-download',25);
    }

    public function render_admin_page(){ ?>

<div class="wrap">
<h1>EximEnd Data Importer</h1>

<table class="form-table">
<tr>
<th><label for="source_site_url">Source Site URL</label></th>
<td>
<input type="text" id="source_site_url" class="regular-text" placeholder="https://source.com" />
<button id="fetch_stats_btn" class="button button-secondary">Fetch Site Statistics</button>
</td>
</tr>
</table>

<div id="stats_container" style="display:none;margin-top:20px;">
<h2>Site Statistics</h2>
<div id="stats_output"></div>
<button id="start_import_all" class="button button-primary">Start Full Import</button>
</div>

<div id="import_log_container" style="margin-top:20px;">
<h2>Import Log</h2>
<div id="import_log" style="height:400px;overflow-y:scroll;background:#f1f1f1;padding:10px;border:1px solid #ccc"></div>
</div>
</div>

<script>

document.addEventListener('DOMContentLoaded',function(){

const fetchBtn=document.getElementById('fetch_stats_btn');
const sourceUrlInput=document.getElementById('source_site_url');
const statsContainer=document.getElementById('stats_container');
const statsOutput=document.getElementById('stats_output');
const importLog=document.getElementById('import_log');
const startImportAllBtn=document.getElementById('start_import_all');

let sourceApiBase='';
let perPage=20;

function log(m,t='info'){
const p=document.createElement('p');
p.innerHTML='['+new Date().toLocaleTimeString()+'] '+m;
p.style.color=t==='error'?'red':(t==='success'?'green':'black');
importLog.appendChild(p);
importLog.scrollTop=importLog.scrollHeight;
}

fetchBtn.addEventListener('click',async()=>{

const url=sourceUrlInput.value.trim();
if(!url){alert('Enter source url');return;}

sourceApiBase=url.replace(/\/$/,'')+'/wp-json/eximend/v1';

try{

const r=await fetch(sourceApiBase+'/stats');
if(!r.ok)throw new Error(r.status);

const stats=await r.json();

const types=[
{type:'users',label:'Users'},
{type:'media',label:'Media'},
{type:'posts',label:'Posts'},
{type:'products',label:'Products'},
{type:'reviews',label:'Reviews'}
];

statsOutput.innerHTML=types.map(s=>{

const count=(stats[s.type]&&stats[s.type].publish||stats[s.type].inherit||0)||0;

return `<div class="stat-box"><strong>${s.label}</strong>: ${count} <button class="button import-btn" data-type="${s.type}">Import</button></div>`;

}).join('');

statsContainer.style.display='block';

Array.from(document.querySelectorAll('.import-btn')).forEach(b=>{

b.onclick=()=> {
    const page = parseInt(prompt('Enter page number', 1));
    const per_page = parseInt(prompt('Enter Per Page', 20));
    startImport(b.dataset.type,page, per_page)
};

});

}
catch(e){
log('Stats error '+e.message,'error');
}

});

startImportAllBtn.addEventListener('click',async()=>{

const order=['users','media','posts','products','reviews'];

for(const t of order){

await startImport(t,1);

}

});

async function startImport(type,page, per_page = 20){

try{

log('Fetching '+type+' page '+page);

const r=await fetch(sourceApiBase+'/'+type+'?page='+page+'&per_page='+per_page);

if(!r.ok)throw new Error(r.status);

const items=await r.json();

if(!items.length){
log(type+' finished','success');
return;
}

const fd=new FormData();
fd.append('action','exim_import_items');
fd.append('_ajax_nonce','<?php echo wp_create_nonce('exim_importer_nonce');?>');
fd.append('dataType',type);
fd.append('items',JSON.stringify(items));

const b=await fetch('<?php echo admin_url('admin-ajax.php');?>',{method:'POST',body:fd});

const res=await b.json();

if(res.success){
log(res.data,'success');
await startImport(type,page+1);
}else{
throw new Error(res.data);
}

}
catch(e){
log(type+' error '+e.message,'error');
}

}

});

</script>

<style>
.stat-box{border:1px solid #ddd;padding:15px;margin-bottom:10px;display:flex;justify-content:space-between}
#import_log p{margin:0;padding:5px;border-bottom:1px solid #eee}
</style>

<?php }

    public function ajax_import_items(){

        @set_time_limit(0);

        check_ajax_referer('exim_importer_nonce');

        if(!current_user_can('manage_options'))wp_send_json_error('Permission');

        $data_type=sanitize_text_field($_POST['dataType']);

        $items=json_decode(stripslashes($_POST['items']),true);

        if(empty($items))wp_send_json_error('Empty');

        $processed=0;
        $skipped=0;

        foreach($items as $item){

            $source_id=$item['id'];

            $existing=$this->get_dest_id($source_id,$data_type);

            if($existing){$skipped++;continue;}

            switch($data_type){

                case 'users':$this->import_user_item($item);break;

                case 'media':$this->import_media_item($item);break;

                case 'posts':$this->import_post_item($item,'post');break;

                case 'products':if(class_exists('WooCommerce'))$this->import_product_item($item);break;

                case 'reviews':$this->import_review_item($item);break;

            }

            $processed++;

        }

        wp_send_json_success("Processed {$processed} skipped {$skipped}");

    }

    private function get_dest_id($source_id,$type){

        if($type==='users'){

            $u=get_users([
            'meta_key'=>$this->source_id_meta_key,
            'meta_value'=>$source_id,
            'fields'=>'ID'
            ]);

            return $u[0]??null;

        }

        if($type==='reviews'){

            global $wpdb;

            return $wpdb->get_var($wpdb->prepare(

            "SELECT comment_id FROM {$wpdb->commentmeta} WHERE meta_key=%s AND meta_value=%s",

            $this->source_id_meta_key,$source_id

            ));

        }

        $q=new WP_Query([
        'post_type'=>'any',
        'post_status'=>'any',
        'meta_key'=>$this->source_id_meta_key,
        'meta_value'=>$source_id,
        'posts_per_page'=>1,
        'fields'=>'ids'
        ]);

        return $q->have_posts()?$q->posts[0]:null;

    }

    private function import_user_item($item){

        if(email_exists($item['user_email'])||username_exists($item['user_login']))return;

        $uid=wp_insert_user([
        'user_login'=>$item['user_login'],
        'user_email'=>$item['user_email'],
        'display_name'=>$item['display_name'],
        'user_pass'=>wp_generate_password(),
        'user_registered'=>$item['user_registered'],
        'role'=>'subscriber'
        ]);

        if(is_wp_error($uid))return;

        update_user_meta($uid,$this->source_id_meta_key,$item['id']);

    }

    private function import_media_item($item){

        $url=$item['url'];

        if(!$url)return;

        $ext=pathinfo(parse_url($url,PHP_URL_PATH),PATHINFO_EXTENSION);

        if(!$ext)$ext='jpg';

        $name=basename(parse_url($url,PHP_URL_PATH));

        $blank=base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=');

        $upload=wp_upload_bits($name,null,$blank);

        if(!empty($upload['error']))return;

        $aid=wp_insert_attachment([

        'post_mime_type'=>'image/'.$ext,

        'post_title'=>$name,

        'post_status'=>'inherit'

        ],$upload['file']);

        if(is_wp_error($aid))return;

        require_once ABSPATH.'wp-admin/includes/image.php';

        wp_update_attachment_metadata($aid,wp_generate_attachment_metadata($aid,$upload['file']));

        update_post_meta($aid,$this->source_id_meta_key,$item['id']);

        update_post_meta($aid,'_ref__download_src',$url);

    }

    private function get_mapped_image_id($url,$source_id=0){

        if($source_id){

            $q=new WP_Query([
            'post_type'=>'attachment',
            'meta_key'=>$this->source_id_meta_key,
            'meta_value'=>$source_id,
            'fields'=>'ids',
            'posts_per_page'=>1
            ]);

            if($q->have_posts())return $q->posts[0];

        }

        if(!$url)return 0;

        global $wpdb;

        $id=$wpdb->get_var($wpdb->prepare(

        "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key='_ref__download_src' AND meta_value=%s",

        $url

        ));

        if($id)return $id;

        return 0;

    }

    private function set_featured_image($pid,$url,$sid=0){

        $aid=$this->get_mapped_image_id($url,$sid);

        if($aid)set_post_thumbnail($pid,$aid);

    }

    private function import_post_item($item,$type){

        $pid=wp_insert_post([

        'post_title'=>$item['title'],

        'post_content'=>$item['content'],

        'post_excerpt'=>$item['excerpt'],

        'post_status'=>$item['status'],

        'post_type'=>$type,

        'post_name'=>$item['slug'],

        'post_date'=>$item['date'],

        'post_date_gmt'=>$item['date_gmt']

        ]);

        if(is_wp_error($pid))return;

        update_post_meta($pid,$this->source_id_meta_key,$item['id']);

        $this->set_featured_image($pid,$item['featured_image_url'],$item['featured_image_id']??0);

    }

    private function import_product_item($item){

        $pid=wp_insert_post([

        'post_title'=>$item['title'],

        'post_content'=>$item['content'],

        'post_excerpt'=>$item['excerpt'],

        'post_status'=>$item['status'],

        'post_type'=>'product',

        'post_name'=>$item['slug'],

        'post_date'=>$item['date'],

        'post_date_gmt'=>$item['date_gmt']

        ]);

        if(is_wp_error($pid))return;

        $p=wc_get_product($pid);

        if(!$p)return;

        if($item['sku']){

            try{$p->set_sku($item['sku']);}catch(Exception $e){}

        }

        $p->set_price($item['price']);

        $p->set_regular_price($item['regular_price']);

        $p->set_sale_price($item['sale_price']);

        $p->save();

        update_post_meta($pid,$this->source_id_meta_key,$item['id']);

        $this->set_featured_image($pid,$item['featured_image_url'],$item['featured_image_id']??0);

    }

    private function import_review_item($item){

        $pid=$this->get_dest_id($item['post_id'],'products');

        if(!$pid)return;

        $cid=wp_insert_comment([

        'comment_post_ID'=>$pid,

        'comment_author'=>$item['author'],

        'comment_author_email'=>$item['author_email'],

        'comment_content'=>$item['content'],

        'comment_date'=>$item['date'],

        'comment_approved'=>1

        ]);

        if($cid)add_comment_meta($cid,$this->source_id_meta_key,$item['id']);

    }

    public function override_attachment_url($url,$id){

        $remote=get_post_meta($id,'_ref__download_src',true);

        if($remote)return $remote;

        return $url;

    }

    public function disable_srcset_if_remote($sources,$size_array,$image_src,$image_meta,$attachment_id){

        $remote=get_post_meta($attachment_id,'_ref__download_src',true);

        if($remote)return false;

        return $sources;

    }

}

new EximEnd_Destination_Site_V2();
