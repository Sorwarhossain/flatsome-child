<?php
// Add custom Theme Functions here

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

add_action( 'custom_payment_methods_replacement', 'woocommerce_checkout_payment', 10 );






add_action( 'wp_enqueue_scripts', 'child_checkout_enqueue_script' );
function child_checkout_enqueue_script(){
	if( is_checkout()){
		wp_register_style('responsive-tabs', get_stylesheet_directory_uri().'/css/responsive-tabs.css');
		wp_enqueue_style('responsive-tabs');

		wp_enqueue_script('responsiveTabs', get_stylesheet_directory_uri().'/js/jquery.responsiveTabs.min.js', array('jquery'), '1.0', true);
	}
	wp_enqueue_script('child-custom-js', get_stylesheet_directory_uri().'/js/custom.js', array('jquery'), '1.0', true);
}


add_action( 'custom_payment_methods_replacement', 'woocommerce_account_create', 20 );

function woocommerce_account_create(){ 
	$checkout = new WC_Checkout();
?>
	
<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ) ?> type="checkbox" name="createaccount" value="1" /> <span><?php _e( 'CREATE AN ACCOUNT SO YOU CAN CHECKOUT FASTER, TRACK YOUR ORDER & ALLOW US TO HELP YOU EVERY STEP OF THE WAY', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>

<?php } // end of woocommerce_account_create




