<?php

namespace hibpwp\model;

class Hibpwp_Settings {

    protected $option_name = 'hibpwp_settings';
    protected $current_values = array();

    /**
     * Allow pwned passwords or block them
     * @var boolean
     */
    protected $block = true;

    public function __construct() {
        $this->populateCurrentValues();
    }

    private function populateCurrentValues() {
        $option = get_option($this->option_name);

        if( !is_array( $option ) ) {
            $option = array();
        }

        $this->current_values = $option;
    }

    public function getCurrentValue( $name ) {
        return $this->current_values[$name];
    }

    /**
     * @return bool
     */
    public function isBlock()
    {
        return $this->block;
    }

    /**
     * @param bool $block
     */
    public function setBlock($block)
    {
        $this->block = $block;
    }


    public function get_value($option_name) {
        $return = false;

        if( key_exists($option_name, $this->current_values) ) {
            $return = $this->current_values[$option_name];
        }

        return $return;
    }


}