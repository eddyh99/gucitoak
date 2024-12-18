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
}
