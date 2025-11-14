<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// $order = wc_get_order( $order_id );
if ( ! $order ) {
    return;
}
?>
<div class="order-confirmation container-fluid">
    <div class="confirmation-header">
        <div class="confirmation-icon">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M26.6668 8L12.0002 22.6667L5.3335 16" stroke="white" stroke-width="2.66667" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="confirmation-text">
            <h1><?php esc_html_e( 'Your order is Confirmed!', 'woocommerce' ); ?></h1>
            <p><?php printf( esc_html__( 'Order Id #%s', 'woocommerce' ), $order->get_order_number() ); ?></p>
            <p><?php printf( esc_html__( 'Thank you for %s', 'woocommerce' ), $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() ); ?></p>
        </div>
    </div>
    <div class="order-details">
        <div class="order-items">
            <h2><?php esc_html_e( 'Order Items', 'woocommerce' ); ?></h2>
            <?php foreach ( $order->get_items() as $item_id => $item ) : ?>
                <?php $product = $item->get_product(); ?>
                <div class="order-item">
                    <div class="item-image">
                        <?php echo $product->get_image( 'thumbnail' ); ?>
                    </div>
                    <div class="item-details">
                        <h3><?php echo $item->get_name(); ?></h3>
                        <div class="item-specs">
                            <?php
                            $meta_data = $item->get_formatted_meta_data( '_', true );
                            if ( ! empty( $meta_data ) ) {
                                foreach ( $meta_data as $meta ) {
                                    echo '<div><span>' . esc_html( $meta->display_key ) . ':</span> <span>' . wp_kses_post( $meta->display_value ) . '</span></div>';
                                }
                            }
                            ?>
                        </div>


                        
                    </div>
                    <div class="item-price"><?php echo $order->get_formatted_line_subtotal( $item ); ?></div>
                    <div class="item-quantity"><?php echo $item->get_quantity(); ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="order-overview">
            <div class="overview-section">
                <h2><?php esc_html_e( 'Overview', 'woocommerce' ); ?></h2>
                <div class="overview-grid">
                    <div class="overview-item">
                        <label><?php esc_html_e( 'Order ID', 'woocommerce' ); ?></label>
                        <span><?php echo $order->get_order_number(); ?></span>
                    </div>
                    <div class="overview-item">
                        <label><?php esc_html_e( 'Date', 'woocommerce' ); ?></label>
                        <span><?php echo wc_format_datetime( $order->get_date_created() ); ?></span>
                    </div>
                    <div class="overview-item">
                        <label><?php esc_html_e( 'Est Delivery', 'woocommerce' ); ?></label>
                        <span><?php echo esc_html( get_post_meta( $order->get_id(), '_estimated_delivery', true ) ?: 'TBD' ); ?></span>
                    </div>
                    <div class="overview-item">
                        <label><?php esc_html_e( 'Address', 'woocommerce' ); ?></label>
                        <span><?php echo $order->get_formatted_billing_address(); ?></span>
                    </div>
                    <div class="overview-item">
                        <label><?php esc_html_e( 'Email', 'woocommerce' ); ?></label>
                        <span><?php echo $order->get_billing_email(); ?></span>
                    </div>
                    <div class="overview-item">
                        <label><?php esc_html_e( 'Phone', 'woocommerce' ); ?></label>
                        <span><?php echo $order->get_billing_phone(); ?></span>
                    </div>
                </div>
            </div>
            <div class="order-summary">
                <h2><?php esc_html_e( 'Order Summary', 'woocommerce' ); ?></h2>
                <div class="summary-items">
                    <div class="summary-item">
                        <span><?php esc_html_e( 'Subtotal (Incl.Vat)', 'woocommerce' ); ?></span>
                        <span><?php echo $order->get_subtotal_to_display(); ?></span>
                    </div>
                    <div class="summary-item">
                        <span><?php esc_html_e( 'Shipping Charge', 'woocommerce' ); ?></span>
                        <span><?php echo $order->get_shipping_to_display(); ?></span>
                    </div>
                    <div class="summary-item">
                        <span><?php esc_html_e( 'Payment method', 'woocommerce' ); ?></span>
                        <span><?php echo $order->get_payment_method_title(); ?></span>
                    </div>
                    <div class="summary-item total">
                        <span><?php esc_html_e( 'Total', 'woocommerce' ); ?></span>
                        <span><?php echo $order->get_formatted_order_total(); ?></span>
                    </div>
                </div>
            </div>
            <div class="action-buttons">
                <button class="btn-outline" onclick="window.print()"><?php esc_html_e( 'Download Invoice', 'woocommerce' ); ?></button>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="btn-primary"><?php esc_html_e( 'Continue Shopping', 'woocommerce' ); ?></a>
            </div>
        </div>
    </div>
</div>