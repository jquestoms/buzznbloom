<?php

use Elementor\Controls_Manager;

$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
$custom_menus = array(
    '' => esc_html__('Default', 'basilico')
);
if ( is_array( $menus ) && ! empty( $menus ) ) {
    foreach ( $menus as $single_menu ) {
        if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
            $custom_menus[ $single_menu->slug ] = $single_menu->name;
        }
    }
} else {
    $custom_menus = '';
}

pxl_add_custom_widget(
    array(
        'name' => 'pxl_menu',
        'title' => esc_html__('Pxl Menu', 'basilico'),
        'icon' => 'eicon-nav-menu',
        'categories' => array('pxltheme-core'),
        'scripts' => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'basilico'),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'type',
                            'label' => esc_html__('Type', 'basilico' ),
                            'type' => 'select',
                            'options' => [
                                '1' => esc_html__('Primary Menu', 'basilico'),
                                '2' => esc_html__('Menu Inner', 'basilico'),
                                '3' => esc_html__('Mobile Menu', 'basilico'),
                                '4' => esc_html__('Sidebar Menu', 'basilico'),
                                '5' => esc_html__('Menu Custom', 'basilico'),
                            ],
                            'default' => '1',
                        ),
                        array(
                            'name' => 'el_title',
                            'label' => esc_html__('Sidebar Widget Title', 'basilico'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                            'condition' => [
                                'type' => '4',
                            ],
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Menu Style', 'basilico' ),
                            'type' => 'select',
                            'options' => [
                                '1' => esc_html__('Underline Top', 'basilico'),
                                '2' => esc_html__('Underline Bottom', 'basilico'),
                                '3' => esc_html__('Vertical', 'basilico'),
                                '4' => esc_html__('Slash Between', 'basilico'),
                                '5' => esc_html__('Rounded', 'basilico'),
                                '6' => esc_html__('Coffee Bean', 'basilico'),
                                '7' => esc_html__('Creams', 'basilico'),
                                '8' => esc_html__('Sushi', 'basilico'),
                                '9' => esc_html__('Seafood', 'basilico'),
                                '10' => esc_html__('Steak', 'basilico'),
                                '11' => esc_html__('Chocolate', 'basilico'),
                            ],
                            'default' => '1',
                            'condition' => [
                                'type' => ['1','2'],
                            ]
                        ),
                        array(
                            'name' => 'style_custom',
                            'label' => esc_html__('Menu Style', 'basilico' ),
                            'type' => 'select',
                            'options' => [
                                'style-1' => esc_html__('Style 1', 'basilico'),
                                'style-2' => esc_html__('Style 2', 'basilico'),
                                'style-3' => esc_html__('Style 2', 'basilico'),
                            ],
                            'default' => '1',
                            'condition' => [
                                'type' => ['5'],
                            ]
                        ),
                        array(
                            'name' => 'menu',
                            'label' => esc_html__('Select Menu', 'basilico'),
                            'type' => 'select',
                            'options' => $custom_menus,
                        ),
                        array(
                            'name'         => 'align',
                            'label'        => esc_html__( 'Alignment', 'basilico' ),
                            'type'         => 'choose',
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
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu' => 'justify-content: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu.style-3 .menu-item' => 'justify-content: {{VALUE}};',
                            ],
                            'condition' => [
                                'type' => ['1','3'],
                            ]
                        ),
                        array(
                            'name' => 'menu_flex_grow',
                            'label' => esc_html__( 'Flex Grow', 'basilico' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                '0' => [
                                    'title' => esc_html__( 'Inherit', 'basilico' ),
                                    'icon' => 'eicon-h-align-center',
                                ],
                                '1' => [
                                    'title' => esc_html__( 'Fill available space', 'basilico' ),
                                    'icon' => 'eicon-h-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}}' => 'flex-grow: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'first_section',
                    'label' => esc_html__('Style First Level', 'basilico'),
                    'tab' => 'content',
                    'condition' => [
                        'type' => ['1','3','5'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'color',
                            'label' => esc_html__('Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li > a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li > a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li .main-menu-toggle:before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li .main-menu-toggle:before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu.pxl-nav-menu-main.style-8 .pxl-primary-menu > li:not(:last-child):after' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-custom-menu > li > a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'color_hover',
                            'label' => esc_html__('Color Hover', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li > a:hover'                      => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-item > a'          => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu:not(.style-6) .pxl-primary-menu > li.current-menu-ancestor > a'      => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li:hover:before'                   => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-item:before'       => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-ancestor:before'   => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li > a:hover'                       => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li:hover .main-menu-toggle:before' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li:hover .main-menu-toggle:before'  => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-custom-menu > li > a:hover'                      => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'underline_color',
                            'label' => esc_html__('Underline Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li:before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li:before, {{WRAPPER}} .pxl-nav-menu.pxl-nav-menu-main.style-2 .pxl-primary-menu > li a:before,
                                {{WRAPPER}} .pxl-nav-menu.pxl-nav-menu-main.style-10 .pxl-primary-menu > li > a:before,
                                {{WRAPPER}} .pxl-nav-menu.pxl-nav-menu-main.style-11 .pxl-primary-menu > li > a:before,
                                {{WRAPPER}} .pxl-nav-menu.pxl-nav-menu-main.style-11 .pxl-primary-menu > li.menu-item-has-children > a > span::before,
                                {{WRAPPER}} .pxl-nav-menu.pxl-nav-menu-main.style-11 .pxl-primary-menu > li.menu-item-has-children > a > span::after' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'type!' => ['5'],
                            ],
                        ),
                        array(
                            'name' => 'underline_color_customs',
                            'label' => esc_html__('Underline Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu.pxl-nav-menu-custom.style-3 .main-menu-toggle:before' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'style_custom' => ['style-3'],
                            ],
                        ),
                        array(
                            'name' => 'typography',
                            'label' => esc_html__('Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li > a, {{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li > a,{{WRAPPER}} .pxl-nav-menu .pxl-custom-menu > li > a',
                        ),
                        array(
                            'name'  => 'show_arrow',
                            'label' => esc_html__('Show Arrow', 'basilico'),
                            'type'  => 'switcher',
                            'return_value' => 'yes',
                            'default' => 'no',
                            'condition' => [
                                'type' => ['1'],
                                'type!' => ['5'],
                            ],
                        ),
                        array(
                            'name'  => 'show_underline',
                            'label' => esc_html__('Show Underline', 'basilico'),
                            'type'  => 'switcher',
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'condition' => [
                                'type' => ['1'],
                                'type!' => ['5'],
                            ],
                        ),
                        array(
                            'name' => 'item_space',
                            'label' => esc_html__('Item Space', 'basilico' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', 'em', '%', 'rem' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-primary-menu > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-mobile-menu > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-nav-menu.style-4 .pxl-primary-menu > li:not(:last-child):after' => 'right: calc(({{LEFT}}{{UNIT}} + {{RIGHT}}{{UNIT}}) / 2 * -1);',
                                '{{WRAPPER}} .pxl-custom-menu > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'sub_section',
                    'label' => esc_html__('Style Sub Level', 'basilico'),
                    'tab' => 'content',
                    'condition' => [
                        'type' => ['1','3','5'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'submenu_space_top',
                            'label' => esc_html__('Space Top', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' , 'em' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-primary-menu > .menu-item > .sub-menu' => 'top: calc(100% + 20px + {{SIZE}}{{UNIT}});',
                                '{{WRAPPER}} .pxl-primary-menu > li.active > .sub-menu, {{WRAPPER}} .pxl-primary-menu > li:hover > .sub-menu' => 'top: calc(100% + {{SIZE}}{{UNIT}});'
                            ],
                            'condition' => [
                                'type!' => ['5'],
                            ],
                        ),
                        array(
                            'name' => 'sub_color',
                            'label' => esc_html__('Text Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu li .sub-menu a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-primary-menu .sub-menu li.menu-item-has-children:after' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-custom-menu li .sub-menu a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu.pxl-nav-menu-main.style-9 .pxl-primary-menu > li .sub-menu > li > a span::after' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_color_hover',
                            'label' => esc_html__('Color Hover/Active', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu .sub-menu .menu-item:hover > a,
                                 {{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu .sub-menu .current-menu-item > a,
                                 {{WRAPPER}} .pxl-nav-menu .pxl-custom-menu .sub-menu .menu-item:hover > a,
                                 {{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu .sub-menu .current-menu-ancestor > a' => 'color: {{VALUE}};',
                                 '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu a:hover, {{WRAPPER}} .pxl-nav-menu .pxl-primary-menu .sub-menu > li.current-menu-item a' => 'color: {{VALUE}};',
                                 '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu li .sub-menu a:hover' => 'color: {{VALUE}};',
                                 '{{WRAPPER}} .pxl-nav-menu .pxl-custom-menu .sub-menu .menu-item:hover > a::before' => 'background-color: {{VALUE}};',
                                 '{{WRAPPER}} .pxl-nav-menu.pxl-nav-menu-main .pxl-primary-menu > li .sub-menu > li > a span::after' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_typography',
                            'label' => esc_html__('Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu a, {{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu li .sub-menu a, {{WRAPPER}} .pxl-nav-menu .pxl-custom-menu li .sub-menu a',
                        ),
                        array(
                            'name' => 'sub_background',
                            'label' => esc_html__('Background Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu .sub-menu' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'type!' => ['5'],
                            ],
                        ),
                        array(
                            'name' => 'divider_type',
                            'label' => esc_html__( 'Divider Type', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'none' => esc_html__( 'None', 'basilico' ),
                                'solid' => esc_html__( 'Solid', 'basilico' ),
                                'double' => esc_html__( 'Double', 'basilico' ),
                                'dotted' => esc_html__( 'Dotted', 'basilico' ),
                                'dashed' => esc_html__( 'Dashed', 'basilico' ),
                                'groove' => esc_html__( 'Groove', 'basilico' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu .sub-menu > li a' => 'border-bottom-style: {{VALUE}};',
                            ],
                            'condition' => [
                                'type!' => ['5'],
                            ],
                            'default' => 'solid',
                        ),
                        array(
                            'name' => 'divider_color',
                            'label' => esc_html__('Divider Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu .sub-menu > li a' => 'border-bottom-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'type!' => ['5'],
                            ],
                        ),
                        array(
                            'name'         => 'box_shadow',
                            'label'        => esc_html__( 'Box Shadow', 'basilico' ),
                            'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                            'control_type' => 'group',
                            'exclude' => [
                                'box_shadow_position',
                            ],
                            'selector' => '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu .sub-menu',
                            'condition' => [
                                'type!' => ['5'],
                            ],
                        ),
                        array(
                            'name' => 'border_radius',
                            'label' => esc_html__('Border Radius', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'type!' => ['5'],
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'nav_section',
                    'label' => esc_html__('Style', 'basilico'),
                    'tab' => 'content',
                    'condition' => [
                        'type' => ['2'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'nav_color',
                            'label' => esc_html__('Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner li' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'nav_color_hover',
                            'label' => esc_html__('Color Hover', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner a:hover' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'  => 'icon_size',
                            'label' => esc_html__( 'Icon Size(px)', 'basilico' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 5,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner a .link-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Icon Color', 'basilico' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner a .link-icon' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'  => 'border_hover',
                            'label' => esc_html__('Border Hover', 'basilico'),
                            'type'  => 'switcher',
                            'return_value' => 'yes',
                            'default' => 'yes',
                        ),
                        array(
                            'name' => 'nav_typography',
                            'label' => esc_html__('Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner a',
                        ),
                        array(
                            'name' => 'nav_item_space',
                            'label' => esc_html__('Item Space', 'basilico' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    basilico_get_class_widget_path()
);