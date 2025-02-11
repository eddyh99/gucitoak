<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">

    <style>
        @page {
            size: 21cm 14cm landscape;
            margin: 0;
        }

        body {
            font-family: 'Courier Prime', monospace;
            padding: 5px;
            font-size: 12px;
            width: 21cm;
            height: 14cm;
        }

        table {
            width: 98%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        .invoice th,
        .invoice td {
            border: 1px solid #000;
        }

        .no-border-table th,
        .no-border-table td {
            border: none;
        }

        th {
            background-color: #f2f2f2;
        }

        .note {
            margin-top: 10px;
            font-size: 10px;
        }
        .signature-line {
            display: block;
            width: 90%;
            border-bottom: 1px solid #000;
            margin: 20px auto 0 auto;
        }
    </style>
</head>

<body>
    <table style="width: 100%; margin-bottom: 10px;">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <p>No Faktur: RJ33250128013</p>
                <p>Tanggal: 28/01/2025</p>
                <p>Pengirim: GUCI LUWAK</p>
                <p>Alamat: Perum GSM Kaja, Jln. Cempaka Kaja No 99, Gianyar</p>
                <p>Telp: 085648247182, 0361-4794548</p>
                <p>Tgl Kirim: 28/01/2025</p>
            </td>
            <td style="width: 50%; vertical-align: top;">
                <p>Nama: PIZZA PANTIES (BU AGNES)</p>
                <p>Alamat: JLN COKROAMINOTO, DENPASAR</p>
                <p>No. Telp: -</p>
                <p>Tgl Tempo: 27/02/2025</p>
            </td>
        </tr>
    </table>

    <table class="invoice">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Keterangan</th>
                <th>Qty</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Dis 1</th>
                <th>Dis 2</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>16613142</td>
                <td>R. MUSH JAMUR KANCING SLICE 900</td>
                <td>60</td>
                <td>PCS</td>
                <td>38.500</td>
                <td>0</td>
                <td>0</td>
                <td>2.310.000</td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; margin-top: 10px;">
        <tr>
            <td style="width: 50%; vertical-align: top; font-size: 12px;">
                <strong>Note:</strong> Pembayaran dan cheque dianggap lunas setelah dapat dicairkan. Faktur asli
                merupakan bukti yang sah untuk penagihan/pelunasan. Retur diterima hanya sebelum 3 bulan masa exp/rusak
                saat pengiriman.
            </td>
            <td style="width: 50%; vertical-align: top;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="text-align: right;">Subtotal:</td>
                        <td style="text-align: right;">2.310.000</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Diskon:</td>
                        <td style="text-align: right;">0</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">PPN:</td>
                        <td style="text-align: right;">0</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><strong>Total:</strong></td>
                        <td style="text-align: right;"><strong>2.310.000</strong></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="width: 100%; margin-top: 20px; text-align: center;">
        <tr>
            <td style="width: 25%;">Mengetahui:<br><br><br><br><br><span class="signature-line"></span></td>
            <td style="width: 25%;">Sales:<br><br><br><br><br><span class="signature-line"></span></td>
            <td style="width: 25%;">Pengirim:<br><br><br><br><br><span class="signature-line"></span></td>
            <td style="width: 25%;">Penerima:<br><br><br><br><br><span class="signature-line"></span></td>
        </tr>
    </table>
</body>

</html>