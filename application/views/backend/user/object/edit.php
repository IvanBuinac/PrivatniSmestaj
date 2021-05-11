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
<h3><?php print empty($object->objekat_id) ? 'Dodaj novi smestaj' : 'Izmeni smestaj ' . $object->naziv; ?></h3>
<div id="rootwizard">
	<div class="navbar">
	  <div class="navbar-inner">
	    <div class="container">
	<ul>
	  	<li><a href="#tab1" data-toggle="tab">Osnovno</a></li>
		<li><a href="#tab2" data-toggle="tab">Karakteristike</a></li>
		<li><a href="#tab3" data-toggle="tab">Mapa</a></li>
		<li><a href="#tab4" data-toggle="tab">Razdaljine</a></li>
		<li><a href="#tab5" data-toggle="tab">Cene i placanja</a></li>
		<li><a href="#tab6" data-toggle="tab">Galerija</a></li>
		<li><a href="#tab7" data-toggle="tab">Detaljan cenovnik</a></li>
	</ul>
	 </div>
	  </div>
	</div>
    <div id="bar" class="progress">
      <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
    </div>
    <?php print validation_errors(); ?>
<?php if(isset($object->objekat_id)){  $id=$object->objekat_id;}else{$id="";}
print form_open_multipart($jezik.'/korisnik/smestaji/sacuvaj/'.$id ,array('role'=>"form",'class'=>"form-horizontal","onSubmit"=>"return checkform()")); ?>

<?php if($privilegija==1){?>
<!-- TinyMCE -->
<script src="<?php print base_url()."js/tiny_mce/tiny_mce.js";?>" type="text/javascript" ></script>
	<script type="text/javascript">
            $(document).ready(function() {

        $('#rootwizard').bootstrapWizard();
});
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
                <div id="kordinata"></div>
<table class="table">
        <?php if($user->privilegija_id==1){ ?>
        <tr>
                <td>Korisnik:</td>
                <td><?php  $datas = "class='form-control'  id='korisnik'";
                print empty($object->objekat_id) ?form_dropdown("korisnik", $users, $korisnik,$datas):form_dropdown("korisnik", $users, $object->korisnik_id,$datas);    ?></td>
	</tr>
        <?php }?>
	<tr>
		<td>Drzava:</td>
		<td><?php $datas = "class='form-control' onChange='dohvati_grad(this.value);' id='drzava'";
                print empty($object->objekat_id) ?form_dropdown("drzava", $drzava , NULL ,$datas):form_dropdown("drzava", $drzava , $grad->drzava_id ,$datas);    ?></td>

	</tr>
	<tr>
		<td>Grad:</td>
		<td><?php $datas = "class='form-control' id='grad'";
                print empty($object->objekat_id) ?form_dropdown("grad", array('0'=>'Izaberi drzavu'), NULL,$datas):form_dropdown("grad", $gradovi, $object->grad_id,$datas);      ?></td>
	</tr>
        <tr>
		<td>Kategorija:</td>
                <td><?php $datas = "class='form-control' id='kategorija'";
                print empty($object->objekat_id) ?form_dropdown("kategorija", $kategorija, NULL,$datas):form_dropdown("kategorija", $kategorija , $object->kategorija_id,$datas);      ?></td>
	</tr>
        <tr>
		<td>Tip:</td>
                <td><?php $datas = "class='form-control' id='tip'";
                print empty($object->objekat_id) ?form_dropdown("tip", $tip, NULL,$datas):form_dropdown("tip", $tip , $object->tip_id ,$datas);      ?></td>
	</tr>
        <tr>
		<td>Web:</td>
                <td><?php print form_input(array('name'=>'web','class'=>'form-control','placeholder'=>'Unesite vasu web stranicu',"id"=>"web"), set_value('web', isset($object->web) ? $object->web : NULL)); ?></td>
	</tr>
        <tr>
		<td>Adresa:</td>
                <td><?php print form_input(array('name'=>'adresa','class'=>'form-control','placeholder'=>'Unesite adresu smestaja',"id"=>"adresa"), set_value('adresa', isset($object->adresa) ? $object->adresa : NULL)); ?></td>
	</tr>
	<tr>
		<td>Naziv:</td>
		<td><?php print form_input(array('name'=>'naziv','class'=>'form-control','placeholder'=>'Unesite naziv smestaja',"id"=>"naziv"), set_value('naziv', isset($object->naziv) ?  $object->naziv:'')); ?></td>
	</tr>
	<tr>
		<td>Opis</td>
                <td><?php print form_textarea(array('name'=>'opis','class'=>'form-control','placeholder'=>'Unesite opis smestaja',"id"=>"opis"), set_value('opis', isset($object->opis) ?  $object->opis:'')); ?></td>
	</tr>
        <tr>
		<td>Ukupni kapacitet:</td>
		<td><?php print form_input(array('name'=>'kapacitet','class'=>'form-control','placeholder'=>'Unesite ukupni kapacitet vaseg smestaja',"id"=>"kapacitet"), set_value('kaitet', isset($object->ukupni_kapacitet) ? $object->ukupni_kapacitet:'')); ?></td>
	</tr>
        <?php foreach($iznajmljujese as $iznajmljujese){?>
        <tr>
		<td><?php print $iznajmljujese->naziv.":";?></td>
                <?php if(!empty($object->objekat_id)){$objekat_iznajmljuje=$this->objekat_iznajmljujese_m->get_by(array('objekat_id'=>$object->objekat_id,'iznajmljujese_id'=>$iznajmljujese->iznajmljujese_id));}
                if(!empty($objekat_iznajmljuje))
                {
                ?>
                <td><?php print form_checkbox(array('name'=>'iznajmljujese[]'),$iznajmljujese->iznajmljujese_id,TRUE); ?></td>
                <?php
                }
                else 
                {         
                ?>
                <td><?php print form_checkbox(array('name'=>'iznajmljujese[]'),$iznajmljujese->iznajmljujese_id,FALSE); ?></td>
                <?php } ?>
        </tr>
        <?php } ?>
        <tr>
		<td>Kapara:</td>
		<td><?php $datas = "class='form-control' id='kapara'";
                print empty($object->objekat_id) ?form_dropdown("kapara", $kapara, NULL,$datas):form_dropdown("kapara", $kapara , $object->kapara_id ,$datas);      ?></td>
	</tr>
        <?php if($user->privilegija_id==1){ ?>
        <tr>
		<td>Prioritet:</td>
		<td><select name='prioritet' class='form-control'><?php 
                for($i=0;$i<15;$i++)
                {
                    print "<option value='$i' ";
                    if(isset($object->prioritet)!=$i)
                    {
                    print "selected='selected'";
                    }
                    print ">$i</option> ";
                }
                ?></select></td>
	</tr>       
        <tr>
		<td>Premium:</td>
		<td><select name='premium' class='form-control'><?php 
                for($i=0;$i<2;$i++)
                {
                    print "<option value='$i' ";
                    if(isset($object->premium)==$i)
                    {
                    print "selected='selected'";
                    }
                    print ">";
                    print $i==1?'da':'ne';
                    print "</option> ";
                }
                ?></select></td>
	</tr>
        <?php } ?>
        <?php if(!isset($object->objekat_id)){?>
            <?php if(isset($age)){ ?>
                <?php foreach($age as $ag){?>
            <tr>
                <td><?php print $ag->naziv;?></td>
                <td><input type="checkbox" class="" name="doba[]" value="<?php print $ag->doba_id;?>"></input><img src="<?php print base_url()."img/doba/".$ag->slika_obojena;?>" alt="<?php print $ag->naziv?>" title="<?php print $ag->naziv?>"/></td>
            </tr>
                <?php } ?>
            <?php }?>
        <?php }else{?>
            <?php if(isset($age)){?>
                <?php foreach($age as $ag){?>
            <?php $checked=$this->objekat_doba_m->get_by(array("objekat_id"=>$id,"doba_id"=>$ag->doba_id),TRUE);                        ?>
            <tr>
                <td><?php print $ag->naziv;?></td>
                <td><input type="checkbox" class="" name="doba[]" value="<?php print $ag->doba_id;?>" <?php if(isset($checked->objekat_doba_id)){print "checked='checked'";}?>s></input><img src="<?php print base_url()."img/doba/".$ag->slika_obojena;?>" alt="<?php print $ag->naziv?>" title="<?php print $ag->naziv?>"/></td>
            </tr>
                <?php }?>
            <?php }?>
        <?php }?>
</table>
	    </div>
	    <div class="tab-pane" id="tab2">
	      <table class="table" id="karakterostika">
             <?php if(!empty($karakteristike))
             {
                 foreach($karakteristike as $key => $karakteristika)
                 {
                 ?>
                <tr>
                    <?php
                     if($karakteristika->chack==1)
                     {
                        print "<td>".$karakteristika->naziv."</td><td><input type='checkbox' value='".$karakteristika->karakteristike_id."' name='idkarakteristike[]'";
                        if(isset($karakteristike_obj))
                        {               
                            foreach ($karakteristike_obj as $key1 => $karakter)
                            {
                                if($karakter->karakteristika_id == $karakteristika->karakteristike_id && $karakter->legenda_id==0)
                                {
                                    print "checked='checked'";
                                }
                            }
                        }
                        print "/></td>"; 
                     }
                     else if($karakteristika->chack==NULL || $karakteristika->chack==0)
                     {
                        print "<td>".$karakteristika->naziv."</td><td><select name='legenda[]' class='form-control'><option value='0'>Izaberite..</option>";
                        if(!empty($legenda))
                        {
                            foreach ($legenda as $key => $leg)
                            {
                                print "<option value='".$leg->legenda_id."'";
                                if(isset($karakteristike_obj))
                                    {               
                                        foreach ($karakteristike_obj as $key1 => $karakter)
                                        {
                                            if($karakter->karakteristika_id == $karakteristika->karakteristike_id && $karakter->legenda_id==$leg->legenda_id)
                                            {                                     
                                                print "selected='selected'";
                                            }
                                        }
                                    }
                                print ">".$leg->naziv."</option>";
                            }
                        }
                        print "<select><input type='hidden' value='".$karakteristika->karakteristike_id."' name='idkarakteristike1[]'/></td>";
                     }
                     ?>
                </tr>
                <?php
                 }
             }
            ?>
        </table>
	    </div>
		<div class="tab-pane" id="tab3">
			<table class="table">
        <tr>
		<td>Geografska sirina:</td>
		<td><?php  print form_input(array('name'=>'kordinata_x','readonly'=>'readonly','class'=>'form-control','placeholder'=>'Kliknite na link ispod kako bi vam se otvorila mapa','id'=>'kordinatax'), set_value('kordinatax', isset($object->kordinata_x) ? $object->kordinata_x:''));      ?></td>
	</tr>
	<tr>
		<td>Geografska duzina:</td>
		<td><?php print form_input(array('name'=>'kordinata_y','readonly'=>'readonly','class'=>'form-control','placeholder'=>'Kliknite na link ispod kako bi vam se otvorila mapa','id'=>'kordinatay'), set_value('kordinatay', isset($object->kordinata_y) ? $object->kordinata_y:''));     ?></td>
	</tr>
              
	<tr>
		<td>Youtube link</td>
		<td><?php print form_input(array('name'=>'youtubelink','class'=>'form-control','placeholder'=>'Unesite Youtube link'), set_value('youtubelink', isset($object->youtube_link) ? $object->youtube_link:''));     ?></td>
	</tr>
        <tr>
                <td colspan='2'>
                <a href='#myModal' data-toggle='modal' onClick='resizeMap(event);'>Prikaži mapu i odredi tačnu lokaciju (geografsku širinu i dužinu)</a><br/>Potrebno je da na mapi pronadjete Vaš objekat i dvokliknete na njega, nakon čega će Vam se očitati GPS koordinate (geografska širina i dužina)
                </td>
        </tr>
        
    </table>
	    </div>
		<div class="tab-pane" id="tab4">
			<table class="table table-striped ">
        <?php if(empty($object->objekat_id)){?>
            <?php foreach($razdaljine as $razdaljina){ ?>               
                <tr>
                        <td><?php print $razdaljina->naziv;?></td>
                        <td><?php print form_input(array('name'=>'razdaljine[]','class'=>'form-control', 'placeholder'=> "Razdaljina od $razdaljina->naziv"))."<input type='hidden' value='$razdaljina->razdaljine_id' name='razdaljine_id[]'/>"; ?></td>
                </tr>
            <?php }?>
         </table>
        <?php } else {?>
        <table class="table table-striped ">
            <?php foreach($razdaljine as $razdaljina){ ?>
                <?php $vrednost=$this->objekat_razdaljine_m->get_by(array("razdaljine_id"=>$razdaljina->razdaljine_id,"objekat_id"=>$id),TRUE); ?>
                <tr>
                        <td><?php print $razdaljina->naziv;?></td>
                        <td><?php print form_input(array('name'=>'razdaljine[]','class'=>'form-control', 'placeholder'=> "Razdaljina od $razdaljina->naziv"), set_value('razdaljine[]',isset($vrednost->vrednost)?$vrednost->vrednost:""))."<input type='hidden' value='$razdaljina->razdaljine_id' name='razdaljine_id[]'/>"; ?></td>
                </tr>
            <?php }?>
        </table>
        <?php }?>
	    </div>
		<div class="tab-pane" id="tab5">
			<table class="table">
      <?php foreach ($nacinplacanja as $nacin) { ?>
      <tr>
		<td><?php print $nacin->naziv; ?></td>
                <?php if(!empty($object->objekat_id)){$objekat_nacinplacanja=$this->objekat_nacinplacanja_m->get_by(array('objekat_id'=>$object->objekat_id,'nacin_id'=>$nacin->nacinplacanja_id));}    
                if(!empty($objekat_nacinplacanja))
                {
                ?>
                <td><?php print form_checkbox(array('name'=>'nacinplacanja[]'),$nacin->nacinplacanja_id,TRUE);   ?></td>
                <?php 
                }
                else
                {
                ?>
                <td><?php print form_checkbox(array('name'=>'nacinplacanja[]'),$nacin->nacinplacanja_id);   ?></td>
                <?php } ?>
	</tr>    
     <?php } ?> 
      </table>
      <table class="table">
      <?php foreach ($cenausezoni as $cena) { ?>
        <tr>
          <td><?php print $cena->naziv; ?></td>
          <?php
          if(!empty($object->objekat_id)){$objekat_cene=$this->objekat_cene_m->get_by(array("objekat_id"=>$object->objekat_id,"sezona_id"=>$cena->cenausezoni_id,'smestajna_jed_id'=>NULL),TRUE);}
          if(!empty($objekat_cene)){
            ?>
            <td><?php print form_input(array('name'=>'cena[]','class'=>'form-control'), set_value('cena[]', $objekat_cene->cena));     ?><input type="hidden" value="<?php print $cena->cenausezoni_id?>" name='sezona_id[]'/><input type='radio' value='<?php print $cena->cenausezoni_id?>' name='trenutna' <?php if($objekat_cene->status==$cena->cenausezoni_id){print "checked='checked'";}?>/>Trenutna</td>
            <?php
            }
            else 
            {
            ?>
            <td><?php print form_input(array('name'=>'cena[]','class'=>'form-control','placeholder'=>$cena->naziv));     ?><input type="hidden" value="<?php print $cena->cenausezoni_id?>" name='sezona_id[]'/><input type='radio' value='<?php print $cena->cenausezoni_id?>' name='trenutna' />Trenutna</td>
            <?php
            }
            ?>
        </tr>    
     <?php } ?>
      </table>
	    </div>
		<div class="tab-pane" id="tab6">
		<table class="table">
            <?php if(empty($object->objekat_id)){?>
            <tr id='slika2'><td>Glavna Slika:</td><td><input type='file' name='glavna' class='btn btn-info form-control'/><input type='text' name='nazivglavna' class="form-control" placeholder='Unesite naziv slike'/></td></tr>
            <tr><td>Galerija:</td><td id='slika1'><input name='slika[]' type='file' class='btn btn-success form-control' class='sliska' onChange='dodajsliku();' /><input class="form-control" type='text' name='nazivslika[]' placeholder='Unesite naziv slike'/></td></tr>
            
            
            <?php } else {?>
                <?php if(count($glavna)==1){ ?>
            <tr <?php if($slikee==NULL){print "id='slika2'";} ?>><td>Glavna:</td><td><img src="<?php print base_url()."img/Objekti/".str_replace(" ","-",$object->naziv)."_".$object->objekat_id."/M".str_replace(" ","-",$glavna->naziv)."".$glavna->putanja;?>" width="100" height="100"></img><a  class="close" href="<?php print base_url()."$jezik/korisnik/smestaji/obrisiSliku/".$glavna->objekat_slika_id?>"><span aria-hidden="true">&times;</span></a></td></tr>
                        <tr><td></td><td></td></tr>
                <?php }else{?>
                    <tr <?php if($slikee==NULL){print "id='slika2'";}?>><td>Glavna Slika:</td><td><input type='file' name='glavna' class='btn btn-info form-control' multiple /><input type='text' name='nazivglavna' class="form-control" placeholder='Unesite naziv slike'/></td></tr>                  
                <?php }?>
                    
                <?php if(isset($slikee)){?> 
                    <?php foreach ($slikee as $x => $slika){?>
                    <tr <?php $br=count($slike);--$br; if($x==$br){print "id='slika2'";} ?>><td>Galerija:</td><td><img src="<?php print base_url()."img/Objekti/".str_replace(" ","-",$object->naziv)."_".$object->objekat_id."/M".str_replace(" ","-",$slika->naziv)."".$slika->putanja;?>" width="100" height="100"></img><a  class="close" href="<?php print base_url()."$jezik/korisnik/smestaji/obrisiSliku/".$slika->objekat_slika_id?>"><span aria-hidden="true">&times;</span></a></td></tr>
                    <?php }?>
                <?php }?>
                <tr><td>Galerija:</td><td id='slika1'><input name='slika[]' type='file' class='btn btn-success form-control' class='sliska' onChange='dodajsliku();' multiple/><input class="form-control" type='text' name='nazivslika[]' placeholder='Unesite naziv slike'/></td></tr>    
            <?php }?>
            
            
        </table>
	    </div>
		<div class="tab-pane" id="tab7">
		<table class="table" id='addinput'>        
<div class="dodaj-novi">



            <?php if(!empty($object->objekat_id))
            {
                foreach ($detaljan_cenovnik as $x => $detaljan)
                {
                    print '<script type="text/javascript">
    $(function () {
        $("#datetimepicker'.$x.'").datetimepicker(
            {
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

    

</div>

<?php print form_close();?>
<script type="text/javascript"> 

//<![CDATA[
     // global "map" variable
      var map = null;
      var marker = null;

var infowindow = new google.maps.InfoWindow(
  { 
    size: new google.maps.Size(150,50)
  });

// A function to create the marker and set up the event window function 
function createMarker(latlng, name, html) {
    var contentString = html;
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString); 
        infowindow.open(map,marker);
        });
    google.maps.event.trigger(marker, 'click');    
    return marker;
}

 
function initialize() {
  // create the map
  var myOptions = {
    zoom: <?php if(isset($object->objekat_id)){print $grad->zoom;}else{print 1;}?>,
    center: new google.maps.LatLng(<?php if(isset($object->objekat_id)){print "$grad->lat,$grad->long";}else{print "42.83503626758015,19.154663296875015";}?>),
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById("map_canvas"),
                                myOptions);
 
  google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
        });
google.maps.event.addListener(map, 'click', function(event) {
                    mLat = event.latLng.lat();
                    mLng = event.latLng.lng();
                    document.getElementById('lat').value = mLat;
                    document.getElementById('lng').value = mLng;
                    document.getElementById('kordinatax').value = mLat;
                    document.getElementById('kordinatay').value = mLng;
                });
  google.maps.event.addListener(map, 'click', function(event) {
	//call function to create marker
         if (marker) {
            marker.setMap(null);
            marker = null;
         }
	 marker = createMarker(event.latLng, "name", "<b>Location</b><br>"+event.latLng);
  });
  <?php if(isset($object->objekat_id)){?>
  var marker = new google.maps.Marker({
      position: new google.maps.LatLng(<?php print "$object->kordinata_x,$object->kordinata_y";?>),
      map: map,
      icon: '<?php print base_url()?>img/house.png',
  });
  <?php }?>
}
function resizeMap() {
   if(typeof map =="undefined") return;
   setTimeout( function(){resizingMap();} , 400);
}
			
	function resizingMap() {
   if(typeof map =="undefined") return;
   var center = map.getCenter();
   google.maps.event.trigger(map, "resize");
   map.setCenter(center); 
}
			
	
</script> 
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">MAPA</h4>
            </div>
            <div class="modal-body">
                <div id="map_canvas"  style="height: 350px; width: 500px;"></div>
                    lat: <input id="lat" />
                    lng: <input id="lng" />             
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div id="ispis" style="color:red;" class='col-md-12'></div>