<?php
/**
* Starter content for the theme
* @since 1.0.6
*/

class Punte_Starter_Contents{


	/**
	 * A reference to an instance of this class.
	 *
	 * @access private
	 * @var    object
	 */

	private static $instance = null;



	public static function get_instance() {
        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }



    public function __construct() {

    	add_action( 'after_setup_theme', array($this,'punte_starter_content_data') );

    }



    function punte_starter_content_data(){

    	add_theme_support('starter-content', array(
    		

	        // Starter pages to include
	        'posts' => array(
	            'home',
	            'about',
	            'contact',
	            'blog'
	        ),

	        // Add pages to primary navigation menu
	        'nav_menus' => array(

	            'primary' => array(
	                'name' => esc_html__('Main Menu', 'punte'),
	                'items' => array(
	                    'home_link',
	                    'page_about',
	                    'page_blog',
	                    'page_contact',
	                ),
	            )

	        ),


		    // Add test widgets to footer sidebar
	        'widgets' => array(
	            
	            'punte-footer-1' => array(
					'text_business_info',
				),

				'punte-footer-2' => array(
					'search',
					'text_about',
				),

				'punte-footer-3' => array(
					'text_business_info',
				),

				'punte-footer-4' => array(
					'text_about',
				),

	        )



    	));

    }






}

/**
* Returns instanse of the class.
*
* @return object
*/
function punte_starter_contents_init() {
	return Punte_Starter_Contents::get_instance();
}

punte_starter_contents_init();