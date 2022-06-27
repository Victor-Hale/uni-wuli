<?php

namespace App\models\UserorStudentModel;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

            $student_id = self::create($array)->id;
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
