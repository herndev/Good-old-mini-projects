<?php
/**
 * @package Punte
 */
global $punte_options;
$transparent_header = isset( $punte_options[ 'transparent-header' ] ) ? $punte_options[ 'transparent-header' ] : false;

if( $transparent_header == true ){
    $transparent_header = 'punte-transparent-header';
}else{
    $transparent_header = '';
}
?>
<header id="masthead" class="site-header header-layout6 <?php echo esc_attr($transparent_header)?>">

    <?php do_action( 'punte_top_header' ); ?>

    <?php do_action( 'punte_before_main_header' ); ?>

    <div class="main-header">
        <div class="punte-container clearfix">
            <div class="site-branding">
                <?php do_action( 'punte_header_logo' ); ?>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'fallback_cb' => false,
                    'container' => false,
                    'menu_class' => 'clearfix punte-main-menu'
                ) );
                ?>
            </nav><!-- #site-navigation -->
        </div>
    </div>

    <?php do_action( 'punte_bottom_header' ); ?>
</header><!-- #masthead -->