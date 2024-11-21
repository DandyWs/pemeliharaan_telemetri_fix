<?php

namespace App\Http\Controllers;

use App\Models\JadwalModel;
use App\Models\NasabahModel;
use App\Models\SampahModel;
use App\Models\SopirModel;
use App\Models\TransaksiBaruModel;
use App\Models\TransaksiModel;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageNasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $jadwal = TransaksiBaruModel::where('id_nasabah', $user->nasabah->id)->get();
        $transaksi = JadwalModel::where('id_nasabah', $user->nasabah->id)->get();
        $nasabah = NasabahModel::where('email', $user->email)->first();
        return view('pagenasabah.nasabah', compact('jadwal', 'nasabah', 'transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nasabah = Auth::user()->nasabah;
        $sampah = SampahModel::all();
        //$jadwalUser = JadwalModel::where('id_nasabah', $user->id)->first();
       
        return view('pagenasabah.create_jadwal',['sampah'=>$sampah,'nasabah'=>$nasabah])
        ->with('url_form', url('/jadwalnasabah'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nsbid = $request->id_nasabah;
        $current = Carbon::now();
        $pre = $current->format('mYdHis');
        $newid = $nsbid.'-'.$pre;
        $confirm = 'Menunggu Konfirmasi';

        JadwalModel::insert(
            [
                'id_jadwal'=>$newid,
                'id_nasabah' => $request->id_nasabah,
                'konfirmasi' => $confirm,
            ]
        );

        for($i = 0; $i < $request->counter; $i++){
            $berat = $request['berat_'.$i];
            $jenisSampah = SampahModel::find($request['jenis_sampah_'.$i]);
            $harga = $jenisSampah->harga * $berat;

            TransaksiBaruModel::insert([
                'id_transaksibaru' => $newid,
                'id_nasabah' => $request->id_nasabah,
                'jenis_sampah' => $request['jenis_sampah_'.$i],
                'konfirmasi' => $confirm,
                'berat' => $berat,
                'harga' => $harga,
            ]);
            
        }
        

        //$data = JadwalModel::create($request->except(['_token']));
        return redirect('jadwalnasabah')
            ->with('success', 'Jadwal Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwal = TransaksiBaruModel::where('id', $id)->get();
        return view('pagenasabah.detail_jadwal', ['jadwal' => $jadwal[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
