<?php
/**
 * @package Punte
 */

add_action( 'punte_after_footer', 'punte_back_to_top' );
add_action( 'punte_footer', 'punte_footer_template');

if( !function_exists('punte_back_to_top')){
	function punte_back_to_top(){
		global $punte_options;
        $enable_backtotop = isset($punte_options['enable-backtotop']) ? $punte_options['enable-backtotop'] : true;
		if( $enable_backtotop ){
			?>
			<div id="pune-back-top">
				<?php echo punte_get_icon_svg('arrow_up',18); ?>
			</div>
			<?php
		}
	}
}

if( !function_exists('punte_footer_template') ){
	function punte_footer_template(){
		get_template_part('includes/punte-footer');
	}
}

/**
* Footer copyright
*/
add_action('punte_footer_copyright','punte_footer_copyright');
if( ! function_exists('punte_footer_copyright')){
	function punte_footer_copyright(){ ?>
		
		<span></span>
	    <?php esc_html_e('WordPress Theme:','punte'); ?>
	    <a href="https://thepunte.com/">
	        <?php echo esc_html(PUNTE_THEME_NAME);  ?>
	    </a>
	<?php 
	}
}