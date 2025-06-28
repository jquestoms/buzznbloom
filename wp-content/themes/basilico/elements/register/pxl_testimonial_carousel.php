<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_testimonial_carousel',
        'title' => esc_html__('PXL Testimonial Carousel', 'basilico'),
        'icon' => 'eicon-blockquote',
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__( 'Layout 3', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__( 'Layout 4', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__( 'Layout 5', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-5.jpg'
                                ],
                                '6' => [
                                    'label' => esc_html__( 'Layout 6', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-6.jpg'
                                ],
                                '7' => [
                                    'label' => esc_html__( 'Layout 7', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-7.jpg'
                                ],
                                '8' => [
                                    'label' => esc_html__( 'Layout 8', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-8.jpg'
                                ],
                                '9' => [
                                    'label' => esc_html__( 'Layout 9', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-9.jpg'
                                ],
                                '10' => [
                                    'label' => esc_html__( 'Layout 10', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-10.jpg'
                                ],
                                '11' => [
                                    'label' => esc_html__( 'Layout 11', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-11.jpg'
                                ],
                                '12' => [
                                    'label' => esc_html__( 'Layout 12', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-12.jpg'
                                ],
                                '13' => [
                                    'label' => esc_html__( 'Layout 13', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-13.jpg'
                                ],
                                '14' => [
                                    'label' => esc_html__( 'Layout 14', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-14.jpg'
                                ],
                                '15' => [
                                    'label' => esc_html__( 'Layout 15', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-15.jpg'
                                ],
                                '16' => [
                                    'label' => esc_html__( 'Layout 16', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_carousel-16.jpg'
                                ],
                            ],
                            'prefix_class' => 'pxl-testimonial-carousel-layout-',
                        ),
                        
                    ),
                ),
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Content', 'basilico'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'image_layout14',
                            'label' => esc_html__('Image', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => ['layout' => '14'],
                        ),
                        array(
                            'name' => 'content_list',
                            'label' => esc_html__('Testimonial Items', 'basilico'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                    'description' => esc_html__('Image Not for layout 14', 'basilico'),
                                ),
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__('Name', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'position',
                                    'label' => esc_html__('Position', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                ),
                                array(
                                    'name' => 'testimonial_title',
                                    'label' => esc_html__('Title', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'description',
                                    'label' => esc_html__('Description', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => 10,
                                ),
                                array(
                                    'name' => 'rating',
                                    'label' => esc_html__('Rating', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'default' => 'none',
                                    'options' => [
                                        'none' => esc_html__('None', 'basilico' ),
                                        'star1' => esc_html__('1 Star', 'basilico' ),
                                        'star2' => esc_html__('2 Star', 'basilico' ),
                                        'star3' => esc_html__('3 Star', 'basilico' ),
                                        'star4' => esc_html__('4 Star', 'basilico' ),
                                        'star5' => esc_html__('5 Star', 'basilico' ),
                                    ],
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                        array(
                            'name' => 'quote_icon_type',
                            'label' => esc_html__('Select Quote Type', 'basilico'),
                            'type' => 'select',
                            'options' => [
                                'text' => esc_html__('Default', 'basilico'),
                                'icon' => esc_html__('Icon', 'basilico'),
                                'none' => esc_html__('None', 'basilico'),
                            ],
                            'condition' => ['layout!' => '13'],
                            'default' => 'text'
                        ),
                        array(
                            'name' => 'selected_icon',
                            'label' => esc_html__('Quote Icon', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::ICONS,
                            'fa4compatibility' => 'icon',
                            'condition' => [
                                'quote_icon_type' => 'icon'
                            ]                            
                        ),
                        array(
                            'name' => 'quote_typography',
                            'label' => esc_html__('Quote Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .item-quote-icon',
                            'condition' => [
                                'quote_icon_type' => 'text',
                                'layout!' => '13'
                            ]
                        ),
                        array(
                            'name' => 'show_button',
                            'label' => esc_html__('Show Button More', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'condition' => [
                                'layout' => ['6', '10']
                            ]
                        ),
                        array(
                            'name'        => 'button_link',
                            'label'       => esc_html__( 'Button More Link', 'basilico' ),
                            'type'        => \Elementor\Controls_Manager::URL,
                            'placeholder' => esc_html__( 'https://your-link.com', 'basilico' ),
                            'default'     => [
                                'url'         => '#',
                                'is_external' => 'on'
                            ],
                            'condition' => [
                                'layout' => ['6', '10'],
                                'show_button' => 'true'
                            ]
                        ),
                    ),
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
                                'default' => false,
                            ),
                            array(
                                'name' => 'speed',
                                'label' => esc_html__('Animation Speed', 'basilico'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'default' => 400,
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'arrow_settings',
                    'label' => esc_html__('Arrow Settings', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        basilico_arrow_settings(),
                    ),
                    'condition' => ['layout!' => '14'],
                ),
                array(
                    'name' => 'arrow_settings_layout14',
                    'label' => esc_html__('Arrow Settings', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'arrows_14',
                                'label' => esc_html__('Show Arrows', 'basilico'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'color_arrow',
                                'label' => esc_html__('Arrow Color', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-testimonial-carousel .pxl-swiper-arrows .pxl-swiper-arrow' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'color_arrow_active',
                                'label' => esc_html__('Arrow Color Active', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-testimonial-carousel .pxl-swiper-arrows .pxl-swiper-arrow::after' => 'background-color: {{VALUE}};',
                                ],
                            ),
                        ),
                    ),
                    'condition' => ['layout' => '14'],
                ),
                array(
                    'name' => 'dots_settings',
                    'label' => esc_html__('Dots Settings', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        basilico_dots_settings(),
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'quote_size',
                            'label' => esc_html__('Quote Size', 'basilico'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .item-quote-icon' => 'font-size: {{VALUE}}px;',
                                '{{WRAPPER}} .pxl-testimonial-carousel .icon-wrapper svg' => 'width: {{VALUE}}; height: {{VALUE}}px;',
                            ],
                            'condition' => ['layout!' => '13'],
                        ),
                        array(
                            'name' => 'quote_color',
                            'label' => esc_html__('Quote Icon Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .item-quote-icon' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-testimonial-carousel .icon-wrapper svg' => 'fill: {{VALUE}};',
                            ],
                            'condition' => ['layout!' => '13'],
                        ),
                        array(
                            'name' => 'quote_margin',
                            'label' => esc_html__('Quote Margin', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .item-inner .item-quote-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => ['layout' => '2'],
                        ),
                        array(
                            'name' => 'bg_color',
                            'label' => esc_html__('Background Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => ['layout!' => '13'],
                        ),
                        array(
                            'name' => 'title_typography_testimo',
                            'label' => esc_html__('Title Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .testimonial-title',
                            'condition' => ['layout' => '14'],
                        ),
                        array(
                            'name' => 'title_testimo_color',
                            'label' => esc_html__('Title', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial-title, .pxl-testimonial-carousel .tes-title' => 'color: {{VALUE}};'
                            ],
                            'condition' => ['layout' => ['14', '16']],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Name Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .item-inner .item-title',
                            'condition' => ['layout' => '2'],
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Name Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .item-title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-testimonial-carousel.layout-8 .item-title:before,
                                {{WRAPPER}} .pxl-testimonial-carousel.layout-8 .item-title:after' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-testimonial-carousel.layout-14 .item-title::before' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'name_margin',
                            'label' => esc_html__('Name Margin', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .item-inner .item-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition' => ['layout' => '2'],
                        ),
                        array(
                            'name' => 'bg_des_color',
                            'label' => esc_html__('Box Description Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .item-desc' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => ['layout' => '13'],
                        ),
                        array(
                            'name' => 'testimonial_Typography',
                            'label' => esc_html__('Title Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .item-inner .testimonial-title',
                            'condition' => ['layout' => '2'],
                        ),
                        array(
                            'name' => 'testimonial_color',
                            'label' => esc_html__('Title Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .testimonial-title' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['2', '3', '4']
                            ]
                        ),
                        array(
                            'name' => 'title_space_bottom',
                            'label' => esc_html__('Title Space Bottom', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => -300,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .item-inner .testimonial-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['2']
                            ]
                        ),
                        array(
                            'name' => 'position_color',
                            'label' => esc_html__('Position Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .item-position' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'description_Typography',
                            'label' => esc_html__('Description Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-testimonial-carousel .item-inner .item-desc',
                            'condition' => ['layout' => '2'],
                        ),
                        array(
                            'name' => 'description_color',
                            'label' => esc_html__('Description Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .item-desc' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'des_space_bottom',
                            'label' => esc_html__('Des Space Bottom', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => -300,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .item-inner .item-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'layout' => ['2']
                            ]
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Star icon Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .item-rating' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'divider_color',
                            'label' => esc_html__('Divider Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-divider::before' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => ['15']
                            ]
                        ),
                        array(
                            'name' => 'testimonial_background',
                            'label' => esc_html__('Background Image', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'condition' => ['layout!' => '13', '14'],
                        ),
                        array(
                            'name' => 'max_width',
                            'label' => esc_html__('Description Max Width', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 300,
                                    'max' => 1500,
                                ],
                            ],
                            'condition' => ['layout' => '2'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-swiper-slider .pxl-swiper-slide .item-desc' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'         => 'text_alignment',
                            'label'        => esc_html__( 'Text Alignment', 'basilico' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__( 'Start', 'basilico' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'basilico' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__( 'End', 'basilico' ),
                                    'icon' => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-testimonial-carousel .item-inner' => 'text-align: {{VALUE}};',
                                '{{WRAPPER}} .pxl-testimonial-carousel .pxl-swiper-slide' => 'justify-content: {{VALUE}};',
                                '{{WRAPPER}} .pxl-testimonial-carousel .item-inner .item-wrap' => 'justify-content: {{VALUE}};',
                            ],
                            'condition' => ['layout' => ['2', '15']],
                        ),
                    ),
                ),
            ),
        ),
    ),
    basilico_get_class_widget_path()
);