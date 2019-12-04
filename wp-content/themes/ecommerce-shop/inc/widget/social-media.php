<?php
/**
 * Display Social Media
 *
 * @package eCommerce_Shop
 */

function ecommerce_shop_action_social_medi() {
	register_widget( 'ecommerce_shop_social_media' );	
}
add_action( 'widgets_init', 'ecommerce_shop_action_social_medi' );

class ecommerce_shop_social_media extends WP_Widget {
	
	function __construct() {
		
		global $control_ops;

		$widget_ops = array(
			'classname'   => 'social-links',
			'description' => esc_html__( 'Add Widget to Display Social Media.', 'ecommerce-shop' )
		);

		parent::__construct( 'ecommerce_shop_social_media',esc_html__( 'ES: Follow Us', 'ecommerce-shop' ), $widget_ops, $control_ops );
	}
    /**
     * Echo the widget content.
     *
     * @since 1.0.0
     *
     * @param array $args     Display arguments including before_title, after_title,
     *                        before_widget, and after_widget.
     * @param array $instance The settings for the particular instance of the widget.
     */
    function widget( $args, $instance ) {

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

        echo $args['before_widget'];

        if ( ! empty( $title ) ) {
            echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
        }

        echo '<div class="social-links">';

        if ( has_nav_menu( 'social-menu' ) ) {
			wp_nav_menu( array(
				'theme_location'  => 'social-menu',
				'container'       => false,							
				'depth'           => 1,
				'fallback_cb'     => false,

			) );
			
        }

        echo '</div>';

        echo $args['after_widget'];

    }

    /**
     * Update widget instance.
     *
     * @since 1.0.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            {@see WP_Widget::form()}.
     * @param array $old_instance Old settings for this instance.
     * @return array Settings to save or bool false to cancel saving.
     */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = sanitize_text_field( $new_instance['title'] );

        return $instance;
    }

    /**
     * Output the settings update form.
     *
     * @since 1.0.0
     *
     * @param array $instance Current settings.
     * @return void
     */
    function form( $instance ) {

        $instance = wp_parse_args( (array) $instance, array(
            'title' => '',
        ) );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'ecommerce-shop' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>

        <?php if ( ! has_nav_menu( 'social-menu' ) ) : ?>
        <p>
            <?php esc_html_e( 'Social menu is not set. Please create menu and assign it to Social Media.', 'ecommerce-shop' ); ?>
        </p>
        <?php endif; ?>
        <?php
    }			

}