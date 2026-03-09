<?php

defined( 'ABSPATH' ) || exit;
?>
<form name="checkout" method="post" class="woocommerce-form woocommerce-verify-email" action="<?php echo esc_url( $verify_url ); ?>">

	<?php
	wp_nonce_field( 'wc_verify_email', 'check_submission' );

	if ( $failed_submission ) {
		wc_print_notice( esc_html__( 'We were unable to verify the email address you provided. Please try again.', 'woocommerce' ), 'error' );
	}
	?>
	<p>
		<?php
		printf(
			/* translators: 1: opening login link 2: closing login link */
			esc_html__( 'To view this page, you must either %1$slogin%2$s or verify the email address associated with the order.', 'woocommerce' ),
			'<a href="' . esc_url( wc_get_page_permalink( 'myaccount' ) ) . '">',
			'</a>'
		);
		?>
	</p>

	<p class="form-row">
		<label for="email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="email" class="input-text" name="email" id="email" autocomplete="email" />
	</p>

	<p class="form-row">
		<button type="submit" class="woocommerce-button button <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ); ?>" name="verify" value="1">
			<?php esc_html_e( 'Verify', 'woocommerce' ); ?>
		</button>
	</p>
</form>
