<?php

namespace App\Http\Controllers;

use App\Models\Sopir;
use App\Http\Controllers\Controller;
use App\Models\SopirModel;
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
        //     $sopir = SopirModel::where('nama','LIKE','%'.$request->search.'%')->paginate(10);
        // }else{
        //     $sopir = SopirModel::paginate(25);
        // }
       
        // return view('sopir.sopir')->with('sopir',$sopir);
        return view('sopir.sopir');
    }
    public function data(){
        $data = SopirModel::selectRaw('id, id_sopir, nama ,alamat, phone');
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
            'id_sopir'=>'required|string|max:10|unique:sopir,id_sopir',
            'nama'=>'required|string|max:50',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'alamat'=>'required|string|max:255',
            'phone'=>'required|digits_between:5, 15',
            'email'=>'required|string|unique:users,email',
            'password' => 'required|string|min:4'
        ]);

        // if ($request->file('foto')) {
        //     $file = $request->file('foto');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = 'sopir-' . 'nama' . '.' . $extension;
        //     $image_name = $file->storeAs('sopirprofile', $filename, 'public');
        // }

        User::create([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'sopir',
        ]);
        SopirModel::create([
            'id_sopir' => $request->input('id_sopir'),
            'nama' => $request->input('nama'),
            // 'foto' => $image_name,
            'alamat' => $request->input('alamat'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect('sopir')->with('success', 'Sopir Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sopir = SopirModel::where('id', $id)->get();
        return view('sopir.detail_sopir', ['sopir' => $sopir[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sopir = SopirModel::find($id);
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
            'id_sopir'=>'required|string|max:10|unique:sopir,id_sopir,'.$id,
            'nama'=>'required|string|max:50',
            // 'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'alamat'=>'required|string|max:255',
            'phone'=>'required|digits_between:5, 15'
        ]);

        $sopir = SopirModel::find($id);

        // if ($request->hasFile('foto')) {
        //     $foto = $request->file('foto');
        //     $fotoName = 'sopirprofile/'.'sopir-' . $sopir->nama . '.' . $foto->getClientOriginalExtension();
        //     !is_null($sopir->foto) && Storage::delete($sopir->foto);

        //     $foto->storeAs('sopirprofile', $fotoName, 'public');
        //     $sopir->foto = $fotoName;
        // }

        SopirModel::where('id', $id)->update([
            'id_sopir' => $request->id_sopir,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->input('password')),
        ]);     

        $sopir->save();

        if ($request->filled('password')) {
            $user = User::where('email', $sopir->email)->first();
            $sopir->password = Hash::make($request->input('password'));
            $user->save();
        }

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
        $sopir = SopirModel::find($id);
        $user = User::where('email', $sopir->email)->first();

        if ($sopir->foto) {
            Storage::disk('public')->delete($sopir->foto);
        }

        $sopir->delete();

        if ($user) {
            $user->delete();
        }

        return redirect('sopir')
            ->with('success', 'Sopir Berhasil Dihapus');
    }
}
