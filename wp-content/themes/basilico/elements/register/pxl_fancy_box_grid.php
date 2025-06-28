<?php
use Elementor\Icons_Manager;
Icons_Manager::enqueue_shim();
pxl_add_custom_widget(
    array(
        'name' => 'pxl_fancy_box_grid',
        'title' => esc_html__('PXL Fancy Box Grid', 'basilico'),
        'icon' => 'eicon-info-box',
        'categories' => array('pxltheme-core'),
        'scripts' => [
            'imagesloaded',
            'isotope',
            'basilico-post-grid',
        ],
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
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_fancy_box_grid-1.jpg'
                                ],
                            ],
                            'prefix_class' => 'pxl-fancy-box-grid-layout-',
                        ),
                    ),
                ),
                array(
                    'name' => 'section_list',
                    'label' => esc_html__('Content', 'basilico'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'content_list',
                            'label' => esc_html__('Item', 'basilico'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'image',
                                    'label' => esc_html__('Image', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                                array(
                                    'name' => 'title',
                                    'label' => esc_html__('Title', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'categories',
                                    'label' => esc_html__('Categories', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'rows' => 4,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link', 'basilico'),
                                    'type' => \Elementor\Controls_Manager::URL,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'background_color',
                                    'label' => esc_html__('Background Color', 'basilico' ),
                                    'type' => \Elementor\Controls_Manager::COLOR,
                                    'selectors' => [
                                        '{{WRAPPER}} .pxl-fancy-box-grid {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
                                    ],
                                ),
                            ),
                            'title_field' => '{{{ title }}}',
                        ),
                    ),
                ),
                array(
                    'name' => 'parallax_section',
                    'label' => esc_html__('Parallax Settings', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'pxl_parallax',
                            'label' => esc_html__( 'Parallax Type', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                ''        => esc_html__( 'None', 'basilico' ),
                                'y'       => esc_html__( 'Transform Y', 'basilico' ),
                                'x'       => esc_html__( 'Transform X', 'basilico' ),
                                'z'       => esc_html__( 'Transform Z', 'basilico' ),
                                'rotateX' => esc_html__( 'RotateX', 'basilico' ),
                                'rotateY' => esc_html__( 'RotateY', 'basilico' ),
                                'rotateZ' => esc_html__( 'RotateZ', 'basilico' ),
                                'scaleX'  => esc_html__( 'ScaleX', 'basilico' ),
                                'scaleY'  => esc_html__( 'ScaleY', 'basilico' ),
                                'scaleZ'  => esc_html__( 'ScaleZ', 'basilico' ),
                                'scale'   => esc_html__( 'Scale', 'basilico' ),
                            ],
                        ),
                        array(
                            'name' => 'parallax_value',
                            'label' => esc_html__('Value', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '',
                            'condition' => [ 'pxl_parallax!' => '']  
                        ),
                        array(
                            'name' => 'pxl_parallax_screen',
                            'label'   => esc_html__( 'Parallax In Screen', 'basilico' ),
                            'type'    => \Elementor\Controls_Manager::SELECT,
                            'control_type' => 'responsive',
                            'default' => '',
                            'options' => array(
                                '' => esc_html__( 'Default', 'basilico' ),
                                'no'   => esc_html__( 'No', 'basilico' ),
                            ),
                            'prefix_class' => 'pxl-parallax%s-',
                            'condition' => [ 'pxl_parallax!' => '']  
                        )
                    ),
                ),
                array(
                    'name' => 'grid_section',
                    'label' => esc_html__('Grid', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        basilico_grid_column_settings(),
                        array(
                            array(
                                'name' => 'img_size',
                                'label' => esc_html__('Image Size', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::TEXT,
                                'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).', 'basilico')
                            )
                        ),
                        basilico_elementor_animation_opts([
                            'name'   => 'item',
                            'label' => esc_html__('Item', 'basilico'),
                        ])
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-fancy-box-grid .item-inner .item-title',
                        ),
                        array(
                            'name' => 'color_title',
                            'label' => esc_html__('Color Title', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-grid .item-inner .item-title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-fancy-box-grid .item-inner .item-title a::after' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'categories_typography',
                            'label' => esc_html__('Categories Typography', 'basilico' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-fancy-box-grid .item-inner .item-categories',
                        ),
                        array(
                            'name' => 'color_categories',
                            'label' => esc_html__('Color Categories', 'basilico' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-fancy-box-grid .item-inner .item-categories' => 'color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    basilico_get_class_widget_path()
);