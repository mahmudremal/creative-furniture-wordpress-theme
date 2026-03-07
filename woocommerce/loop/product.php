<?php
/**
 * Product Loop card
 *
 * @package Creative_Furniture
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! is_a( $product, WC_Product::class ) ) {
    return;
}

$product_id = $product->get_id();
$image_url = wp_get_attachment_image_url( $product->get_image_id(), 'woocommerce_thumbnail' );
if ( !$image_url ) {
    $image_url = wc_placeholder_img_src( 'woocommerce_thumbnail' );
}

$sale_percentage = 0;
if ( $product->is_on_sale() ) {
    $regular_price = (float) $product->get_regular_price();
    $sale_price = (float) $product->get_sale_price();
    if ( $regular_price > 0 ) {
        $sale_percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
    }
}

$variations_data = [];
if ( $product->is_type( 'variable' ) ) {
    $attributes = $product->get_variation_attributes();
    if ( isset( $attributes['pa_color'] ) ) {
        foreach ( $attributes['pa_color'] as $color_slug ) {
            $term = get_term_by( 'slug', $color_slug, 'pa_color' );
            if ( $term ) {
                $color_hex = get_term_meta( $term->term_id, 'color_hex', true );
                $variations_data[] = [
                    'slug' => $color_slug,
                    'hex' => $color_hex ?: '#000000',
                    'name' => $term->name,
                ];
            }
        }
    }
}
?>

<div class="flex flex-col gap-4 items-start justify-start -flex-1 relative group product-card" data-product-id="<?php echo esc_attr( $product_id ); ?>">
    <!-- Image Section -->
    <div class="self-stretch shrink-0 h-[294px] relative overflow-hidden bg-[#f4f4f4] rounded-sm">
        <a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" class="block w-full h-full">
            <img class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110" 
                src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>">
        </a>

        <!-- Discount Badge -->
        <?php if ( $sale_percentage > 0 ) : ?>
            <div class="bg-black py-1 px-2 absolute left-0 top-0 z-10">
                <span class="text-white font-bold text-xs leading-none">
                    -<?php echo esc_html( $sale_percentage ); ?>%
                </span>
            </div>
        <?php endif; ?>

        <!-- Wishlist Button -->
        <button type="button" class="bg-white rounded-full p-2 absolute right-4 top-4 z-10 shadow-sm hover:bg-[#bd262a] hover:text-white transition-all product-wishlist-btn <?php echo (function_exists('cf_wishlist_is_in_wishlist') && cf_wishlist_is_in_wishlist($product_id)) ? 'active text-red-600' : 'text-black'; ?>" data-product-id="<?php echo esc_attr($product_id); ?>">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99544 3.42388C6.66254 1.8656 4.43984 1.44643 2.76981 2.87334C1.09977 4.30026 0.864655 6.68598 2.17614 8.3736C3.26655 9.77674 6.56653 12.7361 7.64808 13.6939C7.76908 13.801 7.82958 13.8546 7.90015 13.8757C7.96175 13.8941 8.02914 13.8941 8.09074 13.8757C8.16131 13.8546 8.22181 13.801 8.34281 13.6939C9.42436 12.7361 12.7243 9.77674 13.8147 8.3736C15.1262 6.68598 14.9198 4.28525 13.2211 2.87334C11.5223 1.46144 9.32835 1.8656 7.99544 3.42388Z" stroke="currentColor" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </button>
        
        <!-- Quick View Overlay -->
        <div class="absolute bottom-0 left-0 w-full p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300 z-10">
            <button class="w-full bg-white text-black py-2 text-sm font-semibold uppercase tracking-wider shadow-lg hover:bg-black hover:text-white transition-colors product-quick-view-btn" data-product-id="<?php echo esc_attr($product_id); ?>">
                <?php echo esc_html__( 'Quick View', 'creative-furniture' ); ?>
            </button>
        </div>
    </div>

    <!-- Info Section -->
    <div class="flex flex-col gap-2 items-start justify-start self-stretch relative">
        <h3 class="text-[#141414] font-semibold text-sm leading-5 h-10 overflow-hidden line-clamp-2">
            <a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" class="hover:text-[#bd262a] transition-colors">
                <?php echo esc_html( $product->get_name() ); ?>
            </a>
        </h3>

        <!-- Variations Swatches -->
        <?php if ( !empty( $variations_data ) ) : ?>
            <div class="flex flex-row gap-3 items-center justify-start h-5">
                <div class="flex flex-row gap-1 items-center justify-start">
                    <?php foreach ( array_slice($variations_data, 0, 4) as $variation ) : ?>
                        <div class="rounded-full w-2.5 h-2.5 border border-black/10" 
                            style="background-color: <?php echo esc_attr( $variation['hex'] ); ?>"
                            title="<?php echo esc_attr( $variation['name'] ); ?>"></div>
                    <?php endforeach; ?>
                </div>
                <?php if ( count($variations_data) > 4 ) : ?>
                    <div class="text-[#3f3f3f] font-medium text-xs">
                        <?php echo esc_html__( '+ more options', 'creative-furniture' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Price Section -->
        <div class="flex flex-row gap-2 items-baseline">
            <?php if ( $product->is_on_sale() ) : ?>
                <div class="text-[#3f3f3f] font-bold text-base">
                    <?php echo wp_kses_post( wc_price( $product->get_sale_price() ) ); ?>
                </div>
                <div class="text-[#8f8f8f] text-sm line-through">
                    <?php echo wp_kses_post( wc_price( $product->get_regular_price() ) ); ?>
                </div>
            <?php else : ?>
                <div class="text-[#3f3f3f] font-bold text-base">
                    <?php echo wp_kses_post( $product->get_price_html() ); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
