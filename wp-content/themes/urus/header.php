<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action('urus_before_content');?>
<?php Urus_Helper::get_drawers(); ?>
<div class="site-content">
    <?php do_action('urus_before_site_content');?>
	<?php
		if ( ! Urus_Helper::is_mobile_template()) {
			Urus_Helper::get_header();
		}
	?>
<?php Urus_Helper::header_mobile();?>

