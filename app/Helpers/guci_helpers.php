<?php

use \Config\Services;

function gucitoakAPI($url, $postData = NULL)
{
    $token = null;

    if (isset($_SESSION["logged_user"])) {
        $token = @sha1($_SESSION["logged_user"]["username"] . $_SESSION["logged_user"]["password"]);
    } else {
        $id_sales = Services::request()->getHeaderLine('sales-id');
        if ($id_sales) {
            $sales = getSales_permissions();
            $token = @sha1($sales['namasales'] . $sales['password']);
        }
    }

    $ch     = curl_init($url);
    $headers    = array(
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json'
    );

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    $result = json_decode(curl_exec($ch));
    curl_close($ch);
    return $result;
}
