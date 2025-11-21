<?php
register_activation_hook(__FILE__,'cf_wishlist_activate');
// add_action('init', 'cf_wishlist_activate');
function cf_wishlist_activate(){
    global $wpdb;
    $table=$wpdb->prefix.'cf_wishlist_items';
    $charset=$wpdb->get_charset_collate();
    $sql="CREATE TABLE IF NOT EXISTS $table (id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,user_id BIGINT UNSIGNED NULL,session_key VARCHAR(255) NULL,product_id BIGINT UNSIGNED NOT NULL,created_at DATETIME NOT NULL,PRIMARY KEY(id)) $charset;";
    require_once ABSPATH.'wp-admin/includes/upgrade.php';
    wp_die($sql);
    // dbDelta($sql);
    global $wpdb;
    $table = $wpdb->prefix . 'cf_wishlist_share_tokens';
    $charset = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        token VARCHAR(255) NOT NULL,
        product_ids LONGTEXT NOT NULL,
        created_at DATETIME NOT NULL,
        PRIMARY KEY(id),
        UNIQUE KEY token(token)
    ) $charset;";
    dbDelta($sql);

}
add_action('init','cf_wishlist_start_session');
function cf_wishlist_start_session(){
    if(!session_id())session_start();
}
function cf_wishlist_get_session(){
    if(!isset($_SESSION['cf_wishlist_session']))$_SESSION['cf_wishlist_session']=wp_generate_uuid4();
    return $_SESSION['cf_wishlist_session'];
}
add_action('wp_ajax_cf_wishlist_toggle','cf_wishlist_toggle');
add_action('wp_ajax_nopriv_cf_wishlist_toggle','cf_wishlist_toggle');
function cf_wishlist_toggle(){
    global $wpdb;
    $table=$wpdb->prefix.'cf_wishlist_items';
    $pid=intval($_POST['product_id']);
    $uid=get_current_user_id();
    $session=cf_wishlist_get_session();
    if($uid){
        $row=$wpdb->get_row($wpdb->prepare("SELECT id FROM $table WHERE product_id=%d AND user_id=%d",$pid,$uid));
        if($row){
            $wpdb->delete($table,['id'=>$row->id]);
            wp_send_json(['status'=>'removed']);
        } else {
            $wpdb->insert($table,['user_id'=>$uid,'session_key'=>null,'product_id'=>$pid,'created_at'=>current_time('mysql')]);
            wp_send_json(['status'=>'added']);
        }
    } else {
        $row=$wpdb->get_row($wpdb->prepare("SELECT id FROM $table WHERE product_id=%d AND session_key=%s",$pid,$session));
        if($row){
            $wpdb->delete($table,['id'=>$row->id]);
            wp_send_json(['status'=>'removed']);
        } else {
            $wpdb->insert($table,['user_id'=>null,'session_key'=>$session,'product_id'=>$pid,'created_at'=>current_time('mysql')]);
            wp_send_json(['status'=>'added']);
        }
    }
}
add_action('wp_login','cf_wishlist_merge',10,2);
function cf_wishlist_merge($user_login,$user){
    global $wpdb;
    $table=$wpdb->prefix.'cf_wishlist_items';
    $session=cf_wishlist_get_session();
    $uid=$user->ID;
    $items=$wpdb->get_results($wpdb->prepare("SELECT product_id FROM $table WHERE session_key=%s",$session));
    foreach($items as $i){
        $exists=$wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE product_id=%d AND user_id=%d",$i->product_id,$uid));
        if(!$exists){
            $wpdb->insert($table,['user_id'=>$uid,'session_key'=>null,'product_id'=>$i->product_id,'created_at'=>current_time('mysql')]);
        }
    }
    $wpdb->delete($table,['session_key'=>$session]);
}
function cf_wishlist_get_items(){
    global $wpdb;
    $table=$wpdb->prefix.'cf_wishlist_items';
    $uid=get_current_user_id();
    if($uid){
        return $wpdb->get_col($wpdb->prepare("SELECT product_id FROM $table WHERE user_id=%d ORDER BY created_at DESC",$uid));
    } else {
        $session=cf_wishlist_get_session();
        return $wpdb->get_col($wpdb->prepare("SELECT product_id FROM $table WHERE session_key=%s ORDER BY created_at DESC",$session));
    }
}
function cf_wishlist_render_page() {
    $items = cf_wishlist_get_items();
    echo '<div class="cf-wishlist-wrapper">';
    echo '<div class="cf-wishlist-left">';
    echo '<h2>Your Wishlist (' . count($items) . ')</h2>';
    echo '<div class="cf-wishlist-list">';
    foreach ($items as $pid) {
        $p = wc_get_product($pid);
        if ($p) {
            echo '<div class="cf-wishlist-item">';
            echo '<div class="cf-wishlist-thumb"><a href="'.get_permalink($pid).'">'.get_the_post_thumbnail($pid, 'medium').'</a></div>';
            echo '<div class="cf-wishlist-info">';
            echo '<a class="cf-wishlist-title" href="'.get_permalink($pid).'">'.$p->get_name().'</a>';
            echo '<div class="cf-wishlist-price">'.$p->get_price_html().'</div>';
            echo '<div class="cf-wishlist-actions">';
            echo '<button class="cf-wishlist-remove" data-product-id="'.$pid.'">Remove</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    echo '</div>';
    echo '</div>';

    $total = 0;
    foreach ($items as $pid) {
        $p = wc_get_product($pid);
        if ($p) $total += floatval($p->get_price());
    }

    echo '<div class="cf-wishlist-right">';
    echo '<div class="cf-wishlist-summary">';
    echo '<h3>Wishlist Summary</h3>';
    echo '<div class="cf-wishlist-summary-row"><span>Total Items</span><span>'.count($items).'</span></div>';
    echo '<div class="cf-wishlist-summary-row"><span>Total Cost</span><span>'.wc_price($total).'</span></div>';
    echo '<button class="cf-wishlist-share-btn" id="cf-wishlist-share-btn">Share Wishlist</button>';
    echo '</div>';
    echo '<div class="cf-wishlist-share-panel" id="cf-wishlist-share-panel">';
    echo '<input type="text" readonly value="'.esc_url(add_query_arg('wishlist', implode(',', $items), home_url())).'" class="cf-wishlist-share-link">';
    echo '<button class="cf-wishlist-copy-link" id="cf-wishlist-copy-link">Copy Link</button>';
    echo '</div>';
    echo '</div>';

    echo '</div>';
}


function cf_wishlist_is_in_wishlist($product_id){
    global $wpdb;
    $table=$wpdb->prefix.'cf_wishlist_items';
    $uid=get_current_user_id();
    if($uid){
        return (bool)$wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE user_id=%d AND product_id=%d",$uid,$product_id));
    } else {
        $session = cf_wishlist_get_session();
        return (bool)$wpdb->get_var($wpdb->prepare("SELECT id FROM $table WHERE session_key=%s AND product_id=%d",$session,$product_id));
    }
}
function cf_wishlist_has_any() {
    global $wpdb;
    $table = $wpdb->prefix . 'cf_wishlist_items';
    $uid = get_current_user_id();

    if ($uid) {
        return (bool) $wpdb->get_var(
            $wpdb->prepare("SELECT id FROM $table WHERE user_id=%d LIMIT 1", $uid)
        );
    } else {
        $session = cf_wishlist_get_session();
        return (bool) $wpdb->get_var(
            $wpdb->prepare("SELECT id FROM $table WHERE session_key=%s LIMIT 1", $session)
        );
    }
}
add_shortcode('cf_wishlist', 'render_wishlist_shortcode');
function render_wishlist_shortcode($attr = []) {
    ob_start();
    cf_wishlist_render_page();
    return ob_get_clean();
}

// Share wishlist
function cf_wishlist_generate_share_token($product_ids) {
    global $wpdb;
    $table = $wpdb->prefix . 'cf_wishlist_share_tokens';
    $token = wp_generate_uuid4();
    $wpdb->insert($table, [
        'token' => $token,
        'product_ids' => implode(',', $product_ids),
        'created_at' => current_time('mysql')
    ]);
    return $token;
}
function cf_wishlist_get_shared_items($token) {
    global $wpdb;
    $table = $wpdb->prefix . 'cf_wishlist_share_tokens';
    $row = $wpdb->get_row($wpdb->prepare("SELECT product_ids FROM $table WHERE token=%s", $token));
    if (!$row) return [];
    return array_filter(array_map('intval', explode(',', $row->product_ids)));
}

add_action('wp_ajax_cf_wishlist_share','cf_wishlist_share');
add_action('wp_ajax_nopriv_cf_wishlist_share','cf_wishlist_share');
function cf_wishlist_share() {
    $items = cf_wishlist_get_items();
    if (empty($items)) wp_send_json(['status'=>'empty']);
    $token = cf_wishlist_generate_share_token($items);
    $url = add_query_arg('wishlist_token', $token, home_url());
    wp_send_json(['status'=>'ok','url'=>$url]);
}

