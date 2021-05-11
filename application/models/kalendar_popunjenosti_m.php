<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kalendar_popunjenosti_m
 *
 * @author Ivan
 */
class kalendar_popunjenosti_m extends MY_Model{
    //put your code here
    protected $_table_name = 'kalendar_popunjenosti';
	protected $_primary_key = 'kalendar_popunjenosti_id';
	protected $_order_by = 'kalendar_popunjenosti_id';
	public $rules = array();
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
        
        public function dohvati_datum($id, $year,$month)
        {
            //select("datum , ime_prezime, smestajna_jed_id,popunjenost_id")
            $query=  $this->db->select("kalendar_popunjenosti_id, datum ,cena, ime_prezime,status, smestajna_jed_id")->from('kalendar_popunjenosti')->where("smestajna_jed_id",$id)->like("datum",$year."-".$month,"after")->get()->result();
            
           
            return $query;
        }
    
}
