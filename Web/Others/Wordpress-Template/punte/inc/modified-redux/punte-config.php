<?php

/**
 * ReduxFramework Barebones Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */
if ( !class_exists( 'Redux' ) ) {
    return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "punte_options";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */
$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    'footer_credit' => esc_html__( 'Punte - Theme Option Panel', 'punte' ),
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => $theme->get( 'Name' ),
    // Name that appears at the top of your panel
    'display_version' => $theme->get( 'Version' ),
    // Version that appears at the top of your panel
    'menu_type' => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true,
    // Show the sections below the admin menu item or not
    'menu_title' => esc_html__( 'Punte Options', 'punte' ),
    'page_title' => esc_html__( 'Punte Options', 'punte' ),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key' => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography' => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar' => false,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-admin-generic',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Show the time the page took to load, etc
    'update_notice' => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    // OPTIONAL -> Give you extra features
    'page_priority' => 60,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => 'dashicons-admin-generic',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => 'punte_options',
    // Page slug used to denote the panel
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => false,
    'show_options_object' => false,
    // Shows the Import/Export panel when not used as a field.
    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => false,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
    //'compiler'             => true,
    'disable_tracking' => true,
    // HINTS
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'light',
            'shadow' => true,
            'rounded' => false,
            'style' => 'tipsy',
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '200',
                'event' => 'mouseover',
            ),
            'hide' => array(
                'effect' => 'fade',
                'duration' => '100',
                'event' => 'click mouseleave',
            ),
        ),
    )
);

// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
$args[ 'admin_bar_links' ][] = array(
    'id'    => 'punte-docs',
    'href'  => 'http://thepunte.com/',
    'title' => esc_html__( 'Punte Documentation', 'punte' ),
);

$args[ 'admin_bar_links' ][] = array(
    'id'    => 'punte-support',
    'href'  => 'http://thepunte.com/',
    'title' => esc_html__( 'Punte Support', 'punte' ),
);

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
$args[ 'share_icons' ][] = array(
    'url'   => 'https://www.facebook.com/PunteThemes',
    'title' => esc_html__('Like us on Facebook','punte'),
    'icon'  => 'el el-facebook'
);
$args[ 'share_icons' ][] = array(
    'url'   => 'https://twitter.com/PunteThemes',
    'title' => esc_html__('Follow us on Twitter','punte'),
    'icon'  => 'el el-twitter'
);

$args[ 'share_icons' ][] = array(
    'url'   => 'https://www.youtube.com/channel/UCdvOoyiQVG0z4E0zL8_lnUA',
    'title' => esc_html__('Subscribe Us on YouTube','punte'),
    'icon'  => 'el el-youtube'
);

Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */

/*
 * ---> START HELP TABS
 */


// Set the help sidebar
$content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'punte' );



/*
 * <--- END HELP TABS
 */


/*
 *
 * ---> START SECTIONS
 *
 */

$content_ratio = array(
    '80' => '80% | 20%',
    '79' => '79% | 21%',
    '78' => '78% | 22%',
    '77' => '77% | 23%',
    '76' => '76% | 24%',
    '75' => '75% | 25%',
    '74' => '74% | 26%',
    '73' => '73% | 27%',
    '72' => '72% | 28%',
    '71' => '71% | 29%',
    '70' => '70% | 30%',
    '69' => '69% | 31%',
    '68' => '68% | 32%',
    '67' => '67% | 33%',
    '66' => '66% | 34%',
    '65' => '65% | 35%',
    '64' => '64% | 36%',
    '63' => '63% | 37%',
    '62' => '62% | 38%',
    '61' => '61% | 39%',
    '60' => '60% | 40%',
    '59' => '59% | 41%',
    '58' => '58% | 42%',
    '57' => '57% | 43%',
    '56' => '56% | 44%',
    '55' => '55% | 45%',
    '54' => '54% | 46%',
    '53' => '53% | 47%',
    '52' => '52% | 48%',
    '51' => '51% | 49%',
    '50' => '50% | 50%',
);

$image_url = PUNTE_THEME_URI . '/inc/modified-redux/images/';

$sidebar_layout = apply_filters('punte_sidebar_layouts',array(
    'no-sidebar' => array(
        'alt' => esc_html__( 'No Sidebar', 'punte' ),
        'img' => $image_url . 'sidebar/1c.png'
    ),
    'left-sidebar' => array(
        'alt' => esc_html__( 'Left Sidebar', 'punte' ),
        'img' => $image_url . 'sidebar/2cl.png'
    ),
    'right-sidebar' => array(
        'alt' => esc_html__( 'Right Sidebar', 'punte' ),
        'img' => $image_url . 'sidebar/2cr.png'
    ),
    'both-sidebar' => array(
        'alt' => esc_html__( 'Both Sidebar', 'punte' ),
        'img' => $image_url . 'sidebar/3cm.png'
    ),
));



//site main headers
$main_header_styles = apply_filters('punte_site_nav_styles',array(
        'header-1' => array(
            'alt' => esc_html__( 'Header One', 'punte' ),
            'img' => $image_url . 'headers/header1.png'
        ),
        'header-2' => array(
            'alt' => esc_html__( 'Header Two', 'punte' ),
            'img' => $image_url . 'headers/header2.png'
        ),
        'header-3' => array(
                'alt' => esc_html__( 'Header Three', 'punte' ),
                'img' => $image_url . 'headers/header3.png'
            ),
        'header-4' => array(
            'alt' => esc_html__( 'Header Four', 'punte' ),
            'img' => $image_url . 'headers/header4.png'
        ),
      
));

//blog style
$blog_styles = apply_filters('punte_blog_styles',array(
        'blog-style1' => array(
            'alt' => esc_html__( 'Blog Style One', 'punte' ),
            'img' => $image_url . 'blog/blog-style1.png'
        ),
        'blog-style2' => array(
            'alt' => esc_html__( 'Blog Style Two', 'punte' ),
            'img' => $image_url . 'blog/blog-style2.png'
        ),
));

// -> START Basic Fields
Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Getting Started', 'punte' ),
    'id' => 'punte-getting-started',
    'icon' => 'el el-cog'
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'General Settings', 'punte' ),
    'id' => 'punte-general-settings',
    'subsection' => true,
    'fields' => apply_filters('punte_general_settings_args',array(
       
        array(
            'id' => 'enable-breadcrumb',
            'type' => 'switch',
            'title' => esc_html__( 'Enable BreadCrumb', 'punte' ),
            'default' => true,
        ),
        array(
            'id' => 'enable-backtotop',
            'type' => 'switch',
            'title' => esc_html__( 'Enable Back To Top', 'punte' ),
            'default' => true
        ),
       
    ) )

) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Colors', 'punte' ),
    'id' => 'punte-colors',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'skin-color',
            'type' => 'color',
            'title' => esc_html__( 'Theme Skin', 'punte' ),
            'default' => '#25bcea',
            'transparent' => false
        ),
        array(
            'id' => 'content-link-color',
            'type' => 'link_color',
            'title' => esc_html__( 'Main Content Link Color', 'punte' ),
            'default' => '#333333',
            'transparent' => false,
            'active' => false, // Disable Active Color
            'visited' => false, // Enable Visited Color
            'default' => array(
                'regular' => '#333333',
                'hover' => '#25bcea',
            )
        ),
        array(
            'id' => 'body-background',
            'type' => 'background',
            'title' => esc_html__( 'Body background', 'punte' ),
            'preview_media' => true,
            'preview' => false,
            'transparent' => false,
            'default' => array(
                'background-color' => '#FFFFFF',
            )
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Responsive', 'punte' ),
    'id' => 'punte-responsive',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'enable-responsive',
            'type' => 'switch',
            'title' => esc_html__( 'Enable Responsive', 'punte' ),
            'default' => true,
        ),
        array(
            'id' => 'responsive-width',
            'type' => 'slider',
            'title' => esc_html__( 'Enable Resonsive Nav from', 'punte' ),
            'subtitle' => esc_html__( 'Select the container width in px from where the responsive nav appear.', 'punte' ),
            'desc' => esc_html__( 'Min: 420, Max: 1200, Default Value: 1170', 'punte' ),
            'default' => 768,
            'min' => 420,
            'step' => 1,
            'max' => 1200,
            'display_value' => 'text'
        ),
    )
) );


Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Layout', 'punte' ),
    'id' => 'punte-layout',
    'icon' => 'el el-website',
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Website Layout', 'punte' ),
    'id' => 'punte-website-layout',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'website-layout',
            'type' => 'button_set',
            'title' => esc_html__( 'Website Layout', 'punte' ),
            'options' => array(
                'full-width' => esc_html__( 'Full Width', 'punte' ),
                'boxed' => esc_html__( 'Boxed', 'punte' )
            ),
            'default' => 'full-width'
        ),
        array(
            'id' => 'container-width',
            'type' => 'slider',
            'title' => esc_html__( 'Container Width', 'punte' ),
            'subtitle' => esc_html__( 'Container width in px', 'punte' ),
            'desc' => esc_html__( 'Min: 960, Max: 1300, Default Value: 1170', 'punte' ),
            'default' => 1170,
            'min' => 960,
            'step' => 1,
            'max' => 1300,
            'display_value' => 'text'
        ),
        array(
            'id' => 'content-sidebar-ratio',
            'type' => 'select',
            'title' => esc_html__( 'Content | Sidebar Ratio', 'punte' ),
            'select2' => array( 'allowClear' => false, 'minimumResultsForSearch' => -1 ),
            'desc' => esc_html__( 'Default: 70% | 30%', 'punte' ),
            'options' => $content_ratio,
            'default' => '70'
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Sidebar Layout', 'punte' ),
    'id' => 'punte-sidebar-layout',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'blog-layout',
            'type' => 'image_select',
            'title' => esc_html__( 'Blog Page Sidebar Layout', 'punte' ),
            'options' => $sidebar_layout,
            'default' => 'right-sidebar'
        ),
        array(
            'id' => 'page-layout',
            'type' => 'image_select',
            'title' => esc_html__( 'Page Sidebar Layout', 'punte' ),
            'options' => $sidebar_layout,
            'default' => 'right-sidebar'
        ),
        array(
            'id' => 'post-layout',
            'type' => 'image_select',
            'title' => esc_html__( 'Post Sidebar Layout', 'punte' ),
            'options' => $sidebar_layout,
            'default' => 'right-sidebar'
        ),
        array(
            'id' => 'portfolio-layout',
            'type' => 'image_select',
            'title' => esc_html__( 'Portfolio Post Sidebar Layout', 'punte' ),
            'options' => $sidebar_layout,
            'default' => 'right-sidebar'
        ),
        array(
            'id' => 'archive-layout',
            'type' => 'image_select',
            'title' => esc_html__( 'Archive Page Sidebar Layout', 'punte' ),
            'options' => $sidebar_layout,
            'default' => 'right-sidebar'
        ),
        array(
            'id' => 'search-layout',
            'type' => 'image_select',
            'title' => esc_html__( 'Search Page Sidebar Layout', 'punte' ),
            'options' => $sidebar_layout,
            'default' => 'right-sidebar'
        ),
        array(
            'id' => '404-layout',
            'type' => 'image_select',
            'title' => esc_html__( '404 Page Sidebar Layout', 'punte' ),
            'options' => $sidebar_layout,
            'default' => 'right-sidebar'
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Post Title Bar Layout', 'punte' ),
    'id' => 'punte-post-title-bar',
    'subsection' => true,
    'desc' => __( 'This Settings will apply globally on all the posts. These setting can additionally be changed in the respective posts', 'punte' ),
    'fields' => apply_filters('punte_post_title',array(
        array(
            'id' => 'post-enable-header-bar',
            'type' => 'switch',
            'title' => esc_html__( 'Enable Post Header', 'punte' ),
            'default' => true
        ),
        array(
            'id' => 'post-header-bg',
            'type' => 'background',
            'title' => esc_html__( 'Header Background', 'punte' ),
            'preview_media' => true,
            'preview' => false,
            'transparent' => false,
            'default' => array(
                'background-color' => '#f5f4f4'
            )
        ),
       
       
        array(
            'id' => 'post-header-text-color',
            'type' => 'color',
            'title' => esc_html__( 'Post Header Title/SubTitle Color', 'punte' ),
            'transparent' => false,
            'default' => '#333333'
        ),
        array(
            'id' => 'post-header-padding',
            'type' => 'spacing',
            'mode' => 'padding',
            'all' => false,
            'right' => false, // Disable the right
            'left' => false, // Disable the left
            'units' => array( 'px' ), // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'false', // Allow users to select any type of unit
            'title' => esc_html__( 'Title Padding', 'punte' ),
            'desc' => esc_html__( 'Top, Bottom Padding', 'punte' ),
            'select2' => array( 'allowClear' => false, 'minimumResultsForSearch' => -1 ),
            'default' => array(
                'padding-top' => '20px',
                'padding-bottom' => '20px',
            ),
        ),
        
        
    ))
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Page Title Bar Layout', 'punte' ),
    'id' => 'punte-page-title-bar',
    'subsection' => true,
    'desc' => __( 'This Settings will apply globally on all the pages. These setting can additionally be changed in the respective pages', 'punte' ),
    'fields' => apply_filters('punte_page_title',array(
        array(
            'id' => 'page-enable-header-bar',
            'type' => 'switch',
            'title' => esc_html__( 'Enable Page Header', 'punte' ),
            'default' => true
        ),
        array(
            'id' => 'page-header-bg',
            'type' => 'background',
            'title' => esc_html__( 'Header Background', 'punte' ),
            'preview_media' => true,
            'preview' => false,
            'transparent' => false,
            'default' => array(
                'background-color' => '#f5f4f4'
            )
        ),
        
       
        array(
            'id' => 'page-header-text-color',
            'type' => 'color',
            'title' => esc_html__( 'Page Header Title/SubTitle Color', 'punte' ),
            'transparent' => false,
            'default' => '#333333'
        ),
        array(
            'id' => 'page-header-padding',
            'type' => 'spacing',
            'mode' => 'padding',
            'all' => false,
            'right' => false, // Disable the right
            'left' => false, // Disable the left
            'units' => array( 'px' ), // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'false', // Allow users to select any type of unit
            'title' => esc_html__( 'Title Padding', 'punte' ),
            'desc' => esc_html__( 'Top, Bottom Padding', 'punte' ),
            'select2' => array( 'allowClear' => false, 'minimumResultsForSearch' => -1 ),
            'default' => array(
                'padding-top' => '20px',
                'padding-bottom' => '20px',
            ),
        ),
       
    ))
) );

do_action('punte_title_bar_hooks');

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Archive Title Bar Layout', 'punte' ),
    'id' => 'punte-archive-title-bar',
    'subsection' => true,
    'desc' => __( 'This Settings will apply globally on all archive pages. It includes category, tag, date, author, search, taxonomy pages', 'punte' ),
    'fields' => apply_filters('punte_archive_title',array(
        array(
            'id' => 'archive-enable-header-bar',
            'type' => 'switch',
            'title' => esc_html__( 'Enable archive Header', 'punte' ),
            'default' => true
        ),
        array(
            'id' => 'archive-header-bg',
            'type' => 'background',
            'title' => esc_html__( 'Header Background', 'punte' ),
            'preview_media' => true,
            'preview' => false,
            'transparent' => false,
            'default' => array(
                'background-color' => '#f5f4f4'
            )
        ),
       
        array(
            'id' => 'archive-header-text-color',
            'type' => 'color',
            'title' => esc_html__( 'Archive Header Title/SubTitle Color', 'punte' ),
            'transparent' => false,
            'default' => '#333333'
        ),
        array(
            'id' => 'archive-header-padding',
            'type' => 'spacing',
            'mode' => 'padding',
            'all' => false,
            'right' => false, // Disable the right
            'left' => false, // Disable the left
            'units' => array( 'px' ), // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'false', // Allow users to select any type of unit
            'title' => esc_html__( 'Title Padding', 'punte' ),
            'desc' => esc_html__( 'Top, Bottom Padding', 'punte' ),
            'select2' => array( 'allowClear' => false, 'minimumResultsForSearch' => -1 ),
            'default' => array(
                'padding-top' => '20px',
                'padding-bottom' => '20px',
            ),
        ),
        
    ))
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Header', 'punte' ),
    'id' => 'punte-header',
    'icon' => 'el el-caret-up',
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Header Style', 'punte' ),
    'id' => 'punte-header-style',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'header-style',
            'type' => 'image_select',
            'title' => esc_html__( 'Header Style', 'punte' ),
            'options' => $main_header_styles,
            'default' => 'header-1'
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Main Header', 'punte' ),
    'id' => 'punte-main-header',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'header-background',
            'type' => 'color_rgba',
            'title' => esc_html__( 'Header Background Color', 'punte' ),
            'default' => array(
                'color' => '#FFFFFF',
                'alpha' => '1',
                'rgba' => 'rgba(255,255,255,1)'
            ),
            'options' => array(
                'clickout_fires_change' => true,
                'show_buttons' => false,
            )
        ),
        array(
            'id' => 'transparent-header',
            'type' => 'switch',
            'title' => esc_html__( 'Transparent Header', 'punte' ),
            'default' => false,
            'on' => esc_html__( 'Enable', 'punte' ),
            'off' => esc_html__( 'Disable', 'punte' )
        ),
        array(
            'id' => 'navbar-height',
            'type' => 'slider',
            'title' => esc_html__( 'Navbar height', 'punte' ),
            'subtitle' => esc_html__( 'Navbar height in px', 'punte' ),
            'desc' => esc_html__( 'Min: 80, Max: 150, Default Value: 90', 'punte' ),
            'default' => 90,
            'min' => 60,
            'step' => 1,
            'max' => 150,
            'display_value' => 'text'
        ),
       
        array(
            'id' => 'enable-navbar-search',
            'type' => 'switch',
            'title' => esc_html__( 'Navbar Search', 'punte' ),
            'default' => true,
            'on' => esc_html__( 'Enable', 'punte' ),
            'off' => esc_html__( 'Disable', 'punte' )
        ),
        array(
            'id' => 'upload-logo',
            'type' => 'media',
            'title' => esc_html__( 'Upload Logo', 'punte' ),
            'desc' => esc_html__( 'Recommended Logo Size: 320px X 80px', 'punte' ),
            'default' => ''
        ),
        array(
            'id' => 'logo-padding',
            'type' => 'spacing',
            'mode' => 'padding',
            'all' => false,
            'units' => array( 'px' ), // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'false', // Allow users to select any type of unit
            'title' => esc_html__( 'Logo Padding', 'punte' ),
            'desc' => esc_html__( 'Top, Right, Bottom, Left Padding', 'punte' ),
            'select2' => array( 'allowClear' => false, 'minimumResultsForSearch' => -1 ),
            'default' => array(
                'padding-top' => '10px',
                'padding-right' => '10px',
                'padding-bottom' => '10px',
                'padding-left' => '0px'
            )
        ),
        array(
            'id' => 'menu-link-color',
            'type' => 'link_color',
            'title' => esc_html__( 'Menu - Link Color', 'punte' ),
            'transparent' => false,
            'active' => false, // Disable Active Color
            'visited' => false, // Enable Visited Color
            'default' => array(
                'regular' => '#333333',
                'hover' => '#25bcea',
            )
        ),
        array(
            'id' => 'submenu-link-color',
            'type' => 'link_color',
            'title' => esc_html__( 'SubMenu - Link Color', 'punte' ),
            'transparent' => false,
            'active' => false, // Disable Active Color
            'visited' => false, // Enable Visited Color
            'default' => array(
                'regular' => '#000',
                'hover' => '#25bcea',
            )
        ),
        array(
            'id' => 'submenu-background',
            'type' => 'color_rgba',
            'title' => esc_html__( 'SubMenu - Background Color', 'punte' ),
            'default' => array(
                'color' => '#25bcea',
                'alpha' => '.8',
                'rgba' => 'rgba(37,188,234,0.8)'
            ),
            'options' => array(
                'clickout_fires_change' => true,
                'show_buttons' => false,
            ),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Top Header', 'punte' ),
    'id' => 'punte-top-header',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'top-header',
            'type' => 'switch',
            'title' => esc_html__( 'Top Header', 'punte' ),
            'default' => false,
            'on' => esc_html__( 'Enable', 'punte' ),
            'off' => esc_html__( 'Disable', 'punte' )
        ),
        array(
            'id' => 'top-header-padding',
            'type' => 'spacing',
            'mode' => 'padding',
            'all' => false,
            'left' => false,
            'right' => false,
            'units' => array( 'px' ),
            'units_extended' => 'false',
            'title' => esc_html__( 'Top Header Padding', 'punte' ),
            'desc' => esc_html__( 'Top, Bottom Padding', 'punte' ),
            'select2' => array( 'allowClear' => false, 'minimumResultsForSearch' => -1 ),
            'default' => array(
                'padding-top' => '10px',
                'padding-bottom' => '10px',
            )
        ),
        array(
            'id' => 'top-left-header',
            'type' => 'select',
            'select2' => array( 'allowClear' => false, 'minimumResultsForSearch' => -1 ),
            'title' => esc_html__( 'Top Left Header Options', 'punte' ),
            'options' => array(
                'empty' => esc_html__( 'Empty', 'punte' ),
                'html-text' => esc_html__( 'HTML Text', 'punte' ),
                'menu' => esc_html__( 'Menu', 'punte' ),
                'widget' => esc_html__( 'Widget', 'punte' ),
            ),
            'default' => 'empty'
        ),
        array(
            'id' => 'top-left-header-html-text',
            'type' => 'editor',
            'required' => array( 'top-left-header', '=', 'html-text' ),
            'title' => esc_html__( 'Top Left Header Text', 'punte' ),
            'validate' => 'html_custom',
            'default' => esc_html__( 'Mail Us : info@example.com | Call Us : +977 9841012345', 'punte' ),
            'args' => array(
                'wpautop' => false,
                'media_buttons' => false,
                'textarea_rows' => 5,
                'teeny' => false,
                'quicktags' => false,
            )
        ),
        array(
            'id' => 'top-left-header-menu',
            'type' => 'select',
            'data' => 'menus',
            'select2' => array( 'allowClear' => false, 'minimumResultsForSearch' => -1 ),
            'required' => array( 'top-left-header', '=', 'menu' ),
            'title' => esc_html__( 'Top Left Header Menu', 'punte' ),
        ),
        array(
            'id' => 'top-left-header-widget',
            'type' => 'select',
            'data' => 'sidebars',
            'required' => array( 'top-left-header', '=', 'widget' ),
            'title' => esc_html__( 'Select the Widget', 'punte' ),
            'select2' => array( 'allowClear' => false, 'minimumResultsForSearch' => -1 ),
        ),
        array(
            'id' => 'top-right-header',
            'type' => 'select',
            'select2' => array( 'allowClear' => false, 'minimumResultsForSearch' => -1 ),
            'title' => esc_html__( 'Top Right Header Options', 'punte' ),
            'options' => array(
                'empty' => esc_html__( 'Empty', 'punte' ),
                'html-text' => esc_html__( 'HTML Text', 'punte' ),
                'menu' => esc_html__( 'Menu', 'punte' ),
                'widget' => esc_html__( 'Widget', 'punte' ),
            ),
            'default' => 'empty'
        ),
        array(
            'id' => 'top-right-header-html-text',
            'type' => 'editor',
            'required' => array( 'top-right-header', '=', 'html-text' ),
            'title' => esc_html__( 'Top Right Header Text', 'punte' ),
            'args' => array(
                'wpautop' => false,
                'media_buttons' => false,
                'textarea_rows' => 5,
                'teeny' => false,
                'quicktags' => false,
            )
        ),
        array(
            'id' => 'top-right-header-menu',
            'type' => 'select',
            'select2' => array( 'allowClear' => false, 'minimumResultsForSearch' => -1 ),
            'data' => 'menus',
            'required' => array( 'top-right-header', '=', 'menu' ),
            'title' => esc_html__( 'Top Right Menu', 'punte' ),
            'desc' => sprintf( __( 'Go to <a target="_blank" href="%s">Menu Page</a> to create a new Menu and refresh the page', 'punte' ), admin_url( '/nav-menus.php' ) ), // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
        ),
        array(
            'id' => 'top-right-header-widget',
            'type' => 'select',
            'select2' => array( 'allowClear' => false, 'minimumResultsForSearch' => -1 ),
            'data' => 'sidebars',
            'required' => array( 'top-right-header', '=', 'widget' ),
            'title' => esc_html__( 'Select the Widget', 'punte' ),
            'desc' => sprintf( __( 'Go to <a target="_blank" href="%s">widget Page</a> to create a new Widget Area and refresh this page', 'punte' ), admin_url( '/widgets.php' ) ), // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
        ),
        array(
            'id' => 'top-header-background',
            'type' => 'color_rgba',
            'title' => esc_html__( 'Top Header Background Color', 'punte' ),
            'default' => array(
                'color' => '#25bcea',
                'alpha' => '1',
                'rgba' => 'rgba(37,188,234,1)'
            ),
            'options' => array(
                'clickout_fires_change' => true,
                'show_buttons' => false,
            )
        ),
        array(
            'id' => 'top-header-text-color',
            'type' => 'color',
            'title' => esc_html__( 'Text Color', 'punte' ),
            'default' => '#FFFFFF',
            'transparent' => false
        ),
        array(
            'id' => 'top-header-link-color',
            'type' => 'link_color',
            'title' => esc_html__( 'Link Color', 'punte' ),
            'transparent' => false,
            'active' => false, // Disable Active Color
            'visited' => false, // Enable Visited Color
            'default' => array(
                'regular' => '#FAFAFA',
                'hover' => '#EEEEEE',
            )
        ),
    )
) );


Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Header Builder', 'punte' ),
    'id' => 'punte-header-builder',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'enable-custom-header',
            'type' => 'switch',
            'title' => esc_html__( 'Enable Custom Header', 'punte' ),
            'default' => false,
            'on' => esc_html__( 'Yes', 'punte' ),
            'off' => esc_html__( 'No', 'punte' ),
            'desc' => esc_html__( 'Build custom Header', 'punte' ),
        ),
        array(
            'id'        => 'custom-header-page',
            'type'      => 'select',
            'title'     => esc_html__( 'Header Template', 'punte' ),
            'desc'      => esc_html__( 'Select elementor template for header', 'punte' ),
            'default'   => 0,
            'options'   => punte_get_elementor_templates(),
        ),
        array(
            'id' => 'custom-header-font-color',
            'type' => 'color',
            'title' => esc_html__( 'Text Color', 'punte' ),
            'default' => '#333333',
            'transparent' => false
        ),
        array(
            'id' => 'custom-header-link-color',
            'type' => 'link_color',
            'title' => esc_html__( 'Anchor Link Color', 'punte' ),
            'default' => '#333333',
            'transparent' => false,
            'active' => false, // Disable Active Color
            'visited' => false, // Enable Visited Color
            'default' => array(
                'regular' => '#333333',
                'hover' => '#25bcea',
            )
        ),
    )
) );


Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Footer', 'punte' ),
    'id' => 'punte-footer',
    'icon' => 'el el-caret-down',
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Footer Settings', 'punte' ),
    'id' => 'punte-footer-settings',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'show-footer',
            'type' => 'switch',
            'title' => esc_html__( 'Footer', 'punte' ),
            'default' => true,
            'on' => esc_html__( 'Show', 'punte' ),
            'off' => esc_html__( 'Hide', 'punte' )
        ),
        array(
            'id' => 'footer-column',
            'type' => 'image_select',
            'title' => esc_html__( 'Footer Widget Column', 'punte' ),
            'options' => array(
                'col-1' => array(
                    'alt' => esc_html__( 'One Column', 'punte' ),
                    'img' => $image_url . 'footer/1c.png'
                ),
                'col-2' => array(
                    'alt' => esc_html__( 'Two Column', 'punte' ),
                    'img' => $image_url . 'footer/2c.png'
                ),
                'col-3' => array(
                    'alt' => esc_html__( 'Three Column', 'punte' ),
                    'img' => $image_url . 'footer/3c.png'
                ),
                'col-4' => array(
                    'alt' => esc_html__( 'Four Column', 'punte' ),
                    'img' => $image_url . 'footer/4c.png'
                ),
                'col-1-2' => array(
                    'alt' => esc_html__( 'One Two Column', 'punte' ),
                    'img' => $image_url . 'footer/1-2c.png'
                ),
                'col-2-1' => array(
                    'alt' => esc_html__( 'Two One Column', 'punte' ),
                    'img' => $image_url . 'footer/2-1c.png'
                ),
                'col-1-1-2' => array(
                    'alt' => esc_html__( 'One One Two Column', 'punte' ),
                    'img' => $image_url . 'footer/1-1-2c.png'
                ),
                'col-2-1-1' => array(
                    'alt' => esc_html__( 'Two One One Column', 'punte' ),
                    'img' => $image_url . 'footer/2-1-1c.png'
                ),
                'col-1-3' => array(
                    'alt' => esc_html__( 'One Three Column', 'punte' ),
                    'img' => $image_url . 'footer/1-3c.png'
                ),
                'col-3-1' => array(
                    'alt' => esc_html__( 'Three One Column', 'punte' ),
                    'img' => $image_url . 'footer/3-1c.png'
                ),
                'col-1-2-1' => array(
                    'alt' => esc_html__( 'One Two One Column', 'punte' ),
                    'img' => $image_url . 'footer/1-2-1c.png'
                ),
            ),
            'default' => 'col-4'
        ),
        array(
            'id' => 'footer-font-size',
            'type' => 'slider',
            'title' => esc_html__( 'Footer Text Size', 'punte' ),
            'default' => 14,
            'min' => 10,
            'step' => 1,
            'max' => 40,
            'display_value' => 'text'
        ),
        array(
            'id' => 'footer-background-color',
            'type' => 'color',
            'title' => esc_html__( 'Footer Background Color', 'punte' ),
            'default' => '#333333',
            'transparent' => false
        ),
        array(
            'id' => 'footer-header-color',
            'type' => 'color',
            'title' => esc_html__( 'Footer Header Color', 'punte' ),
            'default' => '#FFFFFF',
            'transparent' => false
        ),
        array(
            'id' => 'footer-text-color',
            'type' => 'color',
            'title' => esc_html__( 'Footer Text Color', 'punte' ),
            'default' => '#EEEEEE',
            'transparent' => false
        ),
        array(
            'id' => 'footer-link-color',
            'type' => 'link_color',
            'title' => esc_html__( 'Footer Link Color', 'punte' ),
            'transparent' => false,
            'active' => false, // Disable Active Color
            'visited' => false, // Enable Visited Color
            'default' => array(
                'regular' => '#CCCCCC',
                'hover' => '#AAAAAA',
            )
        ),
        array(
            'id' => 'copyright-text',
            'type' => 'editor',
            'title' => esc_html__( 'CopyRight Text', 'punte' ),
            'default' => esc_html__( 'All Right Reserved.', 'punte' ),
            'args' => array(
                'wpautop' => false,
                'media_buttons' => false,
                'textarea_rows' => 5,
                'teeny' => false,
                'quicktags' => false,
            )
        ),
    )
) );


Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Footer Builder', 'punte' ),
    'id' => 'punte-footer-builder',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'enable-custom-footer',
            'type' => 'switch',
            'title' => esc_html__( 'Enable Custom Footer', 'punte' ),
            'default' => false,
            'on' => esc_html__( 'Yes', 'punte' ),
            'off' => esc_html__( 'No', 'punte' ),
            'desc' => esc_html__( 'Builder custom Footer', 'punte' ),
        ),
        array(
            'id'        => 'custom-footer-page',
            'type'      => 'select',
            'title'     => esc_html__( 'Footer Template', 'punte' ),
            'desc'      => esc_html__( 'Select elementor template for footer', 'punte' ),
            'default'   => 0,
            'options'   => punte_get_elementor_templates(),
        ),
        array(
            'id' => 'custom-footer-font-color',
            'type' => 'color',
            'title' => esc_html__( 'Text Color', 'punte' ),
            'default' => '#333333',
            'transparent' => false
        ),
        array(
            'id' => 'custom-footer-link-color',
            'type' => 'link_color',
            'title' => esc_html__( 'Anchor Link Color', 'punte' ),
            'default' => '#333333',
            'transparent' => false,
            'active' => false, // Disable Active Color
            'visited' => false, // Enable Visited Color
            'default' => array(
                'regular' => '#333333',
                'hover' => '#25bcea',
            )
        ),
    )
) );


Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Sidebar', 'punte' ),
    'id' => 'punte-sidebar',
    'icon' => 'el el-caret-right',
    'fields' => array(
        array(
            'id' => 'sidebar-style',
            'type' => 'image_select',
            'title' => esc_html__( 'Sidebar Style', 'punte' ),
            'options' => array(
                'sidebar-style1' => array(
                    'alt' => esc_html__( 'Sidebar Style One', 'punte' ),
                    'img' => $image_url . 'sidebar-style/sidebar1.png'
                ),
                'sidebar-style2' => array(
                    'alt' => esc_html__( 'Sidebar Style Two', 'punte' ),
                    'img' => $image_url . 'sidebar-style/sidebar2.png'
                ),
               
            ),
            'default' => 'sidebar-style1'
        ),
        array(
            'id' => 'sticky-sidebar',
            'type' => 'switch',
            'title' => esc_html__( 'Sticky Sidebar', 'punte' ),
            'default' => false,
            'on' => esc_html__( 'Enable', 'punte' ),
            'off' => esc_html__( 'Disable', 'punte' )
        ),
    )
) );




Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Typography', 'punte' ),
    'id' => 'punte-typography',
    'icon' => 'el el-fontsize',
        )
);



Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Menu Font', 'punte' ),
    'id' => 'punte-menu-typography',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'menu-typography',
            'type' => 'typography',
            'title' => esc_html__( 'Menu Font', 'punte' ),
            'font-backup' => false,
            'line-height' => false,
            'text-align' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'color' => false,
            'font_family_clear' => false,
            'select2' => array( 'allowClear' => false, 'minimumResultsForSearch' => -1 ),
            'default' => array(
                'color' => '#333',
                'font-style' => '',
                'font-weight' => 400,
                'subsets' => 'latin',
                'font-family' => 'Open Sans',
                'google' => true,
                'font-size' => '16px',
                'text-transform' => 'uppercase',
                'letter-spacing' => ''
            ),
        )
    )
) );



Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Blog', 'punte' ),
    'id' => 'punte-blog',
    'icon' => 'el el-hourglass',
    'fields' => array(
        array(
            'id' => 'blog-style',
            'type' => 'image_select',
            'title' => esc_html__( 'Blog Style', 'punte' ),
            'options' => $blog_styles,
            'default' => 'blog-style1'
        ),
        array(
            'id' => 'blog-excerpt',
            'type' => 'radio',
            'title' => esc_html__( 'Blog Content', 'punte' ),
            'default' => 'excerpt',
            'desc' => esc_html__( 'Define the no of words to show if Excerpt is selected.', 'punte' ),
            'options' => array(
                'full-content' => esc_html__( 'Show Full Content', 'punte' ),
                'excerpt' => esc_html__( 'Show Excerpt', 'punte' ),
            ),
            'required' => array( 'blog-style', 'equals', 'blog-style1' )
        ),
        array(
            'id' => 'blog-excerpt-length',
            'type' => 'slider',
            'title' => esc_html__( 'Excerpt Length', 'punte' ),
            'subtitle' => esc_html__( 'Number of words', 'punte' ),
            'default' => 70,
            'min' => 0,
            'step' => 1,
            'max' => 300,
            'display_value' => 'text'
        ),
        array(
            'id' => 'post-meta',
            'type' => 'switch',
            'title' => esc_html__( 'Post Meta', 'punte' ),
            'subtitle' => esc_html__( 'Show Author, Date & Categories', 'punte' ),
            'default' => true,
            'on' => esc_html__( 'Show', 'punte' ),
            'off' => esc_html__( 'Hide', 'punte' ),
        ),
        array(
            'id' => 'share-button',
            'type' => 'switch',
            'title' => esc_html__( 'Share Buttons', 'punte' ),
            'subtitle' => esc_html__( 'Share button at the bottom of the post', 'punte' ),
            'default' => true,
            'on' => esc_html__( 'Show', 'punte' ),
            'off' => esc_html__( 'Hide', 'punte' ),
        ),
        $fields = array(
    'id' => 'blog-divider',
    'type' => 'divide'
        ),
        array(
            'id' => 'single-post-image',
            'type' => 'switch',
            'title' => esc_html__( 'Featured Image', 'punte' ),
            'subtitle' => esc_html__( 'Show Featured Image', 'punte' ),
            'default' => true,
            'on' => esc_html__( 'Show', 'punte' ),
            'off' => esc_html__( 'Hide', 'punte' ),
        ),
        array(
            'id' => 'single-post-meta',
            'type' => 'switch',
            'title' => esc_html__( 'Single Post - Meta', 'punte' ),
            'subtitle' => esc_html__( 'Show Author, Date & Categories', 'punte' ),
            'default' => true,
            'on' => esc_html__( 'Show', 'punte' ),
            'off' => esc_html__( 'Hide', 'punte' ),
        ),
        array(
            'id' => 'single-share-button',
            'type' => 'switch',
            'title' => esc_html__( 'Single Post - Share Buttons', 'punte' ),
            'subtitle' => esc_html__( 'Share button at the bottom of the post', 'punte' ),
            'default' => true,
            'on' => esc_html__( 'Show', 'punte' ),
            'off' => esc_html__( 'Hide', 'punte' ),
        ),
        array(
            'id' => 'single-post-author',
            'type' => 'switch',
            'title' => esc_html__( 'Single Post - Author Box', 'punte' ),
            'subtitle' => esc_html__( 'Show Author Box', 'punte' ),
            'default' => true,
            'on' => esc_html__( 'Show', 'punte' ),
            'off' => esc_html__( 'Hide', 'punte' ),
        ),
        array(
            'id' => 'single-post-pagination',
            'type' => 'switch',
            'title' => esc_html__( 'Single Post - Pagination', 'punte' ),
            'subtitle' => esc_html__( 'Show Prev/Next Post', 'punte' ),
            'default' => true,
            'on' => esc_html__( 'Show', 'punte' ),
            'off' => esc_html__( 'Hide', 'punte' ),
        ),
        array(
            'id' => 'single-related-posts',
            'type' => 'switch',
            'title' => esc_html__( 'Single Post - Related Posts', 'punte' ),
            'subtitle' => esc_html__( 'Show Related Box', 'punte' ),
            'default' => true,
            'on' => esc_html__( 'Show', 'punte' ),
            'off' => esc_html__( 'Hide', 'punte' ),
        ),
        array(
            'id' => 'single-post-comments',
            'type' => 'switch',
            'title' => esc_html__( 'Single Post - Comments', 'punte' ),
            'subtitle' => esc_html__( 'Show Comments', 'punte' ),
            'default' => true,
            'on' => esc_html__( 'Show', 'punte' ),
            'off' => esc_html__( 'Hide', 'punte' ),
        ),
    )
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'WooCommerce', 'punte' ),
    'id' => 'punte-woocommerce',
    'icon' => 'el el-shopping-cart',
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'General Settings', 'punte' ),
    'id' => 'punte-woocommerce-general-settings',
    'subsection' => true,
    'fields' => apply_filters('punte_woo_general_settings',array(
        array(
            'id' => 'show-shopping-cart',
            'type' => 'switch',
            'title' => esc_html__( 'Shopping Bag Icon / Cart', 'punte' ),
            'desc' => esc_html__( 'Show shopping bag icon and cart in main navigation', 'punte' ),
            'default' => true,
            'on' => esc_html__( 'Show', 'punte' ),
            'off' => esc_html__( 'Hide', 'punte' ),
        ),
        array(
            'id' => 'woocommerce-layout',
            'type' => 'image_select',
            'title' => esc_html__( 'Archive Page Sidebar Layout', 'punte' ),
            'options' => $sidebar_layout,
            'default' => 'right-sidebar'
        ),
        array(
            'id' => 'woocommerce-single-layout',
            'type' => 'image_select',
            'title' => esc_html__( 'Single Page Sidebar Layout', 'punte' ),
            'options' => $sidebar_layout,
            'default' => 'right-sidebar'
        ),
        
    ))
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Title Bar Layout', 'punte' ),
    'id' => 'punte-woocommerce-title-bar-layout',
    'subsection' => true,
    'fields' =>apply_filters('punte_woo_title_bar',array(
        array(
            'id' => 'woo-enable-header-bar',
            'type' => 'switch',
            'title' => esc_html__( 'Page Header', 'punte' ),
            'default' => true,
            'on' => esc_html__( 'Enable', 'punte' ),
            'off' => esc_html__( 'Disable', 'punte' )
        ),
         array(
            'id' => 'woo-header-padding',
            'type' => 'spacing',
            'mode' => 'padding',
            'all' => false,
            'right' => false, // Disable the right
            'left' => false, // Disable the left
            'units' => array( 'px' ), // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'false', // Allow users to select any type of unit
            'title' => esc_html__( 'Header Padding', 'punte' ),
            'desc' => esc_html__( 'Top, Bottom Padding', 'punte' ),
            'select2' => array( 'allowClear' => false, 'minimumResultsForSearch' => -1 ),
            'default' => array(
                'padding-top' => '30px',
                'padding-bottom' => '30px',
            ),
        ),
        array(
            'id' => 'woo-header-bg',
            'type' => 'background',
            'title' => esc_html__( 'Title Header Background', 'punte' ),
            'preview_media' => true,
            'preview' => false,
            'transparent' => false,
            'default' => array(
                'background-color' => '#EEEEEE',
            )
        ),
        
       
        array(
            'id' => 'woo-header-text-color',
            'type' => 'color',
            'title' => esc_html__( 'Header Title/SubTitle Color', 'punte' ),
            'transparent' => false,
            'default' => '#333333',
        ),
        array(
            'id' => 'woo-enable-breadcrumbs',
            'type' => 'switch',
            'title' => esc_html__( 'Show Breadcrumbs', 'punte' ),
            'default' => true,
            'on' => esc_html__( 'Show', 'punte' ),
            'off' => esc_html__( 'Hide', 'punte' )
        ),
        array(
            'id' => 'woo-breadcrumb-color',
            'type' => 'color',
            'transparent' => false,
            'title' => esc_html__( 'Breadcrumb Color', 'punte' ),
            'default' => '#333333'
        ),
        
    ))
) );

Redux::setSection( $opt_name, array(
    'title' => esc_html__( 'Social Links', 'punte' ),
    'id' => 'punte-social',
    'icon' => 'el el-share',
    'fields' => array(
        array(
            'id' => 'show-social-links',
            'type' => 'switch',
            'title' => esc_html__( 'Show Social Links', 'punte' ),
            'default' => true,
            'on' => 'Show',
            'off' => 'Hide',
        ),
        array(
            'id' => 'social-facebook',
            'type' => 'text',
            'title' => esc_html__( 'Facebook', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://facebook.com',
        ),
        array(
            'id' => 'social-twitter',
            'type' => 'text',
            'title' => esc_html__( 'Twitter', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://twitter.com',
        ),
      
        array(
            'id' => 'social-flickr',
            'type' => 'text',
            'title' => esc_html__( 'Flickr', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://flickr.com',
        ),
        array(
            'id' => 'social-linkedin',
            'type' => 'text',
            'title' => esc_html__( 'LinkedIn', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://linkedin.com',
        ),
        array(
            'id' => 'social-pinterest',
            'type' => 'text',
            'title' => esc_html__( 'Pinterest', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://pinterest.com',
        ),
        array(
            'id' => 'social-instagram',
            'type' => 'text',
            'title' => esc_html__( 'Instagram', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://instagram.com',
        ),
        array(
            'id' => 'social-dribble',
            'type' => 'text',
            'title' => esc_html__( 'Dribbble', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://dribbble.com',
        ),
        array(
            'id' => 'social-tumblr',
            'type' => 'text',
            'title' => esc_html__( 'Tumblr', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://tumblr.com',
        ),
        array(
            'id' => 'social-youtube',
            'type' => 'text',
            'title' => esc_html__( 'Youtube', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://youtube.com',
        ),
        array(
            'id' => 'social-vimeo',
            'type' => 'text',
            'title' => esc_html__( 'Vimeo', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://vimeo.com',
        ),
        array(
            'id' => 'social-reddit',
            'type' => 'text',
            'title' => esc_html__( 'Reddit', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://reddit.com',
        ),
        array(
            'id' => 'social-digg',
            'type' => 'text',
            'title' => esc_html__( 'Digg', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://digg.com',
        ),
        array(
            'id' => 'social-stumbleUpon',
            'type' => 'text',
            'title' => esc_html__( 'StumbleUpon', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://stumbleUpon.com',
        ),
        array(
            'id' => 'social-soundCloud',
            'type' => 'text',
            'title' => esc_html__( 'SoundCloud', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://soundCloud.com',
        ),
        array(
            'id' => 'social-foursquare',
            'type' => 'text',
            'title' => esc_html__( 'Foursquare', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://foursquare.com',
        ),
        array(
            'id' => 'social-lastfm',
            'type' => 'text',
            'title' => esc_html__( 'LastFM', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://lastfm.com',
        ),
        array(
            'id' => 'social-behance',
            'type' => 'text',
            'title' => esc_html__( 'Behance', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://behance.com',
        ),
        array(
            'id' => 'social-dropbox',
            'type' => 'text',
            'title' => esc_html__( 'Dropbox', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://dropbox.com',
        ),
        array(
            'id' => 'social-foursquare',
            'type' => 'text',
            'title' => esc_html__( 'Foursquare', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://foursquare.com',
        ),
        array(
            'id' => 'social-github',
            'type' => 'text',
            'title' => esc_html__( 'GitHub', 'punte' ),
            'validate' => 'url',
            'placeholder' => 'https://github.com',
        ),
        array(
            'id' => 'social-skype',
            'type' => 'text',
            'title' => esc_html__( 'Skype', 'punte' ),
            'placeholder' => 'UserName',
        ),
    )
) );


/*
 *  END SECTIONS*
*/