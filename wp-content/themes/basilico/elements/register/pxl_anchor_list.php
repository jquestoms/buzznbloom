<?php
$templates_df = [
    0 => esc_html__('None', 'basilico'),
    'cart-dropdown' => esc_html__('Cart Dropdown', 'basilico'),
    'cart-page' => esc_html__('Cart Page', 'basilico'),
    'url' => esc_html__('URL', 'basilico')
];
$templates = $templates_df + basilico_get_templates_option('hidden-panel');

pxl_add_custom_widget(
    array(
        'name'       => 'pxl_anchor_list',
        'title'      => esc_html__( 'PXL Anchor List', 'basilico' ),
        'icon'       => 'eicon-anchor',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Layout', 'basilico' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'basilico' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_banner_carousel-1.jpg'
                                ],
                            ],
                        ),
                        
                    ),
                ),
                array(
                    'name'     => 'icon_section',
                    'label'    => esc_html__( 'Settings', 'basilico' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'anchors',
                            'label' => esc_html__('', 'basilico'),
                            'type' => 'repeater',
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'template',
                                    'label' => esc_html__('Select Templates', 'basilico'),
                                    'type' => 'select',
                                    'options' => $templates,
                                    'default' => 'df' 
                                ),
                                array(
                                    'name' => 'cart_style',
                                    'label' => esc_html__('Dropdown Layout', 'basilico'),
                                    'type' => 'select',
                                    'options' => [
                                        'layout-1' => esc_html__('Layout 1', 'basilico'),
                                        'layout-2' => esc_html__('Layout 2', 'basilico'),
                                        'layout-3' => esc_html__('Layout 3', 'basilico'),
                                        'layout-4' => esc_html__('Layout 4', 'basilico'),
                                    ],
                                    'default' => 'layout-1',
                                    'condition' => ['template' => 'cart-dropdown']
                                ),
                                array(
                                    'name'             => 'selected_icon',
                                    'label'            => esc_html__( 'Icon', 'basilico' ),
                                    'type'             => 'icons',
                                    'default'          => [
                                        'library' => 'pxli',
                                        'value'   => 'pxli-search-400'
                                    ],
                                ),
                                array(
                                    'name'  => 'cart_count',
                                    'label' => esc_html__('Show Cart Count', 'basilico'),
                                    'type'  => \Elementor\Controls_Manager::SWITCHER,
                                    'default' => 'false',
                                    'condition' => [
                                        'template' => ['cart-dropdown', 'cart-page']
                                    ],
                                ),
                                array(
                                    'name'  => 'anchor_url',
                                    'label' => esc_html__('URL' ,'basilico'),
                                    'type'  => \Elementor\Controls_Manager::TEXT,
                                    'condition' => [
                                        'template' => ['url']
                                    ],
                                ),
                            ),
                        ),
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style Settings', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array_merge(
                        array(
                            array(
                                'name'  => 'icon_size',
                                'label' => esc_html__( 'Icon Size(px)', 'basilico' ),
                                'type'  => 'slider',
                                'range' => [
                                    'px' => [
                                        'min' => 15,
                                        'max' => 300,
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor' => 'font-size: {{SIZE}}{{UNIT}};',
                                    '{{WRAPPER}} .pxl-anchor svg' => 'width: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                            array(
                                'name' => 'icon_color',
                                'label' => esc_html__('Color', 'basilico' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor' => 'color: {{VALUE}};'
                                ],
                            ),
                            array(
                                'name' => 'container_background',
                                'label' => esc_html__('Background Hover', 'basilico' ),
                                'type' => \Elementor\Group_Control_Background::get_type(),
                                'control_type' => 'group',
                                'types' => ['classic', 'gradient'],
                                'selector' => '{{WRAPPER}} .pxl-anchor-list.layout-1 .pxl-anchor-list-wrap',
                            ),
                            array(
                                'name' => 'icon_color_hover',
                                'label' => esc_html__('Icon Hover', 'basilico' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor-list.layout-1 .pxl-anchor:hover' => 'color: {{VALUE}};',
                                    '{{WRAPPER}} .pxl-anchor-list.layout-1 .pxl-anchor:hover svg' => 'fill: {{VALUE}};'
                                ],
                                'separator' => 'before'
                            ),
                            array(
                                'name' => 'icon_color_background',
                                'label' => esc_html__('Icon Background Hover', 'basilico' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-anchor-list.layout-1 .pxl-anchor:before' => 'background-color: {{VALUE}};'
                                ],
                            ),
                        ),
                    ),
                ),
            ),
),
),
basilico_get_class_widget_path()
);