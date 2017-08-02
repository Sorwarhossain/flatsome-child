<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$row_classes = array();
$main_classes = array();
$sidebar_classes = array();

$layout = get_theme_mod('checkout_layout');

if(!$layout){
  $sidebar_classes[] = 'has-border';
}

if($layout == 'simple'){
  $sidebar_classes[] = 'is-well';
}

$row_classes = implode(" ", $row_classes);
$main_classes = implode(" ", $main_classes);
$sidebar_classes = implode(" ", $sidebar_classes);

wc_print_notices(); ?>

<?php

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() ); ?>

<?php
// Social login
if(flatsome_option('facebook_login_checkout') && get_option('woocommerce_enable_myaccount_registration')=='yes' && !is_user_logged_in()){
	wc_get_template('checkout/social-login.php');
} ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

	<div class="row pt-0 <?php echo $row_classes; ?>">
  	<div class="large-4 col  <?php echo $main_classes; ?>">
    <?php if ( $checkout->checkout_fields ) : ?>

  		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

  		<div id="customer_details">
  			<div class="clear">
  				<?php do_action( 'woocommerce_checkout_billing' ); ?>
  			</div>
  			<div class="clear">
  				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
  			</div>
  		</div>

  		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

  	<?php endif; ?>
  	</div><!-- large-7 -->

    <div class="large-4 col">
      <h3 class="bill_title"><span>2</span> Confirm Payment Details </h3>
      <?php do_action('custom_payment_methods_replacement'); ?>
    </div>

  	<div class="large-4 col">
  			<div class="checkout-sidebar sm-touch-scroll">
  				<h3 id="order_review_heading" class="bill_title"><span>3</span> <?php _e( 'Your order', 'woocommerce' ); ?></h3>
  				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

  				<div id="order_review" class="woocommerce-checkout-review-order">
  					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
  				</div>
  				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
          
          <!-- replace the place order btn -->
          <div class="form-row place-order">
            <noscript>
              <?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ); ?>
              <br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>" />
            </noscript>

            <?php wc_get_template( 'checkout/terms.php' ); ?>

            <?php do_action( 'woocommerce_review_order_before_submit' ); ?>

            <input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order_cus" value="Complete Purchase" data-value="Complete Purchase" />

            <?php do_action( 'woocommerce_review_order_after_submit' ); ?>

            <?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>
          </div>
          <!-- replace the place order btn -->

  			</div>
  	</div><!-- large-5 -->

	</div><!-- row -->
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
