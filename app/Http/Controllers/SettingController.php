<?php

namespace App\Http\Controllers;

use App\Models\FormKomponen;
use App\Models\Setting2;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SettingController extends Controller
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
        return view('setting.setting');
    }
    public function data(){
        $data = Setting2::with('FormKomponen')->get();
        $data = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'simulasi' => $item->simulasi,
                'display' => $item->display,
                'form_komponen_id' => $item->FormKomponen->id,
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
        $form_komponen =  FormKomponen::all();
        return view('setting.create_setting')
            ->with('form_komponen', $form_komponen)
            ->with('url_form', url('/setting'));
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
            'simulasi'=>'required|string|max:50',
            'display'=>'required|string|max:50',
            'form_komponen_id'=>'required',
        ]);
        
        Setting2::create([
            'simulasi' => $request->input('simulasi'),
            'display' => $request->input('display'),
            'form_komponen_id' => $request->input('form_komponen_id'),
        ]);

        return redirect('setting')->with('success', 'Setting Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Setting2::where('id', $id)->first();
        // $data = Komponen2::selectRaw('id, nama ');
        // return DataTables::of($data)
        //             ->addIndexColumn()
        //             ->make(true);
        // dd($sopir);
        return view('setting.detail_setting', ['setting' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $setting = Setting2::find($id);
        return view('setting.create_setting')
        ->with('spr', $setting)->with('url_form', url('/setting/'.$id));
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
            'simulasi'=>'required|string|max:50',
            'display'=>'required|string|max:50',
            'form_komponen_id'=>'required',
        ]);

        $setting = Setting2::find($id);

        Setting2::where('id', $id)->update([
            'simulasi' => $request->simulasi,
            'display' => $request->display,
            'form_komponen_id' => $request->form_komponen_id,
            'nama' => $request->nama,
        ]);     

        $setting->save();

        return redirect('setting')
            ->with('success', 'Setting Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sopir  $sopir
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $setting = Setting2::find($id);

        $setting->delete();

        return redirect('setting')
            ->with('success', 'Setting Berhasil Dihapus');
    }
}
