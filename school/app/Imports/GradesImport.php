<?php

namespace App\Imports;

use App\Models\Grade;
use Maatwebsite\Excel\Concerns\ToModel;

class GradesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0] == "Mã khoá học") {
            return null;
        }

        $courseId = $row[0];
        $studentId = $row[1];
        $name = $row[3];
        $grade = $row[4];
        $index = 0;
        if($name == "Giữa kì") {
            $index = 30;
        } elseif($name == "Cuối kì") {
            $index = 60;
        }

        if($grade == null || $name == null) {
            return null;
        }
        
        //protected $fillable = ['course_id', 'student_id', 'name', 'grade', 'index'];

        // dd($row);
        return new Grade([
            'course_id' => $courseId,
            'student_id' => $studentId,
            'name' => $name,
            'grade' => $grade,
            'index' => $index
        ]);
    }
}
