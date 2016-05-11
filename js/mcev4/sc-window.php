<?php 
global $shcreate;
?>
<!DOCTYPE html>
<html>
<head>
<!-- iframed version for tinyMCE 4+ -->
<link rel="stylesheet" href="<?php echo SH_ROOT_URL; ?>/css/sh-admin.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo SH_ROOT_URL; ?>/css/spectrum.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo SH_ROOT_URL; ?>/css/font-awesome/css/font-awesome.min.css" type="text/css" media="all" />
<?php
if (isset($shcreate['linear-icons']) && $shcreate['linear-icons'] ) {
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/linear-icons/style.css" type="text/css" media="all" />
<?php } ?>

<?php 
if (isset($shcreate['ion-icons']) && $shcreate['ion-icons'] ) {
?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ionicons/css/ionicons.min.css" type="text/css" media="all" />
<?php } ?>

</head>
<body>

<div class="sc-container">
	<div class="sc-wrapper">
    	<div class="sc-selection">
        	<div class="sc-label">Shortcode</div>
            <div class="sc-option">
				<select class="sc-select">
					<?php 
						$choices = scChoices();
						foreach ($choices as $k => $v) {
							if ($v['value'] == 'optgroup') {
								echo '<optgroup label="' . $v['name'] . '"></optgroup>';
							} else {
								echo '<option value="' . $v['value'] . '">' . $v['name'] . '</option>';
							}
						}
					?>
                </select>
			</div>
        </div>
        <div class="sc-individual">Choose a shortcode.</div>
        <input class="sc-save button button-primary" value="Insert" />
    </div>
</div>

<!-- The javascript for the shortcodes -->
<script>
var jQuery = parent.jQuery;
var wp = parent.wp;  // For image selection
var linearIcons = "<?php echo isset($shcreate['linear-icons']) ? $shcreate['linear-icons'] : false; ?>"; // Linear Icons enabled
var ionIcons = "<?php echo isset($shcreate['ion-icons']) ? $shcreate['ion-icons'] : false; ?>"; // Ion Icons enabled
jQuery(function ($) {  // use $ for jQuery
    "use strict";
    /* Shortcode specific options */
    $(document).on('change', '.sc-select', function() {
        var sel = $(this).val();

		if (sel == 'alertmsg') { // Alert messages
			var results = window.parent.retrieveAllIcons(processResults5);
			// results handled in processResults

		} else if (sel == 'accordion') { // Accordions
			var ind = '<div class="fields"><div class="sc-label"><?php echo __('Choose Type', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="accord-type">'
					+ '<option value="single"><?php echo __('One open at a time', 'shshortc'); ?></option>'
					+ '<option value="all"><?php echo __('All open at a time', 'shshortc'); ?></option>'
					+ '</select></div></div>'
					
					+ '<div class="fields"><div class="sc-label"><?php echo __('Choose how many tabs', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="accord-number">';
			for (var i=1; i<21; i++) {
				ind += '<option value="' + i + '">' + i + '</option>';
			}
					
            ind += '</select></div></div>'
				+ '<div class="sh-message"><?php echo __("Type sets if many or one tab can be open at a time.  Choose the number of tabs you\'ll have ( you can always add more later ).  If you want one to be open on load just add <b>open=\"true\"</b> to the individual tab.", 'shshortc'); ?></div>';

		} else if (sel == 'anchor') { // Anchor Links
			var ind = '<div class="fields"><div class="sc-label"><?php echo __('Set the anchor id', 'shshortc'); ?></div>'
					+ '<div class="sc-option"><input type="text" class="anchor-id" value="" /></div></div>'
					+ '<div class="fields"><div class="sc-label"><?php echo __('Content', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><textarea class="anchor-text" /></textarea></div></div>'
                    + '<div class="sh-message"><?php echo __('Give your anchor a unique id, you can then create custom links to this id (e.g. <b>contactnow</b> custom link = http://mywebsite/#contactnow).  Leave content blank for hidden anchor.', 'shshortc'); ?></div>';

		} else if (sel == 'animate') { // Animations
			<?php  // get animation list
				require_once SH_ROOT_PATH.'/core/sh-animations.php';
        		$animations = SH_ANIMATIONS();
			?>
			
			var ind = '<div class="fields"><div class="sc-label"><?php echo __('Choose Animation', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="anim-type">'

			<?php foreach ($animations as $k => $v) { echo "+ '<option value=\"$v\">$k</option>'" . "\n"; } ?>
					+ '</select></div></div>'
					+ '<div class="fields"><div class="sc-label"><?php echo __('Set the delay', 'shshortc'); ?></div>'
					+ '<div class="sc-option"><input type="text" class="anim-delay" value="1000" /></div></div>'

                    + '<div class="sh-message"><?php echo __('Choose an animation and set a delay (1000 = 1 second)', 'shshortc'); ?></div>';

		} else if (sel == 'button') {     // Button options
			var results = window.parent.retrieveAllIcons(processResults4);
            // results handled in processResults

		} else if (sel == 'bloggrid') {   // Latest Posts Blog Grid
			var ind = '<div class="fields"><div class="sc-label"><?php echo __('Items Per Row', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="bloggrid-perrow">'
                    + '<option value="2">2</option>'
					+ '<option value="3">3</option>'
					+ '<option value="4">4</option>'
					+ '<option value="5">5</option>'
                    + '</select></div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Total Items To Show', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="bloggrid-show">';
			for (var i=1; i<21; i++) {
					ind += '<option value="' + i + '">' + i + '</option>';
			}
             
			ind += '</select></div></div>'
			 	+ '<div class="fields"><div class="sc-label"><?php echo __('Categories', 'shshortc'); ?></div>'
				+ '<div class="sc-option"><input type="text" class="bloggrid-categories"></div></div>'
				+ '<div class="sh-message"><?php echo __("3 or 4 Items per row will look best, keep in mind this is for showing a small group of recent posts in other pages. If you want to show more or all use one of the blog templates.  Categories are seperated by commas.", 'shshortc'); ?></div>';

		} else if (sel == 'portfoliogrid') { // Portfolio Grid
			var ind = '<div class="fields"><div class="sc-label"><?php echo __('Items Per Row', 'shshortc'); ?></div>'
					+ '<div class="sc-option"><select class="portfoliogrid-perrow">'
					+ '<option value="2">2</option>'
					+ '<option value="3">3</option>'
					+ '<option value="4">4</option>'
					+ '<option value="5">5</option>'
					+ '<option value="6">6</option>'
					+ '</select></div></div>'

                    + '<div class="fields"><div class="sc-label"><?php echo __('Total Items To Show', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="portfoliogrid-show">';
            for (var i=1; i<21; i++) {
                    ind += '<option value="' + i + '">' + i + '</option>';
            }
             
            ind += '</select></div></div>'
					+ '<div class="fields"><div class="sc-label"><?php echo __('Categories', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="portfoliogrid-categories"></div></div>'

                	+ '<div class="sh-message"><?php echo __("Seperate categories with a comma (,) leave blank for all.", 'shshortc'); ?></div>';


		} else if (sel == 'callout') { // Callout options
			var results = window.parent.retrieveAllIcons(processResults6);
			// results handled in processResults

		} else if (sel == 'contentbox') { // Content Boxes
			var results = window.parent.retrieveAllIcons(processResults9);
			// results handled in processResults 9

        } else if (sel=='quote') {  // Quote
            var ind = '<div class="fields"><div class="sc-label"><?php echo __('Block Quote', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><textarea class="quote-text" /></textarea></div></div>'
                    + '<div class="sh-message"><?php echo __('Add Your Quote Text', 'shshortc'); ?></div>';

        } else if (sel=='quote2') {  // Quote
            var ind = '<div class="fields"><div class="sc-label"><?php echo __('Block Quote', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><textarea class="quote-text" /></textarea></div></div>'
                    + '<div class="sh-message"><?php echo __('Add Your Quote Text', 'shshortc'); ?></div>';

        } else if (sel=='pullquote') { // Pullquote
            var ind = '<div class="fields"><div class="sc-label"><?php echo __('Quote Text', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><textarea class="quote-text" /></textarea></div></div>'
                    + '<div class="fields"><div class="sc-label"><?php echo __('Side to pull to', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="quote-side">'
                    + '<option value="left"><?php echo __('Left Side', 'shshortc'); ?></option>'
                    + '<option value="right"><?php echo __('Right Side', 'shshortc'); ?></option>'
					+ '<option value="center"><?php echo __('Center', 'shshortc'); ?></option>'
                    + '</select></div></div>'
                    + '<div class="fields"><div class="sc-label"><?php echo __('Source', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="quote-source" /></div></div>'
                    + '<div class="sh-message"><?php echo __('Enter your text, choose a side to pull to and enter a source if wanted.', 'shshortc'); ?></div>';

        } else if (sel=='dropcap') { // Dropcap
            var ind = '<div class="fields"><div class="sc-label"><?php echo __('Letter to Dropcap', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="dropcap-letter" /></div></div>'

                    + '<div class="fields"><div class="sc-label"><?php echo __('Choose The Style', 'shshortc'); ?></div>'
					+ '<div class="sc-option"><select class="dropcap-style">'
                    + '<option value="theme"><?php echo __('Theme Accent Color', 'shshortc'); ?></option>'
                    + '<option value="custom"><?php echo __('Custom colors', 'shshortc'); ?></option>'
                    + '</select></div></div>'
					
					+ '<div class="fields">'
					+ '<div class="sc-label"><?php echo __('Choose Highlight', 'shshortc'); ?></div>'
					+ '<div class="sc-option"><select class="dropcap-color">'
                    + '<option value="foreground"><?php echo __('Foreground Highlight', 'shshortc'); ?></option>'
                    + '<option value="background"><?php echo __('Background Highlight', 'shshortc'); ?></option>'
                    + '</select></div></div>'

					+ '<div class="fields" style="display:none;">'
                    + '<div class="sc-label"><?php echo __("Dropcap Font Color:", "shshortc"); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor dropcap-fontcolor"'
                    + ' value="#555" /></div></div>'

					+ '<div class="fields" style="display:none;">'
					+ '<div class="sc-label"><?php echo __('Set Background Color', 'shshortc'); ?></div>'
					+ '<div class="sc-option"><select class="dropcap-setbg">'
                    + '<option value="true"><?php echo __('Set a background color', 'shshortc'); ?></option>'
                    + '<option value="false" selected="selected">'
					+ '<?php echo __('Do not set a background color', 'shshortc'); ?></option>'
                    + '</select></div></div>'

					+ '<div class="fields" style="display:none;">'
                	+ '<div class="sc-label"><?php echo __('Background Color:', 'shshortc'); ?></div>'
                	+ '<div class="sc-option"><input type="text" class="spectrumcolor dropcap-background"'
                	+ ' value="rgba(0,0,0,0.25)" /></div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Letter Dropshadow', 'shshortc'); ?></div>'
					+ '<div class="sc-option"><select class="dropcap-dropshadow">'
                    + '<option value="true"><?php echo __('True - set a dropshadow on the letter', 'shshortc'); ?></option>'
                    + '<option value="false" selected="selected">'
					+ '<?php echo __('False - Do not set a dropshadow', 'shshortc'); ?></option>'
                    + '</select></div></div>'

                    + '<div class="sh-message"><?php echo __('Insert the letter you want to add the dropcap to and select your options.', 'shshortc');?></div>';

        } else if (sel=='highlight') { // Highlight
            var ind = '<div class="fields"><div class="sc-label"><?php echo __('Highlight Text', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="highlight" /></div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Color', 'shshortc'); ?></div>'
					+ '<div class="sc-option"><select class="highlight-color">'
					+ '<option value="accentcolor"><?php echo __('Accent color', 'shshortc'); ?></option>'
					+ '<option value="dark"><?php echo __('Dark', 'shshortc'); ?></option>'
					+ '<option value="yellow"><?php echo __('Yellow', 'shshortc'); ?></option>'
					+ '<option value="custom"><?php echo __('Custom', 'shshortc'); ?></option>'
					+ '</select></div></div>'
		
					+ '<div class="fields"><div class="sc-label"><?php echo __('Foreground or Background', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="highlight-choice">'
                    + '<option value="foreground"><?php echo __('Foreground', 'shshortc'); ?></option>'
                    + '<option value="background"><?php echo __('Background', 'shshortc'); ?></option>'
                    + '</select></div></div>'

					+ '<div class="fields" style="display:none;">'
                    + '<div class="sc-label"><?php echo __("Highlight Font Color:", "shshortc"); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor highlight-fontcolor"'
                    + ' value="#555" /></div></div>'

					+ '<div class="fields" style="display:none;">'
                    + '<div class="sc-label"><?php echo __("Highlight Background Color:", "shshortc"); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor highlight-background"'
                    + ' value="#fff" /></div></div>'

                    + '<div class="sh-message"><?php echo __('Add the text you would like to highlight with the theme accent color or a color of your choosing.', 'shshortc');?></div>';

		} else if (sel=='imageframe') { // Image Frame
			var ind = '<div class="fields"><div class="sc-label"><?php echo __('Image Style', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="imageframe-style" >'
				+ '<option value="bordered"><?php echo __('Bordered', 'shshortc'); ?></option>'
				+ '<option value="circle"><?php echo __('Circle', 'shshortc'); ?></option>'
				+ '<option value="circleshadow"><?php echo __('Circle with Shadow', 'shshortc'); ?></option>'
				+ '<option value="shadow"><?php echo __('Shadowed', 'shshortc'); ?></option>'
				+ '<option value="lifted"><?php echo __('Lifted', 'shshortc'); ?></option>'
				+ '<option value="sideshadow"><?php echo __('Side Shadows', 'shshortc'); ?></option>'
				+ '</select></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Border Size', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="imageframe-bordersize" >';
			for (var i = 0; i < 31; i++) {
				ind += '<option value="' + i + 'px">' + i + 'px</option>';
			}
			ind += '</select></div></div>'
				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Border Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor imageframe-bordercolor"'
				+ ' value="#555" /></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Padding', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="imageframe-padding" >';
            for (var i = 0; i < 31; i++) {
                ind += '<option value="' + i + 'px">' + i + 'px</option>';
            }

            ind += '</select></div></div>'
				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Image URL', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="upload_image" type="text" name="background-image" value="" />'
                + '</div></div>'
                + '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Choose Image', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="upload_image_button" class="button"'
                + ' type="button" value="<?php echo __('Choose Image', 'shshortc'); ?>" />'
                + '<br /><br /><div class="sc-option"><div class="image-selected"></div></div></div>'
                + '</div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Action', 'shshortc'); ?></div>'
				+ '<div class="sc-option"><select class="imageframe-action" >'
				+ '<option value="none"><?php echo __('None', 'shshortc'); ?></option>'
				+ '<option value="url"><?php echo __('Open a new URL', 'shshortc'); ?></option>'
				+ '<option value="fancybox"><?php echo __('Open Image in Lightbox', 'shshortc'); ?></option>'
				+ '</select></div></div>'

				+ '<div class="fields" style="display:none">'
				+ '<div class="sc-label"><?php echo __('Hover Effect', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="imageframe-hover" >'
                + '<option value="disable"><?php echo __('Disable', 'shshortc'); ?></option>'
                + '<option value="enable"><?php echo __('Enable', 'shshortc'); ?></option>'
                + '</select></div></div>'

				+ '<div class="fields" style="display:none">'
				+ '<div class="sc-label"><?php echo __('Title', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="imageframe-title" type="text" />'
                + '</div></div>'

				+ '<div class="fields" style="display:none">'
				+ '<div class="sc-label"><?php echo __('Link URL', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="imageframe-url" type="text" />'
                + '</div></div>';

		} else if (sel =='progressbar') { // Progress Bars
			var ind = '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Style', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="progress-style" type="text">'
				+ '<option value="solid"><?php echo __('Solid Bar', 'shshortc'); ?></option>'
				+ '<option value="striped"><?php echo __('Striped Bar', 'shshortc'); ?></option>'
				+ '<option value="pulse"><?php echo __('Pulse Bar', 'shshortc'); ?></option>'
                + '</select></div></div>'
			
				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Bar Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="progress-barcolor spectrumcolor" value="#2980b9" /></div></div>'
				
				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Text Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="progress-textcolor spectrumcolor" value="#fff" /></div></div>'				
				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Background Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="progress-background spectrumcolor" value="rgba(0,0,0,0.15)" />'
				+ '</div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Padding', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="progress-padding" type="text">';

				for (i=0; i<31;i++) {
					ind += '<option value="' + i + 'px">' + i + 'px</option>';
				}
                ind += '</select></div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Progress Text:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="progress-text" value="Your Progress Text" /></div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Progress Bar percent (e.g. 25):', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="progress-percent small-text" value="75" />%</div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Progress symbol:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="progress-symbol small-text" value="%" /></div></div>';
					

        } else if (sel=='fontawesome') { // Font Awesome, Linear & Ion Icons
            var results = window.parent.retrieveAllIcons(processResults);
            // results handled in processResults

		} else if (sel=='socialicon') { // Social Icons (Font Awesome)
			var results = window.parent.retrieveAllIcons(processResults10);

        } else if (sel== 'center') { // Center content
            var ind = '<div class="fields"><div class="sc-label"><?php echo __('Click Insert', 'shshortc'); ?></div></div>'
                    + '<div class="sh-message"><?php echo __('This is useful for centering other shortcodes in your layout.  After creation, insert your shortcodes inside this container shortcode.', 'shshortc');?></div>';

		} else if (sel=='contact') { // Contact Forms
			var ind = '<div class="fields">'
				    + '<div class="sc-label"><?php echo __('Name Field Text', 'shshortc'); ?></div>'
			        + '<div class="sc-option"><input type="text" class="contact-nametext"'
					+ ' value="<?php echo __('Your Name', 'shshortc');?>" /></div></div>'

					+ '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Email Field Text', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="contact-emailtext"'
					+ ' value="<?php echo __('Your Email', 'shshortc');?>" /></div></div>'

					+ '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Message Field Text', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="contact-messagetext"'
					+ ' value="<?php echo __('Enter Your Message', 'shshortc');?>" /></div></div>'

					+ '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Input Text Color', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="contact-inputtext spectrumcolor"'
                    + ' value="#555555" /></div></div>'

					+ '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Input Background Color', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="contact-inputbg spectrumcolor"'
                    + ' value="#ffffff" /></div></div>'

					+ '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Input Border Color', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="contact-inputborder spectrumcolor"'
                    + ' value="#777777" /></div></div>'

					+ '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Button Text', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="contact-buttontext"'
                    + ' value="<?php echo __('Send Message', 'shshortc');?>" /></div></div>'

				    + '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Button Background Color', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="contact-buttonbg spectrumcolor"'
					+ ' value="#ffffff" /></div></div>'



					+ '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Button Text Color', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="contact-buttoncolor spectrumcolor"'
                    + ' value="#555555" /></div></div>'

					+ '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Button Border Color', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="contact-buttonborder spectrumcolor"'
                    + ' value="#555555" /></div></div>'

					+ '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Button Border Width', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="contact-buttonborderw small-text"'
                    + ' value="2px" /></div></div>'

					+ '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Input and Buton Radius', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="contact-borderradius small-text"'
                    + ' value="0px" /></div></div>'

					+ '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Send to other email?', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="contact-newemail"'
                    + ' value="<?php echo __('', 'shshortc');?>" /></div></div>'

					+ '<div class="sh-message"><?php echo __('Border width and radius need to be in the format <b>2px</b> (size with px following).  Leave new email blank if you want this to go to the default admin email.', 'shshortc');?></div>';

		} else if (sel=='checklist') { // include Font Awesome for checklists
			var results = window.parent.retrieveAllIcons(processResults3);
			// results handled in processResults3

        } else if (sel=='headers') {  // Headers
            var ind = '<div class="fields"><div class="sc-label"><?php echo __('Header Size', 'shshortc'); ?></div>'
                 + '<div class="sc-option"><select class="header-size">'
            	 + '<option value="h1">h1</option>'
               	 + '<option value="h2">h2</option>'
                 + '<option value="h3">h3</option>'
                 + '<option value="h4">h4</option>'
                 + '<option value="h5">h5</option>'
                 + '<option value="h6">h6</option>'
            	 + '</select></div></div>'

				 + '<div class="fields"><div class="sc-label"><?php echo __('Header Type', 'shshortc'); ?></div>'
                 + '<div class="sc-option"><select class="header-type">'
                 + '<option value="underline"><?php echo __('Underlined', 'shshortc');?></option>'
                 + '<option value="boxed"><?php echo __('boxed', 'shshortc');?></option>'
                 + '</select></div></div>'

                 + '<div class="fields"><div class="sc-label"><?php echo __('Header Content', 'shshortc'); ?></div>'
                 + '<div class="sc-option"><input type="text" class="header-text" />'
                 + '</div></div>'
                 + '<div class="fields"><div class="sc-label"><?php echo __('Summary Below Header', 'shshortc'); ?></div>'
                 + '<div class="sc-option"><input type="text" class="header-summary" />'
                 + '</div></div>'

				 + '<div class="fields"><div class="sc-label"><?php echo __('Change Header Color', 'shshortc'); ?></div>'
                 + '<div class="sc-option"><select class="header-color-change">'
			 	 + '<option value="disable"><?php echo __('Disable', 'shshortc');?></option>'
				 + '<option value="enable"><?php echo __('Enable', 'shshortc');?></option>'
                 + '</select></div></div>'				 

				 + '<div class="fields"><div class="sc-label"><?php echo __('Header Bar Height', 'shshortc'); ?></div>'
                 + '<div class="sc-option"><input class="header-barheight" type="text" value="2px" />'
                 + '</div></div>'  

				 + '<div class="fields"><div class="sc-label"><?php echo __('Header Bar Width', 'shshortc'); ?></div>'
                 + '<div class="sc-option"><input class="header-barwidth" type="text" value="200px" />'
                 + '</div></div>' 

				 + '<div class="fields">'
                 + '<div class="sc-label"><?php echo __('Header Bar Color:', 'shshortc'); ?></div>'
                 + '<div class="sc-option"><input type="text" class="spectrumcolor header-barcolor" value="#555" /></div></div>'

				 + '<div class="fields" style="display:none;">'
				 + '<div class="sc-label"><?php echo __('Header Color:', 'shshortc'); ?></div>'
                 + '<div class="sc-option"><input type="text" class="spectrumcolor header-color" value="#555" /></div></div>'

                 + '<div class="sh-message"><?php echo __('Select the header size and input the content. Add a summary below if you like (note: content below header is ignored for boxed).  Change the default text color if you want.', 'shshortc');?></div>';

         } else if (sel=='headersdouble') {  // Headers double bar
            var ind = '<div class="fields"><div class="sc-label"><?php echo __('Header Size', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="header-size">';

            ind += '<option value="h1">h1</option>'
                 + '<option value="h2">h2</option>'
                 + '<option value="h3">h3</option>'
                 + '<option value="h4">h4</option>'
                 + '<option value="h5">h5</option>'
                 + '<option value="h6">h6</option>';

            ind += '</select></div></div>'
                 + '<div class="fields"><div class="sc-label"><?php echo __('Header Content', 'shshortc'); ?></div>'
                 + '<div class="sc-option"><input type="text" class="header-text" />'
                 + '</div></div>'
                 + '<div class="sh-message"><?php echo __('Select the header size and input the content.', 'shshortc');?></div>';

		} else if (sel == 'countdown') { // Countdowns
				
			var ind = '<div class="fields"><div class="sc-label"><?php echo __('Year', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="count-year">';
	        for (var i=2014; i < 2060; i++) {
				ind += '<option value="' + i + '">' + i + '</option>';
			}
		    ind += '</select></div></div>'
				
				+ '<div class="fields"><div class="sc-label"><?php echo __('Month', 'shshortc'); ?></div>'
				+ '<div class="sc-option"><select class="count-month">'
				+ '<option value="January"><?php echo __('January', 'shshortc');?></option>'
				+ '<option value="February"><?php echo __('February', 'shshortc');?></option>'
				+ '<option value="March"><?php echo __('March', 'shshortc');?></option>'
				+ '<option value="April"><?php echo __('April', 'shshortc');?></option>'
				+ '<option value="May"><?php echo __('May', 'shshortc');?></option>'
			    + '<option value="June"><?php echo __('June', 'shshortc');?></option>'
				+ '<option value="July"><?php echo __('July', 'shshortc');?></option>'
				+ '<option value="August"><?php echo __('August', 'shshortc');?></option>'
				+ '<option value="September"><?php echo __('September', 'shshortc');?></option>'
				+ '<option value="October"><?php echo __('October', 'shshortc');?></option>'
				+ '<option value="November"><?php echo __('November', 'shshortc');?></option>'
				+ '<option value="December"><?php echo __('December', 'shshortc');?></option>'
				+ '</select></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Day', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="count-day">';
			for (var i=1; i < 32; i++) {
				ind += '<option value="' + i + '">' + i + '</option>';
			}
			ind += '</select></div></div>'
				+ '<div class="fields"><div class="sc-label"><?php echo __('Time', 'shshortc'); ?></div>'
                + '<div class="sc-option"><?php echo __("Hr:", "shshortc");?> <select class="count-hour">'
				+ '<option value="00"><?php echo __("12 AM", "shshortc");?></option>'
				+ '<option value="01"><?php echo __("1 AM", "shshortc");?></option>'
				+ '<option value="02"><?php echo __("2 AM", "shshortc");?></option>'
				+ '<option value="03"><?php echo __("3 AM", "shshortc");?></option>'
				+ '<option value="04"><?php echo __("4 AM", "shshortc");?></option>'
				+ '<option value="05"><?php echo __("5 AM", "shshortc");?></option>'
				+ '<option value="06"><?php echo __("6 AM", "shshortc");?></option>'
				+ '<option value="07"><?php echo __("7 AM", "shshortc");?></option>'
				+ '<option value="08"><?php echo __("8 AM", "shshortc");?></option>'
				+ '<option value="09"><?php echo __("9 AM", "shshortc");?></option>'
				+ '<option value="10"><?php echo __("10 AM", "shshortc");?></option>'
				+ '<option value="11"><?php echo __("11 AM", "shshortc");?></option>'
				+ '<option value="12"><?php echo __("12 PM", "shshortc");?></option>'
				+ '<option value="13"><?php echo __("1 PM", "shshortc");?></option>'
				+ '<option value="14"><?php echo __("2 PM", "shshortc");?></option>'
				+ '<option value="15"><?php echo __("3 PM", "shshortc");?></option>'
				+ '<option value="16"><?php echo __("4 PM", "shshortc");?></option>'
				+ '<option value="17"><?php echo __("5 PM", "shshortc");?></option>'
				+ '<option value="18"><?php echo __("6 PM", "shshortc");?></option>'
				+ '<option value="19"><?php echo __("7 PM", "shshortc");?></option>'
				+ '<option value="20"><?php echo __("8 PM", "shshortc");?></option>'
				+ '<option value="21"><?php echo __("9 PM", "shshortc");?></option>'
				+ '<option value="22"><?php echo __("10 PM", "shshortc");?></option>'
				+ '<option value="23"><?php echo __("11 PM", "shshortc");?></option>'
			ind += '</select>'
				+ ' <?php echo __("Min:", "shshortc");?> <select class="count-minute">';
			for (var i=0; i < 60; i++) {
				var num = ("0" + i).slice(-2);
				ind += '<option value="' + num + '">' + num + '</option>';
			}
			ind += '</select>'
				+ ' <?php echo __("Secs:", "shshortc");?> <select class="count-seconds">';

			for (var i=0; i < 60; i++) {
				var num = ("0" + i).slice(-2);
                ind += '<option value="' + num + '">' + num + '</option>';
            }

			ind += '</select></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Style:', 'shshortc'); ?></div>'
				+ '<div class="sc-option"><select class="count-style">'
				+ '<option value="simple"><?php echo __("Simple","shshortc");?></option>'
				+ '<option value="bordered"><?php echo __("Bordered","shshortc");?></option>'
				+ '<option value="tiles"><?php echo __("Background Tiles", "shshortc");?></option>'
				+ '</select></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Text Color:', 'shshortc'); ?></div>'
            	+ '<div class="sc-option"><input type="text" class="spectrumcolor count-color" value="#555" /></div></div>'
			    + '<div class="sh-message"><?php echo __('Set the date for the counter to expire, and set your color.', 'shshortc');?></div>';

		} else if (sel == 'gdoc') { // Google Docs
			var ind = '<div class="fields"><div class="sc-label"><?php echo __('Google Doc Link', 'shshortc'); ?></div>'
				    + '<div class="sc-option"><input type="text" class="gdoc-link" /></div></div>'

					+'<div class="fields"><div class="sc-label"><?php echo __('Height', 'shshortc'); ?></div>'
					+ '<div class="sc-option"><input type="text" class="gdoc-height" value="400" /></div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Seamless display', 'shshortc'); ?></div>'
                	+ '<div class="sc-option"><select class="gdoc-seamless">'
					+ '<option value="true"><?php echo __("True (Do not show headers)", "shshortc");?></option>'
					+ '<option value="false"><?php echo __("False (Show document headers)", "shshortc");?></option>'
					+ '</select></div></div>'

					+ '<div class="sh-message"><?php echo __('Enter the url, set a height (e.g. 400), and choose how to display.', 'shshortc');?></div>';


		} else if (sel == 'columns') { // Columns
			var ind = '<div class="fields"><div class="sc-label"><?php echo __('Number of Columns', 'shshortc'); ?></div>'
            	+ '<div class="sc-option"><select class="column-number">'
           		+ '<option value="1">1</option>'
               	+ '<option value="2">2</option>'
               	+ '<option value="3">3</option>'
               	+ '<option value="4">4</option>'
               	+ '<option value="6">6</option>'
				+ '<option value="one-third"><?php echo __("One Third", "shshortc");?></option>'
				+ '<option value="two-thirds"><?php echo __("Two Thirds", "shshortc");?></option>'
				+ '<option value="one-quarter"><?php echo __("One Quarter", "shshortc");?></option>'
				+ '<option value="three-quarters"><?php echo __("Three Quarters", "shshortc");?></option>'
				+ '<option value="middle-half"><?php echo __("Middle Half", "shshortc");?></option>'
				+ '</select></div></div>'
				+ '<div class="sh-message"><?php echo __('Choose the number of columns to create.', 'shshortc');?></div>';

		} else if (sel == 'divider') { // Dividers
			var ind = '<div class="fields"><div class="sc-label"><?php echo __('Divider Style', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="divider-style">'
				+ '<option value="none"><?php echo __("None", "shshortc");?></option>'
                + '<option value="single"><?php echo __("Single Line", "shshortc");?></option>'
                + '<option value="dashed"><?php echo __("Dashed Line", "shshortc");?></option>'
				+ '<option value="dotted"><?php echo __("Dotted Line", "shshortc");?></option>'
                + '<option value="double"><?php echo __("Double Lines", "shshortc");?></option>'
				+ '<option value="doubledash"><?php echo __("Double Dashed Lines", "shshortc");?></option>'
				+ '<option value="doubledot"><?php echo __("Double Dotted Lines", "shshortc");?></option>'
                + '<option value="shadow"><?php echo __("Shadow Line", "shshortc");?></option>'
				+ '<option value="lookdown"><?php echo __("Look Down", "shshortc");?></option>'
                + '</select></div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor divider-color" value="rgba(0,0,0,0.15" />'
                + '</div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Divider width', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="divider-width">'
                + '<option value="wide"><?php echo __("Full Width", "shshortc");?></option>'
                + '<option value="short"><?php echo __("Short", "shshortc");?></option>'
                + '</select></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Spacing Top', 'shshortc'); ?></div>'
				+ '<div class="sc-option"><select class="divider-space-top">';
			for (var i=0; i < 101; i++) {
				var selected = '';
				if (i == 20) {
					selected = ' selected="selected"';
				}
				ind += '<option value="' + i + 'px"' + selected + '>' + i + 'px</option>';
			}

            ind += '</select></div></div>'

			+ '<div class="fields"><div class="sc-label"><?php echo __('Spacing Bottom', 'shshortc'); ?></div>'
            + '<div class="sc-option"><select class="divider-space-bottom">';
            for (var i=0; i < 101; i++) {
                var selected = '';
                if (i == 20) {
                    selected = ' selected="selected"';
                }
                ind += '<option value="' + i + 'px"' + selected + '>' + i + 'px</option>';
            }

            ind += '</select></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Enable Return to Top:', 'shshortc'); ?></div>'
            	+ '<div class="sc-option"><input type="radio" class="return-totop"'
            	+ ' name="returntotop" value="enable" checked="checked">'
            	+ '<?php echo __('Enable', 'shshortc');?><br />'
            	+ '<input type="radio" class="return-totop" name="returntotop" value="disable" checked="checked">'
            	+ '<?php echo __('Disable', 'shshortc');?><br />'
            	+ '</div></div>'

                + '<div class="sh-message"><?php echo __('Choose the style of divider you would like, add the spacing size (for the top and bottom.', 'shshortc');?></div>';

		} else if (sel == 'table') { // Tables
			var ind = '<div class="fields"><div class="sc-label"><?php echo __('Number of Columns', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="table-column-count">';
            var i;
            for(i=1;i<25;i++) {
                ind += '<option value="' + i + '">' + i + '</option>';
            }
            ind += '</select></div></div>'
			 	+ '<div class="fields"><div class="sc-label"><?php echo __('Number of Rows', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="table-row-count">';
            var i;
            for(i=1;i<25;i++) {
                ind += '<option value="' + i + '">' + i + '</option>';
            }
            ind += '</select></div></div>'
				+ '<div class="fields"><div class="sc-label"><?php echo __('Bordered', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="table-border">'
				+ '<option value="noborder"><?php echo __("No Border", "shshortc"); ?></option>'
				+ '<option value="bordered"><?php echo __("Border", "shshortc"); ?></option>'
				+ '</select></div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Row Background Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor table-bgcolor" value="#f9f9f9" />'
                + '</div></div>'    

                + '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Row Alternate Background Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor table-altbgcolor" value="#ffffff" />'
                + '</div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Border Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor table-bordercolor" value="#dddddd" />'
                + '</div></div>'    

                + '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Row Hover Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor table-hovercolor" value="#f5f5f5" />'
                + '</div></div>'

				+ '<div class="sh-message"><?php echo __('Choose the number of rows and columns you would like.  Select Border or no Border', 'shshortc');?></div>';

		} else if (sel == 'gmap') { // Google Map
			var ind = '<div class="fields"><div class="sc-label"><?php echo __('Full Address', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="gmap-address" /></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Add border to map:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="radio" class="gmap-bordered"'
                + ' name="gmapbordered" value="true">'
                + '<?php echo __('True', 'shshortc');?><br />'
                + '<input type="radio" class="gmap-bordered" name="gmapbordered" value="false" checked="checked">'
                + '<?php echo __('False', 'shshortc');?><br />'
                + '</div></div>'
				
				+ '<div class="fields"><div class="sc-label"><?php echo __('Full Width Map:', 'shshortc'); ?></div>'
				+ '<div class="sc-option"><input type="radio" class="gmap-fullwidth"'
                + ' name="gmapfullwidth" value="true">'
                + '<?php echo __('True', 'shshortc');?><br />'
                + '<input type="radio" class="gmap-fullwidth" name="gmapfullwidth" value="false" checked="checked">'
                + '<?php echo __('False', 'shshortc');?><br />'
                + '</div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Map Height', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="gmap-height" value=" 300px" /></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Map Width', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="gmap-width" value="100%" /></div></div>'
			
				+ '<div class="fields"><div class="sc-label"><?php echo __('Zoom Level', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="gmap-zoom">';
			for (var i=0;i<24;i++) {
				if (i == 16) {
					var selected = " selected='selected'";
				} else {
					var selected = '';
				} 
				ind += '<option value="' + i + '"' + selected + '>' + i + '</option>';
			}

            ind += '</select></div></div>'

				// Map Controls
				+ '<div class="fields"><div class="sc-label"><?php echo __('Enable Zoom Control', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="gmap-zoomcontrol">'
                + '<option value="true"><?php echo __('True - show zoom control', 'shshortc');?></option>'
				+ '<option value="false"><?php echo __('False - Do not show zoom control', 'shshortc');?></option>'
            	+ '</select></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Enable Pan Control', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="gmap-pancontrol">'
                + '<option value="true"><?php echo __('True - show pan control', 'shshortc');?></option>'
                + '<option value="false"><?php echo __('False - Do not show pan control', 'shshortc');?></option>'
                + '</select></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Enable Map Type Control', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="gmap-maptypecontrol">'
                + '<option value="true"><?php echo __('True - show map type control', 'shshortc');?></option>'
                + '<option value="false"><?php echo __('False - Do not show map type control', 'shshortc');?></option>'
                + '</select></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Enable ScrollWheel', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="gmap-scrollwheel">'
                + '<option value="true"><?php echo __('True - Mouse Zooms in/out', 'shshortc');?></option>'
                + '<option value="false"><?php echo __('False - No mouse zoom', 'shshortc');?></option>'
                + '</select></div></div>'

				// Map Type
				+ '<div class="fields"><div class="sc-label"><?php echo __('Map Type', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="gmap-maptype">'
                + '<option value="ROADMAP"><?php echo __('Roadmap', 'shshortc');?></option>'
                + '<option value="SATELLITE"><?php echo __('Satellite', 'shshortc');?></option>'
				+ '<option value="TERRAIN"><?php echo __('Terrain', 'shshortc');?></option>'
				+ '<option value="HYBRID"><?php echo __('Hybrid', 'shshortc');?></option>'
                + '</select></div></div>'

				// Marker image
				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Marker URL', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="upload_image gmap-marker" type="text" name="gmapmarker" value="" />'
                + '</div></div>'
                + '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Choose Marker', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="upload_image_button" class="button"'
				+ ' type="button" value="<?php echo __('Choose Marker', 'shshortc'); ?>" />'

				// Map Color
				+ '<div class="fields"><div class="sc-label"><?php echo __('Change Map Color', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="gmap-changemap">'
                + '<option value="true"><?php echo __('True - Use your own color', 'shshortc');?></option>'
                + '<option value="false" selected="selected"><?php echo __('False - Use default map color', 'shshortc');?></option>'
                + '</select></div></div>'

				+ '<div class="fields" style="display:none">'
                + '<div class="sc-label"><?php echo __('Map Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor gmap-mapcolor" value="#6D6D6D" />'
                + '</div></div>'

				+ '<div class="fields" style="display:none">'
                + '<div class="sc-label"><?php echo __('Map Saturation (-100 to 100):', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="gmap-saturation" value="0" />'
                + '</div></div>'

				+ '<div class="fields" style="display:none">'
                + '<div class="sc-label"><?php echo __('Map Lightness (-100 to 100):', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="gmap-lightness" value="0" />'
                + '</div></div>'

				// InfoBox
				+ '<div class="fields"><div class="sc-label"><?php echo __('Infobox Content:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><textarea class="gmap-infobox">'
                + '<?php echo __("This is an infobox, delete text to hide", "shshortc");?>'
				+ '</textarea></div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Infobox Background:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor gmap-infoboxbg" value="rgba(255,255,255,0.8)" />'
                + '</div></div>'	

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Infobox Text Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor gmap-infoboxcolor" value="#111111" />'
                + '</div></div>';


		} else if (sel == 'popover') { // Popover
			var ind = '<div class="fields"><div class="sc-label"><?php echo __('Placement:', 'shshortc'); ?></div>'
				    + '<div class="sc-option"><select class="popover-placement">'
					+ '<option value="top"><?php echo __('Top', 'shshortc'); ?></option>'
					+ '<option value="left"><?php echo __('Left', 'shshortc'); ?></option>'
					+ '<option value="right"><?php echo __('Right', 'shshortc'); ?></option>'
					+ '<option value="bottom"><?php echo __('Bottom', 'shshortc'); ?></option>'
					+ '</select></div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Title:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="popover-title" value="'
					+ '<?php echo __("The Title", "shshortc");?>" /></div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('The Text:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><textarea class="popover-text">'
                    + '<?php echo __("The popover text", "shshortc");?></textarea></div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Trigger:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="popover-trigger">'
                    + '<option value="hover"><?php echo __('Hover', 'shshortc'); ?></option>'
                    + '<option value="click"><?php echo __('Click', 'shshortc'); ?></option>'
                    + '</select></div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Change default colors:', 'shshortc'); ?></div>'
                	+ '<div class="sc-option"><input type="radio" class="popover-color"'
                	+ ' name="popovercolor" value="enable">'
                	+ '<?php echo __('Enable', 'shshortc');?><br />'
                	+ '<input type="radio" class="popover-color" name="popovercolor" value="disable" checked="checked">'
                	+ '<?php echo __('Disable', 'shshortc');?><br />'
                	+ '</div></div>'

					// Title Font color
                    + '<div class="fields" style="display: none;">'
					+ '<div class="sc-label"><?php echo __('Title Font Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor popover-titlecolor" value="#6D6D6D" />'
                    + '</div></div>'

					// Title Background Color
                    + '<div class="fields" style="display: none;">'
					+ '<div class="sc-label"><?php echo __('Title Background Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor popover-titlebgcolor" value="#F7F7F7" />'
                    + '</div></div>'

					// Text color
                    + '<div class="fields" style="display: none;">'
					+ '<div class="sc-label"><?php echo __('Text Font Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor popover-fontcolor" value="#6D6D6D" />'
                    + '</div></div>'

					// Text Background Color
                    + '<div class="fields" style="display: none;">'
					+ '<div class="sc-label"><?php echo __('Text Background Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor popover-bgcolor" value="#fff" />'
                    + '</div></div>'

					// Border Color
                    + '<div class="fields" style="display: none;">'
					+ '<div class="sc-label"><?php echo __('Border Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor popover-bordercolor" value="rgba(0,0,0,0.25)" />'
                    + '</div></div>';

		} else if (sel=='tooltip') { // Tooltips
			var ind = '<div class="fields"><div class="sc-label"><?php echo __('Placement:', 'shshortc'); ?></div>'
				    + '<div class="sc-option"><select class="tooltip-placement">'
				    + '<option value="top"><?php echo __('Top', 'shshortc'); ?></option>'
				    + '<option value="left"><?php echo __('Left', 'shshortc'); ?></option>'
				    + '<option value="right"><?php echo __('Right', 'shshortc'); ?></option>'
				    + '<option value="bottom"><?php echo __('Bottom', 'shshortc'); ?></option>'
				    + '</select></div></div>'
				
					+ '<div class="fields"><div class="sc-label"><?php echo __('Title:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="tooltip-title" value="'
                    + '<?php echo __("The Title", "shshortc");?>" /></div></div>'
			
					+ '<div class="sh-message"><?php echo __('Select the placement and set your title text.', 'shshortc');?></div>';


        } else if (sel=='pricetable') {  // Pricing tables
            var ind = '<div class="fields"><div class="sc-label"><?php echo __('Number of Columns', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="price-column-count">';
            var i;
            for(i=1;i<7;i++) {
                ind += '<option value="' + i + '">' + i + '</option>';
            }
            ind += '</select></div></div>';
            ind += '<div class="fields"><div class="sc-label"><?php echo __('Column To Highlight', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="price-column-highlight">';

            for(i=1;i<7;i++) {
                ind += '<option value="' + i + '">' + i + '</option>';
            }
            ind += '<option value="none"><?php echo __('None', 'shshortc'); ?></option>'
            	+ '</select></div></div>'
			
				+ '<div class="fields"><div class="sc-label"><?php echo __('Style', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="price-style">'
				+ '<option value="color"><?php echo __('Colored Columns', 'shshortc'); ?></option>'
				+ '<option value="light"><?php echo __('Light Columns', 'shshortc'); ?></option>'
				+ '</select></div></div>'


                + '<div class="sh-message"><?php echo __('Choose the number of columns first and then the column to Highlight.', 'shshortc');?></div>';

		} else if (sel=='colorbg') { // Color Background section
            var ind = '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Background Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor colorbg-overlay" value="rgba(0,0,0,1)" />'
                    + '</div></div>'

                    // font color
                    + '<div class="fields"><div class="sc-label"><?php echo __('Text Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor colorbg-font" value="#ffffff" />'
                    + '</div></div>'

                    // Enable section arrow
                    + '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Enable section top or bottom arrow', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="colorbg-arrow">'
                    + '<option value="none"><?php echo __('None', 'shshortc');?></option>'
                    + '<option value="top"><?php echo __('Top', 'shshortc');?></option>'
                    + '<option value="bottom"><?php echo __('Bottom', 'shshortc');?></option>'
                    + '</select></div></div>';

		} else if (sel=='imagebg') { // Image Background section
			var ind = '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Background Image URL', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input class="upload_image" type="text" name="background-image" value="" />'
                    + '</div></div>'
                    + '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Choose Image', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input class="upload_image_button" class="button"'
                    + ' type="button" value="<?php echo __('Choose Image', 'shshortc'); ?>" />'
                    + '<br /><br /><div class="sc-option"><div class="image-selected"></div></div></div>'
                    + '</div></div>'

					// repeat or cover
					// Enable section arrow
                    + '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Full or Repeat image', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="imagebg-repeat">'
                    + '<option value="cover"><?php echo __('Full / Cover', 'shshortc');?></option>'
                    + '<option value="repeat"><?php echo __('Repeat Image', 'shshortc');?></option>'
                    + '</select></div></div>'
					
					// overlay color
					+ '<div class="fields">'
                    + '<div class="sc-label"><?php echo __('Overlay Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor imagebg-overlay" value="rgba(0,0,0,0.25)" />'
                    + '</div></div>'

					// font color
                    + '<div class="fields"><div class="sc-label"><?php echo __('Text Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor imagebg-font" value="#ffffff" />'
                    + '</div></div>'

					// Enable section arrow
                    + '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Enable section top or bottom arrow', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="imagebg-arrow">'
                    + '<option value="none"><?php echo __('None', 'shshortc');?></option>'
                    + '<option value="top"><?php echo __('Top', 'shshortc');?></option>'
					+ '<option value="bottom"><?php echo __('Bottom', 'shshortc');?></option>'
                    + '</select></div></div>';
			
					

        } else if (sel=='parallax') { // Parallax Section
            var ind = '<div class="fields"><div class="sc-label">'
					+ '<?php echo __('Choose section background', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="background-choice">'
                    + '<option value="solid"><?php echo __('Solid Color', 'shshortc');?></option>'
                    + '<option value="parallax"><?php echo __('Parallax', 'shshortc');?></option>'
					+ '<option value="fixed"><?php echo __('Fixed', 'shshortc');?></option>'
					+ '<option value="video"><?php echo __('Video', 'shshortc');?></option>'
                    + '</select></div></div>'

					// solid background color
					+ '<div class="fields"><div class="sc-label"><?php echo __('Background Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor bg-color" value="#555" />'
                    + '</div></div>'

					// parallax
					+ '<div class="fields" style="display:none;">'
					+ '<div class="sc-label"><?php echo __('Background Image URL', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input class="upload_image" type="text" name="background-image" value="" />'
                    + '</div></div>'
                    + '<div class="fields" style="display:none;">'
					+ '<div class="sc-label"><?php echo __('Choose Image', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input class="upload_image_button" class="button"'
					+ ' type="button" value="<?php echo __('Choose Image', 'shshortc'); ?>" />'
					+ '<br /><br /><div class="sc-option"><div class="image-selected"></div></div></div>'
                    + '</div></div>'

					+ '<div class="fields" style="display:none;">'
					+ '<div class="sc-label"><?php echo __('Overlay Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor overlaycolor" value="rgba(0,0,0,0.25)" />'
                    + '</div></div>'

					// video
					+ '<div class="fields" style="display:none;">'
					+ '<div class="sc-label"><?php echo __('Background Video URL MP4', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input class="upload_video_mp4"'
					+ ' type="text" name="background-video-mp4" value="" />'
                    + '</div></div>'

                    + '<div class="fields" style="display:none;">'
					+ '<div class="sc-label"><?php echo __('Choose MP4 Video', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input class="upload_video_button_mp4" class="button"'
					+ ' type="button" value="<?php echo __('Choose MP4 Video', 'shshortc'); ?>" />'
                    + '</div></div>'

					+ '<div class="fields" style="display:none;">'
					+ '<div class="sc-label"><?php echo __('Background Video URL WEBM', 'shshortc'); ?></div>'
					+ '<div class="sc-option"><input class="upload_video_webm"'
					+ ' type="text" name="background-video" value="" />'
                    + '</div></div>'

                    + '<div class="fields" style="display:none;">'
					+ '<div class="sc-label"><?php echo __('Choose WEBM Video', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input class="upload_video_button_webm" class="button"'
					+ ' type="button" value="<?php echo __('Choose WEBM Video', 'shshortc'); ?>" />'
                    + '</div></div>'

					// font color
					+ '<div class="fields"><div class="sc-label"><?php echo __('Text Color:', 'shshortc'); ?></div>'
                	+ '<div class="sc-option"><input type="text" class="spectrumcolor font-color" value="#fff" />'
					+ '</div></div>'

					// Enable section shadow (only for solid and image currently)
					+ '<div class="fields"><div class="sc-label">'
					+ '<?php echo __('Enable section bottom shadow', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="bottomshadow">'
                    + '<option value="disable"><?php echo __('Disable', 'shshortc');?></option>'
                    + '<option value="enable"><?php echo __('Enable', 'shshortc');?></option>'
                    + '</select></div></div>'

                    + '<div class="fields"><div class="sc-label"></div>'
                    + '<div class="sh-message"><?php echo __('Choose solid background, Parallax, Fixed background or Video. If video is selected, the background image will be the fallback for devices that do not play video.  Use mp4 for video and add optional webm format to extend browser support.', 'shshortc');?></div>';

		} else if (sel == 'people') { // People
			var ind = '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('The PostID', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input class="people-postid" type="text" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label"></div>'
                    + '<div class="sh-message"><?php echo __('The Custom Post ID for the Person (Can be found in the page edit url when creating People and looks like <b>post=1524</b>.  You just need the number.', 'shshortc');?></div>';

		} else if (sel == 'sitemap') { // Sitemaps
			var ind = '<div class="fields"><div class="sc-label">'
				    + '<?php echo __('Show Pages', 'shshortc'); ?></div>'
				    + '<div class="sc-option"><select class="sitemap-show-pages">'
					+ '<option value="true"><?php echo __('True', 'shshortc');?></option>'
					+ '<option value="false"><?php echo __('False', 'shshortc');?></option>'
				    + '</select></div></div>'

					+ '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Show Posts', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="sitemap-show-posts">'
                    + '<option value="true"><?php echo __('True', 'shshortc');?></option>'
                    + '<option value="false"><?php echo __('False', 'shshortc');?></option>'
                    + '</select></div></div>'

					+ '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Show Custom Posts', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="sitemap-show-custom">'
                    + '<option value="true"><?php echo __('True', 'shshortc');?></option>'
                    + '<option value="false"><?php echo __('False', 'shshortc');?></option>'
                    + '</select></div></div>'
	
					+ '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Show Select Choices', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="sitemap-show-select">'
                    + '<option value="true"><?php echo __('True', 'shshortc');?></option>'
                    + '<option value="false"><?php echo __('False', 'shshortc');?></option>'
                    + '</select></div></div>'
		
					+ '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Page - default view', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="sitemap-page-view">'
                    + '<option value="post_title"><?php echo __('Title', 'shshortc');?></option>'
                    + '<option value="post_date"><?php echo __('Date', 'shshortc');?></option>'
					+ '<option value="post_author"><?php echo __('Author', 'shshortc');?></option>'
                    + '</select></div></div>'

					+ '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Posts - default view', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="sitemap-post-view">'
                    + '<option value="title"><?php echo __('Title', 'shshortc');?></option>'
                    + '<option value="date"><?php echo __('Date', 'shshortc');?></option>'
                    + '<option value="author"><?php echo __('Author', 'shshortc');?></option>'
                    + '<option value="category"><?php echo __('Category', 'shshortc');?></option>'
                    + '</select></div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Exclude ID list (e.g 1,5,7)', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="sitemap-exclude" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label"></div>'
                    + '<div class="sh-message"><?php echo __('Select what to show, default sorting options, and exclude list if wanted.  Note: Excluded items are by id seperated by commas ( 5,3,24,15).', 'shshortc');?></div>';


		} else if (sel == 'soundcloud') { // Sound Cloud
			var ind = '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('SoundCloud url', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="soundcloud-url" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Auto Play clip', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="soundcloud-autoplay">'
                    + '<option value="false"><?php echo __('Disable', 'shshortc');?></option>'
                    + '<option value="true"><?php echo __('Enable', 'shshortc');?></option>'
                    + '</select></div></div>'
	
					+ '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Show Comments', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="soundcloud-comments">'
                    + '<option value="false"><?php echo __('Disable', 'shshortc');?></option>'
                    + '<option value="true"><?php echo __('Enable', 'shshortc');?></option>'
                    + '</select></div></div>'			

					+ '<div class="fields"><div class="sc-label"><?php echo __('Set Color', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor soundcloud-color" value="#555" />'
                    + '</div></div>'

				    + '<div class="sh-message"><?php echo __('Color changes the play button and sound bars, autoplay will cause the clip to start playing when the page loads.', 'shshortc');?></div>';

		} else if (sel == 'testimonial') { // Testimonial Individual
			var ind = '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Name', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="test-name" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Title', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="test-title" />'
                    + '</div></div>'

					+ '<div class="fields">'
                	+ '<div class="sc-label"><?php echo __('Image URL', 'shshortc'); ?></div>'
                	+ '<div class="sc-option"><input class="upload_image" type="text" name="background-image" value="" />'
                	+ '</div></div>'
                	+ '<div class="fields">'
                	+ '<div class="sc-label"><?php echo __('Choose Image', 'shshortc'); ?></div>'
                	+ '<div class="sc-option"><input class="upload_image_button" class="button"'
                	+ ' type="button" value="<?php echo __('Choose Image', 'shshortc'); ?>" />'
                	+ '<br /><br /><div class="sc-option"><div class="image-selected"></div></div></div>'
                	+ '</div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('The Testimonial', 'shshortc'); ?></div>'
                	+ '<div class="sc-option"><textarea class="test-content" /></textarea></div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Font Color', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor test-fontcolor" value="#828282" />'
                    + '</div></div>'
					
					+ '<div class="fields"><div class="sc-label"><?php echo __('Background Color', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor test-bgcolor" value="#f6f6f6" />'
                    + '</div></div>'
	
					+ '<div class="fields"><div class="sc-label"><?php echo __('Border Color', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor test-bordercolor" value="#c8c8c8" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label"></div>'
                    + '<div class="sh-message"><?php echo __('Image and title are optional', 'shshortc');?></div>';

		} else if (sel == 'testimonialc') { // Testimonial Caraousel
			var ind = '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Pause Per Slide (e.g. 5000)', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="testc-pause" value="5000" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Slide Transition', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="testc-transition">'
                    + '<option value="fade"><?php echo __('Fade To Next', 'shshortc');?></option>'
                    + '<option value="horizontal"><?php echo __('Horizontal Slide', 'shshortc');?></option>'
				    + '<option value="vertical"><?php echo __('Vertical Slide', 'shshortc');?></option>'
                    + '</select></div></div>'    

					+ '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Slideshow Adapt Per Slide', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="testc-adapt">'
                    + '<option value="true"><?php echo __('True - Slide show changes height', 'shshortc');?></option>'
                    + '<option value="false"><?php echo __('False - Slide show same height', 'shshortc');?></option>'
                    + '</select></div></div>'

					+ '<div class="fields"><div class="sc-label"></div>'
                    + '<div class="sh-message"><?php echo __('Slideshow Adapt means the slideshow will grow and shrink with each slide.', 'shshortc');?></div>';


		} else if (sel == 'video') { // Video Embedded
			var ind = '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Choose the type of video', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="video-type">'
                    + '<option value="vimeo"><?php echo __('Vimeo', 'shshortc');?></option>'
                    + '<option value="youtube"><?php echo __('Youtube', 'shshortc');?></option>'
					+ '<option value="selfhosted"><?php echo __('Self Hosted', 'shshortc');?></option>'
                    + '</select></div></div>'
					
					+ '<div class="fields"><div class="sc-label"><?php echo __('Video ID:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="video-id" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Poster Image URL:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="video-poster" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label"></div>'
                    + '<div class="sh-message"><?php echo __('Select Vimeo or Youtube and add the id of the video only.  Self Hosted - Add the full url and a poster image if wanted.', 'shshortc');?></div>';

		} else if (sel == 'circlechart') { // Circle Charts
			var results = window.parent.retrieveAllIcons(processResults8);
			// results handled in processResults

		} else if (sel == 'milestone') { // Milestone counters
			var results = window.parent.retrieveAllIcons(processResults7);
            // results handled in processResults
					
        } else if (sel == 'modal') { // Modal popups
			var ind = '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Open Modal On Page Load', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="modal-openready">'
                    + '<option value="disable"><?php echo __('Disable', 'shshortc');?></option>'
                    + '<option value="enable"><?php echo __('Enable', 'shshortc');?></option>'
                    + '</select></div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Modal Title:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="modal-title" />'
                    + '</div></div>'
					
					+ '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Modal Size', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="modal-modalsize">'
                    + '<option value="small"><?php echo __('Small', 'shshortc');?></option>'
                    + '<option value="large"><?php echo __('Large', 'shshortc');?></option>'
                    + '</select></div></div>'
				
					+ '<div class="fields"><div class="sc-label">'
                    + '<?php echo __('Enable Footer', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><select class="modal-footer">'
                    + '<option value="enable"><?php echo __('Enable', 'shshortc');?></option>'
                    + '<option value="disable"><?php echo __('Disable', 'shshortc');?></option>'
                    + '</select></div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Modal Background Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor modal-modalbg" value="#ffffff" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Modal Border Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor modal-modalborder" value="rgba(0,0,0,0.2)" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Modal Font Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor modal-modalfont" value="#555555" />'
                    + '</div></div>'

					// Button settings only for on page modals (not autoload modals)
					+ '<div class="fields"><div class="sc-label"><?php echo __('Button Text:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="modal-buttontext" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Button Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor modal-buttoncolor" value="#ffffff" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Button Border Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor modal-buttonborder" value="#555555" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Button Text Color:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="spectrumcolor modal-buttontextcolor" value="#555555" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Button Border Width:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="modal-buttonborderwidth small-text" value="2px" />'
                    + '</div></div>'

					+ '<div class="fields"><div class="sc-label"><?php echo __('Button Border Radius:', 'shshortc'); ?></div>'
                    + '<div class="sc-option"><input type="text" class="modal-buttonborderradius small-text" value="4px" />'
                    + '</div></div>';

        } else {
            var ind = '';
        }
        $(document).find('.sc-individual').html(ind);

		if (sel=='countdown'
			|| sel=='contact'
			|| sel=='divider'
			|| sel=='dropcap'
			|| sel=='highlight'
			|| sel=='headers' 
			|| sel=='imagebg'
			|| sel=='colorbg'
			|| sel=='modal'
			|| sel=='parallax'
			|| sel=='popover'
			|| sel=='imageframe'
			|| sel=='progressbar'
			|| sel=='testimonial'
			|| sel=='table'
		) {
			// initialize spectrum color picker  (some are initialized in processResults)
			var colorInput = $(document).find(".spectrumcolor");
    		$(colorInput).spectrum({
				showInput: true,
				showAlpha: true,
				//flat: true,
				//showPalette: true,
				preferredFormat: "rgb",
   			});
		}

		if (sel=='soundcloud'
			|| sel=='gmap'
		) { // just hex choices
			// initialize spectrum color picker  (some are initialized in processResults)
            var colorInput = $(document).find(".spectrumcolor");
            $(colorInput).spectrum({
                showInput: true,
                showAlpha: true,
                preferredFormat: "hex",
            });
        }
    });

    /* Insert shortcode funtion */
    $(document).on('click', '.sc-save', function() {
        var sel = $(document).find('.sc-select').val();

		if (sel == 'accordion') { // Accordion
			var type = $(document).find('.accord-type').val();
			var tabs = parseInt($(document).find('.accord-number').val());

			var shortcode = '[sh_accordion mode="' + type + '"]'
				+ '[sh_accord_item title="Tab 1" open="true"]<?php echo __('Enter Tab content here', 'shshortc');?>'
				+ '[/sh_accord_item]';

			for(i=2; i <= tabs; i++) {
				shortcode += '[sh_accord_item title="Tab ' + i 
						  + '"]<?php echo __('Enter Tab content here', 'shshortc');?>[/sh_accord_item]';
			}
			shortcode += '[/sh_accordion]';

		} else if (sel == 'alertmsg') { // Alert messages
			var text = $(document).find('.alert-text').val();
			var close = $(document).find('.alert-close').val();
			var type = $(document).find('.alert-type').val();
			var enableFont = $(document).find('input[name=enablefont]:checked').val();
			var iconset = $(document).find('input[name=iconset]:checked').val();
			if (iconset == 'fontawesome') {
				var iconchosen= $(document).find('.font-awesome-select span.selected').text();
				var icon = 'iconfa'; 
			} else if (iconset == 'linear') {
				var iconchosen= $(document).find('.linear-select span.selected').text();
				var icon = 'iconlinear';
			} else if (iconset == 'ion') {
				var iconchosen= $(document).find('.ion-select span.selected').text();
				var icon = 'iconion';
			}
			var fontsize = $(document).find('.alert-fontsize').val();
			var background = $(document).find('.alert-background').val();
			var fontcolor = $(document).find('.alert-fontcolor').val();
			var bordercolor = $(document).find('.alert-bordercolor').val();
			var custom = '';

			if (type == 'custom') { // add custom settings
				var custom = ' background="' + background + '" fontcolor="' + fontcolor + '" bordercolor="' + bordercolor + '"';
			}

			var shortcode = '[sh_alert type="' + type + '" close="' + close 
						  + '" enablefont="' + enableFont + '" iconset="' + iconset + '" ' + icon + '="' + iconchosen
						  + '" fontsize="' + fontsize + '"' 
						  + custom + ']' + text + '[/sh_alert]';
		
		} else if (sel == 'anchor') {
			var id = $(document).find('.anchor-id').val();
			var text = $(document).find('.anchor-text').val();
			var shortcode = '[sh_anchor id="' + id + '"]' + text + '[/sh_anchor]';

		} else if (sel == 'animate') {
			var anim = $(document).find('.anim-type').val();
			var delay = $(document).find('.anim-delay').val();
			var shortcode = '[sh_animate anim="' + anim + '" delay="' 
						  + delay + '"]<?php echo __('Add Your Content', 'shshortc');?>[/sh_animate]';

		} else if (sel == 'button') {                // Button
            var text = $(document).find('.button-text').val();
            var link = $(document).find('.button-link').val();
            var target = $(document).find('.button-target').val();
			var enableIcon = $(document).find('input[name=icon]:checked').val();
	
            var iconset = $(document).find('input[name=iconset]:checked').val();
            if (iconset == 'fontawesome') {
                var iconchosen= $(document).find('.font-awesome-select span.selected').text();
                var icon = 'iconfa'; 
            } else if (iconset == 'linear') {
                var iconchosen= $(document).find('.linear-select span.selected').text();
                var icon = 'iconlinear';
            } else if (iconset == 'ion') {
                var iconchosen= $(document).find('.ion-select span.selected').text();
                var icon = 'iconion';
            }

			var iconBG = $(document).find('.icon-background').val();
			//var icon= $(document).find('span.selected').text();
			var buttonSize = $(document).find('.button-size').val();
			var buttonShape = $(document).find('.button-shape').val();
			var buttonStyle = $(document).find('.button-style').val();
			var buttonColor = $(document).find('.button-color').val();
			var enableHover = $(document).find('.enable-hover').val();
			var borderColor = $(document).find('.border-color').val();
			var borderSize = $(document).find('.border-size').val();
			var fontColor = $(document).find('.font-color').val();

            var shortcode = '[sh_btn link="' + link + '" target="' + target + '" shape="' + buttonShape + '" style="' + buttonStyle
						  + '" size="' + buttonSize + '" color="' + buttonColor + '" bordercolor="' + borderColor 
						  + '" bordersize="' + borderSize + '" fontcolor="' + fontColor 
						  + '" enablehover="' + enableHover + '" enableicon="' + enableIcon + '" iconbg="' + iconBG
						  + '" iconset="' + iconset + '" ' + icon + '="' + iconchosen + '"]' + text + '[/sh_btn]';

		} else if (sel == 'bloggrid') { // Latest Posts Blog Grid
			var perrow = $(document).find('.bloggrid-perrow').val();
			var show = $(document).find('.bloggrid-show').val();
			var categories = $(document).find('.bloggrid-categories').val();
			var shortcode = '[sh_bloggrid perrow="' + perrow + '" show="' + show + '" categories="' + categories + '"]';

		} else if (sel == 'portfoliogrid') { // Portfolio grid
			var perrow = $(document).find('.portfoliogrid-perrow').val();
			var show = $(document).find('.portfoliogrid-show').val();
			var categories = $(document).find('.portfoliogrid-categories').val();
			var shortcode = '[sh_portfoliogrid perrow="' + perrow + '" show="' + show + '" categories="' + categories + '"]';

		} else if (sel == 'callout') { // Callouts
			var calloutType = $(document).find('.callout-type').val();
			var calloutTitle = $(document).find('.callout-title').val();
			var calloutText = $(document).find('.callout-text').val();
			var flipText = $(document).find('.callout-flip-text').val();
			var flipColor = $(document).find('.flip-font-color').val();
			var flipbgColor = $(document).find('.flip-bg-color').val();
			var flipBorderColor = $(document).find('.flip-border-color').val();

			var borderColor = $(document).find('.border-color').val();
			var borderSize = $(document).find('.border-size').val();
			var borderRadius = $(document).find('.border-radius').val();
	
			var backgroundColor = $(document).find('.background-color').val();
			var fontColor = $(document).find('.font-color').val();

			var buttonEnable = $(document).find('.callout-button-enable:checked').val();
			var buttonText = $(document).find('.callout-button-text').val();
			var buttonLink = $(document).find('.callout-button-link').val();
			var buttonTarget = $(document).find('.callout-button-target').val();
			var buttonFontColor = $(document).find('.button-font-color').val();
			var buttonbgColor = $(document).find('.button-bg-color').val();
	
			var btnbordercolor = $(document).find('.btn-border-color').val();
			var btnbordersize = $(document).find('.btn-border-size').val();
			var btnborderradius = $(document).find('.btn-border-radius').val();

			var image = $(document).find('.upload_image').val();
			var imageHeight = $(document).find('.callout-image-h').val();
			var imageWidth = $(document).find('.callout-image-w').val();

			var iconEnable = $(document).find('.callout-icon-enable:checked').val();
			var iconSpin = $(document).find('.callout-icon-spin:checked').val();

			var iconset = $(document).find('input[name=iconset]:checked').val();
            if (iconset == 'fontawesome') {
                var iconchosen= $(document).find('.font-awesome-select span.selected').text();
                var icon = 'iconfa'; 
            } else if (iconset == 'linear') {
                var iconchosen= $(document).find('.linear-select span.selected').text();
                var icon = 'iconlinear';
            } else if (iconset == 'ion') {
                var iconchosen= $(document).find('.ion-select span.selected').text();
                var icon = 'iconion';
            }

			var iconFontColor = $(document).find('.icon-font-color').val();
			var iconbgColor = $(document).find('.icon-bg-color').val();

			var shortcode = '[sh_callout callouttype="' + calloutType + '"  title="' + calloutTitle 
						  + '" bordercolor="' + borderColor + '" bordersize="' + borderSize + '" borderradius="' + borderRadius 
						  + '" backgroundcolor="' + backgroundColor + '" fontcolor="' + fontColor
						  + '" buttonenable="' + buttonEnable
						  + '" buttonbgcolor="' + buttonbgColor + '" buttonfontcolor="' + buttonFontColor 
						  + '" btnbordercolor="' + btnbordercolor + '" btnborderwidth="' + btnbordersize
						  + '" btnborderradius="' + btnborderradius 
						  + '" buttontext="' + buttonText + '" buttonlink = "' + buttonLink 
						  + '" buttonTarget="' + buttonTarget + '" fliptext="' + flipText 
						  + '" flipcolor="' + flipColor + '" flipbgcolor="' + flipbgColor 
						  + '" flipbordercolor="' + flipBorderColor
						  + '" iconenable="' + iconEnable 
						  + '" iconfontcolor="' + iconFontColor + '" iconbgcolor="' + iconbgColor 
						  + '" iconset="' + iconset + '" ' + icon + '="' + iconchosen
						  + '" iconspin="' + iconSpin
						  + '" image="' + image + '" imageheight="' + imageHeight + '" imagewidth="' + imageWidth + '"]' 
						  + calloutText + '[/sh_callout]';

		} else if (sel == 'contentbox') { // Content Box
			var style = $(document).find('.cb-style').val();
			var background = $(document).find('.cb-background').val();
			var color = $(document).find('.cb-color').val();
			var readmorelink = $(document).find('.cb-readmorelink').val();
			var readmoretext = $(document).find('.cb-readmoretext').val();
			var target = $(document).find('.cb-target').val();
			var image = $(document).find('.upload_image').val();
			var iconset = $(document).find('input[name=iconset]:checked').val();
            if (iconset == 'fontawesome') {
                var iconchosen= $(document).find('.font-awesome-select span.selected').text();
                var icon = 'iconfa'; 
            } else if (iconset == 'linear') {
                var iconchosen= $(document).find('.linear-select span.selected').text();
                var icon = 'iconlinear';
            } else if (iconset == 'ion') {
                var iconchosen= $(document).find('.ion-select span.selected').text();
                var icon = 'iconion';
            }
			var title = $(document).find('.cb-title').val();
			var content = $(document).find('.cb-content').val();
			var choice = $(document).find('.cb-choice').val();
		
			var iconImage= '';
			if (choice == 'image') {
				iconImage= ' image="' + image + '"';
			} else {
				iconImage= ' iconset="' + iconset + '" ' + icon + '="' + iconchosen + '"';
			}
			var shortcode = '[sh_content style="' + style + '" color="' + color + '" readmorelink="' + readmorelink 
				+ '" readmoretext="' + readmoretext + '" target="' + target + '" title="' + title + '"' 
				+ iconImage + ']' + content + '[/sh_content]';

        } else if (sel == 'quote') {         // Quote
            var text = $(document).find('.quote-text').val();
            var shortcode = '[sh_quote]' + text + '[/sh_quote]';

        } else if (sel == 'quote2') {         // Quote
            var text = $(document).find('.quote-text').val();
            var shortcode = '[sh_quote2]' + text + '[/sh_quote2]';

        } else if (sel == 'pullquote') {
            var text = $(document).find('.quote-text').val();
            var side = $(document).find('.quote-side').val();
            var source = $(document).find('.quote-source').val();
            var shortcode = '[sh_pullquote side="' + side + '" source="' + source + '"]' + text + '[/sh_pullquote]';

        } else if (sel == 'dropcap') {       // Dropcap
            var letter = $(document).find(".dropcap-letter").val();
            var style = $(document).find(".dropcap-style").val();
			var color = $(document).find('.dropcap-color').val();
			var fontcolor = $(document).find('.dropcap-fontcolor').val();
			var setbg = $(document).find('.dropcap-setbg').val();
			var background = $(document).find('.dropcap-background').val();
			var dropshadow = $(document).find('.dropcap-dropshadow').val();

			var targetStyle = '';
			if (style == 'theme') {
				targetStyle = ' color="' + color + '"';
			} else if (style == 'custom') {
				targetStyle = ' fontcolor="' + fontcolor + '"';
				if (setbg == 'true') { 
					targetStyle += ' setbg="' + setbg + '" background="' + background + '"';
				}
			}
					
            var shortcode = '[sh_dropcap style="' + style + '" dropshadow="' 
				+ dropshadow + '"' + targetStyle + ']' + letter + '[/sh_dropcap]';

        } else if (sel == 'highlight') { // Highlight text
            var text = $(document).find(".highlight").val();
			var choice = $(document).find(".highlight-choice").val();
			var color = $(document).find(".highlight-color").val();
			var fontcolor = $(document).find('.highlight-fontcolor').val();
			var background = $(document).find('.highlight-background').val();

			var customColors = '';
			var choices = ' choice="' + choice + '"';
			if (color=="custom") {
				customColors = ' background="' + background + '" fontcolor="' + fontcolor + '"';
				choices = '';
			}
            var shortcode = '[sh_highlight ' + choices + ' color="' + color + '"' + customColors + ']' + text + '[/sh_highlight]';

		} else if (sel == 'imageframe') {
			var style = $(document).find(".imageframe-style").val();
			var bordersize = $(document).find(".imageframe-bordersize").val();
			var bordercolor = $(document).find(".imageframe-bordercolor").val();
			var padding = $(document).find(".imageframe-padding").val();
			var source = $(document).find(".upload_image").val();
			var action = $(document).find(".imageframe-action").val();
			var hover = $(document).find(".imageframe-hover").val();
			var title = $(document).find(".imageframe-title").val();
			var url = $(document).find(".imageframe-url").val();

			var shortcode = '[sh_imageframe style="' + style + '" source="' + source + '" bordersize="' + bordersize 
						  + '" bordercolor="' + bordercolor + '" padding="' + padding + '" action="' + action + '"';
			// check if this is a url or fancybox
			if (action == 'url') {
				shortcode += ' hover="' + hover + '" title="' + title + '" url="' + url + '"]';
			} else if (action == 'fancybox') {
				shortcode += ' hover="' + hover + '" title="' + title + '"]';
			} else {
				shortcode += ']';
			}

		} else if (sel == 'progressbar') { // Progress Bar
			var style = $(document).find('.progress-style').val();
			var barcolor = $(document).find('.progress-barcolor').val();
			var textcolor = $(document).find('.progress-textcolor').val();
			var background = $(document).find('.progress-background').val();
			var padding = $(document).find('.progress-padding').val();
			var text = $(document).find('.progress-text').val();
			var percent = $(document).find('.progress-percent').val();
			var symbol = $(document).find('.progress-symbol').val();

			var shortcode = '[sh_progress style="' + style + '" barcolor="' + barcolor + '" textcolor="' + textcolor 
				+ '" background="' + background + '" percent="' + percent + '" symbol="' + symbol + '" text="' + text + '"]';

        } else if (sel == 'fontawesome') { // Font Awesome
			var link = $(document).find('input[name=enablelink]:checked').val();
			var iconset = $(document).find('input[name=iconset]:checked').val();
            if (iconset == 'fontawesome') {
                var iconchosen= $(document).find('.font-awesome-select span.selected').text();
                var icon = 'iconfa'; 
            } else if (iconset == 'linear') {
                var iconchosen= $(document).find('.linear-select span.selected').text();
                var icon = 'iconlinear';
            } else if (iconset == 'ion') {
                var iconchosen= $(document).find('.ion-select span.selected').text();
                var icon = 'iconion';
            }
            var url= $(document).find('.font-awesome-url').val();
            var target= $(document).find('.font-awesome-target').val();
			var size = $(document).find('.font-awesome-size').val();
			var fontColor = $(document).find('.icon-font-color').val();
			var enableCircle = $(document).find('.enable-circle:checked').val();
			var spin = $(document).find('.enable-spin:checked').val();
			var circleColor = $(document).find('.icon-circle-color').val();
			var borderColor = $(document).find('.icon-border-color').val();
            var shortcode = '[sh_fa link="' + link + '" url="' + url + '" size="' + size 
						  + '" fontcolor="' + fontColor + '" enablecircle="' + enableCircle
						  + '" circlecolor="' + circleColor + '" bordercolor="' + borderColor
						  + '" target="' + target + '" spin="' + spin 
						  + '" iconset="' + iconset + '" ' + icon + '="' + iconchosen + '"][/sh_fa]';

		} else if (sel == 'socialicon') { // Social Icons Font Awesome
		 	var iconset = $(document).find('input[name=iconset]:checked').val();
            if (iconset == 'fontawesome') {
                var iconchosen= $(document).find('.font-awesome-select span.selected').text();
                var icon = 'iconfa'; 
            } else if (iconset == 'linear') {
                var iconchosen= $(document).find('.linear-select span.selected').text();
                var icon = 'iconlinear';
            } else if (iconset == 'ion') {
                var iconchosen= $(document).find('.ion-select span.selected').text();
                var icon = 'iconion';
            }
			var target = $(document).find('.si-target').val();
			var link = $(document).find('.si-link').val();
			var size = $(document).find('.si-size').val();
			var title = $(document).find('.si-title').val();
			var placement = $(document).find('.si-placement').val();
			var fontcolor = $(document).find('.si-fontcolor').val();
			var framed = $(document).find('.si-framed').val();
			var bgcolor = $(document).find('.si-bgcolor').val();
			var radius = $(document).find('.si-radius').val();

			var framedVals = '';
			if (framed == 'true') {
				framedVals = ' bgcolor="' + bgcolor + '" radius="' + radius + '"';
			}

			var shortcode = '[sh_social iconset="' + iconset + '" ' + icon + '="' + iconchosen + '" link="' + link 
				+ '" target="' + target + '" size="' + size 
				+ '" title="' + title + '" placement="' + placement + '" framed="' + framed + '" fontcolor="' + fontcolor 
				+ '"' + framedVals + ']';

        } else if (sel == 'center') { // Center items
            var shortcode = '[sh_center]<p>&nbsp;</p><p>&nbsp;</p>  [/sh_center]';

		} else if (sel == 'checklist') { // Checklist
			var iconset = $(document).find('input[name=iconset]:checked').val();
            if (iconset == 'fontawesome') {
                var iconchosen= $(document).find('.font-awesome-select span.selected').text();
                var icon = 'iconfa'; 
            } else if (iconset == 'linear') {
                var iconchosen= $(document).find('.linear-select span.selected').text();
                var icon = 'iconlinear';
            } else if (iconset == 'ion') {
                var iconchosen= $(document).find('.ion-select span.selected').text();
                var icon = 'iconion';
            }
			var type = $(document).find('.bullet-type').val();
			var background = $(document).find('.bullet-background').val();
			var customcolor = $(document).find('.bullet-customcolor:checked').val();
			var backgroundcolor = $(document).find('.bullet-backgroundcolor').val();
			var fontcolor = $(document).find('.bullet-fontcolor').val();
			var number = $(document).find('.bullet-count').val();			
			var content = '';

			for(var i=0; i < number; i++) {
				content += "<br />[sh_checklist_item]<?php echo __('Checklist Item, enter your text.', 'shshortc');?>"
						+ "[/sh_checklist_item]";
			}

			var customize = '';
			if (customcolor == 'true') { // inject the custom color settings
				customize = ' customcolor="' + customcolor + '" backgroundcolor="' + backgroundcolor 
					+ '" fontcolor="' + fontcolor + '"';
			}

			var shortcode = '[sh_checklist iconset="' + iconset + '" ' + icon + '="' + iconchosen + '" type="' 
						+ type + '" background="' + background + '"' + customize + ']' + content + "<br />" + '[/sh_checklist]';
			
		} else if (sel == 'contact') { // Contact Form
			var nametext = $(document).find('.contact-nametext').val();
			var emailtext = $(document).find('.contact-emailtext').val();
			var messagetext = $(document).find('.contact-messagetext').val();
			var inputtext = $(document).find('.contact-inputtext').val();
			var inputbg = $(document).find('.contact-inputbg').val();
			var inputborder = $(document).find('.contact-inputborder').val();

			var buttontext = $(document).find('.contact-buttontext').val();
			var buttonbg = $(document).find('.contact-buttonbg').val();
			var buttoncolor = $(document).find('.contact-buttoncolor').val();
			var buttonborder = $(document).find('.contact-buttonborder').val();
			var buttonborderw = $(document).find('.contact-buttonborderw').val();
			var borderradius = $(document).find('.contact-borderradius').val();
			var newemail = $(document).find('.contact-newemail').val();
			if (newemail != '') {
				var email = 'newemail="' + newemail + '"';
			} else {
				var email = '';
			}

			var shortcode = '[sh_form nametext="' + nametext + '" emailtext="' + emailtext + '" messagetext="' 
				+ messagetext + '" inputtext="' + inputtext + '" inputbg="' + inputbg + '" inputborder="' + inputborder 
				+ '" buttontext="' + buttontext + '" buttonbg="' + buttonbg + '" buttoncolor="' + buttoncolor
				+ '" buttonborder="' + buttonborder + '" buttonborderw="' + buttonborderw + '" borderradius="' + borderradius
				+ '" ' + email + ']';

        } else if (sel == 'headers') { // Headers
            var size = $(document).find('.header-size').val();
			var type = $(document).find('.header-type').val();
            var header = $(document).find('.header-text').val();
            var summary = $(document).find('.header-summary').val();
			var color = $(document).find('.header-color').val();
			var colorChange = $(document).find('.header-color-change').val();
			var barWidth = $(document).find('.header-barwidth').val();
			var barHeight = $(document).find('.header-barheight').val();
			var barColor = $(document).find('.header-barcolor').val();

			if (colorChange == 'disable') { // do not insert color
				var colors = ' colorchange="' + colorChange + '"';
			} else {
				var colors = ' colorchange="' + colorChange + '" color="' + color + '"';
			}
			
			if (type == 'boxed') {
				var shortcode = '[sh_header size="' + size + '" type="' + type + '" header="' + header + '"' + colors + ']'
					+ '[/sh_header]';
			} else {
            	var shortcode = '[sh_header size="' + size + '" type="' + type + '" header="' + header + '"' + colors 
					+ ' barheight="' + barHeight + '" barwidth="' + barWidth + '" barcolor="' + barColor + '"]' 
				+ summary + '[/sh_header]';
			}

        } else if (sel == 'headersdouble') { // Headers double bar
            var size = $(document).find('.header-size').val();
            var text = $(document).find('.header-text').val();
            var shortcode = '[sh_headerdouble size="' + size + '"]' + text + '[/sh_headerdouble]';
	
		} else if (sel == 'countdown') { // Countdown
			var year = $(document).find('.count-year').val();
			var month = $(document).find('.count-month').val();
			var day = $(document).find('.count-day').val();
			var hour = $(document).find('.count-hour').val();
			var minute = $(document).find('.count-minute').val();
			var seconds = $(document).find('.count-seconds').val();
			var style = $(document).find('.count-style').val();
			var color = $(document).find('.count-color').val();
			// format the date string for the countdown function
			var shortcode = '[sh_countdown color="' + color + '" style="' + style 
						  + '" date="' + day + ' ' + month + ' ' + year +  ' ' + hour + ':' + minute + ':' + seconds + '"]';

		} else if (sel == 'gdoc') { // Google Document
			var link = $(document).find('.gdoc-link').val();
			var height = $(document).find('.gdoc-height').val();
			var seamless = $(document).find('.gdoc-seamless').val();
			var shortcode = '[sh_gdoc height="' + height + '" seamless="' + seamless + '" link="' + link + '"]';

		} else if (sel == 'circlechart') { // Circle Chart
			var text = $(document).find('.circle-text').val();
			var info = $(document).find('.circle-info').val();
			var percent = $(document).find('.circle-percent').val();
			var dimension = $(document).find('.circle-dimension').val();
			var fontsize = $(document).find('.circle-fontsize').val();
			var width = $(document).find('.circle-width').val();
			var type = $(document).find('.circle-type').val();
			var fgcolor = $(document).find('.circle-fgcolor').val();
			var bgcolor = $(document).find('.circle-bgcolor').val();
			var fill = $(document).find('.circle-fill').val();
			var circleEnable = $(document).find('.circle-icon-enable:checked').val();
			var iconcolor = $(document).find('.circle-iconcolor').val();
			// var icon = $(document).find('span.selected').text();
			
			var iconset = $(document).find('input[name=iconset]:checked').val();
            if (iconset == 'fontawesome') {
                var iconchosen= $(document).find('.font-awesome-select span.selected').text();
                var icon = 'iconfa'; 
            } else if (iconset == 'linear') {
                var iconchosen= $(document).find('.linear-select span.selected').text();
                var icon = 'iconlinear';
            } else if (iconset == 'ion') {
                var iconchosen= $(document).find('.ion-select span.selected').text();
                var icon = 'iconion';
            }

			var iconSettings = '';
			if (circleEnable == 'enable') {
				iconSettings = 'iconset="' + iconset + '" ' + icon + '="' + iconchosen + '" iconcolor="' + iconcolor + '"';
			}	

			var shortcode = '[sh_circle text="' + text + '" info="' + info + '" percent="' + percent + '"'
						  + ' dimension="' + dimension + '" fontsize="' + fontsize + '" width="' + width + '"'
						  + ' type="' + type + '" fgcolor="' + fgcolor + '" bgcolor="' + bgcolor + '" fill="' + fill + '"'
						  + ' circleicon="' + circleEnable + '" ' + iconSettings + ']';

		} else if (sel == 'milestone') { // Milestone
			var start = $(document).find('.mile-start').val();
			var stop = $(document).find('.mile-stop').val();
			var iconset = $(document).find('input[name=iconset]:checked').val();
            if (iconset == 'fontawesome') {
                var iconchosen= $(document).find('.font-awesome-select span.selected').text();
                var icon = 'iconfa'; 
            } else if (iconset == 'linear') {
                var iconchosen= $(document).find('.linear-select span.selected').text();
                var icon = 'iconlinear';
            } else if (iconset == 'ion') {
                var iconchosen= $(document).find('.ion-select span.selected').text();
                var icon = 'iconion';
            }
			var color = $(document).find('.mile-color').val();
			var textBefore = $(document).find('.mile-before').val();
			var textAfter = $(document).find('.mile-after').val();
			var size = $(document).find('.mile-size').val();
			var speed = $(document).find('.mile-speed').val();
			var content = $(document).find('.mile-summary').val();

			var shortcode = '[sh_milestone color="' + color + '" start="' + start + '" stop="' + stop + '" iconset="' 
						  + iconset + '" ' + icon + '="' + iconchosen + '" textbefore="' 
						  + textBefore + '" textafter="' + textAfter + '" size="'
						  + size + '" speed="' + speed + '"]' + content + '[/sh_milestone]';

		} else if (sel == 'modal') { // Modal popup
			var openready = $(document).find('.modal-openready').val();
			var title = $(document).find('.modal-title').val();
			var modalsize = $(document).find('.modal-modalsize').val();
			var footer = $(document).find('.modal-footer').val();
			var buttontext = $(document).find('.modal-buttontext').val();
			var buttoncolor = $(document).find('.modal-buttoncolor').val();
			var buttonborder = $(document).find('.modal-buttonborder').val();
			var buttonborderradius = $(document).find('.modal-buttonborderradius').val();
			var buttontextcolor = $(document).find('.modal-buttontextcolor').val();
			var buttonborderwidth = $(document).find('.modal-buttonborderwidth').val();
			var modalbg = $(document).find('.modal-modalbg').val();
			var modalborder = $(document).find('.modal-modalborder').val();
			var modalfont = $(document).find('.modal-modalfont').val();

			var buttonEntries = '';
			if (openready == 'disable') { //only need buttons for modals that are not autoloaded
				var buttonEntries = 'buttontext="' + buttontext + '" buttoncolor="' + buttoncolor 
					+ '" buttonborder="' + buttonborder + '" buttonborderradius="' + buttonborderradius + '" buttontextcolor="'
					+ buttontextcolor + '" buttonborderwidth="' + buttonborderwidth + '"';
			}

			var shortcode = '[sh_modal openready="' + openready + '" title="' + title + '" modalsize="' + modalsize 
				+ '" footer="' + footer + '" modalbg="' + modalbg + '" modalborder="' + modalborder 
				+ '" modalfont="' + modalfont + '" ' + buttonEntries 
				+ ']<?php echo __("Your Modal Content", "shshortc");?>[/sh_modal]'; 


		} else if (sel == 'columns') { // Columns
			// Standard columns and left right and center layouts (standard are numeric)
			var number = $(document).find('.column-number').val();
			var entries = '';
			if (number == 'one-third' || number == 'two-thirds' 
				|| number == 'one-quarter' || number == 'three-quarters'
			) {
				entries += '[sh_column]Enter your column content[/sh_column]<p>&nbsp;</p>'
						 + '[sh_column]Enter your column content[/sh_column]<p>&nbsp;</p>';

			} else if (number == 'middle-half') {
				entries += '[sh_column]Enter your column content[/sh_column]<p>&nbsp;</p>'
                         + '[sh_column]Enter your column content[/sh_column]<p>&nbsp;</p>'
						 + '[sh_column]Enter your column content[/sh_column]<p>&nbsp;</p>';
			} else {
				for(var i=1; i <= number; i++) {
					entries += '[sh_column]Enter your column content[/sh_column]<p>&nbsp;</p>';
				}
			}
			var shortcode = '[sh_columns number="' + number + '"]<p>&nbsp;</p>' + entries + '[/sh_columns]<p>&nbsp;</p>';

		} else if (sel == 'divider') { // Dividers
			var style = $(document).find('.divider-style').val();
			var color = $(document).find('.divider-color').val();
			var width = $(document).find('.divider-width').val();
			var spacetop = $(document).find('.divider-space-top').val();
			var spacebottom = $(document).find('.divider-space-bottom').val();
			var totop = $(document).find('.return-totop:checked').val();
			var shortcode = '[sh_divider style="' + style + '" shwidth="' + width + '" spacetop="' 
						  + spacetop + '" spacebottom="' + spacebottom + '" totop="' + totop + '" color="' + color + '"]';

		} else if (sel == 'gmap') { // Google Map
			var address = $(document).find('.gmap-address').val();
			if (address == '') {
				alert('Address cannot be blank');
				return false;
			}
			var bordered = $(document).find('.gmap-bordered:checked').val();
			var fullwidth = $(document).find('.gmap-fullwidth:checked').val();
			var height = $(document).find('.gmap-height').val();
            var width = $(document).find('.gmap-width').val();
			var zoom = $(document).find('.gmap-zoom').val();
			var zoomcontrol = $(document).find('.gmap-zoomcontrol').val();
			var pancontrol = $(document).find('.gmap-pancontrol').val();
			var maptypecontrol = $(document).find('.gmap-maptypecontrol').val();
			var scrollwheel = $(document).find('.gmap-scrollwheel').val();
			var maptype = $(document).find('.gmap-maptype').val();
			var marker = $(document).find('.gmap-marker').val();
			var changemap = $(document).find('.gmap-changemap').val();
			var mapcolor = $(document).find('.gmap-mapcolor').val();
			var saturation = $(document).find('.gmap-saturation').val();
			var lightness = $(document).find('.gmap-lightness').val();
			var infobox = $(document).find('.gmap-infobox').val();
			infobox = String(infobox).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
			var infoboxbg = $(document).find('.gmap-infoboxbg').val();
			var infoboxcolor = $(document).find('.gmap-infoboxcolor').val();

			// borders
			var theborder = (bordered=='true') ? 'bordered="true"' : '';
			// widths and full width
			var thewidth = (fullwidth == 'true') ? 'fullwidth="true"' : 'width="' + width + '"';
			// mapcolor
			var premapcolor = 'mapcolor="' + mapcolor + '" saturation="' + saturation + '" lightness="' + lightness + '"';
			var themapcolor = (changemap== 'true') ? premapcolor : '';
							

			// unique id
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			var unique='';
			for( var i=0; i < 8; i++ ) {
        		unique += possible.charAt(Math.floor(Math.random() * possible.length));
			}
			
			var shortcode = '[sh_gmap height="' + height + '" ' + thewidth + ' ' + theborder 
				+ ' unique="' + unique + '" address="' + address + '" marker="' + marker + '" zoom="' + zoom 
				+ '" zoomcontrol="' + zoomcontrol + '" pancontrol="' + pancontrol 
				+ '" maptypecontrol="' + maptypecontrol + '" scrollwheel="' + scrollwheel 
				+ '" maptype="' + maptype + '" infobox="' + infobox + '" infoboxbg="' + infoboxbg 
				+ '" infoboxcolor="' + infoboxcolor + '" ' + themapcolor + ']<p>&nbsp;</p>'	
			
				+ '[sh_gmap_point address="<?php echo __('Add Address for this marker or remove', 'shshortc');?>"'
				+ ' marker="" infobox=""]<p>&nbsp;</p>'

				+ '[sh_gmap_point address="<?php echo __('Add Address for this marker or remove', 'shshortc');?>"'
                + ' marker="" infobox=""]<p>&nbsp;</p>'

				+ '[/sh_gmap]<p>&nbsp;</p>';

		} else if (sel == 'table') { // Table
			var columns = parseInt($(document).find('.table-column-count').val());
			var rows = parseInt($(document).find('.table-row-count').val());
			var border = $(document).find('.table-border').val();

			var trbgcolor = $(document).find('.table-bgcolor').val();
			var traltbgcolor = $(document).find('.table-altbgcolor').val();
			var bordercolor = $(document).find('.table-bordercolor').val();
			var hovercolor = $(document).find('.table-hovercolor').val();
			
			var shortcode = '[sh_table columns="' + columns + '" style="' + border + '" tr_bgcolor="' 
						  + trbgcolor + '" tr_altbgcolor="' + traltbgcolor + '" bordercolor="' + bordercolor 
						  + '" hovercolor="' + hovercolor + '"]' + "<br />" + '[sh_head]';
			for(i=1; i<=columns; i++) {
				shortcode += '<?php echo __('Head', 'shshortc'); ?> ' + i;
				if (i != columns) {   // no commas on last entry
                        shortcode += ',, ';
                    }
			}
			shortcode += '[/sh_head]<br />'
			for (i=1; i <= rows; i++) {
				shortcode += '[sh_row]';
				for (var ii = 1; ii <= columns; ii++) {	
					shortcode += '<?php echo __('Data', 'shshortc'); ?> ' + ii;
					if (ii != columns) {   // no commas on last entry
						shortcode += ',, ';
					}
				}
				shortcode += '[/sh_row]<br />';
			}
			shortcode += '[/sh_table]<br />';

		} else if (sel == 'popover') { // Popover
			var placement = $(document).find('.popover-placement').val();
			var title = $(document).find('.popover-title').val();
			var text = $(document).find('.popover-text').val(); 
			var trigger = $(document).find('.popover-trigger').val();
			var colorchange = $(document).find('.popover-color:checked').val();
			var titlecolor = $(document).find('.popover-titlecolor').val();
			var titlebgcolor = $(document).find('.popover-titlebgcolor').val();
			var fontcolor = $(document).find('.popover-fontcolor').val();
			var bgcolor = $(document).find('.popover-bgcolor').val();
			var bordercolor = $(document).find('.popover-bordercolor').val();

			var colors = '';
			if (colorchange == 'enable') {
				colors = ' titlecolor="' + titlecolor + '" titlebgcolor="' + titlebgcolor + '" fontcolor="' + fontcolor + '"'
					   + ' bgcolor="' + bgcolor + '" bordercolor="' + bordercolor + '"';
			}
			var shortcode = '[sh_popover placement="' + placement + '" title="' + title + '" pcontent="' + text + '"'
						  + ' trigger="' + trigger + '" colorchange="' + colorchange + '" ' + colors + ']'
						  + '<?php echo __("Enter Your Content For the popover", "shshortc");?> [/sh_popover]'; 

		} else if (sel == 'tooltip') { // Tooltip
			var placement = $(document).find('.tooltip-placement').val();
            var title = $(document).find('.tooltip-title').val();
	
			var shortcode = '[sh_tooltip placement="' + placement + '" title="' 
				+ title + '"]<?php echo __("Enter your content for the tooltip", "shshortc");?>[/sh_tooltip]';
			

        } else if (sel == 'pricetable') {  // Price Columns
            var content = '';
            var columns = parseInt($(document).find('.price-column-count').val());
            var highlighted = parseInt($(document).find('.price-column-highlight').val());
			var style = $(document).find('.price-style').val();
            var i;
			var colors = ['#2ecc71', '#3498db', '#e74c3c', '#e67e22', '#34495e', '#16a085'];
            for(i=0;i<columns;i++) {
                var highlight = ((i+1) == highlighted) ? " highlight='true'" : '';
				
				content += "<br />" + '[sh_pcol title="<?php echo __('Column', 'shshortc');?> ' + (i+1) + '"' + highlight 
						+ ' colcolor="' + colors[i] 
						+ '" cost="29.99/mo" btntext="Order now" btnlink="http://www.example.com" btntarget="new"]'
						+ '<p><?php echo __('Column Data', 'shshortc');?></p>'
						+ '<p><?php echo __('Column Data', 'shshortc');?></p>'
						+ '<p><?php echo __('Column Data', 'shshortc');?></p>'
						+ '<p><?php echo __('Column Data', 'shshortc');?></p>'
						+ '[/sh_pcol]' + "\n";
            }
            var shortcode = '[sh_ptable columns="' + columns + '" style="' 
						  + style + '"]' + "\n" + content + "\n" + '[/sh_ptable]';

		} else if (sel == 'colorbg') {
			var fontColor = $(document).find('.colorbg-font').val();
			var backgroundColor = $(document).find('.colorbg-overlay').val();
			var arrow = $(document).find('.colorbg-arrow').val();
			
			var shortcode = '[sh_colorbg fontcolor="' + fontColor + '" backgroundcolor="' 
                          + backgroundColor + '" arrow="' + arrow + '"]'
                          + '<p>&nbsp;</p><?php echo __('Enter your section content here.', 'shshortc'); ?><p>&nbsp;</p>'
                          + '[/sh_colorbg]';

		} else if (sel == 'imagebg') {
			var fontColor = $(document).find('.imagebg-font').val();
			var overlayColor = $(document).find('.imagebg-overlay').val();
			var background = $(document).find('.upload_image').val();
			var bgrepeat = $(document).find('.imagebg-repeat').val();
			var arrow = $(document).find('.imagebg-arrow').val();

			var shortcode = '[sh_imagebg fontcolor="' + fontColor + '" overlaycolor="' 
						  + overlayColor + '" background="' + background + '" bgrepeat="' + bgrepeat + '" arrow="' + arrow + '"]'
						  + '<p>&nbsp;</p><?php echo __('Enter your section content here.', 'shshortc'); ?><p>&nbsp;</p>'
						  + '[/sh_imagebg]';

        } else if (sel == 'parallax') {
			var backgroundChoice = $(document).find('.background-choice').val();
			var bgColor = $(document).find('.bg-color').val();
			var fontColor = $(document).find('.font-color').val();
            var background = $(document).find('.upload_image').val();
			var overlaycolor = $(document).find('.overlaycolor').val();
			var videoUrlmp4 = $(document).find('.upload_video_mp4').val();
			var videoUrlwebm = $(document).find('.upload_video_webm').val();
			var bottomshadow = $(document).find('.bottomshadow').val();

			var overlay = '';
			if (backgroundChoice=='parallax' 
				|| backgroundChoice=='video'
			) {
				overlay=' overlaycolor="' + overlaycolor + '"';
			}

			var video = '';
			if (backgroundChoice=='video') {
				video = ' videourlmp4="' + videoUrlmp4 + '" videourlwebm="' + videoUrlwebm + '" ';
			}

            var shortcode = '[sh_parallax background="' + background + '" backgroundchoice="' + backgroundChoice 
						   + '" bgcolor="' + bgColor + '" fontcolor="' + fontColor + '" bottomshadow="' + bottomshadow + '"'
						   + video + overlay + ']'
                           + '<p>&nbsp;</p><?php echo __('Enter your section content here.', 'shshortc'); ?><p>&nbsp;</p>'
                           + '[/sh_parallax]';
		
		} else if (sel == 'people') {
			var postid = $(document).find('.people-postid').val();
			var shortcode = '[sh_people postid="' + postid + '"]';

		} else if (sel == 'sitemap') {
			var show_pages = $(document).find('.sitemap-show-pages').val();
			var show_posts = $(document).find('.sitemap-show-posts').val();
			var show_cpts = $(document).find('.sitemap-show-custom').val();
			var show_select = $(document).find('.sitemap-show-select').val();
			var pages_default = $(document).find('.sitemap-page-view').val();
			var posts_default = $(document).find('.sitemap-post-view').val();
			var exclude_ids = $(document).find('.sitemap-exclude').val();
			
			var shortcode = '[sh_sitemap show_pages="' + show_pages + '" show_posts="' + show_posts + '" show_cpts="' + show_cpts
				+ '" show_select="' + show_select + '" pages_default="' + pages_default + '" posts_default="' + posts_default 
				+ '" exclude_ids="' + exclude_ids + '"]';

		} else if (sel == 'soundcloud') {
			var url = $(document).find('.soundcloud-url').val();
			var autoplay = $(document).find('.soundcloud-autoplay').val();
			var comments = $(document).find('.soundcloud-comments').val();
			var color = $(document).find('.soundcloud-color').val();

			var shortcode = '[sh_soundcloud auto_play="' + autoplay + '" show_comments="' + comments + '" color="' 
					+ color + '" url="' + url + '"]';

		} else if (sel == 'testimonial') {
			var name = $(document).find('.test-name').val();
			var title = $(document).find('.test-title').val();
			var image = $(document).find('.upload_image').val();
			var content = $(document).find('.test-content').val();
			var fontcolor = $(document).find('.test-fontcolor').val();
			var bgcolor = $(document).find('.test-bgcolor').val();
			var bordercolor = $(document).find('.test-bordercolor').val();
			
			var shortcode = '[sh_testimonial name="' + name + '" title="' + title + '" image="' + image + '" fontcolor="' 
					+ fontcolor + '" bgcolor="' + bgcolor + '" bordercolor="' + bordercolor + '"]' 
					+ content + '[/sh_testimonial]';

		} else if (sel == 'testimonialc') {
			var pause = $(document).find('.testc-pause').val();
			var transition = $(document).find('.testc-transition').val();
			var adapt = $(document).find('.testc-adapt').val();
			
			var shortcode = '[sh_testcarousel pause="' + pause + '" transition="' + transition + '" adapt="' + adapt + '"]'
				+ '<p>&nbsp;</p>' + '[sh_testimonial name="<?php echo __('Name', 'shshortc');?>"'
				+ ' title="<?php echo __('Title', 'shshortc');?>" image=""]<?php echo __('The Testimonial', 'shshortc');?>'
				+ '[/sh_testimonial]'

				+ '<p>&nbsp;</p>' + '[sh_testimonial name="<?php echo __('Name', 'shshortc');?>"'
                + ' title="<?php echo __('Title', 'shshortc');?>" image=""]<?php echo __('The Testimonial', 'shshortc');?>'
                + '[/sh_testimonial]'

				+ '<p>&nbsp;</p>' + '[sh_testimonial name="<?php echo __('Name', 'shshortc');?>"'
                + ' title="<?php echo __('Title', 'shshortc');?>" image=""]<?php echo __('The Testimonial', 'shshortc');?>'
                + '[/sh_testimonial]<p>&nbsp;</p>'

				+ '[/sh_testcarousel]';

		} else if (sel == 'video') {
			var type= $(document).find('.video-type').val();
			var id= $(document).find('.video-id').val();
			var poster = $(document).find('.video-poster').val();
			var shortcode = '[sh_video video="' + type + '" id="' + id + '" poster="' + poster + '"]';

        } else {
            alert('<?php echo __('Please select a Shortcode.', 'shshortc'); ?>');
            return false;
        }
        parent.tinymce.execCommand('mceInsertContent', 0, shortcode);
        //$('.sc-container').dialog('close').remove();
        parent.tinymce.activeEditor.windowManager.close();
    });

    /* destroy existing container on close 3x */
    $(document).on('click', '.ui-dialog-titlebar-close', function() {
        $('.sc-container').dialog('close').remove();
        return false;
    });

    // handle font awesome icons with callback to global function
    function processResults(results) {

		 var ind = '<div class="fields"><div class="sc-label"><?php echo __('Choose Icon Set:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="radio" class="cb-iconset"'
                + ' name="iconset" value="fontawesome" checked="checked">'
                + '<?php echo __('Font Awesome Icons', 'shshortc');?><br />';
            
        if (linearIcons == '1') {
            ind += '<input type="radio" class="cb-iconset" name="iconset" value="linear">'
                + '<?php echo __('Linear Icons', 'shshortc');?><br />'
        }
        if (ionIcons == '1') {
            ind += '<input type="radio" class="cb-iconset" name="iconset" value="ion">'
                + '<?php echo __('Ion Icons', 'shshortc');?><br />'
        }

        ind += '</div></div>';

        ind += font_awesome_select(results);

		if (linearIcons == '1') {
            ind += linear_select(results);
        }
        if (ionIcons == '1') {
            ind += ion_select(results);
        }

		ind += '<div class="fields"><div class="sc-label"><?php echo __('Enable Link:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="radio" class="font-awesome-link"'
			+ ' name="enablelink" value="enable" checked="checked">'
            + '<?php echo __('Enable', 'shshortc');?><br />'
            + '<input type="radio" class="font-awesome-link" name="enablelink" value="disable">'
            + '<?php echo __('Disable', 'shshortc');?><br />'
            + '</div></div>'


            + '<div class="fields"><div class="sc-label"><?php echo __('Enter the URL', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input class="font-awesome-url" placeholder="http://www.example.com" /></div></div>'
            + '<div class="fields"><div class="sc-label"><?php echo __('Select New Window or Same', 'shshortc'); ?></div>'
            + '<div class="sc-option"><select class="font-awesome-target">'
            + '<option value="_blank"><?php echo __('New Window', 'shshortc'); ?></option>'
            + '<option value="_self"><?php echo __('Same Window', 'shshortc'); ?></option>'
            + '</select></div></div>'
			+ '<div class="fields"><div class="sc-label"><?php echo __('Select the icon size', 'shshortc'); ?></div>'
			+ '<div class="sc-option"><select class="font-awesome-size">'
			+ '<option value=""><?php echo __('Standard', 'shshortc'); ?></option>'
			+ '<option value="2x"><?php echo __('2 x the size', 'shshortc'); ?></option>'
			+ '<option value="3x"><?php echo __('3 x the size', 'shshortc'); ?></option>'
			+ '<option value="4x"><?php echo __('4 x the size', 'shshortc'); ?></option>'
			+ '<option value="5x"><?php echo __('5 x the size', 'shshortc'); ?></option>'
			+ '</select></div></div>'

			+ '<div class="fields"><div class="sc-label"><?php echo __('Font Color:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="text" class="spectrumcolor icon-font-color" value="#555" /></div></div>'

			 + '<div class="fields"><div class="sc-label"><?php echo __('Enable Icon Spin:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="radio" class="enable-spin"'
            + ' value="enable" name="enable-spin" checked="checked">'
            + '<?php echo __('Enable', 'shshortc');?><br />'
            + '<input type="radio" class="enable-spin" value="disable" name="enable-spin" checked="checked">'
            + '<?php echo __('Disable', 'shshortc');?><br />'
            + '</div></div>'

			+ '<div class="fields"><div class="sc-label"><?php echo __('Enable Circle Surround:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="radio" class="enable-circle"'
            + ' value="enable" name="enable-circle" checked="checked">'
            + '<?php echo __('Enable', 'shshortc');?><br />'
            + '<input type="radio" class="enable-circle" value="disable" name="enable-circle" checked="checked">'
            + '<?php echo __('Disable', 'shshortc');?><br />'
            + '</div></div>'

			+ '<div class="fields" style="display:none">'
			+ '<div class="sc-label"><?php echo __('Surround Color:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="text"'
			+ ' class="spectrumcolor icon-circle-color" value="#DD4040"/></div></div>'
			
			+ '<div class="fields" style="display:none">'
			+ '<div class="sc-label"><?php echo __('Border Color:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="text"'
			+ ' class="spectrumcolor icon-border-color" value="#DD4040" /></div></div>'

            + '<div class="sh-message"><?php echo __('Choose an icon, the color and a url for the link to add.  You can add a circle color and border around as well.', 'shshortc');?></div>';

        $(document).find('.sc-individual').html(ind);
        enableSelectBoxes();
		
		// initialize spectrum color picker
        var colorInput = $(document).find(".spectrumcolor");
        $(colorInput).spectrum({
            showInput: true,
            showAlpha: true,
            //showPalette: true,
            preferredFormat: "rgb",
        });
    }

	function processResults3(results) { // font awesome for checklists
		var ind = '<div class="fields"><div class="sc-label">'
				+ '<?php echo __('Select List Type:', 'shshortc'); ?></div>'
				+ '<div class="sc-option"><select class="bullet-type">'
				+ '<option value="unordered"><?php echo __('Unordered', 'shshortc');?>'
				+ '<option value="ordered"><?php echo __('Ordered', 'shshortc');?>'
				+ '</select></div></div>'

		 		+ '<div class="fields"><div class="sc-label"><?php echo __('Choose Icon Set:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="radio" class="list-iconset"'
                + ' name="iconset" value="fontawesome" checked="checked">'
                + '<?php echo __('Font Awesome Icons', 'shshortc');?><br />';
            
        if (linearIcons == '1') {
            ind += '<input type="radio" class="list-iconset" name="iconset" value="linear">'
                + '<?php echo __('Linear Icons', 'shshortc');?><br />'
        }
        if (ionIcons == '1') {
            ind += '<input type="radio" class="list-iconset" name="iconset" value="ion">'
                + '<?php echo __('Ion Icons', 'shshortc');?><br />'
        }

        ind += '</div></div>';

        ind += font_awesome_select(results);

        if (linearIcons == '1') {
            ind += linear_select(results);
        }
        if (ionIcons == '1') {
            ind += ion_select(results);
        }

		ind	+= '<div class="fields"><div class="sc-label"><?php echo __('Bullet Background:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><select class="bullet-background">'
            + '<option value="enable"><?php echo __('Enable', 'shshortc'); ?></option>'
            + '<option value="disable" selected="selected"><?php echo __('Disable', 'shshortc'); ?></option>'
            + '</select></div></div>'

			+ '<div class="fields" style="display:none;">'
			+ '<div class="sc-label"><?php echo __('Use Custom Colors:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="radio" class="bullet-customcolor"'
			+ ' name="customcolor" value="false" checked="checked">'
            + '<?php echo __('False - Theme Accent used', 'shshortc');?><br />'
            + '<input type="radio" class="bullet-customcolor" name="customcolor" value="true">'
            + '<?php echo __('True - Override Theme Accent', 'shshortc');?><br />'
            + '</div></div>'			

			+ '<div class="fields" style="display:none;">'
			+ '<div class="sc-label"><?php echo __('Bullet Background Color:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="text" class="spectrumcolor bullet-backgroundcolor" value="#555555" />'
			+ '</div></div>'

			+ '<div class="fields" style="display:none;">'
			+ '<div class="sc-label"><?php echo __('Bullet Font Color:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="text" class="spectrumcolor bullet-fontcolor" value="#ffffff" />'
            + '</div></div>'

			+ '<div class="fields"><div class="sc-label"><?php echo __('Number of items:', 'shshortc'); ?></div>'
			+ '<div class="sc-option"><select class="bullet-count">';

		for (var i=1; i < 51; i++) {
			ind += '<option value="' + i + '">' + i + '</option>';
		}

		ind += '</select></div></div>'
        	+ '<div class="sh-message"><?php echo __('Select an icon for your unordered checklists, bullet background and font color can be customized but defaults to theme accent for background color.', 'shshortc');?></div>';

		$(document).find('.sc-individual').html(ind);
		enableSelectBoxes();

		// initialize spectrum color picker
        var colorInput = $(document).find(".spectrumcolor");
        $(colorInput).spectrum({
            showInput: true,
            showAlpha: true,
            //showPalette: true,
            preferredFormat: "rgb",
        });
	}

	function processResults4(results) { // font awesome for buttons

		var ind = '<div class="fields"><div class="sc-label"><?php echo __('Button Text:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input class="button-text" value="A Button" /></div></div>'
            + '<div class="fields"><div class="sc-label"><?php echo __('Button Link:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input class="button-link" value="http://www.example.com" /></div></div>'
            + '<div class="fields"><div class="sc-label"><?php echo __('Button Target:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><select class="button-target">'
            + '<option value="_blank"><?php echo __('New Window', 'shshortc'); ?></option>'
            + '<option value="_self"><?php echo __('Same Window', 'shshortc'); ?></option>'
            + '</select></div></div>'

			+ '<div class="fields"><div class="sc-label"><?php echo __('Use Icons:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="radio" class="button-icon" name="icon" value="disable">'
			+ '<?php echo __('Disable', 'shshortc');?><br />'
			+ '<input type="radio" class="button-icon" name="icon" value="enable" checked="checked">'
			+ '<?php echo __('Enable', 'shshortc');?><br />'
			+ '</div></div>'

			+ '<div class="fields">'
			+ '<div class="sc-label"><?php echo __('Icon Background Style:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><select class="icon-background">'
            + '<option value="flat"><?php echo __('Flat (Same Background as button)', 'shshortc'); ?></option>'
            + '<option value="square"><?php echo __('Square (Offset darker background)', 'shshortc'); ?></option>'
            + '<option value="diagonal"><?php echo __('Diagonal (Diagonal cut darker background)', 'shshortc'); ?></option>'
            + '</select></div></div>'

		 	+ '<div class="fields"><div class="sc-label"><?php echo __('Choose Icon Set:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="radio" class="button-iconset"'
            + ' name="iconset" value="fontawesome" checked="checked">'
            + '<?php echo __('Font Awesome Icons', 'shshortc');?><br />';
            
        if (linearIcons == '1') {
            ind += '<input type="radio" class="button-iconset" name="iconset" value="linear">'
                + '<?php echo __('Linear Icons', 'shshortc');?><br />'
        }
        if (ionIcons == '1') {
            ind += '<input type="radio" class="button-iconset" name="iconset" value="ion">'
                + '<?php echo __('Ion Icons', 'shshortc');?><br />'
        }

        ind += '</div></div>';


		ind += font_awesome_select(results);

        if (linearIcons == '1') {
            ind += linear_select(results);
        }
        if (ionIcons == '1') {
            ind += ion_select(results);
        }

        ind += '<div class="fields"><div class="sc-label"><?php echo __('Button Size:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><select class="button-size">'
            + '<option value="small"><?php echo __('Small', 'shshortc'); ?></option>'
            + '<option value="medium"><?php echo __('Medium', 'shshortc'); ?></option>'
            + '<option value="large"><?php echo __('Large', 'shshortc'); ?></option>'
            + '<option value="extralarge"><?php echo __('Extra Large', 'shshortc'); ?></option>'
            + '</select></div></div>'

            + '<div class="fields"><div class="sc-label"><?php echo __('Button Shape:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><select class="button-shape">'
            + '<option value="square"><?php echo __('Square', 'shshortc'); ?></option>'
            + '<option value="squareRounded"><?php echo __('Square Rounded', 'shshortc'); ?></option>'
            + '<option value="round"><?php echo __('Round', 'shshortc'); ?></option>'
            + '</select></div></div>'

			+ '<div class="fields"><div class="sc-label"><?php echo __('Button Style:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><select class="button-style">'
            + '<option value="flat"><?php echo __('Flat Styled', 'shshortc'); ?></option>'
            + '<option value="dimension"><?php echo __('3D Styled', 'shshortc'); ?></option>'
            + '</select></div></div>'

            + '<div class="fields"><div class="sc-label"><?php echo __('Enable Hover:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><select class="enable-hover">'
            + '<option value="enable"><?php echo __('Enable', 'shshortc');?></option>'
            + '<option value="disable"><?php echo __('Disable', 'shshortc'); ?></option>'
            + '</select></div></div>'
                

            + '<div class="fields"><div class="sc-label"><?php echo __('Button Color:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="text" class="spectrumcolor button-color" value="#DD4040" /></div></div>'

            + '<div class="fields"><div class="sc-label"><?php echo __('Border Color and Size:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="text" class="spectrumcolor border-color" value="#DD4040" />'
            + '<select class="border-size small">';

            for (var i=0; i < 25; i++) {
                ind += '<option value="' + i + '">' + i + '</option>';
            }
            ind += '</select></div></div>'

                + '<div class="fields"><div class="sc-label"><?php echo __('Font Color', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor font-color" value="#DD4040" /></div></div>'
   
                + '<div class="sh-message"><?php echo __('Text is the button text, link is the url for the button, target chooses to open a new or same window.', 'shshortc');?></div>';
			
		$(document).find('.sc-individual').html(ind);
        enableSelectBoxes();

		// initialize spectrum color picker
        var colorInput = $(document).find(".spectrumcolor");
        $(colorInput).spectrum({
            showInput: true,
            showAlpha: true,
            preferredFormat: "rgb",
        });
	}
	// End Process Results 4 (buttons)	

	function processResults5(results) {  // alert messages with icon select
		var ind = '<div class="fields"><div class="sc-label"><?php echo __('Alert Message Text', 'shshortc'); ?></div>'
                + '<div class="sc-option"><textarea class="alert-text" /></textarea></div></div>'

                + '<div class="fields"><div class="sc-label"><?php echo __('Enable Close Button:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="radio" class="alert-close"'
                + ' name="enableclose" value="enable" checked="checked">'
                + '<?php echo __('Enable', 'shshortc');?><br />'
                + '<input type="radio" class="alert-close" name="enableclose" value="disable">'
                + '<?php echo __('Disable', 'shshortc');?><br /><br />'
                + '</div></div>'

				
                + '<div class="fields"><div class="sc-label"><?php echo __('Enable Icon Before Message:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="radio" class="alert-font"'
                + ' name="enablefont" value="enable" checked="checked">'
                + '<?php echo __('Enable', 'shshortc');?><br />'
                + '<input type="radio" class="alert-font" name="enablefont" value="disable">'
                + '<?php echo __('Disable', 'shshortc');?><br /><br />'
                + '</div></div>'

				
				+ '<div class="fields"><div class="sc-label"><?php echo __('Choose Icon Set:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="radio" class="alert-iconset"'
                + ' name="iconset" value="fontawesome" checked="checked">'
				+ '<?php echo __('Font Awesome Icons', 'shshortc');?><br />';
			
        if (linearIcons == '1') {
            ind += '<input type="radio" class="alert-iconset" name="iconset" value="linear">'
                + '<?php echo __('Linear Icons', 'shshortc');?><br />'
		}
        if (ionIcons == '1') {
			ind += '<input type="radio" class="alert-iconset" name="iconset" value="ion">'
                + '<?php echo __('Ion Icons', 'shshortc');?><br />'
		}

        ind += '</div></div>';
				

		ind += font_awesome_select(results);

        if (linearIcons == '1') {
			ind += linear_select(results);
		}
        if (ionIcons == '1') {
			ind += ion_select(results);
		}

        ind += '<div class="fields"><div class="sc-label"><?php echo __('Alert Type:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="alert-type">'
                + '<option value="general"><?php echo __('General', 'shshortc'); ?></option>'
                + '<option value="info"><?php echo __('Informational', 'shshortc'); ?></option>'
                + '<option value="success"><?php echo __('Success', 'shshortc'); ?></option>'
                + '<option value="warning"><?php echo __('Warning', 'shshortc'); ?></option>'
                + '<option value="error"><?php echo __('Error', 'shshortc'); ?></option>'
				+ '<option value="custom"><?php echo __('Custom', 'shshortc'); ?></option>'
                + '</select></div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Font Size (px):', 'shshortc'); ?></div>'
                + '<div class="sc-option">'
                + '<input type="text" class="alert-fontsize" value="15px" /></div></div>'

				+ '<div class="fields" style="display:none;">'
				+ '<div class="sc-label"><?php echo __('Background Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option">'
                + '<input type="text" class="spectrumcolor alert-background" value="#fff" /></div></div>'

				+ '<div class="fields" style="display:none;">'
				+ '<div class="sc-label"><?php echo __('Font Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option">'
                + '<input type="text" class="spectrumcolor alert-fontcolor" value="#555" /></div></div>'

				+ '<div class="fields" style="display:none;">'
				+ '<div class="sc-label"><?php echo __('Border Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option">'
                + '<input type="text" class="spectrumcolor alert-bordercolor" value="#555" /></div></div>'

                + '<div class="sh-message"><?php echo __('Enter the alert text, choose if you would like to enable the close button, decide if you want an icon, and choose the type of alert message you want to use.', 'shshortc'); ?></div>';
		$(document).find('.sc-individual').html(ind);
        enableSelectBoxes();

		// initialize spectrum color picker
        var colorInput = $(document).find(".spectrumcolor");
        $(colorInput).spectrum({
            //color: "#DD4040",
            showInput: true,
            showAlpha: true,
            //showPalette: true,
            preferredFormat: "rgb",
        });
    }
	// End Process Results 5 ( alert messages )

	function processResults6(results) { // Callout Boxes
		var ind = '<div class="fields">'
				+ '<div class="sc-label"><?php echo __('Choose a Callout Type:', 'shshortc');?></div>'
				+ '<div class="sc-option"><select class="callout-type">'
				+ '<option value="standard"><?php echo __('Standard Box', 'shshortc');?></option>'
				+ '<option value="flip"><?php echo __('Flip Box', 'shshortc');?></option>'
				+ '</select></div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('The Title:', 'shshortc');?></div>'
                + '<div class="sc-option"><input type="text" class="callout-title" />'
                + '</div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('The Content:', 'shshortc');?></div>'
                + '<div class="sc-option"><textarea class="callout-text" /></textarea>'
                + '</div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Border Color, Size, and Radius:', 'shshortc'); ?></div>'
            	+ '<div class="sc-option">'
				+ '<input type="text" class="spectrumcolor border-color" value="rgba(0,0,0,0.15)" />'
				+ '<select class="border-size">';
				for (var i = 0; i < 25; i++) {
					var selected = '';
                    if (i == 1) {
                        selected = ' selected="selected"';
                    }
					ind += '<option value="' + i + 'px"' + selected + '>' + i +'px</option>';
				}

				ind += '</select>'
				+ '<select class="border-radius">';

                for (var i = 0; i < 25; i++) {
					var selected = '';
					if (i == 4) {
						selected = ' selected="selected"';
					}
                    ind += '<option value="' + i + 'px"' + selected + '>' + i +'px</option>';
                }

                ind += '</select></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Background Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option">'
                + '<input type="text" class="spectrumcolor background-color" value="#fff" /></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Font Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option">'
                + '<input type="text" class="spectrumcolor font-color" value="#555" /></div></div>'

				+ '<div class="fields" style="display:none;">'
                + '<div class="sc-label"><?php echo __('Flip Content:', 'shshortc');?></div>'
                + '<div class="sc-option"><textarea class="callout-flip-text" /></textarea>'
                + '</div></div>'

				+ '<div class="fields" style="display:none;">'
				+ '<div class="sc-label"><?php echo __('Flip Font Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option">'
                + '<input type="text" class="spectrumcolor flip-font-color" value="#555" /></div></div>'

				+ '<div class="fields" style="display:none;">'
				+ '<div class="sc-label"><?php echo __('Flip Background Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option">'
                + '<input type="text" class="spectrumcolor flip-bg-color" value="#fff" /></div></div>'

				+ '<div class="fields" style="display:none;">'
                + '<div class="sc-label"><?php echo __('Flip Border Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option">'
                + '<input type="text" class="spectrumcolor flip-border-color" value="rgba(0,0,0,0.15)" /></div></div>'


				+ '<hr><div class="fields"><div class="sc-label"><?php echo __('Enable Button:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="radio" class="callout-button-enable"'
                + ' name="callout-button-enable" value="enable" checked="checked">'
                + '<?php echo __('Enable', 'shshortc');?>'
                + '<input type="radio" class="callout-button-enable" name="callout-button-enable" value="disable">'
                + '<?php echo __('Disable', 'shshortc');?>'
                + '</div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Button Text:', 'shshortc');?></div>'
                + '<div class="sc-option"><input type="text" class="callout-button-text" />'
                + '</div></div>'
	
				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Button Link:', 'shshortc');?></div>'
                + '<div class="sc-option"><input type="text" class="callout-button-link" value="http://www.example.com" />'
                + '</div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Button Target:', 'shshortc');?></div>'
                + '<div class="sc-option"><select class="callout-button-target">'
				+ '<option value="_blank"><?php echo __('New Window', 'shshortc'); ?></option>'
            	+ '<option value="_self"><?php echo __('Same Window', 'shshortc'); ?></option>'
                + '</select></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Button Font Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option">'
                + '<input type="text" class="spectrumcolor button-font-color" value="#fff" /></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Button Background Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option">'
                + '<input type="text" class="spectrumcolor button-bg-color" value="#DD4040" /></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Button Border Color, Size, and Radius:', 'shshortc'); ?></div>'
                + '<div class="sc-option">'
                + '<input type="text" class="spectrumcolor btn-border-color" value="rgba(0,0,0,0.15)" />'
                + '<select class="btn-border-size">';
                for (var i = 0; i < 25; i++) {
                    var selected = '';
                    if (i == 1) {
                        selected = ' selected="selected"';
                    }
                    ind += '<option value="' + i + 'px"' + selected + '>' + i +'px</option>';
                }

                ind += '</select>'
                + '<select class="btn-border-radius">';

                for (var i = 0; i < 25; i++) {
                    var selected = '';
                    if (i == 4) {
                        selected = ' selected="selected"';
                    }
                    ind += '<option value="' + i + 'px"' + selected + '>' + i +'px</option>';
                }

                ind += '</select></div></div>'

				+ '<hr><div class="fields"><div class="sc-label"><?php echo __('Enable Icon or Image:', 'shshortc'); ?></div>'
            	+ '<div class="sc-option"><input type="radio" class="callout-icon-enable"'
            	+ ' name="callout-icon-enable" value="enable" checked="checked">'
            	+ '<?php echo __('Enable Icon', 'shshortc');?>'
            	+ '<input type="radio" class="callout-icon-enable" name="callout-icon-enable" value="image">'
            	+ '<?php echo __('Enable Image', 'shshortc');?>'
				+ '<input type="radio" class="callout-icon-enable" name="callout-icon-enable" value="disable">'
                + '<?php echo __('Disable', 'shshortc');?>'
            	+ '</div></div>'

				// Images
				+ '<div class="fields" style="display: none;">'
				+ '<div class="sc-label"><?php echo __('Image URL', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="upload_image" type="text" name="callout-image" value="" />'
                + '</div></div>'
                + '<div class="fields" style="display: none;">'
			    + '<div class="sc-label"><?php echo __('Choose Image', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="upload_image_button" class="button" type="button" value="<?php echo __('Choose Image', 'shshortc'); ?>" />'
                + '</div></div>'
				+ '<div class="fields" style="display:none;">'
                + '<div class="sc-label"><?php echo __('Image Height and Width (px):', 'shshortc');?></div>'
                + '<div class="sc-option"><input type="text" class="callout-image-h" value="100px" />'
				+ '<input type="text" class="callout-image-w" value="250px" />'
                + '</div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Choose Icon Set:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="radio" class="callout-iconset"'
                + ' name="iconset" value="fontawesome" checked="checked">'
                + '<?php echo __('Font Awesome Icons', 'shshortc');?><br />';
            
        if (linearIcons == '1') {
            ind += '<input type="radio" class="callout-iconset" name="iconset" value="linear">'
                + '<?php echo __('Linear Icons', 'shshortc');?><br />'
        }
        if (ionIcons == '1') {
            ind += '<input type="radio" class="callout-iconset" name="iconset" value="ion">'
                + '<?php echo __('Ion Icons', 'shshortc');?><br />'
        }

        ind += '</div></div>'

			+ '<div class="fields"><div class="sc-label"><?php echo __('Icon Spin:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="radio" class="callout-icon-spin"'
            + ' name="callout-icon-spin" value="enable">'
            + '<?php echo __('Enable', 'shshortc');?>'
            + '<input type="radio" class="callout-icon-spin" name="callout-icon-spin" value="disable" checked="checked">'
            + '<?php echo __('Disable', 'shshortc');?>'
            + '</div></div>';


        ind += font_awesome_select(results);

        if (linearIcons == '1') {
            ind += linear_select(results);
        }
        if (ionIcons == '1') {
            ind += ion_select(results);
        }


		ind += '<div class="fields"><div class="sc-label"><?php echo __('Icon Font Color:', 'shshortc'); ?></div>'
            + '<div class="sc-option">'
            + '<input type="text" class="spectrumcolor icon-font-color" value="#fff" /></div></div>'

            + '<div class="fields"><div class="sc-label"><?php echo __('Icon Background Color:', 'shshortc'); ?></div>'
            + '<div class="sc-option">'
            + '<input type="text" class="spectrumcolor icon-bg-color" value="#DD4040" /></div></div>'


			+ '<div class="sh-message"><?php echo __('Choose the type of callout box you would like and set the options for it.', 'shshortc'); ?></div>';

		$(document).find('.sc-individual').html(ind);
        enableSelectBoxes();

		// initialize spectrum color picker
        var colorInput = $(document).find(".spectrumcolor");
        $(colorInput).spectrum({
            //color: "#DD4040",
            showInput: true,
            showAlpha: true,
            //showPalette: true,
            preferredFormat: "rgb",
        });

	} 
	// End Process Results 6 ( callouts )

	function processResults7(results) { // Milestone counters
		var ind = '<div class="fields"><div class="sc-label"><?php echo __('Starting Number', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="mile-start" type="text" value="0" />'
                + '</div></div>'

                + '<div class="fields"><div class="sc-label"><?php echo __('Stop Number', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="mile-stop" type="text" value="200" />'
                + '</div></div>'

         + '<div class="fields"><div class="sc-label"><?php echo __('Choose Icon Set:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="radio" class="mile-iconset"'
                + ' name="iconset" value="fontawesome" checked="checked">'
                + '<?php echo __('Font Awesome Icons', 'shshortc');?><br />';
            
        if (linearIcons == '1') {
            ind += '<input type="radio" class="mile-iconset" name="iconset" value="linear">'
                + '<?php echo __('Linear Icons', 'shshortc');?><br />'
        }
        if (ionIcons == '1') {
            ind += '<input type="radio" class="mile-iconset" name="iconset" value="ion">'
                + '<?php echo __('Ion Icons', 'shshortc');?><br />'
        }

        ind += '</div></div>';

        ind += font_awesome_select(results);

        if (linearIcons == '1') {
            ind += linear_select(results);
        }
        if (ionIcons == '1') {
            ind += ion_select(results);
        }


        ind += '<div class="fields"><div class="sc-label"><?php echo __('Icon Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor mile-color" value="#555" /></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Short Text Before', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="mile-before" type="text" value="$" />'
                + '</div></div>'
				
				+ '<div class="fields"><div class="sc-label"><?php echo __('Short Text After', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="mile-after" type="text" value="" />'
                + '</div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Summary Below', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="mile-summary" type="text" value="" />'
                + '</div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Milestone Size:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="mile-size">'
				+ '<option value="small"><?php echo __('Small', 'shshortc');?></option>'
				+ '<option value="medium"><?php echo __('Medium', 'shshortc');?></option>'
				+ '<option value="large"><?php echo __('Large', 'shshortc');?></option>'
				+ '</select></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('speed (thousands of a second)', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="mile-speed" type="text" value="2000" />'
                + '</div></div>'

                + '<div class="sh-message"><?php echo __('Start and Stop need to be numeric.  Text before and after are useful for percents or dollar signs...keep them short.', 'shshortc');?></div>'; 


		$(document).find('.sc-individual').html(ind);
        enableSelectBoxes();

        // initialize spectrum color picker
        var colorInput = $(document).find(".spectrumcolor");
        $(colorInput).spectrum({
            //color: "#DD4040",
            showInput: true,
            showAlpha: true,
            //showPalette: true,
            preferredFormat: "rgb",
        });

	}
	// End Process Results 7

	function processResults8(results) { // Circle Charts
		var ind = '<div class="fields"><div class="sc-label"><?php echo __('Circle Text', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="circle-text" type="text" value="75%" />'
                + '</div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Circle Info (smaller text)', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="circle-info" type="text" value="" />'
                + '</div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Actual Percent Fill', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="circle-percent small-text" type="text" value="75" /> %'
                + '</div></div>'
	
				+ '<div class="fields"><div class="sc-label"><?php echo __('Chart Size', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="circle-dimension small-text" type="text" value="250" /> px'
                + '</div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Font Size', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="circle-fontsize small-text" type="text" value="38" /> px'
                + '</div></div>'
				
				+ '<div class="fields"><div class="sc-label"><?php echo __('Bar width', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="circle-width small-text" type="text" value="15" /> px'
                + '</div></div>'
				
				+ '<div class="fields"><div class="sc-label"><?php echo __('Circle Chart Type', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="circle-type">'
				+ '<option value="full"><?php echo __("Full Circle", "shshortc");?></option>'
				+ '<option value="half"><?php echo __("Half Circle", "shshortc");?></option>'
                + '</select></div></div>'
	
				+ '<div class="fields"><div class="sc-label"><?php echo __('Bar Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor circle-fgcolor" value="#61a9dc" /></div></div>'					
				+ '<div class="fields"><div class="sc-label"><?php echo __('Bar Background Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor circle-bgcolor" value="#eee" /></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Fill Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor circle-fill" value="#fff" /></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Enable Icon:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="radio" class="circle-icon-enable"'
                + ' name="circleicon" value="enable" checked="checked">'
                + '<?php echo __('Enable', 'shshortc');?><br />'
                + '<input type="radio" class="circle-icon-enable" name="circleicon" value="disable">'
                + '<?php echo __('Disable', 'shshortc');?>'
                + '</div></div>'				
	
				+ '<div class="fields">'
				+ '<div class="sc-label"><?php echo __('Icon Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor circle-iconcolor" value="#999" /></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Choose Icon Set:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="radio" class="circle-iconset"'
                + ' name="iconset" value="fontawesome" checked="checked">'
                + '<?php echo __('Font Awesome Icons', 'shshortc');?><br />';
            
        if (linearIcons == '1') {
            ind += '<input type="radio" class="circle-iconset" name="iconset" value="linear">'
                + '<?php echo __('Linear Icons', 'shshortc');?><br />'
        }
        if (ionIcons == '1') {
            ind += '<input type="radio" class="circle-iconset" name="iconset" value="ion">'
                + '<?php echo __('Ion Icons', 'shshortc');?><br />'
        }

        ind += '</div></div>';

        ind += font_awesome_select(results);

        if (linearIcons == '1') {
            ind += linear_select(results);
        }
        if (ionIcons == '1') {
            ind += ion_select(results);
        }

		$(document).find('.sc-individual').html(ind);
        enableSelectBoxes();

        // initialize spectrum color picker
        var colorInput = $(document).find(".spectrumcolor");
        $(colorInput).spectrum({
            showInput: true,
            showAlpha: true,
            //showPalette: true,
            preferredFormat: "rgb",
        });
	}
	// End Process Results 8

	// Process Results 9 Content Boxes
	function processResults9(results) { // Content Boxes
        var ind = '<div class="fields"><div class="sc-label"><?php echo __('Content Box Style', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="cb-style">'
                + '<option value="top"><?php echo __("Top Icon or Image", "shshortc");?></option>'
                + '<option value="left"><?php echo __("Left Icon or Image", "shshortc");?></option>'
                + '</select></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Enable Background', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="cb-background">'
                + '<option value="true"><?php echo __("Enable Transparent Background", "shshortc");?></option>'
                + '<option value="false"><?php echo __("Disable Background", "shshortc");?></option>'
                + '</select></div></div>'
			
				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Link and Icon Color:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="spectrumcolor cb-color" value="#555555" /></div></div>'
			
				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Read More Link:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="cb-readmorelink" value="" /></div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Read More Text:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="cb-readmoretext" value="" /></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Target', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="cb-target">'
                + '<option value="_new"><?php echo __("New Window", "shshortc");?></option>'
                + '<option value="_self"><?php echo __("Same Window", "shshortc");?></option>'
                + '</select></div></div>'

				+ '<div class="fields">'
                + '<div class="sc-label"><?php echo __('Title:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="text" class="cb-title" value="" /></div></div>'

				+ '<div class="fields">'
				+ '<div class="sc-label"><?php echo __('Content:', 'shshortc'); ?></div>'
				+ '<div class="sc-option"><textarea class="cb-content"></textarea></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Use Icon or Image', 'shshortc'); ?></div>'
                + '<div class="sc-option"><select class="cb-choice">'
                + '<option value="icon"><?php echo __("Use Icon", "shshortc");?></option>'
                + '<option value="image"><?php echo __("Use Image", "shshortc");?></option>'
                + '</select></div></div>'

				+ '<div class="fields"><div class="sc-label"><?php echo __('Choose Icon Set:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="radio" class="cb-iconset"'
                + ' name="iconset" value="fontawesome" checked="checked">'
                + '<?php echo __('Font Awesome Icons', 'shshortc');?><br />';
            
        if (linearIcons == '1') {
            ind += '<input type="radio" class="cb-iconset" name="iconset" value="linear">'
                + '<?php echo __('Linear Icons', 'shshortc');?><br />'
        }
        if (ionIcons == '1') {
            ind += '<input type="radio" class="cb-iconset" name="iconset" value="ion">'
                + '<?php echo __('Ion Icons', 'shshortc');?><br />'
        }

        ind += '</div></div>';

        ind += font_awesome_select(results);

        if (linearIcons == '1') {
            ind += linear_select(results);
        }
        if (ionIcons == '1') {
            ind += ion_select(results);
        }

		// Images
                + '<div class="fields" style="display: none;">'
                + '<div class="sc-label"><?php echo __('Image URL', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="upload_image" type="text" name="cb-image" value="" />'
                + '</div></div>'
                + '<div class="fields" style="display: none;">'
                + '<div class="sc-label"><?php echo __('Choose Image', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input class="upload_image_button" class="button" type="button" value="<?php echo __('Choose Image', 'shshortc'); ?>" />'
                + '</div></div>'

				+ '<div class="sh-message"><?php echo __('Leave Read More Link blank if you do not want a link.', 'shshortc');?></div>';

		$(document).find('.sc-individual').html(ind);
        enableSelectBoxes();

        // initialize spectrum color picker
        var colorInput = $(document).find(".spectrumcolor");
        $(colorInput).spectrum({
            showInput: true,
            showAlpha: true,
            //showPalette: true,
            preferredFormat: "rgb",
        });
	}
	// End Process Results 9 Content Boxes

	// Process Results 10 Social Icons
	function processResults10(results) {
		var ind = '<div class="fields"><div class="sc-label"><?php echo __('Choose Icon Set:', 'shshortc'); ?></div>'
                + '<div class="sc-option"><input type="radio" class="circle-iconset"'
                + ' name="iconset" value="fontawesome" checked="checked">'
                + '<?php echo __('Font Awesome Icons', 'shshortc');?><br />';
            
        if (linearIcons == '1') {
            ind += '<input type="radio" class="circle-iconset" name="iconset" value="linear">'
                + '<?php echo __('Linear Icons', 'shshortc');?><br />'
        }
        if (ionIcons == '1') {
            ind += '<input type="radio" class="circle-iconset" name="iconset" value="ion">'
                + '<?php echo __('Ion Icons', 'shshortc');?><br />'
        }

        ind += '</div></div>';

        ind += font_awesome_select(results);

        if (linearIcons == '1') {
            ind += linear_select(results);
        }
        if (ionIcons == '1') {
            ind += ion_select(results);
        }

	
		ind	+= '<div class="fields">'
            + '<div class="sc-label"><?php echo __('Link', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="text" class="si-link" value="" /></div></div>'

            + '<div class="fields"><div class="sc-label"><?php echo __('Target', 'shshortc'); ?></div>'
            + '<div class="sc-option"><select class="si-target">'
            + '<option value="_new"><?php echo __("New Window", "shshortc");?></option>'
            + '<option value="_self"><?php echo __("Same Window", "shshortc");?></option>'
            + '</select></div></div>'

			+ '<div class="fields"><div class="sc-label"><?php echo __('Icon Size', 'shshortc'); ?></div>'
            + '<div class="sc-option"><select class="si-size">'
            + '<option value="small"><?php echo __("Small", "shshortc");?></option>'
            + '<option value="medium"><?php echo __("Medium", "shshortc");?></option>'
			+ '<option value="large"><?php echo __("Large", "shshortc");?></option>'
            + '</select></div></div>'

			+ '<div class="fields">'
            + '<div class="sc-label"><?php echo __('Hover Title', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="text" class="si-title" value="" /></div></div>'

			+ '<div class="fields"><div class="sc-label"><?php echo __('Hover Title Placement', 'shshortc'); ?></div>'
            + '<div class="sc-option"><select class="si-placement">'
            + '<option value="top"><?php echo __("Top", "shshortc");?></option>'
            + '<option value="bottom"><?php echo __("Bottom", "shshortc");?></option>'
            + '<option value="right"><?php echo __("Right", "shshortc");?></option>'
			+ '<option value="left"><?php echo __("Left", "shshortc");?></option>'
            + '</select></div></div>'

			+ '<div class="fields"><div class="sc-label"><?php echo __('Framed', 'shshortc'); ?></div>'
            + '<div class="sc-option"><select class="si-framed">'
            + '<option value="false"><?php echo __("False - Just the icon", "shshortc");?></option>'
            + '<option value="true"><?php echo __("True - Icon and Background", "shshortc");?></option>'
            + '</select></div></div>'

			+ '<div class="fields" style="display:none;">'
            + '<div class="sc-label"><?php echo __('Radius', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="text" class="si-radius" value="2px" /></div></div>'	
			
			+ '<div class="fields" style="display:none;">'
            + '<div class="sc-label"><?php echo __('Background Color:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="text" class="spectrumcolor si-bgcolor"'
			+ ' value="rgba(0,0,0,0.15)" /></div></div>'

			+ '<div class="fields">'
            + '<div class="sc-label"><?php echo __('Icon Color:', 'shshortc'); ?></div>'
            + '<div class="sc-option"><input type="text" class="spectrumcolor si-fontcolor"'
			+ ' value="rgba(0,0,0,0.3)" /></div></div>'
		$(document).find('.sc-individual').html(ind);
        enableSelectBoxes();

        // initialize spectrum color picker
        var colorInput = $(document).find(".spectrumcolor");
        $(colorInput).spectrum({
            showInput: true,
            showAlpha: true,
            //showPalette: true,
            preferredFormat: "rgb",
        });
	}
	// End Process Results 10 Social Icons

    // search options
    $(document).on('keyup', '.searchOptionsLive', function() {
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
    function enableSelectBoxes(){
        $(document).find('div.selectBox').each(function(){
            $(this).children('span.selected').html($(this).children('div.selectOptions').children('span.selectOption:first').html());
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

    // select image for backgrounds
    var custom_uploader;
    $(document).on('click', '.upload_image_button', function(e) {
        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $(document).find('.upload_image').val(attachment.url);
            var image = '<img src="' + attachment.url + '" width="250" />';
            $(document).find('.image-selected').html(image);
        });

        //Open the uploader dialog
        custom_uploader.open();
    });
	
	var custom_vidUploader_mp4;
	// select MP4 video for background
	$(document).on('click', '.upload_video_button_mp4', function(e) {
        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (custom_vidUploader_mp4) {
            custom_vidUploader_mp4.open();
            return;
        }

        //Extend the wp.media object
        custom_vidUploader_mp4 = wp.media.frames.file_frame = wp.media({
            title: 'Choose Video (mp4 format)',
            button: {
                text: 'Choose MP4 Video'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_vidUploader_mp4.on('select', function() {
            var attachment = custom_vidUploader_mp4.state().get('selection').first().toJSON();
            $(document).find('.upload_video_mp4').val(attachment.url);
        });

        //Open the uploader dialog
        custom_vidUploader_mp4.open();
    });

	var custom_vidUploader_webm;
    // select WEBM video for background
    $(document).on('click', '.upload_video_button_webm', function(e) {
        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (custom_vidUploader_webm) {
            custom_vidUploader_webm.open();
            return;
        }

        //Extend the wp.media object
        custom_vidUploader_webm = wp.media.frames.file_frame = wp.media({
            title: 'Choose Video (webm format)',
            button: {
                text: 'Choose WEBM Video'
            },
            multiple: false
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_vidUploader_webm.on('select', function() {
            var attachment = custom_vidUploader_webm.state().get('selection').first().toJSON();
            $(document).find('.upload_video_webm').val(attachment.url);
        });

        //Open the uploader dialog
        custom_vidUploader_webm.open();
    });

	// Dropcap selections
	$(document).on('change', '.dropcap-style', function() {
		var val = $(this).val();
		if (val == 'theme') {
			$(document).find('.dropcap-color').closest('.fields').show();
			$(document).find('.dropcap-setbg').closest('.fields').hide();
			$(document).find('.dropcap-background').closest('.fields').hide();
			$(document).find('.dropcap-fontcolor').closest('.fields').hide();
		} else if (val == 'custom') {
			$(document).find('.dropcap-color').closest('.fields').hide();
			$(document).find('.dropcap-setbg').closest('.fields').show();
			var setbg = $(document).find('.dropcap-setbg').val();
			if (setbg == 'true') {
            	$(document).find('.dropcap-background').closest('.fields').show();
			}
            $(document).find('.dropcap-fontcolor').closest('.fields').show();
		}
	});

	// Highlight selections
	$(document).on('change', '.highlight-color', function() {
		var val = $(this).val();
		if (val == 'custom') {
			$(document).find('.highlight-fontcolor').closest('.fields').show();
			$(document).find('.highlight-background').closest('.fields').show();
			$(document).find('.highlight-choice').closest('.fields').hide();
		} else {
			$(document).find('.highlight-fontcolor').closest('.fields').hide();
            $(document).find('.highlight-background').closest('.fields').hide();
            $(document).find('.highlight-choice').closest('.fields').show();
		}
	});

	$(document).on('change', '.dropcap-setbg', function() {
		var val = $(this).val();
		if (val == 'true') {
			$(document).find('.dropcap-background').closest('.fields').show();
		} else {
			$(document).find('.dropcap-background').closest('.fields').hide();
		}
	});

	// changing of list types, show or hide Font Awesome selection
	$(document).on('change', '.bullet-type', function() {
		var val = $(this).val();
		 $(document).find('.selectBox').closest('.fields').hide();  // hide all initially
		if (val == 'ordered') {
			$(document).find('.list-iconset').closest('.fields').hide();
		} else {
			$(document).find('.list-iconset').closest('.fields').show();
			var iconset = $(document).find('input[name=iconset]:checked').val();
            if (iconset == 'fontawesome') {
                $(document).find('.font-awesome-select').show();
            } else if (iconset == 'linear') {
                $(document).find('.linear-select').show();
            } else if (iconset == 'ion') {
                $(document).find('.ion-select').show();
            }
		}
	});

	// List show iconsets icon select change
    $(document).on('change', '.list-iconset', function() {
        $(document).find('.selectBox').closest('.fields').hide();  // hide all initially
        var iconset = $(document).find('input[name=iconset]:checked').val();
        if (iconset == 'fontawesome') {
            $(document).find('.font-awesome-select').show();
        } else if (iconset == 'linear') {
            $(document).find('.linear-select').show();
        } else if (iconset == 'ion') {
            $(document).find('.ion-select').show();
        }
    });

	// Changing list bullet background enabling/disabling custom colors
	$(document).on('change', '.bullet-background', function() {
		var val = $(this).val();
		if (val == 'enable') {
			$(document).find('input[name=customcolor]:checked').closest('.fields').show();
			var val2 = $(document).find('.bullet-customcolor:checked').val();
			if (val2 == 'true') {
				$(document).find('.bullet-backgroundcolor').closest('.fields').show();
            	$(document).find('.bullet-fontcolor').closest('.fields').show();
			}
		} else {
			$(document).find('.bullet-customcolor').closest('.fields').hide();
			$(document).find('.bullet-backgroundcolor').closest('.fields').hide();
			$(document).find('.bullet-fontcolor').closest('.fields').hide();
		}
	});
	$(document).on('click', '.bullet-customcolor', function() {
		var val = $(document).find('.bullet-customcolor:checked').val();
		if (val == 'true') {
			$(document).find('.bullet-backgroundcolor').closest('.fields').show();
            $(document).find('.bullet-fontcolor').closest('.fields').show();
		} else {
			$(document).find('.bullet-backgroundcolor').closest('.fields').hide();
            $(document).find('.bullet-fontcolor').closest('.fields').hide();
		}
	});

	// changing of using a link for font awesome icons or not (hide url and window selection)
	$(document).on('change', '.font-awesome-link', function() {
        var val = $(document).find('input[name=enablelink]:checked').val();
        if (val == 'enable') {
             $(document).find('.font-awesome-url').closest('.fields').show();
             $(document).find('.font-awesome-target').closest('.fields').show();
        } else {
            $(document).find('.font-awesome-url').closest('.fields').hide();
            $(document).find('.font-awesome-target').closest('.fields').hide();
        }
    });
	// changing of circle background for icon or not
	$(document).on('change', '.enable-circle', function() {
		var val = $(document).find('.enable-circle:checked').val();
		if (val == 'enable') {
			$(document).find('.icon-circle-color').closest('.fields').show();
			$(document).find('.icon-border-color').closest('.fields').show();
		} else {
			$(document).find('.icon-circle-color').closest('.fields').hide();
            $(document).find('.icon-border-color').closest('.fields').hide();
		}
	});

	// changing of icon use in buttons show or hide Font Awesome selection
	$(document).on('change', '.button-icon', function() {
		var val = $(document).find('input[name=icon]:checked').val();

		if (val == 'enable') {
			$(document).find('.selectBox').closest('.fields').hide();  // hide all initially
            var iconset = $(document).find('input[name=iconset]:checked').val();
			if (iconset == 'fontawesome') {
                $(document).find('.font-awesome-select').show();
            } else if (iconset == 'linear') {
                $(document).find('.linear-select').show();
            } else if (iconset == 'ion') {
                $(document).find('.ion-select').show();
            }
			$(document).find('.icon-background').closest('.fields').show();
            $(document).find('.button-iconset').closest('.fields').show();
        } else {
            $(document).find('.selectBox').closest('.fields').hide();
			$(document).find('.icon-background').closest('.fields').hide();
			$(document).find('.button-iconset').closest('.fields').hide();
        }
	});

	// Change Icon select box - buttons
    $(document).on('change', '.button-iconset', function() {
        $(document).find('.selectBox').closest('.fields').hide();  // hide all initially
        var iconset = $(document).find('input[name=iconset]:checked').val();
        if (iconset == 'fontawesome') {
            $(document).find('.font-awesome-select').show();
        } else if (iconset == 'linear') {
            $(document).find('.linear-select').show();
        } else if (iconset == 'ion') {
            $(document).find('.ion-select').show();
        }
    });

	// Select Icons for alerts
	$(document).on('change', '.alert-font', function() {
		var val = $(document).find('input[name=enablefont]:checked').val();
		if (val == 'enable') {
			$(document).find('.selectBox').closest('.fields').hide();  // hide all initially
			var iconset = $(document).find('input[name=iconset]:checked').val();

			if (iconset == 'fontawesome') {
				$(document).find('.font-awesome-select').show();
			} else if (iconset == 'linear') {
				$(document).find('.linear-select').show();
			} else if (iconset == 'ion') {
				$(document).find('.ion-select').show();
			}
			$(document).find('.alert-iconset').closest('.fields').show();
		} else {
			$(document).find('.selectBox').closest('.fields').hide();
			$(document).find('.alert-iconset').closest('.fields').hide();
		}
	});

	// Change Icon select box
	$(document).on('change', '.alert-iconset', function() {
		$(document).find('.selectBox').closest('.fields').hide();  // hide all initially
        var iconset = $(document).find('input[name=iconset]:checked').val();
        if (iconset == 'fontawesome') {
            $(document).find('.font-awesome-select').show();
        } else if (iconset == 'linear') {
            $(document).find('.linear-select').show();
        } else if (iconset == 'ion') {
            $(document).find('.ion-select').show();
        }
	});

	// alert custom type settings
	$(document).on('change', '.alert-type', function() {
		var val = $(this).val();
		if (val == 'custom') {
			$(document).find('.alert-background').closest('.fields').show();
			$(document).find('.alert-fontcolor').closest('.fields').show();
			$(document).find('.alert-bordercolor').closest('.fields').show();
		} else {
			$(document).find('.alert-background').closest('.fields').hide();
            $(document).find('.alert-fontcolor').closest('.fields').hide();
            $(document).find('.alert-bordercolor').closest('.fields').hide();
		}
	});

	// Callout boxes type selection show and hide relevant options
	$(document).on('change', '.callout-type', function() {
		var val = $(this).val();
		if (val == 'standard') {
			$(document).find('.callout-flip-text').closest('.fields').hide();
			$(document).find('.flip-font-color').closest('.fields').hide();
			$(document).find('.flip-bg-color').closest('.fields').hide();
			$(document).find('.flip-border-color').closest('.fields').hide();
		} else if (val == 'flip') {
            $(document).find('.callout-flip-text').closest('.fields').show();
			$(document).find('.flip-font-color').closest('.fields').show();
            $(document).find('.flip-bg-color').closest('.fields').show();
			$(document).find('.flip-border-color').closest('.fields').show();
		}
	});
	$(document).on('change', '.callout-button-enable', function() {
		var val = $(this).val();
		if (val == 'enable') {
			$(document).find('.callout-button-text').closest('.fields').show();
			$(document).find('.callout-button-link').closest('.fields').show();
			$(document).find('.callout-button-target').closest('.fields').show();
			$(document).find('.button-font-color').closest('.fields').show();
			$(document).find('.button-bg-color').closest('.fields').show();
			$(document).find('.btn-border-color').closest('.fields').show();
		} else {
			$(document).find('.callout-button-text').closest('.fields').hide();
            $(document).find('.callout-button-link').closest('.fields').hide();
            $(document).find('.callout-button-target').closest('.fields').hide();
            $(document).find('.button-font-color').closest('.fields').hide();
            $(document).find('.button-bg-color').closest('.fields').hide();
			$(document).find('.btn-border-color').closest('.fields').hide();		
		}
	});
	$(document).on('change', '.callout-icon-enable', function() {
        var val = $(this).val();
		$(document).find('.selectBox').closest('.fields').hide();  // hide all initially
        var iconset = $(document).find('input[name=iconset]:checked').val();
        if (val == 'enable') {
			$(document).find('.callout-iconset').closest('.fields').show();
			if (iconset == 'fontawesome') {
            	$(document).find('.font-awesome-select').show();
				$(document).find('.callout-icon-spin').closest('.fields').show();
        	} else if (iconset == 'linear') {
            	$(document).find('.linear-select').show();
				$(document).find('.callout-icon-spin').closest('.fields').hide();
       	 	} else if (iconset == 'ion') {
            	$(document).find('.ion-select').show();
				$(document).find('.callout-icon-spin').closest('.fields').hide();
        	}

            $(document).find('.icon-font-color').closest('.fields').show();
            $(document).find('.icon-bg-color').closest('.fields').show();

			$(document).find('.upload_image').closest('.fields').hide();
            $(document).find('.upload_image_button').closest('.fields').hide();
            $(document).find('.callout-image-h').closest('.fields').hide();
		} else if (val == 'image') {
			$(document).find('.callout-iconset').closest('.fields').hide();
			$(document).find('.callout-icon-spin').closest('.fields').hide();
            $(document).find('.selectBox').closest('.fields').hide();
            $(document).find('.icon-font-color').closest('.fields').hide();
            $(document).find('.icon-bg-color').closest('.fields').hide();

			$(document).find('.upload_image').closest('.fields').show();
			$(document).find('.upload_image_button').closest('.fields').show();
			$(document).find('.callout-image-h').closest('.fields').show();
        } else {
			$(document).find('.callout-iconset').closest('.fields').hide();
			$(document).find('.callout-icon-spin').closest('.fields').hide();
            $(document).find('.selectBox').closest('.fields').hide();
            $(document).find('.icon-font-color').closest('.fields').hide();
            $(document).find('.icon-bg-color').closest('.fields').hide();

			$(document).find('.upload_image').closest('.fields').hide();
            $(document).find('.upload_image_button').closest('.fields').hide();
            $(document).find('.callout-image-h').closest('.fields').hide();
        }
    });	

	// Callout icon-set change
	$(document).on('change', '.callout-iconset', function() {
		$(document).find('.selectBox').closest('.fields').hide();  // hide all initially
		var iconset = $(document).find('input[name=iconset]:checked').val();
		if (iconset == 'fontawesome') {
            $(document).find('.font-awesome-select').show();
            $(document).find('.callout-icon-spin').closest('.fields').show();
        } else if (iconset == 'linear') {
            $(document).find('.linear-select').show();
            $(document).find('.callout-icon-spin').closest('.fields').hide();
        } else if (iconset == 'ion') {
            $(document).find('.ion-select').show();
            $(document).find('.callout-icon-spin').closest('.fields').hide();
        }

	});

	// Header type selection (boxed does not have a summary)
	$(document).on('change', '.header-type', function() {
		var val = $(this).val();
		if (val == 'boxed') {
			$(document).find('.header-summary').closest('.fields').hide();
			$(document).find('.header-barcolor').closest('.fields').hide();
			$(document).find('.header-barwidth').closest('.fields').hide();
			$(document).find('.header-barheight').closest('.fields').hide();
		} else {
			$(document).find('.header-summary').closest('.fields').show();
			$(document).find('.header-barcolor').closest('.fields').show();
            $(document).find('.header-barwidth').closest('.fields').show();
            $(document).find('.header-barheight').closest('.fields').show();
		}
	});

	// Content Box Icon or Image Selection
	$(document).on('change', '.cb-choice', function() {
		var val = $(this).val();
			$(document).find('.selectBox').closest('.fields').hide();  // hide all initially
		if (val == 'icon') {
			var iconset = $(document).find('input[name=iconset]:checked').val();
        	if (iconset == 'fontawesome') {
            	$(document).find('.font-awesome-select').show();
        	} else if (iconset == 'linear') {
            	$(document).find('.linear-select').show();
        	} else if (iconset == 'ion') {
            	$(document).find('.ion-select').show();
        	}
			$(document).find('.upload_image').closest('.fields').hide();
			$(document).find('.upload_image_button').closest('.fields').hide();
			$(document).find('.cb-iconset').closest('.fields').show();
		} else {
            $(document).find('.upload_image').closest('.fields').show();
            $(document).find('.upload_image_button').closest('.fields').show();
			$(document).find('.cb-iconset').closest('.fields').hide();
		}
	});
	// Content box icon-set change
    $(document).on('change', '.cb-iconset', function() {
        $(document).find('.selectBox').closest('.fields').hide();  // hide all initially
        var iconset = $(document).find('input[name=iconset]:checked').val();
        if (iconset == 'fontawesome') {
            $(document).find('.font-awesome-select').show();
        } else if (iconset == 'linear') {
            $(document).find('.linear-select').show();
        } else if (iconset == 'ion') {
            $(document).find('.ion-select').show();
        }
    });

			

	// Section Solid, Parallax and video backgrounds hide show options
	$(document).on('change', '.background-choice', function() {
		var val = $(this).val();
		if (val == 'solid') {  // solid color
			$(document).find('.bg-color').closest('.fields').show();
			$(document).find('.bottomshadow').closest('.fields').show();

			$(document).find('.upload_image').closest('.fields').hide();
            $(document).find('.upload_image_button').closest('.fields').hide();
			$(document).find('.upload_video_mp4').closest('.fields').hide();
            $(document).find('.upload_video_button_mp4').closest('.fields').hide();
            $(document).find('.upload_video_webm').closest('.fields').hide();
            $(document).find('.upload_video_button_webm').closest('.fields').hide();
			$(document).find('.overlaycolor').closest('.fields').hide();

		} else if (val == 'parallax' || val == 'fixed' ) {  // parallax
			$(document).find('.bg-color').closest('.fields').hide();
			$(document).find('.upload_image').closest('.fields').show();
            $(document).find('.upload_image_button').closest('.fields').show();
			
			$(document).find('.upload_video_mp4').closest('.fields').hide();
            $(document).find('.upload_video_button_mp4').closest('.fields').hide();
            $(document).find('.upload_video_webm').closest('.fields').hide();
            $(document).find('.upload_video_button_webm').closest('.fields').hide();
			$(document).find('.overlaycolor').closest('.fields').show();
			$(document).find('.bottomshadow').closest('.fields').show();

		} else {  		// video
			$(document).find('.bg-color').closest('.fields').hide();
			$(document).find('.bottomshadow').closest('.fields').hide();

			$(document).find('.upload_image').closest('.fields').show();
            $(document).find('.upload_image_button').closest('.fields').show();
			$(document).find('.upload_video_mp4').closest('.fields').show();
            $(document).find('.upload_video_button_mp4').closest('.fields').show();
            $(document).find('.upload_video_webm').closest('.fields').show();
            $(document).find('.upload_video_button_webm').closest('.fields').show();
			$(document).find('.overlaycolor').closest('.fields').show();
		}
	});

	// Header color change show / hide options
	$(document).on('change', '.header-color-change', function() {
		var val = $(this).val();
		if (val == 'enable') {
			$(document).find('.header-color').closest('.fields').show();
		} else {
			$(document).find('.header-color').closest('.fields').hide();
		}
	});

	// Popover enable/disable color show / hide options
	$(document).on('click', '.popover-color', function() {
		var val = $(this).val();	
		if (val == 'enable') {
			$(document).find('.popover-titlecolor').closest('.fields').show();
			$(document).find('.popover-titlebgcolor').closest('.fields').show();
			$(document).find('.popover-fontcolor').closest('.fields').show();
			$(document).find('.popover-bgcolor').closest('.fields').show();
			$(document).find('.popover-bordercolor').closest('.fields').show();
		} else {
			$(document).find('.popover-titlecolor').closest('.fields').hide();
            $(document).find('.popover-titlebgcolor').closest('.fields').hide();
            $(document).find('.popover-fontcolor').closest('.fields').hide();
            $(document).find('.popover-bgcolor').closest('.fields').hide();
            $(document).find('.popover-bordercolor').closest('.fields').hide();
		}

	});
	
	// Image Frame Action selection
	$(document).on('change', '.imageframe-action', function() {
		var val = $(this).val();
		if (val == 'url') {
			$(document).find('.imageframe-hover').closest('.fields').show();
			$(document).find('.imageframe-title').closest('.fields').show();
			$(document).find('.imageframe-url').closest('.fields').show();
		} else if (val == 'fancybox') {
			$(document).find('.imageframe-hover').closest('.fields').show();
            $(document).find('.imageframe-title').closest('.fields').show();
            $(document).find('.imageframe-url').closest('.fields').hide();
		} else {
			$(document).find('.imageframe-hover').closest('.fields').hide();
            $(document).find('.imageframe-title').closest('.fields').hide();
            $(document).find('.imageframe-url').closest('.fields').hide();
		}
	});

	// Circle chart action selection
	$(document).on('click', '.circle-icon-enable', function() {
		var val = $(this).val();
		if (val == 'enable') {
			var iconset = $(document).find('input[name=iconset]:checked').val();
        	if (iconset == 'fontawesome') {
            	$(document).find('.font-awesome-select').show();
        	} else if (iconset == 'linear') {
            	$(document).find('.linear-select').show();
        	} else if (iconset == 'ion') {
            	$(document).find('.ion-select').show();
        	}
			$(document).find('.circle-iconcolor').closest('.fields').show();
			$(document).find('.circle-iconset').closest('.fields').show();
		} else {
			$(document).find('.circle-iconset').closest('.fields').hide();
			$(document).find('.circle-iconcolor').closest('.fields').hide();
        	$(document).find('.selectBox').closest('.fields').hide();
		}
	});		

	// Circle chart icon select change
    $(document).on('change', '.circle-iconset', function() {
        $(document).find('.selectBox').closest('.fields').hide();  // hide all initially
        var iconset = $(document).find('input[name=iconset]:checked').val();
        if (iconset == 'fontawesome') {
            $(document).find('.font-awesome-select').show();
        } else if (iconset == 'linear') {
            $(document).find('.linear-select').show();
        } else if (iconset == 'ion') {
            $(document).find('.ion-select').show();
        }
    });

	// Milestone icon select change
    $(document).on('change', '.mile-iconset', function() {
        $(document).find('.selectBox').closest('.fields').hide();  // hide all initially
        var iconset = $(document).find('input[name=iconset]:checked').val();
        if (iconset == 'fontawesome') {
            $(document).find('.font-awesome-select').show();
        } else if (iconset == 'linear') {
            $(document).find('.linear-select').show();
        } else if (iconset == 'ion') {
            $(document).find('.ion-select').show();
        }
    });

	// Modal options display
	$(document).on('change', '.modal-openready', function() {
		var val = $(this).val();
		if (val == 'disable') {
			$(document).find('.modal-buttontext').closest('.fields').show();
			$(document).find('.modal-buttoncolor').closest('.fields').show();
			$(document).find('.modal-buttonborder').closest('.fields').show();
			$(document).find('.modal-buttontextcolor').closest('.fields').show();
			$(document).find('.modal-buttonborderwidth').closest('.fields').show();
			$(document).find('.modal-buttonborderradius').closest('.fields').show();
		} else {
			$(document).find('.modal-buttontext').closest('.fields').hide();
            $(document).find('.modal-buttoncolor').closest('.fields').hide();
            $(document).find('.modal-buttonborder').closest('.fields').hide();
            $(document).find('.modal-buttontextcolor').closest('.fields').hide();
            $(document).find('.modal-buttonborderwidth').closest('.fields').hide();
            $(document).find('.modal-buttonborderradius').closest('.fields').hide();
		}
	});

	// Map options display
	$(document).on('change', '.gmap-fullwidth', function() {
		var val = $(this).val();
		if (val == 'true') {
			$(document).find('.gmap-width').closest('.fields').hide();
		} else {
			$(document).find('.gmap-width').closest('.fields').show();
		}
	});

	$(document).on('change', '.gmap-changemap', function() {
		var val = $(this).val();
		if (val == 'true') {
			$(document).find('.gmap-mapcolor').closest('.fields').show();
			$(document).find('.gmap-saturation').closest('.fields').show();
			$(document).find('.gmap-lightness').closest('.fields').show();
		} else {
			$(document).find('.gmap-mapcolor').closest('.fields').hide();
			$(document).find('.gmap-saturation').closest('.fields').hide();
            $(document).find('.gmap-lightness').closest('.fields').hide();
		}
	});

	// Social Icons options display
	$(document).on('change', '.si-framed', function() {
		var val = $(this).val();
		if (val == 'true') {
			$(document).find('.si-bgcolor').closest('.fields').show();
			$(document).find('.si-radius').closest('.fields').show();
		} else {
			$(document).find('.si-bgcolor').closest('.fields').hide();
            $(document).find('.si-radius').closest('.fields').hide();
		}
	});

	// Font Awesome select list
	function font_awesome_select(results) {
		var select_list = '<div class="fields font-awesome-select">'
                + '<div class="sc-label"><?php echo __('Select Font Awesome Icon:', 'shshortc');?></div>'
                + '<div class="sc-option"><div class="selectBox">'
                + '<span class="selected"></span>'
                + '<span class="selectArrow">&#9660</span>'
                + '<div class="selectOptions">'
                + '<span class="searchOptions">'
				+ '<input class="searchOptionsLive" placeholder="<?php echo __('Search', 'shshortc');?>" />'
				+ '</span>';
        $.each(results.font_awesome, function(i, item) {
            select_list += '<span class="selectOption" value="' + item + '"><i class="fa ' + item + '"></i> ' + item + '</span>';
        });

        select_list += '</div></div> </div></div>';
		return select_list;
	};

	// Linear Icon select list
	function linear_select(results) {
		var select_list = '<div class="fields linear-select" style="display:none;">'
                + '<div class="sc-label"><?php echo __('Select Linearicon:', 'shshortc');?></div>'
                + '<div class="sc-option"><div class="selectBox">'
                + '<span class="selected"></span>'
                + '<span class="selectArrow">&#9660</span>'
                + '<div class="selectOptions">'
                + '<span class="searchOptions">'
                + '<input class="searchOptionsLive" placeholder="<?php echo __('Search', 'shshortc');?>" />'
                + '</span>';
        $.each(results.linear_icons, function(i, item) {
            select_list += '<span class="selectOption" value="' + item + '"><i class="' + item + '"></i> ' + item + '</span>';
        });

        select_list += '</div></div> </div></div>';
        return select_list;
    };

	// Ion Icon select list
	function ion_select(results) {
		var select_list = '<div class="fields ion-select" style="display:none;">'
                + '<div class="sc-label"><?php echo __('Select Ionicon:', 'shshortc');?></div>'
                + '<div class="sc-option"><div class="selectBox">'
                + '<span class="selected"></span>'
                + '<span class="selectArrow">&#9660</span>'
                + '<div class="selectOptions">'
                + '<span class="searchOptions">'
                + '<input class="searchOptionsLive" placeholder="<?php echo __('Search', 'shshortc');?>" />'
                + '</span>';
        $.each(results.ion_icons, function(i, item) {
            select_list += '<span class="selectOption" value="' + item + '"><i class="' + item + '"></i> ' + item + '</span>';
        });

        select_list += '</div></div> </div></div>';
        return select_list;
    };

});
</script>

</body>
</html>

<?php

/* Shortcode options */
function scChoices() {
    $choices = array (
		array (
			'name' => __('--Select--', 'shshortc'), 
			'value' => '',
		),
		array (
            'name' => __('Accordion', 'shshortc'),
            'value' => 'accordion'
        ),
		array ( 
			'name' => __('Alert Messages', 'shshortc'),
			'value' => 'alertmsg'
		),
		array (
			'name' => __('Anchor Link', 'shshortc'),
			'value' => 'anchor'
		),
		array (
            'name' => __('Animate', 'shshortc'),
            'value' => 'animate'
        ),
		array (
            'name' => __('Block Quote', 'shshortc'),
            'value' => 'quote',
        ),
        array (
            'name' => __('Block Quote Style 2', 'shshortc'),
            'value' => 'quote2',
        ),
		array ( 
			'name' => __('Button', 'shshortc'),
            'value' => 'button',
        ),
		array (
			'name' => __('Callout Box', 'shshortc'),
			'value' => 'callout'
		),
		array (
            'name' => __('Circle Chart', 'shshortc'),
            'value' => 'circlechart'
        ),
        array (
            'name' => __('Centered Content', 'shshortc'),
            'value' => 'center'
        ),
		array (
            'name' => __('Color Background Section', 'shshortc'),
            'value' => 'colorbg'
        ),
		array (
            'name' => __('Columns', 'shshortc'),
            'value' => 'columns',
        ),
        array (
            'name' => __('Contact Form', 'shshortc'),
            'value' => 'contact',
        ),
		array (
			'name' => __('Content Box', 'shshortc'),
			'value' => 'contentbox'
		),
		array (
            'name' => __('Countdown', 'shshortc'),
            'value' => 'countdown'
        ),
		array (
            'name' => __('Dividers', 'shshortc'),
            'value' => 'divider'
        ),
		array (
            'name' => __('Dropcap', 'shshortc'),
            'value' => 'dropcap',
        ),
		array ( 
			'name' => __('Google Docs', 'shshortc'),
			'value' => 'gdoc',
		),
		array (
            'name' => __('Google Map', 'shshortc'),
            'value' => 'gmap'
        ),
		array (
            'name' => __('Header Styled', 'shshortc'),
            'value' => 'headers'
        ),
        array (
            'name' => __('Header Double Bar', 'shshortc'),
            'value' => 'headersdouble'
        ),
		array (
            'name' => __('Highlight', 'shshortc'),
            'value' => 'highlight',
        ),
		array (
            'name' => __('Icons', 'shshortc'),     // Font Awesome, Linear, and Ion fonts now
            'value' => 'fontawesome',
        ),

		array ( 
			'name' => __('Image Background Section', 'shshortc'),
			'value' => 'imagebg'
		),
        array (
            'name' => __('Image Frame', 'shshortc'),
            'value' => 'imageframe',
        ),
		array (
            'name' => __('Latest Posts', 'shshortc'),
            'value' => 'bloggrid'
        ),
		array (
            'name' => __('Lists', 'shshortc'),
            'value' => 'checklist'
        ),
		array (
            'name' => __('Milestone', 'shshortc'),
            'value' => 'milestone'
        ),
		array (
			'name' => __('Modal', 'shshortc'),
			'value' => 'modal'
		),
		array (
            'name' => __('Parallax, Solid & Video Section', 'shshortc'),
            'value' => 'parallax'
        ),
		array (
            'name' => __('People', 'shshortc'),
            'value' => 'people'
        ),
		array (
            'name' => __('Popover', 'shshortc'),
            'value' => 'popover'
        ),
		array (
			'name' => __('Portfolio Grid', 'shshortc'),
			'value' => 'portfoliogrid'
		),
		array (
            'name' => __('Price Table', 'shshortc'),
            'value' => 'pricetable',
        ),
		array (
			'name' => __('Progress Bar', 'shshortc'),
			'value' => 'progressbar'
		),
		array (
            'name' => __('Pullquote', 'shshortc'),
            'value' => 'pullquote'
        ),
		array (
            'name' => __('Sitemap', 'shshortc'),
            'value' => 'sitemap'
        ),
		array (
            'name' => __('Social Icons', 'shshortc'),
            'value' => 'socialicon'
        ),
        array (
            'name' => __('SoundCloud', 'shshortc'),
            'value' => 'soundcloud'
        ),
		array (
			'name' => __('Table', 'shshortc'),
			'value' => 'table',
		),
		array(
            'name' => __('Testimonial', 'shshortc'),
            'value' => 'testimonial'
        ),
        array(
            'name' => __('Testimonial Carousel', 'shshortc'),
            'value' => 'testimonialc'
        ),
		array ( 
			'name' => __('Tooltip', 'shshortc'),
			'value' => 'tooltip'
		),
		array (
			'name' => __("Video", "shshortc"),
			'value' => 'video'
		),
    );
    return $choices;
}
?>
