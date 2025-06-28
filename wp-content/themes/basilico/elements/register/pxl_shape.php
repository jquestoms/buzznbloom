<?php
// Register Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_shape',
        'title' => esc_html__('Pxl Shape', 'basilico'),
        'icon' => 'eicon-circle',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'basilico'),
                    'tab' => 'layout',
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'basilico'),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'basilico'),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_shape-1.jpg'
                                ]
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_style_shape',
                    'label' => esc_html__('Shape Style', 'basilico'),
                    'tab' => 'style',
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Shape Styles', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'default',
                            'options' => [
                                'default' => esc_html__('Default', 'basilico' ),
                                'style2' => esc_html__('Style2', 'basilico' ),
                                'style3' => esc_html__('Style3', 'basilico' ),
                            ],
                        ),
                        array(
                            'name' => 'shape_background',
                            'type' => \Elementor\Group_Control_Background::get_type(),
                            'control_type' => 'group',
                            'types' => ['classic', 'gradient'],
                            'selector' => '{{WRAPPER}} .pxl-shape',
                        ),
                        array(
                            'name' => 'shape_opacity',
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'label' => esc_html__('Opacity', 'basilico'),
                            'range' => [
                                'px' => [
                                    'max' => 1,
                                    'min' => 0.10,
                                    'step' => 0.01,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-shape' => 'opacity: {{SIZE}};',
                            ],
                        ),
                        array(
                            'name' => 'shape_width',
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'label' => esc_html__('Shape Width', 'basilico'),
                            'size_units' => ['px'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1000,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 480,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-shape' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'shape_height',
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'label' => esc_html__('Shape Height', 'basilico'),
                            'size_units' => ['px'],
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1000,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 340,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-shape' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__( 'Border Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-shape' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_width',
                            'label' => esc_html__( 'Border Width', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-shape' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'responsive' => true,
                        ),
                    ),
                ),
            ),
        ),
    ),
    basilico_get_class_widget_path()
);