<?php

namespace App\Http\Controllers;

use App\Models\Komponen;
use App\Http\Controllers\Controller;
use App\Models\Komponen2;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class KomponenController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->has('search')){
        //     $komponen = Komponen2::where('nama','LIKE','%'.$request->search.'%')->paginate(10);
        // }else{
        //     $komponen = Komponen2::paginate(25);
        // }
       
        // return view('komponen.komponen')->with('komponen',$komponen);
        return view('komponen.komponen');
    }
    public function data(){
        $data = Komponen2::get();
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
        return view('komponen.create_komponen')
            ->with('url_form', url('/komponen'));
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
            
            'nama'=>'required|string|max:50',
        ]);

        // if ($request->file('foto')) {
        //     $file = $request->file('foto');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = 'komponen-' . 'nama' . '.' . $extension;
        //     $image_name = $file->storeAs('komponenprofile', $filename, 'public');
        // }

        
        Komponen2::create([
            'nama' => $request->input('nama'),
            
        ]);

        return redirect('komponen')->with('success', 'Komponen Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Komponen  $komponen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Komponen2::where('id', $id)->first();
        // $data = Komponen2::selectRaw('id, nama ');
        // return DataTables::of($data)
        //             ->addIndexColumn()
        //             ->make(true);
        // dd($komponen);
        return view('komponen.detail_komponen', ['komponen' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Komponen  $komponen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $komponen = Komponen2::find($id);
        return view('komponen.create_komponen')
        ->with('spr', $komponen)->with('url_form', url('/komponen/'.$id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Komponen  $komponen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'id_komponen'=>'required|string|max:10|unique:komponen,id_komponen,'.$id,
            'nama'=>'required|string|max:50',
            // 'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            // 'alamat'=>'required|string|max:255',
            // 'phone'=>'required|digits_between:5, 15'
        ]);

        $komponen = Komponen2::find($id);

        // if ($request->hasFile('foto')) {
        //     $foto = $request->file('foto');
        //     $fotoName = 'komponenprofile/'.'komponen-' . $komponen->nama . '.' . $foto->getClientOriginalExtension();
        //     !is_null($komponen->foto) && Storage::delete($komponen->foto);

        //     $foto->storeAs('komponenprofile', $fotoName, 'public');
        //     $komponen->foto = $fotoName;
        // }

        Komponen2::where('id', $id)->update([
            // 'id_komponen' => $request->id_komponen,
            'nama' => $request->nama,
            // 'alamat' => $request->alamat,
            // 'phone' => $request->phone,
            // 'email' => $request->email,
            // 'password' => Hash::make($request->input('password')),
        ]);     

        $komponen->save();

        // // if ($request->filled('password')) {
        //     $user = User::where('email', $komponen->email)->first();
        //     $komponen->password = Hash::make($request->input('password'));
        //     $user->save();
        // }

        return redirect('komponen')
            ->with('success', 'Komponen Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Komponen  $komponen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $komponen = Komponen2::find($id);

        $komponen->delete();

        return redirect('komponen')
            ->with('success', 'Komponen Berhasil Dihapus');
    }
}
