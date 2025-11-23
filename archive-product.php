<?php
get_header();

if ( woocommerce_product_loop() ) {
    $bg_image = get_template_directory_uri() . '/dist/images/shop-bg.jpg';
    
    $title = __('Furniture', 'creative-furniture');
    
    if ( is_product_category() ) {
        $category = get_queried_object();
        
        $title = $category->name;
        
        $banner_id = get_term_meta( $category->term_id, '_catalogue_banner', true );
        if ( ! empty( $banner_id ) && is_numeric( $banner_id ) ) {
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
                <?php echo wp_kses_post(sprintf(__('All %s %s %s', 'creative-furniture'), '<em class="font-italic-accent">', $title, '</em>')); ?>
            </h1>
        </div>
<?php
global $wp_query;
$current_post_ids = wp_list_pluck($wp_query->posts, 'ID');

$filter_data = [];

$categories = get_terms([
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
    'object_ids' => $current_post_ids,
]);
$filter_data['categories'] = [];
foreach ($categories as $category) {
    $filter_data['categories'][] = [
        'slug' => $category->slug,
        'name' => $category->name,
        'count' => $category->count,
    ];
}

$tags = get_terms([
    'taxonomy' => 'product_tag',
    'hide_empty' => true,
    'object_ids' => $current_post_ids,
]);
$filter_data['tags'] = [];
foreach ($tags as $tag) {
    $filter_data['tags'][] = [
        'slug' => $tag->slug,
        'name' => $tag->name,
        'count' => $tag->count,
    ];
}

$attributes = wc_get_attribute_taxonomies();
$filter_data['attributes'] = [];
foreach ($attributes as $attribute) {
    $taxonomy = 'pa_' . $attribute->attribute_name;
    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
        'object_ids' => $current_post_ids,
    ]);
    $attr_terms = [];
    foreach ($terms as $term) {
        $attr_terms[] = [
            'slug' => $term->slug,
            'name' => $term->name,
            'count' => $term->count,
        ];
    }
    $filter_data['attributes'][$attribute->attribute_label] = $attr_terms;
}

global $wpdb;
$price_range = $wpdb->get_row("
    SELECT MIN(meta_value + 0) as min_price, MAX(meta_value + 0) as max_price
    FROM {$wpdb->postmeta}
    WHERE meta_key = '_price' AND meta_value > 0 AND post_id IN (" . implode(',', array_map('intval', $current_post_ids)) . ")
", ARRAY_A);
$filter_data['price'] = [
    'min' => (float) $price_range['min_price'],
    'max' => (float) $price_range['max_price'],
];

$filter_data['sorting'] = [
    ['value' => 'menu_order', 'label' => 'Default sorting'],
    ['value' => 'popularity', 'label' => 'Sort by popularity'],
    ['value' => 'rating', 'label' => 'Sort by average rating'],
    ['value' => 'date', 'label' => 'Sort by latest'],
    ['value' => 'price', 'label' => 'Sort by price: low to high'],
    ['value' => 'price-desc', 'label' => 'Sort by price: high to low'],
];

$filter_data['current'] = [
    'categories' => isset($_GET['product_cat']) ? (array) $_GET['product_cat'] : [],
    'tags' => isset($_GET['product_tag']) ? (array) $_GET['product_tag'] : [],
    'attributes' => [],
    'price' => [
        'min' => isset($_GET['min_price']) ? (float) $_GET['min_price'] : '',
        'max' => isset($_GET['max_price']) ? (float) $_GET['max_price'] : '',
    ],
    'orderby' => isset($_GET['orderby']) ? $_GET['orderby'] : 'menu_order',
];
foreach ($attributes as $attribute) {
    $taxonomy = 'pa_' . $attribute->attribute_name;
    $filter_data['current']['attributes'][$attribute->attribute_label] = isset($_GET[$taxonomy]) ? (array) $_GET[$taxonomy] : [];
}

$filter_arrays = wp_json_encode($filter_data);
?>


        <div class="shop-container">
            <div class="">
                <div class="shop-toolbar">
                    <div class="container-fluid">
                        <button class="filters-toggle" data-filters="<?php echo esc_attr($filter_arrays); ?>">
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