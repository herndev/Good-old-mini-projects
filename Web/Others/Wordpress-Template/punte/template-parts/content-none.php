<?php
/**
 * @package Punte
 */
?>

<div class="no-results not-found">
    <h2><?php esc_html_e( 'Nothing Found', 'punte' ); ?></h2>

    <div class="page-content">
        <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

            <p><?php printf( /* translators: 1: new post link */
                wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'punte' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

        <?php elseif ( is_search() ) : ?>

            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'punte' ); ?></p>
            <?php
            get_search_form();

        else :
            ?>

            <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'punte' ); ?></p>
            <?php
            get_search_form();

        endif;
        ?>
    </div><!-- .page-content -->
</div><!-- .no-results -->