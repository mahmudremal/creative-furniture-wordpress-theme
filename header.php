<?php
function add_menu_anchor_class($atts, $item, $args) {
    if ($args->theme_location == 'header-mega-menu') {
        if (strpos($args->menu_class, 'flex-col') !== false) {
            $atts['class'] = "text-black text-base font-semibold py-3 px-4 rounded-2xl bg-gray-50/50 hover:bg-black hover:text-white transition-all duration-300 flex items-center justify-between group";
        } else {
            $atts['class'] = "text-black/80 hover:text-black text-sm lg:text-base font-semibold transition-all duration-200 relative flex items-center justify-start";
        }
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_anchor_class', 10, 3);
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'creative-furniture' ); ?></a>

    <header id="masthead" class="site-header relative z-50">
        <div class="flex flex-col items-center justify-start w-full gap-4 mb-4">
            <div class="w-full bg-[#eaeaea]">
                <div class="px-4 --md:px-0 flex flex-col md:flex-row items-center justify-between gap-2 w-full max-w-full md:w-[1440px] m-auto relative">
                    <div class="flex flex-col md:flex-row items-center justify-between w-full gap-2 md:gap-4">
                        <div class="text-black text-center md:text-left font-normal text-xs md:text-sm leading-5 text-nowrap">
                            <?php echo esc_html__( 'Free shipping - orders above AED 1500', 'creative-furniture' ); ?>
                        </div>
                        <div class="text-black text-center font-normal text-xs md:text-sm leading-5">
                            <!-- <?php echo esc_html__( 'All type of furniture items under one roof, with customization option!', 'creative-furniture' ); ?> -->
                            <div class="blaze-slider" data-slider="discount-text" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => true, 'slidesToShow' => 1, 'slidesToScroll' => 1, 'enableAutoplay' => true, 'OnInteraction' => true, 'autoplayInterval' => 4000]])); ?>">
                                <div class="blaze-container">
                                    <div class="blaze-track-container">
                                        <div class="blaze-track">
                                            <span><?php echo esc_html__( 'All type of furniture items under one roof, with customization option!', 'creative-furniture' ); ?></span>
                                            <span><?php echo esc_html__( 'All type of furniture items under one roof, with customization option!', 'creative-furniture' ); ?></span>
                                            <span><?php echo esc_html__( 'All type of furniture items under one roof, with customization option!', 'creative-furniture' ); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row gap-4 md:gap-6 items-center justify-start">
                        <div class="flex flex-row gap-0.5 items-center justify-start relative cursor-pointer group">
                            <div class="currency-switcher desktop-only">
                                <?php
                                wp_nav_menu([
                                    'theme_location' => 'language-switcher-menu',
                                    'menu_id'        => 'language-switcher-menu',
                                    'container'      => false,
                                    'fallback_cb'    => false,
                                ]);
                                ?>
                            </div>
                        </div>
                        <div class="flex flex-row gap-0.5 items-center justify-start relative cursor-pointer group">
                            <div class="currency-switcher desktop-only">
                                <?php echo do_shortcode('[mymc_currency_switcher]'); ?>
                            </div>
                        </div>
                        
                        <a href="<?php echo esc_url( function_exists('wc_get_wishlist_url') ? wc_get_wishlist_url() : home_url('/wishlist/') ); ?>" class="text-[#434343] hover:text-[#bd262a] transition-colors relative">
                            <svg class="w-5 h-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.99425 4.27985C8.32813 2.332 5.54975 1.80804 3.4622 3.59168C1.37466 5.37532 1.08077 8.35748 2.72012 10.467C4.08314 12.2209 8.2081 15.9201 9.56004 17.1174C9.7113 17.2513 9.78692 17.3183 9.87514 17.3446C9.95213 17.3676 10.0364 17.3676 10.1134 17.3446C10.2016 17.3183 10.2772 17.2513 10.4285 17.1174C11.7804 15.9201 15.9054 12.2209 17.2684 10.467C18.9077 8.35748 18.6497 5.35656 16.5263 3.59168C14.4029 1.8268 11.6604 2.332 9.99425 4.27985Z" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <?php $totalWishlist = cf_wishlist_get_total(); ?>
                            <span class="wishlist-total-qty absolute -top-1.5 -right-1.5 bg-[#bd262a] text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center <?php echo esc_attr($totalWishlist > 0 ? '' : 'hidden'); ?>">
                                <?php echo esc_html($totalWishlist); ?>
                            </span>
                        </a>

                        <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" class="text-[#434343] hover:text-[#bd262a] transition-colors">
                            <svg class="w-5 h-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16.6667 17.5C16.6667 16.337 16.6667 15.7555 16.5232 15.2824C16.2 14.217 15.3663 13.3834 14.301 13.0602C13.8278 12.9167 13.2463 12.9167 12.0834 12.9167H7.91671C6.75374 12.9167 6.17225 12.9167 5.69909 13.0602C4.63375 13.3834 3.80007 14.217 3.47691 15.2824C3.33337 15.7555 3.33337 16.337 3.33337 17.5M13.75 6.25C13.75 8.32107 12.0711 10 10 10C7.92897 10 6.25004 8.32107 6.25004 6.25C6.25004 4.17893 7.92897 2.5 10 2.5C12.0711 2.5 13.75 4.17893 13.75 6.25Z" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>

                        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="text-[#434343] hover:text-[#bd262a] transition-colors relative">
                            <svg class="w-5 h-5" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.25 6.39167V5.58333C6.25 3.70833 7.75833 1.86667 9.63333 1.69167C11.8667 1.475 13.75 3.23333 13.75 5.425V6.575" stroke="currentColor" stroke-width="1.66667" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M7.49998 18.3333H12.5C15.85 18.3333 16.45 16.9917 16.625 15.3583L17.25 10.3583C17.475 8.325 16.8916 6.66667 13.3333 6.66667H6.66664C3.10831 6.66667 2.52498 8.325 2.74998 10.3583L3.37498 15.3583C3.54998 16.9917 4.14998 18.3333 7.49998 18.3333Z" stroke="currentColor" stroke-width="1.66667" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M12.9129 10H12.9204" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M7.07872 10H7.0862" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <?php $totalInCart = WC()->cart->get_cart_contents_count(); ?>
                            <span class="cart-total-qty absolute -top-1.5 -right-1.5 bg-[#bd262a] text-white text-[10px] w-4 h-4 rounded-full flex items-center justify-center <?php echo esc_attr($totalInCart > 0 ? '' : 'hidden'); ?>">
                                <?php echo esc_html($totalInCart); ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="w-full h-[70px] md:h-[62px] py-2 px-4 --md:px-0 relative flex">
                <div class="flex flex-row items-center justify-between w-full max-w-full md:w-[1440px] m-auto">
                    <button id="mobile-menu-toggle" class="md:hidden p-3 -ml-3 text-black hover:bg-gray-100 rounded-full transition-colors active:scale-95">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>

                    <nav class="hidden md:flex flex-row gap-6 lg:gap-8 items-center justify-start flex-1 h-full">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'header-mega-menu',
                            'container' => false,
                            'menu_class' => 'flex flex-row gap-4 lg:gap-6 items-center h-full text-black font-bold text-sm lg:text-base capitalize tracking-tight',
                            'fallback_cb' => false,
                            'walker' => new \CF_MegaMenuWalker()
                        ]);
                        ?>
                    </nav>

                    <div class="flex flex-row items-center justify-center shrink-0 absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                        <?php
                        if ( has_custom_logo() ) {
                            the_custom_logo();
                        } else {
                            ?>
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="flex items-center">
                                <img class="w-[40px] h-[40px] md:w-[60.22px] md:h-[60.22px] object-cover" src="<?php echo esc_url( get_template_directory_uri() . '/dist/images/v2/logo-icon.png' ); ?>" alt="Logo Icon">
                                <img class="w-[100px] h-auto md:w-[150px] object-cover" src="<?php echo esc_url( get_template_directory_uri() . '/dist/images/v2/logo-text.png' ); ?>" alt="Creative Furniture">
                            </a>
                            <?php
                        }
                        ?>
                    </div>

                    <div class="hidden md:flex flex-row items-center justify-end flex-1">
                        <form role="search" method="get" class="w-full max-w-[481px]" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <div class="border-b border-[#d3d3d3] py-2 flex flex-row gap-5 items-center justify-start w-full relative">
                                <input type="search" class="bg-transparent border-none focus:ring-0 text-black text-sm w-full outline-none placeholder:text-[#464646]" 
                                    placeholder="<?php echo esc_attr__( 'What are you looking for?', 'creative-furniture' ); ?>" 
                                    value="<?php echo get_search_query(); ?>" name="s" />
                                <input type="hidden" name="post_type" value="product" />
                                <button type="submit" class="text-[#464646]">
                                    <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.5 17.5L14.5834 14.5833M16.6667 9.58333C16.6667 13.4954 13.4954 16.6667 9.58333 16.6667C5.67132 16.6667 2.5 13.4954 2.5 9.58333C2.5 5.67132 5.67132 2.5 9.58333 2.5C13.4954 2.5 16.6667 5.67132 16.6667 9.58333Z" stroke="currentColor" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="md:hidden flex items-center">
                        <button id="mobile-search-toggle" class="p-2 text-black">
                            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.5 17.5L14.5834 14.5833M16.6667 9.58333C16.6667 13.4954 13.4954 16.6667 9.58333 16.6667C5.67132 16.6667 2.5 13.4954 2.5 9.58333C2.5 5.67132 5.67132 2.5 9.58333 2.5C13.4954 2.5 16.6667 5.67132 16.6667 9.58333Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="mobile-menu-drawer" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] transition-opacity duration-300 opacity-0 pointer-events-none md:hidden">
            <div id="mobile-menu-content" class="absolute left-0 top-0 h-full w-[300px] bg-white shadow-2xl translate-x-[-100%] transition-transform duration-500 ease-out flex flex-col">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white sticky top-0 z-10">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-black rounded-lg flex items-center justify-center">
                             <img class="w-5 h-5 object-contain invert" src="<?php echo esc_url( get_template_directory_uri() . '/dist/images/v2/logo-icon.png' ); ?>" alt="Icon">
                        </div>
                        <span class="font-bold text-xl tracking-tight text-black"><?php echo esc_html__( 'Menu', 'creative-furniture' ); ?></span>
                    </div>
                    <button id="mobile-menu-close" class="p-2 hover:bg-gray-100 rounded-full transition-colors group">
                        <svg class="w-6 h-6 text-gray-500 group-hover:text-black transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto px-2 py-6 custom-scrollbar">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'header-mega-menu',
                        'container' => false,
                        'menu_class' => 'flex flex-col gap-2',
                        'fallback_cb' => false,
                    ]);
                    ?>
                </div>

                <div class="p-6 bg-gray-50 border-t border-gray-100 space-y-4">
                    <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" class="flex items-center gap-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-200 text-sm font-semibold text-black hover:border-black transition-all">
                        <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-black" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.6667 17.5C16.6667 16.337 16.6667 15.7555 16.5232 15.2824C16.2 14.217 15.3663 13.3834 14.301 13.0602C13.8278 12.9167 13.2463 12.9167 12.0834 12.9167H7.91671C6.75374 12.9167 6.17225 12.9167 5.69909 13.0602C4.63375 13.3834 3.80007 14.217 3.47691 15.2824C3.33337 15.7555 3.33337 16.337 3.33337 17.5M13.75 6.25C13.75 8.32107 12.0711 10 10 10C7.92897 10 6.25004 8.32107 6.25004 6.25C6.25004 4.17893 7.92897 2.5 10 2.5C12.0711 2.5 13.75 4.17893 13.75 6.25Z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs text-gray-500 font-normal"><?php echo esc_html__( 'Manage Profile', 'creative-furniture' ); ?></span>
                            <span><?php echo esc_html__( 'My Account', 'creative-furniture' ); ?></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div id="mobile-search-bar" class="hidden md:hidden w-full bg-white border-b border-gray-100 p-6 transform transition-all duration-300">
            <form role="search" method="get" class="w-full" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-black transition-colors" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.5 17.5L14.5834 14.5833M16.6667 9.58333C16.6667 13.4954 13.4954 16.6667 9.58333 16.6667C5.67132 16.6667 2.5 13.4954 2.5 9.58333C2.5 5.67132 5.67132 2.5 9.58333 2.5C13.4954 2.5 16.6667 5.67132 16.6667 9.58333Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    <input type="search" class="block w-full bg-gray-50 border-0 focus:ring-2 focus:ring-black rounded-2xl py-4 pl-12 pr-4 text-black text-sm transition-all placeholder:text-gray-400" 
                        placeholder="<?php echo esc_attr__( 'Search products...', 'creative-furniture' ); ?>" 
                        value="<?php echo get_search_query(); ?>" name="s" />
                    <input type="hidden" name="post_type" value="product" />
                    <button type="submit" class="absolute inset-y-0 right-0 pr-4 flex items-center text-sm font-bold text-black uppercase tracking-wider">
                        <?php echo esc_html__( 'Go', 'creative-furniture' ); ?>
                    </button>
                </div>
            </form>
        </div>
    </header>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('mobile-menu-toggle');
        const drawer = document.getElementById('mobile-menu-drawer');
        const content = document.getElementById('mobile-menu-content');
        const close = document.getElementById('mobile-menu-close');
        
        function openMenu() {
            drawer.classList.remove('opacity-0', 'pointer-events-none');
            drawer.classList.add('opacity-100');
            content.classList.remove('translate-x-[-100%]');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMenu() {
            drawer.classList.add('opacity-0', 'pointer-events-none');
            drawer.classList.remove('opacity-100');
            content.classList.add('translate-x-[-100%]');
            document.body.style.overflow = '';
        }
        
        toggle?.addEventListener('click', openMenu);
        close?.addEventListener('click', closeMenu);
        drawer?.addEventListener('click', function(e) {
            if (e.target === drawer) closeMenu();
        });

        const searchToggle = document.getElementById('mobile-search-toggle');
        const searchBar = document.getElementById('mobile-search-bar');
        
        searchToggle?.addEventListener('click', function() {
            searchBar.classList.toggle('hidden');
        });
    });
    </script>



