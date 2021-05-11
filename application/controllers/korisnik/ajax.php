<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajax
 *
 * @author Ivan
 */
class ajax extends Frontend_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        
        $this->load->model('grad_m');
        $this->load->model('drzava_m');
        $this->load->model('godina_m');
        $this->load->model('razdaljine_m');
        
    }
    public function grad($id)
    {
        if($id!=NULL)
        {
            $p=$this->grad_m->get_by(array("drzava_id"=>$id,"status"=>1));
            $options[0]='Izaberite';
            foreach ($p as $k => $a)
            {
            $options[$a->grad_id]= $a->naziv;
            }            
            echo form_dropdown('grad', $options);
            
        }
    }
    
    
    
    public function drzava($id)
    {
        if($id!=NULL)
        {
            $p=$this->drzava_m->get_country_by_age($id);
            $options[0]='Izaberite';
            foreach ($p as $k => $a)
            {
            $options[$a->drzava_id]= $a->naziv;
            }
            $datas = "class='form-control' onClick='dohvati_grad(this.value);'";
            echo form_dropdown("drzava", $options, NULL,$datas);
            
        }
    }
    
    
    public function obrisi_upit_detaljno($id)
    {
        if($id!=NULL)
        {
            $this->load->model('upitdetaljno_m');
            $this->upitdetaljno_m->delete($id);
        }
       
    }
    
    
    
    
}
