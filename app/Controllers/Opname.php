<?php

namespace App\Controllers;

class Opname extends BaseController
{
    public function index()
    {
        $mdata = [
            'title'     => 'Stok Opname - ' . NAMETITLE,
            'content'   => 'admin/opname/opname',
            'extra'     => 'admin/opname/js/_js_opname',
            'menuactive_persediaan'   => 'active open',
            'stokopname_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function konfirm()
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


}
