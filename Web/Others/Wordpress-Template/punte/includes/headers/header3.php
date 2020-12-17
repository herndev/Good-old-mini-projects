<?php
/**
 * @package Punte
 */
?>
<header id="masthead" class="site-header header-layout3">

    <?php do_action( 'punte_top_header' ); ?>

    <?php do_action( 'punte_before_main_header' ); ?>

    <div class="main-header">
        <div class="clearfix main-top-header punte-container flex-box">
            <div class="site-branding">
                <?php do_action( 'punte_header_logo' ); ?>
            </div><!-- .site-branding -->

            <?php if ( is_active_sidebar( 'punte-header-widget' ) ) { ?>
                <div class="header-widget">
                    <?php dynamic_sidebar( 'punte-header-widget' ) ?>
                </div>
            <?php } ?>
        </div>

        <nav id="site-navigation" class="main-navigation">
            <div class="punte-container">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'fallback_cb' => false,
                    'container' => false,
                    'menu_class' => 'clearfix punte-main-menu'
                ) );
                ?>
            </div>
        </nav><!-- #site-navigation -->
    </div>

    <?php do_action( 'punte_bottom_header' ); ?>

</header><!-- #masthead -->