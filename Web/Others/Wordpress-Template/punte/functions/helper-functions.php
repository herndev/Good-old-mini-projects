<?php
/**
 * @package Punte
 */
if ( !function_exists( 'punte_posted_by' ) ) {

    function punte_posted_by() {
        echo '<span class="author vcard">' . esc_html( get_the_author() ) . '</span>';
    }

}

if ( !function_exists( 'punte_posted_on' ) ) {

    function punte_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() )
        );

        echo '<span class="posted-on">' . $time_string . '</span>';// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

}

if ( !function_exists( 'punte_entry_category' ) ) {

    function punte_entry_category() {
        $icon = punte_get_icon_svg('archive',16);
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( ', ' );
            if ( $categories_list && punte_categorized_blog() ) {
                printf( '<span class="cat-links">'.$icon.' ' . $categories_list . '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }
    }

}

if ( !function_exists( 'punte_entry_tags' ) ) {

    function punte_entry_tags() {
        $icon = punte_get_icon_svg('tag',16);
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $tag_list = get_the_tag_list( '', ', ' );
            if ( $tag_list && punte_categorized_blog() ) {
                printf( '<span class="tag-links">'.$icon.' ' . $tag_list . '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }
    }

}

if ( !function_exists( 'punte_entry_comment' ) ) {

    function punte_entry_comment() {
        if ( !is_single() && !post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link( esc_html__( '0 comment', 'punte' ), esc_html__( '1 Comment', 'punte' ), esc_html__( '% Comments', 'punte' ) );
            echo '</span>';
        }
    }

}

if ( !function_exists( 'punte_entry_image' ) ) {

    function punte_entry_image( $thumb_size = 'medium' ) {
        if ( has_post_thumbnail() ) :
            $image = wp_get_attachment_image_src( get_post_thumbnail_id(), $thumb_size );
            ?>
            <div class="entry-image">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $image[ 0 ] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></a>
            </div>
            <?php
        endif;
    }

}



if ( !function_exists( 'punte_post_pagination' ) ) {

    function punte_post_pagination() {
        $icon_left  = punte_get_icon_svg('chevron_left',16);
        $icon_right = punte_get_icon_svg('chevron_right',16);
        ?>
        <nav class="navigation post-navigation" role="navigation">
            <div class="nav-links">
                <div class="nav-previous">
                    <?php previous_post_link( '%link', '<span>'.$icon_left . esc_html__( 'Prev', 'punte' ) . '</span>%title' ); ?> 
                </div>

                <div class="nav-next">
                    <?php next_post_link( '%link', '<span>' . esc_html__( 'Next', 'punte' ) . $icon_right.'</span>%title' ); ?>
                </div>
            </div>
        </nav>
        <?php
    }

}



if ( !function_exists( 'punte_related_post' ) ) {

    function punte_related_post() {
        global $post;

        $categories = get_the_category( $post->ID );


        if ( $categories ) {
            $caegory_ids = array();
            foreach ( $categories as $category ) {
                $caegory_ids[] = $category->term_id;
            }

            $args = array(
                'category__in' => $caegory_ids,
                'post__not_in' => array( $post->ID ),
                'posts_per_page' => 3,
            );

            $query = new WP_Query( $args );

            if ( $query->have_posts() ):
                echo '<div class="punte-related-post">';
                echo '<h4>' . esc_html__( 'Related Posts', 'punte' ) . '</h4>';
                echo '<ul class="punte-related-post-wrap clearfix">';
                while ( $query->have_posts() ): $query->the_post();
                    ?>
                    <li>
                        <div class="relatedthumb">
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                <?php
                                if ( has_post_thumbnail() ) {
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'punte-375x250' );
                                    echo '<img src="' . esc_url( $image[ 0 ] ) . '" alt="' . esc_attr( get_the_title() ) . '"/>';
                                }
                                ?>
                            </a>
                        </div>

                        <div class="relatedcontent">
                            <h4><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                            <div class="entry-date-author">
                                <?php echo punte_get_icon_svg('person',16); ?>
                                <?php punte_posted_by(); ?>
                                <?php echo punte_get_icon_svg('watch',14); ?>
                                <?php punte_posted_on(); ?>
                            </div>
                        </div>
                    </li>
                    <?php
                endwhile;
                echo '</ul>';
                echo '</div>';
            endif;
            wp_reset_postdata();
        }
    }

}

/* Convert hexdec color string to rgb(a) string */
if ( !function_exists( 'punte_hex2rgb' ) ) {

    function punte_hex2rgb( $hex ) {
        $hex = str_replace( "#", "", $hex );

        if ( strlen( $hex ) == 3 ) {
            $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
            $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
            $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
        } else {
            $r = hexdec( substr( $hex, 0, 2 ) );
            $g = hexdec( substr( $hex, 2, 2 ) );
            $b = hexdec( substr( $hex, 4, 2 ) );
        }
        $rgb = array( $r, $g, $b );
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }

}

if ( !function_exists( 'punte_rgb2hex' ) ) {

    function punte_rgb2hex( $rgb ) {
        $hex = "#";
        $hex .= str_pad( dechex( $rgb[ 0 ] ), 2, "0", STR_PAD_LEFT );
        $hex .= str_pad( dechex( $rgb[ 1 ] ), 2, "0", STR_PAD_LEFT );
        $hex .= str_pad( dechex( $rgb[ 2 ] ), 2, "0", STR_PAD_LEFT );

        return $hex; // returns the hex value including the number sign (#)
    }

}

if ( !function_exists( 'punte_check_hex' ) ) {

    function punte_check_hex( $color ) {
        if ( substr( $color, 0, 1 ) == '#' ) {
            return true;
        } else {
            return false;
        }
    }

}

if ( !function_exists( 'punte_color_luminance' ) ) {

    function punte_color_luminance( $hex, $percent = 1 ) {

        // validate hex string

        $hex = preg_replace( '/[^0-9a-f]/i', '', $hex );
        $new_hex = '#';

        if ( strlen( $hex ) < 6 ) {
            $hex = $hex[ 0 ] + $hex[ 0 ] + $hex[ 1 ] + $hex[ 1 ] + $hex[ 2 ] + $hex[ 2 ];
        }

        // convert to decimal and change luminosity
        for ( $i = 0; $i < 3; $i++ ) {
            $dec = hexdec( substr( $hex, $i * 2, 2 ) );
            $dec = min( max( 0, $dec + $dec * $percent ), 255 );
            $new_hex .= str_pad( dechex( $dec ), 2, 0, STR_PAD_LEFT );
        }

        return $new_hex;
    }

}

if ( !function_exists( 'punte_parseRGBa' ) ) {

    function punte_parseRGBa( $rgba ) {
        $rgba = trim( str_replace( ' ', '', $rgba ) );
        if ( stripos( $rgba, 'rgba' ) !== false ) {
            $res = sscanf( $rgba, "rgba(%d, %d, %d, %f)" );
        } else {
            $res = sscanf( $rgba, "rgb(%d, %d, %d)" );
            $res[] = 1;
        }
        return array_combine( array( '0', '1', '2', '3' ), $res );
    }

}

if ( !function_exists( 'punte_darken_color' ) ) {

    function punte_darken_color( $skin_color, $percent ) {
        if ( !punte_check_hex( $skin_color ) ) {
            $rgba_array = punte_parseRGBa( $skin_color );
            $skin_color = punte_rgb2hex( $rgba_array );
        }

        return punte_color_luminance( $skin_color, $percent );
    }

}

if ( !function_exists( 'punte_excerpt' ) ) {

    function punte_excerpt( $content, $letter_count = 100 ) {
        $content = strip_shortcodes( $content );
        $content = strip_tags( $content );
        $new_content = mb_substr( $content, 0, $letter_count );
        if ( strlen( $content ) > strlen( $new_content ) ) {
            $new_content .= "...";
        }
        return $new_content;
    }

}

function punte_comment( $comment, $args, $depth ) {

    $tag = ( 'div' === $args[ 'style' ] ) ? 'div' : 'li';
    ?>
    <<?php echo esc_attr($tag); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args[ 'has_children' ] ) ? 'parent' : '', $comment ); ?>>
    <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
        <footer class="comment-meta">
            <div class="comment-author vcard">
                <?php if ( 0 != $args[ 'avatar_size' ] ) echo get_avatar( $comment, $args[ 'avatar_size' ] ); ?>
                <?php echo sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) ); ?>
            </div><!-- .comment-author -->

            <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'punte' ); ?></p>
            <?php endif; ?>
            <?php edit_comment_link( esc_html__( 'Edit', 'punte' ), '<span class="edit-link">', '</span>' ); ?>
        </footer><!-- .comment-meta -->

        <div class="comment-content">
            <?php comment_text(); ?>
        </div><!-- .comment-content -->

        <div class="comment-metadata clearfix">
            <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                <time datetime="<?php comment_time( 'c' ); ?>">
                    <?php
                    /* translators: 1: comment date, 2: comment time */
                    printf( esc_html__( '%1$s at %2$s', 'punte' ), get_comment_date( '', $comment ), get_comment_time() );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    ?>
                </time>
            </a>

            <?php
            
            $reply_icon = punte_get_icon_svg('reply',16);

            comment_reply_link( array_merge( $args, array(
                'add_below' => 'div-comment',
                'depth' => $depth,
                'max_depth' => $args[ 'max_depth' ],
                'before' => '<div class="reply">'.$reply_icon,
                'after' => '</div>'
            ) ) );
            ?>
        </div><!-- .comment-metadata -->
    </article><!-- .comment-body -->
    <?php
}

/**
 * Get size information for all currently-registered image sizes.
 *
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 * @return array $sizes Data for all currently-registered image sizes.
 */
function punte_get_image_sizes() {
    global $_wp_additional_image_sizes;

    $sizes = array();

    foreach ( get_intermediate_image_sizes() as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ] = 'Image Size - ' . get_option( "{$_size}_size_w" ) . 'x' . get_option( "{$_size}_size_h" );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = 'Image Size - ' . $_wp_additional_image_sizes[ $_size ][ 'width' ] . 'x' . $_wp_additional_image_sizes[ $_size ][ 'height' ];
        }
    }

    return $sizes;
}

if ( !function_exists( 'punte_css_strip_whitespace' ) ) {

    function punte_css_strip_whitespace( $css ) {
        $replace = array(
            "#/\*.*?\*/#s" => "", // Strip C style comments.
            "#\s\s+#" => " ", // Strip excess whitespace.
        );
        $search = array_keys( $replace );
        $css = preg_replace( $search, $replace, $css );

        $replace = array(
            ": " => ":",
            "; " => ";",
            " {" => "{",
            " }" => "}",
            ", " => ",",
            "{ " => "{",
            ";}" => "}", // Strip optional semicolons.
            ",\n" => ",", // Don't wrap multiple selectors.
            "\n}" => "}", // Don't wrap closing braces.
                //"} "  => "}\n", // Put each rule on it's own line.
        );
        $search = array_keys( $replace );
        $css = str_replace( $search, $replace, $css );

        return trim( $css );
    }

}

/* prevent undefined function error if redux-framework plugin is not activated */

function punte_get_redux_post_meta( $key, $default_value = '' ) {
    global $post;

    if ( function_exists( 'redux_post_meta' ) ) {
        return redux_post_meta( 'punte_options', $post->ID, $key );
    } else {
        return $default_value;
    }
}
