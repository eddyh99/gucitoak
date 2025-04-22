<?php

namespace App\Controllers;
use App\Enums\Menu;

class Laporan extends BaseController
{

    public function barangexp() {
        if (!hasPermission(Menu::BARANG_EXPIRED, 'laporan')) {
            return view('errors/html/error_403');
        }
        $mdata = [
            'title'     => 'Laporan Barang Expired - ' . NAMETITLE,
            'content'   => 'admin/laporan/barang-expired',
            'extra'     => 'admin/laporan/js/_js_barang-exp',
            'menuactive_laporan'   => 'active open',
            'barangexp_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_barang_expired(){
        $url = URLAPI . "/v1/laporan/get_barangexpired";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
        
    }

    public function barang() {
        if (!hasPermission(Menu::STOK_MIN_BARANG, 'laporan')) {
            return view('errors/html/error_403');
        }
        $mdata = [
            'title'     => 'Laporan Barang - ' . NAMETITLE,
            'content'   => 'admin/laporan/barang',
            'extra'     => 'admin/laporan/js/_js_barang',
            'menuactive_laporan'   => 'active open',
            'stokminbrg_active'   => 'active'
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
        if (!hasPermission(Menu::MUTASI_STOK, 'laporan')) {
            return view('errors/html/error_403');
        }
        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/mutasistok',
            'extra'     => 'admin/laporan/js/_js_mutasi',
            'menuactive_laporan'   => 'active open',
            'mutasistok_active'   => 'active'
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
        if (!hasPermission(Menu::PENJUALAN_SUMMARY, 'laporan')) {
            return view('errors/html/error_403');
        }

        $url =  URLAPI . "/v1/sales/getall_sales";
        $response = gucitoakAPI($url);
        $sales = $response->message;

        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/penjualan',
            'extra'     => 'admin/laporan/js/_js_penjualan',
            'menuactive_laporan'   => 'active open',
            'penjualan_active'   => 'active',
            'sales' => $sales
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_penjualan(){
        $sales  = $this->request->getVar('sales');
        $bulan  = $this->request->getVar('bulan');
        $tahun  = $this->request->getVar('tahun');
        $url = URLAPI . "/v1/laporan/mutasi_penjualan?". "sales=".$sales."&bulan=".$bulan."&tahun=".$tahun;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
        
    }

    public function pembelian() {
        if (!hasPermission(Menu::PEMBELIAN_SUMMARY, 'laporan')) {
            return view('errors/html/error_403');
        }
        $url = URLAPI . "/v1/barang/getall_barang";
		$response = gucitoakAPI($url);
        $barang = $response->message;
        
        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/pembelian',
            'extra'     => 'admin/laporan/js/_js_pembelian',
            'menuactive_laporan'   => 'active open',
            'pembelian_active'   => 'active',
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
        if (!hasPermission(Menu::LAP_RETUR_SUPLIER, 'laporan')) {
            return view('errors/html/error_403');
        }
        $url = URLAPI . "/v1/suplier/getall_suplier";
        $response = gucitoakAPI($url);
        $suplier = $response->message;

        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/retursup',
            'extra'     => 'admin/laporan/js/_js_retursup',
            'menuactive_laporan'   => 'active open',
            'retursup_active'   => 'active',
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
        if (!hasPermission(Menu::LAP_RETUR_PELANGGAN, 'laporan')) {
            return view('errors/html/error_403');
        }
        $url = URLAPI . "/v1/pelanggan/getall_pelanggan";
        $response = gucitoakAPI($url);
        $pelanggan = $response->message;

        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/returpel',
            'extra'     => 'admin/laporan/js/_js_returpel',
            'menuactive_laporan'   => 'active open',
            'returpel_active'   => 'active',
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
        if (!hasPermission(Menu::OMZET_OUTLET, 'laporan')) {
            return view('errors/html/error_403');
        }

        $url = URLAPI . "/v1/pelanggan/getall_pelanggan";
        $response = gucitoakAPI($url);
        $pelanggan = $response->message;

        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/omzetpel',
            'extra'     => 'admin/laporan/js/_js_omzetpel',
            'menuactive_laporan'   => 'active open',
            'omzetoutlet_active'   => 'active',
            'pelanggan' => $pelanggan
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function omzet_sales() {

        $url = URLAPI . "/v1/sales/getall_sales";
		$sales = gucitoakAPI($url)->message;

        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'sales/laporan/omzet',
            'extra'     => 'sales/laporan/js/_js_omzetsales',
            'menuactive_laporan'   => 'active open',
            'omzetsales_active'   => 'active',
            'sales' => $sales
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_omzetpel($id){
        $url = URLAPI . "/v1/laporan/omzet_pelanggan?id=$id";
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
    }

    public function get_omzetsales(){
        $id = session()->get('logged_user')['id_sales'] ?? null;
        $url = URLAPI . "/v1/laporan/omzet_sales?id=$id";
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
    }

    public function outlet_idle() {
        if (!hasPermission(Menu::OUTLET_IDLE, 'laporan')) {
            return view('errors/html/error_403');
        }

        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/outletidle',
            'extra'     => 'admin/laporan/js/_js_outlet_idle',
            'menuactive_laporan'   => 'active open',
            'outletidle_active'   => 'active',
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_outletIdle(){
        $url = URLAPI . "/v1/laporan/outlet_idle";
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
    }

    public function penjualan_outlet() {
        if (!hasPermission(Menu::PENJUALAN_OUTLET, 'laporan')) {
            return view('errors/html/error_403');
        }

        $url = URLAPI . "/v1/pelanggan/getall_pelanggan";
        $response = gucitoakAPI($url);
        $pelanggan = $response->message;

        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/penjualanoutlet',
            'extra'     => 'admin/laporan/js/_js_penjualan_outlet',
            'menuactive_laporan'   => 'active open',
            'penjualanoutlet_active'   => 'active',
            'pelanggan' => $pelanggan
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_penjualan_outlet(){
        $id  = $this->request->getVar('id');
        $tahun  = $this->request->getVar('tahun');
        $url = URLAPI . "/v1/laporan/penjualan_outlet?id=".$id."&tahun=".$tahun;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
    }

    public function katalog() {
        // if (!hasPermission(Menu::PENJUALAN_OUTLET, 'laporan')) {
        //     return view('errors/html/error_403');
        // }

        $url = URLAPI . "/v1/kategori/getall_kategori";
        $response = gucitoakAPI($url);
        $kategori = $response->message;

        $mdata = [
            'title'     => 'Katalog - ' . NAMETITLE,
            'content'   => 'admin/laporan/katalog',
            'extra'     => 'admin/laporan/js/_js_katalog',
            'menuactive_laporan'   => 'active open',
            'katalog_active'   => 'active',
            'kategori' => $kategori
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_katalog() {
        $id = $this->request->getVar('id');
        $url = URLAPI . "/v1/laporan/get_katalog?id=$id";
        $response = gucitoakAPI($url)->message;
    
        if ($response) {
            // Add the image path to each item
            $response = array_map(function($res) {
                $res->foto = $res->foto ? "assets/img/produk/" . $res->foto : "assets/img/no-image.png";
                return $res;
            }, $response);
        }
    
        return $this->response->setJSON($response);
    }

    public function hutang_suplier() {
        // if (!hasPermission(Menu::STOK_MIN_BARANG, 'laporan')) {
        //     return view('errors/html/error_403');
        // }
        $mdata = [
            'title'     => 'Laporan Hutang Outlet - ' . NAMETITLE,
            'content'   => 'admin/laporan/hutang_suplier',
            'extra'     => 'admin/laporan/js/_js_hutang_suplier',
            'menuactive_laporan'   => 'active open',
            'hutangsuplier_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }
    

    public function hutang_outlet() {
        // if (!hasPermission(Menu::STOK_MIN_BARANG, 'laporan')) {
        //     return view('errors/html/error_403');
        // }
        $mdata = [
            'title'     => 'Laporan Hutang Outlet - ' . NAMETITLE,
            'content'   => 'admin/laporan/hutang_outlet',
            'extra'     => 'admin/laporan/js/_js_hutang_outlet',
            'menuactive_laporan'   => 'active open',
            'hutangoutlet_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function returpel_monthly() {
        // if (!hasPermission(Menu::PENJUALAN_OUTLET, 'laporan')) {
        //     return view('errors/html/error_403');
        // }

        $url = URLAPI . "/v1/pelanggan/getall_pelanggan";
        $response = gucitoakAPI($url);
        $pelanggan = $response->message;

        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/returpel_monthly',
            'extra'     => 'admin/laporan/js/_js_returpel_monthly',
            'menuactive_laporan'   => 'active open',
            'returpelm_active'   => 'active',
            'pelanggan' => $pelanggan
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function getretur_outletmonthly(){
        $id  = $this->request->getVar('id');
        $tahun  = $this->request->getVar('tahun');
        $url = URLAPI . "/v1/laporan/getretur_outletmonthly?id=".$id."&tahun=".$tahun;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
    }
}
