<?php
// Register Widget
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_single_info',
        'title'      => esc_html__( 'PXL Single Info', 'basilico' ),
        'icon' => 'eicon-price-list',
        'categories' => array('pxltheme-core'),
        'scripts'    => [],
        'params'     => array(
            'sections' => array(
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Content Settings', 'basilico' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'el_style',
                            'label' => esc_html__('Style', 'basilico'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style-1' => esc_html__('Style 1', 'basilico'),
                                'style-2' => esc_html__('Style 2', 'basilico'),
                            ],
                            'default' => 'style-1'
                        ),
                        array(
                            'name' => 'el_title',
                            'label' => esc_html__('Element Title', 'basilico'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'single_info_items',
                            'label' => esc_html__('List Items', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'info_label',
                                    'label' => esc_html__('Label', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                ),
                                array(
                                    'name' => 'info_type',
                                    'label'    => esc_html__('Type', 'basilico'), 
                                    'type'     => \Elementor\Controls_Manager::SELECT,
                                    'options'  => array(
                                        'text' => esc_html__('Text', 'basilico'),
                                        'post_title' => esc_html__('Current Post Title', 'basilico'),
                                        'post_categories' => esc_html__('Current Post Categories', 'basilico'), 
                                        'post_tags' => esc_html__('Current Post Tags', 'basilico'), 
                                        'post_date' => esc_html__('Current Post Date', 'basilico'),
                                    ),
                                    'default' => 'text'
                                ),
                                array(
                                    'name' => 'info_text',
                                    'label' => esc_html__('Text', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'condition' => [
                                        'info_type' => 'text'
                                    ]
                                ),
                            ),
                            'title_field' => '{{{ info_label }}}',
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'show_social',
                            'label' => esc_html__('Show Social Share', 'basilico'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true'
                        ),
                    )
                )
            )
        )
    ),
    basilico_get_class_widget_path()
);