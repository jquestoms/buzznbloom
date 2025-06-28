<?php
/**
 * @package Basilico
 */
 
if ( post_password_required() )
    return;
$post_comment = basilico()->get_theme_opt('post_comments_on', '1');
$wrap_class = 'comments-area no-comments';
if(have_comments()) $wrap_class = 'comments-area';

if(is_page()) $wrap_class .= ' page-comment';

if($post_comment == '1'):
?>
    <div id="comments" class="<?php echo esc_attr($wrap_class);?>">
        <?php
        if ( have_comments() ) : ?>
            <div class="comment-list-wrap">
                <h4 class="comments-title"><?php esc_html_e('Comments', 'basilico'); ?></h4>
                  
                <ol class="commentlist">
                    <?php
                        wp_list_comments( array(
                            'style'      => 'ul',
                            'short_ping' => true,
                            'callback'   => [basilico()->comment, 'comment_list'],
                            'max_depth'  => 3
                        ) );
                    ?>
                </ol>
                <nav class="navigation comments-pagination empty-none"><?php 
                    //the_comments_navigation(); 
                    paginate_comments_links([
                        'prev_text' => '<span class="pxli-angle-left"></span>',
                        'next_text' => '<span class="pxli-angle-left"></span>'
                    ]); 
                ?></nav> 
 
            </div>
            <?php if ( ! comments_open() ) : ?>
                <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'basilico' ); ?></p>
            <?php
            endif;

        endif;
       
        comment_form(basilico()->comment->comment_form_args()); ?>
</div>

<?php endif; 