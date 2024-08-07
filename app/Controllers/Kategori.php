<?php

namespace App\Controllers;

class Kategori extends BaseController
{
    public function index()
    {
        $mdata = [
            'title'     => 'List Kategori - ' . NAMETITLE,
            'content'   => 'admin/master/kategori/index',
            'extra'     => 'admin/master/kategori/js/_js_index',
            'active_kategori'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_kategori()
    {
        $data = [
            (object) [
                "kategori"    => "Dry Food",
            ],
            (object) [
                "kategori"    => "Fast Food",
            ],
            (object) [
                "kategori"    => "Food",
            ],
            (object) [
                "kategori"    => "Dry Food",
            ],
            (object) [
                "kategori"    => "Fast Food",
            ],
            (object) [
                "kategori"    => "Food",
            ],
            (object) [
                "kategori"    => "Dry Food",
            ],
            (object) [
                "kategori"    => "Fast Food",
            ],
            (object) [
                "kategori"    => "Food",
            ],
            (object) [
                "kategori"    => "Dry Food",
            ],
            (object) [
                "kategori"    => "Fast Food",
            ],
            (object) [
                "kategori"    => "Food",
            ],
            (object) [
                "kategori"    => "Dry Food",
            ],
            (object) [
                "kategori"    => "Fast Food",
            ],
            (object) [
                "kategori"    => "Food",
            ],
            (object) [
                "kategori"    => "Dry Food",
            ],
            (object) [
                "kategori"    => "Fast Food",
            ],
            (object) [
                "kategori"    => "Food",
            ],
            (object) [
                "kategori"    => "Dry Food",
            ],
            (object) [
                "kategori"    => "Fast Food",
            ],
            (object) [
                "kategori"    => "Food",
            ],
        ];

        echo json_encode($data);
    }

    public function tambah_kategori()
    {
        $mdata = [
            'title'     => 'Tambah Kategori - ' . NAMETITLE,
            'content'   => 'admin/master/kategori/tambah_kategori',
            'extra'     => 'admin/master/kategori/js/_js_index',
            'active_kategori'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        // Validation Field
        $rules = $this->validate([
            'kategori'     => [
                'label'     => 'Kategori',
                'rules'     => 'trim|required'
            ],
        ]);

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "kategori/tambah_kategori")->withInput();
        }
        
        // Initial Data
        $mdata = [
            'kategori'    => htmlspecialchars($this->request->getVar('kategori')),
        ];
        
        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/user/adduser";
        $response = foodysAPI($url, json_encode($mdata));
        $result = $response->result->messages;

        if (@$response->status != 200) {
            session()->setFlashdata('failed', $result->error);
            return redirect()->to(BASE_URL . "kategori/tambah_kategori")->withInput();
        }else{
            session()->setFlashdata('success', $result->messages);
            return redirect()->to(BASE_URL . "kategori")->withInput();
        }
    }

    public function edit_kategori($kategoriname)
    {
        $mdata = [
            'title'     => 'Edit Kategori - ' . NAMETITLE,
            'content'   => 'admin/master/kategori/edit_kategori',
            'extra'     => 'admin/master/kategori/js/_js_index',
            'active_kategori'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    // @todo::Integrasi Hapus kategori
    public function hapus_kategori($username)
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
