<?php
defined( 'ABSPATH' ) || exit;

global $product;

if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}

$card_style = get_theme_mod( 'product_card_style', 'style1' );
$product_id = $product->get_id();
$gallery_ids = $product->get_gallery_image_ids();
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
?>

<li <?php wc_product_class( 'product-card product-card-' . esc_attr( $card_style ), $product ); ?> data-product-id="<?php echo esc_attr( $product_id ); ?>">
	
	<div class="product-card-inner">
		
		<div class="product-image-wrapper">
			
			<?php if ( $sale_percentage > 0 ) : ?>
				<span class="product-badge sale-badge"><?php echo esc_html( $sale_percentage ); ?>% OFF</span>
			<?php endif; ?>

			<?php if ( ! $product->is_in_stock() ) : ?>
				<span class="product-badge out-of-stock-badge"><?php esc_html_e( 'Out of Stock', 'creative-furniture' ); ?></span>
			<?php endif; ?>

			<button type="button" class="product-wishlist-btn" data-product-id="<?php echo esc_attr( $product_id ); ?>" aria-label="Add to wishlist">
				<?php footer_block_svg_icon_print('heart'); ?>
			</button>

			<button type="button" class="product-quick-view-btn" data-product-id="<?php echo esc_attr( $product_id ); ?>" aria-label="Quick view">
				Quick View
				<?php footer_block_svg_icon_print('plus'); ?>
			</button>

			<?php if ( $card_style === 'style1' ) : ?>
				
				<a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" class="product-image-link">
					<div class="product-images-hover">
						<div class="product-image-main">
							<?php echo wp_kses_post( $product->get_image( 'woocommerce_thumbnail' ) ); ?>
						</div>
						<?php if ( ! empty( $gallery_ids ) ) : ?>
							<div class="product-image-hover">
								<?php echo wp_get_attachment_image( $gallery_ids[0], 'woocommerce_thumbnail' ); ?>
							</div>
						<?php endif; ?>
					</div>
				</a>

			<?php elseif ( $card_style === 'style2' ) : ?>
				
				<div class="product-image-slider">
					<div class="slider-container">
						<div class="slider-track">
							<div class="slider-item">
								<?php echo wp_kses_post( $product->get_image( 'woocommerce_thumbnail' ) ); ?>
							</div>
							<?php if ( ! empty( $gallery_ids ) ) : ?>
								<?php foreach ( $gallery_ids as $gallery_id ) : ?>
									<div class="slider-item">
										<?php echo wp_get_attachment_image( $gallery_id, 'woocommerce_thumbnail' ); ?>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
					
					<?php if ( ! empty( $gallery_ids ) ) : ?>
						<button type="button" class="slider-btn slider-prev" aria-label="Previous image">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none">
								<path d="M12 4L6 10l6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
						<button type="button" class="slider-btn slider-next" aria-label="Next image">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="none">
								<path d="M8 4l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</button>
						<div class="slider-dots"></div>
					<?php endif; ?>
				</div>

			<?php endif; ?>
		</div>

		<div class="product-info">
			<h3 class="product-title">
				<a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>">
					<?php echo esc_html( $product->get_name() ); ?>
				</a>
			</h3>

			<div class="product-price">
				<?php echo wp_kses_post( $product->get_price_html() ); ?>
			</div>

			<?php if ( ! empty( $available_variations ) ) : ?>
				<div class="product-variations">
					<?php
					$color_attributes = [];
					foreach ( $available_variations as $variation ) {
						foreach ( $variation['attributes'] as $attr_name => $attr_value ) {
							if ( strpos( strtolower( $attr_name ), 'color' ) !== false || strpos( strtolower( $attr_name ), 'colour' ) !== false ) {
								$color_attributes[ $attr_value ] = [
									'name' => $attr_value,
									'image' => $variation['image']['url'] ?? '',
									'variation_id' => $variation['variation_id']
								];
							}
						}
					}
					
					if ( ! empty( $color_attributes ) ) :
						$color_attributes = array_slice( $color_attributes, 0, 4 );
					?>
						<div class="product-color-swatches">
							<?php foreach ( $color_attributes as $color ) : ?>
								<button 
									type="button" 
									class="color-swatch" 
									data-variation-id="<?php echo esc_attr( $color['variation_id'] ); ?>"
									data-image="<?php echo esc_url( $color['image'] ); ?>"
									title="<?php echo esc_attr( $color['name'] ); ?>"
									style="background-color: <?php echo esc_attr( strtolower( $color['name'] ) ); ?>;"
								>
									<span class="screen-reader-text"><?php echo esc_html( $color['name'] ); ?></span>
								</button>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

	</div>

</li>