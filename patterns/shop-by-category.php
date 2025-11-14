<?php
/**
 * Title: Shop by Category
 * Slug: creative-furniture/shop-by-category
 * Categories: creative-furniture
 * Keywords: shop, category, furniture, product category
 * Description: Display product categories like Office, Home, Hospitality, and Unique Furniture.
 */
$banner_bg = get_template_directory_uri() . '/dist/images/promo-banner.jpg';
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"60px","bottom":"60px"}}},"className":"shop-by-category"} -->
<div class="wp-block-group alignfull shop-by-category" style="padding-top:60px;padding-bottom:60px">
    
    <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between","alignItems":"center"},"className":"shop-by-category-header"} -->
    <div class="wp-block-group shop-by-category-header">
        <!-- wp:heading {"level":2,"className":"shop-by-category-title"} -->
        <h2 class="shop-by-category-title">
            <span class="title-part">Shop by</span> 
            <span class="title-italic">category</span>
        </h2>
        <!-- /wp:heading -->

        <!-- wp:group {"layout":{"type":"flex","justifyContent":"right","flexWrap":"nowrap"},"className":"shop-by-category-arrows"} -->
        <div class="wp-block-group shop-by-category-arrows">
            <div class="arrow prev"></div>
            <div class="arrow next"></div>
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"className":"shop-category-grid"} -->
    <div class="wp-block-columns shop-category-grid">

        <!-- wp:column {"className":"shop-category-card"} -->
        <div class="wp-block-column shop-category-card">
            <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"category-image"} -->
            <figure class="wp-block-image size-large category-image">
                <img src="<?php echo esc_attr($banner_bg); ?>" alt="Office Furniture"/>
            </figure>
            <!-- /wp:image -->
            <!-- wp:heading {"level":3,"className":"category-title"} -->
            <h3 class="category-title">Office Furniture</h3>
            <!-- /wp:heading -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"shop-category-card"} -->
        <div class="wp-block-column shop-category-card">
            <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"category-image"} -->
            <figure class="wp-block-image size-large category-image">
                <img src="<?php echo esc_attr($banner_bg); ?>" alt="Home Furniture"/>
                <a href="#" class="see-collections">See collections</a>
            </figure>
            <!-- /wp:image -->
            <!-- wp:heading {"level":3,"className":"category-title"} -->
            <h3 class="category-title">Home Furniture</h3>
            <!-- /wp:heading -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"shop-category-card"} -->
        <div class="wp-block-column shop-category-card">
            <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"category-image"} -->
            <figure class="wp-block-image size-large category-image">
                <img src="<?php echo esc_attr($banner_bg); ?>" alt="Hospitality Furniture"/>
            </figure>
            <!-- /wp:image -->
            <!-- wp:heading {"level":3,"className":"category-title"} -->
            <h3 class="category-title">Hospitality Furniture</h3>
            <!-- /wp:heading -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"shop-category-card"} -->
        <div class="wp-block-column shop-category-card">
            <!-- wp:image {"sizeSlug":"large","linkDestination":"none","className":"category-image"} -->
            <figure class="wp-block-image size-large category-image">
                <img src="<?php echo esc_attr($banner_bg); ?>" alt="Unique Furniture"/>
            </figure>
            <!-- /wp:image -->
            <!-- wp:heading {"level":3,"className":"category-title"} -->
            <h3 class="category-title">Unique Furniture</h3>
            <!-- /wp:heading -->
        </div>
        <!-- /wp:column -->

    </div>
    <!-- /wp:columns -->

</div>
<!-- /wp:group -->
