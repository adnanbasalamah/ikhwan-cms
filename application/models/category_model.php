<?php
class Category_model extends CI_Model {
	
	private $tbl_category= 'video_category';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($tbl_category);
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_category);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		$this->db->order_by('id','asc');
		return $this->db->get($this->tbl_category, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tbl_category);
	}
	
	function save($category){
		$this->db->insert($this->tbl_category, $category);
		return $this->db->insert_id();
	}
	
	function update($id, $category){
		$this->db->where('id', $id);
		$this->db->update($this->tbl_category, $category);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_category);
	}
}
?>