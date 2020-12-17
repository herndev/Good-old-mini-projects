<?php
/**
 * @package Punte
 */

if ( !function_exists( 'punte_author_info_box' ) ) {

    function punte_author_info_box() {

        global $post, $punte_options;
        $single_post_author = isset( $punte_options[ 'single-post-author' ] ) ? $punte_options[ 'single-post-author' ] : true;

        if ( !$single_post_author )
            return;

        if ( is_singular( 'post' ) && isset( $post->post_author ) ) {
            // Get Author Data
            $author = get_the_author();
            $author_description = get_the_author_meta( 'description', $post->post_author );
            $author_url = get_author_posts_url( $post->post_author );
            $author_avatar = get_avatar( get_the_author_meta( 'user_email', $post->post_author ), apply_filters( 'wpex_author_bio_avatar_size', 100 ) );

            // Only display if author has a description
            if ( $author_description ) :
                ?>

                <div class="punte-author-info clearfix">

                    <?php if ( $author_avatar ) { ?>
                        <div class="punte-author-avatar">
                            <a href="<?php echo esc_url( $author_url ); ?>" rel="author">
                                <?php echo wp_kses_post($author_avatar); ?>
                            </a>
                        </div><!-- .author-avatar -->
                    <?php } ?>

                    <div class="punte-author-description">
                        <h4><span><?php printf( /* translators: 1: autnor name */
                            esc_html__( 'By %s', 'punte' ), esc_html( $author ) ); ?></span></h4>
                        <p><?php echo wp_kses_post( $author_description ); ?></p>
                    </div>
                </div>

                <?php
            endif;
        }
    }

}

add_action( 'punte_after_content', 'punte_author_info_box', 20 );


if ( !function_exists( 'punte_single_post_meta' ) ) {

    function punte_single_post_meta() {
        global $punte_options;
        $single_post_meta = isset( $punte_options[ 'single-post-meta' ] ) ? $punte_options[ 'single-post-meta' ] : true;

        if ( !$single_post_meta || is_singular( 'team' ) ) {
            return;
        }
        ?>

        <div class="single-entry-meta">
            <div class="single-entry-author">
                <?php echo punte_get_icon_svg('person',16); ?>
                <?php punte_posted_by(); ?>
            </div>
            <div class="single-entry-date">
                <?php echo punte_get_icon_svg('watch',14); ?>
                <?php punte_posted_on(); ?>
            </div>
            <div class="single-entry-category">
                <?php punte_entry_category(); ?>
            </div>

            <div class="single-entry-tags">
                <?php punte_entry_tags(); ?>
            </div>
        </div>
        <?php
    }

}

add_action( 'punte_before_content', 'punte_single_post_meta' );

add_action( 'punte_before_content', 'punte_single_blog_image',8 );
if(! function_exists('punte_single_blog_image')){
    function punte_single_blog_image(){
        global $punte_options;
        $single_post_image = isset( $punte_options[ 'single-post-image' ] ) ? $punte_options[ 'single-post-image' ] : true;

        if($single_post_image == false){
            return;
        }
        
        echo '<div class="post-img">';
        the_post_thumbnail();
        echo '</div>';
    }
}


if ( !function_exists( 'punte_hooks' ) ) {

    function punte_hooks() {
        global $punte_options;
        $single_share_button    = isset( $punte_options[ 'single-share-button' ] ) ? $punte_options[ 'single-share-button' ] : '1';
        $single_post_pagination = isset( $punte_options[ 'single-post-pagination' ] ) ? $punte_options[ 'single-post-pagination' ] : '1';
        $single_related_posts   = isset( $punte_options[ 'single-related-posts' ] ) ? $punte_options[ 'single-related-posts' ] : '1';

        if( function_exists('punte_entry_social_share')){
            if ( $single_share_button == '1' && is_singular( 'post' ) ) {
                add_action( 'punte_after_content', 'punte_entry_social_share', 10 );
            }
        }

        if ( $single_post_pagination == '1' && is_singular( 'post' ) ) {
            add_action( 'punte_after_content', 'punte_post_pagination', 20 );
        }

        if ( $single_related_posts == '1' && is_singular( 'post' ) ) {
            add_action( 'punte_after_content', 'punte_related_post', 30 );
        }
    }

}

add_action( 'wp_head', 'punte_hooks' );

if ( !function_exists( 'punte_change_reply_html' ) ) {

    function punte_change_reply_html( $defaults ) {
        $defaults[ 'title_reply_before' ] = '<h4 id="reply-title" class="comment-reply-title">';
        $defaults[ 'title_reply_after' ] = '</h4>';
        return $defaults;
    }

}

add_filter( 'comment_form_defaults', 'punte_change_reply_html' );

if ( !function_exists( 'punte_responsive_navigation' ) ) {

    function punte_responsive_navigation() {
        echo '<div id="punte-side-navigation" class="main-side-navigation">';
        echo '<div class="mob-menu-close-icon">'.punte_get_icon_svg('circle_times',36).'</div>';
        wp_nav_menu( array(
            'theme_location' => 'primary',
            'fallback_cb' => false,
            'container' => false,
        ) );
        echo '</div>';
    }

}

add_action( 'punte_below_body', 'punte_responsive_navigation' );




if ( !function_exists( 'punte_get_elementor_templates' ) ) {

    function punte_get_elementor_templates() {
        $args = [
        'post_type' => 'elementor_library',
        'posts_per_page' => -1,
    ];

    $page_templates = get_posts( $args );

    $options = array();

    if ( !empty( $page_templates ) && !is_wp_error( $page_templates ) ) {
        $options['0'] = esc_html__('Select Template','punte');
        foreach ( $page_templates as $post ) {
            $options[ $post->ID ] = $post->post_title;
        }
    }
    return $options;
    }

}

/**
 * escape unknown values from colors
 *
 */
function punte_escape_colors( $color ) {
    if ( empty( $color ) || is_array( $color ) ) {
        return '';
    }

    if ( false === strpos( $color, 'rgba' ) ) {
        return sanitize_hex_color( $color );
    }

    $color = str_replace( ' ', '', $color );
    sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );

    return 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
}