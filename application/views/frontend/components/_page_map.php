
<script type='text/javascript'> 
//<![CDATA[

     // global 'map' variable
      var map = null;
      var marker = null;


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
	<?php if(isset($doba) && !isset($drzava1) && !isset($grad1) && !isset($objekat)) {?>
	zoom: 3,
        center: new google.maps.LatLng(42.458579810844405,18.511491032775893),
	<?php }?>
	<?php if(isset($doba) && isset($drzava1) && !isset($grad1) && !isset($objekat)) {?>
            <?php print "zoom:".$drzava1->zoom.",";
            print "center: new google.maps.LatLng(".$drzava1->lat.",".$drzava1->long."),";
        ?>
	<?php }?>
        <?php if(isset($doba) && isset($drzava1) && isset($grad1) && !isset($objekat)) {?>
            <?php print "zoom:".$grad1->zoom.",";
            print "center: new google.maps.LatLng(".$grad1->lat.",".$grad1->long."),";
        ?>
	<?php }?>
    mapTypeControl: true,
    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
    navigationControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	
	map = new google.maps.Map(document.getElementById('map_canvas'),
                                myOptions);

	prikazmarkera1();
}

</script>
<div id='map_canvas' style='min-height:300px; min-width: 200px;margin:5px;'></div>
<script type='text/javascript'>function prikazmarkera1(){
<?php foreach($objekti1 as $objekat){ ?>
var <?php print "marker$objekat->objekat_id"?> = new google.maps.Marker({
  position: new google.maps.LatLng(<?php print $objekat->kordinata_x.",".$objekat->kordinata_y ;?>),
  map: map,
  icon: '<?php print base_url();?>img/house.png'
});


var <?php print "contentString$objekat->objekat_id"?> = '<div style=min-width:100px;min-height:150px;max-width:400px;max-height:300px><a href=objekat.php?objekat=$skripta[idobjekat] ><h4 align=center style=color:black >$skripta[4]</h4></a><br/><a href=objekat.php?objekat=$skripta[idobjekat] ><img src=\"img/Objekti/$skripta[4]_$skripta[idobjekat]/M$skripta[putanja]\" style=height:150px;width:200px alt=$skripta[4]></img></a></div>';
    
	  
var <?php print "infowindow$objekat->objekat_id"?> = new google.maps.InfoWindow({
      content: <?php print "contentString$objekat->objekat_id"; ?>
  });
google.maps.event.addListener(<?php print "marker$objekat->objekat_id";?>, 'click', function() {
    <?php print "infowindow$objekat->objekat_id.open(map,marker$objekat->objekat_id)";?>
  });

<?php } ?> 


}
</script>
   
    

