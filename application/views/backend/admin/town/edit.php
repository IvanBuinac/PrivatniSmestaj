<h3><?php print empty($grad->grad_id) ? 'Dodaj novi grad' : 'Izmeni grad ' . $grad->naziv; ?></h3>

<?php print validation_errors(); ?>
<?php isset($grad->grad_id) ? $id=$grad->grad_id : $id="";
print form_open('admin/administracija_gradova/sacuvaj/'.$id ,array('role'=>"form",'class'=>"form-horizontal")); ?>
<table class="table">
	<tr>
		<td>Naziv:</td>
		<td><?php print form_input(array('name'=>'naziv','class'=>'form-control','placeholder'=>'Naziv grada'), set_value('naziv', isset($grad->grad_id) ? $grad->naziv : NULL)); ?></td>
	</tr>
	<tr>
		<td>Putanja:</td>
		<td><?php print form_input(array('name'=>'putanja','class'=>'form-control','placeholder'=>'Putanja'), set_value('putanja', isset($grad->grad_id) ? $grad->putanja : NULL)); ?></td>
	</tr>
	<tr>
		<td>Drzava kojoj priparada:</td>
		<td><?php $datas = "class='form-control' onChange='dohvati_grad(this.value);' id='drzava'";
                print form_dropdown("drzava", $drzave , isset($grad->drzava_id)?$grad->drzava_id:NULL ,$datas);    ?></td>
	</tr>
        <tr>
		<td>Status:</td>
		<td><?php $datas = "class='form-control' onChange='dohvati_grad(this.value);' id='drzava'";
                print form_dropdown("status", array("1"=>"Aktivan","0"=>"Ne aktivan") , isset($grad->status)?$grad->status:NULL ,$datas);    ?></td>
	</tr>
		<?php print form_input(array('name'=>'lat','class'=>'form-control','placeholder'=>'Putanja',"id"=>'lat','type'=>'hidden'), set_value('lat', isset($grad->grad_id) ? $grad->lat : NULL)); ?>
		<?php print form_input(array('name'=>'lng','class'=>'form-control','placeholder'=>'Putanja',"id"=>'lng','type'=>'hidden'), set_value('lng', isset($grad->grad_id) ? $grad->long : NULL)); ?>
		<?php print form_input(array('name'=>'zoom','class'=>'form-control','placeholder'=>'Putanja',"id"=>'zoom','type'=>'hidden'), set_value('zoom', isset($grad->grad_id) ? $grad->zoom : NULL)); ?>
       
</table>
 <input type='submit' class='btn btn-primary ' value="Sacuvaj" name="Sacuvaj"/>
<?php print form_close();?>
        <div id='map_canvas'  style='height:300px;margin:10px;'></div>
        <script type="text/javascript"> 
//<![CDATA[
     // global "map" variable
      var map = null;
      var marker = null;

var infowindow = new google.maps.InfoWindow(
  { 
    size: new google.maps.Size(150,50)
  });

// A function to create the marker and set up the event window function 
function createMarker(latlng, name, html) {
    var contentString = html;
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString); 
        infowindow.open(map,marker);
        });
    google.maps.event.trigger(marker, 'click');    
    return marker;
}

 
function initialize() {
  // create the map
  var myOptions = {
    zoom: <?php if(isset($grad->grad_id)){print $grad->zoom;}else{print 1;}?>,
    center: new google.maps.LatLng(<?php if(isset($grad->grad_id)){print "$grad->lat,$grad->long";}else{print "42.83503626758015,19.154663296875015";}?>),
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById("map_canvas"),
                                myOptions);
 
  google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
        });
google.maps.event.addListener(map, 'click', function(event) {
                    mLat = event.latLng.lat();
                    mLng = event.latLng.lng();
                    document.getElementById('lat').value = mLat;
                    document.getElementById('lng').value = mLng;
                    document.getElementById('zoom').value = map.getZoom();;
                });
  google.maps.event.addListener(map, 'click', function(event) {
	//call function to create marker
         if (marker) {
            marker.setMap(null);
            marker = null;
         }
	 marker = createMarker(event.latLng, "name", "<b>Location</b><br>"+event.latLng);
  });
  <?php if(isset($grad->grad_id)){?>
  var marker = new google.maps.Marker({
      position: new google.maps.LatLng(<?php print "$grad->lat,$grad->long";?>),
      map: map,
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