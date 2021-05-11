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

class User_Controller extends Backend_Controller
{

	function __construct ()
	{
		parent::__construct();
                 $exception_uris = array(
			'login', 
			'login/logout'
		);
		if (in_array(uri_string(), $exception_uris) == FALSE) {
			if ($this->korisnik_m->loggedin() == FALSE) {
				redirect('login');
			}
		}
                $this->data['links']=$this->link_m->get_nested(3);
                $privilegija=$this->korisnik_m->get_privilege_id ();
                if($privilegija==1)
                {
                $links=$this->data['links'][]=array('naziv'=>'Administracija_sajta','putanja'=>'admin/dashboard');
                }
                else
                {

                }
                $links=$this->data['links'][]=array('naziv'=>'logout','putanja'=>'login/logout');
                
	}
}