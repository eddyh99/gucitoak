<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    // public function __construct()
    // {
    //     $session = session();
    //     if(!$session->has('logged_user')){
    //         header("Location:".BASE_URL );
    //         exit();
    //     }
    // }

    public function index()
    {
        $mdata = [
            'title'     => 'Dashboard - ' . NAMETITLE,
            'content'   => 'admin/dashboard/index',
            'extra'     => 'admin/dashboard/js/_js_index',
            'active_dash'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


}
