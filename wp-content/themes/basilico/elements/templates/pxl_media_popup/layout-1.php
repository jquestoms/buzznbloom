<div class="pxl-media-popup">
    <div class="media-content-inner">
        <a class="media-play-button <?php echo esc_attr($settings['icon_style']); ?> <?php echo esc_attr($settings['media_type']); ?>"
        href="<?php echo esc_url($settings['media_link']['url']);?>">
            <?php if ($settings['media_style'] == 'featured-video') : ?>
                <i class="pxli-play-2"></i>
            <?php elseif ($settings['media_style'] == 'featured-audio') :?>
                <i class="pxli-volume"></i>
            <?php endif; ?>
        </a>
        <?php if (!empty($settings['description_text'])) : ?>
            <p class="button-text"><?php pxl_print_html(nl2br($settings['description_text'])); ?></p>
        <?php endif; ?>
    </div>
</div>