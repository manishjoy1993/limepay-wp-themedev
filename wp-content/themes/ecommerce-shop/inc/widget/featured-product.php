<?php
/**
 * Display Featured Product
 *
 * @package eCommerce_Shop
 */

function ecommerce_shop_action_featured_product() {
	register_widget( 'ecommerce_shop_featured_product' );	
}
add_action( 'widgets_init', 'ecommerce_shop_action_featured_product' );

class ecommerce_shop_featured_product extends WP_Widget {
	
	function __construct() {
		
		global $control_ops;

		$widget_ops = array(
			'classname'   => 'main-product-section',
			'description' => esc_html__( 'Add Widget to Display WooCommerce Featured Slider.', 'ecommerce-shop' )
		);

		parent::__construct( 'ecommerce_shop_featured_product',esc_html__( 'ES: Feature Product', 'ecommerce-shop' ), $widget_ops, $control_ops );
	}
	function form( $instance ) {
		$defaults[ 'button' ]           = esc_html__( 'Shop', 'ecommerce-shop');
		$defaults[ 'category' ]         = '';
		$defaults[ 'product_number' ]   = 2;
		$instance = wp_parse_args( (array) $instance, $defaults );

		$button            = esc_html( $instance[ 'button' ] );
		$category         = absint( $instance[ 'category' ] );
		$product_number   = absint( $instance[ 'product_number' ] );		
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
					'selected'         => $instance['category'],
					'taxonomy'         => 'product_cat'
				)
			);
			?>
		</p>	

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'product_number' ) ); ?>"><?php esc_html_e( 'Number of Products:', 'ecommerce-shop' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'product_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'product_number' ) ); ?>" type="number" value="<?php echo esc_attr( $product_number ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'button' )); ?>"><?php esc_html_e( 'Button Title:', 'ecommerce-shop' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button' ) ); ?>" type="text" value="<?php echo esc_attr( $button ); ?>" />
		</p>						


	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'button' ]          = sanitize_text_field( $new_instance[ 'button' ] );
		$instance[ 'category' ]       = absint( $new_instance[ 'category' ] );
		$instance[ 'product_number' ] = absint( $new_instance[ 'product_number' ] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		$category        = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
		$product_number  = isset( $instance[ 'product_number' ] ) ? $instance[ 'product_number' ] : 3;
		$button = ! empty( $instance['button'] ) ? esc_html($instance['button']) : esc_html__( 'Shop', 'ecommerce-shop' );

		echo $before_widget;
		?>

		<div class="container">
			<div class="clearfix product-main-wrap">

				<?php $args = array(
					'post_type' => 'product',
					'posts_per_page' => absint( $product_number ),	
				);
				if ( absint($category ) > 0 ){
					$args['tax_query'] = array(
						array(
							'taxonomy'  => 'product_cat',
							'field'     => 'id',
							'terms'     => absint( $category ),
						)
					);
				}

				$slider_arg = new WP_Query( $args );

				if ( $slider_arg->have_posts() ): ?>
					
					<?php while ( $slider_arg->have_posts() ): $slider_arg->the_post(); 
					$image_id = get_post_thumbnail_id();
					$image_url = wp_get_attachment_image_src($image_id,'ecommerce-shop-main-slider', false);
					?>
					<div class="product-main">
						<div class="product-main-inner">
							<div class="product-list-info">
								<div class="post-cat-list">
									<?php ecommerce_shop_product_category(); ?>
								</div>
								<header class="entry-header " >
									<h2 class="entry-title"><?php the_title();?></h2>
								</header>
								<div class="entry-content ">
									<?php
	                                    $excerpt = ecommerce_shop_the_excerpt( 10 );
	                                    echo wp_kses_post( wpautop( $excerpt ) );
	                                ?>
								</div>
								<a class="product-button" href="<?php the_permalink();?>" ><span><?php echo esc_html( $button );?></span></a>
							</div>
							<div class="product-img">
								<?php the_post_thumbnail( 'ecommerce-shop-featured-product' );?>
							</div>
						</div>
					</div>
					<?php endwhile;
					wp_reset_postdata(); ?>
						
				<?php endif;  ?>
			</div>		
		</div>
		<?php echo $after_widget;
	}	

}