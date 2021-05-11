<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of korisnik_kontakt_m
 *
 * @author Ivan
 */
class korisnik_kontakt_m extends MY_Model{
    //put your code here
    protected $_table_name = 'korisnik_kontakt';
	protected $_primary_key = 'korisnik_kontakt_id';
	protected $_order_by = 'korisnik_kontakt_id';
	public $rules = array();
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
    
}
