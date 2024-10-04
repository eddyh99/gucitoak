<?php

namespace App\Controllers;

class Stok extends BaseController
{
    public function index()
    {
        $mdata = [
            'title'     => 'Stok barang - ' . NAMETITLE,
            'content'   => 'admin/stok/barang',
            'extra'     => 'admin/stok/js/_js_barang',
            'menuactive_persediaan'   => 'active open',
            'stokbarang_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_stokbarang()
    {
        $url = URLAPI . "/v1/barang/getall_barang";
		$response = gucitoakAPI($url);
        $result = $response->result->message;
        echo json_encode($result);
    }

    public function tambah_stokbarang()
    {
        $mdata = [  
            'title'     => 'Tambah Stok Barang - ' . NAMETITLE,
            'content'   => 'admin/stok/tambah_stokbarang',
            'extra'     => 'admin/stok/js/_js_tambahbarang',
            'menuactive_persediaan'   => 'active open',
            'stokbarang_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }



}
