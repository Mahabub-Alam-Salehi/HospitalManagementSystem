<?php
/**
* 
*/
class Hospital_model extends CI_Model
{
	private $table;
	function __construct()
	{
		parent::__construct();
		$this->table = 'users';
	}
	public function set_table($table){
		$this->table = $table;
	}
	public function get_table($table){
		return $this->table;
	}
	public function New_Data($data = array()){
		if(!is_array($data))
			return;
		$this->db->insert($this->table,$data);
	}
	public function Update_Data($options = array(),$data = array()){
		if(!is_array($options))
			return;
		foreach ($options as $key => $value) {
			$this->db->where($key,$value);
		}
		$this->db->set($data);
		$this->db->update($this->table);
	}
	public function Get_Data($data = array()){
		$this->db->order_by('id','desc');
		foreach ($data as $key => $value) {
			$this->db->where($key,$value);
		}
		$query = $this->db->get($this->table);
		return $query->result();
	}
	public function Delete_Data($data = array()){
		if(empty($data))
			return;
		foreach ($data as $key => $value) {
			$this->db->where($key,$value);
		}
		return $this->db->delete($this->table);
	}
	public function exist($data = array()){
		if(empty($data))
			return;
		foreach ($data as $key => $value) {
			$this->db->where($key,$value);
		}
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) {
	        return true;
	    } else {
	        return false;
	    }
	}
}