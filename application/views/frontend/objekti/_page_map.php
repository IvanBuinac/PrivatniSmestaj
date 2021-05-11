<article class="col-md-5  hidden-sm hidden-xs map-container">
    <h2 class='hidden'><?php print translate("Mapa", $jezik)?></h2>        
<script>
      var script = '<script type="text/javascript" src="<?php print base_url();?>js/markerclusterer';
      if (document.location.search.indexOf('compiled') !== -1) {
        script += '_compiled';
      }
      script += '.js"><' + '/script>';
      document.write(script);
    </script>
<script type='text/javascript'> 
/**
 * @fileoverview This demo is used for MarkerClusterer. It will show 100 markers
 * using MarkerClusterer and count the time to show the difference between using
 * MarkerClusterer and without MarkerClusterer.
 * @author Luke Mahe (v2 author: Xiaoxi Wu)
 */




pics = null;
map = null;
markerClusterer = null;
markers = [];
infoWindow = null;

function initialize() {
  var myOptions = {
     <?php if(!isset($drzava) && !isset($grad) && !isset($objekat) &&  !isset($smestajna)){?>
    zoom: 5,
    center: new google.maps.LatLng(42.458579810844405,18.511491032775893),
    <?php } else if(isset($drzava) && !isset($grad) && !isset($objekat) &&  !isset($smestajna)){?>
    zoom: <?php print $drzava->zoom;?>,
    center: new google.maps.LatLng(<?php print $drzava->lat.",".$drzava->long;?>),   
    <?php } else if(isset($drzava) && isset($grad) && !isset($objekat) &&  !isset($smestajna)){?>
    zoom: <?php print $grad->zoom;?>,
    center: new google.maps.LatLng(<?php print $grad->lat.",".$grad->long;?>),       
    <?php } else if(isset($drzava) && isset($grad) && isset($objekat) ||  isset($smestajna)){?>
    zoom:  <?php print $grad->zoom;?>,
    center: new google.maps.LatLng(<?php print $objekat->kordinata_x.",".$objekat->kordinata_y;?>),    
    <?php }?>
    mapTypeControl: true,
    disableDefaultUI: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	
	map = new google.maps.Map(document.getElementById('map_canvas'),
                                myOptions);
        infoWindow = new google.maps.InfoWindow();
<?php
if(isset($objekti11)){?>
showMarkers();
<?php } ?>


};
function showMarkers() {
    markers=[];
   
    <?php 
    foreach ($objekti11 as $i => $objekat){?>
             <?php
             
             $zajebaniniz=array();
     $najzajebanijiniz=array();
if(isset($_GET['od']) && isset($_GET['od']))
{
   $od=$_GET['od'];
   $do=$_GET['do'];
    $date1 = new DateTime($od);
    $date2 = new DateTime($do);

    $diff = $date2->diff($date1)->format("%a");
    if(isset($_GET['lezaja']))
    {
        $lezaja=$_GET['lezaja'];
        $smestajnejedinice=  $this->smestajnajedinica_m->get_by(array("objekat_id"=>$objekat->objekat_id,"broj_mesta"=>$lezaja));

    }
    else
    $smestajnejedinice=  $this->smestajnajedinica_m->get_by(array("objekat_id"=>$objekat->objekat_id));
    
    $niz=array();
    
   
    
    $brojsmestaja=  count($smestajnejedinice);
    foreach ($smestajnejedinice as $key2=>$smestajnajedinica)
    { 
 
        for($i=0;$i<=$diff;$i++)
        {
            $trenutni=strtotime("$i day", strtotime($od));


            $kalendar=$this->kalendar_popunjenosti_m->get_by(array("smestajna_jed_id"=>$smestajnajedinica->smestajnajedinica_id,"datum"=>date("Y-m-d",$trenutni)));
            foreach($kalendar as $kal)
            {
                array_push($niz, $kal->datum);
                $counts = array_count_values($niz);

                if($counts[$kal->datum]==$brojsmestaja)
                {
                    $zajebaniniz[$kal->datum]=$kal->smestajna_jed_id;
                } 
            }
            
        }
        

    }
    if(!empty($zajebaniniz))
    {
        $smestajneee=$this->smestajnajedinica_m->get_by_in(array("smestajnajedinica_id"=>$zajebaniniz));
        foreach ($smestajneee as $smestajna)
        {
            $najzajebanijiniz[$smestajna->objekat_id]=$smestajna->objekat_id;
        }
    }
    
}
             $proba1=0;
$objekat_cene=$this->objekat_cene_m->get_by(array("smestajna_jed_id"=>NULL));
$vrednosti=array();
$vrednost=array();
foreach($objekat_cene as $cenaaa)
{
    array_push($vrednosti,$cenaaa->cena);
    if($cenaaa->objekat_id==$objekat->objekat_id)
    {
        array_push($vrednost,$cenaaa->cena);
    }
}







$minimum=min($vrednosti);
$maximum=max($vrednosti);

if(isset($_GET['price']))
    {
    $cena=$_GET['price'];
    $cena1=  explode("-", $cena);
    
    for($z=0;$z<sizeof($vrednost);$z++)
    {

        if($vrednost[$z]<=$cena1[1] && $vrednost[$z]>=$cena1[0])
        {
            $proba1=1;
            break;
        }
    }
    
    
    }
 else {
    $proba1=1;
    $cena1[0]=$minimum;
    $cena1[1]=$maximum;
 }
             
             
             
             
             $string="";
                 $objekat_doba1=$this->objekat_doba_m->get_by(array("objekat_id"=>$objekat->objekat_id));
                 foreach($objekat_doba1 as $objd)
                 {
                     $string.=$objd->doba_id;
                 }
                 $dobaaa=NULL;  
                 if(isset($_GET["age"]))
                 $dobaaa=$_GET["age"];
                 $dobaaa1=str_split($dobaaa);
                 $string1=str_split($string);
                 $proba=0;
                    for($p=0;$p<sizeof($string1);$p++)
                    {
                        
                        if(in_array($string1[$p],$dobaaa1 ))
                        {
                            $proba=1;
                            
                            break;
                        }
                    }
                if($dobaaa==NULL)
                {
                   $proba=1; 
                }
                
                
                 if($proba==1 && $proba1==1 && !in_array($objekat->objekat_id, $najzajebanijiniz, true))
                 
                 {
             $slika=$this->objekat_slika_m->get_by(array("objekat_id"=>$objekat->objekat_id,"glavna"=>1),TRUE); 
$grad=$this->grad_m->get_by(array("grad_id"=>$objekat->grad_id),TRUE); 
$drzava=$this->drzava_m->get_by(array("drzava_id"=>$grad->drzava_id),TRUE);

?>
            var titleText = '<?php print $objekat->naziv;?>';
            if (titleText === '') {
              titleText = 'No title';
            }
            
            var latLng = new google.maps.LatLng(<?php print $objekat->kordinata_x.",".$objekat->kordinata_y;?>);

    var imageUrl = '<?php print base_url();?>img/house.png';
    var markerImage = new google.maps.MarkerImage(imageUrl,
        new google.maps.Size(24, 32));

    var marker = new google.maps.Marker({
      position: latLng,
      icon: imageUrl,
      
    });
    var putanja="<?php print base_url()."/$jezik/".create_link_for_object($drzava,$grad,$objekat);?>";
    var slika="<?php if(isset($slika->putanja)){print base_url().create_img("M", $objekat, NULL, $slika);}else(print base_url ()."img/NemaSlike.png")?>";

    var fn = markerClickFunction(putanja,titleText,slika, latLng);
    google.maps.event.addListener(marker, 'click', fn);
    markers.push(marker);
    <?php }}?>

    var markerCluster = new MarkerClusterer(map, markers);
    
}
function markerClickFunction(putanja,title,slika, latlng) {
  return function(e) {
    e.cancelBubble = true;
    e.returnValue = false;
    if (e.stopPropagation) {
      e.stopPropagation();
      e.preventDefault();
    }

  
    var titl = title;
    var url = putanja;
    var fileurl = slika;

    var infoHtml = '<div class="info"><h3>' + titl +
      '</h3><div class="info-body">' +
      '<a href="' + url + '" target="_blank"><img src="' +
      fileurl + '" class="info-img"/></a></div></div>';


    infoWindow.setContent(infoHtml);
    infoWindow.setPosition(latlng);
    infoWindow.open(map);
  };
};


</script>


<div id='map_canvas'  class='map '></div>
    </article>
</section>
