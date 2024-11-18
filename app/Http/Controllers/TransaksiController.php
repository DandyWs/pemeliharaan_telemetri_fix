<?php

namespace App\Http\Controllers;

use App\Models\TransaksiModel;
use App\Http\Controllers\Controller;
use App\Models\JadwalModel;
use App\Models\SampahModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {$cari = request('cari');
        $transaksi = TransaksiModel::query();
        if ($cari) {
           
            $transaksi->where(function ($query) use ($cari) {
                $query->where('id_jadwal', 'LIKE', '%' . $cari . '%');
                    
            })->orWhereHas('jadwal', function ($query) use ($cari) {
                $query->where('id_jadwal', 'LIKE', '%' . $cari . '%');
                  
            });
        }

        $transaksi = $transaksi->whereHas('jadwal', function ($query) {
            $query->where('status', 'selesai');
        })->get();
        return view('transaksi.transaksi', compact('transaksi'));
    
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jadwal = JadwalModel::all();
        $sampah = SampahModel::all();
        return view('transaksi.create_transaksi',['jdw'=>$jadwal],['smp'=>$sampah])
        ->with('url_form', url('/transaksi'));
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
            'id_jadwal' => 'required',
            'jenis_sampah'=>'required',
            'berat'=>'required',
            'harga'=>'required'
        ]);

        TransaksiModel::insert($request->except(['_token']));

        //$data = JadwalModel::create($request->except(['_token']));
        return redirect('transaksi')
            ->with('success', 'Transaksi Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransaksiModel  $transaksiModel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = TransaksiModel::where('id', $id)->get();
        return view('transaksi.detail_transaksi', ['trs' => $transaksi[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransaksiModel  $transaksiModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = TransaksiModel::find($id);
        $jadwal = JadwalModel::all();
        $sampah = SampahModel::all();
        return view('transaksi.edit_transaksi', compact('id'))
        ->with('url_form', url('/transaksi/' . $id))
        ->with('jdw', $jadwal)
        ->with('trs', $transaksi)
        ->with('smp', $sampah);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransaksiModel  $transaksiModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_jadwal' => 'required',
            'jenis_sampah'=>'required',
            'berat'=>'required',
            'harga'=>'required'
        ]);

        $data = TransaksiModel::where('id', '=', $id)->update($request->except(['_token', '_method']));

        return redirect('transaksi')->with('success', 'Data Berhasil Diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransaksiModel  $transaksiModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TransaksiModel::where('id', '=', $id)->delete();
        return redirect('transaksi')
            ->with('success', 'Transaski Berhasil Dihapus');
    }
    public function grafik(Request $request){

        $harga = TransaksiModel::select(DB::raw("CAST(SUM(harga)as int) as harga"))
        ->whereYear("created_at",date('Y'))
        ->GroupBy(DB::raw("Month(created_at)"))
        ->pluck('harga');
       
        $bulan = TransaksiModel::select(DB::raw("MONTHNAME(created_at) as bulan"))
        ->whereYear("created_at",date('Y'))
        ->GroupBy(DB::raw("MONTHNAME(created_at)"))
        ->pluck('bulan');
       
        return view('laporan.penjualan_grafik',compact('harga','bulan'));
    }
  

  
}
