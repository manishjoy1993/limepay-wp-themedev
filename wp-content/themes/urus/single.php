
<?php get_header(); ?>
<?php
$blog_layout = Urus_Helper::get_option('single_blog_layout','left');
$blog_used_sidebar = Urus_Helper::get_option('single_blog_used_sidebar','widget-area');
$blog_list_style = Urus_Helper::get_option('blog_list_style','classic');
$main_container_class = array('main-container');
$main_content_class   = array('main-content');
$sidebar_class   = array('sidebar');

if ( !is_active_sidebar( $blog_used_sidebar )){
    $blog_layout = 'full';
}

if( $blog_layout == 'full'){
    $main_container_class[] = 'no-sidebar';
}else{
    $main_container_class[] = $blog_layout.'-sidebar';
}

if ( $blog_layout == 'full' ) {
    $main_content_class[] = 'col-lg-12 col-md-12 col-sm-12';
} else {
    $main_content_class[] = 'col-lg-9 col-md-12 col-sm-12';
}
if ( $blog_layout != 'full' ) {
    $sidebar_class[] = 'col-lg-3 col-md-12 col-sm-12';
}

$main_container_class = apply_filters('urus_blog_main_container_class',$main_container_class);
$main_content_class = apply_filters('urus_blog_main_content_class',$main_content_class);
$sidebar_class = apply_filters('urus_blog_sidebar_class',$sidebar_class);
$blog_content_width = Urus_Helper::get_option('blog_content_width','container');

?>
<?php do_action( 'urus_before_blog_content_wrapper' ); ?>
    <div class="<?php echo esc_attr( implode( ' ', $main_container_class ) ); ?>">
        <div class="<?php echo esc_attr($blog_content_width);?>">
            <div class="clearfix urus-content-inner row">
                <div class="<?php echo esc_attr( implode( ' ', $main_content_class ) ); ?>">
                    <div class="article-content">
                        <?php if ( have_posts() ) : ?>
                            <div class="">
                                <?php
                                // Start the loop.
                                while ( have_posts() ) : the_post();

                                    /*
                                     * Include the Post-Format-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'content', 'single');

                                    // End the loop.
                                endwhile;

                                ?>
                            </div>
                            <?php

                            /*If comments are open or we have at least one comment, load up the comment template.*/
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        // If no content, include the "No posts found" template.
                        else :
                            get_template_part( 'content', 'none' );
                        endif;
                        ?>
                    </div>
                </div>
                <?php if ( $blog_layout != "full" ): ?>
                    <div class="<?php echo esc_attr( implode( ' ', $sidebar_class ) ); ?>">
                        <?php get_sidebar(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php do_action( 'urus_before_blog_content_wrapper' ); ?>
<?php get_footer(); ?>