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

    <header id="masthead" class="site-header">

        <div class="top-bar">
            <div class="top-bar-content">
                <div class="top-bar-left">
                    <span><em class="font-italic-accent">Free shipping</em> - orders above AED 1500</span>
                </div>
                <div class="top-bar-center">
                    <span>All type of furniture items under one roof, <em class="font-italic-accent">with customization option!</em></span>
                </div>
                <div class="top-bar-right">
                    <span><em class="font-italic-accent">Free Assembly</em> On all orders</span>
                </div>
            </div>
        </div>

        <div class="main-header">
            <div class="container-fluid">
                <div class="header-wrapper">
                    
                    <button class="mobile-menu-toggle" aria-label="Toggle menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>

                    <nav class="header-nav-left desktop-only">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'top-left-header-menu',
                            'menu_id'        => 'top-left-menu',
                            'container'      => false,
                            'fallback_cb'    => false,
                        ]);
                        ?>
                    </nav>

                    <div class="header-logo">
                        <?php 
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                            echo '<a href="' . esc_url(home_url('/')) . '" class="site-title">Creative<sup>®</sup><br><span>Furniture</span></a>';
                        }
                        ?>
                    </div>

                    <div class="header-actions">
                        <button class="search-toggle mobile-only" aria-label="Toggle search">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="2"/>
                                <path d="M14 14L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </button>

                        <div class="search-box desktop-only">
                            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                                <button type="submit" class="search-submit">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                        <circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="2"/>
                                        <path d="M14 14L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </button>
                                <input type="search" class="search-field" placeholder="What are you looking for?" name="s">
                            </form>
                        </div>

                        <div class="currency-switcher desktop-only">
                            <?php echo do_shortcode('[mymc_currency_switcher]'); ?>
                        </div>

                        <a href="<?php echo esc_url(home_url('/wishlist')); ?>" class="header-icon wishlist <?php echo esc_attr(function_exists('cf_wishlist_has_any') && cf_wishlist_has_any() ? 'contains' : ''); ?>" aria-label="Wishlist">
                            <?php footer_block_svg_icon_print('heart'); ?>
                        </a>

                        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('myaccount'))); ?>" class="header-icon myaccount desktop-only" aria-label="Account">
                            <?php footer_block_svg_icon_print('user'); ?>
                        </a>

                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="header-icon cart" aria-label="Cart" data-cart-toggle="true">
                            <?php footer_block_svg_icon_print('bag'); ?>
                        </a>
                    </div>
                </div>

                <div class="mobile-search-bar">
                    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <button type="submit" class="search-submit">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <circle cx="9" cy="9" r="7" stroke="currentColor" stroke-width="2"/>
                                <path d="M14 14L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </button>
                        <input type="search" class="search-field" placeholder="What are you looking for?" name="s">
                    </form>
                </div>
            </div>
        </div>

        <div class="mega-menu-bar desktop-only">
            <div class="container-fluid">
                <nav class="mega-menu-nav">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'header-mega-menu',
                        'menu_id'        => 'mega-menu',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ]);
                    ?>
                </nav>
            </div>
        </div>

        <div class="promo-ticker">
            <div class="ticker-wrapper container-fluid">
                <div class="ticker-content">
                    <span>ITEMS USE CODE HELLO15</span>
                    <span>TOP PICKS WITH TABBY & TAMARA</span>
                    <span>BUY 10+ SAVE 30% – SINGLE ORNAMENTS ONLY</span>
                    <span>BUY 10+ AND SAVE 30% ON SINGLE ORNAMENTS ONLY</span>
                    <span>BUY 10+ AND SAVE</span>
                    <span>ITEMS USE CODE HELLO15</span>
                    <span>TOP PICKS WITH TABBY & TAMARA</span>
                </div>
            </div>
        </div>

    </header>

    <div class="mobile-menu-overlay"></div>
    <nav class="mobile-menu">
        <div class="mobile-menu-header">
            <div class="mobile-menu-title">Menu</div>
            <button class="mobile-menu-close" aria-label="Close menu">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
        
        <div class="mobile-menu-content">
            <div class="mobile-menu-section">
                <?php
                wp_nav_menu([
                    'theme_location' => 'top-left-header-menu',
                    'menu_id'        => 'mobile-top-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ]);
                ?>
            </div>

            <div class="mobile-menu-divider"></div>

            <div class="mobile-menu-section">
                <?php
                wp_nav_menu([
                    'theme_location' => 'header-mega-menu',
                    'menu_id'        => 'mobile-mega-menu',
                    'container'      => false,
                    'fallback_cb'    => false,
                ]);
                ?>
            </div>

            <div class="mobile-menu-divider"></div>

            <div class="mobile-menu-section mobile-menu-actions">
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('myaccount'))); ?>" class="mobile-menu-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16.6668 17.5C16.6668 16.337 16.6668 15.7555 16.5233 15.2824C16.2001 14.217 15.3664 13.3834 14.3011 13.0602C13.828 12.9167 13.2465 12.9167 12.0835 12.9167H7.91683C6.75386 12.9167 6.17237 12.9167 5.69921 13.0602C4.63388 13.3834 3.8002 14.217 3.47703 15.2824C3.3335 15.7555 3.3335 16.337 3.3335 17.5M13.7502 6.25C13.7502 8.32107 12.0712 10 10.0002 10C7.92909 10 6.25016 8.32107 6.25016 6.25C6.25016 4.17893 7.92909 2.5 10.0002 2.5C12.0712 2.5 13.7502 4.17893 13.7502 6.25Z" stroke="#717171" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>My Account</span>
                </a>
                <div class="mobile-currency-switcher">
                    <?php echo do_shortcode('[mymc_currency_switcher]'); ?>
                </div>
            </div>
        </div>
    </nav>
