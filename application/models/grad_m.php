<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of grad_m
 *
 * @author Ivan
 */
class Grad_m extends MY_Model {
    //put your code here
        protected $_table_name = 'grad';
	protected $_primary_key = 'grad_id';
	protected $_order_by = 'grad_id';
	public $rules = array();
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
        
        public function get_new ()
	{
		$city = new stdClass();
		$city->naziv = '';
		$city->putanja = '';
		$city->roditelj = 0;
		$city->tezina = 0;
		return $city;
	}
        
        public function get_citys_by_country($country_id,$single=FALSE)
        {
           $city = $this->get_by(array(
                       'drzava_id'=>"$country_id",
               ),$single);
           return $city;
        }
        
}
