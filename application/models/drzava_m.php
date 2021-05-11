<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of drzava_m
 *
 * @author Ivan
 */
class Drzava_m extends MY_Model{
    //put your code here
        protected $_table_name = 'drzava';
	protected $_primary_key = 'drzava_id';
	protected $_order_by = 'drzava_id';
	public $rules = array();
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
        
        
        public function get_country_by_age($age_id,$single=FALSE)
        {
           $country = $this->get_by(array(
                       'doba_id'=>"$age_id",
               ),$single);
           return $country;
        }
        
}
