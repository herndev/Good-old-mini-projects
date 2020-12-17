<?php
/**
 * @package Punte
 */
global $punte_options;
$error_layout       = isset( $punte_options[ '404-layout' ] ) ? $punte_options[ '404-layout' ] : 'right-sidebar';
$enable_breadcrumb  = isset( $punte_options[ 'enable-breadcrumb' ] ) ? $punte_options[ 'enable-breadcrumb' ] : true;

get_header();
?>

<header class="page-header">
    <div class="punte-container">
        <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'punte' ); ?></h1>
        <?php
        if ( $enable_breadcrumb ) {
            punte_breadcrumbs();
        }
        ?>
    </div>
</header>


<div class="punte-container clearfix">
    <div id="primary" class="content-area">

        <section class="error-404 not-found">

            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'punte' ); ?></p>

        </section><!-- .error-404 -->

    </div><!-- #primary -->

    <?php
    if ( $error_layout == 'left-sidebar' || $error_layout == 'both-sidebar' || $error_layout == 'both-left-sidebar' || $error_layout == 'both-right-sidebar' ) {
        get_sidebar( 'left' );
    }

    if ( $error_layout == 'right-sidebar' || $error_layout == 'both-sidebar' || $error_layout == 'both-left-sidebar' || $error_layout == 'both-right-sidebar' ) {
        get_sidebar( 'right' );
    }
    ?>
</div>
<?php
get_footer();
