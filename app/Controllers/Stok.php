<?php

namespace App\Controllers;

use App\Enums\Menu;

class Stok extends BaseController
{

    public function index()
    {
        if (!hasPermission(Menu::STOK_BARANG, 'persediaan')) {
            return view('errors/html/error_403');
        }
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
        $url = URLAPI . "/v1/barang/getstok";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
    }

    public function tambah_stokbarang()
    {
        if (!hasPermission(Menu::INPUT_STOK, 'persediaan')) {
            return view('errors/html/error_403');
        }
        
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
            'menuactive_persediaan'   => 'show',
            'inputstok_active'   => 'active', 
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
        $barcode = $data['barcode'];

        // Cek jika Session kosong
        if (empty($stokdata)) {
            $this->session->set("stokbarang", [$data]);
        } else {
            // Cek apakah barcode sudah ada
            $found = false;
            foreach ($stokdata as &$item) {
                if ($item['barcode'] === $data['barcode'] && $item['kodebrg'] === $data['kodebrg'] ) {
                    $item['stok'] += $data['stok'];
                    $found = true;
                    break;
                }
            }

            // jika tidak ada
            if (!$found) {
                $stokdata[] = $data;
            }
            $this->session->set("stokbarang", $stokdata);
        }
        die;
    }

    public function clear_stok_session()
    {
        $this->session->remove("stokbarang");
    }

    public function clear_stok_session_item()
    {
        $data = $this->request->getVar('data');
        $stokdata = @$_SESSION['stokbarang'];
        $stokdata = array_filter($stokdata, function($item) use ($data) {
            var_dump($data);
            return !($item['barcode'] == $data['barcode'] && $item['kodebrg'] == $data['kodebrg']);
        });
    
        // Reindex array
        $stokdata = array_values($stokdata);
        $this->session->set("stokbarang", $stokdata);
        die;
    }

    public function savestok(){

        $postData = $this->request->getPost();

        if (!empty($postData)) {
            $data = $this->validate_stokform($postData);
            if(!$data->validated) {
                session()->setFlashdata('failed', $data->message);
                return redirect()->to(BASE_URL . "pembelian/tambah_pembelian")->withInput();
            }

            $data = $data->message;

        } else {
            $data = $_SESSION["stokbarang"];
        }

        $urlBarang = URLAPI . "/v1/barang/add_stok";
		$responseBarang = gucitoakAPI($urlBarang,json_encode($data));

        if (isset($_SESSION['stokbarang'])) {
            unset($_SESSION['stokbarang']);
            return redirect()->to(BASE_URL . "stok")->withInput();
        }

        session()->setFlashdata('success', $responseBarang->message);
        return redirect()->to(BASE_URL . "pembelian/tambah_pembelian")->withInput();
        
    }

    private function validate_stokform($data) {
        $validation = $this->validation;

            $validation->setRules([
                'id_barang' => [
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Kode barang wajib diisi',
                    ]
                ],
                'barcodex' => [
                    'rules'  => 'required|exact_length[18]',
                    'errors' => [
                        'required' => 'Barcode wajib diisi',
                    ]
                ],
                'stok' => [
                    'rules'  => 'required|integer',
                    'errors' => [
                        'required' => 'Jumlah stok wajib diisi',
                        'integer'  => 'Stok harus berupa angka',
                    ]
                ],
            ]);
    
            if (!$validation->withRequest($this->request)->run()) {
                return (object) [
                    'validated' => false,
                    'message' => $validation->listErrors()
                ];
            }
    
            $barcode = $this->request->getVar('barcodex');
            $last6 = substr($barcode, -6);
            $day = (int) substr($last6, 0, 2);
            $month = (int) substr($last6, 2, 2);
            $year = '20' . substr($last6, 4, 2);
            $expdate = sprintf('%02d/%02d/%02d', $day, $month, $year);
        
            // Validate expiration date
            if (!checkdate($month, $day, $year)) {
                return (object) [
                    'validated' => false,
                    'message' => 'Tanggal expired tidak valid.'
                ];
            }

            $data = [
                [
                'kodebrg' => $this->request->getVar('id_barang'),
                'barcode' => $barcode,
                'expdate' => $expdate,
                'stok' => $this->request->getVar('stok'),
            ]];

            return (object) [
                'validated' => true,
                'message' => $data
            ];
    }

    // public function savestok(){
    //     $urlBarang = URLAPI . "/v1/barang/add_stok";
	// 	$responseBarang = gucitoakAPI($urlBarang,json_encode($_SESSION["stokbarang"]));
    //     $resultBarang = $responseBarang->message;
    //     unset($_SESSION['stokbarang']);
    //     return redirect()->to(BASE_URL . "stok")->withInput();
        
    // }
    
    public function list_barcode($id){
        $id=base64_decode($id);
        $url = URLAPI . "/v1/barang/detailstok?id=".$id;
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
        
    }

}
