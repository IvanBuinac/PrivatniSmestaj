    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dashboard
 *
 * @author Ivan
 */
class dashboard extends Admin_Controller{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
public function index()
    {
        
    	
        
        

        parent::template ();
    }
    public function backup_database()
    {
          
	$this->load->dbutil();

        $prefs = array(     
                'format'      => 'zip',             
                'filename'    => 'my_db_backup.sql'
              );


        $backup =& $this->dbutil->backup($prefs); 

        $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        $save = 'DB_backup/'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup); 
print "uspesno ste sacuvali fajl!";
//    $path = base_url();      
//$cron = $path . "/pocetna/backup_database";
//echo exec("***** php -q ".$cron." &> /dev/null");
 
    }
}
