<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Uputstva
 *
 * @author Ivan
 */
class uputstva extends User_Controller{
    //put your code here
    
    public function __construct() {
        parent::__construct();
    }
    
    public function smestaja()
    {
       $jezik=  $this->data["jezik"]= $this->uri->segment(1); 
       $niz=  array("naziv"=>translate("Uputstvo za pravljenje smestaja",$jezik));
        $page=(object)$niz;
        $this->data['page']=$page;
        
        
        $main=array('1'=>'backend/user/manual/index');
        
        parent::template ($main,TRUE);
    }
}
