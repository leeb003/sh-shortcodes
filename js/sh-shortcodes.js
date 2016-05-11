jQuery(function ($) {  // use $ for jQuery
    "use strict";

	// Testimonial Carousel
	$(document).ready(function() {
		$('.sh-testimonials').each( function() {
			var pause = $(this).data('pause');
			var mode = $(this).data('mode');
			var adaptive = $(this).data('adapt');
			$(this).bxSlider({
				auto: true,
				pause: pause,
				adaptiveHeight: adaptive,
				nextSelector: '.slide-next',
				prevSelector: '.slide-prev',
				mode: mode           // horizontal, fade, or vertical
			});	
		});
	});

	// Isotope grids - blog posts
    if ($('.sh-bloggrid').length ) {
        $('.sh-bloggrid').imagesLoaded(function(){
            var $container = $('.sh-bloggrid');
            $container.isotope({
                itemSelector: '.grid-post',

            });
        });
    };

	// portfolios
    var $container = $('.sh-portfoliogrid');
    if ($('.sh-portfoliogrid').length ) {
        $container.imagesLoaded(function(){
            $container.isotope({
                itemSelector: '.portfolio-item2',
            });
        });
    };

	// Parallax sections
    $.fn.parallax = function(options) {
        var windowHeight = $(window).height();
        // Establish default settings
        var settings = $.extend({
            speed        : 0.15
        }, options);
        // Iterate over each object in collection
        return this.each( function() {
        	// Save a reference to the element
        	var $this = $(this);
			$(document).ready(function(){
				var scrollTop = $(window).scrollTop();
                var offset = $this.offset().top;
                var height = $this.outerHeight();
                // Check if above or below viewport
                if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) {
                    return;
                }
                var yBgPosition = Math.round((offset - scrollTop) * settings.speed);
                // Apply the Y Background Position to Set the Parallax Effect
                $this.css('background-position', 'center ' + yBgPosition + 'px');
            });
        	// Set up Scroll Handler
        	$(document).scroll(function(){
    			var scrollTop = $(window).scrollTop();
        		var offset = $this.offset().top;
        		var height = $this.outerHeight();
    			// Check if above or below viewport
				if (offset + height <= scrollTop || offset >= scrollTop + windowHeight) {
					return;
				}
				var yBgPosition = Math.round((offset - scrollTop) * settings.speed);
    			// Apply the Y Background Position to Set the Parallax Effect
    			$this.css('background-position', 'center ' + yBgPosition + 'px');
        	});
        });
    }

	// Parallax init
	if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
		$('.sh-parallax').parallax({ speed : 0.25 });
	}

	$(window).resize(function() {
		checkFullWidthSections();
	});
	
	$(document).ready(function() {
		checkFullWidthSections();
		if ($('.flexslider').length) {
			$('.flexslider').data('flexslider').resize();
		}
	});

	// Parallax sizing for full width and boxed
	function checkFullWidthSections() {
		if ($('.container-fluid').length ) {
			var container = $('.container-fluid').width();
			if ( theme_globals.themeMenu == '2'
			    && theme_globals.themeTemplate != 'single-blank.php' ) {  // Side menu need to adjust for, not on single blank pages
           		var currWidth = $(document).width();
				var sidebarWidth = $('.side-wrapper').width();
               	$('.sh-solidbg').css( 'margin-left', '-35px');
               	$('.sh-solidbg').css( 'margin-right', '-35px');
               	$('.sh-imagebg').css( 'margin-left', '-35px');
               	$('.sh-imagebg').css( 'margin-right', '-35px');
               	$('.sh-colorbg').css( 'margin-left', '-35px');
               	$('.sh-colorbg').css( 'margin-right', '-35px');
               	$('.sh-parallax').css( 'margin-left', '-35px');
               	$('.sh-parallax').css( 'margin-right', '-35px');
               	$('.sh-fixed').css( 'margin-left', '-35px');
               	$('.sh-fixed').css( 'margin-right', '-35px');
               	$('.sh-video').css( 'margin-left', '-35px');
               	$('.sh-video').css( 'margin-right', '-35px');
               	$('.sh-map-full').css( 'margin-left', '-35px');
               	$('.sh-map-full').css( 'margin-right', '-35px');
               	$('.top-slider-full').css( 'margin-left', '-35px');
               	$('.top-slider-full').css( 'margin-right', '-35px');


			} else { // no side menu
				var container = $('.container-fluid').width();
				var currWidth = $(document).width();
				if (currWidth > 767) {    // check width to do math
					var offset = $('.nested-container').offset();
					var padding = 15;
					var totalOffset = offset.left + padding;
					// need right margins here for rtl
					$('.sh-parallax').css('margin-left', '-' + totalOffset + 'px' );
					$('.sh-parallax').css('margin-right', '-' + totalOffset + 'px' );
					$('.sh-fixed').css('margin-left', '-' + totalOffset + 'px' );
                	$('.sh-fixed').css('margin-right', '-' + totalOffset + 'px' );
					$('.sh-video').css('margin-left', '-' + totalOffset + 'px' );
					$('.sh-video').css('margin-right', '-' + totalOffset + 'px' );
					$('.sh-solidbg').css('margin-left', '-' + totalOffset + 'px' );
					$('.sh-solidbg').css('margin-right', '-' + totalOffset + 'px' );
					$('.sh-imagebg').css('margin-left', '-' + totalOffset + 'px' );
					$('.sh-imagebg').css('margin-right', '-' + totalOffset + 'px' );
					$('.sh-colorbg').css('margin-left', '-' + totalOffset + 'px' );
                	$('.sh-colorbg').css('margin-right', '-' + totalOffset + 'px' );
					$('.sh-map-full').css('margin-left', '-' + totalOffset + 'px' );
					$('.sh-map-full').css('margin-right', '-' + totalOffset + 'px' );
					$('.top-slider-full').css('margin-left', '-' + totalOffset + 'px' );
					$('.top-slider-full').css('margin-right', '-' + totalOffset + 'px' );
				} else {     // smaller than 768 different adjustments
					$('.sh-solidbg').css( 'margin-left', '-15px');
					$('.sh-solidbg').css( 'margin-right', '-15px');
					$('.sh-imagebg').css( 'margin-left', '-15px');
                	$('.sh-imagebg').css( 'margin-right', '-15px');
					$('.sh-colorbg').css( 'margin-left', '-15px');
                	$('.sh-colorbg').css( 'margin-right', '-15px');
					$('.sh-parallax').css( 'margin-left', '-15px');
                	$('.sh-parallax').css( 'margin-right', '-15px');
					$('.sh-fixed').css( 'margin-left', '-15px');
                	$('.sh-fixed').css( 'margin-right', '-15px');
					$('.sh-video').css( 'margin-left', '-15px');
                	$('.sh-video').css( 'margin-right', '-15px');
					$('.sh-map-full').css( 'margin-left', '-15px');
                	$('.sh-map-full').css( 'margin-right', '-15px');
					$('.top-slider-full').css( 'margin-left', '-15px');
			    	$('.top-slider-full').css( 'margin-right', '-15px');
				}
			}
		
			$('.sh-parallax').css( "width",(container)+'px');
			$('.sh-fixed').css( "width",(container)+'px');
            $('.sh-video').css( "width",(container)+'px');
            $('.sh-solidbg').css( "width",(container)+'px');
			$('.sh-imagebg').css( "width",(container)+'px');
			$('.sh-colorbg').css( "width",(container)+'px');
            $('.sh-map-full').css( "width",(container)+'px');
			$('.top-slider-full').css( "width",(container)+'px');

		} else {   // boxed window
			var container = $('.container').width();
			var currWidth = $(document).width();
			if (currWidth > 767) { 
				$('.sh-parallax').css('margin-left', '-30px');
				$('.sh-parallax').css('margin-right', '-30px');
				$('.sh-fixed').css('margin-left', '-30px');
                $('.sh-fixed').css('margin-right', '-30px');
				$('.sh-video').css('margin-left', '-30px');
				$('.sh-video').css('margin-right', '-30px');
				$('.sh-solidbg').css('margin-left', '-30px');
            	$('.sh-solidbg').css('margin-right', '-30px');
				$('.sh-imagebg').css('margin-left', '-30px');
				$('.sh-imagebg').css('margin-right', '-30px');
				$('.sh-colorbg').css('margin-left', '-30px');
                $('.sh-colorbg').css('margin-right', '-30px');
				$('.sh-map-full').css('margin-left', '-30px');
				$('.sh-map-full').css('margin-right', '-30px');
				$('.sh-map-full').css('width', 'auto');
				$('.top-slider-full').css('margin-left', '-30px');
                $('.top-slider-full').css('margin-right', '-30px');
                $('.top-slider-full').css('width', 'auto');
			} else {
				$('.sh-parallax').css('margin-left', '-15px');
                $('.sh-parallax').css('margin-right', '-15px');
				$('.sh-fixed').css('margin-left', '-15px');
                $('.sh-fixed').css('margin-right', '-15px');
                $('.sh-video').css('margin-left', '-15px');
                $('.sh-video').css('margin-right', '-15px');
                $('.sh-solidbg').css('margin-left', '-15px');
                $('.sh-solidbg').css('margin-right', '-15px');
				$('.sh-imagebg').css('margin-left', '-15px');
                $('.sh-imagebg').css('margin-right', '-15px');
				$('.sh-colorbg').css('margin-left', '-15px');
                $('.sh-colorbg').css('margin-right', '-15px');
                $('.sh-map-full').css('margin-left', '-15px');
                $('.sh-map-full').css('margin-right', '-15px');
                $('.sh-map-full').css('width', 'auto');
				$('.top-slider-full').css('margin-left', '-15px');
                $('.top-slider-full').css('margin-right', '-15px');
                $('.top-slider-full').css('width', 'auto');
			}
			$('.sh-parallax').css( "width",(container)+'px');
			$('.sh-fixed').css( "width",(container)+'px');
            $('.sh-video').css( "width",(container)+'px');
            $('.sh-solidbg').css( "width",(container)+'px');
			$('.sh-imagebg').css( "width",(container)+'px');
			$('.sh-colorbg').css( "width",(container)+'px');
            $('.sh-map-full').css( "width",(container)+'px');
			$('.top-slider-full').css( "width",(container)+'px');
		}
	};

	// Image background sections top / bottom backgrounds set to page background
	$(function() {
		var pageBG = $(document).find('.wrapper').css('background-color');
		$('.sh-imagebg').each( function() {
			$(this).find('.sh-bottomarrow').css('background-color', pageBG);
			$(this).find('.sh-toparrow').css('background-color', pageBG);
		});
	});


	// Parallax header colors (override theme settings)
	$(function() {
		$('.sh-solidbg').each( function() {
			var color = $(this).attr('data-color');
			$(this).find('h2,h3,h4,h5,h6').css('color', color);
		});
		$('.sh-imagebg').each( function() {
            var color = $(this).attr('data-color');
            $(this).find('h2,h3,h4,h5,h6').css('color', color);
        });
		$('.sh-colorbg').each( function() {
            var color = $(this).attr('data-color');
            $(this).find('h2,h3,h4,h5,h6').css('color', color);
        });
		$('.sh-parallax').each( function() {
			var color = $(this).attr('data-color');
            $(this).find('h2,h3,h4,h5,h6').css('color', color);
        });
		$('.sh-fixed').each( function() {
            var color = $(this).attr('data-color');
            $(this).find('h2,h3,h4,h5,h6').css('color', color);
        });
		$('.sh-video').each( function() {
            var color = $(this).attr('data-color');
            $(this).find('h2,h3,h4,h5,h6').css('color', color);
        });
		$('.shadow-section').parent().css('z-index', '1').css('position', 'relative');
	});

	// checklist colors (overrides highlight color if set), only for ul, ol's have dynamic increments and are handled
	// in shortcode creation with inline style overrides because of :before psuedo counter
	$('ul.sh-checklist.custom').each( function() {
		var background = $(this).data('background');
		var color = $(this).data('color');
		$(this).find('i').css({'background-color': background, 'color': color});
	});

	// Dropcap custom colors
	$('.sh-dropcap.custom').each( function() {
		if ($(this).hasClass('background')) {
			var background = $(this).data('background');
			$(this).css({'background-color': background});
		}
		var font = $(this).data('font');
		$(this).css({'color':font});
	});

	// Highlight custom colors
    $('.sh-highlight.custom').each( function() {
            var background = $(this).data('background');
			var font = $(this).data('font');
            $(this).css({'background-color': background, 'color': font});
    });

	// table tr hovers
	$(function() {
		$('.sh-table tr').hover(
			function() {
				var backgroundColor = $(this).data('hover');
				var origColor = $(this).data('background');
				var $this = $(this);
				$this.data('background', $this.css('background-color')).css('background-color', backgroundColor);
			}, function() {
				var $this = $(this);
				$this.css('background-color', $this.data('background'));
			}
		);
	});
		

	// button hovers
	$(function() {
		$('.hover-enable').hover(
			function() {
				var backgroundColor = $(this).attr('data-hover');
				var iconBGColor = $(this).find('.icon-hover-style').attr('data-icon-hover');
				var $this = $(this);
      			$this.data('bgcolor', $this.css('background-color')).css('background-color', backgroundColor);
				$this.find('.icon-hover-style').data('bgcolor', $this.find('.icon-hover-style').css('background-color')).css('background-color', iconBGColor);
			}, function() {
				var $this = $(this);
				$this.css('background-color', $this.data('bgcolor'));
				$this.find('.icon-hover-style').css('background-color', $this.find('.icon-hover-style').data('bgcolor'));
			}
		);
	});

	// social icon font only no background hover
	$('.hover-text').hover(
		function() {
			var textColor = $(this).data('textcolor');
			var $this = $(this);
			$this.data('textcolor', $this.css('color'));
			$this.css('color', textColor);
		}, function() {
			var textColor = $(this).data('textcolor');
			var $this = $(this);
			$this.data('textcolor', $this.css('color'));
			$this.css('color', textColor);
		}
	);

	// Content box hovers
	$('.sh-contentbox').hover(
		function() {
			var backgroundColor = $(this).data('background');
	    	var $this = $(this).find('.cb-icon');
			$this.css('background-color', backgroundColor);
			$this.css('color', '#ffffff');
		}, function() {
			var backgroundColor = $(this).data('background');
	    	var $this = $(this).find('.cb-icon');
			$this.css('background-color', '#ffffff');
			$this.css('color', backgroundColor);
		}
	);

	$('.sh-contentbox .cb-link, .sh-contentbox .cb-content').hover(
		function() {
			var backgroundColor = $(this).closest('.sh-contentbox').data('background');
			$(this).find('a').css('color', backgroundColor);
		}, function() {
			$(this).find('a').css('color', '');
		}
	);



	// Popovers and Tooltips
	$('.sh-popover').each(function(i, v) {
		var $el = $(v);
		$el.popover({
			container: 'body',
			template: '<div class="popover ' + $el.data('custclass') + '" role="tooltip">'
					+ '<div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
		});
	});

	$('.sh-tooltip').tooltip({
		container: 'body',
	});


	//alert box close
	$(document).on('click', '.sh-alert i.close-btn', function() {
		$(this).closest('.sh-alert').fadeOut();
	});

	// callback boxes set parent height of absolute front child
	$(window).load(function() {
		$('.sh-callout-holder.flip').each(function(){
			var currentHeight = $('.sh-front', this).outerHeight();
			$(this).find('.sh-back').css('min-height', currentHeight);
	   		$(this).find('.sh-callout-inner').css('min-height', currentHeight);
		});
    });
	$(window).resize(function() {
		$('.sh-callout-holder.flip').each(function(){
            var currentHeight = $('.sh-front', this).outerHeight();
            $(this).find('.sh-callout-inner').css('min-height', currentHeight);
            $(this).find('.sh-back').css('min-height', currentHeight);
        });
    });



	// check for 3d transform support...workaround for flipping callouts and no 3d support
	$(document).ready(function() {
		var test = has3d();
		if (test == false) {
			$(document).on('mouseenter touchstart', '.sh-callout-holder.flip', function() {
				$(this).find('.sh-front').fadeOut();
				$(this).find('.sh-back').fadeIn();
			});
			$(document).on('mouseleave touchmove', '.sh-callout-holder.flip', function() {
	            $(this).find('.sh-back').fadeOut();
				$(this).find('.sh-front').fadeIn();
            });
		} 
	});

	function has3d(){
		var el = document.createElement('p'),
		has3d,
		transforms = {
			'webkitTransform':'-webkit-transform',
			'OTransform':'-o-transform',
			'msTransform':'-ms-transform',
			'MozTransform':'-moz-transform',
			'transform':'transform'
		};
 
		// Add it to the body to get the computed style
		document.body.insertBefore(el, null);
 
		for(var t in transforms){
			if( el.style[t] !== undefined ){
				el.style[t] = 'translate3d(1px,1px,1px)';
				has3d = window.getComputedStyle(el).getPropertyValue(transforms[t]);
			}
		}
 
		document.body.removeChild(el);
 
		return (has3d !== undefined && has3d.length > 0 && has3d !== "none");
	}

	// Milestones
		$('.sh-milestone').waypoint(function(direction) {
			var $el_this = $(this).find('.mile-number');
			var start = $el_this.attr('data-start');
			var stop = $el_this.attr('data-stop');
			var speed = parseInt($el_this.attr('data-speed'));
			$({inc: start}).animate({inc: stop}, {
				duration: speed,
				easing: 'swing',
				step: function(i) {
					$el_this.text(Math.ceil(i));
				}
			});
		}, { offset: '90%', triggerOnce: true });

	// Animations trigger
	
	$(window).load(function() {
		if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {

			$('.sh-animate').waypoint(function(direction) {
				var $this = $(this);
				var animation = $(this).attr('data-anim');
				var delay = $(this).attr('data-delay');

				if (!animation) {             // For WooCommerce default animation
					animation = 'fadeInUp';
				} 
				delay = parseInt(delay);
				if (isNaN(delay)) {
					delay = 0;
				}
				setTimeout(function () {
					$this.css('visibility', 'visible').addClass('animated ' + animation);
				}, delay);
			}, {offset: '99%', triggerOnce: true});
		} else {  // mobile devices, don't animate
			$('.sh-animate').each(function () {
				$(this).css('visibility', 'visible');
			});
		}
	});

	// Progress bar animations
    $('.sh-progress').waypoint(function(direction) {
		var width = parseInt($(this).data('width'));
        var bar = $(this).find('.progress-bar');
		bar.animate({
			width: width + '%',
			easing: 'easeOutBack',
		}, 500); 
	}, { offset: '90%', triggerOnce: true });	

	// Circle Charts
	if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
		$('.sh-circle').each( function() {
			var $this = $(this);
    		var isGraph1Viewed=false;

			$(document).ready(function() {
           		if(isScrolledIntoView($this) && isGraph1Viewed==false){$this.circliful();isGraph1Viewed=true;}
    		});

    		$(window).scroll(function() {   
       			if(isScrolledIntoView($this) && isGraph1Viewed==false){$this.circliful();isGraph1Viewed=true;}
    		});
		});
	} else { // mobile
		$( document ).ready(function() {
        	$('.sh-circle').circliful();
    	});
	}

   	function isScrolledIntoView(elem){
       	var docViewTop = $(window).scrollTop();
       	var docViewBottom = docViewTop + $(window).height() - 20; //the 20 is the amount pixels from the bottom
       	var elemTop = $(elem).offset().top;
       	var elemBottom = elemTop + $(elem).height();
       	return ((elemBottom < docViewBottom) && (elemTop > docViewTop));
   	}
	
	// Countdowns
	$(document).ready(function() {
	  	$('.sh-countdown').each( function() {
		  	var countdownDate = $(this).attr('data-date');
      		$(this).countdown({
        		//date: "4 december 2014 11:10:50", // add the countdown's end date (i.e. 3 november 2012 12:00:00)
				date: countdownDate,
        		format: "on" // on (03:07:52) | off (3:7:52) - two_digits set to ON maintains layout consistency
      		},
     
      		function() {
        		// the code here will run when the countdown ends
        		//alert("done!")
      		});
		});
	});

	$.fn.countdown = function(options, callback) {
    //custom 'this' selector
    var thisEl = $(this);
    //array of custom settings
    var settings = {
      'date': null,
      'format': null
    };

    //append the settings array to options
    if(options) {
      $.extend(settings, options);
    }

    //main countdown function
    function countdown_proc() {
     
      var eventDate = Date.parse(settings['date']) / 1000;
      var currentDate = Math.floor($.now() / 1000);
     
      if(eventDate <= currentDate) {
        callback.call(this);
        clearInterval(interval);
      }
     
      var seconds = eventDate - currentDate;
     
      var days = Math.floor(seconds / (60 * 60 * 24)); //calculate the number of days
      seconds -= days * 60 * 60 * 24; //update the seconds variable with no. of days removed
     
      var hours = Math.floor(seconds / (60 * 60));
      seconds -= hours * 60 * 60; //update the seconds variable with no. of hours removed
     
      var minutes = Math.floor(seconds / 60);
      seconds -= minutes * 60; //update the seconds variable with no. of minutes removed
     
      //conditional Ss
      if (days == 1) { thisEl.find(".timeRefDays").text("day"); } else { thisEl.find(".timeRefDays").text("days"); }
      if (hours == 1) { thisEl.find(".timeRefHours").text("hour"); } else { thisEl.find(".timeRefHours").text("hours"); }
      if (minutes == 1) { thisEl.find(".timeRefMinutes").text("minute"); } else { thisEl.find(".timeRefMinutes").text("minutes"); }
      if (seconds == 1) { thisEl.find(".timeRefSeconds").text("second"); } else { thisEl.find(".timeRefSeconds").text("seconds"); }
     
      //logic for the two_digits ON setting
      if(settings['format'] == "on") {
        days = (String(days).length >= 2) ? days : "0" + days;
        hours = (String(hours).length >= 2) ? hours : "0" + hours;
        minutes = (String(minutes).length >= 2) ? minutes : "0" + minutes;
        seconds = (String(seconds).length >= 2) ? seconds : "0" + seconds;
      }
     
      //update the countdown's html values.
      if(!isNaN(eventDate)) {
        thisEl.find(".days").text(days);
        thisEl.find(".hours").text(hours);
        thisEl.find(".minutes").text(minutes);
        thisEl.find(".seconds").text(seconds);
      } else {
        alert("Invalid date. Here's an example: 12 December 2012 17:30:00");
        clearInterval(interval);
      }
    }
   
    //run the function
    countdown_proc();
   
    //loop the function
    var interval = setInterval(countdown_proc, 1000);
  }


	// fancybox
    if ($('.sh-fancybox').length) {
        $('.sh-fancybox').fancybox({
            // No white border
            padding:0,
            tpl: {
                closeBtn: '<a title="Close" class="fancybox-item fancybox-close myClose" href="javascript:;"></a>',
                prev: '<a title="Previous" class="fancybox-nav fancybox-prev"><span class="myPrev"></span></a>',
                next: '<a title="Next" class="fancybox-nav fancybox-next"><span class="myNext"></span></a>'
            },
            //make sure fancybox knows we are loading images from wordpress
            'type': 'image',
            'autoSize' : true,
            //lock the background when fancybox is active so weird padding doesn't show up
            helpers : {
                title: {
                    type: 'inside'
                },
                overlay : {
                    locked : false
                }
            }
        });

        //don't display loader
        $.fancybox.showLoading = function () {
            //console.info('My loading');
        }
    };

	// Modals - auto open
	$( document ).ready( function() {
	    $( '.sh-modal.openready' ).modal( 'toggle' );
	});

	// Google Maps
	$('.sh-map').each(function (index, Element) {
		var map;
        var lat = $(this).data('lat');
        var lng = $(this).data('lng');
        var zoom = $(this).attr('data-zoom');
        var maptype = $(this).attr('data-maptype');
        var zoomcontrol = $(this).attr('data-zoomcontrol') == 'true' ? true : false;
        var pancontrol = $(this).attr('data-pancontrol') == 'true' ? true : false;
        var maptypecontrol = $(this).attr('data-maptypecontrol') == 'true' ? true : false;
        var scrollwheel = $(this).attr('data-scrollwheel') == 'true' ? true : false;
        var mapcolor = $(this).attr('data-mapcolor');

		var saturation = typeof $(this).data('saturation') != 'undefined' ? $(this).data('saturation') : 0;
		var lightness = typeof $(this).data('lightness') != 'undefined' ? $(this).data('lightness') : 0;
        var custommarker = $(this).attr('data-marker');
        var infoboxbg = $(this).attr('data-infoboxbg');
        var infoboxcolor = $(this).attr('data-infoboxcolor');
        var points = $(this).data('points');
		var infoboxAr = $(this).data('infobox');
		if (infoboxAr) {
			var infobox = infoboxAr['infobox'];
		}
		
		var centerMap = new google.maps.LatLng(parseFloat(lat), parseFloat(lng)),
			markers,
				myMapOptions = {
					zoom: parseFloat(zoom),
            		center: centerMap,
            		mapTypeId: google.maps.MapTypeId[maptype],
            		disableDefaultUI: false,

            		scrollwheel: scrollwheel,
            		mapTypeControl: maptypecontrol,
            		zoomControl: zoomcontrol,
            		panControl: pancontrol,
            		panControlOptions: {
                		position: google.maps.ControlPosition.TOP_LEFT
            		},
            		zoomControlOptions: {
                		style: google.maps.ZoomControlStyle.SMALL
            		}
			},
			map = new google.maps.Map(Element, myMapOptions);

		 // Map Color
        if (mapcolor) {
            var styles = [{
                stylers: [
                    {hue: mapcolor},
					// lightness & saturation values from -100 to 100
					{saturation: saturation},
					{lightness: lightness},
                ]},
            ];
            map.setOptions({styles: styles});
        } 

		function initMarkers(map, markerData) {
        	var newMarkers = [],
            	marker;

			for(var i=0; i < markerData.length; i++) {
				var boxText;
				var infoboxOptions;
            	marker = new google.maps.Marker({
					map:map,
					position: markerData[i].coords,
					visible: true,
					icon: markerData[i].marker
				}),
				boxText = document.createElement("div"),
            	//these are the options for all infoboxes
            	infoboxOptions = {
                	content: boxText,
                	disableAutoPan: false,
                	maxWidth: 0,
                	pixelOffset: new google.maps.Size(-120, 0),
                	zIndex: null,
                	boxStyle: {
                    	opacity: 1,
                    	width: "240px"
                	},
                	closeBoxMargin: "12px 4px 2px 2px",
                	closeBoxURL: "//www.google.com/intl/en_us/mapfiles/close.gif",
                	infoBoxClearance: new google.maps.Size(1, 1),
                	isHidden: false,
                	pane: "floatPane",
                	enableEventPropagation: false
            	};

				newMarkers.push(marker);
            	//define the text and style for all infoboxes
				if (markerData[i].infobox) {
					boxText.style.cssText = 'border: 0; border-radius: 4px; margin-top: 8px;'
                		+ 'color:' + infoboxcolor + '; background:' + infoboxbg + '; padding: 5px;';
            		boxText.innerHTML = markerData[i].infobox;
            		//Define the infobox
            		newMarkers[i].infobox = new InfoBox(infoboxOptions);
            		//Open box when page is loaded
            		newMarkers[i].infobox.open(map, marker);
            		google.maps.event.addListener(marker, 'click', (function(marker, i) {
                		return function() {
                    		newMarkers[i].infobox.open(map, this);
                    		map.panTo(markerData[i].coords);
                		}
            		})(marker, i));
				}
        	}
        	return newMarkers;
		}
		markers = initMarkers(map, [
			// Add Primary Point
			{ coords: new google.maps.LatLng(parseFloat(lat), parseFloat(lng)), infobox: infobox, marker: custommarker },
    	]);
		// Add Secondary Points
		if (points != null) {
			$.each(points, function(i, v) {
				markers= markers + initMarkers(map, [
				{ coords: new google.maps.LatLng(v['address_lat'], v['address_lng']), infobox: v['infobox'], marker: v['marker']}
				]);
        	});
		}
	});
	// End Google Maps

	
    // Contact Form //
    $(document).on('click', '.cont-send', function() {
		var $container = $(this).closest('.sh-contact-form');
        var email   = $container.find('.contact-email').val();
        var name    = $container.find('.contact-name').val();
        var message = $container.find('.contact-message').val();
		var newemail = $container.data('newemail');

        $container.find('.error-field').removeClass('error-field');
        $container.find('.contact-response').html('');
        $container.find('.error-text').removeClass('error-text');

        $.ajax({
            type: "POST",
            url: theme_globals.sh_adminUrl + "/admin-ajax.php",
            dataType: 'json',
            data: {action: 'handle_contact_form', name:name, email:email, message:message, newemail:newemail},
            success: function(response) {
                if(response.ok == 'true') {   // Message sent
                    var message = response.message;
                    $container.find('.contact-response').hide().fadeIn('slow').html(message);
                    $container.find('.contact-name').prop('disabled', true);
                    $container.find('.contact-email').prop('disabled', true);
                    $container.find('.contact-message').prop('disabled', true);
                    $container.find('.contSend').prop('disabled', true);
                    // reset form
                    $container.find(':input')
                        .not(':button, :submit, :reset, :hidden')
                        .val('')
                        .removeAttr('checked')
                        .removeAttr('selected');

                } else if (response.ok == 'false') {
                    $container.find('.contact-response').hide().fadeIn('slow').html(response.message);
                    $container.find('.contact-' + response.field).addClass('error-field');
                } else {
                    alert('There was a problem communicating, please try again.');
                }
            }
        });
    });
    // End Contact Form //

	// Sitemap sorting //
	$(document).on('change', '.sitemap-page-options', function() {
		$('.sitemap-page-sort').submit();
	});

	$(document).on('change', '.sitemap-post-options', function() {
        $('.sitemap-post-sort').submit();
    });

	// End Sitemap //

	

});
