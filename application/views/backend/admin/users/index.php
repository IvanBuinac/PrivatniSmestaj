<h2>Korisnici</h2>
    <?php echo anchor('admin/administracija_korisnika/izmeni', '<span class="glyphicon glyphicon-plus"></span> Dodaj novog korisnika'); ?>
    <table class="table table-striped">
        <thead>
                <tr>
                        <th>ID</th>
                        <th>Ime i prezime</th>
                        <th>Email</th>
                        <th>Broj Smestaja</th>
                        <th>Broj Smestajnih jed</th>
                        <th>Privilegija</th>
                        <th>Status</th>
                        <th>Izmeni</th>
                        <th>Obrisi</th>
                </tr>
        </thead>
        <tbody>
            <?php if(count($korisnici)){

                foreach($korisnici as $korisnik){?>
                <tr>
                <td><?php print $korisnik->korisnik_id; ?></td>    
                <td><?php print $korisnik->ime." ".$korisnik->prezime; ?></td>
                <td><?php print $korisnik->email; ?></td>
                <td><?php print $korisnik->max_smestaja; ?></td>
                <td><?php print $korisnik->max_smestajnih_jed; ?></td>
                <td><?php $privilegija=$this->privilegija_m->get_by(array("privilegija_id"=>$korisnik->privilegija_id),TRUE); print $privilegija->naziv; ?></td>
                <td><?php if($korisnik->potvrda==1)
                    {
                    print "<img src='".base_url()."img/yes.png' alt='yes'>";
                    }
                    else
                    {
                    print "<img src='".base_url()."img/no.png' alt='no'>";
                    }
                    if($korisnik->potvrda==2)
                    {
                    print "<p style='color:red'>Banovan!</p>";
                    }
                    ?></td>
                <td><?php print btn_edit($jezik.'/admin/administracija_korisnika/izmeni/' . $korisnik->korisnik_id); ?></td>
                <td><?php print btn_delete($jezik.'admin/administracija_korisnika/obrisi/' . $korisnik->korisnik_id); ?></td>
            </tr>
            <?php }}?>
        </tbody>
    </table>
    <div class="row">
        <?php print form_open();?>
        <div class="col-md-10">
            <?php $privi=$this->privilegija_m->get_by(array("registracija"=>"1"),TRUE);?>
            <?php $datas = "class='form-control'";
            print form_dropdown("promena_privilegije", $privilegije ,$privi->privilegija_id  ,$datas); ?>
           
            
    </div>
        <div class="col-md-2"><button type="submit" name="submittt" value="1" class="btn btn-danger">Posalji</button></div>
        <?php print form_close();?>
    </div>