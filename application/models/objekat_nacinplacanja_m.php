<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of objekat_nacinplacanja_m
 *
 * @author Ivan
 */
class objekat_nacinplacanja_m extends MY_Model{
    //put your code here
    protected $_table_name = 'objekat_nacinplacanja';
	protected $_primary_key = 'objekat_nacinplacanja_id';
	protected $_order_by = 'objekat_nacinplacanja_id';
	public $rules = array();
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
        
        public function get_nacin_by_object_id($id,$single=FALSE)
        {
           $city = $this->get_by(array(
                       'objekat_id'=>"$id",
               ),$single);
           return $city;
        }
}
