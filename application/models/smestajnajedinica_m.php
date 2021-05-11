<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of smestajnajedinica_m
 *
 * @author Ivan
 */
class smestajnajedinica_m extends MY_Model{
    //put your code here
        protected $_table_name = 'smestajnajedinica';
	protected $_primary_key = 'smestajnajedinica_id';
	protected $_order_by = 'smestajnajedinica_id';
	public $rules = array(
            'objekat_id' => array(
			'field' => 'objekat', 
			'label' => 'Object', 
			'rules' => 'trim|intval|required|strip_tags'
		),
            'vrsta_id' => array(
			'field' => 'vrsta', 
			'label' => 'category', 
			'rules' => 'trim|intval|required|strip_tags'
		),
            'naziv' => array(
			'field' => 'naziv', 
			'label' => 'Title', 
			'rules' => 'trim|required|max_length[40]|xss_clean|strip_tags'
		),
            'opis' => array(
			'field' => 'opis', 
			'label' => 'Description', 
			'rules' => 'trim|required|xss_clean|strip_tags'
		),
            'broj_mesta' => array(
			'field' => 'mesta', 
			'label' => 'Capacity', 
			'rules' => 'trim|intval|required|strip_tags'
		),
        );
	protected $_timestamps = TRUE;
        
        function __construct() {
		parent::__construct();
	}
        
        public function get_object_units_by_object($id=NULL,$single=FALSE)
        {
            
           $object = $this->get_by(array(
                            'objekat_id'=>"$id",
               ),$single);
           return $object;
           
        }
        
}
