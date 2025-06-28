<?php

use Elementor\Controls_Manager;
use Elementor\Embed;
use Elementor\Group_Control_Image_Size;

if (!function_exists('basilico_elements_scripts')) {
    add_action('basilico_scripts', 'basilico_elements_scripts');
    function basilico_elements_scripts(){
        wp_enqueue_style( 'e-animations');
        wp_register_style( 'odometer', get_template_directory_uri() . '/elements/assets/css/odometer-theme-default.css', array(), '1.1.0');
        wp_register_script( 'scroll-trigger', get_template_directory_uri() . '/elements/assets/js/libs/scroll-trigger.js', array( 'jquery' ), '3.10.5', true );
        wp_register_script( 'pxl-split-text', get_template_directory_uri() . '/elements/assets/js/libs/split-text.js', array( 'jquery' ), '3.6.1', true );
        wp_enqueue_script('basilico-elements', get_template_directory_uri() . '/elements/assets/js/pxl-elements.js', [ 'jquery' ], basilico()->get_version(), true);
        wp_register_script('basilico-tabs', get_template_directory_uri() . '/elements/assets/js/pxl-tabs.js', ['jquery'], basilico()->get_version(), true);
        wp_register_script('basilico-storelist', get_template_directory_uri() . '/elements/assets/js/pxl-store-list.js', ['jquery'], basilico()->get_version(), true);
        wp_register_script('basilico-typewrite', get_template_directory_uri() . '/elements/assets/js/pxl-typewrite.js', ['jquery'], basilico()->get_version(), true);
        wp_enqueue_script('pxl-parallax-scroll', get_template_directory_uri() . '/elements/assets/js/libs/parallax-scroll.js', [ 'jquery' ], basilico()->get_version(), true);
        wp_enqueue_script('pxl-parallax-background', get_template_directory_uri() . '/elements/assets/js/libs/parallax-background.js', [ 'jquery' ], basilico()->get_version(), true);

        wp_register_script('basilico-post-grid', get_template_directory_uri() . '/elements/assets/js/pxl-post-grid.js', ['isotope', 'jquery'], basilico()->get_version(), true);
        wp_localize_script('basilico-post-grid', 'main_data_grid', array('ajax_url' => admin_url('admin-ajax.php')));

        wp_register_script('basilico-swiper', get_template_directory_uri() . '/elements/assets/js/pxl-swiper-carousel.js', ['jquery'], basilico()->get_version(), true);
        wp_register_script('basilico-accordion', get_template_directory_uri() . '/elements/assets/js/pxl-accordion.js', [ 'jquery' ], basilico()->get_version(), true);
        wp_register_script('basilico-progressbar', get_template_directory_uri() . '/elements/assets/js/pxl-progressbar.js', [ 'jquery' ], basilico()->get_version(), true);
        wp_register_script('odometer', get_template_directory_uri() . '/elements/assets/js/libs/odometer.min.js', [ 'jquery' ], basilico()->get_version(), true);
        wp_register_script('gsMotionPath', get_template_directory_uri() . '/elements/assets/js/libs/gsMotionPath.js', [ 'jquery' ], basilico()->get_version(), true);
        wp_register_script('basilico-moving-path', get_template_directory_uri() . '/elements/assets/js/pxl-moving-path.js', [ 'jquery' ], basilico()->get_version(), true);
        wp_register_script('basilico-counter', get_template_directory_uri() . '/elements/assets/js/pxl-counter.js', [ 'jquery' ], basilico()->get_version(), true);
        wp_register_script('basilico-clock', get_template_directory_uri() . '/elements/assets/js/pxl-clock.js', [ 'jquery' ], basilico()->get_version(), true);
        wp_register_script('basilico-google-chart', get_template_directory_uri() . '/elements/assets/js/pxl-google-chart.js', [ 'jquery' ], basilico()->get_version(), true);
        wp_register_script('basilico-countdown', get_template_directory_uri() . '/elements/assets/js/pxl-countdown.js', [ 'jquery' ], basilico()->get_version(), true);
        wp_register_script('basilico-post-create', get_template_directory_uri() . '/elements/assets/js/pxl-post-create.js', [ 'jquery' ], basilico()->get_version(), true);
        wp_register_script('pxl-tabs-carousel', get_template_directory_uri() . '/elements/assets/js/pxl-tabs-carousel.js', [ 'jquery' ], basilico()->get_version(), true);
        wp_register_script( 'pxl-circle-text', get_template_directory_uri() . '/elements/assets/js/pxl-circletext.js', array( 'jquery' ), basilico()->get_version(), true );
    }
}

add_filter( 'elementor/icons_manager/additional_tabs', 'basilico_register_custom_icon_library');
function basilico_register_custom_icon_library( $settings ) {
    $settings['basilico'] = [
        'name' => 'basilico',
        'label' => esc_html__('Basilico', 'basilico'),
        'url' => false,
        'enqueue' => false,
        'prefix' => 'pxli-',
        'displayPrefix' => 'pxli',
        'labelIcon' => 'fas fa-user-plus',
        'ver' => '1.0.0',
        'fetchJson' => get_template_directory_uri() . '/assets/fonts/pixelart/pixelarts.js',
    ];
    $settings['material'] = [
        'name' => 'material',
        'label' => esc_html__( 'Material Design Iconic', 'basilico' ),
        'url' => false,
        'enqueue' => false,
        'prefix' => 'zmdi-',
        'displayPrefix' => 'zmdi',
        'labelIcon' => 'fas fa-user-plus',
        'ver' => '1.0.0',
        'fetchJson' => get_template_directory_uri() . '/assets/fonts/material/materialdesign.js',
    ];
    return $settings;
}


if (!function_exists('basilico_get_class_widget_path')) {
    function basilico_get_class_widget_path(){
        $upload_dir = wp_upload_dir();
        $cls_path = $upload_dir['basedir'] . '/elementor-widget/';
        if (!is_dir($cls_path)) {
            wp_mkdir_p($cls_path);
        }
        return $cls_path;
    }
}

function basilico_get_post_type_options($pt_supports = []){
    $post_types = get_post_types([
        'public' => true,
    ], 'objects');
    $excluded_post_type = [
        'page',
        'attachment',
        'revision',
        'nav_menu_item',
        'custom_css',
        'customize_changeset',
        'oembed_cache',
        'e-landing-page',
        'product',
        'elementor_library'
    ];

    $result_some = [];
    $result_any = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $post_type) {
        if (!$post_type instanceof WP_Post_Type)
            continue;
        if (in_array($post_type->name, $excluded_post_type))
            continue;
        if (!empty($pt_supports) && in_array($post_type->name, $pt_supports)) {
            $result_some[$post_type->name] = $post_type->labels->singular_name;
        } else {
            $result_any[$post_type->name] = $post_type->labels->singular_name;
        }
    }
    if (!empty($pt_supports))
        return $result_some;
    else
        return $result_any;
}

//* post_grid functions
function basilico_get_post_grid_layout($pt_supports = []){
    $post_types = basilico_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
        $result[] = array(
            'name' => 'layout_' . $name,
            'label' => sprintf(esc_html__('Select Templates of %s', 'basilico'), $label),
            'type' => 'layoutcontrol',
            'default' => 'post-1',
            'options' => basilico_get_grid_layout_options($name),
            'condition' => [
                'post_type' => [$name]
            ]
        );
    }
    return $result;
}

function basilico_get_grid_layout_options($post_type_name){
    $option_layouts = [];
    switch ($post_type_name) {
        case 'pxl-portfolio':
        $option_layouts = [
            'pxl-portfolio-1' => [
                'label' => esc_html__('Layout 1', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-pxl-portfolio-1.jpg'
            ],
            'pxl-portfolio-2' => [
                'label' => esc_html__('Layout 2', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-pxl-portfolio-2.jpg'
            ],
            'pxl-portfolio-3' => [
                'label' => esc_html__('Layout 3', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-pxl-portfolio-3.jpg'
            ],
            'pxl-portfolio-4' => [
                'label' => esc_html__('Layout 4', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-pxl-portfolio-4.jpg'
            ],
            'pxl-portfolio-5' => [
                'label' => esc_html__('Layout 5', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-pxl-portfolio-5.jpg'
            ],
            'pxl-portfolio-6' => [
                'label' => esc_html__('Layout 6', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-pxl-portfolio-6.jpg'
            ],
            'pxl-portfolio-7' => [
                'label' => esc_html__('Layout 7', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-pxl-portfolio-7.jpg'
            ],
            'pxl-portfolio-8' => [
                'label' => esc_html__('Layout 8', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-pxl-portfolio-8.jpg'
            ],
            'pxl-portfolio-9' => [
                'label' => esc_html__('Layout 9', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-pxl-portfolio-9.jpg'
            ],
            'pxl-portfolio-10' => [
                'label' => esc_html__('Layout 10', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-pxl-portfolio-10.jpg'
            ],
            'pxl-portfolio-11' => [
                'label' => esc_html__('Layout 11', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-pxl-portfolio-11.jpg'
            ],
            'pxl-portfolio-12' => [
                'label' => esc_html__('Layout 12', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-pxl-portfolio-12.jpg'
            ],
        ];
        break;
        case 'post':
        $option_layouts = [
            'post-1' => [
                'label' => esc_html__('Layout 1', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-layout1.jpg'
            ],
            'post-2' => [
                'label' => esc_html__('Layout 2', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-layout2.jpg'
            ],
            'post-3' => [
                'label' => esc_html__('Layout 3', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-layout3.jpg'
            ],
            'post-4' => [
                'label' => esc_html__('Layout 4', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-layout4.jpg'
            ],
            'post-5' => [
                'label' => esc_html__('Layout 5', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-layout5.jpg'
            ],
            'post-6' => [
                'label' => esc_html__('Layout 6', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-layout6.jpg'
            ],
            'post-7' => [
                'label' => esc_html__('Layout 7', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-layout7.jpg'
            ],
            'post-8' => [
                'label' => esc_html__('Layout 8', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-layout8.jpg'
            ],
            'post-9' => [
                'label' => esc_html__('Layout 9', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-layout9.jpg'
            ],
            'post-10' => [
                'label' => esc_html__('Layout 10', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-layout10.jpg'
            ],
        ];
        break;
    }
    return $option_layouts;
}

//* post_list functions
function basilico_get_post_list_layout($pt_supports = []){
    $post_types = basilico_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
        $result[] = array(
            'name' => 'layout_' . $name,
            'label' => sprintf(esc_html__('Select Templates of %s', 'basilico'), $label),
            'type' => 'layoutcontrol',
            'default' => 'post-list-1',
            'options' => basilico_get_list_layout_options($name),
            'condition' => [
                'post_type' => [$name]
            ]
        );
    }
    return $result;
}

function basilico_get_list_layout_options($post_type_name){
    $option_layouts = [];
    switch ($post_type_name) {
        case 'pxl-portfolio':
        $option_layouts = [
            'pxl-portfolio-list-1' => [
                'label' => esc_html__('Layout 1', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_list-pxl-portfolio-1.jpg'
            ],
        ];
        break;
        case 'post':
        $option_layouts = [
            'post-list-1' => [
                'label' => esc_html__('Layout 1', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_list-layout1.jpg'
            ],
            'post-list-2' => [
                'label' => esc_html__('Layout 2', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_list-layout2.jpg'
            ],
            'post-list-3' => [
                'label' => esc_html__('Layout 3', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_list-layout3.jpg'
            ],
            'post-list-4' => [
                'label' => esc_html__('Layout 4', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_list-layout3.jpg'
            ],
        ];
        break;
    }
    return $option_layouts;
}

//* post_create functions
function basilico_get_create_list_layout($pt_supports = []){
    $post_types = basilico_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
        $result[] = array(
            'name' => 'layout_' . $name,
            'label' => sprintf(esc_html__('Select Templates of %s', 'basilico'), $label),
            'type' => 'layoutcontrol',
            'default' => 'post-create-1',
            'options' => basilico_get_create_layout_options($name),
            'condition' => [
                'post_type' => [$name]
            ]
        );
    }
    return $result;
}

function basilico_get_create_layout_options($post_type_name){
    $option_layouts = [];
    switch ($post_type_name) {
        case 'post':
        $option_layouts = [
            'post-create-1' => [
                'label' => esc_html__('Layout 1', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_create-1.jpg'
            ],
        ];
        break;
    }
    return $option_layouts;
}

function basilico_get_grid_term_by_post_type($pt_supports = [], $args = []){
    $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]);
    $post_types = basilico_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {

        $taxonomy = get_object_taxonomies($name, 'names');

        if ($name == 'post') $taxonomy = ['category'];
        if ($name == 'product') $taxonomy = ['product_cat'];

        $result[] = array(
            'name' => 'source_' . $name,
            'label' => sprintf(esc_html__('Select Term', 'basilico'), $label),
            'description' => esc_html__('Get all when no term selected', 'basilico'),
            'type' => Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => pxl_get_grid_term_options($name, $taxonomy),
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }

    return $result;
}

function basilico_get_grid_ids_by_post_type($pt_supports = [], $args = []){
    $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]);
    $post_types = basilico_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {

        $posts = basilico_list_post($name, false);

        $result[] = array(
            'name' => 'source_' . $name . '_post_ids',
            'label' => sprintf(esc_html__('Select posts', 'basilico'), $label),
            'type' => Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => $posts,
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }

    return $result;
}

/* post_carousel functions */
function basilico_get_post_carousel_layout($pt_supports = []){
    $post_types = basilico_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {
        $result[] = array(
            'name' => 'layout_' . $name,
            'label' => sprintf(esc_html__('Select Templates of %s', 'basilico'), $label),
            'type' => 'layoutcontrol',
            'default' => 'post-1',
            'options' => basilico_get_carousel_layout_options($name),
            'prefix_class' => 'post-layout-',
            'condition' => [
                'post_type' => [$name]
            ]
        );
    }
    return $result;
}

function basilico_get_carousel_layout_options($post_type_name){
    $option_layouts = [];
    switch ($post_type_name) {
        case 'post':
        $option_layouts = [
            'post-1' => [
                'label' => esc_html__('Layout 1', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-1.jpg'
            ],
            'post-2' => [
                'label' => esc_html__('Layout 2', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-2.jpg'
            ],
            'post-3' => [
                'label' => esc_html__('Layout 3', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-3.jpg'
            ],
            'post-4' => [
                'label' => esc_html__('Layout 4', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-4.jpg'
            ],
            'post-5' => [
                'label' => esc_html__('Layout 5', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-5.jpg'
            ],
            'post-6' => [
                'label' => esc_html__('Layout 6', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_grid-layout4.jpg'
            ],
            'post-7' => [
                'label' => esc_html__('Layout 7', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-7.jpg'
            ],
            'post-8' => [
                'label' => esc_html__('Layout 8', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-8.jpg'
            ],
        ];
        break;
        case 'pxl-portfolio':
        $option_layouts = [
            'pxl-portfolio-1' => [
                'label' => esc_html__('Layout 1', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-1.jpg'
            ],
            'pxl-portfolio-2' => [
                'label' => esc_html__('Layout 2', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-2.jpg'
            ],
            'pxl-portfolio-3' => [
                'label' => esc_html__('Layout 3', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-3.jpg'
            ],
            'pxl-portfolio-4' => [
                'label' => esc_html__('Layout 4', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-4.jpg'
            ],
            'pxl-portfolio-5' => [
                'label' => esc_html__('Layout 5', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-5.jpg'
            ],
            'pxl-portfolio-6' => [
                'label' => esc_html__('Layout 6', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-6.jpg'
            ],
            'pxl-portfolio-7' => [
                'label' => esc_html__('Layout 7', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-7.jpg'
            ],
            'pxl-portfolio-8' => [
                'label' => esc_html__('Layout 8', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-8.jpg'
            ],
            'pxl-portfolio-9' => [
                'label' => esc_html__('Layout 9', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-9.jpg'
            ],
            'pxl-portfolio-10' => [
                'label' => esc_html__('Layout 10', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-10.jpg'
            ],
            'pxl-portfolio-11' => [
                'label' => esc_html__('Layout 11', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-11.jpg'
            ],
            'pxl-portfolio-12' => [
                'label' => esc_html__('Layout 12', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-12.jpg'
            ],
            'pxl-portfolio-13' => [
                'label' => esc_html__('Layout 13', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-13.jpg'
            ],
            'pxl-portfolio-14' => [
                'label' => esc_html__('Layout 14', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-14.jpg'
            ],
            'pxl-portfolio-15' => [
                'label' => esc_html__('Layout 15', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/post_carousel-pxl-portfolio-15.jpg'
            ],
        ];
        break;
        case 'pxl-service':
        $option_layouts = [
            'pxl-service-1' => [
                'label' => esc_html__('Layout 1', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/service_carousel-1.jpg'
            ],
            'pxl-service-2' => [
                'label' => esc_html__('Layout 2', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/service_carousel-2.jpg'
            ],
            'pxl-service-3' => [
                'label' => esc_html__('Layout 3', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/service_carousel-3.jpg'
            ],
            'pxl-service-4' => [
                'label' => esc_html__('Layout 4', 'basilico'),
                'image' => get_template_directory_uri() . '/elements/assets/layout-image/service_carousel-4.jpg'
            ],
        ];
        break;
        case 'pxl-food':
            $option_layouts = [
                'pxl-food-1' => [
                    'label' => esc_html__('Layout 1', 'basilico'),
                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/food_carousel-1.jpg'
                ],
            ];
        break;
    }
    return $option_layouts;
}

function basilico_get_carousel_term_by_post_type($pt_supports = [], $args = []){
    $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]);
    $post_types = basilico_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {

        $taxonomy = get_object_taxonomies($name, 'names');

        if ($name == 'post') $taxonomy = ['category'];
        if ($name == 'product') $taxonomy = ['product_cat'];

        $result[] = array(
            'name' => 'source_' . $name,
            'label' => sprintf(esc_html__('Select Term', 'basilico'), $label),
            'type' => Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => pxl_get_grid_term_options($name, $taxonomy),
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }

    return $result;
}

function basilico_get_carousel_ids_by_post_type($pt_supports = [], $args = []){
    $args = wp_parse_args($args, ['condition' => 'post_type', 'custom_condition' => []]);
    $post_types = basilico_get_post_type_options($pt_supports);
    $result = [];
    if (!is_array($post_types))
        return $result;
    foreach ($post_types as $name => $label) {

        $posts = basilico_list_post($name, false);

        $result[] = array(
            'name' => 'source_' . $name . '_post_ids',
            'label' => sprintf(esc_html__('Select posts', 'basilico'), $label),
            'type' => Controls_Manager::SELECT2,
            'multiple' => true,
            'options' => $posts,
            'condition' => array_merge(
                [
                    $args['condition'] => [$name]
                ],
                $args['custom_condition']
            )
        );
    }
    return $result;
}



/* grid columns setting */
function basilico_grid_column_settings(){
    $options = [
        '12' => '1/12',
        '6'  => '1/6',
        '5'  => '1/5',
        '4'  => '1/4',
        '3'  => '1/3',
        '2'  => '1/2',
        '1.5'  => '2/3',
        '0.4'  => '2/5',
        '1'  => '1'
    ];
    return array(
        array(
            'name'    => 'col_xs',
            'label'   => esc_html__( 'Extra Small <= 575', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => $options
        ),
        array(
            'name'    => 'col_sm',
            'label'   => esc_html__( 'Small <= 767', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => $options
        ),
        array(
            'name'    => 'col_md',
            'label'   => esc_html__( 'Medium <= 991', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => $options
        ),
        array(
            'name'    => 'col_lg',
            'label'   => esc_html__( 'Large <= 1199', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => $options
        ),
        array(
            'name'    => 'col_xl',
            'label'   => esc_html__( 'XL Devices >= 1200', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '3',
            'options' => $options
        ),
        array(
            'name'    => 'col_xxl',
            'label'   => esc_html__( 'XXL Devices >= 1400', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '3',
            'options' => $options
        )
    );
}

function basilico_grid_custom_column_settings(){
    $options = [
        '12' => '1/12',
        '6'  => '1/6',
        '5'  => '1/5',
        '4'  => '1/4',
        '3'  => '1/3',
        '2'  => '1/2',
        '1.5'  => '2/3',
        '0.4'  => '2/5',
        '1'  => '1'
    ];
    return array(
        array(
            'name'    => 'col_xs_c',
            'label'   => esc_html__( 'Extra Small <= 575', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => $options
        ),
        array(
            'name'    => 'col_sm_c',
            'label'   => esc_html__( 'Small <= 767', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => $options
        ),
        array(
            'name'    => 'col_md_c',
            'label'   => esc_html__( 'Medium <= 991', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => $options
        ),
        array(
            'name'    => 'col_lg_c',
            'label'   => esc_html__( 'Large <= 1199', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => $options
        ),
        array(
            'name'    => 'col_xl_c',
            'label'   => esc_html__( 'XL Devices >= 1200', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '3',
            'options' => $options
        ),
        array(
            'name'    => 'col_xxl_c',
            'label'   => esc_html__( 'XXL Devices >= 1400', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '3',
            'options' => $options
        )
    );
}

function basilico_carousel_column_settings(){
    $options = [
        '12' => '12',
        '6'  => '6',
        '5'  => '5',
        '4'  => '4',
        '3'  => '3',
        '2'  => '2',
        '1.5'  => '2/3',
        '0.4'  => '2/5',
        '1'  => '1'
    ];
    return array(
        array(
            'name'    => 'col_xs',
            'label'   => esc_html__( 'Extra Small <= 575', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '1',
            'options' => $options
        ),
        array(
            'name'    => 'col_sm',
            'label'   => esc_html__( 'Small <= 767', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => $options
        ),
        array(
            'name'    => 'col_md',
            'label'   => esc_html__( 'Medium <= 991', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '2',
            'options' => $options
        ),
        array(
            'name'    => 'col_lg',
            'label'   => esc_html__( 'Large <= 1199', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '3',
            'options' => $options
        ),
        array(
            'name'    => 'col_xl',
            'label'   => esc_html__( 'XL Devices >= 1200', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '4',
            'options' => $options
        ),
        array(
            'name'    => 'col_xxl',
            'label'   => esc_html__( 'XXL Devices >= 1400', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => '4',
            'options' => $options
        )
    );
}

function basilico_arrow_settings(){
    return array(
        array(
            'name'         => 'arrows',
            'label'        => esc_html__('Show Arrows', 'basilico'),
            'type'         => 'select',
            'options'      => [
                'flex'  => esc_html__('Yes', 'basilico'),
                'none' => esc_html__('No', 'basilico')
            ], 
            'default'      => 'none',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows' => 'display: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'arrows_style',
            'label' => esc_html__('Arrows Style', 'basilico'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'style-1' => esc_html__('Style 1', 'basilico'),
                'style-2' => esc_html__('Style 2', 'basilico'),
                'style-3' => esc_html__('Style 3', 'basilico'),
                'style-4' => esc_html__('Style 4', 'basilico'),
                'style-5' => esc_html__('Style 5', 'basilico'),
            ],
            'default' => 'style-1',
        ),
        array(
            'name' => 'arrow_icon_previous',
            'label' => esc_html__('Icon Previous', 'basilico' ),
            'type' => 'icons',
            'label_block' => true,
            'fa4compatibility' => 'icon',
        ),
        array(
            'name' => 'arrow_icon_next',
            'label' => esc_html__('Icon Next', 'basilico' ),
            'type' => 'icons',
            'label_block' => true,
            'fa4compatibility' => 'icon',
        ),
        array(
            'name' => 'arrows_bg',
            'label' => esc_html__('Arrows Background', 'basilico'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'arrows_style' => ['style-2', 'style-3']
            ]
        ),
        array(
            'name' => 'arrows_bg_hover',
            'label' => esc_html__('Arrows Background Hover', 'basilico'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow:hover' => 'background-color: {{VALUE}};',
            ],
            'condition' => [
                'arrows_style' => 'style-2'
            ]
        ),
        array(
            'name' => 'arrows_border',
            'label' => esc_html__('Arrows Border', 'basilico'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow' => 'border: 1px solid {{VALUE}};',
            ],
            'condition' => [
                'arrows_style' => 'style-2'
            ]
        ),
        array(
            'name' => 'arrows_border_hover',
            'label' => esc_html__('Arrows Border Hover', 'basilico'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow:hover' => 'border: 1px solid {{VALUE}};',
            ],
            'condition' => [
                'arrows_style' => 'style-2'
            ]
        ),
        array(
            'name' => 'arrow_icon_size',
            'label' => esc_html__('Arrow Icon Size', 'basilico' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow .pxl-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow svg' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'arrows_icon_color',
            'label' => esc_html__('Arrows Icon Color', 'basilico'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow .pxl-icon' => 'color: {{VALUE}};',
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow svg' => 'fill: {{VALUE}};'
            ],
        ),
        array(
            'name' => 'arrows_icon_hover',
            'label' => esc_html__('Arrows Icon Color Hover', 'basilico'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow:hover .pxl-icon' => 'color: {{VALUE}};',
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow:hover svg' => 'fill: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'arrow_prev_position',
            'label' => esc_html__('Arrow Previous Position', 'basilico'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'default',
            'options' => [
                'default' => esc_html('Default', 'basilico'),
                'center-vertical' => esc_html('Center Vertical', 'basilico'),
                'absolute' => esc_html('Custom', 'basilico'),
            ],
            'condition' => [
                'arrows_style!' => 'style-4'
            ],
            'separator' => 'before'
        ),
        array(
            'name' => 'arrow_prev_offset_orientation_h',
            'label' => esc_html__('Horizontal Orientation', 'basilico'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'default' => 'left',
            'options' => [
                'left' => [
                    'title' => 'Start',
                    'icon' => 'eicon-h-align-left',
                ],
                'right' => [
                    'title' => 'End',
                    'icon' => 'eicon-h-align-right',
                ],
            ],
            'render_type' => 'ui',
            'condition' => [
                'arrows_style!' => 'style-4',
                'arrow_prev_position' => ['absolute', 'center-vertical']
            ],
        ),
        array(
            'name' => 'arrow_prev_offset_x',
            'label' => esc_html__('Offset', 'basilico'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -1000,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vw' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vh' => [
                    'min' => -200,
                    'max' => 200,
                ],
            ],
            'control_type' => 'responsive',
            'default' => [
                'size' => 0,
                'unit' => 'px'
            ],
            'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow-prev' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
            ],
            'condition' => [
                'arrow_prev_offset_orientation_h!' => 'right',
                'arrow_prev_position' => ['absolute', 'center-vertical'],
                'arrows_style!' => 'style-4'
            ],
        ),
        array(
            'name' => 'arrow_prev_offset_x_end',
            'label' => esc_html__('Offset', 'basilico'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -1000,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vw' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vh' => [
                    'min' => -200,
                    'max' => 200,
                ],
            ],
            'control_type' => 'responsive',
            'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
            'default' => [
                'size' => 0,
                'unit' => 'px'
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow-prev' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
            ],
            'condition' => [
                'arrow_prev_offset_orientation_h' => 'right',
                'arrow_prev_position' => ['absolute', 'center-vertical'],
                'arrows_style!' => 'style-4'
            ],
        ),
        array(
            'name' => 'arrow_prev_offset_orientation_v',
            'label' => esc_html__('Vertical Orientation', 'basilico'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'default' => 'top',
            'options' => [
                'top' => [
                    'title' => 'Top',
                    'icon' => 'eicon-v-align-top',
                ],
                'bottom' => [
                    'title' => 'Bottom',
                    'icon' => 'eicon-v-align-bottom',
                ],
            ],
            'render_type' => 'ui',
            'condition' => [
                'arrow_prev_position' => 'absolute',
                'arrows_style!' => 'style-4'
            ]
        ),
        array(
            'name' => 'arrow_prev_offset_y',
            'label' => esc_html__('Offset', 'basilico'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -1000,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vw' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vh' => [
                    'min' => -200,
                    'max' => 200,
                ],
            ],
            'control_type' => 'responsive',
            'default' => [
                'size' => 0,
                'unit' => 'px'
            ],
            'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow-prev' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
            ],
            'condition' => [
                'arrow_prev_offset_orientation_v!' => 'bottom',
                'arrow_prev_position' => 'absolute',
                'arrows_style!' => 'style-4'
            ],
        ),
        array(
            'name' => 'arrow_prev_offset_y_end',
            'label' => esc_html__('Offset', 'basilico'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -1000,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vw' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vh' => [
                    'min' => -200,
                    'max' => 200,
                ],
            ],
            'control_type' => 'responsive',
            'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
            'default' => [
                'size' => 0,
                'unit' => 'px'
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow-prev' => 'bottom: {{SIZE}}{{UNIT}}; top: auto;',
            ],
            'condition' => [
                'arrow_prev_offset_orientation_v' => 'bottom',
                'arrow_prev_position' => 'absolute',
                'arrows_style!' => 'style-4'
            ],
        ),
        array(
            'name' => 'arrow_next_position',
            'label' => esc_html__('Arrow Next Position', 'basilico'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'default',
            'options' => [
                'default' => esc_html('Default', 'basilico'),
                'center-vertical' => esc_html('Center Vertical', 'basilico'),
                'absolute' => esc_html('Custom', 'basilico'),
            ],
            'condition' => [
                'arrows_style!' => 'style-4'
            ],
            'separator' => 'before'
        ),
        array(
            'name' => 'arrow_next_offset_orientation_h',
            'label' => esc_html__('Horizontal Orientation', 'basilico'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'default' => 'right',
            'options' => [
                'left' => [
                    'title' => 'Start',
                    'icon' => 'eicon-h-align-left',
                ],
                'right' => [
                    'title' => 'End',
                    'icon' => 'eicon-h-align-right',
                ],
            ],
            'render_type' => 'ui',
            'condition' => [
                'arrow_next_position' => ['absolute', 'center-vertical'],
                'arrows_style!' => 'style-4'
            ]
        ),
        array(
            'name' => 'arrow_next_offset_x',
            'label' => esc_html__('Offset', 'basilico'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -1000,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vw' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vh' => [
                    'min' => -200,
                    'max' => 200,
                ],
            ],
            'control_type' => 'responsive',
            'default' => [
                'size' => 0,
                'unit' => 'px'
            ],
            'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow-next' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
            ],
            'condition' => [
                'arrow_next_offset_orientation_h!' => 'right',
                'arrow_next_position' => ['absolute', 'center-vertical'],
                'arrows_style!' => 'style-4'
            ],
        ),
        array(
            'name' => 'arrow_next_offset_x_end',
            'label' => esc_html__('Offset', 'basilico'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -1000,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vw' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vh' => [
                    'min' => -200,
                    'max' => 200,
                ],
            ],
            'control_type' => 'responsive',
            'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
            'default' => [
                'size' => 0,
                'unit' => 'px'
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow-next' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
            ],
            'condition' => [
                'arrow_next_offset_orientation_h' => 'right',
                'arrow_next_position' => ['absolute', 'center-vertical'],
                'arrows_style!' => 'style-4'
            ],
        ),
        array(
            'name' => 'arrow_next_offset_orientation_v',
            'label' => esc_html__('Vertical Orientation', 'basilico'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'default' => 'top',
            'options' => [
                'top' => [
                    'title' => 'Top',
                    'icon' => 'eicon-v-align-top',
                ],
                'bottom' => [
                    'title' => 'Bottom',
                    'icon' => 'eicon-v-align-bottom',
                ],
            ],
            'render_type' => 'ui',
            'condition' => [
                'arrow_next_position' => 'absolute',
                'arrows_style!' => 'style-4'
            ]
        ),
        array(
            'name' => 'arrow_next_offset_y',
            'label' => esc_html__('Offset', 'basilico'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -1000,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vw' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vh' => [
                    'min' => -200,
                    'max' => 200,
                ],
            ],
            'control_type' => 'responsive',
            'default' => [
                'size' => 0,
                'unit' => 'px'
            ],
            'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow-next' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
            ],
            'condition' => [
                'arrow_next_offset_orientation_v!' => 'bottom',
                'arrow_next_position' => 'absolute',
                'arrows_style!' => 'style-4'
            ],
        ),
        array(
            'name' => 'arrow_next_offset_y_end',
            'label' => esc_html__('Offset', 'basilico'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => -1000,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vw' => [
                    'min' => -200,
                    'max' => 200,
                ],
                'vh' => [
                    'min' => -200,
                    'max' => 200,
                ],
            ],
            'control_type' => 'responsive',
            'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
            'default' => [
                'size' => 0,
                'unit' => 'px'
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-arrows .pxl-swiper-arrow-next' => 'bottom: {{SIZE}}{{UNIT}}; top: auto;',
            ],
            'condition' => [
                'arrow_next_offset_orientation_v' => 'bottom',
                'arrow_next_position' => 'absolute',
                'arrows_style!' => 'style-4'
            ]
        )
    );
}

function basilico_dots_settings(){
    return array(
        array(
            'name'         => 'dots',
            'label'        => esc_html__('Show Dots', 'basilico'),
            'type'         => 'select',
            'options'      => [
                'flex'  => esc_html__('Yes', 'basilico'),
                'none' => esc_html__('No', 'basilico')
            ], 
            'default'      => 'none',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-dots, {{WRAPPER}} .slick-dots' => 'display: {{VALUE}} !important;',
            ],
        ),
        array(
            'name' => 'dots_scape',
            'label' => esc_html__('Dots Space Top', 'basilico' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'control_type' => 'responsive',
            'size_units' => [ 'px', 'em' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-dots, {{WRAPPER}} .slick-dots' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ),
        array(
            'name' => 'dots_align',
            'label' => esc_html__('Alignment', 'basilico' ),
            'type' => 'choose',
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
                '{{WRAPPER}} .pxl-swiper-dots, {{WRAPPER}} .slick-dots' => 'justify-content: {{VALUE}};'
            ],
        ),
        array(
            'name' => 'dots_color',
            'label' => esc_html__('Dots Color', 'basilico'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-slider .pxl-swiper-dots .pxl-swiper-pagination-bullet:before, {{WRAPPER}} .slick-slider .slick-dots .pxl-swiper-pagination-bullet:before' => 'background-color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'dots_color_active',
            'label' => esc_html__('Active Color', 'basilico'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-slider .pxl-swiper-dots .pxl-swiper-pagination-bullet.swiper-pagination-bullet-active:before, {{WRAPPER}} .slick-slider .slick-dots .slick-active .pxl-swiper-pagination-bullet:before' => 'background-color: {{VALUE}};',
            ],
        ),
        array(
            'name' => 'border_color_active',
            'label' => esc_html__('Border Color Active', 'basilico'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .pxl-swiper-slider .pxl-swiper-dots .pxl-swiper-pagination-bullet:after, {{WRAPPER}} .slick-slider .slick-dots .pxl-swiper-pagination-bullet:after' => 'border-color: {{VALUE}};',
            ],
        ),
    );
}

function basilico_elementor_animation_opts($args = []){
    $args = wp_parse_args($args, [
        'name'   => '',
        'label'  => '',
        'condition'   => [],
    ]);

    return array(
        array(
            'name'      => $args['name'].'_animation',
            'label'     => $args['label'].' '.esc_html__( 'Motion Effect', 'basilico' ),
            'type'      => \Elementor\Controls_Manager::ANIMATION,
            'condition'   => $args['condition'],
        ),
        array(
            'name'    => $args['name'].'_animation_duration', 
            'label'   => $args['label'].' '.esc_html__( 'Animation Duration', 'basilico' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'normal',
            'options' => [
                'slow'   => esc_html__( 'Slow', 'basilico' ),
                'normal' => esc_html__( 'Normal', 'basilico' ),
                'fast'   => esc_html__( 'Fast', 'basilico' ),
            ],
            'condition'   => array_merge($args['condition'], [ $args['name'].'_animation!' => '' ]),
        ),
        array(
            'name'      => $args['name'].'_animation_delay',
            'label'     => $args['label'].' '.esc_html__( 'Animation Delay', 'basilico' ),
            'type'      => \Elementor\Controls_Manager::NUMBER,
            'min'       => 0,
            'step'      => 100,
            'condition'   => array_merge($args['condition'], [ $args['name'].'_animation!' => '' ]),
        )
    );
}

function basilico_position_option($args = []){
    $start = is_rtl() ? esc_html__( 'Right', 'basilico' ) : esc_html__( 'Left', 'basilico' );
    $end = ! is_rtl() ? esc_html__( 'Right', 'basilico' ) : esc_html__( 'Left', 'basilico' );
    $args = wp_parse_args($args, [
        'prefix' => '',
        'selectors_class' => '',
        'condition' => []
    ]);
    $options = array(
        array(
            'name'        => $args['prefix'] .'position',
            'label' => ucfirst( str_replace('_', ' ', $args['prefix']) ).' '.esc_html__( 'Position', 'basilico' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => '',
            'options' => [
                '' => esc_html__( 'Default', 'basilico' ),
                'absolute' => esc_html__( 'Absolute', 'basilico' ),
            ],
            'frontend_available' => true,
            'condition'   => $args['condition'],
        ),

        array(
            'name'        => $args['prefix'] .'pos_offset_left',
            'label' => esc_html__( 'Left', 'basilico' ).' (50px) px,%,vw,auto',
            'type' => 'text',
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'left: {{VALUE}}',
            ],
            'condition'   => array_merge($args['condition'], [ $args['prefix'] .'position!' => '' ]),
        ),  
        array(
            'name'        => $args['prefix'] .'pos_offset_right',
            'label' => esc_html__( 'Right', 'basilico' ).' (50px) px,%,vw,auto',
            'type' => 'text',
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'right: {{VALUE}}',
            ],
            'condition'   => array_merge($args['condition'], [ $args['prefix'] .'position!' => '' ]),

        ),
        array(
            'name'        => $args['prefix'] .'pos_offset_top',
            'label' => esc_html__( 'Top', 'basilico' ).' (50px) px,%,vh,auto',
            'type' => 'text',
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'top: {{VALUE}}',
            ],
            'condition'   => array_merge($args['condition'], [ $args['prefix'] .'position!' => '']),

        ),  
        array(
            'name'        => $args['prefix'] .'pos_offset_bottom',
            'label' => esc_html__( 'Bottom', 'basilico' ).' (50px) px,%,vh,auto',
            'type' => 'text',
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'bottom: {{VALUE}}',
            ],
            'condition'   => array_merge($args['condition'], [ $args['prefix'] .'position!' => '']),
        ),
        array(
            'name'        => $args['prefix'] .'z_index',
            'label' => ucfirst( str_replace('_', ' ', $args['prefix']) ).' '. esc_html__( 'Z-Index', 'basilico' ),
            'type' => Controls_Manager::NUMBER,
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'z-index: {{VALUE}};',
            ],
            'condition'   => array_merge($args['condition'], [ $args['prefix'] .'position!' => '' ]),
        )
    );
    return $options;
}

function basilico_gradient_option($args = []){
    $gradient_prefix_class = 'pxl-';
    $args = wp_parse_args($args, [
        'prefix' => '',
        'selectors_class' => '',
        'output_key' => 'gradient01',
        'condition' => []
    ]);
    $options = array(
        array(
            'name'        => $args['prefix'] .'gradient_option_popover',
            'label' => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'Gradient', 'basilico' ),
            'type' => Controls_Manager::POPOVER_TOGGLE,
            'prefix_class' => $gradient_prefix_class,
            'condition'   => $args['condition'],
        ),
        array(
            'name'        => $args['prefix'] .'pxl_start_popover',
            'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'Start Popover', 'basilico' ),
            'type'        => 'pxl_start_popover',
            'condition'   => $args['condition'],
        ),
        array(
            'name' => $args['prefix'] .'gradient_from',
            'label' => esc_html__('Gradient From', 'basilico' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => '--'.$args['output_key'].'-color-from: {{VALUE}};',
            ],
            'condition'   => $args['condition'],
        ),
        array(
            'name' => $args['prefix'] .'gradient_to',
            'label' => esc_html__('Gradient To', 'basilico' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => '--'.$args['output_key'].'-color-to: {{VALUE}};',
            ],
            'condition'   => $args['condition'],
        ),
        array(
            'name' => $args['prefix'] .'_gradient_angle',
            'label' => esc_html__('Angle', 'basilico' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 360,
                    'step' => 10,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => '--'.$args['output_key'].'-angle: {{SIZE}}deg;',
            ],
        ),
        array(
            'name'        => $args['prefix'] .'pxl_end_popover',
            'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'End Popover', 'basilico' ),
            'type'        => 'pxl_end_popover',
            'condition'   => $args['condition'],
        )
    );
    return $options;
}

function basilico_get_img_link_url( $settings ) {
    if ( 'none' === $settings['link_to'] ) {
        return false;
    }

    if ( 'custom' === $settings['link_to'] ) {
        if ( empty( $settings['link']['url'] ) ) {
            return false;
        }

        return $settings['link'];
    }

    return [
        'url' => $settings['image']['url'],
    ];
}

function pxl_get_product_grid_term_options($args=[]){
    $product_categories = get_categories(array( 'taxonomy' => 'product_cat' ));
    $options = array();
    foreach($product_categories as $category){
        $options[$category->slug] = $category->name;
    }
    return $options;
}

function basilico_get_parallax_effect_settings($settings){
    if(!empty($settings['pxl_bg_parallax']) && $settings['pxl_bg_parallax'] == 'transform'){
        $effects = [];
        if(!empty($settings['parallax_effect_x'])){
            $effects['x'] = (int)$settings['parallax_effect_x'];
        }
        if(!empty($settings['parallax_effect_y'])){
            $effects['y'] = (int)$settings['parallax_effect_y'];
        }
        if(!empty($settings['parallax_effect_z'])){
            $effects['z'] = (int)$settings['parallax_effect_z'];
        }
        if(!empty($settings['parallax_effect_rotate_x'])){
            $effects['rotateX'] = (float)$settings['parallax_effect_rotate_x'];
        }
        if(!empty($settings['parallax_effect_rotate_y'])){
            $effects['rotateY'] = (float)$settings['parallax_effect_rotate_y'];
        }
        if(!empty($settings['parallax_effect_scale_z'])){
            $effects['rotateZ'] = (float)$settings['parallax_effect_scale_z'];
        }
        if(!empty($settings['parallax_effect_scale_x'])){
            $effects['scaleX'] = (float)$settings['parallax_effect_scale_x'];
        }
        if(!empty($settings['parallax_effect_scale_y'])){
            $effects['scaleY'] = (float)$settings['parallax_effect_scale_y'];
        }
        if(!empty($settings['parallax_effect_scale_z'])){
            $effects['scalez'] = (float)$settings['parallax_effect_scale_z'];
        }
        if(!empty($settings['parallax_effect_scale'])){
            $effects['scale'] = (float)$settings['parallax_effect_scale'];
        }

        return json_encode($effects);
    }else{
        return '';
    }
}

function basilico_position_option_base($args = []){
    $args = wp_parse_args($args, [
        'prefix' => '',
        'selectors_class' => '',
        'condition' => []
    ]);
    $options = array(
        array(
            'name'         => $args['prefix'] .'position_popover',
            'label'        => ucfirst( str_replace('_', ' ', $args['prefix']) ).' '. esc_html__( 'Position', 'basilico' ),
            'type'         => Controls_Manager::POPOVER_TOGGLE,
            'label_off'    => esc_html__( 'Default', 'basilico' ),
            'label_on'     => esc_html__( 'Custom', 'basilico' ),
            'return_value' => 'yes',
            'condition'    => $args['condition'],
        ),
        array(
            'name'        => $args['prefix'] .'pxl_start_popover',
            'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'Start Popover', 'basilico' ),
            'type'        => 'pxl_start_popover',
            'condition'   => $args['condition'],
        ), 

        array(
            'name'        => $args['prefix'] .'pos_offset_left',
            'label' => esc_html__( 'Left', 'basilico' ).' (50px) px,%,vw,auto',
            'type' => 'text',
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'left: {{VALUE}}',
            ],
            'condition'   => $args['condition'],
        ),  
        array(
            'name'        => $args['prefix'] .'pos_offset_right',
            'label' => esc_html__( 'Right', 'basilico' ).' (50px) px,%,vw,auto',
            'type' => 'text',
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'right: {{VALUE}}',
            ],
            'condition'   => $args['condition'],

        ),
        array(
            'name'        => $args['prefix'] .'pos_offset_top',
            'label' => esc_html__( 'Top', 'basilico' ).' (50px) px,%,vh,auto',
            'type' => 'text',
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'top: {{VALUE}}',
            ],
            'condition'   => $args['condition'],

        ),  
        array(
            'name'        => $args['prefix'] .'pos_offset_bottom',
            'label' => esc_html__( 'Bottom', 'basilico' ).' (50px) px,%,vh,auto',
            'type' => 'text',
            'default' => '',
            'control_type' => 'responsive',
            'selectors' => [
                '{{WRAPPER}} '.$args['selectors_class'] => 'bottom: {{VALUE}}',
            ],
            'condition'   => $args['condition'],
        ),
        array(
            'name'        => $args['prefix'] .'pxl_end_popover',
            'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'End Popover', 'basilico' ),
            'type'        => 'pxl_end_popover',
            'condition'   => $args['condition'],
        )
        
    );
    return $options;
}

function basilico_parallax_effect_option($args = []){

    $args = wp_parse_args($args, [
        'prefix' => '',
        'condition' => []
    ]);
    $options = array(
        array(
            'name'         => $args['prefix'] .'parallax_effect_popover',
            'label'        => ucfirst( str_replace('_', ' ', $args['prefix']) ).' '. esc_html__( 'Parallax Effect', 'basilico' ),
            'type'         => Controls_Manager::POPOVER_TOGGLE,
            'label_off'    => esc_html__( 'Default', 'basilico' ),
            'label_on'     => esc_html__( 'Custom', 'basilico' ),
            'return_value' => 'yes',
            'condition'    => $args['condition'],
        ),
        array(
            'name'        => $args['prefix'] .'pxl_start_popover',
            'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'Start Popover', 'basilico' ),
            'type'        => 'pxl_start_popover',
            'condition'   => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_x',
            'label'     => esc_html__( 'TranslateX', 'basilico' ).' (-80)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_y',
            'label'     => esc_html__( 'TranslateY', 'basilico' ).' (-80)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_z',
            'label'     => esc_html__( 'TranslateZ', 'basilico' ).' (-80)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_rotate_x',
            'label'     => esc_html__( 'Rotate X', 'basilico' ).' (30)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_rotate_y',
            'label'     => esc_html__( 'Rotate Y', 'basilico' ).' (30)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_rotate_z',
            'label'     => esc_html__( 'Rotate Z', 'basilico' ).' (30)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_scale_x',
            'label'     => esc_html__( 'Scale X', 'basilico' ).' (0.8)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_scale_y',
            'label'     => esc_html__( 'Scale Y', 'basilico' ).' (0.8)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_scale_z',
            'label'     => esc_html__( 'Scale Z', 'basilico' ).' (0.8)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'      => $args['prefix'] .'parallax_effect_scale',
            'label'     => esc_html__( 'Scale', 'basilico' ).' (0.8)', 
            'type'      => Controls_Manager::NUMBER,
            'default'   => '',
            'condition' => $args['condition'],
        ),
        array(
            'name'        => $args['prefix'] .'pxl_end_popover',
            'label'       => ucfirst( str_replace('_', '', $args['prefix']) ).' '. esc_html__( 'End Popover', 'basilico' ),
            'type'        => 'pxl_end_popover',
            'condition'   => $args['condition'],
        ), 

    );
return $options;
}

function basilico_split_text_option($name=''){
    return [
        'name' => $name.'split_text_anm',
        'label' => ucfirst( str_replace('_', ' ', $name) ).' '.esc_html__('Split Text Animation', 'basilico' ),
        'type' => 'select',
        'options' => [
            ''               => esc_html__( 'None', 'basilico' ),
            'split-in-fade' => esc_html__( 'In Fade', 'basilico' ),
            'split-in-right' => esc_html__( 'In Right', 'basilico' ),
            'split-in-left'  => esc_html__( 'In Left', 'basilico' ),
            'split-in-up'    => esc_html__( 'In Up', 'basilico' ),
            'split-in-down'  => esc_html__( 'In Down', 'basilico' ),
            'split-in-rotate'  => esc_html__( 'In Rotate', 'basilico' ),
            'split-in-scale'  => esc_html__( 'In Scale', 'basilico' ),
            'split-words-scale'  => esc_html__( 'Words Scale', 'basilico' ),
            'split-lines-transform'  => esc_html__( 'Lines Transform', 'basilico' ),
            'split-lines-rotation-x'  => esc_html__( 'Lines Transform rotate rotate', 'basilico' ),
        ],
        'label_block' => true,
        'default' => '',
    ];
}

function sanitize_text_field_array( $array ) {
    if (!is_array($array))
        return sanitize_text_field($array);
    
    foreach ( $array as $key => $value ) {
        if ( is_array( $value ) ) {
            $array[ $key ] = sanitize_text_field_array( $value );
        } else {
            $array[ $key ] = sanitize_text_field( $value );
        }
    }
    return $array;
}