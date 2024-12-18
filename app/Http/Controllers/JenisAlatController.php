<?php

namespace App\Http\Controllers;

use App\Models\JenisAlat;
use App\Models\JenisAlatModel;
// use App\Models\JenisAlatModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class JenisAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       /**if($request->has('search')){
            $jenis_alat = Jenis_alatModel::where('jenis_jenisalat','LIKE','%'.$request->search.'%')->paginate(10);
        }else{
            $jenisalat = JenisAlatModel::paginate(25);
        }
       
        return view('jenisalat.jenisalat')->with('jenisalat',$jenisalat); */ 
        return view('jenisalat.jenisalat');
    }
    public function data(){
        $data = JenisAlat::selectRaw('id, namajenis, setting');
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
        return view ('jenisalat.create_jenisalat')
        ->with('url_form',url('/jenisalat'));
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
            'namajenis'=>'required|string|max:30',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // 'harga'=>'required|integer',
            'setting'=>'required|boolean'
        ]);

        // $image_name = $request->file('foto')->store('fotojenisalat', 'public');

        JenisAlat::create([
            'namajenis' => $request->namajenis,
            // 'foto' => $image_name,
            // 'harga' => $request->harga,
            'setting' => $request->setting
        ]);

        return redirect('jenisalat')
            ->with('success','Jenis Alat Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jenisalat=JenisAlat::find($id);
        return view('jenisalat.create_jenisalat')
            ->with('jenisalat', $jenisalat)
            ->with('url_form',url('/jenisalat/'. $id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'namajenis'=>'required|string|max:30',
            // 'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // 'harga'=>'required|integer'
            'setting'=>'required|boolean'
        ]);

        // $image_name = $request->file('foto')->store('fotojenisalat', 'public');

        JenisAlat::where('id', $id)->update([
            'namajenis' => $request->namajenis,
            // 'foto' => $image_name,
            // 'harga' => $request->harga,
            'setting' => $request->setting
        ]);

        return redirect('jenisalat')
            ->with('success', 'Jenis Alat Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        JenisAlat::where('id','=',$id)->delete();
        return redirect('jenisalat')
        ->with('success','Jenis Alat Berhasil Dihapus');
    }
}
