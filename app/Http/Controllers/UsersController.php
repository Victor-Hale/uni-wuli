<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\models\UserorStudentModel\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * 注册
     * @param Request $registeredRequest
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function registered(Request $registeredRequest)
    {
        //dd($registeredRequest);
        $count = User::checknumber($registeredRequest);   //检测账号密码是否存在
        if($count == 0)
        {
            $student_id = User::createUser(self::userHandle($registeredRequest));
            return  $student_id ?
                json_success('注册成功!',$student_id,200  ) :
                json_fail('注册失败!',null,100  ) ;
        }
        else{
            return
                json_success('注册失败!该工号已经注册过了！',null,100  ) ;
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        $credentials = self::credentials($request);   //从前端获取账号密码
       $stuid=$request['student_id'];
       $password=$request['password'];
        $token = auth('api')->attempt($credentials);   //获取token
         $data['token']=$token;
        // $data['status']=DB::table('user')->where('student_id',$stuid)->value('status');
        return $token?
            json_success('登录成功!',$data,  200):
            json_fail('登录失败!账号或密码错误',null, 100 ) ;
        //       json_success('登录成功!',$this->respondWithToken($token,$user),  200);
    }

    //封装token的返回方式
    protected function respondWithToken($token, $msg)
    {
        // $data = Auth::user();
        return json_success( $msg, array(
            'token' => $token,
            //设置权限  'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ),200);
    }
    protected function credentials($request)   //从前端获取账号密码
    {
        return ['student_id' => $request['student_id'], 'password' => $request['password']];
    }

    protected function userHandle($request)   //对密码进行哈希256加密
    {
        $registeredInfo = $request->except('password_confirmation');
        $registeredInfo['password'] = bcrypt($request['password']);
      // $registeredInfo['collegename'] = $registeredInfo['collegename'];
        //$registeredInfo['status'] = 0;
        return $registeredInfo;
    }


    /**
     * 修改密码时从新加密
     */
    protected function userHandle111($password)   //对密码进行哈希256加密
    {
        $red = bcrypt($password);
        return $red;
    }
    /**
     * 修改密码
     */
    public function again(Request $registeredRequest)
    {
        $collegename    = $registeredRequest['collegename'];
        $newpassword = $registeredRequest['newpassword'];

        $password3 = self::userHandle111($newpassword);
        $red = DB::table('users')->where('collegename', '=', $collegename)->update([
            'password' => $password3
        ]);
        return $red ?
            json_success('修改成功!', $red, 200) :
            json_fail('修改失败!', null, 100);
    }

}
