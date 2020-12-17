<?php
/**
 * @package Punte
 */
global $punte_options, $post;
$post_layout            = punte_get_redux_post_meta( 'mb-post-layout', 'default' );
$single_post_comment    = isset( $punte_options[ 'single-post-comments' ] ) ? $punte_options[ 'single-post-comments' ] : true;

if ( $post_layout == 'default' ) {
    $post_layout = isset( $punte_options[ 'post-layout' ] ) ? $punte_options[ 'post-layout' ] : 'right-sidebar';
}

get_header();

/*
 *  @hook punte_post_header
 */
do_action( 'punte_post_header' );
?>

<div class="punte-container clearfix">
    <div id="primary" class="content-area">

        <?php
        while ( have_posts() ) : the_post();

            do_action( 'punte_before_content' );

            get_template_part( 'template-parts/content', 'single' );

            do_action( 'punte_after_content' );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( (comments_open() || get_comments_number()) && $single_post_comment ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </div><!-- #primary -->

    <?php
    if( 'elementor_library' != get_post_type() ){
        if ( $post_layout == 'left-sidebar' || $post_layout == 'both-sidebar' || $post_layout == 'both-left-sidebar' || $post_layout == 'both-right-sidebar' ) {
            get_sidebar( 'left' );
        }

        if ( $post_layout == 'right-sidebar' || $post_layout == 'both-sidebar' || $post_layout == 'both-left-sidebar' || $post_layout == 'both-right-sidebar' ) {
            get_sidebar( 'right' );
        }
    }
    ?>
</div>
<?php
get_footer();
