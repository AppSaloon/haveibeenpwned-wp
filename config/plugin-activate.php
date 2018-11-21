<?php

namespace hibpwp\config;

use hibpwp\lib\Container;

class Plugin_Activate {

	/**
	 * Runs when the plugin is activated
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		register_activation_hook( HIBPWP_FILE, array( $this, 'activation' ) );
	}

	/**
	 * Actions to execute on activation
	 *
	 * @since 1.0.0
	 */
	public function activation() {

		$this->create_log_table();
	}

	/**
	 * Creates log table
	 *
	 * @throws \DI\DependencyException
	 * @throws \DI\NotFoundException
	 *
	 * @since 1.0.0
	 */
	public function create_log_table() {
		$container = Container::getInstance();

		/**
		 * @var \hibpwp\controller\log\Database_Log_Controller
		 */
		$log = $container->container->get( 'Log_Controller_Interface' );

		$log->create_log_table();
	}
}