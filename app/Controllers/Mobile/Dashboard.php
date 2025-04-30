<?php

namespace App\Controllers\Mobile;
use App\Controllers\BaseController;

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

    public function get_penjualan_sales() {
        $sales = 10;
        $id = session()->get('logged_user')['id_sales'] ?? $sales;
        $url = URLAPI . "/mobile/sales/penjualan_sales_bulan_sekarang?id=".$id;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response, true);
    }

}
