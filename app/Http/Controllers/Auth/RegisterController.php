<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\NasabahModel;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/jadwalnasabah';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email_register' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password_register' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data):User
    {
        NasabahModel::create([
            'id_nasabah' => $data['id_nasabah'],
            'nama' => $data['name'],
            'alamat' => $data['alamat'],
            'email' => $data['email_register'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password_register']),
        ]);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email_register'],
            'role' => 'nasabah',
            'password' => Hash::make($data['password_register']),
        ]);
        
    }

    protected function store(Request $request)
    {
        $validator = self::validator($request->except(['_token']));

        // Jika validasi gagal, kembalikan pesan error
        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        self::create($request->except(['_token']));

        return redirect('/jadwalnasabah')
            ->with('success', 'Registered Successfully');
    }
}
