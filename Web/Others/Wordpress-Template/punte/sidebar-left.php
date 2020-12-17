<?php
/**
 * @package Punte
 */
wp_print_styles( array( 'punte-sidebar' ) ); 

global $punte_options, $post;
$sidebar_style = isset( $punte_options[ 'sidebar-style' ] ) ? $punte_options[ 'sidebar-style' ] : 'sidebar-style1';

$sidebar_id = 'sidebar-left';

if ( is_singular( 'page' ) ) {
    $sidebar_id = punte_get_redux_post_meta( 'mb-page-left-sidebar', 'punte-sidebar-left' );
    $sidebar_id = !empty( $sidebar_id ) ? $sidebar_id : 'sidebar-left';
} elseif ( is_singular( array( 'post', 'team' ) ) ) {
    $sidebar_id = punte_get_redux_post_meta( 'mb-post-left-sidebar', 'punte-sidebar-left' );
    $sidebar_id = !empty( $sidebar_id ) ? $sidebar_id : 'sidebar-left';
} elseif ( is_singular( 'portfolio' ) ) {
    $sidebar_id = punte_get_redux_post_meta( 'mb-portfolio-left-sidebar', 'punte-sidebar-left' );
    $sidebar_id = !empty( $sidebar_id ) ? $sidebar_id : 'sidebar-left';
}
?>

<aside id="secondary-left" class="sidebar sidebar-left <?php echo esc_attr( $sidebar_style ); ?>">
    <?php dynamic_sidebar( $sidebar_id ); ?>
</aside><!-- #secondary -->