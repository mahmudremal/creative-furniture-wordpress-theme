<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table flex flex-col gap-8">
    
    <!-- Product List -->
    <div class="flex flex-col gap-5 items-start justify-start self-stretch shrink-0 relative">
        <?php
        do_action( 'woocommerce_review_order_before_cart_contents' );

        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                ?>
                <div class="flex flex-row gap-6 items-center justify-start self-stretch shrink-0 relative border-b border-[#d9d9d9] pb-5 last:border-b-0">
                    <div class="flex flex-row gap-4 items-center justify-start flex-1 relative">
                        <div class="bg-[#d9d9d9] shrink-0 w-[98px] h-[98px] relative rounded-md">
                            <?php echo $_product->get_image( 'thumbnail', array( 'class' => 'w-full h-full object-cover' ) ); ?>
                            
                            <!-- Quantity Badge -->
                            <div class="bg-[#818080] rounded-[62px] p-2.5 flex flex-col gap-2.5 items-center justify-center shrink-0 w-6 h-6 absolute -right-2 -top-2 z-10">
                                <div class="text-[#ffffff] text-center font-['Aspekta-400',_sans-serif] text-xs leading-none font-normal relative flex items-center justify-center">
                                    <?php echo esc_html( $cart_item['quantity'] ); ?>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 items-start justify-center self-stretch flex-1 relative">
                            <div class="flex flex-col gap-1 items-start justify-start self-stretch shrink-0 relative">
                                <div class="text-[#000000] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative self-stretch">
                                    <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
                                </div>
                            </div>
                            
                            <div class="flex flex-col gap-0.5 items-start justify-start self-stretch shrink-0 relative text-xs text-[#717171] font-['Raleway-Regular']">
                                <?php echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-row gap-[66px] items-center justify-end shrink-0 relative">
                        <div class="text-[#000000] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
                            <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }

        do_action( 'woocommerce_review_order_after_cart_contents' );
        ?>
    </div>

    <!-- Discount Code Section -->
    <div class="flex flex-row gap-5 items-start justify-start self-stretch shrink-0 relative coupon-section-custom">
        <div class="bg-[#ffffff] border-solid border-[#e9eaf0] border px-4 flex flex-row gap-6 items-center justify-start shrink-0 w-[359px] h-14 relative rounded-md">
            <input type="text" name="coupon_code" class="bg-transparent border-none outline-none w-full font-['Raleway-Regular'] text-base text-[#111111] p-0 focus:ring-0" id="coupon_code" value="" placeholder="Discount Code">
        </div>
        <button type="submit" class="bg-[#000000] rounded-md pt-3 pr-5 pb-3 pl-5 flex flex-row gap-2.5 items-center justify-center self-stretch flex-1 relative" name="apply_coupon" value="Apply">
            <span class="text-[#ffffff] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">Apply</span>
        </button>
    </div>

    <!-- Totals Section -->
    <div class="flex flex-col gap-0 items-start justify-start self-stretch shrink-0 relative">
        <div class="border-solid border-[#d9d9d9] border-t border-b pt-5 pb-5 flex flex-col gap-3 items-start justify-start self-stretch shrink-0 relative">
            
            <!-- Subtotal -->
            <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                <div class="text-[#373737] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative">
                    Subtotal (Incl.Vat)
                </div>
                <div class="text-[#373737] text-right font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium uppercase relative">
                    <?php wc_cart_totals_subtotal_html(); ?>
                </div>
            </div>

            <!-- Coupons applied -->
            <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <div class="text-[#373737] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative">
                        <?php wc_cart_totals_coupon_label( $coupon ); ?>
                    </div>
                    <div class="text-[#373737] text-right font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium uppercase relative">
                        <?php wc_cart_totals_coupon_html( $coupon ); ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Shipping -->
            <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                <div class="flex flex-col gap-2 w-full">
                    <?php wc_cart_totals_shipping_html(); ?>
                </div>
            <?php endif; ?>

            <!-- Fees -->
            <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                    <div class="text-[#373737] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative"><?php echo esc_html( $fee->name ); ?></div>
                    <div class="text-[#373737] text-right font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium uppercase relative">
                        <?php wc_cart_totals_fee_html( $fee ); ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Taxes -->
            <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
                <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                    <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
                        <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                            <div class="text-[#373737] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative"><?php echo esc_html( $tax->label ); ?></div>
                            <div class="text-[#373737] text-right font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium uppercase relative">
                                <?php echo wp_kses_post( $tax->formatted_amount ); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                        <div class="text-[#373737] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></div>
                        <div class="text-[#373737] text-right font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium uppercase relative">
                            <?php wc_cart_totals_taxes_total_html(); ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <!-- Total -->
            <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative pt-2">
                <div class="text-[#373737] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
                    <?php _e( 'Total', 'woocommerce' ); ?>
                </div>
                <div class="text-[#373737] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold uppercase relative">
                    <?php wc_cart_totals_order_total_html(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
