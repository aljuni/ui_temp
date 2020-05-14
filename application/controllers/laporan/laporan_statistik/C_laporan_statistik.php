<?php defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Psr7;
use \GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**********************************************************************************
 * 
 * Deskripsi
 * Menampilkan halaman client/laporan_statistik
 * 
 **********************************************************************************/
class C_laporan_statistik extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->library('pdf');
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
    $this->id_ref_global_tipe_42 = 501;
    $this->title = "Laporan Statistik";
    
    // guzzle client
    $this->_client_rs = new Client([
      'base_uri'  => $this->config->item('api_rs'),
      'headers'   => [
        'Content-Type' => 'application/json',
        'x-token' => $token
      ]
    ]);
    
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
    $this->c_folder = "C_laporan_statistik"; // <<< HANYA INI YANG PERLU DIRUBAH DI CONSTRUCT()!!!! SISANYA DIAMKAN

    //menghilangkan 'C_' pada nama class untuk dinamisasi routing;
    $this->class = str_replace("c_", "", $this->router->fetch_class());

    //dummy id departemen
    $this->id_dept = 3;

    // untuk menyimpan data ke /tmp untuk ditampilkan di cetak
    $this->folder = $this->config->item('tmp_folder');
  }

  // redirect ke fungsi list
  public function index()
  // $route['laporan_statistik'] = 'laporan_statistik/c_laporan_statistik';
  {
    // echo base_url(); die;
    redirect(base_url() . $this->class . '/list');
  }


  // Menampilkan tampilan aktif dan arsip
  public function list()
  {
    $data = array(
      'title'   => 'Laporan Statistik',
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
      $response_laporan_statistik = $this->_client_laporan->request('GET', 'statistik/registrasi', [
        'query' => [
          'type_tgl' => 'checkin',
          'tgl_start'  => '2019-01-06',
          'tgl_end' => '2020-04-16'
        ]
      ]);

      $data['laporan_statistik'] = json_decode($response_laporan_statistik->getBody()->getContents(), true)['data'];


      $response_laporan_icd10 = $this->_client_laporan->request('GET', 'statistik/icd10', [
        'query' => [
          'type_tgl' => 'checkin',
          'tgl_start'  => '2019-01-02',
          'tgl_end' => '2020-03-01'
        ]
      ]);

      $data['laporan_icd10'] = json_decode($response_laporan_icd10->getBody()->getContents(), true)['data'];

      // $user_id      = $this->session->userdata('id_user');
      // foreach (glob($this->folder . $user_id . '_' . $this->class . '*') as $f) {
      //   unlink($f);
      // }

      $this->load->view('contents/laporan/' . $this->class . '/list', $data);
      // echo "string";
      // echo trace($data);

  }

  function print_pdf(){

      $rs_key = $this->session->userdata('rs_key');

      $response_prop_clinic     = $this->_client_rs->request('GET', 'clinic_profile', [
        'query' => ['rs_key' => $rs_key]
      ]);
      $prop_clinic = json_decode($response_prop_clinic->getBody()->getContents(), true);
      $clinic_profile = $prop_clinic['data'];

      // form header
      $id_form = $this->id_ref_global_tipe_42;

      $form = $this->_client_ref->request('GET', 'form', [
        'query' => ['id' => $id_form]
      ]);

      $form = json_decode($form->getbody()->getcontents(), true);
      $form = $form['data'];

      $no_rm = $this->session->userdata('no_rm');

      $tgl_start = '2019-01-06';
      $tgl_end = '2020-04-16';

      //aktif
      $response_pasien_reg = $this->_client_laporan->request('GET', 'statistik/registrasi', [
        'query' => [
          'type_tgl' => 'checkin',
          'tgl_start'  => '2019-01-06',
          'tgl_end' => '2020-04-16'
        ]
      ]);

      $response['laporan_statistik'] = json_decode($response_pasien_reg->getBody()->getContents(), true)['data'];

      $response_laporan_icd10 = $this->_client_laporan->request('GET', 'statistik/icd10', [
        'query' => [
          'type_tgl' => 'checkin',
          'tgl_start'  => '2019-01-02',
          'tgl_end' => '2020-03-01'
        ]
      ]);

      $response['laporan_icd10'] = json_decode($response_laporan_icd10->getBody()->getContents(), true)['data'];

      $laporan_statistik = $response['laporan_statistik'];
      $laporan_icd10 = $response['laporan_icd10'];

      $title  = $form['nama_form']; // title pdf
      $kode   = $form['kode_form']; // kode form
      $name   = $form['pdf_file_name'] . date("Ymd") . '.pdf'; // nama form

      $pdf = new FPDF('P','mm','A4');
      $pdf->SetTitle($title);

      $textColour = array( 0, 0, 0 );
      $headerColour = array( 100, 100, 100 );
      $tableHeaderTopTextColour = array( 255, 255, 255 );
      $tableHeaderTopFillColour = array( 125, 152, 179 );
      $tableHeaderTopProductTextColour = array( 0, 0, 0 );
      $tableHeaderTopProductFillColour = array( 143, 173, 204 );
      $tableHeaderLeftTextColour = array( 99, 42, 57 );
      $tableHeaderLeftFillColour = array( 184, 207, 229 );
      $tableBorderColour = array( 50, 50, 50 );
      $tableRowFillColour = array( 213, 170, 170 );

      $pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
      // membuat halaman baru
      $pdf->AddPage();


      ////////////////////////////////////////
      // START Header PDF
      ///////////////////////////////////////
      $pdf->SetFont( 'Arial', 'B', 24 );
      $pdf->Cell(27,27,'', 1,0, 'C');
      // $pdf->Image($clinic_profile['logo1'], 11,11,25,0,'PNG');
      $x = $pdf->GetX();

      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFont( 'Arial', '', 17 );
      $pdf->Cell(130,15,$title, 1,0,'C');
      // date('d-M-Y',  strtotime($tgl_start)) .' - '.date('d-M-Y',  strtotime($tgl_end))

      $pdf->SetFont( 'Arial', 'B', 20 );
      $pdf->Cell(30,27, $kode, 1,1, 'C');
      $pdf->SetY(25);
      $pdf->SetX($x);

      $pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
      $pdf->SetFont( 'Arial', '', 14 );
      // $pdf->Cell(130,12, '  '.$clinic_profile['clinic_name'], 1,1);
      $pdf->Cell(130,12, '  Klinik Bahagia', 1,1);

      // $pdf->ln(10);

      ////////////////////////////////////////
      // START Body PDF
      ///////////////////////////////////////
      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFont( 'Arial', '', 10 );
      $pdf->Cell(180,15,chr(149) . ' Rekapitulasi '. date('d-M-Y',  strtotime($tgl_start)) .' - '.date('d-M-Y',  strtotime($tgl_end)), 0,1,'L');

      // Start Tabel Bagian Data Umur
      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFont( 'Arial', '', 10 );
      $pdf->Cell(60,12, 'Laporan Umur Pasien', 'B',1);
      $margin_Y = $pdf->GetY();

      $pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
      $pdf->ln(5);

      $pdf->SetFont( 'Arial', '', 10 );
      $pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
      $pdf->SetFillColor( 118, 120, 122 );
      $pdf->Cell( 50, 10, " Pasien - Umur", 1, 0, 'L', true );
      $pdf->Cell( 10, 10, 'L', 1, 0, 'C', true );
      $pdf->Cell( 10, 10, 'P', 1, 0, 'C', true );
      $margin_X = $pdf->GetX();
      $pdf->Cell( 20, 10, 'Total', 1, 1, 'C', true );

      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFillColor( 255, 255, 255 );
      $data = $laporan_statistik['data_umur'];
      $keys = array_keys((array)$data);
      
      for ($i=0; $i < count($keys); $i++) { 
        $pdf->Cell( 50, 8,  $keys[$i], 'B', 0, 'L', true );
        $pdf->Cell( 10, 8, $data[$keys[$i]]['pria'], 'B', 0, 'C', true );
        $pdf->Cell( 10, 8, $data[$keys[$i]]['wanita'], 'B', 0, 'C', true );
        $pdf->Cell( 20, 8, $data[$keys[$i]]['pria'] + $data[$keys[$i]]['wanita'], 'B', 1, 'C', true );
      }

      $pdf->ln(10);
      // End Tabel Bagian Data Umur

      // Start Tabel Bagian Data Penjamin
      ////////////////////////////////////////////////////////////
      $pdf->SetXY($margin_X + 60, $margin_Y - 10);
      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFont( 'Arial', '', 10 );
      $pdf->Cell(60,10, 'Laporan Data Penjamin', 'B',1, 'R');


      $pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
      $pdf->ln(5);

      $pdf->SetFont( 'Arial', '', 10 );
      $pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
      $pdf->SetFillColor( 118, 120, 122 );
      $pdf->SetX($margin_X + 30);
      $pdf->Cell( 90, 6, " Penjamin", 1, 1, 'C', true );

      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFillColor( 255, 255, 255 );
      $data = $laporan_statistik['data_penjamin'];
      $keys = array_keys((array)$data);
      
      for ($i=0; $i < count($keys); $i++) { 
        $pdf->SetX($margin_X + 30);
        $pdf->Cell( 70, 6,  $keys[$i], 'B', 0, 'L', true );
        $pdf->Cell( 15, 6, $data[$keys[$i]], 'B', 1, 'R', true );
      }
      $margin_Y = $pdf->GetY();
      $pdf->ln(5);
      // End Tabel Penjamin

      // Start Tabel Bagian Data Dokter
      ////////////////////////////////////////////////////////////
      $pdf->SetX($margin_X + 60);
      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFont( 'Arial', '', 10 );
      $pdf->Cell(60,6, 'Laporan Data Dokter', 'B',1, 'R');

      $pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
      $pdf->ln(5);

      $pdf->SetX($margin_X + 30);
      $pdf->SetFont( 'Arial', '', 10 );
      $pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
      $pdf->SetFillColor( 118, 120, 122 );
      $pdf->Cell( 90, 6, " Dokter", 1, 1, 'C', true );
      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFillColor( 255, 255, 255 );

      $data = $laporan_statistik['data_dokter'];
      $keys = array_keys((array)$data);
        
      for ($i=0; $i < count($keys); $i++) { 
            $pdf->SetX($margin_X + 30);
            $pdf->Cell( 70, 6,  $keys[$i], 'B', 0, 'L', true );
            $pdf->Cell( 15, 6, $data[$keys[$i]], 'B', 1, 'R', true );
        }

      $pdf->ln(10);
      // End Tabel Dokter


      // Start Tabel Bagian Data Status Pasien
      ////////////////////////////////////////////////////////////
      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFont( 'Arial', '', 14 );
      $pdf->Cell(70,12, 'Laporan Status Pasien', 'B',1);
      $y = $pdf->GetY();
      $pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
      $pdf->ln(5);

      
      $pdf->SetFont( 'Arial', '', 12 );
      $pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
      $pdf->SetFillColor( 118, 120, 122 );
      $pdf->Cell( 90, 10, " Pasien Lama / Baru", 1, 1, 'C', true );
      $y1 = $pdf->GetY();

      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFillColor( 255, 255, 255 );
      $data = $laporan_statistik['data_status_pasien'];
      $keys = array_keys((array)$data);
      
      $pdf->Cell( 55, 10,  'Pasien lama', 'B', 0, 'L', true );
      $pdf->Cell( 35, 10, $data['lama'], 'B', 1, 'R', true );
      $y2 = $pdf->GetY();
      $x2 = $pdf->GetX();


      $pdf->Cell( 55, 10,  'Pasien Baru', 'B', 0, 'L', true );
      $pdf->Cell( 35, 10, $data['baru'], 'B', 1, 'R', true );
      $y3 = $pdf->GetY();
      $x3 = $pdf->GetX();
      //End Status Pasien


      // Start Tabel Bagian Data JK Pasien
      ////////////////////////////////////////////////////////////
      $data = $laporan_statistik['data_kelamin'];

      $pdf->SetY($y - 12);
      $x1 = $pdf->SetX($x + 90);
      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFont( 'Arial', '', 14 );
      $pdf->Cell(70,12, 'Laporan JK Pasien', 'B',1, 'R');

      $pdf->SetXY($x1 - 100, $y1 - 10);

      $pdf->SetFont( 'Arial', '', 12 );
      $pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
      $pdf->SetFillColor( 118, 120, 122 );
      $pdf->Cell( 90, 10, " Pasien Laki-Laki / Perempuan", 1, 1, 'C', true );

      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFillColor( 255, 255, 255 );
      
      $pdf->SetXY($x2 - 110, $y2 - 10);
      $pdf->Cell( 55, 10,  'Laki-Laki', 'B', 0, 'L', true );
      $pdf->Cell( 35, 10, $data['pria'], 'B', 1, 'R', true );

      $pdf->SetY($y3 - 10);
      $pdf->SetX($x3 - 110);
      $pdf->Cell( 55, 10,  'Perempuan', 'B', 0, 'L', true );
      $pdf->Cell( 35, 10, $data['wanita'], 'B', 1, 'R', true );
      $pdf->ln(10);
      // End Tabel JK Pasien
      

      $pdf->AddPage();

      // Start Tabel Bagian Data Lokasi Geolocation
      ////////////////////////////////////////////////////////////

      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFont( 'Arial', '', 14 );
      $pdf->Cell(100,12, 'Laporan Data Lokasi', 'B',1);

      $pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
      $pdf->ln(5);

      $pdf->SetFont( 'Arial', '', 10 );
      $pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
      $pdf->SetFillColor( 118, 120, 122 );
      $pdf->Cell( 185, 10, " Geolocation ", 1, 1, 'C', true );
      $pdf->Cell( 105, 10, " Kecamatan", 1, 0, 'L', true );
      $pdf->Cell( 20, 10, 'L', 1, 0, 'C', true );
      $pdf->Cell( 20, 10, 'P', 1, 0, 'C', true );
      $pdf->Cell( 40, 10, 'Total', 1, 1, 'C', true );

      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFillColor( 255, 255, 255 );
      $data = $laporan_statistik['data_lokasi'];
      
      $keys = array_keys((array)$data);
      
      for ($i=0; $i < count($keys); $i++) { 
        $pdf->Cell( 105, 10,  $keys[$i], 'B', 0, 'L', true );
        $pdf->Cell( 20, 10, $data[$keys[$i]]['pria'], 'B', 0, 'C', true );
        $pdf->Cell( 20, 10, $data[$keys[$i]]['wanita'], 'B', 0, 'C', true );
        $pdf->Cell( 40, 10, $data[$keys[$i]]['pria'] + $data[$keys[$i]]['wanita'], 'B', 1, 'C', true );
      }
      // End Tabel Bagian Geolocation

      $pdf->AddPage();

      // Start Tabel Bagian Data Lokasi Geolocation
      ////////////////////////////////////////////////////////////

      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFont( 'Arial', '', 14 );
      $pdf->Cell(100,12, 'Laporan Data ICD10', 'B',1);

      $pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
      $pdf->ln(5);

      $pdf->SetFont( 'Arial', '', 10 );
      $pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
      $pdf->SetFillColor( 118, 120, 122 );
      $pdf->Cell( 20, 7, " ICD10", 1, 0, 'C', true );
      $pdf->Cell( 125, 7, 'Deskripsi', 1, 0, 'C', true );
      $pdf->Cell( 40, 7, 'Total', 1, 1, 'C', true );

      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFillColor( 255, 255, 255 );

      $data = $laporan_icd10;
      
      $keys = array_keys((array)$data);
      
      for ($i=0; $i < count($keys); $i++) { 
        if (isset($data[$keys[$i]]['primary']) && isset($data[$keys[$i]]['secondary'])){
            $type = 'primary';
            $total_icd10 = $data[$keys[$i]]['primary']['total']['pria'] + $data[$keys[$i]]['primary']['total']['wanita'];
            $total_icd10 += $data[$keys[$i]]['secondary']['total']['pria'] + $data[$keys[$i]]['secondary']['total']['wanita'];
          }elseif (isset($data[$keys[$i]]['secondary'])) {
            $type = 'secondary';
            $total_icd10 = $data[$keys[$i]][$type]['total']['pria'] + $data[$keys[$i]][$type]['total']['wanita'];
          }else{
            $type = 'primary';
            $total_icd10 = $data[$keys[$i]][$type]['total']['pria'] + $data[$keys[$i]][$type]['total']['wanita'];
          }

          $pdf->Cell( 20, 7,  $keys[$i], 'B', 0, 'L', true );
          $pdf->Cell( 125, 7, $data[$keys[$i]][$type]['deskripsi'], 'B', 0, 'L', true );
          $pdf->Cell( 40, 7, $total_icd10, 'B', 1, 'C', true );
      }

      $pdf->ln(15);
      

      // for ($i=1; $i <= $max_col; $i++) { 
      // $pdf->Cell( 60, 10,  'Dokter '.$i, 'B', 0, 'L', true );
      // if ($max_col == 22) {
      //   $x = $pdf->GetX();
      // }
      // $pdf->Cell( 30, 10, $i, 'B', 1, 'R', true );
      // $default_margin_X = 35;
      // $pdf->SetXY($x + $default_margin_X, $y);
      // for ($i=$max_col+1; $i <= $max_col + $max_col; $i++) { 
      //   $pdf->Cell( 60, 10,  'Dokter '.$i, 'B', 0, 'L', true );
      //   $pdf->Cell( 30, 10, $i, 'B', 1, 'R', true );
      //   $y = $pdf->GetY();
      //   $pdf->SetXY($x + $default_margin_X, $y);
      // }

      $pdf->Output('',$name);
  }

  // Export ke excel
  function export()
  { 

      $rs_key = $this->session->userdata('rs_key');

      $response_prop_clinic     = $this->_client_rs->request('GET', 'clinic_profile', [
        'query' => ['rs_key' => $rs_key]
      ]);
      $prop_clinic = json_decode($response_prop_clinic->getBody()->getContents(), true);
      $clinic_profile = $prop_clinic['data'];

      // form header
      $id_form = $this->id_ref_global_tipe_42;

      $form = $this->_client_ref->request('GET', 'form', [
        'query' => ['id' => $id_form]
      ]);

      $form = json_decode($form->getbody()->getcontents(), true);
      $form = $form['data'];

      $no_rm = $this->session->userdata('no_rm');

      $tgl_start = '2019-01-06';
      $tgl_end = '2020-04-16';

      $response_pasien_reg = $this->_client_laporan->request('GET', 'statistik/registrasi', [
        'query' => [
          'type_tgl' => 'checkin',
          'tgl_start'  => $tgl_start,
          'tgl_end' => $tgl_end
        ]
      ]);

      $response['laporan_statistik'] = json_decode($response_pasien_reg->getBody()->getContents(), true)['data'];

      $response_laporan_icd10 = $this->_client_laporan->request('GET', 'statistik/icd10', [
        'query' => [
          'type_tgl' => 'checkin',
          'tgl_start'  => '2019-01-02',
          'tgl_end' => '2020-03-01'
        ]
      ]);

      $response['laporan_icd10'] = json_decode($response_laporan_icd10->getBody()->getContents(), true)['data'];

      $laporan_statistik = $response['laporan_statistik'];
      $laporan_icd10 = $response['laporan_icd10'];

      $title  = $form['nama_form']; // title pdf
      $kode   = $form['kode_form']; // kode form
      $name   = $form['pdf_file_name'] . date("Ymd") . '.pdf'; // nama form


      // Start Excel Code
      // Create new Spreadsheet
      /////////////////////////////////////////////
      $spreadsheet = new Spreadsheet();

      $sheetLocation = $spreadsheet->createSheet();
      $sheetLocation->setTitle('Data Geolocation');

      $sheetIcd10 = $spreadsheet->createSheet();
      $sheetIcd10->setTitle('Data ICD10');

      $sheet = $spreadsheet->getActiveSheet();
      $sheet->setTitle('Data Statistik');

      $horizontal_center = \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER;
      $vertical_center = \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER;

      $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
      $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

      $titleStyle = array(        
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'rotation' => 90,
            'startColor' => [
                'argb' => 'c5d9f1',
            ],
        ],
      );
      $subTitleStyle = array(
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'rotation' => 90,
            'startColor' => [
                'argb' => 'f2f2f2',
            ],
        ],
      );

      $rowHeaderStyle = array(
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => 'eeece1'],
            ],

        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'rotation' => 90,
            'startColor' => [
                'argb' => 'd9d9d9',
            ],
        ],
      );

      $rowStyle = array(
        'borders' => [
            'bottom' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => 'a6a6a6'],
            ],

        ],
      );


      $sheet->mergeCells('A2:N3');
      $sheet->getStyle('A2:N3')->applyFromArray($titleStyle);
      $sheet->getStyle('A2')->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('A2')->getAlignment()->setVertical($vertical_center);
      $sheet->setCellValue('A2', $title);

      $sheet->mergeCells('A4:N4');
      $sheet->getStyle('A4:N4')->applyFromArray($subTitleStyle);
      $sheet->getStyle('A4')->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('A4')->getAlignment()->setVertical($vertical_center);
      $sheet->setCellValue('A4', date('d-M-Y',  strtotime($tgl_start)) .' - '.date('d-M-Y',  strtotime($tgl_end)));

      $cell = 6; //Mulai Bagian Body Laporan
      $start_cell = $cell;
      // Menampilkan data Umur
      
      $sheet->getStyle('A'.$cell.':E'.$cell)->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('A'.$cell.':E'.$cell)->getAlignment()->setVertical($vertical_center);
      $sheet->getStyle('A'.$cell.':E'.$cell)->applyFromArray($rowHeaderStyle);
      $sheet->mergeCells('A'.$cell.':B'.$cell);
      $sheet->setCellValue('A'.$cell, 'Pasien - Umur');
      $sheet->getColumnDimension('B')->setWidth(15);
      $sheet->setCellValue('C'.$cell, 'L');
      $sheet->setCellValue('D'.$cell, 'P');
      $sheet->setCellValue('E'.$cell, 'Total');
      
      $data = $laporan_statistik['data_umur'];
      $keys = array_keys((array)$data);
      
      for ($i=0; $i < count($keys); $i++) { 
        $sheet->getStyle('A'.($i + $cell + 1).':E'.($i + $cell + 1))->applyFromArray($rowStyle);
        $sheet->mergeCells('A'.($i + $cell + 1).':B'.($i + $cell + 1));
        $sheet->setCellValue('A'. ($i + $cell + 1), $keys[$i]);
        $sheet->setCellValue('C'. ($i + $cell + 1), $data[$keys[$i]]['pria']);
        $sheet->setCellValue('D'. ($i + $cell + 1), $data[$keys[$i]]['wanita']);
        $sheet->setCellValue('E'. ($i + $cell + 1), '=SUM('.$data[$keys[$i]]['pria'].'+'.$data[$keys[$i]]['wanita'].')');
      }
      $sheet->mergeCells('A'.($i + $cell + 1).':E'.($i + $cell + 1));

      $sheet->getColumnDimension('F')->setWidth(5);
      $sheet->getColumnDimension('K')->setWidth(5);
      $sheet->getRowDimension('6')->setRowHeight(21);


      ///////////////////////////////////////////////////////////
      //                                                       //
      //                    Sheet sheetIcd10                   //
      //                                                       //
      ///////////////////////////////////////////////////////////

      // Menampilkan data ICD10
      $cell = $start_cell; // mereset nilai cell

      $sheet->getStyle('G'.$cell.':J'.$cell)->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('G'.$cell.':J'.$cell)->getAlignment()->setVertical($vertical_center);
      $sheet->getStyle('G'.$cell.':J'.$cell)->applyFromArray($rowHeaderStyle);
      $sheet->getColumnDimension('G')->setWidth(10);
      $sheet->setCellValue('G'.$cell, 'ICD10');
      $sheet->mergeCells('H'.$cell.':I'.$cell);
      $sheet->setCellValue('H'.$cell, 'Deskripsi');
      $sheet->setCellValue('J'.$cell, 'Total');


      $data = $laporan_icd10;
      $keys = array_keys((array)$data);

      $sheet->getColumnDimension('H')->setWidth(45);
      for ($i=0; $i < count($keys); $i++) {
        if (isset($data[$keys[$i]]['primary']) && isset($data[$keys[$i]]['secondary'])) 
          {
            $type = 'primary';
            $total_icd10 = $data[$keys[$i]]['primary']['total']['pria'] + $data[$keys[$i]]['primary']['total']['wanita'];
            $total_icd10 += $data[$keys[$i]]['secondary']['total']['pria'] + $data[$keys[$i]]['secondary']['total']['wanita'];
          }elseif (isset($data[$keys[$i]]['secondary'])) {
            $type = 'secondary';
            $total_icd10 = $data[$keys[$i]][$type]['total']['pria'] + $data[$keys[$i]][$type]['total']['wanita'];
          }else{
            $type = 'primary';
            $total_icd10 = $data[$keys[$i]][$type]['total']['pria'] + $data[$keys[$i]][$type]['total']['wanita'];
          }

        $sheet->getStyle('G'.($i + $cell + 1).':J'.($i + $cell + 1))->applyFromArray($rowStyle); 
        $sheet->mergeCells('H'.($i + $cell + 1).':I'.($i + $cell + 1));
        $sheet->setCellValue('G'. ($i + $cell + 1), $keys[$i]);
        $sheet->setCellValue('H'. ($i + $cell + 1), $data[$keys[$i]][$type]['deskripsi']);
        $sheet->setCellValue('J'. ($i + $cell + 1), $total_icd10);
      }

      ////////////////////////////////////////////////////
      //                                                //
      //         Menampilkan data status pasien         //
      //                                                //
      ////////////////////////////////////////////////////
      $sheet->mergeCells('L'.$cell.':N'.$cell);
      $sheet->getStyle('L'.$cell.':N'.$cell)->applyFromArray($rowHeaderStyle);
      $sheet->getStyle('L'.$cell)->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('L'.$cell)->getAlignment()->setVertical($vertical_center);
      $sheet->setCellValue('L'.$cell, 'Pasien Lama / Baru');
      
      $data = $laporan_statistik['data_status_pasien'];
      $total_pasien = $data['lama'] + $data['baru'];
      
      ++$cell; 
      $sheet->getStyle('L'.$cell.':N'.$cell)->applyFromArray($rowStyle);
      $sheet->mergeCells('L'.$cell.':M'.$cell);
      $sheet->setCellValue('L'.$cell, 'Pasien Lama');
      $sheet->setCellValue('N'.$cell, $data['lama']);
      
      ++$cell; 
      $sheet->getStyle('L'.$cell.':N'.$cell)->applyFromArray($rowStyle);
      $sheet->mergeCells('L'.$cell.':M'.$cell);
      $sheet->setCellValue('L'.$cell, 'Pasien Baru');
      $sheet->setCellValue('N'.$cell, $data['baru']);
      $sheet->mergeCells('L'.( $cell + 1).':N'.($cell + 1));

      ////////////////////////////////////////////////////
      //                                                //
      //     Menampilkan data Jenis Kelamin pasien      //
      //                                                //
      ////////////////////////////////////////////////////
      ++$cell; ++$cell; // Cell jadi = 10
      $sheet->mergeCells('L'.$cell.':N'.$cell);
      $sheet->getStyle('L'.$cell.':N'.$cell)->applyFromArray($rowHeaderStyle);
      $sheet->getStyle('L'.$cell)->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('L'.$cell)->getAlignment()->setVertical($vertical_center);
      $sheet->setCellValue('L'.$cell, 'Pasien Laki-Laki / Perempuan');
      
      $data = $laporan_statistik['data_kelamin'];
      
      ++$cell; // Cell jadi = 11
      $sheet->getStyle('L'.$cell.':N'.$cell)->applyFromArray($rowStyle);
      $sheet->mergeCells('L'.$cell.':M'.$cell);
      $sheet->setCellValue('L'.$cell, 'Laki-Laki');
      $sheet->setCellValue('N'.$cell, $data['pria']);
      
      ++$cell; // Cell jadi = 12
      $sheet->getStyle('L'.$cell.':N'.$cell)->applyFromArray($rowStyle);
      $sheet->mergeCells('L'.$cell.':M'.$cell);
      $sheet->setCellValue('L'.$cell, 'Perempuan');
      $sheet->setCellValue('N'.$cell, $data['wanita']);
      $sheet->mergeCells('L'.( $cell + 1).':N'.($cell + 1));


      ////////////////////////////////////////////////////
      //                                                //
      //        Menampilkan data Total pasien           //
      //                                                //
      ////////////////////////////////////////////////////
      ++$cell; ++$cell; // Cell jadi = 14
      $sheet->mergeCells('L'.$cell.':N'.$cell);
      $sheet->getStyle('L'.$cell.':N'.$cell)->applyFromArray($rowHeaderStyle);
      $sheet->getStyle('L'.$cell)->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('L'.$cell)->getAlignment()->setVertical($vertical_center);
      $sheet->setCellValue('L'.$cell, 'Pasien Total');
      
      ++$cell; // Cell jadi = 15
      $sheet->getStyle('L'.$cell.':N'.$cell)->applyFromArray($rowStyle);
      $sheet->mergeCells('L'.$cell.':M'.$cell);
      $sheet->setCellValue('L'.$cell, 'Total Pasien');
      $sheet->setCellValue('N'.$cell, $total_pasien);
      $sheet->mergeCells('L'.( $cell + 1).':N'.($cell + 1));

      
      ////////////////////////////////////////////////////
      //                                                //
      //       Menampilkan data Penjamin Pasien         //
      //                                                //
      ////////////////////////////////////////////////////
      ++$cell; ++$cell;
      $sheet->mergeCells('L'.$cell.':N'.$cell);
      $sheet->getStyle('L'.$cell.':N'.$cell)->applyFromArray($rowHeaderStyle);
      $sheet->getStyle('L'.$cell)->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('L'.$cell)->getAlignment()->setVertical($vertical_center);
      $sheet->setCellValue('L'.$cell, 'Penjamin Pasien');

      $data = $laporan_statistik['data_penjamin'];
      $keys = array_keys((array)$data);
      
      for ($i=0; $i < count($keys); $i++) { 
        $sheet->getStyle('L'.($i + $cell + 1).':N'.($i + $cell + 1))->applyFromArray($rowStyle);
        $sheet->mergeCells('L'.($i + $cell + 1).':M'.($i + $cell + 1));
        $sheet->setCellValue('L'. ($i + $cell + 1), $keys[$i]);

        $sheet->setCellValue('N'. ($i + $cell + 1), $data[$keys[$i]]);
      }
      $cell += $i;

      ////////////////////////////////////////////////////
      //                                                //
      //            Menampilkan data Dokter             //
      //                                                //
      ////////////////////////////////////////////////////
      ++$cell; ++$cell;
      $sheet->mergeCells('L'.$cell.':N'.$cell);
      $sheet->getStyle('L'.$cell.':N'.$cell)->applyFromArray($rowHeaderStyle);
      $sheetLocation->getColumnDimension('L')->setWidth(27);
      $sheet->getStyle('L'.$cell)->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('L'.$cell)->getAlignment()->setVertical($vertical_center);
      $sheet->setCellValue('L'.$cell, 'Dokter');

      $data = $laporan_statistik['data_dokter'];
      $keys = array_keys((array)$data);
      
      for ($i=0; $i < count($keys); $i++) {
        $sheet->getStyle('L'.($i + $cell + 1).':N'.($i + $cell + 1))->applyFromArray($rowStyle); 
        $sheet->mergeCells('L'.($i + $cell + 1).':M'.($i + $cell + 1));
        $sheet->setCellValue('L'. ($i + $cell + 1), $keys[$i]);

        $sheet->setCellValue('N'. ($i + $cell + 1), $data[$keys[$i]]);
      }


      //////////////////////////////////////////////////////////
      //                                                      //
      //                    Sheet Geolocation                 //
      //                                                      //
      //////////////////////////////////////////////////////////
      $cell = 17;
      
      $sheet->getStyle('A'.$cell.':E'.($cell+1))->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('A'.$cell.':E'.($cell+1))->getAlignment()->setVertical($vertical_center);
      $sheet->mergeCells('A'.$cell.':E'.$cell);
      $sheet->getRowDimension($cell)->setRowHeight(21);
      $sheet->getStyle('A'.$cell.':E'.($cell+1))->applyFromArray($rowHeaderStyle);
      $sheet->setCellValue('A'.$cell, 'Data Geolocation');

      ++$cell;
      $sheet->mergeCells('A'.$cell.':B'.$cell);
      $sheet->setCellValue('A'.$cell, 'Kecamatan');
      $sheet->getColumnDimension('A')->setWidth(25);
      $sheet->setCellValue('C'.$cell, 'L');
      $sheet->setCellValue('D'.$cell, 'P');
      $sheet->setCellValue('E'.$cell, 'Total');


      $data = $laporan_statistik['data_lokasi'];
      $keys = array_keys((array)$data);
      for ($i=0; $i < count($keys); $i++) { 
        $sheet->getStyle('A'.($i + $cell + 1).':E'.($i + $cell + 1))->applyFromArray($rowStyle); 
        $sheet->mergeCells('A'.($i + $cell + 1).':B'.($i + $cell + 1));
        $sheet->setCellValue('A'. ($i + $cell + 1), $keys[$i]);
        $sheet->setCellValue('C'. ($i + $cell + 1), $data[$keys[$i]]['pria']);
        $sheet->setCellValue('D'. ($i + $cell + 1), $data[$keys[$i]]['wanita']);
        $sheet->setCellValue('E'. ($i + $cell + 1), '=SUM('.$data[$keys[$i]]['pria'].'+'.$data[$keys[$i]]['wanita'].')');
      }




      $spreadsheet->setActiveSheetIndex(0);;
      $writer = new Xlsx($spreadsheet);
      
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'. $title .'.xlsx"'); 
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
  }

}
