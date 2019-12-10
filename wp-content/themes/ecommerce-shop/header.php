<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eCommerce_Shop
 */

?><?php
	/**
	 * Hook - ecommerce_shop_action_doctype.
	 *
	 * @hooked ecommerce_shop_doctype -  10
	 */
	do_action( 'ecommerce_shop_action_doctype' );
?>

<head>
	<?php
	/**
	 * Hook - ecommerce_shop_action_head.
	 *
	 * @hooked ecommerce_shop_head -  10
	 */
	do_action( 'ecommerce_shop_action_head' );
	?>

	<?php wp_head(); ?>
	<link rel="stylesheet" type="text/css" href="https://www.nike.com/assets/ncss/3.1/dotcom/desktop/css/ncss.en-gb.min.css">
	<link rel="stylesheet" type="text/css" href="http://demo.limepay.com.au/wordpress_498/wp-content/plugins/elementor/assets/css/frontend.min.css">
</head>

<body <?php body_class(); ?>>
	
	<?php
		/**
		 * Hook - ecommerce_shop_action_before.
		 *
		 * @hooked ecommerce_shop_page_start - 10
		 * 
		 */
		do_action( 'ecommerce_shop_action_before' );
	?>

	<?php 
		/**
		 * Hook - ecommerce_shop_action_before_header
		 *
		 * @hooked ecommerce_shop_site_branding -10
		 * @hooked ecommerce_shop_main_navigation -15
		 * @hooked ecommerce_shop_header_information -20
		 *
		 */
		do_action( 'ecommerce_shop_action_before_header' );
	?>
	<?php 
		/**
		 * Hook - ecommerce_shop_action_header
		 *
		 * @hooked ecommerce_shop_site_branding -10
		 *
		 */
		do_action( 'ecommerce_shop_action_header' );
	?>

	<?php 
		/**
		 * Hook - ecommerce_shop_action_after_header
		 *
		 * @hooked ecommerce_shop_header_end -10
		 *
		 */
		do_action( 'ecommerce_shop_action_after_header' );
	?>
	<?php 
		/**
		 * Hook - ecommerce_shop_action_breadcrumb_trail
		 *
		 * @hooked ecommerce_shop_breadcrumb_trail -10
		 *
		 */
		do_action( 'ecommerce_shop_action_breadcrumb_trail' );
	?>	

	<?php 
		/**
		 * Hook - ecommerce_shop_action_before_content
		 *
		 * @hooked ecommerce_shop_content_start -10
		 *
		 */
		do_action( 'ecommerce_shop_action_before_content' );
		
	?>
	