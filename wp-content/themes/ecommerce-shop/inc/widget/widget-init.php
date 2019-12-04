<?php
/**
 * Widget Load files
 *
 * @package eCommerce_Shop
 */

function ecommerce_shop_widgets_scripts( $hook ) {
    if ( 'widgets.php' != $hook ) {
        return;
    }
    wp_enqueue_style( 'ecommerce-shop-backend', get_template_directory_uri() . '/css/backend.css');

    wp_enqueue_script( 'ecommerce-shop-color-picker', get_template_directory_uri() . '/js/backend.js', array( ), '20151215', true );
}
add_action( 'admin_enqueue_scripts', 'ecommerce_shop_widgets_scripts' );

if ( ecommerce_shop_is_woocommerce_active() ) {
	/**
	 * Featured Slider.
	 */
	require trailingslashit( get_template_directory() ). '/inc/widget/featured-slider.php';

	/**
	 * Featured Slider.
	 */
	require trailingslashit( get_template_directory() ). '/inc/widget/featured-product.php';

	/**
	 * Product Tab Section.
	 */
	require trailingslashit( get_template_directory() ). '/inc/widget/product-tab.php';

	/**
	 * Product Tab Section.
	 */
	require trailingslashit( get_template_directory() ). '/inc/widget/rated-section.php';


	/**
	 * Call To Action Section.
	 */
	require trailingslashit( get_template_directory() ). '/inc/widget/best-seller.php';
}

/**
 * Testimonial Section.
 */
require trailingslashit( get_template_directory() ). '/inc/widget/testimonial.php';

/**
 * Client Section.
 */
require trailingslashit( get_template_directory() ). '/inc/widget/client-section.php';

/**
 * Follow Us Widget.
 */
require trailingslashit( get_template_directory() ). '/inc/widget/social-media.php';

/**
 * Call To Action Section.
 */
require trailingslashit( get_template_directory() ). '/inc/widget/cta.php';
