<?php

namespace App\Http\Controllers;


use App\Models\JadwalModel;
use App\Models\SampahModel;
use Illuminate\Http\Request;
use App\Models\TransaksiModel;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Database\Data;
use App\Models\TransaksiBaruModel;

class DashboardController extends Controller
{
    public function index(Request $request) {

    if($request->has('search')){
        $transaksi = JadwalModel::where('id_jadwal','LIKE','%'.$request->search.'%')->paginate(25);
    }else{
        $transaksi = JadwalModel::orderBy('created_at', 'desc')->paginate(10);
    }
   
    return view('layouts.dashboard')->with('transaksi',$transaksi);
}


    // public function show($id)
    // {
    //     $transaksi = TransaksiModel::where('id', $id)->get();
    //     $jadwal = JadwalModel::where('id', $id)->get();
    //     return view('transaksi.detail_transaksi', ['trs' => $transaksi[0]]);

    // }

}