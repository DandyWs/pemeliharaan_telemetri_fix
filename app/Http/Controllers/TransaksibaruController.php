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
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;




class TransaksibaruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $jadwal = TransaksiBaruModel::where('id_transaksibaru','LIKE','%'.$request->search.'%')->paginate(10);
        }else{
            $jadwal = TransaksiBaruModel::paginate(10);
            //$jadwal = TransaksiBaruModel::select('id_transaksibaru')->distinct()->get();
        }
        $former = NULL;
        return view('jadwal.jadwal')->with(['jadwal'=>$jadwal, 'former'=>$former]);
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
            'id_nasabah' => 'required',
            'id_sopir' => 'required',
            'tanggal_pengambilan' => 'required|date',
            'konfirmasi' => 'required|string',
        ]);

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
     * @param  \App\Models\TransaksiBaruModel  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwal = TransaksiBaruModel::where('id', $id)->get();
        return view('jadwal.detail_jadwal', ['jdw' => $jadwal[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jadwal = TransaksiBaruModel::where('id', $id)->first();
        $sampah = SampahModel::all();
        $nasabah = NasabahModel::all();
        $sopir = SopirModel::all();
        return view('jadwal.edit_jadwal', compact('id'))
        ->with('url_form', url('/jadwal/' . $id))
        ->with('jdw', $jadwal)
        ->with('nasabah', $nasabah)
        ->with('sampah',$sampah)
        ->with('sopir', $sopir);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransaksiModel  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            //'id_transaksibaru' => 'required|string|max:10'.$id,
            'id_sopir'=>'required',
            'tanggal_pengambilan'=>'required|date',
            'konfirmasi'=>'required|string',
        ]);

        // $berat = $request->berat;
        // $jenisSampah = SampahModel::find($request->jenis_sampah);
        // $harga = $jenisSampah->harga * $berat;

        // $request['harga'] = $harga;
        $data = TransaksiBaruModel::where('id', '=', $id)->update($request->except(['_token', '_method']));

        return redirect('jadwal')->with(['success'=>'Jadwal Berhasil Diubah']);
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
        TransaksiBaruModel::where('id', '=', $id)
            ->update([
                'konfirmasi' => $confirm
            ]);
        return redirect('jadwal')
            ->with('success', 'Jadwal Berhasil Dihapus');
    }
    public function grafik(Request $request){
        $confirm = 'Selesai';
       if(TransaksiBaruModel::where('konfirmasi', $confirm))
        $harga = TransaksiBaruModel::select(DB::raw("CAST(SUM(harga)as int) as harga"))
        ->where('konfirmasi', $confirm)
        ->whereYear("tanggal_pengambilan",date('Y'))
        ->groupBy(DB::raw("MONTH(tanggal_pengambilan)"))
        ->pluck('harga');
       
        $bulan = TransaksiBaruModel::select(DB::raw("MONTHNAME(tanggal_pengambilan) as bulan"))
        ->where('konfirmasi', $confirm)
        ->whereYear("tanggal_pengambilan",date('Y'))
        ->GroupBy(DB::raw("MONTHNAME(tanggal_pengambilan)"))
        ->pluck('bulan');
       
        return view('laporan.penjualan_grafik',compact('harga','bulan'));
    }
}
