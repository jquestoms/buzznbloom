<?php
// Register Fancy Box Widget
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_single_navigation',
        'title'      => esc_html__( 'PXL Single Navigation', 'basilico' ),
        'icon'       => 'eicon-icon-box',
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
                            'default' => 'default',
                            'options' => [
                                'default' => esc_html__('Default', 'basilico' ),
                                'style-2' => esc_html__('Style 2', 'basilico' ),
                            ],
                        ),
                    ),
                ),
            )
        )
    ),
    basilico_get_class_widget_path()
);