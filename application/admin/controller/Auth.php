<?php
namespace app\admin\controller;

use \think\Controller;
use \think\Session;
use \think\Db;

/**
 * Class Auth
 * 登录验证控制器
 */
class Auth extends Controller
{
    public function _initialize(){
        if(!Session::has('admin_id') || !Session::has('admin_name') || !Session::has('session_validate')){
            $this->error('非法登录，信不信打死你！','admin/login/index');
        }

        $userSessionValidate =  Db::name('users')->field("session_validate")->find(Session('admin_id'));
        if(Session('session_validate') != $userSessionValidate['session_validate']){
            $this->error('登录过期，请重新登录！','admin/login/index');
//            return alert('登录过期，请重新登录！','/admin/login',2,2);
        }
    }
}