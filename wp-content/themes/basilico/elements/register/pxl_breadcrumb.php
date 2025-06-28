<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_breadcrumb',
        'title' => esc_html__('PXL Breadcrumb', 'basilico' ),
        'icon' => 'eicon-navigation-horizontal',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'basilico' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Templates', 'basilico' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_fancy_box-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__( 'Layout 2', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_fancy_box-1.jpg'
                                ],
                            ],
                        )
                    )
                ),
                array(
                    'name' => 'content_section',
                    'label' => esc_html__('Style', 'basilico' ),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'text_align',
                            'label' => esc_html__('Alignment', 'basilico' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Start', 'basilico' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'basilico' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'End', 'basilico' ),
                                    'icon' => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'brc_color',
                            'label' => esc_html__('Text Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb, .pxl-breadcrumb .br-item' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'link_color',
                            'label' => esc_html__('Link Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb a' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'link_color_hover',
                            'label' => esc_html__('Link Color Hover', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb a:hover' => 'color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Divider Icon', 'basilico' ),
                            'type'             => 'icons',
                            'condition'        => [
                                'layout!'       => '2' 
                            ]
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
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb .pxli' => 'font-size: {{SIZE}}{{UNIT}} !important;',
                                '{{WRAPPER}} .pxl-breadcrumb svg' => 'width: {{SIZE}}{{UNIT}} !important;',
                            ],
                            'condition'        => [
                                'layout'       => '1' 
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'basilico' ),
                            'type' => 'color',
                            'condition'        => [
                                'layout!'       => '2' 
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb .br-divider' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'brc_typography',
                            'label' => esc_html__('Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-breadcrumb, {{WRAPPER}} .pxl-breadcrumb a, {{WRAPPER}} .pxl-breadcrumb .br-item, {{WRAPPER}} .pxl-breadcrumb .br-divider, {{WRAPPER}} .pxl-breadcrumb .br-item',
                        ),
                        array(
                            'name' => 'btn_padding',
                            'label' => esc_html__('Padding', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-breadcrumb .br-divider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'control_type' => 'responsive',
                            'condition'        => [
                                'layout'       => '1' 
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    basilico_get_class_widget_path()
);