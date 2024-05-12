<?php

namespace App\Service;

use App\Models\User;
use App\Repository\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Illuminate\Support\Facades\Hash;

class EmployeeService
{

    public static function process_data(Request $data, $id = null)
    {
        $rules = [
            'nik' => ['required', 'unique:employee,nik,' . $id],
            'name' => ['required'],
            'divisi' => ['required'],
        ];

        $validated = $data->validate($rules, [], [
            'nik' => 'NIK',
            'name' => 'Nama',
            'divisi' => 'Divisi',
        ]);

        return $validated;
    }

    public static function create(Request $input)
    {
        $validated = self::process_data($input);
        $data = Employee::create($validated);

        return $data;
    }

    public static function update(Request $data, $id)
    {
        $findDataFirst = Employee::findOrFail($id);

        $validated = self::process_data($data, $id);
        $findDataFirst->update($validated);

        return $findDataFirst;
    }

    public static function delete($id)
    {
        $data = Employee::find($id);
        $data->delete();
    }

    public static function list_datatables()
    {
        $data = Employee::where('id', '!=', null);
        return DataTables::of($data)->make();
    }

    public static function get_options()
    {
        $data = Employee::all();
        return $data;
    }
}
