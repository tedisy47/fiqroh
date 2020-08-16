<?php 
	
class M_user extends MY_Model{

	function __construct()
    {
        // parent::__construct();
       $this->table  = array(
        	'name' => 'user',
        	'primary_key' => 'user_id'
        );
         
	}
	
	public function login($email,$password)
	{
		$query = $this->db
		->join('user_detail','user_detail.user_id=user.user_id','left')
		->where('email',$email)
		->where('password',$password)
		->get($this->table['name'])
		->row();
		return $query;
	}

	public function get($start,$limit)
	{
		$query = $this->db
		->get($this->table['name'],$limit,$start)
		->result();
		return $query;
	}

	public function by_id($id)
	{
		$query = $this->db
		->where('user_id',$id)
		->get($this->table['name'])
		->row();
		return $query;
	}

	public function insert($data)
	{
		$this->db->insert($this->table['name'], $data);
	}

	public function delete($id)
	{
		$this->db->delete($this->table['name'], ['user_id' => $id]);
	}
}