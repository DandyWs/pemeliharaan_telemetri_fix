<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AlatTelemetri;
use App\Models\JenisAlat;
use Yajra\DataTables\DataTables;
use App\Models\User;

class AlatController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->has('search')){
        //     $detail_componen = DetailKomponen::where('nama','LIKE','%'.$request->search.'%')->paginate(10);
        // }else{
        //     $detail_componen = DetailKomponen::paginate(25);
        // }
       
        // return view('detail_componen.detail_componen')->with('detail_componen',$detail_componen);
        return view('alat.alat');
    }
    public function data(){
        $data = AlatTelemetri::with('JenisAlat')->get();
        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'lokasiStasiun' => $item->lokasiStasiun,
                'jenisAlat' => $item->JenisAlat->namajenis,
            ];
        });
        // $data = DetailKomponen::selectRaw('id, namadetail, komponen2_id');
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
        $jenisAlat =  JenisAlat::all();
        return view('alat.create_alat')
            ->with('jenisAlat', $jenisAlat)
            ->with('url_form', url('/alat'));
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
            
            'lokasiStasiun'=>'required|string|max:50',
            'jenis_alat_id'=>'required',
        ]);

        // if ($request->file('foto')) {
        //     $file = $request->file('foto');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = 'detail_componen-' . 'nama' . '.' . $extension;
        //     $image_name = $file->storeAs('detail_componenprofile', $filename, 'public');
        // }

        
        AlatTelemetri::create([
            'lokasiStasiun' => $request->input('lokasiStasiun'),
            'jenis_alat_id' => $request->input('jenis_alat_id'),
        ]);

        return redirect('alat')->with('success', 'Alat Telemetri Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detail_componen  $detail_componen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alat = AlatTelemetri::where('id', $id)->first();
        // $data = DetailKomponen::selectRaw('id, nama ');
        // return DataTables::of($data)
        //             ->addIndexColumn()
        //             ->make(true);
        // dd($detail_componen);
        return view('alat.detail_alat', ['alat' => $alat]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detail_componen  $detail_componen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alat = AlatTelemetri::find($id);
        $jenisAlat =  JenisAlat::all();
        return view('alat.create_alat')
            ->with('jenisAlat', $jenisAlat)
        ->with('spr', $alat)->with('url_form', url('/alat/'.$id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detail_componen  $detail_componen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'lokasiStasiun'=>'required|string|max:50',
        ]);

        $alat = AlatTelemetri::find($id);
        AlatTelemetri::where('id', $id)->update([
            'lokasiStasiun' => $request->lokasiStasiun,
            'jenis_alat_id' => $request->jenis_alat_id,
        ]);   

        $alat->save();

        // // if ($request->filled('password')) {
        //     $user = User::where('email', $detail_componen->email)->first();
        //     $detail_componen->password = Hash::make($request->input('password'));
        //     $user->save();
        // }

        return redirect('alat')
            ->with('success', 'Alat Telemetri Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detail_componen  $detail_componen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alat = AlatTelemetri::find($id);

        $alat->delete();

        return redirect('alat')
            ->with('success', 'Detail_componen Berhasil Dihapus');
    }
}
