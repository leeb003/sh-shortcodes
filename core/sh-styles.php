<?php
/*
 * Get supporting files
 */

class shStyles {

	public function __construct() {
        add_action('wp_enqueue_scripts', array(&$this, 'sh_shortcode_files'));

		// scripts for grid and isotope items
		add_action('init', array(&$this, 'register_footer_scripts') );
		add_action('wp_footer', array(&$this, 'print_footer_scripts') );

		// contact form handled through admin
        // contact form init
        // creating Ajax call for WordPress  
        add_action( 'wp_ajax_nopriv_handle_contact_form', array($this, 'handle_contact_form') );
        add_action( 'wp_ajax_handle_contact_form', array($this, 'handle_contact_form') );

    }

	public function sh_shortcode_files() {
		// include variables for menu and side location
		global $shcreate;
		if (is_page_template()) {
            $sh_template = basename ( get_post_meta( get_the_id(), '_wp_page_template', true ) );
        } else {
            $sh_template = '';
        }
		wp_register_script( 'sh-js', SH_ROOT_URL . '/js/sh-shortcodes.min.js', array( 'jquery' ), '', true );
        wp_enqueue_script( 'sh-js' );
		wp_localize_script(  'sh-js', 'theme_globals', array(
			'themeMenu' => $shcreate['top-side-menu'],
			'sideMenuSide' => $shcreate['side-menu-location'],
			'themeTemplate' => $sh_template,
			'sh_adminUrl' => admin_url(),
        ));
		wp_register_style('sh-shortcodes-css', SH_ROOT_URL . '/css/sh-shortcodes.min.css' );
		wp_enqueue_style('sh-shortcodes-css');

		wp_deregister_style('font-awesome');
		wp_dequeue_style('font-awesome');
		wp_register_style('font-awesome', SH_ROOT_URL . '/css/font-awesome/css/font-awesome.min.css', '4.3.0', '' );
        wp_enqueue_style('font-awesome');

		wp_register_style('animate', SH_ROOT_URL . '/css/animate.min.css' );
		wp_enqueue_style('animate');
		// register waypoints
        wp_enqueue_script( 'waypoints', SH_ROOT_URL. '/js/waypoints.min.js', array('jquery'), false, true );
        wp_enqueue_script( 'waypoints-sticky', SH_ROOT_URL. '/js/waypoints-sticky.min.js', array('jquery'), false, true );
		// register fancybox
		wp_enqueue_script('fancybox', SH_ROOT_URL. '/js/fancybox/jquery.fancybox.min.js', array( 'jquery'), '2.1.5', true );
        //wp_enqueue_script('fancybox-media', SH_ROOT_URL . '/js/fancybox/helpers/jquery.fancybox-media.min.js', array( 'fancybox'), null, true );  // not needed now for images only
        wp_enqueue_style('fancybox-style', SH_ROOT_URL . '/css/jquery.fancybox.css', '');
		// circliful - circle charts
		wp_enqueue_script( 'circliful', SH_ROOT_URL . '/js/jquery.circliful.min.js', array('jquery'), false, true);
		// google maps - no http or https set so page decides
		$gmap_key = '';
        if (isset($shcreate['google-map-key'])) {
            $gmap_key = '?key=' . $shcreate['google-map-key'];
        }
        wp_enqueue_script('googlemaps', '//maps.googleapis.com/maps/api/js' . $gmap_key, false, null, true);
		// google maps infobox
		wp_enqueue_script( 'infobox', SH_ROOT_URL . '/js/infobox_packed.js', array('jquery'), false, true);
		// Bootstrap 3 - we include in shortcodes for other themes
        wp_enqueue_script( 'bootstrap', get_template_directory_uri()
           . '/js/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '3.2.0', true );
		// Bootstrap style
		wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/js/bootstrap/css/bootstrap.min.css' );
	}

	public function register_footer_scripts() {
		wp_register_script('isotope', SH_ROOT_URL . '/js/isotope.pkgd.min.js', false, null, true);
		wp_register_script('imagesLoaded', SH_ROOT_URL . '/js/imagesloaded.pkgd.min.js', false, null, true);
		wp_register_script('fancybox-media', SH_ROOT_URL . '/js/fancybox/helpers/jquery.fancybox-media.min.js', 
				array( 'fancybox'), null, true );
	}

	public function print_footer_scripts() {
		global $grid_needed;
		global $fancy_media;
		if (true == $grid_needed) {
			wp_print_scripts('isotope');
			wp_print_scripts('imagesLoaded');
		}
		if (true == $fancy_media) {
			wp_print_scripts('fancybox-media');
		}
	}

	/* This is the form handler for the contact form.
     * It uses wp_mail for recieving email
     */
    public function handle_contact_form() {
        $emailTo = get_option('admin_email');
        $jsonData = array();
        // Clean and convert post vars for html
        foreach ($_POST as $key => $value) {
            $key        = trim(htmlentities($key));
            $value      = trim(htmlentities($value));
            $post[$key] = $value;
        }
        //$name    = $post['name'];
        //$email   = $post['email'];
        //$message = $post['message'];

		/* Using esc_attr instead to allow other characters, email filtered below  */
		$name    = esc_attr($_POST['name']);
		$email   = $_POST['email'];
		$message = esc_attr($_POST['message']);

		if (isset($post['newemail'])) {
			// unencode email
			$newemail = base64_decode($post['newemail']);
		} 
        if ($name == '') {
            $jsonData['ok'] = 'false';
            $jsonData['field'] = 'name';
			$jsonData['message'] = __('Please enter your Name', 'shshortc');
        } elseif ($email == '') {
            $jsonData['ok'] = 'false';
            $jsonData['field'] = 'email';
			$jsonData['message'] = __('Please enter your Email', 'shshortc');
        } elseif ($message == '') {
            $jsonData['ok'] = 'false';
            $jsonData['field'] = 'message';
			$jsonData['message'] = __('Please enter your Message', 'shshortc');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $jsonData['ok'] = 'false';
            $jsonData['message'] = __('You entered an <span class="error-text">invalid</span> email address.', 'shshortc');
            $jsonData['field'] = 'email';
        } else {    // Send the email
			if (isset($newemail) && filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
				$emailTo = $newemail;
			} else {
            	$emailTo = get_option('admin_email');
			}
            $subject = __('Website Contact From ', 'shshortc') . $name;
            $body = __("Name: ", "shshortc") . $name . "\n\n" . __("Email: ", "shshortc") . $email 
				. "\n\n" . __("Message: ","shshortc") . $message;
            $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

            wp_mail($emailTo, $subject, $body, $headers);

            $jsonData['ok'] = 'true';
			$jsonData['message'] = __('Your message has been sent, Thank you!', 'shshortc');
        }
        die(json_encode($jsonData));
    }

}
