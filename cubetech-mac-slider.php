<?php
/**
 * Plugin Name: cubetech Mac Slider
 * Plugin URI: http://www.cubetech.ch
 * Description: cubetech Mac Slider - a funny slider that slides in a mac screen :)
 * Version: 1.0.3
 * Author: cubetech GmbH
 * Author URI: http://www.cubetech.ch
 */

include_once('lib/cubetech-install.php');
include_once('lib/cubetech-metabox.php');
include_once('lib/cubetech-post-type.php');
include_once('lib/cubetech-settings.php');
include_once('lib/cubetech-shortcode.php');

add_image_size( 'cubetech-mac-slider-thumb', 590, 334, true );

wp_enqueue_script('jquery');
wp_register_script('cubetech_mac_slider_js', plugins_url('assets/js/cubetech-mac-slider.js', __FILE__), 'jquery');
wp_enqueue_script('cubetech_mac_slider_js');

add_action('wp_enqueue_scripts', 'cubetech_mac_slider_add_styles');

function cubetech_mac_slider_add_styles() {
	wp_register_style('cubetech-mac-slider-css', plugins_url('assets/css/cubetech-mac-slider.css', __FILE__) );
	wp_enqueue_style('cubetech-mac-slider-css');
}

/* Add button to TinyMCE */
function cubetech_mac_slider_addbuttons() {

	if ( (! current_user_can('edit_posts') && ! current_user_can('edit_pages')) )
		return;
	
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_cubetech_mac_slider_tinymce_plugin");
		add_filter('mce_buttons', 'register_cubetech_mac_slider_button');
		add_action( 'admin_footer', 'cubetech_mac_slider_dialog' );
	}
}
 
function register_cubetech_mac_slider_button($buttons) {
   array_push($buttons, "|", "cubetech_mac_slider_button");
   return $buttons;
}
 
function add_cubetech_mac_slider_tinymce_plugin($plugin_array) {
	$plugin_array['cubetech_mac_slider'] = plugins_url('assets/js/cubetech-mac-slider-tinymce.js', __FILE__);
	return $plugin_array;
}

add_action('init', 'cubetech_mac_slider_addbuttons');

function cubetech_mac_slider_dialog() { 

	$args=array(
		'hide_empty' => false,
		'orderby' => 'name',
		'order' => 'ASC'
	);
	$taxonomies = get_terms('cubetech_mac_slider_group', $args);
	
	?>
	<style type="text/css">
		#cubetech_mac_slider_dialog { padding: 10px 30px 15px; }
	</style>
	<div style="display:none;" id="cubetech_mac_slider_dialog">
		<div>
			<p><input type="submit" class="button-primary" value="Mac Slider einfügen" onClick="tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[cubetech-mac-slider]'); tinyMCEPopup.close();" /></p>
		</div>
	</div>
	<?php
}

?>
