<?php
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_anchor_cart',
        'title'      => esc_html__( 'PXL Cart', 'basilico' ),
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
                            'name' => 'layout_type',
                            'label' => esc_html__('Layout Type', 'basilico'),
                            'type' => 'select',
                            'options' => [
                                'layout-df' => esc_html__('Default (Icon)', 'basilico'),
                                'layout-text' => esc_html__('Text', 'basilico'),
                            ],
                            'default' => 'layout-df' 
                        ),
                        array(
                            'name' => 'cart_style',
                            'label' => esc_html__('Dropdown Layout', 'basilico'),
                            'type' => 'select',
                            'options' => [
                                'layout-1' => esc_html__('Layout 1', 'basilico'),
                                'layout-2' => esc_html__('Layout 2', 'basilico'),
                                'layout-3' => esc_html__('Layout 3', 'basilico'),
                                'layout-4' => esc_html__('Layout 4', 'basilico'),
                                'layout-5' => esc_html__('Layout 5', 'basilico'),
                                'layout-6' => esc_html__('Layout 6', 'basilico'),
                                'layout-7' => esc_html__('Layout 7', 'basilico'),
                            ],
                            'default' => 'layout-1' 
                        ),
                        array(
                            'name' => 'link_target',
                            'label' => esc_html__('Link Target', 'basilico'),
                            'type' => 'select',
                            'options' => [
                                'cart-page' => esc_html__('Cart Page', 'basilico'),
                                'cart-dropdown' => esc_html__('Cart Dropdown', 'basilico'),
                            ],
                            'default' => 'cart_dropdown' 
                        ),
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Icon', 'basilico' ),
                            'type'             => 'icons',
                            'default'          => [
                                'library' => 'lnil',
                                'value'   => 'lnil lnil-cart'
                            ],
                            'condition' => ['layout_type' => 'layout-df']
                        ),
                        array(
                            'name'  => 'icon_size',
                            'label' => esc_html__( 'Icon Size(px)', 'basilico' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-cart.layout-df a.cart-anchor .pxl-anchor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-anchor-cart.layout-df a.cart-anchor .pxl-anchor-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => ['layout_type' => 'layout-df']
                        ),
                        array(
                            'name'        => 'text_title',
                            'label'       => esc_html__( 'Text Title', 'basilico' ),
                            'type'        => 'text',
                            'default'     => 'Basket',
                            'condition'   => ['layout_type' => 'layout-text']
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-anchor',
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
                            'condition' => ['icon_type!' => 'none'],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Color', 'basilico' ),
                            'type' => 'color',
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor, {{WRAPPER}} .pxl-anchor-icon' => 'color: {{VALUE}};',
                            ],
                        ), 
                        array(
                            'name' => 'icon_color_hover',
                            'label' => esc_html__('Hover Color', 'basilico' ),
                            'type' => 'color',
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor:hover, {{WRAPPER}} .pxl-anchor:hover .pxl-anchor-icon' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'cart_count_bg',
                            'label' => esc_html__('Count background', 'basilico' ),
                            'type' => 'color',
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-cart a.cart-anchor .mini-cart-count' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => ['layout_type' => 'layout-df']
                        ),  
                        array(
                            'name' => 'cart_count_color',
                            'label' => esc_html__('Count Color', 'basilico' ),
                            'type' => 'color',
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-cart a.cart-anchor .mini-cart-count' => 'color: {{VALUE}};',
                            ],
                        ), 
                        array(
                            'name'         => 'show_cart_totals',
                            'label'        => esc_html__('Show Cart Total', 'basilico'),
                            'type'         => 'select',
                            'options'      => [
                                'inline-flex' => esc_html__('Yes','basilico'),
                                'none'  => esc_html__('No', 'basilico')
                            ], 
                            'default'      => 'inline-flex', 
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-cart a.cart-anchor .mini-cart-total' => 'display: {{VALUE}};',
                            ],
                            'prefix_class' => 'show-cart-totals%s-',
                        ),
                        array(
                            'name' => 'padding_cart',
                            'label' => esc_html__('Padding(px)', 'basilico' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
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
                                '{{WRAPPER}} .pxl-anchor-cart' => 'border-style: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_width',
                            'label' => esc_html__( 'Border Width', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-cart' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'responsive' => true,
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__( 'Border Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-cart' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_radius',
                            'label' => esc_html__('Border Radius', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            'prefix_class' => 'anchor-align-'
                        ),
                        array(
                            'name'         => 'dropdown_pos_offset_top',
                            'label'        => esc_html__( 'Dropdown Offset Top', 'basilico' ).' (50px) px,%,vh,auto',
                            'type'         => 'text',
                            'default'      => '',
                            'control_type' => 'responsive',
                            'selectors'    => [
                                '{{WRAPPER}} .pxl-cart-dropdown' => 'top: {{VALUE}}',
                            ],
                            'condition' => ['link_target' => 'cart-dropdown'] 
                        ),
                        array(
                            'name'         => 'dropdown_pos_offset_right',
                            'label'        => esc_html__( 'Dropdown Offset Right', 'basilico' ).' (50px) px,%,vh,auto',
                            'type'         => 'text',
                            'default'      => '',
                            'control_type' => 'responsive',
                            'selectors'    => [
                                '{{WRAPPER}} .pxl-cart-dropdown' => 'right: {{VALUE}}',
                            ],
                            'condition' => ['link_target' => 'cart-dropdown'] 
                        ),
                        array(
                            'name'        => 'custom_class',
                            'label'       => esc_html__( 'Custom class', 'basilico' ),
                            'type'        => 'text',
                        ),
                    )
                )
            )
        )
    ),
    basilico_get_class_widget_path()
);