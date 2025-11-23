<?php

add_action('init', 'add_seller_dashboard_endpoint');
function add_seller_dashboard_endpoint() {
    add_rewrite_endpoint('seller-dashboard', EP_ROOT | EP_PAGES);
    add_rewrite_endpoint('my-products', EP_ROOT | EP_PAGES);
}

add_filter('query_vars', 'seller_dashboard_query_vars', 0);
function seller_dashboard_query_vars($vars) {
    $vars[] = 'seller-dashboard';
    $vars[] = 'my-products';
    return $vars;
}

add_filter('woocommerce_account_menu_items', 'add_seller_dashboard_link');
function add_seller_dashboard_link($items) {
    $new_items = array();
    foreach($items as $key => $value) {
        $new_items[$key] = $value;
        if($key === 'dashboard') {
            $new_items['seller-dashboard'] = __('Seller Dashboard', 'creative-furniture');
        }
    }
    return $new_items;
}

add_action('woocommerce_account_seller-dashboard_endpoint', 'seller_dashboard_content');
function seller_dashboard_content() {
    include get_template_directory() . '/woocommerce/myaccount/seller-dashboard.php';
}

add_action('woocommerce_account_my-products_endpoint', 'my_products_content');
function my_products_content() {
    include get_template_directory() . '/woocommerce/myaccount/my-products.php';
}

add_action('wp_ajax_update_seller_product', 'handle_update_seller_product');
function handle_update_seller_product() {
    check_ajax_referer('seller_product_nonce', 'nonce');
    
    $product_id = intval($_POST['product_id']);
    $product = wc_get_product($product_id);
    
    if(!$product || $product->get_meta('_seller_id') != get_current_user_id()) {
        wp_send_json_error('Unauthorized');
        return;
    }
    
    $product->set_name(sanitize_text_field($_POST['product_name']));
    $product->set_regular_price(sanitize_text_field($_POST['regular_price']));
    $product->set_sale_price(sanitize_text_field($_POST['sale_price']));
    $product->set_description(wp_kses_post($_POST['description']));
    $product->set_stock_quantity(intval($_POST['stock_quantity']));
    
    if($_POST['stock_status'] === 'instock') {
        $product->set_stock_status('instock');
    } else {
        $product->set_stock_status('outofstock');
    }
    
    $product->save();
    
    wp_send_json_success('Product updated successfully');
}

add_action('wp_ajax_delete_seller_product', 'handle_delete_seller_product');
function handle_delete_seller_product() {
    check_ajax_referer('seller_product_nonce', 'nonce');
    
    $product_id = intval($_POST['product_id']);
    $product = wc_get_product($product_id);
    
    if(!$product || $product->get_meta('_seller_id') != get_current_user_id()) {
        wp_send_json_error('Unauthorized');
        return;
    }
    
    wp_delete_post($product_id, true);
    wp_send_json_success('Product deleted successfully');
}

function get_seller_products($user_id, $paged = 1) {
    $args = [
        'post_type' => 'product',
        'posts_per_page' => 50,
        'paged' => (int) $paged,
        'meta_query' => [
            [
                'key' => '_seller_id',
                'value' => $user_id,
                'compare' => '='
            ]
        ]
    ];
    return get_posts($args);
}

function get_seller_recent_orders($user_id, $limit = 10) {
    global $wpdb;
    
    $orders = wc_get_orders([
        'limit' => $limit,
        'orderby' => 'date',
        'order' => 'DESC',
        'status' => [
            'wc-processing',
            'wc-completed',
            'wc-pending'
        ]
    ]);
    
    $seller_orders = [];
    
    foreach($orders as $order) {
        foreach($order->get_items() as $item) {
            $product = $item->get_product();
            if($product && $product->get_meta('_seller_id') == $user_id) {
                $seller_orders[] = [
                    'order' => $order,
                    'item' => $item,
                    'product' => $product
                ];
                break;
            }
        }
    }
    
    return $seller_orders;
}