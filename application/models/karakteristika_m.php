<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of karakteristika_m
 *
 * @author Ivan
 */
class karakteristika_m extends MY_Model{
    //put your code here
    protected $_table_name = 'karakteristike';
	protected $_primary_key = 'karakteristike_id';
	protected $_order_by = 'karakteristike_id';
	public $rules = array();
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
    
}
