<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"D:\wamp64\www\zqcms\public/../application/index\view\index\index.html";i:1560329266;s:61:"D:\wamp64\www\zqcms\application\index\view\common\header.html";i:1560325159;s:58:"D:\wamp64\www\zqcms\application\index\view\common\top.html";i:1560326306;s:61:"D:\wamp64\www\zqcms\application\index\view\common\footer.html";i:1560325491;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/static/index/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/static/index/css/main.css">
    <!--加载meta IE兼容文件-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<style type="text/css">
    .pagination { display: inline-block; padding-left: 0; margin: 20px 0; border-radius: 4px; }
    .pagination li { display: inline; }
    .pagination li a,.pagination li span { position: relative; float: left; padding: 6px 12px; margin-left: -1px; line-height: 1.428571429; text-decoration: none; background-color: #fff; border: 1px solid #ddd; }
    .pagination li:first-child a { margin-left: 0; border-bottom-left-radius: 4px; border-top-left-radius: 4px; }
    .pagination li:last-child a { border-top-right-radius: 4px; border-bottom-right-radius: 4px; }
    .pagination li a:hover, .pagination li a:focus { background-color: #eee; }
    .pagination .active span, .pagination .active span:hover, .pagination .active span:focus { z-index: 2; color: #fff; cursor: default; background-color: #428bca; border-color: #428bca; }
    .pagination .disabled span, .pagination .disabled span:hover, .pagination .disabled span:focus { color: #999; cursor: not-allowed; background-color: #fff; border-color: #ddd; }
    .pagination-lg li a { padding: 10px 16px; font-size: 18px; }
    .pagination-sm li a, .pagination-sm li span { padding: 5px 10px; font-size: 12px; }
</style>
<body>
<div class="header">
    <div class="menu-btn">
        <div class="menu"></div>
    </div>
    <h1 class="logo">
        <a href="index.html">
            <span>MYBLOG</span>
            <img src="/static/index/img/logo.png">
        </a>
    </h1>
    <div class="nav">
        <a href="index.html" class="active">文章</a>
        <a href="whisper.html">微语</a>
        <a href="leacots.html">留言</a>
        <a href="album.html">相册</a>
        <a href="about.html">关于</a>
    </div>
    <ul class="layui-nav header-down-nav">
        <li class="layui-nav-item"><a href="index.html" class="active">文章</a></li>
        <li class="layui-nav-item"><a href="whisper.html">微语</a></li>
        <li class="layui-nav-item"><a href="leacots.html">留言</a></li>
        <li class="layui-nav-item"><a href="album.html">相册</a></li>
        <li class="layui-nav-item"><a href="about.html">关于</a></li>
    </ul>
    <p class="welcome-text">
        欢迎来到<span class="name">我</span>的博客~
    </p>
</div>
<div class="banner">
    <div class="cont w1000">
        <div class="title">
            <h3>MY<br/>BLOG</h3>
            <h4>well-balanced heart</h4>
        </div>
        <div class="amount">
            <p><span class="text">访问量</span><span class="access">99</span></p>
            <p><span class="text">日志</span><span class="daily-record">99</span></p>
        </div>
    </div>
</div>

<div class="content">
    <div class="cont w1000">
        <div class="title">
        <span class="layui-breadcrumb" lay-separator="|">
          <a href="javascript:;" class="active">设计文章</a>
          <a href="javascript:;">前端文章</a>
          <a href="javascript:;">旅游杂记</a>
        </span>
        </div>
        <div class="list-item">
            <?php if(is_array($article_list) || $article_list instanceof \think\Collection || $article_list instanceof \think\Paginator): $k = 0; $__LIST__ = $article_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?>
            <div class="item">
                <div class="layui-fluid">
                    <div class="layui-row">
                        <div class="layui-col-xs12 layui-col-sm4 layui-col-md5">
                            <?php if($vo['thumb'] == ''): ?>
                            <div class="img"><img src="/static/index/img/sy_img<?php echo(rand(1,5)); ?>.jpg" alt=""></div>
                            <?php else: ?>
                            <div class="img"><img src="{vo.thumb}" alt=""></div>
                            <?php endif; ?>
                        </div>
                        <div class="layui-col-xs12 layui-col-sm8 layui-col-md7">
                            <div class="item-cont">
                                <h3><?php echo $vo['title']; ?>
                                    <button class="layui-btn layui-btn-danger new-icon">new</button>
                                </h3>
                                <h5><?php echo $vo['cname']; ?></h5>
                                <p>
                                    <?php echo $vo['digest']; ?></p>
                                <a href="details.html" class="go-icon"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="layui-box layui-laypage layui-laypage-center" style="text-align: center;"><?php echo $article_list->render(); ?></div>
    </div>
</div>
<div class="footer-wrap">
    <div class="footer w1000">
        <div class="qrcode">
            <img src="/static/index/img/erweima.jpg">
        </div>
        <div class="practice-mode">
            <img src="/static/index/img/down_img.jpg">
            <div class="text">
                <h4 class="title">我的联系方式</h4>
                <p>微信<span class="WeChat">15012345678</span></p>
                <p>手机<span class="iphone">15012345678</span></p>
                <p>邮箱<span class="email">15012345678@qq.com</span></p>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="/static/index/layui/layui.js"></script>
<script type="text/javascript">
    layui.config({
        base: '/static/index/js/util/'
    }).use(['element', 'laypage', 'jquery', 'menu'], function () {
        element = layui.element, laypage = layui.laypage, $ = layui.$, menu = layui.menu;
        laypage.render({
            elem: 'demo'
            , count: 70 //数据总数，从服务端得到
        });
        menu.init();
    })
</script>
</body>
</html>