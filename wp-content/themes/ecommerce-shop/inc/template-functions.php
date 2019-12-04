<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package eCommerce_Shop
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ecommerce_shop_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    if ( is_front_page() && ! is_home() ){
        $classes[] = 'front-home';
    }
         
    // Add class for global layout.
    $sidebar_layout = ecommerce_shop_get_option( 'sidebar_layout' );
    if ( ecommerce_shop_is_woocommerce_active() ) {
        if ( is_woocommerce() ){
            $sidebar_layout = ecommerce_shop_get_option( 'woo_sidebar_layout' ); 
        }
    } else{
        $sidebar_layout = ecommerce_shop_get_option( 'sidebar_layout' );
    }

    $sidebar_layout = apply_filters( 'ecommerce_shop_filter_theme_global_layout', $sidebar_layout );
    $classes[] = 'global-layout-' . esc_attr( $sidebar_layout );    
 

    if ( ecommerce_shop_is_woocommerce_active() ) {
         $classes[] = 'woocommerce';
    }
   

	return $classes;
}
add_filter( 'body_class', 'ecommerce_shop_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ecommerce_shop_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'ecommerce_shop_pingback_header' );

if ( ! function_exists( 'ecommerce_shop_the_excerpt' ) ) :

    /**
     * Generate excerpt.
     *
     * @since 1.0.0
     *
     * @param int     $length Excerpt length in words.
     * @param WP_Post $post_obj WP_Post instance (Optional).
     * @return string Excerpt.
     */
    function ecommerce_shop_the_excerpt( $length = 0, $post_obj = null ) {

        global $post;

        if ( is_null( $post_obj ) ) {
            $post_obj = $post;
        }

        $length = absint( $length );

        if ( 0 === $length ) {
            return;
        }

        $source_content = $post_obj->post_content;

        if ( ! empty( $post_obj->post_excerpt ) ) {
            $source_content = $post_obj->post_excerpt;
        }

        $source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
        $trimmed_content = wp_trim_words( $source_content, $length, '&hellip;' );
        return $trimmed_content;

    }

endif;

/**
 * Register the required plugins for this theme.
 * 
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function ecommerce_shop_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array(
            'name'      => esc_html__( 'Woocommerce', 'ecommerce-shop' ), //The plugin name
            'slug'      => 'woocommerce',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
        
        array(
            'name'      => esc_html__( 'YITH WooCommerce Wishlist', 'ecommerce-shop' ), //The plugin name
            'slug'      => 'yith-woocommerce-wishlist',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),
        array(
            'name'      => esc_html__( 'YITH WooCommerce Quick View', 'ecommerce-shop' ), //The plugin name
            'slug'      => 'yith-woocommerce-quick-view',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),        
        array(
            'name'      => esc_html__( 'Contact Form 7', 'ecommerce-shop' ), //The plugin name
            'slug'      => 'contact-form-7',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),        
        array(
            'name'      => esc_html__( 'One Click Demo Import', 'ecommerce-shop' ), //The plugin name
            'slug'      => 'one-click-demo-import',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),    
        array(
            'name'      => esc_html__( 'Newsletters', 'ecommerce-shop' ), //The plugin name
            'slug'      => 'newsletter',  // The plugin slug (typically the folder name)
            'required'  => false,  // If false, the plugin is only 'recommended' instead of required.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
        ),               
    );

    $config = array(
        'id'           => 'ecommerce-shop',        // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.     
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        );

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'ecommerce_shop_register_required_plugins' );
