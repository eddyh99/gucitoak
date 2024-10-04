<?php

namespace App\Controllers;

class Pelanggan extends BaseController
{
    public function index()
    {
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
        $result = $response->result->message;
        echo json_encode($result);
    }

    public function tambah_pelanggan()
    {
        $mdata = [
            'title'     => 'Tambah pelanggan - ' . NAMETITLE,
            'content'   => 'admin/pelanggan/tambah_pelanggan',
            'extra'     => 'admin/pelanggan/js/_js_index',
            'active_pelanggan'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        $validation = $this->validation;
        $validation->setRules([
            'pelanggan'     => [
                'label'     => 'Nama pelanggan',
                'rules'     => 'trim|required'
            ],
            'alamat'     => [
                'label'     => 'Alamat',
                'rules'     => 'trim|required'
            ],
            'kota'     => [
                'label'     => 'Kota',
                'rules'     => 'trim|required'
            ],
            'telp'     => [
                'label'     => 'Telp',
                'rules'     => 'trim|required'
            ],
        ]);

        // Checking Validation
        if (!$validation->withRequest($this->request)->run()){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "pelanggan/tambah_pelanggan")->withInput();
        }
        
        // Initial Data
        $mdata = [
            'namapelanggan' => htmlspecialchars($this->request->getVar('pelanggan')),
            'pemilik'       => htmlspecialchars($this->request->getVar('pemilik')),
            'alamat'        => htmlspecialchars($this->request->getVar('alamat')),
            'kota'          => htmlspecialchars($this->request->getVar('kota')),
            'telp'          => htmlspecialchars($this->request->getVar('telp')),
            'plafon'        => filter_var($this->request->getVar('plafon'),FILTER_SANITIZE_NUMBER_INT),
        ];
        // echo "<pre>".print_r($mdata,true)."</pre>";
        // die;
        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/pelanggan/add_pelanggan";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->result;
        // echo "<pre>".print_r($response,true)."</pre>";
        // die;
        if (@$response->status != 200) {
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "pelanggan/tambah_pelanggan")->withInput();
        }else{
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "pelanggan")->withInput();
        }
    }

    public function edit_pelanggan($pelanggan)
    {
        $pelanggan=base64_decode($pelanggan);
        $url = URLAPI . "/v1/pelanggan/getpelanggan_byid?id=".$pelanggan;
		$response = gucitoakAPI($url);
        $result = $response->result->message;
        // print_r($result);
        // die;
        $mdata = [
            'title'     => 'Edit pelanggan - ' . NAMETITLE,
            'content'   => 'admin/pelanggan/edit_pelanggan',
            'extra'     => 'admin/pelanggan/js/_js_index',
            'active_pelanggan'   => 'active',
            'pelanggan'  => $result
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function ubah_pelanggan()
    {

        $validation = $this->validation;
        $validation->setRules([
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
        if (!$validation->withRequest($this->request)->run()){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "/pelanggan/edit_pelanggan/".base64_encode($idpelanggan))->withInput();
        }
        
        // Initial Data
        $mdata = [
            'namapelanggan'     => htmlspecialchars($this->request->getVar('pelanggan')),
            'pemilik'       => htmlspecialchars($this->request->getVar('pemilik')),
            'alamat'        => htmlspecialchars($this->request->getVar('alamat')),
            'kota'          => htmlspecialchars($this->request->getVar('kota')),
            'telp'          => htmlspecialchars($this->request->getVar('telp')),
            'plafon'        => filter_var($this->request->getVar('plafon'),FILTER_SANITIZE_NUMBER_INT),
        ];
        
        // echo "<pre>".print_r($mdata,true)."</pre>";
        // die;

        

        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/pelanggan/ubah_pelanggan?id=".$idpelanggan;
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->result;
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;
        if (@$response->status != 200) {
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "pelanggan/edit_pelanggan/".base64_encode($idpelanggan))->withInput();
        }else{
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "pelanggan")->withInput();
        }
    }

    public function hapus_pelanggan($pelanggan)
    {
        $pelanggan = base64_decode($pelanggan);
        $url = URLAPI . "/v1/pelanggan/hapus_pelanggan?id=".$pelanggan;
		$response = gucitoakAPI($url);
        $result = $response->result;


        if($response->status == 200){
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "pelanggan");
        }else{
            session()->setFlashdata('error', $result->message);
            return redirect()->to(BASE_URL . "pelanggan");
        }
    }


}
