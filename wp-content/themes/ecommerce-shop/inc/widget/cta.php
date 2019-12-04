<?php
/**
 * Display Featured Product
 *
 * @package eCommerce_Shop
 */

function ecommerce_shop_action_cta() {
	register_widget( 'ecommerce_shop_cta' );	
}
add_action( 'widgets_init', 'ecommerce_shop_action_cta' );

class ecommerce_shop_cta extends WP_Widget {
	
	function __construct() {
		
		global $control_ops;

		$widget_ops = array(
			'classname'   => 'cta-section',
			'description' => esc_html__( 'Add Widget to Display CTA.', 'ecommerce-shop' )
		);

		parent::__construct( 'ecommerce_shop_cta',esc_html__( 'ES: CTA', 'ecommerce-shop' ), $widget_ops, $control_ops );
	}
	function form( $instance ) {
		$defaults[ 'cta' ]           	= '';
		$defaults[ 'button' ]           = esc_html__( 'Shop', 'ecommerce-shop');
		$defaults[ 'button_url' ]       = '';

		$instance = wp_parse_args( (array) $instance, $defaults );

		$cta            = absint( $instance[ 'cta' ] );
		$button         = esc_html( $instance[ 'button' ] );
		$button_url     = esc_url_raw( $instance[ 'button_url' ] );
		
	?>	
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'cta' )); ?>">
                <strong><?php esc_html_e( 'CTA Page:', 'ecommerce-shop' ); ?></strong>
            </label>
            <?php
            wp_dropdown_pages( array(
                'id'               => esc_attr($this->get_field_id( 'cta' )),
                'class'            => 'widefat',
                'name'             => esc_attr($this->get_field_name( 'cta' )),
                'selected'         => $instance[ 'cta' ],
                'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'ecommerce-shop' ),
                )
            );
            ?>
        </p>	
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'button' )); ?>"><?php esc_html_e( 'Button Title:', 'ecommerce-shop' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button' ) ); ?>" type="text" value="<?php echo esc_attr( $button ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'button_url' )); ?>"><?php esc_html_e( 'Button Url:', 'ecommerce-shop' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_url' ) ); ?>" type="text" value="<?php echo esc_url( $button_url ); ?>" />
		</p>								


	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;		
		$instance[ 'cta' ]       = absint( $new_instance[ 'cta' ] );
		$instance[ 'button' ]     = sanitize_text_field( $new_instance[ 'button' ] );
		$instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		$cta        = isset( $instance[ 'cta' ] ) ? $instance[ 'cta' ] : '';
		$button = ! empty( $instance['button'] ) ? esc_html($instance['button']) : esc_html__( 'Shop', 'ecommerce-shop' );		
		$button_url = ! empty( $instance['button_url'] ) ? esc_url($instance['button_url']) : '';
		?>		
			<?php if ( !empty( $cta ) ): 
				$args = array(
                    'posts_per_page' => 1,
                    'page_id'        => absint( $cta ),
                    'post_type'      => 'page',
                    'post_status'    => 'publish',
                );

				$cta = new WP_Query( $args );

				if ( $cta->have_posts() ): ?>						
					<?php while ( $cta->have_posts() ): $cta->the_post(); 
					$image_id = get_post_thumbnail_id();
					$image_url = wp_get_attachment_image_src($image_id,'full', false);
					?>
					<section class="cta-section" style="background-image: url(<?php echo esc_url( $image_url[0] ) ?>);">
						<div class="container">
							<div class="product-main clearfix">
								<div class="product-list-info">
									<header class="entry-header">
										<h2 class="entry-title"><span><?php the_title();?></span></h2>
									</header>
									<?php if ( !empty( $button ) ): ?>
										<a class="product-button" href="<?php echo esc_url( $button_url);?>"><span><?php echo esc_html( $button);?></span></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</section>
					<?php endwhile;
					wp_reset_postdata(); ?>
						
				<?php endif;  ?>
			<?php endif; 

	}	

}