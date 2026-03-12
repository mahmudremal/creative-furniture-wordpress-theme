<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<div class="flex flex-col gap-7 pt-10 pb-20">
    <div class="flex flex-row gap-2 items-center justify-start px-4 md:px-0 w-full md:w-[1440px] m-auto relative">
        <div class="text-[#989898] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
        </div>
        <div class="text-[#989898] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">
            /
        </div>
        <div class="text-[#000000] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">
            Cart
        </div>
    </div>

    <div class="flex flex-wrap md:grid grid-cols-1 md:grid-cols-[2fr_1fr] gap-7 items-start justify-between px-4 md:px-0 w-full md:w-[1440px] m-auto relative">
        <div class="flex flex-col gap-6 items-start justify-start shrink-0 w-full md:w-[887px] relative">
            <div class="text-black-primary text-left font-['Raleway-Medium',_sans-serif] text-2xl leading-[44px] font-medium relative self-stretch flex items-center justify-start">
                <?php esc_html_e( 'Your cart', 'woocommerce' ); ?> (<?php echo WC()->cart->get_cart_contents_count(); ?>)
            </div>

            <form class="woocommerce-cart-form w-full" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                <?php do_action( 'woocommerce_before_cart_table' ); ?>

                <div class="flex flex-col gap-5 items-start justify-start self-stretch shrink-0 relative">
                    <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            ?>
                            <div class="border-solid border-[#e2e2e2] border-b pb-5 flex flex-row gap-4 md:gap-6 items-center justify-start self-stretch shrink-0 relative woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                                <div class="bg-[#f4f4f4] shrink-0 w-36 h-36 relative overflow-hidden">
                                    <?php
                                    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

                                    if ( ! $product_permalink ) {
                                        echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    } else {
                                        printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    }
                                    ?>
                                </div>
                                <div class="flex flex-col gap-4 items-start justify-start flex-1 relative">
                                    <div class="flex flex-row gap-1 items-start justify-start self-stretch shrink-0 relative">
                                        <div class="flex flex-col gap-1.5 items-start justify-start flex-1 relative">
                                            <div class="text-[#111111] text-left font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative self-stretch flex items-center justify-start product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                                <?php
                                                if ( ! $product_permalink ) {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
                                                } else {
                                                    echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                                }

                                                do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );
                                                ?>
                                            </div>
                                        </div>
                                        <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                            <?php
                                                echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                                            ?>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-0.5 items-start justify-start self-stretch shrink-0 relative product-meta">
                                        <?php
                                            echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

                                            if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
                                            }
                                        ?>
                                    </div>
                                    <div class="flex flex-row gap-3 items-center justify-start self-stretch shrink-0 relative">
                                            <?php
                                            if ( $_product->is_sold_individually() ) {
                                                $min_quantity = 1;
                                                $max_quantity = 1;
                                            } else {
                                                $min_quantity = 0;
                                                $max_quantity = $_product->get_max_purchase_quantity();
                                            }

                                            $product_quantity = woocommerce_quantity_input(
                                                array(
                                                    'input_name'   => "cart[{$cart_item_key}][qty]",
                                                    'input_value'  => $cart_item['quantity'],
                                                    'max_value'    => $max_quantity,
                                                    'min_value'    => $min_quantity,
                                                    'product_name' => $_product->get_name(),
                                                ),
                                                $_product,
                                                false
                                            );

                                            echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
                                            ?>
                                        <div class="flex flex-row gap-2 items-center justify-start flex-1 relative product-remove">
                                            <div class="flex flex-row gap-2.5 items-center justify-start shrink-0 relative">
                                                <div class="flex flex-row gap-[5px] items-center justify-start shrink-0 relative">
                                                <?php
                                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                        'woocommerce_cart_item_remove_link',
                                                        sprintf(
                                                            '<a href="%s" class="remove flex items-center gap-1" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                                                                <svg class="shrink-0 w-3 h-3 relative overflow-visible" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M10.5001 3.36523C10.4901 3.36523 10.4751 3.36523 10.4601 3.36523C7.81508 3.10023 5.17508 3.00023 2.56008 3.26523L1.54008 3.36523C1.33008 3.38523 1.14508 3.23523 1.12508 3.02523C1.10508 2.81523 1.25508 2.63523 1.46008 2.61523L2.48008 2.51523C5.14008 2.24523 7.83508 2.35023 10.5351 2.61523C10.7401 2.63523 10.8901 2.82023 10.8701 3.02523C10.8551 3.22023 10.6901 3.36523 10.5001 3.36523Z" fill="black" fill-opacity="0.6"></path>
                                                                    <path d="M4.24988 2.86C4.22988 2.86 4.20988 2.86 4.18488 2.855C3.98488 2.82 3.84488 2.625 3.87988 2.425L3.98988 1.77C4.06988 1.29 4.17988 0.625 5.34488 0.625H6.65488C7.82488 0.625 7.93488 1.315 8.00988 1.775L8.11988 2.425C8.15488 2.63 8.01488 2.825 7.81488 2.855C7.60988 2.89 7.41488 2.75 7.38488 2.55L7.27488 1.9C7.20488 1.465 7.18988 1.38 6.65988 1.38H5.34988C4.81988 1.38 4.80988 1.45 4.73488 1.895L4.61988 2.545C4.58988 2.73 4.42988 2.86 4.24988 2.86Z" fill="black" fill-opacity="0.6"></path>
                                                                    <path d="M7.60495 11.3748H4.39495C2.64995 11.3748 2.57995 10.4098 2.52495 9.62979L2.19995 4.59479C2.18495 4.38979 2.34495 4.20979 2.54995 4.19479C2.75995 4.18479 2.93495 4.33979 2.94995 4.54479L3.27495 9.57979C3.32995 10.3398 3.34995 10.6248 4.39495 10.6248H7.60495C8.65495 10.6248 8.67495 10.3398 8.72495 9.57979L9.04995 4.54479C9.06495 4.33979 9.24495 4.18479 9.44995 4.19479C9.65495 4.20979 9.81495 4.38479 9.79995 4.59479L9.47495 9.62979C9.41995 10.4098 9.34995 11.3748 7.60495 11.3748Z" fill="black" fill-opacity="0.6"></path>
                                                                    <path d="M6.83004 8.625H5.16504C4.96004 8.625 4.79004 8.455 4.79004 8.25C4.79004 8.045 4.96004 7.875 5.16504 7.875H6.83004C7.03504 7.875 7.20504 8.045 7.20504 8.25C7.20504 8.455 7.03504 8.625 6.83004 8.625Z" fill="black" fill-opacity="0.6"></path>
                                                                    <path d="M7.25 6.625H4.75C4.545 6.625 4.375 6.455 4.375 6.25C4.375 6.045 4.545 5.875 4.75 5.875H7.25C7.455 5.875 7.625 6.045 7.625 6.25C7.625 6.455 7.455 6.625 7.25 6.625Z" fill="black" fill-opacity="0.6"></path>
                                                                </svg>
                                                                <span class="text-[rgba(0,0,0,0.60)] text-left font-[\'Raleway-Regular\',_sans-serif] text-xs font-normal relative leading-none">Remove</span>
                                                            </a>',
                                                            esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                            esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $_product->get_name() ) ) ),
                                                            esc_attr( $product_id ),
                                                            esc_attr( $_product->get_sku() )
                                                        ),
                                                        $cart_item_key
                                                    );
                                                ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <div class="flex flex-wrap gap-5 items-center justify-between mt-8">
                    <div class="coupon-section flex gap-3">
                        <?php if ( wc_coupons_enabled() ) { ?>
                            <input type="text" name="coupon_code" class="border-solid border-[#e2e2e2] border p-2 text-sm" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
                            <button type="submit" class="bg-black text-white px-4 py-2 text-sm font-semibold" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply', 'woocommerce' ); ?></button>
                        <?php } ?>
                    </div>
                    
                    <button type="submit" class="bg-black text-white px-6 py-2 text-sm font-semibold" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>
                </div>

                <?php do_action( 'woocommerce_cart_contents' ); ?>
                <?php do_action( 'woocommerce_cart_actions' ); ?>
                <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                <?php do_action( 'woocommerce_after_cart_table' ); ?>
            </form>
        </div>

        <div class="flex flex-col gap-6 items-center justify-start shrink-0 w-full md:w-[453px] relative sticky top-0">
            <div class="bg-[#f4f4f4] rounded-lg p-6 flex flex-col gap-5 items-start justify-start self-stretch shrink-0 relative">
                <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-[44px] font-semibold relative self-stretch flex items-center justify-start">
                    Order Summary
                </div>
                <div class="flex flex-col gap-3 items-start justify-start self-stretch shrink-0 relative">
                    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                        <div class="text-[#373737] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative">
                            Subtotal (Incl.Vat)
                        </div>
                        <div class="text-[#373737] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative">
                            <?php wc_cart_totals_subtotal_html(); ?>
                        </div>
                    </div>
                    <?php if ( WC()->cart->get_cart_contents_tax() > 0 ) : ?>
                    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                        <div class="text-[#373737] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative">
                            VAT Amount
                        </div>
                        <div class="text-[#373737] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative">
                            <?php echo wc_price( WC()->cart->get_cart_contents_tax() ); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                        <div class="text-[#373737] text-left font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold uppercase relative">
                            Total
                        </div>
                        <div class="text-[#373737] text-right font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold uppercase relative">
                            <?php wc_cart_totals_order_total_html(); ?>
                        </div>
                    </div>
                </div>

                <div class="bg-[#0c0a0a] pt-3 pr-5 pb-3 pl-5 flex flex-row gap-1 items-center justify-center self-stretch shrink-0 h-12 relative mt-4">
                    <div class="flex flex-row gap-2 items-center justify-center flex-1 relative text-center">
                        <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative checkout-button button alt wc-forward w-full">
                            Secure Checkout
                        </a>
                    </div>
                </div>

                <div class="text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative self-stretch flex items-center justify-start mt-2">
                    <span class="text-xs text-[#737373]">
                        By continuing to Checkout, you are agreeing to our 
                        <a href="<?php echo esc_url( get_permalink( wc_terms_and_conditions_page_id() ) ); ?>" class="underline">Terms of Use</a> and 
                        <a href="<?php echo esc_attr( get_privacy_policy_url() ); ?>" class="underline">Privacy Policy.</a>
                    </span>
                </div>
            </div>
            <img class="shrink-0 w-[366px] h-[27px] relative" style="object-fit: cover; aspect-ratio: 366/27" src="<?php echo get_template_directory_uri(); ?>/dist/images/payment-methods.png">
        </div>
    </div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
