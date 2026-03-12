<?php
/**
 * Custom “No Products Found” Template styled with Tailwind CSS
 */

defined('ABSPATH') || exit;
?>

<section class="flex flex-col items-center justify-center text-center bg-[#F9F9F9] border border-[#f0f0f0] px-6 py-8 md:px-10 md:py-16 w-full md:w-[1440px] m-auto">
    <div class="mb-[40px] text-[#BD262A] opacity-80">
        <div class="relative w-20 h-20 mx-auto">
            <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" class="mx-auto">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
            </svg>
            <div class="absolute inset-0 flex items-center justify-center">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
            </div>
        </div>
    </div>

    <h2 class="text-[#141414] text-[32px] md:text-[40px] font-['Raleway-SemiBold',_sans-serif] font-semibold leading-tight mb-[16px]">
        <?php echo esc_html(__('No Search Results Found', 'creative-furniture')); ?>
    </h2>

    <p class="text-[#4D4D4D] text-base md:text-lg font-['Raleway-Regular',_sans-serif] leading-relaxed mb-[40px] max-w-[500px] mx-auto opacity-80">
        <?php echo esc_html(__("We couldn't find any products matching your specific selection. Try refining your filters or using different keywords.", 'creative-furniture')); ?>
    </p>

    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" 
       class="bg-[#000000] text-white pt-4 pr-10 pb-4 pl-10 flex flex-row gap-3 items-center justify-center transition-all duration-300 hover:bg-[#BD262A] group shadow-lg shadow-black/5">
        <span class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base font-semibold uppercase tracking-widest">
            <?php echo esc_html(__('Explore All Products', 'creative-furniture')); ?>
        </span>
        <svg class="shrink-0 w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </a>
</section>
