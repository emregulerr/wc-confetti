<?php

/**
 * Fired during plugin activation
 *
 * @link       https://eguler.net
 * @since      1.0.0
 *
 * @package    Wc_Confetti
 * @subpackage Wc_Confetti/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wc_Confetti
 * @subpackage Wc_Confetti/includes
 * @author     Emre Güler <iletisim@eguler.net>
 */
class Wc_Confetti_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
        add_option('wcc_amount', '100');
        add_option('wcc_delay', '0');
        add_option('wcc_duration', '3000');
        add_option('wcc_text', __('FREE SHIPPING','wc-confetti'));
        add_option('wcc_font', 'Arial');
        add_option('wcc_size', '5vw');
        add_option('wcc_color', '#000000');
        add_option('wcc_bg', 'transparent');
        add_option('wcc_pad', '0');
        add_option('wcc_border', '0');
        add_option('wcc_blur', '0');
	}

}
