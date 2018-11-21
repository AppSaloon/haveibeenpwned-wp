<?php

namespace hibpwp\controller;

use hibpwp\controller\adapter\Hibpwp_Adapter;
use hibpwp\controller\adapter\Hibpwp_Adapter_Interface;
use hibpwp\controller\log\Log_Controller_Interface;
use hibpwp\lib\Container;
use hibpwp\lib\Helper;
use hibpwp\model\Hibpwp_User;

class Hibpwp_Controller implements Hibpwp_Controller_Interface {

	/**
	 * @var Hibpwp_Adapter
	 */
	public $hibpwp_adapter;

	/**
	 * @var Log_Controller_Interface
	 */
	public $log;

	/**
	 * @var array
	 */
	public $xml_files;

	/**
	 * Hibpwp_Controller constructor.
	 *
	 * @param Hibpwp_Adapter_Interface $hibpwp_adapter
	 * @param Log_Controller_Interface $log
	 */
	public function __construct( Hibpwp_Adapter_Interface $hibpwp_adapter, Log_Controller_Interface $log ) {
		$this->hibpwp_adapter = $hibpwp_adapter;
		$this->log              = $log;
	}

}