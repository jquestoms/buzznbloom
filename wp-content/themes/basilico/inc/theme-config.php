<?php
// make some configs
if(!function_exists('basilico_configs')){
    function basilico_configs($value){
        $heading_font = '\'Cormorant Infant\', sans-serif';
        $body_font    = '\'DM Sans\', sans-serif';
        $configs = [
            'theme_colors' => [
                'primary'   => [
                    'title' => esc_html__('Primary', 'basilico'),
                    'value' => basilico()->get_opt('primary_color', '#e6c9a2')
                ],
                'secondary'   => [
                    'title' => esc_html__('Secondary', 'basilico'),
                    'value' => basilico()->get_opt('secondary_color', '#0e1927')
                ],
                'additional01'   => [
                    'title' => esc_html__('Additional Color', 'basilico'),
                    'value' => basilico()->get_opt('additional_color_01', '#fbf5ee')
                ],
                'divider'   => [
                    'title' => esc_html__('Divider Color', 'basilico'),
                    'value' => basilico()->get_opt('divider_color', '#c8c8c8')
                ],
                'body'     => [
                    'title' => esc_html__('Body', 'basilico'),
                    'value' => basilico()->get_opt('font_body', ['color' => '#666666'],'color')
                ],
                'heading'     => [
                    'title' => esc_html__('Heading', 'basilico'),
                    'value' => basilico()->get_opt('font_heading', ['color' => '#080f19'],'color')
                ],
            ],
            'link' => [
                'color' => basilico()->get_opt('link_color', ['regular' => 'inherit'],'regular'),
                'color-hover'   => basilico()->get_opt('link_color', ['hover' => '#0e1927'],'hover'),
                'color-active'  => basilico()->get_opt('link_color', ['active' => '#0e1927'],'active'),
            ],
            'gradient' => [
                'gradient01' => [
                    'color-from' => basilico()->get_opt('gradient_color_01', ['from' => '#e8411d'])['from'],
                    'color-to' => basilico()->get_opt('gradient_color_01', ['to' => '#faac52'])['to'],
                    'angle' => basilico()->get_opt('gradient_color_01', ['gradient-angle' => '51'])['gradient-angle'].'deg',
                ],
                'gradient02' => [
                    'color-from' => basilico()->get_opt('gradient_color_02', ['from' => '#443b7f'])['from'],
                    'color-to' => basilico()->get_opt('gradient_color_02', ['to' => '#7b7bcf'])['to'],
                    'angle' => basilico()->get_opt('gradient_color_02', ['gradient-angle' => '180'])['gradient-angle'].'deg',
                ],
            ],
            'custom_sizes' => [
                'size-post-single'      => [800, 442, true],
                'size-recent-post'      => [400, 432, true],
            ],
            'body' => [
                'bg'                => '#fff',
                'font-family'       => basilico()->get_theme_opt('font_body',['font-family' => $body_font], 'font-family'),
                'font-size'         => basilico()->get_theme_opt('font_body',['font-size' => '15px'], 'font-size'),
                'font-weight'       => basilico()->get_theme_opt('font_body',['font-weight' => '400'], 'font-weight'),
                'line-height'       => basilico()->get_theme_opt('font_body',['line-height' => '1.66666666667'], 'line-height'),
                'letter-spacing'    => basilico()->get_theme_opt('font_body',['letter-spacing' => '0.01em'], 'letter-spacing'),
            ],
            'heading' => [
                'font-family'       => basilico()->get_theme_opt('font_heading',['font-family' => $heading_font], 'font-family'),
                'font-weight'       => basilico()->get_theme_opt('font_heading',['font-weight' => '700'], 'font-weight'),
                'text-transform'    => basilico()->get_theme_opt('font_heading',['text-transform' => 'none'], 'text-transform'),
                'line-height'       => basilico()->get_theme_opt('font_heading',['line-height' => '1.18'], 'line-height'),
                'letter-spacing'    => basilico()->get_theme_opt('font_heading',['letter-spacing' => '0.05em'], 'letter-spacing'),
                'color-hover'      => 'var(--primary-color)',
            ],
            'heading_font_size' => [
                'h1' => basilico()->get_theme_opt('font_h1','50px'),
                'h2' => basilico()->get_theme_opt('font_h2','40px'),
                'h3' => basilico()->get_theme_opt('font_h3','30px'),
                'h4' => basilico()->get_theme_opt('font_h4','25px'),
                'h5' => basilico()->get_theme_opt('font_h5','22px'),
                'h6' => basilico()->get_theme_opt('font_h6','16px')
            ],
            'header' => [
                'height' => '81px' // use for default header
            ],
            'logo' => [
                'mobile_width' => basilico()->get_opt('logo_mobile_size', ['width' => '193px', 'units' => 'px'])['width'],
            ],
            'border' => [
                'color'          => '#dadada',
            ],
            'divider' => [
                'color'          => basilico()->get_opt('divider_color', '#c8c8c8'),
            ],
            // Menu Color
            'menu' => [
                'bg'          => '#fff',
                'regular'     => 'var(--heading-color)',
                'hover'       => 'var(--heading-color)',
                'active'      => 'var(--heading-color)',
                'font_size'   => '17px',
                'font_weight' => 700,
                'font_family' => $heading_font
            ],
            'dropdown' => [
                'bg'            => 'var(--secondary-color)',
                'shadow'        => '0 0 4px rgba(0, 0, 0, 0.8)',
                'regular'       => '#FFF',
                'hover'         => 'var(--primary-color)',
                'active'        => 'var(--primary-color)',
                'font_size'     => '15px',
                'font_weight'   => '700',
                'item_bg'       => 'transparent',
                'item_bg_hover' => '#ffffff'
            ],
            'mobile_menu' => [
                'regular' => 'var(--heading-color)',
                'hover'   => 'var(--primary-color)',
                'active'  => 'var(--primary-color)',
                'font_size'   => '15px',
                'font_weight' => 500,
                'font_family' => $heading_font,
                'item_bg'       => 'transparent',
                'item_bg_hover' => 'transparent',
                'text_transform' => 'capitalize' 
            ],
            'mobile_submenu' => [
                'regular' => 'var(--heading-color)',
                'hover'   => 'var(--primary-color)',
                'active'  => 'var(--primary-color)',
                'font_size'     => '14px', 
                'font_weight' => 400, 
                'font_family' => $body_font,
                'item_bg'       => 'transparent',
                'item_bg_hover' => 'transparent',
                'text_transform' => 'capitalize' 
            ],
            'button' => [
                'font-family'        => $body_font,
                'font-size'          => '13px',
                'font-weight'        => '400',
                'letter-spacing'     => '0.15em',
                'padding'            => '9px 32px',
                'radius'             => '0',
                'radius-rtl'         => '0',
                'line-height'        => '24px',
            ],
            //* Input
            'input' => [
                'bg'                => basilico()->get_opt('input_bg_color', '#fff'),
                'bg-hover'          => basilico()->get_opt('input_bg_hover', '#fff'),
                'border-color'      => basilico()->get_opt('input_border', '#0e1618'),
                'border-hover'      => basilico()->get_opt('input_border_hover', '#0e1618'),
                'height'            => basilico()->get_opt('input_height', ['height' => '44px', 'units' => 'px'])['height'],
                'border-radius'     => basilico()->get_opt('input_border_radius2', ['width' => '0px', 'units' => 'px'])['width'],
                'font-family'       => basilico()->get_theme_opt('font_input', ['font-family' => $body_font], 'font-family'),
                'font-size'         => basilico()->get_theme_opt('font_input', ['font-size' => '15px'], 'font-size'),
                'font-weight'       => basilico()->get_theme_opt('font_input', ['font-weight' => '400'], 'font-weight'),
                'line-height'       => basilico()->get_theme_opt('font_input', ['line-height' => '1.66666666667'], 'line-height'),
                'letter-spacing'    => basilico()->get_theme_opt('font_input', ['letter-spacing' => '0.01em'], 'letter-spacing'),
                'padding-left'      => basilico()->get_theme_opt('input_padding', ['padding-left' => '20px', 'units' => 'px'])['padding-left'],
                'padding-right'     => basilico()->get_theme_opt('input_padding', ['padding-right' => '20px', 'units' => 'px'])['padding-right'],
            ],
        ];

        return $configs[$value];
    }
}
if(!function_exists('basilico_inline_styles')){
    function basilico_inline_styles() {
        $body              = basilico_configs('body');
        $theme_colors      = basilico_configs('theme_colors');
        $link_color        = basilico_configs('link');
        $gradient_colors   = basilico_configs('gradient');
        $heading           = basilico_configs('heading');
        $heading_font_size = basilico_configs('heading_font_size');
        $input             = basilico_configs('input');
        $logo              = basilico_configs('logo');
        ob_start();
        echo ':root{';
        foreach ($theme_colors as $color => $value) {
            printf('--%1$s-color: %2$s;', $color,  $value['value']);
        }
        foreach ($theme_colors as $color => $value) {
            printf('--%1$s-color-rgb: %2$s;', $color,  basilico_hex_rgb($value['value']));
        }
        foreach ($link_color as $color => $value) {
            printf('--link-%1$s: %2$s;', $color, $value);
        }
        foreach ($gradient_colors as $color => $value) {
            printf('--%1$s-color-from: %2$s;', $color,  $value['color-from']);
            printf('--%1$s-color-to: %2$s;', $color,  $value['color-to']);
            printf('--%1$s-angle: %2$s;', $color,  $value['angle']);
        }
        foreach ($body as $key => $value) {
            printf('--body-%1$s: %2$s;', $key, $value);
        }
        foreach ($heading as $key => $value) {
            printf('--heading-%1$s: %2$s;', $key, $value);
        }
        foreach ($heading_font_size as $key => $value) {
            printf('--heading-font-size-%1$s: %2$s;', $key, $value);
        }
        foreach ($logo as $key => $value) {
            printf('--logo-%1$s: %2$s;', $key, $value);
        }
        foreach ($input as $key => $value) {
            printf('--input-%1$s: %2$s;', $key, $value);
        }
        echo '}';
        return ob_get_clean();

    }
}
 