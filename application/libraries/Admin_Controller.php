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

class Admin_controller extends Backend_Controller
{

	function __construct ()
	{
	parent::__construct();
                $exception_uris = array(
			'login', 
			'login/logout'
		);
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if ($this->korisnik_m->loggedin() == TRUE) {
                            if($this->korisnik_m->get_privilege_id ()!=1)
                            {
				redirect('login');
                            }
			}
		}
        
        $this->data['links']=$this->link_m->get_nested(2);
                
	}
}