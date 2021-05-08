<?php

/**
* Plugin Name: RA Custom Admin Panel API
* Plugin URI: http://wordpress.org
* Description: WordPress Settings API 
* Author: Raju Ahmed
* Author URI: http://wordpress.org
* Version: 0.1
*/
/** Load WordPress dashboard API */
require_once(ABSPATH . 'wp-admin/includes/dashboard.php');
/**
* WordPress Custom Admin Panel API demo class
*
* @author Raju Ahmed
*/
if ( !class_exists('RA_CustomAdminPanel_API_Test' ) ):
class RA_CustomAdminPanel_API_Test {
		
	protected $metabox_api;

	public function __construct() {
		add_action( 'admin_menu', array($this, 'custom_panel_menu') );
		wp_enqueue_script( 'dashboard' );
		wp_enqueue_script( 'media-upload' );
		add_thickbox();
		add_image_size( 'jmra-featured-image', 100, 90, true );
		if ( wp_is_mobile() )
		wp_enqueue_script( 'jquery-touch-punch'); 
		
	}
		function custom_panel_menu() {
        add_menu_page( 'JMRAmmu Custom Panel API', 'JMRAmmu Custom Panel API', 'manage_options','welcome-panel-slug', array($this, 'welcome_panel_api') );
    }
	/**
	 * Custom Welcome panel
	 *
	 * @return custom panel
	 */
	 function welcome_panel_api(){
				
		echo '<div class="wrap">';
		if ( has_action( 'welcome_panel' ) && current_user_can( 'edit_theme_options' ) ) :
		$classes = 'welcome-panel';
		$option = get_user_meta( get_current_user_id(), 'show_welcome_panel', true );
		$hide = 0 == $option;
		if ( $hide )
			$classes .= ' hidden';	
			$url = esc_url( admin_url( '?welcome=0' ) );
					echo '<div id="welcome-panel" class=" welcome-panel '.esc_attr( $classes ).'">';
					
							wp_nonce_field( 'welcome-panel-nonce', 'welcomepanelnonce', false );
								echo '<a class="welcome-panel-close" href="'.$url.'" aria-label="Dismiss the welcome panel">Dismiss</a>';
									echo '<div class="welcome-panel-content ">';
										echo '<h1>Custom Panel API</h1>';	
											echo '<div class="welcome-panel-column-container">';
													query_posts(array( 
														'post_type' => 'student',
														'showposts' => 6,
													) );
													while ( have_posts() ) :
											
														echo '<div class="welcome-panel-column">';
														
														 the_post();
															if ( '' !== get_the_post_thumbnail() && ! is_single() ) :
															
															echo '<p>'.the_post_thumbnail( 'jmra-featured-image' ).'</p>';
															
															endif;
														
														echo '</div>'; 
														endwhile;														
																												
											echo '</div>
									</div>';

					echo '</div>';
			endif;
		echo '</div>';
	
	 }
	 	 
}
endif;
$setting = new RA_CustomAdminPanel_API_Test;

