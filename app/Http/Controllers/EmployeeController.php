<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\EmployeeDataTable;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\Imports\EmployeeImport;
use App\Rules\ExcelRule;
use Excel;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::with('user')->get();
        // $employee = User::where(['role' => 'employee'])->get();
        return view('employee.index', compact('employee'));
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employee::where('user_id', Auth::id())->find($id);
        return view('employee.edit', compact('employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employees = Employee::find($id);

        $request->validate([
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'employee_image' => 'mimes:png,jpg,gif,svg',
        ]);

        $employees->fname = $request->fname;
        $employees->lname = $request->lname;
        $employees->phone = $request->phone;
        $employees->address = $request->address;
        $employees->city = $request->city;

        if($file = $request->hasFile('employee_image')){
        $file = $request->file('employee_image');
        $fileName = $file->getClientOriginalName();
        $destinationPath  = public_path().'/img_path';
        $input['employee_image'] = 'img_path/'.$fileName;
        $image = $input['employee_image'] = 'img_path/'.$fileName;
        $file->move($destinationPath, $fileName);
        $employees->employee_image = $image;
        }

        $employees->update();
        return redirect()->route('employee.profile')->with('Record Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->user()->delete();

        return redirect('getEmployees')->with('Record Successfully Deleted');
    }

    public function getEmployee(EmployeeDataTable $dataTable){
        $employees = Employee::with([])->get();
        return $dataTable->render('employee.employees');

    }

    public function editrole($id){

        // $employees = User::where(['role' => 'employee'])->findOrFail($id);
        $employees = User::with('employee')->findOrFail($id);
        return view('employee.edit_role', compact('employees'));

    }

    public function  updaterole(Request $request, $id)
    {
        $employees = User::with('employee')->findOrFail($id);

        $request->validate([
            'role' => 'required|max:255'
        ]);

        $employees->role = $request->role;

        $employees->update();

        return redirect()->route('employee.index')->with('Roles Successfully Updated');
    }

    public function import(Request $request){

        $request->validate([
            'employee_import' => ['required', new ExcelRule($request->file('employee_import'))],
        ]);

        Excel::import(new EmployeeImport, request()->file('employee_import'));

        return redirect()->back()->with('success', 'Excel File Imported Successfully');

    }
}
