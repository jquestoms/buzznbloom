<?php
if (!class_exists('Basilico_Page_Title')) return;
$titles = basilico()->pagetitle->get_title();
$style = $widget->get_setting('style', 'style-1');
?>

<div class="pxl-pt-wrap <?php echo esc_attr($style); ?>">
    <h1 class="main-title">
        <span><?php pxl_print_html($titles['title']) ?></span>
    </h1>
</div>