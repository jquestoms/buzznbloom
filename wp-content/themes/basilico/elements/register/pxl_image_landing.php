<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_image_landing',
        'title' => esc_html__('PXL Image Landing', 'basilico' ),
        'icon' => 'eicon-image',
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
                            'label'   => esc_html__( 'Layout', 'basilico' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_image_landing-1.jpg'
                                ],
                            ],
                        ),
                    )
                ),
                array(
                    'name' => 'content_section',
                    'label' => esc_html__('Content', 'basilico' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'selected_image',
                            'label' => esc_html__('Image', 'basilico' ),
                            'type' => 'media',
                        ),
                        array(
                            'name' => 'title_text',
                            'label' => esc_html__('Title Text', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => esc_html__('Homepage', 'basilico'),
                        ),
                        array(
                            'name' => 'link_type',
                            'label' => esc_html__('Link Type', 'basilico'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options'       => [
                                'url'   => esc_html__('URL', 'basilico'),
                                'page'  => esc_html__('Existing Page', 'basilico'),
                            ],
                            'default'       => 'url',
                        ),
                        array(
                            'name' => 'link',
                            'label' => esc_html__('Link', 'basilico'),
                            'type' => \Elementor\Controls_Manager::URL,
                            'placeholder' => esc_html__('https://your-link.com', 'basilico' ),
                            'condition'     => [
                                'link_type'     => 'url',
                            ],
                            'default' => [
                                'url' => '#',
                            ],
                        ),
                        array(
                            'name' => 'page_link',
                            'label' => esc_html__('Existing Page', 'basilico'),
                            'type' => \Elementor\Controls_Manager::SELECT2,
                            'options'       => pxl_get_all_page(),
                            'condition'     => [
                                'link_type'     => 'page',
                            ],
                            'multiple'      => false,
                            'label_block'   => true,
                        ),
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style', 'basilico' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__('Border Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-landing .image-wrap' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'border_hover_color',
                            'label' => esc_html__('Border Hover Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-landing:hover .image-wrap' => 'border-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-image-landing .image-title',
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image-landing .image-title' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    basilico_get_class_widget_path()
);