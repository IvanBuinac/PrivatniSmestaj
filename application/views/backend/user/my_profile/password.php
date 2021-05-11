<h3><?php print translate("Promena Lozinke", $jezik,TRUE)?></h3>
<?php print form_open($jezik.'/korisnik/moj_profil/promeni');?>
    <div class="form-group">
        <label for="password"><?php print translate("Lozinka", $jezik) ?></label>
            <?php print form_input(array('type'=>'password','class'=>"form-control ",'placeholder'=>translate("Lozinka", $jezik),'required'=>'required','name'=>'password',"id"=>"password")); ?>
    </div>
<div class="form-group">
        <label for="password1"><?php print translate("Lozinka ponovo", $jezik,TRUE) ?></label>
            <?php print form_input(array('type'=>'password','class'=>"form-control ",'placeholder'=>translate("Lozinka", $jezik),'required'=>'required','name'=>'password1',"id"=>"password1")); ?>
    </div>
<?php print form_submit(array('type'=>'submit','name'=>'btnPromeniLoz','value'=>translate("Promeni", $jezik),'class'=>'btn btn-primary pr_modal_login' )); ?>
<?php print form_close();?>

