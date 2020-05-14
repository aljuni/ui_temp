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
 * Menampilkan halaman client/laporan_pasien_meninggal
 * 
 **********************************************************************************/
class C_laporan_pasien_meninggal extends CI_Controller
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
    $this->id_ref_global_tipe_42 = 505;

    $this->title = "Laporan Pasien Meninggal";
    
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
    $this->c_folder = "C_laporan_pasien_meninggal"; // <<< HANYA INI YANG PERLU DIRUBAH DI CONSTRUCT()!!!! SISANYA DIAMKAN

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
      'title'   => 'Laporan Pasien Meninggal',
      'class_name' => $this->class,
    );

    $data['contents'] = 'contents/laporan/' . $this->class . '/index';
    $this->load->view('master', $data);

  }

  //mengambil data registrasi untuk di tampilkan
  function get_data()
  {

    $no_rm = $this->session->userdata('no_rm');

      // //aktif
      // $response_pasien_reg = $this->_client_laporan->request('GET', 'registrasi');
      // $data['laporan_icd9'] = json_decode($response_pasien_reg->getBody()->getContents(), true)['data'];

      // $user_id      = $this->session->userdata('id_user');
      // foreach (glob($this->folder . $user_id . '_' . $this->class . '*') as $f) {
      //   unlink($f);
      // }

    $this->load->view('contents/laporan/' . $this->class . '/list');
  }

  // Export ke pdf
  function print_pdf(){
    $pdf = new FPDF('l','mm','A5');
    $pdf->SetTitle($this->title);
      // membuat halaman baru
    $pdf->AddPage();
      // setting jenis font yang akan digunakan
    $pdf->SetFont('Arial','B',16);
      // mencetak string 
    $pdf->Cell(190,7,'test PDF '. $this->title,0,1,'C');
    $pdf->SetFont('Arial','B',12);
    // $pdf->Cell(190,7,'DAFTAR SISWA KELAS IX JURUSAN REKAYASA PERANGKAT LUNAK',0,1,'C');
      // Memberikan space kebawah agar tidak terlalu rapat
    $pdf->Cell(10,7,'',0,1);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,6,'NIM',1,0);
    $pdf->Cell(85,6,'NAMA MAHASISWA',1,0);
    $pdf->Cell(27,6,'NO HP',1,0);
    $pdf->Cell(25,6,'TANGGAL LHR',1,1);
    $pdf->SetFont('Arial','',10);

    $pdf->Cell(20,6,"coba",1,0);
    $pdf->Cell(85,6,"coba",1,0);
    $pdf->Cell(27,6,"coba",1,0);
    $pdf->Cell(25,6,"coba",1,1); 

    $pdf->Output();
  }

  // Export ke excel
  function export()
  {
    // Create new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Hello World !');

    $writer = new Xlsx($spreadsheet);
    
    $filename = 'Rekap ' .$this->title;
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

}
