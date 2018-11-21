<?php

namespace hibpwp\controller\cron;

use hibpwp\controller\log\Database_Log_Controller;
use hibpwp\controller\Hibpwp_Controller;
use hibpwp\lib\Helper;

class Hibpwp_Cron_Controller {

	protected $hibpwp_controller;

	public function __construct( Hibpwp_Controller $hibpwp_controller ) {
		$this->hibpwp_controller = $hibpwp_controller;
	}


}