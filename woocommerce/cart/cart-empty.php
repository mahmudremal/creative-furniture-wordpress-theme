<?php
defined( 'ABSPATH' ) || exit;

if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
	<div class="flex flex-col items-center justify-center text-center p-[80px_20px] bg-[#F9F9F9] rounded-[12px] my-[40px] mx-auto max-w-[600px] w-full">
		<div class="mb-[32px]">
			<svg width="120" height="120" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-[120px] h-[120px]">
				<path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7ZM9 3V4H15V3H9ZM7 6V19H17V6H7Z" fill="#9D8465"/>
				<path d="M9 8H11V17H9V8ZM13 8H15V17H13V8Z" fill="#9D8465"/>
			</svg>
		</div>
		<h2 class="text-[#242424] text-[30px] font-medium capitalize leading-[46px] mb-[16px]"> <?php esc_html_e('cart is empty', 'creative-furniture'); ?></h2>
		<p class="text-[#0A0909] text-[18px] font-normal leading-[28px] mb-[32px] max-w-[400px]"><?php esc_html_e("Looks like you haven't added anything to your cart yet. Start shopping to fill it up!", 'creative-furniture'); ?></p>
		<p class="mt-0">
			<a class="inline-block p-[14px_30px] bg-[rgba(17,17,17,0.80)] hover:bg-[rgba(17,17,17,1)] rounded-[90px] text-white text-[18px] font-medium capitalize transition-colors duration-300" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
				<?php
				echo esc_html( apply_filters( 'woocommerce_return_to_shop_text', __( 'Return to shop', 'woocommerce' ) ) );
				?>
			</a>
		</p>
	</div>
<?php endif; ?>
