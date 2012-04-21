<?php
class Mobilefront_model extends CI_Model {
	
	private $tbl_news= 'news';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($tbl_news);
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_news);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		//$this->db->order_by('id','asc');
		$this->db->order_by('id','desc');
		return $this->db->get($this->tbl_news, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tbl_news);
	}
	
	function save($news){
		$this->db->insert($this->tbl_news, $news);
		return $this->db->insert_id();
	}
	
	function update($id, $news){
		$this->db->where('id', $id);
		$this->db->update($this->tbl_news, $news);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_news);
	}
}
?>