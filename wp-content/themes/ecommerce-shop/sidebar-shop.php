<?php
/**
 * The sidebar containing the main shop widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eCommerce_Shop
 */
$sidebar_layout = ecommerce_shop_get_option( 'woo_sidebar_layout' );
if ( ! is_active_sidebar( 'sidebar-shop' ) || 'none' == $sidebar_layout ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-shop' ); ?>
</aside><!-- #secondary -->