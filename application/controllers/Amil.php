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
            $data['data'] = array();
        }else{
            $data['data'] = $this->amil->by_id($id);
        }
        // print_r($data);die;
        $this->load->view('index',$data);
    }
    public function insert()
    {
        $post = $this->input->post();
        if (empty($post['latlong'])) {
            # code...
            $this->session->set_flashdata('sweatalert','<script>swal("OOPS", "lokasi karus di tandai", "error")</script>');
            redirect('Amil/form/'.$post['amil_id']);
        }else{
            $latlong = str_replace('(', '', $post['latlong']);
            $latlong = str_replace(')', '', $latlong);
            $latlong = str_replace(' ', '', $latlong);
            $latlong = explode(',', $latlong);
            $data = array(
                'nama_amil' => $post['nama_amil'],
                'penanggun_jawab' => $post['penanggung_jawab'],
                'alamat' => $post['alamat'],
                'langtitude' => $latlong[0],
                'longtitiud' => $latlong[1],
                );
            if (empty($post['amil_id'])) {
                # code...
                $this->amil->insert($data);
                $this->session->set_flashdata('sweatalert','<script>swal("Brhasil", "data berhasil di input", "success")</script>');
                redirect('Amil/list');
            }
            else{
                $this->amil->update($post['amil_id'],$data);
                $this->session->set_flashdata('sweatalert','<script>swal("Brhasil", "data berhasil di update", "success")</script>');
                redirect('Amil/list');
            }
        }
        
    }
    public function detail($id=0)
    {
        $data['title'] = 'Amil';
        $data['page'] = 'amil/detail';
        $data['data'] = $this->amil->by_id($id);
        $this->load->view('index',$data);
    }
    public function delete($id=0)
    {
        $this->amil->delete($id);
        $this->session->set_flashdata('sweatalert','<script>swal("Brhasil", "data berhasil di Hapus", "success")</script>');
                redirect('Amil/list');
    }
}
