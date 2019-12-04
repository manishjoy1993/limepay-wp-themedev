<?php
/**
 * Functions to provide support for the One Click Demo Import plugin (wordpress.org/plugins/one-click-demo-import)
 *
 * @package eCommerce_Shop
 */
if ( ! class_exists( 'OCDI_Plugin' ) ) {
    return;
}

/**
* Remove branding
*/
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

/*Import demo data*/
if ( ! function_exists( 'ecommerce_shop_demo_import_files' ) ) :
    function ecommerce_shop_demo_import_files() {
        return array(
            array(
                'import_file_name'             => 'eCommerce Shop',                
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/default/ecommerce-shop.xml',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/default/ecommerce-shop-widgets.wie',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/default/ecommerce-shop-export.dat',               
            ),
            array(
                'import_file_name'             => 'Book Store',                
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/bookstore/bookhouse.wordpress.xml',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/bookstore/ecommerce-shop-bookhouse-widgets.wie',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/bookstore/ecommerce-shop-export-book.dat',                
            ),   
            array(
                'import_file_name'             => 'Decore',                
                'local_import_file'            => trailingslashit( get_template_directory() ) . 'demo-content/decore/decorhouse.wordpress.xml',
                'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'demo-content/decore/ecommerce-shop-decore-widgets.wie',
                'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'demo-content/decore/ecommerce-shop-export.dat',                
            ),          
        ); 
    }

    add_filter( 'pt-ocdi/import_files', 'ecommerce_shop_demo_import_files' );

endif;

/**
 * Action that happen after import
 */
if ( ! function_exists( 'ecommerce_shop_after_demo_import' ) ) :
    function ecommerce_shop_after_demo_import( $selected_import ) {
            //Set Menu
            $primary_menu = get_term_by('name', 'Main Menu', 'nav_menu'); 

            $social_menu = get_term_by('name', 'Social Menu', 'nav_menu');  

            $footer_menu  = get_term_by( 'name', 'Footer menu', 'nav_menu');

            set_theme_mod( 'nav_menu_locations' , array( 

                'menu-1' => $primary_menu->term_id,

                'social-menu' => $social_menu->term_id, 

                'footer-menu' => $footer_menu->term_id, 

                ) 

            );
            //Set Front page
            $page = get_page_by_title( 'Home');
            $blog_page  = get_page_by_title( 'Blog' );
            if ( isset( $page->ID ) ) {
                update_option( 'page_on_front', $page->ID );
                update_option( 'show_on_front', 'page' );
            }
            update_option( 'show_on_front', 'page' );
            update_option( 'page_for_posts', $blog_page->ID );       
    }

    add_action( 'pt-ocdi/after_import', 'ecommerce_shop_after_demo_import' );



endif;