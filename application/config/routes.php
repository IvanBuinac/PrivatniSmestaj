<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
// url could be yourdomain/imran
//$route['(:any)'] = 'pocetna/lokacija/$1';
// url could be yourdomain/10
//$route['(:num)'] = 'welcome/index/$1';
// url could be yourdomain/imran10
//$route['([a-zA-Z0-9]+)'] = "welcome/index/$1";
// load it
//$route['registracija'] = "registracija";
//$route['login'] = "login";

$jezici=array();
$jezici[]="sr";
//$jezici[]="en";



require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();
$query = $db->get( 'drzava' );
$result = $query->result();

$query1 = $db->get( 'grad' );
$result1 = $query1->result();

$links = $db->get( 'link' );
$resultat = $links->result();

foreach ($jezici as $key2 => $jezik)
{
    $regs='([a-zA-Z0-9\/\-\_]+)';
    foreach( $result as $key1 =>$row )
    {
            $route[$jezik."/".$row->putanja]= "pocetna/lokacija/$jezik/$row->putanja";
            $route[$jezik."/".$row->putanja.'/'.$regs] = "pocetna/lokacija/$jezik/$row->putanja/$1";
    }
    
    
    foreach( $resultat as $link )
    {

        $route[$jezik."/".$link->putanja]= "$link->putanja";
        $route[$jezik."/".$link->putanja.'/'.$regs]= "$link->putanja/$1";
    }
    
    
    
    $route[$jezik."/login".'/'.$regs]= "login/$1";
    
    $route["$jezik/pocetna1"]= "pocetna1/lokacija/$jezik";
    

    $route["$jezik/informacije"]="informacije/index";
    $route["$jezik/informacije".'/'.$regs]="informacije/$1";
    
    
    $route["$jezik/glasaj"]="pocetna/glasaj";
    $route["$jezik/glasaj".'/'.$regs]="pocetna/glasaj/$1";
    
    $route[$jezik]= "pocetna/lokacija/$jezik";
    $route["$jezik/registracija"]="registracija/index/$jezik"; 
    $route["$jezik/registracija".'/'.$regs]="registracija/index/$jezik/$1"; 
    $route["$jezik/registracija/registrujse"]="registracija/registrujse/$jezik";
    $route["$jezik/mika".'/'.$regs]="mika/$1";
    $route["$jezik/mika"]="mika/index";
    $route["$jezik/ajax_calendar"]="pocetna/ajax_calendar";
    $route["$jezik/ajax_calendar".'/'.$regs]="pocetna/ajax_calendar/$1";

}


$route['default_controller'] = "pocetna/lokacija";



$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */