<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $table='employees';

    protected $fillable = ['fname', 'lname','phone','address','city','employee_image','user_id'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
