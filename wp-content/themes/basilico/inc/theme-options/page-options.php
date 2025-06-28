<?php

function basilico_product_style_layout_4() {
    $product_layout = basilico()->get_theme_opt('product_layout', 'layout-1');
    if ($product_layout == 'layout-4')
        return array(
            'id'          => 'product_layout_style',
            'type'        => 'image_select',
            'title'       => esc_html__( 'Image Style', 'basilico' ),
            'description' => esc_html__('Use for Shop Layout 4 Shop Page', 'basilico'),
            'options'      => array(
                'style-df' => array(
                    'alt' => 'Style 1',
                    'img' => get_template_directory_uri() . '/assets/images/pizza-layout/pizza-df.jpg'
                ),
                'style-2' => array(
                    'alt' => 'Style 2',
                    'img' => get_template_directory_uri() . '/assets/images/pizza-layout/pizza-style-2.jpg'
                ),
            ),
            'default' => 'style-df'
        );
    return array();
}

add_action( 'pxl_post_metabox_register', 'basilico_page_options_register' );
function basilico_page_options_register( $metabox ) {
	$panels = [
		'post' => [
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Settings', 'basilico' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'post_settings' => [
					'title'  => esc_html__( 'Post Settings', 'basilico' ),
					'icon'   => 'el el-refresh',
					'fields' => array_merge(
                        array(
                            array(
                                'id'       => 'single_post_layout',
                                'type'     => 'select',
                                'title'    => esc_html__('Select Post Layout', 'basilico'),
                                'options'  => array(
                                    '-1'  => esc_html__('Inherit', 'basilico'),
                                    'layout-1' => esc_html__('Layout 1', 'basilico'),
                                    'layout-2' => esc_html__('Layout 2', 'basilico'),
                                    'layout-3' => esc_html__('Layout 3', 'basilico'),
                                    'layout-4' => esc_html__('Layout 4', 'basilico'),
                                    'layout-5' => esc_html__('Layout 5', 'basilico'),
                                    'layout-6' => esc_html__('Layout 6', 'basilico'),
                                    'layout-7' => esc_html__('Layout 7', 'basilico'),
                                    'layout-8' => esc_html__('Layout 8', 'basilico'),
                                    'layout-9' => esc_html__('Layout 9', 'basilico'),
                                    'layout-10' => esc_html__('Layout 10', 'basilico'),
                                    'layout-11' => esc_html__('Layout 10', 'basilico'),
                                ),
                                'default'  => '-1'
                            ),
                        ),
                        basilico_sidebar_pos_opts(['prefix' => 'post_', 'default' => true, 'default_value' => '-1']),
                        basilico_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'basilico' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'basilico' ),
                                'required' => array( 'pt_mode', '!=', 'none' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'basilico' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'basilico' ),
                                'required' => array( 'pt_mode', '!=', 'none' )
                            )
                        ),
                        array(
                            array(
                                'id'          => 'post_share_count',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Post Share Number', 'basilico' ),
                                'description' => esc_html__( 'Edit post number share. This add 1 when click on post social share button.', 'basilico' ),
                                'validate'    => 'numeric',
                                'msg'         => esc_html__('This must be a number!', 'basilico'),
                            ),
                        ),
                        array(
                            array(
                                'id'          => 'featured-video-url',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Video URL', 'basilico' ),
                                'description' => esc_html__( 'Video will show when set post format is video', 'basilico' ),
                                'validate'    => 'url',
                                'msg'         => 'Url error!',
                            ),
                            array(
                                'id'          => 'featured-audio-url',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Audio URL', 'basilico' ),
                                'description' => esc_html__( 'Audio that will show when set post format is audio', 'basilico' ),
                                'validate'    => 'url',
                                'msg'         => 'Url error!',
                            ),
                            array(
                                'id'        =>'featured-quote-text',
                                'type'      => 'textarea',
                                'title'     => esc_html__('Quote Text', 'basilico'),
                                'default'   => '',
                            ),
                            array(
                                'id'          => 'featured-quote-cite',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Quote Cite', 'basilico' ),
                                'description' => esc_html__( 'Quote will show when set post format is quote', 'basilico' ),
                            ),
                            array(
                                'id'       => 'featured-link-url',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Format Link URL', 'basilico' ),
                                'description' => esc_html__( 'Link will show when set post format is link', 'basilico' ),
                            ),
                            array(
                                'id'          => 'featured-link-text',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Format Link Text', 'basilico' ),
                            ),
                            array(
                                'id'          => 'featured-link-cite',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Format Link Cite', 'basilico' ),
                            ),
                        )
                    )
                ]
            ]
        ],
        'page' => [
            'opt_name'            => 'pxl_page_options',
            'display_name'        => esc_html__( 'Page Settings', 'basilico' ),
            'show_options_object' => false,
            'context'  => 'advanced',
            'priority' => 'default',
            'sections'  => [
                'header' => [
                    'title'  => esc_html__( 'Header', 'basilico' ),
                    'icon'   => 'el-icon-website',
                    'fields' => array_merge(
                        basilico_header_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'       => 'disable_header',
                                'title'    => esc_html__('Disable Header', 'basilico'),
                                'subtitle' => esc_html__('Header will not display.', 'basilico'),
                                'type'     => 'button_set',
                                'options'  => array(
                                    '1'  => esc_html__('Yes','basilico'),
                                    '0'  => esc_html__('No','basilico'),
                                ),
                                'default'  => '0',
                            ),
                        ),
                        array(
                            array(
                                'id'       => 'pd_menu',
                                'type'     => 'select',
                                'title'    => esc_html__( 'Desktop Menu', 'basilico' ),
                                'options'  => basilico_get_nav_menu_slug(),
                                'default' => '-1',
                            ),
                            array(
                                'id'       => 'pm_menu',
                                'type'     => 'select',
                                'title'    => esc_html__( 'Mobile Menu', 'basilico' ),
                                'options'  => basilico_get_nav_menu_slug(),
                                'default' => '-1',
                            ),
                        )
                    )
                ],
                'page_title' => [
                    'title'  => esc_html__( 'Page Title', 'basilico' ),
                    'icon'   => 'el el-indent-left',
                    'fields' => array_merge(
                        basilico_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'basilico' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'basilico' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'basilico' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'basilico' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            )
                        )
                    )
                ],
                'content' => [
                    'title'  => esc_html__( 'Content', 'basilico' ),
                    'icon'   => 'el-icon-pencil',
                    'fields' => array_merge(
                        basilico_sidebar_pos_opts(['prefix' => 'page_', 'default' => false, 'default_value' => '0']),
                        array(
                            array(
                                'id'             => 'content_padding',
                                'type'           => 'spacing',
                                'output'         => array( '#pxl-main' ),
                                'right'          => false,
                                'left'           => false,
                                'mode'           => 'padding',
                                'units'          => array( 'px' ),
                                'units_extended' => 'false',
                                'title'          => esc_html__( 'Content Padding', 'basilico' ),
                                'default'        => array(
                                   'padding-top'    => '',
                                   'padding-bottom' => '',
                                   'units'          => 'px',
                                )
                            ),
                            array(
                                'id'       => 'content_bg_color',
                                'type'     => 'color_rgba',
                                'title'    => esc_html__( 'Background Color', 'basilico' ),
                                'subtitle' => esc_html__( 'Content background color.', 'basilico' ),
                                'output'   => array( 'background-color' => 'body' )
                            ),
                        )  
                    )
                ],
               'footer' => [
                   'title'  => esc_html__( 'Footer', 'basilico' ),
                   'icon'   => 'el el-website',
                   'fields' => array_merge(
                        basilico_footer_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'       => 'disable_footer',
                                'title'    => esc_html__('Disable Footer', 'basilico'),
                                'subtitle' => esc_html__('Footer will not display.', 'basilico'),
                                'type'     => 'button_set',
                                'options'  => array(
                                    '1'  => esc_html__('Yes','basilico'),
                                    '0'  => esc_html__('No','basilico'),
                                ),
                                'default'  => '0',
                            ),
                        ),
                    )
               ],
               'colors' => [
                   'title'  => esc_html__( 'Colors', 'basilico' ),
                   'icon'   => 'el el-website',
                   'fields' => array(
                        array(
                            'id'          => 'primary_color',
                            'type'        => 'color',
                            'title'       => esc_html__('Primary Color', 'basilico'),
                            'transparent' => false,
                            'default'     => ''
                        ), 
                        array(
                            'id'          => 'secondary_color',
                            'type'        => 'color',
                            'title'       => esc_html__('Secondary Color', 'basilico'),
                            'transparent' => false,
                            'default'     => ''
                        ),
                    )
                ]
            ]
        ],
		'product' => [ //product
            'opt_name'            => 'pxl_product_options',
            'display_name'        => esc_html__( 'Product Settings', 'basilico' ),
            'show_options_object' => false,
            'context'  => 'advanced',
            'priority' => 'default',
            'sections'  => [
                'page_title' => [
                    'title'  => esc_html__( 'Page Title', 'basilico' ),
                    'icon'   => 'el el-indent-left',
                    'fields' => array_merge(
                        basilico_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'basilico' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'basilico' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'basilico' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'basilico' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            )
                        )
                    )
                ],
                'general' => [
                    'title'  => esc_html__( 'General', 'basilico' ),
                    'icon'   => 'el-icon-website',
                    'fields' => array_merge(
                        array(
                            array(
                                'id'       => 'gallery_layout',
                                'type'     => 'button_set',
                                'title'    => esc_html__('Single Gallery', 'basilico'),
                                'options'  => array(
                                    'simple' => esc_html__('Simple', 'basilico'),
                                    'horizontal' => esc_html__('Horizontal', 'basilico'),
                                    'vertical' => esc_html__('Vertical', 'basilico'),
                                ),
                                'default'  => 'simple'
                            ),
                            array(
                                'id'=> 'product_feature_text',
                                'type' => 'text',
                                'title' => esc_html__('Featured Text 01', 'basilico'),
                                'default' => '',
                            ),
                            array(
                                'id'          => 'feature_color_01',
                                'type'        => 'color_gradient',
                                'title'       => esc_html__('Featured Color 01', 'basilico'),
                                'transparent' => false,
                                'gradient-angle' => true,
                                'default'  => array(
                                    'from' => '#673AB7',
                                    'to'   => '#973BF5',
                                    'gradient-angle' => 180,
                                ),
                                'required' => array( 'product_feature_text', '!=', '' )
                            ),
                            array(
                                'id'=> 'product_feature_text_02',
                                'type' => 'text',
                                'title' => esc_html__('Featured Text 02', 'basilico'),
                                'default' => '',
                            ),
                            array(
                                'id'          => 'feature_color_02',
                                'type'        => 'color_gradient',
                                'title'       => esc_html__('Featured Color 02', 'basilico'),
                                'transparent' => false,
                                'gradient-angle' => true,
                                'default'  => array(
                                    'from' => '#a90001',
                                    'to'   => '#ed2b2c',
                                    'gradient-angle' => 0,
                                ),
                                'required' => array( 'product_feature_text_02', '!=', '' )
                            ),
                            array(
                                'id'=> 'product_loop_additional_text1',
                                'type' => 'text',
                                'title' => esc_html__('Additional Text', 'basilico'),
                                'default' => esc_html('220gr / 600 cal', 'basilico'),
                                'description' => esc_html('Use for Shop Layout 3', 'basilico')
                            ),
                            basilico_product_style_layout_4()
                        )
                    ),
                ],
            ],
        ],
    	'pxl-portfolio' => [ //post_type
            'opt_name'            => 'pxl_portfolio_options',
            'display_name'        => esc_html__( 'Page Settings', 'basilico' ),
            'show_options_object' => false,
            'context'  => 'advanced',
            'priority' => 'default',
            'sections'  => [
                'page_title' => [
                    'title'  => esc_html__( 'Page Title', 'basilico' ),
                    'icon'   => 'el el-indent-left',
                    'fields' => array_merge(
                        basilico_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'basilico' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'basilico' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'basilico' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'basilico' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            )
                        )
                    )
                ],
                'content' => [
                    'title'  => esc_html__( 'Content', 'basilico' ),
                    'icon'   => 'el-icon-pencil',
                    'fields' => array_merge(
                        array(
                            array(
                                'id'             => 'content_padding',
                                'type'           => 'spacing',
                                'output'         => array( '#pxl-main' ),
                                'right'          => false,
                                'left'           => false,
                                'mode'           => 'padding',
                                'units'          => array( 'px' ),
                                'units_extended' => 'false',
                                'title'          => esc_html__( 'Content Padding', 'basilico' ),
                                'default'        => array(
                                    'padding-top'    => '',
                                    'padding-bottom' => '',
                                    'units'          => 'px',
                                )
                            ),
                            array(
                                'id'       => 'title_tag_on',
                                'title'    => esc_html__('Title & Tags', 'basilico'),
                                'subtitle' => esc_html__('Display the Title & Tags at top of post.', 'basilico'),
                                'type'     => 'switch',
                                'default'  => '0'
                            ),
                        )
                    )
                ],
                'additional_data' => [
                    'title'  => esc_html__( 'Additional Data', 'basilico' ),
                    'icon'   => 'el el-list-alt',
                    'fields' => array(
                        array(
                            'id'           => 'custom_text_portfolio',
                            'type'         => 'text',
                            'title'        => esc_html__( 'Custom Text', 'basilico' ),
                            'default'      => esc_html__('', 'basilico'),
                        ),

                    ),

                ],
            ],
        ],
        'pxl-service' => [ //post_type
            'opt_name'            => 'pxl_service_options',
            'display_name'        => esc_html__( 'Page Settings', 'basilico' ),
            'show_options_object' => false,
            'context'  => 'advanced',
            'priority' => 'default',
            'sections'  => [
                'page_title' => [
                    'title'  => esc_html__( 'Page Title', 'basilico' ),
                    'icon'   => 'el el-indent-left',
                    'fields' => array_merge(
                        basilico_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'basilico' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'basilico' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'basilico' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'basilico' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            )
                        )
                    )
                ],
                'content' => [
                    'title'  => esc_html__( 'Content', 'basilico' ),
                    'icon'   => 'el-icon-pencil',
                    'fields' => array_merge(
                        array(
                            array(
                                'id'             => 'content_padding',
                                'type'           => 'spacing',
                                'output'         => array( '#pxl-main' ),
                                'right'          => false,
                                'left'           => false,
                                'mode'           => 'padding',
                                'units'          => array( 'px' ),
                                'units_extended' => 'false',
                                'title'          => esc_html__( 'Content Padding', 'basilico' ),
                                'default'        => array(
                                    'padding-top'    => '',
                                    'padding-bottom' => '',
                                    'units'          => 'px',
                                )
                            ),
                        )
                    )
                ],
                'additional_data' => [
                    'title'  => esc_html__( 'Additional Data', 'basilico' ),
                    'icon'   => 'el el-list-alt',
                    'fields' => array(
                        array(
                            'id'       => 'area_icon_type',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Icon Type', 'basilico'),
                            'desc'     => esc_html__( 'This image icon will display in post grid or carousel', 'basilico' ),
                            'options'  => array(
                                'icon'  => esc_html__('Icon', 'basilico'),
                                'image'  => esc_html__('Image', 'basilico'),
                            ),
                            'default'  => 'image'
                        ),
                        array(
                            'id'       => 'area_icon',
                            'type'     => 'pxl_iconpicker',
                            'title'    => esc_html__( 'Select Icon', 'basilico' ),
                            'default'  => '',
                            'required' => array( 0 => 'area_icon_type', 1 => 'equals', 2 => 'icon' ),
                        ),
                        array(
                            'id'       => 'area_img',
                            'type'     => 'media',
                            'title'    => esc_html__('Select Image', 'basilico'),
                            'default' => '',
                            'required' => array( 0 => 'area_icon_type', 1 => 'equals', 2 => 'image' ),
                            'force_output' => true
                        ),
                    ),
                ],
            ],            
        ],
        'pxl-food' => [ //post_type
            'opt_name'            => 'pxl_food_options',
            'display_name'        => esc_html__( 'Page Settings', 'basilico' ),
            'show_options_object' => false,
            'context'  => 'advanced',
            'priority' => 'default',
            'sections'  => [
                'page_title' => [
                    'title'  => esc_html__( 'Page Title', 'basilico' ),
                    'icon'   => 'el el-indent-left',
                    'fields' => array_merge(
                        basilico_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'basilico' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'basilico' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'basilico' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'basilico' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            )
                        )
                    )
                ],
                'content' => [
                    'title'  => esc_html__( 'Content', 'basilico' ),
                    'icon'   => 'el-icon-pencil',
                    'fields' => array_merge(
                        array(
                            array(
                                'id'             => 'content_padding',
                                'type'           => 'spacing',
                                'output'         => array( '#pxl-main' ),
                                'right'          => false,
                                'left'           => false,
                                'mode'           => 'padding',
                                'units'          => array( 'px' ),
                                'units_extended' => 'false',
                                'title'          => esc_html__( 'Content Padding', 'basilico' ),
                                'default'        => array(
                                    'padding-top'    => '',
                                    'padding-bottom' => '',
                                    'units'          => 'px',
                                )
                            ),
                            array(
                                'id'       => 'title_tag_on',
                                'title'    => esc_html__('Title & Tags', 'basilico'),
                                'subtitle' => esc_html__('Display the Title & Tags at top of post.', 'basilico'),
                                'type'     => 'switch',
                                'default'  => '0'
                            ),
                        )
                    )
                ],
                'additional_data' => [
                    'title'  => esc_html__( 'Additional Data', 'basilico' ),
                    'icon'   => 'el el-list-alt',
                    'fields' => array(
                        array(
                            'id'           => 'custom_text_food',
                            'type'         => 'text',
                            'title'        => esc_html__( 'Custom Text', 'basilico' ),
                        ),

                    ),

                ],
            ],
        ],
    	'pxl-template' => [ //post_type
            'opt_name'            => 'pxl_hidden_template_options',
            'display_name'        => esc_html__( 'Template Settings', 'basilico' ),
            'show_options_object' => false,
            'context'  => 'advanced',
            'priority' => 'default',
            'sections'  => [
                'general' => [
                    'title'  => esc_html__( 'General', 'basilico' ),
                    'icon'   => 'el-icon-website',
                    'fields' => array(
                        array(
                            'id'    => 'template_type',
                            'type'  => 'select',
                            'title' => esc_html__('Template Type', 'basilico'),
                            'options' => [
                                'default'      => esc_html__('Default', 'basilico'),
                                'header'       => esc_html__('Header', 'basilico'),
                                'header-mobile'       => esc_html__('Header Mobile', 'basilico'),
                                'footer'       => esc_html__('Footer', 'basilico'),
                                'mega-menu'    => esc_html__('Mega Menu', 'basilico'),
                                'page-title'   => esc_html__('Page Title', 'basilico'),
                                'hidden-panel' => esc_html__('Hidden Panel', 'basilico'),
                            ],
                            'default' => 'default',
                        ),
                        array(
                            'id'       => 'template_position',
                            'type'     => 'select',
                            'title'    => esc_html__('Hidden Panel Position', 'basilico'),
                            'options'  => [
                                'full' => esc_html__('Full Screen', 'basilico'),
                                'top'   => esc_html__('Top Position', 'basilico'),
                                'left'   => esc_html__('Left Position', 'basilico'),
                                'long-left'   => esc_html__('Long Left Position', 'basilico'),
                                'right'  => esc_html__('Right Position', 'basilico'),
                                'center'  => esc_html__('Center Position', 'basilico'),
                            ],
                            'default'  => 'full',
                            'required' => [ 'template_type', '=', 'hidden-panel']
                        ),
                        array(
                            'id'      => 'template_close_select',
                            'type'    => 'select',
                            'title'   => esc_html__('Close Button Style', 'basilico'),
                            'options'  => array(
                                'theme-opt'         => esc_html('Inherit From Theme Options', 'basilico'),
                                'none'      => esc_html('Hidden', 'basilico'),
                                'custom'      => esc_html('Custom Style', 'basilico'),
                            ),
                            'default' => 'theme-opt'
                        ),
                        array(
                            'id'      => 'template_close_style',
                            'type'    => 'image_select',
                            'title'   => esc_html__('Close Button Style', 'basilico'),
                            'options'  => array(
                                'style-df' => get_template_directory_uri() . '/assets/images/close_layout/close-1.jpg',
                                'style-2'  => get_template_directory_uri() . '/assets/images/close_layout/close-2.jpg',
                                'style-3'  => get_template_directory_uri() . '/assets/images/close_layout/close-3.jpg',
                            ),
                            'default' => 'style-df',
                            'required' => [ 'template_close_select', '=', 'custom']
                        ),
                        array(
                            'id'      => 'custom_cls',
                            'type'    => 'text',
                            'title'   => esc_html__('Custom Class', 'basilico'),
                        ),
                    ),
                ],
            ]
        ],
    ];

    $metabox->add_meta_data( $panels );
}
