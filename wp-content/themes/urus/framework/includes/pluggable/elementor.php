<?php

if( !class_exists('Urus_Pluggable_Elementor')){
    class  Urus_Pluggable_Elementor{
        /**
         * Variable to hold the initialization state.
         *
         * @var  boolean
         */
        protected static $initialized = false;
        /**
         * Initialize pluggable functions for Visual Composer.
         *
         * @return  void
         */
        public static function initialize() {
            // Do nothing if pluggable functions already initialized.
            if ( self::$initialized ) {
                return;
            }
            add_action('elementor/elements/categories_registered',array(__CLASS__,'categories_registered'));
            add_action('elementor/widgets/widgets_registered', array(__CLASS__,'register_widgets') );
            // State that initialization completed.
            self::$initialized = true;
        }
        
        public static function register_widgets(){

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Special_Banner() );

            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Feature_Box() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Blogs() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Newsletter() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Countdown() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Title() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Button() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_icon() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Socials() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Custom_Menu() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Testimonial() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Footer_Box() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Slide_Text() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Product_Tabs() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Slide_Gallery() );



            if( class_exists('Familab_Instagram_Shop')){
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Instagram_Shop() );
            }
            //
            if ( class_exists( 'WooCommerce' ) ) {
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Products() );
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Category() );
                \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Urus_Elementor_Product_Deal() );
            }
        }
        
        public static function categories_registered($elementsManager ){
           
            $elementsManager->add_category(
                'urus',
                [
                    'title' => esc_html__( 'urus', 'urus' ),
                    'icon' => 'fa fa-plug',
                ]
            );
        }
    
        public static function elementor_bootstrap( $dependency = null, $value_dependency = null ){
            $data_value     = array();
           
            $data_bootstrap = array(
                'boostrap_rows_space' => array(
                    'label' => esc_html__( 'Rows space', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'rows-space-0' => esc_html__( 'Default', 'urus' ),
                        'rows-space-10' => esc_html__( '10px', 'urus' ),
                        'rows-space-20' => esc_html__( '20px', 'urus' ),
                        'rows-space-30' => esc_html__( '30px', 'urus' ),
                        'rows-space-40' => esc_html__( '40px', 'urus' ),
                        'rows-space-50' => esc_html__( '50px', 'urus' ),
                        'rows-space-60' => esc_html__( '60px', 'urus' ),
                        'rows-space-70' => esc_html__( '70px', 'urus' ),
                        'rows-space-80' => esc_html__( '80px', 'urus' ),
                        'rows-space-90' => esc_html__( '90px', 'urus' ),
                        'rows-space-100' => esc_html__( '100px', 'urus' ),
                    ],
                    'default' => 'rows-space-0',
                    'condition' => array(
                        $dependency => $value_dependency
                    ),
                    'label_block'=> true
                ),
                'boostrap_bg_items'  => array(
                    'label' => esc_html__( 'Items per row on Desktop', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        '12' => esc_html__( '1 Item', 'urus' ),
                        '6' => esc_html__( '2 Items', 'urus' ),
                        '4' => esc_html__( '3 Items', 'urus' ),
                        '3' => esc_html__( '4 Items', 'urus' ),
                        '15' => esc_html__( '5 Items', 'urus' ),
                        '2' => esc_html__( '6 Items', 'urus' ),
                    ],
                    'default' => '3',
                    'condition' => array(
                        $dependency => $value_dependency
                    ),
                    'description' => esc_html__( '(Item per row on screen resolution of device >= 1200px and < 1500px )', 'urus' ),
                    'label_block'=> true
                ),
                'boostrap_lg_items' => array(
                    'label' => esc_html__( 'Items per row on Desktop', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        '12' => esc_html__( '1 Item', 'urus' ),
                        '6' => esc_html__( '2 Items', 'urus' ),
                        '4' => esc_html__( '3 Items', 'urus' ),
                        '3' => esc_html__( '4 Items', 'urus' ),
                        '15' => esc_html__( '5 Items', 'urus' ),
                        '2' => esc_html__( '6 Items', 'urus' ),
                    ],
                    'default' => '3',
                    'condition' => array(
                        $dependency => $value_dependency
                    ),
                    'description' => esc_html__( '(Item per row on screen resolution of device >=992px and < 1200px )', 'urus' ),
                    'label_block'=> true
                ),
                'boostrap_md_items' => array(
                    'label' => esc_html__( 'Items per row on Desktop', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        '12' => esc_html__( '1 Item', 'urus' ),
                        '6' => esc_html__( '2 Items', 'urus' ),
                        '4' => esc_html__( '3 Items', 'urus' ),
                        '3' => esc_html__( '4 Items', 'urus' ),
                        '15' => esc_html__( '5 Items', 'urus'),
                        '2' => esc_html__( '6 Items', 'urus' ),
                    ],
                    'default' => '3',
                    'condition' => array(
                        $dependency => $value_dependency
                    ),
                    'description' => esc_html__( '(Item per row on screen resolution of device >=992px and < 1200px )', 'urus' ),
                    'label_block'=> true
                ),
                'boostrap_sm_items' => array(
                    'label' => esc_html__( 'Items per row on Desktop', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        '12' => esc_html__( '1 Item', 'urus' ),
                        '6' => esc_html__( '2 Items', 'urus' ),
                        '4' => esc_html__( '3 Items', 'urus' ),
                        '3' => esc_html__( '4 Items', 'urus' ),
                        '15' => esc_html__( '5 Items', 'urus'),
                        '2' => esc_html__( '6 Items', 'urus' ),
                    ],
                    'default' => '4',
                    'condition' => array(
                        $dependency => $value_dependency
                    ),
                    'description' => esc_html__( '(Item per row on screen resolution of device >=768px and < 992px )', 'urus' ),
                    'label_block'=> true
                ),
                'boostrap_xs_items' => array(
                    'label' => esc_html__( 'Items per row on Desktop', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        '12' => esc_html__( '1 Item', 'urus' ),
                        '6' => esc_html__( '2 Items', 'urus' ),
                        '4' => esc_html__( '3 Items', 'urus' ),
                        '3' => esc_html__( '4 Items', 'urus' ),
                        '15' => esc_html__( '5 Items', 'urus' ),
                        '2' => esc_html__( '6 Items', 'urus' ),
                    ],
                    'default' => '6',
                    'condition' => array(
                        $dependency => $value_dependency
                    ),
                    'description' => esc_html__( '(Item per row on screen resolution of device >=480  add < 768px )', 'urus' ),
                    'label_block'=> true
                ),
                'boostrap_ts_items' => array(
                    'label' => esc_html__( 'Items per row on Desktop', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        '12' => esc_html__( '1 Item', 'urus' ),
                        '6' => esc_html__( '2 Items', 'urus' ),
                        '4' => esc_html__( '3 Items', 'urus' ),
                        '3' => esc_html__( '4 Items', 'urus' ),
                        '15' => esc_html__( '5 Items', 'urus' ),
                        '2' => esc_html__( '6 Items', 'urus' ),
                    ],
                    'default' => '6',
                    'condition' => array(
                        $dependency => $value_dependency
                    ),
                    'description' => esc_html__( '(Item per row on screen resolution of device < 480px)', 'urus' ),
                    'label_block'=> true
                )
            );
            if ( $dependency == null && $value_dependency == null ) {
                foreach ( $data_bootstrap as $key => $value ) {
                    unset( $value['condition'] );
                    $data_value[$key] = $value;
                }
            } else {
                foreach ( $data_bootstrap as $key => $value ) {
                    $data_value[$key] = $value;
                }
            }
            
            return $data_value;
        }
        public static function elementor_carousel($dependency = null, $value_dependency = null ){
            $data_value      = array();
            $arr_dependency = empty($dependency) ? [] : array($dependency => $value_dependency);
            $data_carousel = array(
                'owl_number_row'  => array(
                    'label' => esc_html__( 'The number of rows which are shown on block', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        '1 Row' => esc_html__( '1 Row', 'urus' ) ,
                        '2 Rows' => esc_html__( '2 Rows', 'urus' ),
                        '3 Rows'=> esc_html__( '3 Rows', 'urus' ),
                        '4 Rows' => esc_html__( '4 Rows', 'urus' ),
                        '5 Rows' => esc_html__( '5 Rows', 'urus' ),
                        '6 Rows' => esc_html__( '6 Rows', 'urus' ),
                    ],
                    'default' => '1',
                    'condition' => $arr_dependency,
                    'label_block'=> true
                ),
                'owl_rows_space' => array(
                    'label' => esc_html__( 'Rows space', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'rows-space-0' => esc_html__( 'Default', 'urus' ),
                        'rows-space-10' => esc_html__( '10px', 'urus' ),
                        'rows-space-20' => esc_html__( '20px', 'urus' ),
                        'rows-space-30' => esc_html__( '30px', 'urus' ),
                        'rows-space-40' => esc_html__( '40px', 'urus' ),
                        'rows-space-50' => esc_html__( '50px', 'urus' ),
                        'rows-space-60' => esc_html__( '60px', 'urus' ),
                        'rows-space-70' => esc_html__( '70px', 'urus' ),
                        'rows-space-80' => esc_html__( '80px', 'urus' ),
                        'rows-space-90' => esc_html__( '90px', 'urus' ),
                        'rows-space-100' => esc_html__( '100px', 'urus' ),
                    ],
                    'default' => 'rows-space-0',
                    'condition' => array(
                        'owl_rows_space' => array(2,3,4,5,6)
                    ),
                    
                ),
                'owl_fade' => array(
                    'label' => esc_html__( 'Fade', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'false' => esc_html__( 'No', 'urus' ) ,
                        'true' => esc_html__( 'Yes', 'urus' ),
                    ],
                    'default' => 'false',
                    'condition' =>$arr_dependency,
                    
                ),
                'owl_center_mode' => array(
                    'label' => esc_html__( 'Center Mode', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'false' => esc_html__( 'No', 'urus' ) ,
                        'true' => esc_html__( 'Yes', 'urus' ),
                    ],
                    'default' => 'false',
                    'condition' => $arr_dependency,
                ),
                'owl_center_padding' => array(
                    'label' => esc_html__( 'Center Padding', 'urus' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                    'default' => 50,
                    'description' => esc_html__( 'Distance( or space) between 2 item', 'urus' ),
                    'condition' => array(
                        'owl_center_mode' => 'true'
                    ),
                ),
                //Vertical Mode
                'owl_vertical' => array(
                    'label' => esc_html__( 'Vertical Mode', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'false' => esc_html__( 'No', 'urus' ) ,
                        'true' => esc_html__( 'Yes', 'urus' ),
                    ],
                    'default' => 'false',
                    'condition' => $arr_dependency,
                ),
                'owl_verticalswiping' => array(
                    'label' => esc_html__( 'Vertical Swiping', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'false' => esc_html__( 'No', 'urus' ) ,
                        'true' => esc_html__( 'Yes', 'urus' ),
                    ],
                    'default' => 'false',
                    'condition' => $arr_dependency,
                ),
                'owl_autoplay' => array(
                    'label' => esc_html__( 'Auto Play', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'false' => esc_html__( 'No', 'urus' ) ,
                        'true' => esc_html__( 'Yes', 'urus' ),
                    ],
                    'default' => 'false',
                    'condition' => $arr_dependency,
                ),
                'owl_autoplayspeed' => array(
                    'label' => esc_html__( 'Autoplay Speed', 'urus' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 100000,
                    'step' => 1,
                    'default' => 1000,
                    'condition' => array(
                        'owl_autoplay' => 'true'
                    ),
                ),
                'owl_navigation' =>array(
                    'label' => esc_html__( 'Navigation', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'false' => esc_html__( 'No', 'urus' ) ,
                        'true' => esc_html__( 'Yes', 'urus' ),
                    ],
                    'default' => 'false',
                    'condition' => $arr_dependency,
                ),
                'owl_navigation_style' => array(
                    'label' => esc_html__( 'Navigation Style', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        '' => esc_html__( 'Default', 'urus' ) ,
                        'style1' => esc_html__( 'Style 01', 'urus' ),
                        'style2' => esc_html__( 'Style 02', 'urus' ),
                        'style3' => esc_html__( 'Style 03', 'urus' ),
                        'style4' => esc_html__( 'Style 04', 'urus' ),
                        'style5' => esc_html__( 'Style 05', 'urus' ),
                        'style6' => esc_html__( 'Style 06', 'urus' ),
                    ],
                    'default' => '',
                    'condition' => array(
                        'owl_navigation' => 'true'
                    ),
                ),
                'owl_nav_position' => array(
	                'label' => esc_html__( 'Navigation position', 'urus' ),
	                'type' => \Elementor\Controls_Manager::SELECT,
	                'options' => [
		                '' => esc_html__( 'Default', 'urus' ) ,
		                'nav-top' => esc_html__( 'Navigation on top', 'urus' ),
		                'nav-center' => esc_html__( 'Navigation center', 'urus' ),
	                ],
	                'default' => 'nav-center',
	                'condition' => array(
		                "owl_navigation" => 'true'
	                ),
                ),
                'owl_dots' => array(
                    'label' => esc_html__( 'Dots', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'false' => esc_html__( 'No', 'urus' ) ,
                        'true' => esc_html__( 'Yes', 'urus' ),
                    ],
                    'default' => 'false',
                    'condition' => $arr_dependency,
                ),
                'owl_dots_style' => array(
	                'label' => esc_html__( 'Dots Style', 'urus' ),
	                'type' => \Elementor\Controls_Manager::SELECT,
	                'options' => [
		                '' => esc_html__( 'Default', 'urus' ),
		                'style1' => esc_html__( 'Style 1', 'urus' ),
		                'style2' => esc_html__( 'Style 2', 'urus' ),
		                'style3' => esc_html__( 'Style 3', 'urus' ),
	                ],
	                'default' => '',
	                'condition' => array(
		                'owl_dots' => 'true'
	                ),
                ),
                'owl_loop' => array(
                    'label' => esc_html__( 'Loop', 'urus' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'false' => esc_html__( 'No', 'urus' ) ,
                        'true' => esc_html__( 'Yes', 'urus' ),
                    ],
                    'default' => 'false',
                    'condition' => $arr_dependency,
                ),
                'owl_slidespeed' => array(
                    'label' => esc_html__( 'Slide Speed', 'urus' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 100000,
                    'step' => 1,
                    'default' => 1000,
                    'condition' => $arr_dependency,
                ),
                'owl_slide_margin' => array(
                    'label' => esc_html__( 'Slide Margin', 'urus' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 100000,
                    'step' => 10,
                    'default' => 40,
                    'condition' => $arr_dependency,
                ),
                'owl_ls_items' => array(
                    'label' => esc_html__( 'The items on desktop (Screen resolution of device >= 1500px )', 'urus' ),
                    'type' => \Elementor\Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 100000,
                    'step' => 1,
                    'default' => 4,
                    'condition' => $arr_dependency,
                    'label_block'=> true
                )
            );
            $data_responsive = Urus_Pluggable_Elementor::data_responsive_carousel();
            if ( !empty( $data_responsive ) ) {
                arsort( $data_responsive );
                foreach ( $data_responsive as $key => $item ) {
                    if ( $item['screen'] == 1500 ) {
                        $std = '4';
                    } elseif ( $item['screen'] == 1200 ) {
                        $std = '3';
                    } elseif ( $item['screen'] == 992 || $item['screen'] == 768 ) {
                        $std = '2';
                    } elseif ( $item['screen'] == 480 ) {
                        $std = '2';
                    }
                    $data_carousel["owl_{$item['name']}"] = array(
                        'label' => $item['title'],
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                        'default' => isset( $std ) ? $std : 1,
                        'condition' => $arr_dependency,
                        'label_block'=> true
                    );
                }
            }
            $data_carousel = apply_filters( 'elementor_options_carousel', $data_carousel, $dependency, $value_dependency );
            
            if ( $dependency == null && $value_dependency == null ) {
                $match = array(
                    'owl_navigation_style',
                    'owl_autoplayspeed',
                    'owl_rows_space',
                    'owl_verticalswiping',
                    'owl_center_padding',
                );
                foreach ( $data_carousel as $key => $value ) {
                    if ( !in_array( $key, $match ) ) {
                       
                        unset( $value['condition'] );
                       
                    }
                    $data_value[$key] = $value;
                }
            } else {
                foreach ( $data_carousel as $key => $value ) {
                    $data_value[$key] = $value;
                }
            }
            return $data_value;
        }
        
        public static function data_responsive_carousel(){
            $responsive = array(
                'desktop'          => array(
                    'screen'   => 1500,
                    'name'     => 'lg_items',
                    'title'    => esc_html__( 'The items on desktop (Screen resolution of device <= 1500px )', 'urus' ),
                    'settings' => array(),
                ),
                'laptop'           => array(
                    'screen'   => 1200,
                    'name'     => 'md_items',
                    'title'    => esc_html__( 'The items on desktop (Screen resolution of device  <= 1200px )', 'urus' ),
                    'settings' => array(),
                ),
                'tablet'           => array(
                    'screen'   => 992,
                    'name'     => 'sm_items',
                    'title'    => esc_html__( 'The items on tablet (Screen resolution of device  <= 992px )', 'urus' ),
                    'settings' => array(),
                ),
                'mobile_landscape' => array(
                    'screen'   => 768,
                    'name'     => 'xs_items',
                    'title'    => esc_html__( 'The items on mobile landscape(Screen resolution of device  <= 768px)', 'urus' ),
                    'settings' => array(),
                ),
                'mobile'           => array(
                    'screen'   => 480,
                    'name'     => 'ts_items',
                    'title'    => esc_html__( 'The items on mobile (Screen resolution of device <= 480px)', 'urus' ),
                    'settings' => array(),
                ),
            );
            return apply_filters( 'urus_carousel_responsive_screen', $responsive );
        }
    }
}