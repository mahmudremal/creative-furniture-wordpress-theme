<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-shipping-fields">
	<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>

		<div class="shipping_address">

			<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

			<div class="mt-6 -rounded-lg border-solid border-[#e9eaf0] border flex flex-col gap-0 items-start justify-start self-stretch shrink-0 relative">
                <div class="bg-[#f6f6f6] p-4 flex flex-col gap-3.5 items-start justify-start self-stretch shrink-0 relative">
                    <?php
                    $fields = $checkout->get_checkout_fields( 'shipping' );

                    // Field Wrapper CSS (same as billing)
                    $fw_class = 'bg-[#ffffff] border-solid border-[#e9eaf0] border p-4 flex flex-row gap-6 items-center justify-start self-stretch shrink-0 h-14 relative';
                    
                    // Custom function to render a field with design
                    $render_field = function($key, $field, $is_half = false, $is_third = false) use ($checkout, $fw_class) {
                        $field['class'] = array('design-field-wrapper', $is_half ? 'flex-1' : ($is_third ? 'flex-1' : 'w-full'));
                        $field['input_class'] = ['bg-transparent', 'border-none', 'outline-none', 'w-full', 'p-0', 'focus:ring-0', 'appearance-none', 'text-[#111111]', 'placeholder:text-[#9b9b9b]', 'text-left', "font-['Raleway-Regular',_sans-serif]", 'text-base', 'leading-6', 'font-normal', 'relative', 'flex', 'items-center', 'justify-start'];
                        $field['label_class'] = array('design-label', 'text-[#9b9b9b]', 'text-left', 'font-[\'Raleway-Regular\']', 'text-xs', 'leading-4', 'font-normal', 'absolute', 'top-1', 'left-4', 'pointer-events-none');
                        if (in_array($key, [ 'shipping_first_name', 'shipping_last_name', 'shipping_address_1', 'shipping_address_2', 'shipping_city', 'shipping_state', 'shipping_postcode', 'shipping_phone' ])) {
                            $field['label_class'][] = 'hidden';
                            $field['placeholder'] = $field['label'];
                        } else {
                            $field['input_class'][] = 'mt-3';
                        }
                        
                        echo '<div class="' . $fw_class . ' ' . ($is_half || $is_third ? 'flex-1' : 'w-full') . ' relative group">';
                        woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                        
                        if ($key === 'shipping_country') {
                            echo '<div class="flex flex-row gap-[23px] items-center justify-start shrink-0 relative"><svg class="shrink-0 w-5 h-5 relative overflow-visible" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 7.5L10 12.5L15 7.5" stroke="#9B9B9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>';
                        }
                        
                        echo '</div>';
                    };

                    // Rank 1: Country
                    if ( isset( $fields['shipping_country'] ) ) {
                        $render_field('shipping_country', $fields['shipping_country']);
                    }

                    // Rank 2: First Name / Last Name
                    echo '<div class="flex flex-row gap-3.5 items-start justify-start self-stretch shrink-0 relative">';
                    if ( isset( $fields['shipping_first_name'] ) ) {
                        $render_field('shipping_first_name', $fields['shipping_first_name'], true);
                    }
                    if ( isset( $fields['shipping_last_name'] ) ) {
                        $render_field('shipping_last_name', $fields['shipping_last_name'], true);
                    }
                    echo '</div>';

                    // Rank 3: Company
                    if ( isset( $fields['shipping_company'] ) ) {
                        $render_field('shipping_company', $fields['shipping_company']);
                    }

                    // Rank 4: Address 1
                    if ( isset( $fields['shipping_address_1'] ) ) {
                        $render_field('shipping_address_1', $fields['shipping_address_1']);
                    }

                    // Rank 5: Address 2 (Apartment)
                    if ( isset( $fields['shipping_address_2'] ) ) {
                        $render_field('shipping_address_2', $fields['shipping_address_2']);
                    }

                    // Rank 6: City / State / Postcode
                    echo '<div class="flex flex-row gap-3.5 items-start justify-start self-stretch shrink-0 relative">';
                    if ( isset( $fields['shipping_city'] ) ) {
                        $render_field('shipping_city', $fields['shipping_city'], false, true);
                    }
                    if ( isset( $fields['shipping_state'] ) ) {
                        $render_field('shipping_state', $fields['shipping_state'], false, true);
                    }
                    if ( isset( $fields['shipping_postcode'] ) ) {
                        $render_field('shipping_postcode', $fields['shipping_postcode'], false, true);
                    }
                    echo '</div>';
                    ?>
                </div>
            </div>

			<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

		</div>

	<?php endif; ?>
</div>
<div class="woocommerce-additional-fields mt-6">
	<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

	<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

		<div class="woocommerce-additional-fields__field-wrapper">
			<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
                <?php
                $field['class'][] = 'flex flex-col gap-1';
                $field['input_class'][] = 'bg-white border-[#e9eaf0] border p-4 w-full font-[\'Raleway-Regular\'] text-base focus:ring-black focus:border-black -rounded-lg min-h-[100px]';
                $field['label_class'][] = 'text-[#111111] font-[\'Raleway-SemiBold\'] text-xl leading-[30px] font-semibold mb-2';
                ?>
				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
			<?php endforeach; ?>
		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
</div>
