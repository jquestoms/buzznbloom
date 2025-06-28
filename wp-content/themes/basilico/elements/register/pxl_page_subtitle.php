<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_page_subtitle',
        'title' => esc_html__('PXL Page Subtitle', 'basilico' ),
        'icon' => 'eicon-t-letter',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
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
                                '{{WRAPPER}} .pxl-pt-wrap' => 'justify-content: {{VALUE}};',
                                '{{WRAPPER}} .pxl-pt-wrap .sub-title' => 'text-align: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name'  => 'max_width',
                            'label' => esc_html__( 'Max Width (px)', 'basilico' ),
                            'type'  => 'slider',
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1920,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-pt-wrap .sub-title' => 'max-width: {{SIZE}}{{UNIT}};',
                            ]
                        ),
                        array(
                            'name' => 'sub_title_color',
                            'label' => esc_html__('Sub Title Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .sub-title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'pst_typography',
                            'label' => esc_html__('Sub Title Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .sub-title',
                        ),
                    ),
                ),
            ),
        ),
    ),
    basilico_get_class_widget_path()
);