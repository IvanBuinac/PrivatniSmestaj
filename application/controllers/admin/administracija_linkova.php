<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administracija_linkova
 *
 * @author Ivan
 */
class administracija_linkova extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model("meni_m");
    }
    
    public function index()
    {
 
        
        
        $link=$this->data['link']=$this->link_m->get();
        
        $meniji=  $this->meni_m->get();
        $this->data["meni"][0]="Izaberite";
        foreach ($meniji as $meni)
        {
            $this->data["meni"][$meni->meni_id]=$meni->naziv;
        }
        $this->data['scripts']['extern1']='ajax';
       
        
        $mains=array("1"=>"backend/admin/links/index");

        
        
        parent::template ($mains);
    }
    public function izmeni($id=NULL)
    {
 
        
        
        $this->data['link']=$this->link_m->get_by(array("link_id"=>$id),TRUE);
        
        $meniji=  $this->meni_m->get();
        $this->data["meni"][0]="Izaberite";
        foreach ($meniji as $meni)
        {
            $this->data["meni"][$meni->meni_id]=$meni->naziv;
        }
        
        for($i=0;$i<10;$i++)
        {
           $this->data["tezina"][$i]=$i; 
        }
        
        $roditelj=$this->link_m->get();
        $this->data["roditelj"][0]="Nema";
        foreach ($roditelj as $rod)
        {
            $this->data["roditelj"][$rod->link_id]=$rod->naziv;
        }
        
        $mains=array("1"=>"backend/admin/links/edit");

        
        
        parent::template ($mains); 
    }
    public function obrisi($id)
    {
        $this->link_m->delete($id);
        redirect('admin/administracija_linkova');
    }
    public function sacuvaj($id=NULL)
    {
        $button=$this->input->post('Sacuvaj');
        if($button)
        {
            $data =  $this->link_m->array_from_post(array("naziv"=>"naziv","putanja"=>"putanja","meni_id"=>"meni","tezina"=>"tezina","roditelj"=>"roditelj"));
            $this->link_m->save($data , $id);
            var_dump($id);
        }
        
        redirect('admin/administracija_linkova');
    }
}
