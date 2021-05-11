<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administracija_korisnika
 *
 * @author Ivan
 */
class administracija_korisnika extends Admin_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model("korisnik_m");
        $this->load->model("privilegija_m");
        $this->load->model("drzava_m");
        $this->load->model('korisnik_kontakt_m');
        $this->load->model('grad_m');
    }
    
    public function index()
    {
        $dugme=$this->input->post("submittt");
        if($dugme!="")
        {
            $privilegija=  $this->input->post("promena_privilegije");
            $privileg=$this->privilegija_m->get();
            foreach ($privileg as $priv)
            {
            $data=array("registracija"=>0);         
            $this->privilegija_m->save($data,$priv->privilegija_id);        
            }
            $data="";
            $data=array("registracija"=>1);
            $this->privilegija_m->save($data,$privilegija); 
            
        }
        
        
        $mains=array("1"=>"backend/admin/users/index");

        $this->data["korisnici"]=  $this->korisnik_m->get();
        
        $privilegije= $this->privilegija_m->get();
        $this->data["privilegije"][0]="Izaberite privilegiju";
        foreach ($privilegije as $privilegija)
        {
            $this->data["privilegije"][$privilegija->privilegija_id]=$privilegija->naziv;
        }
        
        parent::template ($mains);
    }
    
    public function izmeni($id=NULL)
    {
        
        $jezik=  $this->uri->segment(1);
        $this->data["korisnik"]=  $this->korisnik_m->get_by(array("korisnik_id"=>$id),TRUE);
        
        $privilegije= $this->privilegija_m->get();
        $this->data["privilegije"][0]="Izaberite privilegiju";
        foreach ($privilegije as $privilegija)
        {
            $this->data["privilegije"][$privilegija->privilegija_id]=$privilegija->naziv;
        }
        
        
        
        $this->data['scripts']['extern1']='ajax';
        
        
        $mains=array("1"=>"backend/admin/users/edit");
        
        
        parent::template ($mains);
    }
    
    public function obrisi($user_id=NULL)
    {
        $this->korisnik_m->delete($user_id);
        redirect('admin/administracija_korisnika');
    }
    public function sacuvaj($id=NULL)
    {
        
        $jezik=  $this->uri->segment(1);
        $button=$this->input->post('Sacuvaj');
        if($button)
        {
            $data =  $this->korisnik_m->array_from_post(array("ime"=>"ime","prezime"=>"prezime","email"=>"email","max_smestaja"=>"smestaji","max_smestajnih_jed"=>"smestajne_jedinice","potvrda"=>"status","privilegija_id"=>"privilegija","grad"=>"grad"));
            $this->korisnik_m->save($data , $id);
            redirect($jezik."/admin/administracija_korisnika");
        }
        
    }
}
