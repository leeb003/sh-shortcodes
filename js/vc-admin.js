jQuery(function ($) {  // use $ for jQuery
    "use strict";

	$(document).on('click', 'span.selectOption', function() {

		$(this).closest('.selectOptions').find('span.selectOption').each(function() {
			$(this).find('.checkbox').prop('checked', false);
			$(this).removeClass('selected-icon');
		});

		$(this).find('.checkbox').prop('checked', true);
		$(this).addClass('selected-icon');
	});

	enableCheckBoxes();


	// search options
    $(document).on('keyup', '.searchCheckLive', function() {
        var search = $(this).val();
        $(this).closest('.selectOptions').find('.selectOption').each(function() {
            var text = $(this).attr('value');
            if (text.toLowerCase().indexOf(search) >= 0) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });


	// custom font awesome select box
    function enableCheckBoxes(){
        $(document).find('div.selectBox').each(function(){
			var prevSelected = false;
			$(this).find('.selectOption').each(function() {
				if ($(this).hasClass('selected-icon')) {
					prevSelected = true;
				}
			});
			// assign the selected icon to the view field if there is one already set, else set the first element
			if (prevSelected) {
				$(this).children('span.selected').html($(this).find('.selected-icon').html());
			} else {
            	$(this).children('span.selected').html($(this).children('div.selectOptions').children('span.selectOption:first').html());
			}

            $(this).attr('value',$(this).children('div.selectOptions').children('span.selectOption:first').attr('value'));

            $(this).children('span.selected,span.selectArrow').click(function(){
                if($(this).parent().children('div.selectOptions').css('display') == 'none'){
                    $(this).parent().children('div.selectOptions').css('display','block');
                }
                else
                {
                    $(this).parent().children('div.selectOptions').css('display','none');
                }
            });

            $(this).find('span.selectOption').click(function(){
                $(this).parent().css('display','none');
                $(this).closest('div.selectBox').attr('value',$(this).attr('value'));
                $(this).parent().siblings('span.selected').html($(this).html());
            });
        });
    }

	// setup initial view for button icon use 
	$(document).ready(function() {
		if ($('.enableicon').length) {  
			var selected = $('input:checkbox.enableicon:checked').val();
			// check if this is editing a pre-existing button and only disable for new and disable selected
			if (selected != "enable") {
				$('input:checkbox.enableicon[value="disable"]').prop("checked", true);
				//$('.iconbg').closest('.vc_shortcode-param').hide();
				$('.selectBox').closest('.vc_shortcode-param').hide();
			}
		}

	});

	// setup initial view for icon enable select
	$(document).ready(function() {
		var selected = $('input:checkbox.link:checked').val();
		if (selected != 'disable') {
			$('input:checkbox.link[value="enable"]').prop("checked", true);
		}
		var spin = $('input:checkbox.spin:checked').val();
		if (spin != 'enable') {
			$('input:checkbox.spin[value="disable"]').prop("checked", true);
		}

		var enableCirc = $('.enablecircle:checked').val();
		if (enableCirc != 'enable') {
			$('.enablecircle[value="disable"]').prop("checked", true);
		}
	});

	$(document).on('click', 'input:checkbox.link', function() {
		$('input:checkbox.link').prop("checked", false);
        $(this).prop("checked", true);
    });
	$(document).on('click', 'input:checkbox.spin', function() {
        $('input:checkbox.spin').prop("checked", false);
        $(this).prop("checked", true);
    });
	$(document).on('click', 'input:checkbox.enablecircle', function() {
        $('input:checkbox.enablecircle').prop("checked", false);
        $(this).prop("checked", true);
    });

	// Alert message boxes
	$(document).ready(function() {
		if ($('input:checkbox.close').length) {
			var selected = $('input:checkbox.close:checked').val();
			if (selected != 'disable') {
				$('input:checkbox.close[value="enable"]').prop("checked", true);
			}
		}

		if ($('input:checkbox.enablefont').length) {
            if ($('input:checkbox.enablefont:checked').val() != 'disable') {
                $('input:checkbox.enablefont[value="enable"]').prop("checked", true);
			}
        } 

		// hide icon selections except chosen initial - Alert message, buttons, icons, circle charts
		var enablefont = $('.enablefont:checked').val();
		var enableicon = $('.enableicon option:selected').val();
		var iconset = $('.iconset option:selected').val();
		var circleicon = $('.circleicon option:selected').val(); // circle charts
		var type = $('.type option:selected').val(); // checklists
		$('.icon-holder').closest('.vc_shortcode-param').hide();
		if (enablefont == 'enable'
		  || enableicon == 'enable'
		  || circleicon == 'enable'
		  || type == 'unorderred'
		) {
			if (iconset == 'fontawesome') {
				$('.fontawesome-select').closest('.vc_shortcode-param').show();
			} else if (iconset == 'linear') {
				$('.linear-select').closest('.vc_shortcode-param').show();
			} else if (iconset == 'ion') {
				$('.ion-select').closest('.vc_shortcode-param').show();
			}
		}
	});

	// show or hide font selection iconset change - Alert message, buttons, callouts
	$(document).on('change', '.iconset', function() {
		var enablefont = $('.enablefont:checked').val();
		var enableicon = $('.enableicon option:selected').val();  // several shortcodes (icons, social icons)
		var iconenable = $('.iconenable option:selected').val();
		var iconset = $('.iconset option:selected').val();
		var choice = $('.choice option:selected').val(); // content boxes
		var circleicon = $('.circleicon option:selected').val(); // circle charts
		var type = $('.type option:selected').val(); // checklists
		$('.icon-holder').closest('.vc_shortcode-param').hide();
		if (enablefont == 'enable'
			|| enableicon == 'enable' 
			|| iconenable == 'enable'
			|| choice == 'icon'
			|| circleicon == 'enable'
			|| type == 'unordered'
		) {
        	if (iconset == 'fontawesome') {
            	$('.fontawesome-select').closest('.vc_shortcode-param').show();
        	} else if (iconset == 'linear') {
            	$('.linear-select').closest('.vc_shortcode-param').show();
        	} else if (iconset == 'ion') {
            	$('.ion-select').closest('.vc_shortcode-param').show();
        	}
		}
    });

	// show or hide icon selections on enablefont change
	$(document).on('change', '.enablefont', function() {
		var enablefont = $('.enablefont:checked').val();
		var iconset = $('.iconset option:selected').val();
		$('.icon-holder').closest('.vc_shortcode-param').hide();
		if (enablefont == 'enable') {
			if (iconset == 'fontawesome') {
            	$('.fontawesome-select').closest('.vc_shortcode-param').show();
        	} else if (iconset == 'linear') {
            	$('.linear-select').closest('.vc_shortcode-param').show();
        	} else if (iconset == 'ion') {
            	$('.ion-select').closest('.vc_shortcode-param').show();
        	}
		}

	});

	$(document).on('click', 'input:checkbox.close', function() {
		$('input:checkbox.close').prop("checked", false);
		$(this).prop("checked", true);
	});

    $(document).on('click', 'input:checkbox.enablefont', function() {
        $('input:checkbox.enablefont').prop("checked", false);
        $(this).prop("checked", true);
    });

	// Callouts
	$(document).ready(function() {
		// Enable Button
		var buttonenable = $(".checkbox.buttonenable:checked").val();
		if (!buttonenable) {
			$('.checkbox.buttonenable[value="enable"]').prop("checked", true);
		}

		// Enable Icon or Image
		var iconenable = $('.iconenable option:selected').val();
		if (!iconenable) { // no value set set to enable
			$('input:checkbox.iconenable[value="enable"]').prop("selected", true);
		}
	});
		// changing Enable Button
	$(document).on('click', '.checkbox.buttonenable', function() {
		$('.checkbox.buttonenable').prop('checked', false);
		$(this).prop('checked', true);
	});
	
		// changing Enable Icon Spin
	$(document).on('click', '.checkbox.iconspin', function() {
		$('.checkbox.iconspin').prop("checked", false);
		$(this).prop("checked", true);
	});
});
