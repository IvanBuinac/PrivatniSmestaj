<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of objekat
 *
 * @author Ivan
 */
class smestaji extends User_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('grad_m');
        $this->load->model('godina_m');
        $this->load->model('drzava_m');
        $this->load->model('kategorija_m');
        $this->load->model('tip_m');
        $this->load->model('iznajmljujese_m');
        $this->load->model('nacinplacanja_m');
        $this->load->model('cenausezoni_m');
        $this->load->model('kapara_m');
        $this->load->model('smestajnajedinica_m');
        $this->load->model('karakteristika_m');
        $this->load->model('legenda_m');
        $this->load->model('objekat_slika_m');
        $this->load->model('objekat_karakteristika_m');
        $this->load->model('razdaljine_m');
        $this->load->model('objekat_nacinplacanja_m');
        $this->load->model('objekat_razdaljine_m');
        $this->load->model('objekat_cene_m');
        $this->load->model('objekat_iznajmljujese_m');
        $this->load->model('objekat_detaljan_cenovnik_m');
        $this->load->model('objekat_doba_m');
        $this->load->model('upit_m');
        $this->load->model('kalendar_popunjenosti_m');
        $this->load->model('smestajnajed_slika_m');
        $this->load->model('dozvole_m');
        $this->load->model('privilegija_dozvole_m');
        
    }
    public function index()
    {
        $user=$this->session->userdata('korisnik_id');
        $objects=$this->data['objects']=$this->objekat_m->get_objects_by_user($user,FALSE);
        $jezik=  $this->uri->segment(1);

       
        
        
        
        $this->data['jezik']=$this->uri->segment(1);
        
        $main=array('1'=>'backend/user/object/index');
        
        
        parent::template ($main,TRUE);
    }
    public function izmeni($object_id=NULL)
    {
        $jezik=  $this->uri->segment(1);
        $user_id=$this->session->userdata('korisnik_id');
        $objects=$this->objekat_m->get_objects_by_user($user_id,FALSE);
        $privilegija=  $this->data['privilegija'] = $this->korisnik_m->get_privilege_id ();
        if(!empty($objects))
        $broj=  count($objects);
        else
        $broj=0;
        $korisnik=$this->korisnik_m->get($user_id,TRUE);
        $true=FALSE;
        $niz=array();
        foreach($objects as $obj){$niz[$obj->objekat_id]=$obj->objekat_id;}
        $dozvola=  $this->dozvole_m->get_by(array("dozvole_id"=>2),TRUE);
        $privilegija_dozvola=  $this->privilegija_dozvole_m->get_by(array("privilegija_id"=>$privilegija,"dozvole_id"=>$dozvola->dozvole_id),TRUE);
        
        if($broj<$korisnik->max_smestaja){$true=TRUE;}
        if($broj<$korisnik->max_smestaja && $object_id!=NULL){$true=TRUE;}
        if(!empty($privilegija_dozvola))
        {         
            if($broj<$privilegija_dozvola->napomena)
            {
                $true=TRUE;
            }
        }
        else {
            $true=TRUE;
        }
//        if($privilegija==1){$true=TRUE;}
//        
//        if($broj==0 && $privilegija==3){$true=TRUE;}
//        if($broj==1 && $object_id!=NULL && $privilegija==3){$true=TRUE;}
//        
//        if($broj<=$korisnik->max_smestaja-1){$true=TRUE;}
//        if($broj<=$korisnik->max_smestaja && $object_id!=NULL){$true=TRUE;}
//        
//        if($broj<=1 && $privilegija==2){$true=TRUE;}
//        if($broj<=2 && $object_id!=NULL && $privilegija==2){$true=TRUE;}
        
        if(in_array($object_id,$niz)){$true=TRUE;}
        
        if($true==TRUE)
        {
        //provera da li su to smestaji tog korisnika i ako je admin ima pristup svima
        $user=$this->data['korisnik']=$this->session->userdata('korisnik_id');
        $this->data['privilegija'] = $this->korisnik_m->get_privilege_id ();
        $this->data['body']=array("onLoad"=>"initialize()");
        $dozvola=  $this->dozvole_m->get_by(array("dozvole_id"=>1),TRUE);
        $privilegija_dozvola=  $this->privilegija_dozvole_m->get_by(array("privilegija_id"=>$privilegija,"dozvole_id"=>$dozvola->dozvole_id),TRUE);
        if(!empty($privilegija_dozvola))
        {
        if($this->korisnik_m->get_privilege_id ()==$privilegija_dozvola->privilegija_id)
        {
            $objects_from_user=$this->objekat_m->get_objects_by_user_and_id($user,$object_id,FALSE);
            if(!empty($objects_from_user))
            {
                foreach ($objects_from_user as $object_from_user)
                {
                        $object_id=$object_id;
                }
                if($object_id!=NULL)
                {
                    $objekat=  $this->objekat_m->get($object_id,TRUE);
                    $this->data['object']=  $this->objekat_m->get($object_id,TRUE);

                }
            }
            else
            {
                if($object_id!=NULL)
                {
                show_404(current_url());
                }
            }
        }
        else 
        {   
            if($object_id!=NULL)
            {
                $objekat=  $this->objekat_m->get($object_id,TRUE);
                $this->data['object']=  $this->objekat_m->get($object_id,TRUE);
            }   
        }
        }
        else
        {
           if($object_id!=NULL)
            {
                $objekat=  $this->objekat_m->get($object_id,TRUE);
                $this->data['object']=  $this->objekat_m->get($object_id,TRUE);
            } 
        }
        // kraj provere  
             
        //Podatci o trenutnom korisniku
        $this->data['user']= $this->korisnik_m->get($user);     
        //Svi korisnici
        $users= $this->korisnik_m->get();
        $this->data['users']=array("0"=>"Izaberite Korisnika");
        foreach ($users as $key => $user)
        {
        $this->data['users'][$user->korisnik_id]=$user->ime." ".$user->prezime;
        }
        //kraj
        
        
        //pocetak dohvatanje doba za dropdown
        $this->data["age"]= $this->godina_m->get();
        //krja dohvatanja doba
        
        $drzave= $this->drzava_m->get_by(array("status"=>1));
            $this->data['drzava'][0]="Izaberite drzavu";
            foreach ($drzave as $drzava)
            {
                $this->data['drzava'][$drzava->drzava_id]=$drzava->naziv;
            }
        
        //pocetak dohvatanja drzave za dopdown
        if(isset($objekat))
        {
            $grad=  $this->grad_m->get($objekat->grad_id,FALSE);     
            $this->data['grad']=$this->grad_m->get($objekat->grad_id,TRUE);  
            

            //kraj dohvatanja drzave

            //pocetak dohvatanja grada za dopdown
            @$gradovi = $this->grad_m->get_by(array("drzava_id"=>$grad->drzava_id,"status"=>1));
            
            foreach ($gradovi as $key => $grad)
            {
            $this->data['gradovi'][$grad->grad_id]=$grad->naziv;
            }
            //kraj dohvatanja drzave
            
            $this->data['detaljan_cenovnik']=  $this->objekat_detaljan_cenovnik_m->get_by(array('objekat_id'=>$object_id,'smestajna_jed_id'=>NULL));
            $this->data['karakteristike_obj']=$this->objekat_karakteristika_m->get_karakteristika_by_object($object_id);
            
            $this->data["glavna"]=  $this->objekat_slika_m->get_by(array("objekat_id"=>$object_id,"glavna"=>"1"),TRUE);
            $slike=$this->data["slikee"]=  $this->objekat_slika_m->get_by(array("objekat_id"=>$object_id,"glavna"=>"0"));
            
        }  
        
        //pocetak dohvatanja kategorija za dopdown
        $this->data['kategorija']=array('0'=>'Izaberite Kategoriju');
        $kategorije = $this->kategorija_m->get();
        foreach ($kategorije as $key => $kategorija)
        {
        $this->data['kategorija'][$kategorija->kategorija_id]=$kategorija->naziv;
        }
        // kraj dohvatanja kategorija
        
        //pocetak dohvatanja tipa za dopdown
        $this->data['tip']=array('0'=>'Izaberite Tip');
        $tipovi= $this->tip_m->get();
        foreach ($tipovi as $key => $tip)
        {
            $this->data['tip'][$tip->tip_id]=$tip->naziv;
        }
        // kraj dohvatanja tipa
        
        // pocetak dohvatanja kapare
        $this->data['kapara']=array('0'=>'Izaberite Kaparu');
        $kapara= $this->kapara_m->get();
        foreach ($kapara as $key => $kapar)
        {
        $this->data['kapara'][$kapar->kapara_id]=$kapar->vrednost."%";
        }
        //kraj dohvatanja kapare
        
        
            
        $this->data['legenda']= $this->legenda_m->get();
        $this->data['karakteristike']= $this->karakteristika_m->get();
        $this->data['cities']= $this->grad_m->get();
        $this->data["razdaljine"]=  $this->razdaljine_m->get();
        
        $this->data['iznajmljujese']= $this->iznajmljujese_m->get();
        $this->data['nacinplacanja']= $this->nacinplacanja_m->get();
        $this->data['cenausezoni']= $this->cenausezoni_m->get();
        
        $this->data['slike']= $this->objekat_slika_m->get_object_images($object_id,0,FALSE);
        $this->data['glavna']= $this->objekat_slika_m->get_object_images($object_id,1,TRUE);
        
        
        
        $this->data['scripts']['extern1']='ajax';
        $this->data['scripts']['extern2']='galerija';
        $this->data['scripts']['extern3']="detaljancenovnik";
        $this->data['scripts']['extern4']="objekat_provera";
        $this->data['scripts']['extern5']="moment";
        $this->data['scripts']['extern6']="bootstrap-datetimepicker";
        $this->data['scripts']['extern7']="jquery.bootstrap.wizard";
        $this->data['css']['extern1']="bootstrap-datetimepicker";
           
		
        
        

        $main=array('1'=>'backend/user/object/edit');
        
        parent::template ($main,TRUE);
        }
        else
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Nemozete dodati vise smestaja!Uplatite neki bolji paket!</div>');
           redirect($jezik.'/korisnik/smestaji'); 
        }
    }
    
    
    
    
    
    
    
    
    public function sacuvaj($id=NULL)
    {
        $jezik=  $this->uri->segment(1);
        $user_id=$this->session->userdata('korisnik_id');
        $korisnik=$this->korisnik_m->get($user_id,TRUE);
        $privilegija=  $this->data['privilegija'] = $this->korisnik_m->get_privilege_id ();
        $objects=$this->objekat_m->get_objects_by_user($user_id,FALSE);
        $broj=  count($objects);
        
        $true=TRUE;
//        if($privilegija==1){$true=TRUE;}
//        
//        if($broj==0 && $privilegija==3){$true=TRUE;}
//        if($broj==1 && $id!=NULL && $privilegija==3){$true=TRUE;}
//        
//        if($broj<=$korisnik->max_smestaja-1){$true=TRUE;}
//        if($broj<=$korisnik->max_smestaja && $id!=NULL){$true=TRUE;}
//        
//        if($broj<=1 && $privilegija==2){$true=TRUE;}
//        if($broj<=2 && $id!=NULL && $privilegija==2){$true=TRUE;}
        
        $this->load->library('form_validation');
        $rules = $this->objekat_m->rules;
        $this->form_validation->set_rules($rules);
        
        $rules2 = $this->objekat_razdaljine_m->rules;
        $this->form_validation->set_rules($rules2);
        
        $rules1 = $this->objekat_cene_m->rules;
        $this->form_validation->set_rules($rules1);
        
        $rules3 = $this->objekat_detaljan_cenovnik_m->rules;        
        $this->form_validation->set_rules($rules3);
        
        if($true==TRUE && $this->form_validation->run() == TRUE)
        {
        $button=  $this->input->post('Sacuvaj', TRUE);
        if($button)
        {
            
            $nazivvs=  $this->objekat_m->get_by(array("objekat_id"=>$id),TRUE);
            
            
            $data =  $this->objekat_m->array_from_post(array('korisnik_id'=>'korisnik','grad_id'=>'grad','kategorija_id'=>'kategorija','tip_id'=>'tip','web'=>'web','adresa'=>'adresa','naziv'=>'naziv','opis'=>'opis','ukupni_kapacitet'=>'kapacitet','kapara_id'=>'kapara','kordinata_x'=>'kordinata_x','kordinata_y'=>'kordinata_y','youtube_link'=>'youtubelink'));
            $data['status']=1;
            if($id==NULL)
            $data['posecenost']=0;
            
            if($this->input->post('korisnik')==0)
            {
                $data['korisnik_id']=$this->session->userdata('korisnik_id');  
            }
            
            if($this->session->userdata('privilegija_id')==1)
            {
               $data['prioritet']=  $this->input->post('prioritet');  
            }
            if($this->session->userdata('privilegija_id')==2)
            {
               $data['prioritet']='10';  
            }
            if($this->session->userdata('privilegija_id')==3)
            {
               $data['prioritet']='15';  
            }
            
            if($this->input->post('premium')==0)
            {
               $data['premium']=0;  
            }
            else 
            {
                $data['premium']=$this->input->post('premium');
            }
            
            if($id!=NULL && $this->session->userdata('privilegija_id')!=1)
            {
                $objekat= $this->objekat_m->get($id,TRUE);   
                if($this->session->userdata('korisnik_id')!=$objekat->korisnik_id)
                {
                show_404(current_url());
                redirect('korisnik/smestaji');
                }
                else 
                {
                $this->objekat_m->save($data , $id);
                
                }
            }
            else
            { 
            $this->objekat_m->save($data , $id);
            if($id==NULL){
                
                $id=mysql_insert_id();
                
            }
            }
            
            
            $this->objekat_karakteristika_m->delete(NULL,array('objekat_id'=>$id));

            $idkarakteristike=$this->input->post("idkarakteristike");
            if (@is_array($idkarakteristike))
            {
                foreach ($idkarakteristike as $karakteristika)
                {
                    $datas['karakteristika_id']=  $karakteristika;
                    $datas['objekat_id']=  $id;
                    $datas['legenda_id']=  0;
                    $this->objekat_karakteristika_m->save($datas);
                }
            }
        
            $idkarakteristike1=$this->input->post("idkarakteristike1");
            $legende=$this->input->post("legenda");
            
                if(@is_array($idkarakteristike1))
                {
                    foreach ($idkarakteristike1 as $key => $karakteristika)
                    {
                        foreach ($legende as $key1 =>$legenda)
                        {
                            if($key == $key1)
                            {
                                $data="";
                                $data['objekat_id']=$id;
                                $data['legenda_id']=$legenda;
                                $data['karakteristika_id']=  $karakteristika;
                                if($data['legenda_id']!=0)
                                {
                                $this->objekat_karakteristika_m->save($data);
                                }
                            }
                        }
                    }
                }
            
            $this->objekat_iznajmljujese_m->delete(NULL,array('objekat_id'=>$id));
            $iznajmljujese=  $this->input->post("iznajmljujese");
            
            if (@is_array($iznajmljujese))
            {
                foreach ($iznajmljujese as $iznajmljujes)
                {
                    $datasa['iznajmljujese_id']=  $iznajmljujes;
                    $datasa['objekat_id']=  $id;
                    $this->objekat_iznajmljujese_m->save($datasa);
                }
            }
            
            $this->objekat_razdaljine_m->delete(NULL,array('objekat_id'=>$id));
            $razdaljine=  $this->input->post("razdaljine");
            $razdaljine_id=$this->input->post("razdaljine_id");
            if (@is_array($razdaljine_id))
                {
                foreach ($razdaljine_id as $key => $razdaljine_ids)
                    {
                        if (@is_array($razdaljine))
                        {
                            foreach ($razdaljine as $key1 => $razdaljina)
                            {
                                if($key == $key1)
                            {
                            $datasas['razdaljine_id']=  $razdaljine_ids;
                            $datasas['objekat_id']=  $id;
                            $datasas['vrednost']=  $razdaljina;
                            if($razdaljina!=NULL)
                            $this->objekat_razdaljine_m->save($datasas);
                            }
                            }
                    }
                }
            }
            
            $this->objekat_cene_m->delete(NULL,array('objekat_id'=>$id,'smestajna_jed_id'=>NULL));
            $cene=  $this->input->post("cena");
            $sezona_id=  $this->input->post("sezona_id");
            if (@is_array($cene))
                {
                foreach ($cene as $key => $cena)
                    {
                        if (@is_array($sezona_id))
                        {
                            foreach ($sezona_id as $key1 => $sezona_ids)
                            {
                                if($key == $key1)
                            {
                                $datasase['smestajna_jed_id']=  NULL;
                                $datasase['objekat_id']=  $id;
                                $datasase['sezona_id']=  $sezona_ids;
                                $datasase['cena']=  $cena;
                                $trenutna=  $this->input->post('trenutna');
                                $datasase['status']=  $trenutna;
                                if($cena!=NULL)
                                $this->objekat_cene_m->save($datasase);
                            }
                            }
                    }
                }
            }
            
            $this->objekat_detaljan_cenovnik_m->delete(NULL,array('objekat_id'=>$id,'smestajna_jed_id'=>NULL));
            $od=$this->input->post("od");
            $do=$this->input->post("do");
            $cenadetaljno=$this->input->post("cenadetaljno");
            $cenapo=$this->input->post("cenapo");
            
            if (@is_array($od))
                {
                    foreach ($od as $key => $o)
                    {
                        if(@is_array($do))
                        {
                            foreach ($do as $key1 => $d)
                            {
                                if(@is_array($cenadetaljno))
                                {
                                    foreach ($cenadetaljno as $key2 => $cena)
                                    {
                                        if(@is_array($cenapo))
                                        {
                                            foreach ($cenapo as $key3 => $po)
                                            {
                                                if($key==$key2 && $key==$key1 && $key==$key3)
                                                {
                                                    $data="";
                                                    $data['smestajna_jed_id']=  NULL;
                                                    $data['objekat_id']=  $id;
                                                    $data['od']=  $o;
                                                    $data['do']=  $d;
                                                    $data['cena']=  $cena;
                                                    $data['cena_za']=  $po;
                                                    $this->objekat_detaljan_cenovnik_m->save($data); 
                                                }
                                            }
                                        }
                                        
                                    }
                                }
                            }
                        }
                    }
                }
                $this->objekat_nacinplacanja_m->delete(NULL,array('objekat_id'=>$id));
                $nacinplacanja=$this->input->post("nacinplacanja");
                    
                    if(is_array($nacinplacanja))
                    {
                        foreach ($nacinplacanja as $nacin)
                        {
                        $data="";
                        $data['objekat_id']=  $id;
                        $data['nacin_id']=$nacin;
                        $this->objekat_nacinplacanja_m->save($data); 
                        }
                    }
                $this->objekat_doba_m->delete(NULL,array('objekat_id'=>$id));
                $doba=$this->input->post("doba");
                    
                    if(is_array($doba))
                    {
                        foreach ($doba as $dob)
                        {
                        $data="";
                        $data['objekat_id']=  $id;
                        $data['doba_id']=$dob;
                        $this->objekat_doba_m->save($data); 
                        }
                    }
                $dozvola=  $this->dozvole_m->get_by(array("dozvole_id"=>3),TRUE);
                $privilegija_dozvola=  $this->privilegija_dozvole_m->get_by(array("privilegija_id"=>$privilegija,"dozvole_id"=>$dozvola->dozvole_id),TRUE);
                $slike=  $this->objekat_slika_m->get_by(array("objekat_id"=>$id));
                 $g=count($slike);
                 $prolaz=FALSE;
                    
                $nazivglavna=$this->input->post('nazivglavna', TRUE);
                @$fileName=$_FILES['glavna']['name'];
                @$fileTmpName=$_FILES['glavna']['tmp_name'];
                @$fileSize=$_FILES['glavna']['size'];
                @$fileType=$_FILES['glavna']['type'];
                $extension=end(explode(".", $fileName));
                $rand=rand();
                $structure=''; 
                $naziv=$this->input->post('naziv', TRUE);
                str_replace(" ","-",$naziv);
                $structure="img/Objekti/".str_replace(" ","-",$naziv)."_".$id."";
               
                
                
                
                
               
                if($nazivvs->naziv!=$this->input->post("naziv"))
                {
                    rename("img/Objekti/".str_replace(" ","-",$nazivvs->naziv)."_".$id."", $structure);
                    
                    
                }
                else
                {
                     @mkdir($structure,0777,true);
                }
                $putanjaM="$structure/M". str_replace(" ","-",$nazivglavna).$rand.'.'.$extension;
                $putanjaV="$structure/V".str_replace(" ","-",$nazivglavna).$rand.'.'.$extension;
                $datume=time();
                
               
                   if(!empty($privilegija_dozvola))
                {
                   if($privilegija_dozvola->napomena>$g)
                   {
                       $prolaz=TRUE;
                   }
                }
 else {$prolaz=TRUE;}
                if($prolaz==TRUE)
                {
               
                if($fileType=="image/jpg" || $fileType=="image/jpeg" || $fileType=="image/png" || $fileType=="image/JPG" || $fileType=="image/JPEG")
                {
                    if(move_uploaded_file($fileTmpName,$putanjaV))
                    {
 $g++;
                       resize($putanjaV,$putanjaV,1800,1800);
                       resize($putanjaV,$putanjaM,300,300);
                       $data="";
                       $data["objekat_id"]=$id;
                       $data["naziv"]=str_replace(" ","-",$nazivglavna);
                       $data["putanja"]="".$rand.'.'.$extension."";
                       $data["datum"]=$datume;
                       $data["velicina"]=$fileSize;
                       $data["glavna"]=1;
                       $this->objekat_slika_m->save($data);
                    }  
                }
                }
                $prolaz=FALSE;
                $slike=  $this->input->post("nazivslika");
                if(count($slike)>=1)
                {
                    foreach($slike as $key1 => $slika)
                    {
                           if(!empty($privilegija_dozvola))
                        {
                           if($privilegija_dozvola->napomena>$g)
                           {
                               $prolaz=TRUE;
                           }
                        }
                        else
                        {
                            $prolaz=TRUE;
                        }
                        if($prolaz==TRUE)
                        {
                        $fileName=$_FILES['slika']['name'][$key1];
                        $fileTmpName=$_FILES['slika']['tmp_name'][$key1];
                        $fileSize=$_FILES['slika']['size'][$key1];
                        $fileType=$_FILES['slika']['type'][$key1];
                        $extension=end(explode(".", $fileName));
                        $rand=rand();


                        $putanjaM="$structure/M". str_replace(" ","-",$slika).$rand.'.'.$extension;
                        $putanjaV="$structure/V".str_replace(" ","-",$slika).$rand.'.'.$extension;
                        $datume=time();
                        
                        if($fileType=="image/jpg"||$fileType=="image/jpeg" || $fileType=="image/png")
                        {
                            if(move_uploaded_file($fileTmpName,$putanjaV))
                            {
 $g++;
                                resize($putanjaV,$putanjaV,700,700);
                                resize($putanjaV,$putanjaM,300,300);
                                $data="";
                                $data["objekat_id"]=$id;
                                $data["naziv"]=str_replace(" ","-",$slika);
                                $data["putanja"]="".$rand.'.'.$extension."";
                                $data["datum"]=$datume;
                                $data["velicina"]=$fileSize;
                                $data["glavna"]=0;
                                $this->objekat_slika_m->save($data);
                            }
                        }
                        }
                    }
                    
                }
                if($nazivvs->posecenost==0)
                {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Uspesno ste dodali smestaj '.$naziv.'!</div>');    
                }
                else
                {
                $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Uspesno ste izmenili smestaj '.$naziv.'!</div>');      
                }
           
                redirect($jezik."/korisnik/smestaji");   
            
            }
        else
        {
        redirect($jezik."/korisnik/smestaji");       
        }
        }
 else {
     $this->session->set_flashdata('error', validation_errors());
    redirect($jezik."/korisnik/smestaji"); 
 }
 }


    
    
    
    
    
    
    
    public function obrisi($object_id)
    {      
        $user=$this->session->userdata('korisnik_id');
        
        if($this->korisnik_m->get_privilege_id ()!=1)
        {
            $objects_from_user=$this->objekat_m->get_objects_by_user_and_id($user,$object_id,FALSE);
            if(!empty($objects_from_user))
            {
                foreach ($objects_from_user as $object_from_user)
                {
                        $object_id=$object_id;
                }
            }
            else
            {
                show_404(current_url());
            }
        }
        else 
        {   
            $object_id=$object_id;
        }
        $objekat=  $this->objekat_m->get_by(array('objekat_id'=>$object_id),TRUE);
        $smestajna=  $this->smestajnajedinica_m->get_by(array("objekat_id"=>$object_id));
        foreach ($smestajna as $sme)
        {
            $this->smestajnajed_slika_m->delete(NULL,array("smestajnajedinica_id"=>$sme->smestajnajedinica_id),FALSE);
            $this->kalendar_popunjenosti_m->delete(NULL,array("smestajna_jed_id	"=>$sme->smestajnajedinica_id),FALSE);
        }
        $this->smestajnajedinica_m->delete(NULL,array('objekat_id'=>$object_id),FALSE);
        $this->objekat_karakteristika_m->delete(NULL,array('objekat_id'=>$object_id),FALSE);
        $this->objekat_nacinplacanja_m->delete(NULL,array('objekat_id'=>$object_id),FALSE);
        $this->objekat_detaljan_cenovnik_m->delete(NULL,array('objekat_id'=>$object_id),FALSE);
        $this->objekat_razdaljine_m->delete(NULL,array('objekat_id'=>$object_id),FALSE);
        $this->objekat_cene_m->delete(NULL,array('objekat_id'=>$object_id),FALSE);
        $this->objekat_iznajmljujese_m->delete(NULL,array('objekat_id'=>$object_id),FALSE);
        $this->objekat_doba_m->delete(NULL,array('objekat_id'=>$object_id),FALSE);
        $this->objekat_slika_m->delete(NULL,array('objekat_id'=>$object_id),FALSE);
        $this->upit_m->delete(NULL,array('objekat_id'=>$object_id),FALSE);
        $this->objekat_m->delete($object_id);
        $this->rmdir_recursive("img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id);
        
        redirect('sr/korisnik/smestaji');
        
        
    }
    
   public function obrisiSliku($id)
    {
       $jezik=  $this->uri->segment(1);
       $this->load->model('objekat_slika_m');
        if($id!=NULL)
        {
            $user=$this->session->userdata('korisnik_id');
            $privilegija=$this->korisnik_m->get_privilege_id ();
            if($privilegija!=1)
            {
                $ids=$this->objekat_slika_m->get_by(array("objekat_slika_id"=>$id),TRUE);
                @$objekat=  $this->objekat_m->get_by(array("objekat_id"=>$ids->objekat_id,"korisnik_id"=>$user),TRUE);
                if(count($objekat)==1)
                {

                    $this->objekat_slika_m->delete($id);           
                    unlink("img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/M".str_replace(" ","-",$ids->naziv)."".$ids->putanja);
                    unlink("img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/V".str_replace(" ","-",$ids->naziv)."".$ids->putanja);
                    redirect($jezik.'/korisnik/smestaji/izmeni/'.$objekat->objekat_id);
                }
                else
                {
                    show_404(current_url());
                }
            }
            else 
            {
                    $ids=$this->objekat_slika_m->get_by(array("objekat_slika_id"=>$id),TRUE);
                    $objekat=  $this->objekat_m->get_by(array("objekat_id"=>$ids->objekat_id),TRUE);
                    $this->objekat_slika_m->delete($id);
                    var_dump($objekat);
                    unlink("img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/M".str_replace(" ","-",$ids->naziv)."".$ids->putanja);
                    unlink("img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/V".str_replace(" ","-",$ids->naziv)."".$ids->putanja);
                    
            }
        }
    }
    
    
    function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$dir/$file")) $this->rmdir_recursive("$dir/$file");
        else unlink("$dir/$file");
    }
    rmdir($dir);
}

}

