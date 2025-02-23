<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5|max:20',
            'age' => 'required|integer|min:21',
            'address' => 'required|string|min:10|max:40',
            'phone' => 'required|string|regex:/^08[0-9]{7,10}$/',
        ]);
    
        Employee::create($validated);
        return redirect('/employees')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5|max:20',
            'age' => 'required|integer|min:21',
            'address' => 'required|string|min:10|max:40',
            'phone' => 'required|string|regex:/^08[0-9]{7,10}$/',
        ]);
    
        $employee = Employee::findOrFail($id);
        $employee->update($validated);
    
        return redirect('/employees')->with('success', 'Data karyawan berhasil diperbarui!');
    
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Employee::findOrFail($id)->delete();
        return redirect('/employees')->with('success', 'Data karyawan berhasil dihapus!');
    }

}
