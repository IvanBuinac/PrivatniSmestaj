<h3><?php print empty($korisnik->korisnik_id) ? 'Dodaj novog korisnika' : 'Izmeni korisnika ' . $korisnik->ime." ".$korisnik->prezime; ?></h3>

<?php print validation_errors(); ?>
<?php isset($korisnik->korisnik_id) ? $id=$korisnik->korisnik_id : $id="";
print form_open($jezik.'/admin/administracija_korisnika/sacuvaj/'.$id ,array('role'=>"form",'class'=>"form-horizontal")); ?>
<table class="table">
	<tr>
		<td>Ime:</td>
		<td><?php print form_input(array('name'=>'ime','class'=>'form-control','placeholder'=>'Ime'), set_value('ime', isset($korisnik->korisnik_id) ? $korisnik->ime : NULL)); ?></td>
	</tr>
	<tr>
		<td>Prezime:</td>
		<td><?php print form_input(array('name'=>'prezime','class'=>'form-control','placeholder'=>'Prezime'), set_value('prezime', isset($korisnik->korisnik_id) ? $korisnik->prezime : NULL)); ?></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><?php print form_input(array('name'=>'email','class'=>'form-control','placeholder'=>'Email'), set_value('email', isset($korisnik->korisnik_id) ? $korisnik->email : NULL)); ?></td>
	</tr>
        <tr>
		<td>Max smestaja:</td>
		<td><?php print form_input(array('name'=>'smestaji','class'=>'form-control','placeholder'=>'Maksimalan broj smestaja'), set_value('smestaji', isset($korisnik->korisnik_id) ? $korisnik->max_smestaja : NULL)); ?></td>
	</tr>
        <tr>
		<td>Max smestajnih jedinica:</td>
		<td><?php print form_input(array('name'=>'smestajne_jedinice','class'=>'form-control','placeholder'=>'Maksimalan broj smestajnih jedinica'), set_value('smestajne_jedinice', isset($korisnik->korisnik_id) ? $korisnik->max_smestajnih_jed : NULL)); ?></td>
	</tr>
        <tr>
		<td>Privilegije:</td>
		<td><?php $datas = "class='form-control'";
                print form_dropdown("privilegija", $privilegije , isset($korisnik->korisnik_id)?$korisnik->privilegija_id:NULL ,$datas);    ?></td>
	</tr>
        <tr>
            <?php $grad=$this->grad_m->get_by(array("grad_id"=>$korisnik->grad),TRUE);
            $drzave=$this->drzava_m->get();
            $drz=array();
            foreach ($drzave as $drzava)
            {
                $drz["$drzava->drzava_id"]=$drzava->naziv;
            }
            $gradovi=$this->grad_m->get_by(array('drzava_id'=>$grad->drzava_id));
            $grd=array();
            foreach ($gradovi as $grod)
            {
                $grd["$grod->grad_id"]=$grod->naziv;
            }
            ?>
                <td>Drzava:</td>
                <td><?php $datas = "class='form-control' onChange='dohvati_grad(this.value);' id='drzava'";
                print form_dropdown("drzava", $drz , $grad->drzava_id ,$datas); ?></td>
        </tr>
        <tr>
                <td>Grad:</td>
                <td><?php $datas = "class='form-control' id='grad'";
                print form_dropdown("grad", $grd , $grad->grad_id ,$datas); ?></td>
        </tr>
        <tr>
		<td>Status:</td>
                <td><?php $datas = "class='form-control'";
                print form_dropdown("status", array("1"=>"Aktivan","0"=>"Neaktivan","2"=>"Banovan") , isset($korisnik->potvrda)?$korisnik->potvrda:NULL ,$datas);    ?></td>
	</tr>
</table>
 <input type='submit' class='btn btn-primary ' value="Sacuvaj" name="Sacuvaj"/>
<?php print form_close();?>
