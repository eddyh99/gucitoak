<?php

namespace App\Controllers;

use App\Enums\Menu;

class Barang extends BaseController
{
    public function index()
    {
        if (!hasPermission(Menu::DAFTAR_BARANG, 'setup')) {
            return view('errors/html/error_403');
        }
        $mdata = [
            'title'     => 'List barang - ' . NAMETITLE,
            'content'   => 'admin/barang/index',
            'extra'     => 'admin/barang/js/_js_index',
            'menuactive_setup'   => 'active open',
            'barang_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_barang()
    {
        $url = URLAPI . "/v1/barang/getall_barang";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
    }

    public function tambah_barang()
    {

        // Kategori
        $urlkategori = URLAPI . "/v1/kategori/getall_kategori";
		$resultkategori = gucitoakAPI($urlkategori)->message;

        // Satuan
        $urlsatuan = URLAPI . "/v1/satuan/getall_satuan";
		$resultsatuan = gucitoakAPI($urlsatuan)->message;

        
        $mdata = [
            'title'     => 'Tambah barang - ' . NAMETITLE,
            'content'   => 'admin/barang/tambah_barang',
            'extra'     => 'admin/barang/js/_js_index',
            'menuactive_setup'   => 'active open',
            'kategori'  => $resultkategori,
            'satuan'    => $resultsatuan
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        // Validation Rules
        $rules = $this->validate([
            'namabarang'     => [
                'label'     => 'Nama barang',
                'rules'     => 'required'
            ],
            'kategori'     => [
                'label'     => 'Kategori',
                'rules'     => 'required'
            ],
            'satuan'     => [
                'label'     => 'Satuan',
                'rules'     => 'required'
            ],
            'stokmin'     => [
                'label'     => 'Stok Minimum',
                'rules'     => 'required'
            ],
            'harga1'     => [
                'label'     => 'Harga 1',
                'rules'     => 'required'
            ],
        ]);

        // Checking Validation
        if (!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "barang/tambah_barang")->withInput();
        }
        
        // Initial Data
        // FILTER HTML Special Char
        // FILTER Trim Char
        // FILTER SANITIZE INTEGER
        $mdata = [
            'namabarang'    => trim(htmlspecialchars($this->request->getVar('namabarang'))),
            'idkategori'    => htmlspecialchars($this->request->getVar('kategori')),
            'idsatuan'      => htmlspecialchars($this->request->getVar('satuan')),
            'stokmin'       => filter_var($this->request->getVar('stokmin'), FILTER_SANITIZE_NUMBER_INT),
            'harga1'        => filter_var($this->request->getVar('harga1'), FILTER_SANITIZE_NUMBER_INT),
            'harga2'        => filter_var($this->request->getVar('harga2'), FILTER_SANITIZE_NUMBER_INT),
            'harga3'        => filter_var($this->request->getVar('harga3'), FILTER_SANITIZE_NUMBER_INT),
            'disc_pct'      => htmlspecialchars($this->request->getVar('discount_pct')),
            'disc_fxd'      => filter_var($this->request->getVar('discount_fxd'), FILTER_SANITIZE_NUMBER_INT),
        ];

        // CALL API
        $url = URLAPI . "/v1/barang/add_barang";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;

        // Checking Response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "barang")->withInput();
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "barang/tambah_barang")->withInput();
        }
    }

    public function edit_barang($barang)
    {
        // GET Segment id barang
        $barang=base64_decode($barang);

        // CALL API
        $url = URLAPI . "/v1/barang/getbarang_byid?id=".$barang;
		$response = gucitoakAPI($url);
        $result = $response->message;

        // Kategori
        $urlkategori = URLAPI . "/v1/kategori/getall_kategori";
        $resultkategori = gucitoakAPI($urlkategori)->message;

        // Satuan
        $urlsatuan = URLAPI . "/v1/satuan/getall_satuan";
        $resultsatuan = gucitoakAPI($urlsatuan)->message;
      
        $mdata = [
            'title'     => 'Edit barang - ' . NAMETITLE,
            'content'   => 'admin/barang/edit_barang',
            'extra'     => 'admin/barang/js/_js_index',
            'menuactive_setup'   => 'active open',
            'barang'  => $result,
            'kategori'  => $resultkategori,
            'satuan'    => $resultsatuan
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function ubah_barang()
    {

        // Validation Rules
        $rules = $this->validate([
            'namabarang'     => [
                'label'     => 'Nama barang',
                'rules'     => 'required'
            ],
            'kategori'     => [
                'label'     => 'Kategori',
                'rules'     => 'required'
            ],
            'satuan'     => [
                'label'     => 'Satuan',
                'rules'     => 'required'
            ],
            'stokmin'     => [
                'label'     => 'Stok Minimum',
                'rules'     => 'required'
            ],
            'harga1'     => [
                'label'     => 'Harga 1',
                'rules'     => 'required'
            ],
        ]);


        $idbarang = $this->request->getVar('idbarang');

        // Checking Validation
        if (!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "barang/edit_barang/".base64_encode($idbarang))->withInput();
        }
        
        // Initial Data
        // FILTER HTML Special Char
        // FILTER Trim Char
        // FILTER SANITIZE INTEGER
        $mdata = [
            'namabarang'    => trim(htmlspecialchars($this->request->getVar('namabarang'))),
            'idkategori'    => htmlspecialchars($this->request->getVar('kategori')),
            'idsatuan'      => htmlspecialchars($this->request->getVar('satuan')),
            'stokmin'       => filter_var($this->request->getVar('stokmin'), FILTER_SANITIZE_NUMBER_INT),
            'harga1'        => filter_var($this->request->getVar('harga1'), FILTER_SANITIZE_NUMBER_INT),
            'harga2'        => filter_var($this->request->getVar('harga2'), FILTER_SANITIZE_NUMBER_INT),
            'harga3'        => filter_var($this->request->getVar('harga3'), FILTER_SANITIZE_NUMBER_INT),
            'disc_pct'      => htmlspecialchars($this->request->getVar('discount_pct')),
            'disc_fxd'      => filter_var($this->request->getVar('discount_fxd'), FILTER_SANITIZE_NUMBER_INT),
        ];

        

        // CALL API
        $url = URLAPI . "/v1/barang/ubah_barang?id=".$idbarang;
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;


        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "barang")->withInput();
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "barang/edit_barang/".base64_encode($idbarang))->withInput();
        }
    }

    public function hapus_barang($barang)
    {
        // Get segment id barang
        $barang = base64_decode($barang);
        // CALL API
        $url = URLAPI . "/v1/barang/hapus_barang?id=".$barang;
		$response = gucitoakAPI($url);
        $result = $response->message;


        if($response->code == 200){
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "barang");
        }else{
            session()->setFlashdata('error', $result);
            return redirect()->to(BASE_URL . "barang");
        }
    }
    
    public function list_harga($id){
        $id=base64_decode($id);
        $url = URLAPI . "/v1/barang/list_harga?id=".$id;
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);

    }

}
