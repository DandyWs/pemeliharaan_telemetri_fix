<?php

namespace App\Http\Controllers;

use App\Models\NasabahModel;
use App\Models\SopirModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request)
    {
        
        NasabahModel::where('email', Auth::user()->email)->update([
            'id_nasabah' => $request->id_nasabah,
            'nama' => $request->name,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        User::where('email', Auth::user()->email)->update([
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            User::where('email', Auth::user()->email)->update([
                'password' => Hash::make($request->input('password')),
            ]);
        }

        return redirect()->back()->with('success', 'Profile Berhasil Diubah.');
    }

    public function updateSopir(Request $request)
    {
        
        SopirModel::where('email', Auth::user()->email)->update([
            'id_sopir' => $request->id_sopir,
            'nama' => $request->name,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        User::where('email', Auth::user()->email)->update([
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            User::where('email', Auth::user()->email)->update([
                'password' => Hash::make($request->input('password')),
            ]);
        }

        return redirect()->back()->with('success', 'Profile Berhasil Diubah.');
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
