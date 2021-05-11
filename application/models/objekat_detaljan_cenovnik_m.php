<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of objekat_detaljan_cenovnik_m
 *
 * @author Ivan
 */
class objekat_detaljan_cenovnik_m extends MY_Model{
    //put your code here
    protected $_table_name = 'objekat_detaljan_cenovnik';
	protected $_primary_key = 'objekat_detaljan_cenovnik_id';
	protected $_order_by = 'objekat_detaljan_cenovnik_id';
	public $rules = array(
            'od' => array(
			'field' => 'od[]', 
			'label' => 'From', 
			'rules' => 'trim|max_length[40]|xss_clean|strip_tags'),
            'do' => array(
			'field' => 'do[]', 
			'label' => 'To', 
			'rules' => 'trim|max_length[40]|xss_clean|strip_tags'),
            'cena' => array(
			'field' => 'cenadetaljno[]', 
			'label' => 'Price', 
			'rules' => 'trim|max_length[40]|xss_clean|strip_tags'),
            'cena_za' => array(
			'field' => 'cenapo[]', 
			'label' => 'Price for (percon...)', 
			'rules' => 'trim|max_length[40]|xss_clean|strip_tags'),
            
            
        );
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
    
}
