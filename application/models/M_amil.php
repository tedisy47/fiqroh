<?php 
	
class M_amil extends MY_Model{

	function __construct()
    {
        // parent::__construct();
       $this->table  = array(
        	'name' => 'alamat_pengambilan',
        	'primary_key' => 'id',
        	'field' =>array(
        		'id' => array(
        			'type' => 'hidden', 'col'=>'12','label'=>'id'
        		),
        		'nama' => array(
        			'type' => 'text', 'col'=>'12','label'=>'Nama'
        		),
        		'nama_barang' => array(
        			'type' => 'text', 'col'=>'12','label'=>'Nama Barang'
        		),
        		'amil_id' => array(
        			'type' => 'hidden', 'col'=>'12','label'=>'id'
        		),
        	),
        );
         
    }
	public function get($start,$limit)
	{
		$query = $this->db
		->get($this->table['name'],$limit,$start)
		->result();
		return $query;
	}
    public function ambil()
    {
        $query = $this->db
        // ->where('status',0)
        ->get($this->table['name'])
        ->result_array();
        return $query;
    }

}