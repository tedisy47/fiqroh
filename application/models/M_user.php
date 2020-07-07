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

}