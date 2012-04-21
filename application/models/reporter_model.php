<?php
class Reporter_model extends CI_Model {
	
	
	private $tbl_reporter= 'reporter';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($tbl_reporter);
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_reporter);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		//$this->db->order_by('id','asc');
		$this->db->order_by('id','desc');
		return $this->db->get($this->tbl_reporter, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tbl_reporter);
	}
	
	function save($news){
		$this->db->insert($this->tbl_reporter, $news);
		return $this->db->insert_id();
	}
	
	function update($id, $news){
		$this->db->where('id', $id);
		$this->db->update($this->tbl_reporter, $news);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_reporter);
	}
	

}
?>