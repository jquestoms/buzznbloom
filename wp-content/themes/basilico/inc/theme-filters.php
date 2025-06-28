<?php
/**
 * Filters hook for the theme
 *
 * @package Basilico
 */

add_filter( 'pxl_server_info', 'basilico_add_server_info');
function basilico_add_server_info($infos){
    $infos = [
        'api_url' => 'https://api.7iquid.com/',
        'docs_url' => 'https://doc.7iquid.com/basilico/',
        'plugin_url' => 'https://7iquid.com/plugins/',
        'demo_url' => 'https://demo.7iquid.com/basilico/main/',
        'support_url' => '#',
        'help_url' => '#',
        'email_support' => '7iquid.agency@gmail.com',
        'video_url' => '#'
    ];

    return $infos;
}

//* Change Register Folder
add_filter('pxl-register-widgets-folder','basilico_custom_register_folder');
function basilico_custom_register_folder($folder_path){
    return get_template_directory() . '/elements/register/';
}

//* Post Type Support Elementor
add_filter( 'pxl_add_cpt_support', 'basilico_add_cpt_support' );
function basilico_add_cpt_support($cpt_support) {
    $cpt_support[] = 'pxl-portfolio';
    $cpt_support[] = 'pxl-service';
    $cpt_support[] = 'pxl-food';
    return $cpt_support;
}


add_filter( 'pxl_extra_post_types', 'basilico_add_post_type' );
function basilico_add_post_type( $postypes ) {
    $postypes['portfolio'] = array(
        'status' => false,
        'args' => array(
            'rewrite' => array(
                'slug' => ''
            ),
        ),
    );
    $portfolio_slug = basilico()->get_theme_opt('pxl_portfolio_slug', 'portfolio');
    $portfolio_label = basilico()->get_theme_opt('pxl_portfolio_label', 'Portfolio');
    $postypes['pxl-portfolio'] = array(
        'status'     => true,
        'item_name'  => esc_html__('Portfolio', 'basilico'),
        'items_name' => esc_html__('Portfolio', 'basilico'),
        'args'       => array(
            'menu_icon'          => 'dashicons-portfolio',
            'supports'           => array(
                'title',
                'thumbnail',
                'editor',
                'excerpt',
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'has_archive' => true,
            'rewrite'             => array(
                'slug'       => $portfolio_slug
            ),
        ),
        'labels'     => array(
            'name' => $portfolio_label,
            'add_new_item' => esc_html__('Add New Portfolio', 'basilico'),
            'edit_item' => esc_html__('Edit Portfolio', 'basilico'),
            'view_item' => esc_html__('View Portfolio', 'basilico'),
        )
    );

    $service_slug = basilico()->get_theme_opt('pxl_service_slug', 'service');
    $service_label = basilico()->get_theme_opt('pxl_service_label', 'Service');
    $postypes['pxl-service'] = array(
        'status'     => true,
        'item_name'  => esc_html__('Services', 'basilico'),
        'items_name' => esc_html__('Services', 'basilico'),
        'args'       => array(
            'menu_icon'          => 'dashicons-image-filter',
            'supports'           => array(
                'title',
                'thumbnail',
                'editor',
                'excerpt',
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'has_archive' => true,
            'rewrite'             => array(
                'slug'       => $service_slug
            ),
        ),
        'labels'     => array(
            'name' =>  $service_label,
            'add_new_item' => esc_html__('Add New Service', 'basilico'),
            'edit_item' => esc_html__('Edit Service', 'basilico'),
            'view_item' => esc_html__('View Service', 'basilico'),
        )

    );

    $food_slug = basilico()->get_theme_opt('pxl_food_slug', 'food');
    $food_label = basilico()->get_theme_opt('pxl_food_label', 'Food');
    $postypes['pxl-food'] = array(
        'status'     => true,
        'item_name'  => esc_html__('Food', 'basilico'),
        'items_name' => esc_html__('Food', 'basilico'),
        'args'       => array(
            'menu_icon'          => 'dashicons-portfolio',
            'supports'           => array(
                'title',
                'thumbnail',
                'editor',
                'excerpt',
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'has_archive' => true,
            'rewrite'             => array(
                'slug'       => $food_slug
            ),
        ),
        'labels'     => array(
            'name' => $food_label,
            'add_new_item' => esc_html__('Add New Food', 'basilico'),
            'edit_item' => esc_html__('Edit Food', 'basilico'),
            'view_item' => esc_html__('View Food', 'basilico'),
        )
    );

	return $postypes;
}

add_filter( 'pxl_extra_taxonomies', 'basilico_add_tax' );
function basilico_add_tax( $taxonomies ) {
	$taxonomies['pxl-portfolio-category'] = array(
		'status'     => true,
		'post_type'  => array( 'pxl-portfolio' ),
		'taxonomy'   => 'Categories',
		'taxonomies' => 'Categories',
        'args' => array(),
		'labels'     => array()
	);
    $taxonomies['pxl-portfolio-tag'] = array(
        'status'     => true,
        'post_type'  => array( 'pxl-portfolio' ),
        'taxonomy'   => 'Tags',
        'taxonomies' => 'Tags',
        'args' => array(),
        'labels'     => array()
    );
    $taxonomies['pxl-service-category'] = array(
        'status'     => true,
        'post_type'  => array( 'pxl-service' ),
        'taxonomy'   => 'Categories',
        'taxonomies' => 'Categories',
        'args' => array(),
        'labels'     => array()
    );
    $taxonomies['pxl-food-category'] = array(
        'status'     => true,
        'post_type'  => array( 'pxl-food' ),
        'taxonomy'   => 'Categories',
        'taxonomies' => 'Categories',
        'args' => array(),
        'labels'     => array()
    );
	return $taxonomies;
}

add_filter( 'pxl_theme_builder_layout_ids', 'basilico_theme_builder_layout_id' );
function basilico_theme_builder_layout_id($layout_ids){
	//default [], 
	$header_layout        = (int)basilico()->get_opt('header_layout');
	$header_sticky_layout = (int)basilico()->get_opt('header_sticky_layout');
	$header_mobile_layout = (int)basilico()->get_opt('header_mobile_layout');
	$ptitle_layout 	      = (int)basilico()->get_opt('ptitle_layout');
	$footer_layout        = (int)basilico()->get_opt('footer_layout');
	if( $header_layout > 0) 
		$layout_ids[] = $header_layout;
	if( $header_sticky_layout > 0) 
		$layout_ids[] = $header_sticky_layout;
	if( $header_mobile_layout > 0) 
		$layout_ids[] = $header_mobile_layout;
	if( $ptitle_layout > 0) 
		$layout_ids[] = $ptitle_layout;
	if( $footer_layout > 0) 
		$layout_ids[] = $footer_layout;
	return $layout_ids;
}

add_filter( 'pxl_wg_get_source_id_builder', 'basilico_wg_get_source_builder' );
function basilico_wg_get_source_builder($wg_datas){
	$wg_datas['pxl_slider'] = 'slider_source';
	$wg_datas['pxl_tabs'] = ['control_name' => 'tabs_list', 'source_name' => 'content_template'];
	return $wg_datas;
}

add_filter( 'pxl_template_type_support', 'basilico_template_type_support' );
function basilico_template_type_support($type){
    //default ['header','footer','mega-menu']
    $extra_type = [
        'header-mobile' => esc_html__('Header Mobile', 'basilico'),
        'page-title'    => esc_html__('Page Title', 'basilico'),
        'hidden-panel'  => esc_html__('Hidden Panel', 'basilico'),
        'popup'         => esc_html__('Popup', 'basilico'),
        'default'       => esc_html__('Default', 'basilico'),
    ];
    $template_type = array_merge($type, $extra_type);
    return $template_type;
}
 
add_filter( 'get_the_archive_title', 'basilico_archive_title_remove_label' );
function basilico_archive_title_remove_label( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = get_the_author();
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	} elseif ( is_home() ) {
		$title = single_post_title( '', false );
	}

	return $title;
}

add_filter( 'comment_reply_link', 'basilico_comment_reply_text' );
function basilico_comment_reply_text( $link ) {
	$link = str_replace( 'Reply', ''.esc_attr__('Reply', 'basilico').'', $link );
	return $link;
}
 

add_filter( 'pxl_enable_megamenu', 'basilico_enable_megamenu' );
function basilico_enable_megamenu() {
	return true;
}
add_filter( 'pxl_enable_onepage', 'basilico_enable_onepage' );
function basilico_enable_onepage() {
	return true;
}

add_filter( 'pxl_support_awesome_pro', 'basilico_support_awesome_pro' );
function basilico_support_awesome_pro() {
	return false;
}

add_filter( 'redux_pxl_iconpicker_field/get_icons', 'basilico_add_icons_to_pxl_iconpicker_field' );
function basilico_add_icons_to_pxl_iconpicker_field($icons){
	$custom_icons = [];
	$icons = array_merge($custom_icons, $icons);
	return $icons;
}


add_filter("pxl_mega_menu/get_icons", "basilico_add_icons_to_megamenu");
function basilico_add_icons_to_megamenu($icons){
	$custom_icons = [];
	$icons = array_merge($custom_icons, $icons);
	return $icons;
}

add_filter( 'body_class', 'basilico_body_classes' );
function basilico_body_classes( $classes )
{
    $header_sticky_layout = (int)basilico()->get_opt('header_sticky_layout');
    $select_style = basilico()->get_opt('select_style', '');
    $footer_fixed = basilico()->get_opt('footer_fixed', '0');

    if (class_exists('ReduxFramework')) {
        $classes[] = 'redux-page';
    }

    if ($header_sticky_layout > 0) {
        $classes[] = 'header-sticky';
    }

    if($footer_fixed == '1') $classes[] = 'pxl-footer-fixed';

    if(!empty($select_style)) $classes[] = $select_style;

    if(get_option( 'woosw_page_id', 0) == get_the_ID())
        $classes[] = 'pxl-wishlist-page';

    return $classes;
}

/**
 * Move comment field to bottom
 */
add_filter( 'comment_form_fields', 'basilico_comment_field_to_bottom' );
function basilico_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

/** 
 * Custom Widget Archive 
 * This code filters the Archive widget to include the post count inside the link 
 * @since 1.0.0
*/
if(!function_exists('basilico_get_archives_link_text')){
    add_filter('get_archives_link', 'basilico_get_archives_link_text', 10, 6);
    function basilico_get_archives_link_text($link_html, $url, $text, $format, $before, $after ){
        $text = wptexturize( $text );
        $url  = esc_url( $url );
     
        if ( 'link' == $format ) {
            $link_html = "\t<link rel='archives' title='" . esc_attr( $text ) . "' href='$url' />\n";
        } elseif ( 'option' == $format ) {
            $link_html = "\t<option value='$url'>$before $text $after</option>\n";
        } elseif ( 'html' == $format ) {
            $link_html = "\t<li>$before<a href='$url'><span class='title'>$text</span></a>$after</li>\n";
        } else { // custom
            $link_html = "\t$before<a href='$url'><span class='title'>$text</span>$after</a>\n";
        }
        return $link_html;
    }
}

if(!function_exists('basilico_archive_count_span')){
    add_filter('get_archives_link', 'basilico_archive_count_span');
    function basilico_archive_count_span($links) {
        $links = str_replace('<li>', '<li class="pxl-list-item pxl-archive-item">', $links);
        $links = str_replace('</a>&nbsp;(', ' <span class="count">', $links);
        $links = str_replace(')</li>', '</span></a></li>', $links);
        return $links;
    }
}
//* Disable Lazy loading
add_filter( 'wp_lazy_loading_enabled', '__return_false' );
// remove <br> in contact form7
add_filter( 'wpcf7_autop_or_not', '__return_false' );

//* Add Custom Fonts Redux
add_filter( 'redux/'.basilico()->get_option_name().'/field/typography/custom_fonts', 'basilico_custom_fonts'); 
function basilico_custom_fonts($fonts){
    $fonts = [
        'Custom Fonts' => [
            'Audrey' => 'Audrey',
            'PS Demo' => 'PS Demo',
            'Souvenir' => 'Souvenir',
            'IPAMincho' => 'IPAMincho',
            'Hertine' => 'Hertine'
        ]
    ];
    return $fonts;
}

//* Add Custom Fonts Elementor
add_filter( 'elementor/fonts/groups', 'basilico_update_elementor_font_groups_control' );
function basilico_update_elementor_font_groups_control($font_groups){
    $pxlfonts_group = array( 'pxlfonts' => esc_html__( 'Custom Fonts', 'basilico' ) );
    return array_merge( $pxlfonts_group, $font_groups );
}

add_filter( 'elementor/fonts/additional_fonts', 'basilico_update_elementor_font_control' );
function basilico_update_elementor_font_control($additional_fonts){
    $additional_fonts['Audrey'] = 'pxlfonts';
    $additional_fonts['Cormorant Infant'] = 'pxlfonts';
    $additional_fonts['PS Demo'] = 'pxlfonts';
    $additional_fonts['Cirka'] = 'pxlfonts';
    $additional_fonts['Souvenir'] = 'pxlfonts';
    $additional_fonts['IPAMincho'] = 'pxlfonts';
    $additional_fonts['Hertine'] = 'pxlfonts';
    return $additional_fonts;
}