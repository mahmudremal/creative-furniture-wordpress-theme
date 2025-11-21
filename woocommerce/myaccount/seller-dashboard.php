<?php
$user_id = get_current_user_id();
$recent_orders = get_seller_recent_orders($user_id, 10);
$products = get_seller_products($user_id);
$total_products = count($products);
$total_sales = 0;
$total_revenue = 0;

foreach($recent_orders as $order_data) {
    $order = $order_data['order'];
    $item = $order_data['item'];
    $total_sales += $item->get_quantity();
    $total_revenue += $item->get_total();
}
?>

<div class="seller-dashboard">
    <div class="seller-dashboard__header">
        <h2><?php _e('Seller Dashboard', 'textdomain'); ?></h2>
    </div>

    <div class="seller-dashboard__stats">
        <div class="stat-card">
            <div class="stat-card__icon">
                <svg>package</svg>
            </div>
            <div class="stat-card__content">
                <span class="stat-card__value"><?php echo $total_products; ?></span>
                <span class="stat-card__label"><?php _e('Total Products', 'textdomain'); ?></span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card__icon">
                <svg>shopping-cart</svg>
            </div>
            <div class="stat-card__content">
                <span class="stat-card__value"><?php echo $total_sales; ?></span>
                <span class="stat-card__label"><?php _e('Total Sales', 'textdomain'); ?></span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-card__icon">
                <svg>dollar-sign</svg>
            </div>
            <div class="stat-card__content">
                <span class="stat-card__value"><?php echo wc_price($total_revenue); ?></span>
                <span class="stat-card__label"><?php _e('Total Revenue', 'textdomain'); ?></span>
            </div>
        </div>
    </div>

    <div class="seller-dashboard__actions">
        <a href="<?php echo esc_url(wc_get_account_endpoint_url('my-products')); ?>" class="btn btn-primary">
            <svg>list</svg>
            <?php _e('My Products', 'textdomain'); ?>
        </a>
    </div>

    <div class="seller-dashboard__orders">
        <h3><?php _e('Recent Orders', 'textdomain'); ?></h3>
        
        <?php if(!empty($recent_orders)): ?>
        <div class="orders-table">
            <table>
                <thead>
                    <tr>
                        <th><?php _e('Order', 'textdomain'); ?></th>
                        <th><?php _e('Product', 'textdomain'); ?></th>
                        <th><?php _e('Quantity', 'textdomain'); ?></th>
                        <th><?php _e('Total', 'textdomain'); ?></th>
                        <th><?php _e('Status', 'textdomain'); ?></th>
                        <th><?php _e('Date', 'textdomain'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($recent_orders as $order_data): 
                        $order = $order_data['order'];
                        $item = $order_data['item'];
                        $product = $order_data['product'];
                    ?>
                    <tr>
                        <td>
                            <a href="<?php echo esc_url($order->get_view_order_url()); ?>">
                                #<?php echo $order->get_order_number(); ?>
                            </a>
                        </td>
                        <td><?php echo esc_html($product->get_name()); ?></td>
                        <td><?php echo $item->get_quantity(); ?></td>
                        <td><?php echo wc_price($item->get_total()); ?></td>
                        <td>
                            <span class="order-status status-<?php echo esc_attr($order->get_status()); ?>">
                                <?php echo esc_html(wc_get_order_status_name($order->get_status())); ?>
                            </span>
                        </td>
                        <td><?php echo $order->get_date_created()->date_i18n('M d, Y'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <p class="no-orders"><?php _e('No orders found.', 'textdomain'); ?></p>
        <?php endif; ?>
    </div>
</div>