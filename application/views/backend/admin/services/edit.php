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
<h3><?php print empty($usluga->usluge_id) ? 'Dodaj novi uslugu' : 'Izmeni uslugu ' . $usluga->naziv; ?></h3>
<?php print validation_errors(); ?>
<?php if(isset($usluga->usluge_id)) { $id=$usluga->usluge_id;}else{ $id="";}
print form_open($jezik.'/admin/usluge/sacuvaj/'.$id ,array('role'=>"form",'class'=>"form-horizontal")); ?>
<div class="row col-md-12">
    <div class="col-md-6">Naziv</div>
    <div class="col-md-6"><?php print form_input(array('name'=>'naziv','class'=>'form-control','placeholder'=>'Naziv usluge'), set_value('naziv', isset($usluga->usluge_id) ? $usluga->naziv : NULL)); ?></div>
</div>
<div class="row col-md-12">
    <div class="col-md-3">Opis</div>
    <div class="col-md-9"><?php print form_textarea(array('name'=>'opis','class'=>'form-control','placeholder'=>'Unesite opis usluge',"id"=>"opis"), set_value('opis', isset($usluga->opis) ?  $usluga->opis:'')); ?></div>
</div>
<div class="row col-md-12">
    <div class="col-md-6">Cena</div>
    <div class="col-md-6"><?php print form_input(array('name'=>'cena','class'=>'form-control','placeholder'=>'Cena'), set_value('cena', isset($usluga->cena) ? $usluga->cena : NULL)); ?></div>
</div>
<input type='submit' class='btn btn-primary ' value="Sacuvaj" name="Sacuvaj"/>
<?php print form_close();?>