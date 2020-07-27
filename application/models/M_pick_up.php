<?php 
	
class M_pick_up extends MY_Model{

	function __construct()
    {
        // parent::__construct();
       $this->table  = array(
        	'name' => 'pick_up',
        	'primary_key' => 'id',
        	'field' =>array(
        		'pick_up_id' => array(
        			'type' => 'hidden', 'col'=>'12','label'=>'id'
        		),
        		'id_pengembilan' => array(
        			'type' => 'text', 'col'=>'12','label'=>'Nama'
        		),
        		'kurir' => array(
        			'type' => 'text', 'col'=>'12','label'=>'Nama Barang'
        		),
        		'jarak' => array(
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
    public function ambil($titik_awal)
    {
        $query = $this->db
        ->where('titik_awal',$titik_awal)
        ->get($this->table['name'])
        ->result_array();
        return $query;
    }
    public function ambil2($titik_awal,$i)
    {
        // $titik = explode('_', $i);

        $this->db->where('titik_awal',$titik_awal);
        foreach ($i as $t) {
        $this->db->where('titik_akhir !=',$t);
            # code...
        }
        $query = $this->db->get($this->table['name'])
        ->result_array();
        return $query;
    }
    public function ambil3($titik_awal,$r)
    {
        $query = $this->db
        ->where('titik_awal',$titik_awal)
        ->where('titik_akhir !=',$titik_awal)
        // ->where('titik_akhir !=',$r)
        // ->where('jalur',$jalur)
        ->get($this->table['name'])
        ->row_array();
        return $query;
    }

}