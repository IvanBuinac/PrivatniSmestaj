<h2>Smestaji</h2>
	<?php echo anchor('korisnik/smestaji/izmeni', '<span class="glyphicon glyphicon-plus"></span> Dodaj novi Smestaj'); ?>
	<table class="table table-striped">
		<thead>
			<tr>
                                <th>ID</th>
				<th>Naziv</th>
                                <th>Lokacija</th>
                                <th>Kategorija</th>
				<th>Status</th>
                                <th>Premium</th>
                                <th>Pozicija</th>
                                <th>Pogledaj<br/> na sajtu</th>
                                <th>Smestajne jedinice</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody> 
<?php if(count($objects)): foreach($objects as $object): ?>
           <tr>
               <td><?php print $object->objekat_id; ?></td>
                <td><?php print $object->naziv; ?></td>
                <td><?php print $putanja ?></td>
                <td><?php print category($object->kategorija_id)?></td>
                <td><?php print yes_or_no($object->status); ?></td>
                <td><?php print yes_or_no($object->premium); ?></td>
                <td><?php $drzava=$this->drzava_m->get_by(array("drzava_id"=>$city->drzava_id), TRUE);
                $objekti=$this->objekat_m->join(array('grad'=>'objekat.grad_id=objekat.grad_id','drzava'=>'drzava.drzava_id=grad.grad_id'),array('objekat.grad_id'=>$object->grad_id,'drzava.drzava_id'=>$drzava->drzava_id,'objekat.status'=>'1')); 
                $i=1;
                foreach ($objekti as $objekat)
                {
                    if($objekat->objekat_id!=$object->objekat_id)
                    $i++;
                    else
                    break;   
                }
                print $i;
                ?></td>
                
                <td><?php print $putanja_objekta;?></td>  
                <td><?php count($smestajne_jedinice)?print "<a href='".base_url()."admin/smestajne_jedinice/objekat/".$objekat->objekat_id."' title='Smestajne jedinice'>".count($smestajne_jedinice)."</a>": print "Nema";?></td>
                <td><?php print btn_edit($jezik.'/korisnik/smestaji/izmeni/' . $object->objekat_id); ?></td>
                <td><?php print btn_delete($jezik.'/korisnik/smestaji/obrisi/' . $object->objekat_id); ?></td>
            </tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="10">Ne postoji nijedan objekat.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>

