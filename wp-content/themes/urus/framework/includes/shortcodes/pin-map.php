<?php
if( !class_exists('Urus_Shortcodes_Pin_Map')){
    class  Urus_Shortcodes_Pin_Map extends Urus_Shortcodes{
        /**
         * Shortcode name.
         *
         * @var  string
         */
        public $shortcode = 'pin_map';
        function __construct(){
            parent::__construct();
            add_action( 'vc_before_init', array($this, 'vc_map'));
        }

        static public function add_css_generate( $atts ){
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'urus_pin_map', $atts ) : $atts;
            // Extract shortcode parameters.
            extract( $atts );
            $css = '';
            return apply_filters( 'urus_shortcodes_title_css_render', $css, $atts );
        }
        public function output_html( $atts, $content = null ){
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'urus_pin_map', $atts ) : $atts;
            extract( $atts );
            $css_class    = array( 'urus-pin-map' );
            $css_class[]  = $atts['el_class'];
            $css_class[]  = $atts['urus_custom_id'];
            $class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
            $css_class[]  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'urus_pin_map', $atts );
            
            ob_start();
            ?>
            <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                <?php echo do_shortcode( '[urus_pinmap id="' . $atts['pinmap_id'] . '"]' ); ?>
            </div>
            <?php
            return apply_filters('urus_shortcode_title_output', ob_get_clean(), $atts, $content);
        }
        public function vc_map(){

            $params    = array(
                'base'        => 'urus_pin_map',
                'name'        => esc_html__( 'Pin Maper', 'urus' ),
                'icon'        => URUS_THEME_URI. 'assets/images/admin/vc_icon.svg',
                'category'    => esc_html__( 'Urus Elements', 'urus' ),
                'description' => esc_html__( 'Display Pin Maper', 'urus' ),
                'params'      => array(
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__( 'Pin Maper', 'urus' ),
                        'param_name'  => 'pinmap_id',
                        'value'       =>Urus_Helper::pinmapper_options(),
                        'admin_label'   => true,
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => esc_html__('CSS box', 'urus'),
                        'param_name' => 'css',
                        'group'      => esc_html__( 'Design Options', 'urus' ),
                    ),
                )

            );
            $params = apply_filters($this->shortcode.'_shortcode_setup', $params);
            vc_map( $params );
        }
    }
}