<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eCommerce_Shop
 */
$sidebar_layout = ecommerce_shop_get_option( 'sidebar_layout' );
if ( ! is_active_sidebar( 'sidebar-1' ) || 'none' == $sidebar_layout  ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
