<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of razdaljine_m
 *
 * @author Ivan
 */
class razdaljine_m extends MY_Model{
    //put your code here
    protected $_table_name = 'razdaljine';
	protected $_primary_key = 'razdaljine_id';
	protected $_order_by = 'razdaljine_id';
	public $rules = array();
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
        
        public function get_by_doba_id($age_id,$single=FALSE)
        {
           $country = $this->get_by(array(
                       'doba_id'=>"$age_id",
               ),$single);
           return $country;
        }
}
