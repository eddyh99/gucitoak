<?php

namespace App\Controllers\Mobile;

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
        $mdata = [
            'title'     => 'Dashboard - ' . NAMETITLE,
            'content'   => 'admin/dashboard/index',
            'extra'     => 'admin/dashboard/js/_js_index',
            'active_dash'   => 'active',
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

    public function get_penjualan_sales() {
        $id = session()->get('logged_user')['id_sales'] ?? null;
        $url = URLAPI . "/v1/penjualan/penjualan_sales_bulan_sekarang?id=".$id;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response, true);
    }

}
