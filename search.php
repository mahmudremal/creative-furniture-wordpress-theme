<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Creative_Furniture
 */

get_header();
?>


	<main id="primary" class="site-main">
		<div class="container container-fluid">
			<?php if ( have_posts() ) : ?>

				<header class="page-header search-header">
					<h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search results for: %s', 'creative-furniture' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
					<p class="search-count"><?php 
						global $wp_query;
						echo $wp_query->found_posts . ' ' . esc_html__( 'items found', 'creative-furniture' ); 
					?></p>
				</header><!-- .page-header -->

				<div class="search-results-wrapper">
					<?php
					$search_query = get_search_query();

					// Products Query
					$product_args = array(
						's' => $search_query,
						'post_type' => 'product',
						'posts_per_page' => -1,
					);
					$product_query = new WP_Query( $product_args );

					if ( $product_query->have_posts() ) : ?>
						<section class="search-section products-results">
							<h2 class="section-title"><?php esc_html_e( 'Products', 'creative-furniture' ); ?></h2>
							<ul class="products columns-4">
								<?php
								while ( $product_query->have_posts() ) : $product_query->the_post();
									if ( function_exists( 'wc_get_template_part' ) ) {
										wc_get_template_part( 'content', 'product' );
									} else {
										get_template_part( 'template-parts/content', 'product' );
									}
								endwhile;
								?>
							</ul>
						</section>
					<?php endif;
					wp_reset_postdata();

					// Posts Query
					$post_args = array(
						's' => $search_query,
						'post_type' => array( 'post', 'page' ),
						'posts_per_page' => -1,
					);
					$post_query = new WP_Query( $post_args );

					if ( $post_query->have_posts() ) : ?>
						<section class="search-section blog-results">
							<h2 class="section-title"><?php esc_html_e( 'Articles & News', 'creative-furniture' ); ?></h2>
							<div class="search-blog-grid">
								<?php
								while ( $post_query->have_posts() ) : $post_query->the_post();
									get_template_part( 'template-parts/content', 'search' );
								endwhile;
								?>
							</div>
						</section>
					<?php endif;
					wp_reset_postdata();
					?>
				</div>

				<?php // The main the_posts_navigation() will not work with multiple custom queries.
				// the_posts_navigation(); ?>

			<?php else : ?>

				<div class="search-no-results">
					<?php get_template_part( 'template-parts/content', 'none' ); ?>
				</div>

			<?php endif; ?>
		</div>
	</main><!-- #main -->

	<style>
		.search-header {
			padding: 60px 0 40px;
			text-align: center;
			border-bottom: 1px solid #eee;
			margin-bottom: 50px;
		}
		.search-header .page-title {
			font-size: 32px;
			font-weight: 700;
			margin-bottom: 10px;
		}
		.search-header .page-title span {
			color: #C19A6B;
		}
		.search-count {
			color: #888;
			font-size: 14px;
			text-transform: uppercase;
			letter-spacing: 1px;
		}
		.search-section {
			margin-bottom: 60px;
		}
		.search-section .section-title {
			font-size: 24px;
			margin-bottom: 30px;
			padding-bottom: 15px;
			border-bottom: 2px solid #333;
			display: inline-block;
		}
		.search-blog-grid {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
			gap: 30px;
		}
		.search-blog-grid article {
			background: #fff;
			padding: 20px;
			border-radius: 8px;
			border: 1px solid #eee;
			transition: all 0.3s ease;
		}
		.search-blog-grid article:hover {
			box-shadow: 0 10px 30px rgba(0,0,0,0.05);
			transform: translateY(-5px);
		}
		.search-blog-grid h2.entry-title {
			font-size: 18px;
			margin-bottom: 10px;
		}
		.search-blog-grid h2.entry-title a {
			color: #333;
			text-decoration: none;
		}
		.search-blog-grid .entry-summary {
			font-size: 14px;
			color: #666;
			line-height: 1.6;
		}
		.search-no-results {
			padding: 100px 0;
			text-align: center;
		}
		@media (max-width: 768px) {
			.search-blog-grid {
				grid-template-columns: 1fr;
			}
		}
		.post-thumbnail img {
			width: 100%;
			border-radius: 8px;
		}
		.search-result-card footer.entry-footer {
			width: auto;
			display: flex;
		}
		.search-result-card footer.entry-footer a.read-more-link {
			background: #1a1a1a;
			padding: 12px 24px;
			border: none;
			border-radius: 30px;
			font-size: 14px;
			font-weight: 500;
			color: #fff;
			cursor: pointer;
			display: flex;
			align-items: center;
			gap: 8px;
			box-shadow: 0 4px 12px rgba(0,0,0,.15);
			text-decoration: none;
			width: auto;
		}
	</style>

<?php
get_sidebar();
get_footer();