<?php
/**
 * Punte functions and definitions.
 *
 * @package Punte
 */
define( 'PUNTE_THEME_DIR', get_template_directory() );
define( 'PUNTE_THEME_URI', get_template_directory_uri() );

define( 'PUNTE_THEME_NAME', 'punte' );
define( 'PUNTE_THEME_VERSION', '1.0' );

if ( !function_exists( 'punte_setup' ) ) :

    function punte_setup() {

        load_theme_textdomain( 'punte', PUNTE_THEME_DIR . '/languages' );

        add_theme_support( 'automatic-feed-links' );

        add_theme_support( 'title-tag' );

        add_theme_support( 'post-thumbnails' );
        /** Custom Image Sizes **/
        add_image_size( 'punte-1920x1080', 1920, 1080, true );
        add_image_size( 'punte-1200x500', 1200, 500, true );
        add_image_size( 'punte-740x400', 740, 400, true );
        add_image_size( 'punte-840x400', 840, 400, true );
        add_image_size( 'punte-550x550', 550, 550, true );
        add_image_size( 'punte-598x460', 598, 460, true );
        add_image_size( 'punte-589x228', 589, 228, true );
        add_image_size( 'punte-375x250', 375, 250, true );
        add_image_size( 'punte-279x228', 297, 228, true );
        add_image_size( 'punte-297x400', 297, 400, true );
        add_image_size( 'punte-100x70', 120, 100, true );
        add_image_size( 'punte-900x600', 900, 600, true );


        register_nav_menus( array(
            'primary' => esc_html__( 'Primary', 'punte' ),
        ) );

        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        add_theme_support( 'post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ) );

        /**
        * Add support for core custom logo.
        *
        * @link https://codex.wordpress.org/Theme_Logo
        */
        add_theme_support(
            'custom-logo', array(
                'height'      => 1280,
                'width'       => 1920,
                'flex-width'  => false,
                'flex-height' => false,
            )
        );

        add_theme_support( 'woocommerce' );
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
    }

endif;
add_action( 'after_setup_theme', 'punte_setup' );

function punte_content_width() {
    $GLOBALS[ 'content_width' ] = apply_filters( 'punte_content_width', 740 );
}

add_action( 'after_setup_theme', 'punte_content_width', 0 );


function punte_register_html5_support() {
    add_theme_support( 'html5', array( 'script', 'style' ) );
}
add_action( 'after_setup_theme', 'punte_register_html5_support' );


// Setup $content_width
if ( !isset( $content_width ) ) {
    $content_width = 800;
}

//Register widget area.
function punte_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar Right', 'punte' ),
        'id'            => 'punte-sidebar-right',
        'description'   => esc_html__( 'Add Widget to show in Right Sidebar', 'punte' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar Left', 'punte' ),
        'id'            => 'punte-sidebar-left',
        'description'   => esc_html__( 'Add Widget to show in Left Sidebar', 'punte' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Header Widget', 'punte' ),
        'id'            => 'punte-header-widget',
        'description'   => esc_html__( 'Add Widget to show in Header. Works with header Layout 3 and 6 only', 'punte' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer One', 'punte' ),
        'id'            => 'punte-footer-1',
        'description'   => esc_html__( 'Add Widget to show in Footer', 'punte' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Two', 'punte' ),
        'id'            => 'punte-footer-2',
        'description'   => esc_html__( 'Add Widget to show in Footer', 'punte' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Three', 'punte' ),
        'id'            => 'punte-footer-3',
        'description'   => esc_html__( 'Add Widget to show in Footer', 'punte' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer Four', 'punte' ),
        'id'            => 'punte-footer-4',
        'description'   => esc_html__( 'Add Widget to show in Footer', 'punte' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}

add_action( 'widgets_init', 'punte_widgets_init' );

//Enqueue scripts and styles.
function punte_scripts() {
    global $punte_options;
    $skin_color             = isset( $punte_options[ 'skin-color' ] ) ? $punte_options[ 'skin-color' ] : '#25bcea';
    $sticky_sidebar         = isset( $punte_options[ 'sticky-sidebar' ] ) ? $punte_options[ 'sticky-sidebar' ] : false;
    $enable_responsive      = isset( $punte_options[ 'enable-responsive' ] ) ? $punte_options[ 'enable-responsive' ] : true;
    $enable_custom_header   = isset( $punte_options[ 'enable-custom-header' ] ) ? $punte_options[ 'enable-custom-header' ] : true;
    


    $punte_option_array = array(
        'skin_color'            => $skin_color,
        'sticky_sidebar'        => $sticky_sidebar
    );
    $font_families = array();

    $font_families[] = 'Roboto:400,400i,700,700i&display=swap';
    $font_families[] = 'Open+Sans:400,400i,700,700i&display=swap';

    $query_args = array(
        'family' => urlencode( implode( '|', $font_families ) ),
        'subset' => urlencode( 'latin,latin-ext' ),
    );
    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

    wp_enqueue_style( 'punte-fonts', $fonts_url, array(), PUNTE_THEME_VERSION );

    
    wp_register_style( 'punte-comments', PUNTE_THEME_URI . '/assets/css/comments.css', array(), PUNTE_THEME_VERSION );
    wp_register_style( 'punte-sidebar', PUNTE_THEME_URI . '/assets/css/sidebar.css', array(), PUNTE_THEME_VERSION );
    
    if( false == $enable_custom_header || ! class_exists('ReduxFramework')){
        wp_enqueue_style( 'punte-headers', PUNTE_THEME_URI . '/assets/css/headers.css', array(), PUNTE_THEME_VERSION );
    }

    
    wp_enqueue_style( 'punte-footers', PUNTE_THEME_URI . '/assets/css/footers.css', array(), PUNTE_THEME_VERSION );
    

    if( is_singular() ){
        wp_enqueue_style( 'punte-blog', PUNTE_THEME_URI . '/assets/css/blog.css', array(), PUNTE_THEME_VERSION );   
    }

    wp_enqueue_style( 'punte-main', PUNTE_THEME_URI . '/assets/css/main.css', array(), PUNTE_THEME_VERSION );
    
    
    if( class_exists('woocommerce') ){
        wp_enqueue_style( 'punte-woocommerce', PUNTE_THEME_URI . '/assets/css/woocommerce.css', array(), PUNTE_THEME_VERSION );
    }

    
    
    wp_enqueue_style( 'punte-style', get_stylesheet_uri() );
    if ( $enable_responsive ) {
        wp_enqueue_style( 'punte-responsive', PUNTE_THEME_URI . '/assets/css/responsive.css', array(), PUNTE_THEME_VERSION );
    }

    wp_enqueue_script( 'jquery-stellar', PUNTE_THEME_URI . '/assets/js/jquery.stellar.js', array( 'jquery' ), PUNTE_THEME_VERSION, true );
    wp_enqueue_script( 'jquery-nav', PUNTE_THEME_URI . '/assets/js/jquery.nav.js', array( 'jquery' ), PUNTE_THEME_VERSION, true );
    
    
    
    
    wp_enqueue_script( 'theia-sticky-sidebar', PUNTE_THEME_URI . '/assets/js/theia-sticky-sidebar.js', array( 'jquery' ), PUNTE_THEME_VERSION, true );

    wp_enqueue_script( 'punte-main', PUNTE_THEME_URI . '/assets/js/main.js', array( 'jquery' ), PUNTE_THEME_VERSION, true );
    wp_localize_script( 'punte-main', 'punte_options', $punte_option_array );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'punte_scripts', 50 );

//Enqueue admin scripts and styles.
function punte_admin_scripts() {

    $currentScreen = get_current_screen();

    if( $currentScreen->id == 'toplevel_page_punte_options' ){
        wp_enqueue_style( 'punte-redux-style', PUNTE_THEME_URI . '/inc/modified-redux/css/redux-style.css', array(), PUNTE_THEME_VERSION );    
    }

    
}

add_action( 'admin_enqueue_scripts', 'punte_admin_scripts', 50 );


/**
 * Custom template tags for this theme.
 */
require PUNTE_THEME_DIR . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require PUNTE_THEME_DIR . '/inc/customizer.php';



/**
 * Custom functions that act independently of the theme templates.
 */
require PUNTE_THEME_DIR . '/inc/icons/svg-icons.php';
require PUNTE_THEME_DIR . '/inc/extras.php';
require PUNTE_THEME_DIR . '/functions/header-functions.php';
require PUNTE_THEME_DIR . '/functions/footer-functions.php';
require PUNTE_THEME_DIR . '/functions/helper-functions.php';
require PUNTE_THEME_DIR . '/functions/punte-functions.php';

/**
 * Custom Hooks and Filters
 */
require PUNTE_THEME_DIR . '/inc/punte-woo.php';
require PUNTE_THEME_DIR . '/inc/breadcrumbs.php';

/**
* Custom header
*/
require PUNTE_THEME_DIR . '/inc/custom-header.php';

/**
* Welcome Page
*/
require PUNTE_THEME_DIR . '/inc/welcome/welcome-config.php';

/**
* Starter content for theme
*/
require PUNTE_THEME_DIR . '/inc/starter-contents.php';


if( ! class_exists('Punte_Companion')){
    require_once PUNTE_THEME_DIR . '/inc/modified-redux/punte-config.php';    
    /** Dynamic Style * */
    require PUNTE_THEME_DIR . '/inc/styles.php';
}





function punte_remove_redux_demo_link() {
    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        remove_action( 'admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
    }
}

add_action( 'init', 'punte_remove_redux_demo_link' );


/**
* Require files 
*/
$req_files = apply_filters('punte_require_files','__return_false');
         
if( $req_files != '__return_false' ){
  if( is_array($req_files) ){
      foreach ( $req_files as $files ){
        require $files;
      }
  }else{
    require $req_files;               
  }
}
