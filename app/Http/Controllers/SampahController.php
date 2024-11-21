<?php

namespace App\Http\Controllers;

use App\Models\SampahModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       /**if($request->has('search')){
            $sampah = SampahModel::where('jenis_sampah','LIKE','%'.$request->search.'%')->paginate(10);
        }else{
            $sampah = SampahModel::paginate(25);
        }
       
        return view('sampah.sampah')->with('sampah',$sampah); */ 
        return view('sampah.sampah');
    }
    public function data(){
        $data = SampahModel::selectRaw('id, jenis_sampah, foto ,harga');
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
        return view ('sampah.create_sampah')
        ->with('url_form',url('/sampah'));
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
            'jenis_sampah'=>'required|string|max:30',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'harga'=>'required|integer',
        ]);

        $image_name = $request->file('foto')->store('fotosampah', 'public');

        SampahModel::create([
            'jenis_sampah' => $request->jenis_sampah,
            'foto' => $image_name,
            'harga' => $request->harga,
        ]);

        return redirect('sampah')
            ->with('success','Sampah Berhasil Ditambahkan');
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
        $sampah=SampahModel::find($id);
        return view('sampah.create_sampah')
            ->with('sampah', $sampah)
            ->with('url_form',url('/sampah/'. $id));
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
            'jenis_sampah'=>'required|string|max:30',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'harga'=>'required|integer'
        ]);

        $image_name = $request->file('foto')->store('fotosampah', 'public');

        SampahModel::where('id', $id)->update([
            'jenis_sampah' => $request->jenis_sampah,
            'foto' => $image_name,
            'harga' => $request->harga,
        ]);

        return redirect('sampah')
            ->with('success', 'Sampah Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        SampahModel::where('id','=',$id)->delete();
        return redirect('sampah')
        ->with('success','Sampah Berhasil Dihapus');
    }
}
