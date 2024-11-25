<?php

namespace App\Http\Controllers;

use App\Models\Detail_componen;
use App\Http\Controllers\Controller;
use App\Models\DetailKomponen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;
use App\Models\Komponen2;

class DetailController extends Controller
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
        return view('detail_componen.detail_componen');
    }
    public function data(){
        $data = DetailKomponen::with('Komponen2')->get();
        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'namadetail' => $item->namadetail,
                'komponen2' => $item->Komponen2->nama,
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
        $komponen2 =  Komponen2::all();
        return view('detail_componen.create_detail_componen')
            ->with('komponen2', $komponen2)
            ->with('url_form', url('/detailcomponen'));
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
            
            'namadetail'=>'required|string|max:50',
        ]);

        // if ($request->file('foto')) {
        //     $file = $request->file('foto');
        //     $extension = $file->getClientOriginalExtension();
        //     $filename = 'detail_componen-' . 'nama' . '.' . $extension;
        //     $image_name = $file->storeAs('detail_componenprofile', $filename, 'public');
        // }

        
        DetailKomponen::create([
            'nama' => $request->input('nama'),
            
        ]);

        return redirect('detail_componen')->with('success', 'Detail_componen Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detail_componen  $detail_componen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail_componen = DetailKomponen::where('id', $id)->first();
        // $data = DetailKomponen::selectRaw('id, nama ');
        // return DataTables::of($data)
        //             ->addIndexColumn()
        //             ->make(true);
        // dd($detail_componen);
        return view('detail_componen.profile_detail_componen', ['detail_componen' => $detail_componen]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detail_componen  $detail_componen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detail_componen = DetailKomponen::find($id);
        return view('detail_componen.create_detail_componen')
        ->with('spr', $detail_componen)->with('url_form', url('/detail_componen/'.$id));
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
            // 'id_detail_componen'=>'required|string|max:10|unique:detail_componen,id_detail_componen,'.$id,
            'nama'=>'required|string|max:50',
            // 'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            // 'alamat'=>'required|string|max:255',
            // 'phone'=>'required|digits_between:5, 15'
        ]);

        $detail_componen = DetailKomponen::find($id);

        // if ($request->hasFile('foto')) {
        //     $foto = $request->file('foto');
        //     $fotoName = 'detail_componenprofile/'.'detail_componen-' . $detail_componen->nama . '.' . $foto->getClientOriginalExtension();
        //     !is_null($detail_componen->foto) && Storage::delete($detail_componen->foto);

        //     $foto->storeAs('detail_componenprofile', $fotoName, 'public');
        //     $detail_componen->foto = $fotoName;
        // }

        DetailKomponen::where('id', $id)->update([
            // 'id_detail_componen' => $request->id_detail_componen,
            'nama' => $request->nama,
            // 'alamat' => $request->alamat,
            // 'phone' => $request->phone,
            // 'email' => $request->email,
            // 'password' => Hash::make($request->input('password')),
        ]);     

        $detail_componen->save();

        // // if ($request->filled('password')) {
        //     $user = User::where('email', $detail_componen->email)->first();
        //     $detail_componen->password = Hash::make($request->input('password'));
        //     $user->save();
        // }

        return redirect('detail_componen')
            ->with('success', 'Detail_componen Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detail_componen  $detail_componen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail_componen = DetailKomponen::find($id);
        $user = User::where('email', $detail_componen->email)->first();

        if ($detail_componen->foto) {
            Storage::disk('public')->delete($detail_componen->foto);
        }

        $detail_componen->delete();

        if ($user) {
            $user->delete();
        }

        return redirect('detail_componen')
            ->with('success', 'Detail_componen Berhasil Dihapus');
    }
}
