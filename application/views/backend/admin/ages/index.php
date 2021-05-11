<h2>Doba</h2>
    <?php echo anchor('admin/administracija_doba/izmeni', '<span class="glyphicon glyphicon-plus"></span> Dodaj novo doba'); ?>
    <table class="table table-striped">
        <thead>
                <tr>
                        <th>Naziv</th>
                        <th>Izmeni</th>
                        <th>Obrisi</th>
                </tr>
        </thead>
        <tbody>
            <?php if(count($doba)){
                foreach($doba as $dob){?>
                <tr>
                <td><?php print $dob->naziv; ?></td>       
                <td><?php print btn_edit('admin/administracija_doba/izmeni/' . $dob->doba_id); ?></td>
                <td><?php print btn_delete('admin/administracija_doba/obrisi/' . $dob->doba_id); ?></td>
            </tr>
            <?php }}?>
        </tbody>
    </table>