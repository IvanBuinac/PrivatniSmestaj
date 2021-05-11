<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usluge
 *
 * @author Ivan
 */
class usluge extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('usluge_m');
    }
    
    public function index()
    {
        $this->data['usluge']=$this->usluge_m->get();
        

        $main=array('1'=>'backend/admin/services/index');
        parent::template ($main,TRUE);
    }
    public function izmeni($id_usluge=NULL)           
    {
        if($id_usluge!=NULL)
        {
            $usluga=$this->data['usluga']=$this->usluge_m->get_by(array("usluge_id"=>$id_usluge),TRUE);
        }
        $main=array('1'=>'backend/admin/services/edit');
        parent::template ($main,TRUE);
    }
    public function sacuvaj($id_usluge=NULL)            
    {
        $jezik=$this->uri->segment(1);
        $button=$this->input->post('Sacuvaj');
        if($button)
        {
            $data=$this->usluge_m->array_from_post(array('opis'=>'opis',"naziv"=>'naziv',"cena"=>'cena'));
            $this->usluge_m->save($data, $id_usluge);
            redirect($jezik.'/admin/usluge');
        }
    }
}
