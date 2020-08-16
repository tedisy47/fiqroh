<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once('vendor/autoload.php');
use \Midtrans\Config;
use \Midtrans\Snap;
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
        $data['title'] = 'Data Muzakki';
        $data['page'] = 'amil/list';
        // print_r($data);die;
		$this->load->view('index',$data);
	}
    public function form($id=0,$jenis='zakat')
    {
        $data = array(
            // 'form' => $this->amil->get_field(),
            'url' => site_url('amil/insert'),
            'page' => 'amil/form',
            'jenis'=> $jenis,
        );

        if($jenis == 'infaq') {
            $data['title'] = 'Form Bayar Infaq';
        } elseif($jenis == 'sodaqoh') {
            $data['title'] = 'Form Bayar Shodaqoh';
        } else {
            $data['title'] = 'Form Bayar Zakat Mal';
        }

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
            $this->session->set_flashdata('sweatalert','<script>swal("OOPS!", "Lokasi harus ditandai.", "error")</script>');
            redirect('amil/form/'.$post['amil_id']);
        }else{
            $latlong = str_replace('(', '', $post['latlong']);
            $latlong = str_replace(')', '', $latlong);
            $latlong = str_replace(' ', '', $latlong);
            $latlong = explode(',', $latlong);
            $data = array(
                'nama' => $post['nama'],
                'nama_barang' => $post['nama_barang'],
                'email' => $post['email'],
                'alamat' => $post['alamat'],
                'jenis' => $post['jenis'],
                'langtitude' => $latlong[0],
                'longtitiud' => $latlong[1],
                );
            if (empty($post['amil_id'])) {
                # code...
                $this->amil->insert($data);
                $config = Array(  
                'protocol' => 'smtp',  
                'smtp_host' => 'ssl://smtp.googlemail.com',  
                'smtp_port' => 465,  
                'smtp_user' => 'email_kamu@gmail.com',   
                'smtp_pass' => 'password_email_kamu',   
                'mailtype' => 'html',   
                'charset' => 'iso-8859-1'  
               );  
               $this->load->library('email', $config);  
               $this->email->set_newline("\r\n");  
               $this->email->from('recodeku@gmail.com', 'Admin Re:Code');   
               $this->email->to('email_kamu@gmail.com');   
               $this->email->subject('Percobaan email');   
               $this->email->message('Ini adalah email percobaan untuk Tutorial CodeIgniter: Mengirim Email via Gmail SMTP menggunakan Email Library CodeIgniter @ recodeku.blogspot.com');  
               if (!$this->email->send()) {  
                show_error($this->email->print_debugger());   
               }else{  
                  
                $this->session->set_flashdata('sweatalert','<script>swal("Berhasil!", "Data berhasil ditambah.", "success")</script>');
                redirect('amil/list');   
               }
            }
            else{
                $this->amil->update($post['amil_id'],$data);
                $this->session->set_flashdata('sweatalert','<script>swal("Berhasil!", "Data berhasil diupdate.", "success")</script>');
                redirect('amil/list');
            }
        }
        
    }
    public function detail($id=0)
    {
        $data['title'] = 'Detail Data Muzakki';
        $data['page'] = 'amil/detail';
        $data['data'] = $this->amil->by_id($id);
        $this->load->view('index',$data);
    }
    
    public function tentang()
    {
        $data['title'] = 'Tentang Zakat';
        $data['page'] = 'tentang_zakat';
        $this->load->view('index',$data);
    }

    public function delete($id=0)
    {
        $this->amil->delete($id);
        $this->session->set_flashdata('sweatalert','<script>swal("Berhasil!", "Data berhasil dihapus.", "success")</script>');
                redirect('amil/list');
    }
    public function midtrans()
    {
        $post = $this->input->post();
        // print_r($post);die;
        Config::$serverKey = "SB-Mid-server-01Fw78TPGlHTj311A6glhuTy";

        //

        // Required
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => $post['nominal'], // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
            'id' => 'a1',
            'price' => $post['nominal'],
            'quantity' => 1,
            'name' => $post['jenis']
        );


        // Optional
        $item_details = array ($item1_details);

     
        // Optional
        $customer_details = array(
            'first_name'    => $post['nama'],
            'last_name'     => "",
            'email'         => "admin@zakat.compact",
            'phone'         => "",
            'billing_address'  => array(),
            'shipping_address' => array()
        );

        // Fill SNAP API parameter
        $params = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($params)->redirect_url;
          
            // Redirect to Snap Payment Page
            header('Location: ' . $paymentUrl);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
}
}
