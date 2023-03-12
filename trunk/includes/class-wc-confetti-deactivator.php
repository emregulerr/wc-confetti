<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://eguler.net
 * @since      1.0.0
 *
 * @package    Wc_Confetti
 * @subpackage Wc_Confetti/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wc_Confetti
 * @subpackage Wc_Confetti/includes
 * @author     Emre Güler <iletisim@eguler.net>
 */
class Wc_Confetti_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
        delete_option('wcc_amount');
        delete_option('wcc_delay');
        delete_option('wcc_duration');
        delete_option('wcc_text');
        delete_option('wcc_font');
        delete_option('wcc_size');
        delete_option('wcc_color');
        delete_option('wcc_bg');
        delete_option('wcc_pad');
        delete_option('wcc_border');
        delete_option('wcc_blur');
	}

}
