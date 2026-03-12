<?php
defined( 'ABSPATH' ) || exit;

global $product;

if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}

$product_id = $product->get_id();
$sale_percentage = 0;

if ( $product->is_on_sale() ) {
	$regular_price = (float) $product->get_regular_price();
	$sale_price = (float) $product->get_sale_price();
	if ( $regular_price > 0 ) {
		$sale_percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
	}
}

$available_variations = [];
if ( $product->is_type( 'variable' ) ) {
	$available_variations = $product->get_available_variations();
}

$categories = get_the_terms( $product_id, 'product_cat' );
$primary_category = ! empty( $categories ) ? $categories[0]->name : '';
?>

<li <?php wc_product_class( 'product-card', $product ); ?> data-product-id="<?php echo esc_attr( $product_id ); ?>">
	<a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" class="flex relative group">
		<div class="flex flex-col gap-4 items-start justify-start flex-1">
			<div class="self-stretch shrink-0 h-[294px] relative overflow-hidden bg-[#f4f4f4] w-full">
				<img class="absolute right-[-0.4px] left-0 bottom-0 top-0 w-full h-full object-cover" src="<?php echo esc_url(get_template_directory_uri() . '/dist/images/v2/products/bg-gray.png'); ?>" alt="Background">
				
				<div class="w-full h-full absolute left-[50%] top-[50%] -translate-x-1/2 -translate-y-1/2 flex items-center justify-center p-0">
					<?php if ( has_post_thumbnail( $product_id ) ) : ?>
						<?php echo get_the_post_thumbnail( $product_id, 'woocommerce_thumbnail', [ 'class' => 'w-full h-full object-contain aspect-square transition-transform duration-500 group-hover:scale-110' ] ); ?>
					<?php else : ?>
						<img class="w-full h-full object-contain aspect-square" src="<?php echo esc_url( wc_placeholder_img_src( 'woocommerce_thumbnail' ) ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>">
					<?php endif; ?>
				</div>

				<?php if ( $sale_percentage > 0 ) : ?>
					<div class="bg-[#000000] pt-1 pr-2 pb-1 pl-2 flex flex-row gap-7 items-center justify-start absolute left-0 top-0 overflow-hidden">
						<div class="text-[#ffffff] text-left font-['Raleway-SemiBold',_sans-serif] text-xs leading-[18px] font-semibold relative flex items-center justify-start">
							- <?php echo esc_html( $sale_percentage ); ?>%
						</div>
					</div>
				<?php endif; ?>

				<button type="button" class="bg-[#ffffff] rounded-full p-2 flex flex-row items-center justify-center absolute right-4 top-5 shadow-sm product-wishlist-btn z-10 <?php echo esc_attr(function_exists('cf_wishlist_is_in_wishlist') && cf_wishlist_is_in_wishlist($product_id) ? 'active' : ''); ?>" data-product-id="<?php echo esc_attr( $product_id ); ?>">
					<svg class="w-4 h-4 transition-colors <?php echo esc_attr(function_exists('cf_wishlist_is_in_wishlist') && cf_wishlist_is_in_wishlist($product_id) ? 'fill-[#bd262a] stroke-[#bd262a]' : 'stroke-[#111111]'); ?>" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M7.99544 3.42388C6.66254 1.8656 4.43984 1.44643 2.76981 2.87334C1.09977 4.30026 0.864655 6.68598 2.17614 8.3736C3.26655 9.77674 6.56653 12.7361 7.64808 13.6939C7.76908 13.801 7.82958 13.8546 7.90015 13.8757C7.96175 13.8941 8.02914 13.8941 8.09074 13.8757C8.16131 13.8546 8.22181 13.801 8.34281 13.6939C9.42436 12.7361 12.7243 9.77674 13.8147 8.3736C15.1262 6.68598 14.9198 4.28525 13.2211 2.87334C11.5223 1.46144 9.32835 1.8656 7.99544 3.42388Z" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
					</svg>
				</button>
			</div>
			
			<div class="flex flex-col gap-2 items-start justify-start self-stretch shrink-0 relative">
				<?php if ( ! empty( $primary_category ) ) : ?>
					<div class="text-[#8f8f8f] text-left font-['Raleway-Medium',_sans-serif] text-[10px] leading-3 uppercase tracking-wider">
						<?php echo esc_html( $primary_category ); ?>
					</div>
				<?php endif; ?>

				<div class="text-[#141414] text-left font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative self-stretch flex items-center justify-start group-hover:text-[#bd262a] transition-colors">
					<?php echo esc_html( $product->get_name() ); ?>
				</div>

				<div class="flex flex-row gap-3 items-center justify-start shrink-0 relative">
					<?php 
					$colors_shown = false;
					if ( ! empty( $available_variations ) ) {
						$color_attributes = [];
						foreach ( $available_variations as $variation ) {
							foreach ( $variation['attributes'] as $attr_name => $attr_value ) {
								if ( strpos( strtolower( $attr_name ), 'color' ) !== false || strpos( strtolower( $attr_name ), 'colour' ) !== false ) {
									$color_attributes[ $attr_value ] = $attr_value;
								}
							}
						}
						
						if ( ! empty( $color_attributes ) ) {
							$colors_shown = true;
							?>
							<div class="flex flex-row gap-1 items-center justify-start shrink-0 relative">
								<?php foreach ( array_slice($color_attributes, 0, 4) as $color_val ) : ?>
									<div class="rounded-full shrink-0 w-2.5 h-2.5 relative border border-gray-200 aspect-square" style="background-color: <?php echo esc_attr( strtolower( $color_val ) ); ?>"></div>
								<?php endforeach; ?>
							</div>
							<?php
						}
					}
					
					if ( ! $colors_shown ) : ?>
						<div class="flex flex-row gap-1 items-center justify-start shrink-0 relative">
							<div class="bg-[#000000] rounded-full shrink-0 w-2.5 h-2.5 relative aspect-square"></div>
							<div class="bg-[#ab9a8d] rounded-full shrink-0 w-2.5 h-2.5 relative aspect-square"></div>
							<div class="bg-[#ceb492] rounded-full shrink-0 w-2.5 h-2.5 relative aspect-square"></div>
							<div class="bg-[#9c7a52] rounded-full shrink-0 w-2.5 h-2.5 relative aspect-square"></div>
						</div>
					<?php endif; ?>
					
					<div class="text-[#3f3f3f] text-right font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative">
						+ more options
					</div>
				</div>

				<div class="flex flex-row gap-2 items-center justify-start shrink-0 relative">
					<?php if ( $product->is_on_sale() ) : ?>
						<div class="text-[#3f3f3f] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
							<?php echo wc_price( $product->get_sale_price() ); ?>
						</div>
						<div class="text-[#8f8f8f] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative line-through">
							<?php echo wc_price( $product->get_regular_price() ); ?>
						</div>
					<?php else : ?>
						<div class="text-[#3f3f3f] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
							<?php echo wc_price( $product->get_price() ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</a>
</li>
