<h2>Usluge</h2>
<?php echo anchor($jezik.'/admin/usluge/izmeni', '<span class="glyphicon glyphicon-plus"></span> Dodaj novu uslugu'); ?>
<div class="row col-md-12">
    <div class="col-md-3"><b>Naziv</b></div>
    <div class="col-md-3"><b>Cena</b></div>
    <div class="col-md-3"><b>Edit</b></div>
    <div class="col-md-3"><b>Delete</b></div>
</div>
<div class="row col-md-12">
    <?php if(!empty($usluge)){
    foreach($usluge as $usluga){?>
            <div class="col-md-3"><?php print $usluga->naziv;?></div>
            <div class="col-md-3"><?php print $usluga->cena;?></div>
            <div class="col-md-3"><?php print btn_edit($jezik.'/admin/usluge/izmeni/' . $usluga->usluge_id); ?></div>
            <div class="col-md-3"><?php print btn_delete($jezik.'/admin/usluge/obrisi/' . $usluga->usluge_id); ?></div>
    <?php }}?>
</div>
