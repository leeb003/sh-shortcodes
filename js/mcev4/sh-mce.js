jQuery(function ($) {  // use $ for jQuery
	"use strict";
	var tinyVersion = parseInt(tinymce.majorVersion);
	// Full tinymce version check = alert(tinymce.majorVersion + '.' + tinymce.minorVersion);
	
	/* The shortcode button hook-in function */
	/* we use global shInstallURL to create the url for the trigger */
	// tinyMCE 4.x    Wordpress 3.9+
	(function() { 
		tinymce.create('tinymce.plugins.shortcodes', {
            init : function(ed, url) {
       			ed.addButton('shortcodes', {
                   	title : 'SH Shortcodes',
					icon : 'image',
                   	image : url + '/../../img/logo-symbol-32x32.png',
					onclick: function() {
						// Open window with a specific url
						ed.windowManager.open({
							title: 'Shortcodes',
							url: shInstallURL + '?scshort_trigger=1',
							width: 650,
							height: 500,
							buttons: [{
								text: 'Close',
								onclick: 'close'
							}]
						});
					}
				});
			}
		});
		// Register Plugin
        tinymce.PluginManager.add('shortcodes', tinymce.plugins.shortcodes);
	})();

});
