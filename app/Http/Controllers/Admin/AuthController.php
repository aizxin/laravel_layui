<?php
/**
 *  管理员认证
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Aizxin\Services\Admin\UserService;
use Auth;
use Cache;
class AuthController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }
    /**
     *  [login 管理员登录]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-05T14:41:02+0800
     *  @param    UserLoginRequest         $request [description]
     *  @return   [type]                            [description]
     */
    public function postLogin(Request $request)
    {
        return $this->service->postLogin($request);
    }
    /**
     *  [addUser 管理员注册]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-05T16:03:09+0800
     *  @param    UserLoginRequest         $request [description]
     */
    public function addUser(Request $request)
    {
         return $this->service->addUser($request);
    }
    /**
     *  [logout 管理员退出]
     *  臭虫科技
     *  @author chouchong
     *  @DateTime 2017-04-10T16:18:51+0800
     *  @return   [type]                   [description]
     */
    public function logout()
    {
        Cache::forget('userpermission'.auth()->user()->id);
        Auth::guard('web')->logout();
        return redirect('/login');
    }
}
