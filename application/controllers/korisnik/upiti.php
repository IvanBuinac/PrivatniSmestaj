<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upiti
 *
 * @author Ivan
 */
class upiti extends User_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('upit_m');
        $this->load->model('objekat_m');
        $this->load->model('upitdetaljno_m');
    }
    
    public function index()
    {
        $jezik=  $this->data['jezik']=$this->uri->segment(1);
        
        $user=$this->session->userdata('korisnik_id');
        $this->data['upiti']=  $this->objekat_m->join(array('upit'=>'objekat.objekat_id = upit.objekat_id'),array('korisnik_id'=>$user));
        $main=array('1'=>'backend/user/upiti/index');
            
        parent::template ($main);
    }
    public function obradjeni()
    {
       $jezik=  $this->data['jezik']=$this->uri->segment(1);
        
       $user=$this->session->userdata('korisnik_id');
       $this->data['upiti']=  $this->objekat_m->join(array('upit'=>'objekat.objekat_id = upit.objekat_id'),array('korisnik_id'=>$user,'stanje'=>'1'));
       $main=array('1'=>'backend/user/upiti/index');

       parent::template ($main); 
    }
    public function neobradjeni()
    {
       $jezik=  $this->data['jezik']=$this->uri->segment(1);
        
       $user=$this->session->userdata('korisnik_id');
       $this->data['upiti']=  $this->objekat_m->join(array('upit'=>'objekat.objekat_id = upit.objekat_id'),array('korisnik_id'=>$user,'stanje'=>'0'));

       $main=array('1'=>'backend/user/upiti/index');
       parent::template ($main); 
    }
    public function poslati()
    {
       $jezik=  $this->data['jezik']=$this->uri->segment(1);
        
       $user=$this->session->userdata('email');
       $this->data['upiti']=  $this->objekat_m->join(array('upit'=>'objekat.objekat_id = upit.objekat_id'),array('email'=>$user));
       $main=array('1'=>'backend/user/upiti/index');

       
       parent::template ($main); 
    }
    
    
    public function obrisi($upit_id)
    {
        $jezik=$this->uri->segment(1);
        $this->upit_m->delete($upit_id);
        $this->upitdetaljno_m->delete($upit_id,array('upit_id'=>$upit_id));
        redirect($jezik.'/korisnik/upiti');
    }
    
    
    
    public function detaljno($upit_id)
    {
        
        $user=$this->session->userdata('korisnik_id');
        $email=$this->session->userdata('email');
        $upit=  $this->upit_m->get($upit_id,TRUE);
        if($upit->stanje==0)
        {
            $data["stanje"]=1;
            $this->upit_m->save($data,$upit_id);
        }
        $this->data['scripts']['extern1']='ajax';
        
        $object=$this->objekat_m->join(array('upit'=>'upit.objekat_id=objekat.objekat_id'),array('objekat.korisnik_id'=>$user),TRUE,array('upit.objekat_id'=>$upit->objekat_id)); 
        if(count($object)==NULL)
        {
            $this->data['errors'][] = 'Upit nije pronadjen';
            show_404(current_url());    
        }
        
        

        $main=array('1'=>'backend/user/upiti/detaljno');
        $this->data['upit']=  $this->upit_m->get($upit_id,TRUE);
        $this->data['email']=  $this->session->userdata('email');
        $this->data['upitidetaljno']=$this->upitdetaljno_m->get_querytext_by_query($upit_id);
        parent::template ($main);
    }
    public function odgovori($upit_id)
    {
        $jezik=$this->uri->segment(1);
        $button=$this->input->post('odgovori');
        if($button)
        {
            $email=  $this->session->userdata('email');
            $data=$this->upitdetaljno_m->array_from_post(array('text'=>'odgovor'));
            $data['email']=$email;
            $data['datum']=time();
            $data['stanje']=1;
            $data['upit_id']=$upit_id;
            $this->upitdetaljno_m->save($data, NULL);
            $data="";
            $data['stanje']=1;
            $this->upit_m->save($data,$upit_id);
            redirect($jezik.'/korisnik/upiti/detaljno/'.$upit_id);
        }
    }
}
