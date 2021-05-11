<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $jezik;?>" lang="<?php print $jezik;?>">
	<head>
		<title><?php print $meta_title;?></title>
		<meta charset="UTF-8">
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta http-equiv="Refresh" content="1800" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="format-detection" content="telephone=no"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
		<meta name="revisit-after" content="10 days"/>
		<meta name="googlebot" content="noodp"/>
		<meta name="msnbot" content="noodp"/>
		<meta name="slurp" content="noodp, noydir"/> <!--yahoo-->
		<meta name="teoma" content="noodp"/><!--ask-->
		
                
                <link rel="apple-touch-icon" href="<?php print base_url()?>img/logos/<?php print str_replace(' ', '', normalize($site_name));?>-mini.ico">
		<link rel="apple-touch-icon-precomposed" href="<?php print base_url()?>img/logos/<?php print str_replace(' ', '', normalize($site_name));?>-mini.ico">
		
		<!--[if IE]><meta http-equiv="x-ua-compatible" content="ie=7"/><![endif]-->
		<!--[if IE]><meta http-equiv="x-ua-compatible" content="ie=emulateie7"/><![endif]-->
		<!--[if IE]><meta http-equiv="x-ua-compatible" content="ie=8"/> <![endif]-->
		<!--[if IE]><meta http-equiv="x-ua-compatible" content="ie=emulateie8"/> <![endif]-->
		<!--[if IE]><meta http-equiv="x-ua-compatible" content="ie=edge"/> <![endif]-->
		<!--[if IE]><meta http-equiv="x-ua-compatible" content="ie=5"/><![endif]-->
		<!--[if IE]><meta http-equiv="x-ua-compatible" content="ie=5; ie=8"/><![endif]-->
		<!--[if IE]><meta http-equiv="x-ua-compatible" content="chrme=1"/><![endif]-->
		<!--[if IE]><meta http-equiv="x-ua-compatible" content="ie=emulateie7; chrome=1"/><![endif]-->
                <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
                
                <meta name="keywords" content="<?php  if(!isset($objekat) && !isset($smestajna))
                    {print $keywords;}
                    else if(isset($objekat) && !isset($smestajna))
                    {print $keywords.",".strip_tags ($objekat->naziv);}
                    else if(isset($smestajna))
                    {print $keywords.",".strip_tags ($smestajna->naziv);} ?>" />
		<meta name="description" content="<?php  if(!isset($objekat) && !isset($smestajna))
                    {print $description;}
                    else if(isset($objekat) && !isset($smestajna))
                    {print strip_tags ($objekat->opis);}
                    else if(isset($smestajna))
                    { print strip_tags ($smestajna->opis);} ?>" />
                <meta name="author" content="Ivan Buinac">
                <meta name="robots" content="index, follow">    
                    
                    
                    
                <!-- twitter meta tags-->
                <meta name="twitter:site" content="@publisher_handle">
                <meta name="twitter:creator" content="@author_handle">
		<meta name="twitter:card" content="summary" />
                <meta name="twitter:site" content="<?php print $site_name;?>">
                <meta name="twitter:creator" content="Ivan Buinac">
                <meta name="twitter:url" content="<?php print current_url(); ?>" />
		<meta name="twitter:title" content="<?php print $meta_title;?>" />
		<meta name="twitter:description" content="<?php  if(!isset($objekat) && !isset($smestajna))
                    {print $description;}
                    else if(isset($objekat) && !isset($smestajna))
                    {print strip_tags ($objekat->opis);}
                    else if(isset($smestajna))
                    { print strip_tags ($smestajna->opis);} ?>" />
		<meta name="twitter:image" content="<?php  if(!isset($drzava) && !isset($grad) && !isset($objekat) && !isset($smestajna))
                    {print base_url()."img/logos/".str_replace(' ', '', normalize($site_name))."iWallpaper.jpg";}
                    else if(isset($drzava) && !isset($grad) && !isset($objekat) && !isset($smestajna))
                    {
                        print base_url()."img/drzave/".str_replace(' ', '-', $drzava->naziv)."/".$drzava->slika.".jpg";
                    }
                    else if(isset($drzava) && isset($grad) && !isset($objekat) && !isset($smestajna))
                    {
                        print base_url()."img/drzave/".str_replace(' ', '-', $drzava->naziv)."/".str_replace(' ', '-', $grad->naziv)."/".$grad->slika.".jpg";
                    }
                    else if(isset($drzava) && isset($grad) && isset($objekat) && !isset($smestajna))
                    {
                        $slika=$this->objekat_slika_m->get_by(array("objekat_id"=>$objekat->objekat_id,"glavna"=>1),TRUE); 
                        print base_url()."".create_img("V", $objekat, NULL, $slika);              
                    }
                    else if(isset($drzava) && isset($grad) && isset($objekat) && isset($smestajna))
                    { 
                        $slika=$this->smestajnajed_slika_m->get_by(array("smestajnajedinica_id"=>$smestajna->smestajnajedinica_id,"glavna"=>1),TRUE);
                        print base_url()."".create_img("V", $objekat, $smestajna, $slika); 
                    } ?>" />
                <meta name="twitter:image:width" content="435px"/>
                <meta name="twitter:image:height" content=" 375px"/>
                <!-- twitter meta tags-->
                
                
		
		<link rel="alternate" type="application/rss+xml" title="<?php print $site_name;?> RSS feed" href="<?php print base_url();?>rss.rss" />
		<link rel="alternate" type="application/rss+xml" title="<?php print $site_name;?> sitemap" href="<?php print base_url();?>sitemap.xml" />
		<link rel="Shortcut Icon" type="image/x-icon" href="<?php print base_url()?>img/logos/<?php print str_replace(' ', '', normalize($site_name));?>-mini.ico" />
		<link rel="shortcut icon" href="<?php print base_url()?>img/logos/<?php print str_replace(' ', '', normalize($site_name));?>-mini.ico" type="image/vnd.microsoft.ico"/>
                
                
                
		<!-- facebook meta tags-->
		<meta property="og:title" content="<?php print $meta_title;?>" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="<?php print current_url(); ?>" />
                <meta property="og:image" content="<?php  if(!isset($drzava) && !isset($grad) && !isset($objekat) && !isset($smestajna))
                    {print base_url()."img/logos/".str_replace(' ', '', normalize($site_name))."iWallpaper.jpg";}
                    else if(isset($drzava) && !isset($grad) && !isset($objekat) && !isset($smestajna))
                    {
                        print base_url()."img/drzave/".str_replace(' ', '-', $drzava->naziv)."/".$drzava->slika.".jpg";
                    }
                    else if(isset($drzava) && isset($grad) && !isset($objekat) && !isset($smestajna))
                    {
                        print base_url()."img/drzave/".str_replace(' ', '-', $drzava->naziv)."/".str_replace(' ', '-', $grad->naziv)."/".$grad->slika.".jpg";
                    }
                    else if(isset($drzava) && isset($grad) && isset($objekat) && !isset($smestajna))
                    {
                        $slika=$this->objekat_slika_m->get_by(array("objekat_id"=>$objekat->objekat_id,"glavna"=>1),TRUE); 
                        print base_url()."".create_img("V", $objekat, NULL, $slika);              
                    }
                    else if(isset($drzava) && isset($grad) && isset($objekat) && isset($smestajna))
                    { 
                        $slika=$this->smestajnajed_slika_m->get_by(array("smestajnajedinica_id"=>$smestajna->smestajnajedinica_id,"glavna"=>1),TRUE);
                        print base_url()."".create_img("V", $objekat, $smestajna, $slika); 
                    } ?>"  />
                <meta property="og:image:type" content="image/jpeg" />
                <meta property="og:image:width" content="1200" />
                <meta property="og:image:height" content="630" />
                
                
                <meta property="og:video" content="<?php
                $date = date('Y-m-d');
                $date=date_parse_from_format("Y-m-d", $date);
                $month=preg_replace('/^0/', '',$date["month"]);
                if($month>=4 && $month<=10)
            { 
                print base_url()."video/".str_replace(' ', '', normalize($site_name))."_Leto.webm";
            }else{
                print base_url()."video/".str_replace(' ', '', normalize($site_name))."PrivatniSmestaji_Zima.webm";
            }
            
            ?>" />

                <meta property="og:video:type" content="application/x-shockwave-flash" />
                <meta property="og:video:width" content="400" />
                <meta property="og:video:height" content="300" />
		<meta property="og:site_name" content="<?php print $site_name;?>" />
		<meta property="fb:page_id" content="" />
		<meta property="og:description" content="<?php  if(!isset($objekat) && !isset($smestajna))
                    {print $description;}
                    else if(isset($objekat) && !isset($smestajna))
                    {print strip_tags ($objekat->opis);}
                    else if(isset($smestajna))
                    { print strip_tags ($smestajna->opis);} ?>" />
		<!-- facebook meta tags end-->
                
                
                 <!--Dublin Core meta tags start -->
                <meta name="dc.language" CONTENT="<?php print $jezik;?>">
                <meta name="dc.source" CONTENT="<?php print current_url();?>">
                <meta name="DC.title" lang="<?php print $jezik;?>" content="<?php print $meta_title;?>">
                <meta name="DC.creator" content="Ivan Buinac">
                <meta name="dc.keywords" CONTENT="<?php print $keywords;?>">
                <meta name="DC.subject" lang="<?php print $jezik;?>" content="DCMI; Dublin Core Metadata Initiative; DC META Tags">
                <meta name="DC.description" lang="<?php print $jezik;?>" content="<?php  if(!isset($objekat) && !isset($smestajna))
                    {print $description;}
                    else if(isset($objekat) && !isset($smestajna))
                    {print strip_tags ($objekat->opis);}
                    else if(isset($smestajna))
                    { print strip_tags ($smestajna->opis);} ?>">
                <meta name="DC.publisher" content="Metatags.org Directory">
                <meta name="DC.contributor" content="DCMI Dublin Core Metadata Initiative">
                <meta name="DC.date" scheme="W3CDTF" content="<?php print date("d-m-Y");?>">
                <meta name="DC.type" scheme="DCMIType" content="Text">
                <meta name="DC.format" scheme="IMT" content="text/html">
                <meta name="DC.coverage" content="World">
		<!--Dublin Core meta tags end -->
                
                
                <!--css and jquery-->
               
                 
                 
                 
                <script type="text/javascript">
                    function base_url(){
                    return "<?php print base_url();?>";
                    }
                </script>
                 
                <?php 
                if(isset($css))
                {
                if(count($css)>0)
                {
                    $i=1;
                    foreach ($css as $key => $cs)
                    {
                        if($key=="extern$i")
                        print "<link type='text/css' rel='stylesheet' href='".base_url()."css/".$cs.".css' />";
                        else if($key=="intern$i")
                        print "<style type='text/css'>".$cs."</style>";
                        $i++;
                    }
                }
                }
                ?>
                
                <?php 
                if(isset($scripts))
                {
                if(count($scripts)>0)
                {
                    $i=1;
                    foreach ($scripts as $key => $script)
                    {
                        print "<script type='text/javascript'  src='".base_url()."js/".$script.".js' ></script>";

                    }
                }
                }
                ?>
                
                              <link href="<?php print base_url()?>css/style.css" rel="stylesheet" type="text/css" />
                <link href="<?php print base_url()?>css/bootstrap1.css" rel="stylesheet" type="text/css">
                
                <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript" ></script> 
               
		<script src="<?php print base_url()?>js/jquery.js" type="text/javascript"></script>
                <script src="<?php print base_url()?>js/jquery-2.1.3.js" type="text/javascript"></script>
		<script src="<?php print base_url()?>js/bootstrap.js" type="text/javascript"></script>    
                <script src="<?php print base_url()?>js/jquery.stickyPanel.js" type="text/javascript" ></script>   
		<script src="<?php print base_url()?>js/bgchangeonindex.js" type="text/javascript" ></script>
                <script src="<?php print base_url()?>js/animacija.js" type="text/javascript"></script>
                <script src="<?php print base_url()?>js/jquery.localscroll-1.2.7-min.js" type="text/javascript"></script>
                <link href="<?php print base_url()?>css/flags.css" type="text/css" rel="stylesheet"/>
                <link href="<?php print base_url()?>css/bootstrap-datetimepicker.css" type="text/css" rel="stylesheet"/>
                <script src="<?php print base_url()?>js/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.js" type="text/javascript"></script>
                <link href="<?php print base_url()?>js/jquery-ui-1.9.2.custom/css/ui-darkness/jquery-ui-1.9.2.custom.css" type="text/css" rel="stylesheet"/>
                <script src="<?php print base_url()?>js/moment.js" type="text/javascript"></script>
                 <script src="<?php print base_url()?>js/bootstrap-datetimepicker.js" type="text/javascript"></script>
				<script src="<?php print base_url()?>js/ostalijs/search.js" type="text/javascript"></script>
                 <script src="<?php print base_url()?>js/ostalijs/pretraga.js" type="text/javascript"></script>
                
                <style type="text/css">
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


.with-new-header .map {
    top: 100;
}


.map {
    display: block;
}

.map {
    position: fixed;
    right: 0;
    left: auto;
    bottom: 0;
    top:0;
}

.map {
    position: absolute;
    top: 0px;
    bottom: 0;
    left: 0;
    right: 0;
}
.map-container
{
    position: fixed;
    height:100vh;
    left: 0;
    top:50px;
    left: auto;
    bottom: 0;
    right: 0;
}











</style>
                <script type="text/javascript">
                $().ready(function () {
            var stickyPanelOptions = {
                topPadding: 40,
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
<!--css and jquery end-->

	</head>
    <body <?php if(isset($body)){
      foreach ($body as $bods => $bos)
                    {
                         print "$bods='".$bos."'";
                    }  
                    } ?>>

<div id="fb-root"></div>
<script type="text/javascript">(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/sr_RS/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script src="https://apis.google.com/js/platform.js" async defer type="text/javascript"></script>
<script type="text/javascript">
  {lang: <?php print "'$jezik'";?>}
</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-76475494-1', 'auto');
  ga('send', 'pageview');

</script>


