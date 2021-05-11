<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of smestajne_jedinice
 *
 * @author Ivan
 */
class smestajne_jedinice extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('smestajnajedinica_m');
        $this->load->model('objekat_m');
        $this->load->model('vrsta_m');
        $this->load->model('karakteristika_m');
        $this->load->model('cenausezoni_m');
        $this->load->model('objekat_detaljan_cenovnik_m');
        $this->load->model('objekat_cene_m');
    }
    
    public function index()
    {
        $object_unit=$this->data['object_unit']=  $this->smestajnajedinica_m->get();
        

        $main=array('1'=>'backend/admin/object_units/index');
        parent::template ($main,TRUE);
    }
    public function objekat($id=NULL)
    {
        
        
        $this->data['object_unit']=  $this->smestajnajedinica_m->get_by(array('objekat_id'=>$id));
        $this->data['object']=  $this->objekat_m->get_by(array('objekat_id'=>$id),TRUE);

        $main=array('1'=>'backend/admin/object_units/index');
        parent::template ($main,TRUE);
    }
}
