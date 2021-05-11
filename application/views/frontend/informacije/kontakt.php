<div class="container">
    <h3 style="text-align: center;"><?php print translate("Kontaktirajte nas", $jezik)?></h3>
    <div class="cpl-md-12">
        <?php print form_open(base_url()."$jezik/informacije/posaljimail",array('role'=>"form",'class'=>"form-horizontal"));?>
        <div class="form-group" >
            <label for="ime" class="col-sm-2 control-label"><?php print translate("Ime:", $jezik)?></label>
            <div class="col-sm-8">
            <input type="text" class="form-control" name="VaseIme" id="ime" placeholder="<?php print translate("Ime", $jezik)?>">
            </div>
        </div>
        <div class="form-group">
            <label for="mail" class="col-sm-2 control-label"><?php print translate("Email", $jezik)?></label>
            <div class="col-sm-8">
            <input type="email" class="form-control" name="mail" id="mail" placeholder="<?php print translate("Email", $jezik)?>">
            </div>
        </div>
        <div class="form-group">
            <label for="text" class="col-sm-2 control-label"><?php print translate("Pitanje", $jezik)?></label>
            <div class="col-sm-8">
                <textarea class="form-control" name="text" id="text" placeholder="<?php print translate("Pitanje", $jezik)?>" rows="10" style="resize: none;"></textarea>
            </div>
        </div>
        <div class="col-md-4"></div>
        <button type="submit" class="col-md-4 btn btn-success" name="posalji" value="posalji" style="margin-bottom: 100px;">Posalji email</button>
        <?php print form_close();?>
    </div>
</div>