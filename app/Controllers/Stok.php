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
        
        // CALL API BARANG
        $urlBarang = URLAPI . "/v1/barang/getall_barang";
		$responseBarang = gucitoakAPI($urlBarang);
        $resultBarang = $responseBarang->message;
        
        // CALL API CABANG
        $urlCabang = URLAPI . "/v1/cabang/getall_cabang";
		$responseCabang = gucitoakAPI($urlCabang);
        $resultCabang = $responseCabang->message;

        // dd($_SESSION);

        $mdata = [  
            'title'     => 'Tambah Stok Barang - ' . NAMETITLE,
            'content'   => 'admin/stok/tambah_stokbarang',
            'extra'     => 'admin/stok/js/_js_tambahbarang',
            'menuactive_persediaan'   => 'active open',
            'stokbarang_active'   => 'active', 
            'barang'    => $resultBarang,
            'cabang'    => $resultCabang
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_list_stokbarang()
    {
        $stokdata = @$_SESSION['stokbarang'];
        if(empty($stokdata)){
            echo json_encode([]);
        }else{
            echo json_encode($stokdata);
        }
    }

    public function save_stok_session()
    {
        $data = $this->request->getVar('data');
        $stokdata = @$_SESSION['stokbarang'];
        
        // Cek jika Session kosong
        if(empty($stokdata)){
            $this->session->set("stokbarang", [$data]);
        }else{
            array_push($stokdata, $data);
            $this->session->set("stokbarang", $stokdata);
        }
        die;
    }

    public function clear_stok_session()
    {
        $this->session->remove("stokbarang");
    }


}
