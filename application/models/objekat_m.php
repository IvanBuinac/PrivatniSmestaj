<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of objekat_m
 *
 * @author Ivan
 */
class Objekat_m extends MY_Model {
    //put your code here
        protected $_table_name = 'objekat';
	protected $_primary_key = 'objekat_id';
	protected $_order_by = 'premium DESC,prioritet ASC,  posecenost';
	public $rules = array(
                'grad_id' => array(
			'field' => 'grad', 
			'label' => 'Town', 
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
		'ukupni_kapacitet' => array(
			'field' => 'kapacitet', 
			'label' => 'Capacity', 
			'rules' => 'trim|intval|required|strip_tags'
		),
                'kategorija' => array(
			'field' => 'kategorija', 
			'label' => 'Category', 
			'rules' => 'trim|intval|required|strip_tags'
		),
                'kategorija' => array(
			'field' => 'tip', 
			'label' => 'Type', 
			'rules' => 'trim|intval|required|strip_tags'
		),
                'web' => array(
			'field' => 'web', 
			'label' => 'Website', 
			'rules' => 'trim|required|max_length[100]|xss_clean|strip_tags'
		),
                'youtube_link' => array(
			'field' => 'youtubelink', 
			'label' => 'Youtube Link', 
			'rules' => 'trim|max_length[200]|xss_clean|strip_tags'
		),
                'adresa' => array(
			'field' => 'adresa', 
			'label' => 'Adress', 
			'rules' => 'trim|required|max_length[40]|xss_clean|strip_tags'
		),
                'kapara' => array(
			'field' => 'kapara', 
			'label' => 'Deposit', 
			'rules' => 'trim|intval|required|strip_tags'
		),
                'kordinata_x' => array(
			'field' => 'kordinata_x', 
			'label' => 'Coordinate Latitude', 
			'rules' => 'trim|required|max_length[40]|xss_clean|strip_tags'
		),
                'kordinata_y' => array(
			'field' => 'kordinata_y', 
			'label' => 'Coordinate Longitude', 
			'rules' => 'trim|required|max_length[40]|xss_clean|strip_tags'
		),
                
                
            
            
        );
	protected $_timestamps =True;
	
	function __construct() {
		parent::__construct();
	}
        
        public function get_new ()
	{
		$object = new stdClass();
		$object->naziv = '';
		$object->putanja = '';
		$object->roditelj = 0;
		$object->tezina = 0;
		return $object;
	}
        
        public function get_objects_by_user($id=NULL,$single=FALSE)
        {
            
           $object = $this->get_by(array(
                            'korisnik_id'=>"$id",
               ),$single);
           return $object;
           
        }
        public function get_objects_by_user_and_id($user=NULL,$id=NULL,$single=FALSE)
        {
            
           $object = $this->get_by(array(
                            'korisnik_id'=>"$user",
                            'objekat_id'=>"$id",
               ),$single);
           return $object;
           
        }
        
        
        
        
}
