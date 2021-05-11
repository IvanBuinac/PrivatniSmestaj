<?php $error=$this->session->flashdata('error');
if (isset($error)) {
    print $error;
}?>
<?php  $message=$this->session->flashdata('message');
if(isset($message)){print $message;} ?>
<h2>Smestaji</h2>
	<?php echo anchor($jezik.'/korisnik/smestaji/izmeni', '<span class="glyphicon glyphicon-plus"></span> Dodaj novi Smestaj'); ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Naziv</th>
                                <th>Lokacija</th>
                                <th>Kategorija</th>
				<th>Status</th>
                                <th>Premium</th>
                                <th>Pozicija</th>
                                <th>Pogledaj<br/> na sajtu</th>
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody> 
<?php if(count($objects)): foreach($objects as $object): ?>
           <tr>
                <td><?php print $object->naziv; 
            $city=  $this->grad_m->get_by(array("grad_id"=>$object->grad_id,"status"=>1),TRUE);    
            $country= $this->drzava_m->get_by(array("drzava_id"=>$city->drzava_id,"status"=>1),TRUE);
            $putanja="".base_url().$jezik.'/'.strtolower("$country->naziv/$city->naziv");
            $putanja_objekta="".base_url().$jezik.'/'.strtolower("$country->naziv/$city->naziv/$object->naziv-$object->objekat_id");
            $new = str_replace(' ', '-', $putanja);
            $new1 = str_replace(' ', '-', $putanja_objekta);
            $putanja_objekta1=  anchor($new1, "<span class='glyphicon glyphicon-eye-open'></span>");
            $putanja1=anchor($new, "$country->naziv/$city->naziv");
                ?></td>
                <td><?php print $putanja1 ?></td>
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
                <td><?php print $putanja_objekta1;?></td>        
                <td><?php print btn_edit($jezik.'/korisnik/smestaji/izmeni/' . $object->objekat_id);?></td>
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

