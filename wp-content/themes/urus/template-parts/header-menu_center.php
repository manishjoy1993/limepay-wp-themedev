
<?php
    $enable_sticky_header = Urus_Helper::get_option('enable_sticky_header',0);
    
    $header_class = array('header default logo_left menu-center');
    if ($enable_sticky_header){
        $header_class[] = 'header-sticky';
    }
    $header_light = Urus_Helper::get_option('header_dark',0);
    if($header_light == 1){
        $header_class[] ='dark';
    }
?>
<header id="header" class="<?php echo esc_attr( implode( ' ', $header_class ) ); ?>">
    <div class="container-wapper">
        <div id="urus-menu-wapper"></div>
        <div class="main-header">
            <div class="logo">
                <?php Urus_Helper::get_logo();?>
            </div>
            <div class="main-menu-wapper">
                <?php
                    if(has_nav_menu('primary')){
                        wp_nav_menu( array(
                            'menu'            => 'primary',
                            'theme_location'  => 'primary',
                            'container'       => '',
                            'container_class' => '',
                            'container_id'    => '',
                            'menu_class'      => 'urus-nav main-menu  urus-clone-mobile-menu',
                        ));
                    }
                ?>
            </div>
            <?php
                ob_start();
                do_action('urus_header_right_control');
                $html = ob_get_clean();
            ?>
            <?php if($html != ''):?>
                <div class="header-control right">
                    <?php echo Urus_Helper::escaped_html($html);?>
                </div>
            <?php endif;?>
        </div>
    </div>
</header>