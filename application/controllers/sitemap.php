<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sitemap
 *
 * @author Ivan
 */
class sitemap extends Frontend_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
       $url = "".  base_url()."sitemap.xml";
       $dom=new DOMDocument();
       $dom->load(@$url); 
       $root=$dom->documentElement; // This can differ (I am not sure, it can be only documentElement or documentElement->firstChild or only firstChild)
       $nodesToDelete=array();
       $urls=$root->getElementsByTagName('url');
       $prioritet=1;
       foreach ($urls as $urlss) {
       $loc=$urlss->getElementsByTagName('loc')->item(0)->textContent;
       $broj=substr_count($loc, '/');
        
        if($broj==3)
        {
            $prioritet;
        }
        if($broj==4)
        {
            $prioritet=0.9;
        }
        if($broj==5)
        {
            $prioritet=0.8;
        }
        if($broj==6)
        {
            $prioritet=0.7;
        }
        if($broj==7)
        {
            $prioritet=0.6;
        }
        if($broj==8)
        {
            $prioritet=0.5;
        }
        if($broj==9)
        {
            $prioritet=0.4;
        }
        if($broj==10)
        {
            $prioritet=0.3;
        }
        if($broj==11)
        {
            $prioritet=0.2;
        }
        if($broj==12)
        {
            $prioritet=0.1;
        }
        if($broj>=13)
        {
            $prioritet=0.9;
        }
        $priority=$urlss->getElementsByTagName('priority')->item(0)->textContent=$prioritet;
       }
       $dom->Save("sitemap1.xml");
       
       $this->load->view('frontend/sitemap/index',  $this->data);
         
    }
}
