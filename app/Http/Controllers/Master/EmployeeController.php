<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Employee;
use App\Service\EmployeeService;

class EmployeeController extends Controller
{

    public function index()
    {
        return view('employee.employee-list');
    }

    public function create()
    {
        return view('employee.employee-form');
    }

    public function store(Request $request)
    {
        $data = EmployeeService::create($request);
        
        // return redirect()->to("/employee")->with([
        //     'success' => 'Data berhasil ditambahkan'
        // ]);

        return response()->json([
            'success' => 'Data berhasil ditambahkan'
        ]);
    }

    public function show(int $id)
    {
    }

    public function edit(int $id)
    {
        $data = Employee::find($id);

        return view('employee.employee-form', compact('data'));
    }

    public function update(Request $request, int $id)
    {
        $data = EmployeeService::update($request, $id);
        // return redirect()->to("/employee")->with([
        //     'success' => 'Data berhasil diperbarui'
        // ]);
        
        return response()->json([
            'success' => 'Data berhasil diedit'
        ]);
    }

    public function destroy(int $id)
    {
        EmployeeService::delete($id);

        // return redirect()->route('employee.employee.index')->with([
        //     'success' => 'Data berhasil dihapus'
        // ]);
        
        return response()->json([
            'success' => 'Data berhasil dihapus'
        ]);
    }
    public function getById(int $id)
    {
        $employee = Employee::where('id', $id)->first();

        return $employee;
    }

    public function list_datatables()
    {
        return EmployeeService::list_datatables();
    }
}
