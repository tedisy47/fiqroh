<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ambil extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('M_amil','amil');
        $this->load->model('M_pick_up','pick_up');
         if (!$this->session->userdata('login_id')) {
             # code...
            redirect();
         }
    }
    public function index()
    {
        $post = $this->input->post();
        // print_r($post);die;
        $lokasi = $this->amil->ambil();

        $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$post['lat'].",".$post['lng']."&destinations=".$post['lat'].",".$post['lng']."&key=AIzaSyAgINDzGpgwWpcZtnOLuw5DtWcrO_VUsoE&mode=driving&language=id");
//        echo $api;die;
        $api = json_decode($api,TRUE);
<<<<<<< HEAD
     	//print_r($api);
=======
        // print_r($api);die;
>>>>>>> 4914fa015e24697a1155a05b8c6fd995edc7ef29
        $data['jarak'] = $api['rows'][0]['elements'][0]['distance']['value']; 
        $data['id_pengambilan'] = $this->session->userdata('login_id');
        $data['kurir'] = $this->session->userdata('login_id');
        $data['titik_awal'] = $this->session->userdata('login_id');
        $data['titik_akhir'] = $this->session->userdata('login_id');
        $data['jalur'] = 0;
        $jalur = 0;
        $this->pick_up->insert($data);
        foreach ($lokasi as $key => $value) {
            $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$post['lat'].",".$post['lng']."&destinations=".$value['langtitude'].",".$value['longtitiud']."&key=AIzaSyAgINDzGpgwWpcZtnOLuw5DtWcrO_VUsoE&mode=driving&language=id");
            // echo $api;
            $api = json_decode($api,TRUE);
            $data['jarak'] = $api['rows'][0]['elements'][0]['distance']['value']; 
            $data['id_pengambilan'] = $value['id'];
            $data['kurir'] = $this->session->userdata('login_id');
            $data['titik_awal'] = $this->session->userdata('login_id');
            $data['titik_akhir'] = $value['id'];
            $data['jalur'] = $key;
            $param['status'] =1 ;
            $this->amil->update($value['id'],$param);
            $lokasi_index = array('lat' =>$value['langtitude'] ,'lng'=>$value['longtitiud'],'titik_awal'=>$value['id']);
            $loksi_kurir = array('lat' =>$post['lat'] ,'lng'=>$post['lng']);
            $this->pick_up->insert($data);
            $this->lokasi_index($lokasi,$lokasi_index,$loksi_kurir,$jalur,count($lokasi));
        }
        // echo count($lokasi);die;
            // print_r($data);die;

        redirect('ambil/warshall');
    }
   
    public function lokasi_index($lokasi,$lokasi_index,$loksi_kurir,$jalur,$count_lokasi)
    {
        // echo $jalur;

         foreach ($lokasi as $key => $value) {
            echo $key;
            $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$lokasi_index['lat'].",".$lokasi_index['lng']."&destinations=".$value['langtitude'].",".$value['longtitiud']."&key=AIzaSyAgINDzGpgwWpcZtnOLuw5DtWcrO_VUsoE&mode=driving&language=id");
            // echo $api;
            $api = json_decode($api,TRUE);
            $data['jarak'] = $api['rows'][0]['elements'][0]['distance']['value']; 
            $data['id_pengambilan'] = $value['id'];
            $data['kurir'] = $this->session->userdata('login_id');
            $data['titik_awal'] = $lokasi_index['titik_awal'];
            $data['titik_akhir'] = $value['id'];
            $data['jalur'] = $jalur;
         
            $this->pick_up->insert($data);
        }
        $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$lokasi_index['lat'].",".$lokasi_index['lng']."&destinations=".$loksi_kurir['lat'].",".$loksi_kurir['lng']."&key=AIzaSyAgINDzGpgwWpcZtnOLuw5DtWcrO_VUsoE&mode=driving&language=id");
            // echo $api;
        $api = json_decode($api,TRUE);
        $data['jarak'] = $api['rows'][0]['elements'][0]['distance']['value']; 
        $data['id_pengambilan'] = $value['id'];
        $data['kurir'] = $this->session->userdata('login_id');
        $data['titik_akhir'] = $this->session->userdata('login_id');
        $data['titik_awal'] = $lokasi_index['titik_awal'];     
        
        $this->pick_up->insert($data);
    }
    public function getDistance($int=0)
    {
        $this->recursive($int);
    }
    public function maps()
    {
         $hasil = $this->db->where('user_id',$this->session->userdata('login_id'))->get('hasil')->result_array();

        $lokasi = count($this->amil->ambil());
        $lokasi = $lokasi+1;
        foreach ($hasil as $key => $value) {
            # code...
           // echo  $value['hasil'].'<br>';
                # code...
            
            $sortir = json_decode($value['hasil'],true);
            // print_r($sortir);s
            foreach ($sortir as $k => $v) {
                # code...
                $count_jalur = explode(',',$v['jalur']);
                $count_jalur = count($count_jalur);
                if ($count_jalur == $lokasi) {
                    # code...
                    $rute[$key]['jarak'] = $v['jarak'];
                    $rute[$key]['jalur'] = $v['jalur'];
                    
                }
                
            }
        }
        $data['rute'] = min($rute);

        $data['title'] = 'Amil';
        $data['page'] = 'test';
        // print_r($data);die;
        $this->load->view('index',$data);
        // print_r($sortir)
    }
    public function warshall()
    {
            
        $lokasi = count($this->amil->ambil());
        $next = $this->recursive($this->session->userdata('login_id'),$this->session->userdata('login_id'),$lokasi+1,0);
            // code...
            print_r($next);die();

        $hasil = $this->get_hasl($next);
       redirect('Ambil/maps');
    }
    public function recursive($titik_awal,$titik,$count,$jarak)
    {   
        $titik2 = explode(',', $titik);
            $jalur = $this->pick_up->ambil2($titik_awal,$titik2); 
        // print_r($titik);die;
            // echo count($titik2).'<br>';
        foreach ($jalur as $key => $value) {
            if (count($titik2)<$count) {
                $data[$key]['jalur'] = $titik.','.$value['titik_akhir'];
                $data[$key]['jarak'] = $jarak+$value['jarak'];
                $data[$key]['next'] = $this->recursive($value['titik_akhir'],$data[$key]['jalur'],$count,$data[$key]['jarak']);
            }
        }
       return @$data;
    }
    public function get_hasl($data)
    {
        $c = NULL;
        foreach ($data as $key => $value) {
            if (!empty($data[$key]['next'])) {
                # code...
                // $this->session->set_userdata('data',json_encode($data[$key]['next']));
                $hasil = array('hasil'=>json_encode($data[$key]['next']),'user_id'=>$this->session->userdata('login_id'),);
                $this->db->insert('hasil',$hasil);
               $next= $this->get_hasl($data[$key]['next']);
                // echo $no.'<br>';;
            }
        }
    }
    public function get_next_location($titik_awal)
    {        
        set_time_limit(2000);
        $lokasi = $this->amil->ambil();
        $data = array();
        foreach ($lokasi as $key => $value) {
            # code...
            if ($titik_awal != $value['id']) {
            # code...
                $pick_up = $this->pick_up->ambil2($titik_awal,$value['id']);
                $value['next'] = $this->get_next_location($pick_up['titik_akhir']);
                array_push($data, $pick_up);
            }
        }
        return $data;
            
    }
    public function test()
    {
        $data_jalur_lengkap = array(1, 2, 3, 4);
        $data_jalur = $data_jalur_lengkap;
        unset($data_jalur[0]);
        $data_jalur_saya = array();
        foreach ($data_jalur as $key => $value) {
          $data_jalur_saya[$value] = $data_jalur;
          unset($data_jalur_saya[$value][$key]);
          $data_jalur_saya_berikut = array();
          foreach ($data_jalur_saya[$value] as $key2 => $value2) {
            $data_jalur_saya_berikut[] = $value2;
          }
          $data_jalur_saya[$value] = $data_jalur_saya_berikut;

          echo "Route " . ($key) . " ::" . "<br>";
          echo "jalur " . $data_jalur_lengkap[0] . " ke " . $value . "<br>";
          echo "jalur " . $value . " ke jalur " . $data_jalur_saya[$value][0] . "<br>";
          echo "jalur " . $value . " ke jalur " . $data_jalur_saya[$value][1] . "<br>";
          echo "jalur " . $data_jalur_saya[$value][0] . " ke jalur " . $data_jalur_saya[$value][1] . "<br>";
          echo "jalur " . $data_jalur_saya[$value][1] . " ke jalur " . $data_jalur_saya[$value][0] . "<br>";
          echo "<br><br>";
        }
    }


}
