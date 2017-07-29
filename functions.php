<?php
// Add custom Theme Functions here

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

add_action( 'custom_payment_methods_replacement', 'woocommerce_checkout_payment', 10 );