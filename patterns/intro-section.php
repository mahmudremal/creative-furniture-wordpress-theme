<?php
/**
 * Title: Intro Section
 * Slug: creative-furniture/intro-section
 * Categories: creative-furniture
 * Keywords: furniture, text, creative-furniture
 * Description: Centered tagline with mixed fonts and subtle color contrast.
 */
$bg_image = esc_attr(get_template_directory_uri() . '/dist/images/shop-bg.jpg');

?>
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