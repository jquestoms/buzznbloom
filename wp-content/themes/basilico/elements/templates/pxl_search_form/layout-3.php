<?php 
$default_settings = [
    'search_type' => '1',
    'placeholder' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings); 
?>

<div class="pxl-search-wrap layout-3">
    <form method="get" class="pxl-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input type="search" class="pxl-search-field" placeholder="<?php echo esc_attr( $settings['placeholder']); ?>" value="<?php echo get_search_query(); ?>" name="s" autocomplete="off"/>
        <button type="submit" class="pxl-search-submit" value=""><span class="pxli-search-400"></span></button>
        <?php if( $search_type == '2'): ?>
            <input type="hidden" name="post_type" value="product">
        <?php endif; ?>
    </form>
</div>