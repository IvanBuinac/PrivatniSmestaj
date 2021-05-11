
<div id='cssmenu' class="col-md-3" style="padding:0px;">
    <ul>
    <?php if(isset($drzave)){?>
        <?php foreach($drzave as $drzava){?>
            <?php $gradovi=$this->grad_m->get_by(array("drzava_id"=>$drzava->drzava_id));?>
        <li class="<?php if($this->uri->segment(1)==$drzava->putanja){print "active";} if(count($gradovi)>1){print " has-sub";}?>"><a href="<?php print base_url()."$jezik/".$drzava->putanja;?>"><span><?php print translate($drzava->naziv, $jezik);?></span></a>
        <?php if(count($gradovi)>1)
        {
            foreach ($gradovi as $grad)
            {
            ?>
            <ul <?php if($this->uri->segment(1)==$drzava->putanja){print "style='display:block;'";}?>>
                <li ><a href='<?php print base_url()."$jezik/".$drzava->putanja."/".$grad->putanja?>'><span><?php print $grad->naziv?></span></a></li>
            </ul>
            <?php
            }
        }
        ?>
        </li>
        <?php }?>
    <?php }?>
    </ul>
</div>
<div class="right-container col-md-9">