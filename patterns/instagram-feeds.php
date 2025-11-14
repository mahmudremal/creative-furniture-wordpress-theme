<?php
/**
 * Title: Instagram Feed Section
 * Slug: creative-furniture/instagram-feeds
 * Categories: creative-furniture
 * Keywords: furniture, instagram, feed, post, creative-furniture
 * Description: Display instagram posts.
 */

$banner_bg = get_template_directory_uri() . '/dist/images/promo-banner.jpg';

?>
<!-- wp:group {"align":"full","className":"creative-furniture-section"} -->
<div class="wp-block-group alignfull creative-furniture-section">
    <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","verticalAlignment":"top"}} -->
    <div class="wp-block-group">
        <!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
        <div class="wp-block-group">
            <!-- wp:paragraph {"className":"creativefurniture-hashtag"} -->
            <p class="creativefurniture-hashtag">#creativefurniture</p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"className":"creativefurniture-subtext"} -->
            <p class="creativefurniture-subtext">Inspiration, straight from your home. See it, share it, shop it.</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->

        <!-- wp:paragraph {"className":"creativefurniture-link"} -->
        <p class="creativefurniture-link"><a href="#">The Instagram Shop ></a></p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"className":"creativefurniture-gallery"} -->
    <div class="wp-block-columns creativefurniture-gallery">
        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
            <figure class="wp-block-image size-large"><img src="<?php echo esc_attr($banner_bg); ?>" alt=""/></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
            <figure class="wp-block-image size-large"><img src="<?php echo esc_attr($banner_bg); ?>" alt=""/></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
            <figure class="wp-block-image size-large"><img src="<?php echo esc_attr($banner_bg); ?>" alt=""/></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:image {"sizeSlug":"large","linkDestination":"none"} -->
            <figure class="wp-block-image size-large"><img src="<?php echo esc_attr($banner_bg); ?>" alt=""/></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->
