<?php
/**
 * Template Name: Order Tracking
 */

get_header();

$order = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['billing_email'])) {
    $order_id = sanitize_text_field($_POST['order_id']);
    $billing_email = sanitize_email($_POST['billing_email']);
    
    $order = wc_get_order($order_id);
    
    if (!$order || $order->get_billing_email() !== $billing_email) {
        $error = __('Order not found. Please check your Order ID and Billing Email.', 'creative-furniture');
        $order = null;
    }
}

?>

<div class="order-tracking-page">
    <div class="container-fluid">
        <?php if (!$order): ?>
            <div class="tracking-form-wrapper">
                <p class="tracking-description">
                    <?php _e('To track your order please enter your Order ID in the box below and press the "', 'creative-furniture'); ?>
                    <strong><?php _e('Track', 'creative-furniture'); ?></strong>
                    <?php _e('" button. This was given to you on your receipt and in the confirmation email you should have received.', 'creative-furniture'); ?>
                </p>

                <?php if ($error): ?>
                    <div class="tracking-error"><?php echo esc_html($error); ?></div>
                <?php endif; ?>

                <form method="POST" action="" class="tracking-form">
                    <div class="form-group">
                        <label for="order_id"><?php _e('Order ID', 'creative-furniture'); ?></label>
                        <input 
                            type="text" 
                            id="order_id" 
                            name="order_id" 
                            placeholder="<?php esc_attr_e('Found in your order confirmation email.', 'creative-furniture'); ?>"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <label for="billing_email"><?php _e('Billing Email', 'creative-furniture'); ?></label>
                        <input 
                            type="email" 
                            id="billing_email" 
                            name="billing_email" 
                            placeholder="<?php esc_attr_e('Email you used during checkout', 'creative-furniture'); ?>"
                            required
                        />
                    </div>

                    <button type="submit" class="track-button">
                        <?php _e('Order Track', 'creative-furniture'); ?>
                    </button>
                </form>
            </div>
        <?php else: ?>
            <div class="tracking-result">
                <h1 class="order-title">
                    <?php printf(__('Order ID: %s', 'creative-furniture'), esc_html($order->get_order_number())); ?>
                </h1>

                <div class="result-grid">
                    <div class="result-left">
                        <div class="order-items">
                            <h2><?php _e('Order Items', 'creative-furniture'); ?></h2>
                            <?php foreach ($order->get_items() as $item): 
                                $product = $item->get_product();
                                $quantity = $item->get_quantity();
                            ?>
                                <div class="order-item">
                                    <div class="item-image">
                                        <?php if ($product && $product->get_image_id()): ?>
                                            <?php echo wp_get_attachment_image($product->get_image_id(), 'thumbnail'); ?>
                                        <?php else: ?>
                                            <div class="placeholder-image"></div>
                                        <?php endif; ?>
                                        <?php if ($quantity > 1): ?>
                                            <span class="item-quantity"><?php echo esc_html($quantity); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="item-details">
                                        <h3><?php echo esc_html($item->get_name()); ?></h3>
                                        <?php
                                        $meta_data = $item->get_meta_data();
                                        foreach ($meta_data as $meta):
                                            if (in_array($meta->key, ['_qty', '_line_subtotal', '_line_total'])) continue;
                                        ?>
                                            <p class="item-meta">
                                                <?php echo esc_html($meta->key); ?>: <?php echo esc_html($meta->value); ?>
                                            </p>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="item-price">
                                        <?php echo $order->get_formatted_line_subtotal($item); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="order-overview">
                            <h2><?php _e('Overview', 'creative-furniture'); ?></h2>
                            <div class="overview-row">
                                <span><?php _e('Order ID', 'creative-furniture'); ?></span>
                                <span><?php echo esc_html($order->get_id()); ?></span>
                            </div>
                            <div class="overview-row">
                                <span><?php _e('Date', 'creative-furniture'); ?></span>
                                <span><?php echo esc_html($order->get_date_created()->format('M d, Y')); ?></span>
                            </div>
                            <div class="overview-row">
                                <span><?php _e('Est Delivery', 'creative-furniture'); ?></span>
                                <span>
                                    <?php
                                    $estimated_delivery = get_post_meta($order->get_id(), '_estimated_delivery', true);
                                    echo $estimated_delivery ? esc_html($estimated_delivery) : '-';
                                    ?>
                                </span>
                            </div>
                            <div class="overview-row">
                                <span><?php _e('Address', 'creative-furniture'); ?></span>
                                <span>
                                    <?php echo esc_html($order->get_shipping_address_1()); ?><br/>
                                    <?php echo esc_html($order->get_shipping_city() . ', ' . $order->get_shipping_state() . ', ' . $order->get_shipping_postcode()); ?>
                                </span>
                            </div>
                            <div class="overview-row">
                                <span><?php _e('Email', 'creative-furniture'); ?></span>
                                <span><?php echo esc_html($order->get_billing_email()); ?></span>
                            </div>
                            <div class="overview-row">
                                <span><?php _e('Phone', 'creative-furniture'); ?></span>
                                <span><?php echo esc_html($order->get_billing_phone()); ?></span>
                            </div>
                        </div>

                        <div class="order-summary">
                            <h2><?php _e('Order Summary', 'creative-furniture'); ?></h2>
                            <div class="summary-row">
                                <span><?php _e('Subtotal (Incl.Vat)', 'creative-furniture'); ?></span>
                                <span><?php echo $order->get_formatted_order_total(); ?></span>
                            </div>
                            <div class="summary-row">
                                <span><?php _e('Shipping Charge', 'creative-furniture'); ?></span>
                                <span>
                                    <?php 
                                    echo $order->get_shipping_total() > 0 
                                        ? wc_price($order->get_shipping_total()) 
                                        : __('Free Shipping', 'creative-furniture'); 
                                    ?>
                                </span>
                            </div>
                            <div class="summary-row">
                                <span><?php _e('Payment Method', 'creative-furniture'); ?></span>
                                <span><?php echo esc_html($order->get_payment_method_title()); ?></span>
                            </div>
                            <div class="summary-row total">
                                <span><?php _e('Total', 'creative-furniture'); ?></span>
                                <span><?php echo $order->get_formatted_order_total(); ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="result-right">
                        <div class="tracking-status">
                            <h2><?php _e('Tracking Status', 'creative-furniture'); ?></h2>
                            <div class="status-timeline">
                                <?php
                                $current_status = $order->get_status();
                                $statuses = [
                                    'pending' => __('Order confirmed', 'creative-furniture'),
                                    'processing' => __('Preparing for Shipment', 'creative-furniture'),
                                    'shipped' => __('Shipped', 'creative-furniture'),
                                    'out-for-delivery' => __('Out for Delivery', 'creative-furniture'),
                                    'completed' => __('Delivery', 'creative-furniture'),
                                ];

                                $status_order = ['pending', 'processing', 'shipped', 'out-for-delivery', 'completed'];
                                $current_index = array_search($current_status, $status_order);
                                if ($current_index === false) $current_index = 0;

                                foreach ($statuses as $status_key => $status_label):
                                    $status_index = array_search($status_key, $status_order);
                                    $is_active = $status_index <= $current_index;
                                    $is_current = $status_key === $current_status;
                                ?>
                                    <div class="status-item <?php echo $is_active ? 'active' : ''; ?> <?php echo $is_current ? 'current' : ''; ?>">
                                        <div class="status-indicator">
                                            <?php if ($is_active): ?>
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20 6L9 17L4 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            <?php endif; ?>
                                        </div>
                                        <div class="status-content">
                                            <?php if ($is_current && $status_key === 'pending'): ?>
                                                <div class="status-time">
                                                    <?php echo esc_html($order->get_date_created()->format('M d, Y')); ?>
                                                    <span><?php echo esc_html($order->get_date_created()->format('g:i A')); ?></span>
                                                </div>
                                            <?php endif; ?>
                                            <div class="status-label"><?php echo esc_html($status_label); ?></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();