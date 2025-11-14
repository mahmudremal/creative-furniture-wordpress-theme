<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_checkout_form', $checkout);

if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}
?>

<div class="checkout-wrapper">
        
        <div class="checkout-main">
            <div class="checkout-left">
                <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
                    <h1 class="checkout-title">Checkout</h1>

                    <div class="express-checkout">
                        <div class="section-divider">
                            <span>Express checkout</span>
                        </div>
                        <div class="express-buttons">
                            <img src="<?php echo get_template_directory_uri(); ?>/dist/images/payment-methods.png" alt="Express Checkout" />
                        </div>
                        <div class="section-divider">
                            <span>OR</span>
                        </div>
                    </div>

                    <?php if ($checkout->get_checkout_fields()): ?>
                        <div class="checkout-section contact-info">
                            <div class="section-header">
                                <h2>Contact information</h2>
                                <?php if (!is_user_logged_in()): ?>
                                    <div class="login-prompt">
                                        <span>Already have and account?</span>
                                        <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>" class="login-link">Log in</a>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                            <div class="checkout-fields">
                                <?php foreach ($checkout->get_checkout_fields('billing') as $key => $field): ?>
                                    <?php if ($key === 'billing_email'): ?>
                                        <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>

                            <label class="checkbox-label">
                                <input type="checkbox" name="newsletter" value="1">
                                <span class="checkbox-custom"></span>
                                <span>Email me with news and offers</span>
                            </label>
                        </div>
                    <?php endif; ?>

                    <div class="checkout-section payment-section">
                        <div class="section-header-simple">
                            <h2>Payment</h2>
                            <p>Already have and account?</p>
                        </div>

                        <?php if (WC()->cart->needs_payment()): ?>
                            <div id="payment" class="woocommerce-checkout-payment">
                                <?php woocommerce_checkout_payment(); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="checkout-section billing-section">
                        <div class="section-header-simple">
                            <h2>Billing Address</h2>
                            <p>Select the address that matches your card or payment method.</p>
                        </div>

                        <div class="billing-options">
                            <label class="radio-option">
                                <input type="radio" name="billing_address_type" value="shipping" checked>
                                <span class="radio-custom"></span>
                                <span>Same as shipping address</span>
                            </label>

                            <label class="radio-option">
                                <input type="radio" name="billing_address_type" value="different">
                                <span class="radio-custom"></span>
                                <span>Use a different billing address</span>
                            </label>

                            <div class="billing-fields-wrapper">
                                <?php do_action('woocommerce_checkout_billing'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-section remember-section">
                        <h2>Remember Me</h2>
                        <label class="checkbox-label">
                            <input type="checkbox" name="save_info" value="1" checked>
                            <span class="checkbox-custom"></span>
                            <span>Save my information for a faster checkout</span>
                        </label>
                    </div>

                    <div class="checkout-actions">
                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="back-link">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M15 18L9 12L15 6" stroke="#9D8465" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Return to shipping</span>
                        </a>
                        <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
                        <button type="submit" class="button alt checkout-button" name="woocommerce_checkout_place_order" id="place_order" value="<?php esc_attr_e('Place order', 'woocommerce'); ?>">
                            Pay now
                        </button>
                    </div>
                </form>
            </div>

            <div class="checkout-right">
                <div class="order-summary">
                    <div class="cart-items">
                        <?php
                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item):
                            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                            if ($_product && $_product->exists() && $cart_item['quantity'] > 0):
                        ?>
                            <div class="cart-item">
                                <div class="item-image">
                                    <?php echo $_product->get_image(); ?>
                                    <?php if ($cart_item['quantity'] > 1): ?>
                                        <span class="quantity-badge"><?php echo $cart_item['quantity']; ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="item-details">
                                    <h3><?php echo $_product->get_name(); ?></h3>
                                    <div class="cart-item-meta">
                                        <?php
                                        $product = $cart_item['data'];

                                        if ( isset( $cart_item['variation'] ) && ! empty( $cart_item['variation'] ) ) {
                                            // For variable products – get selected attributes from cart item
                                            foreach ( $cart_item['variation'] as $attr_name => $attr_value ) {
                                                $attr_label = wc_attribute_label( str_replace( 'attribute_', '', $attr_name ), $product );
                                                echo '<div class="meta-item"><span class="meta-label">' . esc_html( $attr_label ) . ':</span> <span class="meta-value">' . esc_html( $attr_value ) . '</span></div>';
                                            }
                                        } else {
                                            // For simple products – fallback to all attributes
                                            $attributes = $product->get_attributes();
                                            if ( ! empty( $attributes ) ) {
                                                foreach ( $attributes as $attribute_name => $attribute ) {
                                                    $attr_label = wc_attribute_label( $attribute_name, $product );
                                                    $attr_value = $product->get_attribute( $attribute_name );
                                                    if ( $attr_value ) {
                                                        echo '<div class="meta-item"><span class="meta-label">' . esc_html( $attr_label ) . ':</span> <span class="meta-value">' . esc_html( $attr_value ) . '</span></div>';
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </div>

                                </div>
                                <div class="item-price">
                                    <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
                                </div>
                            </div>
                        <?php
                            endif;
                        endforeach;
                        ?>
                    </div>

                    <?php if ( wc_coupons_enabled() ) : ?>
                        <div class="coupon-section">
                            <form class="checkout_coupon woocommerce-form-coupon" method="post" id="woocommerce-checkout-form-coupon">
                                <input type="text" name="coupon_code" class="input-text" id="coupon_code" placeholder="<?php esc_attr_e( 'Discount Code', 'woocommerce' ); ?>" value="">
                                <button type="submit" class="button coupon-button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
                                    <?php esc_html_e( 'Apply', 'woocommerce' ); ?>
                                </button>
                            </form>
                            <div class="clear"></div>
                        </div>
                    <?php endif; ?>


                    <div class="order-totals">
                        <div class="totals-wrapper">
                            <div class="cart-subtotal">
                                <span><?php _e('Subtotal (Incl.VAT)', 'woocommerce'); ?></span>
                                <span><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                            </div>
                            <div class="shipping">
                                <span><?php _e('Shipping Charge', 'woocommerce'); ?></span>
                                <span><?php echo WC()->cart->get_cart_shipping_total(); ?></span>
                            </div>
                            <div class="order-total">
                                <span><?php _e('Total', 'woocommerce'); ?></span>
                                <span><?php echo WC()->cart->get_total(); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>