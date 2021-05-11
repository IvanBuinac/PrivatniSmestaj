<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $jezik;?>" lang="<?php print $jezik;?>">
	<head>
		<title><?php print $meta_title;?></title>
		<meta charset="UTF-8"/>
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

		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
		<meta http-equiv="pragma" content="no-cache" />

		<link rel="apple-touch-icon" href="<?php print base_url()?>img/logos/PrivatniSmestaj-mini.ico">
                <link rel="apple-touch-icon-precomposed" href="<?php print base_url()?>img/logos/PrivatniSmestaj-mini.ico">
		
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
		
                
		<link href="<?php print base_url()?>css/bootstrap.css" rel="stylesheet"/>           
                
                
                <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript" ></script>              
		<script src="<?php print base_url()?>js/jquery.js" type="text/javascript"></script>
                <script src="<?php print base_url()?>js/jquery-2.1.3.js" type="text/javascript"></script>
		<script src="<?php print base_url()?>js/bootstrap.js" type="text/javascript"></script>
                <link href="<?php print base_url()?>css/style.css" rel="stylesheet" type="text/css" />

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
                        if($key=="extern$i")
                        print "<script type='text/javascript'  src='".base_url()."js/".$script.".js' ></script>";   
                        else 
                        print "<script type='text/javascript'>".$script."</script>";
                        $i++;
                    }
                }
                }
                ?>
                
	</head>
    <body <?php if(isset($body)){
      foreach ($body as $bods => $bos)
                    {
                         print "$bods='$bos'";
                    }  
    } ?>>
