<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registracija
 *
 * @author Ivan
 */
class registracija extends Frontend_Controller{
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
        
    }
    
    public function index($jezik,$reg=NULL)
    {
        
        
        $korisnik=  $this->korisnik_m->get_by(array("rand"=>$reg),TRUE);
        if($korisnik!=NULL)
        {
        $this->data['potvrda']=$reg;
        $data['potvrda']=1;
        $this->korisnik_m->save($data,$korisnik->korisnik_id);
        }
        $jezik=$this->data["jezik"]=$jezik;
        $niz=  array("naziv"=>translate("Registracija",$jezik));
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
        
        
        
        $this->data['scripts']['extern2']='ajax';
        $this->data['scripts']['extern3']='provera';
        $this->data['scripts']['extern4']='novitelefon';
        $menus=array("1"=>"frontend/registracija/index");
        parent::template_novi1 ($menus);   
    }
    public function registrujse($jezik)
    {
        $button=  $this->input->post("Sacuvaj");
        $password=$this->input->post("password");
        $ponovljen=$this->input->post("ponovljen");
        
        $rules = $this->korisnik_m->registracija;
        $this->form_validation->set_rules($rules);
        
        if ($this->form_validation->run() == TRUE) {
        if($button && $password==$ponovljen)
        {
            
            $data=$this->korisnik_m->array_from_post(array("ime"=>"ime","prezime"=>"prezime","email"=>"email","grad"=>"grad"));
            $data["max_smestaja"]=1;
            $data["max_smestajnih_jed"]=1;
            $data["rand"]=rand();
            $data['potvrda']=0;
            $data["password"]=  $this->korisnik_m->hash($password);
            $privilegija=$this->privilegija_m->get_by(array("registracija"=>1),TRUE);
            $data["privilegija_id"]=$privilegija->privilegija_id;
            $this->korisnik_m->save($data);
            $id=mysql_insert_id();
            $data="";
            $telefon=$this->input->post("telefon");
            foreach ($telefon as $tel)
            {
                $data['telefon']=$tel;
                $data["korisnik_id"]=$id;
                $this->korisnik_kontakt_m->save($data);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert" style="position:relative;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>'.  translate("Poruka", $jezik).':</strong>'.  translate("Uspesno ste napravili nalog, poslat vam je e-mail sa zahtevom za potvrdu registracije.", $jezik).'.
</div>');
            $korisnik=  $this->korisnik_m->get_by(array("korisnik_id"=>$id),TRUE);

            if(!empty($korisnik))
            {

$config['protocol'] = 'sendmail';
 $config['smtp_host'] = 'ssl://host29.dwhost.net';
 $config['smtp_user'] = 'office@privatnismestaji.com';
 $config['smtp_pass'] = 'Aleksferguson@';
 $config['smtp_port'] = 465;
 $config['charset'] = 'utf-8';
 $config['crlf'] = "\r\n";
 $config['newline'] = "\r\n";
$config['validation'] = TRUE;
 $config['mailtype'] = 'html';
 $config['starttls'] = TRUE;
$config['wordwrap'] = TRUE;


 
 $message="<p>Ovo je automatski generisana poruka. Molimo Vas da na ovu poruku ne odgovarate.</p>---------------------------------------------------------------------------------<br/>Poštovani/a: $korisnik->ime $korisnik->prezime,<br/>Zahvaljujemo se na registraciji na našem portalu.<br/>Vaš nalog je kreiran ali ga morate aktivirati klikom na link<br/>"
         . "<br/><br/><b>Kliknite <a href='".base_url()."sr/registracija/$korisnik->rand'>ovde</a> da bi ste potvrdili registraciju</b><br/><br/><br/>---------------------------------------------------------------------------------<br/>Email (korisničko ime):$korisnik->email<br/>Password:$password<br/><br/><br/>Sva obaveštenja u vezi sa uslugama u ovom korisničkom nalogu će uvek biti slata na ovu email adresu, uključujući i naredna obaveštenja o isticanju pretplate, predračun za produženje pretplate i slično. Veoma je važno da ova email adresa uvek bude u upotrebi ili da je u svom korisničkom nalogu na vreme promenite, ako prestanete da koristite navedenu email adresu promenite adresu na vasem profilu.<br/>---------------------------------------------------------------------------------<br/><b>Napomena:</b> Podatke za pristup korisničkom nalogu ne trebate nikada da dajete trećem licu, a to uglavnom nije ni potrebno.<br/>---------------------------------<br/>Ukoliko imate bilo kakva pitanja možete nas uvek kontaktirati putem sledeće adrese:<a href='".  base_url()."$jezik/informacije/kontakt' title='Privatni Smestaj'>Privatni Smestaji Kontakt</a><br/>Pozdrav,<br/><b>Privatni Smestaj</b><br/>".base_url()."";
  $this->load->library('email');
        $this->email->initialize($config);
  $this->email->from('office@privatnismestaji.com', "Privatni Smestaji");

  $this->email->to("$korisnik->email");
  
  $this->email->subject('Registracija');
  $this->email->message($message);
   

$this->email->send();  
     
   

            }
            
            
        }
        }
        else
        {
            $this->session->set_flashdata('error', validation_errors());
        }
        redirect("$jezik/registracija");
    }
}
