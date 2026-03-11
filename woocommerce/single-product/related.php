<?php
defined( 'ABSPATH' ) || exit;

if ( $related_products ) : ?>
	<section class="related products w-full flex flex-col gap-8">
		<div class="blaze-slider" data-slider="products" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => true, 'slidesToShow' => 5, 'slidesToScroll' => 2, 'slideGap' => '16px']])); ?>">
			<div class="blaze-container flex flex-col gap-7">
				<?php
				$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'You may like', 'creative-furniture' ) );
				if ( $heading ) :
				?>
				<div class="flex flex-row items-center justify-between w-full">
					<h2 class="text-black text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold">
						<?php echo esc_html( $heading ); ?>
					</h2>
					<div class="flex flex-row gap-2 items-center justify-start shrink-0">
						<svg type="button" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="blaze-prev shrink-0 w-7 h-7 relative overflow-visible" >
							<path d="M17.5 21L10.5 14L17.5 7" stroke="#BFBFBF" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
						<svg type="button" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="blaze-next shrink-0 w-7 h-7 relative overflow-visible" >
							<path d="M10.5 21L17.5 14L10.5 7" stroke="var(--ui-light-black-primary, #111111)" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</div>
				</div>
				<?php endif; ?>
				<div class="w-full">
					<div class="blaze-track-container">
						<div class="blaze-track">
							<?php for ($i=1;$i<=5;$i++) : ?>
							<?php foreach ( $related_products as $related_product ) : ?>
								<?php
								$post_object = get_post( $related_product->get_id() );
								setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, BigBrother.PHP.GlobalVariablesOverride.Prohibited
								wc_get_template_part( 'content', 'product' );
								?>
							<?php endforeach; ?>
							<?php endfor; ?>
						</div>
					</div>
				</div>

				<div class="w-full h-0.5 bg-[#D2D2D2] relative overflow-hidden mt-4">
					<div class="bg-black h-full w-1/4 absolute left-0 top-0 transition-all duration-300"></div>
				</div>
			</div>
		</div>

	</section>
	<?php
endif;

wp_reset_postdata();
