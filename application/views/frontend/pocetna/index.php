<div class="container social-buttons">
    <script type="text/javascript">
<!--
function show_VK_button() {
        if (window.VK) {
document.getElementById('my_VK_button').innerHTML=VK.Share.button({
  url: '<?php print current_url();?>',
  title: '<?php print $site_name;?>',
  description: '<?php  if(!isset($objekat) && !isset($smestajna))
                    {print $description;}
                    else if(isset($objekat) && !isset($smestajna))
                    {print strip_tags ($objekat->opis);}
                    else if(isset($smestajna))
                    { print strip_tags ($smestajna->opis);} ?>',
  image: '<?php  if(!isset($objekat) && !isset($smestajna))
                    {print base_url()."img/logos/PrivatniSmestaj.png";}
                    else if(isset($objekat) && !isset($smestajna))
                    {
                        $slika=$this->objekat_slika_m->get_by(array("objekat_id"=>$objekat->objekat_id,"glavna"=>1),TRUE);
                        print base_url()."".create_img("V", $objekat, NULL, $slika);              
                    }
                    else if(isset($smestajna))
                    { 
                        $slika=$this->smestajnajed_slika_m->get_by(array("smestajnajedinica_id"=>$smestajna->smestajnajedinica_id,"glavna"=>1),TRUE);
                        print base_url()."".create_img("V", $objekat, $smestajna, $slika); 
                    } ?>',
  noparse: true
});
}};
-->
</script>
<style type="text/css">
    .my_VK_button_outer {
        text-align: center;
    }
    .my_VK_button_outer > .my_VK_button_inner {
        display: inline-block;
    }
</style>
<div class="my_VK_button_outer pull-left">
    <span class="my_VK_button_inner" id="my_VK_button"></span>
</div>
<script async="async" src="https://vkontakte.ru/js/api/share.js?9" charset="windows-1251"  onload="show_VK_button()"></script>
    <div class="fb-like" data-href="<?php print current_url();?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
    <!-- Поставите ову ознаку тамо где желите да се приказује +1 дугме. -->
    <div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300" data-href="<?php print current_url();?>"></div>
    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php print current_url();?>" data-text="<?php print $site_name;?>" data-hashtags="<?php print $site_name;?>">Tweet</a>
    <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
    <script type="IN/Share" data-url="<?php print current_url();?>" data-counter="right"></script>
    <div class="clearfix"></div>

</div>
<script type="text/javascript">
    $( document ).ready(function() {
        var width;
        var max_width;
        var max_height;
        width=document.getElementsByClassName("thumb");
            max_width=width[0].clientWidth;
            max_height=max_width*9/16;
            $(".thumb .thumbnail").css("background-color","#BDBFBF");
            $(".thumb .caption").css("background-color","#FFFFFF");      
            $(".img-thumb").css("max-width",max_width);
            $(".img-thumb").css("max-height",max_height);
        $( window ).resize(function() {
          width=document.getElementsByClassName("thumb");
            max_width=width[0].clientWidth;
            max_height=max_width*9/16;
            $(".thumb .thumbnail").css("background-color","#BDBFBF");
            $(".thumb .caption").css("background-color","#FFFFFF");
            $(".img-thumb").css("max-width",max_width);
            $(".img-thumb").css("max-height",max_height);  
        });
});
    

</script>
<!--<style type="text/css">
/*    @media screen and (min-width: 769px) 
    {
        .thumb
        {
            max-height: 200px;
            overflow: hidden;
            background-color:#B8DCE9;
        }
        .thumb img
        {
        max-height: 200px;
        width:auto;
  margin:auto;
  display:block;
  object-fit: contain;
        }
    }*/
</style>-->
<div class="container">
   <div class="col-md-12">
       <h2 class="align-center"><?php print translate("Destinacije", $jezik)?></h2>
    <?php if(!empty($drzave)){?>
    <?php foreach($drzave as $key1 =>$drzava){?>
       <script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Place",
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": "<?php print $drzava->lat;?>",
    "longitude": "<?php print $drzava->long;?>"
  },
  "name": "<?php print $drzava->naziv;?>"
}
</script>
        <div class="col-md-3">
            <div class="thumbnail">
                <?php 
                        $objekti=$this->objekat_m->get();
                        $lista=array();
                        $vrednost=array();
                        if(!empty($objekti))
                        {
                            foreach ($objekti as $objekat)
                            {   
                                $vrednosti=array();
                                $grad=$this->grad_m->get_by(array("grad_id"=>$objekat->grad_id,"drzava_id"=>$drzava->drzava_id,"status"=>1),TRUE);
                                if(!empty($grad))
                                {
                                       array_push($lista, $grad->grad_id);                                   
                                }
                                
                            }
                        }
                        ?>
                <?php if(!empty(count($lista))){?>
                <a href="<?php print base_url()."$jezik/$drzava->putanja";?>">
                    <?php if(!empty($drzava->slika)){?><img src="<?php print base_url()."img/drzave/".str_replace(" ", "-", $drzava->naziv)."/$drzava->slika.jpg"?>" alt="<?php print $drzava->naziv;?>" class="img-responsive"><?php }?>
                </a>
                <?php }else{?>
                <img src="<?php print base_url()."img/drzave/".str_replace(" ", "-", $drzava->naziv)."/$drzava->slika.jpg"?>" alt="<?php print $drzava->naziv;?>" class="img-responsive">
                <?php }?>
                <div class="caption">
                    
                    <h3><?php print $drzava->naziv; ?></h3>
                    <?php 
                        
                        if(!empty($lista))
                        {
                            $gradovi=$this->grad_m->get_by_in(array("grad_id"=>$lista,"drzava_id"=>$drzava->drzava_id));
                            foreach($gradovi as $grad)
                            {
                                ?>
                            <script type="application/ld+json">
                            {
                              "@context": "http://schema.org",
                              "@type": "Place",
                              "geo": {
                                "@type": "GeoCoordinates",
                                "latitude": "<?php print $grad->lat;?>",
                                "longitude": "<?php print $grad->long;?>"
                              },
                              "name": "<?php print $grad->naziv;?>"
                            }
                            </script>
                                <?php 
                                print "<p><a href=".base_url()."$jezik/".create_link_for_object($drzava, $grad)." title='$grad->naziv'>$grad->naziv</a></p>";
                                $objekat=$this->objekat_m->get_by(array("grad_id"=>$grad->grad_id));
                                foreach($objekat as $key2=>$obj)
                                {
                                    $objekat_cene=$this->objekat_cene_m->get_by(array("smestajna_jed_id"=>NULL,"objekat_id"=>$obj->objekat_id));

                                    foreach($objekat_cene as $key3 => $cenaaa)
                                    {
                                        array_push($vrednosti, $cenaaa->cena);
                                    }
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
                        }
                        
                        
                        
                        
                    ?>
            </div>
        </div>
        </div>
    <?php }?>
    <?php }?> 
</div>
</div>
<div class="clearfix"></div>
<?php $broj_koji_se_prikazuje=4;
  $sh=  floor(12/$broj_koji_se_prikazuje);
  if(!empty($najposeceniji)){?>
    <?php $broj_objekata=count($najposeceniji);
    
            $broj=$broj_objekata/$broj_koji_se_prikazuje;
            $broj=  ceil($broj);
            
            if(isset($akcija)){
            $brakcija=count($akcija);
            $brakcije=$brakcija/$broj_koji_se_prikazuje;
            $brakcije=ceil($brakcije);
            }
    ?>
  <?php }?>
    <script type="text/javascript">
    // Carousel Auto-Cycle
  $(document).ready(function() {
    $('.carousel').carousel({
      interval: false,
      pause:"hover",
    });
    $(".skiptranslate").remove();
  });
  
    </script>
    <?php if(!empty($akcija)){?>
<div class="container">
    
        
        <div id="carousel-example-generic-akcija" class="carousel slide" data-ride="carousel">
            <div class="page-header align-center btn action col-md-12" >
          <h3 class="align-center"><?php print translate("Akcije", $jezik)?></h3>
          <p class="align-center">U ovom mesecu</p>
    </div>
            <div class="carousel-inner" role="listbox">
                <?php
                    $v=0;
                    foreach ($akcija as $key222 => $ak)
                    {
                       $v++;
                if($v==$broj_koji_se_prikazuje)
                {
                    $v=0;
                }
                if($key222==0)
                print '<div class="item active">';
                if(($key222 % $broj_koji_se_prikazuje) == 0 && $key222!=0)
                {
                        print '<div class="item">';
                }
                $smestajna=$ak;
                $objekat=$this->objekat_m->get_by(array("objekat_id"=>$ak->objekat_id,"status"=>1),TRUE);
                $grad=$this->grad_m->get_by(array("grad_id"=>$objekat->grad_id),TRUE);
                $drzavaaa=$this->drzava_m->get_by(array('drzava_id'=>$grad->drzava_id),TRUE);
                $slika=$this->smestajnajed_slika_m->get_by(array("smestajnajedinica_id"=>$smestajna->smestajnajedinica_id,"glavna"=>1),TRUE);
                $this->db->like("datum",$godina."-".$mesec,"after");
                $cena=$this->kalendar_popunjenosti_m->get_by(array("status"=>2,"smestajna_jed_id"=>$smestajna->smestajnajedinica_id),TRUE);
                print "<div class='col-md-$sh thumb'>
                            <div class='thumbnail'>
                            <h4 class='btn action col-md-12'>$ak->naziv</h4>
                            ";
                $vrsta=$this->vrsta_m->get_by(array("vrsta_id"=>$smestajna->vrsta_id),true);
                 if($slika!=NULL)
                                print "<a href='".  base_url()."$jezik/".  create_link_for_object($drzavaaa, $grad, $objekat,$smestajna)."' title='$smestajna->naziv'><img src='".  base_url()."".  create_img("M",$objekat, $smestajna, $slika)."' alt='$smestajna->naziv $slika->naziv' class='img-responsive  img-thumb' ></a>";
                            else
                                print "<a href='".  base_url()."$jezik/".  create_link_for_object($drzavaaa, $grad, $objekat,$smestajna)."' title='$smestajna->naziv'><img src='".  base_url()."img/NemaSlike.png' alt='No picture' class='img-responsive  img-thumb' ></a>";
                 print "<div class='action col-md-12 align-center'>$cena->cena €</div><div class='caption'>               
                		<p>".character_limiter(strip_tags($smestajna->opis), 50)."</p>
                                <a class='btn btn-mini' href='".  base_url()."$jezik/".  create_link_for_object($drzavaaa, $grad, $objekat,$smestajna)."'>&raquo; ".  translate("$vrsta->naziv<br/>$ak->naziv", $jezik)."</a>
                            </div>
                        </div>";
                            
                 print "</div>";
                
                if(($v % $broj_koji_se_prikazuje) == 0 && $key222!=0 || $key222+1==$broj_objekata)
                {
                    print '</div>';
                }
                    }
                ?>
                  
        
   
    
</div>
             
        </div>
    <a class="left carousel-control" href="#carousel-example-generic-akcija" role="button" data-slide="prev" style="width:50px;">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic-akcija" role="button" data-slide="next" style="width:50px;">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    </div>
    <ol class="carousel-indicators" style="position:relative;">
      <?php if(isset($brakcije)){for($h=0;$h<$brakcije;$h++){?>
        <?php if($h==0){?>
        <li data-target="#carousel-example-generic-akcija" data-slide-to="<?php print $h;?>" class="active" style="background-color:black;"></li>
        <?php }else{?>
        <li data-target="#carousel-example-generic-akcija" data-slide-to="<?php print $h;?>" style="background-color:black;"></li>
        <?php }?>
      <?php }}?>
  </ol> 

    <?php }?>
<div class="clearfix"></div>


  
<div class="container">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  
  

  <!-- Wrapper for slides -->
  <div class="page-header align-center btn btn-success col-md-12" >
          <h3><?php print translate("Izdvajamo iz ponude", $jezik,TRUE);?></h3>
    </div>
  <div class="carousel-inner" role="listbox">
      
    <?php
    if($najposeceniji!=NULL){$s=0;?>
        <?php foreach ($najposeceniji as $key234 => $najposs){?>
            <?php
                $s++;
                if($s==$broj_koji_se_prikazuje)
                {
                    $s=0;
                }
                
                if($key234==0)
                print '<div class="item active">';
                if(($key234 % $broj_koji_se_prikazuje) == 0 && $key234!=0)
                {
                        print '<div class="item">';
                }
                $grad=$this->grad_m->get_by(array("grad_id"=>$najposs->grad_id),TRUE);
                $drzavaaa=$this->drzava_m->get_by(array('drzava_id'=>$grad->drzava_id),TRUE);
                $slika=$this->objekat_slika_m->get_by(array("objekat_id"=>$najposs->objekat_id,"glavna"=>1),TRUE);
                $smestajna=NULL;
                $cena=$this->objekat_cene_m->get_by(array('objekat_id'=>$najposs->objekat_id));
                $cene=array();
                foreach($cena as $ca){if($ca->smestajna_jed_id==NULL){array_push($cene,$ca->cena );}}
                @$min=min($cene);
                ?>
      <script type="application/ld+json">
                {
                "@context": "http://schema.org",
                "@type": "LocalBusiness",
                "address": {
                "@type": "PostalAddress",
                "addressLocality": "<?php print $grad->naziv?>",
                "addressRegion": "<?php print $drzavaaa->naziv;?>",
                "streetAddress": "<?php print $najposs->adresa;?>"
                },
                "description": "<?php print $najposs->opis;?>",
                "name": "<?php print $najposs->naziv;?>",
                "telephone": "<?php $telefon=$this->korisnik_kontakt_m->get_by(array("korisnik_id"=>$najposs->korisnik_id),TRUE); print $telefon->telefon; ?>",
                
                }
                </script>
      <?php 
                print "<div class='col-md-$sh thumb'>
                            <div class='thumbnail'>
                            <h4 class='btn btn-success col-md-12'>$najposs->naziv</h4>
                            ";
                            if($slika!=NULL)
                                print "<a href='".  base_url()."$jezik/".  create_link_for_object($drzavaaa, $grad, $najposs,$smestajna)."' title='$najposs->naziv'><img src='".  base_url()."".  create_img("M",$najposs, $smestajna, $slika)."' alt='$najposs->naziv $slika->naziv' class='img-responsive  img-thumb' ></a>";
                            else
                                print "<a href='".  base_url()."$jezik/".  create_link_for_object($drzavaaa, $grad, $najposs,$smestajna)."' title='$najposs->naziv'><img src='".  base_url()."img/NemaSlike.png' alt='No picture' class='img-responsive  img-thumb' ></a>";
                            $tip=$this->tip_m->get_by(array("tip_id"=>$najposs->tip_id),TRUE);
                            $kategorija=$this->kategorija_m->get_by(array("kategorija_id"=>$najposs->kategorija_id),TRUE);
                            
                            print "
                            <div class='caption'>
                                <p class='bottom-border'>Tip smestaja<span>$tip->naziv</span></p>
                                <p class='bottom-border'>Kapacitet<span>$najposs->ukupni_kapacitet gostiju</span></p>
                                    <p class='bottom-border'>Kategorija<span>$kategorija->naziv</span></p>
                		<p>".character_limiter(strip_tags($najposs->opis), 50)."</p>
                                <a class='btn btn-mini' href='".  base_url()."$jezik/".  create_link_for_object($drzavaaa, $grad, $najposs,$smestajna)."'>&raquo; ".  translate("Smeštaj<br/> $najposs->naziv", $jezik)."</a>
                                ";
                            if(!empty($min))
                            {
                                $clasa='';
                            if($min<=10)
                            {
                                $clasa='blue';
                            }
                            if($min>10 && $min<=20)
                            {
                                $clasa='orange';
                            }
                            if($min>20 && $min<=30)
                            {
                                $clasa='red';
                            }
                            print '<div class="ribbon"><span class="'.$clasa.'">'.$min.'€</span></div>';
                            }
                        print "</div>
                        </div></div>";
                
                
                  
 
                if(($s % $broj_koji_se_prikazuje) == 0 && $key234!=0 || $key234+1==$broj_objekata)
                {
                    print '</div>';
                }
                
                
            ?>
        <?php }?>
    <?php }?>
    
  </div>
  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev" style="width:50px;">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next" style="width:50px;">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  
    </div>
</div>
    <ol class="carousel-indicators " style="position:relative;">
      <?php if(isset($broj)){for($i=0;$i<$broj;$i++){?>
        <?php if($i==0){?>
        <li data-target="#carousel-example-generic" data-slide-to="<?php print $i;?>" class="active " style="background-color:black;"></li>
        <?php }else{?>
        <li data-target="#carousel-example-generic" data-slide-to="<?php print $i;?>" style="background-color:black;"></li>
        <?php }?>
      <?php }}?>
  </ol>

    <div class="container">
    <div id="carousel-example-generic1" class="carousel slide" data-ride="carousel1" style="margin-bottom: 20px;">
  <!-- Indicators -->
  <?php if($randomsmestjane!=NULL){?>
    <?php $broj_smestaja=count($randomsmestjane);
            $broj1=$broj_smestaja/$broj_koji_se_prikazuje;
            $broj1=  ceil($broj1);
    ?>
  <?php }?>
  
  <div class="page-header align-center btn btn-primary col-md-12">
        <h4><?php print translate("Smestajne jedinice", $jezik);?></h4>
    </div>
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">   

    <?php
    if($randomsmestjane!=NULL){$s=0;?>
        <?php foreach ($randomsmestjane as $key234 => $najposs){?>
            <?php
               

                
                $objekat=$this->objekat_m->get_by(array("objekat_id"=>$najposs->objekat_id,"status"=>1),TRUE);
                ?>
      
                <?php 
                $smestajna=$najposs;
                
                if(!empty($objekat))
                {
                    if($s==0)
                {
                print '<div class="item active">';
                }
                if(($s % $broj_koji_se_prikazuje) == 0 && $s!=0)
                {
                        print '<div class="item">';
                }
                        $s++;
                     
                    ?>
      <script type="application/ld+json">
                {
                "@context": "http://schema.org",
                "@type": "LocalBusiness",
                "address": {
                "@type": "PostalAddress",
                "addressLocality": "<?php print $grad->naziv?>",
                "addressRegion": "<?php print $drzavaaa->naziv;?>",
                "streetAddress": "<?php print $objekat->adresa;?>"
                },
                "description": "<?php print $najposs->opis;?>",
                "name": "<?php print $najposs->naziv;?>",
                "telephone": "<?php $telefon=$this->korisnik_kontakt_m->get_by(array("korisnik_id"=>$objekat->korisnik_id),TRUE); print $telefon->telefon; ?>",
                "offers": {
                "@type": "Offer",
                "availability": "http://schema.org/InStock",
                "price": "<?php $cenovnik=  $this->objekat_cene_m->get_by(array("objekat_id"=>$objekat->objekat_id,"smestajna_jed_id"=>$najposs->smestajnajedinica_id),TRUE); print $cenovnik->cena;?>",
                "priceCurrency": "eur",
                "url": "<?php print base_url()."$jezik/".$drzavaaa->putanja."/".$grad->putanja."/".str_replace(' ', '-', $objekat->naziv)."-".$objekat->objekat_id."/".str_replace(' ', '-', $najposs->naziv)."-".$najposs->objekat_id;?>"
                }
                }
                </script>
                <?php
                $grad=$this->grad_m->get_by(array("grad_id"=>$objekat->grad_id),TRUE);
                $drzavaaa=$this->drzava_m->get_by(array('drzava_id'=>$grad->drzava_id),TRUE);
                $slika=$this->smestajnajed_slika_m->get_by(array("smestajnajedinica_id"=>$smestajna->smestajnajedinica_id,"glavna"=>1),TRUE);
                
                $cena=$this->objekat_cene_m->get_by(array('objekat_id'=>$najposs->objekat_id));
                $cene=array();
                foreach($cena as $ca){if($ca->smestajna_jed_id==$smestajna->smestajnajedinica_id){array_push($cene,$ca->cena );}}
                @$min=min($cene);
                print "<div class='col-md-$sh thumb'>
                            <div class='thumbnail'>
                            <h4 class='btn btn-primary col-md-12' >$smestajna->naziv</h4>";
                            if($slika!=NULL)
                                print "<a href='".  base_url()."$jezik/".  create_link_for_object($drzavaaa, $grad, $objekat,$smestajna)."' title='$smestajna->naziv'><img src='".  base_url()."".  create_img("M",$objekat, $smestajna, $slika)."' alt='$smestajna->naziv $slika->naziv' class='img-responsive  img-thumb' ></a>";
                            else
                                print "<a href='".  base_url()."$jezik/".  create_link_for_object($drzavaaa, $grad, $objekat,$smestajna)."' title='$smestajna->naziv'><img src='".  base_url()."img/NemaSlike.png' alt='No picture' class='img-responsive  img-thumb' ></a>";
                            $vrsta=$this->vrsta_m->get_by(array("vrsta_id"=>$najposs->vrsta_id),true);
                            print "
                            <div class='caption'>
                                <p class='bottom-border'>Kapacitet<span>$najposs->broj_mesta gostiju</span></p>
                                <p class='bottom-border'>Vrsta<span>$vrsta->naziv</span></p>
                		<p>".character_limiter(strip_tags($smestajna->opis), 50)."</p>
                                <a class='btn btn-mini' href='".  base_url()."$jezik/".  create_link_for_object($drzavaaa, $grad, $objekat,$smestajna)."'>&raquo; ".  translate("$vrsta->naziv<br/>$smestajna->naziv", $jezik)."</a>
                            ";
                            if(!empty($min))
                            {
                                $clasa='';
                            if($min<=10)
                            {
                                $clasa='blue';
                            }
                            if($min>10 && $min<=20)
                            {
                                $clasa='orange';
                            }
                            if($min>20 && $min<=30)
                            {
                                $clasa='red';
                            }
                            print '<div class="ribbon"><span class="'.$clasa.'">'.$min.'€</span></div>';
                            }
                            
                            print "</div>
                        </div></div>";
                
                if(($s % $broj_koji_se_prikazuje) == 0 && $s!=0 || $s==$broj_smestaja)
                {
                    print '</div>';
                }
                  
 
                
                }
                
            ?>
        <?php }?>
    <?php }?>
    
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic1" role="button" data-slide="prev" style="width:50px;">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic1" role="button" data-slide="next" style="width:50px;">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>  

    </div>                        
    </div>
    <ol class="carousel-indicators" style="position:relative;">
      <?php if(isset($broj1)){for($h=0;$h<$broj1;$h++){?>
        <?php if($h==0){?>
        <li data-target="#carousel-example-generic1" data-slide-to="<?php print $h;?>" class="active" style="background-color:black;"></li>
        <?php }else{?>
        <li data-target="#carousel-example-generic1" data-slide-to="<?php print $h;?>" style="background-color:black;"></li>
        <?php }?>
      <?php }}?>
  </ol>