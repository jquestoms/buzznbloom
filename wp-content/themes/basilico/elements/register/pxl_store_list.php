<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_store_list',
        'title' => esc_html__('PXL Store List', 'basilico' ),
        'icon' => 'eicon-bullet-list',
        'categories' => array('pxltheme-core'),
        'scripts'    => array('basilico-storelist'),
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
                                    'name' => 'store_icon',
                                    'label' => esc_html__('Store Icon', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                    'default' => [
                                        'value' => 'fas fa-store',
                                        'library' => 'fa-solid',
                                    ],
                                ),
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__('Title', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'desc',
                                    'label' => esc_html__('Description', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Button Link', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'tab_style',
                    'label' => esc_html__('Style', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'button_style',
                            'label' => esc_html__('Button Styles', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'btn-additional-8',
                            'options' => [
                                'btn-default' => esc_html__('Default', 'basilico' ),
                                'btn-white' => esc_html__('White', 'basilico' ),
                                'btn-outline' => esc_html__('Out Line', 'basilico' ),
                                'btn-outline-secondary' => esc_html__('Out Line Secondary', 'basilico' ),
                                'btn-additional-1' => esc_html__('Additional Button 01', 'basilico' ),
                                'btn-additional-2' => esc_html__('Additional Button 02', 'basilico' ),
                                'btn-additional-3' => esc_html__('Additional Button 03', 'basilico' ),
                                'btn-additional-4' => esc_html__('Additional Button 04', 'basilico' ),
                                'btn-additional-5' => esc_html__('Additional Button 05', 'basilico' ),
                                'btn-additional-6' => esc_html__('Additional Button 06', 'basilico' ),
                                'btn-additional-7' => esc_html__('Additional Button 07', 'basilico' ),
                                'btn-additional-8' => esc_html__('Additional Button 08', 'basilico' ),
                                'btn-additional-9' => esc_html__('Additional Button 09', 'basilico' ),
                                'btn-additional-10' => esc_html__('Additional Button 10', 'basilico' ),
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    basilico_get_class_widget_path()
);