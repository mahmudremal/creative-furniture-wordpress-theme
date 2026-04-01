<?php
/**
 * The template for displaying the footer
 *
 * @package Creative_Furniture
 */
?>

<footer id="colophon" class="site-footer bg-white mt-10">
    <div class="">
        <!-- Newsletter Section -->
        <div class="bg-[#f4f4f4] py-4 md:py-6 border-b border-black/10 lg:px-4">
            <div class="flex flex-col md:flex-row gap-8 items-center justify-between px-4 w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
                <div class="flex flex-col gap-4 text-center md:text-left w-full md:w-auto">
                    <h3 class="text-[#0c0c0c] font-semibold text-lg sm:text-xl md:text-2xl leading-tight uppercase tracking-tight">
                        <?php echo esc_html__( 'Subscribe Up To Newsletter', 'creative-furniture' ); ?>
                    </h3>
                    <div class="relative w-full max-w-[400px] m-auto md:m-0">
                        <form action="#" class="border-b border-black/20 pb-2 flex items-center justify-between group">
                            <input type="email" placeholder="<?php echo esc_attr__( 'Enter Email Address', 'creative-furniture' ); ?>" class="bg-transparent border-none focus:ring-0 text-sm w-full outline-none py-1" required>
                            <button type="submit" class="bg-[#bd262a] rounded-full p-2 hover:scale-110 transition-transform">
                                <svg class="w-4 h-4 text-white" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.025 15.0581L17.0833 9.99977L12.025 4.94144" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M2.91668 10L16.9417 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Social Icons -->
                <div class="flex flex-row gap-3 items-center justify-center">
                    <a href="https://facebook.com" class="bg-[#e9e9e9] rounded-[22.76px] p-[3.56px] flex flex-row gap-[3.56px] items-center justify-center shrink-0 w-8 h-8 relative">
                        <svg class="rounded-[22.76px] flex flex-row gap-[3.56px] items-center justify-center shrink-0 w-8 h-8 relative overflow-visible" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="32" height="32" rx="16" fill="#E9E9E9"></rect>
                            <path d="M17.1068 17.3415V24.2449H13.9356V17.3415H11.3011V14.5424H13.9356V13.5239C13.9356 9.74295 15.5151 7.75488 18.857 7.75488C19.8816 7.75488 20.1377 7.91954 20.6987 8.0537V10.8224C20.0706 10.7126 19.8938 10.6516 19.2412 10.6516C18.4667 10.6516 18.052 10.8712 17.6739 11.3041C17.2958 11.7371 17.1068 12.4872 17.1068 13.5605V14.5485H20.6987L19.7352 17.3476H17.1068V17.3415Z" fill="#111111"></path>
                        </svg>
                    </a>
                    <a href="https://twitter.com" class="bg-[#e9e9e9] rounded-[22.76px] p-[3.56px] flex flex-row gap-[3.56px] items-center justify-center shrink-0 w-8 h-8 relative">
                        <svg class="rounded-[22.76px] flex flex-row gap-[3.56px] items-center justify-center shrink-0 w-8 h-8 relative overflow-visible" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="32" height="32" rx="16" fill="#E9E9E9"></rect>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.2269 8.5H8.5L14.1045 16.6572L8.85852 23.5H11.2823L15.25 18.3246L18.7731 23.4525H23.5L17.7327 15.0582L17.7429 15.0727L22.7086 8.59529H20.2849L16.5972 13.4055L13.2269 8.5ZM11.1092 9.92858H12.5807L20.8908 22.0238H19.4193L11.1092 9.92858Z" fill="#111111"></path>
                        </svg>
                    </a>
                    <a href="https://pinterest.com" class="bg-[#e9e9e9] rounded-[22.76px] p-[3.56px] flex flex-row gap-[3.56px] items-center justify-center shrink-0 w-8 h-8 relative">
                        <svg class="rounded-[22.76px] flex flex-row gap-[3.56px] items-center justify-center shrink-0 w-8 h-8 relative overflow-visible" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="32" height="32" rx="16" fill="#E9E9E9"></rect>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M14.97 18.935C15.4765 18.9513 15.934 19.6212 17.2737 19.6212C19.7899 19.6375 21.5218 17.7096 22.061 15.177C23.94 6.4031 11.1467 5.70053 9.83957 12.9223C9.52914 14.6215 10.0356 16.5822 11.3591 17.2194C12.3721 17.7096 12.4374 16.3044 12.127 15.6999C10.7545 13.0203 12.4048 10.6022 14.5615 9.91594C16.5875 9.26239 18.0253 9.80157 19.12 10.9289C20.5252 12.3831 19.8879 16.3371 18.2214 17.5952C17.6332 18.0363 16.5548 18.1344 15.9993 17.6115C14.8556 16.5495 16.6202 14.2947 16.3588 12.6445C16.0973 11.0106 13.5158 11.2557 13.3851 13.6575C13.3197 14.8829 13.6792 15.2424 13.4014 16.4678C12.9603 18.4285 11.6205 22.4315 12.5682 24C13.957 23.3464 14.6432 19.4251 14.97 18.935Z" fill="#111111"></path>
                        </svg>
                    </a>
                    <a href="https://instagram.com" class="bg-[#e9e9e9] rounded-[22.76px] p-[3.56px] flex flex-row gap-[3.56px] items-center justify-center shrink-0 w-8 h-8 relative">
                        <svg class="shrink-0 w-4 h-4 relative overflow-visible" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.70182 0.048C5.55491 0.00872726 5.82691 0 8 0C10.1731 0 10.4451 0.00945454 11.2975 0.048C12.1498 0.0865454 12.7316 0.222545 13.2407 0.419636C13.7738 0.621091 14.2575 0.936 14.6575 1.34327C15.0647 1.74255 15.3789 2.22545 15.5796 2.75927C15.7775 3.26836 15.9127 3.85018 15.952 4.70109C15.9913 5.55564 16 5.82764 16 8C16 10.1731 15.9905 10.4451 15.952 11.2982C15.9135 12.1491 15.7775 12.7309 15.5796 13.24C15.3789 13.7739 15.0642 14.2576 14.6575 14.6575C14.2575 15.0647 13.7738 15.3789 13.2407 15.5796C12.7316 15.7775 12.1498 15.9127 11.2989 15.952C10.4451 15.9913 10.1731 16 8 16C5.82691 16 5.55491 15.9905 4.70182 15.952C3.85091 15.9135 3.26909 15.7775 2.76 15.5796C2.22612 15.3789 1.74241 15.0642 1.34255 14.6575C0.935549 14.2579 0.620593 13.7745 0.419636 13.2407C0.222545 12.7316 0.0872727 12.1498 0.048 11.2989C0.00872726 10.4444 0 10.1724 0 8C0 5.82691 0.00945454 5.55491 0.048 4.70255C0.0865454 3.85018 0.222545 3.26836 0.419636 2.75927C0.620889 2.22551 0.936086 1.74205 1.34327 1.34255C1.74257 0.935637 2.2258 0.620686 2.75927 0.419636C3.26836 0.222545 3.85018 0.0872727 4.70109 0.048H4.70182ZM11.2327 1.488C10.3891 1.44945 10.136 1.44145 8 1.44145C5.864 1.44145 5.61091 1.44945 4.76727 1.488C3.98691 1.52364 3.56364 1.65382 3.28145 1.76364C2.90836 1.90909 2.64145 2.08145 2.36145 2.36145C2.09603 2.61967 1.89177 2.93402 1.76364 3.28145C1.65382 3.56364 1.52364 3.98691 1.488 4.76727C1.44945 5.61091 1.44145 5.864 1.44145 8C1.44145 10.136 1.44945 10.3891 1.488 11.2327C1.52364 12.0131 1.65382 12.4364 1.76364 12.7185C1.89164 13.0655 2.096 13.3804 2.36145 13.6385C2.61964 13.904 2.93455 14.1084 3.28145 14.2364C3.56364 14.3462 3.98691 14.4764 4.76727 14.512C5.61091 14.5505 5.86327 14.5585 8 14.5585C10.1367 14.5585 10.3891 14.5505 11.2327 14.512C12.0131 14.4764 12.4364 14.3462 12.7185 14.2364C13.0916 14.0909 13.3585 13.9185 13.6385 13.6385C13.904 13.3804 14.1084 13.0655 14.2364 12.7185C14.3462 12.4364 14.4764 12.0131 14.512 11.2327C14.5505 10.3891 14.5585 10.136 14.5585 8C14.5585 5.864 14.5505 5.61091 14.512 4.76727C14.4764 3.98691 14.3462 3.56364 14.2364 3.28145C14.0909 2.90836 13.9185 2.64145 13.6385 2.36145C13.3803 2.09605 13.066 1.89179 12.7185 1.76364C12.4364 1.65382 12.0131 1.52364 11.2327 1.488ZM6.97818 10.4662C7.54884 10.7037 8.18428 10.7358 8.77595 10.5569C9.36762 10.378 9.87883 9.99921 10.2223 9.48527C10.5657 8.97132 10.72 8.35409 10.6589 7.73899C10.5978 7.12388 10.3251 6.54907 9.88727 6.11273C9.60817 5.8338 9.2707 5.62023 8.89915 5.48738C8.5276 5.35453 8.13122 5.30572 7.73854 5.34445C7.34586 5.38318 6.96666 5.50849 6.62822 5.71137C6.28979 5.91424 6.00054 6.18963 5.78131 6.51771C5.56208 6.84579 5.41832 7.21839 5.36038 7.6087C5.30243 7.99901 5.33175 8.3973 5.44621 8.77492C5.56068 9.15254 5.75744 9.50008 6.02234 9.79253C6.28724 10.085 6.61369 10.315 6.97818 10.4662ZM5.09236 5.09236C5.4742 4.71053 5.92751 4.40764 6.4264 4.20099C6.92529 3.99434 7.46 3.88798 8 3.88798C8.54 3.88798 9.07471 3.99434 9.5736 4.20099C10.0725 4.40764 10.5258 4.71053 10.9076 5.09236C11.2895 5.4742 11.5924 5.92751 11.799 6.4264C12.0057 6.92529 12.112 7.46 12.112 8C12.112 8.54 12.0057 9.07471 11.799 9.5736C11.5924 10.0725 11.2895 10.5258 10.9076 10.9076C10.1365 11.6788 9.09058 12.112 8 12.112C6.90942 12.112 5.86352 11.6788 5.09236 10.9076C4.32121 10.1365 3.88798 9.09058 3.88798 8C3.88798 6.90942 4.32121 5.86352 5.09236 5.09236ZM13.024 4.50036C13.1186 4.41111 13.1944 4.30377 13.2468 4.18471C13.2992 4.06565 13.3271 3.93729 13.329 3.80722C13.3309 3.67716 13.3067 3.54803 13.2578 3.4275C13.2089 3.30696 13.1363 3.19746 13.0443 3.10548C12.9524 3.0135 12.8429 2.94091 12.7223 2.89201C12.6018 2.84311 12.4727 2.81889 12.3426 2.82079C12.2125 2.82268 12.0842 2.85066 11.9651 2.90305C11.8461 2.95545 11.7387 3.0312 11.6495 3.12582C11.4759 3.30984 11.3808 3.55427 11.3845 3.80722C11.3882 4.06017 11.4903 4.30173 11.6692 4.48061C11.8481 4.6595 12.0896 4.76162 12.3426 4.76531C12.5955 4.769 12.84 4.67396 13.024 4.50036Z" fill="#111111"></path>
                        </svg>
                    </a>
                </div>



            </div>
        </div>

        <!-- Main Footer Links -->
        <div class="py-10 md:py-16 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8 md:gap-10 px-4 w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
            <!-- Brand Info -->
            <div class="col-span-2 md:col-span-3 lg:col-span-1 flex flex-col gap-6">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-1">
                    <img class="w-10 h-10 object-cover" src="<?php echo esc_url( get_template_directory_uri() . '/dist/images/v2/logo-icon.png' ); ?>" alt="">
                    <img class="w-28 h-auto object-cover" src="<?php echo esc_url( get_template_directory_uri() . '/dist/images/v2/logo-text.png' ); ?>" alt="Creative Furniture">
                </a>
                <p class="text-[#484848] text-sm leading-relaxed opacity-80">
                    <?php echo esc_html__( 'Creative Furniture is a furniture store in Dubai that specializes in the design, production, and distribution of inexpensive, customizable, and modern furniture for the home, office, outdoor, hospitality, banks, kids, and workplace.', 'creative-furniture' ); ?>
                </p>
            </div>

            <!-- Menus -->
            <?php
            $footer_menus = [
                [
                    __('Quick Links', 'creative-furniture'),
                    [
                        [
                            __('About Us', 'creative-furniture'),
                            '/about-us/'
                        ],
                        [
                            __('Delivery & Installation', 'creative-furniture'),
                            '/delivery-installation/'
                        ],
                        [
                            __('Materials & Finishes', 'creative-furniture'),
                            '/materials-finishes/'
                        ],
                        [
                            __('Warranty Policy', 'creative-furniture'),
                            '/warranty-policy/'
                        ],
                        [
                            __('Order Tracking', 'creative-furniture'),
                            '/order-tracking/'
                        ],
                    ]
                ],
                [
                    __('Shop', 'creative-furniture'),
                    [
                        [
                            __('Office Chairs', 'creative-furniture'),
                            '/product-category/office-chairs/'
                        ],
                        [
                            __('Executive Desks', 'creative-furniture'),
                            '/product-category/executive-desks/'
                        ],
                        [
                            __('Modular Workstations', 'creative-furniture'),
                            '/product-category/workstations/'
                        ],
                        [
                            __('Height Adjustable Desks', 'creative-furniture'),
                            '/product-category/sit-stand-desks/'
                        ],
                        [
                            __('Storage Solutions', 'creative-furniture'),
                            '/product-category/storage/'
                        ],
                    ]
                ],
                [
                    __('Learn More', 'creative-furniture'),
                    [
                        [
                            __('Sell With Us', 'creative-furniture'),
                            '/sell-with-us/'
                        ],
                        [
                            __('Hardware & Mechanisms', 'creative-furniture'),
                            '/mechanisms/'
                        ],
                        [
                            __('Leather & Fabric Care', 'creative-furniture'),
                            '/care-guide/'
                        ],
                        [
                            __('Ergonomic Seating', 'creative-furniture'),
                            '/ergonomic-guide/'
                        ],
                        [
                            __('Meeting Table Sizes', 'creative-furniture'),
                            '/size-guide/'
                        ],
                    ]
                ],
                [
                    __('Resources', 'creative-furniture'),
                    [
                        [
                            __('Planning Ideas', 'creative-furniture'),
                            '/planning/'
                        ],
                        [
                            __('Design Inspiration', 'creative-furniture'),
                            '/inspiration/'
                        ],
                        [
                            __('3D Model Library', 'creative-furniture'),
                            '/3d-models/'
                        ],
                        [
                            __('Terms & Conditions', 'creative-furniture'),
                            '/terms-conditions/'
                        ],
                        [
                            __('Client Login', 'creative-furniture'),
                            '/my-account/'
                        ],
                    ]
                ],
                [
                    __('Contact Us', 'creative-furniture'),
                    [
                        [
                            __('Get in Touch', 'creative-furniture'),
                            '/contact-us/'
                        ],
                        [
                            __('Support Center', 'creative-furniture'),
                            '/support/'
                        ],
                        [
                            __('Become a Partner', 'creative-furniture'),
                            '/sell-with-us/'
                        ],
                        [
                            __('About Us', 'creative-furniture'),
                            '/about/'
                        ],
                        [
                            __('Visit Showrooms', 'creative-furniture'),
                            '/showrooms/'
                        ],
                    ]
                ]
            ];

            foreach ($footer_menus as [$title, $items]) : ?>
                <div class="flex flex-col gap-5">
                    <h4 class="text-[#121212] font-semibold text-sm sm:text-base">
                        <?php echo esc_html__($title, 'creative-furniture'); ?>
                    </h4>
                    <ul class="flex flex-col gap-3">
                        <?php foreach ($items as [$label, $link]) : ?>
                            <li>
                                <a href="<?php echo esc_url(home_url($link)); ?>" class="text-[#484848] text-sm hover:text-[#bd262a] transition-colors flex items-center gap-2 opacity-80">
                                    <svg class="w-3 h-3 flex-shrink-0" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <span><?php echo esc_html__($label, 'creative-furniture'); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Bottom Copyright -->
        <div class="border-t border-black/5 py-6 text-center">
            <p class="text-[#484848] text-xs md:text-sm opacity-80 uppercase tracking-wider font-medium">
                <?php printf( 
                    esc_html__( '&copy; Copyright %s Creative Furniture All Rights Reserved', 'creative-furniture' ), 
                    date('Y') 
                ); ?>
            </p>
        </div>
    </div>
</footer>

</div>

<style>
#language-switcher-menu > li > a::after,
#mymc-switcher::after {
  top: 50%;
  width: 20px;
  right: -5px;
  height: 10px;
  content: " ";
  position: absolute;
  transform: translateY(-5px);
  background-position: center;
  background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIGNsYXNzPSJzaHJpbmstMCB3LTUgaC01IHJlbGF0aXZlIG92ZXJmbG93LXZpc2libGUiIHN0eWxlPSJhc3BlY3QtcmF0aW86IDEiIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDIwIDIwIiBmaWxsPSJub25lIj4KICAgICAgICAgICAgICAgICAgICAgICAgPHBhdGggZD0iTTUgNy41TDEwIDEyLjVMMTUgNy41IiBzdHJva2U9IiMxOTE5MTkiIHN0cm9rZS13aWR0aD0iMS42NyIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIi8+CiAgICAgICAgICAgICAgICAgICAgICA8L3N2Zz4=");
}
</style>

<?php wp_footer(); ?>
</body>
</html>