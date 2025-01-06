<?php

namespace App\Controllers;

class Laporan extends BaseController
{
    public function mutasistok()
    {
        $mdata = [
            'title'     => 'Mutasi Stok - ' . NAMETITLE,
            'content'   => 'admin/laporan/mutasistok',
            'extra'     => 'admin/laporan/js/_js_mutasi',
            'menuactive_laporan'   => 'active open',
            'user_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function get_mutasi(){
        $bulan  = $this->request->getVar('bulan');
        $tahun  = $this->request->getVar('tahun');
        $url = URLAPI . "/v1/laporan/mutasi_stok?bulan=".$bulan."&tahun=".$tahun;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
        
    }
    

}
