<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajax
 *
 * @author Ivan
 */
class ajax extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('link_m');
        $this->load->model('meni_m');
    }
    public function linkovi($id)
    {
        if($id!=NULL)
        {
            $linkovi=  $this->link_m->get_by(array("meni_id"=>$id));
            foreach($linkovi as $link)
            {
                print "<table class='table'><tr><td>";
                print $link->naziv;
                print "</td><td>";
                print $link->putanja;
                print "</td><td>";
                @$meni=$this->meni_m->get_by(array("meni_id"=>$link->meni_id),TRUE); 
                @print $meni->naziv;
                print "</td><td>";
                $rod=$this->link_m->get_by(array("link_id"=>$link->roditelj),TRUE); isset($rod->naziv)?print $rod->naziv:print "Nema";        
                print "</td><td>";
                print $link->tezina;
                print "</td><td>";
                print btn_edit('admin/administracija_linkova/izmeni/' . $link->link_id);
                print "</td><td>";
                print btn_delete('admin/administracija_linkova/obrisi/' . $link->link_id);
                print "</td></tr></table";
            }
        }
    }
    public function objekat($korisnik)
    {
        if(isset($korisnik))
        {
            $objekat=  $this->objekat_m->get_by(array("korisnik_id"=>$korisnik));
            $options[0]='Izaberite';
            foreach ($objekat as $k => $a)
            {
            $options[$a->objekat_id]= $a->naziv;
            }            
            print form_dropdown('objekat', $options);
        }
    }
}
