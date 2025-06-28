<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets.
 *
 * @package Basilico
 */

if( !defined('THEME_DEV_MODE_ELEMENTS') && is_user_logged_in()){
    define('THEME_DEV_MODE_ELEMENTS', true);
}
use Elementor\Plugin;

require_once get_template_directory() . '/inc/classes/class-main.php';

if (is_admin()) {
    require_once get_template_directory() . '/inc/admin/admin-init.php';
}

/**
 * Theme Require
 */
basilico()->require_folder('inc');
basilico()->require_folder('inc/classes');
basilico()->require_folder('inc/theme-options');
basilico()->require_folder('template-parts/widgets');
if (class_exists('Woocommerce')) {
    basilico()->require_folder('woocommerce');
    basilico()->require_folder('pxl-nutrition');
}

function numberOfDecimals( $value ) {
    if ( (int) $value == $value ) {
        return 0;
    }
    else if ( ! is_numeric( $value ) ) {
        return false;
    }

    return strlen( $value ) - strrpos( $value, '.' ) - 1;
}

 