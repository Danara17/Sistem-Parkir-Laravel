<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class KendaraanController extends Controller
{
    public function tambahKendaraan(Request $request)
    {

        $tanggalMasuk = Carbon::now()->format('Y-m-d');
        $jamMasuk = Carbon::now()->format('G:i:s');
        $platnomor = $request->platnomor;
        $status = "masuk";
        $biaya = 5000;
        $idmall = $request->idmall;

        $database = DB::table('kendaraan');




        if ($database->where('platnomor', $platnomor)->exists()) {
            // Jika data sudah ada di database
            // Lakukan sesuatu di sini

            $database->where('platnomor', $platnomor)->update([
                'platnomor' => $platnomor,
                'tglmasuk' => $tanggalMasuk,
                'jammasuk' => $jamMasuk,
                'status' => $status,
                'idmall' => $idmall,
                'lantai' => null,
                'namaruang' => null,
                'tglkeluar' => null,
                'jamkeluar' => null,
                'biayaparkir' => 5000
            ]);

            return redirect()->route('inputkendaraan')->with('success', 'Data Berhasil DiPerbarui');

        } else {
            // Jika data belum ada di database
            // Lakukan sesuatu di sini
            $database->insert([
                'platnomor' => $platnomor,
                'tglmasuk' => $tanggalMasuk,
                'jammasuk' => $jamMasuk,
                'status' => $status,
                'biayaparkir' => $biaya,
                'idmall' => $idmall
            ]);
            return redirect()->route('inputkendaraan')->with('success', 'Data Berhasil Ditambahkan');
        }
    }

    public function keluarkanKendaraan(Request $request)
    {

        $waktuSekarang = Carbon::now()->format('G:i:s');
        $tanggalSekarang = Carbon::now()->format('Y-m-d');
        $biaya = intval(str_replace(".", "", str_replace(",", "", str_replace("Rp. ", "", $request->biaya))));

        DB::table('kendaraan')->where('platnomor', $request->plat)->update([
            'status' => 'keluar',
            'tglkeluar' => $tanggalSekarang,
            'jamkeluar' => $waktuSekarang,
            'biayaparkir' => $biaya
        ]);

        return redirect()->route('outkendaraan')->with('success', 'Data Berhasil Keluar');

    }

    public function updateRuangKendaraan(Request $request)
    {
        $ruang = $request->namaruang;
        $lantai = substr($ruang, 0, 1);
        $namaruang = substr($ruang, 1);
        DB::table('kendaraan')->where('platnomor', $request->plat)->update([
            'lantai' => $lantai,
            'namaruang' => $namaruang
        ]);

        return redirect()->route('ruangkendaraan')->with('success', 'Data Berhasil Di Update');
    }
}