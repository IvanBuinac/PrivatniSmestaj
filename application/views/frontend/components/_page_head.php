<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title><?php print $meta_title;?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Language" content="sr" />
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
		
		<link rel="apple-touch-icon" href="<?php print base_url()?>img/logos/PrivatniSmestaj-mini.icon">
                <link rel="apple-touch-icon-precomposed" href="<?php print base_url()?>img/logos/PrivatniSmestaj-mini.icon">
		
		<meta http-equiv="x-ua-compatible" content="ie=7"/> <!--render Internet Explorer v7 standards mode regardless of doctype-->
		<meta http-equiv="x-ua-compatible" content="ie=emulateie7"/> <!--render according to doctype, standards is v7 and quirks is v5-->
		<meta http-equiv="x-ua-compatible" content="ie=8"/> <!--render Internet Explorer v8 standards mode regardless of doctype-->
		<meta http-equiv="x-ua-compatible" content="ie=emulateie8"/> <!--render according to doctype, standards is v8 and quirks is v5-->
		<meta http-equiv="x-ua-compatible" content="ie=edge"/> <!--render using latest version of Internet Explorer-->
		<meta http-equiv="x-ua-compatible" content="ie=5"/> <!--render using Internet Explorer v7 quirks mode, which is like v5-->
		<meta http-equiv="x-ua-compatible" content="ie=5; ie=8"/> <!--render using v8 if available, otherwise use v5 instead of v6 or v7-->
		<meta http-equiv="x-ua-compatible" content="chrme=1"/> <!--render using Chrome if available-->
		<meta http-equiv="x-ua-compatible" content="ie=emulateie7; chrome=1"/> <!--render Chrome if available or Internet Explorer v7-->
                
		<meta name="keywords" content="<?php print $keywords; ?>" />
		<meta name="description" content="<?php print $description; ?>" />
		<meta name="twitter:card" content="summary" />
                <meta name="twitter:url" content="<?php print base_url(); ?>" />
		<meta name="twitter:title" content="<?php print $meta_title;?>" />
		<meta name="twitter:description" content="<?php print $description; ?>" />
		<meta name="twitter:image" content="<?php print base_url()?>img/logos/PrivatniSmestaj-mini.icon" />
		<meta name="robots" content="noindex, nofolow">
		
		<link rel="alternate" type="application/rss+xml" title="<?php print $site_name;?> RSS feed" href="rss.rss" />
		<link rel="alternate" type="application/rss+xml" title="<?php print $site_name;?> sitemap" href="sitemap.xml" />
		<link rel="Shortcut Icon" type="image/x-icon" href="<?php print base_url()?>img/logos/PrivatniSmestaj-mini.icon" />
		<link rel="shortcut icon" href="<?php print base_url()?>img/logos/PrivatniSmestaj-mini.icon" type="image/vnd.microsoft.icon"/>
		
		<meta property="og:title" content="<?php print $meta_title;?>" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="<?php print base_url(); ?>" />
		<meta property="og:image" content="<?php print base_url()?>img/logos/PrivatniSmestaj-mini.icon" />
		<meta property="og:site_name" content="<?php print $site_name;?>" />
		<meta property="fb:page_id" content="174769159220452" />
		<meta property="og:description" content="<?php print $description; ?>" />
		
                <link href="<?php print base_url()?>css/style.css" rel="stylesheet" type="text/css" />
		<link href="<?php print base_url()?>css/bootstrap.css" rel="stylesheet">
                
                <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript" ></script>              
		<script src="<?php print base_url()?>js/jquery.js" type="text/javascript"></script>
                <script src="<?php print base_url()?>js/jquery-2.1.3.js" type="text/javascript"></script>
		<script src="<?php print base_url()?>js/bootstrap.js" type="text/javascript"></script>    
                   
		<script src="<?php print base_url()?>js/bgchangeonindex.js" type="text/javascript" ></script>
                <script src="<?php print base_url()?>js/animacija.js" type="text/javascript"></script>
                <script src="<?php print base_url()?>js/jquery.localscroll-1.2.7-min.js" type="text/javascript"></script>
                
                
                

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

	</head>
    <body <?php if(isset($body)){
      foreach ($body as $bods => $bos)
                    {
                         print "$bods='".$bos."'";
                    }  
    } ?>>
