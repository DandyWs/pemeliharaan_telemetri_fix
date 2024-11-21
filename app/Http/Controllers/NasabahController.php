<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Http\Controllers\Controller;
use App\Models\NasabahModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;


class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->has('search')){
        //     $nasabah = NasabahModel::where('nama','LIKE','%'.$request->search.'%')->paginate(25);
        // }else{
        //     $nasabah = NasabahModel::paginate(25);
        // }
       
        // return view('nasabah.nasabah')->with('nasabah',$nasabah);
        return view('nasabah.nasabah');
    }
    public function data(){
        $data = NasabahModel::selectRaw('id, id_nasabah, nama, alamat ,phone');
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
        return view('nasabah.create_nasabah')
            ->with('url_form', url('/nasabah'));
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
            'id_nasabah'=>'required|string|max:10|unique:nasabah,id_nasabah',
            'nama'=>'required|string',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'alamat'=>'required|string|max:255',
            'phone'=>'required|digits_between:5, 15',
            'email'=>'required|string|unique:users,email',
            'password' => 'required|string|min:4'
        ]);

        // if ($request->file('foto')) {
        //     $file = $request->file('foto');
        //     $filename = 'nasabah-' . 'nama' . '.' . $file->getClientOriginalExtension();
        //     $image_name = $file->storeAs('nasabahprofile', $filename, 'public');
        // }

        User::create([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'nasabah',
        ]);
        NasabahModel::create([
            'id_nasabah' => $request->input('id_nasabah'),
            'nama' => $request->input('nama'),
            // 'foto' => $image_name,
            'alamat' => $request->input('alamat'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect('nasabah')->with('success', 'Nasabah Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nasabah = NasabahModel::where('id', $id)->get();
        return view('nasabah.detail_nasabah', ['nasabah' => $nasabah[0]]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nasabah = NasabahModel::find($id);
        return view('nasabah.create_nasabah')
        ->with('nsb', $nasabah)->with('url_form', url('/nasabah/'.$id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_nasabah'=>'required|string|max:10|unique:nasabah,id_nasabah,'.$id,
            'nama'=>'required|string|max:50',
            // 'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'alamat'=>'required|string|max:255',
            'phone'=>'required|digits_between:5, 15',
        ]);

        $nasabah = NasabahModel::find($id);

        // if ($request->hasFile('foto')) {
        //     $foto = $request->file('foto');
        //     $fotoName = 'nasabahprofile/'.'nasabah-' . $nasabah->nama . '.' . $foto->getClientOriginalExtension();
        //     !is_null($nasabah->foto) && Storage::delete($nasabah->foto);

        //     $foto->storeAs('nasabahprofile', $fotoName, 'public');
        //     $nasabah->foto = $fotoName;
        // }
        
        NasabahModel::where('id', $id)->update([
            'id_nasabah' => $request->id_nasabah,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        $nsb = User::where('email', $nasabah->email)->first();
        
        User::where('email', $nsb->email)->update([
            'name' => $request->nama,
            'email' => $request->email,
        ]);  
        
        $nasabah->save();

        if ($request->filled('password')) {
            $user = User::where('email', $nasabah->email)->first();
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }

        return redirect('nasabah')
            ->with('success', 'Nasabah Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nasabah  $nasabah
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nasabah = NasabahModel::find($id);
        $user = User::where('email', $nasabah->email)->first();

        if ($nasabah->foto) {
            Storage::disk('public')->delete($nasabah->foto);
        }

        $nasabah->delete();

        if ($user) {
            $user->delete();
        }

        return redirect('nasabah')
            ->with('success', 'Nasabah Berhasil Dihapus');
    }

    public function saldo()
    {
        $jadwal = NasabahModel::all();
    
        $total = 0;
        $jumlah = 0;
    
        if ($jadwal->count() > 0) {
            foreach ($jadwal as $i => $k) {
                // Calculate the total
                $total += $k->harga;
            }
        }
    
        return view('nasabah.blade', compact('jadwal', 'total'));
    }
    

}
