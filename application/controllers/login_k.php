<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login_k
 *
 * @author Ivan
 */
class login_k extends Backend_Controller{
    
    public function login()
    {
       
        $user_dashboard = 'sr/korisnik/dashboard';
        $this->korisnik_m->get_privilege_id() != 2 || redirect($user_dashboard);
        $this->korisnik_m->get_privilege_id() != 3 || redirect($user_dashboard);
        
        
        $button=  $this->input->post('btnLoginn');
        $rules = $this->korisnik_m->rules;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            
                if(!empty($button))
                {

                    $email=  $this->input->post('email1');
                    $pass=  $this->input->post('password1');
                    
			if ($this->korisnik_m->login($email,$pass) == TRUE) {                        
                            if($this->korisnik_m->get_privilege_id() != 1)
                            {
                                redirect($user_dashboard);
                            }
                            else
                            {
                                redirect("login/logout");
                            }
			}
                        else
                        {
                           redirect("login/logout"); 
                        }
		}
        


    }
    else {
            $this->session->set_flashdata('error', validation_errors());
            redirect("login/logout"); 
        }
   }
}
