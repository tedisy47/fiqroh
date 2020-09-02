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
		// print_r($this->session->userdata());
		$this->load->view('index',$data);
	}
	public function berhasil()
	{
		$data['title'] = 'Berhasil';
		$data['page'] = 'berhasil';
		$this->load->view('index',$data);

	}
	public function kalkulator()
	{
		$data['title'] = 'Kalkulator Zakat';
		$data['page'] = 'kalkulator';
		$this->load->view('index',$data);		
	}
	public function tentang_zakat()
	{
		$data['title'] = 'Tentang Zakat';
		$data['page'] = 'tentang_zakat';
		$this->load->view('index',$data);		
	}
	public function test_email()
	{
		$config = Array(  
        'protocol' => 'smtp',  
        'smtp_host' => 'ssl://smtp.googlemail.com',  
        'smtp_port' => 465,  
        'smtp_user' => 'fiqrohannisa1512@gmail.com',   
        'smtp_pass' => 'amiypaty',   
        'mailtype' => 'html',   
        'charset' => 'iso-8859-1'  
       );  
       $this->load->library('email', $config);  
       $this->email->set_newline("\r\n");  
       $this->email->from('fiqrohannisa1512@gmail.com', 'fiqroh');   
       $this->email->to('saefulyaditedi@gmail.com');   
       $this->email->subject('Percobaan email');   
       $this->email->message('amiypaty');  
       if (!$this->email->send()) {  
        show_error($this->email->print_debugger());   
       }else{  
          
       		echo "sukses";
       }
	}

}
