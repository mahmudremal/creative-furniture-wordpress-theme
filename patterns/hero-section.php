<?php
/**
 * Title: Hero Section
 * Slug: creative-furniture/hero-section
 * Categories: hero, banner, creative-furniture
 * Keywords: furniture, hero, creative-furniture
 * Description: A full-width hero banner with image, overlay, heading, subtitle, and button.
 */

$bg_image = esc_attr(get_template_directory_uri() . '/dist/images/shop-bg.jpg');

?>
<!-- wp:cover {"url":"<?php echo esc_attr($bg_image); ?>","dimRatio":50,"overlayColor":"black","metadata":{"categories":["creative-furniture"],"patternName":"creative-furniture/hero-section","name":"Hero Section"},"align":"full","className":"hero-cover"} -->
<div class="wp-block-cover alignfull hero-cover">
    <img class="wp-block-cover__image-background" alt="" src="<?php echo esc_attr($bg_image); ?>" data-object-fit="cover"/>
    <span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim"></span>
    <div class="wp-block-cover__inner-container">
        <!-- wp:group {"className":"hero-content","layout":{"type":"constrained"}} -->
        <div class="wp-block-group hero-content">
            <!-- wp:heading {"className":"wp-block-heading hero-title has-text-align-center"} -->
            <h2 class="wp-block-heading hero-title has-text-align-center">
                <span class="part1">Upgrade Your Space —</span>
                <span class="part2"></span>
                <em class="part3">Save More Today!</em>
            </h2>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","className":"hero-subtitle"} -->
            <p class="has-text-align-center hero-subtitle">
                Transform your home with beautifully crafted furniture designed for comfort, style, and everyday living. Discover timeless pieces that blend elegance and functionality.
            </p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
            <div class="wp-block-buttons">
                <!-- wp:button {"backgroundColor":"white","textColor":"black","className":"hero-button"} -->
                <div class="wp-block-button hero-button">
                    <a class="wp-block-button__link has-black-color has-white-background-color has-text-color has-background wp-element-button" href="#">Shop Now</a>
                </div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:group -->
    </div>
</div>
<!-- /wp:cover -->