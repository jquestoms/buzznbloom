<?php
// Register Contact Form 7 Widget
if(class_exists('WPCF7')) {
    $cf7 = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');
    $contact_forms = array();
    if ($cf7) {
        foreach ($cf7 as $cform) {
            $contact_forms[$cform->post_name] = $cform->post_title;
        }
    } else {
        $contact_forms[esc_html__('No contact forms found', 'basilico')] = 0;
    }

    pxl_add_custom_widget(
        array(
            'name'       => 'pxl_contact_form',
            'title'      => esc_html__('Pxl Contact Form 7', 'basilico'),
            'icon'       => 'eicon-form-horizontal',
            'categories' => array('pxltheme-core'),
            'scripts'    => array(),
            'params'     => array(
                'sections' => array(
                    array(
                        'name' => 'source_section',
                        'label' => esc_html__('Source Settings', 'basilico'),
                        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                        'controls' => array(
                            array(
                                'name' => 'ctf7_slug',
                                'label' => esc_html__('Select Form', 'basilico'),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'options' => $contact_forms,
                                'default' => array_key_first($contact_forms),
                            ),
                        ),
                    ),
                    array(
                        'name' => 'content_style',
                        'label' => esc_html__('Content Style', 'basilico'),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            array(
                                'name' => 'mc_style_input_tabs',
                                'control_type' => 'tab',
                                'tabs' => array(
                                    array(
                                        'name' => 'input_style_normal',
                                        'label' => esc_html__('Normal', 'basilico'),
                                        'controls' => array(
                                            array(
                                                'name' => 'input_background',
                                                'label' => esc_html__('Input Background', 'basilico' ),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form7 input[type="text"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="password"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="email"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="phone"], 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="date"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="datetime-local"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="tel"],
                                                     {{WRAPPER}} .pxl-contact-form7 select, 
                                                     {{WRAPPER}} .pxl-contact-form7 textarea' => 'background-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'input_text_color',
                                                'label' => esc_html__('Input Text Color', 'basilico' ),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form7 input[type="text"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="password"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="email"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="phone"], 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="date"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="datetime-local"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="tel"], 
                                                     {{WRAPPER}} .pxl-contact-form7 select, 
                                                     {{WRAPPER}} .pxl-contact-form7 textarea' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'input_border_color',
                                                'label' => esc_html__('Input Border Color', 'basilico' ),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form7 input[type="text"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="password"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="email"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="phone"], 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="date"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="datetime-local"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="tel"], 
                                                     {{WRAPPER}} .pxl-contact-form7 select, 
                                                     {{WRAPPER}} .pxl-contact-form7 textarea' => 'border-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'input_border_radius',
                                                'label' => esc_html__('Input Border Radius', 'basilico' ),
                                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                                'size_units' => [ 'px', 'em' ],
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form7 input[type="text"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="password"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="email"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="phone"], 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="date"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"], 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="datetime-local"],
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="tel"], 
                                                     {{WRAPPER}} .pxl-contact-form7 select, 
                                                     {{WRAPPER}} .pxl-contact-form7 textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                                ],
                                            ),
                                            array(
                                                'name'      => 'select_style',
                                                'type'      => \Elementor\Controls_Manager::SELECT,
                                                'label'     => esc_html__('Select Dropdown Icon Style', 'basilico'),
                                                'options'   => array(
                                                    ''          => esc_html__('Default', 'basilico'),
                                                    'select-2'  => esc_html__('Style 2', 'basilico'),
                                                    'select-3'  => esc_html__('Style 3', 'basilico'),
                                                    'select-4'  => esc_html__('Style 4', 'basilico'),
                                                    'select-5'  => esc_html__('Style 5', 'basilico'),
                                                    'select-6'  => esc_html__('Style 6', 'basilico'),
                                                ),
                                                'default' => ''
                                            ),
                                        )
                                    ),
                                    array(
                                        'name' => 'input_style_hover',
                                        'label' => esc_html__('Hover', 'basilico'),
                                        'controls' => array(
                                            array(
                                                'name' => 'input_background_hover',
                                                'label' => esc_html__('Input Background', 'basilico' ),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form7 input[type="text"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="password"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="email"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="phone"]:hover, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="date"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:hover, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="datetime-local"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="tel"]:hover, 
                                                     {{WRAPPER}} .pxl-contact-form7 textarea:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 select:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="text"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="password"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="email"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="phone"]:focus, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="date"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:focus, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="datetime-local"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="tel"]:focus, 
                                                     {{WRAPPER}} .pxl-contact-form7 textarea:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input:focus + input[type="submit"],
                                                     {{WRAPPER}} .pxl-contact-form7 input:hover + input[type="submit"],
                                                     {{WRAPPER}} .pxl-contact-form7 input:focus + button,
                                                     {{WRAPPER}} .pxl-contact-form7 input:hover + button' => 'background-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'input_text_hover',
                                                'label' => esc_html__('Input Text Color', 'basilico' ),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form7 input[type="text"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="password"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="email"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="phone"]:hover, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="date"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:hover, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="datetime-local"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="tel"]:hover, 
                                                     {{WRAPPER}} .pxl-contact-form7 textarea:hover
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="text"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="password"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="email"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="phone"]:focus, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="date"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:focus, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="tel"]:focus, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="datetime-local"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 textarea:focus' => 'color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'input_border_hover',
                                                'label' => esc_html__('Input Border Color', 'basilico' ),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-contact-form7 input[type="text"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="password"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="email"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="phone"]:hover, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="date"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:hover, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="tel"]:hover, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="datetime-local"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 textarea:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 select:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="text"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="password"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="email"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="phone"]:focus, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="date"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:focus, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="tel"]:focus, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="datetime-local"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 textarea:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input:focus + input[type="submit"],
                                                     {{WRAPPER}} .pxl-contact-form7 input:hover + input[type="submit"],
                                                     {{WRAPPER}} .pxl-contact-form7 input:focus + button,
                                                     {{WRAPPER}} .pxl-contact-form7 input:hover + button' => 'border-color: {{VALUE}};',
                                                ],
                                            ),
                                            array(
                                                'name' => 'input_hover_shadow',
                                                'label'        => esc_html__( 'Box Shadow', 'basilico' ),
                                                'type'         => \Elementor\Group_Control_Box_Shadow::get_type(),
                                                'control_type' => 'group',
                                                'exclude' => [
                                                    'box_shadow_position',
                                                ],
                                                'selector' => 
                                                    '{{WRAPPER}} .pxl-contact-form7 input[type="text"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="password"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="email"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="phone"]:hover, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="date"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:hover, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="tel"]:hover, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="datetime-local"]:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 textarea:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 select:hover,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="text"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="password"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="email"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="phone"]:focus, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="date"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="time"]:focus, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="tel"]:focus, 
                                                     {{WRAPPER}} .pxl-contact-form7 input[type="datetime-local"]:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 textarea:focus,
                                                     {{WRAPPER}} .pxl-contact-form7 input:focus + input[type="submit"],
                                                     {{WRAPPER}} .pxl-contact-form7 input:hover + input[type="submit"],
                                                     {{WRAPPER}} .pxl-contact-form7 input:focus + button,
                                                     {{WRAPPER}} .pxl-contact-form7 input:hover + button'
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    array(
                        'name' => 'section_style_button',
                        'label' => esc_html__('Button Style', 'basilico' ),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            array(
                                'name' => 'text_align',
                                'label' => esc_html__('Alignment', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::CHOOSE,
                                'control_type' => 'responsive',
                                'options' => [
                                    'left' => [
                                        'title' => esc_html__('Left', 'basilico' ),
                                        'icon' => 'eicon-text-align-left',
                                    ],
                                    'center' => [
                                        'title' => esc_html__('Center', 'basilico' ),
                                        'icon' => 'eicon-text-align-center',
                                    ],
                                    'right' => [
                                        'title' => esc_html__('Right', 'basilico' ),
                                        'icon' => 'eicon-text-align-right',
                                    ],
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-contact-form7' => 'text-align: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'button_style_tabs',
                                'control_type' => 'tab',
                                'tabs' => array(
                                    array(
                                        'name' => 'button_style_normal',
                                        'label' => esc_html__('Normal', 'basilico'),
                                        'controls' => array(
                                            array(
                                                'name' => 'button_color',
                                                'label' => esc_html__('Text Color', 'basilico'),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .wpcf7-form input[type="submit"], 
                                                     {{WRAPPER}} .wpcf7-form button' => 'color: {{VALUE}};'
                                                ]
                                            ),
                                            array(
                                                'name' => 'button_background',
                                                'type' => \Elementor\Group_Control_Background::get_type(),
                                                'control_type' => 'group',
                                                'types'             => [ 'classic' , 'gradient' ],
                                                'selector' => '{{WRAPPER}} .wpcf7-form input[type="submit"], {{WRAPPER}} .wpcf7-form button',
                                            ),
                                        )
                                    ),
                                    array(
                                        'name' => 'button_style_hover',
                                        'label' => esc_html__('Hover', 'basilico'),
                                        'controls' => array(
                                            array(
                                                'name' => 'button_color_hover',
                                                'label' => esc_html__('Text Color', 'basilico'),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .wpcf7-form input[type="submit"]:hover,
                                                     {{WRAPPER}} .wpcf7-form button:hover' => 'color:{{VALUE}};'
                                                ]
                                            ),
                                            array(
                                                'name' => 'button_background_hover',
                                                'label' => esc_html__('Background Color', 'basilico'),
                                                'type' => \Elementor\Controls_Manager::COLOR,
                                                'selectors' => [
                                                    '{{WRAPPER}} .pxl-button-wrapper .btn:hover' => 'border-color: {{VALUE}};',
                                                    '{{WRAPPER}} .pxl-button-wrapper .btn.btn-additional-6:hover, {{WRAPPER}} .pxl-button-wrapper .btn.btn-additional-7:hover,
                                                     {{WRAPPER}} .pxl-button-wrapper .btn.btn-additional-5:hover, {{WRAPPER}} .pxl-button-wrapper .btn.btn-additional-8:hover' => 'background-color: {{VALUE}};',
                                                    '{{WRAPPER}} .pxl-button-wrapper .btn:before' => 'background-color: {{VALUE}};'
                                                ],
                                            ),
                                        )
                                    ),
                                )
                            ),
                        ),
                    ),
                    array(
                        'name' => 'textarea_size',
                        'label' => esc_html__('Texarea Size', 'basilico'),
                        'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                        'controls' => array(
                            array(
                                'name'  =>  'message_height',
                                'type'  =>  \Elementor\Controls_Manager::SLIDER,
                                'label' => esc_html__('Message Height', 'basilico'),
                                'size_units' => ['px'],
                                'range' => [
                                    'px' => [
                                        'min' => 120,
                                        'max' => 350,
                                    ],
                                ],
                                'default'   => [
                                    'unit' => 'px',
                                    'size' => '',
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .wpcf7-form textarea.wpcf7-textarea' => 'height: {{SIZE}}{{UNIT}};',
                                ],
                            ),
                        ),
                    ),
                ),
            )
        ),
            basilico_get_class_widget_path()
    );
}