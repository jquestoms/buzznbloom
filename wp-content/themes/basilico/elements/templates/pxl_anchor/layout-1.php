<?php
$template = (int)$widget->get_setting('template',0);
$is_fullwidth = esc_attr($settings['is_fullwidth']) == 'yes' ? 'btn-fullwidth' : '';
$widget->add_render_attribute('anchor', 'class', 'pxl-anchor side-panel d-flex align-items-center'.' '.$is_fullwidth);
$target = '.pxl-hidden-template-'.$template;
if($template > 0 ){
    if ( !has_action( 'pxl_anchor_target_hidden_panel_'.$template) ){
        add_action( 'pxl_anchor_target_hidden_panel_'.$template, 'basilico_hook_anchor_hidden_panel' );
    }

}else{
    add_action( 'pxltheme_anchor_target', 'basilico_hook_anchor_custom' );
}

$custom_cls = $widget->get_setting('custom_class','');
$btn_style = $settings['style_button'];
$widget->add_render_attribute( 'button', 'class', 'btn '.esc_attr($btn_style).' '.$is_fullwidth);
?>
<div class="pxl-anchor-wrap d-flex align-items-center align-content-center <?php echo esc_attr($custom_cls);?>">
	<a href="#pxl-<?php echo esc_attr($template)?>" <?php pxl_print_html($widget->get_render_attribute_string( 'anchor' )); ?> data-target="<?php echo esc_attr($target)?>">
	    <?php 
	    if( $widget->get_setting('icon_type','none') == 'lib'){
	    	echo '<div class="pxl-anchor-icon d-inline-flex">';
	    	\Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true', 'class' => '' ], 'span' );
	    	echo '</div>';
	    }
	    if($widget->get_setting('icon_type','none') == 'custom'){
	    	echo '<div class="pxl-icon pxl-anchor-icon custom"><span></span><span></span><span></span></div>';
	    }
	    if($widget->get_setting('icon_type', 'none') == 'custom-2'){
	    	echo '<div class="pxl-icon pxl-anchor-icon custom-2"><span></span><span></span><span></span><span></span></div>';
	    }
	    if($widget->get_setting('icon_type', 'none') == 'custom-3'){
	    	echo '<div class="pxl-icon pxl-anchor-icon custom-3"></div>';
	    }
		if($widget->get_setting('icon_type', 'none') == 'custom-4'){
	    	echo '<div class="pxl-icon pxl-anchor-icon custom-4"><span></span></div>';
		}
		if($widget->get_setting('icon_type', 'none') == 'custom-5'){
	    	echo '<div class="pxl-icon pxl-anchor-icon custom-5"><span></span><span></span><span></span></div>';
		}
		if($widget->get_setting('icon_type', 'none') == 'custom-6'){
	    	echo '<div class="pxl-icon pxl-anchor-icon custom-6"><div class="box-custom"><span></span><span></span><span></span></div><div class="pxl-close-cus"><span></span><span></span></div></div>';
		}
		if($widget->get_setting('icon_type', 'none') == 'custom-7'){
	    	echo '<div class="pxl-icon pxl-anchor-icon custom-7"><span></span><span></span></div>';
		}
		if($widget->get_setting('icon_type', 'none') == 'select-button'){
	    	?>
				<div <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?>>
                    <span class="pxl-button-text"><?php echo esc_html($settings['text_button']); ?></span>
				</div>
			<?php
		}
		
	    if(!empty($widget->get_setting('title',''))){
	    	echo '<span class="anchor-title d-inline-flex">'.$widget->get_setting('title', '').'</span>';
	    } ?>
	</a>
</div>