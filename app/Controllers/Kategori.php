<?php

namespace App\Controllers;

class Kategori extends BaseController
{
    public function index()
    {
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
        $result = $response->result->message;
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

        $validation = $this->validation;
        $validation->setRules([
            'kategori'     => [
                'label'     => 'Kategori',
                'rules'     => 'required'
            ],
        ]);

        // Checking Validation
        if (!$validation->withRequest($this->request)->run()){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "kategori/tambah_kategori")->withInput();
        }
        
        // Initial Data
        $mdata = [
            'namakategori'      => htmlspecialchars($this->request->getVar('kategori')),
        ];
        
        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/kategori/add_kategori";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->result;
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;
        if (@$response->status != 201) {
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "kategori/tambah_kategori")->withInput();
        }else{
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "kategori")->withInput();
        }
    }

    public function edit_kategori($kategori)
    {
        $kategori=base64_decode($kategori);
        $url = URLAPI . "/v1/kategori/getkategori_byid?id=".$kategori;
		$response = gucitoakAPI($url);
        $result = $response->result->message;
        // print_r($result);
        // die;
        $mdata = [
            'title'     => 'Edit kategori - ' . NAMETITLE,
            'content'   => 'admin/kategori/edit_kategori',
            'extra'     => 'admin/kategori/js/_js_index',
            'active_kategori'   => 'active',
            'kategori'  => $result
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function ubah_kategori()
    {

        $validation = $this->validation;
        $validation->setRules([
            'kategori'     => [
                'label'     => 'Kategori',
                'rules'     => 'required'
            ],
        ]);

        $idkategori=$this->request->getVar('idkategori');
        // Checking Validation
        if (!$validation->withRequest($this->request)->run()){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "kategori/edit_kategori/".base64_encode($idkategori))->withInput();
        }
        
        // Initial Data
        $mdata = [
            'namakategori'      => htmlspecialchars($this->request->getVar('kategori')),
        ];
        

        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/kategori/ubah_kategori?id=".$idkategori;
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->result;
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;
        if (@$response->status != 200) {
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "kategori/ubah_kategori")->withInput();
        }else{
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "kategori")->withInput();
        }
    }

    public function hapus_kategori($kategori)
    {
        $kategori = base64_decode($kategori);
        $url = URLAPI . "/v1/kategori/hapus_kategori?id=".$kategori;
		$response = gucitoakAPI($url);
        $result = $response->result;


        if($response->status == 200){
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "kategori");
        }else{
            session()->setFlashdata('error', $result->message);
            return redirect()->to(BASE_URL . "kategori");
        }
    }



}
