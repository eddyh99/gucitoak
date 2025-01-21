<?php

namespace App\Controllers;

use App\Enums\Menu;

class Kategori extends BaseController
{
    public function index()
    {
        if (!hasPermission(Menu::DAFTAR_KATEGORI, 'setup')) {
            return view('errors/html/error_403');
        }
        $mdata = [
            'title'     => 'List kategori - ' . NAMETITLE,
            'content'   => 'admin/kategori/index',
            'extra'     => 'admin/kategori/js/_js_index',
            'menuactive_setup'   => 'active open',
            'kategori_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_kategori()
    {
        $url = URLAPI . "/v1/kategori/getall_kategori";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
    }

    public function tambah_kategori()
    {
        $mdata = [
            'title'     => 'Tambah kategori - ' . NAMETITLE,
            'content'   => 'admin/kategori/tambah_kategori',
            'extra'     => 'admin/kategori/js/_js_index',
            'menuactive_setup'   => 'active open',
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        // Validation Rules
        $rules = $this->validate([
            'kategori'     => [
                'label'     => 'Kategori',
                'rules'     => 'required'
            ],
        ]);

        // Checking Validation
        if (!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "kategori/tambah_kategori")->withInput();
        }
        
        // Initial Data
        // FILTER HTML special chars
        // FILTER Trim Chars
        $mdata = [
            'namakategori'      => trim(htmlspecialchars($this->request->getVar('kategori'))),
        ];
        
        // CALL API
        $url = URLAPI . "/v1/kategori/add_kategori";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;


        // Checking response API
        if ($response->code == 200 || $response->code == 201){
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "kategori");
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "kategori/tambah_kategori")->withInput();
        }
    }

    public function edit_kategori($kategori)
    {
        // get parameter and decode
        $kategori = base64_decode($kategori);

        // CALL API
        $url = URLAPI . "/v1/kategori/getkategori_byid?id=".$kategori;
		$response = gucitoakAPI($url);
        $result = $response->message;

        $mdata = [
            'title'     => 'Edit kategori - ' . NAMETITLE,
            'content'   => 'admin/kategori/edit_kategori',
            'extra'     => 'admin/kategori/js/_js_index',
            'menuactive_setup'   => 'active open',
            'kategori'  => $result
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function ubah_kategori()
    {

        // Validation Rule
        $rules = $this->validate([
            'kategori'     => [
                'label'     => 'Kategori',
                'rules'     => 'required'
            ],
        ]);

        $idkategori = $this->request->getVar('idkategori');

        // Checking Validation
        if (!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "kategori/edit_kategori/".base64_encode($idkategori))->withInput();
        }
        
        // Initial Data
        // FILTER HTML Special Chars
        // FILTER Trim Chars
        $mdata = [
            'namakategori'      => trim(htmlspecialchars($this->request->getVar('kategori'))),
        ];
        
        // CALL API
        $url = URLAPI . "/v1/kategori/ubah_kategori?id=".$idkategori;
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;

        // Check Response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "kategori")->withInput();
            exit();
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "kategori/edit_kategori/".base64_encode($idkategori))->withInput();
            exit();
        }
    }

    public function hapus_kategori($kategori)
    {
        // Get parameters 
        $kategori = base64_decode($kategori);

        // CALL API
        $url = URLAPI . "/v1/kategori/hapus_kategori?id=".$kategori;
		$response = gucitoakAPI($url);
        $result = $response->message;

        // Check response API
        if($response->code == 200 || $response->code == 201){
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "kategori");
        }else{
            session()->setFlashdata('error', $result);
            return redirect()->to(BASE_URL . "kategori");
        }
    }



}
