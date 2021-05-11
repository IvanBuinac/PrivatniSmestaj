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

<h2>Mailing list</h2>
    <?php echo anchor($jezik.'/admin/mailing/izmeni', '<span class="glyphicon glyphicon-plus"></span> Dodaj novu email adressu'); ?>
<?php print form_open(base_url()."$jezik/admin/mailing/posalji",array('role'=>"form",'class'=>"form-horizontal"))?>
    <table class="table table-striped">
        <thead>
                <tr>
                    <th><input class="check-all" name="reason" type="checkbox" onclick="for(c in document.getElementsByName('listofemails[]')) document.getElementsByName('listofemails[]').item(c).checked = this.checked"/><span>Check all</span></th>
                        <th>Novosti_id</th>
                        <th>Email</th>
                        <th>Izmeni</th>
                        <th>Obrisi</th>
                </tr>
        </thead>
        <tbody>
            <?php if(count($emaillist)){
                foreach($emaillist as $email){?>
                <tr>
                    <td><input type="checkbox" name="listofemails[]" value="<?php print $email->email;?>"/></td>
                <td><?php print $email->novosti_id; ?></td>
                <td><?php print $email->email; ?></td> 
                <td><?php print btn_edit($jezik.'/admin/mailing/izmeni/' . $email->novosti_id); ?></td>
                <td><?php print btn_delete($jezik.'/admin/mailing/obrisi/' . $email->novosti_id); ?></td>
            </tr>
            <?php }}else{print "<tr><td colspan='4'>Nema email adressa!</td></tr>";}?>
        </tbody>
    </table>

<?php print form_textarea(array('name'=>'poruka','class'=>'form-control',"id"=>"poruka"));?>
<input type='submit' class='btn btn-primary ' value="posalji" name="Posalji"/>
<?php print form_close();?>