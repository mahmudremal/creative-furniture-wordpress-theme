<?php
function register_hero_pattern() {
register_block_pattern_category(
    'creative-furniture',
    ['label' => __('Creative Furniture', 'creative-furniture')]
);

$bg_image = esc_attr(get_template_directory_uri() . '/dist/images/shop-bg.jpg');

register_block_pattern(
    'creative-furniture/hero-section',
    [
        'title'       => __( 'Hero Section', 'creative-furniture' ),
        'description' => __( 'A full-width hero banner with image, overlay, heading, subtitle, and button.', 'creative-furniture' ),
        'categories'  => [ 'hero', 'creative-furniture' ],
        'content'     => '
        <!-- wp:cover {"url":"'. $bg_image .'","dimRatio":50,"overlayColor":"black","metadata":{"categories":["creative-furniture"],"patternName":"creative-furniture/hero-section","name":"Hero Section"},"align":"full","className":"hero-cover"} -->
        <div class="wp-block-cover alignfull hero-cover">
            <img class="wp-block-cover__image-background" alt="" src="'. $bg_image .'" data-object-fit="cover"/>
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
        ',
    ]
);
register_block_pattern(
    'creative-furniture/intro-section',
    [
        'title'       => __( 'Intro Section', 'creative-furniture' ),
        'description' => __( 'Centered tagline with mixed fonts and subtle color contrast.', 'creative-furniture' ),
        'categories'  => [ 'text', 'creative-furniture' ],
        'content'     => '
        <!-- wp:group {"align":"full","className":"cf-intro-section","layout":{"type":"constrained","justifyContent":"center"}} -->
        <div class="wp-block-group alignfull cf-intro-section">
            <!-- wp:paragraph {"align":"center","className":"cf-intro-text"} -->
            <p class="has-text-align-center cf-intro-text">
                <span class="cf-aspekta-dark">Creative Furniture is a </span>
                <span class="cf-playfair-dark">Dubai-based</span>
                <span class="cf-aspekta-dark"> store offering </span>
                <span class="cf-playfair-dark">affordable</span>
                <span class="cf-aspekta-dark">,</span>
                <span class="cf-aspekta-gray"> customizable, and modern </span>
                <span class="cf-playfair-gray">furniture</span>
            </p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
        ',
    ]
);

register_block_pattern(
    'creative-furniture/promo-slider-section',
    [
        'title'       => __( 'Promo Slider Section', 'creative-furniture' ),
        'description' => __( 'Two promotional banners side by side with overlay text and dots.', 'creative-furniture' ),
        'categories'  => [ 'banners', 'creative-furniture' ],
        'content'     => '
        <!-- wp:group {"align":"full","className":"cf-promo-section","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
        <div class="container-fluid wp-block-group alignfull cf-promo-section">

            <!-- wp:cover {"url":"' . esc_url( $bg_image ) . '","dimRatio":50,"overlayColor":"black","className":"cf-promo-card"} -->
            <div class="wp-block-cover cf-promo-card">
                <span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim"></span>
                <img class="wp-block-cover__image-background" alt="" src="' . esc_url( $bg_image ) . '" data-object-fit="cover"/>
                <div class="wp-block-cover__inner-container">

                    <!-- wp:group {"className":"cf-promo-content"} -->
                    <div class="wp-block-group cf-promo-content">

                        <!-- wp:heading {"level":3,"className":"cf-promo-heading"} -->
                        <h3 class="cf-promo-heading"><span class="cf-playfair">Up to 40% Off</span><span class="cf-aspekta"> — Modern Furniture Sale</span></h3>
                        <!-- /wp:heading -->

                        <!-- wp:buttons {"className":"cf-promo-buttons"} -->
                        <div class="wp-block-buttons cf-promo-buttons">
                            <!-- wp:button {"backgroundColor":"white","textColor":"black","className":"cf-promo-button"} -->
                            <div class="wp-block-button cf-promo-button"><a class="wp-block-button__link has-black-color has-white-background-color has-text-color has-background wp-element-button">Shop Now</a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->

                        <!-- wp:group {"className":"cf-promo-dots","layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap"}} -->
                        <div class="wp-block-group cf-promo-dots">
                            <!-- wp:paragraph {"className":"dot"} -->
                            <p class="dot">•</p>
                            <!-- /wp:paragraph -->
                            <!-- wp:paragraph {"className":"dot active"} -->
                            <p class="dot active">•</p>
                            <!-- /wp:paragraph -->
                            <!-- wp:paragraph {"className":"dot"} -->
                            <p class="dot">•</p>
                            <!-- /wp:paragraph -->
                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:group -->

                </div>
            </div>
            <!-- /wp:cover -->

            <!-- wp:cover {"url":"' . esc_url( $bg_image ) . '","dimRatio":60,"overlayColor":"black","className":"cf-promo-card"} -->
            <div class="wp-block-cover cf-promo-card">
                <span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim"></span>
                <img class="wp-block-cover__image-background" alt="" src="' . esc_url( $bg_image ) . '" data-object-fit="cover"/>
                <div class="wp-block-cover__inner-container">

                    <!-- wp:group {"className":"cf-promo-content"} -->
                    <div class="wp-block-group cf-promo-content">

                        <!-- wp:heading {"level":3,"className":"cf-promo-heading"} -->
                        <h3 class="cf-promo-heading"><span class="cf-playfair">Save 20%</span><span class="cf-aspekta"> This Weekend Only!</span></h3>
                        <!-- /wp:heading -->

                        <!-- wp:buttons {"className":"cf-promo-buttons"} -->
                        <div class="wp-block-buttons cf-promo-buttons">
                            <!-- wp:button {"backgroundColor":"white","textColor":"black","className":"cf-promo-button"} -->
                            <div class="wp-block-button cf-promo-button"><a class="wp-block-button__link has-black-color has-white-background-color has-text-color has-background wp-element-button">Shop Now</a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->

                        <!-- wp:group {"className":"cf-promo-dots","layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap"}} -->
                        <div class="wp-block-group cf-promo-dots">
                            <!-- wp:paragraph {"className":"dot"} -->
                            <p class="dot">•</p>
                            <!-- /wp:paragraph -->
                            <!-- wp:paragraph {"className":"dot active"} -->
                            <p class="dot active">•</p>
                            <!-- /wp:paragraph -->
                            <!-- wp:paragraph {"className":"dot"} -->
                            <p class="dot">•</p>
                            <!-- /wp:paragraph -->
                        </div>
                        <!-- /wp:group -->

                    </div>
                    <!-- /wp:group -->

                </div>
            </div>
            <!-- /wp:cover -->

        </div>
        <!-- /wp:group -->
        ',
    ]
);







}
add_action( 'init', 'register_hero_pattern' );
function creative_theme_gutenberg_editor_styles() {
    wp_enqueue_style(
        'creative_theme-editor-styles',
        get_template_directory_uri() . '/css/public.css',
        [],
        null
    );
}
add_action( 'enqueue_block_editor_assets', 'creative_theme_gutenberg_editor_styles' );