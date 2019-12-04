<?php
/**
 * Display Client Section
 *
 * @package eCommerce_Shop
 */

function ecommerce_shop_action_client() {
	register_widget( 'ecommerce_shop_client' );	
}
add_action( 'widgets_init', 'ecommerce_shop_action_client' );

class ecommerce_shop_client extends WP_Widget {
	
	function __construct() {
		
		global $control_ops;

		$widget_ops = array(
			'classname'   => 'client-section',
			'description' => esc_html__( 'Add Widget to Display client.', 'ecommerce-shop' )
		);

		parent::__construct( 'ecommerce_shop_client',esc_html__( 'ES: Client', 'ecommerce-shop' ), $widget_ops, $control_ops );
	}
	function form( $instance ) {
		$defaults[ 'logo_items' ]     = '';	
		$instance = wp_parse_args( (array) $instance, $defaults );
		$logo_items 	= $instance['logo_items'];			
	?>
        <!--updated code-->            
        <div class="ecommerce-repeater">
        	<label><?php esc_html_e( 'Add Client Image', 'ecommerce-shop' ); ?></label><br/>
        
			<?php
			$total_repeater = 0;
			if  (  is_array( $logo_items )  &&  count( $logo_items ) > 0 ){
				foreach ($logo_items as $logo_detail){
					$repeater_id  = $this->get_field_id( 'logo_items') .$total_repeater.'logo_img_url';
					$repeater_name  = $this->get_field_name( 'logo_items' ).'['.$total_repeater.']['.'logo_img_url'.']';

					$repeater_id_1  = $this->get_field_id( 'logo_items') .$total_repeater.'logo_img_link';
					$repeater_name_1  = $this->get_field_name( 'logo_items' ).'['.$total_repeater.']['.'logo_img_link'.']';
					?>
                    <div class="repeater-table">
                        <div class="ecommerce-repeater-top">
                            <div class="ecommerce-repeater-title-action">
                                <button type="button" class="ecommerce-repeater-action">
                                    <span class="ecommerce-toggle-indicator" aria-hidden="true"></span>
                                </button>
                            </div>
                            <div class="ecommerce-repeater-title">
                                <h3><?php esc_html_e( 'Select Logo', 'ecommerce-shop' )?><span class="in-ecommerce-repeater-title"></span></h3>
                            </div>
                        </div>
                        <div class='ecommerce-repeater-inside hidden'>
                            <?php
                            $ecommerce_shop_display_none = '';
                            if ( empty( $logo_detail['logo_img_url'] ) ){
	                            $ecommerce_shop_display_none = ' style="display:none;" ';
                            }
                            ?>
                            <span class="img-preview-wrap" <?php echo esc_attr( $ecommerce_shop_display_none ); ?>>
                                <img class="widefat" src="<?php echo esc_url( $logo_detail['logo_img_url'] ); ?>" alt="<?php esc_attr_e( 'Image preview', 'ecommerce-shop' ); ?>"  />
                            </span><!-- .img-preview-wrap -->
                            <input type="text" class="widefat" name="<?php echo esc_attr( $repeater_name ); ?>" id="<?php echo esc_attr( $repeater_id ); ?>" value="<?php echo esc_url( $logo_detail['logo_img_url'] ); ?>" />
                            <input type="button" value="<?php esc_attr_e( 'Upload Image', 'ecommerce-shop' ); ?>" class="button media-image-upload" data-title="<?php esc_attr_e( 'Select Image','ecommerce-shop'); ?>" data-button="<?php esc_attr_e( 'Select Image','ecommerce-shop'); ?>"/>
                            <input type="button" value="<?php esc_attr_e( 'Remove Image', 'ecommerce-shop' ); ?>" class="button media-image-remove" />

                            <p>
                                <label><?php esc_html_e( 'Enter Image Link', 'ecommerce-shop' ); ?></label>
                                <input type="text" class="widefat" name="<?php echo esc_attr( $repeater_name_1 ); ?>" id="<?php echo esc_attr( $repeater_id_1 ); ?>" value="<?php echo esc_url( $logo_detail['logo_img_link'] ); ?>" />
                            </p>

                            <div class="ecommerce-repeater-control-actions">
                                <button type="button" class="button-link button-link-delete ecommerce-repeater-remove"><?php esc_html_e('Remove','ecommerce-shop');?></button> |
                                <button type="button" class="button-link ecommerce-repeater-close"><?php esc_html_e('Close','ecommerce-shop');?></button>
                            </div>
                        </div>
                    </div>
					<?php
					$total_repeater = $total_repeater + 1;
				}
			}
			$coder_repeater_depth = 'coderRepeaterDepth_'.'0';
			$repeater_id  = $this->get_field_id( 'logo_items') .$coder_repeater_depth.'logo_img_url';
			$repeater_name  = $this->get_field_name( 'logo_items' ).'['.$coder_repeater_depth.']['.'logo_img_url'.']';

			$repeater_id_1  = $this->get_field_id( 'logo_items') .$coder_repeater_depth.'logo_img_link';
			$repeater_name_1  = $this->get_field_name( 'logo_items' ).'['.$coder_repeater_depth.']['.'logo_img_link'.']';
			?>
            <script type="text/html" class="ecommerce-code-for-repeater">
                <div class="repeater-table">
                    <div class="ecommerce-repeater-top">
                        <div class="ecommerce-repeater-title-action">
                            <button type="button" class="ecommerce-repeater-action">
                                <span class="ecommerce-toggle-indicator" aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="ecommerce-repeater-title">
                            <h3><?php esc_html_e( 'Select Logo', 'ecommerce-shop' )?><span class="in-ecommerce-repeater-title"></span></h3>
                        </div>
                    </div>
                    <div class='ecommerce-repeater-inside hidden'>
                        <?php
                        $ecommerce_shop_display_none = ' style="display:none;" ';
                        ?>
                        <span class="img-preview-wrap" <?php echo esc_attr( $ecommerce_shop_display_none ) ; ?>>
                            <img class="widefat" src="" alt="<?php esc_attr_e( 'Image preview', 'ecommerce-shop' ); ?>"  />
                        </span><!-- .img-preview-wrap -->
                        <input type="text" class="widefat" name="<?php echo esc_attr( $repeater_name ); ?>" id="<?php echo esc_attr( $repeater_id ); ?>" value="" />
                        <input type="button" value="<?php esc_attr_e( 'Upload Image', 'ecommerce-shop' ); ?>" class="button media-image-upload" data-title="<?php esc_attr_e( 'Select Image','ecommerce-shop'); ?>" data-button="<?php esc_attr_e( 'Select Image','ecommerce-shop'); ?>"/>
                        <input type="button" value="<?php esc_attr_e( 'Remove Image', 'ecommerce-shop' ); ?>" class="button media-image-remove" />

                        <p>
                            <label><?php esc_html_e( 'Enter Image Link', 'ecommerce-shop' ); ?></label>
                            <input type="text" class="widefat" name="<?php echo esc_attr( $repeater_name_1 ); ?>" id="<?php echo esc_attr( $repeater_id_1 ); ?>" />
                        </p>

                        <div class="ecommerce-repeater-control-actions">
                            <button type="button" class="button-link button-link-delete ecommerce-repeater-remove"><?php esc_html_e('Remove','ecommerce-shop');?></button> |
                            <button type="button" class="button-link ecommerce-repeater-close"><?php esc_html_e('Close','ecommerce-shop');?></button>
                        </div>
                    </div>
                </div>

            </script>
			<?php
			/*most imp for repeater*/
			echo '<input class="ecommerce-total-repeater" type="hidden" value="'.esc_attr( $total_repeater ).'">';
			$add_field = esc_html__('Add Image', 'ecommerce-shop');
			echo '<span class="button-primary ecommerce-add-repeater" id="'.esc_attr( $coder_repeater_depth ).'">'.$add_field.'</span><br/>';
			?>
        </div>
        <!--updated code-->
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/*updated code*/
		$logo_img_details = array();
		if( isset($new_instance['logo_items'] )){
			$logo_items    = $new_instance['logo_items'];
			if  (count($logo_items) > 0 && is_array($logo_items) ){
				foreach ($logo_items as $key=>$logo_detail ){
					$logo_img_details[$key]['logo_img_url'] = esc_url_raw( $logo_detail['logo_img_url'] );
					$logo_img_details[$key]['logo_img_link'] = esc_url_raw( $logo_detail['logo_img_link'] );
				}
			}
        }
		$instance[ 'logo_items' ] = $logo_img_details;
		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		//$logo_items    = $instance['logo_items'];
		$logo_items 		= !empty( $instance['logo_items'] ) ? $instance['logo_items'] : '';	
		?>	
		<?php if ( $logo_items ): ?>
			<section class="client-section">
		    	
					<div class="client-section-wrap">
						<div class="container">
							<div class="client-carousel owl-carousel owl-theme">
								<?php foreach ( $logo_items as $logo_detail ){ 
								$logo_img_url = esc_url( $logo_detail['logo_img_url'] );
				                $logo_img_link = esc_url( $logo_detail['logo_img_link'] );?>
				                	<?php if( !empty( $logo_img_url ) ): ?>
										<div class="item">	
											<a href="<?php echo esc_url( $logo_img_link);?>"><img src="<?php echo esc_url( $logo_img_url) ?>"></a>
										</div>	
									<?php endif; ?>
								<?php } ?>						
							</div>
						</div>		
					</div>	
				

			</section>	
		<?php endif; ?>
		<?php

	}	

}