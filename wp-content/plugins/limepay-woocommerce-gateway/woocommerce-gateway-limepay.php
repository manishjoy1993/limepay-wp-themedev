<?php
/*
Plugin Name: Limepay - WooCommerce Gateway
Plugin URI: https://www.limepay.com.au/
Description: Extends WooCommerce by Adding the Limepay Gateway.
Version: 2.2.2
Author: Madhu Fernando, Limepay
*/

// Include our Gateway Class and register Payment Gateway with WooCommerce
add_action( 'plugins_loaded', 'limepay_init', 11 );
function limepay_init() {
	// If the parent WC_Payment_Gateway class doesn't exist
	// it means WooCommerce is not installed on the site
	// so do nothing
	if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;

	// If we made it this far, then include our Gateway Class
	include_once( 'woocommerce-limepay.php' );

	// Now that we have successfully included our class,
	// Lets add it too WooCommerce
	add_filter( 'woocommerce_payment_gateways', 'add_limepay_gateway' );
	function add_limepay_gateway( $methods ) {
		$methods[] = 'Limepay';
		return $methods;
	}
}

// Add custom action links
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'limepay_action_links' );
function limepay_action_links( $links ) {
	$plugin_links = array(
		'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout' ) . '">' . __( 'Settings', 'limepay' ) . '</a>',
	);

	// Merge our new link with the default ones
	return array_merge( $plugin_links, $links );
}
