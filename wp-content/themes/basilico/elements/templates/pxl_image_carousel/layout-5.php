<?php
extract($settings);

$imgGallery = $settings['img_gallery'];
$arrows_style = $widget->get_setting('arrows_style', 'style-1');
$drag_cursor = $widget->get_setting('setting_drag', false);
$drag_text   = $widget->get_setting('drag_text', 'Drag');

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1, 
    'slide_mode'                    => 'slider',
    'slides_to_show_xxl'            => (float)$widget->get_setting('col_xxl', 3),
    'slides_to_show'                => (float)$widget->get_setting('col_xl', 3),
    'slides_to_show_lg'             => (float)$widget->get_setting('col_lg', 2),
    'slides_to_show_md'             => (float)$widget->get_setting('col_md', 2),
    'slides_to_show_sm'             => (float)$widget->get_setting('col_sm', 1),
    'slides_to_show_xs'             => (float)$widget->get_setting('col_xs', 1), 
    'slides_to_scroll'              => (int)$widget->get_setting('slides_to_scroll', 1), 
    'slides_gutter'                 => $space_between,
    'arrow'                         => true,
    'dots'                          => true,
    'dots_style'                    => 'bullets',
    'autoplay'                      => (bool)$widget->get_setting('autoplay', false),
    'pause_on_hover'                => (bool)$widget->get_setting('pause_on_hover', false),
    'pause_on_interaction'          => true,
    'delay'                         => (int)$widget->get_setting('autoplay_speed', 5000),
    'loop'                          => (bool)$widget->get_setting('infinite', false),
    'speed'                         => (int)$widget->get_setting('speed', 500),
];

$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container overflow-hidden',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);

$img_size = !empty($img_size) ? $img_size : 'full';
$button_text = !empty($button_text) ? $button_text : esc_html__('Drag', 'basilico');
?>

<div class="pxl-swiper-slider pxl-image-carousel layout-5">
    <?php if ($drag_cursor == "true") : ?>
        <div class="circle-cursor">
            <span><?php echo esc_html($drag_text); ?></span>
        </div>
    <?php endif; ?>
    <div class="pxl-swiper-slider-wrap pxl-carousel-inner relative">
        <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
            <div class="pxl-swiper-wrapper swiper-wrapper">
                <?php foreach ($imgGallery as $key => $value) :
                    $image = isset($value['id']) ? $value['id'] : '';
                    $img = pxl_get_image_by_size(array(
                        'attach_id'  => $image,
                        'thumb_size' => $img_size,
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                    ?>
                    <div class="pxl-swiper-slide swiper-slide">
                        <?php if (!empty($image)) : ?>
                            <div class="item-inner">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php basilico_arrow_template($settings, 'pxli pxli-left-arrow', 'pxli pxli-right-arrow'); ?>
        <div class="pxl-swiper-dots"></div>
    </div>
</div>