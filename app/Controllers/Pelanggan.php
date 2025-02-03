<?php

namespace App\Controllers;

use App\Enums\Menu;

class Pelanggan extends BaseController
{
    public function index()
    {
        if (!hasPermission(Menu::DAFTAR_PELANGGAN, 'setup')) {
            return view('errors/html/error_403');
        }
        $mdata = [
            'title'     => 'List pelanggan - ' . NAMETITLE,
            'content'   => 'admin/pelanggan/index',
            'extra'     => 'admin/pelanggan/js/_js_index',
            'menuactive_setup'   => 'active open',
            'pelanggan_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_pelanggan()
    {
        $url = URLAPI . "/v1/pelanggan/getall_pelanggan";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
    }

    public function tambah_pelanggan()
    {
        $mdata = [
            'title'     => 'Tambah pelanggan - ' . NAMETITLE,
            'content'   => 'admin/pelanggan/tambah_pelanggan',
            'extra'     => 'admin/pelanggan/js/_js_index',
            'menuactive_setup'   => 'active open',
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        // Validation Rules
        $rules = $this->validate([
            'pelanggan'     => [
                'label'     => 'Nama pelanggan',
                'rules'     => 'required'
            ],
            'pemilik'     => [
                'label'     => 'Pemilik',
                'rules'     => 'required'
            ],
            'alamat'     => [
                'label'     => 'Alamat',
                'rules'     => 'required'
            ],
            'kota'     => [
                'label'     => 'Kota',
                'rules'     => 'required'
            ],
            'telp'     => [
                'label'     => 'Telp',
                'rules'     => 'required'
            ],
            'harga'     => [
                'label'     => 'Harga',
                'rules'     => 'required'
            ],
        ]);

        // Checking Validation
        if (!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "pelanggan/tambah_pelanggan")->withInput();
        }
        
        // Initial Data
        // FILTER HTML SPECIAL CHARS
        // FILTER TRIM DATA
        // FILTER SANITIZE NUMBER INTEGER
        $mdata = [
            'namapelanggan' => trim(htmlspecialchars($this->request->getVar('pelanggan'))),
            'pemilik'       => trim(htmlspecialchars($this->request->getVar('pemilik'))),
            'alamat'        => trim(htmlspecialchars($this->request->getVar('alamat'))),
            'kota'          => trim(htmlspecialchars($this->request->getVar('kota'))),
            'telp'          => trim(htmlspecialchars($this->request->getVar('telp'))),
            'harga'         => trim(htmlspecialchars($this->request->getVar('harga'))),
            'gmaps'         => trim(htmlspecialchars($this->request->getVar('gmaps'))),
            'plafon'        => trim(filter_var($this->request->getVar('plafon'), FILTER_SANITIZE_NUMBER_INT)),
            'maxnota'       => trim(filter_var($this->request->getVar('maxnota'), FILTER_SANITIZE_NUMBER_INT)),
        ];


        // CALL API
        $url = URLAPI . "/v1/pelanggan/add_pelanggan";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;
        
        // Checking response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "pelanggan")->withInput();
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "pelanggan/tambah_pelanggan")->withInput();
        }
    }

    public function edit_pelanggan($pelanggan)
    {
        // GET Segment id pelanggan
        $pelanggan=base64_decode($pelanggan);

        // CALL API
        $url = URLAPI . "/v1/pelanggan/getpelanggan_byid?id=".$pelanggan;
		$response = gucitoakAPI($url);
        $result = $response->message;

        
        $mdata = [
            'title'     => 'Edit pelanggan - ' . NAMETITLE,
            'content'   => 'admin/pelanggan/edit_pelanggan',
            'extra'     => 'admin/pelanggan/js/_js_index',
            'menuactive_setup'   => 'active open',
            'pelanggan'  => $result
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function ubah_pelanggan()
    {

        // Validation Rules
        $rules = $this->validate([
            'pelanggan'     => [
                'label'     => 'Nama pelanggan',
                'rules'     => 'required'
            ],
            'alamat'     => [
                'label'     => 'Alamat',
                'rules'     => 'required'
            ],
            'kota'     => [
                'label'     => 'Kota',
                'rules'     => 'required'
            ],
            'telp'     => [
                'label'     => 'Telp',
                'rules'     => 'required'
            ],
        ]);

        $idpelanggan=$this->request->getVar('idpelanggan');

        // Checking Validation
        if (!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "/pelanggan/edit_pelanggan/".base64_encode($idpelanggan))->withInput();
        }
        
        // Initial Data
        // FILTER HTML SPECIAL CHARS
        // FILTER TRIM DATA
        // FILTER SANITIZE NUMBER INTEGER
        $mdata = [
            'namapelanggan' => trim(htmlspecialchars($this->request->getVar('pelanggan'))),
            'pemilik'       => trim(htmlspecialchars($this->request->getVar('pemilik'))),
            'alamat'        => trim(htmlspecialchars($this->request->getVar('alamat'))),
            'kota'          => trim(htmlspecialchars($this->request->getVar('kota'))),
            'telp'          => trim(htmlspecialchars($this->request->getVar('telp'))),
            'harga'         => trim(htmlspecialchars($this->request->getVar('harga'))),
            'gmaps'         => trim(htmlspecialchars($this->request->getVar('gmaps'))),
            'plafon'        => trim(filter_var($this->request->getVar('plafon'), FILTER_SANITIZE_NUMBER_INT)),
            'maxnota'       => trim(filter_var($this->request->getVar('maxnota'), FILTER_SANITIZE_NUMBER_INT)),
        ];
    

        // CALL API
        $url = URLAPI . "/v1/pelanggan/ubah_pelanggan?id=".$idpelanggan;
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;
        

        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "pelanggan")->withInput();
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "pelanggan/edit_pelanggan/".base64_encode($idpelanggan))->withInput();
        }
    }

    public function hapus_pelanggan($pelanggan)
    {
        // Get segment id pelanggan
        $pelanggan = base64_decode($pelanggan);

        // CALL API
        $url = URLAPI . "/v1/pelanggan/hapus_pelanggan?id=".$pelanggan;
		$response = gucitoakAPI($url);
        $result = $response->message;


        if($response->code == 200){
            session()->setFlashdata('error', $result);
            return redirect()->to(BASE_URL . "pelanggan");
        }else{
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "pelanggan");
        }
    }


}
