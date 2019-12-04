<?php
/**
 * eCommerce Shop Theme Customizer
 *
 * @package eCommerce_Shop
 */

$default = ecommerce_shop_get_default_theme_options();

/****************  Add Pannel   ***********************/
$wp_customize->add_panel( 'theme_option_panel',
	array(
	'title'      => esc_html__( 'Theme Options', 'ecommerce-shop' ),
	'priority'   => 100,
	'capability' => 'edit_theme_options',
	)
);

/****************  Header Setting Section starts ************/
$wp_customize->add_section('section_header', 
	array(    
	'title'       => esc_html__('Header Setting', 'ecommerce-shop'),
	'panel'       => 'theme_option_panel'    
	)
);

/************************  Site Identity  ******************/
$wp_customize->add_setting('theme_options[site_identity]', 
	array(
	'default' 			=> $default['site_identity'],
	'sanitize_callback' => 'ecommerce_shop_sanitize_select'
	)
);
$wp_customize->add_control('theme_options[site_identity]', 
	array(		
	'label' 	=> esc_html__('Choose Option for Site Title', 'ecommerce-shop'),
	'section' 	=> 'title_tagline',
	'settings'  => 'theme_options[site_identity]',
	'type' 		=> 'radio',
	'choices' 	=>  array(
			'logo-only' 	=> esc_html__('Logo Only', 'ecommerce-shop'),
			'logo-title' 	=> esc_html__('Logo + Title', 'ecommerce-shop'),
			'logo-text' 	=> esc_html__('Logo + Tagline', 'ecommerce-shop'),
			'title-only' 	=> esc_html__('Title Only', 'ecommerce-shop'),
			'title-text' 	=> esc_html__('Title + Tagline', 'ecommerce-shop')
		)
	)
);
/****************  Header Setting Section starts ************/
$wp_customize->add_section('section_header', 
	array(    
	'title'       => esc_html__('Header Setting', 'ecommerce-shop'),
	'panel'       => 'theme_option_panel'    
	)
);

/********************* Login ****************************/
$wp_customize->add_setting( 'theme_options[search_header]',
	array(
		'default'           => $default['search_header'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_shop_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[search_header]',
	array(
		'label'    => esc_html__( 'Enable Search', 'ecommerce-shop' ),
		'section'  => 'section_header',
		'type'     => 'checkbox',
		'priority' => 100,
	)
);

if ( ecommerce_shop_is_woocommerce_active() ) {

	/********************* Login ****************************/
	$wp_customize->add_setting( 'theme_options[login_header]',
		array(
			'default'           => $default['login_header'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'ecommerce_shop_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'theme_options[login_header]',
		array(
			'label'    => esc_html__( 'Enable Login Button', 'ecommerce-shop' ),
			'description' => esc_html__( 'Sidebar layout for shop page', 'ecommerce-shop'),
			'section'  => 'section_header',
			'type'     => 'checkbox',
			'priority' => 100,
		)
	);

	/********************* Cart in Header ****************************/
	$wp_customize->add_setting( 'theme_options[cart_header]',
		array(
			'default'           => $default['cart_header'],
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'ecommerce_shop_sanitize_checkbox',
		)
	);
	$wp_customize->add_control( 'theme_options[cart_header]',
		array(
			'label'    => esc_html__( 'Enable Cart in Header', 'ecommerce-shop' ),
			'section'  => 'section_header',
			'type'     => 'checkbox',
			'priority' => 100,
		)
	);
}

/****************  Breadcrumbs Setting Section starts ************/
$wp_customize->add_section('section_breadcrumb', 
	array(    
	'title'       => esc_html__('Breadcrumbs Setting', 'ecommerce-shop'),
	'panel'       => 'theme_option_panel'    
	)
);

/********************* Breadcrumbs ****************************/
$wp_customize->add_setting( 'theme_options[enable_breadcrumb]',
	array(
		'default'           => $default['enable_breadcrumb'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_shop_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[enable_breadcrumb]',
	array(
		'label'    => esc_html__( 'Enable Breadcrumbs', 'ecommerce-shop' ),
		'section'  => 'section_breadcrumb',
		'type'     => 'checkbox',
	)
);

/************************  Header Image ******************/
$wp_customize->add_setting('theme_options[header_image]', 
	array(
	'default' 			=> $default['header_image'],
	'sanitize_callback' => 'ecommerce_shop_sanitize_select'
	)
);
$wp_customize->add_control('theme_options[header_image]', 
	array(		
	'label' 	=> esc_html__('Choose Option for Header Image', 'ecommerce-shop'),
	'description' 	=> esc_html__('Featured Image works only in single page and single post.Header image is display if featured image is not set.', 'ecommerce-shop'),
	'section' 	=> 'header_image',
	'settings'  => 'theme_options[header_image]',
	'type' 		=> 'radio',
	'choices' 	=>  array(
			'none' 	=> esc_html__('None', 'ecommerce-shop'),
			'header-image' 	=> esc_html__('Header Image', 'ecommerce-shop'),
			'post-thumbnail' 	=> esc_html__('Featured Image', 'ecommerce-shop'),
		)
	)
);


/****************  Archive/Blog Setting ************/
$wp_customize->add_section('section_archive', 
	array(    
	'title'       => esc_html__('Blog/Archive Setting', 'ecommerce-shop'),
	'panel'       => 'theme_option_panel'    
	)
);

/************************ Excerpt Length *********************************/
$wp_customize->add_setting( 'theme_options[excerpt_length]',
	array(
	'default'           => $default['excerpt_length'],
	'capability'        => 'edit_theme_options',	
	'sanitize_callback' => 'ecommerce_shop_sanitize_number_range',
	)
);
$wp_customize->add_control( 'theme_options[excerpt_length]',
	array(
	'label'       => esc_html__( 'Excerpt Length', 'ecommerce-shop' ),
	'section'     => 'section_archive',
	'type'        => 'number', 	
	'input_attrs' => array( 'min' => 10, 'max' => 250, 'step' => 5, 'style' => 'width: 100px;' ),
	)
);

/********************* Post Meta ****************************/
$wp_customize->add_setting( 'theme_options[enable_blog_postmeta]',
	array(
		'default'           => $default['enable_blog_postmeta'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_shop_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[enable_blog_postmeta]',
	array(
		'label'    => esc_html__( 'Enable Post Meta', 'ecommerce-shop' ),
		'section'  => 'section_archive',
		'type'     => 'checkbox',
	)
);




/****************  General Setting ************/
$wp_customize->add_section('section_general', 
	array(    
	'title'       => esc_html__('General Setting', 'ecommerce-shop'),
	'panel'       => 'theme_option_panel'    
	)
);

/************************  Sidebar Setiing ******************/
$wp_customize->add_setting('theme_options[sidebar_layout]', 
	array(
	'default' 			=> $default['sidebar_layout'],
	'sanitize_callback' => 'ecommerce_shop_sanitize_select'
	)
);
$wp_customize->add_control('theme_options[sidebar_layout]', 
	array(		
	'label' 	=> esc_html__('Choose Option for sidebar layout', 'ecommerce-shop'),
	'section' 	=> 'section_general',
	'settings'  => 'theme_options[sidebar_layout]',
	'type' 		=> 'radio',
	'choices' 	=>  array(
			'none' 	=> esc_html__('None', 'ecommerce-shop'),
			'left-sidebar' 	=> esc_html__('Left Sidebar', 'ecommerce-shop'),
			'right-sidebar' 	=> esc_html__('Right Sidebar', 'ecommerce-shop'),
		)
	)
);
if ( ecommerce_shop_is_woocommerce_active() ) {
	/************************ Woocommerce Sidebar Setiing ******************/
	$wp_customize->add_setting('theme_options[woo_sidebar_layout]', 
		array(
		'default' 			=> $default['woo_sidebar_layout'],
		'sanitize_callback' => 'ecommerce_shop_sanitize_select'
		)
	);
	$wp_customize->add_control('theme_options[woo_sidebar_layout]', 
		array(		
		'label' 	=> esc_html__('Choose Option', 'ecommerce-shop'),
		'section' 	=> 'section_general',
		'settings'  => 'theme_options[woo_sidebar_layout]',
		'type' 		=> 'radio',
		'choices' 	=>  array(
				'none' 	=> esc_html__('None', 'ecommerce-shop'),
				'left-sidebar' 	=> esc_html__('Left Sidebar', 'ecommerce-shop'),
				'right-sidebar' 	=> esc_html__('Right Sidebar', 'ecommerce-shop'),
			)
		)
	);
}

/********************************** Pagaination Option *********************************/
$wp_customize->add_setting('theme_options[pagination_option]', 
	array(
	'default' 			=> $default['pagination_option'],
	'type'              => 'theme_mod',
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'ecommerce_shop_sanitize_select'
	)
);

$wp_customize->add_control('theme_options[pagination_option]', 
	array(		
	'label' 	=> esc_html__('Pagination Options', 'ecommerce-shop'),
	'section' 	=> 'section_general',
	'settings'  => 'theme_options[pagination_option]',
	'type' 		=> 'radio',
	'choices' 	=> array(		
		'default' 		=> esc_html__('Default', 'ecommerce-shop'),							
		'numeric' 		=> esc_html__('Numeric', 'ecommerce-shop'),		
		),	
	)
);

/********************* Home Page Content ****************************/
$wp_customize->add_setting( 'theme_options[enable_home_page_content]',
	array(
		'default'           => $default['enable_home_page_content'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_shop_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[enable_home_page_content]',
	array(
		'label'    => esc_html__( 'Enable Home Content', 'ecommerce-shop' ),
		'description' => esc_html__( 'enable home content in home page.', 'ecommerce-shop' ),
		'section'  => 'section_general',
		'type'     => 'checkbox',
	)
);

/********************* Category ****************************/
$wp_customize->add_setting( 'theme_options[enable_category]',
	array(
		'default'           => $default['enable_category'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_shop_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[enable_category]',
	array(
		'label'    => esc_html__( 'Enable Category', 'ecommerce-shop' ),
		'section'  => 'section_general',
		'type'     => 'checkbox',
	)
);

/********************* Breadcrumbs ****************************/
$wp_customize->add_setting( 'theme_options[enable_posted_date]',
	array(
		'default'           => $default['enable_posted_date'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'ecommerce_shop_sanitize_checkbox',
	)
);
$wp_customize->add_control( 'theme_options[enable_posted_date]',
	array(
		'label'    => esc_html__( 'Enable Posted Date', 'ecommerce-shop' ),
		'section'  => 'section_general',
		'type'     => 'checkbox',
	)
);


/****************  Footer Setting Section starts ************/
$wp_customize->add_section('section_footer', 
	array(    
	'title'       => esc_html__('Footer Setting', 'ecommerce-shop'),
	'panel'       => 'theme_option_panel'    
	)
);

// Progress
$wp_customize->add_setting( 'theme_options[footer_info_secton]', array(
    'sanitize_callback' => 'ecommerce_shop_sanitize_repeater',
    'default' => json_encode(
        array(
            array(
                'icon'=> '',
                'title' => '',
                'info'  => '',
            )
        )
    )
));

$wp_customize->add_control(  new Ecommerce_Shop_Repeater_Controler( $wp_customize, 'theme_options[footer_info_secton]', 
    array(
        'label'                        => esc_html__('Info Section','ecommerce-shop'),
        'section'                      => 'section_footer',
        'ecommcer_shop_box_label'         => esc_html__('Info','ecommerce-shop'),
        'ecommcer_shop_box_add_control'   => esc_html__('Add Info','ecommerce-shop'),  
    ),
    array(
        'icon' => array(
        'type'        => 'text',
        'label'       => esc_html__( 'Icon', 'ecommerce-shop' ),
        'description' => esc_html__( 'Eg: fa fa-tasks', 'ecommerce-shop'),
        'default'     => '',	            
        ),

        'title' => array(
        'type'        => 'text',
        'label'       => esc_html__( 'Title', 'ecommerce-shop' ),        
        'default'     => '',		       
    	),        
            
        'info' => array(
        'type'        => 'text',
        'label'       => esc_html__( 'Shot Info', 'ecommerce-shop' ),
        'default'     => '',		       
    	),	
    )
));

/************************  Footer Copyright  ******************/
$wp_customize->add_setting( 'theme_options[copyright_text]',
	array(
	'default'           => $default['copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_textarea_field',	
	)
);
$wp_customize->add_control( 'theme_options[copyright_text]',
	array(
	'label'    => esc_html__( 'Footer Copyright', 'ecommerce-shop' ),
	'section'  => 'section_footer',
	'type'     => 'text',
	
	)
);
