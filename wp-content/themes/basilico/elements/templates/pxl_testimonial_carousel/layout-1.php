<?php
$default_settings = [
    'content_list' => [],
];

$settings = array_merge($default_settings, $settings);
extract($settings);

$arrows_style = $widget->get_setting('arrows_style', 'style-1');
$quote_icon_type = $widget->get_setting('quote_icon_type', 'text');

$pagination_style = basilico()->get_theme_opt('swiper_pagination_style', 'style-df');

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1,
    'slide_mode'                    => 'slide',
    'slides_to_show_xxl'            => (float)$widget->get_setting('col_xxl', 4), 
    'slides_to_show'                => (float)$widget->get_setting('col_xl', 4), 
    'slides_to_show_lg'             => (float)$widget->get_setting('col_lg', 3), 
    'slides_to_show_md'             => (float)$widget->get_setting('col_md', 3), 
    'slides_to_show_sm'             => (float)$widget->get_setting('col_sm', 2), 
    'slides_to_show_xs'             => (float)$widget->get_setting('col_xs', 1), 
    'slides_to_scroll'              => (int)$widget->get_setting('slides_to_scroll', 1), 
    'slides_gutter'                 => 30,
    'arrow'                         => true,
    'dots'                          => true,
    'dots_style'                    => 'bullets',
    'autoplay'                      => (bool)$widget->get_setting('autoplay', false),
    'pause_on_hover'                => (bool)$widget->get_setting('pause_on_hover', false),
    'pause_on_interaction'          => true,
    'delay'                         => (int)$widget->get_setting('autoplay_speed', 5000),
    'loop'                          => (int)$widget->get_setting('infinite', false),
    'speed'                         => (int)$widget->get_setting('speed', 500),
];


$widget->add_render_attribute('carousel', [
    'class'         => 'pxl-swiper-container overflow-hidden',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
?>
<?php if (isset($content_list) && !empty($content_list) && count($content_list)) : ?>
<div class="pxl-swiper-slider pxl-testimonial-carousel layout-<?php echo esc_attr($settings['layout']) ?>">
    <div class="pxl-swiper-slider-wrap pxl-carousel-inner relative">
        <div <?php pxl_print_html($widget->get_render_attribute_string('carousel')); ?>>
            <div class="pxl-swiper-wrapper swiper-wrapper">
                <?php foreach ($content_list as $key => $value) :
                    $image       = isset($value['image']) ? $value['image'] : [];
                    $title       = isset($value['title']) ? $value['title'] : '';
                    $position    = isset($value['position']) ? $value['position'] : '';
                    $description = isset($value['description']) ? $value['description'] : '';
                    $thumbnail = '';
                    if (!empty($image['id'])) {
                        $img = pxl_get_image_by_size(array(
                            'attach_id'  => $image['id'],
                            'thumb_size' => '250x250',
                            'class' => 'no-lazyload',
                        ));
                        $thumbnail = $img['thumbnail'];
                    }
                    ?>
                    <div class="pxl-swiper-slide swiper-slide">
                        <div class="item-inner relative text-center">
                            <?php if ($quote_icon_type == 'icon' && !empty($settings['selected_icon']['value'])) { ?>
                                <div class="icon-wrapper">
                                    <?php \Elementor\Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true', 'class' => 'item-quote-icon pxl-icon'], 'i'); ?>
                                </div>
                            <?php } ?>
                            <?php if ($quote_icon_type == 'text') { ?>
                                <div class="item-quote-icon">“</div>
                            <?php } ?>
                            <div class="item-desc"><?php echo pxl_print_html($description); ?></div>
                            <div class="pxl-divider"></div>
                            <div class="item-wrap row gx-20 justify-content-center">
                                <?php if (!empty($value['rating']) && $value['rating'] != 'none') : ?>
                                    <div class="item-rating-star">
                                        <div class="item-rating <?php echo esc_attr($value['rating']); ?>">
                                            <i class="zmdi zmdi-star"></i>
                                            <i class="zmdi zmdi-star"></i>
                                            <i class="zmdi zmdi-star"></i>
                                            <i class="zmdi zmdi-star"></i>
                                            <i class="zmdi zmdi-star"></i>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="item-info col-auto">
                                    <?php if (!empty($title)) : ?>
                                        <h4 class="item-title"><?php echo esc_html($title); ?></h4>
                                    <?php endif; ?>
                                    <?php if (!empty($position)) : ?>
                                        <div class="item-position"><?php echo esc_html($position); ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($thumbnail)) : ?>
                                        <div class="item-image col-auto">
                                            <span class="img-outer">
                                                <?php echo wp_kses_post($thumbnail); ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php basilico_arrow_template($settings); ?>
        <div class="pxl-swiper-dots <?php echo esc_attr($pagination_style); ?>"></div>
    </div>
</div>
<?php endif; ?>