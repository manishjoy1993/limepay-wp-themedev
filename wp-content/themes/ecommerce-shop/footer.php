<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package eCommerce_Shop
 */

?>

	<?php 
		/**
		 * Hook - ecommerce_shop_action_after_content
		 *
		 * @hooked ecommerce_shop_content_end -10
		 *
		 */
		do_action( 'ecommerce_shop_action_after_content' );
	?>
	<?php 
		/**
		 * Hook - ecommerce_shop_action_before_footer
		 *
		 * @hooked ecommerce_shop_footer_start -10
		 *
		 */
		do_action( 'ecommerce_shop_action_before_footer' );
	?>

	<?php 
		/**
		 * Hook - ecommerce_shop_action_footer
		 *
		 * @hooked ecommerce_shop_footer_copyright -10
		 *
		 */
		do_action( 'ecommerce_shop_action_footer' );
	?>	
	
	<?php 
		/**
		 * Hook - ecommerce_shop_action_after_footer
		 *
		 * @hooked ecommerce_shop_footer_end -10
		 *
		 */
		do_action( 'ecommerce_shop_action_after_footer' );
	?>		

	<?php 
		/**
		 * Hook - ecommerce_shop_action_after
		 *
		 * @hooked ecommerce_shop_page_end -10
		 *
		 */
		do_action( 'ecommerce_shop_action_after' );
	?>

<?php wp_footer(); ?>

</body>
</html>
