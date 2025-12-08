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
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Creative Furniture, use a find and replace
		* to change 'creative-furniture' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'creative-furniture', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus([
		'top-left-header-menu' => esc_html__('Header Top Left Menu', 'creative-furniture'),
		'header-mega-menu' => esc_html__('Header Mega Menu', 'creative-furniture'),
	]);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
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

	// Set up the WordPress core custom background feature.
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

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
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

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function creative_furniture_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'creative_furniture_content_width', 640 );
}
add_action( 'after_setup_theme', 'creative_furniture_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
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

/**
 * Enqueue scripts and styles.
 */
function creative_furniture_scripts() {
	// wp_enqueue_style( 'creative-furniture-style', get_stylesheet_uri(), [], _S_VERSION );
	// wp_style_add_data( 'creative-furniture-style', 'rtl', 'replace' );

	// wp_enqueue_script( 'creative-furniture-navigation', get_template_directory_uri() . '/js/navigation.js', [], _S_VERSION, true );
	if (file_exists(get_template_directory() . '/dist/css/public.css')) {
		wp_enqueue_style('creative-furniture-public', get_template_directory_uri() . '/dist/css/public.css', [], null, 'all');
	}
	wp_enqueue_style('creative-furniture-fonts', get_template_directory_uri() . '/dist/library/fonts/fonts.css', [], null, 'all');
	
	wp_enqueue_script( 'creative-furniture-public', get_template_directory_uri() . '/dist/js/public.js', [], _S_VERSION, true );
	wp_localize_script('creative-furniture-public', 'cfStore', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'add_to_cart_nonce' => wp_create_nonce('cf-add-to-cart'),
		'get_variation_nonce' => wp_create_nonce('cf-get-variation'),
		'update_cart_nonce' => is_cart() ? wp_create_nonce('update-cart') : '',
		'dist' => get_template_directory_uri() . '/dist',
	]);

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require_once get_template_directory() . '/inc/woocommerce.php';
	require_once get_template_directory() . '/inc/multi-currency.php';
	require_once get_template_directory() . '/inc/wishlist.php';
	require_once get_template_directory() . '/inc/seller-dashboard.php';
}



function footer_block_svg_icon_print($icon) {
	$icon_path = get_template_directory() . '/dist/icons/'. $icon .'.svg';
	if (file_exists($icon_path)) {
		echo file_get_contents($icon_path);return;
	}
	?>
	<img src="<?php echo esc_attr(get_template_directory_uri() . '/dist/icons/'. $icon .'.svg'); ?>" width="40" height="40" />
	<?php
}


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

// function custom_products_per_page() {
//     return isset($_GET['per_page']) ? intval($_GET['per_page']) : 20;
// }
// add_filter('loop_shop_per_page', 'custom_products_per_page', 20);