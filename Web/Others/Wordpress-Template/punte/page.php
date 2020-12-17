<?php
/**
 * @package Punte
 */
global $punte_options, $post;
$page_layout = punte_get_redux_post_meta( 'mb-page-layout', 'default' );

if ( $page_layout == 'default' ) {
    $page_layout = isset( $punte_options[ 'page-layout' ] ) ? $punte_options[ 'page-layout' ] : 'right-sidebar';
}

get_header();

/** @hook punte_page_header
 *
 *
 */
do_action( 'punte_page_header' );
?>
<div class="punte-container clearfix">
    <div id="primary" class="content-area">
        <?php
        while ( have_posts() ) : the_post();

            the_content();

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>
    </div>

    <?php
    if ( $page_layout == 'left-sidebar' || $page_layout == 'both-sidebar' || $page_layout == 'both-left-sidebar' || $page_layout == 'both-right-sidebar' ) {
        get_sidebar( 'left' );
    }

    if ( $page_layout == 'right-sidebar' || $page_layout == 'both-sidebar' || $page_layout == 'both-left-sidebar' || $page_layout == 'both-right-sidebar' ) {
        get_sidebar( 'right' );
    }
    ?>
</div>
<?php
get_footer();
