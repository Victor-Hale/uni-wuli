<?php

namespace App\Http\Controllers;

use App\models\UserorStudentModel\Student;
use Illuminate\Http\Request;

class informationFindController extends Controller
{
    //
    public  function zlcSelectStudent(Request $request){
        $student_id =  auth('api')->user()->student_id;
        $res=Student::zlcSelectStudent($student_id);
        return $res?   //判断
            json_success("查询成功",$res,200):
            json_fail("查询失败",null,100);

    }
}
