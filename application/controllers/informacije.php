<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of support
 *
 * @author Ivan
 */
class informacije extends Frontend_Controller{
    //put your code here
     public function __construct() {
        parent::__construct();
        $this->load->model('godina_m');
        $this->load->model('drzava_m');
        $this->load->model('grad_m');
        $this->load->library('session');
        $this->load->model('korisnik_m');
        $this->load->model('korisnik_kontakt_m');
        $this->load->model('privilegija_m');
        $this->load->model('objekat_m');
        $this->load->model('objekat_slika_m');
        $this->load->model('privilegija_m');
        $this->load->model('usluge_m');
        
		// Load helpers
		$this->load->helper('url');
		
		// Load PayPal library
		$this->config->load('paypal_sample');
		
		$config = array(
			'Sandbox' => $this->config->item('Sandbox'), 			// Sandbox / testing mode option.
			'APIUsername' => $this->config->item('APIUsername'), 	// PayPal API username of the API caller
			'APIPassword' => $this->config->item('APIPassword'), 	// PayPal API password of the API caller
			'APISignature' => $this->config->item('APISignature'), 	// PayPal API signature of the API caller
			'APISubject' => '', 									// PayPal API subject (email address of 3rd party user that has granted API permission for your app)
			'APIVersion' => $this->config->item('APIVersion')		// API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
		);
		
		// Show Errors
		if($config['Sandbox'])
		{
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
		}
		
		$this->load->library('Paypal_pro', $config);
                $this->load->model("admin_poruke_m");
        
    }
    
    public function kontakt()
    {
        $jezik=$this->data["jezik"]=  $this->uri->segment(1);
        $niz=  array("naziv"=>translate("Kontakt",$jezik));
        $page=(object)$niz;
        $this->data['page']=$page;
        
        $this->data['objekti']=  $this->objekat_m->get();
        $this->data['ulogovan']=$this->korisnik_m->loggedin();

        $centar=$this->data['centar']=$this->link_m->get_nested(1);

        $this->data['drzave']=  $this->drzava_m->get();
        
        $drzave= $this->drzava_m->get();
        $this->data['drzavas'][0]= translate("Izaberite drzavu", $jezik);
        foreach ($drzave as $drzava)
        {
            $this->data['drzavas'][$drzava->drzava_id]=translate($drzava->naziv, $jezik);
        }
        $menus=array("1"=>"frontend/informacije/kontakt");
        parent::template_novi1 ($menus); 
    }
    public function posaljimail()
    {

        $button=  $this->input->post("posalji");
        if($button!=NULL)
        {
            $eggg=$this->input->post("VaseIme");
            $email=$this->input->post("mail");
            $poruka=$this->input->post("text");
            $konacna=" Ime:".$eggg." \n Email:".$email." \n Poruka:".$poruka;
            mail("office@privatnismestaji.com", "Kontakt forma sa sajta", $konacna);
            mail("support@privatnismestaji.com", "Kontakt forma sa sajta", $konacna);
            mail("admin@privatnismestaji.com", "Kontakt forma sa sajta", $konacna);
            mail("ivan.buinac.182.11@ict.edu.rs", "Kontakt forma sa sajta", $konacna);
            $data["poruka"]=$konacna;
            $this->admin_poruke_m->save($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert" style="position:relative;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>'.  translate("Poruka", $jezik).':</strong>'.  translate("Uspesno ste poslali poruku, cim budemo u mogucnosti odgovoricemo vam na poruku.", $jezik).'.
</div>');
            redirect(base_url());
        }
    }
    
    public function marketing()
    {
        $jezik=$this->data["jezik"]=  $this->uri->segment(1);
        $niz=  array("naziv"=>translate("Marketing",$jezik));
        $page=(object)$niz;
        $this->data['page']=$page;
        
        $this->data['objekti']=  $this->objekat_m->get();
        $this->data['ulogovan']=$this->korisnik_m->loggedin();

        $centar=$this->data['centar']=$this->link_m->get_nested(1);

        $this->data['drzave']=  $this->drzava_m->get();
        
        $drzave= $this->drzava_m->get();
        $this->data['drzavas'][0]= translate("Izaberite drzavu", $jezik);
        foreach ($drzave as $drzava)
        {
            $this->data['drzavas'][$drzava->drzava_id]=translate($drzava->naziv, $jezik);
        }
        
        $this->data["usluge"]=  $this->usluge_m->get();
        
//        $menus=array("1"=>"frontend/informacije/marketing");
        parent::template_novi1 ();  
    }
    
    public function onama()
    {
        
        $jezik=$this->data["jezik"]=  $this->uri->segment(1);
        $niz=  array("naziv"=>translate("O nama",$jezik));
        $page=(object)$niz;
        $this->data['page']=$page;
        
        $this->data['objekti']=  $this->objekat_m->get();
        $this->data['ulogovan']=$this->korisnik_m->loggedin();

        $centar=$this->data['centar']=$this->link_m->get_nested(1);

        $this->data['drzave']=  $this->drzava_m->get();
        
        $drzave= $this->drzava_m->get();
        $this->data['drzavas'][0]= translate("Izaberite drzavu", $jezik);
        foreach ($drzave as $drzava)
        {
            $this->data['drzavas'][$drzava->drzava_id]=translate($drzava->naziv, $jezik);
        }
        parent::template_novi1 (); 
    }
    
    public function uslovikoriscenja()
    {
       $jezik=$this->data["jezik"]=  $this->uri->segment(1);
        $niz=  array("naziv"=>translate("Uslovi koriscenja",$jezik));
        $page=(object)$niz;
        $this->data['page']=$page;
        
        $this->data['objekti']=  $this->objekat_m->get();
        $this->data['ulogovan']=$this->korisnik_m->loggedin();

        $centar=$this->data['centar']=$this->link_m->get_nested(1);

        $this->data['drzave']=  $this->drzava_m->get();
        
        $drzave= $this->drzava_m->get();
        $this->data['drzavas'][0]= translate("Izaberite drzavu", $jezik);
        foreach ($drzave as $drzava)
        {
            $this->data['drzavas'][$drzava->drzava_id]=translate($drzava->naziv, $jezik);
        }
        $menus=array("1"=>"frontend/informacije/uslovi_koriscenja");
        parent::template_novi1 ($menus);  
    }
    
}
