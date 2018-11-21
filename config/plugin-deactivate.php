<?php

namespace hibpwp\config;

class Plugin_Deactivate {

	/**
	 * Runs when the plugin is disabled.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		register_deactivation_hook( HIBPWP_FILE, array( $this, 'deactive' ) );
	}

	/**
	 * Remove the cron job event
	 *
	 * @since 1.0.0
	 */
	public function deactive() {
		wp_clear_scheduled_hook( 'hibpwp_scan_passwords' );

		wp_clear_scheduled_hook( 'clear_hibpwp_log' );
	}
}