<?php
defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$product_id          = $product->get_id();
$item_class          = ['grid-item'];

?>
<div <?php wc_product_class( $item_class, $product ); ?>>
    <div class="pxl-shop-item-wrap">
        <div class="pxl-products-thumb relative">
            <div class="image-wrap">
                <?php
                woocommerce_template_loop_product_thumbnail();
                ?>
            </div>
            <div class="hot-sale">
                <?php
                if ( $product->is_featured() ) {
                    $feature_text = get_post_meta($product->get_id(),'product_feature_text', true);
                    if (empty($feature_text)){
                        $feature_text = "HOT";
                    }
                    ?>
                    <span class="pxl-featured"><?php echo esc_html($feature_text); ?></span>
                    <?php
                }
                woocommerce_show_product_loop_sale_flash();
                ?>
            </div>
            <div class="btn-wrapper">
                <div class="pxl-add-to-cart">
                    <?php woocommerce_template_loop_add_to_cart(); ?>
                </div>
                <?php
                if(class_exists( 'WPCleverWoosw' )){
                    echo '<div class="pxl-shop-woosmart-wrap">';
                    do_action( 'woosw_button_position_archive_woosmart' );
                    echo '</div>';
                }
                ?>
            </div>
        </div>
        <div class="pxl-products-content">
            <div class="pxl-products-content-wrap">
                <div class="pxl-products-content-inner">
                <h3 class="pxl-product-title">
                    <a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
                </h3>
                <div class="pxl-product-category">
                    <?php
                        echo wc_get_product_category_list( $product->get_id(), ', ', _n( '', '', count( $product->get_category_ids() ), 'basilico' ) . '</span>', '</span>' );
                    ?>
                </div>
                <div class="top-content-inner d-md-flex gx-30 justify-content-between">
                    <?php woocommerce_template_loop_price(); ?>
                    </div>
                    <?php
                    /**
                     * Hook: woocommerce_before_shop_loop_item_title.
                     *
                     * @hooked woocommerce_show_product_loop_sale_flash - 10
                     * @hooked woocommerce_template_loop_product_thumbnail - 10
                     */
                    do_action( 'woocommerce_before_shop_loop_item_title' );

                    /**
                     * Hook: woocommerce_shop_loop_item_title.
                     *
                     * @hooked woocommerce_template_loop_product_title - 10
                     */
                    do_action( 'woocommerce_shop_loop_item_title' );
                    /**
                     * Hook: woocommerce_after_shop_loop_item_title.
                     *
                     * @hooked woocommerce_template_loop_rating - 5
                     * @hooked woocommerce_template_loop_price - 10
                     */
                    do_action( 'woocommerce_after_shop_loop_item_title' );
                    ?>
                </div>
            </div>
        </div>
        <div class="pxl-products-content-list-view d-none">
            <h3 class="pxl-product-title">
                <a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
            </h3>
            <?php woocommerce_template_loop_price(); ?>
            <?php
            /**
             * Hook: woocommerce_before_shop_loop_item_title.
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );

            /**
             * Hook: woocommerce_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );
            ?>
            <?php
            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
            <div class="list-view-rating">
                <?php woocommerce_template_loop_rating(); ?>
                <?php
                if(class_exists( 'WPCleverWoosw' )){
                    echo '<div class="pxl-shop-woosmart-wrap">';
                    do_action( 'woosw_button_position_archive_woosmart' );
                    echo '</div>';
                }
                ?>
            </div>
            <div class="pxl-loop-product-excerpt">
                <?php the_excerpt(); ?>
            </div>
            <?php woocommerce_template_loop_add_to_cart(); ?>
        </div>
    </div>
    <?php
	/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
    ?>
</div>