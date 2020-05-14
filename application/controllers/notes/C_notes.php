<?php defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Psr7;
use \GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

/**********************************************************************************
 * 
 * Deskripsi
 * Menampilkan halaman client/notes_temp
 * 
 **********************************************************************************/
class C_notes extends CI_Controller
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

        // guzzle client
        $this->_client_rs = new Client([
            'base_uri'  => $this->config->item('api_rs'),
            'headers'   => [
                'Content-Type' => 'application/json',
                'x-token' => $token
            ]
        ]);

        $this->_client_notes = new Client([
            'base_uri'  => $this->config->item('api_notes'),
            'headers'   => [
                'Content-Type' => 'application/json',
                'x-token' => $token
            ]
        ]);


        // NAMA FOLDER DALAM CONTROLLER. 
        // HANYA EDIT DI SINI.. YANG LAIN TIDAK PERLU DIRUBAH... TOLONG GANTI DENGAN NAMA FOLDER YANG BARU
        $this->c_folder = "notes_temp"; // <<< HANYA INI YANG PERLU DIRUBAH DI CONSTRUCT()!!!! SISANYA DIAMKAN

        //menghilangkan 'C_' pada nama class untuk dinamisasi routing;
        $this->class = str_replace("c_", "", $this->router->fetch_class());

        //dummy id departemen
        $this->id_dept = 3;

        // untuk menyimpan data ke /tmp untuk ditampilkan di cetak
        $this->folder = $this->config->item('tmp_folder');
    }

    // redirect ke fungsi list
    public function index()
    // $route['notes_temp'] = 'notes_temp/c_notes_temp';
    {
        $response_visit = $this->_client_rs->request('GET', 'kunjungan', [
            'query' => [
                'no_rm' => '008000649',
                'type'  => 'visit',
                'id_reg' => '5003',
            ]
        ]);
        $data_visit = json_decode($response_visit->getBody()->getContents(), true)['data']['visit'];

        foreach ($data_visit as $k => $v) {
            $notes=[];
            $response_notes = $this->_client_notes->request('GET', 'notes', [
                'query' => [
                    'id'  => $v['id_visit'],
                ]
            ]);

            $data_notes = json_decode($response_notes->getBody()->getContents(), true)['data'];

            foreach ($data_notes as $n => $o) {
                $jdata = json_decode($o['json_data'], true);
              
                $notes[$n] = [
                    'notes_id' => $o['id'],
                    'approved_dokter' => $jdata['approved_dokter'],
                    'approved_petugas' => $jdata['approved_petugas'],
                    'data1' => $jdata['notes']['data1'],
                    'data2' => $jdata['notes']['data2']
                ];

            };

            $data['list'][$k] = [
                'id_reg'    => $v['id_registrasi'],
                'no_reg'    => $v['no_reg'],
                'id_visit'  => $v['id_visit'],
                'no_visit'  => $v['no_visit'],
                'penjamin'  => $v['nama_penjamin'],
                'id_dept'   => $v['id_poli'],
                'nama_dept' => $v['nama_dept'],
                'tanggal_checkin' => $v['checkin'],
                'pasien'    => $data_visit[$k],
                'data' => $notes
            ];
        }
    }

    public function post()
    {
        $data = [];
        $params = [
            'no_rm' => '008000649',
            'id_ref_global_tipe_42' => '427',
            'id_pasien_registrasi' => '5003',
            'id_pasien_visit' => '2326',
            'id_petugas_approve' => '373684',
            'id_dokter_approve' => '373680',
            'data1' => 'ini adalah data 1 id visit 2326',
            'data2' => 'ini adalah data 2 id visit 2326',
        ];

        $testinput = $this->_client_notes->request('POST', 'notes', [
            'form_params' => $params
        ]);

        $result = json_decode($testinput


            ->getbody()->getcontents(), true);
        echo json_encode($result);
    }

    public function list()
    {
        $data = array(
            'title'   => 'Notes',
            'class_name' => $this->class,
        );

        if ($this->input->is_ajax_request()) {
            $data['contents'] = 'contents/notes/' . $this->class . '/index';
            $this->load->view('master', $data);
        } else {
            $data['contents'] = 'contents/notes/' . $this->class . '/index';
            $this->load->view('master', $data);
        }
    }

    //mengambil data registrasi untuk di tampilkan di aktif dan arsip 
    function get_data_submenu($type)
    {
        // data dummy list registrasi aktif untuk di view index.php
        if ($type == 'list') {
            $no_rm = $this->session->userdata('no_rm');

            //aktif
            $response_reg_aktif = $this->_client_rs->request('GET', 'pasien', [
                'query' => [
                    'no_rm' => $no_rm,
                    'type'  => 'registrasi',
                    'status' => 'active'
                ]
            ]);
            $data['data_reg_aktif'] = json_decode($response_reg_aktif->getBody()->getContents(), true)['data']['registrasi'];

            //arsip
            $response_reg_arsip = $this->_client_rs->request('GET', 'pasien', [
                'query' => [
                    'no_rm' => $no_rm,
                    'type'  => 'registrasi',
                    'status' => 'archive'
                ]
            ]);
            $data['data_reg_arsip'] = json_decode($response_reg_arsip->getBody()->getContents(), true)['data']['registrasi'];

            // menghapus file
            $user_id      = $this->session->userdata('id_user');
            foreach (glob($this->folder . $user_id . '_' . $this->class . '*') as $f) {
                unlink($f);
            }

            // trace($data['data_reg_arsip']);
            // trace($data);
            $this->load->view('contents/notes/' . $this->class . '/list', $data);
        }
    }
}
