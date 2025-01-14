<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pembayaran extends BaseController
{
    public function pelanggan()
    {
        $mdata = [
            'title'     => 'List Pembayaran - ' . NAMETITLE,
            'content'   => 'admin/pembayaran/pelanggan',
            'extra'     => 'admin/pembayaran/js/_js_pelanggan',
            'menuactive_transaksi'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_pembayaran_pel() {
        $tgl    = explode("-",$this->request->getVar('tanggal'));
        $awal   = date_format(date_create($tgl[0]),"Y-m-d");
        $akhir  = date_format(date_create($tgl[1]),"Y-m-d");
        $url = URLAPI . "/v1/pembayaran/pelanggan?awal=".$awal."&akhir=".$akhir;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
    }

    public function pelanggan_tambah()
    {
        $mdata = [
            'title'     => 'List Pembayaran - ' . NAMETITLE,
            'content'   => 'admin/pembayaran/pel_tambah',
            'extra'     => 'admin/pembayaran/js/_js_pel_tambah',
            'menuactive_transaksi'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function cekNota_pelanggan($nota) {
        $url = URLAPI . "/v1/pembayaran/cekNota_pelanggan/?nota=".$nota;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response);
    }

    public function getCicilan_pelanggan() {
        $nota  = $this->request->getVar('nota');
        $url = URLAPI . "/v1/pembayaran/getCicilan_pelanggan/?nota=".$nota;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response);
    }

    public function inputCicilan_pelanggan() {
        $totalCicilan = trim($this->request->getVar('t_cicilan'));
        $notaJual = trim($this->request->getVar('notajual'));
        $cicilan = trim($this->request->getVar('amount'));
        
        // validasi agar cicilan > nota_penjualan
        if(($cicilan +$totalCicilan) > $notaJual) {
            session()->setFlashdata('failed', 'Gagal! cicilan melebihi nota jual.');
            return redirect()->to(BASE_URL . "pembayaran/pelanggan/tambah")->withInput();
        }

        $mdata = [
            'nonota'    => trim($this->request->getVar('nonota')),
            'amount'    => $cicilan,
            'keterangan' => trim($this->request->getVar('keterangan'))
        ];

        $url = URLAPI . "/v1/pembayaran/inputCicilan_pelanggan";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;

        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "pembayaran/pelanggan");
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "pembayaran/pelanggan/tambah")->withInput();
        }
    }

    public function suplier()
    {
        $mdata = [
            'title'     => 'List Pembayaran - ' . NAMETITLE,
            'content'   => 'admin/pembayaran/suplier',
            'extra'     => 'admin/pembayaran/js/_js_suplier',
            'menuactive_transaksi'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function get_pembayaran_sup() {
        $tgl    = explode("-",$this->request->getVar('tanggal'));
        $awal   = date_format(date_create($tgl[0]),"Y-m-d");
        $akhir  = date_format(date_create($tgl[1]),"Y-m-d");
        $url = URLAPI . "/v1/pembayaran/suplier?awal=".$awal."&akhir=".$akhir;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
    }

    public function suplier_tambah()
    {
        $mdata = [
            'title'     => 'List Pembayaran - ' . NAMETITLE,
            'content'   => 'admin/pembayaran/sup_tambah',
            'extra'     => 'admin/pembayaran/js/_js_sup_tambah',
            'menuactive_transaksi'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function cekNota_suplier() {
        $nota = $this->request->getVar('nota');
        $url = URLAPI . "/v1/pembayaran/cekNota_suplier/?nota=".$nota;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response);
    }

    public function getCicilan_suplier() {
        $nota  = $this->request->getVar('nota');
        $url = URLAPI . "/v1/pembayaran/getCicilan_suplier/?nota=".$nota;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response);
    }

    public function inputCicilan_suplier() {
        $totalCicilan = trim($this->request->getVar('t_cicilan'));
        $notabeli = trim($this->request->getVar('notabeli'));
        $cicilan = trim($this->request->getVar('amount'));
        
        // validasi agar cicilan > nota_penjualan
        if(($totalCicilan +$cicilan) > $notabeli) {
            session()->setFlashdata('failed', 'Gagal! cicilan melebihi nota jual.');
            return redirect()->to(BASE_URL . "pembayaran/suplier/tambah")->withInput();
        }
        
        $mdata = [
            'id_nota'    => trim($this->request->getVar('id')),
            'amount'    => $cicilan,
            'keterangan' => trim($this->request->getVar('keterangan'))
        ];

        $url = URLAPI . "/v1/pembayaran/inputCicilan_suplier";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;

        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "pembayaran/suplier");
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "pembayaran/suplier/tambah")->withInput();
        }
    }
}
