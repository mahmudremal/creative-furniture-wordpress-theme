<?php
class Contact_US {

    private $table_name;

    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'contact_us';

        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('init', array($this, 'create_db_table'));
        add_action('admin_post_contact_us_action', array($this, 'handle_form_submission'));
        add_action('admin_post_nopriv_contact_us_action', array($this, 'handle_form_submission'));
    }

    public function create_db_table() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $this->table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            firstname varchar(255) NOT NULL,
            lastname varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            phone varchar(50) NOT NULL,
            message text NOT NULL,
            created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    public function add_admin_menu() {
        add_menu_page(
            'Contact Us Submissions',
            'Contact Us',
            'manage_options',
            'contact-us',
            array($this, 'contact_us_submissions_page'),
            'dashicons-email',
            30
        );
    }

    public function contact_us_submissions_page() {
        include get_template_directory() . '/template-parts/contact-us-page.php';
    }

    public function handle_form_submission() {
        if (!isset($_POST['contact_us_nonce']) || !wp_verify_nonce($_POST['contact_us_nonce'], 'contact_us_form_submit')) {
            wp_die('Security check failed');
        }

        global $wpdb;

        $firstname = sanitize_text_field($_POST['firstname'] ?? '');
        $lastname = sanitize_text_field($_POST['lastname'] ?? '');
        $email = sanitize_email($_POST['email'] ?? '');
        $phone = sanitize_text_field($_POST['phone'] ?? '');
        $message = sanitize_textarea_field($_POST['message'] ?? '');

        if (empty($firstname) || empty($email) || empty($lastname) || empty($message)) {
            wp_redirect(add_query_arg('status', 'error', wp_get_referer()));
            exit;
        }

        $result = $wpdb->insert(
            $this->table_name,
            array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'phone' => $phone,
                'message' => $message
            )
        );

        if ($result) {
            wp_redirect(add_query_arg('status', 'success', wp_get_referer()) . '#contact-form');
        } else {
            wp_redirect(add_query_arg('status', 'error', wp_get_referer()) . '#contact-form');
        }
        exit;
    }
}
$contact_us = new Contact_US();