<?php

namespace App\Imports;

use App\Models\Employee;
use App\Models\User;
use App\Http\Controllers\_CONST;
use Maatwebsite\Excel\Concerns\ToModel;

class TeachersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0] == "Tên") {
            return null;
        }

        if($row[0] == null || $row[1] == null || $row[2] == null || $row[6] == null) {
            return null;
        }

        // dd($row);

        $user = new User();
        $user->name = $row[0];
        $user->email = $row[2];
        // define this user as a student
        $user->role_id = _CONST::TEACHER_ROLE_ID;
        $title = $row[8];
        $user->title = $title;
        $user->theme = "danger";
        $user->password = bcrypt("teacher123");
        $user->save();

        $gender = 1;
        if($row[3] == "Nam") {
            $gender = 1;
        } elseif($row[3] == "Nữ") {
            $gender = 2;
        } elseif($row[3] == "Khác") {
            $gender = 3;
        }
        
        $dob = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]);
        $doj = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]);
        $address = $row[9];

        //protected $fillable = ['user_id', 'type', 'name', 'phone', 'email', 'gender', 'dob', 'doj', 'department_id', 'address'];
        return new Employee([
            'user_id' => $user->id,
            'type' => 'teacher',
            'name' => $row[0],
            'phone' => $row[1],
            'email' => $row[2],
            'gender' => $gender,
            'dob' => $dob,
            'doj' => $doj,
            'department_id' => $row[7]
        ]);
    }
}
