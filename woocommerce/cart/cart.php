<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_cart');
?>

<div class="custom-cart-wrapper">
    <div class="custom-cart-container">
        <div class="cart-items-section">
            <h1 class="cart-title">
                <?php esc_html_e('Your cart', 'woocommerce'); ?> 
                (<?php echo WC()->cart->get_cart_contents_count(); ?>)
            </h1>

            <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
                <?php do_action('woocommerce_before_cart_table'); ?>

                <div class="cart-items-list">
                    <?php
                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                            ?>
                            <div class="cart-item">
                                <div class="cart-item-image">
                                    <?php
                                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                                    if (!$product_permalink) {
                                        echo $thumbnail;
                                    } else {
                                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
                                    }
                                    ?>
                                </div>

                                <div class="cart-item-details">
                                    <div class="cart-item-header">
                                        <div class="cart-item-info">
                                            <h3 class="cart-item-title">
                                                <?php
                                                if (!$product_permalink) {
                                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                                } else {
                                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                                                }
                                                ?>
                                            </h3>
                                        </div>
                                        <div class="cart-item-price">
                                            <?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); ?>
                                        </div>
                                    </div>

                                    <div class="cart-item-meta">
                                        <?php
                                        $size = $_product->get_attribute('pa_size') ?: $_product->get_attribute('size');
                                        $material = $_product->get_attribute('pa_material') ?: $_product->get_attribute('material');
                                        
                                        if ($size) {
                                            echo '<div class="meta-item"><span class="meta-label">Size:</span> <span class="meta-value">' . esc_html($size) . '</span></div>';
                                        }
                                        if ($material) {
                                            echo '<div class="meta-item"><span class="meta-label">Material:</span> <span class="meta-value">' . esc_html($material) . '</span></div>';
                                        }
                                        ?>
                                    </div>

                                    <div class="cart-item-actions">
                                        <div class="quantity-wrapper">
                                            <button type="button" class="qty-btn minus">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15 10.625H5C4.65833 10.625 4.375 10.3417 4.375 10C4.375 9.65833 4.65833 9.375 5 9.375H15C15.3417 9.375 15.625 9.65833 15.625 10C15.625 10.3417 15.3417 10.625 15 10.625Z" fill="#292D32"/>
                                                </svg>
                                            </button>
                                            <?php
                                            if ($_product->is_sold_individually()) {
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

                                            echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
                                            ?>
                                            <button type="button" class="qty-btn plus">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M15 10.625H5C4.65833 10.625 4.375 10.3417 4.375 10C4.375 9.65833 4.65833 9.375 5 9.375H15C15.3417 9.375 15.625 9.65833 15.625 10C15.625 10.3417 15.3417 10.625 15 10.625Z" fill="#292D32"/>
                                                    <path d="M10 15.625C9.65833 15.625 9.375 15.3417 9.375 15V5C9.375 4.65833 9.65833 4.375 10 4.375C10.3417 4.375 10.625 4.65833 10.625 5V15C10.625 15.3417 10.3417 15.625 10 15.625Z" fill="#292D32"/>
                                                </svg>

                                            </button>
                                        </div>

                                        <div class="remove-wrapper">
                                            <?php
                                            echo apply_filters(
                                                'woocommerce_cart_item_remove_link',
                                                sprintf(
                                                    '<a href="%s" class="remove-item" aria-label="%s" data-product_id="%s" data-product_sku="%s">%s %s</a>',
                                                    esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                    esc_html__('Remove this item', 'woocommerce'),
                                                    esc_attr($product_id),
                                                    esc_attr($_product->get_sku()),
                                                    '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10.4998 3.36523C10.4898 3.36523 10.4748 3.36523 10.4598 3.36523C7.81484 3.10023 5.17484 3.00023 2.55984 3.26523L1.53984 3.36523C1.32984 3.38523 1.14484 3.23523 1.12484 3.02523C1.10484 2.81523 1.25484 2.63523 1.45984 2.61523L2.47984 2.51523C5.13984 2.24523 7.83484 2.35023 10.5348 2.61523C10.7398 2.63523 10.8898 2.82023 10.8698 3.02523C10.8548 3.22023 10.6898 3.36523 10.4998 3.36523Z" fill="black" fill-opacity="0.6"/>
                                                        <path d="M4.24988 2.86C4.22988 2.86 4.20988 2.86 4.18488 2.855C3.98488 2.82 3.84488 2.625 3.87988 2.425L3.98988 1.77C4.06988 1.29 4.17988 0.625 5.34488 0.625H6.65488C7.82488 0.625 7.93488 1.315 8.00988 1.775L8.11988 2.425C8.15488 2.63 8.01488 2.825 7.81488 2.855C7.60988 2.89 7.41488 2.75 7.38488 2.55L7.27488 1.9C7.20488 1.465 7.18988 1.38 6.65988 1.38H5.34988C4.81988 1.38 4.80988 1.45 4.73488 1.895L4.61988 2.545C4.58988 2.73 4.42988 2.86 4.24988 2.86Z" fill="black" fill-opacity="0.6"/>
                                                        <path d="M7.60519 11.3758H4.39519C2.65019 11.3758 2.58019 10.4108 2.52519 9.63077L2.20019 4.59577C2.18519 4.39077 2.34519 4.21077 2.55019 4.19577C2.76019 4.18577 2.93519 4.34077 2.95019 4.54577L3.27519 9.58077C3.33019 10.3408 3.35019 10.6258 4.39519 10.6258H7.60519C8.65519 10.6258 8.67519 10.3408 8.72519 9.58077L9.05019 4.54577C9.06519 4.34077 9.24519 4.18577 9.45019 4.19577C9.65519 4.21077 9.81519 4.38577 9.80019 4.59577L9.47519 9.63077C9.42019 10.4108 9.35019 11.3758 7.60519 11.3758Z" fill="black" fill-opacity="0.6"/>
                                                        <path d="M6.83004 8.625H5.16504C4.96004 8.625 4.79004 8.455 4.79004 8.25C4.79004 8.045 4.96004 7.875 5.16504 7.875H6.83004C7.03504 7.875 7.20504 8.045 7.20504 8.25C7.20504 8.455 7.03504 8.625 6.83004 8.625Z" fill="black" fill-opacity="0.6"/>
                                                        <path d="M7.25 6.625H4.75C4.545 6.625 4.375 6.455 4.375 6.25C4.375 6.045 4.545 5.875 4.75 5.875H7.25C7.455 5.875 7.625 6.045 7.625 6.25C7.625 6.455 7.455 6.625 7.25 6.625Z" fill="black" fill-opacity="0.6"/>
                                                    </svg>',
                                                    esc_html__('Remove', 'woocommerce')
                                                ),
                                                $cart_item_key
                                            );
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <?php do_action('woocommerce_cart_contents'); ?>

                <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>" style="display:none;">
                    <?php esc_html_e('Update cart', 'woocommerce'); ?>
                </button>

                <?php do_action('woocommerce_cart_actions'); ?>
                <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
            </form>

            <?php do_action('woocommerce_after_cart_table'); ?>
        </div>

        <div class="cart-summary-section">
            <div class="payment-info-banner">
                <div class="payment-text">
                    <span class="text-light">As low as</span>
                    <span class="text-bold">284.22/month</span>
                    <span class="text-light">or 4 interest-free payments.</span>
                    <span class="text-bold">Learn More</span>
                </div>
                <div>
                    <div class="payment-logo">
                        <svg width="53" height="16" viewBox="0 0 53 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M46.5788 3.07157L43.3517 15.3967V15.4356H45.879L49.106 3.11045H46.5788V3.07157ZM6.68735 10.0701C6.29855 10.2645 5.90974 10.3422 5.48206 10.3422C4.5878 10.3422 4.08236 10.1867 4.0046 9.44798V9.4091C4.0046 9.37022 4.0046 9.37022 4.0046 9.33134V7.1929V6.95962V5.44328V4.82119V4.58791V3.14933L1.74952 3.42149C3.26586 3.11045 4.12124 1.94403 4.12124 0.738731V0H1.594V3.46037L1.43848 3.49925V9.87566C1.51624 11.6642 2.72154 12.7528 4.62668 12.7528C5.32653 12.7528 6.06526 12.5973 6.64847 12.3251L6.68735 10.0701Z" fill="#292929"/>
                            <path d="M7.07626 2.60468L0 3.69334V5.48185L7.07626 4.39319V2.60468ZM7.07626 5.24856L0 6.33722V8.04796L7.07626 6.95931V5.24856ZM15.0079 6.06505C14.8913 4.08215 13.6471 2.87685 11.6253 2.87685C10.4589 2.87685 9.48686 3.34341 8.82589 4.19879C8.16492 5.05416 7.81499 6.29834 7.81499 7.81468C7.81499 9.33102 8.16492 10.5752 8.82589 11.4306C9.48686 12.2859 10.4589 12.7136 11.6253 12.7136C13.6471 12.7136 14.8913 11.5472 15.0079 9.52542V12.5192H17.5351V3.11013L15.0079 3.49893V6.06505ZM15.1634 7.81468C15.1634 9.56431 14.2303 10.7307 12.7917 10.7307C11.3142 10.7307 10.42 9.64207 10.42 7.81468C10.42 5.98729 11.3142 4.89864 12.7917 4.89864C13.4916 4.89864 14.1136 5.1708 14.5413 5.71513C14.9301 6.22058 15.1634 6.95931 15.1634 7.81468ZM24.8836 2.87685C22.8618 2.87685 21.6176 4.04326 21.501 6.06505V0.349609L18.9737 0.738415V12.5192H21.501V9.52542C21.6176 11.5472 22.8618 12.7136 24.8836 12.7136C27.2553 12.7136 28.6939 10.8862 28.6939 7.81468C28.6939 4.74311 27.2553 2.87685 24.8836 2.87685ZM23.756 10.7307C22.3174 10.7307 21.3843 9.60319 21.3843 7.81468C21.3843 6.95931 21.6176 6.22058 22.0064 5.71513C22.4341 5.1708 23.0173 4.89864 23.756 4.89864C25.2335 4.89864 26.1277 5.98729 26.1277 7.81468C26.1277 9.64207 25.2335 10.7307 23.756 10.7307ZM35.5368 2.87685C33.515 2.87685 32.2709 4.04326 32.1542 6.06505V0.349609L29.627 0.738415V12.5192H32.1542V9.52542C32.2709 11.5472 33.515 12.7136 35.5368 12.7136C37.9086 12.7136 39.3471 10.8862 39.3471 7.81468C39.3471 4.74311 37.9086 2.87685 35.5368 2.87685ZM34.4093 10.7307C32.9707 10.7307 32.0376 9.60319 32.0376 7.81468C32.0376 6.95931 32.2709 6.22058 32.6597 5.71513C33.0874 5.1708 33.6706 4.89864 34.4093 4.89864C35.8868 4.89864 36.781 5.98729 36.781 7.81468C36.781 9.64207 35.8868 10.7307 34.4093 10.7307ZM39.3471 3.07125H42.0299L44.2072 12.5192H41.7966L39.3471 3.07125ZM51.1668 4.04326V3.30453H50.8558V3.14901H51.6723V3.30453H51.3612V4.04326H51.1668ZM51.7112 4.04326V3.11013H52.0222L52.1777 3.53782C52.2166 3.65446 52.2555 3.69334 52.2555 3.73222C52.2555 3.69334 52.2944 3.65446 52.3332 3.53782L52.4888 3.11013H52.7998V4.04326H52.6054V3.30453L52.3332 4.04326H52.1388L51.9056 3.30453V4.04326H51.7112Z" fill="#292929"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="order-summary">
                <div class="summary-header">
                    <h2>Order Summary</h2>
                </div>

                <div class="summary-content">
                    <div class="summary-row">
                        <span class="summary-label">Subtotal (Incl.Vat)</span>
                        <span class="summary-value"><?php wc_cart_totals_subtotal_html(); ?></span>
                    </div>

                    <div class="summary-row">
                        <span class="summary-label">VAT Amount</span>
                        <span class="summary-value">
                            <?php
                            $tax_total = WC()->cart->get_cart_contents_tax() + WC()->cart->get_shipping_tax();
                            echo wc_price($tax_total);
                            ?>
                        </span>
                    </div>

                    <div class="summary-row total-row">
                        <span class="summary-label">Total</span>
                        <span class="summary-value"><?php wc_cart_totals_order_total_html(); ?></span>
                    </div>
                </div>

                <div class="checkout-button-wrapper">
                    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="checkout-button">
                        Secure Checkout
                    </a>
                </div>

                <div class="terms-text">
                    By continuing to Checkout, you are agreeing to our 
                    <a href="<?php echo esc_url(get_permalink(wc_terms_and_conditions_page_id())); ?>">Terms of Use</a> 
                    and 
                    <a href="<?php echo esc_url(wc_get_page_permalink('privacy_policy')); ?>">Privacy Policy.</a>
                </div>
            </div>

            <div class="payment-methods">
                <img src="<?php echo get_template_directory_uri(); ?>/dist/images/payment-methods.png" alt="Payment Methods">
            </div>
        </div>
    </div>
</div>

<?php do_action('woocommerce_after_cart'); ?>


