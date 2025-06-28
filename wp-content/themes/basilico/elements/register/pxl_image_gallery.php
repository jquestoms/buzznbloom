<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_image_gallery',
        'title' => esc_html__('PXL Image Gallery', 'basilico'),
        'icon' => 'eicon-gallery-grid',
        'categories' => array('pxltheme-core'),
        'scripts' => [
            'imagesloaded',
            'isotope',
            'basilico-post-grid',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Layout', 'basilico' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_image_gallery-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_image_gallery-2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_image_gallery-3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__( 'Layout 4', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_image_gallery-4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__( 'Layout 5', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_image_gallery-5.jpg'
                                ],
                                '6' => [
                                    'label' => esc_html__( 'Layout 6', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_image_gallery-6.jpg'
                                ],
                                '7' => [
                                    'label' => esc_html__( 'Layout 7', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_image_gallery-7.jpg'
                                ],
                                '8' => [
                                    'label' => esc_html__( 'Layout 8', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_image_gallery-7.jpg'
                                ],
                                '9' => [
                                    'label' => esc_html__( 'Layout 9', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_image_gallery-9.jpg'
                                ],
                            ],
                            'prefix_class' => 'pxl-image-gallery-layout-',
                        ),
                    ),
                ),
                array(
                    'name' => 'grid_section',
                    'label' => esc_html__('Image Gallery', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'wp_gallery',
                                'label' => esc_html__( 'Add Images', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::GALLERY,
                                'show_label' => false,
                                'dynamic' => [
                                    'active' => true,
                                ],
                            ),
                            array(
                                'name'    => 'layout_mode',
                                'label'   => esc_html__( 'Layout Mode', 'basilico' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'options' => [
                                    'fitRows' => esc_html__( 'Basic Grid', 'basilico' ),
                                    'masonry' => esc_html__( 'Masonry Grid', 'basilico' ),
                                ],
                                'default'   => 'fitRows'
                            ),
                            array(
                                'name' => 'img_size',
                                'label' => esc_html__('Image Size', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).', 'basilico')
                            ),
                            array(
                                'name' => 'gallery_rand',
                                'label' => __( 'Order By', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'options' => [
                                    '' => __( 'Default', 'basilico' ),
                                    'rand' => __( 'Random', 'basilico' ),
                                ],
                                'default' => '',
                            )
                        ),
                        basilico_grid_column_settings(),
                        array(
                            array(
                                'name' => 'grid_custom_items_url',
                                'label'     => esc_html__('Custom Items URL', 'basilico'),
                                'type'      => \Elementor\Controls_Manager::REPEATER,
                                'condition' => [
                                    'layout' => ['2', '3', '6']
                                ],
                                'controls' => array_merge(
                                    array(
                                        array(
                                            'name'    => 'item_url',
                                            'label'   => esc_html__( 'Item URL', 'basilico' ),
                                            'type'    => \Elementor\Controls_Manager::TEXT,
                                            'label_block'   => true,
                                        ),
                                    ),
                                )
                            )
                        ),
                        array(
                            array(
                                'name'      => 'grid_custom_columns',
                                'label'     => esc_html__('Custom Items Columns', 'basilico'),
                                'type'      => \Elementor\Controls_Manager::REPEATER,
                                'condition' => [
                                    'layout_mode' => ['masonry'],
                                ],
                                'controls' => array_merge(
                                    basilico_grid_custom_column_settings(),
                                    array(
                                        array(
                                            'name'        => 'img_size_c',
                                            'label'       => esc_html__('Image Size', 'basilico' ),
                                            'type'        => \Elementor\Controls_Manager::TEXT,
                                            'description' => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).', 'basilico'),
                                        ),
                                    ),
                                    basilico_elementor_animation_opts([
                                        'name'  => 'item_c',
                                        'label' => esc_html__('Item', 'basilico'),
                                    ])
                                ),
                            ),
                        ),
                        basilico_elementor_animation_opts([
                            'name'   => 'item',
                            'label' => esc_html__('Item', 'basilico'),
                        ])
                    ),
                ),
                array(
                    'name' => 'gallery_icon_section',
                    'label' => esc_html__('Icon', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'selected_icon',
                            'label' => esc_html__( 'Icon', 'basilico' ),
                            'type' => 'icons',
                            'condition' => [
                                'layout!' => ['1', '4']
                            ]
                        ),
                        array(
                            'name'  => 'icon_size',
                            'label' => esc_html__( 'Icon Size (px)', 'basilico' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-gallery .up-icon i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                            ],
                            'condition' => [
                                'layout' => ['2', '3', '5', '6']
                            ]
                        ),
                        array(
                            'name'  => 'icon_color',
                            'label' => esc_html__( 'Icon Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-gallery .up-icon i' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-image-gallery .pxl-grid-inner .grid-item .item-inner .up-icon .x-line:before,
                                {{WRAPPER}} .pxl-image-gallery .pxl-grid-inner .grid-item .item-inner .up-icon .x-line:after,
                                {{WRAPPER}} .pxl-image-gallery .pxl-grid-inner .grid-item .item-inner .up-icon .y-line:before,
                                {{WRAPPER}} .pxl-image-gallery .pxl-grid-inner .grid-item .item-inner .up-icon .y-line:after' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['2', '3', '5', '6', '9']
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'gallery_images_section',
                    'label' => esc_html__('Images', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'gap',
                            'label' => esc_html__('Image Gap', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'control_type' => 'responsive',
                            'default' => 15,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-grid .pxl-grid-inner' => 'margin-left: -{{VALUE}}px; margin-right: -{{VALUE}}px;',
                                '{{WRAPPER}} .pxl-grid.layout-5 .pxl-grid-inner' => 'margin-left: 0px; margin-right: 0px;',
                                '{{WRAPPER}} .pxl-grid:not(.layout-8) .grid-item' => 'padding-left: {{VALUE}}px; padding-right: {{VALUE}}px; margin-top: {{VALUE}}px; margin-bottom: {{VALUE}}px;',
                                '{{WRAPPER}} .pxl-grid.layout-5 .grid-item' => 'padding-left: {{VALUE}}px; padding-right: {{VALUE}}px; padding-top: {{VALUE}}px; padding-bottom: {{VALUE}}px; margin-top: 0; margin-bottom: 0;',
                                '{{WRAPPER}} .pxl-grid .grid-sizer' => 'padding-left: {{VALUE}}px; padding-right: {{VALUE}}px;',
                            ],
                            'condition' => [
                                'layout!' => '8'
                            ]
                        ),
                        array(
                            'name'         => 'image_border_radius',
                            'label'        => esc_html__( 'Image Radius', 'basilico' ),
                            'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                            'control_type' => 'responsive',
                            'size_units'   => [ 'px', '%' ],
                            'selectors'    => [
                                '{{WRAPPER}} .grid-item .item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                            ],
                        ),
                        array(
                            'name' => 'hover_background',
                            'label' => esc_html__('Hover Background Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-grid .grid-item .item-inner .icon-wrapper, {{WRAPPER}} .pxl-image-gallery .pxl-grid-inner .grid-item .item-inner:before' => 'background-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => ['2', '4']
                            ]
                        ),
                        array(
                            'name'  => 'blur_img_hover',
                            'label' => esc_html__( 'Hover Image Blur', 'basilico' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-gallery .pxl-grid-inner .grid-item .item-inner:hover img' => 'filter: blur({{SIZE}}{{UNIT}});',
                            ],
                            'condition' => [
                                'layout' => ['2']
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'caption_section',
                    'label' => esc_html__('Caption', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'gallery_display_caption',
                            'label' => __( 'Display', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'none',
                            'options' => [
                                'none' => __( 'Hide', 'basilico' ),
                                '' => __( 'Show', 'basilico' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .grid-item .image-caption' => 'display: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'caption_align',
                            'label' => __( 'Alignment', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => __( 'Left', 'basilico' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'Center', 'basilico' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => __( 'Right', 'basilico' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'default' => 'center',
                            'selectors' => [
                                '{{WRAPPER}} .grid-item .image-caption' => 'text-align: {{VALUE}};',
                            ],
                            'condition' => [
                                'gallery_display_caption' => '',
                            ],
                        ),
                        array(
                            'name' => 'caption_color',
                            'label' => __( 'Text Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .grid-item .image-caption' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'gallery_display_caption' => '',
                            ],
                        ),
                        array(
                            'name' => 'caption_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .grid-item .image-caption',
                            'condition' => [
                                'gallery_display_caption' => '',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    basilico_get_class_widget_path()
);