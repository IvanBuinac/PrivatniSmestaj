<h3><?php print empty($doba->doba_id) ? 'Dodaj novo doba' : 'Izmeni doba ' . $doba->naziv; ?></h3>

<?php print validation_errors(); ?>
<?php isset($doba->doba_id) ? $id=$doba->doba_id : $id="";
print form_open('admin/administracija_doba/sacuvaj/'.$id ,array('role'=>"form",'class'=>"form-horizontal")); ?>
<table class="table">
	<tr>
		<td>Naziv:</td>
		<td><?php print form_input(array('name'=>'naziv','class'=>'form-control','placeholder'=>'Naziv drzave'), set_value('naziv', isset($doba->doba_id) ? $doba->naziv : NULL)); ?></td>
	</tr>
</table>
 <input type='submit' class='btn btn-primary ' value="Sacuvaj" name="Sacuvaj"/>
<?php print form_close();?>
        