<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$woo_single_layout = Urus_Helper::get_option('woo_single_layout','left');
$woo_single_used_layout = Urus_Helper::get_option('woo_single_used_layout','vertical');
$woo_product_item_layout = Urus_Helper::get_option('woo_product_item_layout','classic');
if( $woo_single_layout == 'full'){
    $atts = array(
        'loop'         => 'false',
        'ts_items'     => 2,
        'xs_items'     => 3,
        'sm_items'     => 3,
        'md_items'     => 3,
        'lg_items'     => 4,
        'ls_items'     => 4,
        'navigation'   => 'false',
        'slide_margin' => 30,
        'dots' => 'true'
    );
}else{
    $atts = array(
        'loop'         => 'false',
        'ts_items'     => 2,
        'xs_items'     => 2,
        'sm_items'     => 3,
        'md_items'     => 4,
        'lg_items'     => 4,
        'ls_items'     => 5,
        'navigation'   => 'true',
        'slide_margin' => 30,
        'dots' => 'true'
    );
}
$atts['responsive_settings'] = array(
    '1500' => array(

    ),
    '1200' => array(
    ),
    '992' => array(
        'slide_margin' => 20
    ),
    '768' => array(
        'slide_margin' => 20
    ),
    '480' => array(
        'slide_margin' => 15
    )
);

$atts = apply_filters('urus_upsells_products_carousel_settings',$atts);
$carousel_settings = Urus_Helper::carousel_data_attributes('',$atts);

$product_item_class = array('product-item');
$product_item_class[] = $woo_product_item_layout;

if ( $upsells ) : ?>

    <section class="up-sells upsells products urus-box-products container">
        <div class="box-head">
            <h2 class="title"><?php esc_html_e( 'You may also like&hellip;', 'urus' ); ?></h2>
        </div>
        <div class="urus-products urus-products-carousel swiper-container urus-swiper nav-center" <?php echo esc_attr($carousel_settings);?>>
            <div class="swiper-wrapper">
                <?php foreach ( $upsells as $upsell ) : ?>
                    <div class="swiper-slide">
                        <?php
                        $post_object = get_post( $upsell->get_id() );

                        setup_postdata( $GLOBALS['post'] =& $post_object );

                       ?>
                        <div <?php post_class($product_item_class); ?>>
                            <?php
                            wc_get_template_part('product-styles/content-product', $woo_product_item_layout );
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
            
        </div>
        <!-- If we need navigation buttons -->
        <div class="slick-arrow next">
            <?php echo familab_icons('arrow-right'); ?>
        </div>
        <div class="slick-arrow prev">
            <?php echo familab_icons('arrow-left'); ?>
        </div>
    </section>

<?php endif;

wp_reset_postdata();
