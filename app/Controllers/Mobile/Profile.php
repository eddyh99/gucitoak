<?php

namespace App\Controllers\Mobile;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Profile extends BaseController
{

    public function index()
    {
        $sales = $this->request->getHeaderLine('sales-id');
        $id = session()->get('logged_user')['id_sales'] ?? $sales;
        if(!$id) {
            throw PageNotFoundException::forPageNotFound();
        }
        // Call API
        $url = URLAPI . "/mobile/sales/getsales_byid?id=".$id;
		$response = gucitoakAPI($url);
        $result = $response->message;
        $barcode = createBarcode($id);
        $result->barcode = $barcode;
        
        $mdata = [
            'title'     => 'Edit sales - ' . NAMETITLE,
            'content'   => 'mobile/profile/index',
            'extra'     => 'mobile/profile/js/_js_index',
            'menuactive_setup'   => 'active open',
            'sales'  => $result
        ];

        return view('admin/layout/wrapper', $mdata);
    }
}