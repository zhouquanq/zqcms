<?php
namespace app\admin\controller;
use \think\Db;
use \think\Request;

class Article extends Auth{
    public function index(){
        $tag_list = Db::name("tag")->select();
        $this->assign('tagCount',count($tag_list));
        return $this->fetch();
    }

    public function add(){
        $category_list = Db::name("category")->select();
        $tag_list = Db::name("tag")->select();
        $cateTree = unlimitedForLevel($category_list);
        $this->assign('cateTree',$cateTree);
        $this->assign('tag_list',$tag_list);
        return $this->fetch();
    }

    public function edit(){
        $map['aid'] = input("get.aid");
        $oldArticle = Db::name("article")->alias('a')->Join('article_data ad','a.aid = ad.article_aid')->where($map)->find();

        $tagMap['article_aid'] = input("get.aid");
        $articleTag = Db::name("article_tag")->field("tag_tid")->where($tagMap)->select();
        foreach ($articleTag as $k => $v) {
            $tags[] = $v['tag_tid'];
        }
        $articleTag = implode(",",$tags);

        $articleAttr = array("推荐","热门","置顶","图文");

        $category_list = Db::name("category")->select();
        $tag_list = Db::name("tag")->select();
        $cateTree = unlimitedForLevel($category_list);
        $this->assign('cateTree',$cateTree);
        $this->assign('tag_list',$tag_list);
        $this->assign('oldArticle',$oldArticle);
        $this->assign('articleTag',$articleTag);
        $this->assign('articleAttr',$articleAttr);
        return $this->fetch();
    }

    public function getArticle($map=''){
        if(Request::instance()->isGet()){
            //获取分页page和limit参数
            $page = input("get.page") ? input("get.page") : 1;
            $page = intval($page);
            $limit = input("get.limit") ? input("get.limit") : 1;
            $limit = intval($limit);
            $start = $limit*($page-1);

            //分页查询
            $count = Db::name("article")->where($map)->count();
            $article_list = Db::name("article")->alias('a')->Join('article_data ad','a.aid = ad.article_aid')->order("aid asc")->limit($start,$limit)->select();
            $list["msg"] = "";
            $list["code"] = 0;
            $list["count"] = $count;
            $list["data"] = $article_list;
            if(empty($article_list)){
                $list["msg"]="暂无数据";
            }
            return json($list);
        }
    }

    public function do_add(){
        if(Request::instance()->isPost()){
            $data = input('post.');
//            return $data;
            //调用验证器自动验证
            $validate = new \app\admin\validate\Article();
            $validateData = ['title' => $data['title'], 'digest' => $data['digest'], 'category' => $data['category'], 'content' => $data['content']];
            if (!$validate->check($validateData)) {
                return json(["status"=>0,"msg"=>$validate->getError()]);
            }

            $article = array(
                'title'             => $data['title'],
                'sendtime'          => time(),
                'thumb'             => $data['thumb'],
                'digest'            => $data['digest'],
                'status'            => $data['status'],
                'attr'              => $data['attr'],
                'author'            => session('admin_name'),
                'category_cid'      => $data['category'],
                'user_uid'          => session('admin_id'),
            );

            $re1 =  Db::name('article')->insert($article);
            $articleID = Db::name('article')->getLastInsID();

            if($re1){
                $article_data = array(
                    'keywords'      => '',
                    'description'   => $data['digest'],
                    'content'       => $data['content'],
                    'article_aid'   => $articleID,
                );
                $re2 =  Db::name('article_data')->insert($article_data);

                $tags = explode(",",$data['tag']);
                foreach ($tags as $k => $v) {
                    $article_tag = array(
                        'article_aid'   => $articleID,
                        'tag_tid'       => $v,
                        'category_cid'  => $data['category'],
                    );
                    Db::name('article_tag')->insert($article_tag);
                }
            }
            if($re1 && $re2){
                return json(["status"=>1,"msg"=>"文章添加成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"文章添加失败！"]);
            }
        }
    }

    public function do_edit(){
        if(Request::instance()->isPost()){
            $data = input('post.');
            $aid = input('get.aid');
//            return $data;
            //调用验证器自动验证
            $validate = new \app\admin\validate\Article();
            $validateData = ['title' => $data['title'], 'digest' => $data['digest'], 'category' => $data['category'], 'content' => $data['content']];
            if (!$validate->check($validateData)) {
                return json(["status"=>0,"msg"=>$validate->getError()]);
            }

            $article = array(
                'title'             => $data['title'],
                'thumb'             => $data['thumb'],
                'digest'            => $data['digest'],
                'status'            => $data['status'],
                'attr'              => $data['attr'],
                'category_cid'      => $data['category'],
            );

            $re1 =  Db::name('article')->where('aid',$aid)->update($article);

            if($re1){
                $article_data = array(
                    'keywords'      => '',
                    'description'   => $data['digest'],
                    'content'       => $data['content'],
                    'article_aid'   => $aid,
                );
                $re2 =  Db::name('article_data')->where('article_aid',$aid)->update($article_data);
//
//                $tags = explode(",",$data['tag']);
//                foreach ($tags as $k => $v) {
//                    $article_tag = array(
//                        'article_aid'   => $aid,
//                        'tag_tid'       => $v,
//                        'category_cid'  => $data['category'],
//                    );
//                    Db::name('article_tag')->insert($article_tag);
//                }
            }
            if($re1 && $re2){
                return json(["status"=>1,"msg"=>"文章修改成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"文章修改失败！"]);
            }
        }
    }

    public function do_del(){
        if(Request::instance()->isPost()){
            $aid = input('aid');
            $re = Db::name('article')->delete($aid);
            if($re){
                $map['article_aid'] = array('eq',$aid);
                Db::name('article_data')->where($map)->delete();
                Db::name('article_tag')->where($map)->delete();
                return json(["status"=>1,"msg"=>"删除成功！"]);
            }else{
                return json(["status"=>0,"msg"=>"删除失败！"]);
            }
        }
    }

    public function do_delAll(){
        if(Request::instance()->isPost()){
            $aids = input('aids');
            $aid = explode(',',trim($aids,','));
            foreach ($aid as $v){
                $re = Db::name('article')->delete($v);
                if($re){
                    $map['article_aid'] = array('eq',$v);
                    Db::name('article_data')->where($map)->delete();
                    Db::name('article_tag')->where($map)->delete();
                }
            }
            return json(["status"=>1,"msg"=>"删除成功！"]);
        }
    }


    public function upload(){
        $file = request()->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
        if($info){
            return json(["status"=>1,"msg"=>"图片上传成功！","saveName"=>"/upload/".$info->getSaveName()]);
        }else{
            // 上传失败获取错误信息
            return json(["status"=>0,"msg"=>$file->getError()]);
        }
    }


}
