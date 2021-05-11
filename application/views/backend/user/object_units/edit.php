<style>
    .bwizard-steps {
	display: inline-block;
	margin: 0; padding: 0;
	background: #fff }
	.bwizard-steps .active {
		color: #fff;
		background: #007ACC }
	.bwizard-steps .active:after {
		border-left-color: #007ACC }
	.bwizard-steps .active a {
		color: #fff;
		cursor: default }
	.bwizard-steps .label {
		position: relative;
		top: -1px;
		margin: 0 5px 0 0; padding: 1px 5px 2px }
	.bwizard-steps .active .label {
		background-color: #333;}
	.bwizard-steps li {
		display: inline-block; position: relative;
		margin-right: 5px;
		padding: 12px 17px 10px 30px;
		*display: inline;
		*padding-left: 17px;
		background: #efefef;
		line-height: 18px;
		list-style: none;
		zoom: 1; }
	.bwizard-steps li:first-child {
		padding-left: 12px;
		-moz-border-radius: 4px 0 0 4px;
		-webkit-border-radius: 4px 0 0 4px;
		border-radius: 4px 0 0 4px; }
	.bwizard-steps li:first-child:before {
		border: none }
	.bwizard-steps li:last-child {
		margin-right: 0;
		-moz-border-radius: 0 4px 4px 0;
		-webkit-border-radius: 0 4px 4px 0;
		border-radius: 0 4px 4px 0; }
	.bwizard-steps li:last-child:after {
		border: none }
	.bwizard-steps li:before {
		position: absolute;
		left: 0; top: 0;
		height: 0; width: 0;
		border-bottom: 20px inset transparent;
		border-left: 20px solid #fff;
		border-top: 20px inset transparent;
		content: "" }
	.bwizard-steps li:after {
		position: absolute;
		right: -20px; top: 0;
		height: 0; width: 0;
		border-bottom: 20px inset transparent;
		border-left: 20px solid #efefef;
		border-top: 20px inset transparent;
		content: "";
		z-index: 2; }
	.bwizard-steps a {
		color: #333 }
	.bwizard-steps a:hover {
		text-decoration: none }
.bwizard-steps.clickable li:not(.active) {
	cursor: pointer }
.bwizard-steps.clickable li:hover:not(.active) {
	background: #ccc }
.bwizard-steps.clickable li:hover:not(.active):after {
	border-left-color: #ccc }
.bwizard-steps.clickable li:hover:not(.active) a {
	color: #08c }

</style>
<script type='text/javascript'>
    $(document).ready(function() {
        
     	$('#rootwizard').bootstrapWizard({'tabClass': 'bwizard-steps',onTabShow: function(tab, navigation, index) {
		var $total = navigation.find('li').length;
		var $current = index+1;
		var $percent = ($current/$total) * 100;
		$('#rootwizard .progress-bar').css({width:$percent+'%'});
	}}); 
    });
</script>
<h3><?php print empty($smestaj->smestajnajedinica_id) ? 'Dodaj novu Smestajnu jedinicu' : 'Iznemi Smestajnu jedinicu ' . $smestaj->naziv; ?></h3>
<div id="rootwizard">
	<div class="navbar">
	  <div class="navbar-inner">
	    <div class="container">
	<ul>
	  	<li><a href="#tab1" data-toggle="tab">Osnovno</a></li>
		<li><a href="#tab2" data-toggle="tab">Karakteristike</a></li>
		<li><a href="#tab3" data-toggle="tab">Cene</a></li>
		<li><a href="#tab4" data-toggle="tab">Galerija</a></li>
		<li><a href="#tab5" data-toggle="tab">Detaljan cenovnik</a></li>
	</ul>
	 </div>
	  </div>
	</div>
    <div id="bar" class="progress">
      <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
    </div>
    <?php print validation_errors(); ?>
<?php if(!empty($smestaj->smestajnajedinica_id)){$id=$smestaj->smestajnajedinica_id;}else{$id=NULL;}?>
<?php print form_open_multipart($jezik.'/korisnik/smestajne_jedinice/sacuvaj/'.$id,array('role'=>"form",'class'=>"form-horizontal","onSubmit"=>"return checkform()")); ?>

<?php if($privilegija==1){?>
<!-- TinyMCE -->
<script src="<?php print base_url()."js/tiny_mce/tiny_mce.js";?>" type="text/javascript" ></script>
	<script type="text/javascript">
		tinyMCE.init({
			// General options
			mode : "textareas",
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
	
			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
		});
	</script>
	<!-- /TinyMCE -->
<?php }?>
	<div class="tab-content">
	    <div class="tab-pane" id="tab1">
	      <table class="table">
            <?php if($user->privilegija_id==1){ ?>
            <tr>
                    <td>Korisnik:</td>
                    <td><?php  $datas = "class='form-control'  id='korisnik' onChange='dohvati_korisnika(this.value);'";
                    print empty($object->objekat_id) ?form_dropdown("korisnik", $users, $korisnik,$datas):form_dropdown("korisnik", $users, $object->korisnik_id,$datas);    ?></td>
            </tr>
            <?php }?>
            <tr>
                <td>
                    <?php if(empty($smestaj->smestajnajedinica_id)){?>
                  Objekat kome dodajete smestajnu jedinicu:
                    <?php }else{ ?>
                  Objekat kome menjate smestajnu jedinicu:
                    <?php }?>
                </td>
                <td>
                    <?php $datas = "class='form-control' id='objekat'";
                    print empty($smestaj->smestajnajedinica_id)?form_dropdown('objekat',$objekat,NULL,$datas):form_dropdown('objekat',$objekat,$smestaj->objekat_id,$datas) ?>
                </td>
            </tr>
            <tr>
                <td>
                    Vrsta smestajne jedinice:
                </td>
                <td>
                    <?php $datas = "class='form-control' id='vrsta'";
                    print empty($smestaj->smestajnajedinica_id)?form_dropdown('vrsta',$vrsta,NULL,$datas):form_dropdown('vrsta',$vrsta,$smestaj->vrsta_id,$datas) ?>
                </td>
            </tr>
            <tr>
                <td>
                    Naziv smestajne jedinice:
                </td>
                <td>
                    <?php print form_input(array('name'=>'naziv','class'=>'form-control','placeholder'=>'Unesite naziv smestajne jedinice','id'=>'naziv'), set_value('naziv', isset($smestaj->naziv) ? $smestaj->naziv : NULL)); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Opis:
                </td>
                <td>
                    <?php print form_textarea(array('name'=>'opis','class'=>'form-control','placeholder'=>'Unesite opis smestajne jedinice','id'=>'opis'), set_value('opis', isset($smestaj->opis) ? $smestaj->opis : NULL)); ?>
                </td>
            </tr>
            <tr>
                <td>
                    Broj mesta:
                </td>
                <td>
                    <?php print form_input(array('name'=>'mesta','class'=>'form-control','placeholder'=>'Unesite broj mesta u smestajnoj jedinici','id'=>'mesta'), set_value('mesta', isset($smestaj->broj_mesta) ? $smestaj->broj_mesta : NULL)); ?>
                </td>
            </tr>
        </table>
	    </div>
	    <div class="tab-pane" id="tab2">
	      <table class="table">
            <?php if(empty($id)){?>
                <?php foreach ($karakteristike as $karakteristika){?>
                    <?php if($karakteristika->chack==0 || $karakteristika->chack==NULL){?>
                        <tr>
                            <td>
                                <?php print $karakteristika->naziv ?>
                            </td>
                            <td>
                                <?php print form_checkbox(array('name'=>'karakteristika[]'),$karakteristika->karakteristike_id,FALSE)?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            <?php }else{ ?>
                 <?php foreach ($karakteristike as $karakteristika){?>
                     <?php if($karakteristika->chack==0 || $karakteristika->chack==NULL){?>
                        <?php $cekiran=$this->objekat_karakteristika_m->get_by(array("smestajna_jed_id"=>$id,"karakteristika_id"=>$karakteristika->karakteristike_id),TRUE);?>
                        <tr>
                            <td>
                                <?php print $karakteristika->naziv ?>
                            </td>
                            <td>
                                <?php print form_checkbox(array('name'=>'karakteristika[]'),$karakteristika->karakteristike_id,set_value('karakteristika[]', !empty($cekiran) ? "checked='checked'" : NULL))?>
                            </td>
                        </tr>
                     <?php }?>
                 <?php }?>
            <?php }?>
        </table>
	    </div>
		<div class="tab-pane" id="tab3">
			<table class="table">
          
                <?php foreach ($cenausezoni as $cena){?>
                    <tr>
                        <td>
                            <?php print $cena->naziv; ?>
                        </td>
                        <td>
                            
                            <?php

                            if(!empty($id))
                            {
                                    $objekattt=$this->objekat_m->get_by(array("objekat_id"=>$smestaj->objekat_id),TRUE);
                                    $cena_smestaja=  $this->objekat_cene_m->get_by(array('smestajna_jed_id'=>$smestaj->smestajnajedinica_id,'sezona_id'=>$cena->cenausezoni_id,"objekat_id"=>$objekattt->objekat_id));

                                    if(!empty($cena_smestaja))
                                    {
                                        foreach ($cena_smestaja as $cena_sme)
                                        {
                                          print form_input(array('name'=>'cena[]','class'=>'form-control','placeholder'=>''.$cena->naziv), set_value('cena', isset($cena_sme) ? $cena_sme->cena : NULL));  
                                        }
                                    }
                                    else
                                    {
                                    print form_input(array('name'=>'cena[]','class'=>'form-control','placeholder'=>''.$cena->naziv));     
                                    }
                                    
                            }
                            else
                                    {
                                        print form_input(array('name'=>'cena[]','class'=>'form-control','placeholder'=>''.$cena->naziv)); 
                                    }
                                ?>
                            <input type="hidden" value="<?php print $cena->cenausezoni_id;?>" name='sezona_id[]'/><input type='radio' value='<?php print $cena->cenausezoni_id;?>' name='trenutna' />Trenutna
                        </td>
                    </tr>
                <?php } ?>
      </table>
	    </div>
		<div class="tab-pane" id="tab4">
			<table class="table">
            <?php if(empty($smestaj->smestajnajedinica_id)){?>
            <tr id='slika2'><td>Glavna Slika:</td><td><input type='file' name='glavna' class='btn btn-info form-control'/><input type='text' name='nazivglavna' class="form-control" placeholder='Unesite naziv slike'/></td></tr>
            <tr><td>Galerija:</td><td id='slika1'><input name='slika[]' type='file' class='btn btn-success form-control' class='sliska' onChange='dodajsliku();' multiple/><input class="form-control" type='text' name='nazivslika[]' placeholder='Unesite naziv slike'/></td></tr>
            
            
            <?php } else {?>
                <?php if(count($glavna)==1){ ?>
            <tr <?php if($slikee==NULL){print "id='slika2'";} ?>><td>Glavna:</td><td><img src="<?php print base_url()?>img/Objekti/<?php print str_replace(" ","-",$object->naziv)."_".$object->objekat_id."/".str_replace(" ","-",$smestaj->naziv)."_".$smestaj->smestajnajedinica_id."/M".str_replace(" ","-",$glavna->naziv)."".$glavna->putanja; ?>" width="100" height="100"></img><a  class="close" href="<?php print base_url()."$jezik/korisnik/smestajne_jedinice/obrisisliku/".$glavna->smestajnajed_slika_id;?>"><span aria-hidden="true">&times;</span></a></td></tr>
                        <tr><td></td><td></td></tr>
                <?php }else{?>
                    <tr <?php if($slikee==NULL){print "id='slika2'";}?>><td>Glavna Slika:</td><td><input type='file' name='glavna' class='btn btn-info form-control' multiple/><input type='text' name='nazivglavna' class="form-control" placeholder='Unesite naziv slike'/></td></tr>                  
                <?php }?>
                   
                <?php if(isset($slikee)){?> 
                    <?php foreach ($slikee as $x => $slika){?>
                    <tr <?php $br=count($slikee);--$br; if($x==$br){print "id='slika2'";} ?>><td>Galerija:</td><td><img src="<?php print base_url()?>img/Objekti/<?php print str_replace(" ","-",$object->naziv)."_".$object->objekat_id."/".str_replace(" ","-",$smestaj->naziv)."_".$smestaj->smestajnajedinica_id."/M".str_replace(" ","-",$slika->naziv)."".$slika->putanja; ?>" width="100" height="100"></img><a  class="close" href="<?php print base_url()."$jezik/korisnik/smestajne_jedinice/obrisisliku/".$slika->smestajnajed_slika_id ;?>"><span aria-hidden="true">&times;</span></a></td></tr>
                    <?php }?>
                <?php }?>
                <tr><td>Galerija:</td><td id='slika1'><input name='slika[]' type='file' class='btn btn-success form-control' class='sliska' onChange='dodajsliku();' multiple/><input class="form-control" type='text' name='nazivslika[]' placeholder='Unesite naziv slike'/></td></tr>    
            <?php }?>
            
            
        </table>
	    </div>
		<div class="tab-pane" id="tab5">
		<table class="table" id='addinput'>        
<div class="dodaj-novi">



            <?php if(!empty($object->objekat_id))
            {
                foreach ($detaljan_cenovnik as $x => $detaljan)
                {
                    print '<script type="text/javascript">
    $(function () {
        $("#datetimepicker'.$x.'").datetimepicker({
            format: "YYYY-MM-DD",
            useCurrent: false            
});
        $("#datetimepickerr'.$x.'").datetimepicker({
            format: "YYYY-MM-DD",
            useCurrent: false
        });
        $("#datetimepicker'.$x.'").on("dp.change", function (e) {
            $("#datetimepickerr'.$x.'").data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepickerr'.$x.'").on("dp.change", function (e) {
            $("#datetimepicker'.$x.'").data("DateTimePicker").maxDate(e.date);
        });
    });
</script>';
                    print "<tr><td class='col-md-3'>Od:<div class='form-group' style='margin:0px;'><div class='input-group date ' id='datetimepicker".$x."'><input type='text' class='form-control' name='od[]' placeholder='od datuma' value='".$detaljan->od."'/><span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div></div></td><td class='col-md-3'>Do:<div class='form-group' style='margin:0px;'><div class='input-group date ' id='datetimepickerr".$x."'><input type='text' class='form-control' name='do[]' placeholder='do datuma' value='".$detaljan->do."'/><span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span></div></div></td><td class='col-md-3'>Cena:<input type='text' class='form-control' name='cenadetaljno[]' placeholder='Cena' value='".$detaljan->cena."'/></td><td class='col-md-2'><br/><select name='cenapo[]' class='form-control'><option value='1' ";
                    if($detaljan->cena_za==1)
                        {
                        print "selected='selected'";
                        }
                    print ">Po osobi</option><option value='2'";
                    if($detaljan->cena_za==2)
                        {
                        print "selected='selected'";
                        }
                    print ">Za ceo smestaj</option></select></td><td class='col-md-1'><br/><button type='button' class='btn btn-danger form-control ' id='remove'>X</button></td></tr>";
                    
                }
                print "<input type='hidden' value='".  count($detaljan_cenovnik)."' id='brojdet'></input>";
            }
            else
            {
                print "<input type='hidden' value='0' id='brojdet'></input>";
            }
            ?>
</div>
        </table>
        <button class='btn btn-success btn-sm add_field_button' type='button'  style="margin-bottom: 10px;">Nova cena</button>
	    </div>
		<ul class="pager wizard">
			<li class="previous first"><a href="javascript:;">Prva</a></li>
			<li class="previous"><a href="javascript:;">Predhodna</a></li>
			<li class="next last"><a href="javascript:;">Poslednja</a></li>
		  	<li class="next"><a href="javascript:;">Sledeća</a></li>
			<li class="finish"><input type='submit' class='btn btn-primary ' value="Sacuvaj" name="Sacuvaj"/></li>
		</ul>
	</div>
</div>

<?php print form_close();?>
<div id="ispis" style="color:red;" class='col-md-12'></div>