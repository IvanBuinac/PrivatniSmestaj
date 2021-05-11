<h3><?php print empty($link->link_id) ? 'Dodaj novi link' : 'Izmeni link ' . $link->naziv; ?></h3>

<?php print validation_errors(); ?>
<?php isset($link->link_id) ? $id=$link->link_id : $id="";
print form_open('admin/administracija_linkova/sacuvaj/'.$id ,array('role'=>"form",'class'=>"form-horizontal")); ?>
<table class="table">
	<tr>
		<td>Naziv:</td>
		<td><?php print form_input(array('name'=>'naziv','class'=>'form-control','placeholder'=>'Naziv linka'), set_value('naziv', isset($link->link_id) ? $link->naziv : NULL)); ?></td>
        </tr>
        <tr>
		<td>Putanja:</td>
		<td><?php print form_input(array('name'=>'putanja','class'=>'form-control','placeholder'=>'Putanja'), set_value('putanja', isset($link->link_id) ? $link->putanja : NULL)); ?></td>
        </tr>
        <tr>
		<td>Meni:</td>
		<td><?php $datas = "class='form-control'";
                print form_dropdown("meni", $meni , isset($link->meni_id)?$link->meni_id:NULL ,$datas);    ?></td>
	</tr>
        <tr>
		<td>Tezina:</td>
		<td><?php $datas = "class='form-control'";
                print form_dropdown("tezina", $tezina , isset($link->tezina)?$link->tezina:NULL ,$datas);    ?></td>
        </tr>
        <tr>
		<td>Roditelj:</td>
		<td><?php $datas = "class='form-control'";
                print form_dropdown("roditelj", $roditelj , isset($link->roditelj)?$link->roditelj:NULL ,$datas);    ?></td>
        </tr>
       
</table>
 <input type='submit' class='btn btn-primary ' value="Sacuvaj" name="Sacuvaj"/> 

