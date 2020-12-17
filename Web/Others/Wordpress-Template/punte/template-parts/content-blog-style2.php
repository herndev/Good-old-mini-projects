<?php
/**
 * @package Punte
 */
global $punte_options;
$punte_experpt_class    = "";
$post_meta              = isset( $punte_options[ 'post-meta' ] ) ? $punte_options[ 'post-meta' ] : true;
$blog_excerpt_length    = isset( $punte_options[ 'blog-excerpt-length' ] ) ? $punte_options[ 'blog-excerpt-length' ] : 70;
$share_button           = isset( $punte_options[ 'share-button' ] ) ? $punte_options[ 'share-button' ] : true;

if ( !has_post_thumbnail() ) {
    $punte_experpt_class = 'fullwidth';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="clearfix">
        <?php punte_entry_image( 'punte-550x550' ) ?>

        <div class="entry-excerpt <?php echo esc_attr( $punte_experpt_class ); ?>">

            <header class="entry-header">
                <?php
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                ?>
            </header>

            <div class="entry-content">
                <?php echo wp_trim_words( get_the_content(), absint($blog_excerpt_length), $more_val = "..." ); ?>
            </div>

            <?php if ( $post_meta || $share_button ): ?>
                <footer class="entry-footer clearfix">
                    <?php if ( $post_meta ): ?>
                        <?php echo punte_get_icon_svg('person',16); ?>
                        <?php punte_posted_by(); ?>
                        <?php echo punte_get_icon_svg('watch',14); ?>
                        <?php punte_posted_on(); ?>

                        <?php punte_entry_category(); ?>
                    <?php endif; ?>
                </footer>
            <?php endif; ?>
        </div>
    </div>

    <?php if ( function_exists('punte_entry_social_share') && $share_button ): ?>
        <div class="entry-share">
            <?php punte_entry_social_share(); ?>
        </div>
    <?php endif; ?>

</article><!-- #post-## -->