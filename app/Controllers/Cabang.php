<?php

namespace App\Controllers;

class Cabang extends BaseController
{
    public function index()
    {
        $mdata = [
            'title'     => 'List Cabang - ' . NAMETITLE,
            'content'   => 'admin/cabang/index',
            'extra'     => 'admin/cabang/js/_js_index',
            'menuactive_setup'   => 'active open',
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_cabang()
    {
        $url = URLAPI . "/v1/cabang/getall_cabang";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
    }

    public function tambah_cabang()
    {
        $mdata = [
            'title'     => 'Tambah Cabang - ' . NAMETITLE,
            'content'   => 'admin/cabang/tambah_cabang',
            'extra'     => 'admin/cabang/js/_js_index',
            'menuactive_setup'   => 'active open',
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        // Validation Field
        $rules = $this->validate([
            'cabang'     => [
                'label'     => 'Nama Cabang',
                'rules'     => 'required'
            ],
            'alamat'     => [
                'label'     => 'Alamat',
                'rules'     => 'required'
            ],
            'lat'     => [
                'label'     => 'Latitude',
                'rules'     => 'required'
            ],
            'long'     => [
                'label'     => 'Longitude',
                'rules'     => 'required'
            ],
        ]);

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "cabang/tambah_cabang")->withInput();
        }
        
        // Initial Data
        // FILTER HTML Special char
        // FILER Trim char
        $mdata = [
            'namacabang'    => trim(htmlspecialchars($this->request->getVar('cabang'))),
            'alamat'        => trim(htmlspecialchars($this->request->getVar('alamat'))),
            'lat'           => trim(htmlspecialchars($this->request->getVar('lat'))),
            'long'          => trim(htmlspecialchars($this->request->getVar('long'))),
        ];
        
        // CALL API
        $url = URLAPI . "/v1/cabang/add_cabang";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;

        // Check response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "cabang")->withInput();
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "cabang/tambah_cabang")->withInput();
        }

    }

    public function edit_cabang($cabang)
    {
        // GET Segment id cabang
        $idcabang = base64_decode($cabang);

        // CALL API
        $url = URLAPI . "/v1/cabang/getcabang_byid?id=".$idcabang;
        $response = gucitoakAPI($url);
        $result = $response->message;


        $mdata = [
            'title'     => 'Edit Cabang - ' . NAMETITLE,
            'content'   => 'admin/cabang/edit_cabang',
            'extra'     => 'admin/cabang/js/_js_index',
            'menuactive_setup'   => 'active open',
            'cabang'    => $result
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function ubah_proccess()
    {

        // Validation Field
        $rules = $this->validate([
            'cabang'     => [
                'label'     => 'Nama Cabang',
                'rules'     => 'required'
            ],
            'alamat'     => [
                'label'     => 'Alamat',
                'rules'     => 'required'
            ],
            'lat'     => [
                'label'     => 'Latitude',
                'rules'     => 'required'
            ],
            'long'     => [
                'label'     => 'Longitude',
                'rules'     => 'required'
            ],
        ]);

        $idcabang = $this->request->getVar('idcabang');

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL."cabang/edit_cabang/".$idcabang)->withInput();
        }
        
        // Initial Data
        // FILTER HTML Special char
        // FILER Trim char
        $mdata = [
            'namacabang'    => trim(htmlspecialchars($this->request->getVar('cabang'))),
            'alamat'        => trim(htmlspecialchars($this->request->getVar('alamat'))),
            'lat'           => trim(htmlspecialchars($this->request->getVar('lat'))),
            'long'          => trim(htmlspecialchars($this->request->getVar('long'))),
        ];
        
        // CALL API
        $url = URLAPI . "/v1/cabang/ubah_cabang?id=".base64_decode($idcabang);
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;

        // Check response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "cabang")->withInput();
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL."cabang/edit_cabang/".$idcabang)->withInput();
        }
    }


    public function hapus_cabang($cabang)
    {
        // Get segment id cabang
        $idcabang = base64_decode($cabang);
        // CALL API
        $url = URLAPI . "/v1/cabang/hapus_cabang?id=".$idcabang;
        $response = gucitoakAPI($url);
        $result = $response->message;

        if($response->code == 200){
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "cabang");
        }else{
            session()->setFlashdata('error', $result);
            return redirect()->to(BASE_URL . "cabang");
        }
    }



}
