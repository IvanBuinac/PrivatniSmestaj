
<section style="width: 100%;"   >
    <article class="col-md-7 objects">
        <div class="col-md-12 pretraga">
            <script type="text/javascript">


 function addParameter(url, parameterName, parameterValue, atStart/*Add param before others*/){
    replaceDuplicates = true;
    if(url.indexOf('#') > 0){
        var cl = url.indexOf('#');
        urlhash = url.substring(url.indexOf('#'),url.length);
    } else {
        urlhash = '';
        cl = url.length;
    }
    sourceUrl = url.substring(0,cl);

    var urlParts = sourceUrl.split("?");
    var newQueryString = "";

if(parameterValue!="")
    {
    if (urlParts.length > 1)
    {
        var parameters = urlParts[1].split("&");
        for (var i=0; (i < parameters.length); i++)
        {
            var parameterParts = parameters[i].split("=");
            if (!(replaceDuplicates && parameterParts[0] == parameterName))
            {
                if (newQueryString == "")
                    newQueryString = "?";
                else
                    newQueryString += "&";
                newQueryString += parameterParts[0] + "=" + (parameterParts[1]?parameterParts[1]:'');
            }
        }
    }
    if (newQueryString == "")
        newQueryString = "?";
    
    if(atStart){
        newQueryString = '?'+ parameterName + "=" + parameterValue + (newQueryString.length>1?'&'+newQueryString.substring(1):'');
    } else {
        if (newQueryString !== "" && newQueryString != '?')
            newQueryString += "&";
        newQueryString += parameterName + "=" + (parameterValue?parameterValue:'');
    }
    }
    return urlParts[0] + newQueryString + urlhash;
};



                        function posalji()
                    {
                   var kategorija=document.getElementsByName('kategorija');
                   var tipovi=document.getElementsByName('tip');
                   var doba=document.getElementsByName('doba');
                   var price=document.getElementById('cenaa').value;
                   var putanja=document.getElementById('putanja').value;
                   var datetimepicker=document.getElementById('datetimepicker').value;
                   var datetimepickerr=document.getElementById('datetimepickerr').value;
                   var lezaja=document.getElementById('lezaja').value;
                   
               var dobap="";
               var poruka="";
               var tip="";
           for(var i=0; i<kategorija.length; i++){
             if(kategorija[i].checked){
               poruka+=''+kategorija[i].value+',';
               
             }
           }

           for(var r=0; r<tipovi.length; r++){
             if(tipovi[r].checked){
               tip+=''+tipovi[r].value+",";
               
             }
           }
           
           for(var e=0; e<doba.length; e++){
             if(doba[e].checked){
               dobap+=''+doba[e].value+",";
               
             }
           }
           
           var r="";
           if(putanja=="")
           {
           putanja=window.location.href;
           var podeljeno=putanja.split("?");
           r=podeljeno[0];
            }
            else
            {
            r=base_url()+"<?php print $jezik;?>/"+putanja;
            }
           
           
           if(datetimepicker!="")
           r=addParameter(r,"od",datetimepicker);
           if(datetimepickerr!="")
           r=addParameter(r,"do",datetimepickerr);
           if(lezaja!="")
           r=addParameter(r,"lezaja",lezaja);
           if(poruka!="");
           r=addParameter(r,"stars",poruka);
           if(tip!="")
           r=addParameter(r,"type",tip);
           if(dobap!="")
           r=addParameter(r,"age",dobap);
           if(price!="")
           r=addParameter(r,"price",price);

           window.location=r;

           
//    // create a data object to store the information below.
//    var data   = new Object();
//// this could be a suffix of a url string. 
//    var string = "?id=5&first=John&last=Doe";
//// this will now loop through the string and pull out key value pairs seperated 
//// by the & character as a combined string, in addition it passes up the ? mark
//    var pairs = string.substring(string.indexOf('?')+1).split('&');
//    for(var key in pairs)
//    {
//        var value = pairs[key].split("=");
//        data[value[0]] = value[1];
//    }

    
//
//if(dobap!="")
//{
//window.location =""+podeljeno[0]+"?stars="+poruka+"&type="+tip+"&age="+dobap+"&price="+price ;  
//}
//else
//{
//window.location =""+podeljeno[0]+"?stars="+poruka+"&type="+tip+"&price="+price ;      
//}
                   }
                   
                   $( document ).ready(function() {
                   var visina=$( document ).height()-100;
            $("#prosiriiii").click(function(){
           $("#one-object").css("display","none");
           $(".social-buttons").css("display","none");
           $(".pretraga").animate({height:visina},2000);
           $(".prosiriiii").css("margin-botton",'10');
      });               
       });         
                </script>
                
            <div class="kategorije">
                 <div class="col-lg-12 col-md-12" style="margin-bottom:15px;">
        <div class="col-md-6 visible-desktop dark-blue"></div>
        <div class="col-md-6 visible-desktop blue"></div>
                 </div>
                <div class="input-group col-xs-5 pull-left">
                    <input type="text" class="form-control search1" atofocus placeholder="<?php print translate("Gde Hocete da idete?", $jezik);?>" id="search" "/>
                    <input type="hidden" class="form-control putanja" id="putanja" value="<?php print $this->uri->segment(2)."/".$this->uri->segment(3)?>" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    </span>
                 </div>
                 <script type="text/javascript">
                $(function () {
                    $("#datetimepicker").datetimepicker({
                        format: 'DD-MM-YYYY'
                    });
                    $("#datetimepickerr").datetimepicker({
                        format: 'DD-MM-YYYY',
                        useCurrent: false //Important! See issue #1075
                    });
                    $("#datetimepicker").on("dp.change", function (e) {
                        $("#datetimepickerr").data("DateTimePicker").minDate(e.date);
                    });
                    $("#datetimepickerr").on("dp.change", function (e) {
                        $("#datetimepicker").data("DateTimePicker").maxDate(e.date);
                    });
                });
                </script>
                 <div class="input-group col-xs-3 pull-left" >
                     <input type='text' class='form-control' name='od[]' placeholder='od datuma' id='datetimepicker' value="<?php if(isset($_GET["od"])){print $_GET["od"];}?>"/><span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                 </div>
                 <div class="input-group col-xs-3 pull-left" >
                     <input type='text' class='form-control' name='do[]' placeholder='do datuma' id='datetimepickerr' value="<?php if(isset($_GET["do"])){print $_GET["do"];}?>"/><span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
                 </div>
                <div class="input-group col-xs-1 pull-left">
                     <input type='text' class='form-control' id='lezaja' placeholder='lezaja' value="<?php if(isset($_GET["lezaja"])){print $_GET["lezaja"];}?>"/>
                 </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 col-md-12" style="margin-bottom:15px;margin-top:15px;">
        <div class="col-md-6 visible-desktop dark-blue"></div>
        <div class="col-md-6 visible-desktop blue"></div>
    </div>
                <?php
                
                print "<p class='col-md-3'>".translate(" Pretraga smestaja po kategorijama:", $jezik)."</p>";
                $kategorije=  $this->kategorija_m->get(); 
                foreach ($kategorije as $broj => $kategorija)
                {
                    if(isset($_GET['stars'])){
                    $zvezde=$_GET['stars'];
                    
                    $jedan=explode(",",$zvezde);
                     
                    print "<div class=' col-md-2'>";
                    $stani=0;
                    for($l=0;$l<sizeof($jedan);$l++)
                    {
                        
                        if($jedan[$l]==$kategorija->kategorija_id)
                        {    
                        print "<input type='checkbox' name='kategorija'  checked='checked' value='$kategorija->kategorija_id'/>";
                        for($i=0;$i<$kategorija->kategorija_id;$i++)
                        {
                            print "<img src='".base_url()."img/star.png' alt='$kategorija->naziv'/>";
                        }
                        $stani=1;
                        break;
                        }
                        
                        
                    }
                    if($stani==0)
                    {
                      print "<input type='checkbox' name='kategorija'  value='$kategorija->kategorija_id' />";
                        for($i=0;$i<$kategorija->kategorija_id;$i++)
                        {
                            print "<img src='".base_url()."img/star.png' alt='$kategorija->naziv'/>";
                        }  
                    }
                    
                    print "</div>";
                    }
                    else
                    {
                    print "<div class='col-md-2 '>";
                    
                    print "<input type='checkbox' name='kategorija'  value='$kategorija->kategorija_id' />";  
                    
                    for($i=0;$i<$kategorija->kategorija_id;$i++)
                    {
                        print "<img src='".base_url()."img/star.png' alt='$kategorija->naziv'/>";
                    }
                    print "</div>";
                    }
                }
                
                ?>
                <div class="clearfix"></div>
                <div class="col-lg-12 col-md-12" style="margin-top:15px;margin-bottom: 15px;">
        <div class="col-md-6 visible-desktop dark-blue"></div>
        <div class="col-md-6 visible-desktop blue"></div>
    </div>
                <?php 
                print "<p class='col-md-3'>".translate("Tip smestaja:",$jezik)."</p>";
                $tipovi=$this->tip_m->get();
                foreach($tipovi as $tip)
                    if(isset($_GET['type'])){
                        $tipovis=$_GET['type'];
                    
                    $jedantip=explode(",",$tipovis);
                   
                    print "<div class='col-md-2'>";
                    $stani=0;
                        for($d=0;$d<sizeof($jedantip);$d++)
                        {
                            if($jedantip[$d]==$tip->tip_id)
                            {    
                            print "<input type='checkbox' name='tip'  checked='checked' value='$tip->tip_id' />$tip->naziv";
                            $stani=1;
                            break;
                            }
                        }
                        if($stani==0)
                        {
                          print "<input type='checkbox' name='tip'  value='$tip->tip_id' />$tip->naziv";
                        }
                        print "</div>";
                    }
                else {
                    print "<div class='col-md-2'>";
                    
                    print "<input type='checkbox' name='tip'  value='$tip->tip_id' />$tip->naziv";  
                    
                   
                    print "</div>";
                }
                
                ?>
                 <div class="clearfix"></div>
                <div class="col-lg-12 col-md-12" style="margin-top:15px;margin-bottom: 15px;">
                <div class="col-md-6 visible-desktop dark-blue"></div>
                <div class="col-md-6 visible-desktop blue"></div>
                </div>
                <?php 
                print "<p class='col-md-3'>".translate("Doba u kom se izdaje:",$jezik)."</p>";
                $doba=$this->godina_m->get();
                foreach($doba as $dob)
                {
                    if(isset($_GET['age']))
                    {
                        $doba=$_GET['age'];
                        
                    
                        $jednodoba=explode(",",$doba);
                        print "<div class='col-md-2'>";
                        $stani=0;
                        for($s=0;$s<sizeof($jednodoba);$s++)
                        {
                            if($jednodoba[$s]==$dob->doba_id)
                            {    
                            print "<input type='checkbox' name='doba'  checked='checked' value='$dob->doba_id' '/><img src='".  base_url()."img/doba/$dob->slika_obojena' alt='$dob->naziv' height=30 width=30/>$dob->naziv";
                            $stani=1;
                            break;
                            }
                        }
                        if($stani==0)
                        {
                          print "<input type='checkbox' name='doba'  value='$dob->doba_id' /><img src='".  base_url()."img/doba/$dob->slika_crno_bela' alt='$dob->naziv' height=30 width=30/>$dob->naziv";
                        }
                        print "</div>";
                    }
                    else
                    {
                    print "<div class='col-md-2'>";
                    print "<input type='checkbox' name='doba'   value='$dob->doba_id' /><img src='".  base_url()."img/doba/$dob->slika_obojena' alt='$dob->naziv' height=30 width=30 />$dob->naziv";
                    print "</div>";
                    }
                }
                ?>
<div class="clearfix"></div>
                <div class="col-lg-12 col-md-12" style="margin-top:15px;margin-bottom: 15px;">
                <div class="col-md-6 visible-desktop dark-blue"></div>
                <div class="col-md-6 visible-desktop blue"></div>
                </div>

                 <?php
                 print "<p class='col-md-12'>
  <label for='amount'>".translate("Cena:",$jezik)."</label>
  <input type='text' id='amount' readonly style='border:0; color:#f6931f; font-weight:bold;'>
   <input type='hidden' id='cenaa'>
</p>";
    print "<div id='slider-range' class='col-md-12'></div>"
                 
                
                ?>
 <div class="clearfix"></div>
                <div class="col-lg-12 col-md-12" style="margin-top:15px;margin-bottom: 15px;">
                </div>
 
 <div class="col-md-12 "><button id='prosiriiii' class='col-md-2 pull-left btn btn-primary' >Vise</button><button onClick="posalji()" class='col-md-2 pull-right btn btn-primary'>Pretrazi</button></div>

            </div>
        </div>
<div class="social-buttons col-md-12">
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
        <div class="col-md-12 " id="one-object">
            <?php if(isset($drzave) && isset($grad)){
                $vrednosti=array();
$vrednost=array();?> 
                <?php foreach($objekti1 as $br => $objekat){?> 
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

$objekat_cene=$this->objekat_cene_m->get_by(array("smestajna_jed_id"=>NULL,"objekat_id"=>$objekat->objekat_id));
if(!empty($objekat_cene))
{
foreach($objekat_cene as $cenaaa)
{
    array_push($vrednosti,$cenaaa->cena);
    if($cenaaa->objekat_id==$objekat->objekat_id)
    {
        array_push($vrednost,$cenaaa->cena);
    }
}
}
else
{
    $vrednost=array();
}






if(!empty($vrednosti))
{
$minimum=min($vrednosti);
$maximum=max($vrednosti);
}

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

    ?>
<script>
  $(function() {
    $( "#slider-range" ).slider({
      range: true,
      min: <?php print $minimum;?>,
      max: <?php print $maximum;?>,
      values: [ <?php print $cena1[0].",".$cena1[1]?>],
      slide: function( event, ui ) {
        $( "#amount" ).val( "(€)" + ui.values[ 0 ] + "(€)" + ui.values[ 1 ] );
        $( "#cena" ).val( ""+ui.values[ 0 ]+""+ui.values[ 1 ]);  
      },
      stop: function( event, ui ) {

              $( "#cenaa" ).val( ""+$("#slider-range" ).slider("values",0) +
      "-" + $( "#slider-range" ).slider( "values", 1 ) );  
            
      }
      
    });
    $( "#amount" ).val( "(€)" + $( "#slider-range" ).slider( "values", 0 ) +
      " - (€)" + $( "#slider-range" ).slider( "values", 1 ) );
    $( "#cenaa" ).val( ""+$("#slider-range" ).slider("values",0) +
      "-" + $( "#slider-range" ).slider( "values", 1 ) );  
  });
  </script>
                <?php
                 
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
                 ?>   
                <script type="application/ld+json">
                {
                "@context": "http://schema.org",
                "@type": "LocalBusiness",
                "address": {
                "@type": "PostalAddress",
                "addressLocality": "<?php print $grad->naziv?>",
                "addressRegion": "<?php print $drzava->naziv;?>",
                "streetAddress": "<?php print $objekat->adresa;?>"
                },
                "description": "<?php print $objekat->opis;?>",
                "name": "<?php print $objekat->naziv;?>",
                "telephone": "<?php $telefon=$this->korisnik_kontakt_m->get_by(array("korisnik_id"=>$objekat->korisnik_id),TRUE); print $telefon->telefon; ?>",
                "offers": {
                "@type": "Offer",
                "availability": "http://schema.org/InStock",
                "price": "<?php $cenovnik=  $this->objekat_cene_m->get_by(array("objekat_id"=>$objekat->objekat_id,"smestajna_jed_id"=>NULL),TRUE); print $cenovnik->cena;?>",
                "priceCurrency": "eur",
                "url": "<?php print base_url()."$jezik/".$drzava->putanja."/".$grad->putanja."/".str_replace(' ', '-', $objekat->naziv)."-".$objekat->objekat_id;?>"
                }
                }
                </script>
    <?php if($br!=0){?>
    <div class="col-lg-12 col-md-12">
        <div class="col-md-6 visible-desktop dark-purple"></div>
        <div class="col-md-6 visible-desktop tc-red"></div>
    </div>
    <?php }?>
    <div class="object row objekat col-md-12 <?php if($objekat->premium==1){print "premium";}?>">
        <div class="object-image col-md-2" itemscope itemtype="http://schema.org/ImageObject">
            <?php $slika=$this->objekat_slika_m->get_by(array("glavna"=>1,"objekat_id"=>$objekat->objekat_id),TRUE);?>
            <img  class=" img-thumbnail img-responsive"  src="<?php if(isset($slika->putanja)){print base_url()."img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/M".str_replace(" ","-",$slika->naziv)."".$slika->putanja; }else{print base_url()."img/NemaSlike.png";}?>" alt="<?php print $objekat->naziv;?>" itemprop="image" title="<?php print $objekat->naziv;?>" />
            <meta itemprop="datePublished" content="<?php if(isset($slika->datum)){print $slika->datum;}?>">
        </div>
        <div class="content-holder row col-md-3">
            <a href="<?php print base_url()."$jezik/".$drzava->putanja."/".$grad->putanja."/".strtolower(str_replace(" ","-", normalize($objekat->naziv)."-".$objekat->objekat_id));?>" title="<?php print $objekat->naziv;?>" ><h3><?php print $objekat->naziv;?></h3></a>
            <?php $kategorija=$this->kategorija_m->get_by(array("kategorija_id"=>$objekat->kategorija_id),TRUE);
            $br=preg_replace("/[^0-9]/","",$kategorija->naziv);
            for($i=0;$i<$br;$i++)
            {
                print "<img class='zvezdice' src='".base_url()."img/star.png' alt='$br zvezica' title='$br zvezdica'/>";
            }
?>
            <?php $tip=$this->tip_m->get_by(array("tip_id"=>$objekat->tip_id),TRUE); print "<p>Tip smestaja: ".$tip->naziv."</p>";?>
            <p>Kapacitet: <?php print $objekat->ukupni_kapacitet;?></p>  
        </div>
             
        <div class="price col-md-3 hidden-xs hidden-sm">
                <?php $sezone=$this->cenausezoni_m->get();?>
                <?php foreach($sezone as $key123 => $sezona){
                    $cene=$this->objekat_cene_m->get_by(array("objekat_id"=>$objekat->objekat_id,"sezona_id"=>$sezona->cenausezoni_id,"smestajna_jed_id"=>NULL),TRUE);
                    print "<div class='row'>";
                    
                    
                    print "<div class='col-xs-6'>$sezona->naziv</div>";
                    if($cene!=NULL)
                    {
                        print "<div class='col-xs-6'>$cene->cena(€)";
                    }
                    else {
                       print "<div>"; 
                        
                    }
                    if(@$cene->status==$sezona->cenausezoni_id)
                    {
                        print "<img src='".  base_url()."img/yes.png' alt='current'/></div>";
                    }
                    else {
                        print "</div>";
                    }
                    print "</div>";
                }
                        
                        ?>

        </div>
        <div class=" pull-right">       
                    <div class="obj_season hidden-xs">
                        <?php $doba=$this->godina_m->get();
                        
                        foreach ($doba as $key => $dob)
                        {
                            $objekat_doba=$this->objekat_doba_m->get_by(array("objekat_id"=>$objekat->objekat_id,"doba_id"=>$dob->doba_id),TRUE);
                            if($objekat_doba!=NULL)
                            {
                                print "<img src='".base_url()."img/doba/".$dob->slika_obojena."' class='sezona' title='".$dob->naziv."' alt='".$dob->naziv."'>";
                            }
                            else
                            {
                                print "<img src='".base_url()."img/doba/".$dob->slika_crno_bela."' class='sezona' title='".$dob->naziv."' alt='".$dob->naziv."'>";
                            }
                        }   
                        ?>               
                    </div>

                <div class="text-right hidden-xs">
                    | <span title="youtube link"> <span aria-hidden="true" class="glyphicon glyphicon-facetime-video"></span><?php if($objekat->youtube_link!=NULL || $objekat->youtube_link!=""){print "1";}else{print "0";}?></span>
                    | <span title="<?php $slike_sve=$this->objekat_slika_m->get_by(array("objekat_id"=>$objekat->objekat_id));$bro=  count($slike_sve);print "$bro ".  translate("slika", $jezik);?>"> <span class="glyphicon glyphicon-camera" aria-hidden="true"></span><?php print $bro;?> </span>
                    | <span title="Google map"> <span aria-hidden="true" class="glyphicon glyphicon-map-marker text-danger"></span></span>
                </div>


            <a href="<?php print base_url()."$jezik/".$drzava->putanja."/".$grad->putanja."/".  strtolower(str_replace(" ","-", normalize($objekat->naziv)."-".$objekat->objekat_id));?>" title="<?php print $objekat->naziv;?>" class="btn pull-right btn-info" style=""><?php print translate("Opširnije", $jezik)?><i class="glyphicon glyphicon-chevron-right"></i></a>
        
    </div>
           
        
        <div class="clear"></div>
        
    </div>
    
            <?php 
            }}} ?>
    <?php if($pagination){?>
    <div align="center"><?php print $pagination;?></div>
    <?php }?>

        </div>
      </article>
     