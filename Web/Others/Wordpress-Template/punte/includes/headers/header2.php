<?php
/**
 * @package Punte
 */
?>
<header id="masthead" class="site-header header-layout2">

    <?php do_action( 'punte_before_main_header' ); ?>

    <div class="main-header">
        <div class="punte-container clearfix flex-box">
            <div class="site-branding">
                <?php do_action( 'punte_header_logo' ); ?>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <?php do_action( 'punte_top_header' ); ?>

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