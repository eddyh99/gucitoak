<?php

namespace App\Controllers;

class Laporan extends BaseController
{
    public function barang() {
        $mdata = [
            'title'     => 'Laporan Barang - ' . NAMETITLE,
            'content'   => 'admin/laporan/barang',
            'extra'     => 'admin/laporan/js/_js_barang',
            'menuactive_laporan'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_barang(){
        $url = URLAPI . "/v1/laporan/barang";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
        
    }

    public function mutasistok()
    {
        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/mutasistok',
            'extra'     => 'admin/laporan/js/_js_mutasi',
            'menuactive_laporan'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function get_mutasi(){
        $bulan  = $this->request->getVar('bulan');
        $tahun  = $this->request->getVar('tahun');
        $url = URLAPI . "/v1/laporan/mutasi_stok?bulan=".$bulan."&tahun=".$tahun;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
        
    }

    public function penjualan() {
        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/penjualan',
            'extra'     => 'admin/laporan/js/_js_penjualan',
            'menuactive_laporan'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_penjualan(){
        $bulan  = $this->request->getVar('bulan');
        $tahun  = $this->request->getVar('tahun');
        $url = URLAPI . "/v1/laporan/mutasi_penjualan?bulan=".$bulan."&tahun=".$tahun;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
        
    }

    public function pembelian() {
        $url = URLAPI . "/v1/barang/getall_barang";
		$response = gucitoakAPI($url);
        $barang = $response->message;
        
        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/pembelian',
            'extra'     => 'admin/laporan/js/_js_pembelian',
            'menuactive_laporan'   => 'active open',
            'user_active'   => 'active',
            'barang'    => $barang
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_pembelian(){
        $tgl    = explode("-",$this->request->getVar('tanggal'));
        $awal   = date_format(date_create($tgl[0]),"Y-m-d");
        $akhir  = date_format(date_create($tgl[1]),"Y-m-d");
        $barang = $this->request->getVar('barang');
        $url = URLAPI . "/v1/laporan/mutasi_pembelian?awal=".$awal."&akhir=".$akhir.(!empty($barang) ? "&barang=" . $barang : "");
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
        
    }
    

}
