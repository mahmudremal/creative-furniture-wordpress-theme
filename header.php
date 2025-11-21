<?php
/**
 * The header for our theme
 *
 * Displays <head> and everything up until <div id="content">
 *
 * @package Creative_Furniture
 */
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
                    <nav class="header-nav-left">
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
                        <div class="search-box">
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

                        <div class="currency-switcher">
                            <!-- <select>
                                <?php
                                // $current = isset($_COOKIE['mymc_currency']) ? strtoupper(sanitize_text_field($_COOKIE['mymc_currency'])) : 'AED';
                                // foreach (['AED', 'USD', 'EUR'] as $currCode) {
                                //     $selected = ($currCode === $current) ? ' selected' : '';
                                //     echo '<option value="' . esc_attr($currCode) . '"' . $selected . '>' . esc_html($currCode) . '</option>';
                                // }
                                ?>
                            </select> -->
                            <?php echo do_shortcode('[mymc_currency_switcher]'); ?>

                        </div>

                        <a href="<?php echo esc_url(home_url('/wishlist')); ?>" class="header-icon wishlist <?php echo esc_attr(function_exists('cf_wishlist_has_any') && cf_wishlist_has_any() ? 'contains' : ''); ?>" aria-label="Wishlist">
                            <?php footer_block_svg_icon_print('heart'); ?>
                        </a>

                        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('myaccount'))); ?>" class="header-icon myaccount" aria-label="Account">
                            <?php footer_block_svg_icon_print('user'); ?>
                        </a>

                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="header-icon cart" aria-label="Cart" data-cart-toggle="true">
                            <?php footer_block_svg_icon_print('bag'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mega-menu-bar">
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