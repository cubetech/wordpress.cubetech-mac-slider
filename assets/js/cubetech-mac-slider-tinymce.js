tinymce.create( 
	'tinymce.plugins.cubetech_mac_slider', 
	{
	    /**
	     * @param tinymce.Editor editor
	     * @param string url
	     */
	    init : function( editor, url ) {
			/**
			*  register a new button
			*/
			editor.addButton(
				'cubetech_mac_slider_button', 
				{
					cmd   : 'cubetech_mac_slider_button_cmd',
					title : editor.getLang( 'cubetech_mac_slider.buttonTitle', 'cubetech Mac Slider' ),
					image : url + '/../img/toolbar-icon.png'
				}
			);
			/**
			* and a new command
			*/
			editor.addCommand(
				'cubetech_mac_slider_button_cmd',
				function() {
					/**
					* @param Object Popup settings
					* @param Object Arguments to pass to the Popup
					*/
					editor.windowManager.open(
						{
							// this is the ID of the popups parent element
							id       : 'cubetech_mac_slider_dialog',
							width    : 480,
							title    : editor.getLang( 'cubetech_mac_slider.popupTitle', 'cubetech Mac Slider' ),
							height   : 'auto',
							wpDialog : true,
							display  : 'block',
						},
						{
							plugin_url : url
						}
					);
				}
			);
		}
	}
);

// register plugin
tinymce.PluginManager.add( 'cubetech_mac_slider', tinymce.plugins.cubetech_mac_slider );