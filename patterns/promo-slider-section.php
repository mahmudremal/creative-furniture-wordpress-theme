<?php
/**
 * Title: Promo Slider Section
 * Slug: creative-furniture/promo-slider-section
 * Categories: creative-furniture
 * Keywords: furniture, banners, creative-furniture
 * Description: Two promotional banners side by side with overlay text and dots.
 */
$bg_image = esc_attr(get_template_directory_uri() . '/dist/images/shop-bg.jpg');

?>

<!-- wp:group {"align":"full","className":"cf-promo-section","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
<div class="container-fluid wp-block-group alignfull cf-promo-section">

    <!-- wp:cover {"url":"<?php echo esc_attr($bg_image); ?>","dimRatio":50,"overlayColor":"black","className":"cf-promo-card"} -->
    <div class="wp-block-cover cf-promo-card">
        <span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim"></span>
        <img class="wp-block-cover__image-background" alt="" src="<?php echo esc_attr($bg_image); ?>" data-object-fit="cover"/>
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

    <!-- wp:cover {"url":"<?php echo esc_attr($bg_image); ?>","dimRatio":60,"overlayColor":"black","className":"cf-promo-card"} -->
    <div class="wp-block-cover cf-promo-card">
        <span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim"></span>
        <img class="wp-block-cover__image-background" alt="" src="<?php echo esc_attr($bg_image); ?>" data-object-fit="cover"/>
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