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


        add_action('validate_password_reset', array( $this, 'start_check' ) );
        add_action('user_profile_update_errors', array( $this, 'start_check' ) );

    }

    /**
     * Gets triggered when a user updates its password
     * 
     * @param $errors
     */
    public function start_check($errors) {

	    if( isset( $_POST['pass1']) && !empty($_POST['pass1'] ) ) {
	        $new_pass = $_POST['pass1'];
	        $pwned_count = $this->get_hibp_count($new_pass);

	        if( $pwned_count > 0 ) {
	            $errors->add(
	                'hibpwp_pass',
                    $this->get_error_message($pwned_count)
                );
            }
        }

    }

    /**
     * Het the count of times the choosen password was exposed
     *
     * @param $password
     * @return int
     */
    public function get_hibp_count(string $password) {
        $endpoint = 'https://api.pwnedpasswords.com/range/';
        $hash = sha1($password);
        $prefix = substr($hash, 0, 5);
        $suffix = substr($hash, 5);
        $api_response = wp_remote_get($endpoint . $prefix);

        // Return 0 on wp_remote_get error
        if ( is_wp_error( $api_response ) ) {
            $return = 0;
        } else {
            // Check response to see if there's a match.
            // If so, catch an instance count from the response.
            // If not, return 0.
            $regex = "/" . $suffix . ":(\d+)/i";

            // Is there a match found in the HIBP database?
            if ( preg_match($regex, $api_response["body"], $matches)) {
                $return =  intval($matches[1]);
            } else {
                $return =  0;
            }
        }


        return $return;
    }

    /**
     * Generate the error message
     *
     * @param $count How many times
     * @return string The translated error message
     */
    public function get_error_message($count) {
	    return sprintf(
	        '<strong>' . __('Error') . ':</strong> ' . __('Please choose another password!', 'hibpwp') . '<br />' . __('The password you want to use, is exposed in <u>%s</u> sets of data breaches.', 'hibpwp'),
            $count
        );
    }

}