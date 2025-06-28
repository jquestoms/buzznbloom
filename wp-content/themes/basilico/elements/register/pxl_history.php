<?php
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_history',
        'title'      => esc_html__('PXL History', 'basilico'),
        'icon'       => 'eicon-slider-push',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'basilico' ),
                    'tab' => 'layout',
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'basilico' ),
                            'type' => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_history-1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_history-2.jpg'
                                ]
                            ],
                            'prefix_class' => 'pxl-history-layout-'
                        )
                    ),
                ),
                array(
                    'name'     => 'history_list',
                    'label'    => esc_html__('History List', 'basilico'),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'history_items',
                            'label'    => esc_html__('Add Item', 'basilico'),
                            'type'     => 'repeater',
                            'controls' => array(
                                array(
                                    'name'     => 'title',
                                    'label'    => esc_html__('Title', 'basilico'),
                                    'type'     => 'text',
                                    'default'  => esc_html__('first formation.', 'basilico'),
                                ),
                                array(
                                    'name'     => 'description',
                                    'label'    => esc_html__('Description', 'basilico'),
                                    'type'     => 'textarea',
                                    'rows' => 3,
                                    'default'  => esc_html__('Aliquam erat metus, rutrum ut sagittis eu, viverra volutpat arcu. Mauris fermentum sodales nibh, sed vulputate lacus congue sit amet. Nam at lobortis mi. Nullam sit amet feugiat libero.', 'basilico'),
                                ),
                                array(
                                    'name'        => 'year',
                                    'label'       => esc_html__('History Year', 'basilico'),
                                    'type'        => 'text',
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'history_img',
                                    'label'       => esc_html__('History Image', 'basilico'),
                                    'type'        => 'media',
                                    'label_block' => true,
                                ),
                                array(
                                    'name'        => 'image_link',
                                    'label'       => esc_html__( 'History Link', 'basilico' ),
                                    'type'        => 'url',
                                    'placeholder' => esc_html__( 'https://your-link.com', 'basilico' ),
                                    'default'     => [
                                        'url'         => '#',
                                        'is_external' => 'on'
                                    ],
                                ),
                            ),
                            'default' => [],
                            'title_field' => '{{{ year }}}',
                        ),
                        array(
                            'name' => 'icon_background',
                            'label' => esc_html__('Diamond Icon Background', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-history .diamond-icon:before' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-history .diamond-icon:after' => 'background-color: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'icon_space',
                            'label' => esc_html__('Diamond Icon Space Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-history .diamond-icon:before' => 'background-color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            )
        )
    ),
    basilico_get_class_widget_path()
);