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

        // Call API
        $url = URLAPI . "/v1/sales/getsales_byid?id=".$sales;
		$response = gucitoakAPI($url);
        $result = $response->message;
        if($result) {
            $result->barcode = 'assets/img/logo-no-text.png';
        }
        
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