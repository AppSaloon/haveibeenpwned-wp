<?php

namespace wp_navision\model;

class Navision_Product {

	use Navision_Product_Query;

	CONST TABLE_NAME = 'navision_product';

	CONST BATCH_SIZE = 50;

	private $xml;

	private $data;

	private $fields = array(
		'artnr',
		'naam1',
		'prijs',
		'type',
		'productgroepcode',
		'wijnhuis_naam',
		'wijnhuis_omschrijving',
		'wijnstreek_naam',
		'druivensoort',
		'gastronomie',
		'kelder',
		'kleur',
		'jaar',
		'land',
		'award',
		'award_beschrijving',
		'award_img',
		'award_pdf',
		'commerciele_omschrijving',
		'img',
		'processed'
	);

	/**
	 * Sets XML row
	 *
	 * @param $xml
	 *
	 * @since 1.0.0
	 */
	public function set_xml_file( $xml ) {
		$this->xml = $xml;
	}

	/**
	 * Map XML data to variable $data
	 *
	 * @since 1.0.0
	 */
	public function map() {
		$product = array();
		$product['artnr'] = $this->xml->Artnr;
		$product['naam1'] = $this->xml->Naam1;
		$product['prijs'] = $this->xml->Prijs;
		$product['type'] = $this->xml->ItemDetails->Type;
		$product['productgroepcode'] = $this->xml->ItemDetails->Productgroepcode;
		$product['wijnhuis_naam'] = $this->xml->ItemDetails->WijnhuisNaam;
		$product['wijnhuis_omschrijving'] = $this->xml->ItemDetails->WijnhuisOmschrijving;
		$product['wijnstreek_naam'] = $this->xml->ItemDetails->WijnstreekNaam;
		$product['druivensoort'] = $this->xml->ItemDetails->Druivensoort;
		$product['gastronomie'] = $this->xml->ItemDetails->Gastronomie;
		$product['kelder'] = $this->xml->ItemDetails->Kelder;
		$product['kleur'] = $this->xml->ItemDetails->Kleur;
		$product['jaar'] = $this->xml->ItemDetails->Jaar;
		$product['land'] = $this->xml->ItemDetails->LandNaam;
		$product['award'] = $this->xml->ItemDetails->Award;
		$product['award_beschrijving'] = $this->xml->ItemDetails->AwardBeschrijving;
		$product['award_img'] = $this->xml->ItemDetails->AwardImg;
		$product['award_pdf'] = $this->xml->ItemDetails->AwardPDF;
		$product['commerciele_omschrijving'] = $this->xml->ItemDetails->CommercieleOmschrijving;
		$product['img'] = $this->xml->ItemDetails->Img;
		$product['processed'] = false;

		$this->data[] = $product;
	}

	/**
	 * Push data to the database table
	 *
	 * @since 1.0.0
	 */
	public function create() {
		global $wpdb;

		foreach ( $this->data as $product ) {
			$values[] = $wpdb->prepare( "(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
				$product['artnr'],
				$product['naam1'],
				$product['prijs'],
				$product['type'],
				$product['productgroepcode'],
				$product['wijnhuis_naam'],
				$product['wijnhuis_omschrijving'],
				$product['wijnstreek_naam'],
				$product['druivensoort'],
				$product['gastronomie'],
				$product['kelder'],
				$product['kleur'],
				$product['jaar'],
				$product['land'],
				$product['award'],
				$product['award_beschrijving'],
				$product['award_img'],
				$product['award_pdf'],
				$product['commerciele_omschrijving'],
				$product['img'],
				$product['processed']
			);
		}

		$table_name = $wpdb->prefix . self::TABLE_NAME;

		$query = "INSERT INTO " . $table_name . " (" . implode( ', ', $this->fields ) . ") VALUES ";
		$query .= implode( ", ", $values );
		/**
		 * Clear data
		 */
		$this->data = array();


		/**
		 * Execute the query
		 */
		return $wpdb->query( $query );
	}
}