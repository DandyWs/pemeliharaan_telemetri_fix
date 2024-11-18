<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use App\Models\NasabahModel;
use App\Models\SampahModel;
use App\Models\SopirModel;
use App\Models\TransaksiBaruModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageSopirController extends Controller
{
    public function index(){
        $user = Auth::user();
        $sopir = SopirModel::where('email', $user->email)->first();
        $transaksi = TransaksiBaruModel::where('id_sopir', $user->sopir->id)->get();
        $jadwalUser = JadwalModel::where('id_sopir', $user->sopir->id)->get();
        return view('pagesopir.sopir')
            ->with('sopir', $sopir)
            ->with('transaksi', $transaksi)
            ->with('jadwalUser', $jadwalUser);
    }

     public function show($id)
    {
        $user = Auth::user();
        $sopir = SopirModel::where('email', $user->email)->first();
        //$jadwal = TransaksiBaruModel::where('id', $id)->get();
        $jadwal = JadwalModel::where('id', $id)->first();
        $idtrans = $jadwal->id_jadwal;
        $transaksi = TransaksiBaruModel::where('id_transaksibaru', $idtrans)->get();
        return view('pagesopir.detail_jadwal', ['jadwal' => $jadwal[0]], compact('sopir', 'transaksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    
    public function delete_api($id){
        $jadwal = JadwalModel::find($id);
    
        if ($jadwal) {
            // $jadwal->delete();
            $jadwal->update([
                'konfirmasi' => 'Pick Up'
            ]);
          
            TransaksiBaruModel::where('id_transaksibaru', $jadwal->id_jadwal)->update([
                'konfirmasi' => 'Pick Up'

            ]);
    
            return response()->json([
                'message' => 'Sampah berhasil di-Pick Up'
            ]);
            } else {
                return response()->json([
                    'message' => 'Jadwal tidak ditemukan'
                ], 404);
            }
    }


}
