<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\JadwalModel;
use App\Models\NasabahModel;
use App\Models\SampahModel;
use App\Models\SopirModel;
use App\Models\TransaksiBaruModel;
use App\Models\TransaksiModel;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;


class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->has('search')){
        //     $jadwal = JadwalModel::where('id_jadwal', 'LIKE', '%'.$request->search.'%')->paginate(10);
        // } else {
        //     $jadwal = JadwalModel::paginate(10);
        // }
        
        $data=[
            'nasabah'=>NasabahModel::all(),
            'sopir'=>SopirModel::all(),
        ];
        // return view('jadwal.jadwal')->with(['jadwal'=>$jadwal]);
        return view('jadwal.jadwal')
        ->with('data',$data);
    }
    public function data(){
        $data = JadwalModel::all();
        foreach ($data as $key => $value) {
            $value->id_nasabah = $value->nasabah->nama;
            unset($value->nasabah);
            if($value->id_sopir != NULL) {
                $value->id_sopir = $value->sopir->nama;
                unset($value->sopir);
            } else {
                $value->id_sopir = 'Menunggu Konfirmasi';
            }

            if($value->tanggal_pengambilan == NULL){
                $value->tanggal_pengambilan = 'Menunggu Konfirmasi';
            }
        }
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
        $sampah = SampahModel::all();
        $nasabah = NasabahModel::all();
        $sopir = SopirModel::all();
        
        return view('jadwal.create_jadwal',['sampah'=>$sampah,'nasabah'=>$nasabah,'sopir'=>$sopir])
        ->with('url_form', url('/jadwal'));
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
        $request->validate([
            //'id_jadwal' => 'required|string|max:10|unique:jadwal,id_jadwal',
            'id_nasabah'=>'required',
            'id_sopir'=>'required',
            'tanggal_pengambilan'=>'required|date',
            'konfirmasi'=>'required|string'
        ]);

        //JadwalModel::insert($request->except(['_token']));
        JadwalModel::insert(
            [
                'id_jadwal'=>$newid,
                'id_nasabah' => $request->id_nasabah,
                'id_sopir' => $request->id_sopir,
                'tanggal_pengambilan' => $request->tanggal_pengambilan,
                'konfirmasi' => $request->konfirmasi,
            ]
        );

        for($i = 0; $i < $request->counter; $i++){
            $berat = $request['berat_'.$i];
            $jenisSampah = SampahModel::find($request['jenis_sampah_'.$i]);
            $harga = $jenisSampah->harga * $berat;

            TransaksiBaruModel::insert(
                [
                    'id_transaksibaru' => $newid,
                    'id_nasabah' => $request->id_nasabah,
                    'id_sopir' => $request->id_sopir,
                    'tanggal_pengambilan' => $request->tanggal_pengambilan,
                    'konfirmasi' => $request->konfirmasi,
                    'jenis_sampah' => $request['jenis_sampah_'.$i],
                    'berat' => $berat,
                    'harga' => $harga,
                ]
            );
        }

        //$data = JadwalModel::create($request->except(['_token']));
        return redirect('jadwal')
            ->with('success', 'Jadwal Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwal = JadwalModel::where('id', $id)->get();
        $jdw = JadwalModel::where('id', $id)->first();
        $idtrans = $jdw->id_jadwal;
        $transaksi = TransaksiBaruModel::where('id_transaksibaru', $idtrans)->get();
        return view('jadwal.detail_jadwal', ['jdw' => $jadwal[0], 'trs' => $transaksi]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jadwal = JadwalModel::find($id);
        $nasabah = NasabahModel::all();
        $sopir = SopirModel::all();
        return view('jadwal.edit_jadwal', compact('id'))
        ->with('url_form', url('/jadwal/' . $id))
        ->with('jdw', $jadwal)
        ->with('nasabah', $nasabah)
        ->with('sopir', $sopir);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $findjdw = JadwalModel::find($request['id_jadwal_'.$id]);
        // $idtrans = $findjdw->id_jadwal; 
        $request->validate([
            //'id_jadwal' => 'required|string|max:50|unique:jadwal,id_jadwal,'.$id,
            // 'id_nasabah'=>'required',
            'id_sopir'=>'required',
            'tanggal_pengambilan'=>'required|date',
            'konfirmasi'=>'required|string'
        ]);


        $data = JadwalModel::where('id', '=', $id)->update($request->except(['_token', '_method']));
        TransaksiBaruModel::where('id_transaksibaru', '=', $request->id_jadwal)->update([
            'id_sopir' => $request -> id_sopir,
            'tanggal_pengambilan' => $request -> tanggal_pengambilan,
            'konfirmasi' => $request -> konfirmasi
        ]);

        return redirect('jadwal')->with('success', 'Jadwal Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $confirm = 'Dibatalkan';
        $findJdw = JadwalModel::where('id', '=', $id)->first();

        JadwalModel::where('id', '=', $id)->update([
            'konfirmasi' => $confirm
        ]);
        TransaksiBaruModel::where('id_transaksibaru', '=', $findJdw->id_jadwal)->update([
            'konfirmasi' => $confirm
        ]);
        return redirect('jadwal')
            ->with('success', 'Jadwal Berhasil Dibatalkan');
    }
}
