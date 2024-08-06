<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        $mdata = [
            'title'     => 'List User - ' . NAMETITLE,
            'content'   => 'admin/user/index',
            'extra'     => 'admin/user/js/_js_index',
            'active_user'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_user()
    {
        $data = [
            (object) [
                "username" => "admin",
                "namalengkap"   => "Ari Pramana",
                "role"  => "admin"
            ],
            (object) [
                "username" => "kasir",
                "namalengkap"   => "Kasir 123",
                "role"  => "kasir"
            ]
        ];

        echo json_encode($data);
    }

    public function tambah_user()
    {
        $mdata = [
            'title'     => 'Tambah User - ' . NAMETITLE,
            'content'   => 'admin/user/tambah_user',
            'extra'     => 'admin/user/js/_js_index',
            'active_user'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        // Validation Field
        $rules = $this->validate([
            'username'     => [
                'label'     => 'Username or Email',
                'rules'     => 'trim|required'
            ],
            'nama'     => [
                'label'     => 'Nama Lengkap',
                'rules'     => 'trim|required'
            ],
            'password'     => [
                'label'     => 'Password',
                'rules'     => 'trim|required'
            ],
            'role'     => [
                'label'     => 'Role',
                'rules'     => 'trim|required'
            ],
        ]);

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "user/tambah_user")->withInput();
        }
        
        // Initial Data
        $mdata = [
            'username'  => htmlspecialchars($this->request->getVar('username')),
            'nama'      => htmlspecialchars($this->request->getVar('nama')),
            'password'  => sha1(htmlspecialchars($this->request->getVar('password'))),
            'role'      => htmlspecialchars($this->request->getVar('role')),
        ];
        
        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/user/adduser";
        $response = foodysAPI($url, json_encode($mdata));
        $result = $response->result->messages;

        if (@$response->status != 200) {
            session()->setFlashdata('failed', $result->error);
            return redirect()->to(BASE_URL . "user/tambah_user")->withInput();
        }else{
            session()->setFlashdata('success', $result->messages);
            return redirect()->to(BASE_URL . "user")->withInput();
        }
    }

    public function edit_user($username)
    {
        $mdata = [
            'title'     => 'Edit User - ' . NAMETITLE,
            'content'   => 'admin/user/edit_user',
            'extra'     => 'admin/user/js/_js_index',
            'active_user'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function hapus_user($username)
    {
        $username_delete = base64_decode($this->security->xss_clean($username));

        if ($username_delete=="admin"){
            $this->session->set_flashdata('success', "Admin can't be deleted");
            redirect("user");
            return;
        }

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
