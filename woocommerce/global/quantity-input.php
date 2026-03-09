<?php
/**
 * Product quantity input
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 *
 * @var bool   $readonly If the input should be readonly.
 * @var string $type     Input type.
 */

defined( 'ABSPATH' ) || exit;

/* %2$s: Quantity unit, if any */
$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%1$s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'woocommerce' );

?>
<div class="quantity border-solid border-[#dbdbdb] border pt-1.5 pr-3 pb-1.5 pl-3 flex flex-row gap-3 items-center justify-center shrink-0 relative">
    <?php do_action( 'woocommerce_before_quantity_input_field' ); ?>
    
    <button type="button" class="plus flex flex-row gap-[8.33px] items-center justify-start shrink-0 relative bg-transparent border-0 p-0 cursor-pointer">
        <svg class="shrink-0 w-5 h-5 relative overflow-visible" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 10.625H5C4.65833 10.625 4.375 10.3417 4.375 10C4.375 9.65833 4.65833 9.375 5 9.375H15C15.3417 9.375 15.625 9.65833 15.625 10C15.625 10.3417 15.3417 10.625 15 10.625Z" fill="#292D32"></path>
            <path d="M10 15.625C9.65833 15.625 9.375 15.3417 9.375 15V5C9.375 4.65833 9.65833 4.375 10 4.375C10.3417 4.375 10.625 4.65833 10.625 5V15C10.625 15.3417 10.3417 15.625 10 15.625Z" fill="#292D32"></path>
        </svg>
    </button>

    <div class="qty-display text-[rgba(0,0,0,0.70)] text-center font-['Aspekta-500',_sans-serif] text-sm font-normal relative min-w-[20px]">
        <?php echo $input_value; ?>
    </div>

    <button type="button" class="minus flex flex-row gap-[8.33px] items-center justify-start shrink-0 relative bg-transparent border-0 p-0 cursor-pointer">
        <svg class="shrink-0 w-5 h-5 relative overflow-visible" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15 10.625H5C4.65833 10.625 4.375 10.3417 4.375 10C4.375 9.65833 4.65833 9.375 5 9.375H15C15.3417 9.375 15.625 9.65833 15.625 10C15.625 10.3417 15.3417 10.625 15 10.625Z" fill="#292D32"></path>
        </svg>
    </button>

	<input
		type="<?php echo esc_attr( $type ); ?>"
		<?php echo $readonly ? 'readonly' : ''; ?>
		id="<?php echo esc_attr( $input_id ); ?>"
		class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?> qty hidden"
		name="<?php echo esc_attr( $input_name ); ?>"
		value="<?php echo esc_attr( $input_value ); ?>"
		aria-label="<?php echo esc_attr( $label ); ?>"
		title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ); ?>"
		size="4"
		min="<?php echo esc_attr( $min_value ); ?>"
		max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
		<?php if ( ! $readonly ) : ?>
			step="<?php echo esc_attr( $step ); ?>"
		<?php endif; ?>
		placeholder="<?php echo esc_attr( $placeholder ); ?>"
		inputmode="<?php echo esc_attr( $inputmode ); ?>"
		autocomplete="<?php echo esc_attr( $autocomplete ); ?>"
	/>
    
    <?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
</div>
