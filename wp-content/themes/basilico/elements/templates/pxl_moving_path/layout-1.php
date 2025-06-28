<?php
$moving_duration = !empty($settings['moving_duration']) ? $settings['moving_duration'] : '20';
$thumbnail = '';
if( ! empty( $settings['selected_img']['id'] ) ){
    $img  = pxl_get_image_by_size( array(
        'attach_id'  => $settings['selected_img']['id'],
        'thumb_size' => 'full',
    ) );
    $thumbnail = $img['thumbnail'];
}
?>
<div class="pxl-moving-path layout-1" data-duration="<?php echo esc_attr($moving_duration); ?>">
    <?php if(! empty( $settings['selected_svg']['value'] )): ?>
        <?php \Elementor\Icons_Manager::render_icon( $settings['selected_svg'], [ 'aria-hidden' => 'true', 'class' => 'pxl-fancy-icon pxl-icon' ], 'i' );?>
    <?php endif; ?>
    <div class="target-wrap">
        <?php echo wp_kses_post($thumbnail); ?>
    </div>
</div>
 



