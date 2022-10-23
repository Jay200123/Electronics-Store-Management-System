<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request){

        $searchResults = (new Search())
        ->registerModel(Product::class, 'description')
        ->search($request->get('search')); 
        // dd($searchResults); 
        return view('search', compact('searchResults'));

    }
}
