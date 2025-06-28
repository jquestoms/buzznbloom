<?php

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); 

$cart_cross_sell = basilico()->get_theme_opt('cart_cross_sell','off');
$cart_continue_shopping_url = (int)basilico()->get_theme_opt('cart_continue_shopping_url',0);
$continue_shop_url = $cart_continue_shopping_url > 0 ? get_the_permalink( $cart_continue_shopping_url) : wc_get_page_permalink( 'shop' );
?>

<div class="woocommerce-cart-form">
	<div class="cart-form-content row">
		<div class="cart-content-left col-12 col-lg-8">
			<?php do_action( 'woocommerce_before_cart_table' ); ?>
			<div class="cart-list-wrapper">
				<?php wc_get_template( 'cart/pxl-cart-content.php' ); ?>
			</div>
			<?php do_action( 'woocommerce_after_cart_table' ); ?>
			<?php if ( wc_coupons_enabled() ) { ?>
				<form class="form-coupon" method="POST">
					<div class="coupon">
						<label for="coupon_code"><?php esc_html_e( 'Discount Code', 'basilico' ); ?></label> 
						<div class="coupon-control relative">
							<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Enter promo code', 'basilico' ); ?>" /> 
							<span class="pxl-icon lnil lnil-offer"></span>
							<button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'basilico' ); ?>"><?php esc_html_e( 'Apply coupon', 'basilico' ); ?></button>
						</div>
						<?php do_action( 'woocommerce_cart_coupon' ); ?>
					</div>
				</form>
			<?php } ?>
		</div>
		<div class="cart-content-right col-12 col-lg-4">
			<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
			<div id="cart-collaterals" class="cart-collaterals">
				<?php do_action( 'woocommerce_cart_collaterals' );?>	 
			</div>
			<div class="continue-shopping text-center">
				<a class="pxl-continue-shop" href="<?php echo esc_url( $continue_shop_url ); ?>"><?php esc_html_e( 'Continue Shopping', 'basilico' ); ?></a>
			</div>
		</div>
	</div>
</div>

<?php if( $cart_cross_sell == 'on'): ?>
	<div class="cart-cross-sell">
		<?php woocommerce_cross_sell_display(); ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_cart' ); ?>
