<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eCommerce_Shop
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $image = '';
	if ( !has_post_thumbnail() ){
		$image = 'no-image';
	} 
	?>	

	<figure class="featured-image <?php echo esc_attr( $image );?>">
		<a href="<?php the_permalink()?>">
			<?php the_post_thumbnail( 'large' );?>
		</a>
	</figure>
	<div class="post-content">
		<div class="entry-meta">
			<?php
			ecommerce_shop_entry_category();
			ecommerce_shop_posted_on();
			?>
		</div>
		<header class="entry-header">
				<h2 class="entry-title"><a href="<?php the_permalink();?>"><?php the_title()?></a>
				</h2>
		</header>
		<div class="entry-content">
			<?php
                $excerpt = ecommerce_shop_the_excerpt( 30 );
                echo wp_kses_post( wpautop( $excerpt ) );
            ?>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->