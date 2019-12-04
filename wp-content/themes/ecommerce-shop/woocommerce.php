<?php
/**
 * The template for displaying woocommerce section.
 *
 * @package eCommerce_Shop
 */

get_header();
?>
<div class="container clearfix">
	<div class="woocommerce-shop-wrapper">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<?php woocommerce_content(); ?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php  
			get_sidebar( 'shop' );			
		?>
	</div>
	<?php if( is_shop() ): ?>
		<div class="woocommerce-best-seller">
			<?php if ( is_active_sidebar( 'best-seller-shop' ) ):
				dynamic_sidebar( 'best-seller-shop' );
			endif;?>
		</div>
	<?php endif; ?>
	
</div>
<?php
get_footer();