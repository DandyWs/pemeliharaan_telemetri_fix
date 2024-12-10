<?php

namespace App\Http\Controllers;

use App\Models\AlatTelemetri;
use App\Models\DetailKomponen;
use App\Models\JenisAlat;
use App\Models\Komponen2;
use App\Models\Pemeriksaan;
use App\Models\Pemeliharaan2;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PemeriksaanExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PemeriksaanController extends Controller
{
    // ///**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function index(Request $request)
    {
        // if($request->has('search')){
        //     $sopir = Komponen2::where('nama','LIKE','%'.$request->search.'%')->paginate(10);
        // }else{
        //     $sopir = Komponen2::paginate(25);
        // }

        // return view('sopir.sopir')->with('sopir',$sopir);
        return view('pemeriksaan.index');
    }
    public function data(){
        $data = Pemeriksaan::with('Pemeliharaan2')->get();
        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'ttd' => $item->ttd,
                'catatan' => $item->catatan,
                'pemeliharaan2_id' => $item->Pemeliharaan2->id,
                'tanggal' => $item->Pemeliharaan2->tanggal,
                'waktu' => $item->Pemeliharaan2->waktu,
                'periode' => $item->Pemeliharaan2->periode,
                'cuaca' => $item->Pemeliharaan2->cuaca,
                'no_alatUkur' => $item->Pemeliharaan2->no_alatUkur,
                'no_GSM' => $item->Pemeliharaan2->no_GSM,
                'alat_telemetri_id' => $item->Pemeliharaan2->AlatTelemetri->lokasiStasiun,
                'jenis_alat' => $item->Pemeliharaan2->AlatTelemetri->JenisAlat->namajenis,
                'keterangan' => $item->Pemeliharaan2->keterangan,
                'user_id' => $item->User->name,
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
        $jenisAlat =  JenisAlat::all();
        $komponen = Komponen2::all();
        $detailKomponen = DetailKomponen::all();
        return view('pemeriksaan.create')
            ->with('alat', $alat)
            ->with('user', $user)
            ->with('pemeliharaan', $pemelihaaran)
            ->with('pemeriksaan', $pemeriksaan)
            ->with('jenisAlat', $jenisAlat)
            ->with('komponen', $komponen)
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
        $request->validate([
            'ttd' => ['required', 'max:255', 'string'],
            'catatan' => ['required', 'max:255', 'string'],
            'pemeliharaan2_id' => ['required', 'exists:pemeliharaan2s,id'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        // if ($request->file('foto')) {
        //     $file = $request->file('foto');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = 'sopir-' . 'nama' . '.' . $extension;
        //     $image_name = $file->storeAs('sopirprofile', $filename, 'public');
        // }


        Pemeriksaan::create([
            'ttd' => $request->input('ttd'),
            'catatan' => $request->input('catatan'),
            'pemeliharaan2_id' => $request->input('pemeliharaan2_id'),
            'user_id' => $request->input('user_id'),
        ]);

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
        $jenisAlat =  JenisAlat::all();
        $komponen = Komponen2::all();
        $detailKomponen = DetailKomponen::all();
        return view('pemeriksaan.create')
            ->with('alat', $alat)
            ->with('user', $user)
            ->with('pemeriksaan', $pemeriksaan)
            ->with('jenisAlat', $jenisAlat)
            ->with('komponen', $komponen)
            ->with('detailKomponen', $detailKomponen)
        ->with('pemeliharaan', $pemelihaaran)->with('url_form', url('/pemeriksaan/'.$id));
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
            'tanggal' => ['required', 'date'],
            'waktu' => ['required', 'date_format:H:i'],
            'periode' => ['required', 'max:255', 'string'],
            'cuaca' => ['required', 'max:255', 'string'],
            'no_alatUkur' => ['required', 'numeric'],
            'no_GSM' => ['required', 'numeric'],
            'keterangan' => ['nullable', 'max:255', 'string'],
            'alat_telemetri_id' => ['required', 'exists:alat_telemetris,id'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $sopir = Pemeliharaan2::find($id);

        // if ($request->hasFile('foto')) {
        //     $foto = $request->file('foto');
        //     $fotoName = 'sopirprofile/'.'sopir-' . $sopir->nama . '.' . $foto->getClientOriginalExtension();
        //     !is_null($sopir->foto) && Storage::delete($sopir->foto);

        //     $foto->storeAs('sopirprofile', $fotoName, 'public');
        //     $sopir->foto = $fotoName;
        // }

        Pemeliharaan2::where('id', $id)->update([
            'tanggal' => $request->input('tanggal'),
            'waktu' => $request->input('waktu'),
            'periode' => $request->input('periode'),
            'cuaca' => $request->input('cuaca'),
            'no_alatUkur' => $request->input('no_alatUkur'),
            'no_GSM' => $request->input('no_GSM'),
            'alat_telemetri_id' => $request->input('alat_telemetri_id'),
            'user_id' => $request->input('user_id'),
        ]);

        $sopir->save();


        return redirect('pemeliharaans')
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

    public function export(Request $request, $format)
    {
        $this->authorize('view-any', Pemeliharaan2::class);

        $pemeriksaans = Pemeriksaan::all();

        if ($format === 'pdf') {
            $pdf = Pdf::loadView('app.pemeriksaans.export_pdf', compact('pemeriksaans'));
            return $pdf->download('pemeriksaan_list.pdf');
        } elseif ($format === 'xlsx') {
            return Excel::download(new PemeriksaanExport, 'pemeriksaan_list.xlsx');
        }

        return redirect()->route('pemeriksaans.index')
            ->withErrors(__('crud.common.export_failed'));
    }

}
