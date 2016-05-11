jQuery(function ($) {  // use $ for jQuery
	"use strict";
	// get the font awesome icons and return to sh-mce.js on selection
	function retrieveFontAwesome(callback) {
    	var data = {
            action: 'font_awesome',
            encode: 'true'
        };
		$.ajax({  
        	type: "POST",  
        	url: ajaxurl,  
        	dataType: 'json',
        	data: data,  
        	success: function(response) { 
				callback(response);
			}
		});
	}
	// make function accessible
	window.retrieveFontAwesome = retrieveFontAwesome;

	// get all icons - font awesome, linear, and ion icons and return to sh-mce.js on selection
    function retrieveAllIcons(callback) {
        var data = {
            action: 'all_icons',
            encode: 'true'
        };
        $.ajax({
            type: "POST",
            url: ajaxurl,
            dataType: 'json',
            data: data,
            success: function(response) {
                callback(response);
            }
        });
    }
    // make function accessible
    window.retrieveAllIcons = retrieveAllIcons;

});

