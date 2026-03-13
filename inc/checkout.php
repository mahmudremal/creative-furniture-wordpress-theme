<?php

class CustCheckout {
    public function __construct() {
        add_filter('woocommerce_checkout_fields', [$this, 'remove_fields']);
        add_filter('woocommerce_countries_allowed_countries', [$this, 'only_uae']);
        add_action('woocommerce_checkout_create_order', [$this, 'save_full_name']);
        add_action('woocommerce_admin_order_data_after_billing_address', [$this, 'display_full_name']);
    }
    
    public function remove_fields($fields) {
        $fields['billing']['billing_first_name']['label'] = __('Full Name', 'creative-furniture');
        unset($fields['billing']['billing_last_name']);
        unset($fields['billing']['billing_city']);
        unset($fields['billing']['billing_postcode']);
        if (isset($fields['billing']['billing_town'])) unset($fields['billing']['billing_town']);
        $fields['billing']['billing_country']['default'] = 'AE';
        $fields['billing']['billing_country']['custom_attributes'] = ['readonly' => 'readonly'];
        $fields['billing']['billing_state']['label'] = __('Emirate', 'creative-furniture');

        
        $fields['shipping']['shipping_first_name']['label'] = __('Full Name', 'creative-furniture');
        unset($fields['shipping']['shipping_last_name']);
        unset($fields['shipping']['shipping_city']);
        unset($fields['shipping']['shipping_postcode']);
        if (isset($fields['shipping']['shipping_town'])) unset($fields['shipping']['shipping_town']);
        $fields['shipping']['shipping_country']['default'] = 'AE';
        $fields['shipping']['shipping_country']['custom_attributes'] = ['readonly' => 'readonly'];
        $fields['shipping']['shipping_state']['label'] = __('Emirate', 'creative-furniture');

        return $fields;

    }

    public function save_full_name($order, $data){
        if (isset($_POST['billing_full_name'])) {
            $order->update_meta_data('_billing_full_name', sanitize_text_field($_POST['billing_full_name']));
        }
    }

    public function only_uae($countries){
        return ['AE' => 'United Arab Emirates'];
    }
    public function display_full_name($order) {
        $name = $order->get_meta('billing_full_name');
        if($name){
            echo '<p><strong>Full Name:</strong> '.esc_html($name).'</p>';
        }
    }
}
global $custCheckout;
$custCheckout = new CustCheckout();