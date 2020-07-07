<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Amil extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('M_amil','amil');
         
    }
	public function list()
	{
		 //konfigurasi pagination
        $param['url'] = site_url('amil/list');
        $param['perpage'] = 5;
        $param['total_rows'] = $this->amil->count();
        $param['uri_segment'] = 3;
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 		$pagination = pagination($param);
 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['datalist'] = $this->amil->get($data['page'],$param['perpage']);           
        $data['pagination'] = $pagination['pagination'];
        $data['title'] = 'Amil';
        $data['page'] = 'amil/list';
        // print_r($data);die;
		$this->load->view('index',$data);
	}
    public function form($id=0)
    {
        $data = array(
            // 'form' => $this->amil->get_field(),
            'url' => site_url('amil/insert'),
            'page' => 'amil/form',
            'title' => 'Amil'
        );
        if (empty($id)) {
            # code...
            $data['id'] = '';
        }else{
            $data['id'] = $id;
        }
        $this->load->view('index',$data);
    }
}
