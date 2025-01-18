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

    public function retursup() {
        $url = URLAPI . "/v1/suplier/getall_suplier";
        $response = gucitoakAPI($url);
        $suplier = $response->message;

        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/retursup',
            'extra'     => 'admin/laporan/js/_js_retursup',
            'menuactive_laporan'   => 'active open',
            'user_active'   => 'active',
            'suplier' => $suplier
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_retursup(){
        $bulan  = $this->request->getVar('bulan');
        $tahun  = $this->request->getVar('tahun');
        $suplier = $this->request->getVar('suplier');

        $url = URLAPI . "/v1/laporan/retursup?bulan=".$bulan."&tahun=".$tahun.(!empty($suplier) ? "&suplier=" . $suplier : "");
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
        
    }
    
    public function returpel() {
        $url = URLAPI . "/v1/pelanggan/getall_pelanggan";
        $response = gucitoakAPI($url);
        $pelanggan = $response->message;

        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/returpel',
            'extra'     => 'admin/laporan/js/_js_returpel',
            'menuactive_laporan'   => 'active open',
            'user_active'   => 'active',
            'pelanggan' => $pelanggan
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_returpel(){
        $bulan  = $this->request->getVar('bulan');
        $tahun  = $this->request->getVar('tahun');
        $pelanggan = $this->request->getVar('pelanggan');

        $url = URLAPI . "/v1/laporan/returpel?bulan=".$bulan."&tahun=".$tahun.(!empty($pelanggan) ? "&pelanggan=" . $pelanggan : "");
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
        
    }

    public function omzet_outlet() {
        $url = URLAPI . "/v1/pelanggan/getall_pelanggan";
        $response = gucitoakAPI($url);
        $pelanggan = $response->message;

        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/omzetpel',
            'extra'     => 'admin/laporan/js/_js_omzetpel',
            'menuactive_laporan'   => 'active open',
            'user_active'   => 'active',
            'pelanggan' => $pelanggan
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_omzetpel($id){
        $url = URLAPI . "/v1/laporan/omzet_pelanggan?id=$id";
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
    }

}
