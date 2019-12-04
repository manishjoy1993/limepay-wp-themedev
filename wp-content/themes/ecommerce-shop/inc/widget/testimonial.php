<?php
/**
 * Display Testimonial Slider
 *
 * @package eCommerce_Shop
 */

function ecommerce_shop_action_testimonial() {
	register_widget( 'ecommerce_shop_testimonial' );	
}
add_action( 'widgets_init', 'ecommerce_shop_action_testimonial' );

class ecommerce_shop_testimonial extends WP_Widget {
	
	function __construct() {
		
		global $control_ops;

		$widget_ops = array(
			'classname'   => 'testimonial',
			'description' => esc_html__( 'Add Widget to Display Testimonial.', 'ecommerce-shop' )
		);

		parent::__construct( 'ecommerce_shop_testimonial',esc_html__( 'ES: Testimonial', 'ecommerce-shop' ), $widget_ops, $control_ops );
	}
	function form( $instance ) {
		$defaults[ 'category' ]         = '';
		$defaults[ 'number' ]   = 3;
		$instance = wp_parse_args( (array) $instance, $defaults );

		$category         = absint( $instance[ 'category' ] );
		$number   = absint( $instance[ 'number' ] );		
	?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Select Category:', 'ecommerce-shop' ); ?></label>
			<?php
			wp_dropdown_categories(
				array(
					'show_option_none' => '',
					'show_option_all'  => esc_html__('Select','ecommerce-shop'),
					'name'             => $this->get_field_name( 'category' ),
					'class'			   => 'widefat',	
					'name'             => esc_attr($this->get_field_name( 'category' )),
					'selected'         => absint( $category ), 
				)
			);
			?>
		</p>	

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of Products:', 'ecommerce-shop' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" value="<?php echo esc_attr( $number ); ?>" />
		</p>				


	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'category' ]       = absint( $new_instance[ 'category' ] );
		$instance[ 'number' ] = absint( $new_instance[ 'number' ] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		$category        = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
		$number  = isset( $instance[ 'number' ] ) ? $instance[ 'number' ] : 3;	

		echo $before_widget;

	        $args = array(
	            'posts_per_page' => absint( $number ),
	            'post_type' => 'post',
	            'post_status' => 'publish',      
	        );

	        if ( absint( $category ) > 0 ) {
	          $args['cat'] = absint( $category );
	        }

			$testimonial_arg = new WP_Query( $args );

			if ( $testimonial_arg->have_posts() ): ?>
				<div class="testimonial-slider owl-carousel owl-theme">
					<?php while ( $testimonial_arg->have_posts() ): $testimonial_arg->the_post(); 
					$image_id = get_post_thumbnail_id();
					$image_url = wp_get_attachment_image_src($image_id,'ecommerce-shop-woocommerce-testimonial', false);
					?>
						<div class="item">
							<div class="test-wrap clearfix">
								<div class="image-wrap">
									<img src="<?php echo esc_url( $image_url[0] ) ?>">
								</div>
								<div class="product-main">
									<div class="testimonial-content">
										<div class="testimonial-desc">
											<?php
			                                    $excerpt = ecommerce_shop_the_excerpt( 10 );
			                                    echo wp_kses_post( wpautop( $excerpt ) );
			                                ?>
										</div>
										<div class="testimonial-desc-bottom">
											<h4><?php the_title(); ?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile;
					wp_reset_postdata(); ?>
				</div>	
			<?php endif;  

		echo $after_widget;
	}	

}