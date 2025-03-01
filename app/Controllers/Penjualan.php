<?php

namespace App\Controllers;

use App\Enums\Menu;
use Dompdf\Dompdf;
use Dompdf\Options;

class Penjualan extends BaseController
{
    public function index()
    {
        if (!hasPermission(Menu::PENJUALAN, 'transaksi')) {
            return view('errors/html/error_403');
        }
        $mdata = [
            'title'     => 'List Penjualan - ' . NAMETITLE,
            'content'   => 'admin/penjualan/index',
            'extra'     => 'admin/penjualan/js/_js_index',
            'menuactive_transaksi'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_penjualan()
    {
        $urlsales   = URLAPI . "/v1/sales/getall_sales";
		$sales      = gucitoakAPI($urlsales)->message;

        $urlplg     = URLAPI . "/v1/pelanggan/get_detailpelanggan";
		$pelanggan  = gucitoakAPI($urlplg)->message;
        $mdata = [
            'title'     => 'Tambah Penjualan - ' . NAMETITLE,
            'content'   => 'admin/penjualan/tambah',
            'extra'     => 'admin/penjualan/js/_js_tambah',
            'sales'     => $sales,
            'pelanggan' => $pelanggan,
            'menuactive_transaksi'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_list_stokbarang()
    {
        $stokdata = @$_SESSION['barangjual'];
        if(empty($stokdata)){
            echo json_encode([]);
        }else{
            echo json_encode($stokdata);
        }
    }
    
    public function save_stok_session()
    {
        $data = $this->request->getVar('data');
        $stokdata = @$_SESSION['barangjual'];

        $barang = substr($data['barcode'], 0, 12);
        $jumlah = $data['jml'];
        // Cek jika Session kosong
        if(empty($stokdata)){
            $this->session->set("barangjual", [$data]);
            echo json_encode(['success' => true]);
        }else{
            foreach ($stokdata as &$item) {
                if (substr($item['barcode'], 0, 12) == $barang) {
                    $jumlah += $item['jml'];
                }
            }
            // cek jumlah stok disession apakah lebih dari stok database
            if($jumlah > $data['stok_barang']) {
                echo json_encode(['success' => false, 'message' => 'Out of stock']);
            } else {
                array_push($stokdata, $data);
                $this->session->set("barangjual", $stokdata);
                echo json_encode(['success' => true, 'message' => $jumlah]);
            }   
        }
        die;
    }

    public function clear_stok_session()
    {
        $this->session->remove("barangjual");
    }
   

    public function delete_stok_session()
    {
        $barcode = $this->request->getVar('barcode'); // Get barcode from request
        $stokdata = @$_SESSION['barangjual']; // Retrieve current session data
    
        if (!empty($stokdata)) {
            // Filter out the row with the matching barcode
            $stokdata = array_filter($stokdata, function($item) use ($barcode) {
                return $item['barcode'] !== $barcode;
            });
    
            // Re-index the array to maintain order
            $stokdata = array_values($stokdata);
    
            // Update the session with the new array
            $this->session->set("barangjual", $stokdata);
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No data in session to delete.']);
        }
        die;
    }
    
    public function simpanpenjualan(){
                // Validation Field
        $rules = $this->validate([
            'sales'     => [
                'label'     => 'Nama Sales',
                'rules'     => 'required'
            ],
            'pelanggan'     => [
                'label'     => 'Nama Pelanggan',
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
            return redirect()->to(BASE_URL . "penjualan/tambah_penjualan")->withInput();
        }
        
        // Initial Data
        // FILTER HTML Special char
        // FILER Trim char
        $mdata = [
            'pelanggan_id'  => trim($this->request->getVar('pelanggan')),
            'sales_id'      => trim($this->request->getVar('sales')),
            'method'        => trim(htmlspecialchars($this->request->getVar('pembayaran'))),
            'waktu'         => trim(htmlspecialchars($this->request->getVar('lama'))),
            'detail'        => $_SESSION["barangjual"]
        ];
        

        // CALL API
        $url = URLAPI . "/v1/penjualan/add_penjualan";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;
        unset($_SESSION['barangjual']);
        // Check response API
        if ($response->code == 200 || $response->code == 201) {
            $this->cetakPDF(base64_encode($result->nonota));
            session()->setFlashdata('success', $result->success);
            return redirect()->to(BASE_URL . "penjualan");
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "penjualan/tambah_penjualan")->withInput();
        }

    }
    
    public function get_allpenjualan(){
        $tgl    = explode("-",$this->request->getVar('tanggal'));
        $awal   = date_format(date_create($tgl[0]),"Y-m-d");
        $akhir  = date_format(date_create($tgl[1]),"Y-m-d");
        $url = URLAPI . "/v1/penjualan/get_allpenjualan?awal=".$awal."&akhir=".$akhir;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
        
    }
    
    public function list_barang($nonota){
        $url = URLAPI . "/v1/penjualan/get_barangjual?nonota=".base64_decode($nonota);
        $response = gucitoakAPI($url)->message;
        return json_encode($response,true);
    }

    public function set_statusBarang($nonota){
        $url = URLAPI . "/v1/penjualan/set_statusBarang?nonota=".base64_decode($nonota);
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
    }

    public function cetakPDF($nonota)
    {
        $logo = FCPATH . 'assets/img/logo-no-text.png';
        $data = file_get_contents($logo);
        $base64 = 'data:image/png' . ';base64,' . base64_encode($data);
        $date = date('Y-m-d-His');
        // Load view yang ingin dicetak sebagai PDF
        $mdata = $this->list_barang($nonota);
        $html = view('admin/penjualan/cetak', ['mdata' => json_decode($mdata), 'logo' => $base64]);

        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'NotaFonts');
        
        // Buat instance Dompdf
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape'); // HAPUS ini
        $dompdf->render();

        $folderPath = 'assets/pdf/';
        $fileName = "invoice-$date.pdf";
        // Pastikan folder tersedia
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }
        file_put_contents($folderPath . $fileName, $dompdf->output());

        // Eksekusi print
        // exec("print /D:\\\\NamaPrinter " . escapeshellarg($folderPath)); //windows
        // exec("lp " . escapeshellarg($folderPath)); //linux
        // unlink($folderPath); //hapus file pdf

        // Return response
        return json_encode([
            "status" => "success",
            "path" => "assets/pdf/$fileName"
        ]);

        // $dompdf->stream("invoice-$date.pdf", ["Attachment" => false]);
    }

    // for testing
    // public function cetak()
    // {
    //     // Load view yang ingin dicetak sebagai PDF
    //     $mdata = $this->list_barang('MDAwMDAy');
    //     $html = view('admin/penjualan/cetak', ['mdata' => json_decode($mdata)]);
    //     return $html;
    // }


}
