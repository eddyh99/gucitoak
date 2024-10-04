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
            'cabang_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_cabang()
    {
        $data = [
            (object) [
                "namacabang"    => "Gudang",
                "alamat"        => "Jln Pahlawan 123",
                "lat"           => "123456",
                "long"          => "6543231",
            ],
            (object) [
                "namacabang"    => "Gudang Return",
                "alamat"        => "Jln Hasanudin",
                "lat"           => "12345",
                "long"          => "654321"
            ]
        ];

        echo json_encode($data);
    }

    public function tambah_cabang()
    {
        $mdata = [
            'title'     => 'Tambah Cabang - ' . NAMETITLE,
            'content'   => 'admin/master/cabang/tambah_cabang',
            'extra'     => 'admin/master/cabang/js/_js_index',
            'active_cabang'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        // Validation Field
        $rules = $this->validate([
            'cabang'     => [
                'label'     => 'Nama Cabang',
                'rules'     => 'trim|required'
            ],
            'alamat'     => [
                'label'     => 'Alamat',
                'rules'     => 'trim|required'
            ],
            'lat'     => [
                'label'     => 'Latitude',
                'rules'     => 'trim|required'
            ],
            'long'     => [
                'label'     => 'Longitude',
                'rules'     => 'trim|required'
            ],
        ]);

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "cabang/tambah_cabang")->withInput();
        }
        
        // Initial Data
        $mdata = [
            'cabang'    => htmlspecialchars($this->request->getVar('cabang')),
            'alamat'    => htmlspecialchars($this->request->getVar('alamat')),
            'lat'       => htmlspecialchars($this->request->getVar('lat')),
            'long'      => htmlspecialchars($this->request->getVar('long')),
        ];
        
        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/user/adduser";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->result->messages;

        if (@$response->status != 200) {
            session()->setFlashdata('failed', $result->error);
            return redirect()->to(BASE_URL . "cabang/tambah_cabang")->withInput();
        }else{
            session()->setFlashdata('success', $result->messages);
            return redirect()->to(BASE_URL . "cabang")->withInput();
        }
    }

    public function edit_cabang($cabangname)
    {
        $mdata = [
            'title'     => 'Edit Cabang - ' . NAMETITLE,
            'content'   => 'admin/master/cabang/edit_cabang',
            'extra'     => 'admin/master/cabang/js/_js_index',
            'active_cabang'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    // @todo::Integrasi Hapus cabang
    public function hapus_cabang($username)
    {
        $username_delete = base64_decode($this->security->xss_clean($username));

        if ($username_delete=="admin"){
            $this->session->set_flashdata('success', "Admin can't be deleted");
            redirect("user");
            return;
        }

        $url = URLAPI . "/v1/user/deleteUser?username=".$username_delete;
		$response = gucitoakAPI($url);
        $result = $response->result;


        if($response->status == 200){
            $this->session->set_flashdata('success', $result->messages);
			redirect('user');
			return;
        }else{
            $this->session->set_flashdata('error', $result->messages->error);
            redirect('user');
            return;
        }
    }



}
