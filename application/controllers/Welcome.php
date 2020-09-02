<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('M_user','user');
         
    }
	public function index()
	{
		$this->load->view('login');
	}
	public function login()
	{
		$post = $this->input->post();
		$login = $this->user->login($post['email'],md5($post['password']));
		if (!empty($login)) {
			// print_r($login);die;
			$this->session->set_userdata('login_id',$login->user_id);
			$this->session->set_userdata('name',$login->fullname);
			$this->session->set_userdata('level',$login->hak_akses);
			$this->session->set_flashdata('sweatalert','<script>swal("Selamat Datang", "", "success")</script>');
			redirect('menu');
		}else{
			$this->session->set_flashdata('sweatalert','<script>swal("OOPS", "E-mai atau password salah", "error")</script>');
			redirect();
		}

	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect();
	}
}
