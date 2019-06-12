<?php
namespace app\admin\controller;

use \think\Db;
use \think\Request;

/**
 * Class Flink 友链控制器
 */
class Flink extends Auth{
    // 友链列表
    public function index(){
        return $this->fetch();
    }
    // 添加友链页面
    public function add(){
        return $this->fetch();
    }
    // 友链修改页面
    public function edit(){
        //修改查询旧数据
        $map['fid'] = input("get.fid");
        $oldflink =  Db::name('flink')->where($map)->find();
        $this->assign('oldflink',$oldflink);
        return $this->fetch();
    }
    // 获取友链操作
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
            return json($list);
        }
    }
    // 友链添加操作
    public function do_add(){
        if(Request::instance()->isPost()){
            $data = input('post.');
            //调用验证器自动验证flink
            $validate = new \app\admin\validate\Flink;
            $validateData = ['fname' => $data['fname'], 'msg' => $data['msg'], 'sort' => $data['sort'], 'url' => $data['url']];
            if (!$validate->check($validateData)) {
                return json(["status"=>0,"msg"=>$validate->getError()]);
            }
            $data['addtime'] = time();
            $re =  Db::name('flink')->insert($data);
            if($re){
                return json(["status"=>1,"msg"=>"友链添加成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"友链添加失败！"]);
            }
        }
    }
    // 友链删除操作
    public function do_del(){
        if(Request::instance()->isPost()){
            $fid = input('fid');
            $re = Db::name('flink')->delete($fid);
            if($re){
                return json(["status"=>1,"msg"=>"删除成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"删除失败！"]);
            }
        }
    }
    // 选中友链添加操作
    public function do_delAll(){
        if(Request::instance()->isPost()){
            $fids = input('fids');
            $re =  Db::name('flink')->delete($fids);
            if($re){
                return json(["status"=>1,"msg"=>"删除成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"删除失败！"]);
            }
        }
    }

    // 友链修改操作
    public function do_edit(){
        if(Request::instance()->isPost()){
            $data = input('post.');
            $fid = input('get.fid');
            //调用验证器自动验证flink
            $validate = new \app\admin\validate\Flink;
            $validateData = ['fname' => $data['fname'], 'msg' => $data['msg'], 'sort' => $data['sort'], 'url' => $data['url']];
            if (!$validate->check($validateData)) {
                return json(["status"=>0,"msg"=>$validate->getError()]);
            }
            $re =  Db::name('flink')->where('fid',$fid)->update($data);
            if($re){
                return json(["status"=>1,"msg"=>"友链修改成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"友链修改失败！"]);
            }
        }
    }

}
