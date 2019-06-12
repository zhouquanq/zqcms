<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Index extends Controller {
    public function index($map = array()){
        $title = input("get.title") ? trim(input("get.title"),' ') : '';
        if($title) {
            $map['title'] = array('like','%'.$title.'%');
        }
        //分页查询
        $count = Db::name("article")->where($map)->count();
        $article_list = Db::name("article")->alias('a')->Join('category c','a.category_cid = c.cid')->where($map)->order("aid asc")->paginate(5);
        $this->assign('count',$count);
        $this->assign('article_list',$article_list);
        return $this->fetch();
    }
}
