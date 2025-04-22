<?php

namespace App\Enums;

class Menu {

CONST DAFTAR_PENGGUNA = 'daftar_pengguna';
CONST DAFTAR_SALES = 'daftar_sales';
CONST DAFTAR_SUPLIER = 'daftar_suplier';
CONST DAFTAR_PELANGGAN = 'daftar_outlet';
CONST DAFTAR_KATEGORI = 'daftar_kategori';
CONST DAFTAR_SATUAN = 'daftar_satuan';
CONST DAFTAR_BARANG = 'daftar_barang';
CONST DAFTAR_BARANG_SALES = 'daftar_barang_sales';
CONST HAK_AKSES = 'hak_akses';
CONST INPUT_STOK = 'input_stok';
CONST PENYESUAIAN_STOK = 'penyesuaian_stok';
CONST STOK_BARANG = 'stok_barang';
CONST CONFIRM_OPNAME = 'konfirmasi_opname';
CONST CONFIRM_DISPOSE = 'konfirmasi_dispose';
CONST HAPUS_STOK = 'penghapusan_stok';
CONST PEMBELIAN = 'pembelian';
CONST PENJUALAN =  'penjualan';
CONST RETUR_SUPLIER = 'retur_suplier';
CONST RETUR_PELANGGAN = 'retur_outlet';
CONST PEMBAYARAN_PELANGGAN = 'pembayaran_outlet';
CONST PEMBAYARAN_SUPLIER = 'pembayaran_suplier';
CONST BIAYA = 'biaya';
CONST STOK_MIN_BARANG = 'stok_min_barang';
CONST MUTASI_STOK = 'mutasi_stok';
CONST PENJUALAN_SUMMARY = 'penjualan_summary';
CONST PEMBELIAN_SUMMARY = 'pembelian_summary';
CONST LAP_RETUR_SUPLIER = 'laporan_retur_suplier';
CONST LAP_RETUR_PELANGGAN = 'laporan_retur_outlet';
CONST OMZET_OUTLET = 'omzet_outlet';
CONST OUTLET_IDLE = 'outlet_idle';
CONST PENJUALAN_OUTLET = 'penjualan_outlet';
CONST KATALOG = 'katalog';
CONST BARANG_EXPIRED = 'barang_expired';
CONST PENGGAJIAN_SALES = 'penggajian_sales';
CONST HUTANG_OUTLET = 'hutang_outlet';
CONST HUTANG_SUPLIER = 'hutang_suplier';
CONST LAP_RETUR_PELANGGAN_MONTHLY = 'laporan_retur_outlet30';
CONST LAP_BIAYA = 'laporan_biaya';

    public static function subMenu_setup()
        {
            return [
                self::DAFTAR_PENGGUNA,
                self::DAFTAR_SALES,
                self::DAFTAR_SUPLIER,
                self::DAFTAR_PELANGGAN,
                self::DAFTAR_KATEGORI,
                self::DAFTAR_SATUAN,
                self::DAFTAR_BARANG,
                self::DAFTAR_BARANG_SALES,
                self::HAK_AKSES
            ];
        }

        public static function subMenu_persediaan()
        {
            return [
                self::INPUT_STOK,
                self::PENYESUAIAN_STOK,
                self::STOK_BARANG,
                self::CONFIRM_OPNAME,
                self::CONFIRM_DISPOSE,
                self::HAPUS_STOK,
            ];
        }

        public static function subMenu_transaksi()
        {
            return [
                self::PEMBELIAN,
                self::PENJUALAN,
                self::RETUR_SUPLIER,
                self::RETUR_PELANGGAN,
                self::PEMBAYARAN_PELANGGAN,
                self::PEMBAYARAN_SUPLIER,
                self::BIAYA
            ];
        }

        public static function subMenu_laporan()
        {
            return [
                self::BARANG_EXPIRED,
                self::STOK_MIN_BARANG,
                self::MUTASI_STOK,
                self::PENJUALAN_SUMMARY,
                self::PEMBELIAN_SUMMARY,
                self::LAP_RETUR_PELANGGAN,
                self::LAP_RETUR_SUPLIER,
                self::OMZET_OUTLET,
                self::OUTLET_IDLE,
                self::PENJUALAN_OUTLET,
                self::KATALOG,
                self::LAP_RETUR_PELANGGAN_MONTHLY,
                self::HUTANG_OUTLET,
                self::HUTANG_SUPLIER,
                self::LAP_BIAYA
            ];
        }

        public static function subMenu_penggajian()
        {
            return [
                self::PENGGAJIAN_SALES
            ];
        }
}
