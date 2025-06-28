<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_list',
        'title' => esc_html__('PXL List', 'basilico' ),
        'icon' => 'eicon-bullet-list',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(),
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_fancy_box-2.jpg'
                                ],
                            ],
                        )
                    )
                ),
                array(
                    'name' => 'tab_content',
                    'label' => esc_html__( 'Content', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'list',
                            'label' => esc_html__('Items', 'basilico'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'list_icon',
                                    'label' => esc_html__('List Icon', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                    'default' => [
                                        'value' => 'fas fa-check',
                                        'library' => 'fa-solid',
                                    ],
                                ),
                                array(
                                    'name' => 'content',
                                    'label' => esc_html__('Content', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Item Link', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ content }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_style',
                    'label' => esc_html__('Style', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
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
                            'default' => [
                                'size' => 15,
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list-content .pxl-list-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-list-content .pxl-list-icon svg' => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-list.layout-2 .pxl-list-content:hover .pxl-list-icon' => 'max-width: calc({{SIZE}}{{UNIT}} + 10px);',
                            ],

                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list-icon' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-list-icon svg' => 'fill: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_margin',
                            'label' => esc_html__('Icon Margin(px)', 'basilico' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list-content .pxl-list-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_position',
                            'label' => esc_html__('Icon Position Y', 'basilico' ),
                            'description' => esc_html__('Vertical deviation from the original position (Unit: px)', 'basilico'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list-content .pxl-list-icon' => 'bottom: {{VALUE}}px;',
                            ],
                        ),
                        array(
                            'name' => 'content_color',
                            'label' => esc_html__('Content Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list .pxl-list-content' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'content_typography',
                            'label' => esc_html__('Content Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-list .pxl-list-content',
                        ),
                        array(
                            'name' => 'content_border_type',
                            'label' => esc_html__( 'Content Border Type', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'none' => esc_html__( 'None', 'basilico' ),
                                'solid' => esc_html__( 'Solid', 'basilico' ),
                                'double' => esc_html__( 'Double', 'basilico' ),
                                'dotted' => esc_html__( 'Dotted', 'basilico' ),
                                'dashed' => esc_html__( 'Dashed', 'basilico' ),
                                'groove' => esc_html__( 'Groove', 'basilico' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list .pxl-list-content + .pxl-list-content' => 'border-top-style: {{VALUE}};',
                            ],
                            'condition' => [
                                'layout' => '2'
                            ],
                        ),
                        array(
                            'name' => 'content_border_color',
                            'label' => esc_html__( 'Content Border Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list .pxl-list-content + .pxl-list-content' => 'border-top-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'content_border_type!' => 'none',
                                'layout' => '2'
                            ],
                        ),
                        array(
                            'name' => 'link_color',
                            'label' => esc_html__('Link Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list .pxl-list-content a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'link_color_hover',
                            'label' => esc_html__( 'Link Color Hover', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list .pxl-list-content a:hover' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'item_spacing',
                            'label' => esc_html__('Item Space', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-item-list .pxl-list-content + .pxl-list-content' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'         => 'item_alignment',
                            'label'        => esc_html__( 'Item Alignment', 'basilico' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__( 'Start', 'basilico' ),
                                    'icon'  => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'basilico' ),
                                    'icon'  => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__( 'End', 'basilico' ),
                                    'icon'  => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-list-content' => 'justify-content: {{VALUE}}; text-align: {{VALUE}};'
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    basilico_get_class_widget_path()
);