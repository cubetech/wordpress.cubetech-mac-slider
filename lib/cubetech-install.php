<?php

	function cubetech_mac_slider_activate() {
		update_option( 'cubetech_mac_slider_link_title', 'Mehr erfahren' );
		update_option( 'cubetech_mac_slider_show_content', 'checked' );
	}
	register_activation_hook( __FILE__, 'cubetech_mac_slider_activate' );

	function cubetech_mac_slider_uninstall()
	{
	    if ( ! current_user_can( 'activate_plugins' ) )
	        return;
	    check_admin_referer( 'bulk-plugins' );

	    // Important: Check if the file is the one
	    // that was registered during the uninstall hook.
	    if ( __FILE__ != WP_UNINSTALL_PLUGIN )
	        return;

		delete_option( 'cubetech_mac_slider_link_title' );
		delete_option( 'cubetech_mac_slider_show_content' );

	}
	register_uninstall_hook( __FILE__, 'cubetech_mac_slider_uninstall' );

?>