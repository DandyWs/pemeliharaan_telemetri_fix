<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use App\Models\SampahModel;
use App\Models\TransaksiBaruModel;
use App\Models\TransaksiModel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;
class CetakLaporan extends Controller
{
    public function index(){
        return view('laporan.laporan');
    }
    
    public function cetak(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $tgl_aw = DateTime::createFromFormat('Y-m-d', $tanggalAwal);
        $tgl_ak = DateTime::createFromFormat('Y-m-d', $tanggalAkhir);
        
        // Query data berdasarkan filter tanggal pembuatan
        $transaksi = JadwalModel::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])->get();
        $trs = TransaksiBaruModel::whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])->get();
        
        $domPdf = Pdf::loadView('laporan.export_pdf', ['transaksi' => $transaksi, 'tanggal_awal' =>  $tanggalAwal, 'tanggal_akhir' =>  $tanggalAkhir, 'trs' => $trs]);

        $filename = 'laporan_transaksi_' .  $tanggalAkhir . 'to' .  $tanggalAkhir . '.pdf';

        Storage::disk('public')->put('pdf/' . $filename, $domPdf->output());

        return response()->download(public_path('storage/pdf/' . $filename));
    }
    
   
   
       
}

