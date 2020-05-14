<?php defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Psr7;
use \GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

/**********************************************************************************
 * 
 * Deskripsi
 * Menampilkan halaman client/laporan_pasien_registrasi
 * 
 **********************************************************************************/
class C_laporan_pasien_registrasi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    // add session statis
    $data = [
      'id_user' => "123",
      'rs_key'  => "A123",
      'user_login' => [
        'id_user' => "373680"
      ],
      'no_rm'      => "008000649",
      'timezone' => "Asia/Jakarta"
    ];
    $this->session->set_userdata($data);

    // token diambil dari postman, kalau sudah expired sikahkan ambil lagi.
    $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJuYW1lIjoiTkFNQSAyIiwiaWRfdXNlciI6IjM3MzY4MSIsInJtX251bWJlciI6ImFkbWluIiwicnNfa2V5IjoiQTEyMyIsImlwX2FkZHJlc3MiOiIxMjcuMC4xLjEiLCJhY2Nlc3MiOiJ1c2VyIn0.ubW6fyc7ErYOW2T5qFbjXvLIVTLp05s3A0paQ6wfcmo";
    $this->id_ref_global_tipe_42 = 500;
    
    // guzzle client
    
    $this->_client_ref = new Client([
      'base_uri'  => $this->config->item('api_ref'),
      'headers'   => [
        'Content-Type' => 'application/json',
        'x-token' => $token
      ]
    ]);

    $this->_client_laporan = new Client([
      'base_uri'  => $this->config->item('api_laporan'),
      'headers'   => [
        'Content-Type' => 'application/json',
        'x-token' => $token
      ]
    ]);

    // NAMA FOLDER DALAM CONTROLLER. 
    // HANYA EDIT DI SINI.. YANG LAIN TIDAK PERLU DIRUBAH... TOLONG GANTI DENGAN NAMA FOLDER YANG BARU
    $this->c_folder = "C_laporan_pasien_registrasi"; // <<< HANYA INI YANG PERLU DIRUBAH DI CONSTRUCT()!!!! SISANYA DIAMKAN

    //menghilangkan 'C_' pada nama class untuk dinamisasi routing;
    $this->class = str_replace("c_", "", $this->router->fetch_class());

    //dummy id departemen
    $this->id_dept = 3;

    // untuk menyimpan data ke /tmp untuk ditampilkan di cetak
    $this->folder = $this->config->item('tmp_folder');
  }

  // redirect ke fungsi list
  public function index()
  // $route['laporan_pasien_registrasi'] = 'laporan_pasien_registrasi/c_laporan_pasien_registrasi';
  {
    // echo base_url(); die;
    redirect(base_url() . $this->class . '/list');
  }


  // Menampilkan tampilan aktif dan arsip
  public function list()
  {
    $data = array(
      'title'   => 'Laporan Pasien Registrasi',
      'class_name' => $this->class,
    );

      $data['contents'] = 'contents/laporan/' . $this->class . '/index';
      $this->load->view('master', $data);

  }

  //mengambil data registrasi untuk di tampilkan
  function get_data()
  {

      $no_rm = $this->session->userdata('no_rm');

      //aktif
      // $response_pasien_reg = $this->_client_laporan->request('GET', 'registrasi');
      // $data['laporan_pasien_registrasi'] = json_decode($response_pasien_reg->getBody()->getContents(), true)['data'];

      // $user_id      = $this->session->userdata('id_user');
      // foreach (glob($this->folder . $user_id . '_' . $this->class . '*') as $f) {
      //   unlink($f);
      // }

      // $this->load->view('contents/laporan/' . $this->class . '/list', $data);

      $this->load->view('contents/laporan/' . $this->class . '/list');

  }

}
