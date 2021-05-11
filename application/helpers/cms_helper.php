<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function add_meta_title ($string,$jezik=NULL)
{
	$CI =& get_instance();
        @$CI->data['meta_title'] = $string . ' | ' . $CI->data['meta_title'];
}
function addhttp($url) {
    if (substr($url, 0, 7) == 'http://') {
   $url=$url;
} elseif (substr($url, 0, 8) == 'https://') {
    $url=$url;
} else {
    $url = 'http://'.$url;
}
    return $url;
}

function create_link_for_object($drzava=NULL,$grad=NULL,$object=NULL,$smestajna=NULL)
{
    if($drzava!=NULL)
    {
       if($grad!=NULL)
        {
           if($object==NULL && $smestajna==NULL){
           $putanja=strtolower("$drzava->putanja/$grad->putanja");
           $new = str_replace(' ', '-', $putanja);
           }
           else if($object!=NULL && $smestajna==NULL){
           $putanja=strtolower("$drzava->putanja/$grad->putanja/".normalize($object->naziv)."-$object->objekat_id");
           $new = str_replace(' ', '-', $putanja);
           }
           else if($object!=NULL && $smestajna!=NULL)
           {
           $putanja=strtolower("$drzava->putanja/$grad->putanja/".normalize($object->naziv)."-$object->objekat_id/".normalize($smestajna->naziv)."-$smestajna->smestajnajedinica_id");
           $new = str_replace(' ', '-', $putanja);
           }
        } 
    }

    return normalize($new);
}

function make_new_file($url,$text,$ext,$dir)
{
    if (filter_var($url, FILTER_VALIDATE_URL)) 
        { 
            if($dir==NULL)
            {
                error_reporting(E_ALL^ E_WARNING);
                $testURL = $url;

                $doc = new DOMDocument();
                $doc->loadHTMLFile($testURL);
                $scripts = $doc->getElementsByTagName('script');
                $myfile = fopen("testfile.txt", "w"); 
                for ($i = 0; $i < $scripts->length; $i++)
                {
                    $script = $scripts->item($i);                
                    fwrite($myfile, $script->textContent);
                }
            }
        }
else
{
    if($dir==NULL)
    {
    $myfile = fopen($ext."/".$url.".".$ext, "w") or die("Unable to open file!");
    fwrite($myfile, $text);
    fclose($myfile);
    }
    if($dir!=NULL)
    {       
            $fp = opendir($dir);
    while ($file = readdir($fp)) {
            if (strpos($file, ".$ext",1))
                $results[] = $file;
        }
    closedir($fp);
    $myfile = fopen("$ext/$url.$ext", "w") or die("Unable to open file!");
    $all="";
            foreach($results as $key => $result)
            {
                $myfile1 = fopen($dir."/".$result, "r") or die("Unable to open file!");
                $all.=fread($myfile1,filesize($dir."/".$result));
                fclose($myfile1);
            }
            fwrite($myfile, $all);
            fclose($myfile);
    }
}

}





   





    function normalize ($str) {
  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή',',','!','.','?');
  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η','','','','');
  return str_replace($a, $b, $str);
}

function url_exist($url){
        $c=curl_init();
        curl_setopt($c,CURLOPT_URL,$url);
        curl_setopt($c,CURLOPT_HEADER,1);
        curl_setopt($c,CURLOPT_NOBODY,1);
        curl_setopt($c,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($c,CURLOPT_FRESH_CONNECT,1);
        if(!curl_exec($c)){
        return false;
        }else{
        return true;
        }}

function ispitaj_datum($datum,$privilegija)
{
    
    $datumm=date('d/m/Y', "$datum");
    $podeljen=date_parse ($datumm );
    $trenutni=time();
    
    $godinaaaa=$podeljen['year']+1;
    $novi_datum=$podeljen['day'].'/'.$podeljen['month'].'/'.$godinaaaa;   
    $novi_datum=  strtotime($novi_datum);
    
    if($trenutni>=$novi_datum)
    {
        if($privilegija!=1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }

    }
    else
    {
        return FALSE;
    }
    

}
function create_img($velicina,$objekat,$smestajna,$slika)
{
    
           if($objekat!=NULL && $smestajna==NULL){
           $new = "img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/$velicina".str_replace(" ","-",$slika->naziv)."".$slika->putanja;
           }
           else if($objekat!=NULL && $smestajna!=NULL)
           {
           $new = "img/Objekti/".str_replace(" ","-",$objekat->naziv)."_".$objekat->objekat_id."/".str_replace(" ","-",$smestajna->naziv)."_".$smestajna->smestajnajedinica_id."/$velicina".str_replace(" ","-",$slika->naziv)."".$slika->putanja;
           }
    return $new;
}

function btn_edit ($uri)
{
	return anchor($uri, '<span class="glyphicon glyphicon-edit"></span>');
}

function btn ($uri,$bootstrap)
{
	return anchor($uri, '<span class="'.$bootstrap.'"></span>');
}

function btn_delete ($uri)
{
	return anchor($uri, '<span class="glyphicon glyphicon-remove"></span>', array(
		'onclick' => "return confirm('You are about to delete a record. This cannot be undone. Are you sure?');"
	));
}
function category($id)
{
    $star='';
    for($i=1;$i<=$id;$i++){
        $star.="<img src='".base_url()."img/star.png' alt='star' title='star' class='pull-left'/>";
    }
    return $star;
}

function yes_or_no($url)
{
    if($url==1)
    {
    return "<img src='".base_url()."img/yes.png' alt='yes' title='yes'/>";
    }
    else
    {
    return "<img src='".base_url()."img/no.png' alt='no' title='no' />";
    }
}

function article_link($article){
	return 'article/' . intval($article->id) . '/' . e($article->slug);
}
function article_links($articles){
	$string = '<ul>';
	foreach ($articles as $article) {
		$url = article_link($article);
		$string .= '<li>';
		$string .= '<h3>' . anchor($url, e($article->title)) .  ' ›</h3>';
		$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
		$string .= '</li>';
	}
	$string .= '</ul>';
	return $string;
}

function get_excerpt($article, $numwords = 50){
	$string = '';
	$url = article_link($article);
	$string .= '<h2>' . anchor($url, e($article->title)) .  '</h2>';
	$string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
	$string .= '<p>' . e(limit_to_numwords(strip_tags($article->body), $numwords)) . '</p>';
	$string .= '<p>' . anchor($url, 'Read more ›', array('title' => e($article->title))) . '</p>';
	return $string;
}

function limit_to_numwords($string, $numwords){
	$excerpt = explode(' ', $string, $numwords + 1);
	if (count($excerpt) >= $numwords) {
		array_pop($excerpt);
	}
	$excerpt = implode(' ', $excerpt);
	return $excerpt;
}

function e($string){
	return htmlentities($string);
}

function get_menu ($array, $jezik=NULL ,$child = FALSE)
{
	$CI =& get_instance();
	$str = '';
        
	if($jezik==NULL)
        {
            $jezik="sr";
        }
        
	if (count($array)) {
            
		$str .= $child == FALSE ? '<ul class="nav navbar-nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;
		foreach ($array as $item) {
			if($CI->uri->segment(1).'/'.$CI->uri->segment(2)=="$jezik/".$item['putanja'] || $CI->uri->segment(1) == "$jezik/".$item['putanja'])
                        $active =TRUE;
                        else
                        $active =FALSE;
			if (isset($item['children']) && count($item['children'])) {
                                
                                
				$str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
				$str .= '<a  class="dropdown-toggle" data-toggle="dropdown" href="'."$jezik/".site_url(e($item['putanja'])) . '">' . translate(e($item['naziv']),$jezik);
                                $str .= '<b class="caret"></b></a>' . PHP_EOL;
				$str .= get_menu($item['children'],$jezik, TRUE);
			}
                        
			else {

				$str .= $active ? '<li class="active">' : '<li>';
				$str .= '<a href="' . site_url("$jezik/".$item['putanja']) . '">' . translate(e($item['naziv']),$jezik) . '';
                                $str.= '</a>';       
                        }
			$str .= '</li>' . PHP_EOL;
		}
		
		$str .= '</ul>' . PHP_EOL;
	}
	
	return $str;
}

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable 
        ob_start();
        var_dump($var);
        $output = ob_get_clean();
        
        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
        
        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}


if (!function_exists('dump_exit')) {
    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump ($var, $label, $echo);
        exit;
    }
}

function resize($name,$filename,$new_w,$new_h){
	$system=explode('.',$name);
	if (preg_match('/jpg|jpeg/i',$system[1])){
		$src_img=imagecreatefromjpeg($name);
	}
	if (preg_match('/png/i',$system[1])){
		$src_img=imagecreatefrompng($name);
	}
        
	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);
	if ($old_x > $old_y) {
		$thumb_w=$new_w;
		$thumb_h=$old_y*($new_h/$old_x);
	}
	if ($old_x < $old_y) {
		$thumb_w=$old_x*($new_w/$old_y);
		$thumb_h=$new_h;
	}
	if ($old_x == $old_y) {
		$thumb_w=$new_w;
		$thumb_h=$new_h;
	}

	$dst_img=imagecreatetruecolor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);


	if (preg_match("/png/i",$system[1])){
		imagepng($dst_img,$filename);
    } else {
	  	imagejpeg($dst_img,$filename);
	}
	imagedestroy($dst_img);
	imagedestroy($src_img);
}

function translate($rec,$jezik,$parcici=FALSE)
{
    require_once( BASEPATH .'database/DB'. EXT );
    $db =& DB();
    $query = $db->get( 'recnik' );
    $result = $query->result();
    $resultat=$rec;
    
    foreach( $result as $key1 =>$row )
    {
        if(strcasecmp($row->sr, $rec) == 0 && $parcici==FALSE)
        {
            $resultat=$row->$jezik;
        }
        if($parcici==TRUE)
        {
            $delovi=explode(" ", $rec);
            
            foreach ($delovi as $i => $deo)
            {

                if(strcasecmp($row->sr, $deo) == 0)
                {  
                    if($i==0)
                    {                      
                       $resultat="";
                    }
                   $resultat.=" ".translate($deo, $jezik);
                }
            }
            
        }
        
    }
    return $resultat;
}