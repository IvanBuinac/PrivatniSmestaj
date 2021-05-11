<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Model extends CI_Model {
	
	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $rules = array();
	protected $_timestamps = FALSE;
	
	function __construct() {
		parent::__construct();
	}
	
	public function array_from_post($fields){
		$data = array();
		foreach ($fields as $key => $field) {
                        if($key!=NULL)
			$data[$key] = $this->input->post($field);
                        else
                        $data[$field] = $this->input->post($field);
		}
		return $data;
	}
	
	public function get($id = NULL, $single = FALSE){
		if ($id != NULL) {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
		
		if (!count($this->db->ar_orderby)) {
			$this->db->order_by($this->_order_by);
		}
		return $this->db->get($this->_table_name)->$method();
	}
	
	public function get_by($where, $single = FALSE,$or=NULL){
		$this->db->where($where);
                if($or!=NULL)
                {
                $this->db->or_where($or);
                }
		return $this->get(NULL, $single);
	}
        public function get_by_in($where, $single = FALSE){         
            foreach($where as $key =>$whe)
                    {                    
                    $this->db->where_in($key,$whe);
                    }
		return $this->get(NULL, $single);
	}
	
	public function save($data, $id = NULL){
		
		// Set timestamps
		if ($this->_timestamps == TRUE) {
			$now = time();
			$id || $data['kreiran'] = $now;
			$data['modifikovan'] = $now;
		}
		
		// Insert
		if ($id === NULL) {
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		}
		// Update
		else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}
		
		return $id;
	}
	
	public function delete($id,$where=NULL,$limit=FALSE){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		
                if($where==NULL)
                    if($id==NULL)
                    {
                    return FALSE;
                    }
                    else
                    $this->db->where($this->_primary_key, $id);
                else
                {
                    foreach($where as $key =>$whe)
                    {
                    $this->db->where($key,$whe);
                    }
                }
                if($limit!=FALSE)
                {
		$this->db->limit(1);
                }
		return $this->db->delete($this->_table_name);
                
	}
        
        
        public function join($datas,$where=NULL,$single=FALSE)
        {
            if(count($datas)>0)
            {
                foreach ($datas as $key => $data)
                {
                    $this->db->join($key,$data);
                }
            }
            if($where!=NULL && is_array($where))
                    $query = $this->get_by_in($where,$single);
            else
            $query = $this->get(NULL,$single);
            
            return $query;
        }
}