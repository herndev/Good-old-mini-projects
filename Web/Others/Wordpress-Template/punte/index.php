<?php
/**
 * @package Punte
 */
global $punte_options;
$blog_style = isset( $punte_options[ 'blog-style' ] ) ? $punte_options[ 'blog-style' ] : 'blog-style2';
$blog_layout = isset( $punte_options[ 'blog-layout' ] ) ? $punte_options[ 'blog-layout' ] : 'right-sidebar';
$enable_breadcrumb = isset( $punte_options[ 'enable-breadcrumb' ] ) ? $punte_options[ 'enable-breadcrumb' ] : true;

get_header();

if ( is_home() && !is_front_page() ) :
    ?>
    <header class="page-header">
        <div class="punte-container">
            <div class="page-title-wrap">
                <?php
                single_post_title( '<h1 class="page-title">', '</h1>' );
                ?>
            </div>

            <?php
            if ( $enable_breadcrumb ) {
                punte_breadcrumbs();
            }
            ?>
        </div>
    </header>
    <?php
endif;
?>
<div class="punte-container clearfix">
    <div id="primary" class="content-area clearfix">
        <div class="<?php echo esc_attr( $blog_style . '-wrap' ) ?> clearfix">
            <?php
            if ( have_posts() ) :

                /* Start the Loop */
                while ( have_posts() ) : the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
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
    if ( $blog_layout == 'left-sidebar' || $blog_layout == 'both-sidebar' || $blog_layout == 'both-left-sidebar' || $blog_layout == 'both-right-sidebar' ) {
        get_sidebar( 'left' );
    }

    if ( $blog_layout == 'right-sidebar' || $blog_layout == 'both-sidebar' || $blog_layout == 'both-left-sidebar' || $blog_layout == 'both-right-sidebar' ) {
        get_sidebar( 'right' );
    }
    ?>
</div>
<?php
get_footer();
