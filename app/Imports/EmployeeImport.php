<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use App\Models\Employee;

class EmployeeImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
                
            $user = new User();
            $user->name = $row['fname'].''.$row['lname'];
            $user->email = $row['email'];
            $user->password = bcrypt($row['password']);
            $user->role = 'employee';
            $user->save();

            $employee  = new Employee();
            $employee->fname = $row['fname'];
            $employee->lname = $row['lname'];
            $employee->phone = $row['phone'];
            $employee->address = $row['address'];
            $employee->city = $row['city'];
            $employee->employee_image = $row['images'];
            $employee->user_id = $user->id;
            
            $employee->user()->associate($user);
            $employee->save();
        }
    }
}
