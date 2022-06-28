<?php

namespace App\models\CompoleteModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pendulum extends Model
{
    //
    protected $table="danbai";
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    public $timestamps = true;
    protected $primaryKey="id";
    protected $guarded = [];

    public static function zlcEstablish (
        $student_id,
        $zq,
        $dcm1,$dcm2,$dcm3,$dcm4,$dcm5,$dcm6,
        $average_dcm,
        $sd1,$sd2,$sd3,$sd4,$sd5,$sd6,
        $average_sd,$average_d,$averages_dcm,
        $l,$js,
        $xz1,$xz2,$xz3

    ){

        $res1=DB::table('danbai')->where('student_id',$student_id)->value('student_id');
        if($res1==null) {
            $res2 =Pendulum::create([
                'student_id' => $student_id,
                'zq' => $zq,
                'dcm1' => $dcm1,
                'dcm2' => $dcm2,
                'dcm3' => $dcm3,
                'dcm4' => $dcm4,
                'dcm5' => $dcm5,
                'dcm6' => $dcm6,
                'average_dcm' => $average_dcm,
                'sd1' => $sd1,
                'sd2' => $sd2,
                'sd3' => $sd3,
                'sd4' => $sd4,
                'sd5' => $sd5,
                'sd6' => $sd6,
                'average_sd' => $average_sd,
                'average_d' => $average_d,
                'averages_dcm' => $averages_dcm,
                'l' => $l,
                'xz1' => $xz1,
                'xz2' => $xz2,
                'xz3' => $xz3,
                'state'=>0,
                'js'=>$js
            ]);
            return $res2;
        }
        else
            return 0;
    }

    public static function zlcStateChange($student_id){

        try {

            $row =Pendulum::where('student_id',$student_id)->update([
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

    public static function zlcGrade($student_id, $grade,$grade_xp){
        try {

            $res = Pendulum::where('student_id', '=', $student_id)

                ->update(['grade' => $grade,'grade_xp' => $grade_xp]);

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('搜索错误', [$e->getMessage()]);
            return false;
        }
    }

    public static function zlcJs($student_id,$tgrade){
        try {
            $grade=DB::table('danbai')->where('student_id',$student_id)->value('grade');
            if($grade>71)
                return false;
            $grade+=$tgrade;
            $res = Pendulum::where('student_id', '=', $student_id)

                ->update(['grade' => $grade,]);

            return $res ?
                $res :
                false;
        } catch (\Exception $e) {
            logError('评分错误', [$e->getMessage()]);
            return false;
        }
    }
}
