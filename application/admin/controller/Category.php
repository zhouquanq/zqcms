<?php
namespace app\admin\controller;

use \think\Db;
use \think\Request;

/**
 * Class Category 分类控制器
 */
class Category extends Auth
{
    // 分类列表页
    public function index(){
        return $this->fetch();
    }
    // 添加分类页面
    public function add(){
        $category_list = Db::name("category")->select();
        // 调用unlimitedForLevel函数 树状显示分类
        $cateTree = unlimitedForLevel($category_list);
        $this->assign('cateTree',$cateTree);
        return $this->fetch();
    }
    // 修改分类页面
    public function edit(){
        //查询所有分类并调整树状显示
        $category_list = Db::name("category")->select();
        $cateTree = unlimitedForLevel($category_list);
        //获取旧的分类信息
        $map['cid'] = input("get.cid");
        $oldCate =  Db::name('category')->where($map)->find();
        $this->assign('oldCate',$oldCate);
        $this->assign('cateTree',$cateTree);
        return $this->fetch();
    }
    // 获取分类
    public function getCategory(){
        if(Request::instance()->isGet()){
            //分页查询
            $count = Db::name("category")->count();
            $category_list = Db::name("category")->order("cid asc")->select();
            $list["msg"] = "";
            $list["code"] = 0;
            $list["count"] = $count;
            $list["data"] = $category_list;
            if(empty($category_list)){
                $list["msg"]="暂无分类数据";
            }
            return json($list);
        }
    }
    // 添加分类操作
    public function do_add(){
        if(Request::instance()->isPost()){
            $data = input('post.');
            $map['cname'] = $data['cname'];
            $is_cate =  Db::name('category')->where($map)->find();
            if($is_cate){
                return json(["status"=>0,"msg"=>"添加失败，分类名已存在！"]);
            }
            //调用验证器自动验证
            $validate = new \app\admin\validate\Category;
            $validateData = ['cname' => $data['cname'], 'csort' => $data['csort']];
            if (!$validate->check($validateData)) {
                return json(["status"=>0,"msg"=>$validate->getError()]);
            }
            $re =  Db::name('category')->insert($data);
            if($re){
                return json(["status"=>1,"msg"=>"分类添加成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"分类添加失败！"]);
            }
        }
    }
    // 删除分类操作
    public function do_del(){
        if(Request::instance()->isPost()){
            $cid = input('cid');
            $sonCategory = Db::name("category")->where("pid = $cid")->find();
            if($sonCategory){
                return json(["status"=>0,"msg"=>"删除失败,必须先删除该分类下的所有子分类！"]);
            }
            $re = Db::name('category')->delete($cid);
            if($re){
                return json(["status"=>1,"msg"=>"分类删除成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"分类删除失败！"]);
            }
        }
    }
    // 修改分类操作
    public function do_edit(){
        if(Request::instance()->isPost()){
            $data = input('post.');
            $cid = input('get.cid');
            $map['cname'] = $data['cname'];
            $old_cate = Db::name('category')->where("cid = $cid")->find();
            $is_cate =  Db::name('category')->where($map)->find();
            if($is_cate && $old_cate['cname'] != $data['cname']){
                return json(["status"=>0,"msg"=>"修改失败，分类名已存在！"]);
            }
            //调用验证器
            $validate = new \app\admin\validate\Category;
            $validateData = ['cname' => $data['cname'], 'csort' => $data['csort']];
            //验证是否符合验证器里定义(验证码)的规范,不符合返回错误信息
            if (!$validate->check($validateData)) {
                return json(["status"=>0,"msg"=>$validate->getError()]);
            }
            $re =  Db::name('category')->where('cid',$cid)->update($data);
            if($re){
                return json(["status"=>1,"msg"=>"分类修改成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"分类修改失败！"]);
            }
        }
    }
}
