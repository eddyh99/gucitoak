<?php

namespace App\Controllers;

use App\Enums\Menu;

class Sales extends BaseController
{
    public function index()
    {
        if (!hasPermission(Menu::DAFTAR_SALES, 'setup')) {
            return view('errors/html/error_403');
        }
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
        $result = $response->message;
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

        // Checking Validation
        if (!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "sales/tambah_sales")->withInput();
        }
        
        // Initial Data
        // FILTER HTML SPECIAL CHARS
        // FILTER TRIM DATA
        // FILTER SANITIZE NUMBER INTEGER
        $mdata = [
            'namasales'     => trim(htmlspecialchars($this->request->getVar('sales'))),
            'alamat'        => trim(htmlspecialchars($this->request->getVar('alamat'))),
            'kota'          => trim(htmlspecialchars($this->request->getVar('kota'))),
            'telp'          => trim(htmlspecialchars($this->request->getVar('telp'))),
            'omzet'         => trim(filter_var($this->request->getVar('omzet'), FILTER_SANITIZE_NUMBER_INT)),
            'gajipokok'     => trim(filter_var($this->request->getVar('gapok'), FILTER_SANITIZE_NUMBER_INT)),
            'komisi'        => trim(filter_var($this->request->getVar('komisi'), FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION)),
        ];


        // CALL API
        $url = URLAPI . "/v1/sales/add_sales";
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;


        // Check response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "sales");
            exit();
        }else{
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "sales/tambah_sales")->withInput();
            exit();
        }
    }

    public function edit_sales($sales)
    {
        // Get segment idsales
        $sales=base64_decode($sales);

        // Call API
        $url = URLAPI . "/v1/sales/getsales_byid?id=".$sales;
		$response = gucitoakAPI($url);
        $result = $response->message;
        
        $mdata = [
            'title'     => 'Edit sales - ' . NAMETITLE,
            'content'   => 'admin/sales/edit_sales',
            'extra'     => 'admin/sales/js/_js_index',
            'menuactive_setup'   => 'active open',
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
        // FILTER HTML SPECIAL CHARS
        // FILTER TRIM DATA
        // FILTER SANITIZE NUMBER INTEGER
        $mdata = [
            'namasales'     => trim(htmlspecialchars($this->request->getVar('sales'))),
            'alamat'        => trim(htmlspecialchars($this->request->getVar('alamat'))),
            'kota'          => trim(htmlspecialchars($this->request->getVar('kota'))),
            'telp'          => trim(htmlspecialchars($this->request->getVar('telp'))),
            'omzet'         => trim(filter_var($this->request->getVar('omzet'), FILTER_SANITIZE_NUMBER_INT)),
            'gajipokok'     => trim(filter_var($this->request->getVar('gapok'), FILTER_SANITIZE_NUMBER_INT)),
            'komisi'        => trim(filter_var($this->request->getVar('komisi'), FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION)),
        ];
        

        // CALL API
        $url = URLAPI . "/v1/sales/ubah_sales?id=".$idsales;
        $response = gucitoakAPI($url, json_encode($mdata));
        $result = $response->message;


        // Checking response API
        if ($response->code == 200 || $response->code == 201) {
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "sales")->withInput();
            exit();
        }else{
            session()->setFlashdata('failed', $result->message);
            return redirect()->to(BASE_URL . "sales/edit_sales/".base64_encode($idsales))->withInput();
            exit();
        }
    }

    public function hapus_sales($sales)
    {
        // GET id sales from segment
        $idsales = base64_decode($sales);

        // CALL API
        $url = URLAPI . "/v1/sales/hapus_sales?id=".$idsales;
		$response = gucitoakAPI($url);
        $result = $response->message;

        // Check response API
        if($response->code == 200){
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "sales");
        }else{
            session()->setFlashdata('error', $result);
            return redirect()->to(BASE_URL . "sales");
        }
    }

    
    public function list_assign_sales()
    {
        if (!hasPermission(Menu::DAFTAR_BARANG_SALES, 'setup')) {
            return view('errors/html/error_403');
        }
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
        // CALL API SALES
        $urlSales = URLAPI . "/v1/sales/getall_sales";
		$responseSales = gucitoakAPI($urlSales);
        $resultSales = $responseSales->message;

        // CALL API BARANG
        $urlBarang = URLAPI . "/v1/barang/getall_barang";
		$responseBarang = gucitoakAPI($urlBarang);
        $resultBarang = $responseBarang->message;

        $mdata = [
            'title'     => 'Assign Sales - ' . NAMETITLE,
            'content'   => 'admin/sales/assignsales',
            'extra'     => 'admin/sales/js/_js_assignsales',
            'menuactive_master'   => 'active open',
            'assignsales_active'   => 'active',
            'sales'     => $resultSales,
            'barang'    => $resultBarang
        ];

        return view('admin/layout/wrapper', $mdata);
    }
    
    public function list_all_salesbarang(){
        $url = URLAPI . "/v1/sales/getall_salesbarang";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
        die;

    }

    public function assignsales_proccess()
    {

        


        // Validation Rules
        $rules = $this->validate([
            'sales'     => [
                'label'     => 'Nama Sales',
                'rules'     => 'required'
            ],
            'barang.*'   => [
                'label'     => 'Barang',
                'rules'     => 'required'
            ]
        ]);
     
        // Checking Validation
        if (!$rules){
            session()->setFlashdata('failed', $this->validation->listErrors());
            return redirect()->to(BASE_URL . "sales/assign_sales")->withInput();
        }

        $barang = $this->request->getVar('barang');
        $sales  = $this->request->getVar('sales');
        $data = [];
        foreach($barang as $key => $value){

            $temp['id_sales'] = $sales;
            $temp['id_barang']  = $value;

            array_push($data, $temp);
        }

        // CALL API
        $url = URLAPI . "/v1/sales/add_produk";
        $response = gucitoakAPI($url, json_encode($data));
        $result = $response->message;

        // Check response API
        if($response->code == 200){
            session()->setFlashdata('success', $result);
            return redirect()->to(BASE_URL . "sales/list_assign_sales");
        }else{
            session()->setFlashdata('error', $result);
            return redirect()->to(BASE_URL . "sales/assign_sales");
        }
    }

    public function get_sales_report(){
        $id = $this->request->getVar('id');
        $url = URLAPI . "/v1/sales/getreport_sales?id=$id";
		$response = gucitoakAPI($url);
        $result = $response->message;
        echo json_encode($result);
    }



}
