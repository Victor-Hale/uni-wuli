<?php

namespace App\models\UserorStudentModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    //
    protected $table="student";
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $primaryKey="id";
    public $timestamps = true;



    public  static  function zlcSelectStudent($student_id){
        $res =DB::table("student")->where("student_num",$student_id)->select(
            "student_name","student_num","student_level", "student_year","student_spec","student_class"
        )->get();
        return $res;
    }
}
