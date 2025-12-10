<?php

class CF_MegaMenuWalker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = [] ) {
        // Prevent default <ul> submenu — mega menu replaces it.
        $output .= "";
    }

    public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {

        $mega_content = '';
        $has_mega     = false;

        // Load mega content (saved from admin)
        $saved = get_post_meta( $item->ID, '_mega_menu_content', true );

        if ( ! empty( $saved ) ) {
            $has_mega     = true;
            $mega_content = do_shortcode( $saved );
            // $mega_content = wp_kses_post( $saved );
        }

        $classes = empty( $item->classes ) ? [] : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        if ( $has_mega ) {
            $classes[] = 'has-mega';
        }

        $class_names = implode( ' ', array_map( 'sanitize_html_class', $classes ) );

        $output .= '<li class="' . $class_names . '">';

        // Link
        $atts = '';
        if ( ! empty( $item->url ) ) {
            $atts = ' href="' . esc_url( $item->url ) . '"';
        }

        $output .= '<a' . $atts . '>' . esc_html( $item->title ) . '</a>';

        // Append mega content panel
        if ( $has_mega ) {
            $output .= '<div class="mega-menu">';
            $output .= '<div class="mega-content">';
            $output .= $mega_content;
            $output .= '</div>';
            $output .= '</div>';
        }
    }

    public function end_el( &$output, $item, $depth = 0, $args = [] ) {
        $output .= "</li>";
    }

}
