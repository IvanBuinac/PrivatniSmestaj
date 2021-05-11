<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of privilegija_m
 *
 * @author Ivan
 */
class privilegija_m extends MY_Model{
    //put your code here
    protected $_table_name = 'privilegija';
	protected $_primary_key = 'privilegija_id';
	protected $_order_by = 'privilegija_id';
	public $rules = array();
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
    
}
