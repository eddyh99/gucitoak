<?php

namespace App\Controllers;

class Satuan extends BaseController
{
    public function index()
    {
        $mdata = [
            'title'     => 'List Satuan - ' . NAMETITLE,
            'content'   => 'admin/master/satuan/index',
            'extra'     => 'admin/master/satuan/js/_js_index',
            'active_satuan'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_satuan()
    {
        $data = [
            (object) [
                "satuan"    => "Ctn",
            ],
            (object) [
                "satuan"    => "Botol",
            ],
            (object) [
                "satuan"    => "Pcs",
            ],
            (object) [
                "satuan"    => "Bonus",
            ],
            (object) [
                "satuan"    => "Renceng",
            ],
            (object) [
                "satuan"    => "Ball",
            ],
            (object) [
                "satuan"    => "Box",
            ],
        ];

        echo json_encode($data);
    }

    public function tambah_satuan()
    {
        $mdata = [
            'title'     => 'Tambah Satuan - ' . NAMETITLE,
            'content'   => 'admin/master/satuan/tambah_satuan',
            'extra'     => 'admin/master/satuan/js/_js_index',
            'active_satuan'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        // Validation Field
        $rules = $this->validate([
            'satuan'     => [
                'label'     => 'Satuan',
                'rules'     => 'trim|required'
            ],
        ]);

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "satuan/tambah_satuan")->withInput();
        }
        
        // Initial Data
        $mdata = [
            'satuan'    => htmlspecialchars($this->request->getVar('satuan')),
        ];
        
        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/user/adduser";
        $response = foodysAPI($url, json_encode($mdata));
        $result = $response->result->messages;

        if (@$response->status != 200) {
            session()->setFlashdata('failed', $result->error);
            return redirect()->to(BASE_URL . "satuan/tambah_satuan")->withInput();
        }else{
            session()->setFlashdata('success', $result->messages);
            return redirect()->to(BASE_URL . "satuan")->withInput();
        }
    }

    public function edit_satuan($satuanname)
    {
        $mdata = [
            'title'     => 'Edit Satuan - ' . NAMETITLE,
            'content'   => 'admin/master/satuan/edit_satuan',
            'extra'     => 'admin/master/satuan/js/_js_index',
            'active_satuan'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    // @todo::Integrasi Hapus satuan
    public function hapus_satuan($username)
    {
        $username_delete = base64_decode($this->security->xss_clean($username));

        $url = URLAPI . "/v1/user/deleteUser?username=".$username_delete;
		$response = foodysAPI($url);
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
