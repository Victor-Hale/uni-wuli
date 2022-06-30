<?php

namespace App\models\UserorStudentModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{

    protected $table = "student";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];




    public static function statechange($id)
    {
        try {

            $row = Student::where('student_num',$id);
            if($row)
                $row = $row->update([
                    'state' => 2
                ]);
            return  $row?
                $row :


                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
    public static function grade($student_id, $grade,$grade_xp)
    {
        try {

            $res = Student::where('student_num', '=', $student_id)

                ->update(['grade' => $grade,'grade_xp' => $grade_xp]);

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    public static function es($array)
    {
        try {
            $res = self::create(
                [
                    'student_name'=>$array['student_name'],
                    'student_level' => $array['student_level'],
                    'student_spec'=> $array['student_spec'],
                    'student_year'=>$array['student_year'],
                    'student_class' => $array['student_class'],
                    'student_num'=> $array['student_id'],
                    'student_teacher' => $array['student_teacher']
                ]
            );

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('创建错误', [$e->getMessage()]);
            return false;
        }

    public  static  function zlcSelectStudent($student_id){
        $res =DB::table("student")->where("student_num",$student_id)->select(
            "student_name","student_num","student_level", "student_year","student_spec","student_class"
        )->get();
        return $res;

    }
}
