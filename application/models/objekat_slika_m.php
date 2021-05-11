<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of objekat_slika_m
 *
 * @author Ivan
 */
class objekat_slika_m extends MY_Model{
    //put your code here
    protected $_table_name = 'objekat_slika';
	protected $_primary_key = 'objekat_slika_id';
	protected $_order_by = 'objekat_slika_id';
	public $rules = array();
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
        
        public function get_object_images($id,$glavna=NULL,$single=FALSE)
        {
           $image = $this->get_by(array(
                       'objekat_id'=>"$id",
                       'glavna'=>"$glavna",
               ),$single);
           return $image;
        }
        
}
