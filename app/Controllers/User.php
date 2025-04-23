<?php

namespace App\Controllers;

use App\Enums\Menu;

class User extends BaseController
{
    public function index()
    {

        if (!hasPermission(Menu::DAFTAR_PENGGUNA, 'setup')) {
            return view('errors/html/error_403');
        }
        $mdata = [
            'title'     => 'List User - ' . NAMETITLE,
            'content'   => 'admin/user/index',
            'extra'     => 'admin/user/js/_js_index',
            'menuactive_setup'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_user()
    {
        $url = URLAPI . "/v1/pengguna/getall_pengguna";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
    }

    public function getpengguna_byid()
    {
        $id = $this->request->getVar('id');
        $url = URLAPI . "/v1/pengguna/getpengguna_byid?id=".$id;
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
    }

    public function tambah_user()
    {
        $mdata = [
            'title'     => 'Tambah User - ' . NAMETITLE,
            'content'   => 'admin/user/tambah_user',
            'extra'     => 'admin/user/js/_js_index',
            'menuactive_setup'   => 'active open',
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        // Validation Field
        $rules = $this->validate([
            'username'     => [
                'label'     => 'Username or Email',
                'rules'     => 'required'
            ],
            'password'     => [
                'label'     => 'Password',
                'rules'     => 'required'
            ],
            'role'     => [
                'label'     => 'Role',
                'rules'     => 'required'
            ],
        ]);

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "user/tambah_user")->withInput();
        }
        
        // Initial Data
        // FILTER Html Special chars
        // FILTER Trim char
        // ENCRYPT SH1 password
        $mdata = [
            'username'  => trim(htmlspecialchars($this->request->getVar('username'))),
            'password'  => sha1(trim(htmlspecialchars($this->request->getVar('password')))),
            'role'      => trim(htmlspecialchars($this->request->getVar('role'))),
            'gajipokok'     => trim(filter_var($this->request->getVar('gapok'), FILTER_SANITIZE_NUMBER_INT)),
            'komisi'        => trim(filter_var($this->request->getVar('komisi'), FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION))
        ];
        
        // CALL API
        $url = URLAPI . "/v1/pengguna/add_pengguna";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;

        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "user")->withInput();
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "user/tambah_user")->withInput();
        }
    }

    public function edit_user($username)
    {
        // Get segment id username
        $idusername = base64_decode($username);

        // Call API
        $url = URLAPI . "/v1/pengguna/getpengguna_byid?id=".$idusername;
        $response = gucitoakAPI($url);
        $result = $response->message;

        // echo '<pre>'.print_r($result,true).'</pre>';
        // die;

        $mdata = [
            'title'     => 'Edit User - ' . NAMETITLE,
            'content'   => 'admin/user/edit_user',
            'extra'     => 'admin/user/js/_js_index',
            'menuactive_setup'   => 'active open',
            'username'  => $result
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function ubah_proccess()
    {

        // Validation Field
        $rules = $this->validate([
            'username'     => [
                'label'     => 'Username or Email',
                'rules'     => 'required'
            ],
            'role'     => [
                'label'     => 'Role',
                'rules'     => 'required'
            ],
        ]);

        $idusername = $this->request->getVar('idusername');

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL."user/edit_user/".$idusername)->withInput();
        }
        
        // Call API
        $urlDetail = URLAPI . "/v1/pengguna/getpengguna_byid?id=".base64_decode($idusername);
        $response = gucitoakAPI($urlDetail);
        $resultDetail = $response->message;

        $newpass = $this->request->getVar('password');

        // Initial Data
        // FILTER Html Special chars
        // FILTER Trim char
        // ENCRYPT SH1 password
        $mdata = [
            'username'  => trim(htmlspecialchars($this->request->getVar('username'))),
            'password'  => ((empty($newpass)) ? $resultDetail->passwd : sha1(trim(htmlspecialchars($newpass)))),
            'role'      => trim(htmlspecialchars($this->request->getVar('role'))),
            'gajipokok'     => trim(filter_var($this->request->getVar('gapok'), FILTER_SANITIZE_NUMBER_INT)),
            'komisi'        => trim(filter_var($this->request->getVar('komisi'), FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION))
        ];

        // CALL API
        $url = URLAPI . "/v1/pengguna/ubah_pengguna?id=" . base64_decode($idusername);
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;

        // Check response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "user")->withInput();
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL."user/edit_user/".$idusername)->withInput();
        }
    }

    public function hapus_user($id, $username)
    {
        // GET id username from segment
        $idusername = base64_decode($id);
        $username_delete = base64_decode($username);

        // Checking
        if ($username_delete == "admin"){
            $this->session->set_flashdata('failed', "Admin tidak bisa di hapus");
            redirect("user");
            return;
        }

        $url = URLAPI . "/v1/pengguna/hapus_pengguna?id=".$idusername;
		$response = gucitoakAPI($url);
        $result = $response->message;


        if($response->code == 200){
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL."user");
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL."user");
        }
    }

}
