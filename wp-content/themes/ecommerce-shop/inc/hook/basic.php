<?php
/**
 * Load BASIC Function.
 *
 * @package eCommerce_Shop
 */

if ( ! function_exists( 'ecommerce_shop_fonts_url' ) ) {
	/**
	 * Register Google fonts.
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function ecommerce_shop_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/* translators: If there are characters in your language that are not supported by Barlow, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Open Sans: on or off', 'ecommerce-shop' ) ) {
			$fonts[] = 'Open Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i';
		}
		/* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Oswald: on or off', 'ecommerce-shop' ) ) {
			$fonts[] = 'Oswald:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), '//fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
}


if( ! function_exists( 'ecommerce_shop_primary_navigation_fallback' ) ) :

    /**
     * Fallback for primary navigation.
     */
    function ecommerce_shop_primary_navigation_fallback() {
        echo '<ul>';
        echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'ecommerce-shop' ). '</a></li>';
        wp_list_pages( array(
            'title_li' => '',
            'depth'    => 1,
            'number'   => 7,
        ) );
        echo '</ul>';

    }

endif;

if ( ! function_exists( 'ecommerce_shop_navigation' ) ) :
	/**
	 * Posts navigation.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_shop_navigation() {
		$pagination_option = ecommerce_shop_get_option('pagination_option');

		if ( 'default' == $pagination_option) {
			the_posts_navigation();	
		} else{
			the_posts_pagination( array(
				'mid_size' => 5,
				'prev_text' => __( 'PREV', 'ecommerce-shop' ),
				'next_text' => __( 'NEXT', 'ecommerce-shop' ),
				) );
		}
	}

endif;
add_action( 'ecommerce_shop_action_navigation', 'ecommerce_shop_navigation' );

if ( ! function_exists( 'ecommerce_shop_is_woocommerce_active' ) ) :

	/**
	 * Check if WooCommerce is active.
	 *
	 * @since 1.0.0
	 *
	 * @return bool Active status.
	 */
	function ecommerce_shop_is_woocommerce_active() {
		$output = false;

		if ( class_exists( 'WooCommerce' ) ) {
			$output = true;
		}

		return $output;
	}

endif;

/**
 *  eCommerce Shop Breadcrumb
 *
 *
 */
if ( ! function_exists( 'ecommerce_shop_breadcrumb' ) ) :

    /**
     * Simple breadcrumb.
     *
     * @since 1.0.0
     *
     * @link: https://gist.github.com/melissacabral/4032941
     *
     * @param  array $args Arguments
     */
    function ecommerce_shop_breadcrumb( $args = array() ) {

        if ( ! function_exists( 'breadcrumb_trail' ) ) {
            require_once get_template_directory() . '/inc/breadcrumbs.php';
        }

        $enable_breadcrumb = ecommerce_shop_get_option('enable_breadcrumb');

        if( false == $enable_breadcrumb ){
        	return;
        }

        $breadcrumb_args = array(
            'container'   => 'div',
            'show_browse' => false,
        );
        breadcrumb_trail( $breadcrumb_args );
       
    }

endif;

if ( ! function_exists( 'ecommerce_shop_header_image' ) ) :
	/**
	 * Header Image codes
	 *
	 * @since ecommerce_shop 1.0.0
	 *
	 */
	function ecommerce_shop_header_image() {

		$header_image = ecommerce_shop_get_option( 'header_image' );
		if ( 'none' == $header_image ){
			return;
		}		 

		$image = get_header_image();
		if ( 'post-thumbnail' == $header_image  ){
			if ( is_singular() ) :				 
				$image = ( has_post_thumbnail() ) ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : $image;
			endif;
		} else{
			
			$image = ! empty( $image ) ? get_header_image() : '';
		}
		?>
			<div class="page-title-wrap-left" style="background-image: url(<?php echo esc_url( $image ) ?>);">
				
			</div>
		<?php
	}
endif;