<?php
class Video_model extends CI_Model {
	
	private $tbl_video= 'video';
	
	function __construct(){
		parent::__construct();
	}
	
	function list_all(){
		$this->db->order_by('id','asc');
		return $this->db->get($tbl_video);
	}
	
	function count_all(){
		return $this->db->count_all($this->tbl_video);
	}
	
	function get_paged_list($limit = 10, $offset = 0){
		//$this->db->order_by('id','asc');
		$this->db->order_by('id','desc');
		return $this->db->get($this->tbl_video, $limit, $offset);
	}
	
	function get_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->tbl_video);
	}
	
	function save($video){
		$this->db->insert($this->tbl_video, $video);
		return $this->db->insert_id();
	}
	
	function update($id, $video){
		$this->db->where('id', $id);
		$this->db->update($this->tbl_video, $video);
	}
	
	function delete($id){
		$this->db->where('id', $id);
		$this->db->delete($this->tbl_video);
	}
}
?>