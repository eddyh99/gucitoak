<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $sales = $request->getHeaderLine('sales-id') ?: 10;

        // Jika cookie 'logged_user' ada, simpan ke sesi
        if (isset($_COOKIE['logged_user'])) {
            $userData = json_decode($_COOKIE['logged_user'], true);
            $session->set('logged_user', $userData);
        }

        if(!$session->has('logged_user') && !$sales){
            header("Location:".BASE_URL );
            exit();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}