<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author Ivan
 */

class Backend_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();
                $this->load->helper('cookie');
                $this->load->helper('cms_helper');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('link_m');
                $this->load->model('korisnik_m');
                $this->load->model('objekat_m');
                $this->load->model('privilegija_m');
                $this->load->model('smestajnajedinica_m');
                $this->load->model('menu_privilegija_m');
                $this->load->model('privilegija_dozvole_m');
		// Login check
		$exception_uris = array(
			'login',
                        'login_k/login',
			'login/logout',
                        'login/google_login',
                        'login/facebook_login',
                        'login/twitter_login'
		);
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if ( $this->korisnik_m->loggedin() == FALSE) {
				redirect(base_url());
			}
		}
		
                
                
                
                if($this->korisnik_m->loggedin())
                {
                $privilegija=$this->korisnik_m->get_privilege_id();
                $user=$this->session->userdata('korisnik_id');
                $korisnik=  $this->korisnik_m->get_by(array("korisnik_id"=>$user),TRUE);

                if(ispitaj_datum($korisnik->kreiran,$privilegija)==TRUE )
                {
                        $data="";
                        $data['privilegija_id']=3;
                        $this->korisnik_m->save($data,$korisnik->korisnik_id);

                }
                
                @$objekti=$this->objekat_m->get_by(array("korisnik_id"=>$user));
                foreach ($objekti as $objekat)
                { 
                    if(ispitaj_datum($objekat->kreiran,$privilegija)==TRUE )
                    {
                        $data="";
                        $data["status"]=0;
                        $data["premium"]=0;
                        $data["prioritet"]=15;
                        $this->objekat_m->save($data,$objekat->objekat_id);
                    }
                }
                }
	 
	}
        
        public function template ($mains=NULL,$single=FALSE,$sidebars=NULL)
        {
            
            $this->data['page'] = $this->link_m->get_by(array('putanja' => (string) $this->uri->segment(2).'/'.$this->uri->segment(3)), TRUE);
            
            
            @add_meta_title($this->data['page']->naziv);

            $this->data['signle']=$single;
            $this->load->view('backend/components/_page_head',  $this->data);
            $this->load->view('backend/components/_page_menu',  $this->data);
            if(count($mains)!=NULL)
            {
                foreach($mains as $main)
                {
                $this->load->view($main,  $this->data);
                }
            }
            if($single==FALSE)
            {
            $this->load->view('backend/components/_page_sidebar',  $this->data);
            }
            if($single!=FALSE)
            {
            if(count($sidebars)!=NULL)
            {
                foreach($sidebars as $sidebar)
                {
                $this->load->view($sidebar,  $this->data);
                }
            }
            }
            $this->load->view('backend/components/_page_footer',  $this->data);
            
        }
}