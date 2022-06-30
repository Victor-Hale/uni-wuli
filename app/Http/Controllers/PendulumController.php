<?php

namespace App\Http\Controllers;

use App\models\CompoleteModel\Pendulum;
use Illuminate\Http\Request;

class PendulumController extends Controller
{
    //
    public static function zlcDanbai(Request $request){
        $student_id=auth('api')->user()->student_id;

        $zq=sprintf("%.3f",$request['zq']);
        $dcm1=sprintf("%.3f",$request['dcm1']);
        $dcm2=sprintf("%.3f",$request['dcm2']);
        $dcm3=sprintf("%.3f",$request['dcm3']);
        $dcm4=sprintf("%.3f",$request['dcm4']);
        $dcm5=sprintf("%.3f",$request['dcm5']);
        $dcm6=sprintf("%.3f",$request['dcm6']);
        $average_dcm=sprintf("%.3f",$request['average_dcm']);
        $sd1=sprintf("%.3f",$request['sd1']);
        $sd2=sprintf("%.3f",$request['sd2']);
        $sd3=sprintf("%.3f",$request['sd3']);
        $sd4=sprintf("%.3f",$request['sd4']);
        $sd5=sprintf("%.3f",$request['sd5']);
        $sd6=sprintf("%.3f",$request['sd6']);
        $average_sd=sprintf("%.3f",$request['average_sd']);
        $average_d=sprintf("%.3f",$request['average_d']);
        $averages_dcm=sprintf("%.3f",$request['averages_dcm']);
        $l=sprintf("%.2f",$request['l']);
        $js=$request['js'];
        $xz1=$request['xz1'];
        $xz2=$request['xz2'];
        $xz3=$request['xz3'];

        $res1=Pendulum::zlcEstablish(  $student_id,
            $zq,
            $dcm1,$dcm2,$dcm3,$dcm4,$dcm5,$dcm6,
            $average_dcm,
            $sd1,$sd2,$sd3,$sd4,$sd5,$sd6,
            $average_sd,$average_d,$averages_dcm,
            $l,$js,
            $xz1,$xz2,$xz3);


        $grade = 0;
        $grade_xp = 0;
        Pendulum::zlcStateChange($student_id);
        if($zq==1.967)
        {
            $grade+=5;
        }
        if($dcm1==1.662)
        {
            $grade+=3;
        }
        if($dcm2==1.702)
        {
            $grade+=3;
        }

        if($dcm3==1.672)
        {
            $grade+=3;
        }
        if($dcm4==1.672)
        {
            $grade+=3;
        }
        if($dcm5==1.692)
        {
            $grade+=3;
        }
        if($dcm6==1.721)
        {
            $grade+=3;
        }
        if( $average_dcm==1.687)
        {
            $grade+=3;
        }


        if($sd1==0.025)
        {
            $grade+=3;
        }
        if($sd2==0.015)
        {
            $grade+=3;
        }
        if($sd3==0.015)
        {
            $grade+=3;
        }
        if($sd4==0.015)
        {
            $grade+=3;
        }
        if($sd5==0.015)
        {
            $grade+=3;
        }
        if($sd6==0.039)
        {
            $grade+=3;
        }

        if($average_sd==0.021)
        {
            $grade+=3;
        }

        if($average_d==1.687)
        {
            $grade+=2;
        }


        if($averages_dcm==0.021)
        {
            $grade+=2;
        }

        if($l==91.78)
        {
            $grade+=5;
        }


        if($xz1=='C')
        {
            $grade_xp+=5;
        }
        if($xz2=='C')
        {
            $grade_xp+=5;
        }
        if($xz3=='A')
        {
            $grade_xp+=5;
        }

        $grade=$grade+$grade_xp;

        $res2 = Pendulum::zlcGrade($student_id, $grade,$grade_xp);

        $res['res1'] = $res1;
        $res['res2'] = $res2;

        return $res ?
            json_success('操作成功!', null, 200) :
            json_fail('操作失败!', null, 100);
    }

    public static function zlcJs(Request $request){
        $student_id=$request['student_id'];
        $tgrade=$request['tgrade'];
        $res=null;
        if($tgrade<=29)
            $res= Pendulum::zlcJs($student_id,$tgrade);

        return $res ?
            json_success('操作成功!', null, 200) :
            json_fail('操作失败!', null, 100);
    }
}
