<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kapara_m
 *
 * @author Ivan
 */
class kapara_m extends MY_Model{
    //put your code here
    
    protected $_table_name = 'kapara';
	protected $_primary_key = 'kapara_id';
	protected $_order_by = 'kapara_id';
	public $rules = array();
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
}
