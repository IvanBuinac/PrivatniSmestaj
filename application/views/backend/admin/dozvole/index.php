<h2>Dozvole</h2>
	<?php echo anchor('admin/dozvole/izmeni_dozvole', '<span class="glyphicon glyphicon-plus"></span> Dodaj novu dozvolu'); ?>
	<table class="table table-striped">
		<thead>
			<tr>
                                <th>ID</th>
				<th>Naziv</th>
                                <th>Edit</th>
                                <th>Delete</th>
			</tr>
		</thead>
		<tbody> 
<?php if(count($dozvole)): foreach($dozvole as $dozvola): ?>
           <tr>
               <td><?php print $dozvola->dozvole_id; ?></td>
                <td><?php print $dozvola->naziv; ?></td>
                <td><?php print btn_edit($jezik.'/admin/dozvole/izmeni_dozvole/' . $dozvola->dozvole_id); ?></td>
                <td><?php print btn_delete($jezik.'/admin/dozvole/obrisi_dozvole/' . $dozvola->dozvole_id); ?></td>
            </tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="10">Ne postoji nijedna dozvola.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>
<h2>Dozvole i privilegija</h2>
<?php echo anchor('admin/dozvole/izmeni', '<span class="glyphicon glyphicon-plus"></span> Dodaj novu dozvolu privilegiju'); ?>
<table class="table table-striped">
		<thead>
			<tr>
                                <th>ID</th>
				<th>Privilegija</th>
                                <th>Dozvola</th>
                                <th>Edit</th>
                                <th>Delete</th>
			</tr>
		</thead>
		<tbody> 
<?php if(count($privilegija_dozvole)): foreach($privilegija_dozvole as $privilegija): ?>
           <tr>
               <td><?php print $privilegija->privilegija_dozvole_id; ?></td>
                <td><?php $privilegijaa=$this->privilegija_m->get_by(array("privilegija_id"=>$privilegija->privilegija_id),TRUE); print $privilegijaa->naziv;?></td>
                <td><?php $dozvola=$this->dozvole_m->get_by(array("dozvole_id"=>$privilegija->dozvole_id),TRUE);-print $dozvola->naziv; ?></td>
                <td><?php print btn_edit($jezik.'/admin/dozvole/izmeni/' . $privilegija->privilegija_dozvole_id); ?></td>
                <td><?php print btn_delete($jezik.'/admin/dozvole/obrisi/' . $privilegija->privilegija_dozvole_id); ?></td>
            </tr>
<?php endforeach; ?>
<?php else: ?>
		<tr>
			<td colspan="10">Ne postoji nijedna dozvola.</td>
		</tr>
<?php endif; ?>	
		</tbody>
	</table>

<table class="table table-striped">
    <thead>
			<tr>
                            <th>Dozvole/Privilegije</th>
                            <?php if(count($dozvole)){ foreach($dozvole as $dozvola){ ?>
                              <th><?php print $dozvola->naziv;?></th>
                            <?php }}?>
			</tr>
    </thead>
    <tbody>
        
        <?php $privilegije=$this->privilegija_m->get(); 
        if(count($privilegije)){ foreach($privilegije as $privilegija){ ?>
        <tr><td><?php print $privilegija->naziv;?></td>
        <?php  if(count($dozvole)){ foreach($dozvole as $dozvola){
           
            $privilegija_dozv=$this->privilegija_dozvole_m->get_by(array("privilegija_id"=>$privilegija->privilegija_id,"dozvole_id"=>$dozvola->dozvole_id),TRUE);
            if(!empty($privilegija_dozv))
            {
             ?>
            <td><input type="checkbox" name="privilegija_dozvola" checked></td>
            <?php 
            }  else {
            ?>
            <td><input type="checkbox" name="privilegija_dozvola" ></td>
            <?php 
            }}}          
            ?>
            
        
        
        
        </tr>
        
        <?php }}?>
    </tbody>
</table>
