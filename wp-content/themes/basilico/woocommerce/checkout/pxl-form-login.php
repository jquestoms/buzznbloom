<?php
defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

?>

<button class="checkout-login-btn-toggle btn-alt" data-target=".pxl-login-form-checkout"><span class="pxl-icon lnil lnil-user"></span><?php echo esc_html__( 'Log In Your Account', 'basilico' ) ?></button>

<div class="pxl-login-form-checkout pos-fixed">
    <div class="pxl-hidden-template-wrap">
      	<div class="pxl-panel-header">
            <div class="panel-header-inner d-flex justify-content-between">
                <span class="pxl-title h4"><?php esc_html_e( 'Sign In', 'basilico' ) ?></span>
                <span class="pxl-close lnil lnil-close" title="<?php echo esc_attr__( 'Close', 'basilico' ) ?>"></span>
            </div>
        </div>
        <div class="pxl-panel-content custom_scroll">
           	<?php woocommerce_login_form( array( 'message'  => '', 'redirect' => wc_get_checkout_url(), 'hidden'   => false)); ?>
        </div>
    </div>
</div> 
 


