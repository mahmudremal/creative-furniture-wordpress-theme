<?php
function register_hero_pattern() {
    register_block_pattern_category(
        'creative-furniture',
        ['label' => __('Creative Furniture', 'creative-furniture')]
    );
}
add_action( 'init', 'register_hero_pattern');
function creative_theme_gutenberg_editor_styles() {
    // if (file_exists(get_template_directory() . '/dist/css/editor.css')) {
    //     wp_enqueue_style('creative_theme-editor-styles', get_template_directory_uri() . '/dist/css/editor.css', [], null);
    // }
    wp_enqueue_script('creative_theme-editor-scripts', get_template_directory_uri() . '/dist/js/editor.js', ['wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components'], null);
}
add_action('enqueue_block_editor_assets', 'creative_theme_gutenberg_editor_styles');







function creative_furniture_register_blocks() {
    register_block_type('creative-furniture/woo-products', [
        'render_callback' => 'creative_furniture_render_woo_products',
        'attributes'      => [
            'productsPerPage' => [ 'type' => 'number', 'default' => 6 ],
            'productsPerRow'  => [ 'type' => 'number', 'default' => 3 ],
            'productType'     => [ 'type' => 'string', 'default' => 'featured' ],
            'categories'      => [ 'type' => 'array', 'default' => [] ],
            'tags'            => [ 'type' => 'array', 'default' => [] ],
            'includeProducts' => [ 'type' => 'array', 'default' => [] ],
        ],
    ]);
}
add_action('init', 'creative_furniture_register_blocks');

function creative_furniture_render_woo_products( $attributes ) {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return '<p>' . esc_html__( 'WooCommerce is not active.', 'creative-furniture' ) . '</p>';
    }

    $defaults = [
        'productsPerPage' => 6,
        'productsPerRow'  => 3,
        'productType'     => 'featured',
        'categories'      => [],
        'tags'            => [],
        'includeProducts' => [],
    ];
    $attributes = wp_parse_args( $attributes, $defaults );

    $args = [
        'post_type'      => 'product',
        'posts_per_page' => intval( $attributes['productsPerPage'] ),
        'post_status'    => 'publish',
    ];

    switch ( $attributes['productType'] ) {
        case 'featured':
            $args['tax_query'][] = [
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN',
            ];
            break;

        case 'best_selling':
            $args['meta_key'] = 'total_sales';
            $args['orderby']  = 'meta_value_num';
            $args['order']    = 'DESC';
            break;

        case 'category':
            if ( ! empty( $attributes['categories'] ) ) {
                $args['tax_query'][] = [
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => array_map( 'intval', $attributes['categories'] ),
                ];
            }
            break;

        case 'tag':
            if ( ! empty( $attributes['tags'] ) ) {
                $args['tax_query'][] = [
                    'taxonomy' => 'product_tag',
                    'field'    => 'term_id',
                    'terms'    => array_map( 'intval', $attributes['tags'] ),
                ];
            }
            break;

        case 'custom':
            if ( ! empty( $attributes['includeProducts'] ) ) {
                $args['post__in'] = array_map( 'intval', $attributes['includeProducts'] );
                $args['orderby']  = 'post__in';
            }
            break;
    }

    ob_start();
    $query = new WP_Query( $args );
    ?><div class="container-fluid"><?php
    if ( $query->have_posts() ) {
        // Standard WooCommerce wrappers
        woocommerce_product_loop_start();

        while ( $query->have_posts() ) {
            $query->the_post();

            /**
             * Load the default WooCommerce product card (content-product.php)
             * This ensures the theme's styling and hooks are respected.
             */
            wc_get_template_part( 'content', 'product');
        }

        woocommerce_product_loop_end();
    } else {
        echo '<p>' . esc_html__( 'No products found.', 'creative-furniture' ) . '</p>';
    }
    ?></div><?php
    wp_reset_postdata();
    return ob_get_clean();
}

add_action('wp_ajax_update_cart_item', 'creative_furniture_update_cart_item');
add_action('wp_ajax_nopriv_update_cart_item', 'creative_furniture_update_cart_item');

function creative_furniture_update_cart_item() {
    check_ajax_referer('update-cart', 'nonce');
    $key      = sanitize_text_field($_POST['cart_item_key'] ?? '');
    $quantity = intval($_POST['quantity'] ?? 1);
    if (!$key || $quantity < 1) {
        wp_send_json_error(['message' => 'Invalid data']);
    }
    WC()->cart->set_quantity($key, $quantity, true);
    WC()->cart->calculate_totals();
    wp_send_json_success(['message' => 'Cart updated']);
}



// function custom_gutenberg_heartbeat_settings( $settings ) {
//     global $pagenow;
//     if ( $pagenow !== 'post.php' && $pagenow !== 'post-new.php' ) {
//         return $settings;
//     }
//     if ( ! use_block_editor_for_post( get_post_type() ) ) {
//         return $settings;
//     }
//     $settings['interval'] = 120;
//     return $settings;
// }
// add_filter('heartbeat_settings', 'custom_gutenberg_heartbeat_settings');


add_action( 'init', function() {
    wp_deregister_script( 'heartbeat');
});
add_action( 'admin_init', function() {
    wp_deregister_script('autosave');
});
add_filter('wp_revisions_to_keep', '__return_zero');
add_filter('auto_save_interval', '__return_zero');
defined('WP_POST_REVISIONS') || define('WP_POST_REVISIONS', false);

