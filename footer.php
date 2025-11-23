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
                    <p><?php echo esc_html(__('Stay in the loop with discounts, decor ideas, and fresh collections.', 'creative-furniture')); ?></p>
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
                        <h4><?php echo esc_html(__('Free Shipping', 'creative-furniture')); ?></h4>
                        <p><?php echo esc_html(__('Orders Above AED 1500', 'creative-furniture')); ?></p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
						<?php footer_block_svg_icon_print('free-assembly-iocn'); ?>
                    </div>
                    <div class="feature-content">
                        <h4><?php echo esc_html(__('Free Assembly', 'creative-furniture')); ?></h4>
                        <p><?php echo esc_html(__('On all orders', 'creative-furniture')); ?></p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
						<?php footer_block_svg_icon_print('warrenty-certificate'); ?>
                    </div>
                    <div class="feature-content">
                        <h4><?php echo esc_html(__('Warranty', 'creative-furniture')); ?></h4>
                        <p><?php echo esc_html(__('One Year Warranty', 'creative-furniture')); ?></p>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <?php footer_block_svg_icon_print('secure-payment-icon'); ?>
                    </div>
                    <div class="feature-content">
                        <h4><?php echo esc_html(__('Secure Payment', 'creative-furniture')); ?></h4>
                        <p><?php echo esc_html(__('Safe, Fast & Secure', 'creative-furniture')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-main">
        <div class="container-fluid">
            <div class="footer-grid">
                
                <div class="footer-column">
                    <h3><?php echo esc_html(__('Quick Links', 'creative-furniture')); ?></h3>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-quick-links',
                        'container'      => false,
                        'menu_class'     => 'footer-menu',
                        'fallback_cb'    => function() {
                            echo '<ul class="footer-menu">
                                <li><a href="' . esc_attr(home_url('/about-us')) . '">' . esc_html(__('About Us', 'creative-furniture')) . '</a></li>
                                <li><a href="' . esc_attr(wc_get_page_permalink('shop')) . '">' . esc_html(__('Shop All', 'creative-furniture')) . '</a></li>
                                <li><a href="' . esc_attr(get_option('page_for_posts')) . '">' . esc_html(__('Blog / Inspiration', 'creative-furniture')) . '</a></li>
                                <li><a href="' . esc_attr(home_url('/contact')) . '">' . esc_html(__('Contact Us', 'creative-furniture')) . '</a></li>
                            </ul>';
                        }
                    ]);
                    ?>
                </div>

                <div class="footer-column">
                    <h3><?php echo esc_html(__('Customer Care', 'creative-furniture')); ?></h3>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-customer-care',
                        'container'      => false,
                        'menu_class'     => 'footer-menu',
                        'fallback_cb'    => function() {
                            echo '<ul class="footer-menu">
                                <li><a href="' . esc_attr(home_url('/faqs')) . '">' . esc_html(__('FAQs', 'creative-furniture')) . '</a></li>
                                <li><a href="' . esc_attr(home_url('/faqs')) . '">' . esc_html(__('Shipping & Delivery', 'creative-furniture')) . '</a></li>
                                <li><a href="' . esc_attr(get_privacy_policy_url()) . '">' . esc_html(__('Returns & Refunds', 'creative-furniture')) . '</a></li>
                                <li><a href="' . esc_attr(home_url('/order-tracking/')) . '">' . esc_html(__('Track Your Order', 'creative-furniture')) . '</a></li>
                            </ul>';
                        }
                    ]);
                    ?>
                </div>

                <div class="footer-column">
                    <h3><?php echo esc_html(__('Support', 'creative-furniture')); ?></h3>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-support',
                        'container'      => false,
                        'menu_class'     => 'footer-menu',
                        'fallback_cb'    => function() {
                            echo '<ul class="footer-menu">
                                <li><a href="' . esc_attr(home_url('/help')) . '">' . esc_html(__('Help Center', 'creative-furniture')) . '</a></li>
                                <li><a href="' . esc_attr(get_privacy_policy_url()) . '">' . esc_html(__('Terms & Conditions', 'creative-furniture')) . '</a></li>
                                <li><a href="' . esc_attr(get_privacy_policy_url()) . '">' . esc_html(__('Privacy Policy', 'creative-furniture')) . '</a></li>
                                <li><a href="' . esc_attr(get_privacy_policy_url()) . '">' . esc_html(__('Cookie Policy', 'creative-furniture')) . '</a></li>
                            </ul>';
                        }
                    ]);
                    ?>
                </div>

                <div class="footer-column footer-contact">
                    <h3><?php echo esc_html(__('Contact', 'creative-furniture')); ?></h3>
                    <div class="contact-info">
                        <div class="contact-item">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M10 2c-3.3 0-6 2.7-6 6 0 4.5 6 10 6 10s6-5.5 6-10c0-3.3-2.7-6-6-6zm0 8c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" fill="currentColor"/>
                            </svg>
                            <p><?php echo esc_html(__('Office : Al Raihai Tower - Office No J512, 5th Floor - 46th St - next to Movenpick Hotel - Deira - The Town Square - Dubai', 'creative-furniture')); ?></p>
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
                <p class="copyright"><?php echo esc_html(sprintf(__('%s Copyright %s Creative Furniture All Rights Reserved', 'creative-furniture'), '&copy;', date('Y'))); ?></p>
                <div class="footer-social">
                    <a href="#" class="social-link" aria-label="Facebook">
                        <svg width="10" height="19" viewBox="0 0 10 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.32978 18.5128V10.082H9.2155L9.64444 6.78105H6.32978V4.67848C6.32978 3.72595 6.59905 3.07379 7.98607 3.07379H9.74359V0.130813C8.88845 0.040488 8.02891 -0.00312506 7.16888 0.000174013C4.61818 0.000174013 2.86693 1.53492 2.86693 4.3524V6.77487H0V10.0758H2.87319V18.5128H6.32978Z" fill="#424242"/>
                        </svg>
                    </a>
                    <a href="#" class="social-link" aria-label="Twitter">
                        <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_2154_3964)">
                                <path d="M18.9133 3.62114C18.2454 3.89246 17.5279 4.07578 16.7735 4.15864C17.5519 3.73172 18.1342 3.0598 18.4118 2.26825C17.6805 2.66641 16.8802 2.94667 16.0456 3.09685C15.4843 2.54753 14.7409 2.18343 13.9308 2.06108C13.1207 1.93873 12.2892 2.06498 11.5653 2.42023C10.8415 2.77547 10.2659 3.33983 9.92779 4.0257C9.58972 4.71156 9.50813 5.48055 9.69568 6.21327C8.21395 6.14508 6.76442 5.79204 5.44116 5.17708C4.11791 4.56213 2.9505 3.69899 2.0147 2.64369C1.69472 3.14965 1.51074 3.73627 1.51074 4.36102C1.51038 4.92344 1.66147 5.47724 1.95061 5.9733C2.23974 6.46935 2.65798 6.89231 3.16821 7.20466C2.57647 7.1874 1.9978 7.04083 1.48034 6.77716V6.82116C1.48028 7.60997 1.77794 8.37451 2.32282 8.98505C2.8677 9.59559 3.62623 10.0145 4.4697 10.1708C3.92077 10.3069 3.34526 10.327 2.78664 10.2294C3.02462 10.9082 3.48818 11.5017 4.11242 11.9269C4.73667 12.3521 5.49035 12.5878 6.26796 12.6008C4.94793 13.5507 3.3177 14.066 1.63953 14.0637C1.34226 14.0638 1.04524 14.0479 0.75 14.0161C2.45344 15.02 4.43638 15.5529 6.46154 15.5508C13.317 15.5508 17.0647 10.346 17.0647 5.83197C17.0647 5.68531 17.0607 5.53719 17.0535 5.39054C17.7825 4.90729 18.4117 4.30888 18.9117 3.62334L18.9133 3.62114Z" fill="#424242"/>
                            </g>
                            <defs>
                                <clipPath id="clip0_2154_3964">
                                    <rect width="19.1985" height="17.5986" fill="white"/>
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    <a href="#" class="social-link" aria-label="Instagram">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.17114 0.063C7.29082 0.0114545 7.64782 0 10.5 0C13.3522 0 13.7092 0.0124091 14.8279 0.063C15.9466 0.113591 16.7103 0.292091 17.3785 0.550773C18.0781 0.815182 18.7129 1.2285 19.2379 1.76305C19.7725 2.28709 20.1848 2.92091 20.4483 3.62155C20.7079 4.28973 20.8855 5.05336 20.937 6.17018C20.9885 7.29177 21 7.64877 21 10.5C21 13.3522 20.9876 13.7092 20.937 14.8289C20.8864 15.9457 20.7079 16.7093 20.4483 17.3775C20.1848 18.0782 19.7718 18.7131 19.2379 19.2379C18.7129 19.7725 18.0781 20.1848 17.3785 20.4483C16.7103 20.7079 15.9466 20.8855 14.8298 20.937C13.7092 20.9885 13.3522 21 10.5 21C7.64782 21 7.29082 20.9876 6.17114 20.937C5.05432 20.8864 4.29068 20.7079 3.6225 20.4483C2.92179 20.1848 2.28692 19.7717 1.76209 19.2379C1.22791 18.7135 0.814528 18.079 0.550773 17.3785C0.292091 16.7103 0.114545 15.9466 0.063 14.8298C0.0114545 13.7082 0 13.3512 0 10.5C0 7.64782 0.0124091 7.29082 0.063 6.17209C0.113591 5.05336 0.292091 4.28973 0.550773 3.62155C0.814917 2.92099 1.22861 2.28644 1.76305 1.76209C2.28713 1.22802 2.92136 0.814651 3.62155 0.550773C4.28973 0.292091 5.05336 0.114545 6.17018 0.063H6.17114ZM14.743 1.953C13.6357 1.90241 13.3035 1.89191 10.5 1.89191C7.6965 1.89191 7.36432 1.90241 6.25705 1.953C5.23282 1.99977 4.67727 2.17064 4.30691 2.31477C3.81723 2.50568 3.46691 2.73191 3.09941 3.09941C2.75104 3.43832 2.48294 3.85091 2.31477 4.30691C2.17064 4.67727 1.99977 5.23282 1.953 6.25705C1.90241 7.36432 1.89191 7.6965 1.89191 10.5C1.89191 13.3035 1.90241 13.6357 1.953 14.743C1.99977 15.7672 2.17064 16.3227 2.31477 16.6931C2.48277 17.1484 2.751 17.5617 3.09941 17.9006C3.43827 18.249 3.85159 18.5172 4.30691 18.6852C4.67727 18.8294 5.23282 19.0002 6.25705 19.047C7.36432 19.0976 7.69555 19.1081 10.5 19.1081C13.3045 19.1081 13.6357 19.0976 14.743 19.047C15.7672 19.0002 16.3227 18.8294 16.6931 18.6852C17.1828 18.4943 17.5331 18.2681 17.9006 17.9006C18.249 17.5617 18.5172 17.1484 18.6852 16.6931C18.8294 16.3227 19.0002 15.7672 19.047 14.743C19.0976 13.6357 19.1081 13.3035 19.1081 10.5C19.1081 7.6965 19.0976 7.36432 19.047 6.25705C19.0002 5.23282 18.8294 4.67727 18.6852 4.30691C18.4943 3.81723 18.2681 3.46691 17.9006 3.09941C17.5617 2.75107 17.1491 2.48297 16.6931 2.31477C16.3227 2.17064 15.7672 1.99977 14.743 1.953ZM9.15886 13.7369C9.90786 14.0486 10.7419 14.0907 11.5184 13.8559C12.295 13.6211 12.966 13.124 13.4167 12.4494C13.8675 11.7749 14.0701 10.9647 13.9899 10.1574C13.9097 9.3501 13.5517 8.59566 12.977 8.02295C12.6107 7.65686 12.1678 7.37655 11.6801 7.20219C11.1925 7.02782 10.6722 6.96375 10.1568 7.01459C9.64145 7.06542 9.14374 7.2299 8.69954 7.49617C8.25534 7.76244 7.87571 8.12389 7.58797 8.55449C7.30023 8.9851 7.11154 9.47414 7.03549 9.98642C6.95944 10.4987 6.99792 11.0215 7.14815 11.5171C7.29839 12.0127 7.55664 12.4689 7.90432 12.8527C8.25201 13.2365 8.68047 13.5385 9.15886 13.7369ZM6.68373 6.68373C7.18489 6.18257 7.77985 5.78503 8.43465 5.5138C9.08945 5.24257 9.79125 5.10297 10.5 5.10297C11.2087 5.10297 11.9106 5.24257 12.5654 5.5138C13.2201 5.78503 13.8151 6.18257 14.3163 6.68373C14.8174 7.18489 15.215 7.77985 15.4862 8.43465C15.7574 9.08945 15.897 9.79125 15.897 10.5C15.897 11.2087 15.7574 11.9106 15.4862 12.5654C15.215 13.2201 14.8174 13.8151 14.3163 14.3163C13.3041 15.3284 11.9314 15.897 10.5 15.897C9.06862 15.897 7.69587 15.3284 6.68373 14.3163C5.67159 13.3041 5.10298 11.9314 5.10298 10.5C5.10298 9.06862 5.67159 7.69587 6.68373 6.68373ZM17.094 5.90673C17.2182 5.78958 17.3176 5.6487 17.3864 5.49243C17.4551 5.33616 17.4919 5.16769 17.4944 4.99698C17.4968 4.82627 17.4651 4.6568 17.4009 4.49859C17.3367 4.34039 17.2414 4.19667 17.1207 4.07595C17 3.95522 16.8562 3.85995 16.698 3.79577C16.5398 3.73158 16.3704 3.6998 16.1997 3.70228C16.0289 3.70477 15.8605 3.74149 15.7042 3.81026C15.5479 3.87902 15.4071 3.97845 15.2899 4.10264C15.0621 4.34416 14.9373 4.66498 14.9422 4.99698C14.947 5.32898 15.081 5.64602 15.3158 5.8808C15.5506 6.11559 15.8677 6.24963 16.1997 6.25447C16.5317 6.25931 16.8525 6.13457 17.094 5.90673Z" fill="#424242"/>
                        </svg>

                    </a>
                    <a href="#" class="social-link" aria-label="Telegram">
                        <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.5023 0.0760991L0.321039 5.70765C-0.139725 5.86124 -0.0885284 6.52679 0.372235 6.68038L3.95595 7.80669L5.38944 12.3119C5.49183 12.6703 5.95259 12.7727 6.20857 12.5167L8.30761 10.5713L12.3009 13.4894C12.6081 13.6942 13.0176 13.5406 13.12 13.1823L15.8846 1.3048C16.0382 0.43447 15.2703 -0.231077 14.5023 0.0760991ZM6.20857 8.67702L5.74781 11.3392L4.72389 7.6531L14.7071 1.10002L6.20857 8.67702Z" fill="#424242"/>
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