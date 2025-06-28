<?php
// Register Accordion Widget
$templates = basilico_get_templates_option('default', []) ;
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_accordion',
        'title'      => esc_html__( 'PXL Accordion', 'basilico' ),
        'icon'       => 'eicon-accordion',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(
            'basilico-accordion'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'source_section',
                    'label'    => esc_html__( 'Source Settings', 'basilico' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => esc_html__( 'Style 1', 'basilico' ),
                                'style2' => esc_html__( 'Style 2', 'basilico' ),
                                'style3' => esc_html__( 'Style 3', 'basilico' ),
                                'style4' => esc_html__( 'Style 4', 'basilico' ),
                                'style5' => esc_html__( 'Style 5', 'basilico' ),
                                'style6' => esc_html__( 'Style 6', 'basilico' ),
                                'style7' => esc_html__( 'Style 7', 'basilico' ),
                                'style8' => esc_html__( 'Style 8', 'basilico' ),
                                'style9' => esc_html__( 'Style 9', 'basilico' ),
                            ],
                            'default' => 'style1',
                        ),
                        array(
                            'name' => 'active_section',
                            'label' => esc_html__('Active section', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'separator' => 'after',
                            'default' => '1',
                        ),
                        array(
                            'name' => 'ac_items',
                            'label' => esc_html__('Accordion Items', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'ac_title',
                                    'label' => esc_html__('Title', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => 3,
                                ),
                                array(
                                    'name' => 'ac_content_type',
                                    'label' => esc_html__( 'Content Type', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'default' => 'text_editor',
                                    'options' => [
                                        'text_editor' => esc_html__( 'Text Editor', 'basilico' ),
                                        'template' => esc_html__( 'Template', 'basilico' ),
                                    ],
                                ),
                                array(
                                    'name' => 'ac_content',
                                    'label' => esc_html__('Content', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::WYSIWYG,
                                    'show_label' => false,
                                    'condition' => [
                                        'ac_content_type' => 'text_editor'
                                    ],
                                ),
                                array(
                                    'name' => 'ac_content_template',
                                    'label' => esc_html__('Select Templates', 'basilico'),
                                    'description'        => sprintf(esc_html__('Please create your layout before choosing. %sClick Here%s','basilico'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=pxl-template' ) ) . '">','</a>'),
                                    'type' => \Elementor\Controls_Manager::SELECT,
                                    'default' => '',
                                    'options' => $templates,
                                    'condition' => [
                                        'ac_content_type' => 'template'
                                    ],
                                ),
                                array(
                                    'name' => 'background_color',
                                    'label' => esc_html__('Background Color', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::COLOR,
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-accordion.style8 {{CURRENT_ITEM}} .pxl-ac-title' => 'background-color: {{VALUE}};',
                                    ],
                                ),
                                array(
                                    'name' => 'background_color_active',
                                    'label' => esc_html__('Background Color Active', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::COLOR,
                                    'description' => esc_html__('Background Use for Style 8', 'basilico'),
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-accordion.style8 {{CURRENT_ITEM}} .pxl-ac-title.active' => 'background-color: {{VALUE}};',
                                    ],
                                ),
                            ),
                            'default' => [
                                [
                                    'ac_title'   => esc_html__( 'FAQ Title #1', 'basilico' ),
                                    'ac_content' => esc_html__( 'Lorem ipsum dolor sit amet consecte tur adipiscing elit sed do eiu smod tempor incididunt ut labore.', 'basilico' ),
                                ],
                                [
                                    'ac_title'   => esc_html__( 'FAQ Title #2', 'basilico' ),
                                    'ac_content' => esc_html__( 'Lorem ipsum dolor sit amet consecte tur adipiscing elit sed do eiu smod tempor incididunt ut labore.', 'basilico' ),
                                ],
                            ],
                            'title_field' => '{{{ ac_title }}}',
                            'separator' => 'after',
                        ),
                        
                    )
                ),
                array(
                    'name'     => 'style_section',
                    'label'    => esc_html__( 'Style', 'basilico' ),
                    'tab'      => 'style',
                    'controls' => array_merge(
                        array(
                            array(
                                'name' => 'title_color',
                                'label' => esc_html__('Title Color', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-accordion .pxl-ac-item .pxl-ac-title' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'title_typography',
                                'label' => esc_html__('Title Typography', 'basilico' ),
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-accordion .pxl-ac-item .pxl-ac-title',
                            ),
                            array(
                                'name' => 'title_color_active',
                                'label' => esc_html__('Title Color Active', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-accordion .pxl-ac-title.active' => 'color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style' => 'style8'
                                ]
                            ),
                            array(
                                'name' => 'desc_color',
                                'label' => esc_html__('Description Color', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-accordion .pxl-ac-item .pxl-ac-desc' => 'color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style!' => 'style8'
                                ]
                            ),
                            array(
                                'name' => 'desc_typography',
                                'label' => esc_html__('Description Typography', 'basilico' ),
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-accordion .pxl-ac-item .pxl-ac-content',
                                'condition' => [
                                    'style!' => 'style8'
                                ]
                            ),
                            array(
                                'name' => 'icon_color',
                                'label' => esc_html__('Icon Color', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-accordion .pxl-ac-item .pxl-ac-title:before,
                                     {{WRAPPER}} .pxl-accordion.style9 .pxl-ac-title.active > span:before,
                                     {{WRAPPER}} .pxl-accordion.style9 .pxl-ac-title.active > span:after' => 'color: {{VALUE}};',
                                    '{{WRAPPER}} .pxl-accordion .pxl-ac-item .pxl-ac-title:after' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'icon_color_active',
                                'label' => esc_html__('Icon Color Active', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-accordion .pxl-ac-title.active:after' => 'color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style' => 'style8'
                                ]
                            ),
                            array(
                                'name' => 'icon_size',
                                'label' => esc_html__('Icon Size', 'basilico'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'condition' => [
                                    'style' => 'style9'
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-accordion.style9 .pxl-ac-title.active > span:before, {{WRAPPER}} .pxl-accordion.style9 .pxl-ac-title.active > span:after'
                                     => 'font-size: {{VALUE}}px;'
                                ],
                            ),
                            array(
                                'name' => 'divider_color',
                                'label' => esc_html__('Divider Color', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-accordion .pxl-ac-title' => 'border-bottom-color: {{VALUE}};',
                                    '{{WRAPPER}} .pxl-accordion .pxl-ac-content' => 'border-color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style' => 'style1'
                                ]
                            ),
                            array(
                                'name' => 'divider_color_active',
                                'label' => esc_html__('Divider Color Active', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::COLOR,
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-accordion .pxl-ac-title.active' => 'border-bottom-color: {{VALUE}};',
                                ],
                                'condition' => [
                                    'style' => 'style1'
                                ]
                            ),
                            array(
                                'name' => 'content_padding',
                                'label' => esc_html__('Content Padding', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px' ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-accordion .pxl-ac-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
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
                                'prefix_class' => 'elementor-align-',
                                'default' => '',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-accordion.style9' => 'text-align: {{VALUE}};'
                                ],
                                'condition' => [
                                    'style' => 'style9'
                                ]
                            ),
                        )
                    ),
                ),
                
            ),
        ),
    ),
    basilico_get_class_widget_path()
);