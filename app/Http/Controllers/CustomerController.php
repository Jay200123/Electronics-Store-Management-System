<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\DataTables\CustomerDataTable;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Redirect;
use App\Imports\CustomerImport;
use App\Rules\ExcelRule;
use Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Customer::all();

        // if($request->has('view_deleted')){

        //     $customers = Customer::onlyTrashed()->get();

        // }
        return view('customer.index', compact('customers'));
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
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customers = Customer::where('user_id', Auth::id())->find($id);
        return view('customer.edit', compact('customers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customers = Customer::find($id);

        $request->validate([
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'customer_image' => 'mimes:png,jpg,gif,svg',
        ]);

        $customers->fname = $request->fname;
        $customers->lname = $request->lname;
        $customers->phone = $request->phone;
        $customers->address = $request->address;
        $customers->city = $request->city;

        if($file = $request->hasFile('customer_image')){
        $file = $request->file('customer_image');
        $fileName = $file->getClientOriginalName();
        $destinationPath  = public_path().'/img_path';
        $input['customer_image'] = 'img_path/'.$fileName;
        $image = $input['customer_image'] = 'img_path/'.$fileName;
        $file->move($destinationPath, $fileName);
        $customers->customer_image = $image;
        }

        $customers->update();
        return redirect()->route('user.profile')->with('Record Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $customers = Customer::find($id);
    $customers->user()->delete();

    return redirect()->route('getCustomers')->with('Customer Record Successfully Deleted');
    }

    public function getCustomer(CustomerDataTable $dataTable){
        $customers = Customer::with([])->get();
        return $dataTable->render('customer.customers');

    }

    public function import(Request $request){

        $request->validate(['customer_import'  => ['required', new ExcelRule($request->file('customer_import'))], ]);

        Excel::import(new CustomerImport, request()->file('customer_import'));

        return redirect()->back()->with('success', 'Excel File Imported Successfully');

    }

//     public function restore($id){
        
//         Customer::withTrashed()->find($id)->restore();
//         return redirect()->route('customer.index');

//     }

//     public function restore_all(){

//         $customer = Customer::onlyTrashed()->restore();
//         return redirect()->route('customer.index');
//     }
}
