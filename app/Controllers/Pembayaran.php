<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pembayaran extends BaseController
{
    public function pelanggan()
    {
        $mdata = [
            'title'     => 'List Pembayaran - ' . NAMETITLE,
            'content'   => 'admin/pembayaran/pelanggan',
            'extra'     => 'admin/pembayaran/js/_js_pelanggan',
            'menuactive_transaksi'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_pembayaran_pel() {
        $tgl    = explode("-",$this->request->getVar('tanggal'));
        $awal   = date_format(date_create($tgl[0]),"Y-m-d");
        $akhir  = date_format(date_create($tgl[1]),"Y-m-d");
        $url = URLAPI . "/v1/pembayaran/pelanggan?awal=".$awal."&akhir=".$akhir;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
    }

    public function pelanggan_tambah()
    {
        $mdata = [
            'title'     => 'List Pembayaran - ' . NAMETITLE,
            'content'   => 'admin/pembayaran/pel_tambah',
            'extra'     => 'admin/pembayaran/js/_js_pel_tambah',
            'menuactive_transaksi'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }
}
