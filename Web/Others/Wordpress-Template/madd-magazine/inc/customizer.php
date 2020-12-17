<?php
/**
 * Madd Magazine Theme Customizer
 *
 * @package Madd_Magazine
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function madd_magazine_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'madd_magazine_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'madd_magazine_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'madd_magazine_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function madd_magazine_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function madd_magazine_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function madd_magazine_customize_preview_js() {
	wp_enqueue_script( 'madd-magazine-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'madd_magazine_customize_preview_js' );

function madd_magazine_options_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'colors_section', array(
		'title'          => esc_html__( 'Elements Colors', 'madd-magazine' ),
		'priority'       => 134,
	));

		$wp_customize->add_setting( 'label_background', array(
			'default'        => '',
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'label_background', array(
			'label'   => esc_html__( 'Label Background', 'madd-magazine' ),
			'section' => 'colors_section',
			'settings'   => 'label_background',
		)));

		$wp_customize->add_setting( 'slider_background', array(
			'default'        => '',
			'sanitize_callback'	=> 'sanitize_hex_color',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'slider_background', array(
			'label'   => esc_html__( 'Slider Background', 'madd-magazine' ),
			'section' => 'colors_section',
			'settings'   => 'slider_background',
		)));

	$wp_customize->add_section( 'footer_section' , array(
		'title'      => 'Footer',
		'priority'   => 135,
	));

		$wp_customize->add_setting( 'footer_copyright', array(
			'default'        => '',
			'sanitize_callback'	=> 'wp_kses_post',
		));

		$wp_customize->add_control( 'footer_copyright', array(
			'label'   => esc_html__( 'Footer Copyright', 'madd-magazine' ),
			'section' => 'footer_section',
			'settings'   => 'footer_copyright',
			'type'    => 'text',
			'priority' => 3
		));

		
	$wp_customize->add_section( 'social_section' , array(
		'title'      => esc_html__( 'Social', 'madd-magazine' ),
		'priority'   => 135,
	));

		$wp_customize->add_setting( 'social_twitter', array(
			'default'        => '',
			'sanitize_callback'	=> 'sanitize_text_field',
		));

		$wp_customize->add_control( 'social_twitter', array(
			'label'   => esc_html__( 'Twitter', 'madd-magazine' ),
			'section' => 'social_section',
			'settings'   => 'social_twitter',
			'type'    => 'text',
			'priority' => 3
		));

		$wp_customize->add_setting( 'social_facebook', array(
			'default'        => '',
			'sanitize_callback'	=> 'sanitize_text_field',
		));

		$wp_customize->add_control( 'social_facebook', array(
			'label'   => esc_html__( 'Facebook', 'madd-magazine' ),
			'section' => 'social_section',
			'settings'   => 'social_facebook',
			'type'    => 'text',
			'priority' => 3
		));

		$wp_customize->add_setting( 'social_google', array(
			'default'        => '',
			'sanitize_callback'	=> 'sanitize_text_field',
		));

		$wp_customize->add_control( 'social_google', array(
			'label'   => esc_html__( 'Google +', 'madd-magazine' ),
			'section' => 'social_section',
			'settings'   => 'social_google',
			'type'    => 'text',
			'priority' => 3
		));

		$wp_customize->add_setting( 'social_instagram', array(
			'default'        => '',
			'sanitize_callback'	=> 'sanitize_text_field',
		));

		$wp_customize->add_control( 'social_instagram', array(
			'label'   => esc_html__( 'Instagram', 'madd-magazine' ),
			'section' => 'social_section',
			'settings'   => 'social_instagram',
			'type'    => 'text',
			'priority' => 3
		));

		$wp_customize->add_setting( 'social_pinterest', array(
			'default'        => '',
			'sanitize_callback'	=> 'sanitize_text_field',
		));

		$wp_customize->add_control( 'social_pinterest', array(
			'label'   => esc_html__( 'Pinterest', 'madd-magazine' ),
			'section' => 'social_section',
			'settings'   => 'social_pinterest',
			'type'    => 'text',
			'priority' => 3
		));

		$wp_customize->add_setting( 'social_vimeo', array(
			'default'        => '',
			'sanitize_callback'	=> 'sanitize_text_field',
		));

		$wp_customize->add_control( 'social_vimeo', array(
			'label'   => esc_html__( 'Vimeo', 'madd-magazine' ),
			'section' => 'social_section',
			'settings'   => 'social_vimeo',
			'type'    => 'text',
			'priority' => 3
		));	

		$wp_customize->add_setting( 'social_youtube', array(
			'default'        => '',
			'sanitize_callback'	=> 'sanitize_text_field',
		));

		$wp_customize->add_control( 'social_youtube', array(
			'label'   => esc_html__( 'Youtube', 'madd-magazine' ),
			'section' => 'social_section',
			'settings'   => 'social_youtube',
			'type'    => 'text',
			'priority' => 3
		));	

		$wp_customize->add_setting( 'social_linkedin', array(
			'default'        => '',
			'sanitize_callback'	=> 'sanitize_text_field',
		));

		$wp_customize->add_control( 'social_linkedin', array(
			'label'   => esc_html__( 'LinkedIn', 'madd-magazine' ),
			'section' => 'social_section',
			'settings'   => 'social_linkedin',
			'type'    => 'text',
			'priority' => 3
		));	

}

add_action( 'customize_register', 'madd_magazine_options_customize_register' );



function madd_magazine_elements_style() { ?>
<style>
<?php $label_background = get_theme_mod('label_background');
if (!empty($label_background)): ?>
.categories-wrap a,header .site-navigation .current-menu-item > a,header .site-navigation a:hover{background: <?php echo esc_attr($label_background); ?>;}
.video-label{color: <?php echo esc_attr($label_background); ?>;}
<?php endif; ?>
<?php $slider_background = get_theme_mod('slider_background');
if (!empty($slider_background)): ?>
.main-slider-wrap{background: <?php echo esc_attr($slider_background); ?>;}
<?php endif; ?>
</style>

<?php }

add_action( 'wp_head', 'madd_magazine_elements_style' );