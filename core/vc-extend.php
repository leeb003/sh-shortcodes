<?php
/**
 * Visual Composer shortcode additions
 */

class VCExtend {
	// Properties

	// Methods

	public function __construct() {

		if (function_exists('vc_map')) {  // test for visual composer first
			add_action('vc_before_init', array(&$this, 'short_sh_accordion') );
			add_action('vc_before_init', array(&$this, 'short_sh_alert') );
			add_action('vc_before_init', array(&$this, 'short_sh_anchor') );
			add_action('vc_before_init', array(&$this, 'short_sh_animate') );
			add_action('vc_before_init', array(&$this, 'short_sh_quote') );  // Blockquote 1
            add_action('vc_before_init', array(&$this, 'short_sh_quote2') ); // Blockquote 2
			add_action('vc_before_init', array(&$this, 'short_sh_btn') ); // buttons
			add_action('vc_before_init', array(&$this, 'short_sh_callout') );
			add_action('vc_before_init', array(&$this, 'short_sh_circle') ); // Circle Charts
			add_action('vc_before_init', array(&$this, 'short_sh_contentbox') ); // Content Boxes
			add_action('vc_before_init', array(&$this, 'short_sh_contact') ); // Contact Form
			add_action('vc_before_init', array(&$this, 'short_sh_countdown') );
			add_action('vc_before_init', array(&$this, 'short_sh_divider') );
			add_action('vc_before_init', array(&$this, 'short_sh_dropcap') );
			add_action('vc_before_init', array(&$this, 'short_sh_gdoc') ); // Google Documents
            add_action('vc_before_init', array(&$this, 'short_sh_gmap') ); // Google Maps
			add_action('vc_before_init', array(&$this, 'short_sh_headerdouble') );
			add_action('vc_before_init', array(&$this, 'short_sh_header') );
			add_action('vc_before_init', array(&$this, 'short_sh_highlight') );
			add_action('vc_before_init', array(&$this, 'short_sh_fa') ); // font awesome icons, includes linear & ion icons
			add_action('vc_before_init', array(&$this, 'short_sh_colorbg') ); // Color Background Section
			add_action('vc_before_init', array(&$this, 'short_sh_imagebg') ); // Image Background Section
            add_action('vc_before_init', array(&$this, 'short_sh_imageframe') );
			add_action('vc_before_init', array(&$this, 'short_sh_bloggrid') );  // Latest Posts
			add_action('vc_before_init', array(&$this, 'short_sh_checklist') ); // Lists 
			add_action('vc_before_init', array(&$this, 'short_sh_milestone') );
			add_action('vc_before_init', array(&$this, 'short_sh_modal') );
			add_action('vc_before_init', array(&$this, 'short_sh_parallax') ); // Parallax
            add_action('vc_before_init', array(&$this, 'short_sh_people') ); // People
            add_action('vc_before_init', array(&$this, 'short_sh_popover') ); // Popovers
			add_action('vc_before_init', array(&$this, 'short_sh_portfolio') ); // Portfolio Grid
			add_action('vc_before_init', array(&$this, 'short_sh_pricetable') ); // Price Tables 
			add_action('vc_before_init', array(&$this, 'short_sh_progress') ); // Progress Bars
			add_action('vc_before_init', array(&$this, 'short_sh_pullquote') );
			add_action('vc_before_init', array(&$this, 'short_sh_sitemap') ); // Sitemap
            add_action('vc_before_init', array(&$this, 'short_sh_social') ); // Social Icons
            add_action('vc_before_init', array(&$this, 'short_sh_soundcloud') ); // SoundCloud
			add_action('vc_before_init', array(&$this, 'short_sh_table') ); // Tables 
			add_action('vc_before_init', array(&$this, 'short_sh_testimonials') ); // Testimonials
			add_action('vc_before_init', array(&$this, 'short_sh_tooltip') ); // Tooltips
			add_action('vc_before_init', array(&$this, 'short_sh_video') ); // Videos
		}

		// custom dropdown param fontawesome icons
		vc_add_shortcode_param('fa_dropdown', array(&$this, 'fa_dropdown_settings_field'), SH_ROOT_URL . '/js/vc-admin.js' );
		// custom dropdown param linear icons
		vc_add_shortcode_param('linear_dropdown', array(&$this, 'linear_settings_field'), SH_ROOT_URL . '/js/vc-admin.js' );
		// custom dropdown param ion icons
		vc_add_shortcode_param('ion_dropdown', array(&$this, 'ion_settings_field'), SH_ROOT_URL . '/js/vc-admin.js' );
	}

	// custom dropdown for Font Awesome icons
	public function fa_dropdown_settings_field($settings, $value) {
		/* The dropdown is slightly different than our main font awesome shortcode */
		$setup = '<div class="icon-holder fontawesome-select"><div class="sc-option"><div class="selectBox">'
               . '<span class="selected"></span>'
               . '<span class="selectArrow">&#9660</span>'
               . '<div class="selectOptions">'
               . '<span class="searchOptions"><input class="searchCheckLive" placeholder="search" /></span>';
		
		foreach ($settings['value'] as $k => $v) {
			if ($value == $v) {
				$selected = 'selected-icon';
			} else {
				$selected = '';
			}
			$setup .= '<span class="selectOption ' . $selected . '" value="' . $v . '"><input name="' . $settings['param_name']
				. '" class="wpb_vc_param_value checkbox ' . $settings['param_name'] . ' ' 
				. $settings['type'] . '_field" type="checkbox" value="' . $v . '" />' 
				. '<i class="select-fa ' . $v . '"></i> ' . $v . '</span>';
		}
		
		$setup .= '</div></div></div></div>';

		return $setup;
	}

	// custom dropdown for Linear icons
    public function linear_settings_field($settings, $value) {
        $linear_setup = '<div class="icon-holder linear-select"><div class="sc-option"><div class="selectBox">'
               . '<span class="selected"></span>'
               . '<span class="selectArrow">&#9660</span>'
               . '<div class="selectOptions">'
               . '<span class="searchOptions"><input class="searchCheckLive" placeholder="search" /></span>';
        foreach ($settings['value'] as $k => $v) {
            if ($value == $v) {
                $selected = 'selected-icon';
            } else {
                $selected = '';
            }
            $linear_setup .= '<span class="selectOption ' . $selected . '" value="' . $v . '"><input name="' 
			    . $settings['param_name']
                . '" class="wpb_vc_param_value checkbox ' . $settings['param_name'] . ' '
                . $settings['type'] . '_field" type="checkbox" value="' . $v . '" />'
                . '<i class="select-fa ' . $v . '"></i> ' . $v . '</span>';
        }

        $linear_setup .= '</div></div></div></div>';

        return $linear_setup;
    }

	// custom dropdown for Ion icons
    public function ion_settings_field($settings, $value) {
        $setup = '<div class="icon-holder ion-select"><div class="sc-option"><div class="selectBox">'
               . '<span class="selected"></span>'
               . '<span class="selectArrow">&#9660</span>'
               . '<div class="selectOptions">'
               . '<span class="searchOptions"><input class="searchCheckLive" placeholder="search" /></span>';

        foreach ($settings['value'] as $k => $v) {
            if ($value == $v) {
                $selected = 'selected-icon';
            } else {
                $selected = '';
            }
            $setup .= '<span class="selectOption ' . $selected . '" value="' . $v . '"><input name="' . $settings['param_name']
                . '" class="wpb_vc_param_value checkbox ' . $settings['param_name'] . ' '
                . $settings['type'] . '_field" type="checkbox" value="' . $v . '" />'
                . '<i class="select-fa ' . $v . '"></i> ' . $v . '</span>';
        }

        $setup .= '</div></div></div></div>';

        return $setup;
    }



	// Accordions
	public function short_sh_accordion() {

        vc_map( array(
            "name" => __("Accordion", 'shshortc'),
            "base" => "shvc_accordion",
            "as_parent" => array('only' => 'shvc_accord_item'),
            'content_element' => true,
            "show_settings_on_create" => false,
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "description" => __("Add SH-Themes Accordion", "shshortc"),

            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Select Accordion Type", "shshortc"),
                    "param_name" => "mode",
                    "value" => array(
                        __('Single Open', 'shshortc') => 'single',
                        __('Many Open', 'shshortc') => 'all'
                    ),
					"description" => __("One or Many Open at once", "shshortc"),
                ),
            ),
            'default_content' => '
                [shvc_accord_item title="' . __('Tab 1', 'shshortc') . '" open="true"]' 
					. __( 'Add your content', 'shshortc' ) . '[/shvc_accord_item]
                [shvc_accord_item title="' . __('Tab 2', 'shshortc') . '"]' 
                    . __( 'Add your content', 'shshortc' ) . '[/shvc_accord_item]',
            "js_view" => 'VcColumnView'
        ) );
        // Accordion Tabs
        vc_map( array(
            "name" => __('Accordion Tab', 'shshortc'),
            "base" => "shvc_accord_item",
            "content_element" => true,
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "as_child" => array("only" => "shvc_accordion"),
            'params' => array(
				array( 
					"type" => "dropdown",
					"heading" => __("Open or Closed on page load", "shshortc"),
					"param_name" => "open",
					"value" => array(
						__("Closed", "shshortc") => "false",
						__("Open", "shshortc") => "true",
					),
					"description" => __("Choose if you want this tab open on page load", "shshortc"),
				),
				array(
					"type" => "textfield",
					"holder" => "span",
					"heading" => __("Title", "shshortc"),
					"param_name" => "title",
					"value" => __("Tab Title", "shshortc"),
				),
                array(
                    "type" => "textarea_html",
                    "heading" => __("Enter Text", 'shshortc'),
                    "param_name" => "content",
                    "value" => __("Enter your content", 'shshortc'),
                    "description" => __("Enter the Accordion Tab content.", 'shshortc')
                ),
            ),
        ) );
	}

	// Alert Message Boxes
	public function short_sh_alert() {
		require_once SH_ROOT_PATH.'/core/font-awesome-icons.php';
        $icons = fa_font_icons();
		require_once SH_ROOT_PATH.'/core/linear-icons.php';
        $linearicons = linearicons();
		require_once SH_ROOT_PATH.'/core/ion-icons.php';
        $ionicons = ionicons();

		vc_map( array(
			"name" => __("Alert Box", "shshortc"),
			"base" => "sh_alert",
			"icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Alert and Info Boxes", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
			"params" => array(
				array(
					"type" => "textarea",
					"holder" => "span",
					"heading"  => __("Alert Message Text", "shshortc"),
					"param_name" => "content",
					"value" => __("Your Message", "shshortc"),
				),
				array(
					"type" => "checkbox",
					"heading" => __("Enable Close Button", "shshortc"),
					"param_name" => "close",
					"value" => array(
						__("Enable", "shshortc") => "enable",
						__("Disable", "shshortc") => "disable"
					)
				),
				array(
					"type" => "checkbox",
					"heading" => __("Enable Font Before Message:", "shshortc"),
					"param_name" => "enablefont",
					"value" => array(
                        __("Enable", "shshortc") => "enable",
                        __("Disable", "shshortc") => "disable"
                    )
                ),
				 array(
                    "type" => "textfield",
                    "holder" => "span",
                    "heading" => __("Font Size", "shshortc"),
                    "param_name" => 'fontsize',
                    "value" => __("15px", "shshortc")
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Choose The Icons to use:", "shshortc"),
                    "param_name" => "iconset",
                    "value" => array(
                        __("Font Awesome", "shshortc") => "fontawesome",
                        __("Linear Icons", "shshortc") => "linear",
						__("Ion Icons", "shshortc") => "ion"
                    ),
					"description" => __("If you are going to use Linearicons or Ionicons, make sure you've enabled them in Theme Options -> General Settings.", "shshortc"),
					"dependency" => array (
                        "element" => "enablefont",
                        "value" => array("enable"),
                    ),
                ),
					
				array(
                    "type" => "fa_dropdown",
                    "class" => "fontawesome",
                    "heading" => __("Choose a Font Awesome icon", 'shshortc'),
                    "param_name" => "iconfa",
                    "value" => $icons,
                ),
				array(
					"type" => "linear_dropdown",
					"class" => "linearicon",
                    "heading" => __("Choose a Linearicons icon", 'shshortc'),
                    "param_name" => "iconlinear",
                    "value" => $linearicons,
                ),
				array(
                    "type" => "ion_dropdown",
                    "class" => "ionicon",
                    "heading" => __("Choose an Ionicons icon", 'shshortc'),
                    "param_name" => "iconion",
                    "value" => $ionicons,
                ),
				
				array(
					"type" => "dropdown",
					"holder" => "span",
					"heading" => __("Alert Type:", "shshortc"),
					"param_name" => "type",
					"value" => array(
						__("General", "shshortc") => "general",
						__("Informational", "shshortc") => "info",
						__("Success", "shshortc") => "success",
						__("Warning", "shshortc") => "warning",
						__("Error", "shshortc") => "error",
						__("Custom", "shshortc") => "custom"
					)
				),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Background Color:", "shshortc"),
                    "param_name" => "background",
                    "value" => "#ffffff",
					"dependency" => array (
                        "element" => "type",
                        "value" => array("custom"),
                    ),
				),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Font Color:", "shshortc"),
                    "param_name" => "fontcolor",
                    "value" => "#555555",
                    "dependency" => array (
                        "element" => "type",
                        "value" => array("custom"),
                    ),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Border Color:", "shshortc"),
                    "param_name" => "bordercolor",
                    "value" => "#555555",
                    "dependency" => array (
                        "element" => "type",
                        "value" => array("custom"),
                    ),
                ),
			)
		) );
	}

	// Anchor links
	public function short_sh_anchor() {
		vc_map( array(
			"name" => __("Anchor Link", 'shshortc'),
			"base" => "sh_anchor",
			"description" => __("Create an anchor link that you can point a custom url to.", "shshortc"),
			"icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
				array( 
					"type" => "textfield",
					"holder" => "span",
					"heading" => __("Unique Anchor ID", "shshortc"),
					"param_name" => 'id',
					"value" => __("contact-section", "shshortc")
				),	
                array(
                    "type" => "textarea",
                    "heading"  => __("Content", "shshortc"),
                    "param_name" => "content",
                    "value" => __("", "shshortc"),
					"description" => __("Leave blank for hidden anchor, useful if using above a section", "shshortc")
                ),
			)
        ) );
    }

	// Animate
	public function short_sh_animate() {
		require_once SH_ROOT_PATH.'/core/sh-animations.php';
        $animations = SH_ANIMATIONS();

		vc_map( array(
            "name" => __("Animate", 'shshortc'),
            "base" => "shvc_animate",
			"description" => __("Animate Other Elements", "shshortc"),
            "as_parent" => array('except' => 'bob'),
			//'is_container' => true,
            'content_element' => true,
            "show_settings_on_create" => true,
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Select List Type", "shshortc"),
                    "param_name" => "anim",
                    "value" => $animations
                ),
				array(
					"type" => "textfield",
					"heading" => __("Set Delay", "shshortc"),
					"param_name" => "delay",
					"value" => "0",
					"description" => __("Set a delay if you would like, these are in thousands of seconds (1000 = 1 second)", "shshortc")
				)
            ),
			"js_view" => 'VcColumnView'  // necessary if you want nested containers to work right
		) );
	}


	// Callouts
	public function short_sh_callout() {
		require_once SH_ROOT_PATH.'/core/font-awesome-icons.php';
        $icons = fa_font_icons();
		require_once SH_ROOT_PATH.'/core/linear-icons.php';
		$linearicons = linearicons();
		require_once SH_ROOT_PATH.'/core/ion-icons.php';
		$ionicons = ionicons();

		$sizes = array();
		for($i = 0; $i < 25; $i++) {
			$sizes[] = $i . 'px';
		}
		vc_map( array(
			"name" => __("Callout", "shshortc"),
			"base" => "sh_callout",
			"icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Fancy Boxes with content and links", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
					"type" => "dropdown",
					"heading" => __("Choose a Callout Type", "shshortc"),
					"param_name" => "callouttype",
					"value" => array(
						__("Standard Box", "shshortc") => 'standard',
						__("Flip Box", "shshortc") => 'flip',
					)
				),
				array(
					"type" => "textfield",
					"holder" => "span",
					"heading" => __("The Title:", "shshortc"),
					"param_name" => "title",
					"value" => __("Enter Your Title", 'shshortc'),
				),
				array(
					"type" => "textarea_html",
					"heading" => __("The Content", "shshortc"),
					"param_name" => "content",
					"description" => __("This is the text area (for flip boxes this is the first page)", "shshortc"),
				),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Border Color", "shshortc"),
                    "param_name" => "bordercolor",
					"value" => "rgba(0,0,0,0.15)"
                ),
				array(
					"type" => "dropdown",
					"heading" => __("Border Size", "shshortc"),
					"param_name" => "bordersize",
					"value" => $sizes
				),
				array(
                    "type" => "dropdown",
                    "heading" => __("Border Radius", "shshortc"),
                    "param_name" => "borderradius",
                    "value" => $sizes
                ),
				array(
					"type" => "colorpicker",
					"heading" => __("Background Color", "shshortc"),
					"param_name" => "backgroundcolor",
					"value" => "#fff"
				),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Font Color", "shshortc"),
                    "param_name" => "fontcolor",
                    "value" => "#555"
				),
				array(
					"type" => "textarea",
					"heading" => __("Flip Content", "shshortc"),
					"param_name" => "fliptext",
					"dependency" => array (
                        "element" => "callouttype",
                        "value" => array("flip"),
                    ),
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Flip Font Color", "shshortc"),
					"param_name" => "flipcolor",
					"value" => "#555",
					"dependency" => array (
                        "element" => "callouttype",
                        "value" => array("flip"),
                    ),
				),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Flip Background Color", "shshortc"),
                    "param_name" => "flipbgcolor",
					"value" => "#fff",
					"dependency" => array (
                        "element" => "callouttype",
                        "value" => array("flip"),
                    ),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Flip Border Color", "shshortc"),
                    "param_name" => "flipbordercolor",
					"value" => "rgba(0,0,0,0.15)",
					"dependency" => array (
                        "element" => "callouttype",
                        "value" => array("flip"),
                    ),
                ),
				array(
					"type" => "checkbox",
					"heading" => __("Enable Button", "shshortc"),
					"param_name" => "buttonenable",
					"value" => array(
						__("Enable","shshortc") => "enable",
						__("Disable","shshortc") => "disable"
					)
				),
					
				array(
					"type" => "textfield",
					"heading" => __("Button Text:", "shshortc"),
					"param_name" => "buttontext",
					"dependency" => array (
                        "element" => "buttonenable",
                        "value" => array("enable"),
                    ),
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Link:", "shshortc"),
					"param_name" => "buttonlink",
					"value" => "http://www.example.com",
					"dependency" => array (
                        "element" => "buttonenable",
                        "value" => array("enable"),
                    ),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Button Target:", "shshortc"),
					"param_name" => "buttontarget",
					'value' => array(
                        'New Window' => '_blank',
                        'Same Window' => '_self'
                    ),
					"dependency" => array (
                        "element" => "buttonenable",
                        "value" => array("enable"),
                    ),
				),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Button Font Color", "shshortc"),
                    "param_name" => "buttonfontcolor",
                    "value" => "#fff",
					"dependency" => array (
                        "element" => "buttonenable",
                        "value" => array("enable"),
                    ),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Button Background Color", "shshortc"),
                    "param_name" => "buttonbgcolor",
                    "value" => "#DD4040",
					"dependency" => array (
                        "element" => "buttonenable",
                        "value" => array("enable"),
                    ),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Button Border Size", "shshortc"),
                    "param_name" => "btnborderwidth",
                    "value" => $sizes,
					"dependency" => array (
                        "element" => "buttonenable",
                        "value" => array("enable"),
                    ),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Button Border Color", "shshortc"),
                    "param_name" => "btnbordercolor",
                    "value" => "#ffffff",
                    "dependency" => array (
                        "element" => "buttonenable",
                        "value" => array("enable"),
                    ),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Button Border Radius", "shshortc"),
                    "param_name" => "btnborderradius",
                    "value" => $sizes,
                    "dependency" => array (
                        "element" => "buttonenable",
                        "value" => array("enable"),
                    ),
                ),
				array(
					"type" => "dropdown",
					"heading" => __("Enable Icon or Image", "shshortc"),	
					"param_name" => "iconenable",
					"value" => array(
						__("Enable Icon", "shshortc") => "enable",
						__("Enable Image", "shshortc") => "image",
						__("Disable", "shshortc") => "disable"
					)
				),
				array( 
					"type" => "attach_image",
					"heading" => __("Image to use", "shshortc"),
					"param_name" => "image",
					"description" => __("Single image only", "shshortc"),
					"dependency" => array (
                        "element" => "iconenable",
                        "value" => array("image"),
                    ),
				),
				array(
					"type" => "textfield",
					"heading" => __("Image Height", "shshortc"),
					"param_name" => "imageheight",
					"value" => "100px",
					"description" => __("Should be a number with px following e.g. 200px", "shshortc"),
					"dependency" => array (
                        "element" => "iconenable",
                        "value" => array("image"),
                    ),

				),
				array(
                    "type" => "textfield",
                    "heading" => __("Image Width", "shshortc"),
                    "param_name" => "imagewidth",
                    "value" => "100px",
					"description" => __("Should be a number with px following e.g. 200px", "shshortc"),
					"dependency" => array (
                        "element" => "iconenable",
                        "value" => array("image"),
                    ),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Choose The Icons to use:", "shshortc"),
                    "param_name" => "iconset",
                    "value" => array(
                        __("Font Awesome", "shshortc") => "fontawesome",
                        __("Linear Icons", "shshortc") => "linear",
                        __("Ion Icons", "shshortc") => "ion"
                    ),
                    "description" => __("If you are going to use Linearicons or Ionicons, make sure you've enabled them in Theme Options -> General Settings.", "shshortc"),
                    "dependency" => array (
                        "element" => "iconenable",
                        "value" => array("enable"),
                    ),
                ),

				array(
                    "type" => "fa_dropdown",
                    "class" => "fontawesome",
                    "heading" => __("Choose an icon", 'shshortc'),
                    "param_name" => "iconfa",
                    "value" => $icons,
                ),
				array(
                    "type" => "linear_dropdown",
                    "class" => "linearicon",
                    "heading" => __("Choose a Linearicons icon", 'shshortc'),
                    "param_name" => "iconlinear",
                    "value" => $linearicons,
                ),
                array(
                    "type" => "ion_dropdown",
                    "class" => "ionicon",
                    "heading" => __("Choose an Ionicons icon", 'shshortc'),
                    "param_name" => "iconion",
                    "value" => $ionicons,
                ),

				array(
                    "type" => "checkbox",
                    "heading" => __("Icon Spin", "shshortc"),
                    "param_name" => "iconspin",
                    "value" => array(
                        __("Enable", "shshortc") => "enable",
                        __("Disable", "shshortc") => "disable"
                    ),
					"dependency" => array (
                        "element" => "iconset",
                        "value" => array("fontawesome"),
                    ),
                ),

				array(
                    "type" => "colorpicker",
                    "heading" => __("Icon Font Color", "shshortc"),
                    "param_name" => "iconfontcolor",
                    "value" => "#fff",
					"dependency" => array (
                        "element" => "iconenable",
                        "value" => array("enable"),
                    ),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Icon Background Color", "shshortc"),
                    "param_name" => "iconbgcolor",
                    "value" => "#DD4040",
					"dependency" => array (
                        "element" => "iconenable",
                        "value" => array("enable"),
                    ),
                ),
			)
		) );
	}

	// Content Boxes
	public function short_sh_contentbox() { 
		require_once SH_ROOT_PATH.'/core/font-awesome-icons.php';
        $icons = fa_font_icons();
		require_once SH_ROOT_PATH.'/core/linear-icons.php';
		$linearicons = linearicons();
		require_once SH_ROOT_PATH.'/core/ion-icons.php';
		$ionicons = ionicons();

		vc_map( array(
            "name" => __("Content Box", 'shshortc'),
            "base" => "sh_content",
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "description" => __("Add some uniqueness to your site", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    'type' => 'dropdown',
                    'heading' => __('Content Box Style', 'shshortc'),
                    'holder' => 'span',
                    'param_name' => 'style',
                    'value' => array(
						__('Top Icon or Image', 'shshortc') => 'top',
						__('Left Icon or Image', 'shshortc') => 'left'
					),
                    'description' => __('Set where you want the icon or image placed', 'shshortc')
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __('Background', 'shshortc'),
                    'param_name' => 'background',
                    'value' => array(
                        __('Enable Transparent Background', 'shshortc') => 'true',
                        __('Disable Transparent Background', 'shshortc') => 'false',
                    )
                ),
				array(
                    'type' => 'colorpicker',
                    'heading' => __('Link and Icon Color', 'shshortc'),
                    'param_name' => 'color',
                    'value' => '#555555',
					'description' => __('Color for Icons and links', 'shshortc')
                ),
				array(
					'type' => 'textfield',
					'heading' => __('Read More Link', 'shshortc'),
					'param_name' => 'readmorelink',
					'description' => __('Enter a url if you want to have a link to another page', 'shshortc'),
				),
				array(
                    'type' => 'textfield',
                    'heading' => __('Read More Text', 'shshortc'),
                    'param_name' => 'readmoretext',
                    'description' => __('Enter the text for the Read More link', 'shshortc'),
                ),
				array(
                    'type' => 'dropdown',
                    'heading' => __('Target', 'shshortc'),
                    'param_name' => 'target',
                    'value' => array(
                        __('New Window', 'shshortc') => '_new',
                        __('Current Window', 'shshortc') => '_self',
                    )
                ),
				array(
                    'type' => 'textfield',
                    'heading' => __('Title', 'shshortc'),
					'holder' => 'span',
                    'param_name' => 'title',
                    'description' => __('Content Box Title', 'shshortc'),
                ),
				array(
                    'type' => 'textarea_html',
                    'heading' => __('Content', 'shshortc'),
                    'param_name' => 'content',
                    'description' => __('Enter the content for this box', 'shshortc'),
                ),
				array(
                    'type' => 'dropdown',
                    'heading' => __('Use Icon or Image', 'shshortc'),
                    'param_name' => 'choice',
                    'value' => array(
                        __('Use Icon', 'shshortc') => 'icon',
                        __('Use Image', 'shshortc') => 'image',
                    )
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Choose The Icons to use:", "shshortc"),
                    "param_name" => "iconset",
                    "value" => array(
                        __("Font Awesome", "shshortc") => "fontawesome",
                        __("Linear Icons", "shshortc") => "linear",
                        __("Ion Icons", "shshortc") => "ion"
                    ),
                    "description" => __("If you are going to use Linearicons or Ionicons, make sure you've enabled them in Theme Options -> General Settings.", "shshortc"),
                    "dependency" => array (
                        "element" => "choice",
                        "value" => array("icon"),
                    ),
                ),

                array(
                    "type" => "fa_dropdown",
                    "class" => "fontawesome",
                    "heading" => __("Choose an icon", 'shshortc'),
                    "param_name" => "iconfa",
                    "value" => $icons,
                ),
                array(
                    "type" => "linear_dropdown",
                    "class" => "linearicon",
                    "heading" => __("Choose a Linearicons icon", 'shshortc'),
                    "param_name" => "iconlinear",
                    "value" => $linearicons,
                ),
                array(
                    "type" => "ion_dropdown",
                    "class" => "ionicon",
                    "heading" => __("Choose an Ionicons icon", 'shshortc'),
                    "param_name" => "iconion",
                    "value" => $ionicons,
                ),

				array(
                    "type" => "attach_image",
                    "heading" => __("Image", 'shshortc'),
                    "param_name" => "image",
                    "description" => __("Keep images small for the content box.", 'shshortc'),
					"dependency" => array (
                        "element" => "choice",
                        "value" => array("image"),
                    ),
                ),	
			)
        ) );
    }				

	
	// Countdowns
	public function short_sh_countdown() {
		
		vc_map( array(
			"name" => __("Countdown", 'shshortc'),
            "base" => "sh_countdown",
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Countdown to a future date", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
					'type' => 'textfield',
					'heading' => __('Timestamp', 'shshortc'),
					'holder' => 'span',
					'param_name' => 'date',
					'value' => '4 September 2015 00:00:00',
					'description' => __('Enter your time in this format: <b>4 September 2015 00:00:00</b> where 00:00:00 equals Hours:Minutes:Seconds', 'shshortc')
				),
				array( 
					'type' => 'dropdown', 
					'heading' => __('Style', 'shshortc'),
					'param_name' => 'style',
					'value' => array(
						__('Simple', 'shshortc') => 'simple',
						__('Bordered', 'shshortc') => 'bordered',
						__('Tiles', 'shshortc') => 'tiles'
					)
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Font Color', 'shshortc'),
					'param_name' => 'color',
				)
			)
		) );
	}

	// Dividers
	public function short_sh_divider() {
		$size = array();
		for ($i = 0; $i < 101; $i++) {
			$entry = $i . 'px';
			$size[] = $entry;
		}

        vc_map( array(
            "name" => __("Divider", 'shshortc'),
            "base" => "sh_divider",
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Horizontal Content Seperator", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
					"type" => "dropdown",
					"holder" => "span",
					"heading" => __("Divider Style", "shshortc"),
					"param_name" => "style",
					"value" => array(
						__("None", "shshortc") => "none",
						__("Single Line", "shshortc") => "single",
						__("Dashed Line", "shshortc") => "dashed",
						__("Dotted Line", "shshortc") => "dotted",
						__("Double Line", "shshortc") => "double",
						__("Double Dashed Lines", "shshortc") => "doubledash",
						__("Double Dotted Lines", "shshortc") => "doubledot",
						__("Shadow Divider", "shshortc") => "shadow",
						__("Look Down Divider", "shshortc") => "lookdown"
					),
					"description" => __("You can use none and spacing to space content", "shshortc")
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Divider Color', 'shshortc'),
					'param_name' => 'color',
					'value' => 'rgba(0,0,0,0.15)',
					"dependency" => array (
                        "element" => "style",
                        "value" => array("single","dashed", "dotted", "double", "doubledash", "doubledot", "lookdown"),
                    ),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Divider Width", "shshortc"),
					"param_name" => "shwidth",
					"value" => array(
						__("Wide", "shshortc") => "wide",
						__("Short", "shshortc") => "short",
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Spacing Top", "shshortc"),
					"param_name" => "spacetop",
					"value" => $size
				),
				array(
                    "type" => "dropdown",
                    "heading" => __("Spacing Bottom", "shshortc"),
                    "param_name" => "spacebottom",
                    "value" => $size
                ),
				array(
					"type" => "dropdown",
					"heading" => __("Enable Return to Top", "shshortc"),
					"param_name" => "totop",
					"value" => array(
						__("Disable", "shshortc") => "disable",
						__("Enable", "shshortc") => "enable",
					),
					"description" => __("Add a return to top link in the divider if you would like.", "shshortc")
				),
			)
		) );
	}

	// Blog Grid Latest Posts
	public function short_sh_bloggrid() {
		$count = array();
        for ($i = 1; $i < 21; $i++) {
            $count[] = $i;
        }
		vc_map( array(
			"name" => __("Latest Posts Grid", 'shshortc'),
            "base" => "sh_bloggrid",
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "description" => __("A grid of latest posts to add to other pages", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "span",
                    "heading" => __("Items Per Row", "shshortc"),
                    "param_name" => "perrow",
                    "value" => array(
                        __("2 Items", "shshortc") => "2",
                        __("3 Items", "shshortc") => "3",
                        __("4 Items", "shshortc") => "4",
                        __("5 Items", "shshortc") => "5",
                    ),
                    "description" => __("Number of posts per row", "shshortc")
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Total Shown", "shshortc"),
                    "param_name" => "show",
                    "value" => $count,
                ),
				array(
					"type" => "textfield",
					"heading" => __("Categories", "shshortc"),
					"param_name" => "categories",
					"description" => __("Seperate with commas, leave blank for all categories", "shshortc")
				),
            )
        ) );
    }
	
	// Portfolio Grid
	public function short_sh_portfolio() {
		$count = array();
        for ($i = 1; $i < 21; $i++) {
           	$count[] = $i;
       	}
        vc_map( array(
            "name" => __("Portfolio Grid", 'shshortc'),
            "base" => "sh_portfoliogrid",
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "description" => __("A grid of portfolio entries", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "span",
                    "heading" => __("Items Per Row", "shshortc"),
                    "param_name" => "perrow",
                    "value" => array(
                        __("2 Items", "shshortc") => "2",
                        __("3 Items", "shshortc") => "3",
                        __("4 Items", "shshortc") => "4",
                        __("5 Items", "shshortc") => "5",
						__("6 Items", "shshortc") => "6",
                    ),
                    "description" => __("Number of posts per row", "shshortc")
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Total Shown", "shshortc"),
                    "param_name" => "show",
                    "value" => $count,
                ),
				array(
					"type" => "textfield",
					"heading" => __("Categories", "shshortc"),
					"param_name" => "categories",
					"description" => __("Seperate with commas, leave blank for all categories", "shshortc")
				),
            )
        ) );
    }


	// Milestones
	public function short_sh_milestone() {
		require_once SH_ROOT_PATH.'/core/font-awesome-icons.php';
        $icons = fa_font_icons();
		require_once SH_ROOT_PATH.'/core/linear-icons.php';
		$linearicons = linearicons();
		require_once SH_ROOT_PATH.'/core/ion-icons.php';
		$ionicons = ionicons();

		vc_map( array(
			"name" => __("Milestone", "shshortc"),
			"base" => "sh_milestone",
			"icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Animated Progress Element", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => __("Starting Number", "shshortc"),
					"param_name" => "start",
					"value" => "10",
				),
				array(
					"type" => "textfield",
					"heading" => __("Stop Number", "shshortc"),
					"param_name" => "stop",
					"value" => "250"
				),

				array(
                    "type" => "dropdown",
                    "heading" => __("Icons", "shshortc"),
                    "param_name" => "enableicon",
                    "value" => array(
                        __("Enable Icons", "shshortc") => "enable"
                    ),
                 ),
                 array(
                    "type" => "dropdown",
                    "heading" => __("Choose The Icons to use:", "shshortc"),
                    "param_name" => "iconset",
                    "value" => array(
                        __("Font Awesome", "shshortc") => "fontawesome",
                        __("Linear Icons", "shshortc") => "linear",
                        __("Ion Icons", "shshortc") => "ion"
                    ),
                    "description" => __("If you are going to use Linearicons or Ionicons, make sure you've enabled them in Theme Options -> General Settings.", "shshortc"),
                ),
                array(
                    "type" => "fa_dropdown",
                    "class" => "fontawesome",
                    "heading" => __("Choose an icon", 'shshortc'),
                    "param_name" => "iconfa",
                    "value" => $icons,
                ),
                array(
                    "type" => "linear_dropdown",
                    "class" => "linearicon",
                    "heading" => __("Choose a Linearicons icon", 'shshortc'),
                    "param_name" => "iconlinear",
                    "value" => $linearicons,
                ),
                array(
                    "type" => "ion_dropdown",
                    "class" => "ionicon",
                    "heading" => __("Choose an Ionicons icon", 'shshortc'),
                    "param_name" => "iconion",
                    "value" => $ionicons,
                ),

				array(
					"type" => "colorpicker",
					"heading" => __("Icon Color", "shshortc"),
					"param_name" => "color",
					"value" => "#555",
				),
				array(
					"type" => "textfield",
					"heading" => __("Short Text Before", "shshortc"),
					"param_name" => "textbefore",
					"description" => __("Useful for symbols, leave empty if you would like", "shshortc"),
				),
				array(
                    "type" => "textfield",
                    "heading" => __("Short Text After", "shshortc"),
                    "param_name" => "textafter",
                    "description" => __("Useful for symbols, leave empty if you would like", "shshortc"),
				),
				array(
                    "type" => "textfield",
					"holder" => "span",
                    "heading" => __("Summary Below", "shshortc"),
                    "param_name" => "content",
                    "description" => __("Summary Text below the number", "shshortc"),
                ),
				array(
					"type" => "dropdown",
					"heading" => __("Size", "shshortc"),
					"param_name" => "size",
					"value" => array(
						__("Small", "shshortc") => "small",
						__("Medium", "shshortc") => "medium",
						__("Large", "shshortc") => "large",
					)
				),
				array(
                    "type" => "textfield",
                    "heading" => __("Milestone Speed", "shshortc"),
                    "param_name" => "speed",
                    "description" => __("Enter the speed in thousanths of a second (e.g. 1000 = 1 second)", "shshortc"),
					"value" => "1500"
                ),
			)
		) );
	}	
	

	// Styled Headers
	public function short_sh_header() {
		vc_map( array(
            "name" => __("Styled Header", 'shshortc'),
            "base" => "sh_header",
            "class" => "",
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Headers with style", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __("Header Size", 'shshortc'),
                    "param_name" => "size",
                    "value" => array(
						'H1' => 'h1',
						'H2' => 'h2',
						'H3' => 'h3',
						'H4' => 'h4',
						'H5' => 'h5',
						'H6' => 'h6'
					),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Header Type", 'shshortc'),
                    "param_name" => "type",
                    "value" => array(
						__('Underlined', 'shshortc') => 'underline',
                        __('Boxed', 'shshortc') => 'boxed',
                    ),
                ),
				array(
					"type" => "textfield",
					"heading" => __("Header Content", 'shshortc'),
					'holder' => 'span',
					"param_name" => "header",
					"value" => __('Your Title', 'shshortc')
				),
				array(
					"type" => "textfield",
					"heading" => __("Summary Below Header", 'shshortc'),
					"param_name" => "content",
					"value" => __('A Summary below the header if desired.', 'shshortc'),
					"dependency" => array (
                        "element" => "type",
                        "value" => array("underline"),
                    ),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Change Heading Color", "shshortc"),
					"param_name" => "colorchange",
					"value" => array(
						__("Disabled", "shshortc") => "disable",
						__("Enabled", "shshortc") => "enable"
					),
					"description" => __("Disabled keeps the default font color", "shshortc"),
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Change Header Color", "shshortc"),
					"param_name" => "color",
					"value" => "#555",
					"dependency" => array (
						"element" => "colorchange",
						"value" => array("enable"),
					),
				),
				array(
                    "type" => "textfield",
                    "heading" => __("Change Header Bar height", "shshortc"),
                    "param_name" => "barheight",
                    "value" => "2px",
                    "dependency" => array (
                        "element" => "type",
                        "value" => array("underline"),
                    ),
					"description" => __("Bar height should be in px format e.g. 2px or 3px etc.", "shshortc")
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Change Header Bar width", "shshortc"),
                    "param_name" => "barwidth",
                    "value" => "200px",
                    "dependency" => array (
                        "element" => "type",
                        "value" => array("underline"),
                    ),
                    "description" => __("Bar width should be in px format e.g. 100px or 200px etc.", "shshortc")
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Change Header Bar Color", "shshortc"),
                    "param_name" => "barcolor",
                    "value" => "#555",
                    "dependency" => array (
                        "element" => "type",
                        "value" => array("underline"),
                    ),
                ),
            )
        ) );
    }

	// quote
	public function short_sh_quote() {
        vc_map( array(
            "name" => __("Blockquote", 'shshortc'),
            "base" => "sh_quote",
            "class" => "",
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Blockquote Element Style 1", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "textarea",
                    "heading" => __("Content", 'shshortc'),
                    "param_name" => "content",
                    "value" => __("Text to quote", 'shshortc'),
                    "description" => __("Enter the text to quote.", 'shshortc')
                )
            )
        ) );
    }

	// quote 2
    public function short_sh_quote2() {
        vc_map( array(
            "name" => __("Blockquote 2", 'shshortc'),
            "base" => "sh_quote2",
            "class" => "",
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Blockquote Element Style 2", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "textarea",
                    "heading" => __("Content", 'shshortc'),
                    "param_name" => "content",
                    "value" => __("Text to quote", 'shshortc'),
                    "description" => __("Enter the text to quote.", 'shshortc')
                )
            )
        ) );
    }

	// Pullquote

	public function short_sh_pullquote() {
        vc_map( array(
            "name" => __("Pullquote", 'shshortc'),
            "base" => "sh_pullquote",
            "class" => "",
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Quote aligned left or right", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "textarea",
                    "heading" => __("Content", 'shshortc'),
                    "param_name" => "content",
                    "value" => __("The quote text", 'shshortc'),
                    "description" => __("Enter the quote.", 'shshortc')
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "span",
                    "class" => "",
                    "param_name" => "side",
                    "value" => array(
                        __('Left Side', 'shshortc') => 'left',
                        __('Right Side', 'shshortc') => 'right',
						__('Center', 'shshortc') => 'center'
                    ),
                    "description" => __("Choose the side for the quote.", 'shshortc')
                ),
				array(
                    "type" => "textfield",
					'holder' => 'span',
                    "class" => "",
                    "param_name" => "source",
                    "value" => '',
                    "description" => __("Source of quote (if wanted).", 'shshortc')
                ),

            )
        ) );
    }

	// Dropcap

	public function short_sh_dropcap() {
        vc_map( array(
            "name" => __("Dropcap", 'shshortc'),
            "base" => "sh_dropcap",
            "class" => "",
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Insert a large, styled letter", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Content", 'shshortc'),
					'holder' => 'span',
                    "param_name" => "content",
                    "value" => __("S", 'shshortc'),
                    "description" => __("Enter the letter you want to dropcap.", 'shshortc')
                ),
				array(
            		"type" => "dropdown",
            		"heading" => __("Choose Style", "shshortc"),
            		"param_name" => "style",
            		"value" => array(
						__('Theme Accent Color', 'shshortc') => 'theme',
						__('Custom Colors', 'shshortc') => 'custom',
					),
            		"description" => __("Choose a style.", "shshortc")
         		),
				array(
                    "type" => "dropdown",
                    "heading" => __("Choose Highlight", "shshortc"),
                    "param_name" => "color",
                    "value" => array(
                        __('Font Highlight', 'shshortc') => 'foreground',
                        __('Background Highlight', 'shshortc') => 'background',
                    ),
                    "dependency" => array (
                        "element" => "style",
                        "value" => array("theme"),
                    ),
                    "description" => __("Choose what to highlight.", "shshortc")
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Dropcap Font Color", "shshortc"),
                    "param_name" => "fontcolor",
                    "value" => "#555555",
                    "dependency" => array (
                        "element" => "style",
                        "value" => array("custom"),
                    ),
                    "description" => __("Choose what to highlight.", "shshortc")
                ), 
				array(
                    "type" => "dropdown",
                    "heading" => __("Set Background Color", "shshortc"),
                    "param_name" => "setbg",
                    "value" => array(
                        __('Do not set a background color', 'shshortc') => 'false',
                        __('Set background color', 'shshortc') => 'true',
                    ),
                    "dependency" => array (
                        "element" => "style",
                        "value" => array("custom"),
                    ),
                    "description" => __("Set a backgrond or just color the font.", "shshortc")
                ), 

				array(
                    "type" => "colorpicker",
                    "heading" => __("Dropcap Background Color", "shshortc"),
                    "param_name" => "background",
                    "value" => "rgba(0,0,0,0.15)",
                    "dependency" => array (
                        "element" => "setbg",
                        "value" => array("true"),
                    ),
                    "description" => __("Set a background color.", "shshortc")
                ), 
				array(
                    "type" => "dropdown",
                    "heading" => __("Set dropshadow on letter", "shshortc"),
                    "param_name" => "dropshadow",
                    "value" => array(
                        __('Do not set a dropshadow', 'shshortc') => 'false',
                        __('Set a dropshadow', 'shshortc') => 'true',
                    ),
                    "description" => __("Decide if you would like a dropshadow on the dropcap letter.", "shshortc")
                ), 
			
            )
        ) );
    }


	// highlight
	public function short_sh_highlight() {
		vc_map( array(
			"name" => __("Highlight Text", 'shshortc'),
			"base" => "sh_highlight",
			"class" => "",
			"icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Highlight a portion of text", "shshortc"),
			"category" => __('SH-Themes', 'shshortc'),
			"params" => array(
				array(
					"type" => "textarea",
					'holder' => 'span',
            		"heading" => __("Content", 'shshortc'),
            		"param_name" => "content",
            		"value" => __("Highlighted text", 'shshortc'),
            		"description" => __("Enter the text to highlight.", 'shshortc')
         		),
				array(
					'type' => 'dropdown',
					'class' => '',
					'heading' => __('Color', 'shshortc'),
					'param_name' => 'color',
					'value' => array(
						__('Accent Color', 'shshortc') => 'accentcolor',
						__('Dark Color', 'shshortc') => 'dark',
						__('Yellow', 'shshortc') => 'yellow',
						__('Custom', 'shshortc') => 'custom'
					),
					'description' => __('Choose the color of the highlight', 'shshortc')
				),
               array(
                    'type' => 'dropdown',
                    'heading' => __('Background or Foreground', 'shshortc'),
                    'param_name' => 'choice',
                    'value' => array(
                        __('Foreground', 'shshortc') => 'foreground',
                        __('Background', 'shshortc') => 'background',
                    ),
					"dependency" => array (
                        "element" => "color",
                        "value" => array("accentcolor","dark", "yellow"),
                    ),
                    'description' => __('Choose if you are highlighting the foreground or background', 'shshortc')
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Highlight Font Color", 'shshortc'),
                    "param_name" => "fontcolor",
                    "value" => '#555555',
					"dependency" => array (
                        "element" => "color",
                        "value" => array("custom"),
                    ),
                    "description" => __("Set your custom font color.", 'shshortc')
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Highlight Background Color", 'shshortc'),
                    "param_name" => "background",
                    "value" => '#fff',
                    "dependency" => array (
                        "element" => "color",
                        "value" => array("custom"),
                    ),
                    "description" => __("Set your custom background color.", 'shshortc')
                ),
				
      		)
   		) );
	}

	// Image Frame 
	public function short_sh_imageframe() {
		$size = array();
		for ($i =0; $i < 31; $i++) {
			$size[] = $i . 'px';
		}
		vc_map( array(
            "name" => __("Image Frame", 'shshortc'),
            "base" => "sh_imageframe",
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "description" => __("Add a fancy style frame to your image", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    'holder' => 'span',
                    "heading" => __("Style", 'shshortc'),
                    "param_name" => "style",
                    "value" => array(
						__("Set Only Border and Padding", 'shshortc') => 'bordered',
						__("Circle", 'shshortc') => 'circle',
						__("Circle with Shadow", 'shshortc') => 'circleshadow',
						__("Shadowed", 'shshortc') => 'shadow',
						__("Lifted", 'shshortc') => 'lifted',
						__("Side Shadows", 'shshortc') => 'sideshadow',
					),
                    "description" => __("Select the image frame style.", 'shshortc')
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Border Size", 'shshortc'),
                    "param_name" => "bordersize",
                    "value" => $size,
                    "description" => __("Set your border size.", 'shshortc')
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Border Color", 'shshortc'),
                    "param_name" => "bordercolor",
                    "value" => 'rgba(0,0,0,0.25)',
                    "description" => __("Set your border color.", 'shshortc')
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Padding", 'shshortc'),
                    "param_name" => "padding",
                    "value" => $size,
                    "description" => __("Set your padding space around the image.", 'shshortc')
                ),
				array(
                    "type" => "attach_image",
                    "heading" => __("Image", 'shshortc'),
                    "param_name" => "source",
                    "description" => __("Select the image to use (single image).", 'shshortc')
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Action", 'shshortc'),
                    "param_name" => "action",
                    "value" => array(
						__('None', 'shshortc') => 'none',
						__('URL', 'shshortc') => 'url',
						__('Lightbox', 'shshortc') => 'fancybox'
					),
                    "description" => __("Select if you want the image to link to a url or open a larger one in a lightbox.", 'shshortc')
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Hover Effect", 'shshortc'),
                    "param_name" => "hover",
                    "value" => array(
						__('Disable', 'shshortc') => 'disable',
						__('Enable', 'shshortc') => 'enable'
					),
                    "description" => __("Select if you would like the hover effect enabled with your theme accent color.", 'shshortc'),
					"dependency" => array (
                        "element" => "action",
                        "value" => array("url","fancybox"),
                    ),
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Title", 'shshortc'),
                    "param_name" => "title",
                    "description" => __("Set a title for your image (on hover and in lightbox).", 'shshortc'),
					"dependency" => array (
                        "element" => "action",
                        "value" => array("url","fancybox"),
                    ),
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Link URL", 'shshortc'),
                    "param_name" => "url",
                    "description" => __("Set the url that clicking the image will go to.  example: http://www.example.com", 'shshortc'),
					"dependency" => array (
                        "element" => "action",
                        "value" => array("url"),
                    ),
                ),
            )
        ) );
    }

	// Font Awesome Icons
	public function short_sh_fa() {
		require_once SH_ROOT_PATH.'/core/font-awesome-icons.php';
		$icons = fa_font_icons();
		require_once SH_ROOT_PATH.'/core/linear-icons.php';
		$linearicons = linearicons();
		require_once SH_ROOT_PATH.'/core/ion-icons.php';
		$ionicons = ionicons();

		vc_map( array(
			"name" => __("Icon", 'shshortc'),
			"base" => "sh_fa",
			"class" => "sh-fontawesome",
			"icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Icons with many choices", "shshortc"),
			"admin_enqueue_css" => array( SH_ROOT_URL . '/css/vc-admin.css'),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
				 array(
					"type" => "dropdown",
					"heading" => __("Icons", "shshortc"),
					"param_name" => "enableicon",
					"value" => array(
						__("Enable Icons", "shshortc") => "enable"
					),
				 ),
				 array(
                    "type" => "dropdown",
                    "heading" => __("Choose The Icons to use:", "shshortc"),
					"class" => 'sh-fa',
                    "param_name" => "iconset",
                    "value" => array(
                        __("Font Awesome", "shshortc") => "fontawesome",
                        __("Linear Icons", "shshortc") => "linear",
                        __("Ion Icons", "shshortc") => "ion"
                    ),
                    "description" => __("If you are going to use Linearicons or Ionicons, make sure you've enabled them in Theme Op
tions -> General Settings.", "shshortc"),
                ),

                array(
                    "type" => "fa_dropdown",
                    "class" => "fontawesome",
                    "heading" => __("Choose an icon", 'shshortc'),
                    "param_name" => "iconfa",
                    "value" => $icons,
                ),
                array(
                    "type" => "linear_dropdown",
                    "class" => "linearicon",
                    "heading" => __("Choose a Linearicons icon", 'shshortc'),
                    "param_name" => "iconlinear",
                    "value" => $linearicons,
                ),
                array(
                    "type" => "ion_dropdown",
                    "class" => "ionicon",
                    "heading" => __("Choose an Ionicons icon", 'shshortc'),
                    "param_name" => "iconion",
                    "value" => $ionicons,
                ),

				array(
					"type" => "checkbox",
					"heading" => __("Enable Link", "shshortc"),
					"param_name" => "link",
					"value" => array(
						__("Enable", "shshortc") => "enable",
						__("Disable", "shshortc") => "disable"
					)
				),
				array(
					"type" => "textfield",
					"heading" => __("Enter the URL", 'shshortc'),
					"param_name" => 'url',
					'value' => 'http://www.example.com',
					'description' => __('Enter the URL', 'shshortc'),
					"dependency" => array (
                        "element" => "link",
                        "value" => array("enable"),
                    ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Select New Window or Same Window', "shshortc"),
					'param_name' => 'target',
					'value' => array(
						'New Window' => '_blank',
						'Same Window' => '_self'
					),
					"dependency" => array (
                        "element" => "link",
                        "value" => array("enable"),
                    ),
				),
				array(
                    'type' => 'dropdown',
                    'heading' => __('Select the icon size', 'shshortc'),
                    'param_name' => 'size',
                    'value' => array(
                        'Standard' => '',
                        '2 x the size' => '2x',
						'3 x the size' => '3x',
						'4 x the size' => '4x',
						'5 x the size' => '5x',
                    ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Font Color', 'shshortc'),
					'param_name' => 'fontcolor',
					'value' => '#555',
				),
				array(
					'type' => 'checkbox',
					'heading' => __('Enable Icon Spin', 'shshortc'),
					'param_name' => 'spin',
					'value' => array(
						__('Enable', 'shshortc') => 'enable',
						__('Disable', 'shshortc') => 'disable'
					),
					"dependency" => array (
                        "element" => "iconset",
                        "value" => array("fontawesome"),
                    ),
				),
				array(
                    'type' => 'checkbox',
                    'heading' => __('Enable Circle Surround', 'shshortc'),
                    'param_name' => 'enablecircle',
                    'value' => array(
                        __('Enable', 'shshortc') => 'enable',
                        __('Disable', 'shshortc') => 'disable'
                    ),
                ),
				array(
                    'type' => 'colorpicker',
                    'heading' => __('Surround Color', 'shshortc'),
                    'param_name' => 'circlecolor',
                    'value' => '#fff',
					"dependency" => array (
						"element" => "enablecircle",
						"value" => array("enable"),
					),
                ),  
				array(
                    'type' => 'colorpicker',
                    'heading' => __('Border Color', 'shshortc'),
                    'param_name' => 'bordercolor',
                    'value' => '#555',
					'dependency' => array (
                        'element' => 'enablecircle',
                        'value' => array('enable')
                    ),
                ),  

			)
		) );
	}

	// Buttons
	public function short_sh_btn() {
		require_once SH_ROOT_PATH. '/core/font-awesome-icons.php';
		$icons = fa_font_icons();
		require_once SH_ROOT_PATH.'/core/linear-icons.php';
        $linearicons = linearicons();
        require_once SH_ROOT_PATH.'/core/ion-icons.php';
        $ionicons = ionicons();

		$borderSizes = array();
		for ($i = 0; $i < 25; $i++) {
			$borderSizes[] = $i;
		}
		vc_map( array(
			"name" => __("Buttons", 'shshortc'),
			"base" => "sh_btn",
			"icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Beautiful Buttons", "shshortc"),
			"admin_enqueue_css" => array( SH_ROOT_URL . '/css/vc-admin.css'),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
				array(
					"type" => "textfield",
					'holder' => 'span',
					"heading" => __("Button Text:", "shshortc"),
					"param_name" => "content",
					"value" => __("Enter The Button Text", "shshortc")
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Link:", "shshortc"),
					"param_name" => "link",
					"value" => __("http://www.example.com", "shshortc")
				),
				array(
					"type" => "dropdown",
					"heading" => __("Button Target", "shshortc"),
					"param_name" => "target",
					"value" => array(
						__("New Window", "shshortc") => "_blank",
						__("Same Window", "shshortc") => "_self"
					)
				),
				array(
					"type" => "dropdown",
					"heading" => __("Use Icons:", "shshortc"),
					"param_name" => "enableicon",
					"value" => array(
						__("Disable", "shshortc") => "disable",
						__("Enabled", "shshortc") => "enable"
					)
				),
				array(
					"type" => "dropdown",
					"heading" => __("Icon Background Style", "shshortc"),
					"param_name" => "iconbg",
					"value" => array(
						__("Flat (Same Background as Button)", "shshortc") => "flat",
						__("Square (Offset darker background)", "shshortc") => "square",
						__("Diagonal (Diagonal cut darker background)", "shshortc") => "diagonal"
					),
					"dependency" => array (
                        "element" => "enableicon",
                        "value" => array("enable"),
                    ),
				),

				array(
                    "type" => "dropdown",
                    "heading" => __("Choose The Icons to use:", "shshortc"),
                    "param_name" => "iconset",
                    "value" => array(
                        __("Font Awesome", "shshortc") => "fontawesome",
                        __("Linear Icons", "shshortc") => "linear",
                        __("Ion Icons", "shshortc") => "ion"
                    ),
                    "description" => __("If you are going to use Linearicons or Ionicons, make sure you've enabled them in Theme Options -> General Settings.", "shshortc"),
                    "dependency" => array (
                        "element" => "enableicon",
                        "value" => array("enable"),
                    ),
                ),
				array(
                    "type" => "fa_dropdown",
                    "class" => "fontawesome",
                    "heading" => __("Choose an icon", 'shshortc'),
                    "param_name" => "iconfa",
                    "value" => $icons,
                ),
                array(
                    "type" => "linear_dropdown",
                    "class" => "linearicon",
                    "heading" => __("Choose a Linearicons icon", 'shshortc'),
                    "param_name" => "iconlinear",
                    "value" => $linearicons,
                ),
                array(
                    "type" => "ion_dropdown",
                    "class" => "ionicon",
                    "heading" => __("Choose an Ionicons icon", 'shshortc'),
                    "param_name" => "iconion",
                    "value" => $ionicons,
                ),

				array(
					"type" => "dropdown",
					"heading" => __("Button Size:", "shshortc"),
					"param_name" => "size",
					"value" => array(
						__("Small", "shshortc") => "small",
						__("Medium", "shshortc") => "medium",
						__("Large", "shshortc") => "large",
						__("Extra Large", "shshortc") => "extralarge"
					),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Button Shape:", "shshortc"),
					"param_name" => "shape",
					"value" => array(
						__("Square", "shshortc") => "square",
						__("Square Rounded", "shshortc") => "squareRounded",
						__("Round", "shshortc") => "round"
					)
				),
				array(
					"type" => "dropdown",
					"heading" => __("Button Style:", "shshortc"),
					"param_name" => "style",
					"value" => array(
						__("Flat Styled", "shshortc") => "flat",
						__("3D Styled", "shshortc") => "dimension"
					)
				),
				array(
					"type" => "dropdown",
					"heading" => __("Enable Hover:", "shshortc"),
					"param_name" => "enablehover",
					"value" => array(
						__("Enable", "shshortc") => "enable",
						__("Disable", "shshortc") => "disable"
					)
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Button Color:", "shshortc"),
					"param_name" => "color",
					"value" => "#f00"
				),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Border Color:", "shshortc"),
                    "param_name" => "bordercolor",
                    "value" => "#f00"
                ),
				array(
					"type" => "dropdown",
					"heading" => __("Border Size:", "shshortc"),
					"param_name" => "bordersize",
					"value" => $borderSizes,
					"description" => __("Border size of 0 means no border", "shshortc")
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Font Color:", "shshortc"),
					"param_name" => "fontcolor",
					"value" => "#fff"
				)
			)
		) );
	}

	// double bar headers
	public function short_sh_headerdouble() {
        vc_map( array(
            "name" => __("Header Double Bar", 'shshortc'),
            "base" => "sh_headerdouble",
            "class" => "",
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Header with two bars inline", "shshortc"),
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "textfield",
					'holder' => 'span',
                    "heading" => __("Content", 'shshortc'),
                    "param_name" => "content",
                    "value" => __("Section Title", 'shshortc'),
                    "description" => __("Enter the header text.", 'shshortc')
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Size", 'shshortc'),
                    "param_name" => "size",
                    "value" => array(
                        'h1' => 'h1',
                        'h2' => 'h2',
                        'h3' => 'h3',
                        'h4' => 'h4',
						'h5' => 'h5',
						'h6' => 'h6'
                    ),
                    "description" => __("Choose a Header size.", 'shshortc')
                ),

            )
        ) );
    }

	// Checklists 
	public function short_sh_checklist() {
        require_once SH_ROOT_PATH.'/core/font-awesome-icons.php';
        $icons = fa_font_icons();
		require_once SH_ROOT_PATH.'/core/linear-icons.php';
		$linearicons = linearicons();
		require_once SH_ROOT_PATH.'/core/ion-icons.php';
		$ionicons = ionicons();

        vc_map( array(
            "name" => __("List", 'shshortc'),
            "base" => "shvc_checklist",
            "as_parent" => array('only' => 'shvc_checklist_item'),
            'content_element' => true,
            "show_settings_on_create" => true,
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"description" => __("Add a styled checklist", "shshortc"),

            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Select List Type", "shshortc"),
                    "param_name" => "type",
                    "value" => array(
                        __('Unordered', 'shshortc') => 'unordered',
                        __('Ordered', 'shshortc') => 'ordered'
                    ),
                ),

				array(
                    "type" => "dropdown",
                    "heading" => __("Choose The Icons to use:", "shshortc"),
                    "param_name" => "iconset",
                    "value" => array(
                        __("Font Awesome", "shshortc") => "fontawesome",
                        __("Linear Icons", "shshortc") => "linear",
                        __("Ion Icons", "shshortc") => "ion"
                    ),
                    "description" => __("If you are going to use Linearicons or Ionicons, make sure you've enabled them in Theme Options -> General Settings.", "shshortc"),
					"dependency" => array (
                        "element" => "type",
                        "value" => array("unordered"),
                    ),
                ),
                array(
                    "type" => "fa_dropdown",
                    "class" => "fontawesome",
                    "heading" => __("Choose an icon", 'shshortc'),
                    "param_name" => "iconfa",
                    "value" => $icons,
                ),
                array(
                    "type" => "linear_dropdown",
                    "class" => "linearicon",
                    "heading" => __("Choose a Linearicons icon", 'shshortc'),
                    "param_name" => "iconlinear",
                    "value" => $linearicons,
                ),
                array(
                    "type" => "ion_dropdown",
                    "class" => "ionicon",
                    "heading" => __("Choose an Ionicons icon", 'shshortc'),
                    "param_name" => "iconion",
                    "value" => $ionicons,
                ),	

                array(
                    'type' => 'dropdown',
                    'heading' => __('Bullet Background:', 'shshortc'),
                    'param_name' => 'background',
                    'value' => array(
                        __('Disable', 'shshortc') => 'disable',
						__('Enable', 'shshortc') => 'enable',
                    ),
                ),
				array(
					'type' => 'dropdown',
					'heading' => __('Use Custom Colors:', 'shshortc'),
					'param_name' => 'customcolor',
					'value' => array(
						__('False - Theme Accent used', 'shshortc') => 'false',
						__('True - Override Theme Accent', 'shshortc') => 'true',
					),
					"dependency" => array (
                        "element" => "background",
                        "value" => array("enable"),
                    ),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Bullet Background Color:', 'shshortc'),
					'param_name' => 'backgroundcolor',
					'value' => '#555555',
					"dependency" => array (
                        "element" => "customcolor",
                        "value" => array("true"),
                    ),
				),
				array(
                    'type' => 'colorpicker',
                    'heading' => __('Bullet Font Color:', 'shshortc'),
                    'param_name' => 'fontcolor',
                    'value' => '#ffffff',
                    "dependency" => array (
                        "element" => "customcolor",
                        "value" => array("true"),
                    ),
                ),
            ),
			'default_content' => '
    			[shvc_checklist_item]' . __( 'checklist item 1', 'js_composer' ) . '[/shvc_checklist_item]
    			[shvc_checklist_item]' . __( 'checklist item 2', 'js_composer' ) . '[/shvc_checklist_item]',
			"js_view" => 'VcColumnView'
        ) );
		// checklist items
        vc_map( array(
            "name" => __('Checklist Item', 'shshortc'),
            "base" => "shvc_checklist_item",
            "content_element" => true,
			"icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "as_child" => array("only" => "shvc_checklist"),
            'params' => array(
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "heading" => __("Enter Text", 'shshortc'),
                    "param_name" => "content",
                    "value" => __("Checklist item text", 'shshortc'),
                    "description" => __("Enter the checklist item text.", 'shshortc')
                ),
            ),
        ) );
	}

	// Pricing Tables
	public function short_sh_pricetable() {
		vc_map( array(
            "name" => __("Price Table", 'shshortc'),
            "base" => "shvc_pricetable",
			"description" => __("Tables to organize pricing plans", "shshortc"),
            "as_parent" => array('only' => 'shvc_pricetable_col'),
            'content_element' => true,
            "show_settings_on_create" => true,
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",

            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
				array(
					"type" => "dropdown",
					"holder" => "span",
					"heading" => __("Number of Columns", "shshortc"),
					"param_name" => "columns",
					"value" => array(
						__("Three Columns", "shshortc") => 3,
						__("One Column", "shshortc") => 1,
						__("Two Columns", "shshortc") => 2,
						__("Three Columns", "shshortc") => 3,
						__("Four Columns", "shshortc") => 4,
						__("Five Columns", "shshortc") => 5,
						__("Six Columns", "shshortc") => 6
					),
					"description" => __("<u>Please Note:</u>Column count must actually match the number of Columns you add to the price table or things will not work right.  So if you plan on using four columns choose 4 here and add your 4 columns.", "shshortc"),
				),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Select Style", "shshortc"),
                    "param_name" => "style",
                    "value" => array(
                        __('Colored Columns', 'shshortc') => 'color',
                        __('Light Colored Columns', 'shshortc') => 'light'
                    ),
                ),
			),
			'default_content' => '
				[shvc_pricetable_col title="Column 1" colcolor="#2ecc71" cost="14.99/month" btntext="Order Now!" btnlink="#" btntarget="new"]<p>Item 1</p><p>Item 2</p><p>Item 3</p>[/shvc_pricetable_col]
[shvc_pricetable_col title="Column 2" colcolor="#3498db" cost="14.99/month" btntext="Order Now!" btnlink="#" btntarget="new" tag="Best Value!"]<p>Item 1</p><p>Item 2</p><p>Item 3</p>[/shvc_pricetable_col]
[shvc_pricetable_col title="Column 3" colcolor="#e74c3c" cost="14.99/month" btntext="Order Now!" btnlink="#" btntarget="new" highlight="true"]<p>Item 1</p><p>Item 2</p><p>Item 3</p>[/shvc_pricetable_col]',
            "js_view" => 'VcColumnView'
		) );
		// Price Table Columns
		vc_map( array(
			"name" => __("Price Table Column", "shshortc"),
			"base" => "shvc_pricetable_col",
			"content_element" => true,
			"icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"as_child" => array("only" => "shvc_pricetable"),
			"params" => array(
				array(
					"type" => "textfield",
					"holder" => "span",
					"heading" => __("Column Title", "shshortc"),
					"param_name" => "title",
					"value" => __("Column Title", "shshortc"),
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Column Color", "shshortc"),
					"param_name" => "colcolor",
					"value" => "#2ecc71",
				),
				array(
					"type" => "dropdown",
					"heading" => __("Highlight This Column?","shshortc"),
					"param_name" => "highlight",
					"value" => array(
						__("Don't Highlight This Column", "shshortc") => "false",
						__("Highlight This Column", "shshortc") => "true", 
					),
					"description" => __("You should probably only have at most one column highlighted per price table.", "shshortc"), 
				),
				array( 
					"type" => "textfield",
					"heading" => __("Enter Cost Details", "shshortc"),
					"param_name" => "cost",
					"value" => "29.99/month",
				),
				array( 
					"type" => "textfield",
					"heading" => __("Short Tag", "shshortc"),
					"param_name" => "tag",
					"value" => "",
					"description" => __("Enter a short tag if you would like, this will show up as a rotated text at the top right of the column.  Keep it short e.g. Hi-Speed or Best Value!.", "shshortc"),
				),
				array( 
					"type" => "textfield", 
					"heading" => __("Button Text", "shshortc"),
					"param_name" => "btntext",
					"value" => __("Order Now!", "shshortc"),
				),
				array( 
					"type" => "textfield",
					"heading" => __("Button Link", "shshortc"),
					"param_name" => "btnlink",
					"description" => __("Enter a complete url e.g. http://www.example.com", "shshortc"),
				),
				array( 
					"type" => "dropdown", 
					"heading" => __("Button Target", "shshortc"),
					"param_name" => "btntarget",
					"value" => array(
						__("New Window", "shshortc") => "_blank",
						__("Same Window", "shshortc") => "_self",
					),
				),
				array(
					"type" => "textarea_html",
					"heading" => __("Content", "shshortc"),
					"param_name" => "content",
					"value" => "<p>Item 1</p><p>Item 2</p><p>Item 3</p>",
					"description" => __("Enter a few points for this column, use paragraphs or lists for each row", "shshortc"),
				),
			),
		) );
	}

	// Tables
    public function short_sh_table() {
		$columns = array();
		for ($i = 1; $i <= 50; $i++) {
			$columns[] = $i;
		}

        vc_map( array(
            "name" => __("Table", 'shshortc'),
            "base" => "shvc_table",
            "description" => __("Tables to organize data", "shshortc"),
            "as_parent" => array('only' => 'shvc_table_row,shvc_table_head'),
            'content_element' => true,
            "show_settings_on_create" => true,
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",

            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "heading" => __("Select Style", "shshortc"),
                    "param_name" => "style",
                    "value" => array(
                        __('Bordered Table', 'shshortc') => 'bordered',
                        __('No Border', 'shshortc') => 'noborder'
                    ),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Row Background Color", "shshortc"),
                    "param_name" => "tr_bgcolor",
                    "value" => '#f9f9f9',
                    "description" => __("Set The Row Background Color.", "shshortc"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => __("Row Alternate Background Color", "shshortc"),
                    "param_name" => "tr_altbgcolor",
                    "value" => '#ffffff',
                    "description" => __("Set The Alternate Row Background color.", "shshortc"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => __("Border Color", "shshortc"),
                    "param_name" => "bordercolor",
                    "value" => '#dddddd',
                    "description" => __("Set The Table Border color (if borders are used).", "shshortc"),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Hover Color", "shshortc"),
                    "param_name" => "hovercolor",
                    "value" => '#f5f5f5',
                    "description" => __("Set The Table Row Hover Color.", "shshortc"),
                ),
            ),
            'default_content' => '
                [shvc_table_head]' . __('Head 1,, Head 2,, Head 3,, Head 4,, Head 5', 'shshortc') . '[/shvc_table_head]
				[shvc_table_row]' . __('Data 1,, Data 2,, Data 3,, Data 4,, Data 5', 'shshortc') . '[/shvc_table_row]
				[shvc_table_row]' . __('Data 1,, Data 2,, Data 3,, Data 4,, Data 5', 'shshortc') . '[/shvc_table_row]
				[shvc_table_row]' . __('Data 1,, Data 2,, Data 3,, Data 4,, Data 5', 'shshortc') . '[/shvc_table_row]',
            "js_view" => 'VcColumnView'
        ) );
        // Table Head Row
        vc_map( array(
            "name" => __("Table Head Row", "shshortc"),
            "base" => "shvc_table_head",
            "content_element" => true,
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "as_child" => array("only" => "shvc_table"),
            "params" => array(
                array(
                    "type" => "textfield",
                    "holder" => "span",
					"param_name" => "content",
                    "heading" => __("Head Row Data", "shshortc"),
					"value" => __('Head 1,, Head 2,, Head 3,, Head 4,, Head 5', 'shshortc'),
					"description" => __("Insert your data seperated by double commas (e.g. data1,, data2,,).  Match the number of columns set in the table container settings.", "shshortc"),
				),
			)
		) );
		// Table Row
		vc_map( array(
            "name" => __("Table Row", "shshortc"),
            "base" => "shvc_table_row",
            "content_element" => true,
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "as_child" => array("only" => "shvc_table"),
            "params" => array(
                array(
                    "type" => "textfield",
                    "holder" => "span",
					"param_name" => "content",
                    "heading" => __("Head Row Data", "shshortc"),
					"value" => __('Data 1,, Data 2,, Data 3,, Data 4,, Data 5', 'shshortc'),
                    "description" => __("Insert your data seperated by double commas (e.g. data1,, data2,,).  Match the number of co
lumns set in the table container settings.", "shshortc"),
                ),
            )
        ) );
	}

	// Testimonial Carousels and Individual Testimonials
    public function short_sh_testimonials() {

        vc_map( array(
            "name" => __("Testimonial Carousel", 'shshortc'),
            "base" => "shvc_testimonialc",
            "as_parent" => array('only' => 'shvc_testimonial'),
            'content_element' => true,
            "show_settings_on_create" => true,
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "description" => __("Add a Testimonial Carousel", "shshortc"),

            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Pause Per Slide", "shshortc"),
                    "param_name" => "pause",
                    "value" => '5000',
                    "description" => __("Pause time per slide (e.g. 5000) 1000 = 1 second.", "shshortc"),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Slide Transition", "shshortc"),
                    "param_name" => "transition",
                    "value" => array(
						__('Fade To Next', 'shshortc') => 'fade',
						__('Horizontal Slide', 'shshortc') => 'horizontal',
						__('Vertical Slide', 'shshortc') => 'vertical',
					),
                    "description" => __("Slide Transition Effects.", "shshortc"),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Slide Container Adapt", "shshortc"),
                    "param_name" => "adapt",
                    "value" => array(
                        __('True - Slide show changes height', 'shshortc') => 'true',
                        __('False - Slide show retains size', 'shshortc') => 'false',
                    ),
                    "description" => __("Slideshow height can adapt to each slide height.", "shshortc"),
                ),
            ),
            'default_content' => '
                [shvc_testimonial name="' . __('Name', 'shshortc') . '" title="' . __('Title', 'shshortc') . '"]'
                    . __( 'Add your testimonial', 'shshortc' ) . '[/shvc_accord_item]
				[shvc_testimonial name="' . __('Name', 'shshortc') . '" title="' . __('Title', 'shshortc') . '"]'
                    . __( 'Add your testimonial', 'shshortc' ) . '[/shvc_accord_item]',
            "js_view" => 'VcColumnView'
        ) );
        // Individual Testimonials
        vc_map( array(
            "name" => __('Testimonial', 'shshortc'),
            "base" => "shvc_testimonial",
            "content_element" => true,
			'description' => __('Individual Testimonial', 'shshortc'),
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            //"as_child" => array("shvc_testimonialc"),
			"category" => __('SH-Themes', 'shshortc'),
            'params' => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Name", "shshortc"),
					"holder" => 'span',
                    "param_name" => "name",
                    "description" => __("The Name of the person giving the testimonial.", "shshortc"),
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Title", "shshortc"),
                    "param_name" => "title",
                    "description" => __("The title of the person giving the testimonial", "shshortc"),
                ),
				array(
					"type" => "attach_image",
					"heading" => __('Attach a photo', 'shshortc'),
					'param_name' => 'image',
					'description' => __('Optionally add a small image for the person.', 'shshortc'),
				),
                array(
                    "type" => "textarea_html",
                    "heading" => __("The Testimonial", 'shshortc'),
                    "param_name" => "content",
                    "value" => __("Enter The Testimonial", 'shshortc'),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Font Color", "shshortc"),
                    "param_name" => "fontcolor",
                    "value" => '#828282',
                    "description" => __("Set The Testimonial Font Color.", "shshortc"),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Background Color", "shshortc"),
                    "param_name" => "bgcolor",
                    "value" => '#f6f6f6',
                    "description" => __("Set The Testimonial Background color.", "shshortc"),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Border Color", "shshortc"),
                    "param_name" => "bordercolor",
                    "value" => '#c8c8c8',
                    "description" => __("Set The Testimonial Border color.", "shshortc"),
                ),
            ),
        ) );
    }

	// Color Background Section Shortcode - arrows can overlap other sections 
	public function short_sh_colorbg() {
        vc_map( array(
            "name" => __("Color Background Section", 'shshortc'),
            "heading" => __("Color Background Section", "shshortc"),
            "base" => "shvc_colorbg",
            "description" => __("Color background section with Content", "shshortc"),
            "as_parent" => array('except' => 'shvc_parallax'),
            "content_element" => true,
            "show_settings_on_create" => true,
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "colorpicker",
                    "heading" => __("Background Color", "shshortc"),
                    "param_name" => "backgroundcolor",
                    "value" => 'rgba(0,0,0,1)',
                    "description" => __("Set the Background color.", "shshortc"),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => __("Font Color", "shshortc"),
                    "param_name" => "fontcolor",
                    "value" => '#ffffff',
                    "description" => __("Set the Section Font Color.", "shshortc"),
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Enable Bottom, Top, or No Arrow for the section.", "shshortc"),
                    "holder" => "span",
                    "param_name" => "arrower",
                    "value" => array(
                        __('None', 'shshortc') => 'none',
                        __('Bottom', 'shshortc') => 'bottom',
                        __('Top', 'shshortc') => 'top',
                    ),
                    "description" => __("The section can include a bottom or top arrow with the background, it can also overlap other sections.", "shshortc"),
                ),
            ),
            "js_view" => 'VcColumnView'
        ) );
    }

	// Image Background Section
	public function short_sh_imagebg() {
		vc_map( array(
			"name" => __("Image Background Section", 'shshortc'),
			"heading" => __("Image Background", "shshortc"),
			"base" => "shvc_imagebg",
			"description" => __("Image background with Content", "shshortc"),
			"as_parent" => array('except' => 'shvc_parallax'),
			"content_element" => true,
			"show_settings_on_create" => true,
			"icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
			"category" => __('SH-Themes', 'shshortc'),
			"params" => array(
				array(
					"type" => "attach_image",
					"heading" => __("Background Image to use", "shshortc"),
					"param_name" => "background",
					"description" => __("Attach a background image for this section", "shshortc"),
				),
				array(
                    "type" => "dropdown",
                    "heading" => __("Choose Full Image or Repeat", "shshortc"),
                    "holder" => "span",
                    "param_name" => "bgrepeat",
                    "value" => array(
                        __('Full / Cover', 'shshortc') => 'cover',
                        __('Repeat', 'shshortc') => 'repeat',
                    ),
                    "description" => __("Is this a large image or small and meant to repeat.", "shshortc"),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Overlay Color", "shshortc"),
                    "param_name" => "overlaycolor",
                    "value" => 'rgba(0,0,0,0.33)',
                    "description" => __("Set the Overlay color.", "shshortc"),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Font Color", "shshortc"),
                    "param_name" => "fontcolor",
                    "value" => '#ffffff',
                    "description" => __("Set the Section Font Color.", "shshortc"),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Enable Bottom, Top, or No Arrow for the section.", "shshortc"),
                    "holder" => "span",
                    "param_name" => "arrower",
                    "value" => array(
                        __('None', 'shshortc') => 'none',
                        __('Bottom', 'shshortc') => 'bottom',
						__('Top', 'shshortc') => 'top',
                    ),
                    "description" => __("The section can include a bottom or top arrow with the background.", "shshortc"),
                ),
			),
            "js_view" => 'VcColumnView'
        ) );
    }

	// Parallax
    public function short_sh_parallax() {
        vc_map( array(
            "name" => __("Parallax, Fixed, Solid and Video Background", 'shshortc'),
            "heading" => __("Parallax", "shshortc"),
            "base" => "shvc_parallax",
            "description" => __("Parallax, Video, Fixed or Solid background container", "shshortc"),
            "as_parent" => array('except' => 'shvc_parallax'),
            'content_element' => true,
            "show_settings_on_create" => true,
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __("Choose section background", "shshortc"),
					"holder" => "span",
                    "param_name" => "backgroundchoice",
                    "value" => array(
                        __('Solid Color', 'shshortc') => 'solid',
                        __('Parallax', 'shshortc') => 'parallax',
						__('Fixed', 'shshortc') => 'fixed',
                        __('Video', 'shshortc') => 'video',
                    ),
                    "description" => __("Choose the type of background to use.", "shshortc"),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Background Color", "shshortc"),
                    "param_name" => "bgcolor",
                    "value" => '#555',
                    "description" => __("Set the Background color.", "shshortc"),
                    "dependency" => array (
                        "element" => "backgroundchoice",
                        "value" => array("solid"),
                    ),
                ),
				array(
                    "type" => "attach_image",
                    "heading" => __("Background Image to use", "shshortc"),
                    "param_name" => "background",
                    "description" => __("Attach a background image for the Parallax", "shshortc"),
					"dependency" => array (
                        "element" => "backgroundchoice",
                        "value" => array("parallax", "fixed", "video"),
                    ),
                ),
				array(
                    "type" => "vc_link",
                    "heading" => __("Background Video URL MP4", "shshortc"),
                    "param_name" => "videourlmp4",
                    "description" => __("Attach the mp4 video.  All that matters is the URL", "shshortc"),
                    "dependency" => array (
                        "element" => "backgroundchoice",
                        "value" => array("video"),
                    ),
                ),
				array(
                    "type" => "vc_link",
                    "heading" => __("Background Video URL WEBM", "shshortc"),
                    "param_name" => "videourlwebm",
                    "description" => __("Attach the WEBM video (optional).  All that matters is the URL", "shshortc"),
                    "dependency" => array (
                        "element" => "backgroundchoice",
                        "value" => array("video"),
                    ),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Overlay Color", "shshortc"),
                    "param_name" => "overlaycolor",
                    "value" => 'rgba(0,0,0,0.25)',
                    "description" => __("Set the overlay color and opacity (keep the opacity low so the image comes through.", "shshortc"),
                    "dependency" => array (
                        "element" => "backgroundchoice",
                        "value" => array("parallax", "fixed", "video"),
                    ),
                ),	
				array(
                    "type" => "colorpicker",
                    "heading" => __("Text Color", "shshortc"),
                    "param_name" => "fontcolor",
                    "value" => '#fff',
                    "description" => __("Set the Background text color.", "shshortc"),
                ),
				array(
					"type" => "dropdown",
                    "heading" => __("Enable Bottom Shadow", "shshortc"),
                    "param_name" => "bottomshadow",
                    "value" => array(
                        __('Disable', 'shshortc') => 'disable',
                        __('Enable', 'shshortc') => 'enable',
                    ),
                    "description" => __("Add a section bottom shadow effect (does not apply to video).  Use solid color backgrounds if doing a colored section.", "shshortc"),
					"dependency" => array (
                        "element" => "backgroundchoice",
                        "value" => array("solid","parallax", "fixed"),
                    ),
                ),
            ),
            "js_view" => 'VcColumnView'
        ) );
    }

	// People
	public function short_sh_people() { 
		vc_map( array(
            "name" => __("People", 'shshortc'),
            "base" => "sh_people",
            "description" => __("Add Team Members or People to a page.", "shshortc"),
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",

            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "textfield",
					"holder" => "span",
                    "heading" => __("The Person Post ID", "shshortc"),
                    "param_name" => "postid",
                    "value" => '',
                    "description" => __("The Custom Post ID for the Person (Can be found in the page edit url w
hen creating People and looks like <b>post=1524</b>.  You just need the number.", "shshortc"),
                ),
			),
        ) );
    }


	// Popovers
    public function short_sh_popover() {
        vc_map( array(
            "name" => __("Popover", 'shshortc'),
			"heading" => __("Popover", "shshortc"),
            "base" => "shvc_popover",
            "description" => __("Popover container that you can add other items to display a popover", "shshortc"),
            "as_parent" => array('except' => 'shvc_parallax'),
            'content_element' => true,
            "show_settings_on_create" => true,
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",

            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __("Placement", "shshortc"),
                    "param_name" => "placement",
                    "value" => array(
						__('Top', 'shshortc') => 'top',
						__('Left', 'shshortc') => 'left',
						__('Right', 'shshortc') => 'right',
						__('bottom', 'shshortc') => 'bottom'
					),
                    "description" => __("Choose where the popup will display.", "shshortc"),
                ),
				array(
                    "type" => "textfield",
                    "holder" => "span",
                    "heading" => __("Title", "shshortc"),
                    "param_name" => "title",
                    "description" => __("Set a Title for your popover if you would like.", "shshortc"),
                ),
				array(
                    "type" => "textarea",
                    "heading" => __("Text", "shshortc"),
                    "param_name" => "pcontent",
                    "value" => __('Popover content text', 'shshortc'),
                    "description" => __("Set the text that you want to show in the popover.", "shshortc"),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Trigger", "shshortc"),
                    "param_name" => "trigger",
                    "value" => array(
                        __('Hover', 'shshortc') => 'hover',
                        __('Click', 'shshortc') => 'click',
                    ),
                    "description" => __("Set if you want the popover to show on hover or click.", "shshortc"),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Change The Default Colors", "shshortc"),
                    "param_name" => "colorchange",
                    "value" => array(
                        __('Disable', 'shshortc') => 'disable',
                        __('Enable', 'shshortc') => 'enable',
                    ),
                    "description" => __("Do you want to change the default colors?", "shshortc"),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Title Font Color", "shshortc"),
                    "param_name" => "titlecolor",
                    "value" => 'rgb(109,109,109)',
                    "description" => __("Set the Title font color.", "shshortc"),
					"dependency" => array (
                        "element" => "colorchange",
                        "value" => array("enable"),
                    ),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Title Background Color", "shshortc"),
                    "param_name" => "titlebgcolor",
                    "value" => '#fff',
                    "description" => __("Set the Title background color.", "shshortc"),
					"dependency" => array (
                        "element" => "colorchange",
                        "value" => array("enable"),
                    ),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Text Font Color", "shshortc"),
                    "param_name" => "fontcolor",
                    "value" => 'rgb(109,109,109)',
                    "description" => __("Set the Font color.", "shshortc"),
					"dependency" => array (
                        "element" => "colorchange",
                        "value" => array("enable"),
                    ),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Text Background Color", "shshortc"),
                    "param_name" => "bgcolor",
                    "value" => '#fff',
                    "description" => __("Set the Text background color.", "shshortc"),
					"dependency" => array (
                        "element" => "colorchange",
                        "value" => array("enable"),
                    ),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Border Color", "shshortc"),
                    "param_name" => "bordercolor",
                    "value" => 'rgba(0,0,0,0.25)',
                    "description" => __("Set the Border color.", "shshortc"),
					"dependency" => array (
                        "element" => "colorchange",
                        "value" => array("enable"),
                    ),
                ),

			),
			"js_view" => 'VcColumnView'
		) );
	}

	 // Tooltips
    public function short_sh_tooltip() {
        vc_map( array(
            "name" => __("Tooltip", 'shshortc'),
            "heading" => __("Tooltip", "shshortc"),
            "base" => "shvc_tooltip",
            "description" => __("Tooltip container that you can add other items to", "shshortc"),
            "as_parent" => array('except' => 'shvc_parallax'),
            'content_element' => true,
            "show_settings_on_create" => true,
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __("Placement", "shshortc"),
                    "param_name" => "placement",
                    "value" => array(
                        __('Top', 'shshortc') => 'top',
                        __('Left', 'shshortc') => 'left',
                        __('Right', 'shshortc') => 'right',
                        __('bottom', 'shshortc') => 'bottom'
                    ),
                    "description" => __("Choose where the tooltip will display.", "shshortc"),
                ),
                array(
                    "type" => "textfield",
                    "holder" => "span",
                    "heading" => __("Title", "shshortc"),
                    "param_name" => "title",
                    "description" => __("Set a Title for your tooltip.", "shshortc"),
                ),
			),
			"js_view" => 'VcColumnView'
		) );
	}

	// Progress Bars
	public function short_sh_progress() {
		$padding = array();
		for($i =0;$i<46; $i++) {
			$padding[] = $i . 'px';
		}
		vc_map( array(
			"name" => __('Progress Bar', 'shshortc'),
			"base" => 'sh_progress',
			"description" => __("Progress Bars to show skills, achievements etc.", "shshortc"),
			"icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
					"heading" => __("Style", "shshortc"),
					"param_name" => "style",
					"value" => array(
						__("Solid Bar", "shshortc") => 'solid',
						__("Striped Bar", "shshortc") => 'striped',
						__("Pulse Bar", "shshortc") => 'pulse'
					),
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Bar Color", "shshortc"),
					"param_name" => "barcolor",
					"value" => "rgb(41, 128, 185)",
					"description" => __("The color of the bar", "shshortc"),
				),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Text Color", "shshortc"),
                    "param_name" => "textcolor",
                    "value" => "#fff",
                    "description" => __("The color of the text", "shshortc"),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Background Color", "shshortc"),
                    "param_name" => "background",
                    "value" => "rgba(0,0,0,0.15)",
                    "description" => __("The color of the background", "shshortc"),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Padding Space", "shshortc"),
                    "param_name" => "padding",
                    "value" => $padding,
                    "description" => __("Adjust the size of the Progress Bar", "shshortc"),
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Your Text", "shshortc"),
					"holder" => "span",
                    "param_name" => "text",
                    "value" => __("Your Progress Text", "shshortc"),
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Progress Bar percent", "shshortc"),
                    "param_name" => "percent",
                    "value" => "75",
                    "description" => __("The percent filled of the progress bar (numeric)", "shshortc"),
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Symbol", "shshortc"),
                    "param_name" => "symbol",
                    "value" => "%",
                    "description" => __("The symbol or short text after the number", "shshortc"),
                ),
            ),
        ) );
    }

	// Circle Charts
    public function short_sh_circle() {
		require_once SH_ROOT_PATH.'/core/font-awesome-icons.php';
        $icons = fa_font_icons();
		require_once SH_ROOT_PATH.'/core/linear-icons.php';
		$linearicons = linearicons();
		require_once SH_ROOT_PATH.'/core/ion-icons.php';
		$ionicons = ionicons();
		vc_map( array(
            "name" => __('Circle Chart', 'shshortc'),
            "base" => 'sh_circle',
            "description" => __("Circle Charts to show stats.", "shshortc"),
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Text", "shshortc"),
                    "param_name" => "text",
					"description" => __("The main (large) Text.  Can be blank if you are using an icon.", "shshortc")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Circle Info", "shshortc"),
                    "param_name" => "info",
                    "description" => __("The small text below.  Can be blank if you want.", "shshortc"),
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Percent Fill", "shshortc"),
                    "param_name" => "percent",
                    "value" => "75",
                    "description" => __("The percent of chart filled (must be numeric e.g. 75 or 78.4)", "shshortc"),
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Chart Size", "shshortc"),
                    "param_name" => "dimension",
                    "value" => "250",
                    "description" => __("The size in pixels of the chart (must be an integer e.g. 250)", "shshortc"),
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Font Size", "shshortc"),
                    "param_name" => "fontsize",
                    "value" => "38",
                    "description" => __("The size of the font in pixels (must be an integer e.g. 38)", "shshortc"),
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Bar Width", "shshortc"),
                    "param_name" => "width",
                    "value" => "15",
                    "description" => __("The width of the bar (must be an integer e.g. 15)", "shshortc"),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Circle Chart Type", "shshortc"),
                    "param_name" => "type",
                    "value" => array(
                        __("Full Circle", "shshortc") => 'full',
                        __("Half Circle", "shshortc") => 'half',
                    ),
					"description" => __("A Half or Full circle chart", "shshortc")
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Bar Color", "shshortc"),
                    "param_name" => "fgcolor",
                    "value" => "rgb(97, 169, 220)",
					"description" => __("The color of the circle chart bar", "shshortc")
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Bar Background Color", "shshortc"),
                    "param_name" => "bgcolor",
                    "value" => "#eee",
                    "description" => __("The color of the bar background", "shshortc")
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Fill Color", "shshortc"),
                    "param_name" => "fill",
                    "value" => "#fff",
                    "description" => __("The fill color of the chart", "shshortc")
                ),

				array(
                    "type" => "dropdown",
                    "heading" => __("Enable Icon", "shshortc"),
                    "param_name" => "circleicon",
                    "value" => array(
                        __("Disable", "shshortc") => 'disable',
						__("Enable", "shshortc") => 'enable',
                    ),
                ),
				array( 
					"type" => "colorpicker",
					"heading" => __("Icon Color", "shshortc"),
					"param_name" => "iconcolor",
					"value" => "#999",
					"dependency" => array (
                        "element" => "circleicon",
                        "value" => array("enable"),
                    ),
				),
				array(
                    "type" => "dropdown",
                    "heading" => __("Choose The Icons to use:", "shshortc"),
                    "param_name" => "iconset",
                    "value" => array(
                        __("Font Awesome", "shshortc") => "fontawesome",
                        __("Linear Icons", "shshortc") => "linear",
                        __("Ion Icons", "shshortc") => "ion"
                    ),
                    "description" => __("If you are going to use Linearicons or Ionicons, make sure you've enabled them in Theme Options -> General Settings.", "shshortc"),
                    "dependency" => array (
                        "element" => "circleicon",
                        "value" => array("enable"),
                    ),
                ),
				array(
                    "type" => "fa_dropdown",
                    "class" => "fontawesome",
                    "heading" => __("Choose a Font Awesome icon", 'shshortc'),
                    "param_name" => "iconfa",
                    "value" => $icons,
                ),
                array(
                    "type" => "linear_dropdown",
                    "class" => "linearicon",
                    "heading" => __("Choose a Linearicons icon", 'shshortc'),
                    "param_name" => "iconlinear",
                    "value" => $linearicons,
                ),
                array(
                    "type" => "ion_dropdown",
                    "class" => "ionicon",
                    "heading" => __("Choose an Ionicons icon", 'shshortc'),
                    "param_name" => "iconion",
                    "value" => $ionicons,
                ),
			),
        ) );
    }

	// Modal Popups
    public function short_sh_modal() {
        vc_map( array(
            "name" => __('Modal', 'shshortc'),
            "base" => 'sh_modal',
            "description" => __("Modals (popups) for showing more content.", "shshortc"),
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __("Open Modal on Page Load", "shshortc"),
                    "param_name" => "openready",
					"value" => array(
						__("Disable", "shshortc") => "disable",
						__("Enable", "shshortc") => "enable",
					),
                    "description" => __("This will open a modal when the page opens, no button needed.", "shshortc")
                ),
				array(
					"type" => "textfield",
					"holder" => "span",
					"heading" => __("Modal Title", "shshortc"),
					"param_name" => "title",
					"value" => __("Your Modal Title", "shshortc"),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Modal Size", "shshortc"),
					"param_name" => "modalsize",
					"value" => array(
						__("Small", "shshortc") => "small",
						__("Large", "shshortc") => "large",
					),
					"description" => __("Large or Small Modal Window", "shshortc"),
				),
				array(
					"type" => "dropdown",
					"heading" => __("Enable Footer", "shshortc"),
					"param_name" => "footer",
					"value" => array(
						__("Enable", "shshortc") => "enable",
						__("Disable", "shshortc") => "disable",
					),
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Modal Background Color", "shshortc"),
					"param_name" => "modalbg",
					"value" => "#ffffff",
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Modal Border Color", "shshortc"),
					"param_name" => "modalborder",
					"value" => "rgba(0,0,0,0.2)",
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Modal Font Color", "shshortc"),
					"param_name" => "modalfont",
					"value" => "#555"
				),
				array(
					"type" => "textfield",
					"heading" => __("Button Text", "shshortc"),
					"param_name" => "buttontext",
					"value" => __("Open Modal", "shshortc"),
					"dependency" => array (
                        "element" => "openready",
                        "value" => array("disable"),
                    ),
				),
				array(
					"type" => "colorpicker",
					"heading" => __("Button Color", "shshortc"),
					"param_name" => "buttoncolor",
					"value" => "#ffffff",
					"dependency" => array (
                        "element" => "openready",
                        "value" => array("disable"),
                    ),
				),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Button Border Color", "shshortc"),
                    "param_name" => "buttonborder",
                    "value" => "#555555",
                    "dependency" => array (
                        "element" => "openready",
                        "value" => array("disable"),
                    ),
                ),
                array(
                    "type" => "colorpicker",
                    "heading" => __("Button Text Color", "shshortc"),
                    "param_name" => "buttontextcolor",
                    "value" => "#555555",
                    "dependency" => array (
                        "element" => "openready",
                        "value" => array("disable"),
                    ),
                ),
				array(
					"type" => "textfield",
					"heading" => __("Button Border Width", "shshortc"),
					"param_name" => "buttonborderwidth",
					"value" => "2px",
					"description" => __("Set a width in pixels (e.g. 5px)", "shshortc"),
					"dependency" => array (
                        "element" => "openready",
                        "value" => array("disable"),
                    ),
				),
				array(
                    "type" => "textfield",
                    "heading" => __("Button Border Radius", "shshortc"),
                    "param_name" => "buttonborderradius",
                    "value" => "0px",
                    "description" => __("Set a radius in pixels (e.g. 5px), 0 for square", "shshortc"),
                    "dependency" => array (
                        "element" => "openready",
                        "value" => array("disable"),
                    ),
                ),
				array(
                    "type" => "textarea_html",
                    "heading" => __("Enter The Modal Content", 'shshortc'),
                    "param_name" => "content",
                    "value" => __("Your Modal Content", 'shshortc'),
                ),				
				
		 	),
       ) );
    }

	// Youtube and Vimeo Responsive videos
    public function short_sh_video() {
        vc_map( array(
            "name" => __('Video', 'shshortc'),
            "base" => 'sh_video',
            "description" => __("Youtube and Vimeo Videos.", "shshortc"),
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __("Video Type", "shshortc"),
					"holder" => "span",
                    "param_name" => "video",
                    "value" => array(
                        __("Vimeo", "shshortc") => "vimeo",
                        __("Youtube", "shshortc") => "youtube",
						__("Self Hosted", "shshortc") => "selfhosted"
                    ),
                    "description" => __("Vimeo or Youtube videos - just the id. Self Hosted add the full url and a poster image if wanted.", "shshortc")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Video ID", "shshortc"),
                    "param_name" => "id",
					"description" => __("ID of video (found in the video url)", "shshortc")
                ),
				array(
					'type' => 'attach_image',
					'heading' => __('Self Hosted Poster Imagage', 'shshortc'),
					'param_name' => 'poster',
					'description' => __('Poster Image for self hosted video', 'shshortc'),
					"dependency" => array (
                        "element" => "video",
                        "value" => array("selfhosted"),
                    ),
				),
            ),
       ) );
    }

	 // Soundcloud
    public function short_sh_sitemap() {
        vc_map( array(
            'name' => __('Sitemap', 'shshortc'),
            'base' => 'sh_sitemap',
            'description' => __('Add a Sitemap to your site', 'shshortc'),
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "heading" => __("Show Pages", "shshortc"),
                    "param_name" => "show_pages",
                    "description" => __("Select if you want pages to show or not", "shshortc"),
					'value' => array(
						__('True', 'shshortc') => 'true',
						__('False', 'shshortc') => 'false',
					),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Show Posts", "shshortc"),
                    "param_name" => "show_posts",
                    "description" => __("Select if you want posts to show or not", "shshortc"),
                    'value' => array(
                        __('True', 'shshortc') => 'true',
                        __('False', 'shshortc') => 'false',
                    ),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Show Custom Posts", "shshortc"),
                    "param_name" => "show_custom",
                    "description" => __("Select if you want custom posts to show or not", "shshortc"),
                    'value' => array(
                        __('True', 'shshortc') => 'true',
                        __('False', 'shshortc') => 'false',
                    ),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Show Select Choices", "shshortc"),
                    "param_name" => "show_select",
                    "description" => __("Displays a dropdown that users can change views of Pages and Posts.", "shshortc"),
                    'value' => array(
                        __('True', 'shshortc') => 'true',
                        __('False', 'shshortc') => 'false',
                    ),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Default Pages View", "shshortc"),
                    "param_name" => "pages_default",
                    "description" => __("Select the default view for Pages", "shshortc"),
                    'value' => array(
                        __('Title', 'shshortc') => 'post_title',
                        __('Date', 'shshortc') => 'post_date',
						__('Author', 'shshortc') => 'post_author',
                    ),
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Default Posts View", "shshortc"),
                    "param_name" => "posts_default",
                    "description" => __("Select the default view for Posts", "shshortc"),
                    'value' => array(
                        __('Title', 'shshortc') => 'title',
                        __('Date', 'shshortc') => 'date',
                        __('Author', 'shshortc') => 'author',
						__('Category', 'shshortc') => 'category',
                    ),
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Exclude Posts and Pages by ID", "shshortc"),
                    "param_name" => "exclude_ids",
                    "description" => __("Comma seperated list of ids to exclude (e.g. 10,121,159)", "shshortc"),
                ),
			),
       ) );
    }

	// Social Icons
	public function short_sh_social() {
		require_once SH_ROOT_PATH.'/core/font-awesome-icons.php';
        $icons = fa_font_icons();
		require_once SH_ROOT_PATH.'/core/linear-icons.php';
		$linearicons = linearicons();
		require_once SH_ROOT_PATH.'/core/ion-icons.php';
		$ionicons = ionicons();
		vc_map( array(
            'name' => __('Social Icon', 'shshortc'),
            'base' => 'sh_social',
            'description' => __('Insert Social Icons', 'shshortc'),
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
				array(
                    "type" => "dropdown",
                    "heading" => __("Icons", "shshortc"),
                    "param_name" => "enableicon",
                    "value" => array(
                        __("Enable Icons", "shshortc") => "enable"
                    ),
                 ),
				 array(
                    "type" => "dropdown",
                    "heading" => __("Choose The Icons to use:", "shshortc"),
                    "param_name" => "iconset",
                    "value" => array(
                        __("Font Awesome", "shshortc") => "fontawesome",
                        __("Linear Icons", "shshortc") => "linear",
                        __("Ion Icons", "shshortc") => "ion"
                    ),
                    "description" => __("If you are going to use Linearicons or Ionicons, make sure you've enabled them in Theme Options -> General Settings.", "shshortc"),
                ),
				array(
                    "type" => "fa_dropdown",
                    "class" => "fontawesome",
                    "heading" => __("Choose an icon", 'shshortc'),
                    "param_name" => "iconfa",
                    "value" => $icons,
                ),
                array(
                    "type" => "linear_dropdown",
                    "class" => "linearicon",
                    "heading" => __("Choose a Linearicons icon", 'shshortc'),
                    "param_name" => "iconlinear",
                    "value" => $linearicons,
                ),
                array(
                    "type" => "ion_dropdown",
                    "class" => "ionicon",
                    "heading" => __("Choose an Ionicons icon", 'shshortc'),
                    "param_name" => "iconion",
                    "value" => $ionicons,
                ),

                array(
                    "type" => "textfield",
                    "heading" => __("Link", "shshortc"),
                    "param_name" => "link",
                    "description" => __("Insert the social link (e.g. http://www.example.com)", "shshortc")
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Target", "shshortc"),
                    "param_name" => "target",
                    "value" => array(
                        __("New Window", "shshortc") => '_new',
                        __("Same Window", "shshortc") => '_self'
                    ),
                    "description" => __("Have the target open in a new window or the existing one.", "shshortc")
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Size", "shshortc"),
					"holder" => "span",
                    "param_name" => "size",
                    "value" => array(
                        __("Small", "shshortc") => 'small',
                        __("Medium", "shshortc") => 'medium',
						__("Large", "shshortc") => 'large',
                    ),
                    "description" => __("Choose the size of the icon.", "shshortc")
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Hover Title", "shshortc"),
					"holder" => "span",
                    "param_name" => "title",
                    "description" => __("The Title for hovering (leave blank if you don't want one).", "shshortc")
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Hover Title Placement", "shshortc"),
                    "param_name" => "placement",
                    "value" => array(
                        __("Top", "shshortc") => 'top',
                        __("Bottom", "shshortc") => 'bottom',
                        __("Left", "shshortc") => 'left',
						__("Right", "shshortc") => 'right',
                    ),
                    "description" => __("Select the placement of the title.", "shshortc")
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Framed", "shshortc"),
                    "param_name" => "framed",
                    "value" => array(
                        __("True - Icon with background", "shshortc") => 'true',
                        __("False - Icon only", "shshortc") => 'false',
                    ),
                    "description" => __("Select if you would like a background or none.", "shshortc")
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("The Font Color", "shshortc"),
                    "param_name" => "fontcolor",
					"value" => "rgba(0,0,0,0.3)",
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Radius", "shshortc"),
                    "param_name" => "radius",
                    "description" => __("The border radius for the icon (0px = no radius, 2px default, 50% circle.", "shshortc"),
					"value" => '2px',
					"dependency" => array (
                        "element" => "framed",
                        "value" => array("true"),
                    ),
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("The Background Color", "shshortc"),
                    "param_name" => "bgcolor",
                    "value" => "rgba(0,0,0,0.15)",
					"dependency" => array (
                        "element" => "framed",
                        "value" => array("true"),
                    ),
                ),
			),
       ) );
    }

	// Soundcloud
	public function short_sh_soundcloud() {
		vc_map( array(
			'name' => __('SoundCloud', 'shshortc'),
			'base' => 'sh_soundcloud',
			'description' => __('Soundcloud tracks', 'shshortc'),
			"icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("SoundCloud url", "shshortc"),
                    "holder" => "span",
                    "param_name" => "url",
                    "description" => __("Insert the SoundCloud clip url", "shshortc")
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Auto Play", "shshortc"),
                    "param_name" => "auto_play",
					"value" => array(
						__("Disable", "shshortc") => 'false',
						__("Enable", "shshortc") => 'true'
					),
                    "description" => __("Have a clip automatically play on page load", "shshortc")
                ),
				array(
                    "type" => "dropdown",
                    "heading" => __("Show Comments", "shshortc"),
                    "param_name" => "show_comments",
                    "value" => array(
                        __("Disable", "shshortc") => 'false',
                        __("Enable", "shshortc") => 'true'
                    ),
                    "description" => __("Show the comments with the sound clip.", "shshortc")
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Set Color", "shshortc"),
                    "param_name" => "color",
                    "value" => "#555555",
                    "description" => __("Customize the color of the play button and sound grid.", "shshortc")
                ),
            ),
       ) );
    }

	// Google Docs
	public function short_sh_gdoc() {
		vc_map( array(
            'name' => __('Google Doc', 'shshortc'),
            'base' => 'sh_gdoc',
            'description' => __('Google Documents', 'shshortc'),
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Document Link", "shshortc"),
                    "holder" => "span",
                    "param_name" => "link",
                    "description" => __("Insert the link to your document", "shshortc")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Height", "shshortc"),
                    "param_name" => "height",
                    "value" => '300',
                    "description" => __("Integer - set a height for the document (e.g. 400)", "shshortc")
                ),
                array(
                    "type" => "dropdown",
                    "heading" => __("Seamless display", "shshortc"),
                    "param_name" => "seamless",
                    "value" => array(
                        __("Disable", "shshortc") => 'false',
                        __("Enable", "shshortc") => 'true'
                    ),
                    "description" => __("Seamless enable = hide header bar, disable = show header bar.", "shshortc")
                ),
            ),
       ) );
    }

	// Google Maps
	public function short_sh_gmap() {
		$zoom = array();
		for ($i = 0; $i < 24; $i++) {
			$zoom[] = $i;
		}
		$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789'); // and any other characters
		shuffle($seed); // probably optional since array_is randomized; this may be redundant
		$rand = '';
		foreach (array_rand($seed, 7) as $k) $rand .= $seed[$k];

        vc_map( array(
            'name' => __('Google Map', 'shshortc'),
            'base' => 'shvc_gmap',
            'description' => __('Create a Google Map', 'shshortc'),
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
			"as_parent" => array('only' => 'shvc_gmap_point'),
            'content_element' => true,
            "show_settings_on_create" => true,
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Address", "shshortc"),
                    "holder" => "span",
                    "param_name" => "address",
                    "description" => __("Put the full address of the location (it will be geocoded for you)", "shshortc")
                ),
				array(
					'type' => 'textfield', 
					'heading' => __('Unique Map', 'shshortc'),
					'param_name' => 'unique',
					'value' => $rand,
					'description' => __("Generated id for the map, this needs to be unique per map.", 'shshortc'),
				),
                array(
                    "type" => "dropdown",
                    "heading" => __("Add Border", "shshortc"),
                    "param_name" => "bordered",
                    "value" => array(
						__('False - No Border', 'shshortc') => 'false',
						__('True - Add a Border to the Map', 'shshortc') => 'true'
					),
                    "description" => __("Give the map a nice border around it", "shshortc")
                ),
				array(
					'type' => 'dropdown',
					'heading' => __('Full Width Map', 'shshortc'),
					'param_name' => 'fullwidth',
					'value' => array(
						__('False - Set the width', 'shshortc') => 'false',
						__('True - Map extends Full page width', 'shshortc') => 'true',
					),
					'description' => __('Have the Map extend full page width or set the width', 'shshortc'),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Height', 'shshortc'),
					'param_name' => 'height',
					'value' => '300px',
					'description' => __('Set the height of the map, pixels or percent but pixels are typical (e.g. 350px)', 'shshortc'),
				),
				array(
					'type' => 'textfield',
					'heading' => __('Width', 'shshortc'),
					'param_name' => 'width',
					'value' => '100%',
					'description' => __('Set the Width of the map, pixels or percent (e.g. 500px or 100%)', 'shshortc'),
					"dependency" => array (
                        "element" => "full_width",
                        "value" => array("false"),
                    ),
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Map zoom level', 'shshortc'),
					'param_name' => 'zoom',
					'value' => $zoom,
					'description' => __('Set the map zoom level', 'shshortc')
				),
				array(
					'type' => 'dropdown',
					'heading' => __('Enable Zoom Control', 'shshortc'),
					'param_name' => 'zoomcontrol',
					'value' => array(
						__('True', 'shshortc') => 'true',
						__('False', 'shshortc') => 'false'
					),
					'description' => __('Set to allow users to change zoom level', 'shshortc'),
				),
				array(
                    'type' => 'dropdown',
                    'heading' => __('Enable Pan Control', 'shshortc'),
                    'param_name' => 'pancontrol',
                    'value' => array(
                        __('True', 'shshortc') => 'true',
                        __('False', 'shshortc') => 'false'
                    ),
                    'description' => __('Set to allow users to change panning', 'shshortc'),
                ),
				array(
                    'type' => 'dropdown',
                    'heading' => __('Enable Map Type Control', 'shshortc'),
                    'param_name' => 'maptypecontrol',
                    'value' => array(
                        __('True', 'shshortc') => 'true',
                        __('False', 'shshortc') => 'false'
                    ),
                    'description' => __('Set to allow users to change map type', 'shshortc'),
                ),
				array(
                    'type' => 'dropdown',
                    'heading' => __('Enable Scroll Wheel', 'shshortc'),
                    'param_name' => 'scrollwheel',
                    'value' => array(
                        __('True', 'shshortc') => 'true',
                        __('False', 'shshortc') => 'false'
                    ),
                    'description' => __('Set to allow users to zoom with mouse wheel', 'shshortc'),
                ),
				array(
                    'type' => 'dropdown',
                    'heading' => __('Map Type', 'shshortc'),
                    'param_name' => 'maptype',
                    'value' => array(
                        __('Roadmap', 'shshortc') => 'ROADMAP',
                        __('Satellite', 'shshortc') => 'SATELLITE',
						__('Terrain', 'shshortc') => 'TERRAIN',
						__('Hybrid', 'shshortc') => 'HYBRID'
                    ),
                    'description' => __('Choose the type of map you want', 'shshortc'),
                ),
				array(
                    "type" => "attach_image",
                    "heading" => __("Map Marker", "shshortc"),
                    "param_name" => "marker",
                    "description" => __("Attach a marker (or leave blank for default google marker", "shshortc"),
                ),				
				array(
					'type' => 'dropdown',
					'heading' => __("Change Map Color", "shshortc"),
					'param_name' => 'changemap',
					'value' => array(
						__('False', 'shshortc') => 'false',
						__('True', 'shshortc') => 'true',
					),
					'description' => __('Use the default map colors or choose your own.  This will not change all maps (e.g. satellite)', 'shshortc'), 
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Map Color', 'shshortc'),
					'param_name' => 'mapcolor',
					'value' => 'blue',
					'description' => __('Set the color for the map', 'shshortc'),
                    "dependency" => array (
                        "element" => "changemap",
                        "value" => array("true"),
                    ),
				),
				array(
                    'type' => 'textfield',
                    'heading' => __('Map Color Saturation', 'shshortc'),
                    'param_name' => 'saturation',
                    'value' => '0',
                    'description' => __('Values between -100 to 100, 0 is default', 'shshortc'),
                    "dependency" => array (
                        "element" => "changemap",
                        "value" => array("true"),
                    ),
                ),
				array(
                    'type' => 'textfield',
                    'heading' => __('Map Color Lightness', 'shshortc'),
                    'param_name' => 'lightness',
                    'value' => '0',
                    'description' => __('Values between -100 to 100, 0 is default', 'shshortc'),
                    "dependency" => array (
                        "element" => "changemap",
                        "value" => array("true"),
                    ),
                ),
				array(
					'type' => 'textarea',
					'heading' => __('Infobox Content', 'shshortc'),
					'param_name' => 'infobox',
					'description' => __('Infobox content, leave blank for no infobox', 'shshortc'),
				),
				array(
					'type' => 'colorpicker',
					'heading' => __('Infobox Background Color', 'shshortc'),
					'param_name' => 'infoboxbg',
					'value' => 'rgba(255,255,255,0.85)',
					'description' => __('Set the color for your infobox background color (affects all infoboxes in this map)', 'shshortc'),
				),
				array(
                    'type' => 'colorpicker',
                    'heading' => __('Infobox Text Color', 'shshortc'),
                    'param_name' => 'infoboxcolor',
                    'value' => '#111111',
                    'description' => __('Set the text color for infoboxes (affects all infoboxes in this map)', 'shshortc'),
				),
			),
			"js_view" => 'VcColumnView'
       ) );
		// Google Map extra points
		vc_map( array(
            "name" => __('Google Map Point', 'shshortc'),
            "base" => "shvc_gmap_point",
            "content_element" => true,
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "as_child" => array("only" => "shvc_gmap"),
            'params' => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Full address", "shshortc"),
					"holder" => "span",
                    "param_name" => "address",
                    "description" => __("Full address, we will take care of the geocoding (latitude/longitude)", "shshortc"),
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => __('Select Marker', 'shshortc'),
                    'param_name' => 'marker',
                    'description' => __('Set a marker of your choosing or leave blank for Google default', 'shshortc'),
                ),
                array(
                    'type' => 'textarea',
                    'heading' => __('Infobox content', 'shshortc'),
                    'param_name' => 'infobox',
                    'description' => __('Set infobox content, leave blank for none', 'shshortc')
                ),
            ),
       ) );

    }

	// Contact Form
    public function short_sh_contact() {
		$sizes = array();
		for ($i = 0; $i<50;$i++) {
			$sizes[] = $i . 'px';
		}
        vc_map( array(
            'name' => __('Contact Form', 'shshortc'),
            'base' => 'sh_form',
            'description' => __('An easy to use contact form', 'shshortc'),
            "icon" => SH_ROOT_URL . "/img/logo-symbol-32x32.png",
            "category" => __('SH-Themes', 'shshortc'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Name Field Text", "shshortc"),
                    "param_name" => "nametext",
					"value" => __("Your Name", "shshortc"),
                    "description" => __("Set your name field text", "shshortc")
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Email Field Text", "shshortc"),
                    "param_name" => "emailtext",
                    "value" => __("Your Email", "shshortc"),
                    "description" => __("Set your email field text", "shshortc")
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Message Field Text", "shshortc"),
                    "param_name" => "messagetext",
                    "value" => __("Enter Your Message", "shshortc"),
                    "description" => __("Set your message field text", "shshortc")
                ),
				array(
					"type" => "colorpicker",
                    "heading" => __("Input Text Color", "shshortc"),
                    "param_name" => "inputtext",
                    "value" => "#555555",
                    "description" => __("Set Your Input Field Text Color", "shshortc")
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Input Background Color", "shshortc"),
                    "param_name" => "inputbg",
                    "value" => "#ffffff",
                    "description" => __("Set Your Input Field Background Color", "shshortc")
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Input Border Color", "shshortc"),
                    "param_name" => "inputborder",
                    "value" => "#555555",
                    "description" => __("Set Your Input Field Border Color", "shshortc")
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Button Text", "shshortc"),
                    "param_name" => "buttontext",
                    "value" => __("Submit", "shshortc"),
                    "description" => __("Set the button text", "shshortc")
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Button Background Color", "shshortc"),
                    "param_name" => "buttonbg",
                    "value" => "#ffffff",
                    "description" => __("Set the background color of your button", "shshortc")
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Button Text Color", "shshortc"),
                    "param_name" => "buttoncolor",
                    "value" => "#555555",
                    "description" => __("Set your text color of the button", "shshortc")
                ),
				array(
                    "type" => "colorpicker",
                    "heading" => __("Button Border Color", "shshortc"),
                    "param_name" => "buttonborder",
                    "value" => "#555555",
                    "description" => __("Set the border color of your button", "shshortc")
                ),
				array(
					'type' => 'dropdown',
					'heading' => __('Button Border Width', 'shshortc'),
					'param_name' => 'buttonborderw',
					'value' => $sizes,
					'description' => __('Set the border width (0px = no border', 'shshortc'),
				),
				array(
					'type' => 'dropdown',
                    'heading' => __('Input and Button Radius', 'shshortc'),
                    'param_name' => 'borderradius',
                    'value' => $sizes,
                    'description' => __('Set the border radius for form elements (0px = square', 'shshortc'),
                ),
				array(
                    "type" => "textfield",
                    "heading" => __("Send to other email", "shshortc"),
                    "param_name" => "newemail",
                    "value" => "",
                    "description" => __("Leave blank unless you want this form to go to an email address other than the admin email", "shshortc")
                ),
            ),
       ) );
    }

}  // End VCExtend


new VCExtend();
