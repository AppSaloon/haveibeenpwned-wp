<?php

namespace wp_navision\tests\unit\controller\adapter;

/**
 * Class SampleTest
 *
 * @package SampleTest
 */

use wp_navision\controller\adapter\Navision_Adapter;

/**
 * Sample test case.
 *
 * @group whise
 * @group unit
 * @covers \wp_navision\controller\adapter\Navision_Adapter
 */
class Test_Navision_Adapter extends \WP_UnitTestCase {

	CONST CLIENT_ID = '1829c9494c7d4340a152';

	/**
	 * @var \wp_navision\controller\adapter\Navision_Adapter
	 */
	public $navision_adapter;

	function setUp() {
		$this->navision_adapter = new Navision_Adapter();
	}

	/**
	 * @covers \wp_navision\controller\adapter\Navision_Adapter::get
	 */
	function test_connect() {
		$this->assertTrue( $this->navision_adapter->connect() );
	}

	/**
	 * @covers \wp_navision\controller\adapter\Navision_Adapter::get
	 */
	function test_get_xml_files() {
		$this->assertTrue( $this->navision_adapter->connect() );

		var_dump( $this->navision_adapter->get_xml_files() );
	}
}
