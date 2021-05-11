<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administracija_smestaja
 *
 * @author Ivan
 */
class administracija_smestaja extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('grad_m');
        $this->load->model('godina_m');
        $this->load->model('drzava_m');
        $this->load->model('kategorija_m');
        $this->load->model('tip_m');
        $this->load->model('iznajmljujese_m');
        $this->load->model('nacinplacanja_m');
        $this->load->model('cenausezoni_m');
        $this->load->model('kapara_m');
        $this->load->model('smestajnajedinica_m');
        $this->load->model('karakteristika_m');
        $this->load->model('legenda_m');
        $this->load->model('objekat_slika_m');
        $this->load->model('objekat_karakteristika_m');
        $this->load->model('razdaljine_m');
        $this->load->model('objekat_nacinplacanja_m');
        $this->load->model('objekat_razdaljine_m');
        $this->load->model('objekat_cene_m');
        $this->load->model('objekat_iznajmljujese_m');
        $this->load->model('objekat_detaljan_cenovnik_m');
        $this->load->model("smestajnajedinica_m");
    }
    public function index()
    {
        $objects=$this->data["objects"]=$this->objekat_m->get();
        
       
        foreach ($objects as $object)
        {
            $city=$this->data['city']=  $this->grad_m->get($object->grad_id,TRUE);
            $age=$this->godina_m->get();
            $country= $this->drzava_m->get_by(array("drzava_id"=>$city->drzava_id),TRUE);
            $putanja="".base_url().''.strtolower("$country->naziv/$city->naziv");
            $putanja_objekta="".base_url().''.strtolower("$country->naziv/$city->naziv/$object->naziv");
            $new = str_replace(' ', '-', $putanja);
            $new1 = str_replace(' ', '-', $putanja_objekta);
 
            $this->data['putanja']=  anchor($new, "$country->naziv/$city->naziv");
            $this->data['putanja_objekta']=  anchor($new1, "<span class='glyphicon glyphicon-eye-open'></span>");
            $this->data['smestajne_jedinice']=$this->smestajnajedinica_m->get_by(array("objekat_id"=>$object->objekat_id));
            
        }
        
        $mains=array("1"=>"backend/admin/objects/index");
        parent::template ($mains,TRUE);
    }
    public function obrisi($id=NULL)
    {
        
    }
}
