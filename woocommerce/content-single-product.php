<?php
defined( 'ABSPATH' ) || exit;

global $product;

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'max-w-[1440px] mx-auto px-4 md:px-6 py-10', $product ); ?>>

	<div class="flex flex-col lg:flex-row gap-10 items-start justify-between">
		<div class="w-full lg:w-[789px] shrink-0">
			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			do_action( 'woocommerce_before_single_product_summary' );
			?>
		</div>

		<div class="w-full lg:w-[571px] flex flex-col gap-6 summary entry-summary">
			<?php
			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_share - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			do_action( 'woocommerce_single_product_summary' );
			?>

            <div class="bg-[#ffffff] flex flex-col w-full border-t border-[#dbdbdb] mt-4">
                <?php
                /**
                 * Hook: woocommerce_after_single_product_summary.
                 *
                 * @hooked woocommerce_output_product_data_tabs - 10
                 * @hooked woocommerce_upsell_display - 15
                 * @hooked woocommerce_output_related_products - 20
                 */
                // We will handle accordion manually below or via hooks if preferred, 
                // but to match Figma exactly we'll implement it here or via a custom hook.
                ?>
                
                <?php
                $plus_minus_icons = '
                <span class="cf-accordion-icons">
                    <svg class="cf-accordion-icon-minus w-7 h-7" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.8335 14H22.1668" stroke="#737373" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <svg class="cf-accordion-icon-plus w-7 h-7 hidden" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.0002 5.83301V22.1663M5.8335 13.9997H22.1668" stroke="#737373" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                ';
                ?>

                <div class="cf-accordion-item border-b border-[#dbdbdb] cf-accordion-active">
                    <button type="button" class="cf-accordion-header w-full py-5 flex flex-row items-center justify-between group">
                        <span class="text-[#1f1f1f] text-left font-['Raleway-SemiBold',_sans-serif] text-sm sm:text-base leading-6 font-semibold">Description</span>
                        <?php echo $plus_minus_icons; ?>
                    </button>
                    <div class="cf-accordion-content pb-5">
                        <div class="text-[#282828] text-left font-['Raleway-Regular',_sans-serif] text-xs sm:text-sm leading-5 font-normal flex flex-col gap-4">
                            <?php echo wp_kses_post(wpautop($product->get_description())); ?>
                        </div>
                    </div>
                </div>

                <div class="cf-accordion-item border-b border-[#dbdbdb]">
                    <button type="button" class="cf-accordion-header w-full py-5 flex flex-row items-center justify-between group">
                        <span class="text-[#1f1f1f] text-left font-['Raleway-SemiBold',_sans-serif] text-sm sm:text-base leading-6 font-semibold">Additional information</span>
                        <?php echo $plus_minus_icons; ?>
                    </button>
                    <div class="cf-accordion-content pb-5 hidden">
                        <?php do_action('woocommerce_product_additional_information', $product); ?>
                    </div>
                </div>

                <div class="cf-accordion-item border-b border-[#dbdbdb]">
                    <button type="button" class="cf-accordion-header w-full py-5 flex flex-row items-center justify-between group">
                        <span class="text-[#1f1f1f] text-left font-['Raleway-SemiBold',_sans-serif] text-sm sm:text-base leading-6 font-semibold">Care & Instructions</span>
                        <?php echo $plus_minus_icons; ?>
                    </button>
                    <div class="cf-accordion-content pb-5 hidden">
                        <div class="text-[#282828] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal">
                            <?php echo wp_kses_post(wpautop(get_post_meta(get_the_ID(), '_care_instructions', true) ?: get_option('_care_instructions', 'Care instructions coming soon.'))); ?>
                        </div>
                    </div>
                </div>

                <div class="cf-accordion-item border-b border-[#dbdbdb]">
                    <button type="button" class="cf-accordion-header w-full py-5 flex flex-row items-center justify-between group">
                        <span class="text-[#1f1f1f] text-left font-['Raleway-SemiBold',_sans-serif] text-sm sm:text-base leading-6 font-semibold">Warranty & Installation</span>
                        <?php echo $plus_minus_icons; ?>
                    </button>
                    <div class="cf-accordion-content pb-5 hidden">
                        <div class="text-[#282828] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal">
                            <?php echo wp_kses_post(wpautop(get_post_meta(get_the_ID(), '_warranty_installation', true) ?: get_option('_warranty_installation', 'Warranty information coming soon.'))); ?>
                        </div>
                    </div>
                </div>

                <div class="cf-accordion-item border-b border-[#dbdbdb]">
                    <button type="button" class="cf-accordion-header w-full py-5 flex flex-row items-center justify-between group">
                        <span class="text-[#1f1f1f] text-left font-['Raleway-SemiBold',_sans-serif] text-sm sm:text-base leading-6 font-semibold">T&C</span>
                        <?php echo $plus_minus_icons; ?>
                    </button>
                    <div class="cf-accordion-content pb-5 hidden">
                        <div class="text-[#282828] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal">
                            <?php echo wp_kses_post(wpautop(get_post_meta(get_the_ID(), '_terms_conditions', true) ?: get_option('_terms_conditions', 'Terms & Conditions coming soon.'))); ?>
                        </div>
                    </div>
                </div>

                <div class="cf-accordion-item">
                    <button type="button" class="cf-accordion-header w-full py-5 flex flex-row items-center justify-between group">
                        <span class="text-[#1f1f1f] text-left font-['Raleway-SemiBold',_sans-serif] text-sm sm:text-base leading-6 font-semibold">Reviews</span>
                        <?php echo $plus_minus_icons; ?>
                    </button>
                    <div class="cf-accordion-content pb-5 hidden">
                        <?php comments_template(); ?>
                    </div>
                </div>
            </div>
		</div>
	</div>

    <div class="mt-20 border-t border-[#dbdbdb] pt-10">
        <?php
        /**
         * Hook: woocommerce_after_single_product.
         *
         * @hooked woocommerce_upsell_display - 10
         * @hooked woocommerce_output_related_products - 20
         */
        do_action( 'woocommerce_after_single_product' );
        ?>
    </div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
