<?php

namespace App\Http\Controllers;


use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BerandaController extends Controller
{

    public function index()
    {
        return view('homepage.homepage');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function showBeranda()
    {
        $tanggalSekarang = Carbon::now()->format('Y-m-d');

        // Income
        $incomeall = DB::table('kendaraan')->where('status', 'keluar')->sum('biayaparkir');
        $incomeptc = DB::table('kendaraan')->where('status', 'keluar')->where('idmall', 1)->sum('biayaparkir');
        $incometp = DB::table('kendaraan')->where('status', 'keluar')->where('idmall', 2)->sum('biayaparkir');
        $incomeroyal = DB::table('kendaraan')->where('status', 'keluar')->where('idmall', 3)->sum('biayaparkir');

        // Quantity Total
        $jumlahkendaraanall = DB::table('kendaraan')->where('status', 'masuk')->count();
        $jumlahkendaraanptc = DB::table('kendaraan')->where('status', 'masuk')->where('idmall', 1)->count();
        $jumlahkendaraantp = DB::table('kendaraan')->where('status', 'masuk')->where('idmall', 2)->count();
        $jumlahkendaraanroyal = DB::table('kendaraan')->where('status', 'masuk')->where('idmall', 3)->count();

        // Quantity masuk and keluar in a day (admin)
        $kendaraanhariiniall_masuk = DB::table('kendaraan')->where('status', 'masuk')->where('tglmasuk', $tanggalSekarang)->count();
        $kendaraanhariiniall_keluar = DB::table('kendaraan')->where('status', 'keluar')->where('tglmasuk', $tanggalSekarang)->count();


        // Quantity masuk and keluar in a day (PTC)
        $kendaraanhariiniall_masuk_dariptc = DB::table('kendaraan')->where('status', 'masuk')->where('tglmasuk', $tanggalSekarang)->where('idmall', 1)->count();
        $kendaraanhariiniall_keluar_dariptc = DB::table('kendaraan')->where('status', 'keluar')->where('tglmasuk', $tanggalSekarang)->where('idmall', 1)->count();
        // Quantity masuk and keluar in a day (TP)
        $kendaraanhariiniall_masuk_daritp = DB::table('kendaraan')->where('status', 'masuk')->where('tglmasuk', $tanggalSekarang)->where('idmall', 2)->count();
        $kendaraanhariiniall_keluar_daritp = DB::table('kendaraan')->where('status', 'keluar')->where('tglmasuk', $tanggalSekarang)->where('idmall', 2)->count();

        // Quantity masuk and keluar in a day (Royal)
        $kendaraanhariiniall_masuk_dariroyal = DB::table('kendaraan')->where('status', 'masuk')->where('tglmasuk', $tanggalSekarang)->where('idmall', 3)->count();
        $kendaraanhariiniall_keluar_dariroyal = DB::table('kendaraan')->where('status', 'keluar')->where('tglmasuk', $tanggalSekarang)->where('idmall', 3)->count();

        return view('beranda', [
            'totalkendaraan' => $jumlahkendaraanall,
            'totalkendaraanptc' => $jumlahkendaraanptc,
            'totalkendaraantp' => $jumlahkendaraantp,
            'totalkendaraanroyal' => $jumlahkendaraanroyal,
            'incomeall' => $incomeall,
            'incomeptc' => $incomeptc,
            'incometp' => $incometp,
            'incomeroyal' => $incomeroyal,
            'kendaraan_in_admin' => $kendaraanhariiniall_masuk,
            'kendaraan_out_admin' => $kendaraanhariiniall_keluar,
            'kendaraan_in_ptc' => $kendaraanhariiniall_masuk_dariptc,
            'kendaraan_out_ptc' => $kendaraanhariiniall_keluar_dariptc,
            'kendaraan_in_tp' => $kendaraanhariiniall_masuk_daritp,
            'kendaraan_out_tp' => $kendaraanhariiniall_keluar_daritp,
            'kendaraan_in_royal' => $kendaraanhariiniall_masuk_dariroyal,
            'kendaraan_out_royal' => $kendaraanhariiniall_keluar_dariroyal,
        ]);
    }

    public function showUsers()
    {
        $userDataAll = DB::table('users')->get();
        $userPTC = DB::table('users')->where('idmall', 1)->get();
        $userTP = DB::table('users')->where('idmall', 2)->get();
        $userRoyal = DB::table('users')->where('idmall', 3)->get();

        return view('users', [
            'userAll' => $userDataAll,
            'userPTC' => $userPTC,
            'userTP' => $userTP,
            'userRoyal' => $userRoyal
        ]);
    }

    public function showTambahPegawai()
    {
        return view('tambahpegawai');
    }

    public function showEditPegawai($id)
    {
        $data = DB::table('users')->where('id', $id)->get();
        $name = DB::table('users')->where('id', $id)->value('name');
        return view('editpegawai', ['data' => $data, 'nama' => $name]);
    }

    public function showRuangParkirPTC()
    {
        $data = DB::table('ruangmall')
            ->leftJoin('kendaraan', function ($join) {
                $join->on('kendaraan.idmall', '=', 'ruangmall.idmall')
                    ->on('kendaraan.lantai', '=', 'ruangmall.lantai')
                    ->on('kendaraan.namaruang', '=', 'ruangmall.ruang')
                    ->where('kendaraan.status', '=', 'masuk')
                    ->where('kendaraan.idmall', '=', 1);
            })
            ->where('ruangmall.idmall', '=', 1)
            ->groupBy('ruangmall.lantai', 'ruangmall.ruang')
            ->orderBy('ruangmall.lantai')
            ->orderBy('ruangmall.ruang')
            ->select('ruangmall.lantai', 'ruangmall.ruang', DB::raw('COUNT(kendaraan.platnomor) as jumlah_kendaraan'))
            ->get();


        return view('ruangparkir.ptc', [
            'ruangptc' => $data
        ]);
    }
    public function showRuangParkirTp()
    {
        $data = DB::table('ruangmall')
            ->leftJoin('kendaraan', function ($join) {
                $join->on('kendaraan.idmall', '=', 'ruangmall.idmall')
                    ->on('kendaraan.lantai', '=', 'ruangmall.lantai')
                    ->on('kendaraan.namaruang', '=', 'ruangmall.ruang')
                    ->where('kendaraan.status', '=', 'masuk')
                    ->where('kendaraan.idmall', '=', 2);
            })
            ->where('ruangmall.idmall', '=', 2)
            ->groupBy('ruangmall.lantai', 'ruangmall.ruang')
            ->orderBy('ruangmall.lantai')
            ->orderBy('ruangmall.ruang')
            ->select('ruangmall.lantai', 'ruangmall.ruang', DB::raw('COUNT(kendaraan.platnomor) as jumlah_kendaraan'))
            ->get();

        return view('ruangparkir.tp', [
            'ruangtp' => $data
        ]);
    }
    public function showRuangParkirRoyal()
    {
        $data = DB::table('ruangmall')
            ->leftJoin('kendaraan', function ($join) {
                $join->on('kendaraan.idmall', '=', 'ruangmall.idmall')
                    ->on('kendaraan.lantai', '=', 'ruangmall.lantai')
                    ->on('kendaraan.namaruang', '=', 'ruangmall.ruang')
                    ->where('kendaraan.status', '=', 'masuk')
                    ->where('kendaraan.idmall', '=', 3);
            })
            ->where('ruangmall.idmall', '=', 3)
            ->groupBy('ruangmall.lantai', 'ruangmall.ruang')
            ->orderBy('ruangmall.lantai')
            ->orderBy('ruangmall.ruang')
            ->select('ruangmall.lantai', 'ruangmall.ruang', DB::raw('COUNT(kendaraan.platnomor) as jumlah_kendaraan'))
            ->get();



        return view('ruangparkir.royal', [
            'ruangroyal' => $data
        ]);
    }

    public function showInputKendaraan()
    {
        // Data PTC
        $dataPTC = DB::table('kendaraan')->where('status', 'masuk')->where('idmall', 1)->orderBy('tglmasuk', 'asc')->orderBy('jammasuk', 'asc')->get();

        // Data TP
        $dataTP = DB::table('kendaraan')->where('status', 'masuk')->where('idmall', 2)->orderBy('tglmasuk', 'asc')->orderBy('jammasuk', 'asc')->get();

        // Data PTC
        $dataRoyal = DB::table('kendaraan')->where('status', 'masuk')->where('idmall', 3)->orderBy('tglmasuk', 'asc')->orderBy('jammasuk', 'asc')->get();


        return view('inputkendaraan', [
            'dataPTC' => $dataPTC,
            'dataTP' => $dataTP,
            'dataRoyal' => $dataRoyal
        ]);
    }

    public function showOutKendaraan()
    {
        // Data PTC
        $dataPTC = DB::table('kendaraan')->where('status', 'masuk')->where('idmall', 1)->orderBy('tglmasuk', 'asc')->orderBy('jammasuk', 'asc')->get();

        // Data TP
        $dataTP = DB::table('kendaraan')->where('status', 'masuk')->where('idmall', 2)->orderBy('tglmasuk', 'asc')->orderBy('jammasuk', 'asc')->get();

        // Data PTC
        $dataRoyal = DB::table('kendaraan')->where('status', 'masuk')->where('idmall', 3)->orderBy('tglmasuk', 'asc')->orderBy('jammasuk', 'asc')->get();


        return view('outkendaraan', [
            'dataPTC' => $dataPTC,
            'dataTP' => $dataTP,
            'dataRoyal' => $dataRoyal
        ]);
    }

    public function showOutKendaraanInfo($id)
    {
        $data = DB::table('kendaraan')->where('id', $id)->get();
        $tanggalSekarang = Carbon::now()->format('Y-m-d');
        $tanggalMasuk = $data[0]->tglmasuk;
        $datetime1 = date_create($tanggalMasuk);
        $datetime2 = date_create($tanggalSekarang);
        $interval = date_diff($datetime1, $datetime2);

        if ($interval->format('%a') == '0') {
            $biayaparkir = $data[0]->biayaparkir;
        } else {
            $biayaparkir = $data[0]->biayaparkir * (intval($interval->format('%a') + 1));
        }

        return view('outkendaraaninfo', [
            'data' => $data,
            'durasi_parkir' => $interval,
            'biaya' => $biayaparkir
        ]);
    }

    public function showRuangKendaraan()
    {
        // Data PTC
        $dataPTC = DB::table('kendaraan')->where('status', 'masuk')->where('idmall', 1)->orderBy('tglmasuk', 'asc')->orderBy('jammasuk', 'asc')->get();

        // Data TP
        $dataTP = DB::table('kendaraan')->where('status', 'masuk')->where('idmall', 2)->orderBy('tglmasuk', 'asc')->orderBy('jammasuk', 'asc')->get();

        // Data PTC
        $dataRoyal = DB::table('kendaraan')->where('status', 'masuk')->where('idmall', 3)->orderBy('tglmasuk', 'asc')->orderBy('jammasuk', 'asc')->get();


        return view('ruangkendaraan', [
            'dataPTC' => $dataPTC,
            'dataTP' => $dataTP,
            'dataRoyal' => $dataRoyal
        ]);

    }

    public function showRuangKendaraanInfo($id)
    {
        $data = DB::table('kendaraan')->where('id', $id)->get();
        $tanggalSekarang = Carbon::now()->format('Y-m-d');
        $tanggalMasuk = $data[0]->tglmasuk;
        $datetime1 = date_create($tanggalMasuk);
        $datetime2 = date_create($tanggalSekarang);
        $interval = date_diff($datetime1, $datetime2);


        return view('ruangkendaraaninfo', [
            'data' => $data,
            'durasi_parkir' => $interval
        ]);
    }

    public function showLaporanKeuangan()
    {
        $dataAll = DB::table('kendaraan')
            ->where('status', 'keluar')
            ->orderBy('tglkeluar', 'asc')
            ->orderBy('idmall', 'asc')
            ->groupBy(['tglkeluar', 'idmall'])
            ->select(DB::raw('tglkeluar, idmall, SUM(biayaparkir) as total_biaya'))
            ->get();

        $dataPTC = DB::table('kendaraan')
            ->where('status', 'keluar')
            ->where('idmall', 1)
            ->orderBy('tglkeluar', 'asc')
            ->orderBy('idmall', 'asc')
            ->groupBy(['tglkeluar', 'idmall'])
            ->select(DB::raw('tglkeluar, idmall, SUM(biayaparkir) as total_biaya'))
            ->get();

        $dataTP = DB::table('kendaraan')
            ->where('status', 'keluar')
            ->where('idmall', 2)
            ->orderBy('tglkeluar', 'asc')
            ->orderBy('idmall', 'asc')
            ->groupBy(['tglkeluar', 'idmall'])
            ->select(DB::raw('tglkeluar, idmall, SUM(biayaparkir) as total_biaya'))
            ->get();

        $dataRoyal = DB::table('kendaraan')
            ->where('status', 'keluar')
            ->where('idmall', 3)
            ->orderBy('tglkeluar', 'asc')
            ->orderBy('idmall', 'asc')
            ->groupBy(['tglkeluar', 'idmall'])
            ->select(DB::raw('tglkeluar, idmall, SUM(biayaparkir) as total_biaya'))
            ->get();

        return view('laporankeuangan', [
            'dataAll' => $dataAll,
            'dataPTC' => $dataPTC,
            'dataTP' => $dataTP,
            'dataRoyal' => $dataRoyal
        ]);
    }


    public function showDetailLaporanKeuangan($idmall, $tgl, PDF $pdf)
    {
        $data = DB::table('kendaraan')->where('idmall', $idmall)->where('tglkeluar', $tgl)->get();
        $mall = null;
        if ($idmall == 1) {
            $mall = 'Pakuwon Trade Center';
        } else if ($idmall == 2) {
            $mall = 'Tunjungan Plaza';
        } else if ($idmall == 3) {
            $mall = 'Royal Plaza';
        }

        $dataPDF = [
            'data' => $data,
            'waktu' => $tgl,
            'mall' => $mall
        ];
        $pdf = $pdf->loadView('pdf.pdf', $dataPDF);
        return $pdf->download('LaporanKeuangan.pdf');

        // return view('pdf.pdf', [
        //     'data' => $data,
        //     'waktu' => $tgl,
        //     'mall' => $mall
        // ]);
    }

    public function showDetailLaporanKeuanganBulanan(PDF $pdf)
    {
        $waktu = Carbon::now();
        $bulan = $waktu->format('m');
        $data = DB::table('kendaraan')
            ->whereMonth('tglkeluar', $bulan)
            ->where('status', 'keluar')
            ->orderBy('idmall', 'asc')
            ->get();
        $dataPDF = [
            'data' => $data,
            'bulan' => $bulan
        ];
        $pdf = $pdf->loadView('pdf.pdfbulanan', $dataPDF);
        return $pdf->download('LaporanKeuanganBulanan.pdf');
        // $data = DB::table('kendaraan')
        //     ->whereMonth('tglkeluar', $bulan)
        //     ->where('status', 'keluar')
        //     ->orderBy('idmall', 'asc')
        //     ->get();
        // return view('pdf.pdfbulanan', [
        //     'data' => $data,
        //     'bulan' => $bulan
        // ]);
    }
}