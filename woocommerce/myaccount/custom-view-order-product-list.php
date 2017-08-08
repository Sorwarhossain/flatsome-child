<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$product = $order->get_product_from_item( $item );

$is_visible        = $product && $product->is_visible();
$product_permalink = apply_filters( 'woocommerce_order_item_permalink', $is_visible ? $product->get_permalink( $item ) : '', $item, $order );

$sku = $product->get_sku();
$attr = $product->get_attribute('size');
?>

<div class="row single-order-view-product border_bottom_1">
	<div class="large-2 medium-6 col product_img">
		<?php echo $product->get_image(); ?>
	</div>
	<div class="large-5 medium-6 col product_desc">
		<h3><?php echo apply_filters( 'woocommerce_order_item_name', $product_permalink ? sprintf( '<a href="%s">%s</a>', $product_permalink, $item->get_name() ) : $item->get_name(), $item, $is_visible ); ?></h3>
		<?php 
		if(!empty($sku)){
			echo '<p>SKU <span>'. $sku .'</span></p>';
		}
		?>
		<?php 
		if(!empty($attr)){
			echo '<p>Size <span>'. $attr .'</span></p>';
		}
		?>
	</div>
	<div class="large-3 medium-6 col product_status">
		<p class="status"><?php echo wc_get_order_status_name( $order->get_status() ); ?></p>
		<p>Last Update:<br/>
		<?php echo $order->modified_date; ?></p>
	</div>
	<div class="large-2 medium-6 col product_price">
		<p><?php echo $order->get_formatted_order_total(); ?></p>
	</div>
</div>

