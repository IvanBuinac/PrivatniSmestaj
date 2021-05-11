<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administracija_menija
 *
 * @author Ivan
 */
class administracija_menija extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model("meni_m");
    }
    public function index()
    {

        
        
        $this->data['meni']=$this->meni_m->get();
        
        $mains=array("1"=>"backend/admin/menu/index");

        
        
        parent::template ($mains);
    }
    public function izmeni($id=NULL)
    {

        
        
        $this->data['meni']=$this->meni_m->get_by(array("meni_id"=>$id),TRUE);
        
        $mains=array("1"=>"backend/admin/menu/edit");

        
        
        parent::template ($mains); 
    }
    public function obrisi($id)
    {
        $this->meni_m->delete($id);
        redirect('admin/administracija_menija');
    }
    public function sacuvaj($id=NULL)
    {
        $button=$this->input->post('Sacuvaj');
        if($button)
        {
            $data =  $this->meni_m->array_from_post(array("naziv"=>"naziv"));
            $this->meni_m->save($data , $id);
        }
        redirect('admin/administracija_menija');
    }
}
