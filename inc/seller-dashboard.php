<?php

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
    global $wp_query;
    $my_products_var = get_query_var('my-products');
    
    // Parse the endpoint value: ID/edit
    $parts = explode('/', rtrim($my_products_var, '/'));
    $product_id = 0;
    $action = '';
    
    if (!empty($parts[0])) {
        $product_id = intval($parts[0]);
        if (isset($parts[1]) && $parts[1] === 'edit') {
            $action = 'edit';
        }
    }
    
    // If ID is 0 and action is edit, it means "Add New" based on user request /0/edit
    if ($product_id === 0 && isset($parts[1]) && $parts[1] === 'edit') {
        $action = 'add';
    }

    if ($action === 'edit' || $action === 'add') {
        include get_template_directory() . '/woocommerce/myaccount/form-product.php';
    } else {
        include get_template_directory() . '/woocommerce/myaccount/my-products.php';
    }
}

function cf_handle_product_save($product, $data) {
    $product->set_name(sanitize_text_field($data['product_name']));
    $product->set_regular_price(sanitize_text_field($data['regular_price']));
    $product->set_sale_price(sanitize_text_field($data['sale_price']));
    $product->set_description(wp_kses_post($data['description']));
    $product->set_short_description(wp_kses_post($data['short_description']));
    
    // Inventory
    $product->set_sku(sanitize_text_field($data['sku']));
    $manage_stock = isset($data['manage_stock']) && $data['manage_stock'] === 'yes';
    $product->set_manage_stock($manage_stock);
    if ($manage_stock) {
        $product->set_stock_quantity(intval($data['stock_quantity']));
    }
    $product->set_stock_status(sanitize_text_field($data['stock_status']));
    
    // Shipping
    $product->set_weight(sanitize_text_field($data['weight']));
    $product->set_length(sanitize_text_field($data['length']));
    $product->set_width(sanitize_text_field($data['width']));
    $product->set_height(sanitize_text_field($data['height']));
    
    // Categories
    if (isset($data['product_cats']) && is_array($data['product_cats'])) {
        $product->set_category_ids(array_map('intval', $data['product_cats']));
    }
    
    // Image Upload
    if (!empty($_FILES['product_image']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        
        $attachment_id = media_handle_upload('product_image', $product->get_id());
        if (!is_wp_error($attachment_id)) {
            $product->set_image_id($attachment_id);
        }
    }
    
    $product->save();
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
    
    cf_handle_product_save($product, $_POST);
    
    wp_send_json_success([
        'message' => 'Product updated successfully',
        'redirect' => wc_get_account_endpoint_url('my-products')
    ]);
}

add_action('wp_ajax_create_seller_product', 'handle_create_seller_product');
function handle_create_seller_product() {
    check_ajax_referer('seller_product_nonce', 'nonce');
    
    $product = new WC_Product_Simple();
    $product->set_status('draft');
    
    cf_handle_product_save($product, $_POST);
    
    $product->update_meta_data('_seller_id', get_current_user_id());
    $product->save_meta_data();
    
    wp_send_json_success([
        'message' => 'Product created successfully',
        'redirect' => wc_get_account_endpoint_url('my-products')
    ]);
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
        'post_status' => ['publish', 'draft', 'pending'],
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