<?php

namespace App\models\CompoleteModel;

use Illuminate\Database\Eloquent\Model;

class TeacherShow extends Model
{
    protected $table = "student";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function yjxshowallin($year,$class)
    {
        try {
            $res = self::where('student_year',$year)
                ->where('student_class',$class)
                ->join('experiment','experiment.student_id','student.student_num')
                ->get();
//dd(22);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('chaxun错误', [$e->getMessage()]);
            return false;
        }
    }

    public static function yjxshowallin2($year,$class)
    {
        try {
            $res = self::where('student_year',$year)
                ->where('student_class',$class)
                ->join('danbai','danbai.student_id','student.student_num')
                ->get();
//dd(22);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('chaxun错误', [$e->getMessage()]);
            return false;
        }
    }
}
