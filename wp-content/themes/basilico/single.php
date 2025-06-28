<?php
/**
 * @package Basilico
 */
get_header();

$theme_post_style = basilico()->get_theme_opt('single_post_layout', 'layout-1');
$page_post_style  = basilico()->get_page_opt('single_post_layout', '-1');
$post_style = esc_attr($page_post_style) == '-1' ? $theme_post_style : $page_post_style;

$pxl_sidebar = basilico()->get_sidebar_args(['type' => 'post', 'content_col' => '8']); // type: blog, post, page, shop, product
?>
    <div class="container">
        <div class="row <?php echo esc_attr($pxl_sidebar['wrap_class']) ?>">
            <div id="pxl-content-area" class="<?php echo esc_attr($pxl_sidebar['content_class']) ?>">
                <main id="pxl-content-main" class="pxl-content-main <?php echo esc_attr($post_style); ?> <?php echo esc_attr($pxl_sidebar['sidebar_class']) ? '' : 'no-sidebar' ;?>">
                    <?php while (have_posts()) {
                        the_post();
                        get_template_part( 'template-parts/content/content-single-'.$post_style, get_post_format());
                        if (comments_open() || get_comments_number()) {
                            comments_template();
                        }
                    } ?>
                </main>
            </div>
            <?php if ($pxl_sidebar['sidebar_class']) : ?>
                <div id="pxl-sidebar-area" class="<?php echo esc_attr($pxl_sidebar['sidebar_class']) ?>">
                    <div class="sidebar-sticky-wrap">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer();
