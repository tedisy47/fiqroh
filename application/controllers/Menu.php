<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('M_user','user');
         
    }
	public function index()
	{
		$data['title'] = 'Home';
		$data['page'] = 'home';
		$this->load->view('index',$data);
	}
}
