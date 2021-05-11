<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pocetna
 *
 * @author Ivan
 */

class pocetna extends Frontend_Controller{
    //put your code here
    public function __construct() {
            parent::__construct();
            $this->load->library('session');
            $this->load->model('godina_m');
            $this->load->model('drzava_m');
            $this->load->model('grad_m');
            $this->load->library('session');
            $this->load->model('korisnik_m');
            $this->load->model('objekat_m');
            $this->load->model('smestajnajedinica_m');
            $this->load->model('korisnik_kontakt_m');
            $this->load->model("objekat_cene_m");
            $this->load->model('objekat_slika_m');
            $this->load->model('tip_m');
            $this->load->model('kategorija_m');
            $this->load->model('cenausezoni_m');
            $this->load->helper('text');
            $this->load->model("objekat_doba_m");
            $this->load->model("kategorija_m");
            $this->load->model("iznajmljujese_m");
            $this->load->model("objekat_iznajmljujese_m");
            $this->load->model("kapara_m");
            $this->load->model("karakteristika_m");
            $this->load->model("objekat_karakteristika_m");
            $this->load->model("legenda_m");
            $this->load->model("razdaljine_m");
            $this->load->model("objekat_razdaljine_m");
            $this->load->model("objekat_nacinplacanja_m");
            $this->load->model("nacinplacanja_m");
            $this->load->model("objekat_detaljan_cenovnik_m");
            $this->load->model("smestajnajedinica_m");
            $this->load->model("kalendar_popunjenosti_m");
            $this->load->model("smestajnajed_slika_m");
            $this->load->model("vrsta_m");
            $this->load->model("upit_m");
//            $this->load->model("rezervacija_m");
            $this->load->helper('text');

            $this->load->model("rating_m");
            $this->load->helper('cookie');
            
            $this->load->library('Facebook');
            $this->load->library("googleplus");

            
            
            
        }
        function ajax_calendar($tip=NULL,$objekat=NULL,$year = NULL , $month = NULL){           
            $jezik=  $this->uri->segment(1);
            if($tip=="smestaj")
            {
		$config= array(
           'start_day'=>'monday',
           'show_next_prev'=>true,
           'next_prev_url'=> "$jezik/ajax_calendar/smestaj/$objekat",
           
       );
       $smestajnejedinice=  $this->smestajnajedinica_m->get_by(array("objekat_id"=>$objekat));
       $niz=array();
       $cell=array();
       $zajebaniniz=array();
       $najzajebanijiniz=array();
       $brojsmestaja=  count($smestajnejedinice);
       foreach ($smestajnejedinice as $key2=>$smestajnajedinica)
       {

            $kalendar=$this->kalendar_popunjenosti_m->dohvati_datum($smestajnajedinica->smestajnajedinica_id,$year,$month);
            foreach($kalendar as $key1 => $kal)
            {  

                array_push($niz, $kal->datum);
                $counts = array_count_values($niz);
                if($counts[$kal->datum]==$brojsmestaja)
                {
                    array_push($zajebaniniz, $kal->datum);
                }               
            }

            $najzajebanijiniz= array_diff($niz, $zajebaniniz);
            
       }
       
       $najzajebanijiniz = array_values($najzajebanijiniz);
       for($i=0;$i<  count($najzajebanijiniz);$i++)
       {

          $days=preg_replace('/^0/', '',substr($najzajebanijiniz[$i], 8,2));
          $cell[$days]=  "<div class='plavo'></div>"; 
       }

       for($j=0;$j<  count($zajebaniniz);$j++)
       {
          $days=preg_replace('/^0/', '',substr($zajebaniniz[$j], 8,2));
          $cell[$days]=  "<div class='crveno'></div>"; 
       }

       $config["template"]= '

   {table_open}<table border="0" class="calendar table">{/table_open}

   {heading_row_start}<tr class="row header sredina">{/heading_row_start}

   {heading_previous_cell}<th class="col-md-2 prev_button"><div class="{previous_url}" style="color:white;cursor:pointer;">&lt;&lt;</div></th>{/heading_previous_cell}
   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
   {heading_next_cell}<th class="col-md-2 next_button" ><div class="{next_url}" style="color:white;cursor:pointer;"">&gt;&gt;</div></th>{/heading_next_cell}

   {heading_row_end}</tr>{/heading_row_end}

   {week_row_start}<tr class="row">{/week_row_start}
   {week_day_cell}<td class="col-md-2">{week_day}</td>{/week_day_cell}
   {week_row_end}</tr>{/week_row_end}

   {cal_row_start}<tr class="row days sredina">{/cal_row_start}
   {cal_cell_start}<td class="col-md-2 day">{/cal_cell_start}

   {cal_cell_content}
        
        <div class="day_num ">{day}</div>
        <div class="content">{content}</div>
   {/cal_cell_content}
   {cal_cell_content_today}<div class="day_num highlight">{day}</div>
        <div class="content">{content}</div>{/cal_cell_content_today}

   {cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
   {cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}

   {cal_cell_blank}&nbsp;{/cal_cell_blank}

   {cal_cell_end}</td>{/cal_cell_end}
   {cal_row_end}</tr>{/cal_row_end}

   {table_close}</table>{/table_close}
';
                
       $this->load->library('calendar', $config);
       $_html='<script type="text/javascript">
    $(document).ready(function(){
        
        $(".crveno").parent().parent().css("background-color","rgb(217, 83, 79)");
        $(".plavo").parent().parent().css("background-color","orange");
    });
            </script>';}
            if($tip=="smestajna_jedinica")
            {
              $kalendar=$this->kalendar_popunjenosti_m->dohvati_datum($objekat, $year,$month);
       $config= array(
           'start_day'=>'monday',
           'show_next_prev'=>true,
           'next_prev_url'=>"$jezik/ajax_calendar/smestajna_jedinica/$objekat",
           );
           
       $cell=array();
       $input=array();
       foreach($kalendar as $kal)
       {  
           $days=preg_replace('/^0/', '',substr($kal->datum, 8,2));
           $cell[$days]='<input type="hidden" class="ids" value="'.$kal->kalendar_popunjenosti_id.'"></input>';
       }
       
$config["template"]= '

   {table_open}<table border="0" class="calendar table">{/table_open}

   {heading_row_start}<tr class="row header sredina">{/heading_row_start}

   {heading_previous_cell}<th class="col-md-2 prev_button"><div class="{previous_url}" style="color:white;cursor:pointer;">&lt;&lt;</div></th>{/heading_previous_cell}
   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
   {heading_next_cell}<th class="col-md-2 next_button" ><div class="{next_url}" style="color:white;cursor:pointer;"">&gt;&gt;</div></th>{/heading_next_cell}

   {heading_row_end}</tr>{/heading_row_end}

   {week_row_start}<tr class="row">{/week_row_start}
   {week_day_cell}<td class="col-md-2">{week_day}</td>{/week_day_cell}
   {week_row_end}</tr>{/week_row_end}

   {cal_row_start}<tr class="row days sredina">{/cal_row_start}
   {cal_cell_start}<td class="col-md-2 day">{/cal_cell_start}

   {cal_cell_content}
        
        <div class="day_num ">{day}</div>
        <div class="content">{content}</div>
   {/cal_cell_content}
   {cal_cell_content_today}<div class="day_num highlight">{day}</div>
        <div class="content">{content}</div>{/cal_cell_content_today}

   {cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
   {cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}

   {cal_cell_blank}&nbsp;{/cal_cell_blank}

   {cal_cell_end}</td>{/cal_cell_end}
   {cal_row_end}</tr>{/cal_row_end}

   {table_close}</table>{/table_close}
';
       $this->load->library('calendar', $config);
       $_html='<script type="text/javascript">
    $(document).ready(function(){
        
        $(".content").parent().css("background-color","rgb(217, 83, 79)");
    });
</script>';  
            }
		$_html .= $this->calendar->generate($year,$month,$cell);
                
		echo $_html;
	}
        
    public function posaljimail()
    {
        
        $dugme=$this->input->post("Upit");
       
            $trenutnastrana=$this->input->post("trenutnastrana");
            
            $data=$this->upit_m->array_from_post(array("ime"=>"Ime","prezime"=>"Prezime","email"=>"Email","textupita"=>"Text","kontakt"=>"Telefon","objekat_id"=>"Objekat"));
            $data['datum']=  date("d m Y");
            $data['stanje']=0;
            $this->upit_m->save($data);
            $config['protocol'] = 'sendmail';
 $config['smtp_host'] = 'ssl://host29.dwhost.net';
 $config['smtp_user'] = 'office@privatnismestaji.com';
 $config['smtp_pass'] = 'Aleksferguson@';
 $config['smtp_port'] = 465;
 $config['charset'] = 'utf-8';
 $config['crlf'] = "\r\n";
 $config['newline'] = "\r\n";
$config['validation'] = TRUE;
 $config['mailtype'] = 'html';
 $config['starttls'] = TRUE;
$config['wordwrap'] = TRUE;

$id=  $this->input->post("Objekat");
 $objekat=  $this->objekat_m->get_by(array("objekat_id"=>"$id"),TRUE);
 $korisnik=  $this->korisnik_m->get_by(array("korisnik_id"=>$objekat->korisnik_id),TRUE);
 $message="<p>Ovo je automatski generisana poruka. Molimo Vas da na ovu poruku ne odgovarate.</p>---------------------------------------------------------------------------------<br/><br/>Postovani,<br/><br/><br/>Poslat vam je upit na portalu PrivatniSmestaji.com, molim vas odgovorite u sto skorijem roku.<br/><br/><br/>Vaš portal Privatni Smestaji";
    $this->load->library('email');
    $this->email->initialize($config);
    $this->email->from('office@privatnismestaji.com', "Upit - Privatni Smestaji");
    $this->email->to("$korisnik->email");
    $this->email->subject('Upit');
    $this->email->message($message);
    $this->email->send();  
    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert" style="margin-top:70px;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Uspesno ste poslali upit!</div>');
//            redirect($trenutnastrana);
    }
    
    public function rezervisi()
    {
        $dugme=  $this->input->post("rezervisi");
        if($dugme)
        {
            $data["smestajna_jed_id"]=  $this->input->post("izabranasmestajna");
            $data["cena"]=  $this->input->post("cenasmestaja");
            $data["ime_prezime"]=  $this->input->post("nameeeee");
            $data["telefon"]=  $this->input->post("phones");
            $data["email"]=  $this->input->post("emails");
            $data["datum_od"]=  $this->input->post("datetimepicker");
            $data["datum_do"]=  $this->input->post("datetimepickerr");
            $data["status"]=  1;
            $this->rezervacija_m->save($data);
            
        }
        $return=$this->input->post("returneds");
        redirect($return); 
    }
    public function glasaj()     
    {
        $objekat=$this->input->post('objekat');
        $trenutna=$this->input->post('trenutnastranaa');
        $kolacic=$this->input->cookie('glasao', TRUE);
        if($kolacic!=$objekat)
        {
        if($this->input->post('rating'))
        {   
            $cookie = array(
'name' => 'glasao',
'value' => "$objekat",
'expire' => time() + (10 * 365 * 24 * 60 * 60),
'path'   => "$trenutna",
);
$this->input->set_cookie($cookie);
            $rating=$this->input->post('rating');           
            $data['objekat_id']=$objekat;
            $data['ocena']=$rating;
            $this->rating_m->save($data);
            redirect($trenutna);
        }
        }
        else
        {
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert" style="margin-top:70px;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Ne mozete glasati vise od jedanput!!</div>');
        redirect($trenutna);
        }
    }

    public function lokacija($jezik=NULL,$drzava=NULL,$grad=NULL,$objekat=NULL,$smestajna=NULL)
    {
		$agaag=$this->drzava_m->get_by(array("putanja"=>$drzava,"status"=>1),TRUE);
		
		
//        make_new_file("ostali", NULL, "js", "js/ostalijs");
//        make_new_file("app", NULL, "js", "js/front_base");
                

        
        if($jezik==NULL)
        {
//        @$location = file_get_contents('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);
//         $location = file_get_contents('http://freegeoip.net/json/'.$_SERVER['REMOTE_ADDR']);
// print_r($location);
//        $lokacija=array();
//        $podatci=explode(",", $location);
//        foreach ($podatci as $key =>$podatak)
//        {
//            
//            $podatci1=explode(":", $podatak);
//            foreach ($podatci1 as $podatak1)
//            {
//                if($podatak1%2==0)
//                $lokacija[$key]=preg_replace("/[^a-zA-Z0-9]+/", "", $podatak1);
//            }
//        
//        }
//        
//        if(@$lokacija[2]=="Serbia" || @$lokacija[2]=="Bosnia" || @$lokacija[2]=="Croatia")
//        {
//            $jezik="sr";  
//        }
//        else if(@$lokacija[2]==NULL)
//        {
//            $jezik="sr";  
//        }
//        else
//        {
//            $jezik="en"; 
//        }
//@$user_ip = getenv('REMOTE_ADDR');
//@$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
//@$country = $geo["geoplugin_countryName"];
//if($country!=NULL)
//{
//if($country=="Serbia" || $country=="Bosnia" || $country=="Croatia")
//        {
            $jezik="sr";  
//        }
//        else
//        {
//            $jezik="en"; 
//        }
//        }
//        else
//        {
//           $jezik="sr";
//
//        }
        }
        
        
        if($jezik!=NULL)
        {
            
            setcookie('googtrans', '/sr/'.$jezik);
            $niz=  array("naziv"=>  translate("Smeštaj,Apartmani,Sobe - Letovanje|Zimovanje", $jezik));
            $page=(object)$niz;
            $this->data['page']=$page;

//            $this->data["google_login_url"]=  $this->googleplus->url();
            
            $data['user'] = array();

		if ($this->facebook->logged_in())
		{
			$user = $this->facebook->user();
			if ($user['code'] === 200)
			{
				unset($user['data']['permissions']);
				$data['user'] = $user['data'];
                                $this->korisnik_m->facebook_login($data);                             
			}

		}
            $this->data['facebook_login_url']=$this->facebook->login_url();

            
        $smestajns=array();
$godina=  $this->data["godina"]=date("Y");
$mesec=$this->data["mesec"]=date("m");
        $this->db->like("datum",$godina."-".$mesec,"after");
        $akcija=$this->kalendar_popunjenosti_m->get_by(array("status"=>2));
        foreach($akcija as $ak)
        {
            if(!in_array($ak->smestajna_jed_id, $smestajns))
            {
                array_push($smestajns, $ak->smestajna_jed_id);
            }
        }
        foreach($smestajns as $kljuc=>$sm)
        {
            $smestajna_jedinicaa=  $this->smestajnajedinica_m->get_by(array("smestajnajedinica_id"=>$sm,"status"=>1),TRUE);
            $this->data["akcija"][$kljuc]=$smestajna_jedinicaa;
        }
        
        $this->data['objekti']=  $this->objekat_m->get();
        $this->data['ulogovan']=$this->korisnik_m->loggedin();
        
        $centar=$this->data['centar']=$this->link_m->get_nested(1);
        
        $this->data['drzave']=  $this->drzava_m->get();
        
            $this->db->limit(16);
            $this->db->order_by("posecenost","desc");
            $najposeceniji=$this->data["najposeceniji"]=  $this->objekat_m->get_by(array("status"=>1));

            
            $this->db->limit(16);
            $this->data["randomsmestjane"]=  $this->smestajnajedinica_m->get_by(array("status"=>1));
            
            
            
            
            $this->data["jezik"]=$jezik;
           
            $this->data['scripts']['extern2']='ostalijs/img';
            $menus=array("1"=>"frontend/pocetna/index");
            
             
        }

        
        
        if($drzava!=NULL)
        {
            $this->data['jezik']=$jezik;
            $drzavaa=$this->data['drzava'] =  $this->drzava_m->get_by(array("putanja"=>$drzava,"status"=>1),TRUE);
            $this->data['objekti']=  $this->objekat_m->join(array("grad"=>"objekat.grad_id=grad.grad_id","drzava"=>"grad.drzava_id=drzava.drzava_id"),array("drzava.drzava_id"=>$drzavaa->drzava_id));
            $niz=  array("naziv"=>"$drzavaa->naziv");
            $page=(object)$niz;
            
            $this->data['page']=$page;
            $this->data['scripts']=array();
            $menus=array("1"=>"frontend/drzava/index");
            
            
        }
        if($grad!=NULL)
        {
            $gradd=$this->data['grad']=$this->grad_m->get_by(array("putanja"=>$grad,"drzava_id"=>$drzavaa->drzava_id,"status"=>1),TRUE);
            $objekti="";
            $star=NULL;
            $tip=NULL;
            $gradid=NULL;
            if(isset($_GET['stars']))
            {
                $stars=$_GET['stars'];
                $star=str_split($stars);      
            }
            if(isset($_GET['type']))
            {
               $type=$_GET['type'];
               $tip=str_split($type); 
            }
            
            if(isset($gradd->grad_id))
            {
                $gradid=$gradd->grad_id;
            }
            
            $objekti=$this->objekat_m->get_by_in(array("grad_id"=>array($gradid),"kategorija_id"=>$star,"tip_id"=>$tip));
            
            $count=count($objekti);
            
            $perpage = 10;
		if ($count > $perpage) {
			$this->load->library('pagination');
			$config['base_url'] = site_url($this->uri->segment(1) . '/'.$this->uri->segment(2).'/'.$this->uri->segment(3)."/strana/");
                        
                        if (count($_GET) > 0) $config['suffix'] = '?'.urldecode(http_build_query($_GET, '', "&"));
                        $config['first_url'] = $config['base_url'] . $config['suffix'];
			$config['total_rows'] = $count;
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 5;
//                        $config['use_page_numbers'] = TRUE;
			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();
			$offset = $this->uri->segment(5);
		}
		else {
			$this->data['pagination'] = '';
			$offset = 0;
		}
                
                
                
                $this->db->limit($perpage, $offset);
                $this->data['objekti1'] = $this->objekat_m->get_by_in(array("grad_id"=>array($gradid),"status"=>1,"kategorija_id"=>$star,"tip_id"=>$tip),FALSE);
                
                $this->data['objekti11'] = $this->objekat_m->get_by_in(array("grad_id"=>array($gradid),"status"=>1,"kategorija_id"=>$star,"tip_id"=>$tip),FALSE);
		
                
                
               
                
                
            
            @$niz=  array("naziv"=>"$gradd->naziv");
            $page=(object)$niz;
            $this->data['page']=$page;
            if($gradd==NULL)
            {
                show_404(current_url());   
            }
            $menus=array("1"=>"frontend/objekti/_page_objects","2"=>"frontend/objekti/_page_map");
             $this->data['scripts']=array();
            $this->data['body']=array('onLoad'=>'initialize();');
        }
        if($objekat!=NULL)
        {
            if(substr( $objekat, 0, 6 ) !== "strana")
            {
                $br=explode("-", $objekat);
                $broj=count($br);
                
                
                $objekatt=$this->data['objekat']=  $this->objekat_m->get_by(array("objekat_id"=>$br[$broj-1],"grad_id"=>$gradd->grad_id,"status"=>1),TRUE);
                if($this->uri->segment(4)!=  strtolower(str_replace(" ","-", normalize($objekatt->naziv)."-".$objekatt->objekat_id)))
                {
                   show_404(current_url()); 
                }
                $this->data['objekti']=$this->objekat_m->get_by(array("objekat_id"=>$br[$broj-1],"grad_id"=>$gradd->grad_id));
                if($objekatt==NULL)
                {
                    show_404(current_url());  
                }
                $niz=  array("naziv"=>"$objekatt->naziv");
                $page=(object)$niz;
                $this->data['page']=$page;
                $this->data['scripts']['extern1']='ajax';
                
                $config= array(
           'start_day'=>'monday',
           'show_next_prev'=>true,
           'next_prev_url'=>"$jezik/ajax_calendar/smestaj/$objekatt->objekat_id",
           
       );
                
         
        if($smestajna==NULL)
       {
           $smestajna=  date("Y");
       }
       
           $year= date("m");
           
        if(ctype_alnum ( $smestajna )){       
       $smestajnejedinice=  $this->smestajnajedinica_m->get_by(array("objekat_id"=>$objekatt->objekat_id));
       $niz=array();
       $cell=array();
       $zajebaniniz=array();
       $najzajebanijiniz=array();
       $brojsmestaja=  count($smestajnejedinice);
       foreach ($smestajnejedinice as $key2=>$smestajnajedinica)
       {
           
            
            $kalendar=$this->kalendar_popunjenosti_m->dohvati_datum($smestajnajedinica->smestajnajedinica_id,$smestajna,$year);
            
            foreach($kalendar as $key1 => $kal)
            {  
                array_push($niz, $kal->datum);
                $counts = array_count_values($niz);

                if($counts[$kal->datum]==$brojsmestaja)
                {
                    array_push($zajebaniniz, $kal->datum);
                }               
            }
            
            $najzajebanijiniz= array_diff($niz, $zajebaniniz);
            
       }
       
       $najzajebanijiniz = array_values($najzajebanijiniz);
       for($i=0;$i<  count($najzajebanijiniz);$i++)
       {

          $days=preg_replace('/^0/', '',substr($najzajebanijiniz[$i], 8,2));
          $cell[$days]=  "<div class='plavo'></div>"; 
       }
      
       for($j=0;$j<  count($zajebaniniz);$j++)
       {
          $days=preg_replace('/^0/', '',substr($zajebaniniz[$j], 8,2));
          $cell[$days]=  "<div class='crveno'></div>"; 
       }
       
//$days=preg_replace('/^0/', '',substr($kal->datum, 8,2));
//                $cell[$days]=  $kal->ime_prezime;
       
                
                
                      $config["template"]= '

   {table_open}<table border="0" class="calendar table">{/table_open}

   {heading_row_start}<tr class="row header sredina">{/heading_row_start}

   {heading_previous_cell}<th class="col-md-2 prev_button"><div class="{previous_url}" style="color:white;cursor:pointer;">&lt;&lt;</div></th>{/heading_previous_cell}
   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
   {heading_next_cell}<th class="col-md-2 next_button" ><div class="{next_url}" style="color:white;cursor:pointer;"">&gt;&gt;</div></th>{/heading_next_cell}

   {heading_row_end}</tr>{/heading_row_end}

   {week_row_start}<tr class="row">{/week_row_start}
   {week_day_cell}<td class="col-md-2">{week_day}</td>{/week_day_cell}
   {week_row_end}</tr>{/week_row_end}

   {cal_row_start}<tr class="row days sredina">{/cal_row_start}
   {cal_cell_start}<td class="col-md-2 day">{/cal_cell_start}

   {cal_cell_content}
        
        <div class="day_num ">{day}</div>
        <div class="content">{content}</div>
   {/cal_cell_content}
   {cal_cell_content_today}<div class="day_num highlight">{day}</div>
        <div class="content">{content}</div>{/cal_cell_content_today}

   {cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
   {cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}

   {cal_cell_blank}&nbsp;{/cal_cell_blank}

   {cal_cell_end}</td>{/cal_cell_end}
   {cal_row_end}</tr>{/cal_row_end}

   {table_close}</table>{/table_close}
';
                
          
       $this->load->library('calendar', $config);
       $this->data["kalendar"]=  $this->calendar->generate($smestajna,$year,$cell);} 
                  $this->data['scripts']=array();
                
                $menus=array("1"=>"frontend/objekat/index","2"=>"frontend/components2/_page_footer");

            }
            
    }
    
        if($smestajna!=NULL && $objekat!="strana" && !ctype_alnum ( $smestajna ))
        {
            $smestajna=$this->uri->rsegment(7);
            $broj=  explode("-", $smestajna);
            $brs=count($broj);
            $broj=$broj[$brs-1];

            $br=explode("-", $objekat);
            
            $smestajna_jed=  $this->smestajnajedinica_m->get_by(array("objekat_id"=>$objekatt->objekat_id,"smestajnajedinica_id"=>$broj),TRUE);

            if($smestajna_jed==NULL)
            {
              show_404(current_url());    
            }
            $niz=  array("naziv"=>"$smestajna_jed->naziv");
            $page=(object)$niz;
            $this->data['page']=$page;
            $this->data['smestajna']=$smestajna_jed;
            
            $config= array(
           'start_day'=>'monday',
           'show_next_prev'=>true,
           'next_prev_url'=>"$jezik/ajax_calendar/smestajna_jedinica/$broj",
           
       );
            

       $year=  date("Y");

       

           $month= date("m");

       
       
       $kalendar=$this->kalendar_popunjenosti_m->dohvati_datum($smestajna_jed->smestajnajedinica_id, $year,$month);
       
       $cell=array();
       $input=array();
       foreach($kalendar as $kal)
       {  
           $days=preg_replace('/^0/', '',substr($kal->datum, 8,2));
           $cell[$days]=$kal->ime_prezime.'<input type="hidden" class="ids" value="'.$kal->kalendar_popunjenosti_id.'"></input>';
       }
       
$config["template"]= '

   {table_open}<table border="0" class="calendar table">{/table_open}

   {heading_row_start}<tr class="row header sredina">{/heading_row_start}

   {heading_previous_cell}<th class="col-md-2 prev_button"><div class="{previous_url}" style="color:white;cursor:pointer;">&lt;&lt;</div></th>{/heading_previous_cell}
   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
   {heading_next_cell}<th class="col-md-2 next_button" ><div class="{next_url}" style="color:white;cursor:pointer;"">&gt;&gt;</div></th>{/heading_next_cell}

   {heading_row_end}</tr>{/heading_row_end}

   {week_row_start}<tr class="row">{/week_row_start}
   {week_day_cell}<td class="col-md-2">{week_day}</td>{/week_day_cell}
   {week_row_end}</tr>{/week_row_end}

   {cal_row_start}<tr class="row days sredina">{/cal_row_start}
   {cal_cell_start}<td class="col-md-2 day">{/cal_cell_start}

   {cal_cell_content}
        
        <div class="day_num ">{day}</div>
        <div class="content">{content}</div>
   {/cal_cell_content}
   {cal_cell_content_today}<div class="day_num highlight">{day}</div>
        <div class="content">{content}</div>{/cal_cell_content_today}

   {cal_cell_no_content}<div class="day_num">{day}</div>{/cal_cell_no_content}
   {cal_cell_no_content_today}<div class="day_num highlight">{day}</div>{/cal_cell_no_content_today}

   {cal_cell_blank}&nbsp;{/cal_cell_blank}

   {cal_cell_end}</td>{/cal_cell_end}
   {cal_row_end}</tr>{/cal_row_end}

   {table_close}</table>{/table_close}
';
       $this->load->library('calendar', $config);
            $this->data["kalendar"]=  $this->calendar->generate($year,$month,$cell);
 $this->data['scripts']=array();
            $menus=array("1"=>"frontend/smestajna/index","2"=>"frontend/components2/_page_footer");
        }

        

        

        
        
        $this->data['drzave']=  $this->drzava_m->get();  
        $this->data['ulogovan']=$this->korisnik_m->loggedin();
        
        $centar=$this->data['centar']=$this->link_m->get_nested(1);
        
        if($drzava==NULL && $grad==NULL && $objekat==NULL && $smestajna==NULL)
        {
            parent::template_novi1 ($menus);  
        }
        else
        {
            parent::template_novi2 ($menus); 
        }
          
    }
    
    
    
    

            

    
    
    
}
