<?php
namespace app\admin\controller;

use \think\Db;
use \think\Request;

class Flink extends Auth{
    public function index(){
        return $this->fetch();
    }

    public function do_add(){
        if(Request::instance()->isPost()){
            $data = input('post.');
            $map['flinkname'] = $data['flinkname'];
            $is_flink =  Db::name('flink')->where($map)->find();
            if($is_flink){
                return json(["status"=>1,"msg"=>"添加失败，标签名已存在！"]);
            }
            //调用验证器自动验证
            $validate = new \app\admin\validate\flink;
            $validateData = ['flinkname' => $data['flinkname']];
            if (!$validate->check($validateData)) {
                return json(["status"=>0,"msg"=>$validate->getError()]);
            }
            $re =  Db::name('flink')->insert($data);
            if($re){
                return json(["status"=>1,"msg"=>"标签添加成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"标签添加失败！"]);
            }
        }
    }

    public function getflinks(){
        if(Request::instance()->isGet()){
            //获取分页page和limit参数
            $page = input("get.page") ? input("get.page") : 1;
            $page = intval($page);
            $limit = input("get.limit") ? input("get.limit") : 1;
            $limit = intval($limit);
            $start = $limit*($page-1);
            //分页查询
            $count = Db::name("flink")->count();
            $flink_list = Db::name("flink")->order("sort asc")->limit($start,$limit)->select();
            $list["msg"] = "";
            $list["code"] = 0;
            $list["count"] = $count;
            $list["data"] = $flink_list;
            if(empty($flink_list)){
                $list["msg"]="暂无数据";
            }
            return json($list);

        }
    }

    public function do_del(){
        if(Request::instance()->isPost()){
            $tid = input('tid');
            $re = Db::name('flink')->delete($tid);
            if($re){
                $map['flink_tid'] = array('eq',$tid);
                Db::name('article_flink')->where($map)->delete();
                return json(["status"=>1,"msg"=>"标签删除成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"标签删除失败！"]);
            }
        }
    }

    public function do_delAll(){
        if(Request::instance()->isPost()){
            $tids = input('tids');
            $re =  Db::name('flink')->delete($tids);
            if($re){
                $map['flink_tid'] = array('in',$tids);
                Db::name('article_flink')->where($map)->delete();
                return json(["status"=>1,"msg"=>"删除成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"删除失败！"]);
            }
        }
    }

    public function edit(){
        //修改查询旧数据
        $map['tid'] = input("get.tid");
        $oldflink =  Db::name('flink')->where($map)->find();
        $this->assign('oldflink',$oldflink);
        return $this->fetch();
    }

    public function do_edit(){
        if(Request::instance()->isPost()){
            $data = input('post.');
            $tid = input('get.tid');
            $map['flinkname'] = $data['flinkname'];
            $old_flink = Db::name('flink')->where("tid = $tid")->find();
            $is_flink =  Db::name('flink')->where($map)->find();
            if($is_flink && $old_flink['flinkname'] != $data['flinkname']){
                return json(["status"=>0,"msg"=>"修改失败，标签名已存在！"]);
            }
            //调用验证器
            $validate = new \app\admin\validate\flink;
            $validateData = ['flinkname' => $data['flinkname']];
            //验证是否符合验证器里定义(验证码)的规范,不符合返回错误信息
            if (!$validate->check($validateData)) {
                return json(["status"=>0,"msg"=>$validate->getError()]);
            }
            $re =  Db::name('flink')->where('tid',$tid)->update($data);
            if($re){
                return json(["status"=>1,"msg"=>"标签修改成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"标签修改失败！"]);
            }
        }
    }

}
