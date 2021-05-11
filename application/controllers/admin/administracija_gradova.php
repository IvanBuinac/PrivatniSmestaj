<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administracija_gradova
 *
 * @author Ivan
 */
class administracija_gradova extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model("grad_m");
        $this->load->model("drzava_m");
    }
    
    public function index()
    {

        
        
        $mains=array("1"=>"backend/admin/town/index");

        $this->data["gradovi"]=  $this->grad_m->get();
        
        parent::template ($mains);
    }
    
    public function izmeni($id=NULL)
    {
  
        
        
        $this->data["grad"]=  $this->grad_m->get_by(array("grad_id"=>$id),TRUE);
        
        $drzave= $this->drzava_m->get();
        foreach($drzave as $drzava)
        {
            $this->data["drzave"][$drzava->drzava_id]=$drzava->naziv;
        }
        $mains=array("1"=>"backend/admin/town/edit");
        $this->data["body"]=array("onLoad"=>"initialize();");
        
        parent::template ($mains);
    }
    
    public function obrisi($id=NULL)
    {
        $this->grad_m->delete($id);
        redirect('admin/administracija_gradova');
    }
    public function sacuvaj($id=NULL)
    {
        $button=$this->input->post('Sacuvaj');
        if($button)
        {
            $data =  $this->grad_m->array_from_post(array("naziv"=>"naziv","putanja"=>"putanja","drzava_id"=>"drzava","lat"=>"lat","long"=>"lng","zoom"=>"zoom","status"=>"status"));
            $this->grad_m->save($data , $id);
        }
        redirect('admin/administracija_gradova');
    }
}
