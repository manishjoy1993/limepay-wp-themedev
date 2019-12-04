<?php
/**
 * Custom theme functions.
 *
 * This file contains hook functions attached to theme hooks.
 *
 * @package eCommerce_Shop
 */

if ( ! function_exists( 'ecommerce_shop_site_branding' ) ) :
	/**
	 * Site branding 
 	 *
	 * @since 1.0.0
	 */
function ecommerce_shop_site_branding() {
	?>
	<div class="site-branding">
    	<?php $site_identity  = ecommerce_shop_get_option( 'site_identity' );
    	if ( in_array( $site_identity, array( 'logo-only', 'logo-text','logo-title' ) )  ) { ?>
    		<div class="site-logo">
    			<?php the_custom_logo(); ?> 
    		</div>
		<?php } ?>

		<?php if ( in_array( $site_identity, array( 'title-text', 'title-only', 'logo-text','logo-title' ) ) ) : ?>
			<?php
			if( in_array( $site_identity, array( 'title-text', 'title-only','logo-title' ) )  ) {
				if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;
			} 
			if ( in_array( $site_identity, array( 'title-text', 'logo-text' ) ) ) {
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
				<?php
				endif; 
			}?>
		<?php endif; ?>
	</div><!-- .site-branding -->	
	<?php 
}
endif;
add_action( 'ecommerce_shop_action_header', 'ecommerce_shop_site_branding', 10 );

if ( ! function_exists( 'ecommerce_shop_main_navigation' ) ) :
	/**
	 * Main navigation
 	 *
	 * @since 1.0.0
	 */
function ecommerce_shop_main_navigation() {
	?>
	<nav id="site-navigation" class="main-navigation">	
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'fallback_cb' => 'ecommerce_shop_primary_navigation_fallback',
			) );
			?>
	</nav><!-- #site-navigation -->
	<?php 
}
endif;
add_action( 'ecommerce_shop_action_header', 'ecommerce_shop_main_navigation', 15 );

if ( ! function_exists( 'ecommerce_shop_header_information' ) ) :
	/**
	 * Header Information 
 	 *
	 * @since 1.0.0
	 */
function ecommerce_shop_header_information() {
	?>
	<div class="header-information">
		<div class="header-information-inner">
			<?php if ( ecommerce_shop_is_woocommerce_active() ): 
				$cart_header = ecommerce_shop_get_option('cart_header');
				if ( true == $cart_header ): ?>
					<div class="site-cart-views">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						<span class="cart-quantity"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
						<div class="widget widget_shopping_cart">	
							<div class="mini_cart_inner">					
							<?php the_widget( 'WC_Widget_Cart', '' ); ?>
							</div>						
						</div>
					</div>	
				<?php endif; ?>		

				<?php $login_header = ecommerce_shop_get_option('login_header');
				if ( true == $login_header ): ?>
					<div class="user-info">
						<?php if( ! is_user_logged_in() ): ?>
							<a class="user-info-pop btn" href="#">
							<i class="fa fa-user"></i>
							<span><?php echo esc_html__( 'login', 'ecommerce-shop' );?></span>
							</a>
							<div class="user-info-dialogue">
								<div class="user-info-dialogue-inner">
									<div class="close-wrap"><a class="popup-close"  href="#"><?php echo esc_html__( 'X', 'ecommerce-shop');?></a></div>
									<div class="main-info-wrap clearfix">
										<div class="figure-info-wrap">
											<figure>
											<img src="<?php echo esc_url(get_template_directory_uri());?>/image/popup.jpg" alt="logo">
											</figure>
											<div class="wc-content">
												<span>
													<?php $description = get_bloginfo( 'description', 'display' );
													if ( $description || is_customize_preview() ) : ?>
														<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
													<?php endif; ?>									
												</span>
											</div>
										</div>
										<div class="info-register">
											<?php echo do_shortcode( '[woocommerce_my_account]');?>
										</div>
									</div>
								</div>
							</div>
						<?php else: ?>
							<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
	                            <i class="fa fa-user"></i><span><?php esc_html_e('My Account', 'ecommerce-shop'); ?></span>
	                        </a>
						<?php endif; ?>
					</div>
				<?php endif; ?>

			<?php endif; ?>

			<?php $search_header = ecommerce_shop_get_option('search_header');
			if ( true == $search_header ): ?>
				<div class="header-search-icon">
					<i class="fa fa-search"></i>
					<form class="search-input" id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?> ">					
						<input class="search-field" placeholder="<?php echo esc_attr_x( 'what are you searching for? &hellip;', 'placeholder', 'ecommerce-shop' ); ?>" value="<?php echo get_search_query(); ?>" name="s" type="search">
						<input class="search-submit" value="<?php echo esc_attr__( 'Find!', 'ecommerce-shop')?>" type="submit">
					</form>
				</div>
			<?php endif; ?>
		</div>
	</div><!-- header-information -->
	<?php 
}
endif;
add_action( 'ecommerce_shop_action_header', 'ecommerce_shop_header_information', 20 );

if ( ! function_exists( 'ecommerce_shop_top_footer' ) ) :
	/**
	 * Footer Menu
 	 *
	 * @since 1.0.0
	 */
function ecommerce_shop_top_footer() {
	?>
    <?php $info_secton = ecommerce_shop_get_option('footer_info_secton'); 
    $info_secton = json_decode( $info_secton );
    if ($info_secton ): 
	?>
		<div class="top-footer">
			<div class="container">
				<div class="top-footer-inner-wrap clearfix">
	                <?php foreach ($info_secton as  $footer_info) {
	            	$icon = $footer_info->icon;
	                $title  = $footer_info->title;
	                $info  = $footer_info->info;
	                if ( !empty( $icon) || !empty( $title) || !empty( $info ) ):	
	                ?>		

						<div class="top-footer-item">
							<div class="footor-icon"><i class="<?php echo esc_attr( $icon );?>"></i></div>
							<div class="top-footor-content">
								<h4><?php echo esc_html( $title );?></h4>
								<?php if (!empty( $info ) ): ?>
									<span class="info"><?php echo esc_html( $info );?></span>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; 
					} ?>

				</div>
			</div>
		</div>
	<?php endif;
}
endif;
add_action( 'ecommerce_shop_action_footer', 'ecommerce_shop_top_footer', 10 );

if ( ! function_exists( 'ecommerce_shop_footer_widget' ) ) :
	/**
	 * Footer Widget
 	 *
	 * @since 1.0.0
	 */
function ecommerce_shop_footer_widget() {
	?>

		<div class="bottom-footor clearfix">
			<div class="footer-content">
				<?php if ( is_active_sidebar( 'footer-1' ) ): ?>
					<div class="footer-content-inner left">
						<div class="container">
							<?php dynamic_sidebar( 'footer-1' );?>
						</div>
					</div>
				<?php endif; ?>
				<?php if ( is_active_sidebar( 'footer-2' ) ): ?>
					<div class="footer-content-inner right">
						<div class="right-footer-wrap">
							<?php dynamic_sidebar( 'footer-2' );?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div><!-- bottom-footer-->
	<?php 
}
endif;
add_action( 'ecommerce_shop_action_footer', 'ecommerce_shop_footer_widget', 15 );

if ( ! function_exists( 'ecommerce_shop_footer_copyright' ) ) :
	/**
	 * Footer Copyright
 	 *
	 * @since 1.0.0
	 */
function ecommerce_shop_footer_copyright() {
	?>
	<div class="site-info ">
		<div class="container clearfix">
			<div class="site-info-left">
				<?php 
					$copyright_footer = ecommerce_shop_get_option( 'copyright_text' ); 

					// Powered by content.
					$powered_by_text = sprintf( __( 'Theme of %s', 'ecommerce-shop' ), '<a target="_blank" rel="designer" href="'.esc_url( 'https://theme404.com/' ).'">'. esc_html__( 'Theme404', 'ecommerce-shop' ). '</a>' ); 
				?>				
				<?php echo wp_kses_post( $powered_by_text );?>&nbsp;
				<?php echo esc_html( $copyright_footer ); ?>
			</div>
			<div class="site-info-right">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer-menu',
					'depth'          => 1,
					'fallback_cb'    => false,
				) );
				?>
			</div>
		</div>
	</div><!-- .site-info -->
	<?php 
}
endif;
add_action( 'ecommerce_shop_action_footer', 'ecommerce_shop_footer_copyright', 20 );

if ( ! function_exists( 'ecommerce_shop_breadcrumb_trail' ) ) :
	/**
	 * Breadcrumb Trail
 	 *
	 * @since 1.0.0
	 */
function ecommerce_shop_breadcrumb_trail() {	
    // Bail if Home Page.
    if ( is_front_page() || is_home() || is_404() ) {
        return;
    }	
    $header_image = ecommerce_shop_get_option( 'header_image' );
    $enable_breadcrumb = ecommerce_shop_get_option('enable_breadcrumb');
    if ( false == $enable_breadcrumb && 'none' == $header_image ){
    	return;
    }
    ?>
		<div class="page-title-wrap">
			<?php ecommerce_shop_header_image();?>
			<div class="page-title-wrap-right">
				<?php ecommerce_shop_breadcrumb(); ?>
			</div>
		</div>	
	<?php 
}
endif;
add_action( 'ecommerce_shop_action_breadcrumb_trail', 'ecommerce_shop_breadcrumb_trail' );