<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">
    <?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

    <div class="rounded-lg border-solid border-[#e9eaf0] border flex flex-col gap-0 items-start justify-start self-stretch shrink-0 relative">
        <div class="bg-[#f6f6f6] p-4 flex flex-col gap-3.5 items-start justify-start self-stretch shrink-0 relative">
            <?php
            $fields = $checkout->get_checkout_fields( 'billing' );

            // Field Wrapper CSS
            $fw_class = 'bg-[#ffffff] border-solid border-[#e9eaf0] border p-4 flex flex-row gap-6 items-center justify-start self-stretch shrink-0 h-14 relative';
            $input_class = 'bg-transparent border-none outline-none w-full font-[\'Raleway-Regular\'] text-base text-[#111111] p-0 focus:ring-0';
            $label_class = 'text-[#9b9b9b] text-left font-[\'Raleway-Regular\'] text-xs leading-4 font-normal absolute top-2 left-4 pointer-events-none';

            // Custom function to render a field with design
            $render_field = function($key, $field, $is_half = false, $is_third = false) use ($checkout, $fw_class, $input_class, $label_class) {
                $field['class'] = array('design-field-wrapper', $is_half ? 'flex-1' : ($is_third ? 'flex-1' : 'w-full'));
                $field['input_class'] = ['bg-transparent', 'border-none', 'outline-none', 'w-full', 'p-0', 'focus:ring-0', 'appearance-none', 'text-[#111111]', 'placeholder:text-[#9b9b9b]', 'text-left', "font-['Raleway-Regular',_sans-serif]", 'text-base', 'leading-6', 'font-normal', 'relative', 'flex', 'items-center', 'justify-start'];
                $field['label_class'] = array('design-label', 'text-[#9b9b9b]', 'text-left', 'font-[\'Raleway-Regular\']', 'text-xs', 'leading-4', 'font-normal', 'absolute', 'top-2', 'left-4', 'pointer-events-none');

                if (in_array($key, [ 'billing_first_name', 'billing_last_name', 'billing_address_1', 'billing_address_2', 'billing_city', 'billing_state', 'billing_postcode', 'billing_phone' ])) {
                    $field['label_class'][] = 'hidden';
                    $field['placeholder'] = $field['label'];
                } else {
                    $field['input_class'][] = 'mt-3';
                }
                
                // Wrap standard form field to add our container classes
                echo '<div class="' . $fw_class . ' ' . ($is_half || $is_third ? 'flex-1' : 'w-full') . ' relative group">';
                woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
                
                // Add icons for specific fields
                if ($key === 'billing_country') {
                    echo '<div class="flex flex-row gap-[23px] items-center justify-start shrink-0 relative"><svg class="shrink-0 w-5 h-5 relative overflow-visible" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 7.5L10 12.5L15 7.5" stroke="#9B9B9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>';
                } elseif ($key === 'billing_state') {
                     echo '<div class="flex flex-row gap-[23px] items-center justify-start shrink-0 relative"><svg class="shrink-0 w-5 h-5 relative overflow-visible" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 7.5L10 12.5L15 7.5" stroke="#9B9B9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>';
                } elseif ($key === 'billing_phone') {
                    echo '<div class="flex flex-row gap-[23px] items-center justify-start shrink-0 relative"><svg class="shrink-0 w-5 h-5 relative overflow-visible" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.33333 6.66853C8.48016 6.25113 8.76998 5.89917 9.15144 5.67498C9.53291 5.45079 9.98141 5.36884 10.4175 5.44364C10.8536 5.51844 11.2492 5.74517 11.5341 6.08367C11.8191 6.42217 11.975 6.8506 11.9744 7.29306C11.9744 8.54213 10.1008 9.16667 10.1008 9.16667M10.1249 11.6667H10.1333M5.83333 15V16.9463C5.83333 17.3903 5.83333 17.6123 5.92436 17.7263C6.00352 17.8255 6.12356 17.8832 6.25045 17.8831C6.39636 17.8829 6.56973 17.7442 6.91646 17.4668L8.90434 15.8765C9.31043 15.5517 9.51347 15.3892 9.73957 15.2737C9.94017 15.1712 10.1537 15.0963 10.3743 15.051C10.6231 15 10.8831 15 11.4031 15H13.5C14.9001 15 15.6002 15 16.135 14.7275C16.6054 14.4878 16.9878 14.1054 17.2275 13.635C17.5 13.1002 17.5 12.4001 17.5 11V6.5C17.5 5.09987 17.5 4.3998 17.2275 3.86502C16.9878 3.39462 16.6054 3.01217 16.135 2.77248C15.6002 2.5 14.9001 2.5 13.5 2.5H6.5C5.09987 2.5 4.3998 2.5 3.86502 2.77248C3.39462 3.01217 3.01217 3.39462 2.77248 3.86502C2.5 4.3998 2.5 5.09987 2.5 6.5V11.6667C2.5 12.4416 2.5 12.8291 2.58519 13.147C2.81635 14.0098 3.49022 14.6836 4.35295 14.9148C4.67087 15 5.05836 15 5.83333 15Z" stroke="#9B9B9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg></div>';
                }
                
                echo '</div>';
            };

            // Rank 1: Country
            if ( isset( $fields['billing_country'] ) ) {
                $render_field('billing_country', $fields['billing_country']);
            }

            // Rank 2: First Name / Last Name
            echo '<div class="flex flex-row gap-3.5 items-start justify-start self-stretch shrink-0 relative">';
            if ( isset( $fields['billing_first_name'] ) ) {
                $render_field('billing_first_name', $fields['billing_first_name'], true);
            }
            if ( isset( $fields['billing_last_name'] ) ) {
                $render_field('billing_last_name', $fields['billing_last_name'], true);
            }
            echo '</div>';

            // Rank 3: Company
            if ( isset( $fields['billing_company'] ) ) {
                $render_field('billing_company', $fields['billing_company']);
            }

            // Rank 4: Address 1
            if ( isset( $fields['billing_address_1'] ) ) {
                $render_field('billing_address_1', $fields['billing_address_1']);
            }

            // Rank 5: Address 2 (Apartment)
            if ( isset( $fields['billing_address_2'] ) ) {
                $render_field('billing_address_2', $fields['billing_address_2']);
            }

            // Rank 6: City / State / Postcode
            echo '<div class="flex flex-row gap-3.5 items-start justify-start self-stretch shrink-0 relative">';
            if ( isset( $fields['billing_city'] ) ) {
                $render_field('billing_city', $fields['billing_city'], false, true);
            }
            if ( isset( $fields['billing_state'] ) ) {
                $render_field('billing_state', $fields['billing_state'], false, true);
            }
            if ( isset( $fields['billing_postcode'] ) ) {
                $render_field('billing_postcode', $fields['billing_postcode'], false, true);
            }
            echo '</div>';

            // Rank 7: Phone
            if ( isset( $fields['billing_phone'] ) ) {
                $render_field('billing_phone', $fields['billing_phone']);
            }
            ?>
        </div>

        <?php if ( WC()->cart->needs_shipping_address() ) : ?>
            <div id="ship-to-different-address" class="bg-[#ffffff] border-solid border-[#e9eaf0] border-t p-4 flex flex-row gap-6 items-center justify-start self-stretch shrink-0 h-14 relative cursor-pointer">
                <div class="flex flex-row gap-3 items-center justify-start flex-1 relative">
                    <label class="flex items-center cursor-pointer gap-3">
                        <input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox peer hidden" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" /> 
                        <div class="bg-transparent border-[#212121] border-2 rounded-[54px] shrink-0 w-5 h-5 relative overflow-hidden transition-all duration-200 peer-checked:bg-[#212121]">
                            <svg class="w-[70%] h-[70%] absolute right-[15%] left-[15%] bottom-[15%] top-[15%] overflow-visible" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.6668 3.5L5.25016 9.91667L2.3335 7" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </label>
                    <label for="ship-to-different-address-checkbox" class="flex flex-row gap-2.5 items-center justify-start shrink-0 relative cursor-pointer">
                        <span class="text-[#565656] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start"><?php esc_html_e( 'Use a different shipping address', 'woocommerce' ); ?></span>
                    </label>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>
