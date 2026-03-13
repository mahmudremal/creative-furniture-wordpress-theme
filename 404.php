<?php get_header(); ?>

<section class="min-h-[70vh] flex items-center justify-center py-20 px-4 bg-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none select-none flex items-center justify-center overflow-hidden">
        <span class="text-[40vw] font-black leading-none uppercase">404</span>
    </div>

    <div class="max-w-2xl w-full text-center relative z-10">
        <div class="mb-2 inline-block px-4 py-1.5 bg-[#bd262a]/10 text-[#bd262a] rounded-full text-sm font-bold uppercase tracking-widest">
            <?php esc_html_e('Error', 'creative-furniture'); ?>
        </div>
        <h1 class="text-7xl md:text-9xl font-black text-black mb-6 tracking-tighter">
            404
        </h1>
        <h2 class="text-2xl md:text-4xl font-bold text-[#121212] mb-6 uppercase tracking-tight">
            <?php echo esc_html__( 'Oops! Page Not Found', 'creative-furniture' ); ?>
        </h2>
        <p class="text-[#484848] text-lg md:text-xl mb-12 max-w-lg mx-auto leading-relaxed opacity-80">
            <?php echo esc_html__( 'The page you are looking for doesn’t exist or has been moved. Please return to the homepage or search for what you need.', 'creative-furniture' ); ?>
        </p>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" 
               class="inline-flex items-center justify-center px-10 py-4 bg-black text-white text-base font-bold rounded-full hover:bg-black transition-all duration-300 transform hover:-translate-y-1 active:scale-95 shadow-xl hover:shadow-black/20 group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <?php echo esc_html__( 'Back to Home', 'creative-furniture' ); ?>
            </a>
            
            <a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" 
               class="inline-flex items-center justify-center px-10 py-4 bg-gray-100 text-black text-base font-bold rounded-full hover:bg-black hover:text-white transition-all duration-300 transform hover:-translate-y-1 active:scale-95 shadow-sm hover:shadow-xl">
                <?php echo esc_html__( 'Browse Shop', 'creative-furniture' ); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
