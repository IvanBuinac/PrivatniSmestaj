<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Googleplus {

        
	public function __construct() {
		
		$CI =& get_instance();
		$CI->config->load('googleplus');
				
		require APPPATH .'third_party/google-api-php-client/src/Google_Client.php';
		require APPPATH .'third_party/google-api-php-client/src/contrib/Google_PlusService.php';
		
		$cache_path = $CI->config->item('cache_path');
		$GLOBALS['apiConfig']['ioFileCache_directory'] = ($cache_path == '') ? APPPATH .'cache/' : $cache_path;
		
		$this->client = new Google_Client();
                $this->client->setScopes(array("https://www.googleapis.com/auth/plus.login","https://www.googleapis.com/auth/plus.me","https://www.googleapis.com/auth/userinfo.email","https://www.googleapis.com/auth/userinfo.profile"));
                $this->client->setAccessType("online");
                $this->client->setApplicationName($CI->config->item('application_name', 'googleplus'));
		$this->client->setClientId($CI->config->item('client_id', 'googleplus'));
		$this->client->setClientSecret($CI->config->item('client_secret', 'googleplus'));
		$this->client->setRedirectUri($CI->config->item('redirect_uri', 'googleplus'));
		$this->client->setDeveloperKey($CI->config->item('api_key', 'googleplus'));		
		$this->plus = new Google_PlusService($this->client);
		
	}
	public function url()
        {
            return $this->client->createAuthUrl();
            
        }
        
        public function get_user($code)
        {
        $this->client->authenticate($code);
        $_SESSION['access_token']=$this->client->getAccessToken();
        if(isset($_SESSION['access_token']))
            {
                $this->client->setAccessToken($_SESSION['access_token']);
                $me = $this->plus->people->get('me');
                return $me;
            }
        }
        
        
	public function __get($name) {
		
		if(isset($this->plus->$name)) {
			return $this->plus->$name;
		}
		return false;
		
	}
	
	public function __call($name, $arguments) {
		
		if(method_exists($this->plus, $name)) {
			return call_user_func(array($this->plus, $name), $arguments);
		}
		return false;
		
	}
	
}
?>