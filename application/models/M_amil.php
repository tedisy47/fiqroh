<?php 
	
class M_amil extends MY_Model{

	function __construct()
    {
        // parent::__construct();
       $this->table  = array(
        	'name' => 'amil',
        	'primary_key' => 'amil_id',
        	'field' =>array(
        		'amil_id' => array(
        			'type' => 'hidden', 'col'=>'12','label'=>'id'
        		),
        		'nama_amil' => array(
        			'type' => 'text', 'col'=>'12','label'=>'Nama Lembaga Amil'
        		),
        		'penanggung_jawab' => array(
        			'type' => 'text', 'col'=>'12','label'=>'Penanggung Jawab'
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

}