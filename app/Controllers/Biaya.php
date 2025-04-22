<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Enums\Menu;
use CodeIgniter\HTTP\ResponseInterface;

class Biaya extends BaseController
{
    public function index()
    {
        // if (!hasPermission(Menu::PEMBAYARAN_PELANGGAN, 'transaksi')) {
        //     return view('errors/html/error_403');
        // }
        $mdata = [
            'title'     => 'List Biaya - ' . NAMETITLE,
            'content'   => 'admin/biaya/index',
            'extra'     => 'admin/biaya/js/_js_index',
            'menuactive_transaksi'   => 'active open',
            'trx_biaya'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function getall_biaya() {
        $bulan  = $this->request->getVar('bulan');
        $tahun  = $this->request->getVar('tahun');
        $url = URLAPI . "/v1/biaya/getall_biaya?bulan=".$bulan."&tahun=".$tahun;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
    }

    public function simpan() {
        $mdata = [
            'deskripsi'  => trim($this->request->getVar('deskripsi')),
            'tanggal'    => trim($this->request->getVar('tanggal')),
            'nominal'    => trim($this->request->getVar('nominal'))
        ];

        // CALL API
        $url = URLAPI . "/v1/biaya/add_biaya";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;

        if($response->code != 201) {
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "biaya")->withInput();
        }

        session()->setFlashdata('success', $result);
        return redirect()->to(BASE_URL . "biaya");
    }
}
