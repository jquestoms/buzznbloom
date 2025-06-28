<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_product_grid',
        'title' => esc_html__('PXL Product Grid', 'basilico' ),
        'icon' => 'eicon-products',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'imagesloaded',
            'isotope',
            'basilico-post-grid',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name'     => 'product_layout',
                            'label'    => esc_html__('Product Layout', 'basilico'),
                            'type'     => 'select',
                            'options'  => [
                                'layout-1'       => esc_html__('Layout 1', 'basilico'),
                                'layout-2'       => esc_html__('Layout 2', 'basilico'),
                                'layout-3'       => esc_html__('Layout 3', 'basilico'),
                                'layout-4'       => esc_html__('Layout 4', 'basilico'),
                                'layout-5'       => esc_html__('Layout 5', 'basilico'),
                                'layout-6'       => esc_html__('Layout 6', 'basilico'),
                                'layout-7'       => esc_html__('Layout 7', 'basilico'),
                                'layout-8'       => esc_html__('Layout 8', 'basilico'),
                                'layout-9'       => esc_html__('Layout 9', 'basilico'),
                                'layout-10'      => esc_html__('Layout 10', 'basilico'),
                                'layout-11'      => esc_html__('Layout 11', 'basilico'),
                                'layout-12'       => esc_html__('Layout 12', 'basilico'),
                            ],
                            'default'  => 'layout-1',
                        ),
                        array(
                            'name'    => 'query_type',
                            'label'   => esc_html__( 'Select Query Type', 'basilico' ),
                            'type'    => 'select',
                            'default' => 'recent_product',
                            'options' => [
                                'recent_product'   => esc_html__( 'Recent Products', 'basilico' ),
                                'best_selling'     => esc_html__( 'Best Selling', 'basilico' ),
                                'featured_product' => esc_html__( 'Featured Products', 'basilico' ),
                                'top_rate'         => esc_html__( 'High Rate', 'basilico' ),
                                'on_sale'          => esc_html__( 'On Sale', 'basilico' ),
                                'recent_review'    => esc_html__( 'Recent Review', 'basilico' ),
                                'deals'            => esc_html__( 'Product Deals', 'basilico' ),
                                'separate'         => esc_html__( 'Product separate', 'basilico' ),
                            ]
                        ),
                        array(
                            'name'     => 'taxonomies',
                            'label'    => esc_html__( 'Select Term of Product', 'basilico' ),
                            'type'     => 'select2',
                            'multiple' => true,
                            'options'  => pxl_get_product_grid_term_options()
                        ),
                        array(
                            'name'     => 'product_ids',
                            'label'    => esc_html__( 'Products id (123,124,135...)', 'basilico' ),
                            'type'     => 'text',
                            'default'  => '',
                            'condition' => array( 'query_type' => 'separate' )
                        ),
                        array(
                            'name'     => 'post_per_page',
                            'label'    => esc_html__( 'Post per page', 'basilico' ),
                            'type'     => 'text',
                            'default'  => '6'
                        )
                    ),
                ),
                array(
                    'name' => 'grid_section',
                    'label' => esc_html__('Grid Settings', 'basilico' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array_merge(
                        basilico_grid_column_settings(true),
                        array(
                            array(
                                'name' => 'item_padding',
                                'label' => esc_html__('Item Padding', 'basilico' ),
                                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                                'size_units' => [ 'px' ],
                                'default' => [],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-grid-inner' => 'margin-top: -{{TOP}}{{UNIT}}; margin-right: -{{RIGHT}}{{UNIT}}; margin-bottom: -{{BOTTOM}}{{UNIT}}; margin-left: -{{LEFT}}{{UNIT}};',
                                    '{{WRAPPER}} .pxl-grid-inner .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                ],
                                'control_type' => 'responsive',
                            ),
                            array(
                                'name'    => 'pagination_type',
                                'label'   => esc_html__('Pagination Type', 'basilico' ),
                                'type'    => \Elementor\Controls_Manager::SELECT,
                                'default' => 'false',
                                'options' => [
                                    'pagination' => esc_html__('Pagination', 'basilico' ),
                                    'false'      => esc_html__('Disable', 'basilico' ),
                                ],
                            ),
                            array(
                                'name'      => 'loadmore_text',
                                'label'     => esc_html__( 'Load More text', 'basilico' ),
                                'type'      => \Elementor\Controls_Manager::TEXT,
                                'default'   => esc_html__('Load More','basilico'),
                                'condition' => [
                                    'pagination_type' => 'loadmore'
                                ]
                            ),
                            array(
                                'name'         => 'pagination_alignment',
                                'label'        => esc_html__( 'Pagination Alignment', 'basilico' ),
                                'type'         => 'choose',
                                'control_type' => 'responsive',
                                'options' => [
                                    'start' => [
                                        'title' => esc_html__( 'Start', 'basilico' ),
                                        'icon'  => 'eicon-text-align-left',
                                    ],
                                    'center' => [
                                        'title' => esc_html__( 'Center', 'basilico' ),
                                        'icon'  => 'eicon-text-align-center',
                                    ],
                                    'end' => [
                                        'title' => esc_html__( 'End', 'basilico' ),
                                        'icon'  => 'eicon-text-align-right',
                                    ]
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-grid-pagination, {{WRAPPER}} .pxl-load-more' => 'justify-content: {{VALUE}};'
                                ]
                            ),
                        )
                    ),
                ),
            ),
),
),
basilico_get_class_widget_path()
);