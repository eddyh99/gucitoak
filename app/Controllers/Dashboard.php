<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    // public function __construct()
    // {
    //     $session = session();
    //     if(!$session->has('logged_user')){
    //         header("Location:".BASE_URL );
    //         exit();
    //     }
    // }

    public function index()
    {
        $id = session()->get('logged_user')['id_sales'] ?? false;
        $mdata = [
            'title'     => 'Dashboard - ' . NAMETITLE,
            'content'   => 'admin/dashboard/index',
            'extra'     => 'admin/dashboard/js/_js_index',
            'active_dash'   => 'active',
            'id_sales' => $id
        ];

        return view('admin/layout/wrapper', $mdata);
    }
    
    public function list_all_stokbarang()
    {
        $url = URLAPI . "/v1/barang/getstokmin";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
    }

}
