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
            line-height: 1;
        }

        p {
            margin: 0 0;
            /* Mengurangi margin antar paragraf */
        }

        table {
            width: 98%;
            border-collapse: collapse;
            margin-top: 5px;
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
                <p>No Faktur: <?= $mdata[0]->nonota ?? '-' ?></p>
                <p>Tanggal: <?= $mdata[0]->tanggal ?? '-' ?></p>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <td style="width: 60px; vertical-align: top;">
                            <img src="<?= $logo ?>" alt="logo" width="50">
                        </td>
                        <td style="vertical-align: top;">
                            <p><strong>GUCI LUWAK</strong></p>
                            <p>Alamat: Perum GSM Kaja, Jln. Cempaka Kaja No 99, Gianyar</p>
                            <p>Telp: 085648247182, 0361-4794548</p>
                        </td>
                    </tr>
                </table>
                <p>Telp: 085648247182, 0361-4794548</p>
                <p>Tgl Kirim: <?= date('d-m-Y') ?></p>
            </td>
            <td style="width: 50%; vertical-align: top;">
                <p>Nama: <?= $mdata[0]->namapelanggan ?? '-' ?></p>
                <p>Alamat: <?= $mdata[0]->alamat ?? '-' ?></p>
                <p>No. Telp: <?= $mdata[0]->telp ?? '-' ?></p>
                <p>Tgl Tempo: <?= $mdata[0]->tempo ?? '-' ?></p>
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
            <?php
            $t_jumlah = 0;
            $ppn = $mdata[0]->ppn ?? 0;
            $diskon = $mdata[0]->discount ??0;
            foreach ($mdata as $barang):
                $harga = $barang->harga ?? 0;
                $diskon1 = $barang->diskon1 ?? 0;
                $diskon2 = $barang->diskon2 ?? 0;
                $jumlah = $harga - $diskon1 - $diskon2;
                $t_jumlah += $jumlah;
            ?>
                <tr>
                    <td>1</td>
                    <td><?= $barang->kd_barang ?? '-' ?></td>
                    <td><?= $barang->namabarang ?? '-' ?></td>
                    <td><?= $barang->jumlah ?? '-' ?></td>
                    <td><?= $barang->namasatuan ?? '-' ?></td>
                    <td><?= $harga ?></td>
                    <td><?= $diskon1 ?></td>
                    <td><?= $diskon2 ?></td>
                    <td><?= $jumlah ?></td>
                </tr>
            <?php endforeach ?>
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
                        <td style="text-align: right;"><?= $t_jumlah ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">Diskon:</td>
                        <td style="text-align: right;"><?= $diskon != 0 ? $diskon : '-' ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">PPN:</td>
                        <td style="text-align: right;"><?= $ppn != 0 ? $ppn . '%' : '-' ?></td>
                    </tr>
                    <tr>
                        <td style="text-align: right;"><strong>Total:</strong></td>
                        <td style="text-align: right;"><strong><?= ($t_jumlah - $diskon) + (($t_jumlah - $diskon) * $ppn) ?>
                            </strong></td>
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