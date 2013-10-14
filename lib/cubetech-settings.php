<?php
// create custom plugin settings menu
add_action('admin_menu', 'cubetech_mac_slider_create_menu');

if($_GET['settings-updated'] == true)
	echo '<div id="message" class="updated fade"><p>Einstellungen gespeichert.</p></div>';

function cubetech_mac_slider_create_menu() {

	//create new top-level menu
	add_submenu_page('edit.php?post_type=cubetech_mac_slider', 'Einstellungen', 'Einstellungen', 'edit_posts', __FILE__, 'cubetech_mac_slider_settings_page');

	//call register settings function
	add_action( 'admin_init', 'register_cubetech_mac_slider_settings' );
}


function register_cubetech_mac_slider_settings() {
	//register our settings
	register_setting( 'cubetech-mac-slider-settings-group', 'cubetech_mac_slider_link_title' );
	register_setting( 'cubetech-mac-slider-settings-group', 'cubetech_mac_slider_show_content' );
}

function cubetech_mac_slider_settings_page() {
?>
<div class="wrap">
<h2>cubetech Icon Slider Einstellungen</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'cubetech-mac-slider-settings-group' ); ?>
    <table class="form-table">

        <tr valign="top">
        <th scope="row">Name des weiterführenden Links</th>
        <td><input type="text" name="cubetech_mac_slider_link_title" value="<?php echo get_option('cubetech_mac_slider_link_title'); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Text anzeigen</th>
        <td><input type="checkbox" name="cubetech_mac_slider_show_content" value="checked" <?php echo get_option('cubetech_mac_slider_show_content'); ?> /></td>
        </tr>
         
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>