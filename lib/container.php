<?php

namespace hibpwp\lib;

use \DI;
use \DI\ContainerBuilder;

Final class Container implements Container_Interface {

	/**
	 * @var \DI\ContainerBuilder
	 */
	protected $builder;

	/**
	 * @var \DI\Container
	 */
	public $container;

	/**
	 * @var Container
	 */
	protected static $instance;

	/**
	 * Build Container.
	 */
	public function __construct() {
		$this->builder = new ContainerBuilder();

		$this->build_container();

		$this->set_classes();
	}

	/**
	 * Instance of this class
	 *
	 * @return Container
	 */
	public static function getInstance() {
		if ( null == static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Build Container
	 */
	public function build_container() {
		$this->builder->addDefinitions( [
			'plugin_activate'          => DI\object( 'hibpwp\config\Plugin_Activate' ),
			'plugin_deactivate'        => DI\object( 'hibpwp\config\Plugin_Deactivate' ),
			'Log_Controller_Interface' => DI\object( 'hibpwp\controller\log\Database_Log_Controller' )
		] );

		$this->container = $this->builder->build();
	}

	/**
	 * Set classes that needs to be used
	 *
	 * TODO extend this with model, controllers and config
	 */
	public function set_classes() {
		/**
		 * Set init config
		 */
		$this->container->set( 'init_config', DI\object( 'hibpwp\config\Init_Config' ) );

		/**
		 * Hibpwp adapter
		 */
		$this->container->set( 'Hibpwp_Adapter_Interface', DI\object( 'hibpwp\controller\adapter\Hibpwp_Adapter' ) );

		/**
		 * Hibpwp controller
		 */
		$this->container->set( 'Hibpwp_Controller_Interface',
			DI\object( 'hibpwp\controller\Hibpwp_Controller' )
				->constructor(
					$this->container->get( 'Hibpwp_Adapter_Interface' ),
					$this->container->get( 'Log_Controller_Interface' )
				)
		);

		/**
		 * Hibpwp cron controller
		 */
		$this->container->set( 'Hibpwp_Cron_Controller_Interface',
			DI\object( 'hibpwp\controller\cron\Hibpwp_Cron_Controller' )
				->constructor(
					$this->container->get( 'Hibpwp_Controller_Interface' )
				)
		);
	}
}