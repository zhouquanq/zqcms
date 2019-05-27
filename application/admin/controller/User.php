<?php
namespace app\admin\controller;
use \think\Db;
use \think\Request;

class User extends Auth
{
    public function index(){
        return $this->fetch();
    }

    public function add(){
        return $this->fetch();
    }

    public function edit(){
        //修改查询就数据
        $map['uid'] = input("get.uid");
        $userInfo =  Db::name('users')->where($map)->find();
        $this->assign('userInfo',$userInfo);
        return $this->fetch('edit');
    }

    public function getUsers($map=''){
        if(Request::instance()->isGet()){
            //获取分页page和limit参数
            $page = input("get.page") ? input("get.page") : 1;
            $page = intval($page);
            $limit = input("get.limit") ? input("get.limit") : 1;
            $limit = intval($limit);
            $start = $limit*($page-1);
            $username = input("get.username") ? input("get.username") : '';
            if($username) {
//                $map['username'] = array('like','%'.$username.'%');
                $map = "username like '%".$username."%'";
            }
            //分页查询
            $count = Db::name("users")->where($map)->count();
            $user_list = Db::name("users")->where($map)->limit($start,$limit)->select();
            $list["msg"] = "";
            $list["code"] = 0;
            $list["count"] = $count;
            $list["data"] = $user_list;
            if(empty($user_list)){
                $list["msg"]="暂无数据";
            }
            return json($list);
        }
    }

    public function do_add(){
        if(Request::instance()->isPost()){
            $data = input('post.');
            $map['username'] = $data['username'];
            $is_user =  Db::name('users')->where($map)->find();
            if($is_user){
                return json(["status"=>0,"msg"=>"添加失败，用户名已存在！"]);
            }
            //调用验证器自动验证
            $validate = new \app\admin\validate\User;
            $validateData = ['username' => $data['username'], 'password' => $data['password']];
            if (!$validate->check($validateData)) {
                return json(["status"=>0,"msg"=>$validate->getError()]);
            }
            $data['password'] = md5($data['password']);
            $data['nickname'] = $data['username'];
            $data['reg_date'] = time();
            $re =  Db::name('users')->insert($data);
            if($re){
                return json(["status"=>1,"msg"=>"用户添加成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"用户添加失败！"]);
            }
        }
    }

    public function do_del(){
        if(Request::instance()->isPost()){
            $uid = input('uid');
            $re = Db::name('users')->delete($uid);
            if($re){
                return json(["status"=>1,"msg"=>"删除成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"删除失败！"]);
            }
        }
    }

    public function do_delAll(){
        if(Request::instance()->isPost()){
            $uids = input('uids');
            $re =  Db::name('users')->delete($uids);
            if($re){
                return json(["status"=>1,"msg"=>"删除成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"删除失败！"]);
            }
        }
    }

    public function do_edit(){
        if(Request::instance()->isPost()){
            $data = input('post.');
            $uid = input('get.uid');
            //调用验证器
            $validate = new \app\admin\validate\User;
            $validateData = ['username' => $data['username']];
            //验证是否符合验证器里定义(验证码)的规范,不符合返回错误信息
            if (!$validate->check($validateData)) {
                return json(["status"=>0,"msg"=>$validate->getError()]);
            }
            $data['nickname'] = $data['username'];
            $re =  Db::name('users')->where('uid',$uid)->update($data);
            if($re){
                return json(["status"=>1,"msg"=>"用户信息修改成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"用户信息修改失败！"]);
            }
        }
    }

    //修改用户的状态
    public function update_lock(){
        if(Request::instance()->isPost()){
            $uid=input("post.uid");
            $new_status['is_lock'] = input("post.status");
            $re=Db::name("users")->where('uid',$uid)->update($new_status);
            if($re){
                return json(["status"=>1,"msg"=>"用户状态修改成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"用户状态修改失败！"]);
            }
        }
    }

}
