<h3><?php print empty($mail) ? 'Dodaj novu email adressu' : 'Izmeni email ' . $mail->email; ?></h3>

<?php print validation_errors(); ?>
<?php isset($mail->novosti_id) ? $id=$mail->novosti_id : $id="";
print form_open($jezik.'/admin/mailing/sacuvaj/'.$id ,array('role'=>"form",'class'=>"form-horizontal")); ?>
<table class="table">
	<tr>
		<td>Email:</td>
		<td><?php print form_input(array('name'=>'email','class'=>'form-control','placeholder'=>'email'), set_value('email', isset($mail->novosti_id) ? $mail->email : NULL)); ?></td>
        </tr>
       
</table>
 <input type='submit' class='btn btn-primary ' value="Sacuvaj" name="Sacuvaj"/>
 <?php print form_close();?>