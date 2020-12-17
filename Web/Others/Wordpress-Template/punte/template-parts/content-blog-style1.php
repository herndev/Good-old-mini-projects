<?php
/**
 * @package Punte
 */
global $punte_options;
$blog_layout            = isset( $punte_options[ 'blog-layout' ] )          ? $punte_options[ 'blog-layout' ]           : 'right-sidebar';
$post_meta              = isset( $punte_options[ 'post-meta' ] )            ? $punte_options[ 'post-meta' ]             : true;
$blog_excerpt_length    = isset( $punte_options[ 'blog-excerpt-length' ] )  ? $punte_options[ 'blog-excerpt-length' ]   : 70;
$share_button           = isset( $punte_options[ 'share-button' ] )         ? $punte_options[ 'share-button' ]          : true;
$blog_excerpt           = isset( $punte_options[ 'blog-excerpt' ] )         ? $punte_options[ 'blog-excerpt' ]          : 'excerpt';

if ( $blog_layout == 'no-sidebar' ) {
    $punte_image_size = 'punte-1200x500';
} else {
    $punte_image_size = 'punte-840x400';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php punte_entry_image( $punte_image_size ) ?>

    <header class="entry-header">
        <?php
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        ?>
    </header>
    <?php if ( $post_meta || $share_button ): ?>
        <div class="entry-footer clearfix">
            <?php if ( $post_meta ): ?>
                <div class="entry-date-author">
                    <?php echo punte_get_icon_svg('person',16); ?>
                    <?php punte_posted_by(); ?>
                    <?php echo punte_get_icon_svg('watch',14); ?>
                    <?php punte_posted_on(); ?>
                </div>
            <?php endif; ?>

            <?php if ( function_exists('punte_entry_social_share') && $share_button ): ?>
                <div class="entry-share">
                    <?php punte_entry_social_share(); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php
        if ( $blog_excerpt == 'full-content' ) {
             the_content();
        } else {
            echo wp_trim_words( get_the_content(), absint($blog_excerpt_length), $more_val = "..." );
            ?>
            <div class="entry-readmore">
                <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'punte' ) ?></a>
            </div>
        <?php }
        ?>
    </div>	

    

</article><!-- #post-## -->