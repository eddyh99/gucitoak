<?php

namespace App\Controllers;

class Sales extends BaseController
{
    public function index()
    {
        $mdata = [
            'title'     => 'List sales - ' . NAMETITLE,
            'content'   => 'admin/sales/index',
            'extra'     => 'admin/sales/js/_js_index',
            'menuactive_setup'   => 'active open',
            'sales_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function list_all_sales()
    {
        $url = URLAPI . "/v1/sales/getall_sales";
		$response = gucitoakAPI($url);
        $result = $response->result->message;
        echo json_encode($result);
        die;
    }

    public function tambah_sales()
    {
        $mdata = [
            'title'     => 'Tambah sales - ' . NAMETITLE,
            'content'   => 'admin/sales/tambah_sales',
            'extra'     => 'admin/sales/js/_js_index',
            'menuactive_setup'   => 'active open',
        ];

        return view('admin/layout/wrapper', $mdata);
    }


    public function tambah_proccess()
    {

        // Convert and remove replace coma (,) in omzet value
        $omzet = $this->request->getVar("omzet");
        $new_omzet = str_replace(',', '', $omzet);
        $_POST["omzet"] = $new_omzet;

        // Validation Rules
        $rules = $this->validate([
            'sales'     => [
                'label'     => 'Nama Sales',
                'rules'     => 'required|trim'
            ],
            'alamat'     => [
                'label'     => 'Alamat',
                'rules'     => 'required'
            ],
            'kota'     => [
                'label'     => 'Kota',
                'rules'     => 'required'
            ],
            'telp'     => [
                'label'     => 'Telphone',
                'rules'     => 'required'
            ],
            'omzet'     => [
                'label'     => 'Omzet',
                'rules'     => 'required'
            ],
        ]);

        // Checking Validation
        if (!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "sales/tambah_sales")->withInput();
        }
        
        // Initial Data
        $mdata = [
            'namasales'     => trim(htmlspecialchars($this->request->getVar('sales'))),
            'alamat'        => trim(htmlspecialchars($this->request->getVar('alamat'))),
            'kota'          => trim(htmlspecialchars($this->request->getVar('kota'))),
            'telp'          => trim(htmlspecialchars($this->request->getVar('telp'))),
            'omzet'         => trim(filter_var($this->request->getVar('omzet'),FILTER_SANITIZE_NUMBER_INT)),
        ];

        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/sales/add_sales";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->result;
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;
        if (@$response->status != 200) {
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "sales/tambah_sales")->withInput();
        }else{
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "sales");
        }
    }

    public function edit_sales($sales)
    {
        $sales=base64_decode($sales);
        $url = URLAPI . "/v1/sales/getsales_byid?id=".$sales;
		$response = gucitoakAPI($url);
        $result = $response->result->message;
        // print_r($result);
        // die;
        $mdata = [
            'title'     => 'Edit sales - ' . NAMETITLE,
            'content'   => 'admin/sales/edit_sales',
            'extra'     => 'admin/sales/js/_js_index',
            'active_sales'   => 'active',
            'sales'  => $result
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function ubah_sales()
    {

        // Convert and remove replace coma (,) in omzet value
        $omzet = $this->request->getVar("omzet");
        $new_omzet = str_replace(',', '', $omzet);
        $_POST["omzet"] = $new_omzet;

        // Validation Rules
        $rules = $this->validate([
            'sales'     => [
                'label'     => 'Nama Sales',
                'rules'     => 'required'
            ],
            'alamat'     => [
                'label'     => 'Alamat',
                'rules'     => 'required'
            ],
            'kota'     => [
                'label'     => 'Kota',
                'rules'     => 'required'
            ],
            'telp'     => [
                'label'     => 'Telphone',
                'rules'     => 'required'
            ],
            'omzet'     => [
                'label'     => 'Omzet',
                'rules'     => 'required'
            ],
        ]);

        $idsales = $this->request->getVar('idsales');

        // Checking Validation
        if (!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "sales/edit_sales/".base64_encode($idsales))->withInput();
        }
        
        // Initial Data
        $mdata = [
            'namasales'     => htmlspecialchars($this->request->getVar('sales')),
            'alamat'        => htmlspecialchars($this->request->getVar('alamat')),
            'kota'          => htmlspecialchars($this->request->getVar('kota')),
            'telp'          => htmlspecialchars($this->request->getVar('telp')),
            'omzet'         => filter_var($this->request->getVar('omzet'),FILTER_SANITIZE_NUMBER_INT),
        ];
        

        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/sales/ubah_sales?id=".$idsales;
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->result;
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;
        if (@$response->status != 200) {
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "sales/edit_sales/".base64_encode($idsales))->withInput();
        }else{
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "sales")->withInput();
        }
    }

    public function hapus_sales($sales)
    {
        $sales = base64_decode($sales);
        $url = URLAPI . "/v1/sales/hapus_sales?id=".$sales;
		$response = gucitoakAPI($url);
        $result = $response->result;


        if($response->status == 200){
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "sales");
        }else{
            session()->setFlashdata('error', $result->message);
            return redirect()->to(BASE_URL . "sales");
        }
    }

    
    public function list_assign_sales()
    {
        $mdata = [
            'title'     => 'Assign Sales - ' . NAMETITLE,
            'content'   => 'admin/sales/list_assignsales',
            'extra'     => 'admin/sales/js/_js_assignsales',
            'menuactive_master'   => 'active open',
            'assignsales_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }
    
    public function assign_sales()
    {
        $mdata = [
            'title'     => 'Assign Sales - ' . NAMETITLE,
            'content'   => 'admin/sales/assignsales',
            'extra'     => 'admin/sales/js/_js_assignsales',
            'menuactive_master'   => 'active open',
            'assignsales_active'   => 'active'
        ];

        return view('admin/layout/wrapper', $mdata);
    }


}
