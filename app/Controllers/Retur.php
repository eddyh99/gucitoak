<?php

namespace App\Controllers;

use App\Enums\Menu;

class Retur extends BaseController
{
    public function pelanggan()
    {
        if (!hasPermission(Menu::RETUR_PELANGGAN, 'transaksi')) {
            return view('errors/html/error_403');
        }
        $mdata = [
            'title'     => 'Retur Pelanggan - ' . NAMETITLE,
            'content'   => 'admin/retur/pelanggan',
            'extra'     => 'admin/retur/js/_js_pelanggan',
            'menuactive_transaksi'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function suplier()
    {
        if (!hasPermission(Menu::RETUR_SUPLIER, 'transaksi')) {
            return view('errors/html/error_403');
        }
        $mdata = [
            'title'     => 'Retur Suplier - ' . NAMETITLE,
            'content'   => 'admin/retur/suplier',
            'extra'     => 'admin/retur/js/_js_suplier',
            'menuactive_transaksi'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_returpel()
    {

        $urlplg     = URLAPI . "/v1/pelanggan/get_detailpelanggan";
		$pelanggan  = gucitoakAPI($urlplg)->message;
        $mdata = [
            'title'     => 'Tambah Retur Pelanggan - ' . NAMETITLE,
            'content'   => 'admin/retur/tambah_returpel',
            'extra'     => 'admin/retur/js/_js_tambahpel',
            'pelanggan' => $pelanggan,
            'menuactive_transaksi'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_retursup()
    {
        $urlsuplier   = URLAPI . "/v1/suplier/getall_suplier";
		$suplier      = gucitoakAPI($urlsuplier)->message;
        $mdata = [
            'title'     => 'Tambah Retur Suplier - ' . NAMETITLE,
            'content'   => 'admin/retur/tambah_retursup',
            'extra'     => 'admin/retur/js/_js_tambahsup',
            'suplier'   => $suplier,
            'menuactive_transaksi'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_list_stokbarang()
    {
        $stokdata = @$_SESSION['barangretur'];
        if(empty($stokdata)){
            echo json_encode([]);
        }else{
            echo json_encode($stokdata);
        }
    }
    
    public function save_stok_session()
    {
        $data = $this->request->getVar('data');
        $stokdata = @$_SESSION['barangretur'];
        
        // Cek jika Session kosong
        if(empty($stokdata)){
            $this->session->set("barangretur", [$data]);
        }else{
            array_push($stokdata, $data);
            $this->session->set("barangretur", $stokdata);
        }
        die;
    }

    public function clear_stok_session()
    {
        $this->session->remove("barangretur");
    }
   

    public function delete_stok_session()
    {
        $barcode = $this->request->getVar('barcode'); // Get barcode from request
        $stokdata = @$_SESSION['barangretur']; // Retrieve current session data
    
        if (!empty($stokdata)) {
            // Filter out the row with the matching barcode
            $stokdata = array_filter($stokdata, function($item) use ($barcode) {
                return $item['barcode'] !== $barcode;
            });
    
            // Re-index the array to maintain order
            $stokdata = array_values($stokdata);
    
            // Update the session with the new array
            $this->session->set("barangretur", $stokdata);
        } else {
            echo json_encode(['success' => false, 'message' => 'No data in session to delete.']);
        }
        die;
    }
    
    public function simpanreturpel(){
                // Validation Field
        $rules = $this->validate([
            'pelanggan'     => [
                'label'     => 'Nama Pelanggan',
                'rules'     => 'required'
            ],
        ]);

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "retur/tambah_returpel")->withInput();
        }
        
        // Initial Data
        // FILTER HTML Special char
        // FILER Trim char
        $mdata = [
            'pelanggan_id'  => trim($this->request->getVar('pelanggan')),
            'detail'        => $_SESSION["barangretur"]
        ];
        
        // CALL API
        $url = URLAPI . "/v1/retur/add_returpel";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;
        unset($_SESSION['barangretur']);
        // Check response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "retur/pelanggan");
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "retur/tambah_returpel")->withInput();
        }

    }

    public function simpanretursup(){
                // Validation Field
        $rules = $this->validate([
            'suplier'     => [
                'label'     => 'Nama Suplier',
                'rules'     => 'required'
            ],
        ]);

        // Checking Validation
        if(!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "retur/tambah_retursup")->withInput();
        }
        
        // Initial Data
        // FILTER HTML Special char
        // FILER Trim char
        $mdata = [
            'id_suplier'  => trim($this->request->getVar('suplier')),
            'detail'        => $_SESSION["barangretur"]
        ];
        
        // CALL API
        $url = URLAPI . "/v1/retur/add_retursup";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;
        unset($_SESSION['barangretur']);
        // Check response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "retur/suplier");
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "retur/tambah_retursup")->withInput();
        }

    }
    
    public function get_retursuplier(){
        $tgl    = explode("-",$this->request->getVar('tanggal'));
        $awal   = date_format(date_create($tgl[0]),"Y-m-d");
        $akhir  = date_format(date_create($tgl[1]),"Y-m-d");
        $url    = URLAPI . "/v1/retur/get_retursuplier?awal=".$awal."&akhir=".$akhir;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
        
    }

    public function get_returpelanggan(){
        $tgl    = explode("-",$this->request->getVar('tanggal'));
        $awal   = date_format(date_create($tgl[0]),"Y-m-d");
        $akhir  = date_format(date_create($tgl[1]),"Y-m-d");
        $url = URLAPI . "/v1/retur/get_returpelanggan?awal=".$awal."&akhir=".$akhir;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
        
    }
    
    public function list_barangsup($id){
        $url = URLAPI . "/v1/retur/getbarang_retursup?id=".base64_decode($id);
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);

    }

    public function list_barangpel($id){
        $url = URLAPI . "/v1/retur/getbarang_returpel?id=".base64_decode($id);
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);

    }

}
