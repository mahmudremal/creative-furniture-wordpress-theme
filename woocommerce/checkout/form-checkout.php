<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is required and not logged in, show login form.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<div class="flex flex-col gap-7 pt-10 pb-20">
    <!-- Breadcrumbs -->
    <div class="flex flex-row gap-2 items-center justify-start px-4 w-full max-w-full md:w-[1440px] m-auto relative">
        <div class="text-[#989898] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home', 'creative-furniture'); ?></a>
        </div>
        <div class="text-[#989898] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">
            /
        </div>
        <div class="text-[#989898] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php esc_html_e('Cart', 'creative-furniture'); ?></a>
        </div>
        <div class="text-[#989898] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">
            /
        </div>
        <div class="text-[#000000] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">
            <?php esc_html_e('Checkout', 'creative-furniture'); ?>
        </div>
    </div>

    <form name="checkout" method="post" class="checkout woocommerce-checkout flex flex-col gap-7 px-4 w-full max-w-full md:w-[1440px] m-auto relative" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
        <div class="flex flex-row md:grid md:grid-cols-[2fr_1fr] gap-7 flex-wrap gap-0 items-start justify-start w-full max-w-full md:w-[1440px] mx-auto relative">
            <!-- Left Side: Checkout Details -->
            <div class="bg-[#ffffff] md:pr-10 flex flex-col gap-4 items-start justify-start shrink-0 w-full md:w-[805px] relative">
                <div class="flex flex-col gap-3 items-start justify-start shrink-0 relative">
                    <h1 class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative self-stretch flex items-center justify-start">
                        <?php esc_html_e('Checkout', 'creative-furniture'); ?>
                    </h1>
                </div>

                <!-- Express Checkout -->
                <div class="flex flex-col gap-5 items-center justify-start self-stretch shrink-0 relative">
                    <div class="flex flex-row gap-3 items-center justify-start self-stretch shrink-0 relative">
                        <div class="border-t border-[#d4d4d4] flex-1 h-0 relative"></div>
                        <div class="text-[#717171] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">
                            <?php esc_html_e('Express checkout', 'creative-furniture'); ?>
                        </div>
                        <div class="border-t border-[#d4d4d4] flex-1 h-0 relative"></div>
                    </div>
                    <img class="shrink-0 w-[640px] h-[47px] relative" style="object-fit: cover; aspect-ratio: 640/47" src="<?php echo get_template_directory_uri(); ?>/dist/images/payment-methods.png">
                    <div class="flex flex-row gap-3 items-center justify-start self-stretch shrink-0 relative">
                        <div class="border-t border-[#d4d4d4] flex-1 h-0 relative"></div>
                        <div class="text-[#717171] text-left font-['Raleway-Regular',_sans-serif] text-base leading-6 font-normal relative flex items-center justify-start">
                            <?php esc_html_e('OR', 'creative-furniture'); ?>
                        </div>
                        <div class="border-t border-[#d4d4d4] flex-1 h-0 relative"></div>
                    </div>
                </div>

                <?php if ( $checkout->get_checkout_fields() ) : ?>
                    <!-- Contact Information -->
                    <div class="flex flex-col gap-0 items-start justify-start self-stretch shrink-0 relative">
                        <div class="flex flex-row gap-2.5 items-center justify-between self-stretch shrink-0 relative">
                            <div class="text-[#111111] text-left font-['Raleway-SemiBold',_sans-serif] text-xl leading-[30px] font-semibold relative flex-1">
                                <?php esc_html_e('Contact information', 'creative-furniture'); ?>
                            </div>
                            <?php if ( ! is_user_logged_in() ) : ?>
                            <div class="text-[#737373] text-left font-['Raleway-Regular',_sans-serif] text-base leading-6 font-normal relative">
                                <?php esc_html_e('Already have an account?', 'creative-furniture'); ?> 
                                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="text-[#2d2d2d] font-semibold underline"><?php esc_html_e('Log in', 'creative-furniture'); ?></a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex flex-col gap-3.5 items-start justify-start self-stretch shrink-0 relative contact-fields-grid">
                            <?php
                            // Just email for contact info as per design
                            $billing_fields = $checkout->get_checkout_fields( 'billing' );
                            if ( isset( $billing_fields['billing_email'] ) ) {
                                $billing_fields['billing_email']['class'][] = 'flex flex-col gap-0 w-full';
                                $billing_fields['billing_email']['input_class'][] = 'bg-white border-[#d4d4d4] border px-4 pt-6 pb-2 h-14 w-full font-[\'Raleway-Regular\'] text-base focus:ring-black focus:border-black';
                                $billing_fields['billing_email']['label_class'][] = 'text-[#717171] font-[\'Raleway-Regular\'] text-sm translate-y-full px-4 pt-2';
                                
                                woocommerce_form_field( 'billing_email', $billing_fields['billing_email'], $checkout->get_value( 'billing_email' ) );
                            }
                            ?>

                            <div class="flex flex-row gap-3 items-center justify-start shrink-0 relative mt-2">
                                <label class="flex items-center cursor-pointer gap-3">
                                    <input type="checkbox" class="peer hidden" name="email_subscribe" id="email_subscribe" />
                                    <div class="bg-transparent border-[#212121] border-2 rounded-[54px] shrink-0 w-5 h-5 relative overflow-hidden transition-all duration-200 peer-checked:bg-[#212121]">
                                        <svg class="w-[70%] h-[70%] absolute right-[15%] left-[15%] bottom-[15%] top-[15%] overflow-visible" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.6668 3.5L5.25016 9.91667L2.3335 7" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                </label>
                                <label for="email_subscribe" class="text-[#737373] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start">
                                    <?php esc_html_e('Email me with news and offers', 'creative-furniture'); ?>
                                </label>
                            </div>
                            
                            
                        </div>
                    </div>

                    <!-- Payment Section -->
                    <div class="flex flex-col gap-4 items-start justify-start self-stretch shrink-0 relative payment-method-section">
                        <div class="flex flex-col gap-1 items-start justify-center self-stretch shrink-0 relative">
                            <div class="text-[#111111] text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative self-stretch flex items-center justify-start">
                                <?php esc_html_e('Payment', 'creative-furniture'); ?>
                            </div>
                            <div class="text-[#737373] text-left font-['Raleway-Regular',_sans-serif] text-base leading-6 font-normal relative flex items-center justify-start">
                                <?php esc_html_e('All transactions are secure and encrypted.', 'creative-furniture'); ?>
                            </div>
                        </div>
                        <div id="payment" class="woocommerce-checkout-payment w-full">
                            <?php woocommerce_checkout_payment(); ?>
                        </div>
                    </div>

                    <!-- Shipping/Billing Section -->
                    <div class="flex flex-col gap-4 items-start justify-start self-stretch shrink-0 relative address-section">
                        <div class="flex flex-col gap-1 items-start justify-center self-stretch shrink-0 relative">
                            <div class="text-[#111111] text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative self-stretch flex items-center justify-start">
                                <?php esc_html_e('Billing Address', 'creative-furniture'); ?>
                            </div>
                            <div class="text-[#737373] text-left font-['Raleway-Regular',_sans-serif] text-base leading-6 font-normal relative flex items-center justify-start">
                                <?php esc_html_e('Select the address that matches your card or payment method.', 'creative-furniture'); ?>
                            </div>
                        </div>
                        
                        <div class="w-full">
                            <?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
                            <?php do_action( 'woocommerce_checkout_billing' ); ?>
                            <?php do_action( 'woocommerce_checkout_shipping' ); ?>
                            <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex flex-col gap-4 items-start justify-start self-stretch shrink-0 relative">
                        <div class="text-[#111111] text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative self-stretch flex items-center justify-start">
                            <?php esc_html_e('Remember Me', 'creative-furniture'); ?>
                        </div>
                        <div class="bg-[#ffffff] border-solid border-[#e9eaf0] border p-4 flex flex-row gap-6 items-center justify-start self-stretch shrink-0 h-14 relative">
                            <div class="flex flex-row gap-3 items-center justify-start flex-1 relative">
                                <label class="flex items-center cursor-pointer gap-3">
                                    <input type="checkbox" class="peer hidden" name="save_account_info" id="save_account_info" />
                                    <div class="bg-transparent border-[#212121] border-2 rounded-[54px] shrink-0 w-5 h-5 relative overflow-hidden transition-all duration-200 peer-checked:bg-[#212121]">
                                        <svg class="w-[70%] h-[70%] absolute right-[15%] left-[15%] bottom-[15%] top-[15%] overflow-visible" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.6668 3.5L5.25016 9.91667L2.3335 7" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                </label>
                                <label for="save_account_info" class="text-[#717171] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">
                                    <?php esc_html_e('Save my information for a faster checkout', 'creative-furniture'); ?>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-row gap-11 items-center justify-between self-stretch shrink-0 relative pt-5">
                        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="flex flex-row gap-1 items-center justify-start text-[#565656]">
                            <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <span class="text-sm leading-5 font-normal font-['Raleway-Regular']">Return to cart</span>
                        </a>
                        <button type="submit" class="bg-[#000000] -rounded-lg pt-3 pr-5 pb-3 pl-5 flex flex-row gap-2.5 items-center justify-center flex-1 relative" name="woocommerce_checkout_place_order" id="place_order" value="Pay now">
                            <span class="text-[#ffffff] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">Pay now</span>
                        </button>
                        <?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
                    </div>

                <?php endif; ?>
            </div>
            <!-- Right Side: Order Summary -->
            <div class="bg-[#f4f4f4] -rounded-xl p-4 md:p-6 flex flex-col gap-8 items-start justify-start self-stretch flex-1 relative h-fit sticky top-0">
                <div id="order_review" class="woocommerce-checkout-review-order w-full">
                    <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                </div>
                
                <img class="shrink-0 w-full relative mt-0" style="object-fit: cover; aspect-ratio: 366/27" src="<?php echo get_template_directory_uri(); ?>/dist/images/payment-methods.png">
            </div>
        </div>
    </form>
</div>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const args = {
        initialCountry: 'ae',
        countryNameLocale: "ae",
        onlyCountries: ['ae', 'sa', 'kw', 'om', 'bh', 'qa', 'bd'],
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@26.7.6/build/js/utils.js",
        containerClass: 'w-full',
        i18n: {
            noCountrySelected: "<?php esc_attr_e('Select country', 'creative-furniture'); ?>",
            countryListAriaLabel: "<?php esc_attr_e('List of countries', 'creative-furniture'); ?>",
            searchPlaceholder: "<?php esc_attr_e('Search', 'creative-furniture'); ?>",
            clearSearchAriaLabel: "<?php esc_attr_e('Clear search', 'creative-furniture'); ?>",
            searchEmptyState: "<?php esc_attr_e('No results found', 'creative-furniture'); ?>",
        }
    };
    document.querySelectorAll("input[type=tel]").forEach(input => window.intlTelInput(input, args));
  });
</script>
<style>
  .iti__arrow {
    border: none;
  }
  .iti__arrow::after {
    content: " ";
    height: 10px;
    width: 20px;
    position: absolute;
    top: 50%;
    right: -10px;
    transform: translateY(-5px);
    background-image: url("data:image/svg+xml;base64,PHN2ZyBjbGFzcz0ic2hyaW5rLTAgdy01IGgtNSByZWxhdGl2ZSBvdmVyZmxvdy12aXNpYmxlIiBzdHlsZT0iYXNwZWN0LXJhdGlvOiAxIiB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KICAgICAgICAgICAgICAgICAgICAgICAgPHBhdGggZD0iTTUgNy41TDEwIDEyLjVMMTUgNy41IiBzdHJva2U9IiM4QzhDOEMiIHN0cm9rZS13aWR0aD0iMS42NyIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48L3BhdGg+CiAgICAgICAgICAgICAgICAgICAgICA8L3N2Zz4=");
    background-position: center;
    background-repeat: no-repeat;
  }
  .iti__country-container + input {
    padding-left: 52px !important;
  }
</style>