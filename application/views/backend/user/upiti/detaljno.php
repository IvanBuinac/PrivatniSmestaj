<h2><?php $objekat=$this->objekat_m->get($upit->objekat_id,TRUE); print $objekat->naziv.' | '.$upit->ime.' '.$upit->prezime; ?></h2>
<div class="alert alert-info pull-left col-md-5" role="alert">
    <strong>Poslato:</strong><?php print date("d-m-Y | G:i:sa", $upit->datum); ?>  <br/>
    <strong>Ime i prezime:</strong><?php print $upit->ime.' '.$upit->prezime; ?><br/>
    <strong>Email:</strong><?php print $upit->email; ?><br/>
    <strong>Telefon:</strong><?php print $upit->kontakt; ?><br/>
    <strong>Obradjena:</strong><?php print yes_or_no($upit->stanje)?><br/>    
</div>
<div class="clearfix clear"></div>
<div class="alert alert-info" role="alert"><h3><b>Pitanje:</b></h3><?php print $upit->textupita;?></div>
<?php if(count($upitidetaljno)>0){?>
    <?php foreach ($upitidetaljno as $detaljno) {?>
        <?php if($email==$detaljno->email) {?>
            <div class="alert alert-success pull-right col-md-5">
               <button type='button' class='close obrisi' data-dismiss='alert' value="<?php print $detaljno->upitdetaljno_id; ?>">×</button>
               <strong>Vi:</strong><b class='pull-right'><?php print date("d-m-Y | G:i:sa", $detaljno->datum);?></b><br/>
               <p><?php print $detaljno->text; ?></p>             
            </div>
            <div class="clearfix clear"></div>
        <?php } else {?>
            <div class="alert alert-warning pull-left col-md-5 ">
               <strong>Korisnik:</strong><b class='pull-right'><?php print date("d-m-Y | G:i:sa", $detaljno->datum);?></b><br/>
               <p><?php print $detaljno->text; ?></p>
            </div>
            <div class="clearfix clear"></div>
        <?php }?>          
    <?php }?>      
<?php }?>
<?php print form_open($jezik."/korisnik/upiti/odgovori/".$upit->upit_id);
    print form_textarea(array('name'=>'odgovor','class'=>'form-control'));
    print form_submit(array('name'=>'odgovori','class'=>'btn btn-primary','value'=>'Odgovori'));
    print form_close();       
?>
