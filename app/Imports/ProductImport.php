<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Product;
use App\Models\Stock;

class ProductImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {

        foreach($rows as $row){

            $products = new Product();

            $products->description = $row['description'];
            $products->cost_price = $row['cost'];
            $products->sell_price = $row['sell'];
            $products->product_image = $row['images'];

            $products->save();

            $stocks = new Stock();
            $stocks->product_id = $products->id;
            $stocks->quantity = $row['quantity'];

            $stocks->product()->associate($products);
            $stocks->save();


        }
    }
}
