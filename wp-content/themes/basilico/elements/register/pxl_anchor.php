<?php
$templates_df = [0 => esc_html__('None', 'basilico')];
$templates = $templates_df + basilico_get_templates_option('hidden-panel');

pxl_add_custom_widget(
    array(
        'name'       => 'pxl_anchor',
        'title'      => esc_html__( 'PXL Anchor', 'basilico' ),
        'icon'       => 'eicon-anchor',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'icon_section',
                    'label'    => esc_html__( 'Settings', 'basilico' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'template',
                            'label' => esc_html__('Select Templates', 'basilico'),
                            'type' => 'select',
                            'options' => $templates,
                            'default' => 'df' 
                        ),
                        array(
                            'name' => 'icon_type',
                            'label' => esc_html__('Select Type', 'basilico'),
                            'type' => 'select',
                            'options' => [
                                'none' => esc_html__('None', 'basilico'),
                                'lib' => esc_html__('Library', 'basilico'),
                                'custom' => esc_html__('Custom 1', 'basilico'),
                                'custom-2' => esc_html__('Custom 2', 'basilico'),
                                'custom-3' => esc_html__('Custom 3', 'basilico'),
                                'custom-4' => esc_html__('Custom 4', 'basilico'),
                                'custom-5' => esc_html__('Custom 5', 'basilico'),
                                'custom-6' => esc_html__('Custom 6', 'basilico'),
                                'custom-7' => esc_html__('Custom 7', 'basilico'),
                                'select-button' => esc_html__('Select Button', 'basilico'),
                            ],
                            'default' => 'lib' 
                        ),
                        array(
                            'name' => 'style_button',
                            'label' => esc_html__('Button Styles', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-default',
                            'options' => [
                                'btn-default' => esc_html__('Default', 'basilico' ),
                                'btn-white' => esc_html__('White', 'basilico' ),
                                'btn-outline' => esc_html__('Out Line', 'basilico' ),
                                'btn-outline-secondary' => esc_html__('Out Line Secondary', 'basilico' ),
                                'btn-outline-secondary-2' => esc_html__('Out Line Secondary 2', 'basilico' ),
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
                            'condition' => ['icon_type' => 'select-button']
                        ),
                        array(
                            'name' => 'text_button',
                            'label' => esc_html__('Button Text', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('Click here', 'basilico'),
                            'placeholder' => esc_html__('Click here', 'basilico'),
                            'condition' => ['icon_type' => 'select-button']
                        ),
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Icon', 'basilico' ),
                            'type'             => 'icons',
                            'default'          => [
                                'library' => 'pxli',
                                'value'   => 'pxli-search-400'
                            ],
                            'condition' => ['icon_type' => 'lib']
                        ),
                        array(
                            'name'  => 'icon_size',
                            'label' => esc_html__( 'Icon Size(px)', 'basilico' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'condition' => ['icon_type' => 'lib'],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-anchor-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'  => 'icon_size_custom',
                            'label' => esc_html__( 'Icon Size(px)', 'basilico' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'condition' => ['icon_type' => 'custom-2'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-icon.custom-2' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'  => 'dot_size_custom',
                            'label' => esc_html__( 'Dot Size(px)', 'basilico' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'condition' => ['icon_type' => 'custom-2'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-icon.custom-2 span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_margin',
                            'label' => esc_html__('Icon Margin(px)', 'basilico' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => ['icon_type!' => ['none', 'select-button']],
                        ),
                        array(
                            'name' => 'border_type_cus2',
                            'label' => esc_html__( 'Border Type', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                '' => esc_html__( 'None', 'basilico' ),
                                'solid' => esc_html__( 'Solid', 'basilico' ),
                                'double' => esc_html__( 'Double', 'basilico' ),
                                'dotted' => esc_html__( 'Dotted', 'basilico' ),
                                'dashed' => esc_html__( 'Dashed', 'basilico' ),
                                'groove' => esc_html__( 'Groove', 'basilico' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-wrap .pxl-anchor' => 'border-style: {{VALUE}};',
                            ],
                            'condition' => ['icon_type' => ['custom-2']],
                        ),
                        array(
                            'name' => 'border_width_cus2',
                            'label' => esc_html__( 'Border Width', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-wrap .pxl-anchor' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'responsive' => true,
                            'condition' => ['icon_type' => ['custom-2']],
                        ),
                        array(
                            'name' => 'border_color_cus2',
                            'label' => esc_html__( 'Border Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-wrap .pxl-anchor' => 'border-color: {{VALUE}};',
                            ],
                            'condition' => ['icon_type' => ['custom-2']],
                        ),
                        array(
                            'name' => 'border_radius_cus2',
                            'label' => esc_html__('Border Radius', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-wrap .pxl-anchor' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => ['icon_type' => ['custom-2']],
                        ),
                        array(
                            'name'        => 'title',
                            'label'       => esc_html__( 'Title', 'basilico' ),
                            'type'        => 'textarea',
                            'placeholder' => esc_html__( 'Menu', 'basilico' ),
                            'condition' => ['icon_type!' => ['select-button']],
                        ),
                        array(
                            'name'         => 'title_typo',
                            'label'        => esc_html__( 'Title Typography', 'basilico' ),
                            'type'         => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .anchor-title',
                            'condition'    => ['title!' => '']
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-anchor-wrap .pxl-anchor-icon.custom span' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-anchor-wrap .pxl-anchor-icon.custom-2 span' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-anchor-icon svg' => 'fill: {{VALUE}};',
                                '{{WRAPPER}} .pxl-anchor-icon.custom-5 span' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => ['icon_type!' => ['select-button']],
                        ),
                        array(
                            'name' => 'icon_color_hover',
                            'label' => esc_html__('Hover Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-anchor-wrap .pxl-anchor-icon.custom.pxl-bars:hover span' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-anchor-wrap .pxl-anchor-icon.custom-2.pxl-bars:hover span' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-anchor:hover pxl-anchor-icon svg' => 'fill: {{VALUE}};',
                                '{{WRAPPER}} .pxl-anchor-icon.custom-5:hover span' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => ['icon_type!' => ['select-button']],
                        ),
                        array(
                            'name'  => 'icon_custom_size',
                            'label' => esc_html__( 'Width', 'basilico' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'condition' => ['icon_type' => 'custom-5'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-icon.custom-5 span' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'  => 'icon_custom_height',
                            'label' => esc_html__( 'Height', 'basilico' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'condition' => ['icon_type' => 'custom-5'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-icon.custom-5' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'         => 'align',
                            'label'        => esc_html__( 'Alignment', 'basilico' ),
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
                                '{{WRAPPER}} .pxl-anchor-wrap' => 'justify-content: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'        => 'custom_class',
                            'label'       => esc_html__( 'Custom class', 'basilico' ),
                            'type'        => 'text',
                        ),
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => ['icon_type' => ['select-button']],
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'btn_padding',
                                'label' => esc_html__('Padding', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px' ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'  => 'is_fullwidth',
                                'label' => esc_html__('Is Fullwidth?', 'basilico'),
                                'type'  => \Elementor\Controls_Manager::SWITCHER,
                                'return_value' => 'yes',
                                'default' => 'no',
                            ),
                            array(
                                'name' => 'typography',
                                'label' => esc_html__('Typography', 'basilico' ),
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-anchor .btn',
                            ),
                            array(
                                'name' => 'btn_color',
                                'label' => esc_html__('Text Color', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor .btn' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_color_hover',
                                'label' => esc_html__('Text Color Hover', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor .btn:hover' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_color_icon',
                                'label' => esc_html__('Icon Color', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor .btn .pxl-button-icon' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_color_icon_hover',
                                'label' => esc_html__('Icon Color Hover', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor .btn:hover .pxl-button-icon' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'btn_bg_color',
                                'label' => esc_html__('Background Color', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor .btn' => 'background-image: none; background-color: {{VALUE}}; border-color: {{VALUE}};',
                                    '{{WRAPPER}} .pxl-anchor .btn::after' => 'background-image: none; background-color: {{VALUE}};'
                                ],
                                'condition' => [
                                    'style_button!' => ['btn-gradient'],
                                ],
                            ),
                            array(
                                'name' => 'btn_bg_color_hover',
                                'label' => esc_html__('Background Color Hover', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor .btn:hover' => 'border-color: {{VALUE}};',
                                    '{{WRAPPER}} .pxl-anchor .btn.btn-additional-6:hover, {{WRAPPER}} .pxl-anchor .btn.btn-additional-7:hover, {{WRAPPER}} .pxl-anchor .btn.btn-additional-5:hover' => 'background-color: {{VALUE}};',
                                    '{{WRAPPER}} .pxl-anchor .btn:before' => 'background-color: {{VALUE}};',
                                    '{{WRAPPER}} .pxl-anchor .btn.btn-additional-10::after' => 'border-left-color: {{VALUE}};'
                                ],
                                'condition' => [
                                    'style_button!' => ['btn-additional-9'],
                                ],
                            ),
                            array(
                                'name' => 'btn_bg_color_hover_style9',
                                'label' => esc_html__('Background Color Hover', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor .btn:before' => 'background-color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style_button' => ['btn-additional-9'],
                                ],
                            ),
                        ),
                        array(
                            array(
                                'name' => 'border_type',
                                'label' => esc_html__( 'Border Type', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'options' => [
                                    '' => esc_html__( 'None', 'basilico' ),
                                    'solid' => esc_html__( 'Solid', 'basilico' ),
                                    'double' => esc_html__( 'Double', 'basilico' ),
                                    'dotted' => esc_html__( 'Dotted', 'basilico' ),
                                    'dashed' => esc_html__( 'Dashed', 'basilico' ),
                                    'groove' => esc_html__( 'Groove', 'basilico' ),
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor .btn' => 'border-style: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'border_width',
                                'label' => esc_html__( 'Border Width', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor .btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'responsive' => true,
                            ),
                            array(
                                'name' => 'border_color',
                                'label' => esc_html__( 'Border Color', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'default' => '',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor .btn' => 'border-color: {{VALUE}};',
                                    '{{WRAPPER}} .pxl-anchor .btn.btn-additional-7' => 'box-shadow: 3px 3px 0px 0px {{VALUE}};',
                                    '{{WRAPPER}} .pxl-anchor .btn.btn-additional-7:hover' => 'box-shadow: 0px 0px 0px 0px {{VALUE}};',
                                    '{{WRAPPER}} .btn.btn-outline:after' => 'background-color: {{VALUE}};'
                                ],
                                'condition' => [
                                    'border_type!' => '',
                                ],
                            ),
                            array(
                                'name' => 'border_color_hover',
                                'label' => esc_html__( 'Border Color Hover', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'default' => '',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor .btn:hover' => 'border-color: {{VALUE}};'
                                ],
                                'condition' => [
                                    'border_type!' => '',
                                ],
                            ),
                            array(
                                'name' => 'btn_border_radius',
                                'label' => esc_html__('Border Radius', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px' ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'mc_style_input_tabs',
                                'control_type' => 'tab',
                                'tabs' => array(
                                    array(
                                        'name' => 'input_style_normal',
                                        'label' => esc_html__('Normal', 'basilico'),
                                        'controls' => array(
                                            array(
                                                'name' => 'button_shadow',
                                                'label'        => esc_html__( 'Box Shadow', 'basilico' ),
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'exclude' => [
                                                    'box_shadow_position',
                                                ],
                                                'condition' => [
                                                    'style_button' => ['btn-additional-9'],
                                                ],
                                                'selector' => 
                                                    '{{WRAPPER}} .pxl-anchor .btn'
                                            ),
                                        )
                                    ),
                                    array(
                                        'name' => 'input_style_hover',
                                        'label' => esc_html__('Hover', 'basilico'),
                                        'controls' => array(
                                            array(
                                                'name' => 'button_hover_shadow',
                                                'label'        => esc_html__( 'Box Shadow', 'basilico' ),
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'exclude' => [
                                                    'box_shadow_position',
                                                ],
                                                'condition' => [
                                                    'style_button' => ['btn-additional-9'],
                                                ],
                                                'selector' => 
                                                    '{{WRAPPER}} .pxl-anchor .btn:hover'
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        )
                    ),
                ),
            )
        )
    ),
    basilico_get_class_widget_path()
);