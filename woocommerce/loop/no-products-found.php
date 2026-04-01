<?php
/**
 * Custom “No Products Found” Template styled with Tailwind CSS
 */

defined('ABSPATH') || exit;
?>

<section class="w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative px-4 md:px-0 py-20 md:py-32 flex flex-col items-center justify-center text-center">
    <div class="max-w-[640px] w-full flex flex-col items-center">
        <!-- SVG Icon -->
        <div class="mb-10 text-black/10">
            <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                <line x1="11" y1="8" x2="11" y2="14"></line>
                <line x1="8" y1="11" x2="14" y2="11"></line>
            </svg>
        </div>

        <h1 class="text-[#141414] text-3xl md:text-4xl font-['Raleway-SemiBold',_sans-serif] font-semibold mb-4">
            <?php echo esc_html(__('No Products Found', 'creative-furniture')); ?>
        </h1>

        <p class="text-[#4D4D4D] text-base md:text-lg font-['Raleway-Regular',_sans-serif] mb-12 opacity-80 leading-relaxed">
            <?php echo esc_html(__("We couldn't find any items matching your current search or filters. Try searching for something else or browse our categories.", 'creative-furniture')); ?>
        </p>

        <!-- Search Bar -->
        <div class="w-full mb-12">
            <form role="search" method="get" class="w-full" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <div class="relative group border-b border-[#d3d3d3] focus-within:border-black transition-colors py-3 px-1 flex items-center gap-4">
                    <input type="search" 
                        class="bg-transparent border-none focus:ring-0 text-black text-lg w-full outline-none placeholder:text-[#464646]/50 font-['Raleway-Regular',_sans-serif]" 
                        placeholder="<?php echo esc_attr__( 'Search for furniture...', 'creative-furniture' ); ?>" 
                        value="<?php echo get_search_query(); ?>" 
                        name="s" />
                    <input type="hidden" name="post_type" value="product" />
                    <button type="submit" class="text-black hover:text-[#BD262A] transition-colors">
                        <svg class="w-6 h-6" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.5 17.5L14.5834 14.5833M16.6667 9.58333C16.6667 13.4954 13.4954 16.6667 9.58333 16.6667C5.67132 16.6667 2.5 13.4954 2.5 9.58333C2.5 5.67132 5.67132 2.5 9.58333 2.5C13.4954 2.5 16.6667 5.67132 16.6667 9.58333Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-6 items-center">
            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" 
               class="bg-black text-white px-10 py-4 font-['Raleway-SemiBold',_sans-serif] text-sm font-semibold uppercase tracking-widest hover:bg-[#BD262A] transition-colors duration-300">
                <?php echo esc_html(__('Browse Shop', 'creative-furniture')); ?>
            </a>
            <a href="<?php echo esc_url(home_url('/')); ?>" 
               class="text-black font-['Raleway-SemiBold',_sans-serif] text-sm font-semibold uppercase tracking-widest border-b border-black pb-1 hover:text-[#BD262A] hover:border-[#BD262A] transition-all duration-300">
                <?php echo esc_html(__('Back to Home', 'creative-furniture')); ?>
            </a>
        </div>
    </div>
</section>
