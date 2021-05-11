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
class kalendar_popunjenosti extends User_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model("kalendar_popunjenosti_m");
$this->load->helper('date');
    }
    
    public function izmeni($id=NULL,$year=NULL,$month=NULL)
    {
       
       $jezik=  $this->data["jezik"]=  $this->uri->segment(1);
       $mains=  array('1'=>"backend/user/calendar/index");
       $config= array(
           'start_day'=>'monday',
           'show_next_prev'=>true,
           'next_prev_url'=>  base_url()."$jezik/korisnik/kalendar_popunjenosti/izmeni/$id"
           
       );
       
       if($year==null)
       {
           $year=  date("Y");
       }
       
       if($month==NULL)
       {
           $month= date("m");
       }
       
       
       
       if($this->input->post("obrisiod") && $this->input->post("obrisido"))
       {
           $pocetak=$this->input->post("obrisiod");
           $kraj=$this->input->post("obrisido");
           for($i=$pocetak;$i<=$kraj;$i++)
           {
               $this->kalendar_popunjenosti_m->delete(NULL,array("datum"=>$year."-".$month."-".$i,"smestajna_jed_id"=>$id));
           }
       }
       
       if($this->input->post("datumod") && $this->input->post("datumdo"))
       {
           $od=$this->input->post("datumod");
           $do=$this->input->post("datumdo");
           $ime=  $this->input->post("nameandsur");
           $cena=$this->input->post("price");
           $status=$this->input->post("status");
           for($i=$od;$i<=$do;$i++)
           {
               $data["smestajna_jed_id"]=$id;
               $data["datum"]=$year."-".$month."-".$i;
               $data["ime_prezime"]=$ime;
               $data["status"]=$status;
               $data['cena']=$cena;
               $ids=  $this->kalendar_popunjenosti_m->get_by(array("datum"=>$year."-".$month."-".$i,"smestajna_jed_id"=>$id),TRUE);
               if(!empty($ids))
               {
                    $this->kalendar_popunjenosti_m->save($data,$ids->kalendar_popunjenosti_id);    
               }
               else
               {
                    $this->kalendar_popunjenosti_m->save($data);
               }
           }
//           $idks=$this->input->post("kalendar_id");
//
//           $text=$this->input->post("ime_prezime");
//           $dayd=$this->input->post("day");
//           $data["smestajna_jed_id"]=$id; 
//           $data["datum"]=$year."-".$month."-".$dayd;
//           $data["ime_prezime"]=$text;
//           if($idks!=NULL)
//           {
//               $this->kalendar_popunjenosti_m->save($data,$idks);
//           }
//           else
//           {
//               $this->kalendar_popunjenosti_m->save($data);
//           }
       }
       
       
       $kalendar=$this->kalendar_popunjenosti_m->dohvati_datum($id, $year,$month);
       $cell=array();
       $input=array();
       foreach($kalendar as $kal)
       {  
           $days=preg_replace('/^0/', '',substr($kal->datum, 8,2));
           if($kal->status==1)
           $cell[$days]=$kal->ime_prezime." ".$kal->cena.'€<div class="rezervisano"></div><input type="hidden" class="ids" value="'.$kal->kalendar_popunjenosti_id.'"></input>';
           else
           $cell[$days]=$kal->ime_prezime." ".$kal->cena.'€<div class="akcija"></div><input type="hidden" class="ids" value="'.$kal->kalendar_popunjenosti_id.'"></input>';
       }
       
       $config["template"]= '

   {table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

   {heading_row_start}<tr class="row header">{/heading_row_start}

   {heading_previous_cell}<th class="col-md-2"><a href="{previous_url}" style="color:white;">&lt;&lt;</a></th>{/heading_previous_cell}
   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
   {heading_next_cell}<th class="col-md-2"><a href="{next_url}" style="color:white;">&gt;&gt;</a></th>{/heading_next_cell}

   {heading_row_end}</tr>{/heading_row_end}

   {week_row_start}<tr class="row ">{/week_row_start}
   {week_day_cell}<td class="col-md-2">{week_day}</td>{/week_day_cell}
   {week_row_end}</tr>{/week_row_end}

   {cal_row_start}<tr class="row days" >{/cal_row_start}
   {cal_cell_start}<td class="col-md-2 day">{/cal_cell_start}

   {cal_cell_content}    
        <div class="day_num " style="text-align:center;">{day}</div>
        <div class="content" >{content}</div>
   {/cal_cell_content}
   
   {cal_cell_content_today}<div class="day_num highlight" style="text-align:center;">{day}</div>
        <div class="content">{content}</div>{/cal_cell_content_today}

   {cal_cell_no_content}<div class="day_num " id="{day}" style="text-align:center;">{day}</div>{/cal_cell_no_content}
   {cal_cell_no_content_today}<div class="day_num highlight" id="{day}" style="text-align:center;">{day}</div>{/cal_cell_no_content_today}

   {cal_cell_blank}&nbsp;{/cal_cell_blank}

   {cal_cell_end}</td>{/cal_cell_end}
   {cal_row_end}</tr>{/cal_row_end}

   {table_close}</table>{/table_close}
';

      
       $this->load->library('calendar', $config);
       $this->data['scripts']=array("extern1"=>"bootstrap-switch");
       $this->data['css']=array('extern1'=>"bootstrap-switch");
       $this->data["kalendar"]=  $this->calendar->generate($year,$month,$cell);
       
       parent::template ($mains,TRUE);
    }
}
