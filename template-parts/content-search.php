<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Creative_Furniture
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-result-card' ); ?>>
	
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'medium' ); ?>
			</a>
		</div>
	<?php endif; ?>

	<div class="entry-wrapper">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<span class="posted-on"><?php creative_furniture_posted_on(); ?></span>
					<span class="byline"> <?php creative_furniture_posted_by(); ?></span>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<footer class="entry-footer">
			<a href="<?php the_permalink(); ?>" class="read-more-link">
				<?php esc_html_e( 'Read More', 'creative-furniture' ); ?>
				<span class="arrow">&rarr;</span>
			</a>
		</footer><!-- .entry-footer -->
	</div><!-- .entry-wrapper -->

</article><!-- #post-<?php the_ID(); ?> -->