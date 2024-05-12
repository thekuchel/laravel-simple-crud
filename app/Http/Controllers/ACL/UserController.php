<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repository\ACL\Role;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
// use App\SKPD;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

date_default_timezone_set('Asia/Jakarta');

class UserController extends Controller
{
    public function index()
    {
        return view('acl.user-list');
    }

    public function create()
    {
        $role = Role::where('is_deleted', 0)->where("id", "!=", 1)->get();
        return view('acl.user-form', [
            'role' => $role,
        ]);
    }

    public function store(Request $request)
    {
        // force to super administrator first
        $request->merge([
            'role' => 1
        ]);
        request()->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => [
                'required',
                Rule::unique('users', 'email')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
                'email'
            ],
            'username' => [
                'required',
                Rule::unique('users', 'username')->where(function ($query) {
                    return $query->where('deleted_at', null);
                }),
            ],
            'password' => 'required',
            'conf_password' => 'required|same:password'
        ]);

        $t = new User();
        $t->name = $request->input('name');
        $t->id_role = $request->input('role');
        $t->email = $request->input('email');
        $t->username = $request->input('username');
        $t->password = Hash::make($request->input('password'));
        $t->save();

        return response()->json(['message' => 'Data Berhasil Disimpan']);
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);

        $role = Role::where('is_deleted', 0)->where("id", "!=", 1)->get();
        return view('acl.user-form', [
            'data' => $data,
            'role' => $role
        ]);
    }

    public function update(Request $request, $id)
    {
        // force to super administrator first
        $request->merge([
            'role' => 1
        ]);
        request()->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => [
                'required',
                Rule::unique('users', 'email')->where(function ($query) use ($id) {
                    return $query->where('deleted_at', null)->where("id", "!=", $id);
                }),
                'email'
            ],
            'username' => [
                'required',
                Rule::unique('users', 'username')->where(function ($query) use ($id) {
                    return $query->where('deleted_at', null)->where("id", "!=", $id);
                }),
            ]
        ]);

        if ($request->input('password') != '') {
            request()->validate([
                'password' => 'required',
                'conf_password' => 'required|same:password'
            ]);
        }

        $t = User::findOrFail($id);
        $t->name = $request->input('name');
        $t->id_role = $request->input('role');
        $t->email = $request->input('email');
        $t->username = $request->input('username');
        if ($request->input('password') != '') {
            $t->password = Hash::make($request->input('password'));
        }
        $t->save();

        return response()->json(['message' => 'Data Berhasil Disimpan']);
    }

    public function destroy(Request $request, $id)
    {
        $logged_user = Auth::user();
        $t = User::findOrFail($id);
        $t->delete();

        return response()->json(['message' => 'Data Berhasil Disimpan']);
    }

    public function list_datatables_api()
    {
        $data = DB::table("users AS u")
            ->select(DB::raw("u.*, r.nama AS role"))
            ->leftJoin("acl_role AS r", "u.id_role", "=", "r.id")
            ->where("u.id", "!=", 1);
        return Datatables::of($data)->make(true);
    }
}
