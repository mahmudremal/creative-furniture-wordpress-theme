<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>
<!-- 
<p>
	<?php
	printf(
		/* translators: 1: user display name 2: logout url */
		wp_kses( __( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ), $allowed_html ),
		'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
		esc_url( wc_logout_url() )
	);
	?>
</p>

<p>
	<?php
	/* translators: 1: Orders URL 2: Address URL 3: Account URL. */
	$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">billing address</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
	if ( wc_shipping_enabled() ) {
		/* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
		$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
	}
	printf(
		wp_kses( $dashboard_desc, $allowed_html ),
		esc_url( wc_get_endpoint_url( 'orders' ) ),
		esc_url( wc_get_endpoint_url( 'edit-address' ) ),
		esc_url( wc_get_endpoint_url( 'edit-account' ) )
	);
	?>
</p> -->

    <?php
    $current_user = wp_get_current_user();
    $billing_phone = get_user_meta( $current_user->ID, 'billing_phone', true );
    ?>
    <div class="flex flex-wrap items-start justify-between w-full max-w-full md:w-[1440px] m-auto relative">
      <div class="bg-[#f4f4f4] p-6 flex flex-col gap-10 items-start justify-start shrink-0 w-full md:w-[689px] relative">
        <div class="flex flex-col gap-2 items-start justify-start self-stretch shrink-0 relative">
          <div class="text-text-and-icon-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-lg leading-6 font-semibold relative self-stretch">
            Personal Info
          </div>
          <div class="text-text-and-icon-secondary text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative self-stretch">
            Manage your data, email and subscriptions
          </div>
        </div>
        <div class="flex flex-col gap-1 items-start justify-start self-stretch shrink-0 relative">
          <div class="flex flex-row gap-2 items-start justify-start self-stretch shrink-0 relative">
            <div class="text-[#0a0909] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative flex-1">
              <?php echo esc_html( $current_user->display_name ); ?>
            </div>
            <div class="flex flex-row gap-5 items-center justify-end shrink-0 w-[69px] relative">
                <a href="<?php echo esc_url(wc_get_endpoint_url('edit-account')); ?>">
                    <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.87604 18.1159C2.92198 17.7024 2.94496 17.4957 3.00751 17.3025C3.06301 17.131 3.14143 16.9679 3.24064 16.8174C3.35246 16.6478 3.49955 16.5008 3.79373 16.2066L17 3.0003C18.1046 1.89573 19.8955 1.89573 21 3.0003C22.1046 4.10487 22.1046 5.89573 21 7.0003L7.79373 20.2066C7.49955 20.5008 7.35245 20.6479 7.18289 20.7597C7.03245 20.8589 6.86929 20.9373 6.69785 20.9928C6.5046 21.0553 6.29786 21.0783 5.88437 21.1243L2.5 21.5003L2.87604 18.1159Z" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
            </div>
          </div>
          <div class="flex flex-row gap-1 items-center justify-start self-stretch shrink-0 relative">
            <div class="text-[#525252] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex-1" style="opacity: 0.8">
              <?php echo esc_html( $current_user->user_email ); ?>
            </div>
          </div>
          <div class="flex flex-row gap-1 items-center justify-start self-stretch shrink-0 relative">
            <div class="text-[#525252] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex-1" style="opacity: 0.8">
              <?php echo esc_html( $billing_phone ? $billing_phone : __('Not set', 'creative-furniture') ); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-[#f4f4f4] p-6 flex flex-col gap-10 items-start justify-start self-stretch shrink-0 w-full md:w-[688px] relative">
        <div class="flex flex-col gap-2 items-start justify-start self-stretch shrink-0 relative">
          <div class="text-text-and-icon-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-lg leading-6 font-semibold relative self-stretch">
            <?php esc_html_e('Password', 'creative-furniture'); ?>
          </div>
          <div class="text-text-and-icon-secondary text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative self-stretch">
            <?php esc_html_e('Update or reset your login password securely', 'creative-furniture'); ?>
          </div>
        </div>
        <div class="flex flex-col gap-2 items-start justify-start self-stretch shrink-0 relative">
          <div class="text-[#0a0909] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative self-stretch">
            <?php esc_html_e('Current password', 'creative-furniture'); ?>
          </div>
          <div class="flex flex-row gap-1 items-center justify-start self-stretch shrink-0 relative">
            <div class="text-[#525252] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex-1" style="opacity: 0.8">
              *************
            </div>
            <div class="flex flex-row gap-5 items-center justify-end shrink-0 w-[69px] relative">
              <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.42012 12.7132C2.28394 12.4975 2.21584 12.3897 2.17772 12.2234C2.14909 12.0985 2.14909 11.9015 2.17772 11.7766C2.21584 11.6103 2.28394 11.5025 2.42012 11.2868C3.54553 9.50484 6.8954 5 12.0004 5C17.1054 5 20.4553 9.50484 21.5807 11.2868C21.7169 11.5025 21.785 11.6103 21.8231 11.7766C21.8517 11.9015 21.8517 11.9015 21.8231 11.7766C21.785 11.6103 21.7169 11.5025 21.5807 11.2868C20.4553 14.4952 17.1054 19 12.0004 19C6.8954 19 3.54553 14.4952 2.42012 12.7132Z" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M12.0004 15C13.6573 15 15.0004 13.6569 15.0004 12C15.0004 10.3431 13.6573 9 12.0004 9C10.3435 9 9.0004 10.3431 9.0004 12C9.0004 13.6569 10.3435 15 12.0004 15Z" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              <a href="<?php echo esc_url(wc_get_endpoint_url('edit-account')); ?>#password_1">
                <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2.87604 18.1159C2.92198 17.7024 2.94496 17.4957 3.00751 17.3025C3.06301 17.131 3.14143 16.9679 3.24064 16.8174C3.35246 16.6478 3.49955 16.5008 3.79373 16.2066L17 3.0003C18.1046 1.89573 19.8955 1.89573 21 3.0003C22.1046 4.10487 22.1046 5.89573 21 7.0003L7.79373 20.2066C7.49955 20.5008 7.35245 20.6479 7.18289 20.7597C7.03245 20.8589 6.86929 20.9373 6.69785 20.9928C6.5046 21.0553 6.29786 21.0783 5.88437 21.1243L2.5 21.5003L2.87604 18.1159Z" stroke="#525252" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php
	do_action( 'woocommerce_account_dashboard' );

	do_action( 'woocommerce_before_my_account' );

	do_action( 'woocommerce_after_my_account' );

