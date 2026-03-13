<?php
/**
 * Show error messages
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $notices ) {
	return;
}

?>


<div class="woocommerce-notices-wrapper px-4 md:px-6 my-6 w-full max-w-full md:w-[1440px] mx-auto relative">
	<?php foreach ( $notices as $notice ) : ?>
		<div class="flex items-center gap-4 p-4 mb-4 text-[#ff0000] border border-[#ff0000]/20 rounded-lg bg-[#ff0000]/5" <?php echo wc_get_notice_data_attr( $notice ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> role="alert">
			<svg class="flex-shrink-0 w-5 h-5" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
			</svg>
			<div class="text-sm font-medium flex-1">
				<?php echo wc_kses_notice( $notice['notice'] ); ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
