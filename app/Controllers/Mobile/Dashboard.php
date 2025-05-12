<?php

namespace App\Controllers\Mobile;
use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

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
        $sales = $this->request->getHeaderLine('sales-id');
        $id = session()->get('logged_user')['id_sales'] ?? $sales;
        if(!$id) {
            throw PageNotFoundException::forPageNotFound();
        }
        $mdata = [
            'title'     => 'Dashboard - ' . NAMETITLE,
            'content'   => 'admin/dashboard/index',
            'extra'     => 'admin/dashboard/js/_js_index',
            'active_dash'   => 'active',
            'id_sales'  => $id
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_penjualan_sales($id) {
        $url = URLAPI . "/mobile/sales/penjualan_sales_bulan_sekarang?id=".$id;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response, true);
    }

}
