<h2>Smestajne jedinice</h2>
	<?php echo anchor('korisnik/smestajne_jedinice/izmeni', '<span class="glyphicon glyphicon-plus"></span> Dodaj novu Smestajnu jedinicu'); ?>
	<table class="table table-striped">
		<thead>
			<tr>
                                <th>ID</th>
				<th>Objekat</th>
				<th>Naziv</th>
                                <th>Broj mesta</th>
                                <th>Kalendar popunjenosti</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody> 
<?php if(!empty($object_unit)): foreach($object_unit as $unit): ?>
           <tr>
                <td><?php print $unit->smestajnajedinica_id ?></td>
                <td><?php $object=$this->objekat_m->get_by(array('objekat_id'=>$unit->objekat_id),TRUE); print @$object->naziv; ?></td>
                <td><?php print $unit->naziv ?></td>
                <td><?php print $unit->broj_mesta ?></td>
                <td><?php print btn('korisnik/kalendar_popunjenosti/izmeni/' . $unit->smestajnajedinica_id,"glyphicon glyphicon-edit"); ?></td>
                <td><?php print btn_edit('korisnik/smestajne_jedinice/izmeni/' . $unit->smestajnajedinica_id); ?></td>
                <td><?php print btn_delete('korisnik/smestajne_jedinice/obrisi/' . $unit->smestajnajedinica_id); ?></td>
            </tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="6">Ne postoji nijedna Smestajna jedinica.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>

