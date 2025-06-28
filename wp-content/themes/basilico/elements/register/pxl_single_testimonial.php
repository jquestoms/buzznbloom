<?php
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_testimonial_single',
        'title'      => esc_html__( 'PXL Client Review', 'basilico' ),
        'icon' => 'eicon-editor-quote',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(
        ),
        'params' => array(
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_testimonial_single-1.jpg'
                                ],
                            ],
                        ),
                    )
                ),
                array(
                    'name' => 'review_section',
                    'label' => esc_html__( 'How To Create Review Link?', 'basilico' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name' => 'review_guide',
                            'label' => esc_html__( 'Review Link Format:', 'basilico' ),
                            'type'    => 'layoutcontrol',
                            'description' => esc_html__('https://search.google.com/local/writereview?placeid=YOUR_PLACE_ID', 'basilico'),

                        ),
                        array(
                            'name' => 'review_placeid',
                            'label' => esc_html__( 'Get YOUR_PLACE_ID At:', 'basilico' ),
                            'type'    => 'layoutcontrol',
                            'description' => esc_html__('https://developers-dot-devsite-v2-prod.appspot.com/maps/documentation/javascript/examples/places-placeid-finder', 'basilico'),

                        ),
                    ),
                ),
                array(
                    'name' => 'section_clients',
                    'label' => esc_html__('Clients', 'basilico'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Icon', 'basilico' ),
                            'type'             => 'icons',
                            'default'          => [
                                'library' => 'pxli',
                                'value'   => 'pxli-quote'
                            ],
                        ),
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
                                '{{WRAPPER}} .pxl-testimonial-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-testimonial-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'tt_content',
                            'label' => __( 'Content', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'rows' => '10',
                            'default' => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                            'placeholder' => esc_html__('Enter some text here.', 'basilico' ),
                        ),
                        array(
                            'name' => 'tt_description',
                            'label' => esc_html__('Description', 'basilico'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'rows' => '3',
                            'label_block' => true,
                            'default' => esc_html__( 'John Doe', 'basilico' )
                        ),
                        array(
                            'name' => 'rating',
                            'label' => esc_html__('Rating', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'none',
                            'options' => [
                                'none' => esc_html__('None', 'basilico' ),
                                'star1' => esc_html__('1 Star', 'basilico' ),
                                'star2' => esc_html__('2 Star', 'basilico' ),
                                'star3' => esc_html__('3 Star', 'basilico' ),
                                'star4' => esc_html__('4 Star', 'basilico' ),
                                'star5' => esc_html__('5 Star', 'basilico' ),
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    basilico_get_class_widget_path()
);