<?php

class SellerDashboard {

  protected $is_seller = null;

  public function __construct() {
    $this->setup_hook();
  }

  public function setup_hook() {
    add_action('init', [$this, 'seller_dashboard_endpoints']);

    add_filter('query_vars', [$this, 'seller_dashboard_query_vars'], 0);
    add_filter('woocommerce_get_query_vars', [$this, 'seller_dashboard_wc_query_vars']);
    add_filter('woocommerce_account_menu_items', [$this, 'add_seller_dashboard_link']);

    add_action('woocommerce_account_seller-dashboard_endpoint', [$this, 'seller_dashboard_content']);
    add_action('woocommerce_account_my-products_endpoint', [$this, 'my_products_content']);

    add_action('wp_ajax_update_seller_product', [$this, 'handle_update_seller_product']);
    add_action('wp_ajax_create_seller_product', [$this, 'handle_create_seller_product']);
    add_action('wp_ajax_delete_seller_product', [$this, 'handle_delete_seller_product']);

    add_action('show_user_profile', [$this, 'seller_profile_field']);
    add_action('edit_user_profile', [$this, 'seller_profile_field']);

    add_action('personal_options_update', [$this, 'save_seller_profile_field']);
    add_action('edit_user_profile_update', [$this, 'save_seller_profile_field']);
  }

  public function is_seller() {
    if ($this->is_seller === null) {
      $this->is_seller = (bool) get_user_meta(get_current_user_id(), '_is_approved_seller', true);
    }

    return $this->is_seller;
  }

  public function seller_dashboard_endpoints() {
    add_rewrite_endpoint('seller-dashboard', EP_ROOT | EP_PAGES);
    add_rewrite_endpoint('my-products', EP_ROOT | EP_PAGES);
  }

  public function seller_dashboard_query_vars($vars) {
    $vars[] = 'seller-dashboard';
    $vars[] = 'my-products';
    return $vars;
  }

  public function seller_dashboard_wc_query_vars($vars) {
    $vars['seller-dashboard'] = 'seller-dashboard';
    $vars['my-products'] = 'my-products';
    return $vars;
  }

  public function add_seller_dashboard_link($items) {
    if (!$this->is_seller()) {
      return $items;
    }

    $new_items = [];

    foreach ($items as $key => $value) {
      $new_items[$key] = $value;

      if ($key === 'dashboard') {
        $new_items['seller-dashboard'] = __('Seller Dashboard', 'creative-furniture');
        $new_items['my-products'] = __('My Products', 'creative-furniture');
      }
    }

    return $new_items;
  }

  public function seller_dashboard_content() {
    if (!$this->is_seller()) {
      echo __('You are not an approved seller.', 'creative-furniture');
      return;
    }

    include get_template_directory() . '/woocommerce/myaccount/seller-dashboard.php';
  }

  public function my_products_content() {
    if (!$this->is_seller()) {
      echo __('You are not an approved seller.', 'creative-furniture');
      return;
    }

    $my_products_var = get_query_var('my-products');

    $parts = explode('/', rtrim($my_products_var, '/'));
    $product_id = 0;
    $action = '';

    if (!empty($parts[0])) {
      $product_id = intval($parts[0]);

      if (isset($parts[1]) && $parts[1] === 'edit') {
        $action = 'edit';
      }
    }

    if ($product_id === 0 && isset($parts[1]) && $parts[1] === 'edit') {
      $action = 'add';
    }

    if ($action === 'edit' || $action === 'add') {
      include get_template_directory() . '/woocommerce/myaccount/form-product.php';
    } else {
      include get_template_directory() . '/woocommerce/myaccount/my-products.php';
    }
  }

  private function cf_handle_product_save($product, $data) {
    $product->set_name(sanitize_text_field($data['product_name']));
    $product->set_regular_price(sanitize_text_field($data['regular_price']));
    $product->set_sale_price(sanitize_text_field($data['sale_price']));

    $product->set_description(wp_kses_post($data['description']));
    $product->set_short_description(wp_kses_post($data['short_description']));

    $product->set_sku(sanitize_text_field($data['sku']));

    $manage_stock = isset($data['manage_stock']) && $data['manage_stock'] === 'yes';
    $product->set_manage_stock($manage_stock);

    if ($manage_stock) {
      $product->set_stock_quantity(intval($data['stock_quantity']));
    }

    $product->set_stock_status(sanitize_text_field($data['stock_status']));

    $product->set_weight(sanitize_text_field($data['weight']));
    $product->set_length(sanitize_text_field($data['length']));
    $product->set_width(sanitize_text_field($data['width']));
    $product->set_height(sanitize_text_field($data['height']));

    if (isset($data['product_cats']) && is_array($data['product_cats'])) {
      $product->set_category_ids(array_map('intval', $data['product_cats']));
    }

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

  public function handle_update_seller_product() {
    if (!$this->is_seller()) {
      wp_send_json_error('Unauthorized');
    }

    check_ajax_referer('seller_product_nonce', 'nonce');

    $product_id = intval($_POST['product_id']);
    $product = wc_get_product($product_id);

    if (!$product || $product->get_meta('_seller_id') != get_current_user_id()) {
      wp_send_json_error('Unauthorized');
    }

    $this->cf_handle_product_save($product, $_POST);

    wp_send_json_success([
      'message' => 'Product updated successfully',
      'redirect' => wc_get_account_endpoint_url('my-products')
    ]);
  }

  public function handle_create_seller_product() {
    if (!$this->is_seller()) {
      wp_send_json_error('Unauthorized');
    }

    check_ajax_referer('seller_product_nonce', 'nonce');

    $product = new WC_Product_Simple();
    $product->set_status('draft');

    $this->cf_handle_product_save($product, $_POST);

    $product->update_meta_data('_seller_id', get_current_user_id());
    $product->save_meta_data();

    wp_send_json_success([
      'message' => 'Product created successfully',
      'redirect' => wc_get_account_endpoint_url('my-products')
    ]);
  }

  public function handle_delete_seller_product() {
    if (!$this->is_seller()) {
      wp_send_json_error('Unauthorized');
    }

    check_ajax_referer('seller_product_nonce', 'nonce');

    $product_id = intval($_POST['product_id']);
    $product = wc_get_product($product_id);

    if (!$product || $product->get_meta('_seller_id') != get_current_user_id()) {
      wp_send_json_error('Unauthorized');
    }

    wp_delete_post($product_id, true);

    wp_send_json_success('Product deleted successfully');
  }

  public function get_seller_products($user_id, $paged = 1) {
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

  public function get_seller_recent_orders($user_id, $limit = 10) {
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

    foreach ($orders as $order) {
      foreach ($order->get_items() as $item) {
        $product = $item->get_product();

        if ($product && $product->get_meta('_seller_id') == $user_id) {
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

  public function seller_profile_field($user) {
    ?>
    <h3>Seller Settings</h3>
    <table class="form-table">
      <tr>
        <th><label for="_is_approved_seller">Approved Seller</label></th>
        <td>
          <label>
            <input type="checkbox" name="_is_approved_seller" value="1" <?php checked(get_user_meta($user->ID, '_is_approved_seller', true), 1); ?> />
            Mark as approved seller
          </label>
        </td>
      </tr>
    </table>
    <?php
  }

  public function save_seller_profile_field($user_id) {
    if (!current_user_can('edit_user', $user_id)) {
      return;
    }

    $value = isset($_POST['_is_approved_seller']) ? 1 : 0;

    update_user_meta($user_id, '_is_approved_seller', $value);
  }
}
global $sellerDash;
$sellerDash = new SellerDashboard();
