<?php

namespace hibpwp\controller\log;

interface Log_Controller_Interface {

	/**
	 * Save message with type debug
	 *
	 * @param       $msg      string  Message to save
	 * @param bool $file string  In which file did the call came from
	 * @param bool $function string  In which function
	 * @param bool $line string  In which line
	 */
	public function debug( $msg, $file = false, $function = false, $line = false );

	/**
	 * Save message with type info
	 *
	 * @param       $msg      string  Message to save
	 * @param bool $file string  In which file did the call came from
	 * @param bool $function string  In which function
	 * @param bool $line string  In which line
	 */
	public function info( $msg, $file = false, $function = false, $line = false );

	/**
	 * Save message with type warn
	 *
	 * @param       $msg      string  Message to save
	 * @param bool $file string  In which file did the call came from
	 * @param bool $function string  In which function
	 * @param bool $line string  In which line
	 */
	public function warn( $msg, $file = false, $function = false, $line = false );

	/**
	 * Save message with type error
	 *
	 * @param       $msg      string  Message to save
	 * @param bool $file string  In which file did the call came from
	 * @param bool $function string  In which function
	 * @param bool $line string  In which line
	 */
	public function error( $msg, $file = false, $function = false, $line = false );

	/**
	 * Save message with type fatal
	 *
	 * @param       $msg      string  Message to save
	 * @param bool $file string  In which file did the call came from
	 * @param bool $function string  In which function
	 * @param bool $line string  In which line
	 */
	public function fatal( $msg, $file = false, $function = false, $line = false );

	/**
	 * Saving log records to database
	 * This function will be executed as the last PHP function.
	 *
	 * @since 1.0
	 */
	public function log_to_database();

	/**
	 * Remove logs older than a month
	 *
	 * @since 1.0
	 */
	public function remove_old_rows();
}