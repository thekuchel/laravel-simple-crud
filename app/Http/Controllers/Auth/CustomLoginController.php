<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Error;
use ErrorException;
use Session;

class CustomLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('csrf');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
            // The user is logged in...
            return redirect('/dashboard');
        } else {
            return view('auth.login');
        }
    }

    public function login_proses(Request $request)
    {
        $remember = $request->input('remember-me') ? true : false;
        if (Auth::attempt([
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ], $remember)) {
            /* find user */
            $find_user = User::where('username', $request->input('username'))->first();

            //  Adding to current User 
            Auth::user()->push('name', $find_user->name);
            Auth::user()->push('role', $find_user->role->nama);
            //   Auth::user()->push('nama_role', $find_user->role->nama);
            return redirect('/dashboard');
        } else {

            /* balikin ke login */
            return back()
                ->withInput([
                    'email'
                ])
                ->withErrors([
                    'email' => 'Mohon periksa email & password anda!',
                ]);
        }
    }

    function not_allowed()
    {
        return view('page_403');
    }
}
