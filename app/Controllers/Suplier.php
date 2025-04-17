<?php

namespace App\Controllers;

use App\Enums\Menu;

class Suplier extends BaseController
{
    public function index()
    {
        if (!hasPermission(Menu::DAFTAR_SUPLIER, 'setup')) {
            return view('errors/html/error_403');
        }
        $mdata = [
            'title'     => 'List suplier - ' . NAMETITLE,
            'content'   => 'admin/suplier/index',
            'extra'     => 'admin/suplier/js/_js_index',
            'menuactive_setup'   => 'active open',
            'supplier_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_suplier()
    {
        $url = URLAPI . "/v1/suplier/getall_suplier";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
    }

    public function tambah_suplier()
    {
        $mdata = [
            'title'     => 'Tambah suplier - ' . NAMETITLE,
            'content'   => 'admin/suplier/tambah_suplier',
            'extra'     => 'admin/suplier/js/_js_index',
            'menuactive_setup'   => 'active open',
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        // Validation Rules
        $rules = $this->validate([
            'suplier'     => [
                'label'     => 'Nama suplier',
                'rules'     => 'required'
            ],
            'pemilik'     => [
                'label'     => 'Nama Pemilik',
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

        // Checking Validation
        if (!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "suplier/tambah_suplier")->withInput();
        }
        
        // Initial Data
        // FILTER HTML special chars
        // FILTER Trim Chars
        $mdata = [
            'namasuplier'       => trim(htmlspecialchars($this->request->getVar('suplier'))),
            'pemilik'            => trim(htmlspecialchars($this->request->getVar('pemilik'))),
            'alamat'            => trim(htmlspecialchars($this->request->getVar('alamat'))),
            'kota'              => trim(htmlspecialchars($this->request->getVar('kota'))),
            'telp'              => trim(htmlspecialchars($this->request->getVar('telp'))),
            'norek'             => trim(htmlspecialchars($this->request->getVar('norek'))),
            'namabank'          => trim(htmlspecialchars($this->request->getVar('namabank'))),
            'anbank'            => trim(htmlspecialchars($this->request->getVar('anbank'))),
        ];

        // CALL API
        $url = URLAPI . "/v1/suplier/add_suplier";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;
    

        // Checking response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "suplier")->withInput();
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "suplier/tambah_suplier")->withInput();
        }
    }


    public function edit_suplier($suplier)
    {
        // GET id supplier from segment
        $suplier=base64_decode($suplier);

        // CALL API
        $url = URLAPI . "/v1/suplier/getsuplier_byid?id=".$suplier;
		$response = gucitoakAPI($url);
        $result = $response->message;

        $mdata = [
            'title'     => 'Edit suplier - ' . NAMETITLE,
            'content'   => 'admin/suplier/edit_suplier',
            'extra'     => 'admin/suplier/js/_js_index',
            'menuactive_setup'   => 'active open',
            'suplier'  => $result
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function ubah_suplier()
    {

        // Validation Rules
        $rules = $this->validate([
            'suplier'     => [
                'label'     => 'Nama suplier',
                'rules'     => 'required'
            ],
            'pemilik'     => [
                'label'     => 'Nama Pemilik',
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

        $idsuplier = $this->request->getVar('idsuplier');

        // Checking Validation
        if (!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "suplier/edit_suplier/".base64_encode($idsuplier))->withInput();
        }
        
        // Initial Data
        // FILTER HTML special chars
        // FILTER Trim Chars
        $mdata = [
            'namasuplier'       => trim(htmlspecialchars($this->request->getVar('suplier'))),
            'pemilik'           => trim(htmlspecialchars($this->request->getVar('pemilik'))),
            'alamat'            => trim(htmlspecialchars($this->request->getVar('alamat'))),
            'kota'              => trim(htmlspecialchars($this->request->getVar('kota'))),
            'telp'              => trim(htmlspecialchars($this->request->getVar('telp'))),
            'norek'             => trim(htmlspecialchars($this->request->getVar('norek'))),
            'namabank'          => trim(htmlspecialchars($this->request->getVar('namabank'))),
            'anbank'            => trim(htmlspecialchars($this->request->getVar('anbank'))),
        ];


        // CALL API
        $url = URLAPI . "/v1/suplier/ubah_suplier?id=".$idsuplier;
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;
      

         // Checking response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "suplier")->withInput();
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "suplier/edit_suplier/".base64_encode($idsuplier))->withInput();
        }
    }

    public function hapus_suplier($suplier)
    {
        // Get Segment id supplier
        $suplier = base64_decode($suplier);

        // CALL API
        $url = URLAPI . "/v1/suplier/hapus_suplier?id=".$suplier;
		$response = gucitoakAPI($url);
        $result = $response->message;


        if($response->code == 200){
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "suplier");
        }else{
            session()->setFlashdata('error', $result);
            return redirect()->to(BASE_URL . "suplier");
        }
    }


}
