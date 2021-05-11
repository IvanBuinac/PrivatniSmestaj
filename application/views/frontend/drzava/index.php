<section style="width: 100%;"   >
        <div class="col-md-12" style="margin-top:60px;">
<?php 
if(isset($drzava))
{
    
    $objekti=$this->objekat_m->get();
                        $lista=array();
                        $vrednosti=array();
                        $vrednost=array();
                        if(!empty($objekti))
                        {
                            
                            foreach ($objekti as $objekat)
                            {  
                                
                                $grad=$this->grad_m->get_by(array("grad_id"=>$objekat->grad_id,"drzava_id"=>$drzava->drzava_id,"status"=>1),TRUE);
                                if(!empty($grad))
                                {
                                       array_push($lista, $grad->grad_id);                                   
                                }
                                
                            }
                        }
                        if(!empty($lista))
                        {
                            
                            $gradovi=$this->grad_m->get_by_in(array("grad_id"=>$lista,"drzava_id"=>$drzava->drzava_id));
                            foreach($gradovi as $key => $grad)
                            {
                                $vrednosti=array();
                                ?>
                        <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="<?php print base_url()."$jezik/$drzava->putanja/$grad->putanja";?>">
                                <?php if(!empty($drzava->slika)){?><img src="<?php print base_url()."img/drzave/".str_replace(" ", "-", $drzava->naziv)."/".str_replace(" ", "-", $grad->naziv)."/$grad->slika.jpg"?>" alt="<?php print $grad->naziv;?>" class="img-responsive"><?php }?>
                            </a>
                            <?php 
                            $objekat=$this->objekat_m->get_by_in(array("grad_id"=>$grad->grad_id));

                            foreach($objekat as $obj)
                            {
                                $objekat_cene=$this->objekat_cene_m->get_by(array("smestajna_jed_id"=>NULL,"objekat_id"=>$obj->objekat_id));
                                
                                foreach($objekat_cene as $cenaaa)
                                {
                                    array_push($vrednosti,$cenaaa->cena);
                                }
                            }
                            
                            $minimum=min($vrednosti);
                            $clasa='';
                            if($minimum<=10)
                            {
                                $clasa='blue';
                            }
                            if($minimum>10 && $minimum<=20)
                            {
                                $clasa='orange';
                            }
                            if($minimum>20 && $minimum<=30)
                            {
                                $clasa='red';
                            }
                            print '<div class="ribbon"><span class="'.$clasa.'">Već od '.$minimum.'€</span></div>';
                            ?>
                            <div class="caption">
                             <?php print "<p><a href=".base_url()."$jezik/".create_link_for_object($drzava, $grad)." title='$grad->naziv'>$grad->naziv</a></p>"; ?>
                            </div>
                        </div></div>
                                <?php 
                            }
                        }
    
    ?>
      
<?php }?>
        </div>
</section>

