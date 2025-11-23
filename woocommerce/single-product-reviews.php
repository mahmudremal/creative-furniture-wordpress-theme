<?php
defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}
?>

<div id="reviews" class="product-reviews">
	<div class="reviews-container">
		<div class="reviews-header">
			<h2 class="reviews-title">
				<?php
				$count = $product->get_review_count();
				if ( $count && wc_review_ratings_enabled() ) {
					$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'woocommerce' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
					echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product );
				} else {
					esc_html_e( 'Reviews', 'woocommerce' );
				}
				?>
			</h2>
		</div>

		<div class="reviews-filters">
			<div class="search-reviews">
				<input type="text" placeholder="<?php esc_attr_e( 'Search reviews', 'woocommerce' ); ?>" class="reviews-search-input">
				<button type="button" class="search-btn">
					<svg>search</svg>
				</button>
			</div>
			
			<div class="filter-group">
				<select class="filter-select" id="reviews-sort">
					<option value="recent"><?php esc_html_e( 'Most Recent', 'woocommerce' ); ?></option>
					<option value="oldest"><?php esc_html_e( 'Oldest', 'woocommerce' ); ?></option>
					<option value="highest"><?php esc_html_e( 'Highest Rating', 'woocommerce' ); ?></option>
					<option value="lowest"><?php esc_html_e( 'Lowest Rating', 'woocommerce' ); ?></option>
				</select>
				
				<select class="filter-select" id="reviews-rating">
					<option value=""><?php esc_html_e( 'All Rating', 'woocommerce' ); ?></option>
					<option value="5">5 <?php esc_html_e( 'Stars', 'woocommerce' ); ?></option>
					<option value="4">4 <?php esc_html_e( 'Stars', 'woocommerce' ); ?></option>
					<option value="3">3 <?php esc_html_e( 'Stars', 'woocommerce' ); ?></option>
					<option value="2">2 <?php esc_html_e( 'Stars', 'woocommerce' ); ?></option>
					<option value="1">1 <?php esc_html_e( 'Star', 'woocommerce' ); ?></option>
				</select>
			</div>
		</div>

		<?php if ( have_comments() ) : ?>
			<div class="reviews-list">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</div>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="reviews-pagination">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
							'next_text' => is_rtl() ? '&larr;' : '&rarr;',
							'type'      => 'list',
						)
					)
				);
				echo '</nav>';
			endif;
			?>
		<?php else : ?>
			<p class="no-reviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>
		<?php endif; ?>
	</div>
</div>