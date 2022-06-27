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

            $res11 = DB::table('experiment')->update(['grade' => $grade,'grade_xp' => $grade_xp]);
            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }
}
