<?php
/**
 * Success messages
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

if (!$notices) {
	return;
}
?>

<div class="woocommerce-notices-wrapper px-4 md:px-6 my-6 w-full max-w-full md:w-[1440px] mx-auto relative">
	<?php foreach ( $notices as $notice ) : ?>
		<div class="flex items-center gap-4 p-4 mb-4 text-[#0f834d] border border-[#0f834d]/20 -rounded-lg bg-[#0f834d]/5" <?php echo wc_get_notice_data_attr( $notice ); ?> role="alert">
			<svg class="flex-shrink-0 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
			</svg>
			<div class="text-sm font-medium flex-1">
				<?php echo wc_kses_notice( $notice['notice'] ); ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
