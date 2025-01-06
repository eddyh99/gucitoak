<?php

namespace App\Controllers;

class Pembelian extends BaseController
{
    public function index()
    {
        $mdata = [
            'title'     => 'List Pembelian - ' . NAMETITLE,
            'content'   => 'admin/pembelian/index',
            'extra'     => 'admin/pembelian/js/_js_index',
            'menuactive_transaksi'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_pembelian()
    {
        $urlsuplier   = URLAPI . "/v1/suplier/getall_suplier";
		$suplier      = gucitoakAPI($urlsuplier)->message;

        $mdata = [
            'title'     => 'Tambah Pembelian - ' . NAMETITLE,
            'content'   => 'admin/pembelian/tambah',
            'extra'     => 'admin/pembelian/js/_js_tambah',
            'suplier'   => $suplier,
            'menuactive_transaksi'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_list_stokbarang()
    {
        $stokdata = @$_SESSION['barangbeli'];
        if(empty($stokdata)){
            echo json_encode([]);
        }else{
            echo json_encode($stokdata);
        }
    }
    
    public function save_stok_session()
    {
        $data = $this->request->getVar('data');
        $stokdata = @$_SESSION['barangbeli'];
        
        // Cek jika Session kosong
        if(empty($stokdata)){
            $this->session->set("barangbeli", [$data]);
        }else{
            array_push($stokdata, $data);
            $this->session->set("barangbeli", $stokdata);
        }
        die;
    }

    public function clear_stok_session()
    {
        $this->session->remove("barangbeli");
    }
   

    public function delete_stok_session()
    {
        $barcode = $this->request->getVar('barcode'); // Get barcode from request
        $stokdata = @$_SESSION['barangbeli']; // Retrieve current session data
    
        if (!empty($stokdata)) {
            // Filter out the row with the matching barcode
            $stokdata = array_filter($stokdata, function($item) use ($barcode) {
                return $item['barcode'] !== $barcode;
            });
    
            // Re-index the array to maintain order
            $stokdata = array_values($stokdata);
    
            // Update the session with the new array
            $this->session->set("barangbeli", $stokdata);
        } else {
            echo json_encode(['success' => false, 'message' => 'No data in session to delete.']);
        }
        die;
    }
    
    public function simpanpembelian(){
                // Validation Field
        $rules = $this->validate([
            'suplier'     => [
                'label'     => 'Nama Suplier',
                'rules'     => 'required'
            ],
            'pembayaran'     => [
                'label'     => 'Pembayaran',
                'rules'     => 'required'
            ],
        ]);

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "pembelian/tambah_pembelian")->withInput();
        }
        
        // Initial Data
        // FILTER HTML Special char
        // FILER Trim char
        $mdata = [
            'nonota'        => trim($this->request->getVar('nonota')),
            'id_suplier'    => trim($this->request->getVar('suplier')),
            'tanggal'       => date_format(date_create($this->request->getVar('tanggal')),"Y-m-d"),
            'method'        => trim(htmlspecialchars($this->request->getVar('pembayaran'))),
            'waktu'         => trim(htmlspecialchars($this->request->getVar('lama'))),
            'detail'        => $_SESSION["barangbeli"]
        ];
        

        // CALL API
        $url = URLAPI . "/v1/pembelian/add_pembelian";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;
        unset($_SESSION['barangbeli']);
        // Check response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "pembelian");
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "pembelian/tambah_pembelian")->withInput();
        }

    }
    
    public function get_allpembelian(){
        $tgl    = explode("-",$this->request->getVar('tanggal'));
        $awal   = date_format(date_create($tgl[0]),"Y-m-d");
        $akhir  = date_format(date_create($tgl[1]),"Y-m-d");
        $url = URLAPI . "/v1/pembelian/get_allpembelian?awal=".$awal."&akhir=".$akhir;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
    }
    
    public function list_barang($id){
        $url = URLAPI . "/v1/pembelian/get_barangbeli?id=".base64_decode($id);
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
    }

}
