<?php

/**
 *  This class creates the core shortcodes  
 *  																			SH 2-28-2014
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'Create_Shortcodes' ) ) :
    class Create_Shortcodes {

      // Protected vars
      //protected $parent;
	  public $theme = 'sh';

      /**
       * Class Constructor. Defines the args for the extions class
       *
       * @since       1.0.0
       * @access      public
       * @param       array SH_Shortcodes class instance
       * @return      void
       */
      	public function __construct() {
			if ( !shortcode_exists( $this->theme . '_accordion' ) ) {
                add_shortcode($this->theme . '_accordion', array($this, 'accordion'));
				add_shortcode($this->theme . '_accord_item', array($this, 'accord_item'));
            }

			if ( !shortcode_exists( $this->theme . '_alert' ) ) {
				add_shortcode($this->theme . '_alert', array($this, 'alert'));
			}

			if ( !shortcode_exists( $this->theme . '_anchor' ) ) {
				add_shortcode($this->theme . '_anchor', array($this, 'anchor'));
			}

			if ( !shortcode_exists( $this->theme . '_animate' ) ) {
                add_shortcode($this->theme . '_animate', array($this, 'animate'));
            }

			/* Columns -bs */
			if ( !shortcode_exists( $this->theme . '_columns' ) ) {
				add_shortcode($this->theme . '_columns', array($this, 'columns'));
				add_shortcode($this->theme . '_column', array($this, 'column'));
			}

			/* Countdowns */
			if ( !shortcode_exists( $this->theme . '_countdown' ) ) {
				add_shortcode($this->theme . '_countdown', array($this, 'countdown'));
			}

			/* Dividers */
			if ( !shortcode_exists( $this->theme . '_divider' ) ) {
                add_shortcode($this->theme . '_divider', array($this, 'divider'));
            }

			/* Display Shortcode */ 
			if ( !shortcode_exists( $this->theme . '_sc' ) ) {
                add_shortcode($this->theme . '_sc', array($this, 'show_shortcode'));
            }

			/* Milestone Counter */
			if ( !shortcode_exists( $this->theme . '_milestone' ) ) {
                add_shortcode($this->theme . '_milestone', array($this, 'milestone'));
            }

			/* Modal */
			if ( !shortcode_exists( $this->theme . '_modal' ) ) {
                add_shortcode($this->theme . '_modal', array($this, 'modal'));
            }

 			/* Lorem Ipsum */     	
			if ( !shortcode_exists( $this->theme . '_lorem' ) ) {
      			add_shortcode($this->theme . '_lorem', array($this, 'lorem'));
			}
		
			/* Quote */
			if ( !shortcode_exists( $this->theme . '_quote' ) ) {
            	add_shortcode($this->theme . '_quote', array($this, 'quote'));
        	}

			/* Quote Style 2 */
			if ( !shortcode_exists( $this->theme . '_quote2' ) ) {
            	add_shortcode($this->theme . '_quote2', array($this, 'quote2'));
        	}

			/* Pull Quote */
			if ( !shortcode_exists( $this->theme . '_pullquote' ) ) {
            	add_shortcode($this->theme . '_pullquote', array($this, 'pullquote'));
        	}

			if ( !shortcode_exists( $this->theme . '_dropcap' ) ) {
				add_shortcode($this->theme . '_dropcap', array($this, 'dropcap'));
			}

			if ( !shortcode_exists( $this->theme . '_highlight' ) ) {
				add_shortcode($this->theme . '_highlight', array($this, 'highlight'));
			}

			/* Image Frames */
            if ( !shortcode_exists( $this->theme . '_imageframe' ) ) {
                add_shortcode($this->theme . '_imageframe', array($this, 'imageframe'));
            }

			/* Progress Bars */
			if ( !shortcode_exists( $this->theme . '_progress' ) ) {
				add_shortcode($this->theme . '_progress', array($this, 'progress'));
	        }

			/* Circles */
			if ( !shortcode_exists( $this->theme . '_circle' ) ) {
                add_shortcode($this->theme . '_circle', array($this, 'circle'));
            }
		
			/* Buttons */
			if ( !shortcode_exists( $this->theme . '_btn' ) ) {
            	add_shortcode($this->theme . '_btn', array($this, 'btn'));
        	}

			/* Blog Entries Grid */
			if ( !shortcode_exists( $this->theme . '_bloggrid' ) ) {
				add_shortcode($this->theme . '_bloggrid', array($this, 'bloggrid'));
			}

			/* Portfolio Entries Grid */
			if ( !shortcode_exists( $this->theme . '_portfoliogrid' ) ) {
                add_shortcode($this->theme . '_portfoliogrid', array($this, 'portfoliogrid'));
            }

			/* Font Awesome icons */
			if ( !shortcode_exists( $this->theme . '_fa') ) {
				add_shortcode($this->theme . '_fa', array($this, 'font'));
			}

			/* Social formatted icons */
			if ( !shortcode_exists( $this->theme . '_social') ) {
                add_shortcode($this->theme . '_social', array($this, 'social'));
            }

			/* Center Container */
			if ( !shortcode_exists( $this->theme . '_center') ) {
            	add_shortcode($this->theme . '_center', array($this, 'center'));
        	}

			/* Callout */
			if ( !shortcode_exists( $this->theme . '_callout') ) {
				add_shortcode($this->theme . '_callout', array($this, 'callout'));
			}

			/* Content Boxes */
			if ( !shortcode_exists( $this->theme . '_content') ) {
                add_shortcode($this->theme . '_content', array($this, 'content'));
            }

			/* checklists */
			if ( !shortcode_exists( $this->theme . '_checklist') ) {
				add_shortcode($this->theme . '_checklist', array($this, 'checklist'));
				add_shortcode($this->theme . '_checklist_item', array($this, 'checklist_item'));
			}

			/* Headers */
			if ( !shortcode_exists( $this->theme . '_header') ) {
            	add_shortcode($this->theme . '_header', array($this, 'header'));
        	}

			/* Header double line */
			if ( !shortcode_exists( $this->theme . '_headerdouble') ) {
            	add_shortcode($this->theme . '_headerdouble', array($this, 'headerdouble'));
        	}
			/* Color only background section - arrows can overlap */
			if (!shortcode_exists( $this->theme . '_colorbg') ) {
				add_shortcode($this->theme . '_colorbg', array($this, 'colorbg'));
			}

			/* Image background section */
			if ( !shortcode_exists( $this->theme . '_imagebg') ) {
				add_shortcode($this->theme . '_imagebg', array($this, 'imagebg'));
			}

			/* people */
			if ( !shortcode_exists( $this->theme . '_people') ) {
                add_shortcode($this->theme . '_people', array($this, 'people'));
            }

			/* pricing */
			if ( !shortcode_exists( $this->theme . '_ptable') ) {
				add_shortcode($this->theme . '_ptable', array($this, 'p_table'));
				add_shortcode($this->theme . '_pcol', array($this, 'p_col'));
			}

			/* parallax */
			if ( !shortcode_exists( $this->theme . '_parallax') ) {
            	add_shortcode($this->theme . '_parallax', array($this, 'parallax'));
        	}

			/* popovers */
			if ( !shortcode_exists( $this->theme . '_popover') ) {
                add_shortcode($this->theme . '_popover', array($this, 'popover'));
            }

			/* sitemaps */
			if ( !shortcode_exists( $this->theme . '_sitemap') ) {
                add_shortcode($this->theme . '_sitemap', array($this, 'sitemap'));
            }

			/* SoundCloud */
            wp_oembed_add_provider('#https?://(?:api\.)?soundcloud\.com/.*#i', 'http://soundcloud.com/oembed', true);
            add_shortcode($this->theme . '_soundcloud', array($this, 'soundcloud_shortcode'));

			/* tooltips */
			if ( !shortcode_exists( $this->theme . '_tooltip') ) {
                add_shortcode($this->theme . '_tooltip', array($this, 'tooltip'));
            }

			/* Tables */
			if ( !shortcode_exists( $this->theme . '_table') ) {
                add_shortcode($this->theme . '_table', array($this, 'table'));
                add_shortcode($this->theme . '_head', array($this, 't_head'));
				add_shortcode($this->theme . '_row', array($this, 't_row'));
            }

			/* Testimonial carousels and single */
			if ( !shortcode_exists( $this->theme . '_testcarousel') ) {
                add_shortcode($this->theme . '_testcarousel', array($this, 'testimonialc'));
                add_shortcode($this->theme . '_testimonial', array($this, 'testimonial'));
            }

			/* Video */
			if ( !shortcode_exists( $this->theme . '_video') ) {
                add_shortcode($this->theme . '_video', array($this, 'video'));
            }
			/* Google Docs */
            if ( !shortcode_exists( $this->theme . '_gdoc') ) {
                add_shortcode($this->theme . '_gdoc', array($this, 'gdoc'));
            }

			/* Google Maps */
			if ( !shortcode_exists( $this->theme . '_gmap') ) {
                add_shortcode($this->theme . '_gmap', array($this, 'gmap'));
				add_shortcode($this->theme . '_gmap_point', array($this, 'gmap_point'));
            }

			/* Simple Form */
			if ( !shortcode_exists( $this->theme . '_form') ) {
                add_shortcode($this->theme . '_form', array($this, 'form'));
            }


      	}

		/**
			Shortcode - accordion
		**/
		public function accordion($atts, $content=NULL) {
			global $accord_count;
			global $accord_display;
			global $accord_items;
			extract(shortcode_atts(array(
                'mode' => 'single',                // single or all openable
            ), $atts));
			$accord_count++;
			$accord_current = 'accordion-' . $accord_count;
			if ($mode == 'all') {  // all can open
				$accord_display = '';  // don't pass the parent id
			} else {
				$accord_display = $accord_current;
			}

            $content = $this->removeTags($content);
			$content = do_shortcode($content);
			

			$output = '<div class="sh-accordion panel-group" id="' . $accord_current . '">';
			
			foreach ($accord_items as $k => $v) {
				$output .= $v;
			}
			$output .= '</div>';

			$accord_items = '';
			return $output; 
		}

	    public function accord_item($atts, $content=NULL) {
			global $accord_display;
			global $accord_items;
			global $accord_item_count;

            extract(shortcode_atts(array(
                'open' => 'false',
				'title' => '',
            ), $atts));
            $content = $this->removeTags($content);
            $content = do_shortcode($content);
			$accord_item_count++;

			if ($open == 'true') {
				$in = 'in';
				$collapsed = '';
			} else {
				$in = '';
				$collapsed = 'collapsed';
			}
			$accord_items[$accord_item_count] = '<div class="panel panel-default">'
    				. '<div class="panel-heading">'
      				. '<h4 class="panel-title">'
        			. '<a class="' . $collapsed . '" data-toggle="collapse" data-parent="#' . $accord_display . 
					'" href="#collapse-' . $accord_item_count . '"><i class="fa fa-plus"> </i> '
          			. $title . '</a></h4></div>'
    				. '<div id="collapse-' . $accord_item_count . '" class="panel-collapse collapse ' . $in . '">'
      				. '<div class="panel-body">';

			$accord_items[$accord_item_count] .= $content;
			$accord_items[$accord_item_count] .= '</div></div></div>';
        }


		/** 
		  	Shortcode - alert
		**/
		public function alert($atts, $content=NULL) {
			extract(shortcode_atts(array(
                'type' => 'general',
                'close' =>'',
				'enablefont' => '',
				'icon' => '',
				'iconset' => 'fontawesome',
				'iconfa' => 'fa fa-glass',
				'iconlinear' => 'icon-home',
				'iconion' => 'ion-alert',
				'background' => '',
				'fontsize' => '15px',
				'fontcolor' => '',
				'bordercolor' => '',
            ), $atts));
			$clean = $this->removeTags($content);
			$clean = $this->removeps($clean);

			 // for pre 2.0 users
            if ($icon != '') {
                $icon = $icon;
            } else {

				if ($iconset == 'fontawesome') {
					$icon = $iconfa;
				} elseif ($iconset == 'linear') {
					$icon = $iconlinear;
				} elseif ($iconset == 'ion') {
					$icon = $iconion;
				}
			}

			if ($close == 'enable') {
				$closeBtn = '<i class="fa fa-times close-btn"> </i>';
			} else {
				$closeBtn = '';
			}
			if ($enablefont == 'enable') {
				$icon = '<i class="alert-font ' . $icon . '"> </i>';
			} else {
				$icon = '';
			}

			if ($type == 'custom') { // custom colors for alert box
				$style = 'style="color:' . $fontcolor . ';background-color:' . $background 
					. ';border: 1px solid ' . $bordercolor . '; font-size: ' . $fontsize . '; line-height: ' . $fontsize . ';"';
			} else {
				$style = 'style="font-size: ' . $fontsize . '; line-height: ' . $fontsize . ';"';
			}

			$content = do_shortcode($clean);
			$output = '<div class="sh-alert ' . $type . '" ' . $style . '>' . $icon . $content . $closeBtn . '</div>';
			return $output;
		}

		/**
		  	Shortcode - Anchor Links
		**/
		public function anchor($atts, $content=NULL) {
			extract(shortcode_atts(array(
                'id' => 'contact-section'
            ), $atts));
            $clean = $this->removeTags($content);
			$clean = $this->removeps($clean);
			if (trim($clean) == '<br />') {  // finally, remove break rows on empty string
				$clean = '';
			}
			$content = do_shortcode($clean);
			$output = '<div id="' . $id . '">' . $content . '</div>';
			return $output;
		}

		/**
			Shortcode - Animate
		**/
		public function animate($atts, $content=NULL) {
			extract(shortcode_atts(array(
				'anim' => 'bounce',
				'delay' => '500'
			), $atts));
			$clean = $this->removeTags($content);
			$content = do_shortcode($clean);
			$output = '<div class="sh-animate" data-anim="' . $anim . '" data-delay="' 
				    . $delay . '" style="visibility:hidden";>' . $content . '</div>';
			return $output;
		}

		/**
			Shortcode - lorem
		**/
	  	public function lorem($atts, $content=NULL) {
			return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec nulla vitae lacus mattis volutpat eu at sapien. Nunc interdum congue libero, quis laoreet elit sagittis ut. Pellentesque lacus erat, dictum condimentum pharetra vel, malesuada volutpat risus. Nunc sit amet risus dolor. Etiam posuere tellus nisl. Integer lorem ligula, tempor eu laoreet ac, eleifend quis diam. Proin cursus, nibh eu vehicula varius, lacus elit eleifend elit, eget commodo ante felis at neque. Integer sit amet justo sed elit porta convallis a at metus. Suspendisse molestie turpis pulvinar nisl tincidunt quis fringilla enim lobortis. Curabitur placerat quam ac sem venenatis blandit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam sed ligula nisl. Nam ullamcorper elit id magna hendrerit sit amet dignissim elit sodales. Aenean accumsan consectetur rutrum.';

		}

		/**
			Shortcode - quote
		**/
		public function quote($atts, $content=NULL) {
			$clean = $this->removeTags($content);
			$output = '<blockquote class="sh-quote">' . $clean . '</blockquote>';
			return $output;
		}

		/**
            Shortcode - quote 2
        **/
        public function quote2($atts, $content=NULL) {
            $clean = $this->removeTags($content);
            $output = '<blockquote class="sh-quote2"><i class="fa fa-quote-left fa-2x"></i>' . $clean . '</blockquote>';
            return $output;
        }

		/** 
			Shortcode - pullquote
		**/
		public function pullquote($atts, $content=NULL) {
			extract(shortcode_atts(array(
                'side' => 'left',
				'source' =>''
            ), $atts));
            $content = $this->removeTags($content);
			$content = $this->removeps($content);
			$content = do_shortcode($content);
			if ($source == '') {
				$sourceCite = '';
			} else {
				$sourceCite = '<cite class="quote-source">- ' . $source . '</cite>';
			}
            $output = '<blockquote class="sh-pullquote ' . $side . '">' . $content . $sourceCite . '</blockquote>';
            return $output;
        }

		/** 
		  	Shortcode - dropcaps
		**/
		public function dropcap($atts, $content=NULL) {
			extract(shortcode_atts(array(
				'style' => 'theme',
				'color' => 'foreground', // this is only for theme style
				'fontcolor' => '#555',
				'setbg' => 'false',      // needed to add background class to custom type
				'background' => 'rgba(0,0,0,0.15)',
				'dropshadow' => 'false',

			), $atts));

			$addClass = '';
			$datavals = '';
			if ($dropshadow == 'true') {
				$addClass .= ' dropshadow';
			}

			if ($style == 'theme') {
				$addClass .= ' ' . $style . ' ' . $color;
			} else if ($style == 'custom') {   // custom styles
				$addClass .= ' ' . $style;
				if ($setbg == 'true') {
					$addClass .= ' background';
				}
				$datavals = ' data-background=' . $background . ' data-font="' . $fontcolor . '"';
			}

			$output = '<span class="sh-dropcap' . $addClass . '"' . $datavals . '>' . $content . '</span>';
			return $output;
		}

		/** 
		  	Shortcode - highlight
		**/
		public function highlight($atts, $content=NULL) {
			extract(shortcode_atts(array(
                'choice' => 'foreground',
				'color' => 'accentcolor',
				'background' => '', // for custom choice
				'fontcolor' => '' // for custom choice
            ), $atts));

			$styles = '';
			if ($color == 'custom') {  // add colors for custom styles
				$styles = 'data-background="' . $background . '" data-font="' . $fontcolor . '"';
			}
			$output = '<span class="sh-highlight ' . $choice . ' ' . $color . '" ' . $styles . '>' . $content . '</span>';
			return $output;
		}

		public function imageframe($atts, $content=NULL) {
			extract(shortcode_atts(array(
                'style' => 'bordered',  // bordered, shadow, lifted, sideshadow, circle, circleshadow
				'bordersize' => '0px',
				'padding' => '0px',
				'bordercolor' => 'rgba(0,0,0,0.25)',
                'source' => '',
				'action' => 'none',
				'title' => '',
				'hover' => 'disable',
				'url' => ''
            ), $atts));
		
			$class = '';   // Class for the image itself
			if ($style == 'circle'
				|| $style == 'circleshadow') 
			{
				$class= 'img-circle';
			}

			// check for image post id from visual composer
            if (preg_match('/^\d+$/', $source, $matches)) {
                $img_attributes = wp_get_attachment_image_src($source, 'full');
                $source = $img_attributes[0];
            } else {
                $source = $source;
            }

			$imgStyle = 'style="border:' . $bordersize . ' solid ' . $bordercolor . ';padding:' . $padding . ';"';

            $output = '<div class="sh-imageframe ' . $style . '">'
					. '<div class="sh-imageholder">';

			if ($action == 'fancybox') {  // wrap in a link

				if ($hover == 'enable') { // enable image effect
					$output .= '<img class="img-responsive ' . $class . '" src="' . $source . '" ' . $imgStyle . ' />'
							. '<div class="imageframe-overlay" style="margin:' . $padding . ';">'
							. '<a class="sh-fancybox" title="' . $title . '" href="' . $source . '">+</a>'
							. '</div>';
                } else {    // fancybox no hover effect
					$output .= '<a class="sh-fancybox" title="' . $title . '" href="' . $source . '">'
							. '<img class="img-responsive ' . $class . '" src="' . $source . '" ' . $imgStyle . ' />'
							. '</a>';
				}
			} elseif ($action == 'url') {
				if ($hover == 'enable') { // url with hover effect
					$output .= '<img class="img-responsive ' . $class . '" src="' . $source . '" ' . $imgStyle . ' />'
                            . '<div class="imageframe-overlay" style="margin:' . $padding . ';">'
                            . '<a class="sh-url" href="' . $url . '">+</a>'
                            . '</div>';
				} else {                 // url without hover effect
					$output .= '<a class="sh-url" title="' . $title . '" href="' . $url . '">'
                            . '<img class="img-responsive ' . $class . '" src="' . $source . '" ' . $imgStyle . ' />'
                            . '</a>';
				}
				
			} else {
				$output .= '<img class="img-responsive ' . $class . '" src="' . $source . '" ' . $imgStyle . ' />';
			}

			$output .= '</div></div>';

			

            return $output;
		}
	
		/** Progress Bars **/
		public function progress($atts, $content=NULL) {
			$clean = $this->removeTags($content);
			extract(shortcode_atts(array(
				'padding' => '0px',
				'barcolor' => '#2980b9',
				'textcolor' => '#fff',
				'background' => 'rgba(0,0,0,0.15)',
				'style' => 'solid',   // solid, pulse, striped
				'text' => 'Your Progress Text',
				'percent' => '75',
				'symbol' => '%'
			), $atts));
			if ($style=='striped') {
				$progStyle = 'progress-striped active';
			} else {
				$progStyle = $style;
			}
			$output = '<div class="sh-progress progress ' . $progStyle . '" '
					. 'style="height: auto;background-color:' . $background . ';" data-width="' . $percent . '">
							<div class="progress-bar" style="background-color:' . $barcolor . ';padding:' . $padding . '">'
							. '<span style="color:' . $textcolor . '">' 
							. $text . '  ' . $percent . $symbol . '</span></div>
					   </div>';
			return $output;
		}

		/** 
		  Shortcode - Circle Charts
		**/
		public function circle($atts, $content=NULL) {
			extract(shortcode_atts(array(
				'dimension' => '250',
				'text' => '',
				'info' => '',
				'border' => 'default', //default, outline, inline  - not used for now
				'width' => '15',
				'fontsize' => '38',// iconsize = fontsize too
				'percent' => '75',
				'fgcolor' => '#61a9dc',
				'bgcolor' => '#eee',
				'fill' => '#fff',
				'type' => 'full',
				'circleicon' => 'disable',
				'icon' => '',
				'iconset' => 'fontawesome',
                'iconfa' => 'fa fa-glass',
                'iconlinear' => 'icon-home',
                'iconion' => 'ion-alert',
				'iconcolor' => '#999',
			), $atts));
			// circleicon is only for Visual Composer, since it will set it anyways, we check for it being disabled
			if ($circleicon == 'disable') {
				$icon = '';
				$iconcolor = '';
			} else {
				// for pre 2.0 users
            	if ($icon != '') {
                	$icon = $icon;
            	} else {

					if ($iconset == 'fontawesome') {
                		$icon = $iconfa;
            		} elseif ($iconset == 'linear') {
                		$icon = $iconlinear;
            		} elseif ($iconset == 'ion') {
                		$icon = $iconion;
            		}
				}
			}

			$output = '<div class="sh-circle" data-dimension="' . $dimension . '" data-text="' . $text 
					. '" data-info="' . $info . '" data-width="' . $width . '" data-fontsize="' . $fontsize 
					. '" data-percent="' . $percent . '" data-fgcolor="' . $fgcolor . '" data-bgcolor="' . $bgcolor 
					. '" data-fill="' . $fill . '" data-type="' . $type . '" data-icon="' . $icon 
					. '" data-iconcolor="' . $iconcolor . '" data-border="' . $border 
					. '" data-iconsize="' . $fontsize . '"></div>';
			return $output;

		}
		

		/**
			Shortcode - Button
		**/
		public function btn($atts, $content=NULL) {
			$clean = $this->removeTags($content);
			$clean = $this->removeps($clean);
			extract(shortcode_atts(array(  
                'link' => '',
                'target' => '_blank',
				'size' => 'small',
				'shape' => 'square',
				'style' => 'flat',
				'color' => '#555555',
				'enablehover' => 'enable',
				'enableicon' => 'disable',
				'icon' => '',
				'iconset' => 'fontawesome',
				'iconfa' => 'fa fa-glass',
				'iconlinear' => 'icon-home',
				'iconion' => 'ion-alert',
				'iconbg' => '',
				'bordersize' => '0',
				'bordercolor' => '',
				'fontcolor' => '#ffffff'
            ), $atts));
			$bordersize = intval($bordersize);

			// for pre 2.0 users
            if ($icon != '') {
                $icon = $icon;
            } else {
				if ($iconset == 'fontawesome') {
                	$icon = $iconfa;
            	} elseif ($iconset == 'linear') {
                	$icon = $iconlinear;
            	} elseif ($iconset == 'ion') {
                	$icon = $iconion;
            	}
			}

			// negative values darken color (e.g. -0.5 ...50%) the lower the number darkens more
           	$darken = $this->colorBrightness($color, -0.9);
           	$darkenMore = $this->colorBrightness($color, -0.8);

			// style flat dimension
            if ($style == 'dimension') {
                $d_border = 'border-bottom:3px solid ' . $darkenMore . ';';
				if ($bordersize > 0) { // override dimension border if they have a border set
                	$d_border = '';
            	}
			} else {
				$d_border = '';
			}

			// hover
			if ($enablehover == 'enable') {
				$hover = 'hover-enable';
				// negative values darken color (e.g. -0.5 ...50%)
				$data_hover = 'data-hover="' . $darken . '"';
			} else {
				$hover = '';
				$data_hover = '';
			}
			// Icon
			if ($enableicon == 'enable') {
				if ($iconbg == 'square') {
					$iconStyle = 'background-color:' . $darken . ';';
					$icon_html = '<span class="btn-icon icon-hover-style ' . $iconbg . '" style="' . $iconStyle . '"' 
							. ' data-icon-hover="' . $darkenMore . '">'
                            . '<i class="' . $icon . '"'
							. ' style="background-color:' . $fontcolor . ';color:' . $darken . '"></i> </span>';
				} elseif ($iconbg == 'diagonal') {
					$iconStyle = 'background-color:' . $darken . ';';
                    $icon_html = '<div class="btn-icon ' . $iconbg . '">'
                            . '<i class="' . $icon . '"></i>'
							. '<div class="diag-bg icon-hover-style"'
							. ' style="' . $iconStyle . '" data-icon-hover="' . $darkenMore . '"></div></div>';
				} else {
					// flat style
					$iconStyle = '';
					$icon_html = '<span class="btn-icon ' . $iconbg . '"><i class="' . $icon . '"></i> </span>';
				}
			} else {
				$icon_html = '';
			}

			$output = '<a class="sh-btn ' . $size . ' ' . $shape . ' ' . $style . ' ' 
					. $hover . '" target="' . $target 
					. '" style="border-style:solid;border-width:' . $bordersize . 'px;border-color:' 
					. $bordercolor . ';background-color:' . $color . ';color:' . $fontcolor . ';' . $d_border . '" ' 
					. $data_hover . ' href="' . $link . '">' . $icon_html . $clean . '</a>';
			return $output;
		}

		/**
			Shortcode - Portfolio Grid
		**/
		public function portfoliogrid($atts, $content=NULL) {
			global $themeSettings;
            global $grid_needed;   // checked to load isotope in shortcode styles and check excerpt in theme settings
			global $fancy_media;   // check to enqueue fancybox media
            $grid_needed = true;
			$fancy_media = true;
            $clean = $this->removeTags($content);
            $content = do_shortcode($clean);
            extract(shortcode_atts(array(
                'perrow' => '2',
                'show' => '1',
				'categories' => '',
            ), $atts));
			$limit = intval($show);
			$cols = 'col-md-3'; // default
            if ($perrow == '2') {
                $cols = 'col-md-6 col-sm-6';
            } elseif ($perrow == '3') {
                $cols = 'col-md-4 col-sm-6';
            } elseif ($perrow == '4') {
                $cols = 'col-md-3 col-sm-6';
            } elseif ($perrow == '5') {
                $cols = 'col-md-5ths col-sm-6';
            } elseif ($perrow == '6') {
				$cols = 'col-md-2 col-sm-4';
			}
			$portfolio = '
			<div class="row">
				<div class="col-md-12 no-padding">
					<div class="sh-portfoliogrid">
			';

			// If they have categories selected
			if (trim($categories) != '') {  // query one or multiple portcats
				$i = 0;
            	$cats = explode(',', $categories);
            	foreach ($cats as $cat) {
					if ($i >= $limit) { return; }
                	$args = array(
                    	'post_type' => 'portfolio_entry',
                    	'portcat' => $cat,
                    	'posts_per_page' => $limit
                	);
                	$my_query = new WP_Query( $args );
                	while ( $my_query->have_posts() ) : $my_query->the_post();
						$i++;
                		$termArray = array();
						// Pull category for each unique post using the ID 
                    	$terms = get_the_terms( get_the_ID(), 'portcat' );
                                
                    	if ( $terms && ! is_wp_error( $terms ) ) {
                        	$links = array();
                        
                        	foreach ( $terms as $term ) {
                            	$links[] = $term->name;
                        
                            	// build category array for links
                            	if (!array_key_exists($term->name, $termArray)) {
                                	$termArray[$term->name] = 1;
                            	} else {
                                	$termArray[$term->name] = $termArray[$term->name] + 1;
                            	}
                        	}
                    
                        	$tax_links = join( " ", str_replace(' ', '-', $links));
							$tax_display = join(" " , $links);
                        	$tax = strtolower($tax_links);
                    	} else {
                        	$tax = '';
                    	}

                    	$thumbnail = get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'thumbnail img-responsive'));
                    	//get post thumbnail id
                    	$image_id = get_post_thumbnail_id();
                    	//go get image attributes [0] => url, [1] => width, [2] => height
                    	$image_url = wp_get_attachment_image_src($image_id,'', true);
                    	$fullImageLink = $image_url[0];
                    	$permalink = get_the_permalink(get_the_ID());
                    	$title = get_the_title(get_the_ID());
                    	$date_value = get_the_time('Y-m-d H:i:s', get_the_ID());

                    	if ($themeSettings->has_featured_video(get_the_ID())) {
                        	$mediaLink = $themeSettings->get_featured_video_link(get_the_ID());
                        	$faClass = "fa fa-play";
                        	$fancybox = "fancybox fancybox-media";
                    	} else {
                        	$mediaLink = $fullImageLink;
                        	$faClass = "fa fa-camera";
                        	$fancybox = "fancybox";
                    	}
						/* Build the output, and Insert category name into portfolio-item class */
						if ($i > $limit) {   // don't populate if the limit's been met
							$portfolio .= '';
						} else {
                    		$portfolio .= '<div class="' . $cols . ' col-sm-6 all portfolio-item2">
                    		<div class="port-img">
                        		<div class="item-overlay">
                            		<div class="port-holder" data-name="' . $title . '">
                                		<div class="port-content">
                                    		<h6>' . $title . '</h6>
                                    		<a class="' . $fancybox . '" rel="' . $tax . '" title="' . $title
                                        		. '" href="' . $mediaLink . '">
                                        		<div class="port-link"> <i class="' . $faClass . '"></i> </div>
                                    		</a>
                                    		<a href="' . $permalink . '"><div class="port-zoom"><i class="fa fa-link"></i> </div></a>
                                    		<div class="port-desc">' . $tax_display . '</div>
                                		</div>
                            		</div>
                        		</div>' . $thumbnail .'</div>
                    		</div>';
						}
               		endwhile;
               		wp_reset_query();
            	}
        	} else {  // all portfolio categories

				$args = array(
    				'post_type' => 'portfolio_entry',
					'posts_per_page' => $limit,
				);
				$my_query = new WP_Query( $args );
				$termArray = array();

				while ( $my_query->have_posts() ) : $my_query->the_post();
					// Pull category for each unique post using the ID 
    				$terms = get_the_terms( get_the_ID(), 'portcat' );

    				if ( $terms && ! is_wp_error( $terms ) ) {

        				$links = array();

        				foreach ( $terms as $term ) {
            				$links[] = $term->name;

            				// build category array for links
            				if (!array_key_exists($term->name, $termArray)) {
                				$termArray[$term->name] = 1;
            				} else {
                				$termArray[$term->name] = $termArray[$term->name] + 1;
            				}
        				}

        				$tax_links = join( " ", str_replace(' ', '-', $links));
						$tax_display = join(" " , $links);
        				$tax = strtolower($tax_links);
    				} else {
        				$tax = '';
    				}

					$thumbnail = get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'thumbnail img-responsive'));
    				//get post thumbnail id
    				$image_id = get_post_thumbnail_id();
    				//go get image attributes [0] => url, [1] => width, [2] => height
    				$image_url = wp_get_attachment_image_src($image_id,'', true);
    				$fullImageLink = $image_url[0];
    				$permalink = get_the_permalink(get_the_ID());
    				$title = get_the_title(get_the_ID());
    				$date_value = get_the_time('Y-m-d H:i:s', get_the_ID());

    				if ($themeSettings->has_featured_video(get_the_ID())) {
        				$mediaLink = $themeSettings->get_featured_video_link(get_the_ID());
        				$faClass = "fa fa-play";
        				$fancybox = "fancybox fancybox-media";
    				} else {
        				$mediaLink = $fullImageLink;
        				$faClass = "fa fa-camera";
        				$fancybox = "fancybox";
    				}

					/* Build the output, and Insert category name into portfolio-item class */
    				$portfolio .= '<div class="' . $cols . ' col-sm-6 all portfolio-item2">
                	<div class="port-img">
                    	<div class="item-overlay">
                        	<div class="port-holder" data-name="' . $title . '">
                            	<div class="port-content">
                                	<h6>' . $title . '</h6>
                                	<a class="' . $fancybox . '" rel="' . $tax . '" title="' . $title
                                    	. '" href="' . $mediaLink . '">
                                    	<div class="port-link"> <i class="' . $faClass . '"></i> </div>
                                	</a>
                                	<a href="' . $permalink . '"><div class="port-zoom"><i class="fa fa-link"></i> </div></a>
                                	<div class="port-desc">' . $tax_display . '</div>
                            	</div>
                        	</div>
                    	</div>' . $thumbnail .'</div>
                	</div>';
				endwhile;
			} // end all categories

			$portfolio .= '
					</div>
				</div>
			</div>
			';

			wp_reset_query();
			return $portfolio;
		}


		/**
		  	Shortcode - Blog Grid
		**/
		public function bloggrid($atts, $content=NULL) {
			global $themeSettings;
			global $grid_needed;   // checked to load isotope in shortcode styles and check excerpt in theme settings
			$grid_needed = true;
			$clean = $this->removeTags($content);
			$content = do_shortcode($clean);
			extract(shortcode_atts(array(
				'perrow' => '2',
				'show' => '1',
				'categories' => ''
			), $atts));
			$limit = intval($show);
			$cols = 'col-md-3'; // default
			if ($perrow == '2') {
				$cols = 'col-md-6 col-sm-6';
			} elseif ($perrow == '3') {
				$cols = 'col-md-4 col-sm-6';
			} elseif ($perrow == '4') {
				$cols = 'col-md-3 col-sm-6';
			} elseif ($perrow == '5') {
				$cols = 'col-md-5ths col-sm-6';
			}

			ob_start();
			?>
			<div class="row">
        		<div class="col-md-12 no-padding">
            		<div class="sh-bloggrid">

			<?php
			// If they have categories selected
            if (trim($categories) != '') {  // query one or multiple portcats
                $i = 0;
                $cats = explode(',', $categories);
				$posts_shown = array();  // keep track of posts so we don't duplicate
                foreach ($cats as $cat) {
                    if ($i >= $limit) { continue; }
                    $args = array(
                        'post_type' => 'post',
                        'category_name' => $cat,
                        'posts_per_page' => $limit
                    );
					$my_query = new WP_Query($args);
                	if( $my_query->have_posts() ):
                    	$i = 0;
                    	while( $my_query->have_posts() ): $my_query->the_post();
							if (in_array(get_the_ID(), $posts_shown) ) { continue; }  // don't duplicate
                        	$i++;  // increment to cut at limit
                        	echo '<div class="' . $cols . ' grid-post">';
                        	?>
                                <?php get_template_part( 'loop', get_post_format() ); ?>
                                <?php echo "</div><!-- End Grid Post -->"; ?>
							<?php $posts_shown[] = get_the_ID(); ?>
							<?php if ($i >=$limit) { continue; } ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
					<?php wp_reset_postdata() ;?>
				<?php } // end foreach ?> 
					</div>
                    <div class="clearfix"></div>
				</div>
			</div>

			<?php
			} else {  // All posts

       			$args = array(
           			'post_type' => 'post',
					'posts_per_page' => $limit,
       			);
       			$my_query = new WP_Query($args);
          			if( $my_query->have_posts() ):
              			while( $my_query->have_posts() ): $my_query->the_post();
                  			echo '<div class="' . $cols . ' grid-post">';
							?>
                        		<?php get_template_part( 'loop', get_post_format() ); ?>
                        		<?php echo "</div><!-- End Grid Post -->"; ?>
                    		<?php endwhile; ?>
                	</div>
                	<div class="clearfix"></div>
                   		<?php endif; ?>
                   		<?php wp_reset_postdata() ;?>
        		</div>
    		</div>
			<?php 
			} // end All posts
			$output = ob_get_contents();
            ob_end_clean();
            return $output;
		}

	    /** 
            Shortcode - Callout Boxes
        **/
        public function callout($atts, $content=NULL) {
            $clean = $this->removeTags($content);
            $content = do_shortcode($clean);

            extract(shortcode_atts(array(
				'callouttype' => 'standard',
				'iconenable' => 'enable',
				'title' => __('Enter Your Title', 'shshortc'),

				'flipcolor' => '',
				'flipbgcolor' => '',
				'flipbordercolor' => '',
			
				'icon' => '',
				'iconset' => 'fontawesome',
                'iconfa' => 'fa fa-glass',
                'iconlinear' => 'icon-home',
                'iconion' => 'ion-alert',
				'iconspin' => '',
				'iconbgcolor' => '',
				'iconfontcolor' => '',

				'image' => '',
				'imageheight' => '',
				'imagewidth' => '',

				'bordercolor' => '',
				'borderradius' => '0px',
				'bordersize' => '0px',
				'fontcolor' => '',
				'backgroundcolor' => '',

				'buttonenable' => '',
				'buttontext' => '',
				'buttonlink' => '',
				'buttontarget' => '_blank',
				'buttonbgcolor' => '',
				'buttonfontcolor' => '',

				'btnbordercolor' => '#ffffff',
				'btnborderwidth' => '0px',
				'btnborderradius' => '0px',
				'fliptext' => ''
            ), $atts));

			// for pre 2.0 users
            if ($icon != '') {
                $icon = $icon;
            } else {

				if ($iconset == 'fontawesome') {
                	$icon = $iconfa;
            	} elseif ($iconset == 'linear') {
                	$icon = $iconlinear;
            	} elseif ($iconset == 'ion') {
                	$icon = $iconion;
            	}
			}

			// check for image post id from visual composer
			if (preg_match('/^\d+$/', $image, $matches)) {
				$img_attributes = wp_get_attachment_image_src($image, 'medium');
				$image_src = $img_attributes[0];
			} else {
				$image_src = $image;
			}


			// style
			$callout_style = ' style="border-color:' . $bordercolor . ';border-width:' . $bordersize 
				   . ';border-radius:' . $borderradius . '; color:' . $fontcolor . ';background-color:' 
				   . $backgroundcolor . ';" ';

			if ($callouttype == 'flip') {  // flip colors
				$flip_style = 'style="border-color:' . $flipbordercolor . ';border-width:' . $bordersize 
                   . ';border-radius:' . $borderradius . '; color:' . $flipcolor . ';background-color:' 
                   . $flipbgcolor . ';" ';
			}

			$h_style = ' style="color:' . $fontcolor . ';" ';
			$holder_border = ' style="border-radius:' . $borderradius . ';" ';
			
			// icons or images
			$icondiv = '';
			if ($iconenable == 'enable') {
				$spin = '';
				if ($iconspin == 'enable' && $iconset == 'fontawesome') {
					$spin = ' fa-spin';
				}
				$icon_style = ' style="color:' . $iconfontcolor . ';background-color:' . $iconbgcolor . ';"';
				$icondiv = '<div class="sh-callout-icon"' . $icon_style . '><i class="' . $icon . $spin . '"></i></div>';

			} elseif ($iconenable == 'image') { // Images instead of icons
				$icondiv = '<div class="sh-callout-image"><img class="img-responsive" src="' 
						 . $image_src . '" style="height:' . $imageheight . ';width:' . $imagewidth . ';" /></div>';
			}

			// buttons
			$button = '';
			if ($buttonenable == 'enable') {
				$btn_style = ' style="color:' . $buttonfontcolor . ';background-color:' . $buttonbgcolor . ';'
							. 'border: ' . $btnborderwidth . ' solid ' . $btnbordercolor . '; border-radius: ' 
							. $btnborderradius . ';"';
				$button = '<a class="sh-callout-btn" href="' . $buttonlink . '" target="' 
						. $buttontarget . '"' . $btn_style . '>' . $buttontext . '</a>';
			} 

			if ($callouttype == 'flip') {
            	$output = '<div class="sh-callout-holder ' . $callouttype . '"' 
					. $holder_border . ' ontouchstart="this.classList.toggle(\'hover\');">'
					. '<div class="sh-callout-inner flipper">'
					. '<div class="sh-front"' . $callout_style . '>'
					. $icondiv
					. '<span class="sh-callout-title"' . $h_style . '>' . $title . '</span>'
				 	. '<div class="sh-callout-content">' . $content . '</div></div>'

					. '<div class="sh-back" ' . $flip_style . '>'
					. '<div class="sh-callout-content">' . $fliptext . '</div>'
					. $button . '</div></div></div>';

			} elseif ($callouttype == 'standard') {
				$output = '<div class="sh-callout-holder ' . $callouttype . '"' . $holder_border . '>'
					. '<div class="sh-callout-inner"' . $callout_style . '>'
					. $icondiv
                    . '<span class="sh-callout-title"' . $h_style . '>' . $title . '</span>'
                    . '<div class="sh-callout-content">' . $content . '</div>'
					. $button . '</div></div>';
			}
            return $output;
        }

		/**
		  	Shortcode - Content Boxes
		**/
		public function content($atts, $content=NULL) {
			$content = $this->removeTags($content);
			$content = do_shortcode($content);
			extract(shortcode_atts(array(
				'style' => 'top',  // top or left
				'background' => 'true',
				'color' => '#555555',
				'readmorelink' => '',
				'readmoretext' => 'Read More <i class="fa fa-angle-right"> </i>',
				'target' => '_self',
				'choice' => 'icon',
				'image' => '',
				'icon' => '',
				'iconset' => 'fontawesome',
                'iconfa' => 'fa fa-glass',
                'iconlinear' => 'icon-home',
                'iconion' => 'ion-alert',
				'title' => '',
			
			), $atts));

			// for pre 2.0 users
            if ($icon != '') {
                $icon = $icon;
            } else {

				if ($iconset == 'fontawesome') {
                	$icon = $iconfa;
            	} elseif ($iconset == 'linear') {
                	$icon = $iconlinear;
            	} elseif ($iconset == 'ion') {
                	$icon = $iconion;
            	}
			}

			// check for image post id from visual composer
            if (preg_match('/^\d+$/', $image, $matches)) {
                $img_attributes = wp_get_attachment_image_src($image, 'medium');
                $image_src = $img_attributes[0];
            } else {
                $image_src = $image;
            }

			$imageIcon = '';
			if ($icon != '' && $choice != 'image') {
				$iconStyle = 'style="color:' . $color . ';border: 1px solid ' . $color . ';font-size:2em;display:inline-block;"';
				$imageIcon = '<div class="cb-ihold"><i class="cb-icon ' . $icon . '" ' . $iconStyle . '> </i></div>';
			} elseif ($image != '') {
				$imageIcon = '<div class="cb-ihold"><img class="cb-image" src="' . $image_src . '" /></div>';
			}

			$bgenable = '';
			if ($background == 'true') {
				$bgenable = '<div class="cb-bgenable"></div>';
			}

			$readLink = '';
			if ($readmorelink != '') {
				$readLink = '<span class="cb-link"><a href="' . $readmorelink . '" target="' . $target . '">' 
					. $readmoretext . '</a></span>';
			}

			$output = '<div class="sh-contentbox ' . $style . '" data-background="' . $color . '">' . $bgenable
				    . $imageIcon 
					. '<div class="cb-content"><h5 class="cb-title">' . $title . '</h5>' . $content . ' ' . $readLink . '</div></div>';

			return $output;
		}

		/**
		  	Shortcode - Font Awesome, Linear, and Ion icons
		**/
		public function font($atts, $content=NULL) {
			$clean = $this->removeTags($content);
			extract(shortcode_atts(array(
				'iconset' => 'fontawesome',
                'iconfa' => 'fa fa-glass',
                'iconlinear' => 'icon-home',
                'iconion' => 'ion-alert',
				'link' => '',
                'url' => '',
				'target' => '_blank',
				'size' => '',
				'enablecircle' => 'disable',
				'fontcolor' => '#555',
				'circlecolor' => '#fff',
				'bordercolor' => '#555',
				'spin' => 'disable',
            ), $atts));

			$fa_size = '';
            $hold_size = '';
			$font_size = '';

			 // for pre 2.0 users
            if ($content != '') {
                $icon = $content;
				if ($size != '') {
                    $fa_size = 'fa-' . $size;
                    $hold_size = 'size-' . $size;
                }
            } else {

				if ($iconset == 'fontawesome') {
                	$icon = $iconfa;
					if ($size != '') {
                		$fa_size = 'fa-' . $size;
                		$hold_size = 'size-' . $size;
            		}
            	} elseif ($iconset == 'linear') {
                	$icon = $iconlinear;
            	} elseif ($iconset == 'ion') {
                	$icon = $iconion;
            	}
			}

			// sizes for linear and ion
			if ($iconset == 'ion' || $iconset == 'linear') {
				if ($size != '') {
					$em_size = str_replace('x', '', $size);
					$font_size = 'font-size: ' . $em_size . 'em;';
					$hold_size = 'size-' . $size;
				}
			}

			if (!$icon) {         // for previous font awesome icons (pre Credence 2.0) 
				$icon = $content;
			}
				

			if ($enablecircle == 'enable') {
				$style = 'style="background-color:' . $circlecolor 
					   . '; border: 1px solid ' . $bordercolor . ';"';
				$fontstyle = 'style="color:' . $fontcolor . ';' . $font_size . '"';
			} else {
				$style = '';
				$fontstyle = 'style="color:' . $fontcolor . ';' . $font_size . '"';
			}

			if ($spin == 'enable') {
				$spin = 'fa-spin';
			} else {
				$spin = '';
			}

			if ($link == 'enable') {
				$output = '<a class="sh-fa ' . $hold_size . '" href="' . $url . '" target="' . $target . '" ' . $style . '>'
				 	. '<i class="' . $icon . ' ' . $fa_size . ' ' . $spin . '" ' . $fontstyle . '></i> </a>';
			} else {
				$output = '<span class="sh-fa ' . $hold_size . '" ' 
					    . $style . '><i class="' . $icon . ' ' .$fa_size . ' ' . $spin . '" ' . $fontstyle . '></i> </span>';
			}
			return $output;
		}

		/**
			Shortcode - Social Formatted Icons
		**/
		public function social($atts, $content=NULL) {
			$clean = $this->removeTags($content);
			extract(shortcode_atts(array(
				'icon' => '',
				'iconset' => 'fontawesome',
                'iconfa' => 'fa fa-glass',
                'iconlinear' => 'icon-home',
                'iconion' => 'ion-alert',
				'target' => '_new',
				'link' => '',
				'framed' => 'true',
				'size' => 'small',   // small, medium, large
				'radius' => '2px',
				'bgcolor' => 'rgba(0,0,0,0.15)',
				'fontcolor' => 'rgba(0,0,0,0.3)',
				'title' => '',
				'placement' => 'bottom'

			), $atts));

			// for pre 2.0 users
			if ($icon != '') {
				$icon = $icon;
			} else {
				if ($iconset == 'fontawesome') {
                	$icon = $iconfa;
            	} elseif ($iconset == 'linear') {
                	$icon = $iconlinear;
            	} elseif ($iconset == 'ion') {
                	$icon = $iconion;
            	}
			}


			$hoverColor = '';
			if ($framed == 'true') {
				$style = 'style="background-color:' . $bgcolor . ';color:' . $fontcolor . ';border-radius:' . $radius . ';"';
				$class = 'hover-enable sh-framed ' . $size;
				$bgcolorDark = $this->colorBrightness($bgcolor, -0.95);
				$hoverColor = ' data-hover="' . $bgcolorDark . '"';
			} else {
				$style = 'style="color:' . $fontcolor . ';"';
				$class = 'hover-text ' . $size;
				$fontcolorDark = $this->colorBrightness($fontcolor, -0.8);
				$hoverColor = ' data-textcolor="' . $fontcolorDark . '"';
			}

			$output = '<a class="sh-social sh-tooltip ' . $class . '" href="' . $link . '" target="' 
					. $target . '" title="' . $title . '" ' . $style . $hoverColor . ' data-placement="' 
					. $placement . '"> <i class="' . $icon . '"> </i></a>';
			return $output;
		}

		/** 
		    Shortcode - Center Container
		**/
		public function center($atts, $content=NULL) {
			$clean = $this->removeTags($content);
			$content = do_shortcode($clean);
			$output = '<div class="sh-center-container">' . $content . '</div>';
			return $output;
		}

		/**
		  	Shortcode - Columns
		**/
		public function columns($atts, $content=NULL) {
			global $column;
			$clean = $this->removeTags($content);
			$content = do_shortcode($clean);
			extract(shortcode_atts(array(
				'number' => '',
			), $atts));
			$col = 12;
			$type = '';
			switch ($number) {
				case 1:
					$col = 12;
					$type = 'even';
					break;
				case 2: 
					$col = 6;
					$type = 'even';
					break;
				case 3: 
					$col = 4;
					$type = 'even';
					break;
				case 4: 
					$col = 3;
					$type = 'even';
					break;
				case 6:
					$col = 2;
					$type = 'even';
					break;
				case 'one-third':
					$type = 'offset';
					break;
				case 'two-thirds':
					$type = 'offset';
					break;
				case 'one-quarter':
					$type = 'offset';
					break;
				case 'three-quarters':
					$type = 'offset';
					break;
				case 'middle-half':
					$type = 'offset';
					break;
			}

			$output = '<div class="row">';
			if ($type == 'even') { // standard layout break up
				for ($i = 0; $i < count($column); $i++) {
                	$output .= '<div class="col-md-'. $col . '"> ' . $column[$i] . '</div>';
           	 	}
			} else if ($type == 'offset') { // offset layouts
				if ($number == 'one-third') {
					$output .= '<div class="col-md-4">' . $column[0] . '</div>'
							. '<div class="col-md-8">' . $column[1] . '</div>';
				} elseif ($number == 'two-thirds') {
					$output .= '<div class="col-md-8">' . $column[0] . '</div>'
                            . '<div class="col-md-4">' . $column[1] . '</div>';
				} elseif ($number == 'one-quarter') {
					$output .= '<div class="col-md-3">' . $column[0] . '</div>'
                            . '<div class="col-md-9">' . $column[1] . '</div>';
				} elseif ($number == 'three-quarters') {
					$output .= '<div class="col-md-9">' . $column[0] . '</div>'
                            . '<div class="col-md-3">' . $column[1] . '</div>';
				} elseif ($number == 'middle-half') {
					$output .= '<div class="col-md-3">' . $column[0] . '</div>'
                            . '<div class="col-md-6">' . $column[1] . '</div>'
							. '<div class="col-md-3">' . $column[2] . '</div>';
				}
			}

            $output .= '</div>';

            $column = '';
            return $output;
        }
		
		/**
			Shortcode - Column
		**/
		public function column($atts, $content = NULL ) {
            $clean = $this->removeTags($content);
            $content = do_shortcode($clean);
            global $column;
            $column[] = $content;
        }

		/** 
		    Shortcode - Countdown
		**/
		public function countdown($atts, $content = NULL ) {
			$clean = $this->removeTags($content);
			$content = do_shortcode($clean);
			extract(shortcode_atts(array(
				'color' => '',
				'date' => '',
				'style' => ''
			), $atts));

			if ($style == 'tiles') { // different output for tiles
				$output = '<div class="sh-countdown-holder">
                        <ul class="sh-countdown ' . $style . '" style="color:' . $color . ';" data-date="' . $date . '">
                           <li class="timer">
                                <span class="days">00</span>
                                <p class="timeRef">' . __('Days', 'shshortc') . '</p>
                            </li>
							<li class="colons"><span class="colonhold">:</span></li>
                            <li class="timer">
                                <span class="hours">00</span>
                                <p class="timeRef">' . __('Hours', 'shshortc') . '</p>
                            </li>
							<li class="colons"><span class="colonhold">:</span></li>
                            <li class="timer">
                                <span class="minutes">00</span>
                                <p class="timeRef">' . __('Minutes', 'shshortc') . '</p>
                            </li>
							<li class="colons"><span class="colonhold">:</span></li>
                            <li class="timer">
                                <span class="seconds">00</span>
                                <p class="timeRef">' . __('Seconds', 'shshortc') . '</p>
                            </li>
                        </ul>
                    </div>';

			} else { // bordered and simple have the same structure

				$output = '<div class="sh-countdown-holder">
						<ul class="sh-countdown ' . $style . '" style="color:' . $color . ';" data-date="' . $date . '">
                           <li>
                             	<span class="days">00</span>
                             	<p class="timeRef">' . __('Days', 'shshortc') . '</p>
    						</li>
    						<li>
      							<span class="hours">00</span>
      							<p class="timeRef">' . __('Hours', 'shshortc') . '</p>
    						</li>
    						<li>
      							<span class="minutes">00</span>
      							<p class="timeRef">' . __('Minutes', 'shshortc') . '</p>
    						</li>
    						<li>
      							<span class="seconds">00</span>
      							<p class="timeRef">' . __('Seconds', 'shshortc') . '</p>
    						</li>
  						</ul>
					</div>';
			}

			return $output;
		}

		/**
			Shortcode - Dividers
		**/
		public function divider($atts, $content=NULL) {
			extract(shortcode_atts(array(
				'style' => 'none',
				'color' => 'rgba(0,0,0,0.15)',
				'shwidth' => 'wide',
				'spacetop' => '0px',
				'totop' => 'disable',
				'spacebottom' => '0px'
			), $atts));

			$totopDiv = '';
			if ($totop == 'enable') {
				$totopStyle = ' style="border: 1px solid ' . $color . ';color: ' . $color . ';"';
				$totopDiv = '<div class="totop-holder"><a class="toTop" title="' 
						. __("Return to Top", "shshortc") . '" ' . $totopStyle . '><i class="fa fa-angle-up"></i></a></div>';
			}

			if ($style == 'lookdown') {  // override any to top links
				$totopStyle = ' style="border: 1px solid ' . $color . '; color: ' . $color . ';"';

				$totopDiv = '<div class="lookdown-holder"><span class="look-down"' . $totopStyle 
						  . '><i class="fa fa-angle-down"></i></a></div>';
				$style = 'single';
	        }

			$lineColor = '';
			if ($style == 'single') {
				$lineColor = ' style="border-bottom: 1px solid ' . $color . '"';

			} elseif ($style == 'double') {
				$lineColor = ' style="border-top: 1px solid ' .$color
    						. '; border-bottom: 1px solid ' . $color . '"';

			} elseif ($style == 'dashed') {
				$lineColor = ' style="border-bottom: 1px dashed ' . $color . '"';

			} elseif ($style == 'doubledash') { 
				$lineColor = ' style="border-top: 1px dashed ' . $color
							. '; border-bottom: 1px dashed ' . $color . '"';
			} elseif ($style == 'dotted') {
				$lineColor = ' style="border-bottom: 2px dotted ' . $color . '"';

			} elseif ($style == 'doubledot') {
				$lineColor = ' style="border-top: 2px dotted ' . $color 
							. '; border-bottom: 2px dotted ' . $color . ';"';
			}

			$output = '<div class="sh-divider ' . $style . ' ' . $shwidth 
					. '" style="margin-top:' . $spacetop . ';margin-bottom:' . $spacebottom . '">'
					. '<div class="sh-line" ' . $lineColor . '>' . $totopDiv . '</div>'
					. '</div>';
			return $output;
		}

		/**
			Shortcode - Display Shortcode (doesn't interpret nested shortcodes and displays text)
		**/
		public function show_shortcode($atts, $content=NULL) {
			extract(shortcode_atts(array(
			), $atts));
			
			$output = '<pre><code>' . $content . '</code></pre>';
			return $output;
		}			

		/**
			Shortcode - Counter Milestones
		**/
		public function milestone($atts, $content=NULL) {
			$clean = $this->removeTags($content);
			$clean = $this->removeps($clean);
			$content = do_shortcode($clean);
			extract(shortcode_atts(array(
				'icon' => '',
				'iconset' => 'fontawesome',
                'iconfa' => 'fa fa-glass',
                'iconlinear' => 'icon-home',
                'iconion' => 'ion-alert',
				'color' => '#555555',
				'size' => 'small',
				'start' => '10',
				'stop' => '250',
				'speed' => '1500',
				'textbefore' => '',
				'textafter' => ''
			), $atts));

			// for pre 2.0 users
            if ($icon != '') {
                $icon = $icon;
            } else {
                if ($iconset == 'fontawesome') {
                    $icon = $iconfa;
                } elseif ($iconset == 'linear') {
                    $icon = $iconlinear;
                } elseif ($iconset == 'ion') {
                    $icon = $iconion;
                }
            }

			$icon_html = '';
			if ($icon) {
				$icon_html = '<i class="' . $icon . '" style="color:' . $color . ';"></i>';
			}

			$output = '<div class="sh-milestone ' . $size . '">'
					. $icon_html
					. '<div class="mile-right">'
					. '<div class="mile-count">' . $textbefore . '<span class="mile-number" '
					. 'data-start="' . $start . '" data-stop="' . $stop . '" data-speed="' . $speed . '">' . $start . '</span>' 
					. $textafter . '</div>'
					. '<span class="mile-sum">' . $content . '</span>'
					. '</div></div>';
			return $output;

		}

		/**
			Shortcode - Modals
		**/
		public function modal($atts, $content=NULL) {
			global $modalID;
			$clean = $this->removeTags($content);
			$content = do_shortcode($clean);
			extract(shortcode_atts(array(
				'title' => 'Modal',
				'openready' => 'disable', // Open on page load
				'modalsize' => 'small',
				'footer' => 'enable', // Enable the footer
				'buttontext' => __('Open Modal', 'shshortc'),
				'buttoncolor' => '#ffffff',
				'buttonborder' => '#555',
				'buttonborderradius' => '0px',
				'buttontextcolor' => '#555',
				'buttonborderwidth' => '2px',
				'modalbg' => '#fff',
				'modalborder' => 'rgba(0,0,0,0.2)',
				'modalfont' => '#555'
            ), $atts));

			$modalID++;
			$output = '';

			$hoverColor = $this->colorBrightness($buttoncolor, -0.95);

			// button styles
			$buttonStyle = 'style="color:' . $buttontextcolor . ';background-color:' 
				. $buttoncolor . ';border:' . $buttonborderwidth . ' solid ' . $buttonborder 
				. ';border-radius:' . $buttonborderradius . '"';

			$modalStyle = 'style="color:' . $modalfont . '; background-color:' . $modalbg 
				. ';border:1px solid ' . $modalborder . '"'; 

			$modalHeaderStyle = 'style="border-bottom: 1px solid ' . $modalborder . ';"';
			$modalFooterStyle = 'style="border-top: 1px solid ' . $modalborder . ';"';
			$modalHStyle = 'style="color:' . $modalfont . ';"';

			if ($openready == 'enable') {      // Open on Window load, no button
				$open = 'openready';
			} else {
				$output .= '<button class="sh-btn btn-primary hover-enable" data-hover="' 
					. $hoverColor . '" data-toggle="modal" data-target=".sh-modal-' 
					. $modalID . '" ' . $buttonStyle . '>' . $buttontext . '</button>';
				$open = '';
			}

			if ($modalsize == 'large') {       // Size
				$sizeClass = 'modal-lg';
			} else {
				$sizeClass = 'modal-sm';
			}

			if ($footer == 'enable') {         // Footer
				$footerCont = '<div class="modal-footer" ' . $modalFooterStyle . '>'
					. '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div>';
			} else {
				$footerCont = '';
			}
			// The actual modal
			$output .= '<div class="sh-modal sh-modal-' . $modalID . ' ' . $open 
					. ' modal fade" role="dialog" tabindex="-1" aria-labelledby="modalLabel-' . $modalID . '">'
					. '<div class="modal-dialog ' . $sizeClass . '">'
					. '<div class="modal-content" ' . $modalStyle . '>'
					. '<div class="modal-header" ' . $modalHeaderStyle . '>'
					. '<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>'
					. '<span class="sr-only">Close</span></button>'
					. '<h5 class="modal-title" ' . $modalHStyle . ' id="modalLabel-' . $modalID . '">' . $title . '</h5>'
					. '</div>'
					. '<div class="modal-body">' . $content . '</div>'
					. $footerCont
					. '</div></div></div>';
			return $output;
		}


		/**	
		  	Shortcode - Checklists
		**/
		public function checklist($atts, $content=NULL) {
			global $checklist_items;
			$clean = $this->removeTags($content);
			$content = do_shortcode($clean);
			extract(shortcode_atts(array(
                'type' => 'unordered',
				'icon' => '',
				'iconset' => 'fontawesome',
                'iconfa' => 'fa fa-glass',
                'iconlinear' => 'icon-home',
                'iconion' => 'ion-alert',
				'background' => 'disable',
				'number' => '',
				'customcolor' => 'false',
				'backgroundcolor' => '',
				'fontcolor' => ''
            ), $atts));

			// for pre 2.0 users
            if ($icon != '') {
                $icon = $icon;
            } else {
                if ($iconset == 'fontawesome') {
                    $icon = $iconfa;
                } elseif ($iconset == 'linear') {
                    $icon = $iconlinear;
                } elseif ($iconset == 'ion') {
                    $icon = $iconion;
                }
            }

			$style = '';
			$customclass = '';
			$inlineStyle = ''; // For ol lists, have to do inline style...sigh
			if ($type == 'unordered') { 
				$list = 'ul'; 
				$iconSet = $icon;
				if ($customcolor == 'true') {
                    $style = 'data-background="' . $backgroundcolor . '" data-color="' . $fontcolor . '"';
                    $customclass = 'custom';
                }
			} else { 
				$list = 'ol'; 
				$iconSet = '';
				if ($customcolor == 'true') {
					$length = 10;
					// generate random class name in case of more than one list on a page, style will only apply to this one
					$randomString = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
					$inlineStyle = '<style> ol.sh-checklist.background.' . $randomString 
						. ' li:before { background-color:' . $backgroundcolor . ';color:' . $fontcolor . ';}</style>';
					$customclass = $randomString;
				}
			}
			if ($background == 'enable') {
				$bgClass = 'background';
			} else {
				$bgClass = '';
			}


			$output = '<' . $list . ' class="sh-checklist ' . $bgClass . ' ' . $customclass . '" ' . $style . '>';

			for ($i = 0; $i < count($checklist_items); $i++) {
				$output .= '<li><i class="' . $iconSet . '"></i> ' . $checklist_items[$i] . '</li>';
			}
			$output .= '</' . $list . '>' . $inlineStyle;

			$checklist_items = '';
			return $output;
		}


		public function checklist_item($atts, $content = null ) {
			$clean = $this->removeTags($content);
            $content = do_shortcode($clean);
			global $checklist_items;
			$checklist_items[] = $content;
		}

		/**
			Shortcode - Headers
		**/
		public function header($atts, $content=NULL) {
            $clean = $this->removeTags($content);
            $content = do_shortcode($clean);

            extract(shortcode_atts(array(
                'size' => 'h1',
				'header' => 'abc123',
				'type' => 'underline',
				'color' => '#555',
				'colorchange' => 'disable',
				'barwidth' => '200px',
				'barheight' => '2px',
				'barcolor' => '#555'
            ), $atts));

			$halfbar = intval($barwidth / 2);
			$halfway = '-' . ceil($halfbar) . 'px';

			$style = '';
			$bar = '';
			if ($colorchange == 'enable') {
				$style = ' style="color:' . $color . ';border-color:' . $color . ';"';
			}
		
			if ($type == 'boxed') {
				$output = '<div class="section-holder" ' . $style . '>'
                    . '<' . $size . ' class="section-title ' . $type . '"' . $style . '>' . $header . '</' . $size . '>'
                    . '</div>';
			} else {            // default, underlined
				$bar = ' style="background-color:' . $barcolor . '; width: ' . $barwidth
                    .'; height:' . $barheight . ';margin-left:' . $halfway . ';"';
				$output = '<div class="section-holder" ' . $style . '>'
                    . '<' . $size . ' class="section-title"' . $style . '>' . $header . '</' . $size . '>'
                    . '<div class="section-bar" ' . $bar . '></div>'
                    . '<p>' . $content . '</p>'
                    . '</div>';
			}

            return $output;
        }

		/** 
			Shortcode - Headers double line
		**/
		public function headerdouble($atts, $content=NULL) {
            $clean = $this->removeTags($content);
            $content = do_shortcode($clean);

            extract(shortcode_atts(array(
                'size' => 'h1'
            ), $atts));
            $output = '<div class="head-double">'
                    . '<' . $size . ' class="header">' . $content . '</' . $size . '>'
					. '<div class="headerbars-holder"><div class="headerbars"></div></div>'
                    . '</div>';

            return $output;
        }

		/* Color Background Section Shortcode - arrows can overlap other sections */
		public function colorbg($atts, $content=NULL) {
			extract(shortcode_atts(array(
                'fontcolor' => '#ffffff',
                'backgroundcolor' => 'rgba(0,0,0,1)',   // for color over images
                'arrow' => 'none',
            ), $atts));
			$content = $this->removeTags($content);
            $content = do_shortcode($content);

			// arrow style
            $arrow_div = '';
            if ('top' == $arrow) {
                $arrow_div = '<div class="sh-color-toparrow" style="background-color: ' . $backgroundcolor . '"></div>';
            } elseif ('bottom' == $arrow) {
                $arrow_div = '<div class="sh-color-bottomarrow" style="background-color: ' . $backgroundcolor . '"></div>';
            }

            $backgroundStyle = 'style="background-color:' . $backgroundcolor . ';"';
            $output = '<div class="sh-colorbg" '
                    . ' data-color="' . $fontcolor . '">'
                    . '<div class="sh-colorbg-overlay" ' . $backgroundStyle . '></div>'
                    . '<div class="nested-container"  style="color:' . $fontcolor . ';">' 
					. $content . '</div>' . $arrow_div . '</div>';

            return $output;
		}

		/* Image Background Section Shortcode */
		public function imagebg($atts, $content=NULL) {
			extract(shortcode_atts(array(
				'fontcolor' => '#fff',
                'overlaycolor' => 'rgba(0,0,0,0.33)',   // for color over images
                'background' => '',
				'bgrepeat' => 'cover',
				'arrow' => 'none',
            ), $atts));
            $content = $this->removeTags($content);
            $content = do_shortcode($content);

			// background image position
			$repeat = '';
			if ($bgrepeat == 'cover') {
				$repeat = ' background-repeat: no-repeat; background-position: center top; background-size: cover;';
			} 
			$backgroundStyle = 'style="background-image: url(\'' . $background . '\'); color:' . $fontcolor . ';' . $repeat . '"';

			// arrow style
			$arrow_div = '';
			if ('top' == $arrow) {
				$arrow_div = '<div class="sh-toparrow"></div>';
			} elseif ('bottom' == $arrow) {
				$arrow_div = '<div class="sh-bottomarrow"></div>';
			} 

			$overlayStyle = 'style="background-color:' . $overlaycolor . ';"';
			$output = '<div class="sh-imagebg" ' . $backgroundStyle
					. ' data-color="' . $fontcolor . '">'
					. '<div class="sh-imagebg-overlay" ' . $overlayStyle . '></div>'
					. '<div class="nested-container" style="color:' . $fontcolor . ';">' 
					. $content . '</div>' . $arrow_div . '</div>';

			return $output;
		}
			
		/* People Shortcode - uses custom post type 'people' */
		public function people( $atts, $content = NULL ) {
			extract(shortcode_atts(array(
				'postid' => '2890',
			), $atts));
			if ($postid) {
				$person = get_post($postid);
				$meta_values = get_post_meta( $postid );
				$name = $meta_values['person_name'][0];
				$title = $meta_values['person_title'][0];
				$person_link = $meta_values['person_link'][0];
				$quickinfo = $meta_values['person_quick'][0];
				$social_icon = get_post_meta( $postid, 'social_icon', true);
                $social_link = get_post_meta( $postid, 'social_link', true);
				$link = get_permalink($postid);

				$image = '';
				if ( get_the_post_thumbnail( $postid, 'full' )) { 
					$image = get_the_post_thumbnail( $postid, 'full' );
				}

				if ($person_link == 'enable') { // show links to full page
					$headerBoxed = '<div class="section-holder"><h6 class="section-title boxed">' 
								. __('Full Profile', 'shshortc') . '</h6></div>';

					$imagediv = '<div class="person-img">' . $image 
						      . '<div class="person-link"><a href="' . $link
							  . '">' . $headerBoxed . '</a></div></div>';
					$namespan = '<span class="person-name"><a href="' . $link . '">' . $name . '</a></span>'; 
				} else {
					$imagediv = '<div class="person-imgno">' . $image . '</div>';
					$namespan = '<span class="person-name">' . $name . '</span>';
				}

				
				$output = '<div class="sh-person">' . $imagediv
						. '<div class="person-info">'
						. '<div class="person-desc">' . $namespan . '<span class="person-title">' 
						. $title . '</span></div><div class="person-social">';
				$i = 0;
                foreach ($social_icon as $key => $soc) {
                    $output .= '<a href="' . $social_link[$i] . '" target="new"><i class="fa ' . $soc . ' fa-2x"></i></a>';
					$i++;
				}
				
				$output .= '</div></div><div class="person-content">' 
					. $quickinfo . '</div></div>';
				return $output;
			}
		}

		/* Pricing Tables */

		public function p_table( $atts, $content = null ) {
			global $ptable;
			global $pclass;  //  style of table
			global $pcolcount;
			global $pcoltotal;
			extract(shortcode_atts(array(
                'columns' => '3',   // default
				'style' => 'color', // default
            ), $atts));

			$pcoltotal = $columns;
			if ($style == 'light') {
				$pclass = 'sh-price-table2';
			} else {
				$pclass = 'sh-price-table';
			}

			$columnsClass = '';
            switch ($columns) {
				case '1':
					$columnsClass .= 'one-column-table';
					break;
                case '2':
                    $columnsClass .= 'two-column-table';
                    break;
                case '3':
                    $columnsClass .= 'three-column-table';
                    break;
                case '4':
                    $columnsClass .= 'four-column-table';
                    break;
                case '5':
                    $columnsClass .= 'five-column-table';
                    break;
                case '6':
                    $columnsClass .= 'six-column-table';
                    break;
            }
			$content = $this->removeTags($content);
			do_shortcode($content);
			$columnContent = '';
			// create the columns
			if (is_array($ptable)) {
                // loop through column content
                foreach ($ptable as $k => $v) {
					$columnContent .= $v;
                }
                // put all the parts together
                $finished_table = '<div class="' . $pclass . ' ' . $columnsClass . '">'
								. $columnContent . '</div><div class="clear"></div>';
            }
            $ptable = '';
			$pcolcount = 0;
            return $finished_table;
		}


		// Pricing Columns
		public function p_col( $atts, $content = null ) {
			global $ptable;
			global $pclass;
			global $pcolcount;
			global $pcoltotal;
			extract(shortcode_atts(array(
                'title' => '',
                'highlight' => 'false',
				'colcolor' => '',
				'cost' => '',
				'tag' => '',
				'btntext' => '',
				'btnlink' => '',
				'btntarget' => ''
            ), $atts));

			$pcolcount++;  // track column number

			if ($btntarget == 'self') {
				$btntarget = '_self';
			} elseif ( $btntarget == 'new') {
				$btntarget = '_new';
			}

			$highlight = strtolower($highlight);
			$highlight = ( $highlight == 'true') ? true : false;

			$colClass = 'price-column';
            $colClass .= ( $pcolcount % 2 ) ?  '' : ' even-column';
            $colClass .= ( $highlight ) ?  ' highlight-column' : '';
            $colClass .= ( $pcolcount == $pcoltotal ) ?  ' last-column' : '';
            $colClass .= ( $pcolcount == 1 ) ?  ' first-column' : '';

			$content = $this->removeTags($content);
            $content = do_shortcode($content);

			$darken = $this->colorBrightness($colcolor, -0.9);
           	$darkenMore = $this->colorBrightness($colcolor, -0.6);

			if ($pclass == 'sh-price-table') {                                         // colored columns
				$style = 'style="background-color:' . $colcolor . ';"';
				$bordStyle = 'style="border:1px solid ' . $colcolor . ';"';
				$holdStyle = 'style="border-bottom:3px solid ' . $colcolor . ';"';
				$tagDiv = '';

				if (trim($tag) != '') {
					$tag = $this->removeTags($tag);
					$tagDiv = '<div class="tag-hold" style="border-color:' 
						. $darkenMore . ' ' . $darkenMore . ' transparent transparent;"><span>' . $tag . '</span></div>';
				}

				$column = '<div class="'. $colClass . '">'
					. '<div class="column-title" ' . $style . '>' 
					. $title . $tagDiv . '</div>'

					. '<div class="price-info"><div class="cost" ' . $style . '>' . $cost . '</div></div>'
					. '<div class="pholder" ' . $holdStyle . '">'
					. '<div class="pcontent" ' . $bordStyle . '>' . $content

					. '<a class="btn hover-enable" target="' . $btntarget . '" href="' . $btnlink
					. '" style="color:#fff;background-color:' . $colcolor 
					. ';" data-hover="' . $darken . '">' . $btntext . '</a>' 
					. '</div></div></div>';
			} else {                                                         // light columns
				$bordStyle = 'style="border:1px solid rgba(0,0,0,0.15);"';
				$style = '';
                $holdStyle = '';

                $tagDiv = '';
                if (trim($tag) != '') {
                    $tag = $this->removeTags($tag);
                    $tagDiv = '<div class="tag-hold" style="border-color:'
                        . $colcolor . ' ' . $colcolor . ' transparent transparent;"><span>' . $tag . '</span></div>';
                }

                $column = '<div class="'. $colClass . '">'
						. '<div class="column-holder">'
                    . '<div class="column-title" ' . $style . '>'
                    . $title . $tagDiv . '</div>'

                    . '<div class="price-info"><div class="cost" ' . $style . '>' . $cost . '</div></div>'
                    . '<div class="pholder" ' . $holdStyle . '">'
                    . '<div class="pcontent" ' . $bordStyle . '>' . $content

                    . '<a class="btn hover-enable" target="' . $btntarget . '" href="' . $btnlink
                    . '" style="color:#fff;background-color:' . $colcolor
                    . ';" data-hover="' . $darken . '">' . $btntext . '</a>'
                    . '</div></div></div></div>';
			}

            $ptable[] = $column;
		}

		// Tables each row has double comma seperated values
		public function table($atts, $content = null) {
			global $sh_head;
			global $sh_row;
			global $row_count;

			$sh_head = array();
			$sh_row = array();
			$row_count = 1;
			extract(shortcode_atts(array(
				'columns' => 4,
				'style' => '',
				'tr_bgcolor' => '#f9f9f9',
            	'tr_altbgcolor' => '#ffffff',
            	'hovercolor' => '#f5f5f5',
            	'bordercolor' => '#dddddd',
			), $atts));
			$content = $this->removeTags($content);
			$content = do_shortcode($content);

			$border = 'border: 0;';
        	if ($style == 'bordered') {
            	$border = 'border: 1px solid ' . $bordercolor . ';';
        	}			
	
			$output = '<div class="table-responsive"><table class="sh-table table">';
			$i = 0;
			if (!empty($sh_head)) {
				foreach ($sh_head as $k => $v) {
					$i++;
                	// background select
                	if ($i % 2 == 0) { $trbg = $tr_altbgcolor; } else { $trbg = $tr_bgcolor; }
                	$output .= '<tr style="background-color:' . $trbg . ';" data-hover="'
                        	. $hovercolor . '" data-background="' . $trbg . '">';
                	foreach ($v as $row => $val) {
                    	$output .= '<th style="' . $border . '">' . $val . '</th>';
                	}
                	$output .= '</tr>';
            	}
			}

			if (!empty($sh_row)) {
				foreach ($sh_row as $k => $v) {
					$i++;
                	// background select
                	if ($i %2 == 0) { $trbg = $tr_altbgcolor; } else { $trbg = $tr_bgcolor; }
                	$output .= '<tr style="background-color:' . $trbg . ';" data-hover="'
                        	. $hovercolor . '" data-background="' . $trbg . '">';
                	foreach($v as $row => $val) {
                    	$output .= '<td style="' . $border . '">' . $val . '</td>';
                	}
                	$output .= '</tr>';
				}
			}
			$output .= '</table></div>';
			return $output;
		}

		// table head
		public function t_head($atts, $content = null) {
			global $sh_head;
			global $row_count;
			$row_count++;
			extract(shortcode_atts(array(
            ), $atts));
            $content = $this->removeTags($content);

			$sh_head[$row_count] = explode(',,', $content);
		}

		// table row
		public function t_row($atts, $content = null) {
			global $sh_row;
			global $row_count;
			extract(shortcode_atts(array(
            ), $atts));
            $content = $this->removeTags($content);

			$row_count++;
			$sh_row[$row_count] = explode(',,', $content);
		}


		// Testimonial Carousel
		public function testimonialc($atts, $content=NULL) {
			global $carousel;
			global $testimonials;
			$carousel = true;
			extract(shortcode_atts(array(
                'pause' => '5000',
                'control' => 'false',
                'transition' => 'fade', // horizontal, vertical, or fade
				'adapt' => 'true'       // auto adapt slide height
            ), $atts));
			$content = $this->removeTags($content);
            $content = do_shortcode($content);

			$output = '<ul class="sh-testimonials" data-pause="' . $pause . '" data-mode="' . $transition 
				. '" data-adapt="' . $adapt . '">';
			foreach ($testimonials as $k => $v) {
				$output .= '<li>' . $v . '</li>';
			}
			$output .= '</ul><div class="slide-prev"></div><div class="slide-next"></div>';
			$testimonials = ''; // clear out for other slideshows
			$carousel = false;
			return $output;
		}


		// Testimonial Individual
		public function testimonial($atts, $content=NULL) {
			global $carousel;
			global $testimonials;
			extract(shortcode_atts(array(
                'name' => '',
                'title' => '',
                'image' => '', 
                'icon' => '',

				'fontcolor' => '#828282',
				'bgcolor' => '#f6f6f6',
				'bordercolor' => '#c8c8c8'
            ), $atts));
            $content = $this->removeTags($content);
            $content = do_shortcode($content);

			$imageSrc = '';
			if ($image != '') {
				$imageSrc = '<img class="test-img" src="' . $image . '" />';
			}

			$style = 'style="color:' . $fontcolor . ';background-color:' . $bgcolor . ';border: 1px solid ' . $bordercolor . ';"';
			$testArrow = 'style="border-top: 10px solid ' . $bgcolor . ';"';
		    $testArrowB = 'style="border-top: 10px solid ' . $bordercolor . ';"';

			$output = '<div class="sh-testimonial">'
					. '<blockquote class="the-testimonial border-testimonial" ' . $style . '>' 
					. $content 
					. '<div class="test-arrow-border test-arrow" ' . $testArrowB . '></div>'
                	. '<div class="test-arrow" ' . $testArrow . '></div>'
					. '</blockquote>'
					. $imageSrc . '<div class="person">' . $name . '<span class="title">' . $title . '</span></div>'
					. '</div>';

			if ($carousel) {
                $testimonials[] = $output;
			} else {
				return $output; 
			}

		}


		// Parallax and Video background
		public function parallax($atts, $content = null) {
			extract(shortcode_atts(array(
				'backgroundchoice' => '',
				'bgcolor' => '',
				'overlaycolor' => 'rgba(0,0,0,0.33)',   // for color over images
				'fontcolor' => '',
				'background' => '',
				'videourlmp4' => '',
				'videourlwebm' => '',
				'bottomshadow' => '', 
			), $atts));
			$content = $this->removeTags($content);
            $content = do_shortcode($content);

			$sclass = ''; // shadow class - only applies to image and background color sections
			if ($bottomshadow == 'enable') {
				$sclass = 'shadow-section';
			}

			if ($backgroundchoice == 'solid') {  // Solid Background
				$output = '<div class="sh-solidbg ' . $sclass . '" style="background-color:' . $bgcolor 
						. ';color:' . $fontcolor . ';" data-color="' . $fontcolor . '">'
						. '<div class="nested-container">' . $content . '</div></div>';

			} elseif ($backgroundchoice == 'parallax') { // Parallax
				$overlayStyle = 'style="background-color:' . $overlaycolor . ';"'; 
                $output = '<div class="sh-parallax ' . $sclass . '"'
						. ' style="background-image: url(\'' . $background . '\'); color:' . $fontcolor . '"'
						. ' data-color="' . $fontcolor . '">' 
                        . '<div class="sh-parallax-overlay" ' . $overlayStyle . '></div>'
                        . '<div class="nested-container">' . $content . '</div></div>';

			} elseif ($backgroundchoice == 'fixed') { // Fixed BG
            	$overlayStyle = 'style="background-color:' . $overlaycolor . ';"';
            	$output = '<div class="sh-fixed ' . $sclass . '"'
                    . ' style="background-image: url(\'' . $background_src . '\'); background-attachment: fixed;'
                    . ' color:' . $fontcolor . '"'
                    . ' data-color="' . $fontcolor . '">'
                    . '<div class="sh-fixed-overlay" ' . $overlayStyle . '></div>'
                    . '<div class="nested-container">' . $content . '</div></div>';

			} elseif ($backgroundchoice == 'video') {  // Video display
				$overlayStyle = 'style="background-color:' . $overlaycolor . ';"';
				$mp4 = '';
				$webm = '';
				$poster = '';
				if ($videourlmp4 != '') {
					$mp4 = '<source src="' . $videourlmp4 . '" type="video/mp4">';
				}
				if ($videourlwebm != '') {
					$webm = '<source src="' . $videourlwebm . '" type="video/webm">';
				}
				if ($background != '') {
                	$poster = 'poster="' . $background . '"';
            	}

				$output = '<div class="sh-video" style="background-image: url(\'' . $background . '\');color:' 
						. $fontcolor . '" data-color="' . $fontcolor . '">'
						. '<video autoplay loop ' . $poster . ' class="backgroundvid">'
						. $webm
                        . $mp4
                        . '</video>'
						. '<div class="sh-video-overlay" ' . $overlayStyle . '></div>'
                    	. '<div class="nested-container">' . $content . '</div></div>';
			}
			return $output;
	    }		

		// Popovers
		public function popover($atts, $content = null) {
			global $popoverCount;
			extract(shortcode_atts(array(
				'placement' => 'top',
				'pcontent' => __('the text', 'shshortc'),
				'title' => __('the title', 'shshortc'),
				'trigger' => 'hover',
				'colorchange' => 'disable',
				'titlecolor' => '#6d6d6d',
				'titlebgcolor' => '#fff',
				'bgcolor' => '#fff',
				'fontcolor' => '6d6d6d',
				'bordercolor' => 'rgba(0,0,0,0.25)'

			), $atts));
			$popoverCount++;
			$content = $this->removeTags($content);
			$content = do_shortcode($content);

			if ($colorchange == 'enable') {
				$style = '<style>'
					   . '.popover-' . $popoverCount . ' {color:' . $fontcolor . ';background-color: ' 
						   . $bgcolor . ';border:none;padding: 0;}'
					   . '.popover-' . $popoverCount . ' .popover-title { color:' . $titlecolor 
						   . ';background-color: ' . $titlebgcolor . ';border-bottom:1px solid ' . $bordercolor . ';}'
					   . '.popover-' . $popoverCount . ' {border: 1px solid '. $bordercolor .';}'
					   . '.popover-' . $popoverCount . '.' . $placement . ' .arrow { border-' 
							 . $placement . '-color: ' . $bordercolor . ';}'
					   . '.popover-' . $popoverCount . '.' . $placement 
							 . ' .arrow:after {border-' . $placement . '-color:' . $bgcolor . ';}'
					   . '</style>';
			} else {
				$style = '';
			}

			$output = '<span class="sh-popover" data-custclass="popover-' . $popoverCount 
					. '" data-placement="' . $placement . '" data-content="' 
				    . $pcontent . '" data-trigger="' . $trigger . '" title="' . $title . '">' . $content . '</span>';

			$output .= $style;  // add our styles
			return $output;
		}

		// Sitemaps
        public function sitemap($atts, $content = null) {
            extract(shortcode_atts(array(
				'show_pages' => 'true',
                'show_posts' => 'true',
               	'show_cpts' => 'true',
				'show_select' => 'true',  // show dropdowns or not
				'pages_default' => 'post_title',
				'posts_default' => 'title',
				'exclude_ids' => '',   // comma seperated exclude list e.g. '35,1776'
            ), $atts));

			// decide on column width (if more than one choice col-md-6)
			if ( ($show_pages == 'true' && $show_posts == 'false' && $show_cpts == 'false')
				|| ($show_pages == 'false' && $show_posts == 'true' && $show_cpts == 'false')		
				|| ($show_pages == 'false' && $show_posts == 'false' && $show_cpts == 'true') 
			) {
				$col = 'col-md-12';
			} else {
				$col = 'col-md-6';
			}
			
			// handle posts
			if (isset($_POST['pages_default'])) {
                $pages = sanitize_text_field($_POST['pages_default']);
                $pages_default = $pages;
            }

			if (isset($_POST['posts_default'])) {
				$posted = sanitize_text_field($_POST['posts_default']);
				$posts_default = $posted;
			}

			ob_start(); // start output caching 

			// Page query args 
			if ( $pages_default == "post_title" ) {
				$page_params = 'menu_order, post_title';
			} else {
				if ( $pages_default == "post_date" ) {
					$page_params = 'post_date';
				} else {
					$page_params = 'post_author';
				}
			}

			$page_args = array( 'sort_column' => $page_params, 'title_li' => '' );
			if ( ! empty( $exclude_ids ) ) {
				$page_args['exclude'] = $exclude_ids;
			}

			// Post query args from Plugin options
			if ( $posts_default == "title" ) {
				$post_params = 'title';
			} else {
				if ( $posts_default == "date" ) {
					$post_params = 'date';
				} else {
					if ( $posts_default == "author" ) {
						$post_params = 'author';
					} else {
						if ( $posts_default == "category" ) {
							$post_params = 'category';
						} else {
							$post_params = 'tags';
						}
					}
				}
			}

			$post_args = array( 'orderby' => $post_params, 'posts_per_page' => - 1, 'order' => 'asc' );

			?>

			<div class="sh-sitemap row">

			<?php // RENDER SITEMAP PAGES ?>

			<?php if ( isset( $show_pages ) && $show_pages == 'true' ) : ?>
				<div id="sh-pages" class="<?php echo $col; ?>">
					<?php echo do_shortcode('[sh_headerdouble size="h4"]' . __('Pages', 'shshortc') .'[/sh_headerdouble]');?>
					
					<?php if ($show_select == 'true') { ?>
					<form method="post" action="" class="sitemap-page-sort">
						<?php echo __('Show Pages by ', 'shshortc'); ?>
						<input type="hidden" name="posts_default" value="<?php echo $posts_default;?>" />
						<select class="sitemap-page-options" name='pages_default'>
							<option value='post_title' <?php selected( 'post_title', $pages_default ); ?>>
								<?php echo __('Title', 'shshortc');?></option>
							<option value='post_date' <?php selected( 'post_date', $pages_default ); ?>>
								<?php echo __('Date', 'shshortc');?></option>
							<option value='post_author' <?php selected( 'post_author', $pages_default ); ?>>
								<?php echo __('Author', 'shshortc');?></option>
						</select>
					</form>
					<?php } ?> 
					<?php
					if ( strpos( $page_params, 'post_date' ) !== false ) {
						echo '<ul class="page_item_list">';
						$page_args = array( 'sort_order' => 'desc', 'sort_column' => 'post_date', 'title_li' => '' );
						if ( ! empty( $exclude_ids ) ) {
							$page_args['exclude'] = $exclude_ids;
						}
						wp_list_pages( $page_args ); // show the sorted pages
						echo '</ul>';
					} elseif ( strpos( $page_params, 'post_author' ) !== false ) {
						$authors = get_users(); //gets registered users
						foreach ( $authors as $author ) {
							$empty_page_args = array( 'echo' => 0, 'authors' => $author->ID, 'title_li' => '' );
							$empty_test      = wp_list_pages( $empty_page_args ); // test for authors with zero pages

							if ( $empty_test != null || $empty_test != "" ) {
								echo "<div class='page-author'><span class='topsection'>$author->display_name</span></div>";
								echo "<div class='toc-date-header'><ul class=\"page_item_list\">";
								$page_args = array( 'authors' => $author->ID, 'title_li' => '' );
								if ( ! empty( $exclude_ids ) ) {
									$page_args['exclude'] = $exclude_ids;
								}
								wp_list_pages( $page_args );
								echo "</ul></div>";
							} else {
								echo "<div class='page_author'><span class='topsection'>$author->display_name</span>"
									. " <span class='toc-sticky'>(no pages published)</span></div>";
							}
						} 
					} else { /* default = title */
						echo '<ul class="page_item_list">';
						wp_list_pages( $page_args ); /* Show sorted pages with default $page_args. */
						echo '</ul>';
					}
					?>
				</div>
			<?php endif; ?>
			<?php // RENDER SITEMAP POSTS ?>
			<?php if ( isset( $show_posts ) && $show_posts=='true' ) : ?>
				<div id="sh-posts" class="<?php echo $col;?>">
					<?php echo do_shortcode('[sh_headerdouble size="h4"]' . __('Posts', 'shshortc') .'[/sh_headerdouble]');?>
					<?php if ($show_select == 'true') { ?>
					<form method="post" action="" class="sitemap-post-sort">
						<?php echo __('Show Posts By', 'shshortc');?> 
						<input type="hidden" name="pages_default" value="<?php echo $pages_default;?>" />
						<select class="sitemap-post-options" name='posts_default'>
                    		<option value='title' <?php selected( 'title', $posts_default ); ?>>
								<?php echo __('Title', 'shshortc');?></option>
                    		<option value='date' <?php selected( 'date', $posts_default ); ?>>
								<?php echo __('Date', 'shshortc');?></option>
                    		<option value='author' <?php selected( 'author', $posts_default ); ?>>
								<?php echo __('Author', 'shshortc');?></option>
                    		<option value='category' <?php selected( 'category', $posts_default ); ?>>
								<?php echo __('Category', 'shshortc');?></option>
                    		<option value='tags' <?php selected( 'tags', $posts_default ); ?>>
								<?php echo __('Tags', 'shshortc');?></option>
                    	</select>
					</form>
					<?php } ?>
					<?php
					if ( strpos( $post_params, 'category' ) !== false ) {
						$categories = get_categories();
						foreach ( $categories as $category ) {
							$category_link = get_category_link( $category->term_id );
							$cat_count     = $category->category_count;

							echo '<div class="toc-cat-header"><span class="topsection"><a href="' . $category_link . '">' 
								. ucwords( $category->cat_name ) . '</a>';
							query_posts( 'posts_per_page=-1&post_status=publish&cat=' . $category->term_id ); // show sorted posts

							global $wp_query;
							echo '(' . $wp_query->post_count . ')</span></div>'; 
							if ( have_posts() ) :
								echo '<div class="post_item_list"><ul class="post_item_list">';
								while ( have_posts() ) :
									the_post(); ?>
									<li class="post_item">
										<a href="<?php the_permalink() ?>" rel="bookmark" 
										title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									</li>
								<?php  endwhile;
								echo '</ul></div>';
							endif;
							wp_reset_query();
						}
					} else if ( strpos( $post_params, 'author' ) !== false ) {
						$authors = get_users(); //gets registered users
						foreach ( $authors as $author ) {
							echo '<span class="topsection"><a href="' . get_author_posts_url( $author->ID ) . '">' 
								. $author->display_name . '</a> ';
							query_posts( 'posts_per_page=-1&post_status=publish&author=' . $author->ID ); // show the sorted posts
							global $wp_query;
							echo '(' . $wp_query->post_count . ')</span>'; ?>
							<?php
							if ( have_posts() ) :
								echo '<div class="post_item_list"><ul class="post_item_list">';
								while ( have_posts() ) :
									the_post(); ?>
									<li class="post_item">
										<a href="<?php the_permalink() ?>" rel="bookmark" 
										title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									</li>
								<?php  endwhile;
								echo '</ul></div>';
							endif;
							wp_reset_query();
						}
					} else if ( strpos( $post_params, 'tags' ) !== false ) {
						$post_tags = get_tags();
						echo '<div class="toc-tag-header">';
						foreach ( $post_tags as $tag ) {
							$tag_link = get_tag_link( $tag->term_id );
							echo "<span class='topsection'><a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
							echo "{$tag->name}</a> ($tag->count)</span>";

							query_posts( 'posts_per_page=-1&post_status=publish&tag=' . $tag->slug ); // show posts
							if ( have_posts() ) :
								echo '<div class="post_item_list"><ul class="post_item_list">';
								while ( have_posts() ) :
									the_post(); ?>
									<li class="post_item">
										<a href="<?php the_permalink() ?>" rel="bookmark" 
										title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									</li>
								<?php  endwhile;
								echo '</ul></div>';
							endif;
							wp_reset_query();
						}
						echo '</div>';
					} else {
						if ( strpos( $post_params, 'date' ) !== false ) {
						?>
							<div class="toc-date-header">
								<?php
								global $wpdb;
								$months = $wpdb->get_results( $wpdb->prepare( "SELECT DISTINCT MONTH(post_date) AS month , YEAR(post_date) AS year FROM $wpdb->posts WHERE post_status = %s and post_date <= now( ) and post_type = %s GROUP BY month, year ORDER BY post_date DESC", 'publish', 'post' ) );
								foreach ( $months as $curr_month ) {
									query_posts( 'posts_per_page=-1&post_status=publish&monthnum=' 
										. $curr_month->month . '&year=' . $curr_month->year ); // show posts
									global $wp_query;
									echo "<span class='topsection'><a href=\"";
									echo get_month_link( $curr_month->year, $curr_month->month );
									echo '">' . date( 'F', mktime( 0, 0, 0, $curr_month->month ) ) . ' ' 
										. $curr_month->year . '</a> (' . $wp_query->post_count . ')</span>'; 
									if ( have_posts() ) :
										echo '<div class="post_item_list"><ul class="post_item_list">';
										while ( have_posts() ) :
											the_post(); ?>
											<li class="post_item">
												<a href="<?php the_permalink() ?>" rel="bookmark" 
												title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
											</li>
										<?php  endwhile;
										echo '</ul></div>';
									endif;
									wp_reset_query();
								} ?>
							</div>
						<?php
						} else { /* default = title */
							?>
							<?php query_posts( $post_args ); /* Show sorted posts with default $post_args. */
							if ( have_posts() ) :
								echo '<ul class="toc-postlist">';
								while ( have_posts() ) :
									the_post();
									$sticky = "";
									if ( is_sticky( get_the_ID() ) ) {
										$sticky = " (sticky post)";
									} ?>
									<li class="post_item">
										<a href="<?php the_permalink() ?>" rel="bookmark" 
										title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
										<?php if ( $sticky == ' (sticky post)' ) : ?>
											<span class="ss_sticky"><?php echo $sticky; ?></span>
										<?php endif; ?>
									</li>
								<?php  endwhile;
								echo '</ul>';
							endif;
							wp_reset_query();
						}
					}
					?>
				</div>
			<?php endif; ?>
			<?php // RENDER SITEMAP CUSTOM POST TYPES ?>
			<?php
			$args = array( 'public' => true, '_builtin' => false );
			$custom_post_types = get_post_types( $args, 'objects' );
			foreach ( $custom_post_types as $post_type ) :
				?>
				<?php if ( isset( $show_cpts ) && $show_cpts=='true' ) : ?>
				<div id="toc-custompost" class="<?php echo $col;?>">
					<?php
					$cpt_posts = get_posts( 'post_type=' . $post_type->name . '&posts_per_page=-1' );
					if ( $cpt_posts ) : ?>
						<?php echo do_shortcode('[sh_headerdouble size="h4"]' . $post_type->label .'[/sh_headerdouble]');?>
						<ul class="cpt_item_list">
							<?php foreach ( $cpt_posts as $cpt_post ) : ?>
								<?php $cpt_link = get_post_permalink( $cpt_post->ID ); ?>
								<li><a href="<?php echo $cpt_link; ?>"> <?php echo $cpt_post->post_title; ?></a></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			<?php endforeach ?>

			</div>
			<?php

			$output = ob_get_contents();
			ob_end_clean();
			return $output;
        }

		// Tooltips
		public function tooltip($atts, $content = null) {
            extract(shortcode_atts(array(
                'placement' => 'top',
                'title' => '',

            ), $atts));
            $content = $this->removeTags($content);
            $content = do_shortcode($content);

            $output = '<a class="sh-tooltip" data-placement="' . $placement 
                    . '" title="' . $title . '"><u>' . $content . '</u></a>';
            return $output;
        }

		// Soundcloud - special
		public function soundcloud_shortcode($atts, $content=NULL) {
			extract(shortcode_atts(array(
				'color' => '#555555',
				'url' => '',
				'auto_play' => 'false',    // autoplay on load
				'show_comments' => 'false',  // no comments by default
				'visual' => 'false',    // for large (450 height) tracks - not using currently
			), $atts));

			$options['params'] = array(
				'url' => $url,
				'auto_play' => $auto_play,
				'show_comments' => $show_comments,
				'color' => $color,
			);

			$iframe = true;
			// The "url" option is required
  			if (!isset($url)) {
    			return '';
  			} else {
    			$url = trim($url);
  			}
			// Build URL
  			$url = 'https://w.soundcloud.com/player?' . http_build_query($options['params']);
  			// Set default width
  			$width = '100%';
  			// Set default height if not defined
  			$height = isset($options['height']) && $options['height'] !== 0
              ? $options['height']
              : ($this->soundcloud_url_has_tracklist($url) 
				|| (isset($visual) && $this->soundcloud_booleanize($visual)) ? '450' : '166');

  			$output = sprintf('<iframe width="%s" height="%s" scrolling="no" frameborder="no" src="%s"></iframe>', $width, $height, $url);
			return $output;
		}

		public function soundcloud_url_has_tracklist($url) {
  			return preg_match('/^(.+?)\/(sets|groups|playlists)\/(.+?)$/', $url);
		}
		public function soundcloud_booleanize($value) {
  			return is_bool($value) ? $value : $value === 'true' ? true : false;
		}

		// Video - Youtube and Vimeo
		public function video($atts, $content = NULL) {
			extract(shortcode_atts(array(
				'height' => '340',
				'width' => '600',
				'id' => 'P5_GlAOCHyE',     // default video
				'video' => 'vimeo',       // youtube or vimeo
				'poster' => '',             // used for self hosted
				'wmode' => 'transparent',
				'allowfullscreen' => true
			), $atts));

			$proto = 'http';
            if (is_ssl()) {
                $proto = 'https';
            }
	
			if($video == 'vimeo'){
            	$fs = $this->allow_full_screen($allowfullscreen, true);
            	$output = '<div class="elastic-video"><iframe src="' . $proto . '://player.vimeo.com/video/'.$id.'" width="'
					.$width.'" height="'.$height.'" frameborder="0" '.$fs.'></iframe></div>';
        	}elseif ($video == 'youtube') {
            	$height = '340';  // adjustment for youtube video sizes not fitting (we call 360 height for vimeo)
            	$fs = $this->allow_full_screen($allowfullscreen);
            	$output = '<div class="elastic-video"><iframe width="'
						.$width.'" height="'.$height.'" src="' . $proto . '://www.youtube.com/embed/'.$id.'?wmode='
						.$wmode.'" frameborder="0" '.$fs.'></iframe></div>';
        	} else {  // Self Hosted
				// check for image post id from visual composer
            	if (preg_match('/^\d+$/', $poster, $matches)) {
                	$img_attributes = wp_get_attachment_image_src($poster, 'full');
                	$poster = $img_attributes[0];
            	} else {
                	$poster = $poster;
            	}

            	$output = '<div class="elastic-video">'
                . '<div class="video-container" style="height:' . $height . 'px;width:' . $width . 'px;">'
                . '<video src="' . $id. '" controls poster="' . $poster . '" preload="none"></video>'
                . '</div></div>';
        	}

			return $output;
		}

		// Googledocs
		public function gdoc($atts, $content = NULL) {
			extract( shortcode_atts( array(
				'link' => false,
				'width' => ! empty( $content_width ) ? $content_width : '100%',
				'height' => 300, // default height is set to 300
				'seamless' => 'false', // if set to 'true', this will not show the Google Docs header / footer.
				'size' => false, // preset presentation size, either 'small', 'medium' or 'large';
			), $atts ) );

			// if no link or link is not from Google Docs, stop now!
			if ( ! $link || strpos( $link, '://docs.google.com' ) === false ) {
				return;
			}

			$type = $extra = false;

			// document
			if ( strpos( $link, '/document/' ) !== false ) {
				$type = 'doc';
			// presentation
			} elseif ( strpos( $link, '/presentation/' ) !== false || strpos( $link, '/present/' ) !== false ) {
				$type = 'presentation';
			// form
			} elseif ( strpos( $link, '/forms/' ) !== false || strpos( $link, 'form?formkey' ) !== false ) {
				$type = 'form';
			// spreadsheet
			} elseif ( strpos( $link, '/spreadsheets/' ) !== false ) {
				$type = 'spreadsheet';
			// nada!
			} else {
				return;
			}

			if ( $seamless == 'true' ) {
            	$link = add_query_arg( 'embedded', 'true', $link );
                $link = add_query_arg( 'rm', 'minimal', $link );
            }

			// add query args depending on doc type
			switch ( $type ) {
				case 'doc' :
					$extra = ' frameborder="0"';
				break;
				case 'presentation' :
					// alter the link so we're in embed mode
					// (older docs)
					$link = str_replace( '/view', '/embed', $link );
					// alter the link so we're in embed mode
					$link = str_replace( 'pub?', 'embed?', $link );
					// dimensions
					switch ( $size ) {
						case 'medium' :
							$width = 960;
							$height = 749;
							break;
						case 'large' :
							$width = 1440;
							$height = 1109;
							break;
						case 'small' :
						default :
							$width = 480;
							$height = 389;
						break;
					}
					// extra iframe args
					// don't like this? use the 'ray_google_docs_shortcode_output' filter to remove it!
					$extra = ' frameborder="0" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"';
					break;
				case 'form' :
					// new form format
					if ( strpos( $link, '/forms/' ) !== false ) {
						$link = str_replace( 'viewform', 'viewform?embedded=true', $link );
					// older form format
					} else {
						$link = str_replace( 'viewform?', 'embeddedform?', $link );
					}
					$extra = ' frameborder="0" marginheight="0" marginwidth="0"';
					break;
				case 'spreadsheet' :
					$link = add_query_arg( 'widget', 'true', $link );
					$extra = ' frameborder="0"';
					break;
			}
			$width = ' width="' . esc_attr( $width ) . '"';
			$height = ' height="' . esc_attr( $height ) . '"';

			$output = '<iframe id="gdoc-' . md5( $link ) . '" class="gdocs_shortcode gdocs_'
 					. esc_attr( $type ) . '" src="' . esc_url( $link ) . '"' . $width . $height . $extra . '></iframe>';

			return $output;
		}

		// Simple Forms
		public function form($atts, $content = NULL) {
            extract( shortcode_atts( array(
				'nametext' => __('Name', 'shshortc'),
				'emailtext' => __('Email', 'shshortc'),
				'messagetext' => __('Your Message', 'shshortc'),
				'inputborder' => 'rgba(0,0,0,0.25)',
				'inputbg' => '#ffffff',
				'inputtext' => '#555555',
				'buttontext' => __('Send us a message', 'shshortc'),
				'buttonbg' => '#ffffff',
				'buttoncolor' =>'#555555',
				'buttonborder' => '#555555',
				'buttonborderw' => '2px',
				'borderradius' => '0px',
				'newemail' => ''
            ), $atts ) );
			if ($newemail != '') {
				// encode it to avoid scrapers
				$newrecip = ' data-newemail="' . base64_encode($newemail) . '"';
			} else {
				$newrecip = ' data-newemail=""';
			}
			$darken = $this->colorBrightness($buttonbg, -0.9);
			$inputStyle = 'style="border-radius:' . $borderradius . ';color:' . $inputtext . ';background-color:' 
						. $inputbg . ';border: 1px solid ' . $inputborder . ';"';
			$buttonStyle = 'style="background:' . $buttonbg . ';color:'. $buttoncolor 
				. ';border:' . $buttonborderw . ' solid ' . $buttonborder . ';border-radius:' . $borderradius . ';"';
			
			$output = '<div class="sh-contact-form"' . $newrecip . '>
                    		<input class="contact-name" ' . $inputStyle . ' placeholder="' . $nametext . '" /><br />
                    		<input class="contact-email" ' . $inputStyle . ' placeholder="' . $emailtext . '" /><br />
                    		<textarea class="contact-message" ' . $inputStyle .' placeholder="'. $messagetext . '"></textarea><br />
                    		<button class="cont-send hover-enable" ' 
							. $buttonStyle . ' data-hover="' . $darken . '">' . $buttontext . '</button>
                    		<div class="contact-response"></div>
                		</div>';
			return $output;

		}

		// Google Maps
		public function gmap($atts, $content = NULL) {
			global $gmap_points;
        	extract( shortcode_atts( array(
				'address' => 'New York, NY 10007',
				'height' => '300px',
				'width' => '100%',
				'zoom' => '15',
				'zoomcontrol' => 'true',
				'pancontrol' => 'true',
				'maptypecontrol' => 'true',
				'scrollwheel' => 'true',
				'maptype' => 'ROADMAP', // ROADMAP, SATELLITE, HYBRID, TERRAIN
				'marker' => '',
				'mapcolor' => '',
				'saturation' => 0,
				'lightness' => 0,
				'infobox' => '',
				'infoboxbg' => 'rgba(255,255,255,0.9)',
				'infoboxcolor' => '#111',
				'unique' => 'default',  // set one just in case
				'bordered' => 'false',
				'fullwidth' => 'false',
            ), $atts ) );
			$content = do_shortcode($content);
			$style = 'style="height:' . $height . ';width:' . $width . ';"';
			$map_settings = $this->google_lat_lng($address, $unique, 'primary');
			$lat = $map_settings[$unique]['address_lat'];
			$lng = $map_settings[$unique]['address_lng'];
			$secondary = '';
			$secondary = $this->google_lat_lng($gmap_points, $unique, 'secondary');
			// replace the table with new data, encode fields that need it
			update_option( 'sh_short_saved_points_' . $unique, $secondary );
			$secondary_out = htmlspecialchars(json_encode($secondary), ENT_QUOTES, 'UTF-8');
			$infoboxAr['infobox'] = $infobox;
			$infobox_out = htmlspecialchars(json_encode($infoboxAr), ENT_QUOTES, 'UTF-8');

			// add border class
			if ($bordered == 'true') {
				$border = 'sh-map-border';
			} else {
				$border = '';
			}

			// add full width class
			if ($fullwidth == 'true') {
				$full = 'sh-map-full';
			} else {
				$full = '';
			}

			$output = '<div class="sh-map-holder ' . $border . ' ' . $full . '" ' . $style . '>' 
				. '<div class="sh-map" data-lat="' . $lat . '" data-lng="' . $lng 
				. '" data-zoom="' . $zoom . '" data-maptype="' . $maptype . '" data-zoomcontrol="' . $zoomcontrol 
				. '" data-pancontrol="' . $pancontrol . '" data-maptypecontrol="' . $maptypecontrol 
				. '" data-scrollwheel="' . $scrollwheel . '" data-marker="' . $marker 
				. '" data-infobox="' . $infobox_out . '" data-infoboxbg="' . $infoboxbg . '" data-infoboxcolor="' 
				. $infoboxcolor . '" data-mapcolor="' . $mapcolor . '" data-saturation="' . $saturation 
				. '" data-lightness="' . $lightness . '" data-points ="' . $secondary_out . '"></div></div>';
			$gmap_points = array();
			return $output;

		}

		// Additional Map Points
		public function gmap_point($atts, $content = NULL) {
			extract( shortcode_atts( array(
                'address' => '',
                'marker' => '',
                'infobox' => '',
			), $atts) );
			global $gmap_points;
			global $point_inc;
			$point_inc++;
			if ($address) {
				$gmap_points[$point_inc]['address'] = $address;
				$gmap_points[$point_inc]['marker'] = $marker;
				$gmap_points[$point_inc]['infobox'] = $infobox;
			}
			

		}

		/*
		 * Check for and save Google Map Lat and Lng per map, if it's changed update it in the database
		*/
    	public function google_lat_lng($address,$unique, $point) {

			// Primary location
			if ($point == 'primary') {
        		$saved_address = get_option('sh_short_saved_address');
        		$confirm = isset($saved_address[$unique]['map_address']) ? $saved_address[$unique]['map_address'] : '';
        		if ($address && $address != $confirm) {
					$coords = $this->google_geo($address);
					$lat = $coords[0];
					$lng = $coords[1];
            		$map_settings[$unique]['map_address'] = $address;
            		$map_settings[$unique]['address_lat'] = $lat;
           	 		$map_settings[$unique]['address_lng'] = $lng;

					$db_update = array();  // update the unique id and keep the saved addresses intact
					if (!empty($saved_address)) {
						foreach ($saved_address as $k => $v) {
							$db_update[$k] = $saved_address[$k];
						}
						$db_update[$unique] = $map_settings[$unique];
					} else {
						$db_update = $map_settings;
					}
            		update_option( 'sh_short_saved_address', $db_update );
        		} else {
            		// Just get the lat and long from the database for the map
            		$map_settings[$unique]['address_lat'] = $saved_address[$unique]['address_lat'];
            		$map_settings[$unique]['address_lng'] = $saved_address[$unique]['address_lng'];
        		}
				return $map_settings;
			} elseif ($point == 'secondary') {  // Extra points on the map, stored and managed in a seperate table
				$secondary = array();
				$saved_points = get_option('sh_short_saved_points_' . $unique);
				if (is_array($address)) {
					foreach ($address as $k => $single) {
						$located = false;
						if (isset($saved_points[$k]) && is_array($saved_points[$k])) {   // existing entries, just get lat and lng
							//echo '<p>Address ' . $k . ': ' .  $saved_points[$k]['map_address'] . '</p>';
							if  ($single['address'] == $saved_points[$k]['map_address']) {
								$located = true;
								$secondary[$k]['map_address'] = $single['address'];
                            	$secondary[$k]['address_lat'] = $saved_points[$k]['address_lat'];
                            	$secondary[$k]['address_lng'] = $saved_points[$k]['address_lng'];
                            	$secondary[$k]['marker'] = $single['marker'];
                            	$secondary[$k]['infobox'] = $single['infobox'];
							}
						}
						if (!$located) {     // doesn't exist in db, need to geocode
							$coords = $this->google_geo($single['address']);
							$lat = $coords[0];
							$lng = $coords[1];
							$secondary[$k]['map_address'] = $single['address'];
                            $secondary[$k]['address_lat'] = $lat;
                            $secondary[$k]['address_lng'] = $lng;
                            $secondary[$k]['marker'] = $single['marker'];
                            $secondary[$k]['infobox'] = $single['infobox'];
						}
					}
					return $secondary;
				}
			}
				
   	 	}

		/* 
		* Actual Geocoding
		*/
		public function google_geo($address) {
			//echo '<p>Geocoding' . $address . '</p>';
			$base_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=";
            $sensor = "&sensor=false";
            $geocode_pending = true;
            $request_url = $base_url . urlencode($address) . $sensor;
            //echo $request_url;

            $result = $this->get_remote($request_url);
            $content = trim( wp_remote_retrieve_body( $result ) );
            $xml = simplexml_load_string($content);

            $status = $xml->status;
            //echo $status . "\n";
            if (strcmp($status, "OK") == 0) {
            	// Successful geocode
                $geocode_pending = false;

                $lat = $xml->result->geometry->location->lat;
                $lng = $xml->result->geometry->location->lng;

            } else if (strcmp($status, "OVER_QUERY_LIMIT") == 0) {
                // sent geocodes too fast
                $lat = '';
                $lng = '';
            } else {
                // failure to geocode
                $lat = '';
                $lng = '';
            }
            $lat = (string)$lat;
            $lng = (string)$lng;	
			$coords = array($lat, $lng);
			return $coords;
		}

		/*
     	* Use wp_remote_get
     	*/
    	public function get_remote($url) {
        	$result = wp_remote_get(
            	$url,
            	array(
                	'timeout'  => 600
            	)
        	);
        	return $result;
    	}


		/*
		 * Remove p tags WP 4.3 seems to have just added this to text entries, may or may not need this for long 
		 * as it's only affecting VC elements.  Currently only found buttons affected
		 */
		public function removeps($content) {
			$array = array (
				'<p>' => '',
				'</p>' => ''
			);
			$nops = strtr($content, $array);
			return $nops;
		}



		/*
		 * Clean up the paragraph and breaks without messing with autop
		 * Not all shortcodes need it
		*/
		public function removeTags($content) {
        	$array = array (
            	'<p>[' => '[', 
            	']</p>' => ']', 
            	']<br />' => ']'
        	);

        	$clean = strtr($content, $array);

			return $clean;
		}

		 /* 
         * Convert hexdec color string to rgb(a) string 
         */
/*
        public function hex2rgba($color, $opacity = false) {
            $default = 'rgb(0,0,0)';

            //Return default if no color provided
            if(empty($color))
            return $default;

            //Sanitize $color if "#" is provided 
            if ($color[0] == '#' ) {
                $color = substr( $color, 1 );
            }

            //Check if color has 6 or 3 characters and get values
            if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
            } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
            } else {
                return $default;
            }

            //Convert hexadec to rgb
            $rgb = array_map('hexdec', $hex);

            //Check if opacity is set(rgba or rgb)
            if($opacity){
                if(abs($opacity) > 1) {
                    $opacity = 1.0;
                }
                $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
            } else {
                $output = 'rgb('.implode(",",$rgb).')';
            }

            //Return rgb(a) color string
            return $output;
        }
*/
		public function colorBrightness($hex, $percent) {
		// Work out if hash given
		$hash = '';

		// handle rgba - LB 8-28-2014
		if (preg_match('/^rgba/', $hex, $matches)) {
			$patterns = array('/rgba\(/','/\)/');
			$actual = preg_replace($patterns, '', $hex);
			$fields = explode(',', $actual);
			$alpha = $fields[3];	
			if ($percent < 0) {   // darken
				$change = 1 + $percent; // get the difference e.g. 1 + (-0.05)
				$alpha = $alpha + $change;
				if ($alpha > 1) { $alpha = 1; }
			} else {             // lighten
				$alpha = $alpha - $percent;
				if ($alpha < 0) { $alpha =0; }
			}

			$newRGBA = 'rgba(' . $fields[0] . ',' . $fields[1] . ',' . $fields[2] . ',' . $alpha . ')';
			return $newRGBA;
		}

		// handle rgb value coming in and convert to hexidecimal before doing the rest  - LB 8-28-2014
		if (preg_match('/^rgb/', $hex, $matches)) {
			$patterns = array('/rgb\(/','/\)/');
            $actual = preg_replace($patterns, '', $hex);
            $fields = explode(',', $actual);
			$r = intval($fields[0]);
			$g = intval($fields[1]);
			$b = intval($fields[2]);

			$r = dechex($r<0?0:($r>255?255:$r));
    		$g = dechex($g<0?0:($g>255?255:$g));
    		$b = dechex($b<0?0:($b>255?255:$b));

    		$color = (strlen($r) < 2?'0':'').$r;
    		$color .= (strlen($g) < 2?'0':'').$g;
    		$color .= (strlen($b) < 2?'0':'').$b;
    		$hex = '#'.$color;
		}

		if (stristr($hex,'#')) {
			$hex = str_replace('#','',$hex);
			$hash = '#';
		}
		/// HEX TO RGB
		$rgb = array(hexdec(substr($hex,0,2)), hexdec(substr($hex,2,2)), hexdec(substr($hex,4,2)));
		//// CALCULATE 
		for ($i=0; $i<3; $i++) {
			// See if brighter or darker
			if ($percent > 0) {
				// Lighter
				$rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
			} else {
				// Darker
				$positivePercent = $percent - ($percent*2);
				$rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
			}
			// In case rounding up causes us to go to 256
			if ($rgb[$i] > 255) {
				$rgb[$i] = 255;
			}
		}
		//// RBG to Hex
		$hex = '';
		for($i=0; $i < 3; $i++) {
			// Convert the decimal digit to hex
			$hexDigit = dechex($rgb[$i]);
			// Add a leading zero if necessary
			if(strlen($hexDigit) == 1) {
				$hexDigit = "0" . $hexDigit;
			}
			// Append to the hex string
			$hex .= $hexDigit;
		}
		$hash = '#';
		return $hash.$hex;
	}

	// Allow Full Screen video
	public function allow_full_screen($allow, $isvimeo = false){
    	if($allow == true){
        	if($isvimeo == 'false'){
            	return 'webkitAllowFullScreen mozallowfullscreen allowFullScreen';
        	}else{
            	return 'allowfullscreen';
        	}
    	}
    	return false;
	}


    } // class

endif;
