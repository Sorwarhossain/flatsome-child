<?php
// Add custom Theme Functions here

remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

add_action( 'custom_payment_methods_replacement', 'woocommerce_checkout_payment', 10 );



add_filter( 'gettext', 'ld_custom_checkout_button_text', 20, 3 );
function ld_custom_checkout_button_text( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
    case 'Proceed to PayPal' :
    $translated_text = __( 'Complete Purchase', 'woocommerce' );
    break;
}
return $translated_text;
}