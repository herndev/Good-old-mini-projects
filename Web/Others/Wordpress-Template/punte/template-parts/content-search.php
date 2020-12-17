<?php
/**
 * Template part for displaying results in search pages.
 * @package Punte
 */
global $punte_options;
$blog_layout            = isset( $punte_options[ 'blog-layout' ] ) ? $punte_options[ 'blog-layout' ] : 'right-sidebar';
$blog_excerpt_length    = isset( $punte_options[ 'blog-excerpt-length' ] ) ? $punte_options[ 'blog-excerpt-length' ] : 70;

if ( $blog_layout == 'no-sidebar' ) {
    $punte_image_size = 'punte-1200x500';
} else {
    $punte_image_size = 'punte-840x400';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( 'blog-style1', 'punte-blog-post' ) ); ?>>
    <?php punte_entry_image( $punte_image_size ) ?>

    <header class="entry-header">
        <?php
        the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        ?>
    </header>

    <div class="entry-content">
        <?php echo wp_trim_words( get_the_content(), absint($blog_excerpt_length), $more_val = "..." ); ?>
    </div>

    <div class="entry-readmore">
        <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'punte' ) ?></a>
    </div>

</article><!-- #post-## -->
