<?php
/**
 * Madd Magazine functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Madd_Magazine
 */

if ( ! function_exists( 'madd_magazine_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function madd_magazine_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Madd Magazine, use a find and replace
		 * to change 'madd-magazine' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'madd-magazine', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size('madd-magazine-blog-post', 730, 485, true);

		add_theme_support('post-formats', array('video'));

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Header Menu', 'madd-magazine' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'madd_magazine_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
				'height'      => 128,
				'width'       => 274,
				'flex-height' => true,
				'flex-width'  => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'madd_magazine_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function madd_magazine_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'madd_magazine_content_width', 640 );
}
add_action( 'after_setup_theme', 'madd_magazine_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function madd_magazine_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Left', 'madd-magazine' ),
		'id'            => 'sidebar-widget',
		'description'   => esc_html__( 'Add widgets here.', 'madd-magazine' ),
		'before_widget' => '<div id="%1$s" class="%2$s sidebar-widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Right', 'madd-magazine' ),
		'id'            => 'sidebar-widget2',
		'description'   => esc_html__( 'Add widgets here.', 'madd-magazine' ),
		'before_widget' => '<div id="%1$s" class="%2$s sidebar-widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'madd-magazine' ),
		'id'            => 'footer-widget',
		'description'   => esc_html__( 'Add widgets here.', 'madd-magazine' ),
		'before_widget' => '<div id="%1$s" class="%2$s footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="footer-widget-title">',
		'after_title' => '</div>',
	));

	register_sidebar( array(
		'name'          => esc_html__( 'Top ADS Block', 'madd-magazine' ),
		'id'            => 'ads-widget1',
		'description'   => esc_html__( 'Add widgets here.', 'madd-magazine' ),
				'before_widget' => '<div id="%1$s" class="%2$s top-ads-widget">',
				'after_widget' => '</div>',
				'before_title' => '<div class="widget-title">',
				'after_title' => '</div>',
	));

}
add_action( 'widgets_init', 'madd_magazine_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function madd_magazine_scripts() {

	wp_enqueue_style( 'madd-magazine-theme-google-font-open', '//fonts.googleapis.com/css?family=Oswald:400,700|Roboto:400,700', null, null );

	wp_register_style('font-awesome', get_template_directory_uri() . '/js/lib/font-awesome/css/font-awesome.min.css', array(), '4.7.0', 'all');
	wp_enqueue_style('font-awesome');

  wp_register_style('swiper', get_template_directory_uri() . '/js/lib/swiper/css/swiper.min.css', array(), '4.1.0', 'all');
  wp_enqueue_style('swiper'); // Enqueue it!

	wp_enqueue_style( 'madd-magazine-style', get_stylesheet_uri() );

	wp_register_script('swiper', get_template_directory_uri() . '/js/lib/swiper/js/swiper.js', array('jquery'), '4.1.0');
  wp_enqueue_script('swiper'); // Enqueue it!

	wp_register_script('madd-magazine-theme-script', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
	wp_enqueue_script('madd-magazine-theme-script'); // Enqueue it!

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'madd_magazine_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

// /**
//  * TGM_Plugin_Activation class.
//  */
require_once get_template_directory() . '/inc/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'madd_magazine_register_required_plugins' );
function madd_magazine_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'Recent Posts Widget With Thumbnails',
			'slug'      => 'recent-posts-widget-with-thumbnails',
			'required'  => false,
		),
	);

	$config = array(
		'id'           => 'madd-magazine',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}