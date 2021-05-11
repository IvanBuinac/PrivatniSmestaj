<div style="padding-left: 0px;padding-right: 0px;" class="col-md-4" >
    <div class="navbar navbar-inverse">
        <div class="navbar-inner left-navigation ">
            <ul class="navbar-nav nav white clear span2" id="expmenu-freebie" style="margin-top:40px;padding:0px;" >
                <li>
                    <!-- Start Freebie -->
                    <ul class="expmenu" style="margin-left:20px;margin-right:20px;padding:0px;">
			<?php if(count($godine)>0){?>
                            <?php foreach($godine as $godina) {?>
                                <li>
				<div class='header <?php print $godina->naziv."_".$godina->doba_id?>' id='<?php print $godina->naziv."_".$godina->doba_id?>' >
                                    <span class='label'><a href='<?php print base_url().''.strtolower($godina->naziv) ?>' title='<?php print $godina->naziv ?>' class='white'><?php print $godina->naziv ?></a></span>
                                    <span class='<?php
                                        if ($godina->naziv!=isset($doba->naziv))
                                            {
                                            echo "arrow down";
                                            }
                                            else
                                            {
                                            echo "arrow up";
                                            }
                                            ?>
                                    '></span>
				</div>
                                <ul class='menu ' id='<?php print $godina->doba_id;?>'
						<?php if($godina->naziv!=@$doba->naziv){
							echo "style='display:none;padding:0px;'";
							}
                                                        else
                                                        {
                                                        echo "style='padding:0px;'";
                                                        }
                                                $drzave=  $this->drzava_m->get_country_by_age($godina->doba_id);
                                                ?>>
                                <?php if(count($drzave)>0){?>
                                    <?php foreach($drzave as $drzava) {?>
                                        <ul class='expmenu1 <?php print $drzava->naziv."_".$drzava->drzava_id; ?>' style='margin:0px; padding:0px;' >
                                            <li id='<?php print $drzava->drzava_id; ?>'>
                                                <div class='header1' id='<?php print $drzava->drzava_id; ?>'>
                                                    <span class='label' ><a href='<?php print base_url().''.strtolower($godina->naziv).'/'.$drzava->putanja; ?>' title='<?php print $drzava->naziv ?>' class='white'><?php print $drzava->naziv ?></a></span>
                                                    <span class='<?php 
                                                    if ($drzava->naziv!=isset($drzava1->naziv))
                                                        {
                                                            echo "arrow down";
                                                        }
                                                        else
                                                        {
                                                            echo "arrow up";
                                                        }
                                                    
                                                    ?>'></span>
                                                </div>
                                                <ul class='menu1' <?php 
                                                                        if($drzava->putanja!=isset($drzava1->putanja))
                                                                        {
									echo " style='display:none'";
									}
                                                                       $gradovi= $this->grad_m->get_citys_by_country($drzava->drzava_id); 
                                                                   ?>
                                                    >
                                                    <?php if(count($gradovi)){?>
                                                        <?php foreach($gradovi  as $grad) {?>
                                                            <li><a href='<?php print base_url().''.strtolower($godina->naziv).'/'.$drzava->putanja.'/'.$grad->putanja; ?>' title='<?php print $grad->naziv ?>' style='color:black;'><?php print $grad->naziv ?></a></li>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </ul>
                                            </li>     
                                        </ul>
                                    <?php } ?>
                                <?php } ?>
                                </ul>
                                </li>       
                            <?php } ?>
                        <?php } ?>		
                    </ul>
                    <!-- End Freebie -->
		</li>
		<li class="white" ><p >Predlozite nam Grad</p></li>
		<li><form class="navbar-form pull-right" action="" method="post" role="form">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-home"></span>
                        </div>
                            <input type="text" class="form-control" id="" placeholder="Drzava" name="tbDrzava" />
                    </div>
                    <div class="input-group">
			<div class="input-group-addon">
                            <span class="glyphicon glyphicon-home"></span>
                        </div>
                        <input type="text" class="form-control" id="" placeholder="Grad" name="tbGrad" />
                    </div>
                    <button type="submit" class="btn btn-primary">Predlozi Grad</button>
                </form></li>
                <li><form class="navbar-form pull-right" action="" method="post" role="form">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-home"></span>
                        </div>
                        <input type="text" class="form-control" id="" placeholder="Drzava" name="tbDrzava" />
                    </div>
                    <button type="submit" class="btn btn-primary">Predlozi Drzava</button>
		</form></li>
            </ul>
	</div>
    </div>
</div>
<div class="right-container col-md-8" >

