<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
do_action( 'woocommerce_before_account_navigation' );
?>
<nav class="bg-[#f6f6f6] flex items-center h-[42px] overflow-hidden w-full max-w-full md:w-[1440px] m-auto relative" aria-label="<?php esc_html_e( 'Account pages', 'woocommerce' ); ?>">
	<div class="flex flex-row gap-7 items-center justify-start px-6 overflow-x-auto">
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<?php if (in_array($endpoint, ['edit-account'])) continue; ?>
            <?php if ($endpoint == 'customer-logout') : ?><div class="border-solid border-[#cacaca] border-t border-r-[0] border-b-[0] border-l-[0] shrink-0 w-5 h-0 relative rotate-90"></div><?php endif; ?>
			<div class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?> flex flex-row gap-2 items-center justify-start shrink-0 relative opacity-50">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" class="text-[#212121] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative flex items-center justify-center gap-2" <?php echo wc_is_current_account_menu_item( $endpoint ) ? 'aria-current="page"' : ''; ?>>
					<?php
					switch ($endpoint) {
						case 'dashboard':
							?>
							<svg class="shrink-0 w-5 h-5 relative overflow-visible" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M16.6666 17.5C16.6666 16.337 16.6666 15.7555 16.5231 15.2824C16.1999 14.217 15.3662 13.3834 14.3009 13.0602C13.8277 12.9167 13.2462 12.9167 12.0832 12.9167H7.91659C6.75362 12.9167 6.17213 12.9167 5.69897 13.0602C4.63363 13.3834 3.79995 14.217 3.47678 15.2824C3.33325 15.7555 3.33325 16.337 3.33325 17.5M13.7499 6.25C13.7499 8.32107 12.071 10 9.99992 10C7.92885 10 6.24992 8.32107 6.24992 6.25C6.24992 4.17893 7.92885 2.5 9.99992 2.5C12.071 2.5 13.7499 4.17893 13.7499 6.25Z" stroke="#565656" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
							<?php
							break;
						case 'orders':
							?>
							<svg class="shrink-0 w-5 h-5 relative overflow-visible" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6.25 6.39192V5.58358C6.25 3.70858 7.75833 1.86692 9.63333 1.69192C11.8667 1.47525 13.75 3.23358 13.75 5.42525V6.57525" stroke="#717171" stroke-width="1.66667" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M7.5001 18.3327H12.5001C15.8501 18.3327 16.4501 16.991 16.6251 15.3577L17.2501 10.3577C17.4751 8.32435 16.8918 6.66602 13.3334 6.66602H6.66677C3.10843 6.66602 2.5251 8.32435 2.7501 10.3577L3.3751 15.3577C3.5501 16.991 4.1501 18.3327 7.5001 18.3327Z" stroke="#717171" stroke-width="1.66667" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M12.9128 10.0007H12.9203" stroke="#717171" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M7.07884 10.0007H7.08632" stroke="#717171" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
							<?php
							break;
						case 'downloads':
							?>
							<svg class="shrink-0 w-5 h-5 relative overflow-visible" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M17.5 17.5H2.5M15 9.16667L10 14.1667M10 14.1667L5 9.16667M10 14.1667V2.5" stroke="#565656" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
							<?php
							break;
						case 'edit-address':
							?>
							<svg class="shrink-0 w-5 h-5 relative overflow-visible" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9.99992 10.8327C11.3806 10.8327 12.4999 9.71339 12.4999 8.33268C12.4999 6.95197 11.3806 5.83268 9.99992 5.83268C8.61921 5.83268 7.49992 6.95197 7.49992 8.33268C7.49992 9.71339 8.61921 10.8327 9.99992 10.8327Z" stroke="#565656" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
								<path d="M9.99992 18.3327C13.3333 14.9993 16.6666 12.0146 16.6666 8.33268C16.6666 4.65078 13.6818 1.66602 9.99992 1.66602C6.31802 1.66602 3.33325 4.65078 3.33325 8.33268C3.33325 12.0146 6.66659 14.9993 9.99992 18.3327Z" stroke="#565656" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
							<?php
							break;
						case 'customer-logout':
							?>
							<svg class="shrink-0 w-5 h-5 relative overflow-visible" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M13.3333 14.1667L17.5 10M17.5 10L13.3333 5.83333M17.5 10H7.5M7.5 2.5H6.5C5.09987 2.5 4.3998 2.5 3.86502 2.77248C3.39462 3.01217 3.01217 3.39462 2.77248 3.86502C2.5 4.3998 2.5 5.09987 2.5 6.5V13.5C2.5 14.9001 2.5 15.6002 2.77248 16.135C3.01217 16.6054 3.39462 16.9878 3.86502 17.2275C4.3998 17.5 5.09987 17.5 6.5 17.5H7.5" stroke="#565656" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
							<?php
							break;
						case 'seller-dashboard':
							?>
							<svg class="shrink-0 w-5 h-5 relative overflow-visible" width="20" height="20" fill="#717171" viewBox="0 0 32 32" id="icon" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:none;}</style></defs><title>shop</title><path d="M30,10.68l-2-6A1,1,0,0,0,27,4H5a1,1,0,0,0-1,.68l-2,6A1.19,1.19,0,0,0,2,11v6a1,1,0,0,0,1,1H4V28H6V18h6V28H28V18h1a1,1,0,0,0,1-1V11A1.19,1.19,0,0,0,30,10.68ZM26,26H14V18H26Zm2-10H24V12H22v4H17V12H15v4H10V12H8v4H4V11.16L5.72,6H26.28L28,11.16Z" transform="translate(0)"/><rect id="_Transparent_Rectangle_" data-name="&lt;Transparent Rectangle&gt;" class="cls-1" width="32" height="32"/></svg>
							<?php
							break;
						case 'my-products':
							?>
							<svg class="shrink-0 w-5 h-5 relative overflow-visible" width="20" height="20" viewBox="0 0 24 24" id="meteor-icon-kit__solid-inventory" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_525_127)">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M1 0C1.55228 0 2 0.447715 2 1V8H5C4.44772 8 4 7.55228 4 7V5C4 4.44772 4.44772 4 5 4H9C9.55228 4 10 4.44772 10 5V7C10 7.55228 9.55228 8 9 8H13C12.4477 8 12 7.55228 12 7V3C12 2.44772 12.4477 2 13 2H19C19.5523 2 20 2.44772 20 3V7C20 7.55228 19.5523 8 19 8H22V1C22 0.447715 22.4477 0 23 0C23.5523 0 24 0.447715 24 1V23C24 23.5523 23.5523 24 23 24C22.4477 24 22 23.5523 22 23V22H2V23C2 23.5523 1.55228 24 1 24C0.447715 24 0 23.5523 0 23V1C0 0.447715 0.447715 0 1 0ZM22 20H19C19.5523 20 20 19.5523 20 19V15C20 14.4477 19.5523 14 19 14H14C13.4477 14 13 14.4477 13 15V19C13 19.5523 13.4477 20 14 20H10C10.5523 20 11 19.5523 11 19V13C11 12.4477 10.5523 12 10 12H5C4.44772 12 4 12.4477 4 13V19C4 19.5523 4.44772 20 5 20H2V10H22V20Z" fill="#717171"/>
								</g>
								<defs>
									<clipPath id="clip0_525_127">
										<rect width="24" height="24" fill="white"/>
									</clipPath>
								</defs>
							</svg>
							<?php
							break;
						default:
							# code...
							break;
					}
					?>
					<span><?php echo esc_html( $label ); ?></span>
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