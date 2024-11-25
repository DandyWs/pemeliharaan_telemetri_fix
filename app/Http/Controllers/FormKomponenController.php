<?php

namespace App\Http\Controllers;

use App\Models\FormKomponen;
use App\Models\DetailKomponen;
use App\Models\Pemeliharaan2;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FormKomponenController extends Controller
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
        return view('form_komponen.form_komponen');
    }
    public function data(){
        $data = FormKomponen::with('DetailKomponen','Komponen2')->get();
        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'cheked' => $item->cheked,
                'pemeliharaan2_id' => $item->pemeliharaan2_id,
                'detail_komponen' => $item->DetailKomponen->namadetail,
                'namakomponen' => $item->DetailKomponen->Komponen2->nama,
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
        $detail_komponen =  DetailKomponen::all();
        $pemeliharaan2 =  Pemeliharaan2::all();
        return view('form_komponen.create_form_komponen')
            ->with('detail_komponen', $detail_komponen)
            ->with('pemeliharaan2', $pemeliharaan2)
            ->with('url_form', url('/form_komponen'));
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
            'pemeliharaan2_id' => 'required',
            'detail_komponen_id' => 'required',
            'cheked' => 'required|boolean',
        ]);
        
        FormKomponen::create([
            'pemeliharaan2_id' => $request->pemeliharaan2_id,
            'detail_komponen_id' => $request->detail_komponen_id,
            'cheked' => $request->cheked,
        ]);

        return redirect('form_komponen')->with('success', 'Komponen Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = FormKomponen::where('id', $id)->first();
        // $data = Komponen2::selectRaw('id, nama ');
        // return DataTables::of($data)
        //             ->addIndexColumn()
        //             ->make(true);
        // dd($sopir);
        return view('form_komponen.detail_form_komponen', ['form' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form = FormKomponen::find($id);
        return view('form_komponen.create_form_komponen')->with('form', $form)->with('url_form', url('/form_komponen/'.$id));
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
            'pemeliharaan2_id' => 'required',
            'detail_komponen_id' => 'required',
            'cheked' => 'required|boolean',
        ]);

        $form = FormKomponen::find($id);

        // if ($request->hasFile('foto')) {
        //     $foto = $request->file('foto');
        //     $fotoName = 'sopirprofile/'.'sopir-' . $sopir->nama . '.' . $foto->getClientOriginalExtension();
        //     !is_null($sopir->foto) && Storage::delete($sopir->foto);

        //     $foto->storeAs('sopirprofile', $fotoName, 'public');
        //     $sopir->foto = $fotoName;
        // }

        FormKomponen::where('id', $id)->update([
            'pemeliharaan2_id' => $request->pemeliharaan2_id,
            'detail_komponen_id' => $request->detail_komponen_id,
            'cheked' => $request->cheked,
        ]);     

        $form->save();

        // // if ($request->filled('password')) {
        //     $user = User::where('email', $sopir->email)->first();
        //     $sopir->password = Hash::make($request->input('password'));
        //     $user->save();
        // }

        return redirect('form_komponen')
            ->with('success', 'Komponen Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sopir = FormKomponen::find($id);

        $sopir->delete();

        return redirect('form_komponen')
            ->with('success', 'Komponen Berhasil Dihapus');
    }
}
