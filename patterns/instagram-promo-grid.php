<?php
/**
 * Title: Instagram Promo Grid
 * Slug: creative-furniture/instagram-promo-grid
 * Categories: creative-furniture
 * Keywords: promo, instagram, grid, creative-furniture
 * Description: A clean intagram posts promo grid
 */

$banner_image = get_template_directory_uri() . '/dist/images';

?>

<!-- wp:group {"className":"cf-instagram-block container-fluid","layout":{"type":"constrained"}} -->
<div class="wp-block-group cf-instagram-block container-fluid">

	<!-- Header -->
	<!-- wp:group {"className":"cf-instagram-header","layout":{"type":"flex","justifyContent":"space-between"}} -->
	<div class="wp-block-group cf-instagram-header">

		<!-- Left Text -->
		<!-- wp:group {"className":"cf-instagram-title-group","layout":{"type":"constrained"}} -->
		<div class="wp-block-group cf-instagram-title-group">
			<!-- wp:paragraph {"className":"cf-hashtag"} -->
			<p class="cf-hashtag">#creativefurniture</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"className":"cf-subtitle"} -->
			<p class="cf-subtitle">Inspiration, straight from your home. See it, share it, shop it.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- Right Link -->
		<!-- wp:paragraph {"className":"cf-instagram-link"} -->
		<p class="cf-instagram-link">The Instagram Shop ></p>
		<!-- /wp:paragraph -->

	</div>
	<!-- /wp:group -->

	<!-- Images Grid -->
	<!-- wp:columns {"className":"cf-instagram-grid"} -->
	<div class="wp-block-columns cf-instagram-grid">

		<!-- Column 1 -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cf-instagram-img"} -->
			<figure class="wp-block-image size-full cf-instagram-img">
				<img src="<?php echo esc_attr($banner_image . '/promo-banner.jpg'); ?>" alt="" />
			</figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

		<!-- Column 2 -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cf-instagram-img"} -->
			<figure class="wp-block-image size-full cf-instagram-img">
				<img src="<?php echo esc_attr($banner_image . '/promo-banner.jpg'); ?>" alt="" />
			</figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

		<!-- Column 3 -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cf-instagram-img"} -->
			<figure class="wp-block-image size-full cf-instagram-img">
				<img src="<?php echo esc_attr($banner_image . '/promo-banner.jpg'); ?>" alt="" />
			</figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

		<!-- Column 4 -->
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"cf-instagram-img"} -->
			<figure class="wp-block-image size-full cf-instagram-img">
				<img src="<?php echo esc_attr($banner_image . '/promo-banner.jpg'); ?>" alt="" />
			</figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

	</div>
	<!-- /wp:columns -->

</div>
<!-- /wp:group -->
