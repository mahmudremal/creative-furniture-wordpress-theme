<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Creative_Furniture
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses creative_furniture_header_style()
 */
function creative_furniture_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'creative_furniture_custom_header_args',
			array(
				'default-image'      => '',
				'default-text-color' => '000000',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'wp-head-callback'   => 'creative_furniture_header_style',
			)
		)
	);
}
add_action( 'after_setup_theme', 'creative_furniture_custom_header_setup' );

if ( ! function_exists( 'creative_furniture_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see creative_furniture_custom_header_setup().
	 */
	function creative_furniture_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;

require_once __DIR__ . '/MegaMenuWalker.php';
// add_filter('wp_edit_nav_menu_walker', function () {
//     return 'CF_MegaMenuWalker';
// });

add_action('wp_ajax_mega_menu_content', function () {
    // check_ajax_referer('save-mega-menu-content');
    $id      = intval($_GET['menu_item_id']);
    $content = get_post_meta($id, '_mega_menu_content', true);

    wp_send_json_success(['content' => (string) $content]);
});
add_action('wp_ajax_save_mega_menu_content', function () {
    // check_ajax_referer('save-mega-menu-content');
    $id      = intval($_POST['menu_item_id']);
    $content = wp_kses_post($_POST['content']);

    update_post_meta($id, '_mega_menu_content', $content);

    wp_send_json_success();
});

add_filter('walker_nav_menu_start_el', function ($item_output, $item, $depth, $args) {

    if ($args->menu_id !== 'mega-menu') return $item_output;

    $content = get_post_meta($item->ID, '_mega_menu_content', true);

    if ($content) {
        $item_output .= '<div class="mega-menu-panel">' . do_shortcode($content) . '</div>';
    }

    return $item_output;

}, 10, 4);

