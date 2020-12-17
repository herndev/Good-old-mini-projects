<?php
if ( !punte_is_woocommerce_activated() )
    return;

function punte_woo_hooks() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
    remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
    remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}

add_action( 'wp_head', 'punte_woo_hooks' );

add_action( 'woocommerce_before_main_content', 'punte_theme_wrapper_start', 10 );
add_action( 'woocommerce_after_main_content', 'punte_theme_wrapper_end', 10 );
add_action( 'punte_woocommerce_breadcrumb', 'woocommerce_breadcrumb', 10 );
add_action( 'punte_woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
add_action( 'punte_woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );

function punte_theme_wrapper_start() {
    global $punte_options, $post;
    $header_style = isset( $punte_options[ 'woo-header-style' ] ) ? $punte_options[ 'woo-header-style' ] : 'header-style1';
    $enable_header_bar = isset( $punte_options[ 'woo-enable-header-bar' ] ) ? $punte_options[ 'woo-enable-header-bar' ] : true;
    $enable_main_breadcrumb = isset( $punte_options[ 'enable-breadcrumb' ] ) ? $punte_options[ 'enable-breadcrumb' ] : true;
    $enable_breadcrumb = isset( $punte_options[ 'woo-enable-breadcrumbs' ] ) ? $punte_options[ 'woo-enable-breadcrumbs' ] : true;

    if ( $enable_header_bar ) {
        echo '<header class="page-header ' . esc_attr( $header_style ) . '">';
        if ( isset($punte_options[ 'woo-header-overlay' ]) ) {
            echo '<div class="page-header-overlay"></div>';
        }
        echo '<div class="punte-container clearfix">';
        echo '<div class="page-title-wrap">';
        echo '<h1 class="page-title">';
        woocommerce_page_title();
        echo '</h1>';
        do_action( 'punte_woocommerce_archive_description' );
        echo '</div>';

        if ( $enable_main_breadcrumb && $enable_breadcrumb ) {
            do_action( 'punte_woocommerce_breadcrumb' );
        }
        echo '</div>';
        echo '</header>';
    }

    echo '<div class="punte-container clearfix">';
    echo '<div id="primary" class="content-area">';
}

function punte_theme_wrapper_end() {
    global $punte_options;

    if ( is_singular() ) {
        $page_layout = isset( $punte_options[ 'woocommerce-single-layout' ] ) ? $punte_options[ 'woocommerce-single-layout' ] : 'right-sidebar';
    } else {
        $page_layout = isset( $punte_options[ 'woocommerce-layout' ] ) ? $punte_options[ 'woocommerce-layout' ] : 'right-sidebar';
    }

    echo '</div>';
    if ( $page_layout == 'left-sidebar' || $page_layout == 'both-sidebar' || $page_layout == 'both-left-sidebar' || $page_layout == 'both-right-sidebar' ) {
        get_sidebar( 'left' );
    }

    if ( $page_layout == 'right-sidebar' || $page_layout == 'both-sidebar' || $page_layout == 'both-left-sidebar' || $page_layout == 'both-right-sidebar' ) {
        get_sidebar( 'right' );
    }
    echo '</div>';
}

add_filter( 'woocommerce_show_page_title', '__return_false' );

// Change number or products per row
add_filter( 'loop_shop_columns', 'punte_loop_columns' );
if ( !function_exists( 'punte_loop_columns' ) ) {

    function punte_loop_columns() {
        global $punte_options;
        $product_columnn = isset( $punte_options[ 'woocommerce-product-column' ] ) ? $punte_options[ 'woocommerce-product-column' ] : 3;
        return $product_columnn;
    }

}

// Display products per page.
add_filter( 'loop_shop_per_page', 'punte_product_per_page', 20 );
if ( !function_exists( 'punte_product_per_page' ) ) {

    function punte_product_per_page() {
        global $punte_options;
        $post_count = isset( $punte_options[ 'woocommerce-no-of-post' ] ) ? $punte_options[ 'woocommerce-no-of-post' ] : 10;
        return $post_count;
    }

}

//Change number of related products on product page
add_filter( 'woocommerce_output_related_products_args', 'punte_related_products_args' );

function punte_related_products_args( $args ) {
    global $punte_options;
    $args[ 'posts_per_page' ] = isset( $punte_options[ 'woocommerce-related-post-count' ] ) ? $punte_options[ 'woocommerce-related-post-count' ] : 3;
    $args[ 'columns' ] = isset( $punte_options[ 'woocommerce-product-column' ] ) ? $punte_options[ 'woocommerce-product-column' ] : 3;
    return $args;
}

add_filter( 'body_class', 'punte_product_columns' );
if ( !function_exists( 'punte_product_columns' ) ) {

    function punte_product_columns( $body_class ) {
        global $punte_options;
        $product_column = isset( $punte_options[ 'woocommerce-product-column' ] ) ? $punte_options[ 'woocommerce-product-column' ] : 3;
        if ( is_shop() || is_product_category() || is_singular( 'product' ) ) {
            $body_class[] = 'columns-' . $product_column;
        }
        return $body_class;
    }

}

function punte_change_prev_text( $args ) {
    $args[ 'prev_text' ] = '&lang;';
    $args[ 'next_text' ] = '&rang;';
    return $args;
}

add_filter( 'woocommerce_pagination_args', 'punte_change_prev_text' );

add_filter( 'woocommerce_product_description_heading', '__return_false' );

add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );

add_action( 'woocommerce_before_shop_loop_item_title', 'punte_title_wrap', 20 );

function punte_title_wrap() {
    echo '<div class="punte-product-title-wrap">';
}

add_action( 'woocommerce_after_shop_loop_item', 'punte_title_wrap_close', 4 );

function punte_title_wrap_close() {
    echo '</div>';
}

/**
 * * Product Wishlist Button Function
 * */
if ( class_exists( 'YITH_WCWL' ) ) {

    /**
     * Wishlist Header Count Ajax Function
     * */
    if ( !function_exists( 'punte_wishlist' ) ) {

        function punte_wishlist() {
            if ( function_exists( 'YITH_WCWL' ) ) {
                $wishlist_url = YITH_WCWL()->get_wishlist_url();
                ?>
                <div class="top-wishlist">
                    <a href="<?php echo esc_url( $wishlist_url ); ?>" title="<?php esc_attr_e( 'Wishlist', 'punte' ); ?>">
                        <div class="count">
                            <span class="badge bigcounter">
                                <?php esc_html_e( 'Wishlist', 'punte' ); ?><?php echo " (" . yith_wcwl_count_products() . ") ";// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </span>
                        </div>
                    </a>
                </div>
                <?php
            }
        }

    }
    add_action( 'wp_ajax_yith_wcwl_update_single_product_list', 'punte_wishlist' );
}

/** Remove Default Quick View Button * */
if ( class_exists( 'YITH_WCQV' ) ) :
    remove_action( 'woocommerce_after_shop_loop_item', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 15 );
endif;

if ( !function_exists( 'punte_woocommerce_product_buttons' ) ) {

    function punte_woocommerce_product_buttons() {
        ?>
        <div class="punte-woo-buttons flex-box"> 
            <?php woocommerce_template_loop_add_to_cart(); ?>

            <?php
            if ( class_exists( 'YITH_WCWL' ) ) :
                echo do_shortcode( '[yith_wcwl_add_to_wishlist browse_wishlist_text="<i class=\'fa fa-heart\' aria-hidden=\'true\'></i>" label="<i class=\'fa fa-heart-o\' aria-hidden=\'true\'></i>"]' );
            endif;
            ?>

            <?php if ( class_exists( 'YITH_WCQV' ) ) : ?>
                <?php global $product; ?>
                <div class="punte-quick-view">
                    <span class="feedback"><?php esc_html_e( 'Quick View', 'punte' ) ?></span>
                    <a href="#" class="yith-wcqv-button" data-product_id="<?php echo esc_attr( get_the_ID() ); ?>"><?php echo punte_get_icon_svg('search',16); ?></a>
                </div>
            <?php endif; ?>
        </div>
        <?php
    }

}

add_action( 'woocommerce_after_shop_loop_item', 'punte_woocommerce_product_buttons', 10 );


add_action('punte_cart_icons','punte_cart_icons',10);
function punte_cart_icons(){
    ?>
    <i>
    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18px" height="18px" viewBox="0 0 510 510" style="enable-background:new 0 0 510 510;" xml:space="preserve">
<g><g id="shopping-cart"><path d="M153,408c-28.05,0-51,22.95-51,51s22.95,51,51,51s51-22.95,51-51S181.05,408,153,408z M0,0v51h51l91.8,193.8L107.1,306c-2.55,7.65-5.1,17.85-5.1,25.5c0,28.05,22.95,51,51,51h306v-51H163.2c-2.55,0-5.1-2.55-5.1-5.1v-2.551l22.95-43.35h188.7c20.4,0,35.7-10.2,43.35-25.5L504.9,89.25c5.1-5.1,5.1-7.65,5.1-12.75c0-15.3-10.2-25.5-25.5-25.5H107.1L84.15,0H0z M408,408c-28.05,0-51,22.95-51,51s22.95,51,51,51s51-22.95,51-51S436.05,408,408,408z"/></g></g></svg>

    <span class="cart-count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span>
    </i>
<?php 
}


if ( !function_exists( 'punte_cart_link' ) ) {

    function punte_cart_link() {

        ?>
        <a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'punte' ); ?>">
           <?php do_action('punte_cart_icons'); ?>
        </a>
<?php
    }
}


function punte_navigation_icons( $items, $args ) {
    global $punte_options;

    if ( isset( $punte_options[ 'show-shopping-cart' ] ) && $punte_options[ 'show-shopping-cart' ] && $args->theme_location == 'primary' ) {
        ob_start();
        echo '<li class="menu-item menu-item-punte-cart">';
        punte_cart_link();
        the_widget( 'WC_Widget_Cart', 'title=' );
        echo '</li>';
        $items .= ob_get_clean();
    }
    return $items;
}

add_filter( 'wp_nav_menu_items', 'punte_navigation_icons', 10, 2 );
