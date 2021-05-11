<h3><?php print empty($dozvole->dozvole_id) ? 'Dodaj novu dozvolu' : 'Izmeni dozvolu ' . $dozvole->naziv; ?></h3>

<?php print validation_errors(); ?>
<?php isset($dozvole->dozvole_id) ? $id=$dozvole->dozvole_id : $id="";
print form_open('admin/dozvole/sacuvaj_dozvole/'.$id ,array('role'=>"form",'class'=>"form-horizontal")); ?>
<table class="table">
	<tr>
		<td>Naziv:</td>
		<td><?php print form_input(array('name'=>'naziv','class'=>'form-control','placeholder'=>'Naziv dozvole'), set_value('naziv', isset($dozvole->dozvole_id) ? $dozvole->naziv : NULL)); ?></td>
        </tr>
       
</table>
 <input type='submit' class='btn btn-primary ' value="Sacuvaj" name="Sacuvaj"/> 

