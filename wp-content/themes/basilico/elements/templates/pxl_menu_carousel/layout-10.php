<?php
$default_settings = [
    'list_food_2' => [],
];
   
$settings = array_merge($default_settings, $settings);
extract($settings);

$arrows_style = $widget->get_setting('arrows_style', 'style-1');

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => 1,
    'slide_mode'                    => 'slide', 
    'slides_to_show_xxl'            => (int)$widget->get_setting('col_xxl', 3),
    'slides_to_show'                => (int)$widget->get_setting('col_xl', 3),
    'slides_to_show_lg'             => (int)$widget->get_setting('col_lg', 2),
    'slides_to_show_md'             => (int)$widget->get_setting('col_md', 2),
    'slides_to_show_sm'             => (int)$widget->get_setting('col_sm', 1),
    'slides_to_show_xs'             => (int)$widget->get_setting('col_xs', 1), 
    'slides_to_scroll'              => (int)$widget->get_setting('slides_to_scroll', 1), 
    'slides_gutter'                 => 30,
    'arrow'                         => true,
    'dots'                          => true,
    'dots_style'                    => 'bullets',
    'autoplay'                      => (bool)$widget->get_setting('autoplay', false),
    'pause_on_hover'                => (bool)$widget->get_setting('pause_on_hover', true),
    'pause_on_interaction'          => true,
    'delay'                         => (int)$widget->get_setting('autoplay_speed', 5000),
    'loop'                          => (bool)$widget->get_setting('infinite', false),
    'speed'                         => (int)$widget->get_setting('speed', 500)
];
  
$img_size = !empty($img_size) ? $img_size : '443x413';
$widget->add_render_attribute( 'carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);
?>
<?php if(isset($list_food_2) && !empty($list_food_2) && count($list_food_2)): ?>
    <div class="pxl-swiper-slider pxl-menu-carousel layout-<?php echo esc_attr($settings['layout'])?>">
        <div class="pxl-swiper-slider-wrap pxl-carousel-inner relative">
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <div class="pxl-swiper-wrapper swiper-wrapper">
                <?php foreach ($list_food_2 as $key => $value) :
                    $link_food_2 = isset($value['link_food_2']) ? $value['link_food_2'] : '';
                    $link_key = $widget->get_repeater_setting_key( 'content', 'value', $key );
                    if ( ! empty( $link_food_2['url'] ) ) {
                        $widget->add_render_attribute( $link_key, 'href', $link_food_2['url'] );

                        if ( $link_food_2['is_external'] ) {
                            $widget->add_render_attribute( $link_key, 'target', '_blank' );
                        }

                        if ( $link_food_2['nofollow'] ) {
                            $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        }
                    }
                    $link_attributes = $widget->get_render_attribute_string( $link_key );
                ?>
                    <div class="pxl-swiper-slide swiper-slide">
                        <div class="item-inner">
                            <?php if (!empty( $value['selected_img_2']['id'])) :
                                $thumbnail = '';
                                $img  = pxl_get_image_by_size(array(
                                    'attach_id'  => $value['selected_img_2']['id'],
                                    'thumb_size' => $img_size,
                                    'class' => 'no-lazyload',
                                ));
                                $thumbnail = $img['thumbnail'];
                                ?>
                                <div class="item-featured">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </div>
                            <?php endif; ?>
                            <div class="item-content">
                                <?php if (!empty($value['title_food_2'])) : ?>
                                    <div class="menu-title">
                                        <span>
                                            <?php echo pxl_print_html($value['title_food_2']); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($value['description_food_2'])) : ?>
                                    <div class="pxl-divider"></div>
                                    <div class="menu-description">
                                        <?php echo esc_html($value['description_food_2']); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($value['button_food'])) : ?>
                                    <div class="button-menu">
                                        <?php if (!empty( $value['link_food_2']['url'])) : ?>
                                            <a class="btn btn-outline-secondary-2" <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                            <?php endif; ?>
                                            <span><?php echo esc_html($value['button_food']); ?></span>
                                            <?php if (!empty( $value['link_food_2']['url'])) : ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="box-title">
                                <?php if (!empty($value['title_food_2'])) : ?>
                                    <div class="menu-title">
                                        <span>
                                            <?php echo pxl_print_html($value['title_food_2']); ?>
                                        </span>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
            <?php  basilico_arrow_template($settings); ?>
            <div class="pxl-swiper-dots"></div>
        </div>
    </div>
<?php endif; ?>