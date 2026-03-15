<?php
/**
 * Creative Furniture functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Creative_Furniture
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function creative_furniture_setup() {
	load_theme_textdomain( 'creative-furniture', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus([
		'language-switcher-menu' => esc_html__('Language Switcher Menu', 'creative-furniture'),
		'top-left-header-menu' => esc_html__('Header Top Left Menu', 'creative-furniture'),
		'header-mega-menu' => esc_html__('Header Mega Menu', 'creative-furniture'),
	]);
	add_theme_support(
		'html5',
		[
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		]
	);
	add_theme_support(
		'custom-background',
		apply_filters(
			'creative_furniture_custom_background_args',
			[
				'default-color' => 'ffffff',
				'default-image' => '',
			]
		)
	);
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support(
		'custom-logo',
		[
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		]
	);
}
add_action( 'after_setup_theme', 'creative_furniture_setup' );
function creative_furniture_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'creative_furniture_content_width', 640 );
}
add_action( 'after_setup_theme', 'creative_furniture_content_width', 0 );
function creative_furniture_widgets_init() {
	register_sidebar(
		[
			'name'          => esc_html__( 'Sidebar', 'creative-furniture' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'creative-furniture' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		]
	);
}
add_action( 'widgets_init', 'creative_furniture_widgets_init' );
function creative_furniture_scripts() {
	// wp_enqueue_style( 'creative-furniture-style', get_stylesheet_uri(), [], _S_VERSION );
	// wp_style_add_data( 'creative-furniture-style', 'rtl', 'replace' );

	// wp_enqueue_script( 'creative-furniture-navigation', get_template_directory_uri() . '/js/navigation.js', [], _S_VERSION, true );
	if (file_exists(get_template_directory() . '/dist/css/public.css')) {
		wp_enqueue_style('creative-furniture-public', get_template_directory_uri() . '/dist/css/public.css', [], filemtime(get_template_directory() . '/dist/css/public.css'), 'all');
	}
	wp_enqueue_style('creative-furniture-fonts', get_template_directory_uri() . '/dist/library/fonts/fonts.css', [], filemtime(get_template_directory() . '/dist/library/fonts/fonts.css'), 'all');
	
	wp_enqueue_script( 'creative-furniture-tailwindcdn', get_template_directory_uri() . '/js/tailwindcss.js', [], _S_VERSION, true );
	wp_enqueue_style('creative-furniture-styling', get_template_directory_uri() . '/styling.css', [], filemtime(get_template_directory() . '/styling.css'), 'all');
	
	
	wp_enqueue_style('blaze-slider', get_template_directory_uri() . '/dist/library/css/blaze.css', [], false, 'all');
	wp_enqueue_style('intl-tel-input', get_template_directory_uri() . '/dist/library/css/intlTelInput.css', [], false, 'all');
	wp_enqueue_script( 'intl-tel-input', get_template_directory_uri() . '/dist/library/js/intlTelInput.min.js', [], false, true );
	wp_enqueue_script( 'blaze-slider', get_template_directory_uri() . '/dist/library/js/blaze-slider.min.js', [], false, true );
	wp_enqueue_script( 'blaze', get_template_directory_uri() . '/dist/js/blaze.js', [], filemtime(get_template_directory() . '/dist/js/blaze.js'), true );
	wp_enqueue_script( 'creative-furniture-public', get_template_directory_uri() . '/dist/js/public.js', [], filemtime(get_template_directory() . '/dist/js/public.js'), true );
	wp_localize_script('creative-furniture-public', 'cfStore', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'add_to_cart_nonce' => wp_create_nonce('cf-add-to-cart'),
		'get_variation_nonce' => wp_create_nonce('cf-get-variation'),
		'update_cart_nonce' => is_cart() ? wp_create_nonce('update-cart') : '',
		'dist' => get_template_directory_uri() . '/dist',
	]);
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/dist/library/js/popper.min.js', [], false, true );
	wp_enqueue_script( 'tippy', get_template_directory_uri() . '/dist/library/js/tippy.js', [], false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script('comment-reply');
	}
}
add_action( 'wp_enqueue_scripts', 'creative_furniture_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Block Patterns
 */
require get_template_directory() . '/inc/patterns.php';

/**
 * Credits and dev informations.
 */
require get_template_directory() . '/inc/credits.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
// if ( class_exists( 'WooCommerce' ) ) {
	require_once get_template_directory() . '/inc/woocommerce.php';
	require_once get_template_directory() . '/inc/multi-currency.php';
	require_once get_template_directory() . '/inc/wishlist.php';
	require_once get_template_directory() . '/inc/seller-dashboard.php';
	require_once get_template_directory() . '/inc/seller-registration.php';
	require_once get_template_directory() . '/inc/contact-us.php';
	require_once get_template_directory() . '/inc/reviews.php';
	require_once get_template_directory() . '/inc/checkout.php';
	require_once get_template_directory() . '/inc/reward-points.php';
// }



function footer_block_svg_icon_print($icon) {
	$icon_path = get_template_directory() . '/dist/icons/'. $icon .'.svg';
	if (file_exists($icon_path)) {
		echo file_get_contents($icon_path);return;
	}
	?>
	<img src="<?php echo esc_attr(get_template_directory_uri() . '/dist/icons/'. $icon .'.svg'); ?>" width="40" height="40" />
	<?php
}



// add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );
// add_filter( 'woocommerce_admin_disabled', '__return_true' );
// update_option('woocommerce_onboarding_opt_out_given', 'yes');
// delete_option('woocommerce_setup_page_redirect');
// add_action( 'init', function () {

//     // Prevent running again
//     if ( get_option( 'rimu_wc_onboarding_done' ) ) {
//         return;
//     }

//     // Dummy store settings
//     update_option( 'woocommerce_store_address', '123 Demo Street' );
//     update_option( 'woocommerce_store_address_2', '' );
//     update_option( 'woocommerce_store_city', 'Dhaka' );
//     update_option( 'woocommerce_default_country', 'BD:D' );
//     update_option( 'woocommerce_store_postcode', '1200' );
//     update_option( 'woocommerce_currency', 'USD' );
//     update_option( 'woocommerce_product_type', 'physical' );

//     // Mark onboarding wizard as completed
//     update_option( 'woocommerce_onboarding_profile', array(
//         'completed'     => true,
//         'industry'      => array( 'other' ),
//         'product_types' => array( 'physical' ),
//         'selling_venues'=> array(),
//         'setup_client'  => false,
//     ) );

//     // Hide WooCommerce task list
//     update_option( 'woocommerce_task_list_hidden', 'yes' );
//     update_option( 'woocommerce_task_list_tracked_started_tasks', array() );
//     update_option( 'woocommerce_task_list_completed_tasks', array(
//         'store_details',
//         'purchase',
//         'products',
//         'appearance',
//         'shipping',
//         'tax',
//         'marketing',
//         'payments'
//     ) );

//     update_option( 'rimu_wc_onboarding_done', 1 );
// });


// function register_shop_filters_sidebar() {
//     register_sidebar([
//         'name' => 'Shop Filters',
//         'id' => 'shop-filters',
//         'before_widget' => '<div class="filter-widget %2$s">',
//         'after_widget' => '</div>',
//         'before_title' => '<h3 class="filter-title">',
//         'after_title' => '</h3>',
//     ]);
// }
// add_action('widgets_init', 'register_shop_filters_sidebar');

function custom_products_per_page() {
    return isset($_GET['per_page']) ? intval($_GET['per_page']) : 20;
}
add_filter('loop_shop_per_page', 'custom_products_per_page', 20);








function my_custom_menu_scripts_and_styles( $hook_suffix ) {
    if ( 'nav-menus.php' !== $hook_suffix ) {
        return;
    }
    wp_enqueue_style(
        'creative-admin',
        get_template_directory_uri() . '/dist/css/admin.css',
        array(),
        '1.0.0'
    );
    wp_enqueue_script(
        'creative-admin',
        get_template_directory_uri() . '/dist/js/admin.js',
        array( 'jquery' ),
        '1.0.0',
        true
    );

	wp_localize_script('creative-admin', 'csStore', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'mega_menu_nonce' => wp_create_nonce('save-mega-menu-content'),
	]);
}
add_action( 'admin_enqueue_scripts', 'my_custom_menu_scripts_and_styles' );


add_action('rest_api_init', function () {
    register_rest_field('product', 'price_data', [
        'get_callback' => function ($post) {
            $product = wc_get_product($post['id']);
            if (!$product) return null;

            return [
                'price'         => $product->get_price(),
                'regular_price' => $product->get_regular_price(),
                'sale_price'    => $product->get_sale_price(),
                'on_sale'       => $product->is_on_sale(),
                'currency'      => get_woocommerce_currency(),
            ];
        },
        'schema' => null,
    ]);
});

/**
 * Include products and posts in search results, exclude pages.
 */
function creative_furniture_search_filter($query) {
    if ($query->is_search && !is_admin() && $query->is_main_query()) {
        $query->set('post_type', array('post', 'product', 'page'));
    }
    return $query;
}
add_filter('pre_get_posts', 'creative_furniture_search_filter');
function get_id_by_postmeta($value) {
    global $wpdb;

    return (int) $wpdb->get_var(
		$wpdb->prepare(
			"SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'src_site_obj_id' AND meta_value = %s LIMIT 1",
			$value
		)
	);
}
