<?php
// Add custom Theme Functions here

/*remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

add_action( 'custom_payment_methods_replacement', 'woocommerce_checkout_payment', 10 );*/




add_action( 'wp_enqueue_scripts', 'child_checkout_enqueue_script' );
function child_checkout_enqueue_script(){
	if( is_checkout()){
		wp_register_style('responsive-tabs', get_stylesheet_directory_uri().'/css/responsive-tabs.css');
		wp_enqueue_style('responsive-tabs');

		wp_enqueue_script('responsiveTabs', get_stylesheet_directory_uri().'/js/jquery.responsiveTabs.min.js', array('jquery'), '1.0', true);
	}
	wp_enqueue_script('child-custom-js', get_stylesheet_directory_uri().'/js/custom.js', array('jquery'), '1.0', true);
}