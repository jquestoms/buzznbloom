<?php
add_filter('woocommerce_product_data_tabs', 'pxl_nutrition_tab');
function pxl_nutrition_tab($tabs) {
    $tabs['pxl_nutrition'] = array(
        'label' => 'PXL Nutrition',
        'target' => 'pxl_nutrition_opts',
        'priority' => 65,
    );
    return $tabs;
}

add_action( 'woocommerce_product_data_panels', 'pxl_nutrition_tab_content' );
function pxl_nutrition_tab_content() {
    global $post;
    $product = wc_get_product( $post );
    ?>
    <div id="pxl_nutrition_opts" class="panel woocommerce_options_panel">
        <div class="options_group">
            <p class="form-field">
                <label for="_pxl_nutrition_title"><?php echo esc_html( 'Title: ', 'basilico' ); ?></label>
                <input type="text" name="_pxl_nutrition_title" placeholder="<?php echo esc_attr( 'Default: Nutritional Value Per 100g', 'basilico' ); ?>"
                id="_pxl_nutrition_title" value="<?php echo esc_attr($product->get_meta( '_pxl_nutrition_title')); ?>">
                <br/>
            </p>
        </div>
        <div class="options_group">
            <?php foreach(get_nutrition_opts() as $opt => $data ): ?>
                <p class="form-field">
                    <label for="_<?php echo esc_attr( $opt ); ?>"><?php echo esc_html( $data['label'] ); ?></label>
                    <input type="text" name="_<?php echo esc_attr( $opt ); ?>" placeholder="<?php echo esc_attr( $data['placeholder'] ); ?>"
                    id="_<?php echo esc_attr( $opt ); ?>" value="<?php echo esc_attr($product->get_meta( '_' . $opt )); ?>">
                </p>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}

add_action( 'woocommerce_process_product_meta', 'save_meta_box');
function save_meta_box($post_id ) {
    $product = wc_get_product($post_id );

    if (isset($_POST['_pxl_nutrition_title'])) {
        $product->update_meta_data( '_pxl_nutrition_title', sanitize_text_field($_POST[ '_pxl_nutrition_title']));
    } else {
        $product->update_meta_data( '_pxl_nutrition_title', '');
    }

    foreach ( get_nutrition_opts() as $opt => $data ) {
        if ( isset( $_POST[ '_' . $opt ] ) ) {
            $product->update_meta_data( '_' . $opt, sanitize_text_field($_POST[ '_' . $opt ] ) );
        } else {
            $product->update_meta_data( '_' . $opt, '' );
        }
    }
    $product->save();
}

add_action( 'woocommerce_single_product_summary', 'pxl_nutrition_frontend_display', 20 );
function pxl_nutrition_frontend_display() {
    global $product;

    $opts = get_nutrition_opts();
    $title      = $product->get_meta( '_pxl_nutrition_title' );

    if (empty($product->get_meta('_pxl_nutrition_calories')) && empty($product->get_meta('_pxl_nutrition_carbohydrates')) && empty($product->get_meta('_pxl_nutrition_squirrels')) && empty($product->get_meta('_pxl_nutrition_fats'))) return;
    ?>
        <div class="pxl-nutritions-wrapper">
            <h3><?php if (!empty($title)) { echo esc_attr($title); } else { echo esc_html('Nutritional Value Per 100g:', 'basilico'); } ?></h3>
            <div class="pxl-nutrition-list">
                <?php
                $i = 0;
                foreach ($opts as $opt => $value ) :
                    ?>
                    <?php if (!empty($product->get_meta( '_' . $opt ))) : ?>
                        <div class="pxl-nutrition">
                            <span class="pxl-nutrition-title"><?php echo esc_html($value['label'] ); ?></span>
                            <span class="pxl-nutrition-value"><?php echo esc_html($product->get_meta( '_' . $opt )); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php
                    $i = $i + 1;
                endforeach;
                ?>
            </div>
        </div>
    <?php
}

function get_nutrition_opts() {
    $opts = array(
        'pxl_nutrition_calories'    => array(
            'label'                 => esc_html( 'Calories: ', 'basilico' ),
            'placeholder'           => esc_html('550kcal', 'basilico'),
        ),
        'pxl_nutrition_carbohydrates' => array(
            'label'                 => esc_html( 'Carbohydrates: ', 'basilico' ),
            'placeholder'           => esc_html('50G', 'basilico'),
        ),
        'pxl_nutrition_squirrels' => array(
            'label'                 => esc_html( 'Squirrels: ', 'basilico' ),
            'placeholder'           => esc_html('50G', 'basilico'),
        ),
        'pxl_nutrition_fats' => array(
            'label'                 => esc_html( 'Fats: ', 'basilico' ),
            'placeholder'           => esc_html('20G', 'basilico'),
        ),
    );
    return $opts;
}