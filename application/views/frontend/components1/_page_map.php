
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
<?php if(isset($objekti)){?>
showMarkers();
<?php } ?>


};
function showMarkers() {
    markers=[];
   
    <?php foreach ($objekti as $i => $objekat){?>
             <?php $slika=$this->objekat_slika_m->get_by(array("objekat_id"=>$objekat->objekat_id,"glavna"=>1),TRUE);   
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
    var putanja="<?php print base_url()."$jezik/".$drzava->putanja."/".$grad->putanja."/".str_replace(' ', '-', $objekat->naziv)."-".$objekat->objekat_id;?>";
    var slika="<?php print base_url()."img/Objekti/".str_replace(' ', '-', $objekat->naziv)."_".$objekat->objekat_id."/M".$slika->putanja;?>";

    var fn = markerClickFunction(putanja,titleText,slika, latLng);
    google.maps.event.addListener(marker, 'click', fn);
    markers.push(marker);
    <?php }?>

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
<style>
    .info {
        max-width: 200px;
        
      }
      .info img {
        border: 0;
      }
      .info-body {
        max-width: 200px;
        max-height: 200px;
        line-height: 200px;
        margin: 2px 0;
        text-align: center;
        overflow: hidden;
      }
      .info-img {
        max-height: 220px;
        max-width: 200px;
      }
</style>

<div id='map_canvas' style='min-height:350px; min-width: 200px;'></div>
<div class="container">   
    

