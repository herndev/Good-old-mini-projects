<?php
/**
 * @package Punte
 */
global $punte_options;
$search_layout = isset( $punte_options[ 'search-layout' ] ) ? $punte_options[ 'search-layout' ] : 'right-sidebar';
$enable_breadcrumb = isset( $punte_options[ 'enable-breadcrumb' ] ) ? $punte_options[ 'enable-breadcrumb' ] : true;

get_header();

/** @hook punte_archive_header
 *
 *
 */
do_action( 'punte_archive_header' );
?>

<div class="punte-container clearfix">
    <div id="primary" class="content-area">
        <div class="blog-style1-wrap clearfix">

            <?php if ( have_posts() ) : ?>

                <?php
                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    /**
                     * Run the loop for the search to output the results.
                     * If you want to overload this in a child theme then include a file
                     * called content-search.php and that will be used instead.
                     */
                    get_template_part( 'template-parts/content-search' );

                endwhile;

                the_posts_pagination();

            else :

                get_template_part( 'template-parts/content', 'none' );

            endif;
            ?>
        </div>
    </div><!-- #primary -->

    <?php
    if ( $search_layout == 'left-sidebar' || $search_layout == 'both-sidebar' || $search_layout == 'both-left-sidebar' || $search_layout == 'both-right-sidebar' ) {
        get_sidebar( 'left' );
    }

    if ( $search_layout == 'right-sidebar' || $search_layout == 'both-sidebar' || $search_layout == 'both-left-sidebar' || $search_layout == 'both-right-sidebar' ) {
        get_sidebar( 'right' );
    }
    ?>
</div>
<?php
get_footer();
