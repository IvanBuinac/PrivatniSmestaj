<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dozvole
 *
 * @author Ivan
 */
class dozvole extends Admin_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model("dozvole_m");
        $this->load->model("privilegija_dozvole_m");
    }
    public function index()
    {
        $this->data['dozvole']=  $this->dozvole_m->get();
        $this->data['privilegija_dozvole']=  $this->privilegija_dozvole_m->get();
        $main=array('1'=>'backend/admin/dozvole/index');
    	
        
        
        parent::template ($main);
    }
    
    public function izmeni_dozvole($id=NULL)
    {
       if(!$id==NULL)
       {
           $this->data['dozvole']=  $this->dozvole_m->get_by(array("dozvole_id"=>$id),TRUE);
       }
       $main=array('1'=>'backend/admin/dozvole/izmeni_dozvole');
       parent::template ($main);
    }
    
    public function sacuvaj_dozvole($id=NULL)
    {
       $naziv= $this->input->post("naziv");
       $data['naziv']=$naziv;
       if($id!=NULL)
       $this->dozvole_m->save($data,$id);
       else
       $this->dozvole_m->save($data);
   redirect("sr/admin/dozvole");
    }
    public function izmeni($id=NULL)
    {
        if(!$id==NULL)
       {
           $this->data['privilegija_dozvole']=  $this->privilegija_dozvole_m->get_by(array("privilegija_dozvole_id"=>$id),TRUE);
       }
       $privilegije=$this->privilegija_m->get();
       $this->data["privilegija"][0]="Izaberite privilegiju";
       foreach($privilegije as $privilegija)
       {
       $this->data["privilegija"][$privilegija->privilegija_id]=$privilegija->naziv;
       }
       
       $dozvole=$this->dozvole_m->get();
       $this->data["dozvole"][0]="Izaberite dozvole";
       foreach($dozvole as $dozvola)
       {
       $this->data["dozvole"][$dozvola->dozvole_id]=$dozvola->naziv;
       }
       
       
        $main=array('1'=>'backend/admin/dozvole/izmeni');
       parent::template ($main);
    }
    
    public function sacuvaj($id=NULL){
        $privilegija=$this->input->post("privilegija");
        $dozvole=  $this->input->post("dozvole");
        $napomena=  $this->input->post("napomena");
        if($privilegija!=NULL && $dozvole!=NULL)
        {
            $data['privilegija_id']=$privilegija;
            $data['dozvole_id']=$dozvole;
            $data['napomena']=$napomena;
            if($id!=NULL)
            $this->privilegija_dozvole_m->save($data,$id);
            else
            $this->privilegija_dozvole_m->save($data);
        }
        redirect("sr/admin/dozvole");
        
    }
    
    public function obrisi($id=NULL)
    {
        $this->privilegija_dozvole_m->delete($id);
        redirect("sr/admin/dozvole");
    }
}
