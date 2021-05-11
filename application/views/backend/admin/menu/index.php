<h2>Meni</h2>
    <?php echo anchor('admin/administracija_menija/izmeni', '<span class="glyphicon glyphicon-plus"></span> Dodaj novi meni'); ?>
    <table class="table table-striped">
        <thead>
                <tr>
                        <th>Naziv</th>
                        <th>Izmeni</th>
                        <th>Obrisi</th>
                </tr>
        </thead>
        <tbody>
            <?php if(count($meni)){
                foreach($meni as $men){?>
                <tr>
                <td><?php print $men->naziv; ?></td>       
                <td><?php print btn_edit('admin/administracija_menija/izmeni/' . $men->meni_id); ?></td>
                <td><?php print btn_delete('admin/administracija_menija/obrisi/' . $men->meni_id); ?></td>
            </tr>
            <?php }}?>
        </tbody>
    </table>

