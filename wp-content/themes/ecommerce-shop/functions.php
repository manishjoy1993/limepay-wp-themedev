<?php
/**
 * eCommerce Shop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package eCommerce_Shop
 */

if ( ! function_exists( 'ecommerce_shop_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ecommerce_shop_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on eCommerce Shop, use a find and replace
		 * to change 'ecommerce-shop' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ecommerce-shop', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'ecommerce-shop-main-slider', 809, 499, true);
		add_image_size( 'ecommerce-shop-featured-product', 525, 365, true);
		add_image_size( 'ecommerce-shop-woocommerce-product', 243, 285, true);
		add_image_size( 'ecommerce-shop-woocommerce-testimonial', 82, 123, true);
		add_image_size( 'ecommerce-shop-product-slider', 143, 143, true);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ecommerce-shop' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'ecommerce-shop' ),
			'social-menu' => esc_html__( 'Social Menu', 'ecommerce-shop' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ecommerce_shop_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );		

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// makes our theme WC compatible
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );		
	}
endif;
add_action( 'after_setup_theme', 'ecommerce_shop_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ecommerce_shop_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ecommerce_shop_content_width', 640 );
}
add_action( 'after_setup_theme', 'ecommerce_shop_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ecommerce_shop_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ecommerce-shop' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ecommerce-shop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Slider', 'ecommerce-shop' ),
		'id'            => 'home-slider',
		'description'   => esc_html__( 'Add widgets here.', 'ecommerce-shop' ),
		'before_widget' => '<section id="%1$s" class="%2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Widget Area', 'ecommerce-shop' ),
		'id'            => 'home-widget-area',
		'description'   => esc_html__( 'Add widgets here.', 'ecommerce-shop' ),
		'before_widget' => '<section id="%1$s" class="%2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	

	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'ecommerce-shop' ), 1 ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</h2></span>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'ecommerce-shop' ), 2 ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</h2></span>',
	) );

	if ( ecommerce_shop_is_woocommerce_active() ) : 
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'ecommerce-shop' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Add widgets here.', 'ecommerce-shop' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			) );
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Best Seller', 'ecommerce-shop' ),
			'id'            => 'best-seller-shop',
			'description'   => esc_html__( 'Add widgets here.', 'ecommerce-shop' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			) );		
	endif;

}
add_action( 'widgets_init', 'ecommerce_shop_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ecommerce_shop_scripts() {

	wp_enqueue_style( 'ecommerce-shop-fonts', ecommerce_shop_fonts_url(), array(), null );
	
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css');

	wp_enqueue_style( 'fontawesome', get_template_directory_uri().'/css/font-awesome/css/font-awesome.min.css');
	
	wp_enqueue_style( 'meanmenu', get_template_directory_uri().'/css/meanmenu.css');

	wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css');

	wp_enqueue_style( 'ecommerce-shop-style', get_stylesheet_uri() );	

	wp_enqueue_style( 'ecommerce-shop-responsive', get_template_directory_uri().'/css/responsive.css');

	wp_enqueue_script( 'ecommerce-shop-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'jquery-ui-tabs' );

	wp_enqueue_script( 'jquery-ui-selectmenu' );

	wp_enqueue_script( 'meanmenu', get_template_directory_uri() . '/js/jquery.meanmenu.js', array(), 'v2.0.8', true );

	wp_enqueue_script( 'jquery-wow-js', get_template_directory_uri() . '/js/wow.min.js', array('jquery'), 'v1.1.3', true );

	wp_enqueue_script( 'jquery-owl-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery'), 'v2.3.4', true );

	wp_enqueue_script( 'ecommerce-shop-custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery-ui-tabs'), '1.0.0', true );	

	wp_enqueue_script( 'ecommerce-shop-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ecommerce_shop_scripts' );

/**
 * Load init.
 */
require_once trailingslashit( get_template_directory() ) . 'inc/init.php';