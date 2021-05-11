<h2>Drzave</h2>
    <?php echo anchor('admin/administracija_drzava/izmeni', '<span class="glyphicon glyphicon-plus"></span> Dodaj novu drzavu'); ?>
    <table class="table table-striped">
        <thead>
                <tr>
                        <th>Naziv</th>
                        <th>Putanja</th>
                        <th>Izmeni</th>
                        <th>Obrisi</th>
                </tr>
        </thead>
        <tbody>
            <?php if(count($drzave)){
                foreach($drzave as $drzava){?>
                <tr>
                <td><?php print $drzava->naziv; ?></td>
                <td><?php print $drzava->putanja; ?></td>        
                <td><?php print btn_edit('admin/administracija_drzava/izmeni/' . $drzava->drzava_id); ?></td>
                <td><?php print btn_delete('admin/administracija_drzava/obrisi/' . $drzava->drzava_id); ?></td>
            </tr>
            <?php }}?>
        </tbody>
    </table>