<?php
namespace app\admin\controller;

use \think\Db;
use \think\Request;

/**
 * Class Tag 标签控制器
 */
class Tag extends Auth{
    // 标签列表
    public function index(){
        return $this->fetch();
    }
    // 修改标签页面
    public function edit(){
        //修改查询旧数据
        $map['tid'] = input("get.tid");
        $oldTag =  Db::name('tag')->where($map)->find();
        $this->assign('oldTag',$oldTag);
        return $this->fetch();
    }
    // 获取标签操作
    public function getTags(){
        if(Request::instance()->isGet()){
            //获取分页page和limit参数
            $page = input("get.page") ? input("get.page") : 1;
            $page = intval($page);
            $limit = input("get.limit") ? input("get.limit") : 1;
            $limit = intval($limit);
            $start = $limit*($page-1);
            //分页查询
            $count = Db::name("tag")->count();
            $tag_list = Db::name("tag")->order("tid asc")->limit($start,$limit)->select();
            $list["msg"] = "";
            $list["code"] = 0;
            $list["count"] = $count;
            $list["data"] = $tag_list;
            if(empty($tag_list)){
                $list["msg"]="暂无数据";
            }
            return json($list);

        }
    }
    // 添加标签操作
    public function do_add(){
        if(Request::instance()->isPost()){
            $data = input('post.');
            $map['tagname'] = $data['tagname'];
            $is_tag =  Db::name('tag')->where($map)->find();
            if($is_tag){
                return json(["status"=>1,"msg"=>"添加失败，标签名已存在！"]);
            }
            //调用验证器自动验证
            $validate = new \app\admin\validate\Tag;
            $validateData = ['tagname' => $data['tagname']];
            if (!$validate->check($validateData)) {
                return json(["status"=>0,"msg"=>$validate->getError()]);
            }
            $re =  Db::name('tag')->insert($data);
            if($re){
                return json(["status"=>1,"msg"=>"标签添加成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"标签添加失败！"]);
            }
        }
    }
    // 删除标签操作
    public function do_del(){
        if(Request::instance()->isPost()){
            $tid = input('tid');
            $re = Db::name('tag')->delete($tid);
            if($re){
                $map['tag_tid'] = array('eq',$tid);
                Db::name('article_tag')->where($map)->delete();
                return json(["status"=>1,"msg"=>"标签删除成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"标签删除失败！"]);
            }
        }
    }
    // 删除选中标签操作
    public function do_delAll(){
        if(Request::instance()->isPost()){
            $tids = input('tids');
            $re =  Db::name('tag')->delete($tids);
            if($re){
                $map['tag_tid'] = array('in',$tids);
                Db::name('article_tag')->where($map)->delete();
                return json(["status"=>1,"msg"=>"删除成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"删除失败！"]);
            }
        }
    }
    // 修改标签操作
    public function do_edit(){
        if(Request::instance()->isPost()){
            $data = input('post.');
            $tid = input('get.tid');
            $map['tagname'] = $data['tagname'];
            $old_tag = Db::name('tag')->where("tid = $tid")->find();
            $is_tag =  Db::name('tag')->where($map)->find();
            if($is_tag && $old_tag['tagname'] != $data['tagname']){
                return json(["status"=>0,"msg"=>"修改失败，标签名已存在！"]);
            }
            //调用验证器
            $validate = new \app\admin\validate\Tag;
            $validateData = ['tagname' => $data['tagname']];
            //验证是否符合验证器里定义(验证码)的规范,不符合返回错误信息
            if (!$validate->check($validateData)) {
                return json(["status"=>0,"msg"=>$validate->getError()]);
            }
            $re =  Db::name('tag')->where('tid',$tid)->update($data);
            if($re){
                return json(["status"=>1,"msg"=>"标签修改成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"标签修改失败！"]);
            }
        }
    }
}
