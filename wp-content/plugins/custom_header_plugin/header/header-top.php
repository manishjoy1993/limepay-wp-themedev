
<?php
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	// echo $image[0];

	$blog_title = get_bloginfo( 'name' );
?>

<div class="header_top">
	<div class="header_top_items">
		<div class="header_top_left">
			<span class="top_left_name"><?php echo $blog_title; ?></span>
			<!-- <span class="top_left_logo">
				<img src="<?php echo $image[0]; ?>">
			</span> -->
		</div>
		<div class="header_top_right">
			<div class="account_page">
				<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account',''); ?>"><i class="fa fa-user"></i> <?php _e('My Account',''); ?></a>
			</div>
			<div class="help_page">
				<a href="" class="help_page_link">Help</a>
			</div>
			<div class="loc_lang">
				<span><i class="fa fa-map-marker" class="map_marker"></i><?php _e(' India',''); ?></span>
			</div>

		</div>
	</div>
</div>