<?php

namespace App\Controllers;

class Auth extends BaseController
{
    public function index()
    {
        $mdata = [
            'title'     => 'Sign in - ' . NAMETITLE,
            'content'   => 'auth/index',
            'extra'     => 'auth/js/_js_index',
        ];

        return view('auth/layout/wrapper', $mdata);
    }

    public function signin_proccess()
    {
        
        // Validation Field
        $rules = $this->validate([
            'username'     => [
                'label'     => 'Username or Email',
                'rules'     => 'trim|required'
            ],
            'password'     => [
                'label'     => 'Password',
                'rules'     => 'trim|required'
            ],
        ]);

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL )->withInput();
        }
        
        // Initial Data
        $mdata = [
            'username'  => htmlspecialchars($this->request->getVar('username')),
            'password'  => sha1(htmlspecialchars($this->request->getVar('password'))),
        ];
        
        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/auth/signin";
		$response = foodysAPI($url, json_encode($mdata));
        $result = $response->result->messages;

        if (@$response->status != 200) {
            session()->setFlashdata('failed', $result->error);
            return redirect()->to(BASE_URL)->withInput();
		}

        $this->session->set('logged_user', $mdata);

        // @todo::Meng redirect sukses login
        session()->setFlashdata('success', "Selamat datang <b>".$result->username."</b>");
        return redirect()->to(BASE_URL . "dashboard");
    }

}
