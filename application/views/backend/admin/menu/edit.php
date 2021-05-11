<h3><?php print empty($meni->meni_id) ? 'Dodaj novi meni' : 'Izmeni meni ' . $meni->naziv; ?></h3>

<?php print validation_errors(); ?>
<?php isset($meni->meni_id) ? $id=$meni->meni_id : $id="";
print form_open('admin/administracija_menija/sacuvaj/'.$id ,array('role'=>"form",'class'=>"form-horizontal")); ?>
<table class="table">
	<tr>
		<td>Naziv:</td>
		<td><?php print form_input(array('name'=>'naziv','class'=>'form-control','placeholder'=>'Naziv menija'), set_value('naziv', isset($meni->meni_id) ? $meni->naziv : NULL)); ?></td>
        </tr>
       
</table>
 <input type='submit' class='btn btn-primary ' value="Sacuvaj" name="Sacuvaj"/> 

