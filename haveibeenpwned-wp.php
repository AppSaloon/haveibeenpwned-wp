<?php
/*
Plugin Name: Have I Been Pwned WP
Plugin URI:
Description: Help your users and administrators prevent using passwords that were exposed in data breaches, by testing them on the Have I Been Pwned database.
Version: 1.0.0
Author: AppSaloon - Koen
Author URI: https://www.appsaloon.be/
License: GPL3
*/

namespace hibpwp;

use hibpwp\lib\Container;
use hibpwp\lib\Container_Interface;

define( 'HIBPWP_DIR', plugin_dir_path( __FILE__ ) );
define( 'HIBPWP_URL', plugin_dir_url( __FILE__ ) );
define( 'HIBPWP_VERSION', '1.0.0' );
define( 'HIBPWP_FILE', __FILE__ );

/**
 * Register autoloader to load files/classes dynamically
 */
include_once HIBPWP_DIR . 'lib/autoloader.php';

/**
 * Load composer/PHP-DI container
 *
 * FYI vendor files are moved from /vendor to /lib/ioc/ directory
 *
 * "php-di/php-di": "5.0"
 */
include_once HIBPWP_DIR . 'lib/ioc/autoload.php';

class Hibpwp_Bootstrap {

	/**
	 * Plugin_Boilerplate constructor.
	 *
	 * @param Container_Interface $container
	 */
	public function __construct( Container_Interface $container ) {
		$container->container->get( 'init_config' );
	}
}

new Hibpwp_Bootstrap( Container::getInstance() );