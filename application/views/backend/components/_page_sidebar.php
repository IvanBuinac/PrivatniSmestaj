</div>
<div class="col-md-2">
    <?php print anchor('login/logout','<span class="glyphicon glyphicon-off" aria-hidden="true"></span>  logout'); ?>
    <?php   
            $korisnik_id=$this->session->userdata('korisnik_id');
            $privilegija=  $this->korisnik_m->get_privilege_id ();
            $korisnik=$this->korisnik_m->get($korisnik_id,TRUE);
            $objekat=$this->objekat_m->get_by(array('korisnik_id'=>$korisnik_id));
            $smestajna_jedinicaaa=$this->smestajnajedinica_m->join(array("objekat o"=>"smestajnajedinica.objekat_id=o.objekat_id"),array("o.korisnik_id"=>$korisnik_id));
            
    ?>
    <h2><?php print $korisnik->ime.' '.$korisnik->prezime?></h2>
    <h3><?php $pri=$this->privilegija_m->get($privilegija,TRUE); print $pri->naziv;?></h3>
    <p>Broj objekata</p>
    <h3 style="margin-left:20px;"><?php $broj=0; foreach ($objekat as $obj){$broj++;} print $broj;?></h3>
    <p>Maksimalni broj objekata</p>
    <h3 style="margin-left:20px;"><?php $dozvole=$this->privilegija_dozvole_m->get_by(array("dozvole_id"=>2,"privilegija_id"=>$privilegija),TRUE);
    if(!empty($dozvole->napomena))
    {
    if($korisnik->max_smestaja<=$dozvole->napomena){print $dozvole->napomena;}else if($korisnik->max_smestaja>=$dozvole->napomena){print $korisnik->max_smestaja;}
    }
    else
    print 'Neograniceno';

    ?></h3>
    
    <p>Broj Smestajnih jedinica</p>
    <h3 style="margin-left:20px;"><?php $broj=0; foreach ($smestajna_jedinicaaa as $smj){$broj++;} print $broj;?></h3>
    <p>Maksimalni broj smestajnih jedinica</p>
    <h3 style="margin-left:20px;"><?php $dozvole=$this->privilegija_dozvole_m->get_by(array("dozvole_id"=>6,"privilegija_id"=>$privilegija),TRUE);
    if(!empty($dozvole->napomena))
    {
    if($korisnik->max_smestajnih_jed<=$dozvole->napomena){print $dozvole->napomena;}else if($korisnik->max_smestajnih_jed>=$dozvole->napomena){print $korisnik->max_smestajnih_jed;}
    }
    else
print 'Neograniceno';
    ?></h3>