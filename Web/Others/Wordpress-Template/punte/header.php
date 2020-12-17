<?php
/**
 * @package Punte
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>

        <?php if ( function_exists( 'wp_body_open' ) ) {
            wp_body_open(); 
        } ?>
        
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to the content', 'punte' ); ?></a>

        <?php 
        /**
         * punte_below_body hook
         *
         *
         * @hooked punte_responsive_navigation
         */
        do_action( 'punte_below_body' );
        ?>
        <div id="page" class="site">

            <?php
            /**
             * punte_header hook.
             *
             * @hooked punte_header_layouts - 10 
             */
            do_action( 'punte_header' );
            ?>

            <div id="content" class="site-content">

