<?php
use Picqer\Barcode\BarcodeGeneratorPNG;

function createBarcode($id_sales) {
    $tanggal = date('Ymd');
    // $tanggal = '20250430';
    $secret = BARCODE_SECRET;

    $hash = substr(sha1($id_sales . $tanggal . $secret), 0, 4);
    $barcode = "SLS$id_sales-$tanggal-$hash";
    $generator = new BarcodeGeneratorPNG();
    // dd($barcode);
    return 'data:image/png;base64,' . base64_encode(
        $generator->getBarcode($barcode, $generator::TYPE_CODE_128 ,2 , 80)
    );
} 

function validateBarcode($barcode) {
    $secret = BARCODE_SECRET;

    // Pisah format barcode
    // ex: SLS10-20250429-a1f4
    if (!preg_match('/^SLS(\d+)-(\d{8})-([a-z0-9]{4})$/i', $barcode, $matches)) {
        return false;
    }

    $id = $matches[1];
    $tanggal = $matches[2];
    $token = $matches[3];

    // Hitung ulang hash
    $expected = substr(sha1($id . $tanggal . $secret), 0, 4);

    // Cek validitas
    if ($token !== $expected) {
        return false; // Token tidak sah
    }

    if($tanggal != date('Ymd')) {
        return false;
    }

    return (int)$id; // Return ID jika valid
}

