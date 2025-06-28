<?php
use Elementor\Utils;

$widget->add_render_attribute( 'wrapper', 'class', 'pxl-button-wrapper d-flex pxl-button-layout1' );
$link_type = $settings['button_url_type'];
$is_fullwidth = esc_attr($settings['is_fullwidth']) == 'yes' ? 'btn-fullwidth' : '';
$btn_style = $settings['style'];

if(($link_type == 'url') && !empty( $settings['link']['url'])){
    $widget->add_render_attribute( 'button', 'href', $settings['link']['url'] );
    if ( $settings['link']['is_external'] ) {
        $widget->add_render_attribute( 'button', 'target', '_blank' );
    }
    if ( $settings['link']['nofollow'] ) {
        $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
    }
    if ( ! empty( $settings['link']['custom_attributes'] ) ) {
        // Custom URL attributes should come as a string of comma-delimited key|value pairs
        $custom_attributes = Utils::parse_custom_attributes( $settings['link']['custom_attributes'] );
        $widget->add_render_attribute( 'link', $custom_attributes);
    }
}
if ($link_type == 'page') {
    $page_url = get_permalink($settings['page_link']);
    $widget->add_render_attribute( 'button', 'href', $page_url );
}

$widget->add_render_attribute( 'button', 'class', 'btn '.esc_attr($btn_style).' icon-ps-'.$settings['icon_align'].' '.$is_fullwidth );
$html_id = pxl_get_element_id($settings);

if(!empty($settings['button_split_text_anm']) ){
    switch ($settings['hover_split_text_anm']) {
        case 'hover-split-text':
            $split_cls = 'pxl-split-text hover-split-text '.$settings['button_split_text_anm'];
            break;
        case 'only-hover-split-text':
            $split_cls = 'pxl-split-text-only-hover '.$settings['button_split_text_anm'];
            break;
        default:
            $split_cls = 'pxl-split-text '.$settings['button_split_text_anm'];
            break;
    }
    $widget->add_render_attribute( 'button', 'class', $split_cls );
}

?>
<div id="<?php echo esc_attr($html_id); ?>" <?php pxl_print_html($widget->get_render_attribute_string( 'wrapper' )); ?>>
    <a <?php pxl_print_html($widget->get_render_attribute_string( 'button' )); ?>>
        <?php
		$widget->add_inline_editing_attributes( 'text', 'none' );
        ?>
        <span class="pxl-button-text" data-text="<?php echo esc_attr($settings['text']); ?>"><?php echo esc_html($settings['text']); ?></span>
        <?php 
        if ( $settings['btn_icon'] ) 
            \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true', 'class' => 'pxl-button-icon pxl-icon '.$settings['icon_align'] ], 'i' ); 
        ?>
    </a>
</div>