<?php
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' );
?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<div class="account-section">
		<div class="section-header">
			<div class="section-title">Account</div>
		</div>
		<div class="fields-container">
			<div class="fields-row">
				<div class="field">
					<div class="field-label">First Name</div>
					<div class="field-input">
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" aria-required="true" />
					</div>
				</div>
				<div class="field">
					<div class="field-label">Last Name</div>
					<div class="field-input">
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" aria-required="true" />
					</div>
				</div>
			</div>
			<div class="fields-row">
				<div class="field">
					<div class="field-label">Phone Number</div>
					<div class="field-input">
						<input type="tel" class="woocommerce-Input woocommerce-Input--tel input-text" name="account_phone" id="account_phone" value="<?php echo esc_attr( get_user_meta( $user->ID, 'billing_phone', true ) ); ?>" />
					</div>
				</div>
				<div class="field">
					<div class="field-label">Email Address</div>
					<div class="field-input">
						<input type="email" class="woocommerce-Input woocommerce-Input--email input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" aria-required="true" />
					</div>
				</div>
			</div>
		</div>
		<div class="save-button">
			<button type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>">Save Info</button>
		</div>
	</div>

	<div class="password-section">
		<div class="section-header">
			<div class="section-title">Reset Password</div>
		</div>
		<div class="fields-container">
			<div class="fields-row">
				<div class="field">
					<div class="field-label">New password</div>
					<div class="field-input field-input-password">
						<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_1" id="password_1" autocomplete="off" />
						<!-- <div class="password-toggle">
							<svg class="eye-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="20" height="20" fill="white"/>
								<path d="M2.01677 10.5937C1.90328 10.414 1.84654 10.3241 1.81477 10.1855C1.79091 10.0814 1.79091 9.91727 1.81477 9.81317C1.84654 9.67458 1.90328 9.58473 2.01677 9.40503C2.95461 7.92005 5.74617 4.16602 10.0003 4.16602C14.2545 4.16602 17.0461 7.92005 17.9839 9.40503C18.0974 9.58473 18.1541 9.67458 18.1859 9.81317C18.2098 9.91727 18.2098 10.0814 18.1859 10.1855C18.1541 10.3241 18.0974 10.414 17.9839 10.5937C17.0461 12.0786 14.2545 15.8327 10.0003 15.8327C5.74617 15.8327 2.95461 12.0786 2.01677 10.5937Z" stroke="#525252" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M10.0003 12.4993C11.381 12.4993 12.5003 11.3801 12.5003 9.99935C12.5003 8.61864 11.381 7.49935 10.0003 7.49935C8.61962 7.49935 7.50034 8.61864 7.50034 9.99935C7.50034 11.3801 8.61962 12.4993 10.0003 12.4993Z" stroke="#525252" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div> -->
					</div>
				</div>
				<div class="field">
					<div class="field-label">Confirm Password</div>
					<div class="field-input field-input-password">
						<input type="password" class="woocommerce-Input woocommerce-Input--password input-text" name="password_2" id="password_2" autocomplete="off" />
						<!-- <div class="password-toggle">
							<svg class="eye-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<rect width="20" height="20" fill="white"/>
								<path d="M2.01677 10.5937C1.90328 10.414 1.84654 10.3241 1.81477 10.1855C1.79091 10.0814 1.79091 9.91727 1.81477 9.81317C1.84654 9.67458 1.90328 9.58473 2.01677 9.40503C2.95461 7.92005 5.74617 4.16602 10.0003 4.16602C14.2545 4.16602 17.0461 7.92005 17.9839 9.40503C18.0974 9.58473 18.1541 9.67458 18.1859 9.81317C18.2098 9.91727 18.2098 10.0814 18.1859 10.1855C18.1541 10.3241 18.0974 10.414 17.9839 10.5937C17.0461 12.0786 14.2545 15.8327 10.0003 15.8327C5.74617 15.8327 2.95461 12.0786 2.01677 10.5937Z" stroke="#525252" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M10.0003 12.4993C11.381 12.4993 12.5003 11.3801 12.5003 9.99935C12.5003 8.61864 11.381 7.49935 10.0003 7.49935C8.61962 7.49935 7.50034 8.61864 7.50034 9.99935C7.50034 11.3801 8.61962 12.4993 10.0003 12.4993Z" stroke="#525252" stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		<div class="save-button">
			<button type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>">Reset Password</button>
		</div>
	</div>

	<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
	<input type="hidden" name="action" value="save_account_details" />

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>