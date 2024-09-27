<?php

namespace App\Controllers;

class Suplier extends BaseController
{
    public function index()
    {
        $mdata = [
            'title'     => 'List suplier - ' . NAMETITLE,
            'content'   => 'admin/suplier/index',
            'extra'     => 'admin/suplier/js/_js_index',
            'active_suplier'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_suplier()
    {
        $url = URLAPI . "/v1/suplier/getall_suplier";
		$response = foodysAPI($url);
        $result = $response->result->message;
        echo json_encode($result);
    }

    public function tambah_suplier()
    {
        $mdata = [
            'title'     => 'Tambah suplier - ' . NAMETITLE,
            'content'   => 'admin/suplier/tambah_suplier',
            'extra'     => 'admin/suplier/js/_js_index',
            'active_suplier'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        $validation = $this->validation;
        $validation->setRules([
            'suplier'     => [
                'label'     => 'Nama suplier',
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
            return redirect()->to(BASE_URL . "suplier/tambah_suplier")->withInput();
        }
        
        // Initial Data
        $mdata = [
            'namasuplier'     => htmlspecialchars($this->request->getVar('suplier')),
            'alamat'        => htmlspecialchars($this->request->getVar('alamat')),
            'kota'          => htmlspecialchars($this->request->getVar('kota')),
            'telp'          => htmlspecialchars($this->request->getVar('telp')),
            'norek'          => htmlspecialchars($this->request->getVar('norek')),
            'namabank'          => htmlspecialchars($this->request->getVar('namabank')),
            'anbank'          => htmlspecialchars($this->request->getVar('anbank')),
        ];
        // echo "<pre>".print_r($mdata,true)."</pre>";
        // die;
        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/suplier/add_suplier";
        $response = foodysAPI($url, json_encode($mdata));
        $result = $response->result;
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;
        if (@$response->status != 201) {
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "suplier/tambah_suplier")->withInput();
        }else{
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "suplier")->withInput();
        }
    }

    public function edit_suplier($suplier)
    {
        $suplier=base64_decode($suplier);
        $url = URLAPI . "/v1/suplier/getsuplier_byid?id=".$suplier;
		$response = foodysAPI($url);
        $result = $response->result->message;
        // print_r($result);
        // die;
        $mdata = [
            'title'     => 'Edit suplier - ' . NAMETITLE,
            'content'   => 'admin/suplier/edit_suplier',
            'extra'     => 'admin/suplier/js/_js_index',
            'active_suplier'   => 'active',
            'suplier'  => $result
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function ubah_suplier()
    {

        $validation = $this->validation;
        $validation->setRules([
            'suplier'     => [
                'label'     => 'Nama suplier',
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

        $idsuplier=$this->request->getVar('idsuplier');

        // Checking Validation
        if (!$validation->withRequest($this->request)->run()){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "suplier/edit_suplier/".base64_encode($idsuplier))->withInput();
        }
        
        // Initial Data
        $mdata = [
            'namasuplier'     => htmlspecialchars($this->request->getVar('suplier')),
            'alamat'        => htmlspecialchars($this->request->getVar('alamat')),
            'kota'          => htmlspecialchars($this->request->getVar('kota')),
            'telp'          => htmlspecialchars($this->request->getVar('telp')),
            'norek'          => htmlspecialchars($this->request->getVar('norek')),
            'namabank'          => htmlspecialchars($this->request->getVar('namabank')),
            'anbank'          => htmlspecialchars($this->request->getVar('anbank')),
        ];
        

        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/suplier/ubah_suplier?id=".$idsuplier;
        $response = foodysAPI($url, json_encode($mdata));
        $result = $response->result;
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;
        if (@$response->status != 200) {
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "suplier/edit_suplier/".base64_encode($idsuplier))->withInput();
        }else{
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "suplier")->withInput();
        }
    }

    public function hapus_suplier($suplier)
    {
        $suplier = base64_decode($suplier);
        $url = URLAPI . "/v1/suplier/hapus_suplier?id=".$suplier;
		$response = foodysAPI($url);
        $result = $response->result;


        if($response->status == 200){
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "suplier");
        }else{
            session()->setFlashdata('error', $result->message);
            return redirect()->to(BASE_URL . "suplier");
        }
    }


}
