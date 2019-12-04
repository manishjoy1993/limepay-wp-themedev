<?php
/**
 * Default theme options.
 *
 * @package eCommerce_Shop
 */

if ( ! function_exists( 'ecommerce_shop_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
function ecommerce_shop_get_default_theme_options() {

	$defaults = array();
	
	$defaults['site_identity']						= 'title-text';

	/******************** Header Setting **************************************/
	$defaults['login_header']						= true;
	$defaults['cart_header']						= true;
	$defaults['search_header']						= true;

	/******************** Breadcrumbs Setting **************************************/
	$defaults['enable_breadcrumb']					= true;
	$defaults['header_image']						= 'none';

	/************************ Archive/Blog Setting ***************************************/
	$defaults['excerpt_length']						= 20;
	$defaults['enable_blog_postmeta']				= true;


	/************************ General Options ***************************************/
	$defaults['sidebar_layout']						= 'right-sidebar';
	$defaults['woo_sidebar_layout']					= 'right-sidebar';
	$defaults['pagination_option']					= 'default';
	$defaults['enable_category']					= true;
	$defaults['enable_posted_date']					= true;
	$defaults['enable_home_page_content']			= true;

	/********************Footer **************************************/
	$defaults['copyright_text']						= '';

	/**************************Contact *********************************/
	$defaults['google_map_address']					= '';


	// Pass through filter.
	$defaults = apply_filters( 'ecommerce_shop_filter_default_theme_options', $defaults );

	return $defaults;
}

endif;

/**
*  Get theme options
*/
if ( ! function_exists( 'ecommerce_shop_get_option' ) ) :

	/**
	 * Get theme option
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function ecommerce_shop_get_option( $key ) {

		$default_options = ecommerce_shop_get_default_theme_options();

		if ( empty( $key ) ) {
			return;
		}

		$theme_options = (array)get_theme_mod( 'theme_options' );
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;

	}

endif;