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

class Frontend_Controller extends MY_Controller
{

	function __construct ()
	{
		parent::__construct();
                $this->load->model('link_m');
                $this->load->helper('cookie');
                $this->load->helper('cms_helper');
                $this->load->library('form_validation');
                $this->load->helper('form');
                
	}
        
        
        public function template_novi ($mains=NULL,$sidebars=NULL)
        {
            
            add_meta_title($this->data['page']->naziv,  $this->data["jezik"]);
                
            
            
            
            
            $this->load->view('frontend/components1/_page_head',  $this->data);
            $this->load->view('frontend/components1/_page_menu',  $this->data);
            $this->load->view('frontend/components1/_page_location-social',  $this->data);
            $this->load->view('frontend/components1/_page_map',  $this->data);
            if(count($mains)!=NULL)
            {
                foreach($mains as $main)
                {
                $this->load->view($main,  $this->data);
                }
            }

            $this->load->view('frontend/components1/_page_footer',  $this->data); 
            $this->load->view('frontend/components1/_page_animations',  $this->data);
        }
        
        public function template_novi2 ($mains=NULL,$sidebars=NULL)
        {
            add_meta_title($this->data['page']->naziv,  $this->data["jezik"]);
            
            $this->load->view('frontend/components2/_page_head',  $this->data);
            $this->load->view('frontend/objekti/_page_menu',  $this->data);
            if(count($mains)!=NULL)
            {
                foreach($mains as $main)
                {
                $this->load->view($main,  $this->data);
                }
            }

            $this->load->view('frontend/components1/_page_animations',  $this->data);
            $this->load->view('frontend/components2/_page_end',  $this->data);
        }
        public function template_novi1 ($mains=NULL,$sidebars=NULL)
        {
            add_meta_title($this->data['page']->naziv,  $this->data["jezik"]);
            $this->load->view('frontend/components2/_page_head',  $this->data);
            $this->load->view('frontend/components2/_page_menu',  $this->data);
            $this->load->view('frontend/components2/_page_header',  $this->data);
            if(count($mains)!=NULL)
            {
                foreach($mains as $main)
                {
                $this->load->view($main,  $this->data);
                }
            }

            $this->load->view('frontend/components2/_page_footer',  $this->data); 
            $this->load->view('frontend/components1/_page_animations',  $this->data);
            $this->load->view('frontend/components2/_page_end',  $this->data);
        }
}