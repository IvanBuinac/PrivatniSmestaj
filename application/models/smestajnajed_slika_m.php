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
class smestajnajed_slika_m extends MY_Model{
    //put your code here
        protected $_table_name = 'smestajnajed_slika';
	protected $_primary_key = 'smestajnajed_slika_id';
	protected $_order_by = 'smestajnajed_slika_id';
	public $rules = array();
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
        
        
        
}
