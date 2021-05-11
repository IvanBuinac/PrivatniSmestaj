<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of iznajmljujese_m
 *
 * @author Ivan
 */
class Iznajmljujese_m extends MY_Model{
    //put your code here
        protected $_table_name = 'iznajmljujese';
        protected $_primary_key = 'iznajmljujese_id';
        protected $_order_by = 'iznajmljujese_id';
        public $rules = array();
	protected $_timestamps = FALSE;
        
    public function __construct() {
        parent::__construct();
    }
    
}
