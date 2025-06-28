<?php
use Elementor\Utils;
?>
<div class="pxl-circle-text layout-1">
    <?php if(!empty($widget->get_setting('title'))): ?>
        <div id="circle-text" class="circle-text">
            <?php pxl_print_html( nl2br($widget->get_setting('title'))); ?>
        </div>
    <?php endif; ?>
</div>