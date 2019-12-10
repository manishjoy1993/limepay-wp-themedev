<?php
add_action( 'wp_enqueue_scripts', 'urus_child_enqueue_styles' );

if( !function_exists('urus_child_enqueue_styles')){
    function urus_child_enqueue_styles() {
        $parent_style ='urus-prent';
        wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css');
        wp_enqueue_style( 'urus-child',
            get_stylesheet_directory_uri() . '/style.css',
            array( $parent_style ),
            wp_get_theme()->get('Version')
        );
    }
}
