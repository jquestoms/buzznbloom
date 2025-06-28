<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_divider',
        'title' => esc_html__('PXL Divider', 'basilico' ),
        'icon' => 'eicon-divider',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Styles', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'style-1',
                            'options' => [
                                'style-1' => esc_html__('Style 1', 'basilico' ),
                                'style-2' => esc_html__('Style 2', 'basilico' ),
                            ],
                        ),
                        array(
                            'name' => 'width',
                            'label' => esc_html__( 'Width', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'default' => [
                                'size' => 218,
                                'unit' => 'px',
                            ],
                            'tablet_default' => [
                                'unit' => '%',
                            ],
                            'mobile_default' => [
                                'unit' => '%',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-divider' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'fill',
                            'label' => esc_html__( 'Fill', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'max' => 1000,
                                ],
                            ],
                            'default' => [
                                'size' => 103,
                                'unit' => 'px',
                            ],
                            'tablet_default' => [
                                'unit' => '%',
                            ],
                            'mobile_default' => [
                                'unit' => '%',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-divider::before' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => 'style-1'
                            ]
                        ),
                        array(
                            'name' => 'alignment',
                            'label' => esc_html__( 'Alignment', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'prefix_class' => 'pxl-divider-align-%s',
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
                        ),
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style Settings', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'color',
                            'label' => esc_html__( 'Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-divider' => 'background-color: {{VALUE}}',
                                '{{WRAPPER}} .pxl-divider .diamond-icon' => 'border-color: {{VALUE}}',
                                '{{WRAPPER}} .pxl-divider .diamond-icon:before' => 'background-color: {{VALUE}}',
                            ],
                        ),
                        array(
                            'name' => 'fill_color',
                            'label' => esc_html__( 'Fill Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-divider:before' => 'background-color: {{VALUE}}',
                            ],
                            'condition' => [
                                'style' => 'style-1'
                            ],
                        ),
                        array(
                            'name' => 'icon_gap_color',
                            'label' => esc_html__( 'Icon Gap Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-divider .diamond-icon' => 'background-color: {{VALUE}}',
                            ],
                            'condition' => [
                                'style' => 'style-2'
                            ],
                        ),
                        array(
                            'name' => 'weight',
                            'label' => esc_html__( 'Weight', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'default' => [
                                'size' => 1,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 1,
                                    'max' => 10,
                                    'step' => 0.1,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-divider' => 'height: {{SIZE}}{{UNIT}}',
                                '{{WRAPPER}} .pxl-divider:before' => 'height: {{SIZE}}{{UNIT}}',
                            ],
                        ),
                        array(
                            'name' => 'gap',
                            'label' => esc_html__( 'Gap', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'TOP' => 15,
                                'BOTTOM' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-divider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'border_radius',
                            'label' => esc_html__( 'Border Radius', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-divider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                            ],
                        ),
                        array(
                            'name'  => 'draw',
                            'label' => esc_html__('Draw Animation', 'basilico'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'separator' => 'before',
                        ),
                    ),
                ),
            ),
        ),
    ),
    basilico_get_class_widget_path()
);