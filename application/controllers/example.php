<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of example
 *
 * @author Ivan
 */
class example extends Frontend_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();

        // To use site_url and redirect on this controller.
        $this->load->helper('url');
	}
        public function index()
        {
            $this->load->library("Facebook_new");
            
        }
        public function loging()
        {
            $this->load->library("googleplus");
            $authUrl=  $this->googleplus->url();
            if (isset($_GET['code'])) {
            $user=$this->googleplus->get_user($_GET['code']);
            $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
            var_dump($email);
            }
            echo "<a class='login' href='" . $authUrl . "'><img src='".base_url()."img/signin_button.png' height='50px'/></a>";
        }
	public function login(){

	$this->load->library('facebook'); // Automatically picks appId and secret from config
        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));

	$user = $this->facebook->getUser();

        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me?fields=email,name,id,gender,cover,link');
            } catch (FacebookApiException $e) {
                $user = null;
            }
        }else {
            $this->facebook->destroySession();
        }

        if ($user) {

            $data['logout_url'] = site_url('example/logout'); // Logs off application
            // OR 
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();

        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('example/login'), 
                'scope' => array("email") // permissions here
            ));
        }
        $this->load->view('login',$data);

	}

    public function logout(){

        $this->load->library('facebook');

        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.

        redirect('example/login');
    }
}
