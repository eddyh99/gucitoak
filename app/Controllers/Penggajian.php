<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;

class Penggajian extends BaseController
{
    // private $isSales;

    // public function __construct()
    // {
    //     $this->isSales = session()->get('logged_user')['role'] == 'sales';
    // }

    public function index()
    {
        $mdata = [
            'title'     => 'Gaji Sales - ' . NAMETITLE,
            'content'   => 'admin/penggajian/index',
            'extra'     => 'admin/penggajian/js/_js_index',
            'menuactive_penggajian'   => 'active open',
            'gaji_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function tambah()
    {
        $user = $this->request->getVar('user');

        switch ($user) {
            case 'sales':
                $url   = URLAPI . "/v1/sales/getall_sales";
                break;
            case 'admin':
                $url   = URLAPI . "/v1/pengguna/getall_pengguna";
                break;
            default:
                return redirect()->to(BASE_URL . 'penggajian');
        }
		$user      = gucitoakAPI($url)->message;

        $mdata = [
            'title'     => 'Gaji Sales - ' . NAMETITLE,
            'content'   => 'admin/penggajian/tambah',
            'extra'     => 'admin/penggajian/js/_js_tambah',
            'menuactive_penggajian'   => 'active open',
            'user_active'   => 'active',
            'user'         => $user
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function input_gaji($user) {
        $rules = [
            'sales' => [
                'label' => 'Sales',
                'rules' => 'required'
            ],
            'uangharian' => [
                'label' => 'Uang Harian',
                'rules' => 'required|numeric'
            ],
            'gajipokok' => [
                'label' => 'Gaji Pokok',
                'rules' => 'required|numeric|greater_than[0]'
            ],
            'insentif' => [
                'label' => 'Insentif',
                'rules' => 'required|numeric'
            ]
        ];
    
        // Jika user adalah sales, tambahkan validasi detailnota
        if ($user === 'sales') {
            $rules['detailnota'] = [
                'label' => 'Penjualan',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Sales belum melakukan penjualan.'
                ]
            ];
        }

        // Checking Validation
        if(!$this->validate($rules)){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . 'penggajian/tambah?user=' . $user)->withInput();
        }
        

        $mdata = [
            'sales'  => $this->request->getVar('sales'),
            'bulan'  => $this->request->getVar('bulan'),
            'gajipokok'  => $this->request->getVar('gajipokok'),
            'uangharian'  => $this->request->getVar('uangharian'),
            'insentif'  => $this->request->getVar('insentif'),
            'komisi'  => $this->request->getVar('komisi'),
            'user_type'  => $this->request->getVar('user_type'),
            'detailnota'  => $this->request->getVar('detailnota')
        ];

        $url = URLAPI . "/v1/penggajian/inputGaji_sales";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;

        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "penggajian");
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "penggajian/tambah?user=".$user)->withInput();
        }
    }

    public function get_listGaji()
    {
        $bulan = (new DateTime("{$this->request->getVar('tahun')}-{$this->request->getVar('bulan')}"));
        $url = URLAPI . "/v1/penggajian/listGaji_bulanan?bulan=" . $bulan->format('Y-m');
        $response = gucitoakAPI($url)->message;
        echo json_encode($response, true);
    }

    public function slipgaji() {
        if(!$this->isSales) return view('errors/html/error_403');
        $mdata = [
            'title'     => 'Slip Gaji - ' . NAMETITLE,
            'content'   => 'sales/slipgaji/index',
            'extra'     => 'sales/slipgaji/js/_js_index',
            'menuactive_slipgaji'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function getGaji_sales()
    {
        $tahun = $this->request->getVar('tahun');
        $id = session()->get('logged_user')['id_sales'] ?? null;
        $url = URLAPI . "/v1/penggajian/getGaji_sales?id=" .$id. "&tahun=" .$tahun;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response, true);
    }

    public function get_penjualan_byNota($nonota) {
        $url = URLAPI . "/v1/laporan/penjualan_byNota?nonota=".base64_decode($nonota);
        $response = gucitoakAPI($url)->message;
        echo json_encode($response, true);
    }
}
