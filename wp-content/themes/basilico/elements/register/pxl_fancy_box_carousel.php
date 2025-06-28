<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_fancy_box_carousel',
        'title' => esc_html__('PXL Fancy Box Carousel', 'basilico'),
        'icon' => 'eicon-info-box',
        'categories' => array('pxltheme-core'),
        'scripts' => [
            'swiper',
            'basilico-swiper',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_fancy_box_carousel-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_fancy_box_carousel-2.jpg'
                                ],
                            ],
                        ),
                        
                    ),
                ),
                array(
                    'name' => 'section_boxs',
                    'label' => esc_html__('Box Settings', 'basilico'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'boxs',
                            'label' => esc_html__('', 'basilico'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name'             => 'selected_img',
                                    'label'            => esc_html__( 'Image', 'basilico' ),
                                    'type'             => 'media',
                                    'default'          => '',
                                ),
                                array(
                                    'name' => 'title_text',
                                    'label' => esc_html__('Title', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => esc_html__('This is the heading', 'basilico'),
                                    'placeholder' => esc_html__('Enter your title', 'basilico'),
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'sub_title_text',
                                    'label' => esc_html__('Sub Title', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => esc_html__('Sub Title', 'basilico'),
                                    'placeholder' => esc_html__('Sub Title', 'basilico'),
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'price_text',
                                    'label' => esc_html__('Price', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'default' => esc_html__('20.25$', 'basilico'),
                                    'placeholder' => esc_html__('Price', 'basilico'),
                                    'description' => esc_html__('Use for Layout 2', 'basilico'),
                                    'show_label' => false,
                                ),
                                array(
                                    'name' => 'description_text',
                                    'label' => esc_html__('Description', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                                    'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'basilico'),
                                    'show_label' => false,
                                ),
                                array(
                                    'name'        => 'button_text',
                                    'label'       => esc_html__( 'Button Text', 'basilico' ),
                                    'type'        => \Elementor\Controls_Manager::TEXT,
                                ),
                                array(
                                    'name'        => 'link',
                                    'label'       => esc_html__( 'Custom Link', 'basilico' ),
                                    'type'        => 'url',
                                    'placeholder' => esc_html__( 'https://your-link.com', 'basilico' ),
                                    'default'     => [
                                        'url'         => '#',
                                        'is_external' => 'on'
                                    ],
                                ),
                            ),
                            'title_field' => '{{{ title_text }}}',
                        ),
                        array(
                            'name' => 'icon_size',
                            'label' => esc_html__('Image Size (px)', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 3,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-carousel .item-image img' => 'height: {{SIZE}}{{UNIT}}; width: 100%; object-fit: cover;',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-fancy-box-carousel .item-title',
                        ),
                        array(
                            'name' => 'heading_color',
                            'label' => esc_html__('Heading Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-carousel .item-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_title_typography',
                            'label' => esc_html__('Sub Title', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-fancy-box-carousel .item-sub-title',
                        ),
                        array(
                            'name' => 'sub_title_color',
                            'label' => esc_html__('Sub Title Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-carousel .item-sub-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_typography',
                            'label' => esc_html__('Description', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-fancy-box-carousel .item-description',
                        ),
                        array(
                            'name' => 'desc_color',
                            'label' => esc_html__('Description Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-carousel .item-description' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'background_color',
                            'label' => esc_html__('Background Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-carousel .item-inner .overlay-1, {{WRAPPER}} .pxl-fancy-box-carousel .item-inner .overlay-2' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                    ),
                ),
                array(
                    'name' => 'btn_section',
                    'label' => esc_html__('Button Settings', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'btn_style',
                            'label' => esc_html__('Button Styles', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-default',
                            'options' => [
                                'btn-default' => esc_html__('Default', 'basilico' ),
                                'btn-white' => esc_html__('White', 'basilico' ),
                                'btn-outline' => esc_html__('Out Line', 'basilico' ),
                                'btn-outline-secondary' => esc_html__('Out Line Secondary', 'basilico' ),
                                'btn-additional-1' => esc_html__('Additional Button 01', 'basilico' ),
                                'btn-additional-2' => esc_html__('Additional Button 02', 'basilico' ),
                                'btn-additional-3' => esc_html__('Additional Button 03', 'basilico' ),
                                'btn-additional-4' => esc_html__('Additional Button 04', 'basilico' ),
                                'btn-additional-5' => esc_html__('Additional Button 05', 'basilico' ),
                                'btn-additional-6' => esc_html__('Additional Button 06', 'basilico' ),
                                'btn-additional-7' => esc_html__('Additional Button 07', 'basilico' ),
                                'btn-additional-8' => esc_html__('Additional Button 08', 'basilico' ),
                                'btn-additional-9' => esc_html__('Additional Button 09', 'basilico' ),
                                'btn-additional-10' => esc_html__('Additional Button 10', 'basilico' ),
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_padding',
                            'label' => esc_html__('Padding', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-carousel .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'typography',
                            'label' => esc_html__('Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-fancy-box-carousel .btn',
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_color',
                            'label' => esc_html__('Text Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-carousel .btn' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_color_hover',
                            'label' => esc_html__('Text Color Hover', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-carousel .btn:hover' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_color_icon',
                            'label' => esc_html__('Icon Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-carousel .btn .pxl-button-icon' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_color_icon_hover',
                            'label' => esc_html__('Icon Color Hover', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-carousel .btn:hover .pxl-button-icon' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_bg_color',
                            'label' => esc_html__('Background Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-carousel .btn' => 'background-image: none; background-color: {{VALUE}}; border-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-fancy-box-carousel .btn::after' => 'background-image: none; background-color: {{VALUE}};'
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                        array(
                            'name' => 'btn_bg_color_hover',
                            'label' => esc_html__('Background Color Hover', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-carousel .item-inner:hover .btn' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-fancy-box-carousel .item-inner:hover .btn:not(.btn-additional-7):before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-fancy-box-carousel .item-inner:hover .btn.btn-additional-6' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-fancy-box-carousel .item-inner:hover .btn.btn-additional-7 .pxl-button-bg' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ]
                        ),
                    )
                ),
                array(
                    'name' => 'carousel_setting',
                    'label' => esc_html__('Carousel Settings', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        basilico_carousel_column_settings(),
                        array( 
                            array(
                                'name' => 'slides_to_scroll',
                                'label' => esc_html__('Slides to scroll', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => '1',
                                'options' => [
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4',
                                    '5' => '5',
                                    '6' => '6',
                                ],
                            ),
                            array(
                                'name' => 'pause_on_hover',
                                'label' => esc_html__('Pause on Hover', 'basilico'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'autoplay',
                                'label' => esc_html__('Autoplay', 'basilico'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'autoplay_speed',
                                'label' => esc_html__('Autoplay Speed', 'basilico'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'default' => 5000,
                                'condition' => [
                                    'autoplay' => 'true'
                                ]
                            ),
                            array(
                                'name' => 'infinite',
                                'label' => esc_html__('Infinite Loop', 'basilico'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'speed',
                                'label' => esc_html__('Animation Speed', 'basilico'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'default' => 400,
                            ),
                        )
                    ),
                ),
                array(
                    'name' => 'arrow_settings',
                    'label' => esc_html__('Arrow Settings', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        basilico_arrow_settings(),
                    ),
                ),
                array(
                    'name' => 'dot_settings',
                    'label' => esc_html__('Dot Settings', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        basilico_dots_settings(),
                    ),
                ),
            ),
        ),
    ),
    basilico_get_class_widget_path()
);