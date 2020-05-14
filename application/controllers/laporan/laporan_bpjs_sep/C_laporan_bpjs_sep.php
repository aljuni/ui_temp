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
 * Menampilkan halaman client/laporan_bpjs_sep
 * 
 **********************************************************************************/
class C_laporan_bpjs_sep extends CI_Controller
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
    $this->id_ref_global_tipe_42 = 504;
    
    $this->title = "Laporan Vclaim Sep";
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
    $this->c_folder = "C_laporan_bpjs_sep"; // <<< HANYA INI YANG PERLU DIRUBAH DI CONSTRUCT()!!!! SISANYA DIAMKAN

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
      'title'   => 'Laporan Bpjs Sep',
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
      $response_pasien_reg = $this->_client_laporan->request('GET', 'laporan/vclaim',
        [
         'query' => [
          'type_tgl' => 'checkin',
          'tgl_start'  => '2020-04-01',
          'tgl_end' => '2020-04-01'
         ] 
        ]);

      $data['laporan_bpjs_sep'] = json_decode($response_pasien_reg->getBody()->getContents(), true)['data'];

     
      $this->load->view('contents/laporan/' . $this->class . '/list', $data);
      // echo trace($data);
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
  $response_pasien_reg = $this->_client_laporan->request('GET', 'laporan/vclaim',
        [
         'query' => [
          'type_tgl' => 'checkin',
          'tgl_start'  => '2020-04-01',
          'tgl_end' => '2020-04-01'
         ] 
        ]);

      $response['laporan_bpjs_sep'] = json_decode($response_pasien_reg->getBody()->getContents(), true)['data'];
      $laporan_bpjs_sep = $response['laporan_bpjs_sep'];

      $title  = $form['nama_form']; // title pdf
      $kode   = $form['kode_form']; // kode form
      $name   = $form['pdf_file_name'] . date("Ymd") . '.pdf'; // nama form
     


      $pdf = new FPDF('L','mm','A4');
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
      $pdf->Cell(100,12, 'Laporan BPJS SEP', 'B',1);

      $pdf->SetDrawColor( $tableBorderColour[0], $tableBorderColour[1], $tableBorderColour[2] );
      $pdf->ln(5);

      $pdf->SetFont( 'Arial', 'B', 9 );
      $pdf->SetTextColor( $tableHeaderTopTextColour[0], $tableHeaderTopTextColour[1], $tableHeaderTopTextColour[2] );
      $pdf->SetFillColor( 118, 120, 122 );
      $pdf->Cell( 10, 10, "No.", 1, 0, 'C', true );
      $pdf->Cell( 20, 10, 'Id Pasien Registrasi', 1, 0, 'C', true );
      $pdf->Cell( 20, 10, 'No. Kartu', 1, 0, 'C', true );
      $pdf->Cell( 20, 10, 'Nama', 1, 0, 'C', true );
      $pdf->Cell( 20, 10, 'Tgl. SEP', 1, 0, 'C', true );
      $pdf->Cell( 20, 10, 'Tgl. Pulang', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'No. SEP', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'PPK Pelayanan', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'Jns. Pelayanan', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'Kelas Rawat', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'Jns. Rawat', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'No. Mr', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'Asal Rujukan', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'Catatan', 1, 1, 'C', true ); 
      $pdf->Cell( 20, 10, 'Diagnosa Awal', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'Kode Diagnosa Awal', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'Poli Tujuan', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'No. Surat', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'Kode DPJP', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'Nama DPJP', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'Diinput Oleh', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'Tanggal Dibuat', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'Dihapus Oleh', 1, 1, 'C', true );
      $pdf->Cell( 20, 10, 'Petugas Pulang', 1, 1, 'C', true );

      $pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
      $pdf->SetFillColor( 255, 255, 255 );
      $data = $laporan_bpjs_sep;
      $keys = array_keys((array)$data);
      $tipe = '';
      $no = 1;

      // for ($i=0; $i < count($keys); $i++) { 
       
      //   $total = 0;
      //   if (isset($data[$keys[$i]]['primary'])) {
      //     $tipe = 'primary';
      //   } else {
      //     $tipe = 'secondary';
      //   } 
      //   if (isset($data[$keys[$i]]['primary']) && isset($data[$keys[$i]]['secondary'])) {
      //       $total_pria = $data[$keys[$i]]['primary']['total']['pria'] + $data[$keys[$i]]['secondary']['total']['pria'];
      //       $total_wanita = $data[$keys[$i]]['primary']['total']['wanita'] + $data[$keys[$i]]['secondary']['total']['wanita'];
      //   } elseif(isset($data[$keys[$i]]['primary'])) {
      //       $total_pria = $data[$keys[$i]]['primary']['total']['pria'];
      //       $total_wanita = $data[$keys[$i]]['primary']['total']['wanita'];
      //   }else {
      //       $total_pria = $data[$keys[$i]]['secondary']['total']['pria'];
      //       $total_wanita = $data[$keys[$i]]['secondary']['total']['wanita'];
      //   }
  
      //   $pdf->Cell( 10, 10, $no++ , 'B', 0, 'C', true );
      //   $pdf->Cell( 20, 10,  $keys[$i], 'B', 0, 'C', true );
      //   $pdf->Cell( 68, 10, $data[$keys[$i]][$tipe]['deskripsi'], 'B', 0, 'L', true );
      //   $pdf->Cell( 30, 10, $total_pria, 'B', 0, 'C', true );
      //   $pdf->Cell( 30, 10, $total_wanita, 'B', 0, 'C', true );
      //   $pdf->Cell( 30, 10, $total_pria+=$total_wanita, 'B', 1, 'C', true );
      // }
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

      $tgl_start = '2020-04-01';
      $tgl_end = '2020-04-01';

      $response_pasien_reg = $this->_client_laporan->request('GET', 'laporan/vclaim', [
        'query' => [
          'type_tgl' => 'checkin',
          'tgl_start'  => $tgl_start,
          'tgl_end' => $tgl_end
        ]
      ]);
     //aktif
     $response_pasien_reg = $this->_client_laporan->request('GET', 'laporan/vclaim',
        [
         'query' => [
          'type_tgl' => 'checkin',
          'tgl_start'  => '2020-04-01',
          'tgl_end' => '2020-04-01'
         ] 
        ]);


      $response['laporan_bpjs_sep'] = json_decode($response_pasien_reg->getBody()->getContents(), true)['data'];
      $laporan_bpjs_sep = $response['laporan_bpjs_sep'];

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

      $sheet->mergeCells('B1:AV3');
      $sheet->getStyle('B1:AV3')->applyFromArray($titleStyle);
      $sheet->getStyle('B1')->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('B1')->getAlignment()->setVertical($vertical_center);
      $sheet->setCellValue('B1', $title);

      $sheet->mergeCells('B4:AV4');
      $sheet->getStyle('B4:AV4')->applyFromArray($subTitleStyle);
      $sheet->getStyle('B4')->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('B4')->getAlignment()->setVertical($vertical_center);
      $sheet->setCellValue('B4', date('d-M-Y',  strtotime($tgl_start)) .' - '.date('d-M-Y',  strtotime($tgl_end)));

      $cell = 6;
      // Menampilkan data Umur
      $spreadsheet->getActiveSheet()->setAutoFilter('B'.$cell.':AV'.$cell);
      $sheet->getStyle('B'.$cell.':AV'.$cell)->getAlignment()->setHorizontal($horizontal_center);
      $sheet->getStyle('B'.$cell.':AV'.$cell)->getAlignment()->setVertical($vertical_center);
      $sheet->getStyle('B'.$cell.':AV'.$cell)->applyFromArray($rowHeaderStyle);
      $sheet->getStyle('B'.$cell.':AV'.$cell)->getFont()->setSize(9);
      $sheet->setCellValue('B'.$cell, 'No');
      $sheet->setCellValue('C'.$cell, 'Id Pasien Registrasi');
      $sheet->setCellValue('D'.$cell, 'No. Kartu');
      $sheet->setCellValue('E'.$cell, 'Nama');
      $sheet->setCellValue('F'.$cell, 'Tanggal SEP');
      $sheet->setCellValue('G'.$cell, 'Tanggal Pulang');
      $sheet->setCellValue('H'.$cell, 'No. SEP');
      $sheet->setCellValue('I'.$cell, 'PPK Pelayanan');
      $sheet->setCellValue('J'.$cell, 'Jenis Pelayanan');
      $sheet->setCellValue('K'.$cell, 'Kelas Rawat');
      $sheet->setCellValue('L'.$cell, 'Jenis Rawat');
      $sheet->setCellValue('M'.$cell, 'No. Mr');
      $sheet->setCellValue('N'.$cell, 'Asal Rujukan');
      $sheet->setCellValue('O'.$cell, 'Tanggal Rujukan');
      $sheet->setCellValue('P'.$cell, 'No. Rujukan');
      $sheet->setCellValue('Q'.$cell, 'No. Rujukan Keluar');
      $sheet->setCellValue('R'.$cell, 'Nama PPK Rujukan');
      $sheet->setCellValue('S'.$cell, 'PPK Rujukan');
      $sheet->setCellValue('T'.$cell, 'Catatan');
      $sheet->setCellValue('U'.$cell, 'Diagnosa Awal');
      $sheet->setCellValue('V'.$cell, 'Kode Diagnosa Awal');
      $sheet->setCellValue('W'.$cell, 'Poli Tujuan');
      $sheet->setCellValue('X'.$cell, 'Kode Poli Tujuan');
      $sheet->setCellValue('Y'.$cell, 'Eksekutif');
      $sheet->setCellValue('Z'.$cell, 'Cob');
      $sheet->setCellValue('AA'.$cell, 'Katarak');
      $sheet->setCellValue('AB'.$cell, 'Laka Lantas');
      $sheet->setCellValue('AC'.$cell, 'Lokasi Laka');
      $sheet->setCellValue('AD'.$cell, 'Penjamin');
      $sheet->setCellValue('AE'.$cell, 'Tanggal Kejadian');
      $sheet->setCellValue('AF'.$cell, 'Keterangan');
      $sheet->setCellValue('AG'.$cell, 'Suplesi');
      $sheet->setCellValue('AH'.$cell, 'No. SEP Suplesi');
      $sheet->setCellValue('AI'.$cell, 'Kode Propinsi');
      $sheet->setCellValue('AJ'.$cell, 'Kode Kabupaten');
      $sheet->setCellValue('AK'.$cell, 'Kode Kecamatan');
      $sheet->setCellValue('AL'.$cell, 'No. Surat');
      $sheet->setCellValue('AM'.$cell, 'Kode DPJP');
      $sheet->setCellValue('AN'.$cell, 'Nama DPJP');
      $sheet->setCellValue('AO'.$cell, 'Diinput Oleh');
      $sheet->setCellValue('AP'.$cell, 'Tanggal Dibuat');
      $sheet->setCellValue('AQ'.$cell, 'Dihapus Oleh');
      $sheet->setCellValue('AR'.$cell, 'Petugas Pulang');
      $sheet->setCellValue('AS'.$cell, 'No. Telpon');
      $sheet->setCellValue('AT'.$cell, 'User');
      $sheet->setCellValue('AU'.$cell, 'Vclaim Rujukan');
      $sheet->setCellValue('AV'.$cell, 'Ref ICD 10');

      
     
      $no = 1;
      $i = 0;
      foreach ($laporan_bpjs_sep as $data) {
        
        $sheet->getStyle('B6:C73')->getAlignment()->setHorizontal($horizontal_center);
        $sheet->getStyle('B6:C73')->getAlignment()->setVertical($vertical_center);
        $sheet->getStyle('E6:G73')->getAlignment()->setHorizontal($horizontal_center);
        $sheet->getStyle('E6:G73')->getAlignment()->setVertical($vertical_center);
        $sheet->getStyle('B'. ($i + 7).':'.'AV'. ($i + 7))->applyFromArray($rowStyle);
        $sheet->getStyle('B'. ($i + 7).':'.'AV'. ($i + 7))->getFont()->setSize(8);
        $sheet->setCellValue('B'. ($i + 7), $no++);
        $sheet->setCellValue('C'. ($i + 7), $data['id_pasien_registrasi']);
        $sheet->setCellValue('D'. ($i + 7), $data['noKartu']);
        $sheet->setCellValue('E'. ($i + 7), $data['nama']);
        $sheet->setCellValue('F'. ($i + 7), $data['tglSep']);
        $sheet->setCellValue('G'. ($i + 7), $data['tglPulang']);
        $sheet->setCellValue('H'. ($i + 7), $data['noSep']);
        $sheet->setCellValue('I'. ($i + 7), $data['ppkPelayanan']);
        $sheet->setCellValue('J'. ($i + 7), $data['jnsPelayanan']['nama_detail']);
        $sheet->setCellValue('K'. ($i + 7), $data['klsRawat']);
        $sheet->setCellValue('L'. ($i + 7), $data['jenis_rawat']['nama_detail']);
        $sheet->setCellValue('M'. ($i + 7), $data['noMr']);
        $sheet->setCellValue('N'. ($i + 7), $data['asalRujukan']['nama_detail']);
        $sheet->setCellValue('O'. ($i + 7), $data['tglRujukan']);
        $sheet->setCellValue('P'. ($i + 7), $data['noRujukan']);
        $sheet->setCellValue('Q'. ($i + 7), $data['noRujukanKeluar']);
        $sheet->setCellValue('R'. ($i + 7), $data['namaPpkRujukan']);
        $sheet->setCellValue('S'. ($i + 7), $data['ppkRujukan']);
        $sheet->setCellValue('T'. ($i + 7), $data['catatan']);
        $sheet->setCellValue('U'. ($i + 7), $data['diagAwal']);
        $sheet->setCellValue('V'. ($i + 7), $data['code_diagAwal']);
        $sheet->setCellValue('W'. ($i + 7), $data['poliTujuan']);
        $sheet->setCellValue('X'. ($i + 7), $data['code_poliTujuan']);
        $sheet->setCellValue('Y'. ($i + 7), $data['eksekutif']);
        $sheet->setCellValue('Z'. ($i + 7), $data['cob']);
        $sheet->setCellValue('AA'. ($i + 7), $data['katarak']);
        $sheet->setCellValue('AB'. ($i + 7), $data['lakaLantas']);
        $sheet->setCellValue('AC'. ($i + 7), $data['lokasiLaka']);
        $sheet->setCellValue('AD'. ($i + 7), $data['penjamin']);
        $sheet->setCellValue('AE'. ($i + 7), $data['tglKejadian']);
        $sheet->setCellValue('AF'. ($i + 7), $data['keterangan']);
        $sheet->setCellValue('AG'. ($i + 7), $data['suplesi']);
        $sheet->setCellValue('AH'. ($i + 7), $data['noSepSuplesi']);
        $sheet->setCellValue('AI'. ($i + 7), $data['kdPropinsi']);
        $sheet->setCellValue('AJ'. ($i + 7), $data['kdKabupaten']);
        $sheet->setCellValue('AK'. ($i + 7), $data['kdKecamatan']);
        $sheet->setCellValue('AL'. ($i + 7), $data['noSurat']);
        $sheet->setCellValue('AM'. ($i + 7), $data['kodeDPJP']);
        $sheet->setCellValue('AN'. ($i + 7), $data['nama_dpjp']);
        $sheet->setCellValue('AO'. ($i + 7), $data['nama_petugas_input']);
        $sheet->setCellValue('AP'. ($i + 7), $data['created_date']);
        $sheet->setCellValue('AQ'. ($i + 7), $data['nama_petugas_delete']);
        $sheet->setCellValue('AR'. ($i + 7), $data['nama_petugas_pulang']);
        $sheet->setCellValue('AS'. ($i + 7), $data['noTelp']);
        $sheet->setCellValue('AT'. ($i + 7), $data['user']);
        $sheet->setCellValue('AU'. ($i + 7), $data['vclaim_rujukan']);
        $sheet->setCellValue('AV'. ($i + 7), $data['ref_icd10']['nama_icd10']);
        
        $i++;
      }

      $sheet->getColumnDimension('B')->setWidth(5);
      $sheet->getColumnDimension('C')->setWidth(25);
      $sheet->getColumnDimension('D')->setWidth(20);
      $sheet->getColumnDimension('E')->setWidth(20);
      $sheet->getColumnDimension('F')->setWidth(20);
      $sheet->getColumnDimension('G')->setWidth(20);
      $sheet->getColumnDimension('H')->setWidth(25);
      $sheet->getColumnDimension('I')->setWidth(20);
      $sheet->getColumnDimension('J')->setWidth(20);
      $sheet->getColumnDimension('K')->setWidth(20);
      $sheet->getColumnDimension('L')->setWidth(20);
      $sheet->getColumnDimension('M')->setWidth(20);
      $sheet->getColumnDimension('N')->setWidth(20);
      $sheet->getColumnDimension('O')->setWidth(20);
      $sheet->getColumnDimension('P')->setWidth(20);
      $sheet->getColumnDimension('Q')->setWidth(20);
      $sheet->getColumnDimension('R')->setWidth(20);
      $sheet->getColumnDimension('S')->setWidth(20);
      $sheet->getColumnDimension('T')->setWidth(20);
      $sheet->getColumnDimension('U')->setWidth(40);
      $sheet->getColumnDimension('V')->setWidth(20);
      $sheet->getColumnDimension('W')->setWidth(30);
      $sheet->getColumnDimension('X')->setWidth(20);
      $sheet->getColumnDimension('Y')->setWidth(20);
      $sheet->getColumnDimension('Z')->setWidth(20);
      $sheet->getColumnDimension('AA')->setWidth(20);
      $sheet->getColumnDimension('AB')->setWidth(20);
      $sheet->getColumnDimension('AC')->setWidth(20);
      $sheet->getColumnDimension('AD')->setWidth(20);
      $sheet->getColumnDimension('AE')->setWidth(20);
      $sheet->getColumnDimension('AF')->setWidth(20);
      $sheet->getColumnDimension('AG')->setWidth(20);
      $sheet->getColumnDimension('AH')->setWidth(20);
      $sheet->getColumnDimension('AI')->setWidth(20);
      $sheet->getColumnDimension('AJ')->setWidth(20);
      $sheet->getColumnDimension('AK')->setWidth(20);
      $sheet->getColumnDimension('AL')->setWidth(20);
      $sheet->getColumnDimension('AM')->setWidth(20);
      $sheet->getColumnDimension('AN')->setWidth(20);
      $sheet->getColumnDimension('AO')->setWidth(30);
      $sheet->getColumnDimension('AP')->setWidth(30);
      $sheet->getColumnDimension('AQ')->setWidth(20);
      $sheet->getColumnDimension('AR')->setWidth(20);
      $sheet->getColumnDimension('AS')->setWidth(20);
      $sheet->getColumnDimension('AT')->setWidth(20);
      $sheet->getColumnDimension('AU')->setWidth(20);
      $sheet->getColumnDimension('AV')->setWidth(40);
      $sheet->getRowDimension('6')->setRowHeight(21);
           
      $writer = new Xlsx($spreadsheet);
      
      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="'. $title .'.xlsx"'); 
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
  }

}
