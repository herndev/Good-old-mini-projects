<?php
/**
 * @package Punte
 */
global $punte_options;
$blog_style = isset( $punte_options[ 'blog-style' ] ) ? $punte_options[ 'blog-style' ] : 'blog-style2';
$archive_layout = isset( $punte_options[ 'archive-layout' ] ) ? $punte_options[ 'archive-layout' ] : 'right-sidebar';

get_header();

/** @hook punte_archive_header
 *
 *
 */
do_action( 'punte_archive_header' );
?>

<div class="punte-container clearfix">
    <div id="primary" class="content-area">
        <div class="<?php echo esc_attr( $blog_style . '-wrap' ) ?> clearfix">
            <?php if ( have_posts() ) : ?>

                <?php
                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content-' . $blog_style, get_post_format() );

                endwhile;

                the_posts_pagination();

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif;
            ?>
        </div>
    </div><!-- #primary -->

    <?php
    if ( $archive_layout == 'left-sidebar' || $archive_layout == 'both-sidebar' || $archive_layout == 'both-left-sidebar' || $archive_layout == 'both-right-sidebar' ) {
        get_sidebar( 'left' );
    }

    if ( $archive_layout == 'right-sidebar' || $archive_layout == 'both-sidebar' || $archive_layout == 'both-left-sidebar' || $archive_layout == 'both-right-sidebar' ) {
        get_sidebar( 'right' );
    }
    ?>
</div>
<?php
get_footer();
