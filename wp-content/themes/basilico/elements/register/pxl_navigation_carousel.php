<?php
// Register PXL Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_navigation_carousel',
        'title' => esc_html__('Navigation Carousel', 'basilico' ),
        'icon' => 'eicon-dual-button',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Navigation Setting', 'basilico' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'carousel_ids',
                            'label' => esc_html__('Carousel Ids', 'basilico'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'description' => esc_html__('List of CSS ID of carousel widget that navigation will affect, without #, separated by commas. Example: "id1, id2"', 'basilico'),
                        ),
                        array(
                            'name' => 'nav_style',
                            'label' => esc_html__('Navigation Style', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'default' => 'Default',
                            ],
                            'default' => 'default',
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'prev_background',
                            'label' => esc_html__('Prev Button Background', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-carousel .nav-prev' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'prev_color',
                            'label' => esc_html__('Prev Button Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-carousel .nav-prev i' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'next_background',
                            'label' => esc_html__('Next Button Background', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-carousel .nav-next' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'next_color',
                            'label' => esc_html__('Next Button Color', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-carousel .nav-next i' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'  =>  'button_size',
                            'type'  =>  \Elementor\Controls_Manager::SLIDER,
                            'label' => esc_html__('Button Size', 'basilico'),
                            'size_units' => ['px'],
                            'range' => [
                                'px' => [
                                    'min' => 30,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-navigation-carousel .nav-button' => 'width: {{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
                            ],

                        ),
                    )
                ),  
            ),
        ),
    ),
    basilico_get_class_widget_path()
);