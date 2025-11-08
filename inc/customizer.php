<?php
/**
 * Creative Furniture Theme Customizer
 *
 * @package Creative_Furniture
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function creative_furniture_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'creative_furniture_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'creative_furniture_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'creative_furniture_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function creative_furniture_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function creative_furniture_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function creative_furniture_customize_preview_js() {
	wp_enqueue_script( 'creative-furniture-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'creative_furniture_customize_preview_js' );













// function creative_furniture_enqueue_product_card_assets() {
//     wp_enqueue_style(
//         'creative-product-card',
//         get_template_directory_uri() . '/assets/css/product-card.css',
//         [],
//         '1.0.0'
//     );
    
//     wp_enqueue_script(
//         'creative-product-card',
//         get_template_directory_uri() . '/assets/js/product-card.js',
//         ['jquery'],
//         '1.0.0',
//         true
//     );
    
//     wp_localize_script(
//         'creative-product-card',
//         'creativeFurnitureAjax',
//         [
//             'ajaxurl' => admin_url('admin-ajax.php'),
//             'nonce' => wp_create_nonce('creative_wishlist_nonce')
//         ]
//     );
// }
// add_action('wp_enqueue_scripts', 'creative_furniture_enqueue_product_card_assets');

function creative_furniture_customizer_product_card($wp_customize) {
    $wp_customize->add_section('product_card_settings', [
        'title' => __('Product Card Settings', 'creative-furniture'),
        'priority' => 30,
    ]);
    
    $wp_customize->add_setting('product_card_style', [
        'default' => 'style1',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    
    $wp_customize->add_control('product_card_style', [
        'label' => __('Product Card Style', 'creative-furniture'),
        'section' => 'product_card_settings',
        'type' => 'select',
        'choices' => [
            'style1' => __('Style 1 - Hover Image Change', 'creative-furniture'),
            'style2' => __('Style 2 - Image Slider', 'creative-furniture'),
        ],
    ]);
}
add_action('customize_register', 'creative_furniture_customizer_product_card');

function creative_furniture_toggle_wishlist() {
    check_ajax_referer('creative_wishlist_nonce', 'nonce');
    
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $add = isset($_POST['add']) ? intval($_POST['add']) : 0;
    
    if (!$product_id) {
        wp_send_json_error(['message' => 'Invalid product ID']);
    }
    
    $wishlist = get_user_meta(get_current_user_id(), '_creative_wishlist', true);
    if (!is_array($wishlist)) {
        $wishlist = [];
    }
    
    if ($add) {
        if (!in_array($product_id, $wishlist)) {
            $wishlist[] = $product_id;
        }
    } else {
        $wishlist = array_diff($wishlist, [$product_id]);
    }
    
    update_user_meta(get_current_user_id(), '_creative_wishlist', array_values($wishlist));
    
    wp_send_json_success([
        'message' => $add ? 'Added to wishlist' : 'Removed from wishlist',
        'wishlist_count' => count($wishlist)
    ]);
}
add_action('wp_ajax_toggle_wishlist', 'creative_furniture_toggle_wishlist');
add_action('wp_ajax_nopriv_toggle_wishlist', 'creative_furniture_toggle_wishlist');

function creative_furniture_get_wishlist_count() {
    if (!is_user_logged_in()) {
        return 0;
    }
    
    $wishlist = get_user_meta(get_current_user_id(), '_creative_wishlist', true);
    return is_array($wishlist) ? count($wishlist) : 0;
}

function creative_furniture_is_in_wishlist($product_id) {
    if (!is_user_logged_in()) {
        return false;
    }
    
    $wishlist = get_user_meta(get_current_user_id(), '_creative_wishlist', true);
    return is_array($wishlist) && in_array($product_id, $wishlist);
}



