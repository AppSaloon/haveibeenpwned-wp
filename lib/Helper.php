<?php

namespace wp_navision\lib;

class Helper {

	/**
	 * Renames estate response from the webservice to model Estate
	 *
	 * @param $instance
	 * @param $className
	 *
	 * @return mixed
	 *
	 * @since 1.0.0
	 */
	public static function objectToObject( $instance, $className ) {
		return unserialize( sprintf(
			'O:%d:"%s"%s',
			strlen( $className ),
			$className,
			strstr( strstr( serialize( $instance ), '"' ), ':' )
		) );
	}

	/**
	 * Returns estate one by one to save memory
	 *
	 * @param $estates
	 *
	 * @return \Generator
	 *
	 * @since 1.0.0
	 */
	public static function generator( $estates ) {
		foreach ( $estates as $estate ) {
			yield $estate;
		}
	}

	/**
	 * Returns product ID
	 *
	 * @param $products
	 *
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public static function filter_id($products) {
		$response = array();

		foreach( $products as $product ) {
			$response[] = $product->id;
		}

		return $response;
	}
}