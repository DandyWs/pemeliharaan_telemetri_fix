<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if($request->has('search')){
        //     $user = User::where('nama','LIKE','%'.$request->search.'%')->paginate(25);
        // }else{
        //     $user = User::paginate(25);
        // }
       
        // return view('user.user')->with('user',$user);
        return view('user.user');
    }
    public function data(){
        $data = User::selectRaw('id, name, email, role')->orderBy('id', 'desc');
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
        return view('user.create_user')
            ->with('url_form', url('/user'));
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
            // 'id'=>'required|string|max:10|unique',
            'name'=>'required|string',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // 'email'=>'required|string|max:255',
            // 'role'=>'required|digits_between:5, 15',
            'role'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password' => 'required|string|min:4'
        ]);

        // if ($request->file('foto')) {
        //     $file = $request->file('foto');
        //     $filename = 'user-' . 'nama' . '.' . $file->getClientOriginalExtension();
        //     $image_name = $file->storeAs('userprofile', $filename, 'public');
        // }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);
        // User::create([
        //     'id_user' => $request->input('id_user'),
        //     'nama' => $request->input('nama'),
        //     // 'foto' => $image_name,
        //     'alamat' => $request->input('alamat'),
        //     'phone' => $request->input('phone'),
        //     'email' => $request->input('email'),
        //     'password' => Hash::make($request->input('password')),
        // ]);

        return redirect('user')->with('success', 'User Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->get();
        return view('user.detail_user', ['user' => $user[0]]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.create_user')
        ->with('nsb', $user)->with('url_form', url('/user/'.$id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'id'=>'required|string|max:10|unique',
            'name'=>'required|string',
            // 'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // 'email'=>'required|string|max:255',
            // 'role'=>'required|digits_between:5, 15',
            'role'=>'required|string',
            'email'=>'required|string',
            // 'password' => 'required|string|min:4'
        ]);

        $user = User::find($id);

        // if ($request->hasFile('foto')) {
        //     $foto = $request->file('foto');
        //     $fotoName = 'userprofile/'.'user-' . $user->nama . '.' . $foto->getClientOriginalExtension();
        //     !is_null($user->foto) && Storage::delete($user->foto);

        //     $foto->storeAs('userprofile', $fotoName, 'public');
        //     $user->foto = $fotoName;
        // }
        
        User::where('id', $id)->update([
            'id' => $request->id,
            'name' => $request->name,
            // 'email' => $request->alamat,
            'role' => $request->role,
            'email' => $request->email,
        ]);

        // $nsb = User::where('email', $user->email)->first();
        
        // User::where('email', $nsb->email)->update([
        //     // 'name' => $request->name,
        //     'email' => $request->email,
        // ]);  
        
        $user->save();

        if ($request->filled('password')) {
            $user = User::where('email', $request->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect('user')
            ->with('success', 'User Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user = User::where('email', $user->email)->first();

        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

        $user->delete();

        if ($user) {
            $user->delete();
        }

        return redirect('user')
            ->with('success', 'User Berhasil Dihapus');
    }

    // public function saldo()
    // {
    //     $jadwal = User::all();
    
    //     $total = 0;
    //     $jumlah = 0;
    
    //     if ($jadwal->count() > 0) {
    //         foreach ($jadwal as $i => $k) {
    //             // Calculate the total
    //             $total += $k->harga;
    //         }
    //     }
    
    //     return view('user.blade', compact('jadwal', 'total'));
    // }
    

}
