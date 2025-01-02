<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Database\Data;
use App\Models\Pemeliharaan2;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $perPage = $request->input('perPage', 10);

        if($request->has('search')){
            $transaksi = Pemeliharaan2::where('id','LIKE','%'.$request->search.'%')->paginate(25);
        }else{
            $transaksi = Pemeliharaan2::orderBy('created_at', 'desc')->paginate($perPage);
        }
    
        return view('layouts.dashboard')->with('transaksi',$transaksi);
        // return view('layouts.dashboard');
    }



} 