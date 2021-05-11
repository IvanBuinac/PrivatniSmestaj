<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administracija_doba
 *
 * @author Ivan
 */
class administracija_doba extends Admin_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model("godina_m");
    }
    public function index()
    {

        
        $mains=array("1"=>"backend/admin/ages/index");

        $this->data["doba"]=  $this->godina_m->get();
        
        parent::template ($mains);
    }
    
    public function izmeni($id=NULL)
    {

        
        $this->data["doba"]=  $this->godina_m->get_by(array("doba_id"=>$id),TRUE);
        
        
        $mains=array("1"=>"backend/admin/ages/edit");
        
        parent::template ($mains);
    }
    
    public function sacuvaj($id=NULL)
    {
        $button=$this->input->post('Sacuvaj');
        if($button)
        {
            $data =  $this->godina_m->array_from_post(array("naziv"=>"naziv"));
            $this->godina_m->save($data , $id);
        }
        redirect('admin/administracija_doba');
    }
}
