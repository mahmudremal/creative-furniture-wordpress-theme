<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'woocommerce' ) : esc_html__( 'Shipping address', 'woocommerce' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
    <div class="flex flex-col gap-10 w-full max-w-full md:w-[1440px] m-auto relative">
        <div class="flex flex-row items-start justify-between self-stretch shrink-0 relative">
            <div class="flex flex-col gap-3 items-start justify-start shrink-0 relative">
                <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative self-stretch flex items-center justify-start">
                    Addresses
                </div>
                <div class="text-text-and-icon-secondary text-left font-['Raleway-Regular',_sans-serif] text-base leading-6 font-normal relative self-stretch flex items-center justify-start">
                    Manage your billing and shipping addresses for a faster checkout experience.
                </div>
            </div>
        </div>

        <div class="flex flex-row gap-6 items-start justify-start self-stretch shrink-0 relative">
            <?php
            $get_addresses = apply_filters(
                'woocommerce_my_account_get_addresses',
                array(
                    'billing'  => __( 'Billing address', 'woocommerce' ),
                    'shipping' => __( 'Shipping address', 'woocommerce' ),
                ),
                get_current_user_id()
            );

            foreach ( $get_addresses as $name => $address_title ) :
                $address = wc_get_account_formatted_address( $name );
                ?>
                <div class="bg-[#f4f4f4] p-6 flex flex-col gap-10 items-start justify-start flex-1 relative min-h-[300px]">
                    <div class="flex flex-col gap-2 items-start justify-start self-stretch shrink-0 relative">
                        <div class="flex flex-row gap-2 items-center justify-between self-stretch shrink-0 relative">
                            <div class="text-text-and-icon-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-lg leading-6 font-semibold relative">
                                <?php echo esc_html( $address_title ); ?>
                            </div>
                            <a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit">
                                <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.87604 18.1159C2.92198 17.7024 2.94496 17.4957 3.00751 17.3025C3.06301 17.131 3.14143 16.9679 3.24064 16.8174C3.35246 16.6478 3.49955 16.5008 3.79373 16.2066L17 3.0003C18.1046 1.89573 19.8955 1.89573 21 3.0003C22.1046 4.10487 22.1046 5.89573 21 3.0003C22.1046 4.10487 22.1046 5.89573 21 7.0003L7.79373 20.2066C7.49955 20.5008 7.35245 20.6479 7.18289 20.7597C7.03245 20.8589 6.86929 20.9373 6.69785 20.9928C6.5046 21.0553 6.29786 21.0783 5.88437 21.1243L2.5 21.5003L2.87604 18.1159Z" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 items-start justify-start self-stretch shrink-0 relative">
                        <address class="text-[#525252] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-6 font-normal relative self-stretch not-italic" style="opacity: 0.8">
                            <?php echo $address ? wp_kses_post( $address ) : esc_html__( 'You have not set up this type of address yet.', 'woocommerce' ); ?>
                        </address>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else : ?>
    <div class="bg-[#f4f4f4] p-10 rounded-xl w-full max-w-full md:w-[1440px] m-auto relative">
        <form method="post" class="flex flex-col gap-8">
            <div class="flex flex-col gap-2">
                <h3 class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold">
                    <?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?>
                </h3>
                <div class="text-[#717171] text-sm font-['Raleway-Regular']">
                    Please fill in your correct address details.
                </div>
            </div>

            <div class="woocommerce-address-fields">
                <?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

                <div class="woocommerce-address-fields__field-wrapper grid grid-cols-2 gap-6">
                    <?php
                    foreach ( $address as $key => $field ) {
                        // Add Tailwind classes to field args
                        $field['class'][] = 'flex flex-col gap-2';
                        $field['input_class'][] = 'bg-white border-[#d4d4d4] border p-4 h-14 w-full font-[\'Raleway-Regular\'] text-base focus:ring-black focus:border-black';
                        $field['label_class'][] = 'text-[#717171] font-[\'Raleway-Regular\'] text-sm';
                        
                        // Span wide fields
                        if ( in_array($key, ['billing_address_1', 'billing_address_2', 'billing_country', 'shipping_address_1', 'shipping_address_2', 'shipping_country']) ) {
                            echo '<div class="col-span-2">';
                            woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
                            echo '</div>';
                        } else {
                            woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
                        }
                    }
                    ?>
                </div>

                <?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

                <div class="mt-8 flex gap-4">
                    <button type="submit" class="bg-black text-white px-10 py-4 font-semibold font-['Raleway-SemiBold'] text-base min-w-[200px]" name="save_address" value="<?php esc_attr_e( 'Save address', 'woocommerce' ); ?>">
                        <?php esc_html_e( 'Save address', 'woocommerce' ); ?>
                    </button>
                    <?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
                    <input type="hidden" name="action" value="edit_address" />
                </div>
            </div>
        </form>
    </div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>
