<?php
/**
 * Add child styles.
 */

function basilico_child_enqueue_styles(){
    $parent_style = 'basilico-style'; 
    wp_enqueue_style('basilico-style-child', get_stylesheet_directory_uri() . '/style.css', array(
        $parent_style
    ));
}
add_action( 'wp_enqueue_scripts', 'basilico_child_enqueue_styles', 99);