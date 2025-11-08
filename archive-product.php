<?php
get_header();

if ( woocommerce_product_loop() ) {
    // Default fallback background image
    $bg_image = get_template_directory_uri() . '/dist/images/shop-bg.jpg';
    
    // Default title for shop page
    $title = 'All <em class="font-italic-accent">Furniture</em>';
    
    // Check if we're on a product category page
    if ( is_product_category() ) {
        // Get the current category object
        $category = get_queried_object();
        
        // Update title to "All [Category Name]"
        $title = 'All <em class="font-italic-accent">' . esc_html( $category->name ) . '</em>';
        
        // Check for custom term meta '_catalogue_banner' (expects a media attachment ID)
        $banner_id = get_term_meta( $category->term_id, '_catalogue_banner', true );
        if ( ! empty( $banner_id ) && is_numeric( $banner_id ) ) {
            // Get the image URL from the attachment ID
            $banner_url = wp_get_attachment_url( $banner_id );
            if ( $banner_url ) {
                $bg_image = $banner_url;
            }
        }
    }
    ?>
    <div class="shop-page">
        <div class="shop-hero" style="background-image: url(<?php echo esc_url($bg_image); ?>);">
            <h1 class="shop-title">
                <?php echo wp_kses_post($title); ?>
            </h1>
        </div>

        <div class="shop-container">
            <div class="">
                <div class="shop-toolbar">
                    <div class="container-fluid">
                        <button class="filters-toggle">
                            <?php footer_block_svg_icon_print('filter-lines'); ?>
                            <span>Filters</span>
                        </button>

                        <div class="toolbar-filters">
                            <button>
                                <span>Category</span>
                                <?php footer_block_svg_icon_print('chevron-down'); ?>
                            </button>
                            <button>
                                <span>Color</span>
                                <?php footer_block_svg_icon_print('chevron-down'); ?>
                            </button>
                            <button>
                                <span>Any Finish</span>
                                <?php footer_block_svg_icon_print('chevron-down'); ?>
                            </button>
                            <button>
                                <span>Price</span>
                                <?php footer_block_svg_icon_print('chevron-down'); ?>
                            </button>
                            <?php // woocommerce_catalog_ordering(); ?>
                        </div>

                        <div class="toolbar-meta">
                            <div class="show-count">
                                <label>Show:</label>
                                <select class="products-per-page" style="background-image: url(<?php echo esc_attr(get_template_directory_uri() . '/dist/icons/chevron-down.svg'); ?>);">
                                    <option value="20">20</option>
                                    <option value="40">40</option>
                                    <option value="60">60</option>
                                </select>
                            </div>

                            <div class="sort-by">
                                <label>Sort by:</label>
                                <select class="orderby" style="background-image: url(<?php echo esc_attr(get_template_directory_uri() . '/dist/icons/chevron-down.svg'); ?>);">
                                    <option value="menu_order">Best Selling</option>
                                    <option value="popularity">Popularity</option>
                                    <option value="rating">Average rating</option>
                                    <option value="date">Latest</option>
                                    <option value="price">Price: Low to High</option>
                                    <option value="price-desc">Price: High to Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="shop-content container-fluid">
                    <!-- <aside class="shop-sidebar">
                        <div class="sidebar-filters">
                            <?php // dynamic_sidebar('shop-filters'); ?>
                        </div>
                    </aside> -->

                    <main class="shop-main">
                        <div class="products-info">
                            <?php woocommerce_result_count(); ?>
                        </div>

                        <?php woocommerce_product_loop_start(); ?>

                        <?php
                        if ( wc_get_loop_prop( 'total' ) ) {
                            while ( have_posts() ) {
                                the_post();
                                wc_get_template_part( 'content', 'product' );
                            }
                        }
                        ?>

                        <?php woocommerce_product_loop_end(); ?>

                        <?php woocommerce_pagination(); ?>
                    </main>
                </div>
            </div>
        </div>
    </div>
    <?php
} else {
    do_action( 'woocommerce_no_products_found' );
}

get_footer();