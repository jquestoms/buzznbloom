<?php
// Register Widget
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_download',
        'title'      => esc_html__( 'PXL Download', 'basilico' ),
        'icon' => 'eicon-file-download',
        'categories' => array('pxltheme-core'),
        'scripts'    => [],
        'params'     => array(
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_download-1.jpg'
                                ],
                            ],
                            'prefix_class' => 'pxl-download-layout-',
                        ),
                    )
                ),
                array(
                    'name'     => 'list_section',
                    'label'    => esc_html__( 'Content Settings', 'basilico' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'el_title',
                            'label' => esc_html__('Element Title', 'basilico'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'download_description',
                            'label' => esc_html__('Description', 'basilico'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'download',
                            'label' => esc_html__('Download Lists', 'basilico'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'file_name',
                                    'label' => esc_html__('File Name', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'file_type_icon',
                                    'label' => esc_html__('File Icon', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                    'default' => [
                                        'value' => 'fas fa-star',
                                        'library' => 'fa-solid',
                                    ],
                                ),
                                array(
                                    'name' => 'file_size',
                                    'label' => esc_html__('File Size', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::URL,
                                ),
                            ),
                            'title_field' => '{{{ file_name }}}',
                        ),
                    )
                )
            )
        )
    ),
    basilico_get_class_widget_path()
);