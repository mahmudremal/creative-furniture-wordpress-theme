<?php
defined('ABSPATH') || exit;

get_header();

global $product;

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

<div class="max-w-[1440px] mx-auto px-4 md:px-6 py-6 lg:py-10">
    <?php while (have_posts()) : the_post(); $product = wc_get_product(get_the_ID()); ?>
        <div class="flex flex-col lg:flex-row gap-10 items-start justify-between">
            <div class="w-full lg:w-[789px] shrink-0">
                <?php wc_get_template('single-product/product-image.php'); ?>
            </div>
            <div class="w-full lg:w-[571px] flex flex-col gap-6">
                <form class="cart cf-cart-form flex flex-col gap-6" action="<?php echo esc_url( admin_url('admin-ajax.php?action=cf_add_to_cart') ); ?>" method="post" enctype='multipart/form-data'>
                    <input type="hidden" name="action" value="cf_add_to_cart">
                    <?php wp_nonce_field( 'cf_add_to_cart_nonce' ); ?>
                    <div class="flex flex-col gap-5">
                        <div class="flex flex-row items-start justify-between gap-4">
                            <h1 class="text-[#1a1a1a] text-left font-['Raleway-Bold',_sans-serif] text-2xl leading-[30px] font-bold flex-1">
                                <?php the_title(); ?>
                            </h1>
                            <button type="button" class="bg-[#f6f6f6] rounded-full p-2.5 flex items-center justify-center shrink-0 product-wishlist-btn <?php echo esc_attr(function_exists('cf_wishlist_is_in_wishlist') && cf_wishlist_is_in_wishlist($product->get_id()) ? 'active' : ''); ?>" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>">
                                <svg class="w-5 h-5 transition-colors <?php echo esc_attr(function_exists('cf_wishlist_is_in_wishlist') && cf_wishlist_is_in_wishlist($product->get_id()) ? 'fill-[#bd262a] stroke-[#bd262a]' : 'stroke-[#717171]'); ?>" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.99413 4.27985C8.328 2.332 5.54963 1.80804 3.46208 3.59168C1.37454 5.37532 1.08064 8.35748 2.72 10.467C4.08302 12.2209 8.20798 15.9201 9.55992 17.1174C9.71117 17.2513 9.7868 17.3183 9.87501 17.3446C9.95201 17.3676 10.0363 17.3676 10.1132 17.3446C10.2015 17.3183 10.2771 17.2513 10.4283 17.1174C11.7803 15.9201 15.9052 12.2209 17.2683 10.467C18.9076 8.35748 18.6496 5.35656 16.5262 3.59168C14.4028 1.8268 11.6603 2.332 9.99413 4.27985Z" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <?php if ($product->is_type('variable')) : ?>
                        <div class="flex flex-col gap-6">
                            <?php
                            $attributes = $product->get_variation_attributes();
                            $available_variations = $product->get_available_variations();
                            foreach ($attributes as $attribute_name => $options) :
                                $attribute_label = wc_attribute_label($attribute_name);
                                $is_taxonomy = taxonomy_exists($attribute_name);
                                $attribute_slug = sanitize_title($attribute_name);
                                $is_color = (strpos(strtolower($attribute_label), 'color') !== false || strpos(strtolower($attribute_slug), 'color') !== false);
                                ?>
                                <div class="flex flex-col gap-3">
                                    <label class="text-[#000000] font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold">
                                        <?php echo esc_html($attribute_label); ?>
                                    </label>
                                    <div class="flex flex-row flex-wrap gap-3 items-center justify-start">
                                        <?php foreach ($options as $option) :
                                            $label = $option;
                                            if ($is_taxonomy) {
                                                $term = get_term_by('slug', $option, $attribute_name);
                                                if ($term) {
                                                    $label = $term->name;
                                                }
                                            }
                                            if ($is_color) :
                                                $image_url = '';
                                                foreach ($available_variations as $variation) {
                                                    if (isset($variation['attributes']['attribute_' . $attribute_name]) && $variation['attributes']['attribute_' . $attribute_name] === $option) {
                                                        $image_url = !empty($variation['image']['thumb_src']) ? $variation['image']['thumb_src'] : '';
                                                        break;
                                                    }
                                                }
                                                ?>
                                                <button type="button" class="flex flex-col gap-1 items-center justify-center cursor-pointer group cf-variation-swatch" data-value="<?php echo esc_attr($option); ?>" name="<?php echo esc_attr($attribute_name); ?>">
                                                    <div class="w-14 h-12 border border-[#c4c4c4] group-[.active]:border-[#000000] relative overflow-hidden transition-colors flex items-center justify-center">
                                                        <?php if ($image_url) : ?>
                                                            <img class="w-full h-full object-cover" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($label); ?>">
                                                        <?php else : ?>
                                                            <div class="w-10 h-5" style="background-color: <?php echo esc_attr(strtolower($option)); ?>;"></div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <span class="text-[#000000] font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal">
                                                        <?php echo esc_html($label); ?>
                                                    </span>
                                                </button>
                                            <?php else : ?>
                                                <button type="button" class="border border-[#c4c4c4] group-[.active]:border-[#0c0a0a] px-4 py-2 flex items-center justify-center cursor-pointer transition-colors cf-variation-swatch group" data-value="<?php echo esc_attr($option); ?>" name="<?php echo esc_attr($attribute_name); ?>">
                                                    <span class="text-[#000000] text-center font-['Raleway-Regular',_sans-serif] text-base leading-6 font-normal uppercase">
                                                        <?php echo esc_html($label); ?>
                                                    </span>
                                                </button>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="flex flex-col gap-2">
                        <div class="cf-product-price text-[#3c3c3c] font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold">
                            <?php echo $product->get_price_html(); ?>
                        </div>
                    </div>
                    <div class="flex flex-row gap-4 items-stretch justify-start w-full min-h-[48px]">
                        <div class="border border-[#c4c4c4] px-4 flex flex-row gap-4 items-center justify-center shrink-0">
                            <button type="button" class="w-6 h-6 flex items-center justify-center cf-qty-minus">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12H19" stroke="#111111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <input type="number" name="quantity" class="cf-qty-input text-[#000000] text-center font-['Raleway-Regular',_sans-serif] text-base leading-6 font-normal w-10 bg-transparent border-none focus:ring-0 outline-none p-0 [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" value="1" min="1">
                            <button type="button" class="w-6 h-6 flex items-center justify-center cf-qty-plus">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="#111111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <button type="submit" class="cf-add-to-cart bg-[#0c0a0a] text-[#ffffff] font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold flex-1 flex flex-row gap-2 items-center justify-center transition-opacity hover:opacity-90 uppercase">
                            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.3335 7.50033V5.00033C13.3335 3.15938 11.8411 1.66699 10.0001 1.66699C8.1592 1.66699 6.66681 3.15938 6.66681 5.00033V7.50032M2.99348 8.62696L2.49348 13.9603C2.35132 15.4767 2.28023 16.2349 2.53185 16.8206C2.75289 17.335 3.14024 17.7604 3.63183 18.0285C4.19142 18.3337 4.95295 18.3337 6.47602 18.3337H13.5243C15.0473 18.3337 15.8089 18.3337 16.3685 18.0285C16.86 17.7604 17.2474 17.335 17.4684 16.8206C17.7201 16.2349 17.649 15.4767 17.5068 13.9603L17.0068 8.62696C16.8868 7.34645 16.8267 6.70619 16.5388 6.22213C16.2851 5.79581 15.9104 5.45458 15.4623 5.24186C14.9535 5.00033 14.3104 5.00033 13.0243 5.00033L6.97602 5.00033C5.68989 5.00033 5.04682 5.00033 4.53799 5.24186C4.08987 5.45458 3.71515 5.79581 3.46153 6.22213C3.17355 6.70619 3.11353 7.34645 2.99348 8.62696Z" stroke="white" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Add to Cart</span>
                        </button>
                    </div>
                    <a href="https://wa.me/971566736852" class="bg-[#f4f4f4] text-[#2b2b2b] font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold w-full h-12 flex items-center justify-center transition-colors hover:bg-[#e9e9e9]" target="_blank">
                        WhatsApp us for Customization
                    </a>
                    <div class="border-t border-[#dbdbdb] pt-3 flex flex-row items-center justify-between gap-4">
                        <?php 
                        $price = floatval($product->get_price());
                        $installment = $price / 4;
                        ?>
                        <div class="text-[#111111] font-['Raleway-Regular',_sans-serif] text-[13px] leading-5">
                            As low as <span class="font-bold">AED <?php echo number_format($installment, 2); ?>/month</span> or 4 interest-free payments. <a href="https://tabby.ai/en-AE/pay-later" target="_blank" class="font-bold underline">Learn More</a>
                        </div>
                        <div class="flex flex-row gap-2 items-center">
                            <div class="bg-[#60fdb2] rounded-full px-2 py-1 h-5 flex items-center justify-center">
                                <span class="text-[8px] font-bold text-[#292929] uppercase tracking-tighter">Tabby</span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="product_id" value="<?php echo esc_attr($product->get_id()); ?>">
                    <input type="hidden" name="variation_id" class="cf-variation-id" value="">
                </form>
                <div class="bg-[#ffffff] flex flex-col w-full border-t border-[#dbdbdb] mt-4">
                    <?php
                    $accordion_items = [
                        ['id' => 'description', 'title' => 'Description', 'content' => wp_kses_post(wpautop($product->get_description())), 'active' => true],
                        ['id' => 'additional', 'title' => 'Additional information', 'content' => wc_get_template_html('single-product/tabs/additional-information.php', ['product' => $product]), 'active' => false],
                        ['id' => 'care', 'title' => 'Care & Instructions', 'content' => wp_kses_post(wpautop(get_post_meta(get_the_ID(), '_care_instructions', true) ?: 'Care instructions coming soon.')), 'active' => false],
                        ['id' => 'warranty', 'title' => 'Warranty & Installation', 'content' => wp_kses_post(wpautop(get_post_meta(get_the_ID(), '_warranty_installation', true) ?: 'Warranty information coming soon.')), 'active' => false],
                        ['id' => 'tc', 'title' => 'T&C', 'content' => wp_kses_post(wpautop(get_post_meta(get_the_ID(), '_terms_conditions', true) ?: 'Terms & Conditions coming soon.')), 'active' => false],
                        ['id' => 'reviews', 'title' => 'Reviews', 'content' => wc_get_template_html('single-product/tabs/reviews.php', ['product' => $product]), 'active' => false],
                    ];
                    foreach ($accordion_items as $item) : ?>
                        <div class="cf-accordion-item border-b border-[#dbdbdb] <?php echo $item['active'] ? 'cf-accordion-active' : ''; ?>">
                            <button type="button" class="cfr-accordion-header w-full py-4 flex flex-row items-center justify-between group">
                                <span class="text-[#1f1f1f] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold"><?php echo esc_html($item['title']); ?></span>
                                <span class="cf-accordion-icons">
                                    <svg class="cf-accordion-icon-minus w-7 h-7 <?php echo $item['active'] ? '' : 'hidden'; ?>" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.8335 14H22.1668" stroke="#737373" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <svg class="cf-accordion-icon-plus w-7 h-7 <?php echo $item['active'] ? 'hidden' : ''; ?>" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.0002 5.83301V22.1663M5.8335 13.9997H22.1668" stroke="#737373" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                            </button>
                            <div class="cf-accordion-content <?php echo $item['active'] ? 'pb-5' : 'h-0 overflow-hidden'; ?>">
                                <div class="text-[#282828] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal flex flex-col gap-4">
                                    <?php echo $item['content']; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="mt-20">
            <?php woocommerce_output_related_products(); ?>
        </div>
    <?php endwhile; ?>
</div>


<?php get_footer(); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const changeStatus = (item, hide = false) => {
        const content = item.querySelector('.cf-accordion-content');
        const minusIcon = item.querySelector('.cf-accordion-icon-minus');
        const plusIcon = item.querySelector('.cf-accordion-icon-plus');
        if (hide) {
            content.classList.add('h-0', 'overflow-hidden');
            content.classList.remove('pb-5');
            minusIcon.classList.add('hidden');
            plusIcon.classList.remove('hidden');
        } else {
            content.classList.remove('h-0', 'overflow-hidden');
            content.classList.add('pb-5');
            minusIcon.classList.remove('hidden');
            plusIcon.classList.add('hidden');
        }
    }
    document.querySelectorAll('.cfr-accordion-header').forEach(header => {
        header.addEventListener('click', function() {
            const item = header.parentElement;
            item.parentElement.querySelectorAll('.cf-accordion-item:not(.hidden)').forEach(i => changeStatus(i, true));
            const isActive = item.classList.contains('cf-accordion-active');
            changeStatus(item, isActive);
        });
    });
});
</script>