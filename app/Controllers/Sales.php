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

        $validation = $this->validation;
        $validation->setRules([
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
                'label'     => 'Telp',
                'rules'     => 'required'
            ],
        ]);

        // Checking Validation
        if (!$validation->withRequest($this->request)->run()){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "sales/tambah_sales")->withInput();
        }
        
        // Initial Data
        $mdata = [
            'namasales'     => htmlspecialchars($this->request->getVar('sales')),
            'alamat'        => htmlspecialchars($this->request->getVar('alamat')),
            'kota'          => htmlspecialchars($this->request->getVar('kota')),
            'telp'          => htmlspecialchars($this->request->getVar('telp')),
            'omzet'         => filter_var($this->request->getVar('omzet'),FILTER_SANITIZE_NUMBER_INT),
        ];
        // echo "<pre>".print_r($mdata,true)."</pre>";
        // die;
        // @todo::Mengubah endpoint beserta field nya
        $url = URLAPI . "/v1/sales/add_sales";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->result;
        // echo "<pre>".print_r($result,true)."</pre>";
        // die;
        if (@$response->status != 201) {
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "sales/tambah_sales")->withInput();
        }else{
            session()->setFlashdata('success', $result->message);
            return redirect()->to(BASE_URL . "sales")->withInput();
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

        $validation = $this->validation;
        $validation->setRules([
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
                'label'     => 'Telp',
                'rules'     => 'required'
            ],
        ]);

        $idsales=$this->request->getVar('idsales');
        // Checking Validation
        if (!$validation->withRequest($this->request)->run()){
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
