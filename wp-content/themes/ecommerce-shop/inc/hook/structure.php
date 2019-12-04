<?php
/**
 * Theme functions related to structure.
 *
 * This file contains structural hook functions.
 *
 * @package eCommerce_Shop
 */

if ( ! function_exists( 'ecommerce_shop_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_shop_doctype() {
	?><!DOCTYPE html> <html <?php language_attributes(); ?>><?php
	}
endif;

add_action( 'ecommerce_shop_action_doctype', 'ecommerce_shop_doctype', 10 );

if ( !function_exists( 'ecommerce_shop_head' ) ) :
	/**
	 * Header Codes.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_shop_head() {
	?>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
	<?php
	}
endif;

add_action( 'ecommerce_shop_action_head', 'ecommerce_shop_head', 10 );

if ( ! function_exists( 'ecommerce_shop_page_start' ) ) :
	/**
	 * Page Start.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_shop_page_start() {
	?>
    <div id="page" class="site">
    	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ecommerce-shop' ); ?></a>
    <?php
	}
endif;
add_action( 'ecommerce_shop_action_before', 'ecommerce_shop_page_start' );

if ( ! function_exists( 'ecommerce_shop_page_end' ) ) :
	/**
	 * Page End.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_shop_page_end() {
	?></div><!-- #page --><?php
	}
endif;
add_action( 'ecommerce_shop_action_after', 'ecommerce_shop_page_end' );

if ( ! function_exists( 'ecommerce_shop_content_start' ) ) :
	/**
	 * Content Start.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_shop_content_start() {
	?><div id="content" class="site-content"><?php
	}
endif;
add_action( 'ecommerce_shop_action_before_content', 'ecommerce_shop_content_start' );


if ( ! function_exists( 'ecommerce_shop_content_end' ) ) :
	/**
	 * Content End.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_shop_content_end() {
	?></div><!-- #content --><?php
	}
endif;
add_action( 'ecommerce_shop_action_after_content', 'ecommerce_shop_content_end' );


if ( ! function_exists( 'ecommerce_shop_header_start' ) ) :
	/**
	 * Header Start
	 *
	 * @since 1.0.0
	 */
	function ecommerce_shop_header_start() {
	?>
	<header id="masthead" class="site-header"><!-- header starting from here --><div class="header-overlay"></div><div class="container"><!--container start--><?php	
	}
endif;

add_action( 'ecommerce_shop_action_before_header', 'ecommerce_shop_header_start', 10 );


if ( ! function_exists( 'ecommerce_shop_header_end' ) ) :
	/**
	 * Header End
	 *
	 * @since 1.0.0
	 */
	function ecommerce_shop_header_end() {
	?></div><!-- container ends here --></header><!-- header ends here --><?php	
	}
endif;
add_action( 'ecommerce_shop_action_after_header', 'ecommerce_shop_header_end', 10 );

if ( ! function_exists( 'ecommerce_shop_footer_start' ) ) :
	/**
	 * Footer Start.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_shop_footer_start() {
	?><footer id="colophon" class="site-footer"> <!-- footer starting from here --> 
	<?php
	}
endif;
add_action( 'ecommerce_shop_action_before_footer', 'ecommerce_shop_footer_start' );


if ( ! function_exists( 'ecommerce_shop_footer_end' ) ) :
	/**
	 * Footer End.
	 *
	 * @since 1.0.0
	 */
	function ecommerce_shop_footer_end() {
	?></footer><!-- #colophon --><?php
	}
endif;
add_action( 'ecommerce_shop_action_after_footer', 'ecommerce_shop_footer_end' );