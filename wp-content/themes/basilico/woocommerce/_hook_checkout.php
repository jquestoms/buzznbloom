<?php
//Message
if(!function_exists('basilico_woocommerce_checkout_coupon_message')){
	add_filter('woocommerce_checkout_coupon_message','basilico_woocommerce_checkout_coupon_message');
	function basilico_woocommerce_checkout_coupon_message(){
		return '<span class="pxl-added-to-cart-msg">'.esc_html__( 'Have a coupon?', 'basilico' ) . '</span> <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'basilico' ) . '</a>';
	}
}

// add inner wrap div to order review columns
if(!function_exists('basilico_woocommerce_checkout_order_review_inner_open')){
	add_action('woocommerce_checkout_order_review','basilico_woocommerce_checkout_order_review_inner_open', 0);
	function basilico_woocommerce_checkout_order_review_inner_open(){
		echo '<div class="pxl-woocommerce-checkout-review-order-inner p-30 bg-accent pxl-radius-12">';
	}
}
if(!function_exists('basilico_woocommerce_checkout_order_review_inner_close')){
	add_action('woocommerce_checkout_order_review','basilico_woocommerce_checkout_order_review_inner_close', 999);
	function basilico_woocommerce_checkout_order_review_inner_close(){
		echo '</div>';
	}
}

// add div wrap content after order review title
if(!function_exists('basilico_woocommerce_checkout_order_review_inner2_open'))
{
	add_action('woocommerce_checkout_order_review','basilico_woocommerce_checkout_order_review_inner2_open', 2);
	function basilico_woocommerce_checkout_order_review_inner2_open(){
		echo '<div class="pxl-woocommerce-checkout-review-order-inner2 overflow-hidden text-body">';
	}
}
if(!function_exists('basilico_woocommerce_checkout_order_review_inner2_close'))
{
	add_action('woocommerce_checkout_order_review','basilico_woocommerce_checkout_order_review_inner2_close', 998);
	function basilico_woocommerce_checkout_order_review_inner2_close(){
		echo '</div>';
	}
}

//custom proceed to paypal button
if(!function_exists('basilico_woocommerce_order_button_html')){
	add_filter('woocommerce_order_button_html', 'basilico_woocommerce_order_button_html');
	function basilico_woocommerce_order_button_html(){
		$order_button_text = apply_filters( 'woocommerce_order_button_text', esc_html__( 'Place order', 'basilico' ) );
		return '<div class="pxl-checkout-place-order"><button type="submit" class="button" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button></div>';
	}
}