<?php if(isset($smestajna)){?>
<script>
		$(document).ready(function(){
			$(document).on('click','.next_button',function(){
                                var href=base_url();
				href += $(this).find('div').attr('class');
                                
				$.post(href, {}, function(data){
					$('#calendar').html(data);
					//alert(data);
				})

				return false;
			});
			$(document).on('click','.prev_button',function(){
				var href=base_url();
				href += $(this).find('div').attr('class');
                                
				$.post(href, {}, function(data){
					$('#calendar').html(data);
					//alert(data);
				})

				return false;
			});
		});
	</script>
    <link rel="stylesheet" href="<?php print base_url()."css/prettyPhoto.css";?>" type="text/css" media="screen" title="prettyPhoto main stylesheet" property='stylesheet'/>
    <script src="<?php print base_url()."js/jquery.prettyPhoto.js";?>" type="text/javascript" charset="utf-8"></script>
     <div class="coverphoto">
        <?php $slika=$this->smestajnajed_slika_m->get_by(array("smestajnajedinica_id"=>$smestajna->smestajnajedinica_id,"glavna"=>1),TRUE);?>
         <img src="<?php if(isset($slika->putanja)){print base_url()."".  create_img("V", $objekat, $smestajna, $slika); }else{print base_url()."img/NemaSlike.png";}?>" class="img-responsive img-thumbnail" alt="<?php print $smestajna->naziv." | ".$slika->naziv;?>" itemprop="image"  title="<?php print $smestajna->naziv;?>">
    </div>
    <div class="objekat-holder container">
        <div class="row">
            <div class="lista gallery thumbnails col-sm-6" >
                <ul class="gallery clearfix ">
                    <li>                    
                        <a href="<?php if(isset($slika->putanja)){print base_url()."".create_img("V", $objekat, $smestajna, $slika);}else{print base_url()."img/NemaSlike.png";}?>" rel="prettyPhoto" title="<?php print $smestajna->naziv." | ".$slika->naziv;?>" alt="<?php print $smestajna->naziv." | ".$slika->naziv;?>">
                        <img src="<?php if(isset($slika->putanja)){print base_url()."".create_img("M", $objekat, $smestajna, $slika);}else{print base_url()."img/NemaSlike.png";}?>" class="img-responsive img-thumbnail" alt="<?php print $smestajna->naziv." | ".$slika->naziv;?>" itemprop="image" title="<?php print $smestajna->naziv." | ".$slika->naziv;?>">
                        </a>
                        <meta itemprop="datePublished" content="<?php if(isset($slika->datum)){print date('Y-m-d H:i:s',$slika->datum);}?>">
                    </li>
                </ul>
            </div>
            <div itemscope itemtype="http://schema.org/LocalBusiness" class="col-sm-6 ">
                <h2 style="display: inline;" class="white"><span itemprop="name"><?php print $smestajna->naziv;?></span></h2>
                <div class="clearfix"></div>
                
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4 left-col pull-left">
            
            <div class="col-lg-12 col-md-12" style="margin-top:20px;margin-bottom: 20px;">
                <div class="col-md-6 visible-desktop dark-blue"></div>
                <div class="col-md-6 visible-desktop blue"></div></div>
                <div class="user-details">
                    <h3 style="text-align: center;"><?php print translate("Podaci o korisniku:", $jezik)?></h3>
                    <div class="row col-sm-12">
                        <?php $user=$this->korisnik_m->get_by(array("korisnik_id"=>$objekat->korisnik_id),TRUE);?>
                        <div class="col-sm-8"><?php print translate("Kontakt osoba:", $jezik);?></div><div class="col-sm-4"><?php print $user->ime." ".$user->prezime;?></div>
                        <div class="col-sm-8"><?php print translate("Adresa:", $jezik);?></div><div class="col-sm-4"><?php print $objekat->adresa;?></div>
                        <?php $putanja=$this->uri->rsegment(4)."/".$this->uri->rsegment(5);?>
                        <div class="col-sm-8"><?php print translate("Mesto:", $jezik);?></div><div class="col-sm-4"><?php print "<a href='".base_url().$jezik."/$putanja'>$putanja</a>"?></div>
                        <?php $korisnik_kontakt=$this->korisnik_kontakt_m->get_by(array("korisnik_id"=>$user->korisnik_id))?>
                        <?php foreach($korisnik_kontakt as $kontakt){?>
                        <div class="col-sm-8"><?php print translate("Kontakt telefon:", $jezik)?></div><div class="col-sm-4"><?php print $kontakt->telefon; ?></div>
                        <?php }?>
                        <div class="col-sm-8"><?php print translate("Web:", $jezik)?></div><div class="col-sm-4"><?php if(url_exist(addhttp($objekat->web))){ print "<a href='".addhttp($objekat->web)."'>$objekat->naziv</a>";}?></div>
                        <?php $kapara=$this->kapara_m->get_by(array("kapara_id"=>$objekat->kapara_id),TRUE);?>
                        <div class="col-sm-8"><?php print translate("Kapara:", $jezik)?></div><div class="col-sm-4"><?php print $kapara->vrednost."%";?></div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top:20px;margin-bottom: 20px;">
                <div class="col-md-6 visible-desktop dark-blue"></div>
                <div class="col-md-6 visible-desktop blue"></div></div>
                <div class="iznajmljujuse ">
                    <h3 style="text-align: center;"><?php print translate("Vrsta smestajne jedinice:", $jezik)?></h3>
                    <?php $vrsta=$this->vrsta_m->get_by(array("vrsta_id"=>$smestajna->vrsta_id),TRUE);?>
                    <div class="row col-xs-12">
                        <div class='col-xs-8'>Vrsta:</div><div class='col-xs-4'><?php print $vrsta->naziv?></div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top:20px;margin-bottom: 20px;">
                <div class="col-md-6 visible-desktop dark-blue"></div>
                <div class="col-md-6 visible-desktop blue"></div></div>
                <div class="doba">
                    <h3 style="text-align: center;"><?php print translate("Period u kom se iznajmljuje:", $jezik)?></h3>
                    <p style="text-align: center;"><?php print translate("(slika u boji-iznajmljuje se,crno-bela - ne iznajmljuje se)", $jezik)?></p>
                    <div class="row col-xs-12">
                    <?php $doba=$this->godina_m->get();
                        
                        foreach ($doba as $key => $dob)
                        {
                            $objekat_doba=$this->objekat_doba_m->get_by(array("objekat_id"=>$objekat->objekat_id,"doba_id"=>$dob->doba_id),TRUE);
                            if($objekat_doba!=NULL)
                            {
                                print "<div class='col-xs-8'>$dob->naziv</div><div class='col-xs-4'><img src='".base_url()."img/doba/".$dob->slika_obojena."' class='sezona' title='".$dob->naziv."' alt='".$dob->naziv."'></div>";
                            }
                            else
                            {
                                print "<div class='col-xs-8'>$dob->naziv</div><div class='col-xs-4'><img src='".base_url()."img/doba/".$dob->slika_crno_bela."' class='sezona' title='".$dob->naziv."' alt='".$dob->naziv."'></div>";
                            }
                        }   
                        ?>
                    </div>
                </div>    
            </div>
            <div class="col-md-8">
                
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
<style>
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
    <div class="clearfix"></div>
    
                <div class="description">
                    <h3 style="text-align: center;"><?php print translate("Opis:", $jezik)?></h3>
                  <?php print $smestajna->opis;?>  
                </div>
    <div class="col-xs-12" style="margin-top:20px;margin-bottom: 20px;">
                <div class="col-md-6 visible-desktop dark-blue"></div>
                <div class="col-md-6 visible-desktop blue"></div></div>
    <div class="lista  thumbnails " >
                <ul class="gallery clearfix" style="padding:0px;">
                    
                        <?php $slikee=$this->smestajnajed_slika_m->get_by(array("smestajnajedinica_id"=>$smestajna->smestajnajedinica_id,"glavna"=>0));?>
                        <?php foreach ($slikee as $slikaa){?>
                    <script type="text/javascript">
            
    $( document ).ready(function() {
        var width;
        var max_width;
        var max_height;
        width=document.getElementsByClassName("gallery-images");
        
            max_width=width[0].clientWidth;
            max_height=max_width*9/16;
            $(".gallery-image").css("max-width",max_width);
            $(".gallery-image").css("max-height",max_height);
        $( window ).resize(function() {
          width=document.getElementsByClassName("thumb");
            max_width=width[0].clientWidth;
            max_height=max_width*3/4;  
            $(".gallery-image").css("max-width",max_width);
            $(".gallery-image").css("max-height",max_height);  
        });
});
    

</script>
                        <li class="col-md-2 gallery-images thumbnail">
                        <a href="<?php if(isset($slikaa->putanja)){print base_url()."".create_img("V", $objekat, $smestajna, $slikaa);}else{print base_url()."img/NemaSlike.png";}?>" rel="prettyPhoto[Galery2]"  title="<?php print $smestajna->naziv." | ".$slika->naziv;?>" alt="<?php print $smestajna->naziv." | ".$slika->naziv;?>">
                        <img src="<?php if(isset($slikaa->putanja)){print base_url()."".create_img("M", $objekat, $smestajna, $slikaa);}else{print base_url()."img/NemaSlike.png";} ?>" class="img-responsive img-thumbnail gallery-image" alt="<?php print $smestajna->naziv." | ".$slika->naziv;?>" itemprop="image" title="<?php print $smestajna->naziv." | ".$slika->naziv;?>">
                        </a>
                        <meta itemprop="datePublished" content="<?php if(isset($slikaa->datum)){print date('Y-m-d H:i:s',$slikaa->datum);}?>">
                        </li>
                        <?php }?>
                        
                </ul>
                <div class="clearfix"></div>
            </div>
                <div class="col-xs-12" style="margin-top:20px;margin-bottom: 20px;">
                <div class="col-md-6 visible-desktop dark-blue"></div>
                <div class="col-md-6 visible-desktop blue"></div></div>
                 <ul class="nav nav-tabs" role="tablist" id="myTab">
    <li role="presentation" class="active"><a href="#karakteristike" aria-controls="karakteristike" role="tab" data-toggle="tab">Karakteristike smestaja</a></li>
    <li role="presentation"><a href="#cene" aria-controls="cene" role="tab" data-toggle="tab">Cene</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="karakteristike">
    <div class="karakteristike">
                    <h3 style="text-align: center;"><?php print translate("Karakteristike smestaja:", $jezik)?></h3>
                    <?php ?>
                    <div class="row col-sm-12" style="margin-bottom: 20px;"><?php $legende=$this->legenda_m->get(); foreach($legende as $legenda){$alt=explode(".",$legenda->slika);print "<div class='col-sm-3'>$legenda->naziv</div><div class='col-sm-1'><img src='".base_url()."img/$legenda->slika' alt='$alt[0]'/></div>";}?></div>
                    <div class="row col-sm-12">
                    <?php $karakteristike=$this->karakteristika_m->get_by(array("chack"=>NULL));?>
                    <?php foreach ($karakteristike as $key1 => $karakteristika){?>
                    <?php 
                    $brojac1=0;
                    if($key1%3==0 && $key1!=0)
                    {
                            print  "</div><div class='row col-sm-12'>";
                    }
                    
                    print "<div class='col-sm-3'>$karakteristika->naziv</div><div class='col-sm-1'>";
                    ?>
                        <?php $objekat_karakteristika=$this->objekat_karakteristika_m->get_by(array("objekat_id"=>$objekat->objekat_id,"smestajna_jed_id"=>$smestajna->smestajnajedinica_id,"karakteristika_id"=>$karakteristika->karakteristike_id));?>
                            <?php foreach ($objekat_karakteristika as $key3 =>$objekat_kara){?>
                                <?php 
                                            print "<img src='".base_url()."img/yes.png' alt='yes' width='20' height='20'/>";$brojac1++;
                                ?>
                            <?php }?>
                    <?php
                    if($brojac1==0)
						 {
						echo "<img src='".base_url()."img/no.png' alt='no' width='20' height='20' />";
						 }
                    print "</div>";?>
                    <?php } ?>

                </div>
                
                
            </div>
    </div>
      
          <div role="tabpanel" class="tab-pane" id="cene">           
              <div class='row col-sm-12 prices'>
              <h3 style="text-align: center;"><?php print translate("Cene smestaja:", $jezik)?></h3>
              <?php $detaljan_cenovnik=$this->objekat_detaljan_cenovnik_m->get_by(array("objekat_id"=>$objekat->objekat_id,"smestajna_jed_id"=>$smestajna->smestajnajedinica_id));
              if($detaljan_cenovnik!=NULL)
              {
                    foreach ($detaljan_cenovnik as $key1=>$detaljan)
                    {
                        print "<div class='col-sm-3'>Od:$detaljan->od</div><div class='col-sm-3'>Do:$detaljan->do</div><div class='col-sm-3'>Cena:$detaljan->cena</div><div class='col-sm-3'>$detaljan->cena_za</div>";
                    }
              }
                else {
                    $sezone=$this->cenausezoni_m->get();
                    
                    foreach($sezone as $sezona)
                    {
                        print "<div class='col-sm-8'>$sezona->naziv</div><div class='col-sm-4'>";
                        $cenovnik=$this->objekat_cene_m->get_by(array("objekat_id"=>$objekat->objekat_id,"smestajna_jed_id"=>$smestajna->smestajnajedinica_id,"sezona_id"=>$sezona->cenausezoni_id),TRUE);
                        if(isset($cenovnik->cena))
                        {
                            print "$cenovnik->cena(€)";
                            if($cenovnik->status==$cenovnik->sezona_id)
                            {
                                print "<img src='".base_url()."img/yes.png' alt='trenutna cena' title='trenutna cena'/>";
                            }
                        }else{
                            print "Nema";
                        }
                        print "</div>";
                    }
                    
                }
              ?>
              </div>
              
          </div>
  </div>
  <div class="col-sm-12" style="margin-top:20px;margin-bottom: 20px;">
                <div class="col-md-6 visible-desktop dark-blue"></div>
                <div class="col-md-6 visible-desktop blue"></div></div> 
          <div class='row col-sm-12'>
              
              <style>
    .calendar
    {
        font-family: Arial;
        for-size:12px;
    }
    table.calendar
    {
        margin:auto;
        border-collapse: collapse;
    }
    .header
    {
    background-color: #428bca;
    color:white;    
    }
    .calendar .row td:hover
    {
     background-color: #428bca;   
    }
    .calendar .highlight
    {
    font-weight: bold;
    font-size:18px;
    }
    .sredina
    {
        height:30px;
    }
</style>
<h3 style="text-align: center;"><?php print translate("Kalendar popunjenosti:", $jezik)?></h3>
<p style="background-color:rgb(217, 83, 79);">Zauzeto</p>
    <div class="table-responsive" id="calendar">          
    <?php print $kalendar;?>
    </div>
          </div>
            </div>
        </div>
    </div>
<?php } ?>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$("area[rel^='prettyPhoto']").prettyPhoto();
				
				$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:10000, autoplay_slideshow: true,deeplinking: false,});
				$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',slideshow:10000, hideflash: true,deeplinking: false,autoplay_slideshow: true,});
		
				$("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
					custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
					changepicturecallback: function(){ initialize(); }
				});

				$("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
					custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
					changepicturecallback: function(){ _bsap.exec(); }
				});
			});
			</script>


