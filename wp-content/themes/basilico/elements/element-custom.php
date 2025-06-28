<?php

add_action( 'elementor/element/section/section_structure/after_section_end', 'basilico_add_custom_section_controls' );
function basilico_add_custom_section_controls( \Elementor\Element_Base $element) {
    $element->start_controls_section(
        'section_pxl',
        [
            'label' => esc_html__( 'Basilico Settings', 'basilico' ),
            'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
        ]
    );
    if ( get_post_type( get_the_ID()) === 'pxl-template' && get_post_meta( get_the_ID(), 'template_type', true ) === 'header') {

        $element->add_control(
            'pxl_header_type',
            [
                'label' => esc_html__( 'Header Type', 'basilico' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'hide_in_inner' => true,
                'options'      => array(
                    ''          => esc_html__( 'Select Type', 'basilico' ),
                    'main-sticky'       => esc_html__( 'Header Main & Sticky', 'basilico' ),
                    'sticky'      => esc_html__( 'Header Sticky', 'basilico' ),
                    'transparent' => esc_html__( 'Header Transparent', 'basilico' ),
                ),
                'default'      => '', 
            ]
        );
    }
    if ( get_post_type( get_the_ID()) === 'pxl-template' && get_post_meta( get_the_ID(), 'template_type', true ) === 'header-mobile') {
        $element->add_control(
            'pxl_header_mobile_type',
            [
                'label' => esc_html__( 'Header Type', 'basilico' ),
                'type'  => \Elementor\Controls_Manager::SELECT,
                'hide_in_inner' => true,
                'options'      => array(
                    ''          => esc_html__( 'Select Type', 'basilico' ),
                    'main-sticky'       => esc_html__( 'Main & Sticky', 'basilico' ),
                    'sticky'      => esc_html__( 'Sticky', 'basilico' ),
                    'transparent' => esc_html__( 'Transparent', 'basilico' ),
                ),
                'default'      => '',
            ]
        );
    }

    $element->add_control(
        'pxl_section_offset',
        [
            'label' => esc_html__( 'Section Offset', 'basilico' ),
            'type'         => \Elementor\Controls_Manager::SELECT,
            'prefix_class' => 'pxl-section-offset-',
            'hide_in_inner' => true,
            'options'      => array(
                'none'    => esc_html__( 'None', 'basilico' ),
                'left'   => esc_html__( 'Left', 'basilico' ),
                'right'     => esc_html__( 'Right', 'basilico' ),
            ),
            'default'      => 'none',
            'condition' => [
                'layout' => 'full_width'
            ]
        ]
    );

    $element->add_control(
        'pxl_container_width',
        [
            'label' => esc_html__( 'Container Width', 'basilico' ),
            'type'         => \Elementor\Controls_Manager::SELECT,
            'prefix_class' => 'pxl-container-width-',
            'hide_in_inner' => true,
            'options'      => array(
                'container-1200'    => esc_html__( '1200px', 'basilico' ),
                'container-1570'    => esc_html__( '1570px', 'basilico' )
            ),
            'default'      => 'container-1200',
            'condition' => [
                'layout' => 'full_width',
                'pxl_section_offset!' => 'none'
            ]
        ]
    );

    $element->add_control(
        'pxl_section_border_animated',
        [
            'label' => esc_html__('Border Animated', 'basilico'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'basilico' ),
            'label_off' => esc_html__( 'No', 'basilico' ),
            'return_value' => 'yes',
            'default' => 'no',
            'separator' => 'after',
        ]
    );

    $element->add_control(
        'pxl_parallax_bg_img',
        [
            'label' => esc_html__( 'Parallax Background Image', 'basilico' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'selectors' => [
                '{{WRAPPER}} .pxl-section-bg-parallax' => 'background-image: url( {{URL}} );',
            ],
        ]
    );
    $element->add_responsive_control(
        'pxl_parallax_bg_position',
        [
            'label' => esc_html__( 'Background Position', 'basilico' ),
            'type'         => \Elementor\Controls_Manager::SELECT,
            'options'      => array(
                ''              => esc_html__( 'Default', 'basilico' ),
                'center center' => esc_html__( 'Center Center', 'basilico' ),
                'center left'   => esc_html__( 'Center Left', 'basilico' ),
                'center right'  => esc_html__( 'Center Right', 'basilico' ),
                'top center'    => esc_html__( 'Top Center', 'basilico' ),
                'top left'      => esc_html__( 'Top Left', 'basilico' ),
                'top right'     => esc_html__( 'Top Right', 'basilico' ),
                'bottom center' => esc_html__( 'Bottom Center', 'basilico' ),
                'bottom left'   => esc_html__( 'Bottom Left', 'basilico' ),
                'bottom right'  => esc_html__( 'Bottom Right', 'basilico' ),
                'initial'       =>  esc_html__( 'Custom', 'basilico' ),
            ),
            'default'      => '',
            'selectors' => [
                '{{WRAPPER}} .pxl-section-bg-parallax' => 'background-position: {{VALUE}};',
            ],
            'condition' => [
                'pxl_parallax_bg_img[url]!' => ''
            ]        
        ]
    );
    
    $element->add_responsive_control(
        'pxl_parallax_bg_pos_custom_x',
        [
            'label' => esc_html__( 'X Position', 'basilico' ),
            'type' => \Elementor\Controls_Manager::SLIDER,  
            'size_units' => [ 'px', 'em', '%', 'vw' ],
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => -800,
                    'max' => 800,
                ],
                'em' => [
                    'min' => -100,
                    'max' => 100,
                ],
                '%' => [
                    'min' => -100,
                    'max' => 100,
                ],
                'vw' => [
                    'min' => -100,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-section-bg-parallax' => 'background-position: {{SIZE}}{{UNIT}} {{pxl_parallax_bg_pos_custom_y.SIZE}}{{pxl_parallax_bg_pos_custom_y.UNIT}}',
            ],
            'condition' => [
                'pxl_parallax_bg_position' => [ 'initial' ],
                'pxl_parallax_bg_img[url]!' => '',
            ],
        ]
    );
    $element->add_responsive_control(
        'pxl_parallax_bg_pos_custom_y',
        [
            'label' => esc_html__( 'Y Position', 'basilico' ),
            'type' => \Elementor\Controls_Manager::SLIDER,  
            //'hide_in_inner' => true,
            'size_units' => [ 'px', 'em', '%', 'vw' ],
            'default' => [
                'unit' => 'px',
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'min' => -800,
                    'max' => 800,
                ],
                'em' => [
                    'min' => -100,
                    'max' => 100,
                ],
                '%' => [
                    'min' => -100,
                    'max' => 100,
                ],
                'vw' => [
                    'min' => -100,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-section-bg-parallax' => 'background-position: {{pxl_parallax_bg_pos_custom_x.SIZE}}{{pxl_parallax_bg_pos_custom_x.UNIT}} {{SIZE}}{{UNIT}}',
            ],

            'condition' => [
                'pxl_parallax_bg_position' => [ 'initial' ],
                'pxl_parallax_bg_img[url]!' => '',
            ],
        ]
    );
    $element->add_responsive_control(
        'pxl_parallax_bg_size',
        [
            'label' => esc_html__( 'Background Size', 'basilico' ),
            'type'         => \Elementor\Controls_Manager::SELECT,
            'options'      => array(
                ''              => esc_html__( 'Default', 'basilico' ),
                'auto' => esc_html__( 'Auto', 'basilico' ),
                'cover'   => esc_html__( 'Cover', 'basilico' ),
                'contain'  => esc_html__( 'Contain', 'basilico' ),
                'initial'    => esc_html__( 'Custom', 'basilico' ),
            ),
            'default'      => '',
            'selectors' => [
                '{{WRAPPER}} .pxl-section-bg-parallax' => 'background-size: {{VALUE}};',
            ],
            'condition' => [
                'pxl_parallax_bg_img[url]!' => ''
            ]        
        ]
    );
    $element->add_responsive_control(
        'pxl_parallax_bg_size_custom',
        [
            'label' => esc_html__( 'Background Width', 'basilico' ),
            'type' => \Elementor\Controls_Manager::SLIDER,  
            'size_units' => [ 'px', 'em', '%', 'vw' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
                'vw' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'size' => 100,
                'unit' => '%',
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-section-bg-parallax' => 'background-size: {{SIZE}}{{UNIT}} auto',
            ],
            'condition' => [
                'pxl_parallax_bg_size' => [ 'initial' ],
                'pxl_parallax_bg_img[url]!' => '',
            ],
        ]
    );


    $element->add_control(
        'pxl_parallax_pos_popover_toggle',
        [
            'label' => esc_html__( 'Parallax Background Position', 'basilico' ),
            'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
            'label_off' => esc_html__( 'Default', 'basilico' ),
            'label_on' => esc_html__( 'Custom', 'basilico' ),
            'return_value' => 'yes',
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    );
    $element->start_popover();
    $element->add_responsive_control(
        'pxl_parallax_pos_left',
        [
            'label' => esc_html__( 'Left', 'basilico' ).' (50px) px,%,vw,auto',
            'type' => 'text',
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .pxl-section-bg-parallax' => 'left: {{VALUE}}',
            ],
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    );
    $element->add_responsive_control(
        'pxl_parallax_pos_top',
        [
            'label' => esc_html__( 'Top', 'basilico' ).' (50px) px,%,vw,auto',
            'type' => 'text',
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .pxl-section-bg-parallax' => 'top: {{VALUE}}',
            ],
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    ); 
    $element->add_responsive_control(
        'pxl_parallax_pos_right',
        [
            'label' => esc_html__( 'Right', 'basilico' ).' (50px) px,%,vw,auto',
            'type' => 'text',
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .pxl-section-bg-parallax' => 'right: {{VALUE}}',
            ],
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    );
    $element->add_responsive_control(
        'pxl_parallax_pos_bottom',
        [
            'label' => esc_html__( 'Bottom', 'basilico' ).' (50px) px,%,vw,auto',
            'type' => 'text',
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .pxl-section-bg-parallax' => 'bottom: {{VALUE}}',
            ],
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    ); 
    $element->end_popover();

    $element->add_control(
        'pxl_parallax_effect_popover_toggle',
        [
            'label' => esc_html__( 'Parallax Background Effect', 'basilico' ),
            'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
            'label_off' => esc_html__( 'Default', 'basilico' ),
            'label_on' => esc_html__( 'Custom', 'basilico' ),
            'return_value' => 'yes',
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    );
    $element->start_popover();
    $element->add_control(
        'pxl_parallax_bg_img_effect_x',
        [
            'label' => esc_html__( 'TranslateX', 'basilico' ).' (-80)',
            'type' => 'text',
            'default' => '',
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    );
    $element->add_control(
        'pxl_parallax_bg_img_effect_y',
        [
            'label' => esc_html__( 'TranslateY', 'basilico' ).' (-80)',
            'type' => 'text',
            'default' => '',
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    );
    $element->add_control(
        'pxl_parallax_bg_img_effect_z',
        [
            'label' => esc_html__( 'TranslateZ', 'basilico' ).' (-80)',
            'type' => 'text',
            'default' => '',
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    );
    $element->add_control(
        'pxl_parallax_bg_img_effect_rotate_x',
        [
            'label' => esc_html__( 'Rotate X', 'basilico' ).' (30)',
            'type' => 'text',
            'default' => '',
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    );
    $element->add_control(
        'pxl_parallax_bg_img_effect_rotate_y',
        [
            'label' => esc_html__( 'Rotate Y', 'basilico' ).' (30)',
            'type' => 'text',
            'default' => '',
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    );
    $element->add_control(
        'pxl_parallax_bg_img_effect_rotate_z',
        [
            'label' => esc_html__( 'Rotate Z', 'basilico' ).' (30)',
            'type' => 'text',
            'default' => '',
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    );
    $element->add_control(
        'pxl_parallax_bg_img_effect_scale_x',
        [
            'label' => esc_html__( 'Scale X', 'basilico' ).' (1.2)',
            'type' => 'text',
            'default' => '',
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    ); 
    $element->add_control(
        'pxl_parallax_bg_img_effect_scale_y',
        [
            'label' => esc_html__( 'Scale Y', 'basilico' ).' (1.2)',
            'type' => 'text',
            'default' => '',
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    );
    $element->add_control(
        'pxl_parallax_bg_img_effect_scale_z',
        [
            'label' => esc_html__( 'Scale Z', 'basilico' ).' (1.2)',
            'type' => 'text',
            'default' => '',
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    );
    $element->add_control(
        'pxl_parallax_bg_img_effect_scale',
        [
            'label' => esc_html__( 'Scale', 'basilico' ).' (1.2)',
            'type' => 'text',
            'default' => '',
            'condition'     => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    );
    $element->end_popover(); 
    
    $element->add_responsive_control(
        'pxl_section_parallax_opacity',
        [
            'label'      => esc_html__( 'Parallax Opacity (0 - 100)', 'basilico' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ '%' ],
            'range' => [
                '%' => [
                    'min' => 1,
                    'max' => 100,
                ]
            ],
            'default'    => [
                'unit' => '%'
            ],
            'laptop_default' => [
                'unit' => '%',
            ],
            'tablet_extra_default' => [
                'unit' => '%',
            ],
            'tablet_default' => [
                'unit' => '%',
            ],
            'mobile_extra_default' => [
                'unit' => '%',
            ],
            'mobile_default' => [
                'unit' => '%',
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-section-bg-parallax' => 'opacity: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'pxl_parallax_bg_img[url]!' => ''
            ] 
        ]
    );
    
    $element->add_control(
        'pxl_section_static_position',
        [
            'label' => esc_html__('Static Position', 'basilico'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'basilico' ),
            'label_off' => esc_html__( 'No', 'basilico' ),
            'return_value' => 'yes',
            'default' => 'no',
            'separator' => 'before',
            'prefix_class' => 'pxl-section-static-pos-'
        ]
    );
    $element->add_control(
        'pxl_section_overflow_hidden',
        [
            'label' => esc_html__('Overflow Hidden', 'basilico'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'basilico' ),
            'label_off' => esc_html__( 'No', 'basilico' ),
            'return_value' => 'yes',
            'default' => 'no',
            'prefix_class' => 'pxl-section-overflow-hidden-'
        ]
    );

    $element->add_control(
        'pxl_bg_ken_burns_bg_img',
        [
            'label' => esc_html__( 'Ken Burns Background Image', 'basilico' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'hide_in_inner' => true,
            'selectors' => [
                '{{WRAPPER}} .pxl-section-bg-ken-burns' => '--pxl-ken-burns-bg-img: url( {{URL}} );',
            ],
        ]
    );
    $element->add_control(
        'pxl_bg_ken_burns_effect',
        [
            'label' => esc_html__('Ken Burns Effect', 'basilico'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '',
            'options' => [
                '' => esc_html__( 'None', 'basilico' ),
                'in' => esc_html__( 'In', 'basilico' ),
                'out' => esc_html__( 'Out', 'basilico' ),
                'in-out' => esc_html__( 'In Out', 'basilico' ),
            ],
            'prefix_class' => 'pxl-section-ken-burns pxl-ken-burns--', 
            'hide_in_inner' => true,
            'condition' => [
                'pxl_bg_ken_burns_bg_img[url]!' => ''
            ],
            'separator' => 'before',
        ]
    );

    $element->end_controls_section();
};

add_action( 'elementor/element/column/layout/after_section_end', 'basilico_add_custom_columns_controls' );
function basilico_add_custom_columns_controls( \Elementor\Element_Base $element) {
    $element->start_controls_section(
        'columns_pxl',
        [
            'label' => esc_html__( 'Basilico Settings', 'basilico' ),
            'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
        ]
    );
    $element->add_control(
        'pxl_col_auto',
        [
            'label'   => esc_html__( 'Element Auto Width', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'options' => array(
                'default'           => esc_html__( 'Default', 'basilico' ),
                'auto'   => esc_html__( 'Auto', 'basilico' ),
            ),
            'label_block'  => true,
            'default'      => 'default',
            'prefix_class' => 'pxl-column-element-'
        ]
    );
    $element->add_control(
        'pxl_col_fullwidth_desktop',
        [
            'label' => esc_html__('Desktop Full Width (> 1500px)', 'basilico'),
            'type'    => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'basilico' ),
            'label_off' => esc_html__( 'No', 'basilico' ),
            'return_value' => 'yes',
            'default' => 'no',
            'prefix_class' => 'pxl-column-fullwidth-',
        ]
    ); 
    $element->add_control(
        'pxl_border_animated',
        [
            'label' => esc_html__('Border Animated', 'basilico'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'basilico' ),
            'label_off' => esc_html__( 'No', 'basilico' ),
            'return_value' => 'yes',
            'default' => 'no',
        ]
    ); 

    $element->end_controls_section();
}

//* Additional Shape Divider
if (!function_exists('basilico_additional_shapes_divider')) {
    add_filter('elementor/shapes/additional_shapes', 'basilico_additional_shapes_divider', 11, 1);
    function basilico_additional_shapes_divider($additional_shapes){
        $additional_shapes['pxl-waves'] = [
            'title' => _x( 'PXL Waves', 'Shapes', 'basilico' ),
            'has_negative' => true,
            'has_flip' => true,
            'height_only' => false,
            'url' => get_template_directory_uri() . '/elements/assets/dividers/wave_animated.svg',
            'path' => get_template_directory() . '/elements/assets/dividers/wave_animated.svg'
        ];
        return $additional_shapes;
    }
}

//* Section Render
add_action( 'elementor/element/after_add_attributes', 'basilico_custom_el_attributes', 10, 1 );
function basilico_custom_el_attributes($el){
    
    $settings = $el->get_settings();
     
    if( 'section' == $el->get_name() ) {
        if ( isset( $settings['pxl_header_type'] ) && !empty($settings['pxl_header_type'] ) ) {
            $el->add_render_attribute( '_wrapper', 'class', 'pxl-header-'.$settings['pxl_header_type']);
        }
        if ( isset( $settings['pxl_header_sticky_effect'] ) && !empty($settings['pxl_header_sticky_effect'] ) ) {
            $el->add_render_attribute( '_wrapper', 'class', 'pxl-header-'.$settings['pxl_header_sticky_effect']);
        }
        if ( isset( $settings['pxl_header_mobile_type'] ) && !empty($settings['pxl_header_mobile_type'] ) ) {
            $el->add_render_attribute( '_wrapper', 'class', 'pxl-header-mobile-'.$settings['pxl_header_mobile_type']);
        }
        if ( isset( $settings['pxl_section_border_animated'] ) && $settings['pxl_section_border_animated'] == 'yes'  ) {
            $el->add_render_attribute( '_wrapper', 'class', 'pxl-border-section-anm');
        }

        if ( isset( $settings['pxl_section_offset'] ) && $settings['pxl_section_offset'] !='none' ) {
            if( $settings['gap'] === 'no' )
                $el->add_render_attribute( '_wrapper', 'class', 'pxl-section-gap-no');
        }
         
    }
    if( 'column' == $el->get_name() ) {
        if ( isset( $settings['pxl_border_animated'] ) && $settings['pxl_border_animated'] == 'yes'  ) {
            $el->add_render_attribute( '_wrapper', 'class', 'pxl-border-column-anm');
        }
        if(!empty($settings['pxl_column_parallax']) && !empty($settings['pxl_column_parallax_value'])){
            $parallax_settings = json_encode([
                $settings['pxl_column_parallax'] => $settings['pxl_column_parallax_value']
            ]);
            $el->add_render_attribute( '_widget_wrapper', 'data-parallax', $parallax_settings );
        }
    }
    if( 'image' == $el->get_name() ) {
        if (strpos($settings['_css_classes'], 'parallax-') !== false) {
            $parl_arg = explode('--', $settings['_css_classes']); //parallax--y_50 , parallax--x_-50
            $parl_arg1 = explode('_', $parl_arg[1]);  
            $data_parallax = json_encode([
                $parl_arg1[0] => $parl_arg1[1]
            ]); 
            $el->add_render_attribute( '_wrapper', 'data-parallax', esc_attr($data_parallax));
        } 
    }

    $_animation = ! empty( $settings['_animation'] );
    $animation = ! empty( $settings['animation'] );
    $has_animation = $_animation && 'none' !== $settings['_animation'] || $animation && 'none' !== $settings['animation'];

    if ( $has_animation ) {
        $is_static_render_mode = \Elementor\Plugin::$instance->frontend->is_static_render_mode();
        if ( ! $is_static_render_mode ) {
            $el->add_render_attribute( '_wrapper', 'class', 'pxl-elementor-animate' );
        }
    }
}

add_filter( 'pxl_section_start_render', 'basilico_custom_section_start_render', 10, 3 );
function basilico_custom_section_start_render($html, $settings, $el){  
    if(!empty($settings['pxl_parallax_bg_img']['url'])){
        $effects = [];
        if(!empty($settings['pxl_parallax_bg_img_effect_x'])){
            $effects['x'] = (int)$settings['pxl_parallax_bg_img_effect_x'];
        }
        if(!empty($settings['pxl_parallax_bg_img_effect_y'])){
            $effects['y'] = (int)$settings['pxl_parallax_bg_img_effect_y'];
        }
        if(!empty($settings['pxl_parallax_bg_img_effect_z'])){
            $effects['z'] = (int)$settings['pxl_parallax_bg_img_effect_z'];
        }
        if(!empty($settings['pxl_parallax_bg_img_effect_rotate_x'])){
            $effects['rotateX'] = (float)$settings['pxl_parallax_bg_img_effect_rotate_x'];
        }
        if(!empty($settings['pxl_parallax_bg_img_effect_rotate_y'])){
            $effects['rotateY'] = (float)$settings['pxl_parallax_bg_img_effect_rotate_y'];
        }
        if(!empty($settings['pxl_parallax_bg_img_effect_rotate_z'])){
            $effects['rotateZ'] = (float)$settings['pxl_parallax_bg_img_effect_rotate_z'];
        }
        if(!empty($settings['pxl_parallax_bg_img_effect_scale_x'])){
            $effects['scaleX'] = (float)$settings['pxl_parallax_bg_img_effect_scale_x'];
        }
        if(!empty($settings['pxl_parallax_bg_img_effect_scale_y'])){
            $effects['scaleY'] = (float)$settings['pxl_parallax_bg_img_effect_scale_y'];
        }
        if(!empty($settings['pxl_parallax_bg_img_effect_scale_z'])){
            $effects['scaleZ'] = (float)$settings['pxl_parallax_bg_img_effect_scale_z'];
        }
        if(!empty($settings['pxl_parallax_bg_img_effect_scale'])){
            $effects['scale'] = (float)$settings['pxl_parallax_bg_img_effect_scale'];
        }
        $data_parallax = json_encode($effects);
        $html .= '<div class="pxl-section-bg-parallax" data-parallax="'.esc_attr($data_parallax).'"></div>';
    }  
    if(!empty($settings['pxl_bg_ken_burns_bg_img']['url'])){
        $html .= '<div class="pxl-section-bg-ken-burns"></div>';
    }
    
    if(!empty($settings['pxl_divider_top_img']['url'])){
        $html .= '<div class="pxl-section-divider-top-img"></div>';
    }
    if(!empty($settings['pxl_divider_bot_img']['url'])){
        $html .= '<div class="pxl-section-divider-bot-img"></div>';
    }
    
    if(!empty($settings['pxl_section_shape_anm']) && count($settings['pxl_section_shape_anm']) > 0){
        foreach ($settings['pxl_section_shape_anm'] as $v) {
            $html .= '<span class="pxl-section-shape-item elementor-repeater-item-'.$v['_id'].' '.$v['shape_animate'].'">
            <img src="'.$v['shape_img']['url'].'" alt="'.$v['shape_title'].'"/>
            </span>';
        }
    } 

    return $html;
}

//Image Parallax add control
add_action('elementor/element/common/_section_style/after_section_end', 'basilico_add_custom_common_controls');
function basilico_add_custom_common_controls(\Elementor\Element_Base $element){
    $element->start_controls_section(
        'section_pxl_widget_el',
        [
            'label' => esc_html__( 'PXL Settings', 'basilico' ),
            'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
        ]
    );
    $element->start_popover();
    $element->add_responsive_control(
        'pxl_widget_el_position',
        [
            'label' => esc_html__( 'Position', 'basilico' ),
            'type'         => \Elementor\Controls_Manager::SELECT,
            'options'      => array(
                ''         => esc_html__( 'Default', 'basilico' ),
                'absolute' => esc_html__( 'Absolute', 'basilico' ),
                'relative' => esc_html__( 'Relative', 'basilico' ),
                'fixed'    => esc_html__( 'Fixed', 'basilico' ),
            ),
            'default'      => '',
            'selectors' => [
                '{{WRAPPER}}' => 'position: {{VALUE}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'pxl_widget_el_pos_left',
        [
            'label' => esc_html__( 'Left', 'basilico' ).' (50px) px,%,vw,auto',
            'type' => 'text',
            'default' => '',
            'selectors' => [
                '{{WRAPPER}}' => 'left: {{VALUE}}',
            ],
            'condition'     => [
                'pxl_widget_el_position!' => ''
            ] 
        ]
    );
    $element->add_responsive_control(
        'pxl_widget_el_pos_top',
        [
            'label' => esc_html__( 'Top', 'basilico' ).' (50px) px,%,vw,auto',
            'type' => 'text',
            'default' => '',
            'selectors' => [
                '{{WRAPPER}}' => 'top: {{VALUE}}',
            ],
            'condition'     => [
                'pxl_widget_el_position!' => ''
            ] 
        ]
    ); 
    $element->add_responsive_control(
        'pxl_widget_el_pos_right',
        [
            'label' => esc_html__( 'Right', 'basilico' ).' (50px) px,%,vw,auto',
            'type' => 'text',
            'default' => '',
            'selectors' => [
                '{{WRAPPER}}' => 'right: {{VALUE}}',
            ],
            'condition'     => [
                'pxl_widget_el_position!' => ''
            ] 
        ]
    );
    $element->add_responsive_control(
        'pxl_widget_el_pos_bottom',
        [
            'label' => esc_html__( 'Bottom', 'basilico' ).' (50px) px,%,vw,auto',
            'type' => 'text',
            'default' => '',
            'selectors' => [
                '{{WRAPPER}}' => 'bottom: {{VALUE}}',
            ],
            'condition'     => [
                'pxl_widget_el_position!' => ''
            ] 
        ]
    ); 
    $element->end_popover();

    $element->add_responsive_control(
        'widget_width',
        [
            'label' => esc_html__('Widget Width', 'basilico' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'default' => [
                'unit' => '%',
            ],
            'tablet_default' => [
                'unit' => '%',
            ],
            'mobile_default' => [
                'unit' => '%',
            ],
            'size_units' => [ '%', 'px', 'vw' ],
            'range' => [
                '%' => [
                    'min' => 1,
                    'max' => 100,
                ],
                'px' => [
                    'min' => 1,
                    'max' => 1920,
                ],
                'vw' => [
                    'min' => 1,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-widget-container, {{WRAPPER}} .elementor-widget-container > div' => 'width: {{SIZE}}{{UNIT}};',
            ]
        ]
    );
    $element->add_responsive_control(
        'widget_height',
        [
            'label' => esc_html__('Widget Height', 'basilico' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'default' => [
                'unit' => '%',
            ],
            'tablet_default' => [
                'unit' => '%',
            ],
            'mobile_default' => [
                'unit' => '%',
            ],
            'size_units' => [ '%', 'px', 'vw' ],
            'range' => [
                '%' => [
                    'min' => 1,
                    'max' => 100,
                ],
                'px' => [
                    'min' => 1,
                    'max' => 1000,
                ],
                'vh' => [
                    'min' => 1,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}, {{WRAPPER}} .elementor-widget-container, {{WRAPPER}} .elementor-widget-container > div' => 'height: {{SIZE}}{{UNIT}};',
            ]
        ]
    );
    $element->add_control(
        'pxl_widget_el_border_animated',
        [
            'label' => esc_html__('Border Animated', 'basilico'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'basilico' ),
            'label_off' => esc_html__( 'No', 'basilico' ),
            'return_value' => 'yes',
            'default' => 'no',
            'separator' => 'after',
        ]
    );
    $element->add_control(
        'pxl_widget_el_parallax_effect',
        [
            'label' => esc_html__('Pxl Parallax Effect', 'basilico' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                ''               => esc_html__( 'None', 'basilico' ),
                'effect mouse-move bound-section' => esc_html__( 'Mouse Move (section hover)', 'basilico' ),
                'effect mouse-move bound-column' => esc_html__( 'Mouse Move (column hover)', 'basilico' ),
                'effect mouse-move mouse-move-scope' => esc_html__( 'Mouse Move Scope Class (mouse-move-scope)', 'basilico' ),
            ],
            'label_block' => true,
            'default' => '',
            'prefix_class' => 'pxl-parallax-'
        ]
    );
    
    $element->add_responsive_control(
        'pxl_widget_align',
        [
            'label' => esc_html__('Alignment', 'basilico' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
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
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-widget-container' => 'display:flex; flex-wrap:wrap; justify-content: {{VALUE}};'
            ],
        ]
    );

    $element->add_control(
        'pxl_widget_show_on_column_hover',
        [
            'label' => esc_html__('Show On Column Hover', 'basilico' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'basilico' ),
            'label_off' => esc_html__( 'No', 'basilico' ),
            'return_value' => 'yes',
            'default' => 'no',
            'separator' => 'before',
        ]
    );
    $element->end_controls_section();
}

add_filter( 'pxl-custom-section/before-render', 'basilico_custom_section_before_render', 10, 3 );
function basilico_custom_section_before_render($html, $settings, $el){  
    if( isset($settings['pxl_section_border_animated']) && $settings['pxl_section_border_animated'] == 'yes' && isset($settings['border_width'])){
        $unit = $settings['border_width']['unit'];
        $border_color = isset($settings['border_color']) ? $settings['border_color'] : '#000';
        $border_num = 0;
        $bd_top_style = 'style="border-width: '.$settings['border_width']['top'].$unit.' 0 0 0; border-style: '.$settings['border_border'].'; border-color: '.$border_color.';"';
        $bd_right_style = 'style="border-width: 0 '.$settings['border_width']['right'].$unit.' 0 0; border-style: '.$settings['border_border'].'; border-color: '.$border_color.';"';
        $bd_bottom_style = 'style="border-width: 0 0 '.$settings['border_width']['bottom'].$unit.' 0; border-style: '.$settings['border_border'].'; border-color: '.$border_color.';"';
        $bd_left_style = 'style="border-width: 0 0 0 '.$settings['border_width']['left'].$unit.'; border-style: '.$settings['border_border'].'; border-color: '.$border_color.';"';

        if ((int)$settings['border_width']['top'] > 0)
            $border_num++;
        if ((int)$settings['border_width']['right'] > 0)
            $border_num++;
        if ((int)$settings['border_width']['bottom'] > 0)
            $border_num++;
        if ((int)$settings['border_width']['left'] > 0)
            $border_num++;
        
        $html = '<div class="pxl-border-animated num-'.$border_num.'">
        <div class="pxl-border-anm bt w-100" '.$bd_top_style.'></div>
        <div class="pxl-border-anm br h-100" '.$bd_right_style.'></div>
        <div class="pxl-border-anm bb w-100" '.$bd_bottom_style.'></div>
        <div class="pxl-border-anm bl h-100" '.$bd_left_style.'></div>
        </div>';
    }
    
    return $html;
}

//columns render
add_filter( 'pxl-custom-column/before-render', 'basilico_custom_column_before_render', 10, 3 );
function basilico_custom_column_before_render($html, $settings, $el){  
    if(!empty($settings['pxl_parallax_col_bg_img']['url'])){
        if( $settings['pxl_bg_parallax_type'] == 'transform'){
            $effects = [];
            if(!empty($settings['pxl_parallax_col_bg_img_effect_x'])){
                $effects['x'] = (int)$settings['pxl_parallax_col_bg_img_effect_x'];
            }
            if(!empty($settings['pxl_parallax_col_bg_img_effect_y'])){
                $effects['y'] = (int)$settings['pxl_parallax_col_bg_img_effect_y'];
            }
            if(!empty($settings['pxl_parallax_col_bg_img_effect_z'])){
                $effects['z'] = (int)$settings['pxl_parallax_col_bg_img_effect_z'];
            }
            if(!empty($settings['pxl_parallax_col_bg_img_effect_rotate_x'])){
                $effects['rotateX'] = (float)$settings['pxl_parallax_col_bg_img_effect_rotate_x'];
            }
            if(!empty($settings['pxl_parallax_col_bg_img_effect_rotate_y'])){
                $effects['rotateY'] = (float)$settings['pxl_parallax_col_bg_img_effect_rotate_y'];
            }
            if(!empty($settings['pxl_parallax_col_bg_img_effect_rotate_z'])){
                $effects['rotateZ'] = (float)$settings['pxl_parallax_col_bg_img_effect_rotate_z'];
            } 
            if(!empty($settings['pxl_parallax_col_bg_img_effect_scale_x'])){
                $effects['scaleX'] = (float)$settings['pxl_parallax_col_bg_img_effect_scale_x'];
            }
            if(!empty($settings['pxl_parallax_col_bg_img_effect_scale_y'])){
                $effects['scaleY'] = (float)$settings['pxl_parallax_col_bg_img_effect_scale_y'];
            }
            if(!empty($settings['pxl_parallax_col_bg_img_effect_scale_z'])){
                $effects['scaleZ'] = (float)$settings['pxl_parallax_col_bg_img_effect_scale_z'];
            }
            if(!empty($settings['pxl_parallax_col_bg_img_effect_scale'])){
                $effects['scale'] = (float)$settings['pxl_parallax_col_bg_img_effect_scale'];
            }
            $data_parallax = json_encode($effects);
            $html .= '<div class="pxl-column-bg-parallax-outer"><div class="pxl-column-bg-parallax" data-parallax="'.esc_attr($data_parallax).'"></div></div>';
        }else{
            $html .= '<div class="pxl-column-bg-parallax parallax-inner"></div>';
        }
    } 
    if( isset($settings['pxl_border_animated']) && $settings['pxl_border_animated'] == 'yes' ){
        
        $breakpoints = ['laptop','tablet_extra','tablet','mobile_extra','mobile'];
 
        $unit = $settings['border_width']['unit'];
        $border_num = 0;

        $bt_width = $settings['border_width']['top'];
        $br_width = $settings['border_width']['right'];
        $bb_width = $settings['border_width']['bottom'];
        $bl_width = $settings['border_width']['left'];
        foreach ($breakpoints as $v) {
            if( isset($settings['border_width_'.$v]['top']) && (int)$settings['border_width_'.$v]['top'] > 0 )
                $bt_width = $settings['border_width_'.$v]['top'];
            if( isset($settings['border_width_'.$v]['right']) && (int)$settings['border_width_'.$v]['right'] > 0 )
                $br_width = $settings['border_width_'.$v]['right'];
            if( isset($settings['border_width_'.$v]['bottom']) && (int)$settings['border_width_'.$v]['bottom'] > 0 )
                $bb_width = $settings['border_width_'.$v]['bottom'];
            if( isset($settings['border_width_'.$v]['left']) && (int)$settings['border_width_'.$v]['left'] > 0 )
                $bl_width = $settings['border_width_'.$v]['left'];
        }

        $bd_top_style = 'style="--bd-width: '.$bt_width.$unit.' 0 0 0; border-style: '.$settings['border_border'].'; border-color: '.$settings['border_color'].';"';
        $bd_right_style = 'style="--bd-width: 0 '.$br_width.$unit.' 0 0; border-style: '.$settings['border_border'].'; border-color: '.$settings['border_color'].';"';
        $bd_bottom_style = 'style="--bd-width: 0 0 '.$bb_width.$unit.' 0; border-style: '.$settings['border_border'].'; border-color: '.$settings['border_color'].';"';
        $bd_left_style = 'style="--bd-width: 0 0 0 '.$bl_width.$unit.'; border-style: '.$settings['border_border'].'; border-color: '.$settings['border_color'].';"';
  
         
        $bd_top_w = $bd_right_w = $bd_bottom_w = $bd_left_w = '';

        if( isset($settings['border_width']['top'])){
            if( $settings['border_width']['top'] == '0' )
                $bd_top_w.= ' bw-no';
            if( (int)$settings['border_width']['top'] > 0 )
                $bd_top_w.= ' bw-yes';
        }
        if( isset($settings['border_width']['right'])){
            if( $settings['border_width']['right'] == '0' )
                $bd_right_w.= ' bw-no';
            if( (int)$settings['border_width']['right'] > 0 )
                $bd_right_w.= ' bw-yes';
        }
        if( isset($settings['border_width']['bottom'])){
            if( $settings['border_width']['bottom'] == '0' )
                $bd_bottom_w.= ' bw-no';
            if( (int)$settings['border_width']['bottom'] > 0 )
                $bd_bottom_w.= ' bw-yes';
        }
        if( isset($settings['border_width']['left'])){
            if( $settings['border_width']['left'] == '0' )
                $bd_left_w.= ' bw-no';
            if( (int)$settings['border_width']['left'] > 0 )
                $bd_left_w.= ' bw-yes';
        }    
 

        foreach ($breakpoints as $v) {

            if( isset($settings['border_width_'.$v]['top']) ){
                if( $settings['border_width_'.$v]['top'] == '0' )
                    $bd_top_w.= ' bw-'.$v.'-no';
                if( (int)$settings['border_width_'.$v]['top'] > 0 )
                    $bd_top_w.= ' bw-'.$v.'-yes';
            }

            if( isset($settings['border_width_'.$v]['right']) ){
                if( $settings['border_width_'.$v]['right'] == '0' )
                    $bd_right_w.= ' bw-'.$v.'-no';
                if( (int)$settings['border_width_'.$v]['right'] > 0 )
                    $bd_right_w.= ' bw-'.$v.'-yes';
            }
 

            if( isset($settings['border_width_'.$v]['bottom']) ){
                if( $settings['border_width_'.$v]['bottom'] == '0' )
                    $bd_bottom_w.= ' bw-'.$v.'-no';
                if( (int)$settings['border_width_'.$v]['bottom'] > 0 )
                    $bd_bottom_w.= ' bw-'.$v.'-yes';
            }
 
            if( isset($settings['border_width_'.$v]['left']) ){
                if( $settings['border_width_'.$v]['left'] == '0' )
                    $bd_left_w.= ' bw-'.$v.'-no';
                if( (int)$settings['border_width_'.$v]['left'] > 0 )
                    $bd_left_w.= ' bw-'.$v.'-yes';
            }
  
        }

        if( (int)$settings['border_width']['top'] > 0) $border_num++;
        if( (int)$settings['border_width']['right'] > 0) $border_num++;
        if( (int)$settings['border_width']['bottom'] > 0) $border_num++;
        if( (int)$settings['border_width']['left'] > 0) $border_num++;

        $html .= '<div class="pxl-border-animated num-'.$border_num.'">
        <div class="pxl-border-anm bt w-100 '.$bd_top_w.'" '.$bd_top_style.'></div>
        <div class="pxl-border-anm br h-100 '.$bd_right_w.'" '.$bd_right_style.'></div>
        <div class="pxl-border-anm bb w-100 '.$bd_bottom_w.'" '.$bd_bottom_style.'></div>
        <div class="pxl-border-anm bl h-100 '.$bd_left_w.'" '.$bd_left_style.'></div>
        </div>';
    }   
    return $html;
}


//widget render
add_filter('elementor/widget/before_render_content','basilico_custom_widget_el_before_render', 10, 1 );
function basilico_custom_widget_el_before_render($el){
    $settings = $el->get_settings();
    $effects = [];

    if(isset($settings['pxl_widget_show_on_column_hover']) && $settings['pxl_widget_show_on_column_hover'] == 'yes') {
        $el->add_render_attribute( '_wrapper', 'class', 'pxl-show-on-column-hover' );
    }

    if(!empty($settings['pxl_parallax_pos_x']['size']) || !empty($settings['pxl_parallax_pos_y']['size'])){
        $el->add_render_attribute( '_wrapper', 'class', 'pxl-element-parallax' );
        if(!empty($settings['pxl_parallax_pos_x'])){
            $effects['x'] = $settings['pxl_parallax_pos_x']['size'].$settings['pxl_parallax_pos_x']['unit'];
        }
        if(!empty($settings['pxl_parallax_pos_y'])){
            $effects['y'] = $settings['pxl_parallax_pos_y']['size'].$settings['pxl_parallax_pos_y']['unit'];
        }
        $data_parallax = json_encode($effects);
        $el->add_render_attribute( '_wrapper', 'data-parallax', $data_parallax );
    }
}

add_filter('elementor/widget/render_content','basilico_custom_widget_el_render_content', 10, 2 );
function basilico_custom_widget_el_render_content($widget_content, $el){  
    $settings = $el->get_settings();
    if( isset($settings['pxl_widget_el_border_animated']) && $settings['pxl_widget_el_border_animated'] == 'yes' ){

        $el->add_render_attribute( '_wrapper', 'class', 'pxl-border-wg-anm');

        $breakpoints = ['laptop','tablet_extra','tablet','mobile_extra','mobile'];
         
        $unit = $settings['_border_width']['unit'];
        $border_num = 0;

        $bt_width = $settings['_border_width']['top'];
        $br_width = $settings['_border_width']['right'];
        $bb_width = $settings['_border_width']['bottom'];
        $bl_width = $settings['_border_width']['left'];
        foreach ($breakpoints as $v) {
            if( isset($settings['_border_width_'.$v]['top']) && (int)$settings['_border_width_'.$v]['top'] > 0 )
                $bt_width = $settings['_border_width_'.$v]['top'];
            if( isset($settings['_border_width_'.$v]['right']) && (int)$settings['_border_width_'.$v]['right'] > 0 )
                $br_width = $settings['_border_width_'.$v]['right'];
            if( isset($settings['_border_width_'.$v]['bottom']) && (int)$settings['_border_width_'.$v]['bottom'] > 0 )
                $bb_width = $settings['_border_width_'.$v]['bottom'];
            if( isset($settings['_border_width_'.$v]['left']) && (int)$settings['_border_width_'.$v]['left'] > 0 )
                $bl_width = $settings['_border_width_'.$v]['left'];
        }

        $bd_top_style = 'style="--bd-width: '.$bt_width.$unit.' 0 0 0; border-style: '.$settings['_border_border'].'; border-color: '.$settings['_border_color'].';"';
        $bd_right_style = 'style="--bd-width: 0 '.$br_width.$unit.' 0 0; border-style: '.$settings['_border_border'].'; border-color: '.$settings['_border_color'].';"';
        $bd_bottom_style = 'style="--bd-width: 0 0 '.$bb_width.$unit.' 0; border-style: '.$settings['_border_border'].'; border-color: '.$settings['_border_color'].';"';
        $bd_left_style = 'style="--bd-width: 0 0 0 '.$bl_width.$unit.'; border-style: '.$settings['_border_border'].'; border-color: '.$settings['_border_color'].';"';
  
         
        $bd_top_w = $bd_right_w = $bd_bottom_w = $bd_left_w = '';

        if( isset($settings['_border_width']['top'])){
            if( $settings['_border_width']['top'] == '0' )
                $bd_top_w.= ' bw-no';
            if( (int)$settings['_border_width']['top'] > 0 )
                $bd_top_w.= ' bw-yes';
        }
        if( isset($settings['_border_width']['right'])){
            if( $settings['_border_width']['right'] == '0' )
                $bd_right_w.= ' bw-no';
            if( (int)$settings['_border_width']['right'] > 0 )
                $bd_right_w.= ' bw-yes';
        }
        if( isset($settings['_border_width']['bottom'])){
            if( $settings['_border_width']['bottom'] == '0' )
                $bd_bottom_w.= ' bw-no';
            if( (int)$settings['_border_width']['bottom'] > 0 )
                $bd_bottom_w.= ' bw-yes';
        }
        if( isset($settings['_border_width']['left'])){
            if( $settings['_border_width']['left'] == '0' )
                $bd_left_w.= ' bw-no';
            if( (int)$settings['_border_width']['left'] > 0 )
                $bd_left_w.= ' bw-yes';
        }    
 

        foreach ($breakpoints as $v) {

            if( isset($settings['_border_width_'.$v]['top']) ){
                if( $settings['_border_width_'.$v]['top'] == '0' )
                    $bd_top_w.= ' bw-'.$v.'-no';
                if( (int)$settings['_border_width_'.$v]['top'] > 0 )
                    $bd_top_w.= ' bw-'.$v.'-yes';
            }

            if( isset($settings['_border_width_'.$v]['right']) ){
                if( $settings['_border_width_'.$v]['right'] == '0' )
                    $bd_right_w.= ' bw-'.$v.'-no';
                if( (int)$settings['_border_width_'.$v]['right'] > 0 )
                    $bd_right_w.= ' bw-'.$v.'-yes';
            }
 

            if( isset($settings['_border_width_'.$v]['bottom']) ){
                if( $settings['_border_width_'.$v]['bottom'] == '0' )
                    $bd_bottom_w.= ' bw-'.$v.'-no';
                if( (int)$settings['_border_width_'.$v]['bottom'] > 0 )
                    $bd_bottom_w.= ' bw-'.$v.'-yes';
            }
 
            if( isset($settings['_border_width_'.$v]['left']) ){
                if( $settings['_border_width_'.$v]['left'] == '0' )
                    $bd_left_w.= ' bw-'.$v.'-no';
                if( (int)$settings['_border_width_'.$v]['left'] > 0 )
                    $bd_left_w.= ' bw-'.$v.'-yes';
            }
  
        }

        if( (int)$settings['_border_width']['top'] > 0) $border_num++;
        if( (int)$settings['_border_width']['right'] > 0) $border_num++;
        if( (int)$settings['_border_width']['bottom'] > 0) $border_num++;
        if( (int)$settings['_border_width']['left'] > 0) $border_num++;

        $html = '<div class="pxl-border-animated num-'.$border_num.'">
        <div class="pxl-border-anm bt w-100 '.$bd_top_w.'" '.$bd_top_style.'></div>
        <div class="pxl-border-anm br h-100 '.$bd_right_w.'" '.$bd_right_style.'></div>
        <div class="pxl-border-anm bb w-100 '.$bd_bottom_w.'" '.$bd_bottom_style.'></div>
        <div class="pxl-border-anm bl h-100 '.$bd_left_w.'" '.$bd_left_style.'></div>
        </div>';
        return $html.$widget_content;
    }else{
        return $widget_content;
    }
}