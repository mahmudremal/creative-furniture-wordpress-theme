<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
do_action( 'woocommerce_before_account_navigation' );
?>
<nav class="bg-[#f6f6f6] flex items-center h-[42px] overflow-hidden w-full md:w-[1440px] m-auto relative" aria-label="<?php esc_html_e( 'Account pages', 'woocommerce' ); ?>">
	<div class="flex flex-wrap gap-7 items-center justify-start px-6">
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
            <?php if ($endpoint == 'customer-logout') : ?><div class="border-solid border-[#cacaca] border-t border-r-[0] border-b-[0] border-l-[0] shrink-0 w-5 h-0 relative rotate-90"></div><?php endif; ?>
			<div class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?> flex flex-row gap-2 items-center justify-start shrink-0 relative opacity-50">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="text-[#212121] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative flex items-center justify-start" <?php echo wc_is_current_account_menu_item( $endpoint ) ? 'aria-current="page"' : ''; ?>>
					<?php echo esc_html( $label ); ?>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
<style>
.woocommerce-MyAccount-navigation-link.is-active {
    opacity: 1 !important;
}
</style>