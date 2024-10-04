<?php

namespace App\Controllers;

class Barang extends BaseController
{
    public function index()
    {
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
        $result = $response->result->message;
        echo json_encode($result);
    }

    public function tambah_barang()
    {
        $mdata = [
            'title'     => 'Tambah barang - ' . NAMETITLE,
            'content'   => 'admin/barang/tambah_barang',
            'extra'     => 'admin/barang/js/_js_index',
            'active_barang'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        $validation = $this->validation;
        $validation->setRules([
            'barang'     => [
                'label'     => 'Nama barang',
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
        if (!$validation->withRequest($this->request)->run()){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "barang/tambah_barang")->withInput();
        }
        
        // Initial Data
        $mdata = [
            'namabarang'     => htmlspecialchars($this->request->getVar('barang')),
            'alamat'        => htmlspecialchars($this->request->getVar('alamat')),
            'kota'          => htmlspecialchars($this->request->getVar('kota')),
            'telp'          => htmlspecialchars($this->request->getVar('telp')),
            'omzet'         => filter_var($this->request->getVar('omzet'),FILTER_SANITIZE_NUMBER_INT),
        ];
        // echo "<pre>".print_r($mdata,true)."</pre>";
        // die;
        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/barang/add_barang";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->result;
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;
        if (@$response->status != 201) {
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "barang/tambah_barang")->withInput();
        }else{
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "barang")->withInput();
        }
    }

    public function edit_barang($barang)
    {
        $barang=base64_decode($barang);
        $url = URLAPI . "/v1/barang/getbarang_byid?id=".$barang;
		$response = gucitoakAPI($url);
        $result = $response->result->message;
        // print_r($result);
        // die;
        $mdata = [
            'title'     => 'Edit barang - ' . NAMETITLE,
            'content'   => 'admin/barang/edit_barang',
            'extra'     => 'admin/barang/js/_js_index',
            'active_barang'   => 'active',
            'barang'  => $result
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function ubah_barang()
    {

        $validation = $this->validation;
        $validation->setRules([
            'barang'     => [
                'label'     => 'Nama barang',
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

        $idbarang=$this->request->getVar('idbarang');
        // Checking Validation
        if (!$validation->withRequest($this->request)->run()){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "barang/edit_barang/".base64_encode($idbarang))->withInput();
        }
        
        // Initial Data
        $mdata = [
            'namabarang'     => htmlspecialchars($this->request->getVar('barang')),
            'alamat'        => htmlspecialchars($this->request->getVar('alamat')),
            'kota'          => htmlspecialchars($this->request->getVar('kota')),
            'telp'          => htmlspecialchars($this->request->getVar('telp')),
            'omzet'         => filter_var($this->request->getVar('omzet'),FILTER_SANITIZE_NUMBER_INT),
        ];
        

        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/barang/ubah_barang?id=".$idbarang;
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->result;
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;
        if (@$response->status != 200) {
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "barang/edit_barang/".base64_encode($idbarang))->withInput();
        }else{
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "barang")->withInput();
        }
    }

    public function hapus_barang($barang)
    {
        $barang = base64_decode($barang);
        $url = URLAPI . "/v1/barang/hapus_barang?id=".$barang;
		$response = gucitoakAPI($url);
        $result = $response->result;


        if($response->status == 200){
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "barang");
        }else{
            session()->setFlashdata('error', $result->message);
            return redirect()->to(BASE_URL . "barang");
        }
    }


}
