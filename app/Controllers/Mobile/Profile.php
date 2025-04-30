<?php

namespace App\Controllers\Mobile;

use App\Controllers\BaseController;

class Profile extends BaseController
{

    public function index()
    {
        // Get segment idsales
        // $sales=base64_decode($sales);
        $sales = 10;

        $id = session()->get('logged_user')['id_sales'] ?? $sales;
        // Call API
        $url = URLAPI . "/mobile/sales/getsales_byid?id=".$id;
		$response = gucitoakAPI($url);
        $result = $response->message;
        $barcode = createBarcode($sales);
        $result->barcode = $barcode;
        
        $mdata = [
            'title'     => 'Edit sales - ' . NAMETITLE,
            'content'   => 'sales/profile/index',
            'extra'     => 'sales/profile/js/_js_index',
            'menuactive_setup'   => 'active open',
            'sales'  => $result
        ];

        return view('admin/layout/wrapper', $mdata);
    }
}