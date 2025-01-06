<?php

namespace App\Controllers;

class Persediaan extends BaseController
{
    public function index()
    {
        $mdata = [
            'title'     => 'List User - ' . NAMETITLE,
            'content'   => 'admin/user/index',
            'extra'     => 'admin/user/js/_js_index',
            'menuactive_master'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function stok_barang()
    {
        $mdata = [
            'title'     => 'Stock Barang - ' . NAMETITLE,
            'content'   => 'admin/user/index',
            'extra'     => 'admin/user/js/_js_index',
            'menuactive_master'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

   



}
