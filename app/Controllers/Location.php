<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;

class Location extends BaseController
{
    use ResponseTrait;
    protected $cache;
    
    public function __construct()
    {
        $this->cache = \Config\Services::cache();
    }
    
    public function index(){

        $url =  URLAPI . "/v1/sales/getall_sales";
        $response = gucitoakAPI($url);
        $sales = $response->message;

        $mdata = [
            'title'     => 'Location - ' . NAMETITLE,
            'content'   => 'admin/location/index',
            'extra'     => 'admin/location/js/_js_index',
            'menuactive_laporan'   => 'active open',
            'salestracker_active'   => 'active',
            'sales'   => $sales
        ];

        return view('admin/layout/wrapper', $mdata);
    }

    public function record(){

        $url =  URLAPI . "/v1/sales/getall_sales";
        $response = gucitoakAPI($url);
        $sales = $response->message;

        $mdata = [
            'title'     => 'Record Location - ' . NAMETITLE,
            'content'   => 'admin/location/index',
            'extra'     => 'admin/location/js/_js_record',
            'menuactive_laporan'   => 'active open',
            'recordloc_active'   => 'active',
            'isrecord'  => true,
            'sales'   => $sales
        ];

        return view('admin/layout/wrapper', $mdata);
    }
        
    public function getsales_locations(){
        $tgl    = $this->request->getVar('tanggal');
        $sales = $this->request->getVar('sales');
        $url = URLAPI . "/v1/location/sales_locations?tanggal=".$tgl."&sales=".$sales;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
        
    }

    public function getrecord_locations(){
        $tgl    = $this->request->getVar('tanggal');
        $sales = $this->request->getVar('sales');
        $url = URLAPI . "/v1/location/record_locations?tanggal=".$tgl."&sales=".$sales;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
        
    }

    public function saverecord(){
        $ids    = $this->request->getVar('ids');
        $url = URLAPI . "/v1/location/save_record?ids=" . $ids;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
        
    }

    public function delete(){
        $ids    = $this->request->getVar('ids');
        $url = URLAPI . "/v1/location/delete?ids=" . $ids;
        $response = gucitoakAPI($url)->message;
        echo json_encode($response,true);
        
    }

    public function tracker(){
        $mdata = [
            'title'     => 'Real Location - ' . NAMETITLE,
            'content'   => 'admin/location/tracker',
            'extra'     => 'admin/location/js/_js_tracker',
            'menuactive_setup'   => 'active open',
        ];

        return view('admin/layout/wrapper', $mdata);
    }
    
    
    public function realtime()
    {
        $json = $this->request->getJSON();

        if (!$json || !isset($json->sales_id) || !isset($json->lat) || !isset($json->lng)) {
            return $this->fail('Invalid data', 400);
        }

        $data = [
            'user_id' => (int) $json->sales_id,
            'username' => (string) $json->sales_name,
            'lat' => (float) $json->lat,
            'lng' => (float) $json->lng,
            'last_update' => time(),
        ];

        $userKey = 'location_user_' . $data['user_id'];

        // Save location to Memcached (5 minutes expiration)
        $this->cache->save($userKey, $data, 300);

        // Update the users list
        $users = $this->cache->get('users_list') ?: [];
        if (!in_array($data['user_id'], $users)) {
            $users[] = $data['user_id'];
            $this->cache->save('users_list', $users);
        }

        return $this->respond(['status' => 'success']);
    }

   
    // Get all active locations (GET)
    public function get_realtime()
    {
        $users = $this->cache->get('users_list') ?: [];
        $locations = [];

        foreach ($users as $userId) {
            $userKey = 'location_user_' . $userId;
            $location = $this->cache->get($userKey);

            if ($location) {
                $locations[] = $location;
            }
        }
        
        $locations = [
          ['username' => 'john', 'latitude' => -6.2, 'longitude' => 106.8],
          ['username' => 'john', 'latitude' => -6.21, 'longitude' => 106.81],
          ['username' => 'doe', 'latitude' => -6.22, 'longitude' => 106.82],
        ];


        return $this->respond($locations);
    }

    // Optional: Cleanup inactive users
    public function cleanup()
    {
        $users = $this->cache->get('users_list') ?: [];
        $activeUsers = [];

        foreach ($users as $userId) {
            $userKey = 'location_user_' . $userId;
            $location = $this->cache->get($userKey);
            if ($location) {
                $activeUsers[] = $userId;
            } else {
                $this->cache->delete($userKey);
            }
        }

        // Save updated list
        $this->cache->save('users_list', $activeUsers);

        return $this->respond(['status' => 'cleanup done']);
    }
   



}
