<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:69:"D:\wamp64\www\zqcms\public/../application/index\view\about\index.html";i:1560739333;s:61:"D:\wamp64\www\zqcms\application\index\view\common\header.html";i:1560325159;s:58:"D:\wamp64\www\zqcms\application\index\view\common\top.html";i:1560739685;s:61:"D:\wamp64\www\zqcms\application\index\view\common\footer.html";i:1560740804;}*/ ?>
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
        <a href="<?php echo url('index/index/index'); ?>" class="active">文章</a>
        <a href="<?php echo url('index/user/index'); ?>">微语</a>
        <a href="<?php echo url('index/user/index'); ?>">留言</a>
        <a href="<?php echo url('index/user/index'); ?>">相册</a>
        <a href="<?php echo url('index/about/index'); ?>">关于</a>
    </div>
<!--    <ul class="layui-nav header-down-nav">-->
<!--        <li class="layui-nav-item"><a href="<?php echo url('index/index/index'); ?>" class="active">文章</a></li>-->
<!--        <li class="layui-nav-item"><a href="<?php echo url('index/user/index'); ?>">微语</a></li>-->
<!--        <li class="layui-nav-item"><a href="<?php echo url('index/user/index'); ?>">留言</a></li>-->
<!--        <li class="layui-nav-item"><a href="<?php echo url('index/user/index'); ?>">相册</a></li>-->
<!--        <li class="layui-nav-item"><a href="<?php echo url('index/about/index'); ?>">关于</a></li>-->
<!--    </ul>-->
    <p class="welcome-text">
        欢迎来到<span class="name">我</span>的博客~
    </p>
</div>
<div class="about-content">
    <div class="w1000">
        <div class="item info">
            <div class="title">
                <h3>我的介绍</h3>
            </div>
            <div class="cont">
                <img src="/static/index/img/xc_img1.jpg">
                <div class="per-info">
                    <p>
                        <span class="name">小明</span><br/>
                        <span class="age">24岁</span><br/>
                        <span class="Career">设计师, 前端工程师</span><br/>
                        <span class="interest">爱好旅游,打游戏</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="item tool">
            <div class="title">
                <h3>我的技能</h3>
            </div>
            <div class="layui-fluid">
                <div class="layui-row">
                    <div class="layui-col-xs6 layui-col-sm3 layui-col-md3">
                        <div class="cont-box">
                            <img src="/static/index/img/gr_img2.jpg">
                            <p>80%</p>
                        </div>
                    </div>
                    <div class="layui-col-xs6 layui-col-sm3 layui-col-md3">
                        <div class="cont-box">
                            <img src="/static/index/img/gr_img3.jpg">
                            <p>80%</p>
                        </div>
                    </div>
                    <div class="layui-col-xs6 layui-col-sm3 layui-col-md3">
                        <div class="cont-box">
                            <img src="/static/index/img/gr_img4.jpg">
                            <p>80%</p>
                        </div>
                    </div>
                    <div class="layui-col-xs6 layui-col-sm3 layui-col-md3">
                        <div class="cont-box">
                            <img src="/static/index/img/gr_img5.jpg">
                            <p>80%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item contact">
            <div class="title">
                <h3>联系方式</h3>
            </div>
            <div class="cont">
                <img src="/static/index/img/erweima.jpg">
                <div class="text">
                    <p class="WeChat">微信：<span>1234567890</span></p>
                    <p class="qq">qq：<span>123456789</span></p>
                    <p class="iphone">电话：<span>123456789</span></p>
                </div>
            </div>
        </div>
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
<script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.3.0/jquery.min.js"></script>
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
    });


    // $(".nav a").bind('click', function(){
    //     $(this).addClass('active').siblings().removeClass('active');
    // });

    $(document).ready(function(){
        $(".nav a").each(function(){
            $this = $(this);
            if($this[0].href==String(window.location)){
                $this.addClass("active").siblings().removeClass('active');
            }
        });
    });
</script>


</body>
</html>