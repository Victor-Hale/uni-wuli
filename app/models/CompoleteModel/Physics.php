<?php

namespace App\models\CompoleteModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Self_;

class Physics extends Model
{
    protected $table = "experiment";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    public static function establish(
        $student_id,
        $pd1,
        $pd2,
        $pd3,
        $pd4,
        $pd5,
        $pd6,
        $pd7,
        $pd8,
        $xz1,
        $xz2,
        $xz3,
        $xz4,
        $xz5,
        $xz6,
        $xz7,
        $xz8,
        $xz9 ,
        $xz10,
        $xz11,
        $xz12
    ){
        try {
           // DB::table('experiment')->create
            //dd($student_id);
          $r =  DB::table('experiment')->select()->where('student_id' ,'=',$student_id)->count();
            if ($r !=0){
                return false;
            }else {

                $res = self::create(
                //
                    [
                        'pd1' => $pd1,
                        'pd2' => $pd2,
                        'pd3' => $pd3,
                        'pd4' => $pd4,
                        'pd5' => $pd5,
                        'pd6' => $pd6,
                        'pd7' => $pd7,
                        'pd8' => $pd8,
                        'xz1' => $xz1,
                        'xz2' => $xz2,
                        'xz3' => $xz3,
                        'xz4' => $xz4,
                        'xz5' => $xz5,
                        'xz6' => $xz6,
                        'xz7' => $xz7,
                        'xz8' => $xz8,
                        'xz9' => $xz9,
                        'xz10' => $xz10,
                        'xz11' => $xz11,
                        'xz12' => $xz12,

                        'student_id' => $student_id,
                        'state' => 1,
                    ]

                );
            }
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('添加错误', [$e->getMessage()]);
            return false;
        }
            }


    public static function YJXshow($student_id)
    {
        try {

            $res = self::
            join('student', 'student.id', '=', 'completion1.student_id')
                ->where('student.id', '=', $student_id)
                ->select(
                    'student.student_name',
                    'student.student_level',
                    'student.student_spec',
                    'student.student_year',
                    'student.student_class',
                    'student.student_num',
                    'student.experiment_name',
                    'student.course_name',
                    'student.student_date',
                    'student.student_teacher',

                    'student.grade',
                    'student.grade_xp',


                    'pd1',
                    'pd2',
                    'pd3',
                    'pd4',
                    'pd5',
                    'pd6',
                    'pd7',
                    'pd8',
                    'xz1',
                    'xz2',
                    'xz3',
                    'xz4',
                    'xz5',
                    'xz6',
                    'xz7',
                    'xz8',
                    'xz9',
                    'xz10',
                    'xz11',
                    'xz12'
                )->get();

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }


    }
}
