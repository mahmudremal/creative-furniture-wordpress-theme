<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.3
 */

defined( 'ABSPATH' ) || exit;

if ( ! wp_doing_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}
?>
<div id="payment" class="woocommerce-checkout-payment w-full">
	<?php if ( WC()->cart->needs_payment() ) : ?>
		<div class="wc_payment_methods payment_methods methods flex flex-col gap-0 items-start justify-start self-stretch shrink-0 relative">
			<?php
			if ( ! empty( $available_gateways ) ) {
				foreach ( $available_gateways as $gateway ) {
					wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
				}
			} else {
				echo '<div class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</div>'; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
			}
			?>
		</div>
	<?php endif; ?>

	<div class="form-row place-order mt-6">
		<noscript>
			<?php
			/* translators: $1 and $2: opening and closing emphasis tags respectively */
			printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
			?>
			<br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
		</noscript>

		<?php // wc_get_template( 'checkout/terms.php' ); ?>

		<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

		<!-- <button type="submit" class="bg-[#000000] -rounded-lg pt-3 pr-5 pb-3 pl-5 flex flex-row gap-2.5 items-center justify-center w-full relative mb-4" name="woocommerce_checkout_place_order" id="place_order" value="<?php echo esc_attr( $order_button_text ); ?>" data-value="<?php echo esc_attr( $order_button_text ); ?>">
            <span class="text-[#ffffff] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start"><?php echo esc_html( $order_button_text ); ?></span>
        </button> -->

		<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
	</div>
</div>

<?php
if ( ! wp_doing_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}