<?php
/**
 *
 * @package Basilico
 */
get_header();

$pxl_sidebar_pos = basilico()->get_theme_opt( 'blog_sidebar_pos', 'right' );
$pxl_sidebar = basilico()->get_sidebar_args(['type' => 'blog', 'content_col'=> '8']); // type: blog, post, page, shop, product
$archive_style = basilico()->get_theme_opt('archive_post_layout', 'layout-1');

?>
<div class="container">
    <div class="row <?php echo esc_attr($pxl_sidebar['wrap_class']) ?>">
        <div id="pxl-content-area" class="<?php echo esc_attr($pxl_sidebar['content_class']) ?>">
            <?php if ( have_posts() ): ?>
            <main id="pxl-content-main" class="pxl-content-main <?php echo esc_attr($archive_style); ?>">
                <?php 
                    while ( have_posts() ) {
                        the_post();
                        get_template_part( 'template-parts/content/content', 'search' );
                    }
                ?>
            </main>
            <?php 
                basilico()->page->get_pagination();
            else:
                get_template_part( 'template-parts/content/content', 'none' );
            endif; ?>
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
