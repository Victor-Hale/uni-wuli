<?php

namespace App\models\UserorStudentModel;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable ;

    protected $table = 'user';
    protected $remeberTokenName = NULL;
    protected $guarded = [];
    protected $fillable = [ 'password','student_id','status'];
    protected $hidden = [
        'password',
    ];
    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return ['role' => 'user'];
    }


    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }
    /**
     * 创建用户
     *
     * @param array $array
     * @return |null
     * @throws \Exception
     */
    public static function createUser($array = [])
    {
        try {
       //dd($array);
            $student_id = self::create([
                'student_id'=>$array['student_id'],
                'password'=>$array['password']
            ])->id;
//dd(6657);
            $res = DB::table('student')->insert(
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


            return $student_id ?
                $student_id :
                false;
        } catch (\Exception $e) {
            logError('添加用户失败!', [$e->getMessage()]);
            die($e->getMessage());
            return false;
        }
    }

    /**
     * 查询该工号是否已经注册
     * 返回该工号注册过的个数
     * @param $request
     * @return false
     */
    public static function checknumber($request)
    {
        $student_job_number = $request['student_id'];
        try{
            $count = User::select('student_id')
                ->where('student_id',$student_job_number)
                ->count();
            //echo "该账号存在个数：".$count;
            //echo "\n";
            //dd($count);
            return $count;
        }catch (\Exception $e) {
            logError("账号查询失败！", [$e->getMessage()]);
            return false;
        }
    }

}
