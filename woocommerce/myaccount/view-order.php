<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<?php

$carrier_name = get_post_meta( $order->get_id(), 'ywot_carrier_name', true );
$pick_up_date = get_post_meta( $order->get_id(), 'ywot_pick_up_date', true );
$tracking_code = get_post_meta( $order->get_id(), 'ywot_tracking_code', true );
$picked_up = get_post_meta( $order->get_id(), 'ywot_picked_up', true );
if($carrier_name or $pick_up_date or $tracking_code) :
?>
<p class="single-order-title"><?php
	if($picked_up){
		$output = 'Your order is shipped';
	} else {
		$output = 'Your order will be shipped';
	}
	if($carrier_name){
		$output .= ' by <mark>"' . $carrier_name . '"</mark>';
	} 
	if($pick_up_date){
		$output .= ' on <mark>"' . $pick_up_date . '"</mark>';
	}
	if($tracking_code){
		$output .= ' and your track code is <mark>"' . $tracking_code . '"</mark>' . '.';
	}
	echo $output;
?></p>
<?php endif; ?>


<p class="single-order-title"><?php
/* translators: 1: order number 2: order date 3: order status */
printf(
	__( 'Order # %1$s was placed on %2$s and is currently %3$s.', 'woocommerce' ),'<mark class="order-number">' . $order->get_order_number() . '</mark>',
'<mark class="order-date">' . wc_format_datetime( $order->get_date_created() ) . '</mark>',
'<mark class="order-status">' . wc_get_order_status_name( $order->get_status() ) . '</mark>');
?></p>



<?php if ( $notes = $order->get_customer_order_notes() ) : ?>
	<h2><?php _e( 'Order updates', 'woocommerce' ); ?></h2>
	<ol class="woocommerce-OrderUpdates commentlist notes">
		<?php foreach ( $notes as $note ) : ?>
		<li class="woocommerce-OrderUpdate comment note">
			<div class="woocommerce-OrderUpdate-inner comment_container">
				<div class="woocommerce-OrderUpdate-text comment-text">
					<p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); ?></p>
					<div class="woocommerce-OrderUpdate-description description">
						<?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
					</div>
	  				<div class="clear"></div>
	  			</div>
				<div class="clear"></div>
			</div>
		</li>
		<?php endforeach; ?>
	</ol>
<?php endif; ?>

<div class="container">
	<div class="row order_details">
		<div class="large-4 medium-6 col">
			<h3>Shpping Address</h3>
			<address>
				<?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'woocommerce' ); ?>
			</address>
		</div>
		<div class="large-4 medium-6 col">
			<h3>Billing Address</h3>
			<address>
				<?php echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'woocommerce' ); ?>
			</address>
		</div>
		<div class="large-4 medium-6 col">
			<h3>Payment Methods</h3>
			<strong><?php echo  $order->get_payment_method_title(); ?></strong>
		</div>
	</div>
</div>

<p class="single-order-title">Ordered Items</p>

<div class="order_products">
	<div class="container">
		<div class="row border_bottom_1">
			<div class="large-2 medium-6 col">
				<h4 class="product_title">Product</h4>
			</div>
			<div class="large-5 medium-6 col">
				<h4 class="product_title">Description</h4>
			</div>
			<div class="large-3 medium-6 col">
				<h4 class="product_title">Status</h4>
			</div>
			<div class="large-2 medium-6 col">
				<h4 class="product_title product_price_title">Price</h4>
			</div>
		</div>
		<?php
			foreach ( $order->get_items() as $item_id => $item ) {
				$product = apply_filters( 'woocommerce_order_item_product', $item->get_product(), $item );

				wc_get_template( 'myaccount/custom-view-order-product-list.php', array(
					'order'			     => $order,
					'item_id'		     => $item_id,
					'item'			     => $item,
					'show_purchase_note' => $show_purchase_note,
					'purchase_note'	     => $product ? $product->get_purchase_note() : '',
					'product'	         => $product,
				) );
			}
		?>

		<div class="row order_products_bottom border_bottom_0">
		<?php
		foreach ( $order->get_order_item_totals() as $key => $total ){ ?>
			<div class="large-3 col"></div>
			<div class="large-3 col"></div>
			<div class="large-3 col">
				<span class="label"><?php echo $total['label']; ?></span>
			</div>
			<div class="large-3 col">
				<?php echo $total['value']; ?>
			</div>
		<?php } //end of foreach

		?>
		</div>
	</div>
</div>

