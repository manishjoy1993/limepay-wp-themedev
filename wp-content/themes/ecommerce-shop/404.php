<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package eCommerce_Shop
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<div class="page-header-left" style="background-image: url(<?php echo esc_url(get_template_directory_uri());?>/image/404-bg.jpg);">
					</div>
					<div class="page-header-middle">
						<img src="<?php echo esc_url(get_template_directory_uri());?>/image/404img.png" alt="">
					</div>
					<div class="page-header-right">
						<div class="product-main">
							<div class="product-list-info">
								<header class="entry-header">
									<h2 class="entry-title"><?php esc_html_e( 'Sorry, The page not found.', 'ecommerce-shop' ); ?></h2>
								</header>
								<a class="product-button" href="<?php echo esc_url( home_url() ); ?>"><span><?php esc_html_e( 'Back to Home.', 'ecommerce-shop' ); ?></span></a>
							</div>
						</div>
					</div>
				</header><!-- .page-header -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
