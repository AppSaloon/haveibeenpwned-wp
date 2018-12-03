<?php

namespace hibpwp\config;

use hibpwp\controller\cron\Hibpwp_Cron_Controller;
use hibpwp\controller\log\Database_Log_Controller;
use hibpwp\lib\Container;
use hibpwp\model\Hibpwp_Settings;

class Init_Config {

	/**
	 * @var \DI\container
	 */
	private $container;

	/**
	 * Init_Config constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->container = Container::getInstance();

		$this->container->container->get( 'plugin_activate' );
		$this->container->container->get( 'plugin_deactivate' );

		$this->clear_old_log_data();

		$this->write_log_to_database();

        $this->setting_values = new Hibpwp_Settings();


        add_action( 'admin_menu', array( $this, 'admin_submenu' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Cron job event's action to start checking the passwords hashes of all users agains Hibp API
	 *
	 * @throws \DI\DependencyException
	 * @throws \DI\NotFoundException
	 *
	 * @since 1.0.0
	 */
	public function cron_hibpwp_check_passwords() {
		$cron = $this->container->container->get( 'Hibpwp_Cron_Controller_Interface' );
	}

	/**
	 * Add hibpwp options page to save ftp credentials
	 *
	 * @since 1.0.0
	 */
	public function admin_submenu() {
        add_options_page(
			'Have I Been Pwned WP - Settings',
			'Hibp WP',
			'manage_options',
			'hibpwp_options',
			array(
				$this,
				'settings_page'
			)
		);

		new Log_Config();
	}

    /**
     * Register settings for HIBPWP to work
     *
     * @since 1.0.0
     */
    public function register_settings() {
        // register a new section in the "hibpwp_options" page
        add_settings_section(
            'hibpwp_basic_section',
            __( 'Basic settings', 'hibpwp' ),
            array( $this, 'hibpwp_basic_section_cb'),
            'hibpwp_options'
        );


        add_settings_field(
            "hibpwp_basic_block",
            __( 'Block passwords', 'hibpwp' ),
            array( $this, 'checkbox_display_basic_block' ) ,
            "hibpwp_options",
            "hibpwp_basic_section"
        );

        register_setting( 'hibpwp_options', 'hibpwp_settings' );
    }

    public function hibpwp_basic_section_cb() {
        _e('Finetune the behaviour of the plugin', 'hibpwp');
    }

    public function checkbox_display_basic_block() {
        $option = array();
        $option['name'] = 'basic_block';
        $option['checked'] = $this->get_checked($option['name']);
        $option['description'] = __('Show an error when users tries to set a pwned password', 'hibpwp');
        include HIBPWP_DIR . 'view/admin/option_checkbox.php';

    }

    public function get_checked($checkbox_name) {
        $current_value = $this->setting_values->get_value($checkbox_name);

        return checked( $current_value, 1, false );
    }

	/**
	 * Show form for settings and save the values.
	 *
	 * @since 1.0.0
	 */
	public function settings_page() {

		include HIBPWP_DIR . 'view/admin/options.php';
	}

	/**
	 * Clears old log data from the database
	 *
	 * @since 1.0.0
	 */
	public function clear_old_log_data() {
		add_action( 'clear_navision_log', array(
				$this->container->container->get( 'Log_Controller_Interface' ),
				'remove_old_rows'
			)
		);
	}

	/**
	 * Writes log to database
	 *
	 * @since 1.0.0
	 */
	public function write_log_to_database() {
		add_action( 'shutdown', array(
			$this->container->container->get( 'Log_Controller_Interface' ),
			'log_to_database'
		) );
	}


}