<?php
namespace app\admin\controller;

use \think\Controller;
use \think\Request;
use \think\Db;
use \think\Session;

/**
 * Class Login 登录控制器
 */
class Login extends Controller{
    // 登录页面
    public function index(){
        return $this->fetch();
    }
    // 登录操作
    public function login(){

        if (Request::instance()->isPost()) {
            $username = input('post.username');
            $password = md5(input('post.password'));
            //查询数据试库
            $where['username'] = $username;
            $where['is_admin'] = '是';
            $userInfo = Db::name('users')->where($where)->find();
            if ($userInfo && $userInfo['password'] === $password) {
                //登录成功写入session
                $session_validate = md5($userInfo['uid'] . time());
                Session::set('admin_id',$userInfo['uid']);
                Session::set('admin_name',$userInfo['username']);
                Session::set('session_validate',$session_validate);
                $loginInfo = array(
                    "session_validate"  => $session_validate,
                    "login_date"        => time(),
                );
                Db::name('users')->where('uid',$userInfo['uid'])->update($loginInfo);
                return json(["status"=>1,"msg"=>"登录成功！"]);
            } else {
                return json(["status"=>0,"msg"=>"账号或密码错误！"]);
            }
        }
    }
    // 登出操作
    public function loginOut(){
        Session::delete('admin_id');
        Session::delete('admin_name');
        Session::delete('session_validate');
        return alert('退出成功！','/admin/login',1,2);
//        return $this->success("退出成功",'admin/login/index');
    }
}