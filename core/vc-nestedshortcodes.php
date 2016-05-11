<?php
/**
 * Extending WPBakery Visual Composer shortcodes - Checklists
 *
 * @package WPBakeryVisualComposer
 *
 */

// Accordion
class WPBakeryShortCode_SHVC_Accordion extends WPBakeryShortCodesContainer {
	public function __construct( $settings ) {
        parent::__construct( $settings );
    }

    public function content( $atts, $content = null ) {
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

		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
        $content = do_shortcode($content);

        $output = '<div class="sh-accordion panel-group" id="' . $accord_current . '">';

        foreach ($accord_items as $k => $v) {
            $output .= $v;
        }
        $output .= '</div>';

        $accord_items = '';
        return $output;
	}
}

// Accordion Tabs
class WPBakeryShortCode_SHVC_Accord_Item extends WPBakeryShortCode {
    /* We create a global variable that is shared with the parent checklist */

    public function content($atts, $content = null) {
		global $accord_display;
        global $accord_items;
        global $accord_item_count;

        extract(shortcode_atts(array(
            'open' => 'false',
            'title' => '',
        ), $atts));
		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
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
                . '<a class="' . $collapsed . '" data-toggle="collapse" data-parent="#' . $accord_display 
                . '" href="#collapse-' . $accord_item_count . '"><i class="fa fa-plus"> </i> '
                . $title . '</a></h4></div>'
                . '<div id="collapse-' . $accord_item_count . '" class="panel-collapse collapse ' . $in . '">'
                . '<div class="panel-body">';

        $accord_items[$accord_item_count] .= $content;
        $accord_items[$accord_item_count] .= '</div></div></div>';

    }
}



// Animate Container
class WPBakeryShortCode_SHVC_Animate extends WPBakeryShortCodesContainer {
	public function __construct( $settings ) { 
        parent::__construct( $settings );
    }   

    public function content( $atts, $content = null ) { 
		extract(shortcode_atts(array(
                'anim' => '',
				'delay' => '',
            ), $atts));
            //$clean = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
            $content = do_shortcode($content);
            $output = '<div class="sh-animate" data-anim="' . $anim . '" data-delay="' 
				    . $delay . '" style="visibility:hidden;">' . $content . '</div>';
            return $output;
	}	
}

// Checklist Container
class WPBakeryShortCode_SHVC_Checklist extends WPBakeryShortCodesContainer {
	public function __construct( $settings ) {
       	parent::__construct( $settings );
   	}

	public function content( $atts, $content = null ) {
		global $checklist_items;
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
            'backgroundcolor' => '#555',
            'fontcolor' => '#fff'
        ), $atts));

		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
        $content = do_shortcode($content);

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



/*
        if ($type == 'unordered') {
            $list = 'ul';
            $iconSet = $icon;
        } else {
            $list = 'ol';
            $iconSet = '';
        }

        if ($background == 'enable') {
            $bgClass = 'background';
        } else {
            $bgClass = '';
        }

		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
        $content = do_shortcode($content);

        $output = '<' . $list . ' class="sh-checklist ' . $bgClass . '">';
        for ($i = 0; $i < count($checklist_items); $i++) {
            $output .= '<li><i class="' . $iconSet . '"></i> ' . $checklist_items[$i] . '</li>';
        }
        $output .= '</' . $list . '>';

        $checklist_items = '';
        return $output;
*/
    }
}

// Checklist Items
class WPBakeryShortCode_SHVC_Checklist_Item extends WPBakeryShortCode {
	/* We create a global variable that is shared with the parent checklist */
	
    public function content($atts, $content = null) {


        $content = do_shortcode($content);

		// remove p tags
        $parray = array (
            '<p>' => '',
            '</p>' => ''
        );
        $content = strtr($content, $parray);


        global $checklist_items;
        $checklist_items[] = $content;

    }
}

// Pricetable Container
class WPBakeryShortCode_SHVC_PriceTable extends WPBakeryShortCodesContainer {
	public function __construct( $settings ) {
        parent::__construct( $settings );
    }

	public function content( $atts, $content = null ) {
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

		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
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
}

// Price Table Columns
class WPBakeryShortCode_SHVC_PriceTable_Col extends WPBakeryShortCode {
    /* We create global variables that are shared with the parent checklist */

    public function content($atts, $content = null) {
            global $ptable;
            global $pclass;
            global $pcolcount;
            global $pcoltotal;
            extract(shortcode_atts(array(
                'title' => 'Column 1',
                'highlight' => 'false',
                'colcolor' => '#2ecc71',
                'cost' => '14.99/month',
                'tag' => '',
                'btntext' => 'Order Now!',
                'btnlink' => '#',
                'btntarget' => '_blank'
            ), $atts));

            $pcolcount++;  // track column number

            $highlight = strtolower($highlight);
            $highlight = ( $highlight == 'true') ? true : false;

            $colClass = 'price-column';
            $colClass .= ( $pcolcount % 2 ) ?  '' : ' even-column';
            $colClass .= ( $highlight ) ?  ' highlight-column' : '';
            $colClass .= ( $pcolcount == $pcoltotal ) ?  ' last-column' : '';
            $colClass .= ( $pcolcount == 1 ) ?  ' first-column' : '';

			$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
            $content = do_shortcode($content);
            //$darken = $this->colorBrightness($colcolor, -0.9);
			$create_shortcodes = new Create_Shortcodes();
			$darken = $create_shortcodes->colorBrightness($colcolor, -0.9);
            //$darkenMore = $this->colorBrightness($colcolor, -0.6);
			$darkenMore = $create_shortcodes->colorBrightness($colcolor, -0.6);

            if ($pclass == 'sh-price-table') {                                         // colored columns
                $style = 'style="background-color:' . $colcolor . ';"';
                $bordStyle = 'style="border:1px solid ' . $colcolor . ';"';
                $holdStyle = 'style="border-bottom:3px solid ' . $colcolor . ';"';
                $tagDiv = '';

                if (trim($tag) != '') {
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
					$tag = wpb_js_remove_wpautop($tag, true); // fix unclosed/unwanted paragraph tags in $content
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
}

// Table Container
class WPBakeryShortCode_SHVC_Table extends WPBakeryShortCodesContainer {
    public function __construct( $settings ) {
        parent::__construct( $settings );
    }

    public function content( $atts, $content = null ) {
		global $sh_head;
        global $sh_row;
        global $row_count;

        $sh_head = array();
        $sh_row = array();
        $row_count = 1;
        extract(shortcode_atts(array(
            'style' => 'bordered',
			'tr_bgcolor' => '#f9f9f9',
			'tr_altbgcolor' => '#ffffff',
			'hovercolor' => '#f5f5f5',
			'bordercolor' => '#dddddd',
        ), $atts));
		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
       	do_shortcode($content);


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
}

// Table Head
class WPBakeryShortCode_SHVC_Table_Head extends WPBakeryShortCode {
    /* We create global variables that are shared with the parent table */
	/* Removed wpb_js_remove_wpautop since it was adding <p> tags*/

    public function content($atts, $content = null) {
		global $sh_head;
        global $row_count;
        $row_count++;
        extract(shortcode_atts(array(
        ), $atts));

		// remove p tags
        $parray = array (
            '<p>' => '',
            '</p>' => ''
        );
        $content = strtr($content, $parray);

        $sh_head[$row_count] = explode(',,', $content);
    }
}

// Table Row
class WPBakeryShortCode_SHVC_Table_Row extends WPBakeryShortCode {
    /* We create global variables that are shared with the parent table */
	/* Removed wpb_js_remove_wpautop since it was adding <p> tags*/

    public function content($atts, $content = null) {
		global $sh_row;
        global $row_count;
        extract(shortcode_atts(array(
        ), $atts));
        $row_count++;

		// remove p tags
        $parray = array (
            '<p>' => '',
            '</p>' => ''
        );
        $content = strtr($content, $parray);

        $sh_row[$row_count] = explode(',,', $content);
    }
}

// Popovers
class WPBakeryShortCode_SHVC_Popover extends WPBakeryShortCodesContainer {
	public function __construct( $settings ) {
        parent::__construct( $settings );
    }

	public function content($atts, $content=null) {
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
                'fontcolor' => '#6d6d6d',
                'bordercolor' => 'rgba(0,0,0,0.25)'

            ), $atts));
            $popoverCount++;
            $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
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
}

// Tooltips
class WPBakeryShortCode_SHVC_Tooltip extends WPBakeryShortCodesContainer {
    public function __construct( $settings ) {
        parent::__construct( $settings );
    }

    public function content($atts, $content=null) {
            extract(shortcode_atts(array(
                'placement' => 'top',
                'title' => '',

            ), $atts));
            $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
            $content = do_shortcode($content);

            $output = '<a class="sh-tooltip" data-placement="' . $placement . '" title="' . $title . '">' . $content . '</a>';

            return $output;
    }
}

// Color Background Section Shortcode - arrows can overlap other sections 
class WPBakeryShortCode_SHVC_Colorbg extends WPBakeryShortCodesContainer {
    public function __construct( $settings ) {
        parent::__construct( $settings );
    }

    public function content($atts, $content=null) {
		extract(shortcode_atts(array(
                'fontcolor' => '#ffffff',
                'backgroundcolor' => 'rgba(0,0,0,1)',   // for color over images
                'arrower' => 'none',
            ), $atts));
		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
        $content = do_shortcode($content);


        // arrow style
        $arrow_div = '';
        if ('top' == $arrower) {
            $arrow_div = '<div class="sh-color-toparrow" style="background-color: ' . $backgroundcolor . '"></div>';
        } elseif ('bottom' == $arrower) {
            $arrow_div = '<div class="sh-color-bottomarrow" style="background-color: ' . $backgroundcolor . '"></div>';
        }

        $backgroundStyle = 'style="background-color:' . $backgroundcolor . ';"';
        $output = '<div class="sh-colorbg" '
                . ' data-color="' . $fontcolor . '">'
                . '<div class="sh-colorbg-overlay" ' . $backgroundStyle . '></div>'
                . '<div class="nested-container" style="color:' . $fontcolor . ';">' 
				. $content . '</div>' . $arrow_div . '</div>';

        return $output;
	}
}

// Image Background Section
class WPBakeryShortCode_SHVC_Imagebg extends WPBakeryShortCodesContainer {
	public function __construct( $settings ) {
		parent::__construct( $settings );
	}

	public function content($atts, $content=null) {

	/* Image Background Section Shortcode */
        extract(shortcode_atts(array(
            'fontcolor' => '#fff',
            'overlaycolor' => 'rgba(0,0,0,0.33)',   // for color over images
            'background' => '',
            'bgrepeat' => 'cover',
            'arrower' => 'none',
        ), $atts));
		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
        $content = do_shortcode($content);

		// get the image url from image set in visual composer for background
        $img_attributes = wp_get_attachment_image_src($background, 'full');
        $background_src = $img_attributes[0];

        // background image position
        $repeat = '';
        if ($bgrepeat == 'cover') {
            $repeat = ' background-repeat: no-repeat; background-position: center top; background-size: cover;';
        }
        $backgroundStyle = 'style="background-image: url(\'' . $background_src . '\'); color:' . $fontcolor . ';' . $repeat . '"';

        // arrow style
        $arrow_div = '';
        if ('top' == $arrower) {
            $arrow_div = '<div class="sh-toparrow"></div>';
        } elseif ('bottom' == $arrower) {
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
}



// Parallax
class WPBakeryShortCode_SHVC_Parallax extends WPBakeryShortCodesContainer {
    public function __construct( $settings ) {
        parent::__construct( $settings );
    }

    public function content($atts, $content=null) {
	  	extract(shortcode_atts(array(
            'backgroundchoice' => 'solid',
            'bgcolor' => '#555',
            'fontcolor' => '#fff',
			'overlaycolor' => 'rgba(0,0,0,0.25)',
            'background' => '',
            'videourlmp4' => '',
            'videourlwebm' => '',
			'bottomshadow' => 'disable',
        ), $atts));
		
		// get the image url from image set in visual composer for background
		$img_attributes = wp_get_attachment_image_src($background, 'full');
        $background_src = $img_attributes[0];

		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
        $content = do_shortcode($content);

		$sclass = '';   // shadow class - only applies to image and background color sections
        if ($bottomshadow == 'enable') {
            $sclass = 'shadow-section';
        }
		$output = '';

        if ($backgroundchoice == 'solid') {  // Solid Background
            $output = '<div class="sh-solidbg ' . $sclass . '" style="background-color:' . $bgcolor
                   . ';color:' . $fontcolor . ';" data-color="' . $fontcolor . '">'
                   . '<div class="nested-container">' . $content . '</div></div>';

        } elseif ($backgroundchoice == 'parallax') { // Parallax
			$overlayStyle = 'style="background-color:' . $overlaycolor . ';"';
            $output = '<div class="sh-parallax ' . $sclass . '"'
                    . ' style="background-image: url(\'' . $background_src . '\'); color:' . $fontcolor . '"'
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
			$videomp4 =  vc_build_link($videourlmp4);
			$videowebm = vc_build_link($videourlwebm);
			$poster = '';
            if ($videomp4['url'] != '') {
                $mp4 = '<source src="' . $videomp4['url'] . '" type="video/mp4">';
            }
            if ($videowebm['url'] != '') {
                $webm = '<source src="' . $videowebm['url'] . '" type="video/webm">';
            }
			if ($background_src != '') {
                $poster = 'poster="' . $background_src . '"';
            }

            $output = '<div class="sh-video" style="background-image: url(\'' . $background_src . '\');color:'
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
}

// Testimonial Container
class WPBakeryShortCode_SHVC_Testimonialc extends WPBakeryShortCodesContainer {
	public function __construct( $settings ) {
		parent::__construct( $settings );
	}

	public function content($atts, $content=null) {
		global $carousel;
        global $testimonials;
        $carousel = true;
        extract(shortcode_atts(array(
            'pause' => '5000',
            'control' => 'false',
            'transition' => 'fade', // horizontal, vertical, or fade
            'adapt' => 'true'       // auto adapt slide height
        ), $atts));
		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
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
}

// Testimonial Individual
class WPBakeryShortCode_SHVC_TESTIMONIAL extends WPBakeryShortCode {
	/* We create global variables that are shared with the parent table */

    public function content($atts, $content = null) {
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
		$content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
        $content = do_shortcode($content);

	    $imageSrc = '';
		// get the image url from image set in visual composer for background
        $img_attributes = wp_get_attachment_image_src($image, 'full');
        $image = $img_attributes[0];
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
}
		

// Google Maps
class WPBakeryShortCode_SHVC_GMAP extends WPBakeryShortCodesContainer {
    public function __construct( $settings ) {
        parent::__construct( $settings );
    }

    public function content($atts, $content=null) {
		global $gmap_points;
        extract(shortcode_atts(array(
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
			'changemap' => 'false',
            'mapcolor' => '',
			'saturation' => '0',
			'lightness' => '0',
            'infobox' => '',
            'infoboxbg' => 'rgba(255,255,255,0.9)',
            'infoboxcolor' => '#111',
            'unique' => 'default',  // set one just in case
            'bordered' => 'false',
            'fullwidth' => 'false',
        ), $atts ) );
		// get the image url from image set in visual composer for background
        $img_attributes = wp_get_attachment_image_src($marker, 'full');
        $marker = $img_attributes[0];

		if ($changemap == 'false') {
			$mapcolor = '';
		}


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

		$infoboxAr['infobox'] = $infobox;   // build an array for json encoding and to match format for other points
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
            . $infoboxcolor . '" data-mapcolor="' . $mapcolor . '" data-saturation ="' . $saturation 
			. '" data-lightness="' . $lightness . '" data-points ="' . $secondary_out . '"></div></div>';
        $gmap_points = array();
        return $output;
    }

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

}

// Table Row
class WPBakeryShortCode_SHVC_GMAP_POINT extends WPBakeryShortCode {
    /* We create global variables that are shared with the parent table */
    public function content($atts, $content = null) {
		extract( shortcode_atts( array(
            'address' => '',
            'marker' => '',
            'infobox' => '',
        ), $atts) );
        global $gmap_points;
        global $point_inc;
        $point_inc++;
		
		// get the image url from image set in visual composer for background
        $img_attributes = wp_get_attachment_image_src($marker, 'full');
        $marker = $img_attributes[0];

        if ($address) {
            $gmap_points[$point_inc]['address'] = $address;
            $gmap_points[$point_inc]['marker'] = $marker;
            $gmap_points[$point_inc]['infobox'] = $infobox;
        }
    }
}
