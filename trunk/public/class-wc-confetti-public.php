<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://eguler.net
 * @since      1.0.0
 *
 * @package    Wc_Confetti
 * @subpackage Wc_Confetti/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wc_Confetti
 * @subpackage Wc_Confetti/public
 * @author     Emre Güler <iletisim@eguler.net>
 */
class Wc_Confetti_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-confetti-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( 'confetti-js', plugin_dir_url( __FILE__ ) . 'js/confetti.min.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-confetti-public.js', array( 'jquery', 'confetti-js' ), $this->version, false );
		$wccamount 		= get_option('wcc_amount','100');
		$wccdelay 		= get_option('wcc_delay','0');
		$wccduration 	= get_option('wcc_duration','3000');
		$wcctext 		= get_option('wcc_text', __('FREE SHIPPING','wc-confetti'));
		$wccfont 		= get_option('wcc_font','Arial');
		$wccsize 		= get_option('wcc_size','5vw');
		$wcccolor 		= get_option('wcc_color','#000000');
		$wccbg 			= get_option('wcc_bg','transparent');
		$wccpad 		= get_option('wcc_pad','0');
		$wccborder 		= get_option('wcc_border','0');
		$wccblur 		= get_option('wcc_blur','0');
		$arr 			= array(
		    'ajaxurl' 	=> admin_url('admin-ajax.php'),
		    'amount' 	=> $wccamount,
		    'delay' 	=> $wccdelay,
		    'duration' 	=> $wccduration,
		    'text' 		=> $wcctext,
		    'font' 		=> $wccfont,
		    'size' 		=> $wccsize,
		    'color' 	=> $wcccolor,
		    'bg' 		=> $wccbg,
		    'pad' 		=> $wccpad,
		    'border' 	=> $wccborder,
		    'blur' 		=> $wccblur
		);
		wp_localize_script($this->plugin_name,'confettiCookie',$arr);
		wp_enqueue_script($this->plugin_name);

	}

	/**
	 * Cart Check
	 *
	 * @since	1.0.0
	 */
	public function wc_confetti_cart_check() {
	    $cartTotal = WC()->cart->get_cart_contents_total();
	    echo (int) $cartTotal;
	    wp_die();
	}

}
