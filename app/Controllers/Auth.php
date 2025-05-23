<?php

namespace App\Controllers;

class Auth extends BaseController
{
    
    public function index()
    {
        $session = session();
        if($session->has('logged_user') ||  isset($_COOKIE['logged_user'])){
            return redirect()->to(BASE_URL . "dashboard");
            exit();
        }

        if($this->request->getHeaderLine('sales-id')){
            return redirect()->to(BASE_URL . "mobile/dashboard");
            exit();
        }

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
                'rules'     => 'required'
            ],
            'password'     => [
                'label'     => 'Password',
                'rules'     => 'required'
            ],
        ]);

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL)->withInput();
        }

        $remember = filter_var($this->request->getVar('remember'), FILTER_VALIDATE_BOOLEAN);
        
        // Initial Data 
        // FILTER HTML SPECIAL CHARS
        // FILTER TRIM CHARS
        // ENCRPT SHA1 PASSWORD
        $mdata = [
            'username'  => trim(htmlspecialchars($this->request->getVar('username'))),
            'password'  => sha1(htmlspecialchars($this->request->getVar('password'))),
        ];
        
        // Call API
        $url = URLAPI . "/auth/signin";
		$response = gucitoakAPI($url, json_encode($mdata));
        // Check Response if error
        if ($response->code != 200) {
            session()->setFlashdata('failed', $response->message);
            return redirect()->to(BASE_URL)->withInput();
            exit();
		}

        // Reduce call response 
        $result = $response->message;
        
        // Assign role to mdata array
        $mdata['role']  = $result->role;
        $mdata['akses'] = json_decode($result->akses);

        // Set SESSION logged_user
        if ($remember) {
            setcookie('logged_user', json_encode($mdata), time() + (86400 * 30), "/");
        }

        $this->session->set('logged_user', $mdata);

        // If Success set session and redirect
        session()->setFlashdata('success', "Selamat datang <b>".$result->username."</b>");
        return redirect()->to(BASE_URL . "dashboard");
        exit();
    }
    
    
    public function logout(){
        // unset($_SESSION['item']);
        session()->destroy();
        setcookie('logged_user', '', time() - 3600, "/");
        return redirect()->to(BASE_URL)->withInput();
        exit;
    }

    public function sales()
    {
        $session = session();
        if($session->has('logged_user')){
            return redirect()->to(BASE_URL . "dashboard");
            exit();
        }

        $mdata = [
            'title'     => 'Sign in - ' . NAMETITLE,
            'content'   => 'auth/sales/index',
            'extra'     => 'auth/js/_js_index',
        ];

        return view('auth/layout/wrapper', $mdata);
    }

    public function signinSales_proccess()
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
        ]);

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . 'auth/sales')->withInput();
        }
        
        // Initial Data 
        // FILTER HTML SPECIAL CHARS
        // FILTER TRIM CHARS
        // ENCRPT SHA1 PASSWORD
        $mdata = [
            'username'  => trim(htmlspecialchars($this->request->getVar('username'))),
            'password'  => sha1(htmlspecialchars($this->request->getVar('password'))),
        ];
        
        // Call API
        $url = URLAPI . "/auth/sales/signin";
		$response = gucitoakAPI($url, json_encode($mdata));
        // Check Response if error
        if ($response->code != 200) {
            session()->setFlashdata('failed', $response->message);
            return redirect()->to(BASE_URL . 'auth/sales')->withInput();
            exit();
		}

        // Reduce call response 
        $result = $response->message;
        
        // array for session
        unset($mdata);
        $mdata = [
            'namasales' => $result->sales,
            'username' => $result->username,
            'password' => $result->passwd,
            'role'     => $result->role,
            'id_sales' => $result->id_sales,
            'akses'     => json_decode($result->akses)
        ];

        // Set SESSION logged_user
        $this->session->set('logged_user', $mdata);

        // If Success set session and redirect
        session()->setFlashdata('success', "Selamat datang <b>".$result->username."</b>");
        return redirect()->to(BASE_URL . "dashboard");
        exit();
    }

}
