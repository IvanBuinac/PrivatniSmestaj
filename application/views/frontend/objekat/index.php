<?php if(isset($objekat)){?>

    <?php $message=$this->session->flashdata('message');
    ?>
    <?php $s=$objekat->posecenost+1; $data['posecenost']=$s;$this->objekat_m->save($data,$objekat->objekat_id);?>
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
    <?php if(isset($message)){print $message;}?>
    <div class="coverphoto">
        <?php $slika=$this->objekat_slika_m->get_by(array("objekat_id"=>$objekat->objekat_id,"glavna"=>1),TRUE);?>
        <img src="<?php if(isset($slika->putanja)){print base_url()."img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/V".str_replace(" ","-",$slika->naziv)."".$slika->putanja; }else{print base_url()."img/NemaSlike.png";}?>" class="img-responsive img-thumbnail" alt="<?php print $objekat->naziv;?>" itemprop="image"  title="<?php print $objekat->naziv;?>">
    </div>
    <div class="objekat-holder container">
        <div class="row">
            <div class="lista gallery thumbnails col-sm-6" >
                <ul class="gallery clearfix ">
                    <li>                    
                        <a href="<?php if(isset($slika->putanja)){print base_url()."img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/V".str_replace(" ","-",$slika->naziv)."".$slika->putanja; }else{print base_url()."img/NemaSlike.png";}?>" rel="prettyPhoto" title="<?php print $objekat->naziv;?>">
                        <img src="<?php if(isset($slika->putanja)){print base_url()."img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/M".str_replace(" ","-",$slika->naziv)."".$slika->putanja; }else{print base_url()."img/NemaSlike.png";}?>" class="img-responsive img-thumbnail" alt="<?php print $objekat->naziv;?>" itemprop="image" title="<?php print $objekat->naziv;?>">
                        </a>
                        <meta itemprop="datePublished" content="<?php if(isset($slika->datum)){print date('Y-m-d H:i:s',$slika->datum);}?>">
                    </li>
                </ul>
            </div>
            <div itemscope itemtype="http://schema.org/LocalBusiness" class="col-sm-6 ">
                <h2 style="display: inline;font-size: 45px;" class="white"><span itemprop="name"><?php print $objekat->naziv;?></span></h2>
                <div class="btn btn-primary pull-right" ><span class="badge"><?php print $objekat->posecenost;?></span></div>
                <div class="clearfix"></div>
                <span class="pull-right"><?php $kategorijaa=$this->kategorija_m->get_by(array("kategorija_id"=>$objekat->kategorija_id),TRUE); 
                for($i=0;$i<$kategorijaa->kategorija_id;$i++)
                {
                    print "<img src='".  base_url()."img/star.png' alt='star'/>";
                }
                ?></span>
                <div class="clearfix"></div>
            </div>
        </div>
        
       
            <div class="col-md-4 left-col pull-left">
                 <script type="text/javascript">
                $().ready(function () {
            var stickyPanelOptions = {
                topPadding: 60,
                afterDetachCSSClass: "",
                savePanelSpace: false,
                onDetached: function (detachedPanel, spacerPanel) {
                },
                onReAttached: function (detachedPanel) {
                },
                parentSelector: null
            };

            // multiple panel example (you could also use the class ".stickypanel" to select both)
            $(".scroller").stickyPanel(stickyPanelOptions);
            //$(".ui-corner-all").stickyPanel(stickyPanelOptions);
            
        });
</script>
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
                        <div class="col-sm-6"><button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal"><?php print translate("Posaljite Upit", $jezik)?></button></div><div class="col-sm-6"><button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#Mapa" onclick="resizeMap(event);"><?php print translate("Pogledajte mapu", $jezik)?></button></div>
                        <div class="col-sm-6"><button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#kapara"><?php print translate("Izracunaj kaparu", $jezik)?></button></div><div class="col-sm-6"><button class="btn btn-warning btn-block">Ubaci u listu zelja</button></div>
                        <div class="col-sm-12 scroller hidden-sm hidden-xs hidden-md" style="z-index:1000;"><button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#Rezervisiodmah"><?php print translate("Rezervisi odmah", $jezik)?></button></div>
                        <div class="col-sm-12 hidden-lg"><button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#Rezervisiodmah"><?php print translate("Rezervisi odmah", $jezik)?></button></div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top:20px;margin-bottom: 20px;">
                <div class="col-md-6 visible-desktop dark-blue"></div>
                <div class="col-md-6 visible-desktop blue"></div></div>
                <div class="iznajmljujuse ">
                    <h3 style="text-align: center;"><?php print translate("Iznajmljuju se:", $jezik)?></h3>
                    <?php $iznajmljujese=$this->iznajmljujese_m->get();?>
                    <div class="row col-xs-12">
                        <?php foreach($iznajmljujese as $iznajmljuje){?>
                            <?php $objekatiznajmljujese=$this->objekat_iznajmljujese_m->get_by(array("objekat_id"=>$objekat->objekat_id,"iznajmljujese_id"=>$iznajmljuje->iznajmljujese_id),TRUE);?>
                            <?php                                     
                            if($iznajmljuje->iznajmljujese_id==isset($objekatiznajmljujese->iznajmljujese_id))
                            {
                                print "<div class='col-xs-8'>$iznajmljuje->naziv</div><div class='col-xs-4'><img src='".  base_url()."img/yes.png' alt='yes'/></div>";
                            }
                            else 
                            {
                                print "<div class='col-xs-8'>$iznajmljuje->naziv</div><div class='col-xs-4'><img src='".  base_url()."img/no.png' alt='yes'/></div>";
                            }
                            ?>
                        <?php }?>
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
                <div class="clearfix"></div>
                <div class="col-xs-12" style="margin-top:20px;margin-bottom: 20px;">
                <div class="col-md-6 visible-desktop dark-blue"></div>
                <div class="col-md-6 visible-desktop blue"></div></div>
                
                <div class="weather">
                    
                    <?php
                        @$url = "http://api.openweathermap.org/data/2.5/forecast/daily?lat=$objekat->kordinata_x&lon=$objekat->kordinata_y&cnt=7&mode=xml&appid=6cbe904b9230847c5dc090ed32da964c&units=metric";
                       @$xml = simplexml_load_file($url);
//$result = $xml->xpath('forecast');
$json = json_encode($xml);
$result = json_decode($json,TRUE);

if(count(@$result)>0)
{
foreach(@$result as $key =>$value)
{
    print "<div class='row'>";
    if(isset($value['name']))
    print "<div class='col-md-12' style='text-align:center;'>Vremenska prognoza za ".$value['name']."</div>";
    if(isset($value['time']))
    {
        foreach ($value['time'] as $key1 => $time)
        {
            print "<div class='row col-md-12' style='margin-top:15px;margin-bottom:15px;'>";
            print "<div class='col-md-4 pull-right'>";
            print "<div class='col-md-12'><img src='http://openweathermap.org/img/w/".$time['symbol']['@attributes']['var'].".png' alt='".$time['symbol']['@attributes']['name']."' class='img-responsive'/></div>";
            if(isset($time['temperature']['@attributes']['min']) && isset($time['temperature']['@attributes']['max']))
            print "<div class='col-md-12' style='color:blue;'>".$time['temperature']['@attributes']['min']."ºC</div><div class='col-md-12' style='color:red;'>".$time['temperature']['@attributes']['max']."ºC</div>";
            print "</div>";
            print "<div class='col-md-8 pull-left'>";
            print "<div class='col-md-6' style='text-align:center;'>".$time['@attributes']['day']."</div>";
            if(isset($time['precipitation']['@attributes']['type']))
            print "<div class='col-md-12'>".$time['precipitation']['@attributes']['type']."</div>";
            else
            print "<div class='col-md-12'>No details</div>";   
            print "<div class='col-md-12'>".$time['windDirection']['@attributes']['name']." ".$time['windSpeed']['@attributes']['mps']."km/h</div>";
            print "<div class='col-md-12'>humidity ".$time['humidity']['@attributes']['value']."%</div>";
            print "<div class='col-md-12'>".$time['clouds']['@attributes']['value']."</div>";
            
            print "</div>";
            
            print "</div>";
            
        }
    }
    print "</div><div clas='clearfix'></div>";
}
}
 

                       ?>
                </div>
            </div>
            
            <div class="col-md-8 pull-right">
<div class="container social-buttons col-md-12">
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
                  <?php print $objekat->opis;?>  
                </div>
                <div class="col-xs-12" style="margin-top:20px;margin-bottom: 20px;">
                <div class="col-md-6 visible-desktop dark-blue"></div>
                <div class="col-md-6 visible-desktop blue"></div></div>
                <div class="lista  thumbnails " >
                <ul class="gallery clearfix" style="padding:0px;">
                    
                        <?php $slikee=$this->objekat_slika_m->get_by(array("objekat_id"=>$objekat->objekat_id,"glavna"=>0));?>
                        <?php foreach ($slikee as $slikaa){?>
                    <script type="text/javascript">
            
    $( document ).ready(function() {
        var width;
        var max_width;
        var max_height;
        width=document.getElementsByClassName("gallery-images");
        if(width!=null)
        {
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
    }
});

    

</script>
                        <li class="col-sm-2 gallery-images thumbnail" style="margin:0px;padding: 0px;">
                        <a href="<?php if(isset($slikaa->putanja)){print base_url()."img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/V".str_replace(" ","-",$slikaa->naziv)."".$slikaa->putanja; }?>" rel="prettyPhoto[Galery1]"  title="<?php print $objekat->naziv;?>" alt="<?php print $objekat->naziv;?>">
                        <img src="<?php if(isset($slikaa->putanja)){print base_url()."img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/M".str_replace(" ","-",$slikaa->naziv)."".$slikaa->putanja; }?>" class="img-responsive img-thumbnail gallery-image" alt="<?php print $objekat->naziv;?>" itemprop="image" title="<?php print $objekat->naziv;?>">
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
                <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist" id="myTab">
    <li role="presentation" class="active"><a href="#karakteristike" aria-controls="karakteristike" role="tab" data-toggle="tab">Karakteristike smestaja</a></li>
    <li role="presentation"><a href="#udaljenosti" aria-controls="udaljenosti" role="tab" data-toggle="tab">Udaljenosti smestaja</a></li>
    <li role="presentation"><a href="#ceneiplacanja" aria-controls="ceneiplacanja" role="tab" data-toggle="tab">Cene i Placanja</a></li>
    <li role="presentation"><a href="#video" aria-controls="video" role="tab" data-toggle="tab">Video</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
      <div role="tabpanel" class="tab-pane" id="video">
         <div class="embed-responsive embed-responsive-16by9">
             <?php 
             $niz=explode("?",$objekat->youtube_link);
             $broj=count($niz);
             $niz1=explode("=",$niz[$broj-1]);
             $broj1=count($niz1);
             ?>
        <object class="col-md-12 embed-responsive-item" data="https://www.youtube.com/embed/<?php print $niz1[$broj1-1];?>">
</object>
         </div>
      </div>
    <div role="tabpanel" class="tab-pane active" id="karakteristike">
    <div class="karakteristike">
                    <h3 style="text-align: center;"><?php print translate("Karakteristike smestaja:", $jezik)?></h3>
                    <?php ?>
                    <div class="row col-sm-12" style="margin-bottom: 20px;"><?php $legende=$this->legenda_m->get(); foreach($legende as $legenda){$alt=explode(".",$legenda->slika);print "<div class='col-sm-3'>$legenda->naziv</div><div class='col-sm-1'><img src='".base_url()."img/$legenda->slika' alt='$alt[0]'/></div>";}?></div>
                    <div class="row col-sm-12">
                    <?php $karakteristike=$this->karakteristika_m->get();?>
                    <?php foreach ($karakteristike as $key1 => $karakteristika){?>
                    <?php 
                    $brojac1=0;
                    if($key1%3==0 && $key1!=0)
                    {
                            print  "</div><div class='row col-sm-12'>";
                    }
                    
                    print "<div class='col-sm-3'>$karakteristika->naziv</div><div class='col-sm-1'>";
                    ?>
                        <?php $objekat_karakteristika=$this->objekat_karakteristika_m->get_by(array("objekat_id"=>$objekat->objekat_id,"smestajna_jed_id"=>NULL,"karakteristika_id"=>$karakteristika->karakteristike_id));?>
                            <?php foreach ($objekat_karakteristika as $key3 =>$objekat_kara){?>
                                <?php 
                                 if($objekat_kara->legenda_id==0)
                                    {
                                            print "<img src='".base_url()."img/yes.png' alt='yes' width='20' height='20'/>";$brojac1++;
                                    }
                                    else
                                    {
                                        $legende=$this->legenda_m->get_by(array("legenda_id"=>$objekat_kara->legenda_id));
                                        foreach ($legende as $legenda)
                                        {
                                            print "<img src='".base_url()."img/$legenda->slika' alt='$legenda->slika' width='20' height='20' />";$brojac1++;
                                        }
                                        
                                    }
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
      <div role="tabpanel" class="tab-pane" id="udaljenosti">
          <div class='udaljenosti col-sm-12 row'>
              <h3 style="text-align: center;"><?php print translate("Udaljenosti smestaja:", $jezik)?></h3>
              <?php $udaljenosti=$this->razdaljine_m->get();?>
              <?php foreach ($udaljenosti as $key1 => $udaljenost){?>
                    <?php 
                    if($key1%3==0 && $key1!=0)
                    {
                            print  "</div><div class='row col-sm-12'>";
                    }
                    ?>
                    <div class='col-sm-3'><?php print $udaljenost->naziv;?></div><div class='col-sm-1'>
                    <?php $objekat_udaljenost=$this->objekat_razdaljine_m->get_by(array("objekat_id"=>$objekat->objekat_id,"razdaljine_id"=>$udaljenost->razdaljine_id),TRUE);  ?>
                    <?php if(isset($objekat_udaljenost->vrednost))
                    {
                        print $objekat_udaljenost->vrednost;
                    }else {
                        print "Nema";
                        }
                    print "</div>";
                    ?>
              <?php }?>
          </div>
  
      </div>
          <div role="tabpanel" class="tab-pane" id="ceneiplacanja">
              <div class='paying row col-sm-12'>
                  <h3 style="text-align: center;"><?php print translate("Način Plaćanja:", $jezik)?></h3>
                  <?php $placanja=$this->nacinplacanja_m->get();?>
                  <?php foreach ($placanja as $key1 =>$placanje){
                    if($key1%3==0 && $key1!=0)
                    {
                            print  "</div><div class='row col-sm-12'>";
                    }
                  ?>
                  <div class='col-sm-3'><?php print $placanje->naziv;?></div><div class='col-sm-1'>
                  <?php $objekat_nacin=$this->objekat_nacinplacanja_m->get_by(array("objekat_id"=>$objekat->objekat_id,"nacin_id"=>$placanje->nacinplacanja_id),TRUE);?>
                  <?php if(isset($objekat_nacin->nacin_id))
                  {
                      print "<img src='".  base_url()."img/$placanje->slikauboji' alt='$placanje->naziv' width='40' height='40'/>";
                  }else{
                      print "<img src='".  base_url()."img/$placanje->crnobela' alt='$placanje->naziv' width='30' height='30' />";
                  }
                      print "</div>";
                      ?>
                  <?php }?>
              </div>
              <div class='row col-sm-12 prices'>
              <h3 style="text-align: center;"><?php print translate("Cene smestaja:", $jezik)?></h3>
              <?php $detaljan_cenovnik=$this->objekat_detaljan_cenovnik_m->get_by(array("objekat_id"=>$objekat->objekat_id));
              if($detaljan_cenovnik!=NULL)
              {
                    foreach ($detaljan_cenovnik as $key1=>$detaljan)
                    {
                        $za="";
                        if($detaljan->cena_za==1)
                            $za="Po osobi";
                        else
                            $za="Za ceo smestaj";
                        print "<div class='col-md-12'><div class='col-sm-4'>Od:$detaljan->od</div><div class='col-sm-4'>Do:$detaljan->do</div><div class='col-sm-2'>Cena:$detaljan->cena(€)</div><div class='col-sm-2'>$za</div></div>";
                    }
              }
                else {
                    $sezone=$this->cenausezoni_m->get();
                    
                    foreach($sezone as $sezona)
                    {
                        print "<div class='col-sm-8'>$sezona->naziv</div><div class='col-sm-4'>";
                        $cenovnik=$this->objekat_cene_m->get_by(array("objekat_id"=>$objekat->objekat_id,"smestajna_jed_id"=>NULL,"sezona_id"=>$sezona->cenausezoni_id),TRUE);
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

            <div class="col-sm-12 row">
                <h3 style="text-align: center;"><?php print translate("Smestajne jedinice:", $jezik)?></h3>
<?php $smestajnejedinice=$this->smestajnajedinica_m->get_by(array("objekat_id"=>$objekat->objekat_id,'status'=>1));?>
<?php if($smestajnejedinice!=NULL){?>
           <?php foreach($smestajnejedinice as $smestajnajedinica){?>
                <div class="col-sm-4" style="min-height:460px;">
                    <div class="thumbnail">
                        <?php $smestajna_jedinica_slika=$this->smestajnajed_slika_m->get_by(array("smestajnajedinica_id"=>$smestajnajedinica->smestajnajedinica_id,"glavna"=>1),TRUE);?>
                        <a href="<?php print base_url()."$jezik/".create_link_for_object($drzava,$grad,$objekat,$smestajnajedinica)."";?>"><img src="<?php if($smestajna_jedinica_slika!=NULL){print base_url()."img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/".str_replace(" ","-",$smestajnajedinica->naziv)."_".$smestajnajedinica->smestajnajedinica_id."/V".str_replace(" ","-",$smestajna_jedinica_slika->naziv)."".$smestajna_jedinica_slika->putanja;}else{print base_url()."img/NemaSlike.png";}?>" alt="<?php print str_replace(" ","-",$smestajnajedinica->naziv);?>"  ></a>
                        <div class="caption">
                            <h3><?php print $smestajnajedinica->naziv;?></h3>
                            <p><?php print character_limiter(strip_tags($smestajnajedinica->opis),100); ?></p>
                            <p><a href="<?php print base_url()."$jezik/".create_link_for_object($drzava,$grad,$objekat,$smestajnajedinica)."";?>" class="btn btn-primary" role="button"><?php print translate("Vise", $jezik)?></a></p>
                        </div>
                    </div>
                </div>
           <?php }?>
<?php  }  else { print "Nema smestajnih jedinica";}?>

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

      </form>
<h3 style="text-align: center;"><?php print translate("Kalendar popunjenosti:", $jezik)?></h3>
<p style="background-color:rgb(217, 83, 79);">Zauzete sve smestajne jedinice</p><p style="background-color:orange;">Nisu zauzete sve smestajne jedinice(Samo neke)</p>
    <div class="table-responsive" id="calendar">          
    <?php print $kalendar;?>
    </div>
</div>
                    <div class="col-sm-12" style="margin-top:20px;margin-bottom: 20px;">
                <div class="col-md-6 visible-desktop dark-blue"></div>
                <div class="col-md-6 visible-desktop blue"></div></div> 
                <div class="col-md-12">
   <style type="text/css">
          .stars div a {
    background: transparent url(<?php print base_url()?>images/sprite_rate.png) 0 0 no-repeat;
  display: inline-block;
  height: 23px;
  width: 12px;
  text-indent: -999em;
  overflow: hidden;
}

.stars a.rating-right {
  background-position: 0 -23px;
  padding-right: 6px;
}

.stars a.rating-over {
  background-position: 0 -46px;
}

.stars a.rating-over.rating-right {
  background-position: 0 -69px;
}

.stars a.rating {
  background-position: 0 -92px;
}

.stars a.rating.rating-right {
  background-position: 0 -115px;
}

      </style>
      <script type="text/javascript">
          $(document).ready(function(){
              
 starRating.create('.stars');
});

// The widget
var starRating = {
  create: function(selector) {
    // loop over every element matching the selector
    $(selector).each(function() {
      var $list = $('<div></div>');
      var $prosecna=<?php $prosecna=0;
      $rating=$this->rating_m->get_by(array("objekat_id"=>$objekat->objekat_id));
      if(count($rating)>=1)
      {
      foreach ($rating as $ra)
      {
          $prosecna=$prosecna+$ra->ocena;
      }
      $broj=  count($rating);
      print $prosecna/$broj ;
      }
      else
      print $prosecna;
      
      
      ?>;
      // loop over every radio button in each container
      $(this)
        .find('input:radio')
        .each(function(i) {
          var rating = $(this).parent().text();
          if(rating<=$prosecna)
          {
              var $item = $('<a href="#"></a>')
            .attr('title', rating)
            .addClass(i % 2 == 1 ? 'rating-right rating' : 'rating')
            .text(rating);
          }
          else
          {
              var $item = $('<a href="#"></a>')
            .attr('title', rating)
            .addClass(i % 2 == 1 ? 'rating-right' : '')
            .text(rating);
          }
          
          
          starRating.addHandlers($item);
          $list.append($item);
          
          if($(this).is(':checked')) {
            $item.prevAll().andSelf().addClass('rating');
          }
        });
        // Hide the original radio buttons
        $(this).append($list).find('label').hide();
    });
  },
  addHandlers: function(item) {
    $(item).click(function(e) {
      // Handle Star click
      var $star = $(this);
      var $allLinks = $(this).parent();
      
      // Set the radio button value
      $allLinks
        .parent()
        .find('input:radio[value="' + $star.text() + '"]')
        .attr('checked', true);

      // Set the ratings
      $allLinks.children().removeClass('rating');
      $star.prevAll().andSelf().addClass('rating');
      
      // prevent default link click
      e.preventDefault();
  
    }).hover(function() {
      // Handle star mouse over
      $(this).prevAll().andSelf().addClass('rating-over');
    }, function() {
      // Handle star mouse out
      $(this).siblings().andSelf().removeClass('rating-over')
    });    
  }
  
}
          </script>
          <form action="<?php print base_url()."$jezik/glasaj"?>" method="POST">
        <div class="stars">
          <label for="rating-1"><input id="rating-1" name="rating" type="radio" value="1"/>0.5</label>
          <label for="rating-2"><input id="rating-2" name="rating" type="radio" value="2"/>1</label>
          <label for="rating-3"><input id="rating-3" name="rating" type="radio" value="3"/>1.5</label>
          <label for="rating-4"><input id="rating-4" name="rating" type="radio" value="4"/>2</label>
          <label for="rating-5"><input id="rating-5" name="rating" type="radio" value="5"/>2.5</label>
          <label for="rating-6"><input id="rating-6" name="rating" type="radio" value="6"/>3</label>
          <label for="rating-7"><input id="rating-7" name="rating" type="radio" value="7"/>3.5</label>
          <label for="rating-8"><input id="rating-8" name="rating" type="radio" value="8"/>4</label>
          <label for="rating-9"><input id="rating-9" name="rating" type="radio" value="9"/>4.5</label>
          <label for="rating-10"><input id="rating-10" name="rating" type="radio" value="10"/>5</label>                               
        </div>
        <input type="hidden" value="<?php print current_url();?>" name="trenutnastranaa"/>
        <input type="hidden" value="<?php print $objekat->objekat_id;?>" name="objekat"/>
        <input type="submit" value="Glasaj" class='btn btn-success' />      
          </form>  
    </div>
      </div>
      </div>
            </div>
    </div>
      
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

<!-- Modal -->
<div class="modal fade" id="Rezervisiodmah" tabindex="-1" role="dialog" aria-labelledby="Rezervisiodmah">
  <div class="modal-dialog" role="document">
              <?php print form_open("pocetna/rezervisi",array("class"=>"form-horizontal"));?>
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title" id="Rezervacija">Rezervacija Smestaja</h4>
      </div>
      <div class="modal-body">
              <script type="text/javascript">
                  function days_between(date1, date2) {

    // The number of milliseconds in one day
    var ONE_DAY = 1000 * 60 * 60 * 24

    // Convert both dates to milliseconds
    var date1_ms = date1.getTime()
    var date2_ms = date2.getTime()

    // Calculate the difference in milliseconds
    var difference_ms = Math.abs(date1_ms - date2_ms)

    // Convert back to days and return
    return Math.round(difference_ms/ONE_DAY)

}
                  $(document).ready(function(){
                      
                        $( ".smestajnaselect" ).click(function() {
                var myRadio = $('input[name=izabranasmestajna]'); 
                var checkedValue = myRadio.filter(':checked');
                myRadio.parent().parent().removeClass("smestajnaselected");
                checkedValue.parent().parent().addClass("smestajnaselected");

document.getElementById("kaparaa").value=""
document.getElementById("ukupnacena").value=""
                        });
                    });
              </script>
              <h4>Izaberite Smeštajnu jedinicu</h4>
              <?php if($smestajnejedinice!=NULL){?>
           <?php foreach($smestajnejedinice as $smestajnajedinica){?>
              <div class="col-sm-2 gallery-images thumbnail smestajnaselect" style="margin-left:15px;padding:0px;">
               <?php $smestajna_jedinica_slika=$this->smestajnajed_slika_m->get_by(array("smestajnajedinica_id"=>$smestajnajedinica->smestajnajedinica_id,"glavna"=>1),TRUE);?>
              <label for="<?php print $smestajnajedinica->smestajnajedinica_id;?>">
              <img  class="gallery-image " onclick="dohvati_cenu_smestaja(<?php print $smestajnajedinica->smestajnajedinica_id;?>);dohvati_broj_kreveta(<?php print $smestajnajedinica->smestajnajedinica_id;?>);datetime(<?php print $smestajnajedinica->smestajnajedinica_id;?>);" src="<?php if($smestajna_jedinica_slika!=NULL){print base_url()."img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/".str_replace(" ","-",$smestajnajedinica->naziv)."_".$smestajnajedinica->smestajnajedinica_id."/V".str_replace(" ","-",$smestajna_jedinica_slika->naziv)."".$smestajna_jedinica_slika->putanja;}else{print base_url()."img/NemaSlike.png";}?>"  alt="<?php print str_replace(" ","-",$smestajnajedinica->naziv);?>"  >   
              <input class="hidden" id="<?php print $smestajnajedinica->smestajnajedinica_id;?>" name="izabranasmestajna" type="radio" value="<?php print $smestajnajedinica->smestajnajedinica_id;?>" />
              </label>
              <p><?php print $smestajnajedinica->naziv;?></p>
              </div>
              
            <?php }?>
             <div class="form-group">
            <label for="cenasmestaja" class="control-label col-md-2">Cena</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="cenasmestaja" name="cenasmestaja" readonly="readonly">
            </div>
            </div>
            <div class="form-group">
            <label for="brojkreveta" class="control-label col-md-2">Broj kreveta</label>
            <div class="col-sm-10">
            <input type="text" class="form-control" id="brojkreveta"name="brojkreveta" readonly="readonly">
            </div>
            </div>
            <div class="form-group">
            <label for="name" class="control-label col-md-2">Ime i prezime</label>
            <div class="col-sm-10">
            <input type="text" class="form-control col-md-10" id="name" name="nameeeee">
            </div>
            </div>
              <div class="form-group">
            <label for="phones" class="control-label col-md-2">Telefon</label>
            <div class="col-sm-10">
            <input type="text" class="form-control col-md-10" id="phones" name="phones">
            </div>
            </div>
              <div class="form-group">
            <label for="emails" class="control-label col-md-2">Email</label>
            <div class="col-sm-10">
            <input type="email" class="form-control col-md-10" id="emails" name="emails">
            </div>
            </div>
            <div id="datetimepickerdiv">
             <script type="text/javascript">
                 
                $(document).ready(function() {
                var m = moment(new Date());
                    
                $("#datetimepicker").datetimepicker({
                        format: 'YYYY-MM-DD',
                        minDate: m.add(-1, 'days'),
                        useCurrent: false,
                        
                    });
                    $("#datetimepickerr").datetimepicker({
                        format: 'YYYY-MM-DD',
                        minDate: m.add(-1, 'days'),
                        useCurrent: false, //Important! See issue #1075
                    });
                    }); //end ready
                    </script>
                    </div>
                    <script type="text/javascript">
                    $(document).ready(function() {
                    $("#datetimepicker").on("dp.change", function (e) {
                        $("#datetimepickerr").data("DateTimePicker").minDate(e.date);
                    });
                    $("#datetimepickerr").on("dp.change", function (e) {
                        $("#datetimepicker").data("DateTimePicker").maxDate(e.date);
                        
                    });
                
                
                $("#datetimepickerr ,#datetimepicker").on("dp.change", function (e) {
                   var first= $( "#datetimepicker" ).val();
var seccond=$( "#datetimepickerr" ).val();
var a = new Date(first);
var b = new Date(seccond);
document.getElementById("days").value=days_between(a,b);

            var cena=document.getElementById("cenasmestaja").value;
            var brojdana=document.getElementById("days").value;
            var brojkreveta=document.getElementById("brojkreveta").value;
            var ukupnacena=cena*brojdana*brojkreveta;
            document.getElementById("ukupnacena").value=ukupnacena+"(€)";
            var kapara=ukupnacena*<?php $kapara=$this->kapara_m->get_by(array("kapara_id"=>$objekat->kapara_id),TRUE);print $kapara->vrednost;?>/100;
            document.getElementById("kaparaa").value=kapara+"(€)";
            }); //end change function
}); //end ready
                </script>
            <div class="form-group">
            <label for="datefrom" class="control-label col-md-2">Datum od</label>
            <div class="col-sm-10">
            <input type="text" class="form-control col-md-10" id="datetimepicker" name="datetimepicker">
            </div>
            </div>
            <div class="form-group">
            <label for="dateto" class="control-label col-md-2">Datum do</label>
            <div class="col-sm-10">
            <input type="text" class="form-control col-md-10" id="datetimepickerr" name="datetimepickerr">
            </div>
            </div>
            
            <input type="hidden" id="days">
            <input type="hidden" name="returneds" value="<?php print current_url();?>">
            <div class="form-group">
            <label for="kapara" class="control-label col-md-2">kapara</label>
            <div class="col-sm-4">
            <input type="text" class="form-control " id="kaparaa" readonly="readonly" name="kapara">
            </div>
            <label for="ukupnacena" class="control-label col-md-2">Ukupna cena</label>
            <div class="col-sm-4">
            <input type="text" class="form-control" id="ukupnacena" disabled="disabled" name="ukupnacena">
            </div>
            </div>
<?php  }  else { print "Nema smestajnih jedinica ne mozete rezervisati.";}?>
          </div>
        
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
        <button type="submit" class="btn btn-primary" name='rezervisi' value='Rezervisi'>Rezerviši</button>
      </div>
    </div>
      <?php print form_close();?>
  </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="Upit">Upit za smestaj</h4>
      </div>
        <form action="<?php print base_url()."pocetna/posaljimail";?>" class="form-horizontal" method="POST">
      <div class="modal-body">
          <div class="form-group">
                        <label for ="contact-name " class = "col-lg-2 control-label " >Ime :</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="contact-name" placeholder="Ime" name="Ime"/>
						</div>
          </div>
          <div class="form-group">
						<label for ="contact-name " class = "col-lg-2 control-label " >Prezime :</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="contact-name" placeholder="Prezime" name="Prezime"/>
						</div>
          </div>
          <div class="form-group">
                        <label for ="contact-name " class = "col-lg-2 control-label " >Email :</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="contact-name" placeholder="Vas mail" name="Email"/>
						</div>
          </div>
          <div class="form-group">
                         <label for ="contact-name " class = "col-lg-2 control-label " >Telefon :</label>
						<div class="col-lg-10">
							<input type="text" class="form-control" id="contact-name" placeholder="Vas telefon" name="Telefon"/>
						</div>
          </div>
          <div class="form-group">
                         <label for ="contact-name " class = "col-lg-2 control-label " >Pitanje :</label>
						<div class="col-lg-10">
							<textarea rows="4" cols="50" class="form-control" id="contact-name" placeholder="TextPitanja" name="Text"></textarea>
						</div>
          </div>
                        
						
                       
                        <input type="hidden"  value="<?php print $objekat->objekat_id;?>" name="Objekat"/>
                        <input type="hidden" value="<?php print current_url();?>" name="trenutnastrana"/>
                        
                        
      </div>                     

      <div class="modal-footer">
        <button type="submit" name="Upit" class="btn btn-primary">Posalji</button>
        <a class="btn btn-default" data-dismiss="modal">Zatvori</a>
      </div>
        </form>
    </div>
  </div>
</div>
<script type="text/javascript"> 
//<![CDATA[
     // global "map" variable
      var map = null;
      var marker = null;


 
function initialize() {
  // create the map

  var myOptions = {
    zoom: <?php if(isset($objekat->objekat_id)){print $grad->zoom;}else{print 1;}?>,
    center: new google.maps.LatLng(<?php if(isset($objekat->objekat_id)){print "$grad->lat,$grad->long";}else{print "42.83503626758015,19.154663296875015";}?>),
    mapTypeControl: true,
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById("map_canvas"),
                                myOptions);
 

  
  
  <?php if(isset($objekat->objekat_id)){?>
  var marker = new google.maps.Marker({
      position: new google.maps.LatLng(<?php print "$objekat->kordinata_x,$objekat->kordinata_y";?>),
      map: map,
      icon: '<?php print base_url()?>img/house.png',
  });
  <?php }?>
}
function resizeMap() {
   if(typeof map =="undefined") return;
   setTimeout( function(){resizingMap();} , 400);
}
			
	function resizingMap() {
   if(typeof map =="undefined") return;
   var center = map.getCenter();
   google.maps.event.trigger(map, "resize");
   map.setCenter(center); 
}
			
	
</script> 
<!-- Modal -->
<div class="modal fade" id="Mapa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="Mapa">Mapa</h4>
      </div>
      <div class="modal-body">
        <div id="map_canvas"  style="height: 350px; width: 500px;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    function izracunaj(){
				var broj=document.getElementById("brojdana").value;
				var kapara=document.getElementById("kaparat").value;
				var cena=document.getElementById("cena").value;
				var brojosoba=document.getElementById("brojosoba").value;

				var x=(broj*brojosoba*cena)*(kapara/100);
				
				var rezultat=document.getElementById("rezultat").value=x;
				
				
				
			}
    </script>
<!-- Modal -->
<div class="modal fade" id="kapara" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="Kapara">Izracunaj kaparu</h4>
      </div>
      <div class="modal-body">
                        <input type="text" id='brojdana' placeholder="Broj dana" class='col-xs-2' onKeyUp="izracunaj();" />
                        <input type="text" id='brojosoba' placeholder="Broj osoba" class='col-xs-2' onKeyUp="izracunaj();" />
                        <?php
                        $objekat_cene=$this->objekat_cene_m->get_by(array("objekat_id"=>$objekat->objekat_id,"smestajna_jed_id"=>NULL));
                        $min = PHP_INT_MAX;
                        $status=0;
                        foreach ($objekat_cene as $cena)
                        {
                            
                            if($cena->sezona_id==$cena->status)
                            {
                                print "<input type='text' id='cena'  class='col-xs-2' value='$cena->cena' disabled/>";
                                $status=1;
                            }
                            if($min>=$cena->cena)
                            {
                                $min=$cena->cena;
                            }
                            
                        }
                        if($status==0)
                        {
                            print "<input type='text' id='cena'  class='col-xs-2' value='$min' disabled/>";   
                        }
                        $kapara=$this->kapara_m->get_by(array("kapara_id"=>$objekat->kapara_id),TRUE);
                        print "<input type='text' id='kaparat'  class='col-xs-2' value='$kapara->vrednost' disabled/>"
			?>
                        <input type='text' id='rezultat' placeholder='Rezultat'  class='col-xs-2' disabled />(€)
                        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</div>
  
</div>
            
<?php }?>