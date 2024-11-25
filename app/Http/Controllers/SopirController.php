<?php

namespace App\Http\Controllers;

use App\Models\Sopir;
use App\Http\Controllers\Controller;
use App\Models\Komponen2;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class SopirController extends Controller
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
        return view('sopir.sopir');
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
        return view('sopir.create_sopir')
            ->with('url_form', url('/sopir'));
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
        //     $filename = 'sopir-' . 'nama' . '.' . $extension;
        //     $image_name = $file->storeAs('sopirprofile', $filename, 'public');
        // }

        
        Komponen2::create([
            'nama' => $request->input('nama'),
            
        ]);

        return redirect('sopir')->with('success', 'Komponen Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Komponen2::where('id', $id)->first();
        // $data = Komponen2::selectRaw('id, nama ');
        // return DataTables::of($data)
        //             ->addIndexColumn()
        //             ->make(true);
        // dd($sopir);
        return view('sopir.detail_sopir', ['sopir' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sopir = Komponen2::find($id);
        return view('sopir.create_sopir')
        ->with('spr', $sopir)->with('url_form', url('/sopir/'.$id));
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
            // 'id_sopir'=>'required|string|max:10|unique:sopir,id_sopir,'.$id,
            'nama'=>'required|string|max:50',
            // 'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            // 'alamat'=>'required|string|max:255',
            // 'phone'=>'required|digits_between:5, 15'
        ]);

        $sopir = Komponen2::find($id);

        // if ($request->hasFile('foto')) {
        //     $foto = $request->file('foto');
        //     $fotoName = 'sopirprofile/'.'sopir-' . $sopir->nama . '.' . $foto->getClientOriginalExtension();
        //     !is_null($sopir->foto) && Storage::delete($sopir->foto);

        //     $foto->storeAs('sopirprofile', $fotoName, 'public');
        //     $sopir->foto = $fotoName;
        // }

        Komponen2::where('id', $id)->update([
            // 'id_sopir' => $request->id_sopir,
            'nama' => $request->nama,
            // 'alamat' => $request->alamat,
            // 'phone' => $request->phone,
            // 'email' => $request->email,
            // 'password' => Hash::make($request->input('password')),
        ]);     

        $sopir->save();

        // // if ($request->filled('password')) {
        //     $user = User::where('email', $sopir->email)->first();
        //     $sopir->password = Hash::make($request->input('password'));
        //     $user->save();
        // }

        return redirect('sopir')
            ->with('success', 'Sopir Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sopir = Komponen2::find($id);

        $sopir->delete();

        return redirect('sopir')
            ->with('success', 'Sopir Berhasil Dihapus');
    }
}
