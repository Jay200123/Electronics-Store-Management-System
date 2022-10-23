<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Events\SendMail;
use Auth;
use Event;
use App\Models\Employee;


class UserController extends Controller
{
    public function getSignup(){
        return view('user.signup');
    }

    public function PostSignup(Request $request){

        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4',
        ]);

        $user = new User([
            'name' => $request->input('fname').''.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role').''.$request->role='customer'
        ]);

        $user->save();

        $request->validate([
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'customer_image' => 'mimes:png,jpg,gif,svg',
        ]);

        $customer = new Customer();
        $customer->user_id = $user->id;
        $customer->fname = $request->fname;
        $customer->lname = $request->lname;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->city = $request->city;

        if($file = $request->hasFile('customer_image')){
            $file = $request->file('customer_image');
            $fileName = $file->getClientOriginalName();
            $destinationPath  = public_path().'/img_path';
            $input['customer_image'] = 'img_path/'.$fileName;
            $file->move($destinationPath, $fileName);
            $image = $input['customer_image'] = 'img_path/'.$fileName;
            $customer->customer_image = $image;
        }

        $customer->save();
        Event::dispatch(new SendMail($user));
        Auth::login($user);
        return redirect()->route('user.profile')->with("Welcome to Silicon Valley");


    }


    public function getProfile(){

        $customers = Customer::where('user_id', Auth::id())->get();
        return view('user.profile', compact('customers'));
    }

    public function getEmployee(){
        return view('user.employee_signup');
    }

    public function postEmployee(Request $request){

        $this->validate($request, [
            'email' => 'email|required|unique:users',
            'password' => 'required|min:4',
        ]);

        $user = new User([
            'name' => $request->input('fname').''.$request->lname,
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role').''.$request->role='employee'
        ]);

        $user->save();

        $request->validate([
            'fname' => 'required|max:255',
            'lname' => 'required|max:255',
            'phone' => 'required|max:255',
            'address' => 'required|max:255',
            'city' => 'required|max:255',
            'employee_image' => 'mimes:png,jpg,gif,svg',
        ]);

        $employee = new Employee();
        $employee->user_id = $user->id;
        $employee->fname = $request->fname;
        $employee->lname = $request->lname;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->city = $request->city;

        if($file = $request->hasFile('employee_image')){
            $file = $request->file('employee_image');
            $fileName = $file->getClientOriginalName();
            $destinationPath  = public_path().'/img_path';
            $input['employee_image'] = 'img_path/'.$fileName;
            $file->move($destinationPath, $fileName);
            $image = $input['employee_image'] = 'img_path/'.$fileName;
            $employee->employee_image = $image;
        }

        $employee->save();
        Auth::login($user);
        return redirect()->route('employee.profile')->with("Welcome to Silicon Valley");


    }

    public function getEmployeeProfile(){

        $employees = Employee::where('user_id', Auth::id())->get();
        return view('user.employee_profile', compact('employees'));
    }


    public function getSignin(){
        return view('user.signin');
    }
}
