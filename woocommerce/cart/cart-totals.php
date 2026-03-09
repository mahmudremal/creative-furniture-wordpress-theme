<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?> bg-[#f4f4f4] rounded-lg p-6 flex flex-col gap-5 items-start justify-start self-stretch shrink-0 relative">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-[44px] font-semibold relative flex items-center justify-start">
        <?php esc_html_e( 'Order Summary', 'woocommerce' ); ?>
    </div>

	<div class="flex flex-col gap-3 items-start justify-start self-stretch shrink-0 relative">
		
        <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative border-b border-[#d9d9d9] pb-3 mb-3">
            <div class="text-[#373737] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative">
                <?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>
            </div>
            <div class="text-[#373737] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative">
                <?php wc_cart_totals_subtotal_html(); ?>
            </div>
        </div>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<div class="flex flex-row items-center justify-between self-stretch shrink-0 relative cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<div class="text-[#373737] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative"><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
				<div class="text-[#373737] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
			</div>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<div class="shipping-section border-b border-[#d9d9d9] pb-3 mb-3 w-full">
                <?php wc_cart_totals_shipping_html(); ?>
            </div>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

			<div class="shipping flex flex-row items-center justify-between self-stretch shrink-0 relative border-b border-[#d9d9d9] pb-3 mb-3">
				<div class="text-[#373737] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative"><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></div>
				<div class="text-[#373737] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative"><?php woocommerce_shipping_calculator(); ?></div>
			</div>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<div class="fee flex flex-row items-center justify-between self-stretch shrink-0 relative border-b border-[#d9d9d9] pb-3 mb-3">
				<div class="text-[#373737] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative"><?php echo esc_html( $fee->name ); ?></div>
				<div class="text-[#373737] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative"><?php wc_cart_totals_fee_html( $fee ); ?></div>
			</div>
		<?php endforeach; ?>

		<?php
		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) {
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = '';

			if ( WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping() ) {
				/* translators: %s location. */
				$estimated_text = sprintf( ' <small>' . esc_html__( '(estimated for %s)', 'woocommerce' ) . '</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] );
			}

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) {
				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					?>
					<div class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?> flex flex-row items-center justify-between self-stretch shrink-0 relative border-b border-[#d9d9d9] pb-3 mb-3">
						<div class="text-[#373737] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative"><?php echo esc_html( $tax->label ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
						<div class="text-[#373737] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative"><?php echo wp_kses_post( $tax->formatted_amount ); ?></div>
					</div>
					<?php
				}
			} else {
				?>
				<div class="tax-total flex flex-row items-center justify-between self-stretch shrink-0 relative border-b border-[#d9d9d9] pb-3 mb-3">
					<div class="text-[#373737] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
					<div class="text-[#373737] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative"><?php wc_cart_totals_taxes_total_html(); ?></div>
				</div>
				<?php
			}
		}
		?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<div class="order-total flex flex-row items-center justify-between self-stretch shrink-0 relative pt-3">
			<div class="text-[#373737] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold uppercase relative"><?php esc_html_e( 'Total', 'woocommerce' ); ?></div>
			<div class="text-[#373737] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold uppercase relative"><?php wc_cart_totals_order_total_html(); ?></div>
		</div>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</div>

	<div class="wc-proceed-to-checkout w-full mt-5">
		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
	</div>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
