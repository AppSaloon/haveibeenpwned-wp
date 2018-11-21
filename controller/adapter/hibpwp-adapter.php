<?php

namespace hibpwp\controller\adapter;

class Hibpwp_Adapter implements Hibpwp_Adapter_Interface {

	/**
	 * Option value hibpwp_block
     *
     * @var boolean
	 *
	 * @since 1.0.0
	 */
	public $block;

	/**
	 * Option value hibpwp_markuser
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	public $markuser;

	/**
	 * Option value hibpwp_adminnotice
	 *
	 * @var boolean
	 *
	 * @since 1.0.0
	 */
	public $adminnotice;

	/**
	 * Initalize hibpwp adapter.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$this->block     = get_option( 'hibpwp_block' );
		$this->markuser     = get_option( 'hibpwp_markuser' );
		$this->adminnotice = get_option( 'hibpwp_adminnotice' );
	}
}