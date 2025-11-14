<?php
/**
 * Title: Category Card Block
 * Slug: creative-furniture/category-card
 * Categories: featured, banner, creative-furniture
 * Keywords: furniture, card, overlay, button, hover
 * Description: A clickable card with image, hover overlay, and button for linking to a collection or product.
 */
$banner_bg = get_template_directory_uri() . '/dist/images/promo-banner.jpg';

?>
<!-- wp:group {"className":"category-card"} -->
<div class="wp-block-group category-card">
    <!-- wp:image {"sizeSlug":"large","className":"category-image"} -->
    <figure class="wp-block-image size-large category-image">
        <img src="<?php echo esc_attr($banner_bg); ?>" alt="Category Banner"/>
    </figure>
    <!-- /wp:image -->

    <!-- wp:buttons {"className":"overlay-buttons"} -->
    <div class="wp-block-buttons overlay-buttons">
        <!-- wp:button {"className":"see-collections"} -->
        <div class="wp-block-button see-collections">
            <a class="wp-block-button__link" href="#">See Collections</a>
        </div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->
</div>
<!-- /wp:group -->
