<h3><?php print empty($privilegija_dozvole->privilegija_dozvole_id) ? 'Dodaj novu dozvolu privilegiju' : 'Izmeni dozvolu privilegiju ' . $privilegija_dozvole->privilegija_dozvole_id; ?></h3>

<?php print validation_errors(); ?>
<?php isset($privilegija_dozvole->privilegija_dozvole_id) ? $id=$privilegija_dozvole->privilegija_dozvole_id : $id="";
print form_open('admin/dozvole/sacuvaj/'.$id ,array('role'=>"form",'class'=>"form-horizontal")); ?>
<table class="table">
	<tr>
		<td>Privilegija:</td>
                <?php 

$css='class="form-control"';
                ?>
		<td><?php if(empty($privilegija_dozvole->privilegija_dozvole_id))print form_dropdown('privilegija', $privilegija, '0',$css);else print form_dropdown('privilegija', $privilegija,$privilegija_dozvole->privilegija_id ,$css);?></td>
        </tr>
        <tr>
            <td>Dozvole:</td>
                <?php 

$css='class="form-control"';
                ?>
            <td><?php if(empty($privilegija_dozvole->privilegija_dozvole_id))print form_dropdown('dozvole', $dozvole, '0',$css);else print form_dropdown('dozvole', $dozvole,$privilegija_dozvole->dozvole_id ,$css);?></td>
        </tr>
        <tr>
            <td>Napomena</td>
            <td><?php print form_input(array('name'=>'napomena','class'=>'form-control','placeholder'=>'Napomena'), set_value('napomena', isset($privilegija_dozvole->privilegija_dozvole_id) ? $privilegija_dozvole->napomena : NULL)); ?></td>
        </tr>
</table>
 <input type='submit' class='btn btn-primary ' value="Sacuvaj" name="Sacuvaj"/> 

