<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of moj_profil
 *
 * @author Ivan
 */
class moj_profil extends User_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
        $this->load->model('korisnik_kontakt_m');
        $this->load->model('grad_m');
        $this->load->model('drzava_m');
    }
    
    public function index()
    {
        
    	
        
        $id=  $this->session->userdata('korisnik_id');
        $korisnik=$this->data['korisnik']=  $this->korisnik_m->get($id,TRUE);
        
        $korisnik_kontakt=$this->data['korisnik_kontakt']=$this->korisnik_kontakt_m->get_by(array('korisnik_id'=>$id));
         
        
        $main=array('1'=>'backend/user/my_profile/index');
        $this->data['scripts']['extern1']='ajax';
        
        parent::template ($main,FALSE);
        
    }
    
    public function password()
    {
        $this->data['links']=$this->link_m->get_nested(3);
        
        $main=array('1'=>'backend/user/my_profile/password');
        parent::template ($main,FALSE);
    }
    public function promeni()
    {
        
    }




    public function sacuvaj()
    {
        $jezik=  $this->uri->segment(1);
        $button=  $this->input->post('Sacuvaj', TRUE);
        if($button)
        {
            $id=  $this->session->userdata('korisnik_id');
            $email=  $this->input->post('email');
            $email_baza= $this->session->userdata('email');
                if($email==$email_baza)
                {
                $data =  $this->korisnik_m->array_from_post(array('ime'=>'ime','prezime'=>'prezime','email'=>'email','grad'=>'grad'));
                $this->korisnik_m->save($data , $id);
                
                $this->korisnik_kontakt_m->delete(NULL,array('korisnik_id'=>$id));
                $telefon=$this->input->post('telefon');
                if(is_array($telefon))
                {
                    foreach ($telefon as $tel)
                    {
                        $data='';
                        $data['telefon']=$tel;
                        $data['korisnik_id']=$id;
                        $this->korisnik_kontakt_m->save($data);
                    }
                }
                redirect($jezik.'/korisnik/moj_profil');
                }
                else
                {
                $data =  $this->korisnik_m->array_from_post(array('ime'=>'ime','prezime'=>'prezime','email'=>'email','drzava'=>'drzava','grad'=>'grad'));
                $data['potvrda']=0;
                $this->korisnik_m->save($data , $id);
                redirect('login/logout');   
                }
        }
    }
}
