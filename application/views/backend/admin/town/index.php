<h2>Gradovi</h2>
    <?php echo anchor('admin/administracija_gradova/izmeni', '<span class="glyphicon glyphicon-plus"></span> Dodaj novi grad'); ?>
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
            <?php if(count($gradovi)){
                foreach($gradovi as $grad){?>
                <tr>
                <td><?php print $grad->naziv; ?></td>
                <td><?php print $grad->putanja; ?></td>        
                <td><?php print btn_edit('admin/administracija_gradova/izmeni/' . $grad->grad_id); ?></td>
                <td><?php print btn_delete('admin/administracija_gradova/obrisi/' . $grad->grad_id); ?></td>
            </tr>
            <?php }}?>
        </tbody>
    </table>