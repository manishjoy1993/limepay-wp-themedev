<?php

/**
 * [ecommerce_saga_enqueue_style description]
 * @return [type] [description]
 */
function ecommerce_saga_enqueue_style() {

	// Load main css file of parent theme.
    wp_enqueue_style( 'ecommerce-saga-style-default', get_template_directory_uri() . '/style.css' );

    // Load this child theme css after all parent css files.
    wp_enqueue_style( 'ecommerce-saga-style',  get_stylesheet_directory_uri() . '/style.css', array( 'bootstrap', 'font-awesome', 'di-responsive-style-default', 'di-responsive-style-core' ), wp_get_theme()->get('Version'), 'all' );
}
add_action( 'wp_enqueue_scripts', 'ecommerce_saga_enqueue_style' );


/**
 * [ecommerce_saga_recomm_plugins description]
 * @return [type] [description]
 */
function ecommerce_saga_recomm_plugins() {

	$plugins = array(
		array(
			'name'      => __( 'WooCommerce PDF Invoices & Packing Slips', 'ecommerce-saga'),
			'slug'      => 'woocommerce-pdf-invoices-packing-slips',
			'required'  => false,
		),
		array(
			'name'      => __( 'YITH WooCommerce Quick View', 'ecommerce-saga'),
			'slug'      => 'yith-woocommerce-quick-view',
			'required'  => false,
		),
	);

	tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'ecommerce_saga_recomm_plugins' );


/**
 * [ecommerce_saga_setup description]
 * @return [type] [description]
 */
function ecommerce_saga_setup() {

	register_nav_menus( array(
		'footer'	=> __( 'Footer Menu', 'ecommerce-saga' ),
	) );
}
add_action( 'after_setup_theme', 'ecommerce_saga_setup' );


/**
 * [ecommerce_saga_woo_settings description]
 * @return [type] [description]
 */
function ecommerce_saga_woo_settings() {
	Kirki::add_field( 'di_responsive_config', array(
		'type'			 => 'select',
		'settings'		=> 'woo_product_img_effect',
		'label'			=> __( 'Product Images Effect', 'ecommerce-saga' ),
		'description'	=> __( 'Product images effect on shop page', 'ecommerce-saga' ),
		'section'		=> 'woocommerce_options',
		'default'		=> 'zoomin',
		'priority'		=> 10,
		'choices'		=> array(
			'none'			=> esc_attr__( 'None', 'ecommerce-saga' ),
			'zoomin'		=> esc_attr__( 'Zoom In', 'ecommerce-saga' ),
			'zoomout'		=> esc_attr__( 'Zoom Out', 'ecommerce-saga' ),
			'rotate'		=> esc_attr__( 'Rotate', 'ecommerce-saga' ),
			'blur'			=> esc_attr__( 'Blur', 'ecommerce-saga' ),
			'grayscale'		=> esc_attr__( 'Gray Scale', 'ecommerce-saga' ),
			'sepia'			=> esc_attr__( 'Sepia', 'ecommerce-saga' ),
			'opacity'		=> esc_attr__( 'Opacity', 'ecommerce-saga' ),
			'flash'			=> esc_attr__( 'Flash', 'ecommerce-saga' ),
		),
	) );
}
add_action( 'di_responsive_woo_options', 'ecommerce_saga_woo_settings' );


/**
 * [ecommerce_saga_product_images_effect_css description]
 * @return [type] [description]
 */
function ecommerce_saga_product_images_effect_css() {

	$custom_css = "";
	$effect = get_theme_mod( 'woo_product_img_effect', 'zoomin' );
	if( $effect == 'zoomin' ) {
		$custom_css .= "
		.woocommerce ul.products li.product a img {
			-webkit-transition: opacity 0.5s ease, transform 0.5s ease, border-radius 0.5s ease;
			transition: opacity 0.5s ease, transform 0.5s ease, border-radius 0.5s ease;
		}

		.woocommerce ul.products li.product:hover a img {
			opacity: 0.9;
			transform: scale(1.1);
			border-radius : 0 0 20px 20px;
		}
		";
	} elseif( $effect == 'zoomout' ) {
		$custom_css .= "
		.woocommerce ul.products li.product a img {
			-webkit-transition: opacity 0.5s ease, transform 0.5s ease;
			transition: opacity 0.5s ease, transform 0.5s ease;
		}

		.woocommerce ul.products li.product a img {
			opacity: 0.9;
			transform: scale(1.1);
		}

		.woocommerce ul.products li.product:hover a img {
			opacity: 0.9;
			transform: scale(1);
		}
		";
	} elseif( $effect == 'rotate' ) {
		$custom_css .= "
		.woocommerce ul.products li.product a img {
			-webkit-transition: transform 0s ease;
			transition: transform 0s ease;
		}
		.woocommerce ul.products li.product:hover a img {
			-webkit-transition: transform 0.7s ease;
			transition: transform 0.7s ease;
		}
		.woocommerce ul.products li.product:hover img {
			-ms-transform: rotate(360deg);
			-webkit-transform: rotate(360deg);
			transform: rotate(360deg);
		}
		";
	} elseif( $effect == 'blur' ) {
		$custom_css .= "
		.woocommerce ul.products li.product img {
			-webkit-filter: blur(3px);
			filter: blur(3px);
			-webkit-transition: .3s ease-in-out;
			transition: .3s ease-in-out;
		}

		.woocommerce ul.products li.product:hover img {
			-webkit-filter: blur(0px);
			filter: blur(0px);
		}
		";
	} elseif( $effect == 'grayscale' ) {
		$custom_css .= "
		.woocommerce ul.products li.product img {
			-webkit-filter: grayscale(100%);
			filter: grayscale(100%);
			-webkit-transition: .3s ease-in-out;
			transition: .3s ease-in-out;
		}

		.woocommerce ul.products li.product:hover img {
			-webkit-filter: grayscale(0%);
			filter: grayscale(0%);
		}
		";
	} elseif( $effect == 'sepia' ) {
		$custom_css .= "
		.woocommerce ul.products li.product img {
			-webkit-filter: sepia(100%);
			filter: sepia(100%);
			-webkit-transition: .3s ease-in-out;
			transition: .3s ease-in-out;
		}

		.woocommerce ul.products li.product:hover img {
			-webkit-filter: sepia(0%);
			filter: sepia(0%);
		}
		";
	} elseif( $effect == 'opacity' ) {
		$custom_css .= "
		.woocommerce ul.products li.product a img {
			-webkit-transition: opacity 0.5s ease;
			transition: opacity 0.5s ease;
		}

		.woocommerce ul.products li.product:hover a img {
			opacity: 0.7;
		}
		";
	} elseif( $effect == 'flash' ) {
		$custom_css .= "
		.woocommerce ul.products li.product:hover a img {
			opacity: 1;
			-webkit-animation: recflash 1.5s;
			animation: recflash 1.5s;
		}
		@-webkit-keyframes recflash {
			0% {
				opacity: .4;
			}
			100% {
				opacity: 1;
			}
		}
		@keyframes recflash {
			0% {
				opacity: .4;
			}
			100% {
				opacity: 1;
			}
		}
		";
	} else {
		$custom_css .= "
		.woocommerce ul.products li.product a img {

		}
		";
	}
	wp_add_inline_style( 'ecommerce-saga-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'ecommerce_saga_product_images_effect_css' );
