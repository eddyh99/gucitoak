<?php

namespace App\Controllers;

use App\Enums\Menu;

class Opname extends BaseController
{
    public function index()
    {
        if (!hasPermission(Menu::PENYESUAIAN_STOK, 'persediaan')) {
            return view('errors/html/error_403');
        }
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
        if (!hasPermission(Menu::CONFIRM_OPNAME, 'persediaan')) {
            return view('errors/html/error_403');
        }
        $mdata = [
            'title'     => 'Stok Opname - ' . NAMETITLE,
            'content'   => 'admin/opname/konfirm_opname',
            'extra'     => 'admin/opname/js/_js_konfirm_opname',
            'menuactive_persediaan'   => 'active open',
            'stokbarang_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function detailbarcode($barcode){
        $url = URLAPI . "/v1/barang/getStokBy_barcode?id=".$barcode;
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
    }
    
    public function simpanopname(){
                // Validation Field
        $rules = $this->validate([
            'barcode'     => [
                'label'     => 'Barcode',
                'rules'     => 'required'
            ],
            'keterangan'     => [
                'label'     => 'Keterangan',
                'rules'     => 'required'
            ],
            'riil'     => [
                'label'     => 'Stok Riil',
                'rules'     => 'required'
            ],
        ]);

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "opname")->withInput();
        }
        
        // Initial Data
        // FILTER HTML Special char
        // FILER Trim char
        $barcode    = trim(htmlspecialchars($this->request->getVar('barcode')));

        $url = URLAPI . "/v1/barang/getStokBy_barcode?id=".$barcode;
		$response = gucitoakAPI($url);
        $stok = $response->message->stok;

        $mdata = [
            'barcode'       => $barcode,
            'tanggal'       => date("Y-m-d"),
            'jumlah'        => filter_var($this->request->getVar('riil'),FILTER_SANITIZE_NUMBER_INT)-$stok,
            'keterangan'    => trim(htmlspecialchars($this->request->getVar('keterangan')))
        ];
        
        // CALL API
        $url = URLAPI . "/v1/barang/opname";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;

        // Check response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "opname")->withInput();
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "opname")->withInput();
        }

    }
    
    public function listopname(){
        $url = URLAPI . "/v1/barang/listopname";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);

    }

    public function list_barcode($id){
        $id=base64_decode($id);
        $url = URLAPI . "/v1/barang/opname_barcode?id=".$id;
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
    }

    public function hapusstok()
    {
        if (!hasPermission(Menu::HAPUS_STOK, 'persediaan')) {
            return view('errors/html/error_403');
        }
        $mdata = [
            'title'     => 'Penghapusan Stok - ' . NAMETITLE,
            'content'   => 'admin/opname/hapus_stok',
            'extra'     => 'admin/opname/js/_js_hapus_stok',
            'menuactive_persediaan'   => 'active open',
            'hapusstok_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }
    

    public function savestok(){
        $urlBarang = URLAPI . "/v1/barang/add_dispose";
		$responseBarang = gucitoakAPI($urlBarang,json_encode($_SESSION["stokbarang"]));
        $resultBarang = $responseBarang->message;
        unset($_SESSION['stokbarang']);
        return redirect()->to(BASE_URL . "opname/dispose")->withInput();
        
    }

    public function konfirm_dispose() {
        $mdata = [
            'title'     => 'Stok Opname - ' . NAMETITLE,
            'content'   => 'admin/opname/konfirm_dispose',
            'extra'     => 'admin/opname/js/_js_konfirm_dispose',
            'menuactive_persediaan'   => 'active open',
            'stokbarang_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_disposal(){
        $url = URLAPI . "/v1/barang/get_disposal";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);

    }

    public function setStatus_disposal() {
        $id = base64_decode($this->request->getVar('id'));
        $status = $this->request->getVar('status');
        $url = URLAPI . "/v1/barang/setStatus_disposal?id=$id&status=$status";
        $response = gucitoakAPI($url)->message;
        echo json_encode($response);
    }
    
}
