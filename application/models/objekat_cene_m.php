<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of objekat_cene_m
 *
 * @author Ivan
 */
class objekat_cene_m extends MY_Model{
    //put your code here
    protected $_table_name = 'objekat_cene';
	protected $_primary_key = 'objekat_cene_id';
	protected $_order_by = 'objekat_cene_id';
	public $rules = array(
            'cena' => array(
			'field' => 'cena[]', 
			'label' => 'Price', 
			'rules' => 'trim|max_length[5]|xss_clean'
		), 
        );
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
    
}
