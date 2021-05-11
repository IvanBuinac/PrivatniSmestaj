<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author Ivan
 */
class dashboard extends User_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('smestajnajedinica_m');
        $this->load->model('grad_m');
        $this->load->model('godina_m');
        $this->load->model('drzava_m');

    }
    
    public function index()
    {
       $user=$this->session->userdata('korisnik_id');
       $objects=$this->data['objects']=$this->objekat_m->get_objects_by_user($user,FALSE);
       $jezik=  $this->uri->segment(1);
       $this->data['jezik']=$this->uri->segment(1);
       $main=array('1'=>'backend/user/object/index');

        $array=array();
        if(!empty($objects))
        {
            foreach ($objects as $object)
            {
                array_push($array, $object->objekat_id);
                
            }
        }
        if(!empty($array))
        $this->data['object_unit']=  $this->smestajnajedinica_m->get_by_in(array('objekat_id'=>$array));
        else
        $this->data['object_unit']=  "";
        $this->data['upiti']=  $this->objekat_m->join(array('upit'=>'objekat.objekat_id = upit.objekat_id'),array('korisnik_id'=>$user,'stanje'=>'0'));
        $main=array('1'=>'backend/user/object/index','2'=>'backend/user/object_units/index','3'=>'backend/user/upiti/index');
    	
        
        
        parent::template ($main);
    }
}
