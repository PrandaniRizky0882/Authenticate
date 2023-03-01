<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\Masyarakat;
use App\Models\Petugas;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    public function register() {

        return view('auth.register');
    }


    public function register_action(Request $request) {
        $this->validate($request,[
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'telp' => 'required',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'username'  => $request->username,
            'password'  => Hash::make($request->password),
            'telp'      => $request->telp,
        ]);

        return redirect()->route('login');

    }

    public function login(Request $request) {

        return view("auth.login");
    }

    public function authenticate(Request $request) {

        $proses = $request->validate([
            'username' => ['required','string'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($proses)) {
            

            if (Masyarakat::where('user_id',Auth::id())->exists()) {
                

                $request->session()->regenerate();

                return redirect()->route('masyarakat.dashboard');
            } else {
                
                $request->session()->regenerate();

                return redirect()->route('petugas.dashboard');
            }
        }

        return back()->withErrors([
            'username' => "Password atau Username SAlah",
        ])->onlyInput();
    }

    public function logout(Request $request) {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
