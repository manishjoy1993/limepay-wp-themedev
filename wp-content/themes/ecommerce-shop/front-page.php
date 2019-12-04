<?php
/**
 * The template for displaying home page.
 *
 * @package eCommerce_Shop
 */
get_header();
	if ( 'posts' != get_option( 'show_on_front' ) ) { ?>

		<div id="primary" class="content-area ">
			<main id="main" class="site-main">

				<?php if ( is_active_sidebar( 'home-slider' ) ): 
					dynamic_sidebar( 'home-slider');
				endif; ?>

				<?php if ( is_active_sidebar( 'home-widget-area' ) ): 
					dynamic_sidebar( 'home-widget-area');
				endif; ?>

				<?php $enable_home_page_content  = ecommerce_shop_get_option( 'enable_home_page_content' );
				if ( true == $enable_home_page_content ): ?>
					<div class="home-page-wrapper container">
						<?php 
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
						?>
					</div>
				<?php endif; ?>											
			</main><!-- #main -->
		</div><!-- #primary -->
	<?php } else{ ?>	
		<div class="container clearfix">
			<div id="primary" class="content-area">
				<main id="main" class="site-main">
					<div class="post-item-wrapper">

						<?php
						if ( have_posts() ) :

							if ( is_home() && ! is_front_page() ) :
								?>
								<header>
									<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
								</header>
								<?php
							endif;

							/* Start the Loop */
							while ( have_posts() ) :
								the_post();

								/*
								 * Include the Post-Type-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_type() );

							endwhile;

							do_action( 'ecommerce_shop_action_navigation');

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>
					</div>

				</main><!-- #main -->
			</div><!-- #primary -->
			<?php get_sidebar(); ?>
		</div>
	<?php } ?>
<?php
get_footer();
