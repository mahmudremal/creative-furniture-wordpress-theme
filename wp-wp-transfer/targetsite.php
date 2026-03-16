<?php
/**
 * Plugin Name: EximEnd Target Site
 * Description: Exposes REST API endpoints for exporting WooCommerce products, posts, media, users, and reviews.
 * Version: 3.0
 * Author: Remal Mahmud
 */

if (!defined('ABSPATH')) {
    exit;
}

class EximEnd_Target_Site_V3 {

    public function __construct() {
        add_action('rest_api_init', [$this,'register_routes']);
        add_action('init', [$this,'cors']);
    }

    public function cors(){
        if(isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'],'eximend') !== false){
            if(isset($_SERVER['HTTP_ORIGIN'])){
                header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
                header('Access-Control-Allow-Credentials: true');
            }else{
                header('Access-Control-Allow-Origin: *');
            }

            header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
            header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Authorization');

            if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
                status_header(200);
                exit;
            }
        }
    }

    public function register_routes(){

        $namespace='eximend/v1';

        register_rest_route($namespace,'/stats',[
            'methods'=>'GET',
            'callback'=>[$this,'stats'],
            'permission_callback'=>'__return_true'
        ]);

        register_rest_route($namespace,'/posts',[
            'methods'=>'GET',
            'callback'=>[$this,'posts'],
            'permission_callback'=>'__return_true'
        ]);

        register_rest_route($namespace,'/products',[
            'methods'=>'GET',
            'callback'=>[$this,'products'],
            'permission_callback'=>'__return_true'
        ]);

        register_rest_route($namespace,'/media',[
            'methods'=>'GET',
            'callback'=>[$this,'media'],
            'permission_callback'=>'__return_true'
        ]);

        register_rest_route($namespace,'/users',[
            'methods'=>'GET',
            'callback'=>[$this,'users'],
            'permission_callback'=>'__return_true'
        ]);

        register_rest_route($namespace,'/reviews',[
            'methods'=>'GET',
            'callback'=>[$this,'reviews'],
            'permission_callback'=>'__return_true'
        ]);
        
        register_rest_route($namespace, '/categories/map/products', [
            'methods'  => 'GET',
            'callback' => [$this,'get_products_categories_tags'],
            'permission_callback' => '__return_true',
        ]);
        register_rest_route($namespace, '/categories/list', [
            'methods'  => 'GET',
            'callback' => [$this,'get_products_categories_list'],
            'permission_callback' => '__return_true',
        ]);
        register_rest_route($namespace, '/tags/list', [
            'methods'  => 'GET',
            'callback' => [$this,'get_products_tags_list'],
            'permission_callback' => '__return_true',
        ]);

    }

    public function stats(){

        $post_counts=(array)wp_count_posts('post');
        $product_counts=(array)wp_count_posts('product');
        $media_counts=(array)wp_count_posts('attachment');

        $user_counts=count_users();
        $total_users=$user_counts['total_users'];

        if(isset($user_counts['avail_roles']['administrator'])){
            $total_users-=$user_counts['avail_roles']['administrator'];
        }

        $review_counts=get_comments(['post_type'=>'product','count'=>true]);

        return new WP_REST_Response([
            'posts'=>$post_counts,
            'products'=>$product_counts,
            'media'=>$media_counts,
            'users'=>['publish'=>$total_users],
            'reviews'=>['publish'=>$review_counts]
        ],200);

    }

    private function post_data($post){

        $meta=get_post_meta($post->ID);

        $taxonomies=[];

        $post_taxonomies = get_post_taxonomies($post->ID);

        foreach($post_taxonomies as $taxonomy){
            if (in_array($taxonomy,['product_cat','product_tag'])){
                continue;
            }

            $terms=wp_get_post_terms($post->ID,$taxonomy);

            if(!empty($terms) && !is_wp_error($terms)){

                $taxonomies[$taxonomy]=array_map(function($term){

                    return[
                        'id'=>$term->term_id,
                        'name'=>$term->name,
                        'slug'=>$term->slug,
                        'description'=>$term->description,
                        'parent'=>$term->parent
                    ];

                },$terms);

            }

        }

        $featured_id=get_post_thumbnail_id($post->ID);

        $featured_url=$featured_id?wp_get_attachment_url($featured_id):'';

        return[

            'id'=>$post->ID,
            'title'=>$post->post_title,
            'content'=>$post->post_content,
            'excerpt'=>$post->post_excerpt,
            'slug'=>$post->post_name,
            'status'=>$post->post_status,
            'post_type'=>$post->post_type,
            'author_id'=>(int)$post->post_author,
            'date'=>$post->post_date,
            'date_gmt'=>$post->post_date_gmt,
            'modified'=>$post->post_modified,
            'modified_gmt'=>$post->post_modified_gmt,
            'comment_status'=>$post->comment_status,
            'featured_image_id'=>$featured_id,
            'featured_image_url'=>$featured_url,
            'taxonomies'=>$taxonomies,
            'meta'=>$meta

        ];

    }

    public function posts(WP_REST_Request $request){

        $per_page=$request->get_param('per_page')?(int)$request->get_param('per_page'):20;
        $page=$request->get_param('page')?(int)$request->get_param('page'):1;

        $query=new WP_Query([
            'post_type'=>'post',
            'post_status'=>'any',
            'posts_per_page'=>$per_page,
            'paged'=>$page,
            'orderby'=>'ID',
            'order'=>'ASC'
        ]);

        $data=[];

        if($query->have_posts()){

            foreach($query->get_posts() as $post){

                $data[]=$this->post_data($post);

            }

        }

        wp_reset_postdata();

        return new WP_REST_Response($data,200);

    }

    public function products(WP_REST_Request $request){

        if(!class_exists('WooCommerce')){
            return new WP_REST_Response([],200);
        }

        $per_page=$request->get_param('per_page')?(int)$request->get_param('per_page'):20;
        $page=$request->get_param('page')?(int)$request->get_param('page'):1;

        $query=new WP_Query([

            'post_type'=>'product',
            'post_status'=>'any',
            'posts_per_page'=>$per_page,
            'paged'=>$page,
            'orderby'=>'ID',
            'order'=>'ASC'
        ]);

        $data=[];

        if($query->have_posts()){

            foreach($query->get_posts() as $post){

                $product=wc_get_product($post->ID);

                if(!$product)continue;

                $post_data=$this->post_data($post);

                $gallery_ids=$product->get_gallery_image_ids();

                $gallery_urls=array_map('wp_get_attachment_url',$gallery_ids);

                $attributes=[];

                foreach($product->get_attributes() as $attr){

                    $attributes[$attr->get_name()]=[
                        'name'=>$attr->get_name(),
                        'options'=>$attr->get_options(),
                        'variation'=>$attr->get_variation()
                    ];

                }

                $variations=[];

                if($product->is_type('variable')){

                    foreach($product->get_children() as $child_id){

                        $variation=wc_get_product($child_id);

                        if(!$variation)continue;

                        $image_id=$variation->get_image_id();

                        $variations[]=[

                            'id'=>$variation->get_id(),
                            'sku'=>$variation->get_sku(),
                            'price'=>$variation->get_price(),
                            'regular_price'=>$variation->get_regular_price(),
                            'sale_price'=>$variation->get_sale_price(),
                            'stock_quantity'=>$variation->get_stock_quantity(),
                            'stock_status'=>$variation->get_stock_status(),
                            'weight'=>$variation->get_weight(),

                            'dimensions'=>[
                                'length'=>$variation->get_length(),
                                'width'=>$variation->get_width(),
                                'height'=>$variation->get_height()
                            ],

                            'attributes'=>$variation->get_attributes(),

                            'description'=>$variation->get_description(),

                            'image_id'=>$image_id,
                            'image_url'=>$image_id?wp_get_attachment_url($image_id):'',

                            'meta'=>get_post_meta($variation->get_id())

                        ];

                    }

                }

                $product_data=[

                    'type'=>$product->get_type(),
                    'sku'=>$product->get_sku(),
                    'price'=>$product->get_price(),
                    'regular_price'=>$product->get_regular_price(),
                    'sale_price'=>$product->get_sale_price(),
                    'stock_quantity'=>$product->get_stock_quantity(),
                    'stock_status'=>$product->get_stock_status(),
                    'weight'=>$product->get_weight(),

                    'dimensions'=>[
                        'length'=>$product->get_length(),
                        'width'=>$product->get_width(),
                        'height'=>$product->get_height()
                    ],

                    'attributes'=>$attributes,

                    'gallery_image_ids'=>$gallery_ids,
                    'gallery_image_urls'=>$gallery_urls,

                    'variations'=>$variations

                ];

                $data[]=array_merge($post_data,$product_data);

            }

        }

        wp_reset_postdata();

        return new WP_REST_Response($data,200);

    }

    public function media(WP_REST_Request $request){

        $per_page=$request->get_param('per_page')?(int)$request->get_param('per_page'):20;
        $page=$request->get_param('page')?(int)$request->get_param('page'):1;

        $query=new WP_Query([

            'post_type'=>'attachment',
            'post_status'=>'inherit',
            'posts_per_page'=>$per_page,
            'paged'=>$page,
            'orderby'=>'ID',
            'order'=>'ASC'

        ]);

        $data=[];

        if($query->have_posts()){

            foreach($query->get_posts() as $post){

                $data[]=[

                    'id'=>$post->ID,
                    'title'=>$post->post_title,
                    'caption'=>$post->post_excerpt,
                    'alt_text'=>get_post_meta($post->ID,'_wp_attachment_image_alt',true),
                    'description'=>$post->post_content,
                    'url'=>wp_get_attachment_url($post->ID),
                    'mime_type'=>$post->post_mime_type,
                    'date'=>$post->post_date_gmt

                ];

            }

        }

        wp_reset_postdata();

        return new WP_REST_Response($data,200);

    }

    public function users(WP_REST_Request $request){

        $per_page=$request->get_param('per_page')?(int)$request->get_param('per_page'):20;
        $page=$request->get_param('page')?(int)$request->get_param('page'):1;

        $args=[

            'number'=>$per_page,
            'paged'=>$page,
            'orderby'=>'ID',
            'order'=>'ASC'

        ];

        $admin_users=get_users(['role'=>'administrator','fields'=>'ID']);

        if(!empty($admin_users)){
            $args['exclude']=$admin_users;
        }

        $user_query=new WP_User_Query($args);

        $users=$user_query->get_results();

        $data=[];

        foreach($users as $user){

            $data[]=[

                'id'=>$user->ID,
                'user_login'=>$user->user_login,
                'user_email'=>$user->user_email,
                'display_name'=>$user->display_name,
                'user_registered'=>$user->user_registered,
                'roles'=>(array)$user->roles,
                'meta'=>get_user_meta($user->ID)

            ];

        }

        return new WP_REST_Response($data,200);

    }

    public function reviews(WP_REST_Request $request){

        $per_page=$request->get_param('per_page')?(int)$request->get_param('per_page'):20;
        $page=$request->get_param('page')?(int)$request->get_param('page'):1;

        $args=[

            'post_type'=>'product',
            'status'=>'approve',
            'number'=>$per_page,
            'paged'=>$page,
            'orderby'=>'comment_ID',
            'order'=>'ASC'

        ];

        $comments_query=new WP_Comment_Query($args);

        $comments=$comments_query->get_comments();

        $data=[];

        foreach($comments as $comment){

            $data[]=[

                'id'=>$comment->comment_ID,
                'post_id'=>$comment->comment_post_ID,
                'author'=>$comment->comment_author,
                'author_email'=>$comment->comment_author_email,
                'author_url'=>$comment->comment_author_url,
                'author_ip'=>$comment->comment_author_IP,
                'date'=>$comment->comment_date,
                'date_gmt'=>$comment->comment_date_gmt,
                'content'=>$comment->comment_content,
                'parent'=>$comment->comment_parent,
                'user_id'=>$comment->user_id,
                'meta'=>get_comment_meta($comment->comment_ID)

            ];

        }

        return new WP_REST_Response($data,200);

    }

    public function get_products_categories_tags(WP_REST_Request $request) {
        $args = [
            'post_type'      => 'product',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'fields'         => 'ids',
        ];

        $products = get_posts($args);

        $data = [];

        foreach ($products as $product_id) {

            $categories = wp_get_post_terms($product_id, 'product_cat', [
                'fields' => 'ids'
            ]);

            $tags = wp_get_post_terms($product_id, 'product_tag', [
                'fields' => 'ids'
            ]);

            $data[] = [
                'product_id' => $product_id,
                'categories' => $categories,
                'tags'       => $tags,
            ];
        }

        return rest_ensure_response($data);
    }

    public function get_products_categories_list(WP_REST_Request $request) {
        $categories = get_terms([
            'taxonomy'   => 'product_cat',
            'hide_empty' => false,
            'fields'     => 'all',
        ]);

        $data = [];

        foreach ($categories as $category) {
            $data[] = [
                'id'          => $category->term_id,
                'name'        => $category->name,
                'slug'        => $category->slug,
                'description' => $category->description,
                'parent'      => $category->parent,
            ];
        }

        return rest_ensure_response($data);
    }

    public function get_products_tags_list(WP_REST_Request $request) {
        $tags = get_terms([
            'taxonomy'   => 'product_tag',
            'hide_empty' => false,
            'fields'     => 'all',
        ]);

        $data = [];

        foreach ($tags as $tag) {
            $data[] = [
                'id'          => $tag->term_id,
                'name'        => $tag->name,
                'slug'        => $tag->slug,
                'description' => $tag->description,
                'parent'      => $tag->parent,
            ];
        }

        return rest_ensure_response($data);
    }

}

new EximEnd_Target_Site_V3();
