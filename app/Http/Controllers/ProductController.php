<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Imports\ProductImport;
use App\Rules\ExcelRule;
use Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|max:255',
            'cost_price' => 'required|min:6',
            'sell_price' => 'required|min:6',
            'product_image' => 'mimes:png,jpg,gif,svg',
            'quantity' => 'required|min:2',
        ]);


        $products = new Product();
        $products->description = $request->description;
        $products->cost_price = $request->cost_price;
        $products->sell_price = $request->sell_price;

        if($file = $request->hasFile('product_image')) {
        $file = $request->file('product_image') ;
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path().'/img_path' ;
        $input['product_image'] = 'img_path/'.$fileName;
        $image =  $input['product_image'] = 'img_path/'.$fileName;
        $file->move($destinationPath,$fileName);
        $products->product_image = $image;
        }

        $products->save();

        $stocks = new Stock();

        $stocks->product_id = $products->id;
        $stocks->quantity = $request->quantity;

        $stocks->save();

        return redirect()->route('getProducts')->with('Product Successfully Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::find($id);
        return view('product.show', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::find($id);
        return view('product.edit', compact('products'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $products = Product::find($id);

        $request->validate([
            'description' => 'required|max:255',
            'cost_price' => 'required|min:6',
            'sell_price' => 'required|min:6',
            'product_image' => 'mimes:png,jpg,gif,svg',
        ]);

        $products->description = $request->description;
        $products->cost_price = $request->cost_price;
        $products->sell_price = $request->sell_price;

        if($file = $request->hasFile('product_image')) {
            $file = $request->file('product_image') ;
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path().'/img_path' ;
            $input['product_image'] = 'img_path/'.$fileName;
            $image = $input['product_image'] = 'img_path/'.$fileName;
            $file->move($destinationPath,$fileName);
            $products->product_image = $image; 
            }
             $products->update();
             return redirect()->route('getProducts')->with('Record Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->stock()->delete();

        return redirect()->route('getProducts')->with('Record Successfully Deleted');
    }

    public function getProduct(ProductDataTable $dataTable){

    $products = Product::with([])->get();
    return $dataTable->render('product.products');

    }

    public function import(Request $request)
    {
        $request->validate([
            'product_import' => ['required', new ExcelRule($request->file('product_import'))],
        ]);

        Excel::import(new ProductImport, request()->file('product_import'));

        return redirect()->back()->with('success', 'Excel File Imported Successfully');
    }
}
