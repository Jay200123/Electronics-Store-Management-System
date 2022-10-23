<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Customer;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Cart;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'user'], function(){

    Route::group(['middleware' => 'guest'], function(){
       
        //Customer Signup Routes
        Route::get('signup', [UserController::class, 'getSignup'])->name('user.signup');
        Route::post('signup', [UserController::class, 'postSignup'])->name('user.signups');

        //Employee Signup Routes
        Route::get('esignup', [UserController::class, 'getEmployee'])->name('user.employee');
        Route::post('esignup', [UserController::class, 'postEmployee'])->name('user.employees');

        //User Signin
        Route::get('signin', [UserController::class, 'getSignin'])->name('user.signin');
        Route::post('sigin', [LoginController::class, 'postSignin'])->name('user.signins');

    });


    //Route group for Customer
    Route::group(['middleware' => 'role:customer'], function(){

        Route::get('profile', [UserController::class, 'getProfile'])->name('user.profile');
        Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::put('/customers/{id}/update', [CustomerController::class, 'update'])->name('customers.update');
         
        //routes for shop index
        route::get('/shop', [CartController::class, 'index'])->name('shops.index');

       //Routes for Cart
        Route::get('/shopping-cart', [CartController::class, 'getCart'])->name('shop.shoppingCart');
        Route::get('add-to-cart/{id}', [CartController::class,  'getAddToCart'])->name('shops.addToCart');
        Route::get('remove/{id}', [CartController::class, 'getRemoveItem'])->name('shop.remove');
        Route::get('reduce/{id}', [CartController::class, 'getReduceByOne'])->name('shop.reduceByOne');
        Route::get('checkout', [CartController::class, 'checkout'])->name('shop.checkout');
  

    });

    //Route group for Employee
    Route::group(['middleware' => 'role:employee'], function(){
        Route::get('eprofile', [UserController::class, 'getEmployeeProfile'])->name('employee.profile');
        Route::get('/employee/{id}/edit',  [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('/employee/{id}/update', [EmployeeController::class, 'update'])->name('employees.update');

       //Products Route
        Route::get('/product/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/product/{id}/update', [ProductController::class, 'update'])->name('products.update');

       //Route for Import
       
       //Excel Import For Customer
       Route::post('/customer/import', [CustomerController::class, 'import'])->name('customerImport');
       //Excel Import For Employee
       Route::post('/employee/import', [EmployeeController::class, 'import'])->name('employeeImport');
       //Excel Import for Product
       Route::post('/product/import', [ProductController::class, 'import'])->name('productImport');

    });

    //Route group for admin
    Route::group(['middleware'  => 'role:admin'], function(){

        //route for index
        Route::get('/dasboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');

        //route for updating roles
        Route::get('edit_role/{id}/edit', [EmployeeController::class, 'editrole'])->name('roles.edit');
        Route::put('edit_role/{id}/update', [EmployeeController::class, 'updaterole'])->name('roles.update');

        //route for deletes
        Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
        Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
        Route::delete('/product/{id}', [ProductController::class, 'delete'])->name('products.destroy');
    });

    //Route group for admin & employee
        Route::group(['middleware' => 'role:admin,employee'], function(){
        route::get('/customers', [CustomerController::class, 'getCustomer'])->name('getCustomers');
        route::get('/employees', [EmployeeController::class, 'getEmployee'])->name('getEmployees');
        route::get('/products', [ProductController::class, 'getProduct'])->name('getProducts');
        route::get('/product', [ProductController::class, 'index'])->name('products.index');
    });
});

//route for logout
Route::get('logout',[
    'uses' => 'LoginController@logout',
    'as' => 'user.logout',
    ]);

Route::fallback(function () {
return redirect()->back();
});

//Routes for search
Route::get('/search/{search?}', [SearchController::class, 'search'])->name('search');
Route::get('/show-product/{id}', [ProductController::class, 'show'])->name('products.show');

