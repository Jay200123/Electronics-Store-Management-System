<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use App\Models\Customer;

class CustomerImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach($rows as $row){

            $user = new User();
                $user->name = $row['fname'].''.$row['lname'];
                $user->email = $row['email'];
                $user->password = bcrypt($row['password']);
                $user->role = 'customer';
                $user->save();

                $customer  = new Customer();

                $customer->fname = $row['fname'];
                $customer->lname = $row['lname'];
                $customer->phone = $row['phone'];
                $customer->address = $row['address'];
                $customer->city = $row['city'];
                $customer->customer_image = $row['images'];
                $customer->user_id = $user->id;
                
                $customer->user()->associate($user);
                $customer->save();

        }
    }
}
