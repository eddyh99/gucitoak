<?php

use \Config\Services;
if (!function_exists('hasPermission')) {
    /**
     * Check if the logged-in user has permission for a specific menu and action
     *
     * @param string $permission The permission to check (e.g., 'view', 'edit')
     * @param string $menu The menu key (e.g., 'laporan')
     * @return bool
     */
    function hasPermission(string $permission, string $menu): bool
    {
        $request = \Config\Services::request();
        $session = session()->get('logged_user');
        $sales = Services::request()->getHeaderLine('sales-id') ?: 10;
        if ((isset($session['role']) && $session['role'] === 'superadmin') || !empty($sales)) {
            return true;
        }
        $akses = $session['akses'] ?? [];

        // Check if the menu exists and contains the specific permission
        return isset($akses->$menu) && in_array($permission, $akses->$menu);
    }
}

function getSales_permissions() {
    $url = URLAPI . "/auth/getsales_permissions";

    $ch     = curl_init($url);
    $headers    = array(
        'Content-Type: application/json'
    );

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = json_decode(curl_exec($ch));
    curl_close($ch);
    $result = $response->message;
    return [
        'namasales' => $result->username,
        'password'  => $result->passwd,
        'role'      => $result->role,
        'akses'     => json_decode($result->akses),
    ];
}
