<?php
pxl_add_custom_widget(
    [
        'name' => 'pxl_image',
        'title' => esc_html__('PXL Image', 'basilico' ),
        'icon' => 'eicon-image',
        'categories' => ['pxltheme-core'],
        'params' => [
            'sections' => [
                [
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Image', 'basilico' ),
                    'tab'      => 'content',
                    'controls' => [
                        [
                            'name' => 'image',
                            'label' => esc_html__( 'Choose Image', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::MEDIA,
                            'dynamic' => [
                                'active' => true,
                            ],
                            'default' => [
                                'url' => \Elementor\Utils::get_placeholder_image_src()
                            ],
                        ],
                        [
                            'name' => 'image',
                            'label' => esc_html__( 'Image Size', 'basilico' ),
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'full',  
                        ],
                        [
                            'name' => 'align',
                            'label' => esc_html__( 'Alignment', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'basilico' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'basilico' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'basilico' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                            ],
                        ],
                        [
                            'name' => 'link_to',
                            'label' => esc_html__( 'Link', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'none',
                            'options' => [
                                'none' => esc_html__( 'None', 'basilico' ),
                                'file' => esc_html__( 'Media File', 'basilico' ),
                                'custom' => esc_html__( 'Custom URL', 'basilico' ),
                            ],
                        ],
                        [
                            'name' => 'link',
                            'label' => esc_html__( 'Link', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::URL,
                            'dynamic' => [
                                'active' => true,
                            ],
                            'placeholder' => esc_html__( 'https://your-link.com', 'basilico' ),
                            'condition' => [
                                'link_to' => 'custom',
                            ],
                            'show_label' => false,
                        ],
                        [
                            'name' => 'open_lightbox',
                            'label' => esc_html__( 'Lightbox', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'default',
                            'options' => [
                                'default' => esc_html__( 'Default', 'basilico' ),
                                'yes' => esc_html__( 'Yes', 'basilico' ),
                                'no' => esc_html__( 'No', 'basilico' ),
                            ],
                            'condition' => [
                                'link_to' => 'file',
                            ],
                        ]
                    ],
                ],  
                [
                    'name' => 'caption_section',
                    'label' => esc_html__('Caption Settings', 'basilico' ),
                    'tab'      => 'content',
                    'controls' => [
                        [
                            'name'      => 'show_caption',
                            'label'     => esc_html__('Show Caption', 'basilico' ),
                            'type'      => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'false',
                        ],
                        [
                            'name'      => 'caption_align',
                            'label' => esc_html__( 'Caption Alignment', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'basilico' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'basilico' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'basilico' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                                'justify' => [
                                    'title' => esc_html__( 'Justified', 'basilico' ),
                                    'icon' => 'eicon-text-align-justify',
                                ],
                            ],
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .widget-image-caption' => 'text-align: {{VALUE}};',
                            ],
                        ],
                        [
                            'name'      => 'caption_text_color',
                            'label' => esc_html__( 'Caption Text Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .widget-image-caption' => 'color: {{VALUE}};',
                            ],
                        ],
                        [
                            'name'      => 'caption_background_color',
                            'label' => esc_html__( 'Caption Background Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .widget-image-caption' => 'background-color: {{VALUE}};',
                            ],
                        ],
                        [
                            'name' => 'caption_typography',
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .widget-image-caption',
                        ],
                        [
                            'name' => 'caption_text_shadow',
                            'type' => \Elementor\Group_Control_Text_Shadow::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .widget-image-caption',
                        ],
                        [
                            'name' => 'caption_space',
                            'label' => esc_html__( 'Caption Spacing', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .widget-image-caption' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    ]
                ],
                [
                    'name' => 'parallax_section',
                    'label' => esc_html__('Parallax Settings', 'basilico' ),
                    'tab'      => 'content',
                    'controls' => [
                        [
                            'name' => 'pxl_parallax',
                            'label' => esc_html__( 'Parallax Type', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                ''        => esc_html__( 'None', 'basilico' ),
                                'y'       => esc_html__( 'Transform Y', 'basilico' ),
                                'x'       => esc_html__( 'Transform X', 'basilico' ),
                                'z'       => esc_html__( 'Transform Z', 'basilico' ),
                                'rotateX' => esc_html__( 'RotateX', 'basilico' ),
                                'rotateY' => esc_html__( 'RotateY', 'basilico' ),
                                'rotateZ' => esc_html__( 'RotateZ', 'basilico' ),
                                'scaleX'  => esc_html__( 'ScaleX', 'basilico' ),
                                'scaleY'  => esc_html__( 'ScaleY', 'basilico' ),
                                'scaleZ'  => esc_html__( 'ScaleZ', 'basilico' ),
                                'scale'   => esc_html__( 'Scale', 'basilico' ),
                            ],
                        ],
                        [
                            'name' => 'parallax_value',
                            'label' => esc_html__('Value', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                            'condition' => [ 'pxl_parallax!' => '']  
                        ],
                        [
                            'name' => 'pxl_parallax_screen',
                            'label'   => esc_html__( 'Parallax In Screen', 'basilico' ),
                            'type'    => \Elementor\Controls_Manager::SELECT,
                            'control_type' => 'responsive',
                            'default' => '',
                            'options' => array(
                                '' => esc_html__( 'Default', 'basilico' ),
                                'no'   => esc_html__( 'No', 'basilico' ),
                            ),
                            'prefix_class' => 'pxl-parallax%s-',
                            'condition' => [ 'pxl_parallax!' => '']  
                        ]
                        
                    ]
                ],
                [
                    'name'     => 'bg_parallax_section',
                    'label'    => esc_html__('Background Parallax', 'basilico' ),
                    'tab'      => 'content',
                    'controls' => array_merge(
                        [
                            [
                                'name'    => 'pxl_bg_parallax',
                                'label'   => esc_html__( 'Background Parallax Type', 'basilico' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'options' => [
                                    ''                  => esc_html__( 'None', 'basilico' ),
                                    'basic'             => esc_html__( 'Basic', 'basilico' ),
                                    'rotate'            => esc_html__( 'Rotate', 'basilico' ),
                                    'mouse-move'        => esc_html__( 'Mouse Move', 'basilico' ),
                                    'mouse-move-rotate' => esc_html__( 'Mouse Move Rotate', 'basilico' ),
                                    'transform-mouse-move' => esc_html__( 'Transform Mouse Move', 'basilico' ),
                                    'transform' => esc_html__( 'Transform', 'basilico' ),
                                ],
                            ],
                            [
                                'name' => 'bg_parallax_width',
                                'label' => esc_html__('Background Width', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'default' => [
                                    'unit' => '%',
                                ],
                                'tablet_default' => [
                                    'unit' => '%',
                                ],
                                'mobile_default' => [
                                    'unit' => '%',
                                ],
                                'size_units' => [ '%', 'px', 'vw' ],
                                'range' => [
                                    '%' => [
                                        'min' => 1,
                                        'max' => 100,
                                    ],
                                    'px' => [
                                        'min' => 1,
                                        'max' => 1920,
                                    ],
                                    'vw' => [
                                        'min' => 1,
                                        'max' => 100,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-image-wg' => 'width: {{SIZE}}{{UNIT}};',
                                ],
                                'condition' => [ 'pxl_bg_parallax!' => '']  
                            ],
                            [
                                'name' => 'bg_parallax_height',
                                'label' => esc_html__('Background Height', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'control_type' => 'responsive',
                                'default' => [
                                    'unit' => 'px',
                                ],
                                'tablet_default' => [
                                    'unit' => 'px',
                                ],
                                'mobile_default' => [
                                    'unit' => 'px',
                                ],
                                'size_units' => [ 'px', 'vh' ],
                                'range' => [
                                    'px' => [
                                        'min' => 1,
                                        'max' => 1000,
                                    ],
                                    'vh' => [
                                        'min' => 1,
                                        'max' => 100,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-image-wg' => 'height: {{SIZE}}{{UNIT}};',
                                ],
                                'condition' => [ 'pxl_bg_parallax!' => '']  
                            ]
                        ],
                        basilico_position_option_base([
                                'prefix' => '',
                                'selectors_class' => '.parallax-inner',
                                'condition' => ['pxl_bg_parallax' => 'transform']
                            ]
                        ),
                        basilico_parallax_effect_option([
                                'prefix' => '',
                                'condition' => ['pxl_bg_parallax' => 'transform']
                            ]
                        )
                    )
                ],
                [
                    'name'     => 'style_section',
                    'label'    => esc_html__( 'Style', 'basilico' ),
                    'tab'      => 'style',
                    'controls' => [
                        [
                            'name'        => 'width',
                            'label' => esc_html__( 'Width', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'default' => [
                                'unit' => '%',
                            ],
                            'tablet_default' => [
                                'unit' => '%',
                            ],
                            'mobile_default' => [
                                'unit' => '%',
                            ],
                            'size_units' => [ '%', 'px', 'vw' ],
                            'range' => [
                                '%' => [
                                    'min' => 1,
                                    'max' => 100,
                                ],
                                'px' => [
                                    'min' => 1,
                                    'max' => 1000,
                                ],
                                'vw' => [
                                    'min' => 1,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name'        => 'space',
                            'label' => esc_html__( 'Max Width', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'default' => [
                                'unit' => '%',
                            ],
                            'tablet_default' => [
                                'unit' => '%',
                            ],
                            'mobile_default' => [
                                'unit' => '%',
                            ],
                            'size_units' => [ '%', 'px', 'vw' ],
                            'range' => [
                                '%' => [
                                    'min' => 1,
                                    'max' => 100,
                                ],
                                'px' => [
                                    'min' => 1,
                                    'max' => 1000,
                                ],
                                'vw' => [
                                    'min' => 1,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} img' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name'        => 'height',
                            'label' => esc_html__( 'Height', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'default' => [
                                'unit' => 'px',
                            ],
                            'tablet_default' => [
                                'unit' => 'px',
                            ],
                            'mobile_default' => [
                                'unit' => 'px',
                            ],
                            'size_units' => [ 'px', 'vh' ],
                            'range' => [
                                'px' => [
                                    'min' => 1,
                                    'max' => 1000,
                                ],
                                'vh' => [
                                    'min' => 1,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name'        => 'object-fit',
                            'label' => esc_html__( 'Object Fit', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'control_type' => 'responsive',
                            'condition' => [
                                'height[size]!' => '',
                            ],
                            'options' => [
                                '' => esc_html__( 'Default', 'basilico' ),
                                'fill' => esc_html__( 'Fill', 'basilico' ),
                                'cover' => esc_html__( 'Cover', 'basilico' ),
                                'contain' => esc_html__( 'Contain', 'basilico' ),
                            ],
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} img' => 'object-fit: {{VALUE}};',
                            ],
                        ],
                        [
                            'name'        => 'separator_panel_style',
                            'type' => \Elementor\Controls_Manager::DIVIDER,
                            'style' => 'thick',
                        ],
                        [
                            'name' => 'image_effects',
                            'control_type' => 'tab',
                            'tabs' => [
                                [
                                    'name' => 'normal',
                                    'label' => esc_html__('Normal', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::TAB,
                                    'controls' => [
                                        [
                                            'name'        => 'opacity',
                                            'label' => esc_html__( 'Opacity', 'basilico' ),
                                            'type' => \Elementor\Controls_Manager::SLIDER,
                                            'range' => [
                                                'px' => [
                                                    'max' => 1,
                                                    'min' => 0.10,
                                                    'step' => 0.01,
                                                ],
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} img' => 'opacity: {{SIZE}};',
                                            ],
                                        ],
                                        [
                                            'name' => 'css_filters',
                                            'label' => esc_html__('CSS Filters', 'basilico' ),
                                            'type' => \Elementor\Group_Control_Css_Filter::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}} img',
                                        ],       
                                    ],
                                ],
                                [
                                    'name' => 'hover',
                                    'label' => esc_html__('Hover', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::TAB,
                                    'controls' => [
                                        [
                                            'name'        => 'opacity_hover',
                                            'label' => esc_html__( 'Opacity Hover', 'basilico' ),
                                            'type' => \Elementor\Controls_Manager::SLIDER,
                                            'range' => [
                                                'px' => [
                                                    'max' => 1,
                                                    'min' => 0.10,
                                                    'step' => 0.01,
                                                ],
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}}:hover img' => 'opacity: {{SIZE}};',
                                            ],
                                        ],
                                        [
                                            'name' => 'css_filters_hover',
                                            'label' => esc_html__('CSS Filters Hover', 'basilico' ),
                                            'type' => \Elementor\Group_Control_Css_Filter::get_type(),
                                            'control_type' => 'group',
                                            'selector' => '{{WRAPPER}}:hover img',
                                        ],  
                                        [
                                            'name' => 'background_hover_transition',
                                            'label' => esc_html__( 'Transition Duration', 'basilico' ),
                                            'type' => \Elementor\Controls_Manager::SLIDER,
                                            'range' => [
                                                'px' => [
                                                    'max' => 3,
                                                    'step' => 0.1,
                                                ],
                                            ],
                                            'selectors' => [
                                                '{{WRAPPER}} img' => 'transition-duration: {{SIZE}}s',
                                            ],
                                        ],
                                        [
                                            'name' => 'hover_animation',
                                            'label' => esc_html__( 'Hover Animation', 'basilico' ),
                                            'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
                                        ]     
                                    ]
                                ]
                            ],
                        ], 
                        [
                            'name' => 'image_border',
                            'type' => \Elementor\Group_Control_Border::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-image-wg, {{WRAPPER}} .pxl-bg-parallax',
                            'separator' => 'before',
                        ],
                        [
                            'name'         => 'image_border_radius',
                            'label'        => esc_html__( 'Border Radius', 'basilico' ),
                            'type'         => \Elementor\Controls_Manager::DIMENSIONS,
                            'control_type' => 'responsive',
                            'size_units'   => [ 'px', '%' ],
                            'selectors'    => [
                                '{{WRAPPER}} .pxl-image-wg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-bg-parallax' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ],
                        [
                            'name'         => 'image_box_shadow',
                            'label'        => esc_html__( 'Box Shadow', 'basilico' ),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'exclude' => [
                                'box_shadow_position',
                            ],
                            'selector' => '{{WRAPPER}} img',
                        ]   
                    ],
                ],  
                [
                    'name' => 'custom_style_section',
                    'label' => esc_html__('Custom Style', 'basilico' ),
                    'tab'      => 'style',
                    'controls' => [
                        [
                            'name' => 'custom_style',
                            'label' => esc_html__( 'Style', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                ''           => esc_html__( 'None', 'basilico' ),
                                'pxl-transition' => esc_html__( 'Transition', 'basilico' ),
                                'draw-from-top' => esc_html__( 'Draw From Top', 'basilico' ),
                                'draw-from-left' => esc_html__( 'Draw From Left', 'basilico' ),
                                'draw-from-right' => esc_html__( 'Draw From Right', 'basilico' ),
                                'move-from-left' => esc_html__( 'Move From Left', 'basilico' ),
                                'move-from-right' => esc_html__( 'Move From Right', 'basilico' ),
                                'skew-in'         => esc_html__( 'Skew In Left', 'basilico' ),
                                'skew-in-right'         => esc_html__( 'Skew In Right', 'basilico' ),
                            ],
                        ],
                        [
                            'name'      => 'draw_animation_delay',
                            'label'     => esc_html__( 'Draw Animation Delay (ms)', 'basilico' ),
                            'type'      => \Elementor\Controls_Manager::NUMBER,
                            'min'       => 0,
                            'step'      => 100,
                            'condition' => [
                                'custom_style!' => ''
                            ],
                        ],
                        [
                            'name' => 'img_animation',
                            'label' => esc_html__( 'Animation', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => array(
                                'default'=> esc_html__( 'Default', 'basilico' ),
                                'up-down-move'   => esc_html__( 'up down move', 'basilico' ),
                                'shape-animate1'   => esc_html__( 'shape animate 1', 'basilico' ),
                                'shape-animate2'   => esc_html__( 'shape animate 2', 'basilico' ),
                                'shape-animate3'   => esc_html__( 'shape animate 3', 'basilico' ),
                                'shape-animate4'   => esc_html__( 'shape animate 4', 'basilico' ),
                                'shape-animate5'   => esc_html__( 'shape animate 5', 'basilico' ),
                                'shape-animate6'   => esc_html__( 'shape animate 6', 'basilico' ),
                                'shape-animate7'   => esc_html__( 'shape animate 7', 'basilico' ),
                                'fade-in-out-custom'   => esc_html__( 'fade in out custom', 'basilico' ),
                                'fade-out-in-custom'   => esc_html__( 'fade out in custom', 'basilico' ),
                                'zoom-in-out-custom'   => esc_html__( 'zoom in out custom', 'basilico' ),
                                'rotate-animate1'   => esc_html__( 'Rotate Animate', 'basilico' ),
                            ),
                            'default'      => 'default',
                        ],
                        [
                            'name'      => 'animation_delay',
                            'label'     => esc_html__( 'Animation Delay (ms)', 'basilico' ),
                            'type'      => \Elementor\Controls_Manager::NUMBER,
                            'min'       => 0,
                            'step'      => 100,
                            'selectors'    => [
                                '{{WRAPPER}} .pxl-image-wg' => 'animation-delay: {{VALUE}}ms;',
                            ],
                            'condition' => [
                                'img_animation!' => 'default'
                            ],
                        ],
                    ]
                ],
            ], 
        ],
    ],
    basilico_get_class_widget_path()
);