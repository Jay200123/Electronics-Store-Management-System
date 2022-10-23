<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\Models\Order;

class Product extends Model implements Searchable
{
    // use HasFactory;

    public $table='products';

    public $primaryKey='id';

    public $timestamps = 'false';

    protected $fillable = ['description','cost_price','sell_price','product_image'];

    public function stock(){
        return $this->hasOne('App\Models\Stock','product_id');
    }

    public function  orders(){
        return $this->belongsToMany(Order::class, 'orderline','orderinfo_id','product_id')->withPivot('quantity');
    }

    public function getSearchResult(): SearchResult
    {
        $url = url('show-product/'.$this->id);
        return new SearchResult(
            $this,
            $this->description,
            $url);
    }
}
