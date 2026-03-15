<?php

class CF_Reward_Points {
    private $table_logs;
    private $points_rate = 1000;

    public function __construct() {
        global $wpdb;
        $this->table_logs = $wpdb->prefix . 'cf_reward_points_logs';
        $this->init_hooks();
    }

    private function init_hooks() {
        add_action('init', array($this, 'create_table'));
        
        add_action('add_meta_boxes', array($this, 'add_product_metabox'));
        add_action('save_post_product', array($this, 'save_product_reward_points'));
        
        add_action('woocommerce_order_status_completed', array($this, 'earn_points_on_purchase'));
        add_action('woocommerce_cart_calculate_fees', array($this, 'apply_reward_discount'));
        add_action('woocommerce_single_product_summary', array($this, 'show_product_points'), 25);
        add_action('woocommerce_checkout_order_processed', array($this, 'log_redeemed_points'), 10, 3);

        add_action('init', array($this, 'rewards_endpoints'));
        add_filter('query_vars', [$this, 'rewards_query_vars'], 0);
        add_filter('woocommerce_get_query_vars', [$this, 'rewards_wc_query_vars']);
        add_filter('woocommerce_account_menu_items', [$this, 'add_rewards_link']);
        add_action('woocommerce_account_reward_endpoint', [$this, 'reward_dashboard_content']);
    }
    
    public function create_table() {
        global $wpdb;
        if ( get_option( 'cf_reward_points_db_version' ) !== '1.0' ) {
            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE $this->table_logs (
                id bigint(20) NOT NULL AUTO_INCREMENT,
                user_id bigint(20) NOT NULL,
                order_id bigint(20) NOT NULL,
                points int(11) NOT NULL,
                type varchar(20) NOT NULL,
                description varchar(255) NOT NULL,
                created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            update_option('cf_reward_points_db_version', '1.0');
        }
    }
    
    public function add_product_metabox() {
        add_meta_box('cf_reward_points_box', 'Reward Points', array($this, 'render_metabox'), 'product', 'side', 'default');
    }
    
    public function render_metabox($post) {
        $points = get_post_meta($post->ID, '_cf_reward_points', true);
        echo '<label for="cf_reward_points">Points earned on purchase:</label>';
        echo '<input type="number" id="cf_reward_points" name="cf_reward_points" value="' . esc_attr($points) . '" class="widefat" />';
    }
    
    public function save_product_reward_points($post_id) {
        if (isset($_POST['cf_reward_points'])) {
            update_post_meta($post_id, '_cf_reward_points', intval($_POST['cf_reward_points']));
        }
    }
    
    public function earn_points_on_purchase($order_id) {
        $order = wc_get_order($order_id);
        $user_id = $order->get_user_id();
        
        if (!$user_id || get_post_meta($order_id, '_reward_points_awarded', true)) {
            return;
        }
        
        $total_points = 0;
        foreach ($order->get_items() as $item) {
            $product_id = $item->get_product_id();
            $points = get_post_meta($product_id, '_cf_reward_points', true);
            if ($points) {
                $total_points += (intval($points) * $item->get_quantity());
            }
        }
        
        if ($total_points > 0) {
            $this->log_points($user_id, $order_id, $total_points, 'earned', 'Earned points from order #' . $order_id);
            update_post_meta($order_id, '_reward_points_awarded', true);
        }
    }

    public function show_product_points() {
        global $product;
        $points = get_post_meta($product->get_id(), '_cf_reward_points', true);
        if ($points) {
            echo '<div class="cf-reward-points-info text-green-600 font-semibold mb-4">Earn ' . intval($points) . ' reward points upon purchase!</div>';
        }
    }
    
    public function get_user_points($user_id) {
        global $wpdb;
        $earned = $wpdb->get_var($wpdb->prepare("SELECT SUM(points) FROM $this->table_logs WHERE user_id = %d AND type = 'earned'", $user_id));
        $redeemed = $wpdb->get_var($wpdb->prepare("SELECT SUM(points) FROM $this->table_logs WHERE user_id = %d AND type = 'redeemed'", $user_id));
        return intval($earned) - intval($redeemed);
    }
    
    public function log_points($user_id, $order_id, $points, $type, $description) {
        global $wpdb;
        $wpdb->insert(
            $this->table_logs,
            array(
                'user_id' => $user_id,
                'order_id' => $order_id,
                'points' => $points,
                'type' => $type,
                'description' => $description
            ),
            array('%d', '%d', '%d', '%s', '%s')
        );
    }
    
    public function apply_reward_discount($cart) {
        if (is_admin() && !defined('DOING_AJAX')) return;
        if (!is_user_logged_in()) return;
        
        $user_id = get_current_user_id();
        $user_points = $this->get_user_points($user_id);
        
        if ($user_points >= $this->points_rate) {
            $discount_amount = floor($user_points / $this->points_rate);
            $cart_total = $cart->get_subtotal();
            if ($discount_amount > $cart_total) {
                $discount_amount = $cart_total;
            }
            if ($discount_amount > 0) {
                $cart->add_fee(__('Reward Points Discount', 'creative-furniture'), -$discount_amount);
            }
        }
    }
    
    public function log_redeemed_points($order_id, $posted_data, $order) {
        $user_id = $order->get_user_id();
        if (!$user_id) return;
        
        foreach ($order->get_fees() as $fee) {
            if ($fee->get_name() === __('Reward Points Discount', 'creative-furniture')) {
                $discount = abs($fee->get_total());
                $points_used = $discount * $this->points_rate;
                $this->log_points($user_id, $order_id, $points_used, 'redeemed', 'Redeemed points for order #' . $order_id);
            }
        }
    }

    public function get_user_logs($user_id) {
        global $wpdb;
        return $wpdb->get_results($wpdb->prepare("SELECT * FROM $this->table_logs WHERE user_id = %d ORDER BY created_at DESC", $user_id));
    }

    public function rewards_endpoints() {
        add_rewrite_endpoint('reward', EP_ROOT | EP_PAGES);
    }
    
    public function rewards_query_vars($vars) {
        $vars[] = 'reward';
        return $vars;
    }

    
    public function rewards_wc_query_vars($vars) {
        $vars['reward'] = 'reward';
        return $vars;
    }

    public function add_rewards_link($items) {
        $items = [...array_slice($items, 0, -1), 'reward' => __('Reward', 'creative-furniture'), ...array_slice($items, -1)];
        return $items;
    }

    public function reward_dashboard_content() {
        include get_template_directory() . '/woocommerce/myaccount/rewards.php';
    }
}

global $cf_reward_points;
$cf_reward_points = new CF_Reward_Points();