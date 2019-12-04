<?php
/**
 * Display Best Seller
 *
 * @package eCommerce_Shop
 */

function ecommerce_shop_action_best_seller() {
	register_widget( 'ecommerce_shop_best_seller' );	
}
add_action( 'widgets_init', 'ecommerce_shop_action_best_seller' );

class ecommerce_shop_best_seller extends WP_Widget {
	
	function __construct() {
		
		global $control_ops;

		$widget_ops = array(
			'classname'   => 'best-seller-wrapper',
			'description' => esc_html__( 'Add Widget to Display WooCommerce Product.', 'ecommerce-shop' )
		);

		parent::__construct( 'ecommerce_shop_best_seller',esc_html__( 'ES: Best Seller', 'ecommerce-shop' ), $widget_ops, $control_ops );
	}
	function form( $instance ) {
		$defaults[ 'title' ]           = esc_html__( 'Best Seller', 'ecommerce-shop');
		$defaults[ 'category' ]  = '';
		$defaults[ 'product_number' ]   = 3;
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title            = esc_html( $instance[ 'title' ] );
		$category         = absint( $instance[ 'category' ] );
		$product_number   = absint( $instance[ 'product_number' ] );		
	?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'ecommerce-shop' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
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
						


	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ]          = sanitize_text_field( $new_instance[ 'title' ] );
		$instance[ 'category' ]       = absint( $new_instance[ 'category' ] );
		$instance[ 'product_number' ] = absint( $new_instance[ 'product_number' ] );
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = ! empty( $instance['title'] ) ? esc_html($instance['title']) : esc_html__( 'Best Seller', 'ecommerce-shop' );
		$category        = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
		$product_number  = isset( $instance[ 'product_number' ] ) ? $instance[ 'product_number' ] : 3;

		echo $before_widget;
		?>
		<div class="container">	

			<header class="entry-header">
				<h2 class="entry-title"><?php echo esc_html( $title);?></h2>
			</header>
	            	       	
			<?php $args = array(
				'post_type' => 'product',
				'meta_key' => 'total_sales',
    			'orderby' => 'meta_value_num',				
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

			$tab_arg = new WP_Query( $args );

			if ( $tab_arg->have_posts() ): ?>
				<div class="related products">
					<?php while ( $tab_arg->have_posts() ): $tab_arg->the_post();
						global $post; 
						$product = wc_get_product( $tab_arg->post->ID ); 
						$image_id = get_post_thumbnail_id();
						$image_url = wp_get_attachment_image_src($image_id,'ecommerce-shop-product-slider', false);
						$image_alt  = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
						if ( '' == $image_alt ){
							$image_alt = get_the_title();
						}
						
					?>
						<div class="element-item">

							<div class="product-list-wrapper">								
								<figure class="featured-img">
									<?php if($image_url[0]) { ?>
										<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"><img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>"></a>
									<?php } else { ?>
										<a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>"><img src="<?php echo esc_url(ecommerce_market_woocommerce_placeholder_img_src()); ?>" alt="<?php echo esc_attr( $image_alt ); ?>"></a>
									<?php } ?>


									<?php if ( $product->is_on_sale() ) : 
										$sale_price = $product->get_sale_price();
										$regular_price=   $product->get_regular_price();

										
										if ( $product->is_type( 'variable' ) || $product->is_type('grouped') ){ 
											$discount = '';
										} else{
											$discount_price = $regular_price-$sale_price;	
											$discount = round(($discount_price / $regular_price) * 100);	
										}								
									?>
										<?php if ( !$product->is_in_stock() ) { ?>
											<div class="soldout woocommerce"> 
												<?php
												    global $product;
												 
												    if ( !$product->is_in_stock() ) {
												        echo '<span>' . esc_html__( 'SOLD OUT', 'ecommerce-shop' ) . '</span>';
												    } 
											    ?>
											</div>	

										<?php } else{ ?>

											<?php echo apply_filters( 'woocommerce_sale_flash', '<div class="sales-tag"><span>' .absint( $discount ) . esc_html__( '% off', 'ecommerce-shop' ) . '</span></div>', $post, $product ); ?>

										<?php  } ?>
									
									<?php endif; ?>	

								</figure>										
														
								<div class="list-info">	
									<header class="entry-header">

										<a href="<?php the_permalink();?>">
											<h3 class="entry-title"><?php the_title();?></h3>
										</a>
										
									</header>

									<?php if ( $price_html = $product->get_price_html() ) : ?>
										<span class="price"><?php echo wp_kses_post($price_html); ?></span>
									<?php endif; ?>
									<div class="woocommerce-product-rating woocommerce"> <?php
										 if ( $rating_html = wc_get_rating_html( $product->get_average_rating() ) ) { ?>
												<?php echo wp_kses_post($rating_html); ?>
											<?php } else {
												echo '<div class="star-rating"></div>' ;
											}?>
									</div>
									<div class="icons">
										<?php woocommerce_template_loop_add_to_cart( $product );?>
										<?php
										if( function_exists( 'YITH_WCWL' ) ){
											$url = add_query_arg( 'add_to_wishlist', $product->get_id() );
										?>
											<a href="<?php echo esc_url($url); ?>" class="single_add_to_wishlist" ><i class="fa fa-heart"></i>
											</a>										
										<?php } ?>

										<?php
										if( function_exists( 'yith_wcqv_init' ) ){
											$product_id = $product->get_id();	
										?>
											<a href="#" class="btn yith-wcqv-button" data-product_id="<?php echo absint( $product_id );?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
										<?php } ?>

									</div>									
								</div>

							</div>

						</div>
					<?php endwhile;
					wp_reset_postdata(); ?>
					</div>	
				<?php endif;?> 
			
		</div>

		<?php echo $after_widget;
	}	

}