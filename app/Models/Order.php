<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;

    public $table='orderinfo';

    protected $primaryKey='id';

    public $timestamps = false;

    protected $fillable=['customer_id','date_placed','date_shipped','shipping','status'];

    public function customer(){
        return $this->belongsTo('App\Models\Customer');
    }

    public function  products(){
        return $this->belongsToMany(Product::class, 'orderline','orderinfo_id','product_id')->withPivot('quantity');
    }
}
    