<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeliharaan2;
use App\Models\User;
use App\Models\AlatTelemetri;
use App\Models\Pemeriksaan;
use App\Models\FormKomponen;
use App\Models\JenisAlat;
use App\Models\Komponen2;
use App\Models\DetailKomponen;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PrintController extends Controller
{
    public function exportPDF()
        {
            // $data = Pemeliharaan2::with(['user', 'alatTelemetri.jenisAlat'])->get();
            if (auth()->user()->role == 'mekanik') {
                // $data = Pemeliharaan2::with('AlatTelemetri')
                // ->where('user_id', auth()->id())
                // ->get();
                $data = DB::table('pemeliharaan2s')
                ->leftJoin('pemeriksaans', 'pemeliharaan2s.id', '=', 'pemeriksaans.pemeliharaan2_id')
                ->leftJoin('alat_telemetris', 'pemeliharaan2s.alat_telemetri_id', '=', 'alat_telemetris.id')
                ->leftJoin('jenis_alats', 'alat_telemetris.jenis_alat_id', '=', 'jenis_alats.id')
                ->leftJoin('users', 'pemeliharaan2s.user_id', '=', 'users.id')
                ->select('pemeliharaan2s.*', 'pemeriksaans.ttd', 'pemeriksaans.catatan', 'pemeriksaans.user_id', 'alat_telemetris.lokasiStasiun', 'jenis_alats.namajenis', 'users.name')
                ->where('pemeliharaan2s.user_id', auth()->id())
                ->orderByDesc(DB::raw('CONCAT(pemeliharaan2s.tanggal, " ", pemeliharaan2s.waktu)'))
                ->get();
            } else {
                // $data = Pemeliharaan2::with('AlatTelemetri')->get();
                $data = DB::table('pemeliharaan2s')
                ->leftJoin('pemeriksaans', 'pemeliharaan2s.id', '=', 'pemeriksaans.pemeliharaan2_id')
                ->leftJoin('alat_telemetris', 'pemeliharaan2s.alat_telemetri_id', '=', 'alat_telemetris.id')
                ->leftJoin('jenis_alats', 'alat_telemetris.jenis_alat_id', '=', 'jenis_alats.id')
                ->leftJoin('users', 'pemeliharaan2s.user_id', '=', 'users.id')
                ->select('pemeliharaan2s.*', 'pemeriksaans.ttd', 'pemeriksaans.catatan', 'pemeriksaans.user_id', 'alat_telemetris.lokasiStasiun', 'jenis_alats.namajenis', 'users.name')
                ->orderByDesc(DB::raw('CONCAT(pemeliharaan2s.tanggal, " ", pemeliharaan2s.waktu)'))
                ->get();
            }
    
            // $data = $data->map(function ($item) {
            //     return [
            //     'id' => $item->id,
            //     'tanggal' => $item->tanggal,
            //     'waktu' => $item->waktu,
            //     'periode' => $item->periode,
            //     'cuaca' => $item->cuaca,
            //     'no_alatUkur' => $item->no_alatUkur,
            //     'no_GSM' => $item->no_GSM,
            //     'alat_telemetri_id' => $item->lokasiStasiun,
            //     'jenis_alat' => $item->namajenis,
            //     'keterangan' => $item->keterangan,
            //     'user_id' => $item->name,
            //     'ttdMekanik' => $item->ttdMekanik,
            //     'ttd' => $item->ttd,
            //     ];
            // });

            $pdf = Pdf::loadView('pemeriksaan.export_pdf', compact('data'))
                      ->setPaper('a4', 'landscape');

            return $pdf->download('laporan_pemeriksaan.pdf');
        }

        // Export Excel
        // public function exportExcel()
        // {
        //     return Excel::download(new PemeriksaanExport, 'laporan_pemeriksaan.xlsx');
        // }

        public function data(){
            if (auth()->user()->role == 'mekanik') {
                // $data = Pemeliharaan2::with('AlatTelemetri')
                // ->where('user_id', auth()->id())
                // ->get();
                $data = DB::table('pemeliharaan2s')
                ->leftJoin('pemeriksaans', 'pemeliharaan2s.id', '=', 'pemeriksaans.pemeliharaan2_id')
                ->leftJoin('alat_telemetris', 'pemeliharaan2s.alat_telemetri_id', '=', 'alat_telemetris.id')
                ->leftJoin('jenis_alats', 'alat_telemetris.jenis_alat_id', '=', 'jenis_alats.id')
                ->leftJoin('users', 'pemeliharaan2s.user_id', '=', 'users.id')
                ->select('pemeliharaan2s.*', 'pemeriksaans.ttd', 'pemeriksaans.catatan', 'pemeriksaans.user_id', 'alat_telemetris.lokasiStasiun', 'jenis_alats.namajenis', 'users.name')
                ->where('pemeliharaan2s.user_id', auth()->id())
                ->get();
            } else {
                // $data = Pemeliharaan2::with('AlatTelemetri')->get();
                $data = DB::table('pemeliharaan2s')
                ->leftJoin('pemeriksaans', 'pemeliharaan2s.id', '=', 'pemeriksaans.pemeliharaan2_id')
                ->leftJoin('alat_telemetris', 'pemeliharaan2s.alat_telemetri_id', '=', 'alat_telemetris.id')
                ->leftJoin('jenis_alats', 'alat_telemetris.jenis_alat_id', '=', 'jenis_alats.id')
                ->leftJoin('users', 'pemeliharaan2s.user_id', '=', 'users.id')
                ->select('pemeliharaan2s.*', 'pemeriksaans.ttd', 'pemeriksaans.catatan', 'pemeriksaans.user_id', 'alat_telemetris.lokasiStasiun', 'jenis_alats.namajenis', 'users.name')
                ->get();
            }
    
            $data = $data->map(function ($item) {
                return [
                'id' => $item->id,
                'tanggal' => $item->tanggal,
                'waktu' => $item->waktu,
                'periode' => $item->periode,
                'cuaca' => $item->cuaca,
                'no_alatUkur' => $item->no_alatUkur,
                'no_GSM' => $item->no_GSM,
                'alat_telemetri_id' => $item->lokasiStasiun,
                'jenis_alat' => $item->namajenis,
                'keterangan' => $item->keterangan,
                'user_id' => $item->name,
                'ttdMekanik' => $item->ttdMekanik,
                'ttd' => $item->ttd,
                ];
            });
            return DataTables::of($data)
                        ->addIndexColumn()
                        ->make(true);
    
        }
        
        public function exportData($id)
        {
            $pemeliharaan = Pemeliharaan2::find($id);
            $alat = AlatTelemetri::all();
            $pemeriksaan = Pemeriksaan::where('pemeliharaan2_id', $id)->first();
            $user = User::all();
            $formKomponen = FormKomponen::where('pemeliharaan2_id', $id)-> pluck('detail_komponen_id')->toArray();
            $jenisAlat =  JenisAlat::all();
            $komponen = Komponen2::all();
            $detailKomponen = DetailKomponen::all();

            // $data = Pemeliharaan2::find($id)->with([
            //     'user', 
            //     'alatTelemetri.jenisAlat', 
            //     'formKomponens.detailKomponen',
            //     'pemeriksaans.user',
            //     'formKomponens.detailKomponen.komponen2',
            //     'setting2s'
            //     ])->get();

            $pdf = Pdf::loadView('pemeriksaan.exportData', 
            compact('pemeliharaan', 
                'id', 
                'komponen',
                'alat',
                'user',
                'formKomponen',
                'jenisAlat',
                'pemeriksaan',
                'detailKomponen'))
                  ->setPaper('a4', 'portrait');

            return $pdf->download('laporan_pemeriksaan_' . $pemeliharaan->alatTelemetri->jenisAlat->namajenis . '_' . $pemeliharaan->alatTelemetri->lokasiStasiun . '.pdf');
        }
}
