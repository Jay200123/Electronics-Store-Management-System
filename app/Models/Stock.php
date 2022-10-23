<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $primaryKey ='product_id';

    public $table='stocks';

    public $timestamps = 'false';
    protected $fillable=['product_id', 'quantity'];

    public function product(){
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
}
