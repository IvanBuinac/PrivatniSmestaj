<h2>Upiti</h2>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Objekat</th>
				<th>Email</th>
                                <th>Datum</th>
                                <th>Stanje</th>
                                <th>Detaljno</th>
                                <th>Delete</th>				
			</tr>
		</thead>
		<tbody> 
<?php if(count($upiti)): foreach($upiti as $upit): ?>
      <?php if($upit->stanje==0):  ?>
           <tr>
                <td><b><?php print $upit->naziv;  ?></b></td>
                <td><b><?php print $upit->email; ?></b></td>
                <td><b><?php print date("d-m-Y | G:i:sa", $upit->datum); ?></b></td>
                <td><b><?php print yes_or_no($upit->stanje); ?></b></td>
                <td><b><?php print btn_edit($jezik.'/korisnik/upiti/detaljno/' . $upit->upit_id); ?></b></td>
                <td><b><?php print btn_delete($jezik.'/korisnik/upiti/obrisi/' . $upit->upit_id); ?></b></td>
               </tr>
      <?php else: ?>
            <tr>
                <td><?php print $upit->naziv;  ?></td>
                <td><?php print $upit->email; ?></td>
                <td><?php print date("d-m-Y | G:i:sa", $upit->datum); ?></td>
                <td><?php print yes_or_no($upit->stanje); ?></td>
                <td><?php print btn_edit($jezik.'/korisnik/upiti/detaljno/' . $upit->upit_id); ?></td>
                <td><?php print btn_delete($jezik.'/korisnik/upiti/obrisi/' . $upit->upit_id); ?></td>
            </tr>
      <?php endif; ?>	
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="6">Ne postoji nijedan upit.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>

