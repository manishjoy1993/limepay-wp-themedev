<?php
/**
 * Load files
 *
 * @package eCommerce_Shop
 */

/**
 * Include default theme options.
 */
require_once trailingslashit( get_template_directory() ) . 'inc/customizer/default.php';

/**
 * Load Hooks.
 */
require_once trailingslashit( get_template_directory() ) . 'inc/hook/structure.php';
require_once trailingslashit( get_template_directory() ) . 'inc/hook/basic.php';
require_once trailingslashit( get_template_directory() ) . 'inc/hook/custom.php';


/**
 * Plugin Activation Section.
 */
require trailingslashit( get_template_directory() ) . '/inc/class-tgm-plugin-activation.php';

/**
 * Repeater Controller options.
 */
require trailingslashit( get_template_directory() ) . '/inc/customizer/repeater-controller/customizer.php';

/**
 * Implement the Custom Header feature.
 */
require trailingslashit( get_template_directory() ). '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ). '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require trailingslashit( get_template_directory() ). '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require trailingslashit( get_template_directory() ). '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require trailingslashit( get_template_directory() ) . '/inc/jetpack.php';
}

/**
 * Widget Init.
 */
require trailingslashit( get_template_directory() ). '/inc/widget/widget-init.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require trailingslashit( get_template_directory() ). '/inc/woocommerce.php';

/**
 * One Click Demo Import
 */
require_once trailingslashit( get_template_directory() ) . '/demo-content/demo-content-import.php';