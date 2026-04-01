<?php
add_filter( 'woocommerce_product_loop_start', 'custom_woocommerce_loop_start' );
function custom_woocommerce_loop_start( $loop_start ) {
    $custom_classes = 'grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 2xl:grid-cols-6 gap-x-4 gap-y-6 items-center justify-start self-stretch relative';
    return '<ul class="-products ' . esc_attr($custom_classes) . '">';
}

$shop_page_id = wc_get_page_id('shop');
$title = woocommerce_page_title(false);
$description = '';
$breadcrumbs = [];
$breadcrumbs[] = ['label' => __('Home', 'creative-furniture'), 'url' => home_url('/')];

if (is_shop()) {
    $breadcrumbs[] = ['label' => $title, 'url' => ''];
    $description = get_post_field('post_content', $shop_page_id);
} else if (is_product_category()) {
    $breadcrumbs[] = ['label' => __('Shop', 'creative-furniture'), 'url' => get_permalink($shop_page_id)];
    $term = get_queried_object();
    $title = $term->name;
    $description = $term->description;
    
    $ancestors = get_ancestors($term->term_id, 'product_cat');
    foreach (array_reverse($ancestors) as $ancestor_id) {
        $ancestor = get_term($ancestor_id, 'product_cat');
        $breadcrumbs[] = ['label' => $ancestor->name, 'url' => get_term_link($ancestor)];
    }
    $breadcrumbs[] = ['label' => $title, 'url' => ''];
} else if (is_product_tag()) {
    $breadcrumbs[] = ['label' => __('Shop', 'creative-furniture'), 'url' => get_permalink($shop_page_id)];
    $term = get_queried_object();
    $title = $term->name;
    $description = $term->description;
    $breadcrumbs[] = ['label' => $title, 'url' => ''];
} else {
    $breadcrumbs[] = ['label' => $title, 'url' => ''];
}


$current_per_page = isset($_GET['per_page']) ? intval($_GET['per_page']) : 20;
$current_orderby = isset($_GET['orderby']) ? sanitize_text_field($_GET['orderby']) : 'menu_order';

?>

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
    'min' => (float) ($price_range ? $price_range['min_price'] : 0),
    'max' => (float) ($price_range ? $price_range['max_price'] : 0),
];

$filter_data['sorting'] = [
    ['value' => 'menu_order', 'label' => __('Default sorting', 'creative-furniture')],
    ['value' => 'popularity', 'label' => __('Sort by popularity', 'creative-furniture')],
    ['value' => 'rating', 'label' => __('Sort by average rating', 'creative-furniture')],
    ['value' => 'date', 'label' => __('Sort by latest', 'creative-furniture')],
    ['value' => 'price', 'label' => __('Sort by price: low to high', 'creative-furniture')],
    ['value' => 'price-desc', 'label' => __('Sort by price: high to low', 'creative-furniture')],
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
<?php get_header(); ?>

<div class="relative flex flex-col gap-10 px-4 md:px-0">
    <div class="flex flex-wrap gap-1 sm:gap-2 items-center justify-start px-4 w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
        <?php foreach ($breadcrumbs as $index => $crumb) : ?>
            <?php if (!empty($crumb['url'])) : ?>
                <a href="<?php echo esc_url($crumb['url']); ?>" class="text-[#989898] hover:text-[#000000] text-left font-['Raleway-Medium',_sans-serif] text-xs sm:text-base leading-6 font-medium relative flex items-center justify-start transition-colors">
                    <?php echo esc_html($crumb['label']); ?>
                </a>
            <?php else : ?>
                <div class="text-[#000000] text-left font-['Raleway-Medium',_sans-serif] text-xs sm:text-base leading-6 font-medium relative flex items-center justify-start">
                    <?php echo esc_html($crumb['label']); ?>
                </div>
            <?php endif; ?>
            
            <?php if ($index < count($breadcrumbs) - 1) : ?>
                <div class="text-[#989898] text-left font-['Raleway-Medium',_sans-serif] text-xs sm:text-base leading-6 font-medium relative flex items-center justify-start">
                    /
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="border-solid border-[#d3d3d3] border-b">
        <div class="pb-5 px-4 flex flex-col gap-3 items-start justify-start w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
            <h1 class="text-[#010101] text-left font-['Raleway-SemiBold',_sans-serif] text-3xl md:text-5xl leading-[48px] font-semibold relative self-stretch">
                <?php echo esc_html($title); ?>
            </h1>
            <?php if (!empty($description)) : ?>
                <div class="text-[#2f2f2f] text-left font-['Raleway-Regular',_sans-serif] text-base leading-6 font-normal relative <?php echo esc_attr(str_word_count($description) <= 100 ? 'w-[630px]' : 'w-full line-clamp-5'); ?>" style="opacity: 0.8">
                    <?php echo wp_kses_post($description); ?>
                </div>
                <?php if (str_word_count($description) > 100) : ?>
                    <button type="button" class="text-sm font-semibold hover:underline" onclick="this.previousElementSibling.classList.remove('line-clamp-5'); this.remove()"><?php esc_html_e('Show More', 'creative-furniture'); ?></button>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="flex flex-row gap-2 items-center justify-between px-4 w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
        <div class="filters-toggle bg-[#222222] pt-2 pr-3.5 pb-2 pl-3.5 flex flex-row gap-2 items-center justify-start cursor-pointer transition-colors hover:bg-[#333333] select-none" data-filters="<?php echo esc_attr($filter_arrays); ?>">
            <svg class="shrink-0 w-5 h-5 relative overflow-visible" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 10H15M2.5 5H17.5M7.5 15H12.5" stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <div class="text-[#ffffff] text-left font-['Aspekta-400',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start">
                <?php esc_html_e('Filters', 'creative-furniture'); ?>
            </div>
        </div>

        <div class="flex flex-row gap-6 items-center justify-start">
            <div class="flex flex-row gap-2 items-center justify-end shrink-0 relative">
                <label class="text-[#212121] text-right font-['Aspekta-400',_sans-serif] text-sm leading-5 font-normal relative hidden md:flex items-center justify-end">
                    <?php esc_html_e('Show:', 'creative-furniture'); ?>
                </label>
                <div class="flex flex-row gap-1 items-center justify-start shrink-0 relative">
                    <select class="products-per-page text-[#212121] text-right font-['Aspekta-400',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-end border-none focus:ring-0 bg-transparent cursor-pointer" onchange="window.location.href=this.value;">
                        <?php foreach ([20, 40, 60] as $count) : ?>
                            <option value="<?php echo esc_url(remove_query_arg('paged', add_query_arg('per_page', $count))); ?>" <?php selected($current_per_page, $count); ?>>
                                <?php echo esc_html($count); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="flex flex-row gap-2 items-center justify-end shrink-0 relative">
                <label class="text-[#212121] font-['Aspekta-400',_sans-serif] text-sm leading-5 font-normal relative hidden md:flex items-center justify-end">
                    <?php esc_html_e('Sort by:', 'creative-furniture'); ?>
                </label>
                <div class="flex flex-row gap-1 items-center justify-start shrink-0 relative">
                    <select class="orderby text-[#212121] font-['Aspekta-400',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-end border-none focus:ring-0 bg-transparent cursor-pointer" onchange="window.location.href=this.value;">
                        <?php
                        $sort_options = [
                            'menu_order' => __('Best Selling', 'creative-furniture'),
                            'popularity' => __('Popularity', 'creative-furniture'),
                            'rating'     => __('Average rating', 'creative-furniture'),
                            'date'       => __('Latest', 'creative-furniture'),
                            'price'      => __('Price: Low to High', 'creative-furniture'),
                            'price-desc' => __('Price: High to Low', 'creative-furniture'),
                        ];
                        foreach ($sort_options as $value => $label) : ?>
                            <option value="<?php echo esc_url(remove_query_arg('paged', add_query_arg('orderby', $value))); ?>" <?php selected($current_orderby, $value); ?>>
                                <?php echo esc_html($label); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
<?php
if ( woocommerce_product_loop() ) {
    ?>
        <div class="shop-container flex flex-col gap-6 items-start justify-start px-4 w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
            <div class="w-full">
                <div class="shop-content -container-fluid p-0">

                    <main class="shop-main">

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
?>
</div>


<?php get_footer(); ?>