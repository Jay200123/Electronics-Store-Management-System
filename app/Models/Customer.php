<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;

    public $table = 'customers';

    protected $primaryKey='id';

    protected $fillable = ['fname','lname','phone','address','city','customer_image','user_id'];

    // protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function  orders(){
        return $this->hasMany('App\Models\Order','customer_id');
    }
}
