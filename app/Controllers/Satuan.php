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
            'active_satuan'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_satuan()
    {
        $url = URLAPI . "/v1/satuan/getall_satuan";
		$response = foodysAPI($url);
        $result = $response->result->message;
        echo json_encode($result);
    }

    public function tambah_satuan()
    {
        $mdata = [
            'title'     => 'Tambah Satuan - ' . NAMETITLE,
            'content'   => 'admin/satuan/tambah_satuan',
            'extra'     => 'admin/satuan/js/_js_index',
            'active_satuan'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        $validation = $this->validation;
        $validation->setRules([
            'satuan'     => [
                'label'     => 'Nama Satuan',
                'rules'     => 'trim|required'
            ],
        ]);

        // Checking Validation
        if (!$validation->withRequest($this->request)->run()){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "satuan/tambah_satuan")->withInput();
        }
        
        // Initial Data
        $mdata = [
            'namasatuan'      => htmlspecialchars($this->request->getVar('satuan')),
        ];
        
        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/satuan/add_satuan";
        $response = foodysAPI($url, json_encode($mdata));
        $result = $response->result;
        // echo "<pre>".print_r($response,true)."</pre>";
        //  die;
        if (@$response->status != 200) {
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "satuan/tambah_satuan")->withInput();
        }else{
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "satuan");
        }
    }

    public function edit_satuan($satuan)
    {
        $satuan=base64_decode($satuan);
        $url = URLAPI . "/v1/satuan/getsatuan_byid?id=".$satuan;
		$response = foodysAPI($url);
        $result = $response->result->message;
        // print_r($result);
        // die;
        $mdata = [
            'title'     => 'Edit satuan - ' . NAMETITLE,
            'content'   => 'admin/satuan/edit_satuan',
            'extra'     => 'admin/satuan/js/_js_index',
            'active_satuan'   => 'active',
            'satuan'  => $result
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function ubah_satuan()
    {

        $validation = $this->validation;
        $validation->setRules([
            'satuan'     => [
                'label'     => 'Namal',
                'rules'     => 'trim|required'
            ],
        ]);

        $idsatuan=$this->request->getVar('idsatuan');

        // Checking Validation
        if (!$validation->withRequest($this->request)->run()){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "satuan/edit_satuan/".base64_encode($idsatuan))->withInput();
        }
        
        // Initial Data
        $mdata = [
            'namasatuan'      => htmlspecialchars($this->request->getVar('satuan')),
        ];
        

        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/satuan/ubah_satuan?id=".$idsatuan;
        $response = foodysAPI($url, json_encode($mdata));
        $result = $response->result;
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;
        if (@$response->status != 200) {
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "satuan/edit_satuan/".base64_encode($idsatuan))->withInput();
        }else{
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "satuan")->withInput();
        }
    }

    public function hapus_satuan($satuan)
    {
        $satuan = base64_decode($satuan);
        $url = URLAPI . "/v1/satuan/hapus_satuan?id=".$satuan;
		$response = foodysAPI($url);
        $result = $response->result;


        if($response->status == 200){
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "satuan");
        }else{
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "satuan");
        }
    }



}
