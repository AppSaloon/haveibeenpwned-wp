<?php

namespace hibpwp\config;

use hibpwp\controller\log\Database_Log_Controller;
use hibpwp\controller\lists\Log_List;

class Log_Config {

	CONST LOG_PAGE_SLUG = 'hibpwp_log';

	public function __construct() {
		$page = add_submenu_page(
			'hibpwp_options',
			'Log',
			'View Log',
			'manage_options',
			static::LOG_PAGE_SLUG,
			array( $this, 'display_log_page' )
		);

		add_action( 'load-' . $page, array( $this, 'enqueue_log_page_styles' ) );
	}

	/**
	 * Displays the logging admin page
	 */
	public function display_log_page() {
		if ( isset( $_POST ) && isset( $_POST['truncate'] ) ) {
			global $wpdb;
			$table_name = $wpdb->prefix . Database_Log_Controller::TABLE_NAME;
			$query      = "TRUNCATE TABLE $table_name";
			$wpdb->query( $query );
		}

		//Create an instance of our package class...
		$log_list_table = new Log_List();
		//Fetch, prepare, sort, and filter our data...
		$log_list_table->prepare_items();

		include WP_NAVISION_DIR . 'view/admin/log-view.php';
	}

	/**
	 * Enqueues the style(s) for the log page
	 */
	public function enqueue_log_page_styles() {
		wp_enqueue_style( 'hibpwp_log_style', HIBPWP_URL . 'css/admin/log.css' );
	}
}