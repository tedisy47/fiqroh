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
        //panggil function get yang ada pada mmodel m_user. 
        $data['datalist'] = $this->user->get($data['page'],$param['perpage']);           
        $data['pagination'] = $pagination['pagination'];
        $data['title'] = 'Data User';
        $data['page'] = 'user/list';
        // print_r($data);die;
		$this->load->view('index',$data);
    }

    public function form($id=0)
    {
        $data = array(
            'url' => site_url('user/insert'),
            'page' => 'user/form',
            'title' => 'Form User'
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

        if (empty($post['user_id'])) {
            $data = array(
                'email' => $post['email'],
                'password' => md5($post['password']),
                'hak_akses' => $post['hak_akses'],
            );

            $this->user->insert($data);
            $this->session->set_flashdata('sweatalert','<script>swal("Berhasil!", "Data user berhasil ditambah.", "success")</script>');
            redirect('user/list');
        } else {
            if(empty($post['password'])) {
                $data = array(
                    'email' => $post['email'],
                    'hak_akses' => $post['hak_akses'],
                );
            } else {
                $data = array(
                    'email' => $post['email'],
                    'password' => md5($post['password']),
                    'hak_akses' => $post['hak_akses'],
                );
            }

            $this->user->update($post['user_id'], $data);
            $this->session->set_flashdata('sweatalert','<script>swal("Berhasil!", "Data berhasil diupdate.", "success")</script>');
            redirect('user/list');
        }   
    }

    public function delete($id = 0)
    {
        $this->user->delete($id);
        print_r($id);
        $this->session->set_flashdata('sweatalert','<script>swal("Berhasil!", "Data berhasil dihapus.", "success")</script>');
        redirect('user/list');
    }
}
