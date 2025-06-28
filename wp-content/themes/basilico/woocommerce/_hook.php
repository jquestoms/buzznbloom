<?php 
add_filter( 'woocommerce_enqueue_styles', 'basilico_remove_wc_styles' );
function basilico_remove_wc_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] );	// Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

/* Product Search form */
add_filter( 'get_product_search_form', 'basilico_product_search_form', 10, 1 );
function basilico_product_search_form($form){
    ob_start();
    ?>
    <form method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <label class="screen-reader-text" for="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'basilico' ); ?></label>
        <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Search Product&hellip;', 'basilico' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'basilico' ); ?>"><?php echo esc_html_x( 'Search', 'submit button', 'basilico' ); ?></button>
        <input type="hidden" name="post_type" value="product" />
    </form>
    <?php 
    $form = ob_get_clean();
    return $form;
}
add_filter( 'wc_get_template', 'basilico_wc_update_get_template', 10, 5 );
function basilico_wc_update_get_template($template, $template_name, $args, $template_path, $default_path){

    switch ($template_name) {
        case 'loop/loop-start.php':
            $template = get_template_directory().'/'.WC()->template_path().'loop/pxl-loop-start.php';
            break;
        case 'loop/loop-end.php':
            $template = get_template_directory().'/'.WC()->template_path().'loop/pxl-loop-end.php';
            break;
        case 'single-product/related.php':
            $template = get_template_directory().'/'.WC()->template_path().'single-product/pxl-related.php';
            break;
        case 'cart/mini-cart.php':
            $template = get_template_directory().'/'.WC()->template_path().'cart/pxl-mini-cart.php';
            break;
        case 'cart/cart-empty.php':
            $template = get_template_directory().'/'.WC()->template_path().'cart/pxl-cart-empty.php';
            break;
        case 'content-widget-product.php':
            $template = get_template_directory().'/'.WC()->template_path().'pxl-content-widget-product.php';
            break;
        case 'content-widget-price-filter.php':
            $template = get_template_directory().'/'.WC()->template_path().'pxl-content-widget-price-filter.php';
            break;
        case 'loop/pagination.php':
            $template = get_template_directory().'/'.WC()->template_path().'loop/pxl-pagination.php';
            break;
        case 'global/quantity-input.php':
            $template = get_template_directory().'/'.WC()->template_path().'global/pxl-quantity-input.php';
            break;
        case 'cart/cart.php':
            $template = get_template_directory().'/'.WC()->template_path().'cart/pxl-cart.php';
            break;
        case 'cart/cart-totals.php':
            $template = get_template_directory().'/'.WC()->template_path().'cart/pxl-cart-totals.php';
            break;
        case 'cart/cart-shipping.php':
            $template = get_template_directory().'/'.WC()->template_path().'cart/pxl-cart-shipping.php';
            break;
        case 'cart/shipping-calculator.php':
            $template = get_template_directory().'/'.WC()->template_path().'cart/pxl-shipping-calculator.php';
            break;
        case 'checkout/form-checkout.php':
            $template = get_template_directory().'/'.WC()->template_path().'checkout/pxl-form-checkout.php';
            break;
        case 'checkout/form-login.php':
            $template = get_template_directory().'/'.WC()->template_path().'checkout/pxl-form-login.php';
            break;
        case 'global/form-login.php':
            $template = get_template_directory().'/'.WC()->template_path().'global/pxl-form-login.php';
            break;
        case 'checkout/form-coupon.php':
            $template = get_template_directory().'/'.WC()->template_path().'checkout/pxl-form-coupon.php';
            break;
        case 'checkout/form-billing.php':
            $template = get_template_directory().'/'.WC()->template_path().'checkout/pxl-form-billing.php';
            break;
        case 'checkout/form-shipping.php':
            $template = get_template_directory().'/'.WC()->template_path().'checkout/pxl-form-shipping.php';
            break;
        case 'checkout/review-order.php':
            $template = get_template_directory().'/'.WC()->template_path().'checkout/pxl-review-order.php';
            break;
        case 'checkout/thankyou.php':
            $template = get_template_directory().'/'.WC()->template_path().'checkout/pxl-thankyou.php';
            break;
    }

    return $template;
}