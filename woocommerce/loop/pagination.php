<?php
defined( 'ABSPATH' ) || exit;

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
    return;
}
?>
<nav class="woocommerce-pagination">
    <?php
    echo paginate_links(
        apply_filters(
            'woocommerce_pagination_args',
            [
                'base'      => $base,
                'format'    => $format,
                'add_args'  => false,
                'current'   => max( 1, $current ),
                'total'     => $total,
                'prev_text' => '<svg width="8" height="14" viewBox="0 0 8 14" fill="none"><path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                'next_text' => '<svg width="8" height="14" viewBox="0 0 8 14" fill="none"><path d="M1 1L7 7L1 13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                'type'      => 'list',
                'end_size'  => 1,
                'mid_size'  => 2,
            ]
        )
    );
    ?>
</nav>