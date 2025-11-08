<?php
defined('ABSPATH') || exit;
$checkout = WC()->checkout();
?>

<div class="woocommerce-billing-fields">
    <?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>

    <div class="woocommerce-billing-fields__field-wrapper">
        <?php
        $fields = $checkout->get_checkout_fields('billing');
        
        $field_order = [
            'billing_country',
            'billing_first_name',
            'billing_last_name',
            'billing_company',
            'billing_address_1',
            'billing_address_2',
            'billing_city',
            'billing_state',
            'billing_postcode',
            'billing_phone'
        ];

        foreach ($field_order as $key) {
            if (isset($fields[$key])) {
                $field = $fields[$key];
                
                if ($key === 'billing_country') {
                    $field['class'][] = 'form-row-wide';
                    $field['label'] = 'Country/Region';
                }
                
                if ($key === 'billing_first_name') {
                    $field['class'] = ['form-row-first'];
                    $field['label'] = 'First Name';
                    $field['placeholder'] = 'First Name';
                }
                
                if ($key === 'billing_last_name') {
                    $field['class'] = ['form-row-last'];
                    $field['label'] = 'Last Name';
                    $field['placeholder'] = 'Last Name';
                }
                
                if ($key === 'billing_company') {
                    $field['class'][] = 'form-row-wide';
                    $field['label'] = 'Company (optional)';
                    $field['placeholder'] = 'Company (optional)';
                    $field['required'] = false;
                }
                
                if ($key === 'billing_address_1') {
                    $field['class'][] = 'form-row-wide';
                    $field['label'] = 'Address';
                    $field['placeholder'] = 'Address';
                }
                
                if ($key === 'billing_address_2') {
                    $field['class'][] = 'form-row-wide';
                    $field['label'] = 'Apartment, suite, etc. (optional)';
                    $field['placeholder'] = 'Apartment, suite, etc. (optional)';
                    $field['required'] = false;
                }
                
                if ($key === 'billing_city') {
                    $field['class'] = ['form-row-first'];
                    $field['label'] = 'City';
                    $field['placeholder'] = 'City';
                }
                
                if ($key === 'billing_state') {
                    $field['class'] = ['form-row-last'];
                    $field['label'] = 'State';
                    $field['placeholder'] = 'State';
                }
                
                if ($key === 'billing_postcode') {
                    $field['class'] = ['form-row-last'];
                    $field['label'] = 'ZIP code';
                    $field['placeholder'] = 'ZIP code';
                }
                
                if ($key === 'billing_phone') {
                    $field['class'][] = 'form-row-wide';
                    $field['label'] = 'Phone Number';
                    $field['placeholder'] = 'Phone Number';
                }
                
                woocommerce_form_field($key, $field, $checkout->get_value($key));
            }
        }
        ?>
    </div>

    <?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
</div>