<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of korisnik_m
 *
 * @author Ivan
 */
class Korisnik_M extends MY_Model
{
	
	protected $_table_name = 'korisnik';
        protected $_primary_key = 'korisnik_id';
	protected $_order_by = 'ime';
	public $rules = array(
		'email' => array(
			'field' => 'email1', 
			'label' => 'Email', 
			'rules' => 'trim|required|valid_email|xss_clean'
		), 
		'password' => array(
			'field' => 'password1', 
			'label' => 'Password', 
			'rules' => 'trim|required'
		)
	);
        
        public $rules_admin_login=array(
		'email' => array(
			'field' => 'email', 
			'label' => 'Email', 
			'rules' => 'trim|required|valid_email|xss_clean'
		), 
		'password' => array(
			'field' => 'password', 
			'label' => 'Password', 
			'rules' => 'trim|required'
		)
	);
       
        
        public $registracija = array(
            'ime'=> array(
                    'field'=>'ime',
                    'label'=>'Ime',
                    'rules'=>'trim|required|min_length[3]|max_length[10],xss_clean',
            ),
            'prezime'=>array(
                    'field'=>'prezime',
                    'label'=>'Prezime',
                    'rules'=>'trim|required|min_length[3]|max_length[10],xss_clean',
            ),
            'email'=>array(
                    'field'=>'email',
                    'label'=>'Email',
                    'rules'=>'trim|required|min_length[3]|xss_clean|valid_email|is_unique[korisnik.email]',
            ),
            'password' => array(
                    'field'=>'password',
                    'label'=>'Password',
                    'rules'=>'trim|required|xss_clean',
            ),
            'password' => array(
                    'field'=>'ponovljen',
                    'label'=>'Password confirmation',
                    'rules'=>'trim|required|xss_clean',
            ),
            'drzava' => array(
                    'field'=>'drzava',
                    'label'=>'Drzava',
                    'rules'=>'trim|required',
            ),
            'grad'=>array(
                    'field'=>'grad',
                    'label'=>'Grad',
                    'rules'=>'trim|required',
            ),
        );

        protected $_timestamps =True;
        
	function __construct ()
	{
		parent::__construct();
                $this->load->model('privilegija_m');
	}
        public function facebook_login($datas)
        {
            $user = $this->get_by(array(
			'email' => $datas['user']['email'],
                        'potvrda' => 1,
		), TRUE);
            if(count($user)==1)
            {
                $data = array(
                        'ime' => $user->ime,
                        'email' => $user->email,
                        'korisnik_id' => $user->korisnik_id,
                        'privilegija_id' => $user->privilegija_id,
                        'loggedin' => TRUE,
                );
                $this->session->set_userdata($data);
                if($this->session->userdata('loggedin')==TRUE)
                {
                    return TRUE;
                }
            }
            else {
                $data['ime']=$datas['user']['first_name'];
                $data['prezime']=$datas['user']['last_name'];
                $data['email']=$datas['user']['email'];
                $data["max_smestaja"]=1;
                $data["max_smestajnih_jed"]=1;
                $data["rand"]=rand();
                $data['potvrda']=1;
                $privilegija=$this->privilegija_m->get_by(array("registracija"=>1),TRUE);
                $data["privilegija_id"]=$privilegija->privilegija_id;
                $this->korisnik_m->save($data);
                $this->session->set_userdata($data);
                $user = $this->get_by(array(
			'email' => $datas['user']['email'],
                        'potvrda' => 1,
		), TRUE);
                $data = array(
                        'ime' => $user->ime,
                        'email' => $user->email,
                        'korisnik_id' => $user->korisnik_id,
                        'privilegija_id' => $user->privilegija_id,
                        'loggedin' => TRUE,
                    );
                if($this->session->userdata('loggedin')==TRUE)
                {
                    return TRUE;
                }
            }
            
            
        }
	public function login ($user=NULL,$pass=NULL)
	{
		$user = $this->get_by(array(
			'email' => $user,
			'password' => $this->hash($pass),
                        'potvrda' => 1,
		), TRUE);
                

		if (count($user)==1) {
			// Log in user
			$data = array(
				'ime' => $user->ime,
				'email' => $user->email,
				'korisnik_id' => $user->korisnik_id,
                                'privilegija_id' => $user->privilegija_id,
				'loggedin' => TRUE,
			);
			
                        
		}
                $this->session->set_userdata($data);
                if($this->session->userdata('loggedin')==TRUE)
                {
                    return TRUE;
                }
	}

	public function logout ()
	{
		$this->session->sess_destroy();
	}

	public function loggedin ()
	{
		return (bool) $this->session->userdata('loggedin');
	}
        
        public function get_privilege_id ()
	{
		return  $this->session->userdata('privilegija_id');
	}
	
	public function get_new(){
		$user = new stdClass();
		$user->name = '';
		$user->email = '';
		$user->password = '';
		return $user;
	}

	public function hash ($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}
}