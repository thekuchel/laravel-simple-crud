<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $userPasswordChanged = Auth::user() && Auth::user()->is_password_changed == 1;
        return view('profile', compact('userPasswordChanged'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'new_password' => 'nullable|min:4|max:12|required_with:password_confirmation',
            'password_confirmation' => 'nullable|min:4|max:12|required_with:new_password|same:new_password'
        ]);


        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if (!is_null($request->input('new_password'))) {
            $user->password = $request->input('new_password');
            $user->is_password_changed = 1;
        }

        $user->save();

        return redirect()->route('profile')->withSuccess('Profile updated successfully.');
    }

    public function profile_photo_update(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png',
        ]);

        $tujuan_upload = 'profile';

        $user = User::findOrFail(Auth::user()->id);

        $photo = $request->file('file');

        $file_name = $photo->getClientOriginalName();
        $photo->move($tujuan_upload, $file_name);

        $user->profile_image = URL()->to("/") . "/" . $tujuan_upload . "/" . $file_name;
        $user->save();

        return redirect()->route('profile')->withSuccess('Profile updated successfully.');
    }
}
