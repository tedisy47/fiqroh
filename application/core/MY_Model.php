<?php 
	
class MY_Model extends CI_Model{


	public function delete($id)
	{
		$this->db
		->where($this->table['primary_key'],$id)
		->delete($this->table['name']);
	}
	public function update($id,$data)
	{
		$this->db
		->where($this->table['primary_key'],$id)
		->update($this->table['name'],$data);
	}
	public function insert($data)
	{
		$this->db
		->insert($this->table['name'],$data);
	}
	public function count()
	{
		return $this->db->count_all($this->table['name']);
	}

}