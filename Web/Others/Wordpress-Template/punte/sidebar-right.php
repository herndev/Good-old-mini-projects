<?php
/**
 * @package Punte
 */
wp_print_styles( array( 'punte-sidebar' ) ); 

global $punte_options, $post;
$sidebar_style = isset( $punte_options[ 'sidebar-style' ] ) ? $punte_options[ 'sidebar-style' ] : 'sidebar-style1';

$sidebar_id = 'sidebar-right';

if ( is_singular( 'page' ) ) {
    $sidebar_id = punte_get_redux_post_meta( 'mb-page-right-sidebar', 'punte-sidebar-right' );
    $sidebar_id = !empty( $sidebar_id ) ? $sidebar_id : 'sidebar-right';
} elseif ( is_singular( 'post' ) ) {
    $sidebar_id = punte_get_redux_post_meta( 'mb-post-right-sidebar', 'punte-sidebar-right' );
    $sidebar_id = !empty( $sidebar_id ) ? $sidebar_id : 'sidebar-right';
} elseif ( is_singular( 'portfolio' ) ) {
    $sidebar_id = punte_get_redux_post_meta( 'mb-portfolio-right-sidebar', 'punte-sidebar-right' );
    $sidebar_id = !empty( $sidebar_id ) ? $sidebar_id : 'sidebar-right';
}
?>

<aside id="secondary-right" class="sidebar sidebar-right <?php echo esc_attr( $sidebar_style ); ?>">
    <?php dynamic_sidebar( $sidebar_id ); ?>
</aside><!-- #secondary -->