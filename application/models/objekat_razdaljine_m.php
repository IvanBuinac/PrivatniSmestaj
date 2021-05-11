<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of objekat_razdaljine_m
 *
 * @author Ivan
 */
class objekat_razdaljine_m extends MY_Model{
    //put your code here
    protected $_table_name = 'objekat_razdaljine';
	protected $_primary_key = 'objekat_razdaljine_id';
	protected $_order_by = 'objekat_razdaljine_id';
	public $rules = array(
            'vrednost' => array(
			'field' => 'razdaljine[]', 
			'label' => 'Distance', 
			'rules' => 'trim|max_length[6]|xss_clean'
		),
        );
	protected $_timestamps = FALSE;
        
        function __construct() {
		parent::__construct();
	}
        
        
         public function get_razdaljina_by_id($id,$idraz,$single=TRUE)
        {
           $country = $this->get_by(array(
                       'objekat_id'=>"$id",
                       'razdaljine_id'=>"$idraz",
               ),$single);
           return $country;
        }
    
}
