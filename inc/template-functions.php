<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Creative_Furniture
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function creative_furniture_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'creative_furniture_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function creative_furniture_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'creative_furniture_pingback_header' );





function custom_order_tracking_rewrite_rule() {
    add_rewrite_rule('^order-tracking/?$', 'index.php?custom_order_tracking=1', 'top');
}
add_action('init', 'custom_order_tracking_rewrite_rule');
function custom_order_tracking_query_vars($vars) {
    $vars[] = 'custom_order_tracking';
    return $vars;
}
add_filter('query_vars', 'custom_order_tracking_query_vars');
function custom_order_tracking_template_include($template) {
    if (get_query_var('custom_order_tracking')) {
        $new_template = locate_template('order-tracking.php');
        if ($new_template) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'custom_order_tracking_template_include');
?>
