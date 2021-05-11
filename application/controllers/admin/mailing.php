<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mailing
 *
 * @author Ivan
 */
class mailing extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model("novosti_m");
    }
    
    
    public function index(){
        $mains=array("1"=>"backend/admin/mails/index");
        $this->data['emaillist']=$this->novosti_m->get();
        $this->data['jezik']=$this->uri->segment(1);
        parent::template ($mains);
        
        
    }
    
    public function posalji()
    {
        $dugme=  $this->input->post("Posalji");
        if(isset($dugme))
        {
            
      $config['protocol'] = 'sendmail';
 $config['smtp_host'] = 'ssl://host29.dwhost.net';
 $config['smtp_user'] = 'office@privatnismestaji.com';
 $config['smtp_pass'] = 'Aleksferguson@';
 $config['smtp_port'] = 465;
 $config['charset'] = 'utf-8';
 $config['crlf'] = "\r\n";
 $config['newline'] = "\r\n";
$config['validation'] = FALSE;
 $config['mailtype'] = 'html';
 $config['starttls'] = TRUE;
$config['wordwrap'] = TRUE;

$this->load->library('email');
$this->email->initialize($config);
$message=  $this->input->post("poruka");
$emails=  $this->input->post("listofemails");
if (@is_array($emails))
                {
foreach ($emails as $email)
{


  $this->email->from('office@privatnismestaji.com', "Privatni Smestaj");

  $this->email->to("$email");
  
  $this->email->subject('Poslovni Predlog');
  $this->email->message(''.$message.'');


$this->email->send(); 
}

        }
    }
    redirect('sr/admin/mailing');
    }
    
    public function izmeni($id=NULL)
    {
        $mains=array("1"=>"backend/admin/mails/edit");
        $this->data['jezik']=$this->uri->segment(1);
        if($id!=NULL)
        $mail=$this->data['mail']=  $this->novosti_m->get_by(array('novosti_id'=>$id),TRUE);
        parent::template ($mains);
    }
    
    
    public function sacuvaj($id=NULL)
    {
        $button=$this->input->post('Sacuvaj');
        if($button)
        {
            $data =  $this->novosti_m->array_from_post(array("email"=>"email"));
            $this->novosti_m->save($data , $id);
        }
        redirect('sr/admin/mailing');
        
    }
    
    public function obrisi($id=NULL)
    {
        $this->novosti_m->delete($id);
        redirect('sr/admin/mailing');
    }
}
