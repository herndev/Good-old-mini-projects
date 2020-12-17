<?php
/**
 * @package Punte
 */
global $punte_options;

add_action( 'punte_header', 'punte_header_layouts',5 );
add_action( 'punte_top_header', 'punte_top_header_callback' );
add_action( 'punte_top_left_header', 'punte_top_left_header_callback' );
add_action( 'punte_top_right_header', 'punte_top_right_header_callback' );
add_action( 'punte_header_logo', 'punte_header_logo_callback' );
add_filter( 'wp_nav_menu_items', 'punte_add_search_block', 10, 2 );
add_action( 'punte_bottom_header', 'punte_header_search_wrapper');
add_action( 'punte_before_main_header', 'punte_mobile_header' );

if ( !function_exists( 'punte_header_layouts' ) ) {

    function punte_header_layouts() {
        if( class_exists('Punte_Companion')){
            return;
        }
        get_template_part( 'includes/punte-header' );
    }

}

if ( !function_exists( 'punte_top_header_callback' ) ) {

    function punte_top_header_callback() {
        global $punte_options;
        $top_header = isset( $punte_options[ 'top-header' ] ) ? $punte_options[ 'top-header' ] : false;

        if ( !$top_header ) {
            return;
        }
        ?>
        <div class="top-header clearfix">
            <div class="punte-container clearfix">
                <div class="top-left-header-block">
                    <?php do_action( 'punte_top_left_header' ); ?>
                </div>

                <div class="top-right-header-block">
                    <?php do_action( 'punte_top_right_header' ); ?>
                </div>	
            </div>
        </div>
        <?php
    }

}

if ( !function_exists( 'punte_top_left_header_callback' ) ) {

    function punte_top_left_header_callback() {
        global $punte_options;
        $top_left_header            = isset( $punte_options[ 'top-left-header' ] ) ? $punte_options[ 'top-left-header' ] : 'empty';
        $top_left_header_html_text  = isset( $punte_options[ 'top-left-header-html-text' ] ) ? $punte_options[ 'top-left-header-html-text' ] : "";
        $top_left_header_menu       = isset( $punte_options[ 'top-left-header-menu' ] ) ? $punte_options[ 'top-left-header-menu' ] : "";
        $top_left_header_widget     = isset( $punte_options[ 'top-left-header-widget' ] ) ? $punte_options[ 'top-left-header-widget' ] : "";

        if ( $top_left_header == 'html-text' ) {

            echo wp_kses_post( $top_left_header_html_text );
        } elseif ( $top_left_header == 'menu' && !empty( $top_left_header_menu ) ) {

            wp_nav_menu( array(
                'menu' => $top_left_header_menu,
                'fallback_cb' => false,
                'container' => false,
                'menu_class' => 'clearfix top-menu'
                    )
            );
        } elseif ( $top_left_header == 'widget' && !empty( $top_left_header_widget ) ) {

            dynamic_sidebar( $top_left_header_widget );
        }
    }

}

if ( !function_exists( 'punte_top_right_header_callback' ) ) {

    function punte_top_right_header_callback() {
        global $punte_options;
        $top_right_header = isset( $punte_options[ 'top-right-header' ] ) ? $punte_options[ 'top-right-header' ] : 'empty';
        $top_right_header_html_text = isset( $punte_options[ 'top-right-header-html-text' ] ) ? $punte_options[ 'top-right-header-html-text' ] : "";
        $top_right_header_menu = isset( $punte_options[ 'top-right-header-menu' ] ) ? $punte_options[ 'top-right-header-menu' ] : "";
        $top_right_header_widget = isset( $punte_options[ 'top-right-header-widget' ] ) ? $punte_options[ 'top-right-header-widget' ] : "";

        if ( $top_right_header == 'html-text' ) {

            echo wp_kses_post( $top_right_header_html_text );
        } elseif ( $top_right_header == 'menu' && !empty( $top_right_header_menu ) ) {

            wp_nav_menu( array(
                'menu' => $top_right_header_menu,
                'fallback_cb' => false,
                'container' => false,
                'menu_class' => 'clearfix top-menu'
                    )
            );
        } elseif ( $top_right_header == 'widget' && !empty( $top_right_header_widget ) ) {

            dynamic_sidebar( $top_right_header_widget );
        }
    }

}

if ( !function_exists( 'punte_header_logo_callback' ) ) {

    function punte_header_logo_callback() {
        global $punte_options;

        if ( isset( $punte_options[ 'upload-logo' ][ 'url' ] ) && !empty( $punte_options[ 'upload-logo' ][ 'url' ] ) ) {
            $header_logo = $punte_options[ 'upload-logo' ][ 'url' ];
            ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $header_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
            <?php
        } else {
            the_custom_logo();
            ?>
                <?php if ( is_front_page() && is_home() ) : ?>
                    <h1 class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                    </h1>
                <?php else : ?>
                    <p class="site-title">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                    </p>
                <?php
                endif;

                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) :
                    ?>
                    <p class="site-description"><?php echo esc_html( $description ); ?></p>
                    <?php
                endif;
                ?>
            <?php
        }
    }

}

if ( !function_exists( 'punte_add_search_block' ) ) {

    function punte_add_search_block( $items, $args ) {
        global $punte_options;
        $enable_navbar_search   = isset( $punte_options[ 'enable-navbar-search' ] ) ? $punte_options[ 'enable-navbar-search' ] : true;
        $search_icon            = punte_get_icon_svg('search',18);

        if ( $enable_navbar_search ) {
            if ( $args->theme_location == 'primary' ) {
                $items .= '<li class="menu-item menu-item menu-item-search"><a href="javascript:void(0)">'.$search_icon.'</a></li>';
            }
        }
        return $items;
    }

}

if ( !function_exists( 'punte_header_search_wrapper' ) ) {

    function punte_header_search_wrapper() {
        global $punte_options;
        $icon = punte_get_icon_svg('circle_times',36);
        $form = '<div class="header-search-wrapper">';
        $form .= '<div class="search-close" tabindex="0">'.$icon.'</div>';
        $form .= '<div class="search-container">';
        $form .= '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">';
        $form .= '<input autocomplete="off" type="search" class="search-field" placeholder="' . esc_attr__( 'Type and hit Enter', 'punte' ) . '" value="' . get_search_query() . '" name="s" />';
        $form .= '<input type="submit" class="search-submit" value="' . esc_attr__( 'Search', 'punte' ) . '" />';
        $form .= '</form>';
        $form .= '</div>';
        $form .= '</div>';

        $result = apply_filters( 'get_search_form', $form );

        $enable_navbar_search = isset( $punte_options[ 'enable-navbar-search' ] ) ? $punte_options[ 'enable-navbar-search' ] : true;
        if ( $enable_navbar_search ) {
            echo $result; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }

}

add_action( 'punte_page_header', 'punte_page_header_layout', 10 );
add_action( 'punte_post_header', 'punte_post_header_layout', 10 );
add_action( 'punte_archive_header', 'punte_archive_header_layout', 10 );


if ( !class_exists( 'Punte_Companion' ) ) {

    function punte_page_header_layout() {
        global $punte_options;

            $enable_header          = isset( $punte_options[ 'page-enable-header-bar' ] ) ? $punte_options[ 'page-enable-header-bar' ] : true;
            $enable_main_breadcrumb = isset( $punte_options[ 'enable-breadcrumb' ] ) ? $punte_options[ 'enable-breadcrumb' ] : true;

            if ( !$enable_header )
                return;

            $data_parallax      = "";
            $parallax_header    = isset( $punte_options[ 'page-header-parallax' ] ) ? $punte_options[ 'page-header-parallax' ] : true;
            $header_bg          = isset( $punte_options[ 'page-header-bg' ] ) ? $punte_options[ 'page-header-bg' ] : '';
            $header_style       = isset( $punte_options[ 'page-header-style' ] ) ? $punte_options[ 'page-header-style' ] : 'header-style1';
            $header_overlay     = isset( $punte_options[ 'page-header-overlay' ] ) ? $punte_options[ 'page-header-overlay' ] : false;

            if ( $parallax_header && isset( $header_bg[ 'background-image' ] ) && $header_bg[ 'background-image' ] ) {
                $data_parallax = 'data-stellar-background-ratio="0.5"';
            }
            ?>

            <header class="page-header <?php echo esc_attr( $header_style ); ?>" <?php echo esc_attr($data_parallax); ?>>
                <?php if ( $header_overlay ) { ?>
                    <div class="page-header-overlay"></div>
                <?php } ?>

                <div class="punte-container clearfix">
                    <div class="page-title-wrap">
                        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>

                        <?php if ( !empty( $header_subtitle ) ) { ?>
                            <h2 class="page-sub-title"><?php echo wp_kses_post( $header_subtitle ) ?></h2>
                        <?php }
                        ?>
                    </div>

                    <?php
                    if ( $enable_main_breadcrumb  ) {
                        punte_breadcrumbs();
                    }
                    ?>
                </div>
            </header>
            <?php
    }

}

if ( !class_exists( 'Punte_Companion' ) ) {

    function punte_post_header_layout() {
        global $punte_options;

            $enable_header = isset( $punte_options[ 'post-enable-header-bar' ] ) ? $punte_options[ 'post-enable-header-bar' ] : true;
            $enable_main_breadcrumb = isset( $punte_options[ 'enable-breadcrumb' ] ) ? $punte_options[ 'enable-breadcrumb' ] : true;

            if ( !$enable_header )
                return;

            $data_parallax      = "";
            $parallax_header    = isset( $punte_options[ 'post-header-parallax' ] ) ? $punte_options[ 'post-header-parallax' ] : true;
            $header_bg          = isset( $punte_options[ 'post-header-bg' ] ) ? $punte_options[ 'post-header-bg' ] : '';
            $header_style       = isset( $punte_options[ 'post-header-style' ] ) ? $punte_options[ 'post-header-style' ] : 'header-style1';
            $header_overlay     = isset( $punte_options[ 'post-header-overlay' ] ) ? $punte_options[ 'post-header-overlay' ] : false;

            if ( $parallax_header && isset( $header_bg[ 'background-image' ] ) && $header_bg[ 'background-image' ] ) {
                $data_parallax = 'data-stellar-background-ratio="0.5"';
            }
            ?>

            <header class="page-header <?php echo esc_attr( $header_style ); ?>" <?php echo esc_attr($data_parallax); ?>>
                <?php if ( $header_overlay ) { ?>
                    <div class="page-header-overlay"></div>
                <?php } ?>

                <div class="punte-container clearfix">
                    <div class="page-title-wrap">
                        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>

                        <?php if ( !empty( $header_subtitle ) ) { ?>
                            <h2 class="page-sub-title"><?php echo wp_kses_post( $header_subtitle ) ?></h2>
                        <?php }
                        ?>
                    </div>

                    <?php
                    if ( $enable_main_breadcrumb  ) {
                        punte_breadcrumbs();
                    }
                    ?>
                </div>
            </header>
            <?php
    }

}



if ( !function_exists( 'punte_archive_header_layout' ) ) {

    function punte_archive_header_layout() {
        global $punte_options, $post;

        $enable_main_breadcrumb = isset( $punte_options[ 'enable-breadcrumb' ] ) ? $punte_options[ 'enable-breadcrumb' ] : true;
        $enable_header          = isset( $punte_options[ 'archive-enable-header-bar' ] ) ? $punte_options[ 'archive-enable-header-bar' ] : true;

        if ( !$enable_header )
            return;

        $data_parallax      = "";
        $parallax_header    = isset( $punte_options[ 'archive-header-parallax' ] ) ? $punte_options[ 'archive-header-parallax' ] : true;
        $header_bg          = isset( $punte_options[ 'archive-header-bg' ] ) ? $punte_options[ 'archive-header-bg' ] : '';
        $header_style       = isset( $punte_options[ 'archive-header-style' ] ) ? $punte_options[ 'archive-header-style' ] : 'header-style1';
        $header_overlay     = isset( $punte_options[ 'archive-header-overlay' ] ) ? $punte_options[ 'archive-header-overlay' ] : false;

        if ( $parallax_header && isset( $header_bg[ 'background-image' ] ) && $header_bg[ 'background-image' ] ) {
            $data_parallax = 'data-stellar-background-ratio="0.5"';
        }
        ?>

        <header class="page-header <?php echo esc_attr( $header_style ); ?>" <?php echo esc_attr($data_parallax); ?>>
            <?php if ( $header_overlay ) { ?>
                <div class="page-header-overlay"></div>
            <?php } ?>

            <div class="punte-container clearfix">
                <div class="page-title-wrap">
                    <?php if ( is_search() ) { ?>
                        <h1 class="page-title">
                            <?php printf( /* translators: 1: search terms */
                                esc_html__( 'Search Results for: %s', 'punte' ), '<span>' . get_search_query() . '</span>' ); ?>
                        </h1>
                        <?php
                    } else {
                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                        the_archive_description( '<h2 class="page-sub-title">', '</h2>' );
                    }
                    ?>
                </div>

                <?php
                if ( $enable_main_breadcrumb ) {
                    punte_breadcrumbs();
                }
                ?>
            </div>
        </header>
        <?php
    }

}






if ( !function_exists( 'punte_mobile_header' ) ) {

    function punte_mobile_header() {
        global $punte_options;
        $enable_navbar_search = isset( $punte_options[ 'enable-navbar-search' ] ) ? $punte_options[ 'enable-navbar-search' ] : true;
        ?>
        <div class="punte-mobile-header clearfix">
            <div class="punte-nav-icon" tabindex="0"><span></span></div>

            <div class="punte-mobile-logo">
                <?php do_action( 'punte_header_logo' ); ?>
            </div>

            <?php
            if ( $enable_navbar_search ) {
                $search_icon = punte_get_icon_svg('search');
                echo '<div class="punte-mobile-search">';
                echo '<a href="javascript:void(0)">'.$search_icon.'</a>';
                echo '</div>';
            }
            ?>
        </div>
        <?php
    }

}

/**
* Mobile menu overlay
*
*/
add_action('punte_below_body','punte_mob_nav_ovrlay',11);
if(! function_exists('punte_mob_nav_ovrlay')){
    function punte_mob_nav_ovrlay(){
        echo '<div class="punte-mobile-overlay"></div>';
    }
}