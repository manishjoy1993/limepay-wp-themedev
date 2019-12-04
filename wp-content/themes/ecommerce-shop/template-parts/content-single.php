<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package eCommerce_Shop
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<figure class="featured-image">
		<a href="<?php the_permalink()?>">
			<?php the_post_thumbnail();?>
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
				<h2 class="entry-title"><?php the_title()?></h2>
		</header>
		<div class="entry-content">
			<?php the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ecommerce-shop' ),
				'after'  => '</div>',
			) );?>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
