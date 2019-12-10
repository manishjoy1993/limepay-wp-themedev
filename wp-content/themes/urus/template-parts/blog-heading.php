<?php

$blog_heading_style = Urus_Helper::get_option('blog_heading_style','banner');
$page_heading_background_css ='';
if( is_page()){
    $page_heading_background = get_post_meta(get_the_ID(),'page_heading_background',true);

    $blog_heading_style =  Urus_Helper::get_post_meta(get_the_ID(),'page_heading_style','banner');

    if($blog_heading_style =='banner'){
        if( isset($page_heading_background['color']) && $page_heading_background['color']!=''){
            $page_heading_background_css .= 'background-color: '.$page_heading_background['color'].';';
        }
        if( isset($page_heading_background['image']) && $page_heading_background['image']!=''){
            $page_heading_background_css .= ' background-image: url("'.$page_heading_background['image'].'");';
        }
        if( isset($page_heading_background['repeat']) && $page_heading_background['repeat']!=''){
            $page_heading_background_css .= ' background-repeat: '.$page_heading_background['repeat'].';';
        }
        if( isset($page_heading_background['position']) && $page_heading_background['position']!=''){
            $page_heading_background_css .= ' background-position: '.$page_heading_background['position'].';';
        }
        if( isset($page_heading_background['attachment']) && $page_heading_background['attachment']!=''){
            $page_heading_background_css .= ' background-attachment: '.$page_heading_background['attachment'].';';
        }
        if( isset($page_heading_background['size']) && $page_heading_background['size']!=''){
            $page_heading_background_css .= ' background-size:'.$page_heading_background['size'].';';
        }
    }


}
?>
<div style="<?php echo esc_attr($page_heading_background_css);?>" class="blog-heading <?php echo esc_attr($blog_heading_style);?>">
    <div class="inner">
        <?php if ( is_home() ) : ?>
            <?php if( is_front_page()):?>
                <h1 class="page-title blog-title"><?php esc_html_e('Latest Posts','urus');?></h1>
            <?php else:?>
                <h1 class="page-title blog-title"><?php single_post_title(); ?></h1>
            <?php endif;?>
        <?php elseif( is_single() ):?>
            <h1  class="page-title"><?php the_title(); ?></h1>
        <?php elseif(is_page()):?>
            <h1  class="page-title"><?php the_title(); ?></h1>
        <?php elseif(is_search()):?>
            <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'urus' ), get_search_query() ); ?></h1>
        <?php else:?>
            <h1  class="page-title"><?php the_archive_title( '', '' );; ?></h1>
            <?php
            the_archive_description( '<div class="taxonomy-description">', '</div>' );
            ?>
        <?php endif;?>
        <?php do_action('urus_blog_breadcrumbs');?>
    </div>
</div>
