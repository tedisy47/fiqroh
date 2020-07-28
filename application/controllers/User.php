<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('M_user','user');
         
    }
	public function list()
	{
		 //konfigurasi pagination
        $param['url'] = site_url('user/list');
        $param['perpage'] = 5;
        $param['total_rows'] = $this->user->count();
        $param['uri_segment'] = 3;
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 		$pagination = pagination($param);
 
        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 
        $data['datalist'] = $this->user->get($data['page'],$param['perpage']);           
        $data['pagination'] = $pagination['pagination'];
        $data['title'] = 'user';
        $data['page'] = 'user/list';
        // print_r($data);die;
		$this->load->view('index',$data);
	}
    public function form($id=0)
    {
        $data = array(
            // 'form' => $this->user->get_field(),
            'url' => site_url('user/insert'),
            'page' => 'user/form',
            'title' => 'user'
        );
        if (empty($id)) {
            # code...
            $data['data'] = array();
        }else{
            $data['data'] = $this->user->by_id($id);
        }
        // print_r($data);die;
        $this->load->view('index',$data);
    }
    public function insert()
    {
        $post = $this->input->post();
        $data = array(
            'email' => $post['email'],
            'password' => md5($post['password']),
            'nama' => $post['nama'],
            );
        if (empty($post['user_id'])) {
            # code...
            $this->user->insert($data);
            $this->session->set_flashdata('sweatalert','<script>swal("Brhasil", "data berhasil di input", "success")</script>');
            redirect('user/list');
        }
        else{
            $this->user->update($post['user_id'],$data);
            $this->session->set_flashdata('sweatalert','<script>swal("Brhasil", "data berhasil di update", "success")</script>');
            redirect('user/list');
        }        
    }
    public function detail($id=0)
    {
        $data['title'] = 'user';
        $data['page'] = 'user/detail';
        $data['data'] = $this->user->by_id($id);
        $this->load->view('index',$data);
    }
    public function delete($id=0)
    {
        $this->user->delete($id);
        $this->session->set_flashdata('sweatalert','<script>swal("Brhasil", "data berhasil di Hapus", "success")</script>');
                redirect('user/list');
    }
}
