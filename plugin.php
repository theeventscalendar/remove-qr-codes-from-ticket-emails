<?php
/**
 * Plugin Name: The Events Calendar Extension: Remove QR Codes from Ticket Emails
 * Description: Remove QR codes from ticket emails.
 * Version: 1.0.0
 * Author: Modern Tribe, Inc.
 * Author URI: http://m.tri.be/1971
 * License: GPLv2 or later
 */

defined( 'WPINC' ) or die;

class Tribe__Extension__Remove_QR_Codes_from_Ticket_Emails {

    /**
     * The semantic version number of this extension; should always match the plugin header.
     */
    const VERSION = '1.0.0';

    /**
     * Each plugin required by this extension
     *
     * @var array Plugins are listed in 'main class' => 'minimum version #' format
     */
    public $plugins_required = array(
        'Tribe__Tickets__Main'      => '4.2',
        'Tribe__Tickets_Plus__Main' => '4.2'
    );

    /**
     * The constructor; delays initializing the extension until all other plugins are loaded.
     */
    public function __construct() {
        add_action( 'plugins_loaded', array( $this, 'init' ), 100 );
    }

    /**
     * Extension hooks and initialization; exits if the extension is not authorized by Tribe Common to run.
     */
    public function init() {

        // Exit early if our framework is saying this extension should not run.
        if ( ! function_exists( 'tribe_register_plugin' ) || ! tribe_register_plugin( __FILE__, __CLASS__, self::VERSION, $this->plugins_required ) ) {
            return;
        }

        add_action( 'init', array( $this, 'remove_qr', 10 );
    }

    /**
     * Remove QR code from the bottom of ticket emails.
     */
    public function remove_qr() {

        $qr_class = Tribe__Tickets_Plus__Main::instance()->qr();

        remove_action( 'tribe_tickets_ticket_email_ticket_bottom', array( $qr_class, 'inject_qr' ) );
    }
}

new Tribe__Extension__Remove_QR_Codes_from_Ticket_Emails();
