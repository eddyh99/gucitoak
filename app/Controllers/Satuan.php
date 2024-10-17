<?php

namespace App\Controllers;

class Satuan extends BaseController
{
    public function index()
    {
        $mdata = [
            'title'     => 'List Satuan - ' . NAMETITLE,
            'content'   => 'admin/satuan/index',
            'extra'     => 'admin/satuan/js/_js_index',
            'menuactive_setup'   => 'active open',
            'satuan_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_satuan()
    {
        $url = URLAPI . "/v1/satuan/getall_satuan";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
    }

    public function tambah_satuan()
    {
        $mdata = [
            'title'     => 'Tambah Satuan - ' . NAMETITLE,
            'content'   => 'admin/satuan/tambah_satuan',
            'extra'     => 'admin/satuan/js/_js_index',
            'menuactive_setup'   => 'active open',
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        // Validation Rules
        $rules = $this->validate([
            'satuan'     => [
                'label'     => 'Nama Satuan',
                'rules'     => 'required'
            ],
        ]);

        // Checking Validation
        if (!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "satuan/tambah_satuan")->withInput();
        }
        
        // Initial Data
        // FILTER HTML special chars
        // FILTER Trim Chars
        $mdata = [
            'namasatuan'      => trim(htmlspecialchars($this->request->getVar('satuan'))),
        ];
        
        // CALL API
        $url = URLAPI . "/v1/satuan/add_satuan";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;
        

        // Checking response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "satuan");
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "satuan/tambah_satuan")->withInput();
        }
    }

    public function edit_satuan($satuan)
    {
        // get parameter and decode
        $satuan=base64_decode($satuan);
        
        // CALL API 
        $url = URLAPI . "/v1/satuan/getsatuan_byid?id=".$satuan;
		$response = gucitoakAPI($url);
        $result = $response->message;

        $mdata = [
            'title'     => 'Edit satuan - ' . NAMETITLE,
            'content'   => 'admin/satuan/edit_satuan',
            'extra'     => 'admin/satuan/js/_js_index',
            'menuactive_setup'   => 'active open',
            'satuan'  => $result
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function ubah_satuan()
    {

        // Validation Rules
        $rules = $this->validate([
            'satuan'     => [
                'label'     => 'Nama Satuan',
                'rules'     => 'required'
            ],
        ]);

        $idsatuan = $this->request->getVar('idsatuan');

        // Checking Validation
        if (!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "satuan/edit_satuan/".base64_encode($idsatuan))->withInput();
        }
        
        // Initial Data
        // FILTER HTML special chars
        // FILTER Trim Chars
        $mdata = [
            'namasatuan'      => trim(htmlspecialchars($this->request->getVar('satuan'))),
        ];
        
        // CALL API
        $url = URLAPI . "/v1/satuan/ubah_satuan?id=".$idsatuan;
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;


        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "satuan")->withInput();
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "satuan/edit_satuan/".base64_encode($idsatuan))->withInput();
        }
    }

    public function hapus_satuan($satuan)
    {
        // Get Parameter
        $satuan = base64_decode($satuan);

        // CALL API
        $url = URLAPI . "/v1/satuan/hapus_satuan?id=".$satuan;
		$response = gucitoakAPI($url);
        $result = $response->message;


        if($response->code == 200 || $response->code == 201){
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "satuan");
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "satuan");
        }
    }



}
