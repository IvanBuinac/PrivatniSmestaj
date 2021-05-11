<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of objekat_karakteristika_m
 *
 * @author Ivan
 */
class objekat_karakteristika_m extends MY_Model{
    //put your code here
    protected $_table_name = 'objekat_karakteristike';
	protected $_primary_key = 'objekat_karakteristika_id';
	protected $_order_by = 'objekat_karakteristika_id';
	public $rules = array();
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
        
        public function get_karakteristika_by_object($id=NULl,$single=FALSE)
        {
            $karakteristika = $this->get_by(array(
                       'objekat_id'=>"$id",
               ),$single);
           return $karakteristika;
        }
    
}
