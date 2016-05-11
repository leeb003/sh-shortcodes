<?php
/* 
 * Registers the shortcode button with tinymce and includes js
 */

class Admin_Shortcodes {

    public function __construct(){

        add_action('init', array(&$this, 'shortcode_buttons'));
		add_action('admin_enqueue_scripts', array(&$this, 'sh_enqueue') );
		// wp_ajax naming must match...format "wp_ajax_$youraction", where $youraction is your AJAX request's 'action' property.
		add_action('wp_ajax_font_awesome', array(&$this, 'font_awesome_callback') );
		add_action('wp_ajax_all_icons', array(&$this, 'all_icons_callback') );
		
		// add url to javascript in head
		add_action( 'admin_head', array(&$this, 'url_variable') );
    }

	public function url_variable() {
		echo '<script type="text/javascript">
			var shInstallURL="' .  get_site_url() . '";
			</script>';
	}

    public function shortcode_buttons() {
        add_filter( "mce_external_plugins", array(&$this, "shortcodes_add_buttons") );
        add_filter( 'mce_buttons', array(&$this, 'shortcodes_register_buttons') );
    }
    public function shortcodes_add_buttons( $plugin_array ) {
		$plugin_array['shortcodes'] = SH_ROOT_URL.'/js/mcev4/sh-mce.js';
        return $plugin_array;
    }
    public function shortcodes_register_buttons( $buttons ) {
        array_push( $buttons, 'shortcodes'); // you can add more buttons if needed
        return $buttons;
    }

	public function sh_enqueue($hook) {
		global $shcreate;
		wp_enqueue_script( 'ajax-script', plugins_url( '/../js/sh-fa-ajax.js', __FILE__), array('jquery'), '', true );
		wp_localize_script( 'ajax-script', 'ajax_object', 
				array( 'ajax_url' => admin_url( 'admin-ajax.php' ), '' ) );

		// Admin styles
		wp_register_style( 'sh-admin-style', plugins_url( '/../css/sh-admin.css', __FILE__));
        wp_enqueue_style( 'sh-admin-style' );

		wp_deregister_style('font-awesome');
        wp_dequeue_style('font-awesome');
        wp_register_style('font-awesome', SH_ROOT_URL . '/css/font-awesome/css/font-awesome.min.css', '4.3.0', '' );
        wp_enqueue_style('font-awesome');

		// linearicons
        if (isset($shcreate['linear-icons']) && $shcreate['linear-icons'] ) {  
            wp_enqueue_style( 'linearicons', get_template_directory_uri() . '/css/linear-icons/style.css', '1.0');
        }
        // ionicons
        if (isset($shcreate['ion-icons']) && $shcreate['ion-icons'] ) {
            wp_enqueue_style('ionicons', get_template_directory_uri() . '/css/ionicons/css/ionicons.min.css', '2.0.0');
        }

		// Color Picker (Spectrum)
		wp_enqueue_script('spectrum', plugins_url( '/../js/spectrum.js', __FILE__));
		// css is called in iframe window, but appears we need it here too
		wp_register_style('spectrumcss', plugins_url( '/../css/spectrum.css', __FILE__));
		wp_enqueue_style('spectrumcss');
	}

	public function font_awesome_callback() {
		require_once SH_ROOT_PATH.'/core/font-awesome-icons.php';
		$icons = fa_font_icons();
		header('Content-Type: application/json');
		echo json_encode($icons);
		die();
	}

	/* Get a list of all icon sets */
	public function all_icons_callback() {
		require_once SH_ROOT_PATH.'/core/all-icons.php';
        $icons = all_icons();
        header('Content-Type: application/json');
        echo json_encode($icons);
        die();
    }


}
