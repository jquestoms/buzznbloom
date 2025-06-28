<?php
// Register Moving Path Widget
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_moving_path',
        'title'      => esc_html__( 'PXL Moving Path', 'basilico' ),
        'icon'       => 'eicon-lottie',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(
            'gsMotionPath',
            'basilico-moving-path'
            ),
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_moving_path-1.jpg'
                                ],
                            ],
                        )
                    )
                ),
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Content', 'basilico' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'             => 'selected_svg',
                            'label'            => esc_html__( 'SVG Path', 'basilico' ),
                            'type'             => 'icons',
                            'default'          => [],
                        ),
                        array(
                            'name'             => 'selected_img',
                            'label'            => esc_html__( 'Image Moving', 'basilico' ),
                            'type'             => 'media',
                            'default'          => '',
                        ),
                    )
                ),
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'basilico'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name'  => 'path_size',
                            'label' => esc_html__( 'Path Size', 'basilico' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-moving-path svg' => 'height: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'path_color',
                            'label' => esc_html__( 'Path Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-moving-path svg path' => 'stroke: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name'      => 'moving_duration',
                            'label'     => esc_html__( 'Moving Duration(s)', 'basilico' ),
                            'type'      => \Elementor\Controls_Manager::NUMBER,
                            'min'       => 0,
                            'step'      => 100,
                        )
                    ),
                ),
            )
        )
    ),
    basilico_get_class_widget_path()
);