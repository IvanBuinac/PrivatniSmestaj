<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administracija_drzava
 *
 * @author Ivan
 */
class administracija_drzava extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model("drzava_m");
        $this->load->model("godina_m");
    }
    
    public function index()
    {

        
        
        $mains=array("1"=>"backend/admin/city/index");

        $this->data["drzave"]=  $this->drzava_m->get();
        
        parent::template ($mains);
    }
    
    public function izmeni($id=NULL)
    {
        
        
        
        $this->data["drzava"]=  $this->drzava_m->get_by(array("drzava_id"=>$id),TRUE);
        
        $doba= $this->godina_m->get();
        foreach($doba as $dob)
        {
            $this->data["doba"][$dob->doba_id]=$dob->naziv;
        }
        $mains=array("1"=>"backend/admin/city/edit");
        
        $this->data["body"]=array("onLoad"=>"initialize();");
        
        parent::template ($mains);
    }
    
    public function obrisi($id=NULL)
    {
        $this->drzava_m->delete($id);
        redirect('admin/administracija_drzava');
    }
    public function sacuvaj($id=NULL)
    {
        $button=$this->input->post('Sacuvaj');
        if($button)
        {
            $data =  $this->drzava_m->array_from_post(array("naziv"=>"naziv","putanja"=>"putanja","lat"=>"lat","long"=>"lng","zoom"=>"zoom","status"=>"status"));
            $this->drzava_m->save($data , $id);
        }
        redirect('admin/administracija_drzava');
    }
}
