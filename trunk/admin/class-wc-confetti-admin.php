<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://eguler.net
 * @since      1.0.0
 *
 * @package    Wc_Confetti
 * @subpackage Wc_Confetti/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wc_Confetti
 * @subpackage Wc_Confetti/admin
 * @author     Emre Güler <iletisim@eguler.net>
 */
class Wc_Confetti_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Confetti_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Confetti_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-confetti-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Confetti_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Confetti_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-confetti-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Plugin Admin Page
	 *
	 * @since	1.0.0
	 */
	public function wc_confetti_admin_panel(){
        if(isset($_POST["action"]) && $_POST["action"]=="update"){
            if (!isset($_POST['wcc_update']) || ! wp_verify_nonce( $_POST['wcc_update'], 'wcc_update' ) ) {
                print __('Sorry, you are not authorized to access this page!', 'wc-confetti');
                exit;
            }else{
                $wccamount 		= sanitize_text_field($_POST['wcc_amount']);
                $wccdelay 		= sanitize_text_field($_POST['wcc_delay']);
                $wccduration 	= sanitize_text_field($_POST['wcc_duration']);
                $wcctext 		= sanitize_text_field($_POST['wcc_text']);
                $wccfont 		= sanitize_text_field($_POST['wcc_font']);
                $wccsize 		= sanitize_text_field($_POST['wcc_size']);
                $wcccolor 		= sanitize_hex_color($_POST['wcc_color']);
                $wccbg 			= sanitize_text_field($_POST['wcc_bg']);
                $wccpad 		= sanitize_text_field($_POST['wcc_pad']);
                $wccborder 		= sanitize_text_field($_POST['wcc_border']);
                $wccblur 		= sanitize_text_field($_POST['wcc_blur']);
                update_option( 'wcc_amount'		, (int) $wccamount);
                update_option( 'wcc_delay'		, (int) $wccdelay);
                update_option( 'wcc_duration'	, (int) $wccduration);
                update_option( 'wcc_text'		, $wcctext);
                update_option( 'wcc_font'		, $wccfont);
                update_option( 'wcc_size'		, $wccsize);
                update_option( 'wcc_color'		, $wcccolor);
                update_option( 'wcc_bg'			, $wccbg);
                update_option( 'wcc_pad'		, $wccpad);
                update_option( 'wcc_border'		, $wccborder);
                update_option( 'wcc_blur'		, (bool) $wccblur);

                echo '<div class="updated"><p><strong>';
                _e('Settings saved.', 'wc-confetti');
                echo '</strong></p></div>';
            }
        }
        echo '
        <h1>'.__('Confetti for WooCommerce', 'wc-confetti').'</h1>
        <form method="post">
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="wcc_amount">'.__('Cart Amount','wc-confetti').'</label></th>
                <td><input id="wcc_amount" type="number" min="0" name="wcc_amount" value="'.stripslashes(get_option("wcc_amount")).'"><p class="description" id="wcc-amount-description">'.__('Minimum Cart Amount for confetti rain (default = 100)','wc-confetti').'</p></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wcc_delay">'.__('Delay Time','wc-confetti').'</label></th>
                <td><input id="wcc_delay" type="number" min="0" name="wcc_delay" value="'.stripslashes(get_option("wcc_delay")).'"><p class="description" id="wcc-delay-description">'.__('Time to wait before confetti rain, in milliseconds (1000 milliseconds = 1 second, default = 0)','wc-confetti').'</p></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wcc_duration">'.__('Rainfall Duration','wc-confetti').'</label></th>
                <td><input id="wcc_duration" type="number" min="0" name="wcc_duration" value="'.stripslashes(get_option("wcc_duration")).'"><p class="description" id="wcc-duration-description">'.__('Confetti Rainfall Duration in milliseconds (1000 milliseconds = 1 second, default = 3000)','wc-confetti').'</p></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wcc_text">'.__('Celebration Letter','wc-confetti').'</label></th>
                <td><input id="wcc_text" type="text" name="wcc_text" value="'.stripslashes(get_option("wcc_text")).'"><p class="description" id="wcc-text-description">'.sprintf(__('(default = %s)','wc-confetti'),__('FREE SHIPPING', 'wc-confetti')).'</p></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wcc_font">'.__('Font Family','wc-confetti').'</label></th>
                <td><input id="wcc_font" type="text" name="wcc_font" value="'.stripslashes(get_option("wcc_font")).'"><p class="description" id="wcc-font-description">'.sprintf(__("Must be selected from %1\$sweb-safe fonts%2\$s (default = Arial)", 'wc-confetti'), '<a href="https://www.w3schools.com/cssref/css_websafe_fonts.php" target="_blank">', '</a>').'</p></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wcc_size">'.__('Font Size','wc-confetti').'</label></th>
                <td><input id="wcc_size" type="text" name="wcc_size" value="'.stripslashes(get_option("wcc_size")).'"><p class="description" id="wcc-size-description">'.sprintf(__('(default = %s)','wc-confetti'),'5vw').'</p></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wcc_color">'.__('Font Color','wc-confetti').'</label></th>
                <td><input id="wcc_color" type="text" name="wcc_color" value="'.stripslashes(get_option("wcc_color")).'"><p class="description" id="wcc-color-description">'.sprintf(__('(default = %s)','wc-confetti'),'#000000').'</p></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wcc_bg">'.__('Text Container Background','wc-confetti').'</label></th>
                <td><input id="wcc_bg" type="text" name="wcc_bg" value="'.stripslashes(get_option("wcc_bg")).'"><p class="description" id="wcc-bg-description">'.sprintf(__('(default = %s)','wc-confetti'),'transparent').'</p></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wcc_pad">'.__('Text Container Padding','wc-confetti').'</label></th>
                <td><input id="wcc_pad" type="text" name="wcc_pad" value="'.stripslashes(get_option("wcc_pad")).'"><p class="description" id="wcc-pad-description">'.sprintf(__('(default = %s)','wc-confetti'),'0').'</p></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wcc_border">'.__('Text Container Border','wc-confetti').'</label></th>
                <td><input id="wcc_border" type="text" name="wcc_border" value="'.stripslashes(get_option("wcc_border")).'"><p class="description" id="wcc-border-description">'.sprintf(__('(default = %s)','wc-confetti'),'0').'</p></td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="wcc_blur">'.__('Blur Background','wc-confetti').'</label></th>
                <td><input id="wcc_blur" type="checkbox" name="wcc_blur"'.((stripslashes(get_option("wcc_blur"))) ? ' checked' : '').'></td>
            </tr>'.wp_nonce_field('wcc_update','wcc_update').'
        <input type="hidden" name="action" value="update">
        <tr valign="top">
            <th scope="row"></th>
            <td><input type="submit" class="button button-primary" value="'.__('Save Changes','wc-confetti').'"></td>
        </tr>
        </table>
        </form>';
    }

	/**
	 * Plugin Admin Menu
	 *
	 * @since	1.0.0
	 */
	public function wc_confetti_admin_menu() {
        add_submenu_page( 'woocommerce', __('Confetti for WooCommerce', 'wc-confetti'),  __('Confetti for WooCommerce', 'wc-confetti'), 'manage_options', 'wc-confetti-settings', array($this, 'wc_confetti_admin_panel') );
    }

}
