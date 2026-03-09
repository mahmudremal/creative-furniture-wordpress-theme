<?php
class SellerRegistration {

    private $table_name;

    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'seller_registrations';

        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('init', array($this, 'create_db_table'));
        add_action('admin_post_register_seller', array($this, 'handle_form_submission'));
        add_action('admin_post_nopriv_register_seller', array($this, 'handle_form_submission'));
    }

    public function create_db_table() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $this->table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            fullname varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            phone varchar(255) NOT NULL,
            category varchar(255) NOT NULL,
            business_info text NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    public function add_admin_menu() {
        add_menu_page(
            'Seller Submissions',
            'Seller Submissions',
            'manage_options',
            'seller-registration',
            array($this, 'seller_registration_page'),
            'dashicons-businessman'
        );
    }

    public function seller_registration_page() {
        include get_template_directory() . '/template-parts/seller-registration-page.php';
    }

    public function handle_form_submission() {
        if (!isset($_POST['seller_reg_nonce']) || !wp_verify_nonce($_POST['seller_reg_nonce'], 'register_seller_action')) {
            wp_die('Security check failed');
        }

        global $wpdb;

        $fullname = sanitize_text_field($_POST['fullname'] ?? '');
        $email = sanitize_email($_POST['email'] ?? '');
        $phone = sanitize_text_field($_POST['phone'] ?? '');
        $category = sanitize_text_field($_POST['category'] ?? '');
        $business_info = sanitize_textarea_field($_POST['business_info'] ?? '');

        if (empty($fullname) || empty($email) || empty($category) || empty($business_info)) {
            wp_redirect(add_query_arg('status', 'error', wp_get_referer()));
            exit;
        }

        $result = $wpdb->insert(
            $this->table_name,
            array(
                'fullname' => $fullname,
                'email' => $email,
                'phone' => $phone,
                'category' => $category,
                'business_info' => $business_info
            )
        );

        if ($result) {
            wp_redirect(add_query_arg('status', 'success', wp_get_referer()));
        } else {
            wp_redirect(add_query_arg('status', 'error', wp_get_referer()));
        }
        exit;
    }
}
$seller_registration = new SellerRegistration();