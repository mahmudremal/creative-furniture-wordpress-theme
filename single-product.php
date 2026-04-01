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
$demoVariations = true;

?>

<div class="px-4 py-6 lg:py-10 w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
    <?php while (have_posts()) : the_post(); $product = wc_get_product(get_the_ID()); ?>
        <div class="grid grid-cols-1 xl:grid-cols-[1.38fr_1fr] gap-10 items-start justify-between">
            <div class="w-full">
                <?php wc_get_template('single-product/product-image.php'); ?>
            </div>
            <div class="w-full flex flex-col gap-6">
                <form class="cart cf-cart-form flex flex-col gap-6" action="<?php echo esc_url( admin_url('admin-ajax.php?action=cf_add_to_cart') ); ?>" method="post" enctype='multipart/form-data'>
                    <input type="hidden" name="action" value="cf_add_to_cart">
                    <?php wp_nonce_field( 'cf_add_to_cart_nonce' ); ?>
                    <div class="flex flex-col gap-5">
                        <div class="flex flex-row items-start justify-between gap-4">
                            <h1 class="text-[#1a1a1a] text-left font-['Raleway-Bold',_sans-serif] text-xl sm:text-2xl leading-[30px] font-bold flex-1">
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
                    <?php elseif ($demoVariations): ?>
                        <div class="flex flex-col gap-3 items-start justify-start shrink-0 relative">
                            <div class="text-[#000000] text-center font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative flex items-center justify-center">
                                Color
                            </div>
                            <div class="bg-[#ffffff] flex flex-row gap-3 items-center justify-start shrink-0 relative">
                                <div class="flex flex-col gap-[3px] items-center justify-center shrink-0 relative cursor-pointer cf-demo-selectable group">
                                    <div class="border-solid border-[#c4c4c4] group-[.active]:border-[#000000] border shrink-0 w-14 h-12 relative overflow-hidden transition-colors"></div>
                                    <div class="text-[#000000] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative">
                                        Red
                                    </div>
                                </div>
                                <div class="flex flex-col gap-[3px] items-center justify-center shrink-0 relative cursor-pointer cf-demo-selectable group">
                                    <div class="border-solid border-[#c4c4c4] group-[.active]:border-[#000000] border shrink-0 w-14 h-12 relative overflow-hidden transition-colors"></div>
                                    <div class="text-[#000000] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative">
                                        Blue
                                    </div>
                                </div>
                                <div class="flex flex-col gap-[3px] items-center justify-center shrink-0 relative cursor-pointer cf-demo-selectable group active">
                                    <div class="border-solid border-[#c4c4c4] group-[.active]:border-[#000000] border shrink-0 w-14 h-12 relative overflow-hidden transition-colors">
                                        <img class="w-10 h-5 absolute left-[50%] top-[50%]" style="
                                            translate: -50% -50%;
                                            object-fit: cover;
                                            aspect-ratio: 2/1;
                                        " src="image-2633.png">
                                    </div>
                                    <div class="text-[#000000] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative">
                                        Grey
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="flex flex-col gap-3 items-start justify-start shrink-0 relative">
                            <div class="text-[#000000] text-center font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative flex items-center justify-center">
                                Seating Capacity
                            </div>
                            <div class="flex flex-row gap-3 items-start justify-start shrink-0 relative">
                                <div class="border-solid border-[#c4c4c4] group-[.active]:border-[#0c0a0a] border pt-2 pr-4 pb-2 pl-4 flex flex-row gap-4 items-center justify-center shrink-0 relative cursor-pointer cf-demo-selectable group transition-colors">
                                    <div class="text-[#000000] text-center font-['Raleway-Regular',_sans-serif] text-base leading-6 font-normal relative">
                                        1 Seater
                                    </div>
                                </div>
                                <div class="border-solid border-[#c4c4c4] group-[.active]:border-[#0c0a0a] border pt-2 pr-4 pb-2 pl-4 flex flex-row gap-4 items-center justify-center shrink-0 relative cursor-pointer cf-demo-selectable group transition-colors">
                                    <div class="text-[#000000] text-center font-['Raleway-Regular',_sans-serif] text-base leading-6 font-normal relative">
                                        2 Seater
                                    </div>
                                </div>
                                <div class="border-solid border-[#c4c4c4] group-[.active]:border-[#0c0a0a] border pt-2 pr-4 pb-2 pl-4 flex flex-row gap-4 items-center justify-center shrink-0 relative cursor-pointer cf-demo-selectable group transition-colors active">
                                    <div class="text-[#000000] text-center font-['Raleway-Regular',_sans-serif] text-base leading-6 font-normal relative">
                                        3 Seater
                                    </div>
                                </div>
                            </div>
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
                        <div class="flex flex-row gap-2 items-center justify-start shrink-0 relative">
                            <div class="bg-[#60fdb2] rounded-[86.67px] pt-[5.33px] pr-[6.67px] pb-[5.33px] pl-[6.67px] flex flex-col gap-[6.67px] items-start justify-start shrink-0 h-5 relative">
                                <svg class="shrink-0 w-[35.2px] h-[10.29px] relative overflow-visible" width="36" height="11" viewBox="0 0 36 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M31.0525 2.04771L28.9012 10.2645V10.2904H30.586L32.7374 2.07363H31.0525V2.04771ZM4.45824 6.71338C4.19903 6.84298 3.93983 6.89482 3.6547 6.89482C3.05854 6.89482 2.72157 6.79114 2.66973 6.29865V6.27273C2.66973 6.24681 2.66973 6.24681 2.66973 6.22089V4.79527V4.63975V3.62885V3.21413V3.05861V2.09955L1.16635 2.28099C2.17724 2.07363 2.74749 1.29602 2.74749 0.492488V0H1.06267V2.30691L0.958984 2.33283V6.58378C1.01083 7.77611 1.81436 8.50188 3.08446 8.50188C3.55102 8.50188 4.04351 8.3982 4.43232 8.21676L4.45824 6.71338Z" fill="#292929"></path>
                                    <path d="M4.71751 1.73678L0 2.46255V3.65489L4.71751 2.92912V1.73678ZM4.71751 3.49937L0 4.22514V5.36563L4.71751 4.63986V3.49937ZM10.0053 4.04369C9.9275 2.72176 9.09805 1.91822 7.75019 1.91822C6.97258 1.91822 6.32457 2.22927 5.88393 2.79952C5.44328 3.36976 5.21 4.19922 5.21 5.21011C5.21 6.22101 5.44328 7.05046 5.88393 7.62071C6.32457 8.19095 6.97258 8.47608 7.75019 8.47608C9.09805 8.47608 9.9275 7.69847 10.0053 6.35061V8.34648H11.6901V2.07374L10.0053 2.33295V4.04369ZM10.1089 5.21011C10.1089 6.37653 9.48686 7.15414 8.52781 7.15414C7.54283 7.15414 6.94666 6.42837 6.94666 5.21011C6.94666 3.99185 7.54283 3.26608 8.52781 3.26608C8.99437 3.26608 9.4091 3.44753 9.69422 3.81041C9.95343 4.14738 10.1089 4.63986 10.1089 5.21011ZM16.589 1.91822C15.2412 1.91822 14.4117 2.69584 14.334 4.04369V0.233398L12.6491 0.492602V8.34648H14.334V6.35061C14.4117 7.69847 15.2412 8.47608 16.589 8.47608C18.1702 8.47608 19.1292 7.25782 19.1292 5.21011C19.1292 3.1624 18.1702 1.91822 16.589 1.91822ZM15.8374 7.15414C14.8783 7.15414 14.2562 6.40245 14.2562 5.21011C14.2562 4.63986 14.4117 4.14738 14.6709 3.81041C14.9561 3.44753 15.3449 3.26608 15.8374 3.26608C16.8223 3.26608 17.4185 3.99185 17.4185 5.21011C17.4185 6.42837 16.8223 7.15414 15.8374 7.15414ZM23.6912 1.91822C22.3434 1.91822 21.5139 2.69584 21.4362 4.04369V0.233398L19.7513 0.492602V8.34648H21.4362V6.35061C21.5139 7.69847 22.3434 8.47608 23.6912 8.47608C25.2724 8.47608 26.2314 7.25782 26.2314 5.21011C26.2314 3.1624 25.2724 1.91822 23.6912 1.91822ZM22.9395 7.15414C21.9805 7.15414 21.3584 6.40245 21.3584 5.21011C21.3584 4.63986 21.5139 4.14738 21.7731 3.81041C22.0582 3.44753 22.447 3.26608 22.9395 3.26608C23.9245 3.26608 24.5207 3.99185 24.5207 5.21011C24.5207 6.42837 23.9245 7.15414 22.9395 7.15414ZM26.2314 2.04782H28.0199L29.4715 8.34648H27.8644L26.2314 2.04782ZM34.1112 2.69583V2.20335H33.9039V2.09967H34.4482V2.20335H34.2408V2.69583H34.1112ZM34.4741 2.69583V2.07374H34.6815L34.7852 2.35887C34.8111 2.43663 34.837 2.46255 34.837 2.48847C34.837 2.46255 34.8629 2.43663 34.8888 2.35887L34.9925 2.07374H35.1999V2.69583H35.0703V2.20335L34.8888 2.69583H34.7592L34.6037 2.20335V2.69583H34.4741Z" fill="#292929"></path>
                                </svg>
                            </div>
                            <img class="shrink-0 w-[61.68px] h-5 relative" style="object-fit: cover; aspect-ratio: 61.68/20" src="<?php echo esc_url( get_template_directory_uri() . '/dist/images/v2/image-2880.png'); ?>">
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
                                <span class="text-[#1f1f1f] text-left font-['Raleway-SemiBold',_sans-serif] text-sm sm:text-base leading-6 font-semibold"><?php echo esc_html($item['title']); ?></span>
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
                                <div class="text-[#282828] text-left font-['Raleway-Regular',_sans-serif] text-xs sm:text-sm leading-5 font-normal flex flex-col gap-4">
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

    document.querySelectorAll('.cf-demo-selectable').forEach(item => {
        item.addEventListener('click', function() {
            item.parentElement.querySelectorAll('.cf-demo-selectable').forEach(el => el.classList.remove('active'));
            item.classList.add('active');
        });
    });
});
</script>