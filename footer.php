<?php
/**
 * The template for displaying the footer
 *
 * @package Creative_Furniture
 */
?>

<footer id="colophon" class="site-footer">
    
    <div class="footer-newsletter">
        <div class="container-fluid">
            <div class="newsletter-content">
                <div class="newsletter-text">
                    <h2>Subscribe for Exclusive <em class="font-italic-accent">Deals <br />& Updates</em></h2>
                    <p>Stay in the loop with discounts, decor ideas, and fresh collections.</p>
                </div>
                <div class="newsletter-form">
                    <form method="post" action="#" class="subscribe-form">
                        <input type="email" name="email" placeholder="Enter Email Address" required>
                        <button type="submit" aria-label="Subscribe">
                            <?php footer_block_svg_icon_print('arrow-right'); ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-features">
        <div class="container-fluid">
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <?php footer_block_svg_icon_print('free-shipping-car'); ?>
                    </div>
                    <div class="feature-content">
                        <h4>Free Shipping</h4>
                        <p>Orders Above AED 1500</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
						<?php footer_block_svg_icon_print('free-assembly-iocn'); ?>
                    </div>
                    <div class="feature-content">
                        <h4>Free Assembly</h4>
                        <p>On all orders</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
						<?php footer_block_svg_icon_print('warrenty-certificate'); ?>
                    </div>
                    <div class="feature-content">
                        <h4>Warranty</h4>
                        <p>One Year Warranty</p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <?php footer_block_svg_icon_print('secure-payment-icon'); ?>
                    </div>
                    <div class="feature-content">
                        <h4>Secure Payment</h4>
                        <p>Safe, Fast & Secure</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-main">
        <div class="container-fluid">
            <div class="footer-grid">
                
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-quick-links',
                        'container'      => false,
                        'menu_class'     => 'footer-menu',
                        'fallback_cb'    => function() {
                            echo '<ul class="footer-menu">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Shop All</a></li>
                                <li><a href="#">Blog / Inspiration</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>';
                        }
                    ]);
                    ?>
                </div>

                <div class="footer-column">
                    <h3>Customer Care</h3>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-customer-care',
                        'container'      => false,
                        'menu_class'     => 'footer-menu',
                        'fallback_cb'    => function() {
                            echo '<ul class="footer-menu">
                                <li><a href="#">FAQs</a></li>
                                <li><a href="#">Shipping & Delivery</a></li>
                                <li><a href="#">Returns & Refunds</a></li>
                                <li><a href="#">Track Your Order</a></li>
                            </ul>';
                        }
                    ]);
                    ?>
                </div>

                <div class="footer-column">
                    <h3>Support</h3>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-support',
                        'container'      => false,
                        'menu_class'     => 'footer-menu',
                        'fallback_cb'    => function() {
                            echo '<ul class="footer-menu">
                                <li><a href="#">Help Center</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Cookie Policy</a></li>
                            </ul>';
                        }
                    ]);
                    ?>
                </div>

                <div class="footer-column footer-contact">
                    <h3>Contact</h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M10 2c-3.3 0-6 2.7-6 6 0 4.5 6 10 6 10s6-5.5 6-10c0-3.3-2.7-6-6-6zm0 8c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" fill="currentColor"/>
                            </svg>
                            <p>Office : Al Raihai Tower – Office No J512, 5th Floor – 46th St – next to Movenpick Hotel – Deira – The Town Square – Dubai</p>
                        </div>
                        <div class="contact-item">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M3 4h14a1 1 0 011 1v10a1 1 0 01-1 1H3a1 1 0 01-1-1V5a1 1 0 011-1z" stroke="currentColor" stroke-width="2"/>
                                <path d="M2 5l8 5 8-5" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <a href="mailto:info@creativefurniture.ae">info@creativefurniture.ae</a>
                        </div>
                        <div class="contact-item">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M3 3h3l2 5-2 2c1 2 3 4 5 5l2-2 5 2v3c0 1-1 2-2 2C8 18 2 12 2 5c0-1 1-2 2-2" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <a href="tel:+971566736852">+971566736852</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container-fluid">
            <div class="footer-bottom-content">
                <p class="copyright">&copy; Copyright <?php echo date('Y'); ?> Creative Furniture All Rights Reserved</p>
                <div class="footer-social">
                    <a href="#" class="social-link" aria-label="Facebook">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                            <path d="M14 8h-1c-1 0-1 1-1 1v2h2v3h-2v6h-3v-6H7v-3h2V8c0-2 1-3 3-3h2v3z" fill="currentColor"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link" aria-label="Twitter">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                            <path d="M16 8c-.5.3-1 .4-1.5.5.5-.3.9-.8 1-1.4-.5.3-1 .5-1.5.6-.5-.5-1.2-.8-1.9-.8-1.5 0-2.7 1.2-2.7 2.7 0 .2 0 .4.1.6-2.2-.1-4.2-1.2-5.5-2.8-.2.4-.3.8-.3 1.3 0 .9.5 1.7 1.2 2.2-.4 0-.8-.1-1.2-.3v.1c0 1.3.9 2.4 2.1 2.6-.2.1-.5.1-.7.1-.2 0-.4 0-.5-.1.4 1.1 1.4 2 2.7 2-1 .8-2.3 1.3-3.6 1.3-.2 0-.5 0-.7-.1 1.3.8 2.8 1.3 4.5 1.3 5.4 0 8.3-4.5 8.3-8.3v-.4c.6-.4 1.1-.9 1.5-1.5z" fill="currentColor"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link" aria-label="Instagram">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2"/>
                            <circle cx="16" cy="8" r="1" fill="currentColor"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link" aria-label="Telegram">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                            <path d="M8 12l3 3 5-8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

</footer>

</div>

<?php wp_footer(); ?>
</body>
</html>