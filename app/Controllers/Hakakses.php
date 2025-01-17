<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Enums\Menu;

class Hakakses extends BaseController
{
    public function index()
    {
        $url = URLAPI . "/v1/pengguna/getAkses_pengguna";
		$users = gucitoakAPI($url)->message;
        $submenu_setup = Menu::subMenu_setup();
        $submenu_persediaan = Menu::subMenu_persediaan();
        $submenu_transaksi = Menu::subMenu_transaksi();
        $submenu_laporan = Menu::subMenu_laporan();
        $mdata = [
            'title'     => 'Hak Akses - ' . NAMETITLE,
            'content'   => 'admin/hak-akses/index',
            'extra'     => 'admin/hak-akses/js/_js_index',
            'active_dash'   => 'active',
            'users' => $users,
            'submenu_setup' => $submenu_setup,
            'submenu_persediaan' => $submenu_persediaan,
            'submenu_transaksi' => $submenu_transaksi,
            'submenu_laporan' => $submenu_laporan
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    // belum bisa update akses
    public function give_akses() {
        $akses = array_filter($this->request->getVar(['setup', 'persediaan', 'transaksi', 'laporan']));

        $mdata = [
            'pengguna_id'    => $this->request->getVar('user'),
            'akses' => $akses
        ];

        $url = URLAPI . "/v1/pengguna/hak_akses";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;

        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "hakakses");
        }else{
            session()->setFlashdata('failed', $result);
            return redirect()->to(BASE_URL . "hakakses");
        }
    }
}
