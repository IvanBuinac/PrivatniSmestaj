<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
	
	public $data = array();
		function __construct() {
			parent::__construct();
			$errors=$this->data['errors'] = array();
			$this->data['site_name'] = config_item('site_name');
                        $this->data['meta_title']=  config_item('site_name');
                        $this->data['description']=  config_item('description');
                        
                        $this->data['facebook_link']=  config_item('facebook-link');
                        $this->data['twitter_link']=  config_item('twitter-link');
                        $this->data['google_link']=  config_item('google-link');
                        $this->data['youtube_link']=  config_item('youtube-link');
                        
                        $this->data['prijatelji_sajta']=  config_item('prijatelji-sajta');
                        
                        $this->data['keywords']=  config_item('keywords');
                        $jezik=  $this->uri->segment(1);
                        $this->data['jezik']=  $jezik;
ini_set('post_max_size', '64M');
ini_set('upload_max_filesize', '64M');
		}
}