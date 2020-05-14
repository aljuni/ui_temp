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
 * Menampilkan halaman client/laporan_icd10
 * 
 **********************************************************************************/
class C_laporan_icd10 extends CI_Controller
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
    $this->id_ref_global_tipe_42 = 502;
    
    $this->title = "Laporan ICD 10";
    // guzzle client
    
    $this->_client_ref = new Client([
      'base_uri'  => $this->config->item('api_ref'),
      'headers'   => [
        'Content-Type' => 'application/json',
        'x-token' => $token
      ]
    ]);

    $this->_client_rs = new Client([
      'base_uri'  => $this->config->item('api_rs'),
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
    $this->c_folder = "C_laporan_icd10"; // <<< HANYA INI YANG PERLU DIRUBAH DI CONSTRUCT()!!!! SISANYA DIAMKAN

    //menghilangkan 'C_' pada nama class untuk dinamisasi routing;
    $this->class = str_replace("c_", "", $this->router->fetch_class());

    //dummy id departemen
    $this->id_dept = 3;

    // untuk menyimpan data ke /tmp untuk ditampilkan di cetak
    $this->folder = $this->config->item('tmp_folder');
  }

  // redirect ke fungsi list
  public function index()
  // $route['laporan_icd10'] = 'laporan_icd10/c_laporan_icd10';
  {
    // echo base_url(); die;
    redirect(base_url() . $this->class . '/list');
  }


  // Menampilkan tampilan aktif dan arsip
  public function list()
  {
    $data = array(
      'title'   => 'Laporan ICD10',
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
      $response_pasien_reg = $this->_client_laporan->request('GET', 'statistik/icd10', [
        'query' => [
          'type_tgl' => 'checkin',
          'tgl_start'  => '2019-01-02',
          'tgl_end' => '2020-03-01'
        ]
      ]);

       $data['laporan_icd10'] = json_decode($response_pasien_reg->getBody()->getContents(), true)['data'];

      $this->load->view('contents/laporan/' . $this->class . '/list',$data);
  }

function print_pdf(){

// Export ke pdf
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

      //aktif
     $response_pasien_reg = $this->_client_laporan->request('GET', 'statistik/icd10', [
        'query' => [
          'type_tgl' => 'checkin',
          'tgl_start'  => '2019-01-02',
          'tgl_end' => '2020-03-01'
        ]
      ]);

      $response['laporan_icd10'] = json_decode($response_pasien_reg->getBody()->getContents(), true)['data'];
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

      $pdf->SetFont( 'Arial', 'B', 20 );
      $pdf->Cell(30,27, $kode, 1,1, 'C');
      $pdf->SetY(25);
      $pdf->SetX($x);

      $pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
      $pdf->SetFont( 'Arial', '', 14 );
      // $pdf->Cell(130,12, $clinic_profile['clinic_name'], 1,1);
      $pdf->Cell(130,12, ' Klinik Bahagia', 1,1);
      $pdf->ln(10);

      ////////////////////////////////////////
      // START Body PDF
      ///////////////////////////////////////

      // Start Tabel Bagian ICD10
      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFont( 'Arial', '', 14 );
      $pdf->Cell(100,12, 'Laporan ICD10', 'B',1);

      $pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
      $pdf->ln(5);

      $pdf->SetFont( 'Arial', 'B', 9 );
      $pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
      $pdf->SetFillColor( 118, 120, 122 );
      $pdf->Cell( 10, 10, " #", 1, 0, 'C', true );
      $pdf->Cell( 20, 10, 'Kode ICD', 1, 0, 'C', true );
      $pdf->Cell( 68, 10, 'Deskripsi', 1, 0, 'C', true );
      $pdf->Cell( 30, 10, 'Total Pria', 1, 0, 'C', true );
      $pdf->Cell( 30, 10, 'Total Wanita', 1, 0, 'C', true );
      $pdf->Cell( 30, 10, 'Total Pasien', 1, 1, 'C', true );

      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFillColor( 255, 255, 255 );
      $data = $laporan_icd10;
      $keys = array_keys((array)$data);
      $tipe = '';
      $no = 1;

      for ($i=0; $i < count($keys); $i++) { 
       
        $total = 0;
        if (isset($data[$keys[$i]]['primary'])) {
          $tipe = 'primary';
        } else {
          $tipe = 'secondary';
        } 
        if (isset($data[$keys[$i]]['primary']) && isset($data[$keys[$i]]['secondary'])) {
            $total_pria = $data[$keys[$i]]['primary']['total']['pria'] + $data[$keys[$i]]['secondary']['total']['pria'];
            $total_wanita = $data[$keys[$i]]['primary']['total']['wanita'] + $data[$keys[$i]]['secondary']['total']['wanita'];
        } elseif(isset($data[$keys[$i]]['primary'])) {
            $total_pria = $data[$keys[$i]]['primary']['total']['pria'];
            $total_wanita = $data[$keys[$i]]['primary']['total']['wanita'];
        }else {
            $total_pria = $data[$keys[$i]]['secondary']['total']['pria'];
            $total_wanita = $data[$keys[$i]]['secondary']['total']['wanita'];
        }
  
        $pdf->Cell( 10, 10, $no++ , 'B', 0, 'C', true );
        $pdf->Cell( 20, 10,  $keys[$i], 'B', 0, 'C', true );
        $pdf->Cell( 68, 10, $data[$keys[$i]][$tipe]['deskripsi'], 'B', 0, 'L', true );
        $pdf->Cell( 30, 10, $total_pria, 'B', 0, 'C', true );
        $pdf->Cell( 30, 10, $total_wanita, 'B', 0, 'C', true );
        $pdf->Cell( 30, 10, $total_pria+=$total_wanita, 'B', 1, 'C', true );
      }
          $pdf->ln(10);
      // End Tabel Bagian Data ICD10
           
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

      $tgl_start = '2019-01-02';
      $tgl_end = '2020-03-01';

      $response_pasien_reg = $this->_client_laporan->request('GET', 'statistik/icd10', [
        'query' => [
          'type_tgl' => 'checkin',
          'tgl_start'  => $tgl_start,
          'tgl_end' => $tgl_end
        ]
      ]);
     //aktif
     $response_pasien_reg = $this->_client_laporan->request('GET', 'statistik/icd10', [
        'query' => [
          'type_tgl' => 'checkin',
          'tgl_start'  => '2019-01-02',
          'tgl_end' => '2020-03-01'
        ]
      ]);


      $response['laporan_icd10'] = json_decode($response_pasien_reg->getBody()->getContents(), true)['data'];
      $laporan_icd10 = $response['laporan_icd10'];

      $title  = $form['nama_form']; // title pdf
      $kode   = $form['kode_form']; // kode form
      $name   = $form['pdf_file_name'] . date("Ymd") . '.pdf'; // nama form
     

      // Start Excel Code
      // Create new Spreadsheet
      /////////////////////////////////////////////
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
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
                'color' => ['argb' => 'dbdbdb'],
            ],
        ],
      );

      $sheet->mergeCells('B1:G3');
      $sheet->getStyle('B1:G3')->applyFromArray($titleStyle);
      $sheet->getStyle('B1')->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('B1')->getAlignment()->setVertical($vertical_center);
      $sheet->setCellValue('B1', $title);

      $sheet->mergeCells('B4:G4');
      $sheet->getStyle('B4:G4')->applyFromArray($subTitleStyle);
      $sheet->getStyle('B4')->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('B4')->getAlignment()->setVertical($vertical_center);
      $sheet->setCellValue('B4', date('d-M-Y',  strtotime($tgl_start)) .' - '.date('d-M-Y',  strtotime($tgl_end)));

      $cell = 6;
      // Menampilkan data Umur
      $spreadsheet->getActiveSheet()->setAutoFilter('B'.$cell.':G'.$cell);
      $sheet->getStyle('B'.$cell.':G'.$cell)->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('B'.$cell.':G'.$cell)->getAlignment()->setVertical($vertical_center);
      $sheet->getStyle('B'.$cell.':G'.$cell)->applyFromArray($rowHeaderStyle);
      $sheet->getStyle('B'.$cell.':G'.$cell)->getFont()->setSize(9);
      $sheet->setCellValue('B'.$cell, '#');
      $sheet->setCellValue('C'.$cell, 'Kode ICD');
      $sheet->setCellValue('D'.$cell, 'Deskripsi');
      $sheet->setCellValue('E'.$cell, 'Total Pria');
      $sheet->setCellValue('F'.$cell, 'Total Wanita');
      $sheet->setCellValue('G'.$cell, 'Total Pasien');

      
      $data = $laporan_icd10;
      $keys = array_keys((array)$data);
      $tipe = '';
      $no = 1;

      for ($i=0; $i < count($keys); $i++) { 
       
        $total = 0;
        if (isset($data[$keys[$i]]['primary'])) {
          $tipe = 'primary';
        } else {
          $tipe = 'secondary';
        } 
        if (isset($data[$keys[$i]]['primary']) && isset($data[$keys[$i]]['secondary'])) {
            $total_pria = $data[$keys[$i]]['primary']['total']['pria'] + $data[$keys[$i]]['secondary']['total']['pria'];
            $total_wanita = $data[$keys[$i]]['primary']['total']['wanita'] + $data[$keys[$i]]['secondary']['total']['wanita'];
        } elseif(isset($data[$keys[$i]]['primary'])) {
            $total_pria = $data[$keys[$i]]['primary']['total']['pria'];
            $total_wanita = $data[$keys[$i]]['primary']['total']['wanita'];
        }else {
            $total_pria = $data[$keys[$i]]['secondary']['total']['pria'];
            $total_wanita = $data[$keys[$i]]['secondary']['total']['wanita'];
        }
        
        $sheet->getStyle('B6:C73')->getAlignment()->setHorizontal($horizontal_center);
        $sheet->getStyle('B6:C73')->getAlignment()->setVertical($vertical_center);
        $sheet->getStyle('E6:G73')->getAlignment()->setHorizontal($horizontal_center);
        $sheet->getStyle('E6:G73')->getAlignment()->setVertical($vertical_center);
        $sheet->getStyle('B'. ($i + 7).':'.'G'. ($i + 7))->applyFromArray($rowStyle);
        $sheet->getStyle('B'. ($i + 7).':'.'G'. ($i + 7))->getFont()->setSize(8);
        $sheet->setCellValue('B'. ($i + 7), $no++);
        $sheet->setCellValue('C'. ($i + 7), $keys[$i]);
        $sheet->setCellValue('D'. ($i + 7), $data[$keys[$i]][$tipe]['deskripsi']);
        $sheet->setCellValue('E'. ($i + 7), $total_pria);
        $sheet->setCellValue('F'. ($i + 7), $total_wanita);
        $sheet->setCellValue('G'. ($i + 7), '=SUM('.$total_pria.'+'.$total_wanita.')');
      }

      $sheet->getColumnDimension('B')->setWidth(5);
      $sheet->getColumnDimension('C')->setWidth(10);
      $sheet->getColumnDimension('D')->setWidth(55);
      $sheet->getColumnDimension('E')->setWidth(10);
      $sheet->getColumnDimension('F')->setWidth(12);
      $sheet->getColumnDimension('G')->setWidth(11);
      $sheet->getRowDimension('6')->setRowHeight(21);
           
      $writer = new Xlsx($spreadsheet);
      
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'. $title .'.xlsx"'); 
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
  }

}

