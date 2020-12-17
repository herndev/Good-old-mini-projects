<?php

/**
 * @package Punte
 */
function punte_body_classes( $classes ) {
    global $punte_options, $post;

    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( !is_singular() ) {
        $classes[] = 'hfeed';
    }


    if ( is_archive() && !is_post_type_archive() ) {
        $archive_layout = isset( $punte_options[ 'archive-layout' ] ) ? $punte_options[ 'archive-layout' ] : 'right-sidebar';

        $classes[] = esc_attr( $archive_layout );
    }

    if ( is_search() ) {
        $search_layout = isset( $punte_options[ 'search-layout' ] ) ? $punte_options[ 'search-layout' ] : 'right-sidebar';

        $classes[] = esc_attr( $search_layout );
    }

    if ( is_404() ) {
        $error_layout = isset( $punte_options[ '404-layout' ] ) ? $punte_options[ '404-layout' ] : 'right-sidebar';

        $classes[] = esc_attr( $error_layout );
    }

    if ( is_home() ) {
        $blog_layout = isset( $punte_options[ 'blog-layout' ] ) ? $punte_options[ 'blog-layout' ] : 'right-sidebar';

        $classes[] = esc_attr( $blog_layout );
    }

    if ( punte_is_woocommerce_activated() ) {

        if ( is_singular( 'product' ) ) {
            $woo_layout = isset( $punte_options[ 'woocommerce-single-layout' ] ) ? $punte_options[ 'woocommerce-single-layout' ] : 'right-sidebar';
            
            $classes[] = esc_attr( $woo_layout );
        }

        if ( is_shop() || is_product_category() ) {
            $woocommerce_layout = isset( $punte_options[ 'woocommerce-layout' ] ) ? $punte_options[ 'woocommerce-layout' ] : 'right-sidebar';
            $classes[] = esc_attr( $woocommerce_layout );
        }
    }

    return $classes;
}

add_filter( 'body_class', 'punte_body_classes' );

function punte_post_classes( $classes ) {
    global $punte_options;
    $blog_style = isset( $punte_options[ 'blog-style' ] ) ? $punte_options[ 'blog-style' ] : 'blog-style2';

    if ( is_category() || is_time() || is_year() || is_author() || is_date() || is_day() || is_month() || is_tag() || is_home() ) {
        $classes[] = esc_attr( $blog_style );
        $classes[] = 'punte-blog-post';
    }

    return $classes;
}

add_filter( 'post_class', 'punte_post_classes' );

if ( !function_exists( 'punte_is_woocommerce_activated' ) ) {

    function punte_is_woocommerce_activated() {
        if ( class_exists( 'woocommerce' ) ) {
            return true;
        } else {
            return false;
        }
    }

}