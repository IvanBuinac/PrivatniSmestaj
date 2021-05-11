<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upit_m
 *
 * @author Ivan
 */
class upit_m extends MY_Model{
    //put your code here
    protected $_table_name = 'upit';
    protected $_primary_key = 'upit_id';
    protected $_order_by = 'stanje,datum';
    public $rules = array();
    protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
        
       public function get_query_by_object($object_id,$single=FALSE)
        {
           $query = $this->get_by(array(
                       'objekat_id'=>"$object_id",
               ),$single);
           return $query;
        } 
}
