<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of link_m
 *
 * @author Ivan
 */
class Link_m extends MY_Model
{
	protected $_table_name = 'link';
        protected $_primary_key = 'link_id';
	protected $_order_by = 'tezina,link_id';
	public $rules = array(
		'roditelj' => array(
			'field' => 'roditelj', 
			'label' => 'Parent', 
			'rules' => 'trim|intval'
		), 
		'meni_id' => array(
			'field' => 'meni_id', 
			'label' => 'Meni', 
			'rules' => 'trim|required|xss_clean'
		), 
		'naziv' => array(
			'field' => 'naziv', 
			'label' => 'Title', 
			'rules' => 'trim|required|max_length[100]|xss_clean'
		), 
		'putanja' => array(
			'field' => 'putanja', 
			'label' => 'Slug', 
			'rules' => 'trim|required|max_length[100]|url_title|callback__unique_putanja|xss_clean'
		), 
	);

	public function get_new ()
	{
		$link = new stdClass();
		$link->naziv = '';
		$link->putanja = '';
		$link->roditelj = 0;
		$link->tezina = 0;
		return $link;
	}

	
       
	
	public function delete ($id)
	{
		// Delete a link
		parent::delete($id);
		
		// Reset parent ID for its children
		$this->db->set(array(
			'roditelj' => 0
		))->where('roditelj', $id)->update($this->_table_name);
	}

	public function save_order ($links)
	{
		if (count($links)) {
			foreach ($links as $order => $link) {
				if ($link['item_id'] != '') {
					$data = array('roditelj' => (int) $link['roditelj'], 'order' => $order);
					$this->db->set($data)->where($this->_primary_key, $link['item_id'])->update($this->_table_name);
				}
			}
		}
	}

	public function get_nested ($idmenu=NULL)
	{
                $this->db->where('meni_id',$idmenu);
		$this->db->order_by($this->_order_by);
		$links = $this->db->get('link')->result_array();
		
		$array = array();
		foreach ($links as $link) {
                        
			if ($link['roditelj']==NULL || $link['roditelj']==0) {
				// This link has no parent
				$array[$link['link_id']] = $link;
			}
			else {
				// This is a child link
				$array[$link['roditelj']]['children'][] = $link;
			}
		}
		return $array;
	}

         public function get_pages_from_menu($idmenu=NULL,$single=FALSE)         
        {
                // Fetch pages without parents
		$this->db->where('meni_id',$idmenu);
		return $this->get(NULL, $single);
		
                
        }
	public function get_with_parent ($id = NULL, $single = FALSE)
	{
		$this->db->select('links.*, p.putanja as parent_putanja, p.naziv as parent_naziv');
		$this->db->join('links as l', 'links.roditelj=l.id', 'left');
		return parent::get($id, $single);
	}

	public function get_no_parents ()
	{
		// Fetch links without parents
		$this->db->select('id, naziv');
		$this->db->where('roditelj', 0);
		$links = parent::get();
		
		// Return key => value pair array
		$array = array(
			0 => 'No parent'
		);
		if (count($links)) {
			foreach ($links as $link) {
				$array[$link->id] = $link->naziv;
			}
		}
		
		return $array;
	}
}