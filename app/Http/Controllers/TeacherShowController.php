<?php

namespace App\Http\Controllers;

use App\models\CompoleteModel\Physics;
use App\models\CompoleteModel\TeacherShow;
use Illuminate\Http\Request;

class TeacherShowController extends Controller
{
    public function yjxshowxxallin(Request $request)
    {

        $year = $request['year'];
        $class = $request['class'];
        $experiment = $request['experiment'];

        if ($experiment == '物理') {
            $res = TeacherShow::yjxshowallin($year, $class);
        } else {
            $res = TeacherShow::yjxshowallin2($year, $class);
        }


        return $res ?
            json_success('查询成功!', $res, 200) :
            json_fail('查询失败', null, 100);

    }
}
