<?php

namespace App\Http\Controllers;

use App\Models\AlatTelemetri;
use App\Models\DetailKomponen;
use App\Models\FormKomponen;
use App\Models\User;
use App\Models\JenisAlat;
use App\Models\Komponen2;
use App\Models\Setting2;
use App\Models\Pemeliharaan2;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class PemeliharaanController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->has('search')){
        //     $sopir = Komponen2::where('nama','LIKE','%'.$request->search.'%')->paginate(10);
        // }else{
        //     $sopir = Komponen2::paginate(25);
        // }
       
        // return view('sopir.sopir')->with('sopir',$sopir);
        return view('pemeliharaans.index');
    }
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alat = AlatTelemetri::all();
        $user = User::all();
        $jenisAlat =  JenisAlat::all();
        $komponen = Komponen2::all();
        $detailKomponen = DetailKomponen::all();
        return view('pemeliharaans.create')
            ->with('alat', $alat)
            ->with('user', $user)
            ->with('jenisAlat', $jenisAlat)
            ->with('komponen', $komponen)
            ->with('detailKomponen', $detailKomponen)
            ->with('url_form', url('/pemeliharaans'));
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
            'tanggal' => ['required', 'date'],
            'waktu' => ['required', 'date_format:H:i'],
            'periode' => ['required', 'max:255', 'string'],
            'cuaca' => ['required', 'max:255', 'string'],
            'no_alatUkur' => ['required', 'numeric'],
            'no_GSM' => ['required', 'numeric'],
            'keterangan' => ['nullable', 'max:255', 'string'],
            'alat_telemetri_id' => ['required', 'exists:alat_telemetris,id'],
            'user_id' => ['required', 'exists:users,id'],
            // 'ttdMekanik' => ['required', 'max:255', 'string'],
        ]);

        // Initialize the file variable
        $file = null;

        // Handle the ttd field if it's a base64 image
        if ($request->has('ttdMekanik')) {
            try {
                $folderPath = "mekanik/";
                $image_parts = explode(";base64,", $request->input('ttdMekanik'));
                if (count($image_parts) === 2) {
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = isset($image_type_aux[1]) ? $image_type_aux[1] : 'png';
                    $image_base64 = base64_decode($image_parts[1]);
                    $file = $folderPath . uniqid() . '.' . $image_type;
    
                    // Store the image in the public disk
                    $filePath = public_path('assets/img/ttd/mekanik/' . basename($file));
                    file_put_contents($filePath, $image_base64);
                } else {
                    throw new \Exception('Invalid base64 format.');
                }
            } catch (\Exception $e) {
                Log::error('Error storing ttd image: ' . $e->getMessage());
                return redirect()->back()->withErrors(['ttd' => 'Failed to store signature image.']);
            }
        }

        // // Create the Pemeliharaan record
        // try {
        //     $pemeliharaan = Pemeliharaan2::create([
        //         'tanggal' => $request->input('tanggal'),
        //         'waktu' => $request->input('waktu'),
        //         'periode' => $request->input('periode'),
        //         'cuaca' => $request->input('cuaca'),
        //         'no_alatUkur' => $request->input('no_alatUkur'),
        //         'no_GSM' => $request->input('no_GSM'),
        //         'alat_telemetri_id' => $request->input('alat_telemetri_id'),
        //         'user_id' => $request->input('user_id'),
        //         'keterangan' => $request->input('keterangan'),
        //         // 'ttdMekanik' => $file,
        //     ]);
        // } catch (\Exception $e) {
        //     Log::error('Error creating Pemeliharaan record: ' . $e->getMessage());
        //     return redirect()->back()->withErrors(['error' => 'Failed to create Pemeliharaan record.']);
        // }        
        $pemeliharaan = Pemeliharaan2::create([
            'tanggal' => $request->input('tanggal'),
            'waktu' => $request->input('waktu'),
            'periode' => $request->input('periode'),
            'cuaca' => $request->input('cuaca'),
            'no_alatUkur' => $request->input('no_alatUkur'),
            'no_GSM' => $request->input('no_GSM'),
            'alat_telemetri_id' => $request->input('alat_telemetri_id'),
            'user_id' => $request->input('user_id'),
            'keterangan' => $request->input('keterangan'),
            'ttdMekanik' => $file,
            'tegangan' => $request->input('tegangan'),
        ]);

        // if ($request->has('detailKomponen')) {
            // foreach ($request->input('detailKomponen') as $detailKomponen) {
            $detailKomponen = DetailKomponen::all();
            foreach ($detailKomponen as $detail){
                // dd($detail );
                // dd($request->input('cheked24'));
                if ($request->input('cheked'.$detail->id)) 
                FormKomponen::create([
                'pemeliharaan2_id' => $pemeliharaan->id,
                'detail_komponen_id' => $detail->id,
                'cheked' => '1',
                ]);
            
            }
            if ($request->input('chekedsetting9')){
                Setting2::create([
                    'pemeliharaan2_id' => $pemeliharaan->id,
                    'simulasi' => $request->input('simulasi_sebelum'),
                    'display' => $request->input('display_sebelum'),
                    'jenis' => 'bucket',
                    'kondisi' => '0',
                ]);
                Setting2::create([
                    'pemeliharaan2_id' => $pemeliharaan->id,
                    'simulasi' => $request->input('simulasi_sesudah'),
                    'display' => $request->input('display_sesudah'),
                    'jenis' => 'bucket',
                    'kondisi' => '1',
                ]);
            }
            if ($request->input('chekedsetting10')){
                Setting2::create([
                    'pemeliharaan2_id' => $pemeliharaan->id,
                    'simulasi' => $request->input('aktual_sebelum'),
                    'display' => $request->input('display_aktual_sebelum'),
                    'jenis' => 'water',
                    'kondisi' => '0',
                ]);
                Setting2::create([
                    'pemeliharaan2_id' => $pemeliharaan->id,
                    'simulasi' => $request->input('aktual_sesudah'),
                    'display' => $request->input('display_aktual_sesudah'),
                    'jenis' => 'water',
                    'kondisi' => '1',
                ]);
            }
        //}

        return redirect('pemeliharaans')->with('success', 'Form Pemeliharaan Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pemeliharaan = Pemeliharaan2::where('id', $id)->first();
        // Debugging statements
        if (is_null($pemeliharaan)) {
            abort(404, 'Pemeliharaan not found.');
        }
        // Check ownership
        if (!in_array(auth()->user()->role, ['admin']) && $pemeliharaan->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to see this record.');
        }
        $formKomponen = FormKomponen::where('pemeliharaan2_id', $id)-> pluck('detail_komponen_id')->toArray();
        $detailKomponen = DetailKomponen::all();
        $komponen = Komponen2::all();
        $setting2 = Setting2::where('pemeliharaan2_id', $id)->get();
        // dd($setting2);
        return view('pemeliharaans.show', compact('pemeliharaan', 'formKomponen', 'detailKomponen', 'komponen', 'setting2'))
        ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $pemeliharaan = Pemeliharaan2::find($id);
        // // Debugging statements
        // if (is_null($pemeliharaan)) {
        //     abort(404, 'Pemeliharaan not found.');
        // }

        // $alat = AlatTelemetri::all();
        // $formKomponen = FormKomponen:: pluck('detail_komponen_id');
        // $user = User::all();
        // $jenisAlat =  JenisAlat::all();
        // $detailKomponen = DetailKomponen::where('id', $pemeliharaan->detail_komponen_id)->get();
        // $komponen = Komponen2::where('id', $pemeliharaan->komponen_id)->get();

        
        
        $pemeliharaan = Pemeliharaan2::where('id', $id)->first();
        // Debugging statements
        if (is_null($pemeliharaan)) {
            abort(404, 'Pemeliharaan not found.');
        }
        // Check ownership
        if (!in_array(auth()->user()->role, ['admin']) && $pemeliharaan->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to edit this record.');
        }
        // if (!in_array(auth()->user()->role, ['admin']) && $pemeliharaan->user_id !== auth()->id()) {
        //     abort(403, 'You are not authorized to see this record.');
        // }
        $formKomponen = FormKomponen::where('pemeliharaan2_id', $id)-> pluck('detail_komponen_id')->toArray();
        $detailKomponen = DetailKomponen::all();
        $komponen = Komponen2::all();
        $alat = AlatTelemetri::all();
        $setting2 = Setting2::where('pemeliharaan2_id', $id)->get();

        return view('pemeliharaans.edit', compact('pemeliharaan', 'formKomponen', 'detailKomponen', 'komponen', 'setting2', 'alat'))
        ->with('url_form',url('/pemeliharaans/'. $id));
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
        // $request->validate([
        //     'tanggal' => ['required', 'date'],
        //     'waktu' => ['required', 'date_format:H:i'],
        //     'periode' => ['required', 'max:255', 'string'],
        //     'cuaca' => ['required', 'max:255', 'string'],
        //     'no_alatUkur' => ['required', 'numeric'],
        //     'no_GSM' => ['required', 'numeric'],
        //     'keterangan' => ['nullable', 'max:255', 'string'],
        //     'alat_telemetri_id' => ['required', 'exists:alat_telemetris,id'],
        //     'user_id' => ['required', 'exists:users,id'],
        // ]);

        $sopir = Pemeliharaan2::find($id);
        // if ($sopir->user_id !== auth()->id()) {
        //     abort(403, 'You are not authorized to edit this record.');
        // }

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
        if (!auth()->check()) {
            abort(403, 'Unauthorized action.');
        }
        $sopir = Pemeliharaan2::find($id);
        $setting2 = Setting2::where('pemeliharaan2_id', $id)->get();
        $formKomponen = FormKomponen::where('pemeliharaan2_id', $id)->get();
        $pemeriksaan = Pemeriksaan::where('pemeliharaan2_id', $id)->get();
        foreach ($pemeriksaan as $item) {
            $item->delete();
        }

        $sopir->delete();
        foreach ($setting2 as $setting) {
            $setting->delete();
        }
        foreach ($formKomponen as $form) {
            $form->delete();
        }



        return redirect('pemeliharaans')
            ->with('success', 'Pemeliharaan Berhasil Dihapus');
    }
}
