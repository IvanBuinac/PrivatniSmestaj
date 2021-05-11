<h2>Linkovi</h2>
    <table class="table">
	<tr>
		<td>Izbor linkova prema meniju kom pripadaju:</td>
		<td><?php $datas = "class='form-control' onChange='prikaz_linkova(this.value)'";
                print form_dropdown("meni", $meni , isset($link->meni_id)?$link->meni_id:NULL ,$datas);    ?></td>
	</tr>
        
    </table>
    <div id="linkovi"></div>

    <?php echo anchor('admin/administracija_linkova/izmeni', '<span class="glyphicon glyphicon-plus"></span> Dodaj novi link'); ?>
    <table class="table table-striped">
        <thead>
                <tr>
                        <th>Naziv</th>
                        <th>Putanja</th>
                        <th>Meni</th>
                        <th>Roditelj</th>
                        <th>Tezina</th>
                        <th>Izmeni</th>
                        <th>Obrisi</th>
                </tr>
        </thead>
        <tbody>
            <?php if(count($link)){
                foreach($link as $lin){?>
                <tr>
                <td><?php print $lin->naziv; ?></td>  
                <td><?php print $lin->putanja; ?></td>
                <td><?php $meni=$this->meni_m->get_by(array("meni_id"=>$lin->meni_id),TRUE); isset($meni->naziv)?print $meni->naziv:NULL; ?></td>
                <td><?php $rod=$this->link_m->get_by(array("link_id"=>$lin->roditelj),TRUE); isset($rod->naziv)?print $rod->naziv:print "Nema"; ?></td>
                <td><?php print $lin->tezina; ?></td>
                <td><?php print btn_edit('admin/administracija_linkova/izmeni/' . $lin->link_id); ?></td>
                <td><?php print btn_delete('admin/administracija_linkova/obrisi/' . $lin->link_id); ?></td>
            </tr>
            <?php }}?>
        </tbody>
    </table>



