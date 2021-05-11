<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upitdetaljno_m
 *
 * @author Ivan
 */
class upitdetaljno_m extends MY_Model{
    //put your code here
    protected $_table_name = 'upitdetaljno';
    protected $_primary_key = 'upitdetaljno_id';
    protected $_order_by = 'datum';
    public $rules = array();
    protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
        
        public function get_querytext_by_query($query_id,$single=FALSE)
        {
           $query = $this->get_by(array(
                       'upit_id'=>"$query_id",
               ),$single);
           return $query;
        }
        
}
