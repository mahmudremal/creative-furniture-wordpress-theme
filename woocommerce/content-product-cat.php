<?php
/**
 * Template for displaying product category thumbnails within loops
 * Copied and customized from WooCommerce
 *
 * @package YourTheme\WooCommerce
 */

defined( 'ABSPATH' ) || exit;

$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
$image_url    = wp_get_attachment_url( $thumbnail_id ) ?: 'https://placehold.co/336x340';
$category_link = get_term_link( $category, 'product_cat' );
?>

<li <?php wc_product_cat_class( 'shop-category-card', $category ); ?>>
    <div class="category-card-inner">
        <a href="<?php echo esc_url( $category_link ); ?>" class="category-image-wrap">
            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $category->name ); ?>">
            <span class="see-collections">See collections</span>
        </a>

        <h2 class="woocommerce-loop-category__title">
            <?php echo esc_html( $category->name ); ?>
        </h2>
    </div>
</li>
