<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Smestajne-jedinice
 *
 * @author Ivan
 */
class smestajne_jedinice extends User_Controller {
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('smestajnajedinica_m');
        $this->load->model('objekat_m');
        $this->load->model('vrsta_m');
        $this->load->model('karakteristika_m');
        $this->load->model('cenausezoni_m');
        $this->load->model('objekat_detaljan_cenovnik_m');
        $this->load->model('objekat_cene_m');
        $this->load->model('objekat_karakteristika_m');
        $this->load->model('smestajnajed_slika_m');
        $this->load->model('dozvole_m');
        $this->load->model('privilegija_dozvole_m');
        $jezik=$this->data['jezik']=$this->uri->segment(1);
    }
    public function index()
    {
        
        $user=$this->session->userdata('korisnik_id');
        
        $objects=  $this->objekat_m->get_by(array('korisnik_id'=>$user));
        $array=array();
        if(!empty($objects))
        {
            foreach ($objects as $object)
            {
                array_push($array, $object->objekat_id);
                
            }
        }
        if(!empty($array))
        $this->data['object_unit']=  $this->smestajnajedinica_m->get_by_in(array('objekat_id'=>$array));
        else
        $this->data['object_unit']=  "";
        $main=array('1'=>'backend/user/object_units/index');
        parent::template ($main,TRUE);
    }
    public function izmeni($smestajna_id=NULL)
    {
        $jezik=  $this->uri->segment(1);
        $user_id=$this->session->userdata('korisnik_id');
        $objects=$this->objekat_m->get_objects_by_user($user_id,FALSE);
        $privilegija=  $this->data['privilegija'] = $this->korisnik_m->get_privilege_id ();
        $broj= 0;
        $niz=array();
        foreach($objects as $object){
            $smestajne_jedinice=  $this->smestajnajedinica_m->get_by(array("objekat_id"=>$object->objekat_id));
            foreach ($smestajne_jedinice as $smestajna){$broj++;$niz[$smestajna->smestajnajedinica_id]=$smestajna->smestajnajedinica_id;}
        }
        $korisnik=$this->korisnik_m->get($user_id,TRUE);
        $true=FALSE;
        
        $dozvola=  $this->dozvole_m->get_by(array("dozvole_id"=>6),TRUE);
        $privilegija_dozvola=  $this->privilegija_dozvole_m->get_by(array("privilegija_id"=>$privilegija,"dozvole_id"=>$dozvola->dozvole_id),TRUE);
        if($broj<=$korisnik->max_smestajnih_jed-1){$true=TRUE;}
        if($broj<=$korisnik->max_smestajnih_jed && $smestajna_id!=NULL){$true=TRUE;}
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
//        if($broj==1 && $smestajna_id!=NULL && $privilegija==3){$true=TRUE;}
//        
//        if($broj<=$korisnik->max_smestajnih_jed-1){$true=TRUE;}
//        if($broj<=$korisnik->max_smestajnih_jed && $smestajna_id!=NULL){$true=TRUE;}
//        
//        if($broj<=1 && $privilegija==2){$true=TRUE;}
//        if($broj<=2 && $smestajna_id!=NULL && $privilegija==2){$true=TRUE;}
        
        if(in_array($smestajna_id,$niz)){$true=TRUE;}
        
        if($true==TRUE)
        {
        //provera da li su to smestaji tog korisnika i ako je admin ima pristup svima
        $user=$this->data['korisnik']=$this->session->userdata('korisnik_id');
        $this->data['user']= $this->korisnik_m->get($user);
        //Svi korisnici
        $usersss= $this->korisnik_m->get();
        $this->data['users']=array("0"=>"Izaberite Korisnika");
        foreach ($usersss as $key => $usersssssss)
        {
        $this->data['users'][$usersssssss->korisnik_id]=$usersssssss->ime." ".$usersssssss->prezime;
        }
        
        $this->data['privilegija'] = $this->korisnik_m->get_privilege_id ();
        $dozvola=  $this->dozvole_m->get_by(array("dozvole_id"=>4),TRUE);
        $privilegija_dozvola=  $this->privilegija_dozvole_m->get_by(array("privilegija_id"=>$privilegija,"dozvole_id"=>$dozvola->dozvole_id),TRUE);
        if(!empty($privilegija_dozvola))
        {
        if($this->korisnik_m->get_privilege_id ()==$privilegija_dozvola->privilegija_id)
        {
            $objects_from_user=$this->smestajnajedinica_m->join(array('objekat'=>'smestajnajedinica.objekat_id=objekat.objekat_id'),array('objekat.korisnik_id'=>$user,'smestajnajedinica_id'=>$smestajna_id));
  
            if(!empty($objects_from_user))
            {
                foreach ($objects_from_user as $object_from_user)
                {
                $smestajna_id= $smestajna_id;
                }
                if($smestajna_id!=NULL)
                {
                    $smestaj=  $this->smestajnajedinica_m->get($smestajna_id,TRUE);
                    $this->data['smestaj']=  $this->smestajnajedinica_m->get($smestajna_id,TRUE);
                    
                }
            }
            else
            {
                if($smestajna_id!=NULL)
                {
                show_404(current_url());
                }
            }
        }     
        else 
        {   
            if($smestajna_id!=NULL)
            {
                $smestajna=  $this->smestajnajedinica_m->get($smestajna_id,TRUE);
                $this->data['smestaj']=  $this->smestajnajedinica_m->get($smestajna_id,TRUE);
            }   
        }
        }
        else
        {
           if($smestajna_id!=NULL)
            {
                $smestajna=  $this->smestajnajedinica_m->get($smestajna_id,TRUE);
                $this->data['smestaj']=  $this->smestajnajedinica_m->get($smestajna_id,TRUE);
            }  
        }
        
        // kraj provere
        
        $objekti=  $this->objekat_m->get_by(array('korisnik_id'=>$user));
        
        if(count($objekti)>0)
        {
            $this->data['objekat']['0']="Izaberite Smestaj";
            if(is_array($objekti))
            {
                foreach ($objekti as $objekat)
                {
                    $this->data['objekat'][$objekat->objekat_id]=$objekat->naziv;
                }
            }
        }
        else
        {
        $this->data['objekat']['0']="Nemate nijedan Smestaj molimo napravite";   
        }
       
        
        
        
        $vrsta=  $this->vrsta_m->get();
        $this->data['vrsta']['0']=  'Izaberite vrstu smestajne jedinice';
        foreach ($vrsta as $vr)
        {
            $this->data['vrsta'][$vr->vrsta_id]=  $vr->naziv;
        }
        
        $this->data['karakteristike']=$this->karakteristika_m->get();
        
        $this->data['cenausezoni']=$this->cenausezoni_m->get();
        
        
        $this->data['glavna']=  $this->smestajnajed_slika_m->get_by(array('smestajnajedinica_id'=>$smestajna_id,"glavna"=>1),TRUE);
if($smestajna_id!=NULL)
        $cenovnik=$this->data['detaljan_cenovnik']=$this->objekat_detaljan_cenovnik_m->get_by(array('smestajna_jed_id'=>$smestajna_id));
        @$object=$this->data['object']=$this->objekat_m->get_by(array('korisnik_id'=>$user,'objekat_id'=>$smestajna->objekat_id),TRUE);

        $slike=$this->data["slikee"]=  $this->smestajnajed_slika_m->get_by(array("smestajnajedinica_id"=>$smestajna_id,"glavna"=>"0"));
        
        $this->data['scripts']['extern1']='galerija';
        $this->data['scripts']['extern2']="detaljancenovnik";
        $this->data['scripts']['extern3']="smestajna_provera";
        $this->data['scripts']['extern4']="moment";
        $this->data['scripts']['extern5']="bootstrap-datetimepicker";
        $this->data['css']['extern1']="bootstrap-datetimepicker";
        $this->data['scripts']['extern6']='ajax';
        $this->data['scripts']['extern7']="jquery.bootstrap.wizard";
        $main=array('1'=>'backend/user/object_units/edit');
        parent::template ($main,TRUE);
        }
 else {

           $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Nemozete dodati vise smestajnih jedinica!Uplatite neki bolji paket!</div>');
           redirect($jezik.'/korisnik/smestajne_jedinice'); 
 }
    }
    
    
    
    public function sacuvaj($smestajna_id=NULL)
    {
       $jezik=$this->uri->segment(1);
       $this->load->library('form_validation');
       $rules = $this->smestajnajedinica_m->rules;
       $this->form_validation->set_rules($rules);
       
       $button=  $this->input->post('Sacuvaj', TRUE);
       if($this->form_validation->run() == TRUE && $button)
       {
        
       
       $data =  $this->smestajnajedinica_m->array_from_post(array('objekat_id'=>'objekat',"vrsta_id"=>'vrsta','naziv'=>'naziv','opis'=>'opis','broj_mesta'=>'mesta')); 
       $data['status']=1;
       $this->smestajnajedinica_m->save($data , $smestajna_id);
       if($smestajna_id==NULL){$smestajna_id=mysql_insert_id();}
       
       $nazivvs=  $this->smestajnajedinica_m->get_by(array("smestajnajedinica_id"=>$smestajna_id),TRUE);
       $this->objekat_karakteristika_m->delete(NULL,array('smestajna_jed_id'=>$smestajna_id));
       $idkarakteristike=$this->input->post("karakteristika");
       if($idkarakteristike!=NULL)
       {
            foreach ($idkarakteristike as $karakteristika)
            {
                $data="";
                $data["objekat_id"]=  $this->input->post("objekat");
                $data["smestajna_jed_id"]=$smestajna_id;
                $data["karakteristika_id"]=$karakteristika;
                $this->objekat_karakteristika_m->save($data);
            }
       }
       
            $this->objekat_cene_m->delete(NULL,array('smestajna_jed_id'=>$smestajna_id));
            $cene=  $this->input->post("cena");
            $sezona_id=  $this->input->post("sezona_id");
            if (isset($cene))
                {
                foreach ($cene as $key => $cena)
                    {
                        if (isset($sezona_id))
                        {
                            foreach ($sezona_id as $key1 => $sezona_ids)
                            {
                                if($key == $key1)
                            {
                                $data="";
                                $data["objekat_id"]=  $this->input->post("objekat");
                                $data["smestajna_jed_id"]=$smestajna_id;
                                $data["sezona_id"]=$sezona_ids;
                                $data["cena"]=$cena;
                                $trenutna=  $this->input->post('trenutna');
                                $datasase['status']=  $trenutna;
                                if($cena!=NULL)
                                $this->objekat_cene_m->save($data);
                            }
                            }
                    }
                }
            }
            $objekat_id=$this->input->post("objekat");
            $this->objekat_detaljan_cenovnik_m->delete(NULL,array('objekat_id'=>$objekat_id,'smestajna_jed_id'=>$smestajna_id));
            
            $od=$this->input->post("od");
            $do=$this->input->post("do");
            $cenadetaljno=$this->input->post("cenadetaljno");
            $cenapo=$this->input->post("cenadetaljno");
            
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
                                                    $data['smestajna_jed_id']=  $smestajna_id;
                                                    $data['objekat_id']=  $objekat_id;
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
        $privilegija= $this->korisnik_m->get_privilege_id ();    
        $dozvola=  $this->dozvole_m->get_by(array("dozvole_id"=>5),TRUE);
        $privilegija_dozvola=  $this->privilegija_dozvole_m->get_by(array("privilegija_id"=>$privilegija,"dozvole_id"=>$dozvola->dozvole_id),TRUE);
        $slike=  $this->smestajnajed_slika_m->get_by(array("smestajnajedinica_id"=>$smestajna_id));
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
        $objekat_id=$this->input->post('objekat', TRUE);
        $nazivObjekta=  $this->objekat_m->get_by(array("objekat_id"=>$objekat_id),TRUE);
        $nazivJedinice=$this->input->post('naziv', TRUE);
        $structure="img/Objekti/".str_replace(" ","-",$nazivObjekta->naziv)."_".$nazivObjekta->objekat_id."/".str_replace(" ","-",$nazivJedinice)."_".$smestajna_id."";

if($nazivvs->naziv!=$this->input->post("naziv"))
                {
                    rename("img/Objekti/".str_replace(" ","-",$nazivObjekta->naziv)."_".$nazivObjekta->objekat_id."/".str_replace(" ","-",$nazivvs->naziv)."_".$smestajna_id, $structure);  
                    
                }
                else
                {

                     mkdir($structure,0777,true);

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
                       $data["smestajnajedinica_id"]=$smestajna_id;
                       $data["naziv"]=str_replace(" ","-",$nazivglavna);
                       $data["putanja"]="".$rand.'.'.$extension."";
                       $data["datum"]=$datume;
                       $data["velicina"]=$fileSize;
                       $data["glavna"]=1;
                       
                       $this->smestajnajed_slika_m->save($data);
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
                                $data["smestajnajedinica_id"]=$smestajna_id;
                                $data["naziv"]=$slika;
                                $data["putanja"]="".$rand.'.'.$extension."";
                                $data["datum"]=$datume;
                                $data["velicina"]=$fileSize;
                                $data["glavna"]=0;
                                $this->smestajnajed_slika_m->save($data);
                            }
                        }
                    }
                    }
                    
                    
                }
	              redirect($jezik."/korisnik/smestajne_jedinice");   
       }
 else {
       $this->session->set_flashdata('error', validation_errors());
 	 redirect($jezik."/korisnik/smestaji");     
       }
    }
    
    

        public function obrisi($smestajna_id)
    {
            
            $this->smestajnajed_slika_m->delete(NULL,array("smestajnajedinica_id"=>$smestajna_id));
            $this->objekat_cene_m->delete(NULL,array("smestajna_jed_id"=>$smestajna_id));
            $this->objekat_karakteristika_m->delete(NULL,array("smestajna_jed_id"=>$smestajna_id));
            $this->objekat_detaljan_cenovnik_m->delete(NULL,array("smestajna_jed_id"=>$smestajna_id));
            $user=$this->session->userdata('korisnik_id');
            $smestaj=  $this->smestajnajedinica_m->get_by(array("smestajnajedinica_id"=>$smestajna_id),TRUE);
            $objekat=  $this->objekat_m->get_by(array("objekat_id"=>$smestaj->objekat_id,"korisnik_id"=>$user),TRUE);
            if(count($objekat)==1)
            {    
                
                $this->rmdir_recursive("img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/".str_replace(" ","-",$smestaj->naziv)."_".$smestaj->smestajnajedinica_id);
            }
            $this->smestajnajedinica_m->delete($smestajna_id,NULL,TRUE);
            
            $jezik=$this->uri->segment(1);
    redirect($jezik.'/korisnik/smestajne_jedinice');
    }
    function rmdir_recursive($dir) {
    foreach(scandir($dir) as $file) {
        if ('.' === $file || '..' === $file) continue;
        if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
        else unlink("$dir/$file");
    }
    rmdir($dir);
}
public function obrisisliku($id_slike=NULL)
    {
    
        $jezik=  $this->uri->segment(1);
        if($id_slike!=NULL)
        {
            $user=$this->session->userdata('korisnik_id');
            $ids=$this->smestajnajed_slika_m->get_by(array("smestajnajed_slika_id"=>$id_slike),TRUE);
            @$smestaj=  $this->smestajnajedinica_m->get_by(array("smestajnajedinica_id"=>$ids->smestajnajedinica_id),TRUE);
            @$objekat=  $this->objekat_m->get_by(array("objekat_id"=>$smestaj->objekat_id,"korisnik_id"=>$user),TRUE);
            var_dump($objekat);
            
            if(count($objekat)==1)
            {
                
                $this->smestajnajed_slika_m->delete($id_slike);           
                unlink("img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/".str_replace(" ","-",$smestaj->naziv)."_".$smestaj->smestajnajedinica_id."/M".str_replace(" ","-",$ids->naziv)."".$ids->putanja);
                unlink("img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/".str_replace(" ","-",$smestaj->naziv)."_".$smestaj->smestajnajedinica_id."/V".str_replace(" ","-",$ids->naziv)."".$ids->putanja);
                redirect($jezik.'/korisnik/smestajne_jedinice/izmeni/'.$smestaj->smestajnajedinica_id);
            }
            else
            {
                show_404(current_url());
            }
        }
    }
}