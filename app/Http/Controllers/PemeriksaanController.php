<?php

namespace App\Http\Controllers;

use App\Models\AlatTelemetri;
use App\Models\DetailKomponen;
use App\Models\JenisAlat;
use App\Models\Komponen2;
use App\Models\Pemeriksaan;
use App\Models\Pemeliharaan2;
use App\Models\FormKomponen;
use App\Models\User;
use App\Models\Setting2;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PemeriksaanExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PemeriksaanController extends Controller
{
    // ///**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function index(Request $request)
    {

        if (!auth()->user()->role == 'admin' && auth()->user()->role == 'manager') {
            return redirect()->back()->withErrors(['error' => 'You do not have permission to access this resource.']);
        }
        if ($request->ajax()) {
            $data = Pemeriksaan::with('pemeliharaan2')->get();
            return DataTables::of($data)
                ->addColumn('pemeliharaan2_id', function($row) {
                    return $row->pemeliharaan2 ? $row->pemeliharaan2->id : null;
                })
                ->make(true);
        }

        return view('pemeriksaan.index');
    }
    // public function data(){
    //     $data = Pemeliharaan2::with('AlatTelemetri')->get();
    //     $data = $data->map(function ($item) {
    //         return [
    //             'id' => $item->id,
    //             'tanggal' => $item->tanggal,
    //             'waktu' => $item->waktu,
    //             'periode' => $item->periode,
    //             'cuaca' => $item->cuaca,
    //             'no_alatUkur' => $item->no_alatUkur,
    //             'no_GSM' => $item->no_GSM,
    //             'alat_telemetri_id' => $item->AlatTelemetri->lokasiStasiun,
    //             'jenis_alat' => $item->AlatTelemetri->JenisAlat->namajenis,
    //             'keterangan' => $item->keterangan,
    //             'user_id' => $item->User->name,
    //             'ttdMekanik' => $item->ttdMekanik,
                
    //         ];
    //     });
    //     return DataTables::of($data)
    //                 ->addIndexColumn()
    //                 ->make(true);

    // }
    public function data(){
        //$data = Pemeriksaan::with('Pemeliharaan2s')->with('AlatTelemetri')->get();
        $data = DB::table('pemeliharaan2s')
            ->leftJoin('pemeriksaans', 'pemeliharaan2s.id', '=', 'pemeriksaans.pemeliharaan2_id')
            ->leftJoin('alat_telemetris', 'pemeliharaan2s.alat_telemetri_id', '=', 'alat_telemetris.id')
            ->leftJoin('jenis_alats', 'alat_telemetris.jenis_alat_id', '=', 'jenis_alats.id')
            ->leftJoin('users', 'pemeliharaan2s.user_id', '=', 'users.id')
            ->select('pemeliharaan2s.*', 'pemeriksaans.ttd', 'pemeriksaans.catatan', 'pemeriksaans.user_id', 'alat_telemetris.lokasiStasiun', 'jenis_alats.namajenis', 'users.name')
            ->orderByDesc(DB::raw('CONCAT(pemeliharaan2s.tanggal, " ", pemeliharaan2s.waktu)'))
            ->get();
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
                'ttd' => $item->ttd
                
            ];
        });
        return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $alat = AlatTelemetri::all();
        $pemelihaaran = Pemeliharaan2::find($id);
        $pemeriksaan = Pemeriksaan::all();
        $user = User::all();
        $setting2 = Setting2::all();
        $formKomponen = FormKomponen::where('pemeliharaan2_id', $id)-> pluck('detail_komponen_id')->toArray();
        $jenisAlat =  JenisAlat::all();
        $komponen = Komponen2::all();
        $detailKomponen = DetailKomponen::all();
        return view('pemeriksaan.create')
            ->with('alat', $alat)
            ->with('user', $user)
            ->with('formKomponen', $formKomponen)
            ->with('pemeliharaan', $pemelihaaran)
            ->with('pemeriksaan', $pemeriksaan)
            ->with('jenisAlat', $jenisAlat)
            ->with('komponen', $komponen)
            ->with('setting2', $setting2)
            ->with('detailKomponen', $detailKomponen)
            ->with('url_form', url('/pemeriksaan'));
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
    $request->validate([
        'ttd' => ['required', 'string'],
        'catatan' => ['required', 'max:255', 'string'],
        'pemeliharaan2_id' => ['required', 'exists:pemeliharaan2s,id'],
        'user_id' => ['required', 'exists:users,id'],
    ]);

    // Initialize the file variable
    $file = null;

    // Handle the ttd field if it's a base64 image
    if ($request->has('ttd')) {
        try {
            $folderPath = "manager/";
            $image_parts = explode(";base64,", $request->input('ttd'));
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = isset($image_type_aux[1]) ? $image_type_aux[1] : 'png';
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.' . $image_type;

            // Store the image in the public assets directory
            $filePath = public_path('assets/img/ttd/manager/' . basename($file));
            file_put_contents($filePath, $image_base64);
        } catch (\Exception $e) {
            Log::error('Error storing ttd image: ' . $e->getMessage());
            return redirect()->back()->withErrors(['ttd' => 'Failed to store signature image.']);
        }
    }

    // Create the Pemeriksaan record
    try {
            Pemeriksaan::create([
                'ttd' => $file,
                'catatan' => $request->input('catatan'),
                'pemeliharaan2_id' => $request->input('pemeliharaan2_id'),
                'user_id' => $request->input('user_id'),
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating Pemeriksaan record: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create Pemeriksaan record.']);
        }

            return redirect('pemeriksaan')->with('success', 'Form Pemeliharaan telah Diperiksa');
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pemeliharaan2::where('id', $id)->first();
        // $data = Komponen2::selectRaw('id, nama ');
        // return DataTables::of($data)
        //             ->addIndexColumn()
        //             ->make(true);
        // dd($sopir);
        return view('pemeliharaans.show', ['pemeliharaan' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pemelihaaran = Pemeliharaan2::find($id);
        $alat = AlatTelemetri::all();
        $pemeriksaan = Pemeriksaan::all();
        $user = User::all();
        $setting2 = Setting2::where('pemeliharaan2_id', $id)->get();
        $formKomponen = FormKomponen::where('pemeliharaan2_id', $id)-> pluck('detail_komponen_id')->toArray();
        $jenisAlat =  JenisAlat::all();
        $komponen = Komponen2::all();
        $detailKomponen = DetailKomponen::all();
        return view('pemeriksaan.create')
            ->with('alat', $alat)
            ->with('user', $user)
            ->with('formKomponen', $formKomponen)
            ->with('pemeriksaan', $pemeriksaan)
            ->with('jenisAlat', $jenisAlat)
            ->with('komponen', $komponen)
            ->with('setting2', $setting2)
            ->with('detailKomponen', $detailKomponen)
        ->with('pemeliharaan', $pemelihaaran)->with('url_form', url('/pemeriksaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ttd' => ['required', 'max:255', 'string'],
            'catatan' => ['required', 'max:255', 'string'],
            'pemeliharaan2_id' => ['required', 'exists:pemeliharaan2s,id'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $sopir = Pemeriksaan::find($id);

        // if ($request->hasFile('foto')) {
        //     $foto = $request->file('foto');
        //     $fotoName = 'sopirprofile/'.'sopir-' . $sopir->nama . '.' . $foto->getClientOriginalExtension();
        //     !is_null($sopir->foto) && Storage::delete($sopir->foto);

        //     $foto->storeAs('sopirprofile', $fotoName, 'public');
        //     $sopir->foto = $fotoName;
        // }

        Pemeriksaan::where('id', $id)->update([
            'ttd' => $request->input('ttd'),
            'catatan' => $request->input('catatan'),
            'pemeliharaan2_id' => $request->input('pemeliharaan2_id'),
            'user_id' => $request->input('user_id'),
        ]);

        $sopir->save();


        return redirect('pemeriksaan')
            ->with('success', 'Pemeliharaan Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sopir = Pemeliharaan2::find($id);

        $sopir->delete();

        return redirect('pemeliharaans')
            ->with('success', 'Pemeliharaan Berhasil Dihapus');
    }
        // Export PDF
        public function exportPDF()
        {
            $data = Pemeliharaan2::with(['user', 'alatTelemetri.jenisAlat'])->get();

            $pdf = Pdf::loadView('pemeriksaan.export_pdf', compact('data'))
                      ->setPaper('a4', 'landscape');

            return $pdf->download('laporan_pemeriksaan.pdf');
        }

        // Export Excel
        public function exportExcel()
        {
            return Excel::download(new PemeriksaanExport, 'laporan_pemeriksaan.xlsx');
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
