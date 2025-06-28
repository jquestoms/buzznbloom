<?php
$carousel_id = "";
if (!empty($widget->get_setting('carousel_ids'))){
    $carousel_id = $widget->get_setting('carousel_ids');
}
?>
<div class="pxl-navigation-carousel <?php echo esc_attr($settings['nav_style']);?>" data-id="<?php echo esc_attr($carousel_id); ?>">
    <span class="nav-button nav-prev"><span class="pxli-arrow-left"></span></span>
    <span class="nav-button nav-next"><span class="pxli-arrow-right"></span></span>
</div>