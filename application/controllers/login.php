<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author Ivan
 */
class login extends Backend_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        
        $this->load->library("googleplus");
    }
    

    public function google_login()
    {
        if (isset($_GET['code'])) {
            $user=$this->googleplus->get_user($_GET['code']);
            var_dump($user);
            }
    }
    public function index()
    {
       // Redirect a user if he's already logged in
        $admin_dashboard = 'sr/admin/dashboard';
        $user_dashboard = 'sr/korisnik/dashboard';
        $this->korisnik_m->get_privilege_id() != 1 || redirect($admin_dashboard);
        $this->korisnik_m->get_privilege_id() != 2 || redirect($user_dashboard);
        $this->korisnik_m->get_privilege_id() != 3 || redirect($user_dashboard);
        
        
        
        $button=  $this->input->post('btnLogin');
        $button1=  $this->input->post('provera');
        
        if($button1)
        {
            $provera=  $this->input->post('logovanje1');
            $provera1=  $this->input->post('pass1');
            if($provera=='alex' && $provera1=='ferguson')
            {      
              $propusti=TRUE;
              
            }
            else
            {
                $propusti=FALSE;       
            }
             
        }
        else if($button)
        {
         $propusti=TRUE;  
        }
        else
        {
           $propusti=FALSE;  
        }
        
        
        if($propusti==FALSE)
        {
        
        
        
        add_meta_title('Zastita pre logovanja');
        $this->data['css']=array('extern1'=>'page_login');
        $this->load->view('backend/components/_page_head',  $this->data);
        $this->load->view('_page_login_1',  $this->data);
        $this->load->view('backend/components/_page_footer',  $this->data);
        }
        
        
        if($propusti==TRUE)
        {
		
                
        // Set form
		$rules = $this->korisnik_m->rules_admin_login;
		$this->form_validation->set_rules($rules);
		
		// Process form
                if(!empty($button))
                {
		if ($this->form_validation->run() == TRUE) {
			// We can login and redirect
                    $email=  $this->input->post('email');
                    $pass=  $this->input->post('password');
                    
			if ($this->korisnik_m->login($email,$pass) == TRUE) {
                            if($this->korisnik_m->get_privilege_id() == 1)
				redirect($admin_dashboard);
                            else
                                redirect($user_dashboard);
			} 
			
			else {
				$this->session->set_flashdata('error', 'That email/password combination does not exist');
				redirect('login', 'refresh');
			}
                }
		}
                
		
		// Load view
		add_meta_title('Login');
                
                
                $this->data['css']=array('extern1'=>'page_login');
                $this->load->view('backend/components/_page_head',  $this->data);
                $this->load->view('_page_login',  $this->data);
                $this->load->view('backend/components/_page_footer',  $this->data);
        }
    }
    public function logout()
    {
        $this->load->library('facebook');
        // Logs off session from website
        $this->facebook->destroy_session();
        // Make sure you destory website session as well.
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('access_token_secret');
        $this->session->unset_userdata('request_token');
        $this->session->unset_userdata('request_token_secret');
        $this->session->unset_userdata('twitter_user_id');
        $this->session->unset_userdata('twitter_screen_name');
        
        $this->korisnik_m->logout();
        redirect(base_url());
    }
}
