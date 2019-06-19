<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"D:\wamp64\www\zqcms\public/../application/admin\view\login\index.html";i:1559544173;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\header.html";i:1559544173;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\script.html";i:1559544173;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui后台管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/admin/style/admin.css" media="all">
    <script src="/static/admin/layui/layui.js"></script>
</head>
<link rel="stylesheet" href="/static/admin/style/login.css" media="all">

<body>
<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">
    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>layuiAdmin</h2>
            <p>layui 官方出品的单页面后台管理模板系统</p>
        </div>
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username"
                       for="LAY-user-login-username"></label>
                <input type="text" name="username" id="LAY-user-login-username" lay-verify="required" placeholder="用户名"
                       class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password"
                       for="LAY-user-login-password"></label>
                <input type="password" name="password" id="LAY-user-login-password" lay-verify="required"
                       placeholder="密码" class="layui-input">
            </div>
            <!--<div class="layui-form-item">-->
                <!--<div class="layui-row">-->
                    <!--<div class="layui-col-xs7">-->
                        <!--<label class="layadmin-user-login-icon layui-icon layui-icon-vercode"-->
                               <!--for="LAY-user-login-vercode"></label>-->
                        <!--<input type="text" name="vercode" id="LAY-user-login-vercode" lay-verify="required"-->
                               <!--placeholder="图形验证码" class="layui-input">-->
                    <!--</div>-->
                    <!--<div class="layui-col-xs5">-->
                        <!--<div style="margin-left: 10px;">-->
                            <!--<img src="https://www.oschina.net/action/user/captcha" class="layadmin-user-login-codeimg"-->
                                 <!--id="LAY-user-get-vercode">-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
            <!--<div class="layui-form-item" style="margin-bottom: 20px;">-->
                <!--<input type="checkbox" name="remember" lay-skin="primary" title="记住密码">-->
                <!--<a href="forget.html" class="layadmin-user-jump-change layadmin-link" style="margin-top: 7px;">忘记密码？</a>-->
            <!--</div>-->
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-login-submit" id="LAY-user-login-submit">登 入</button>
            </div>
            <!--<div class="layui-trans layui-form-item layadmin-user-login-other">-->
                <!--<label>社交账号登入</label>-->
                <!--<a href="javascript:;"><i class="layui-icon layui-icon-login-qq"></i></a>-->
                <!--<a href="javascript:;"><i class="layui-icon layui-icon-login-wechat"></i></a>-->
                <!--<a href="javascript:;"><i class="layui-icon layui-icon-login-weibo"></i></a>-->

                <!--<a href="reg.html" class="layadmin-user-jump-change layadmin-link">注册帐号</a>-->
            <!--</div>-->
        </div>
    </div>

    <div class="layui-trans layadmin-user-login-footer">

        <p>© 2018 <a href="http://www.layui.com/" target="_blank">layui.com</a></p>
        <p>
            <span><a href="http://www.layui.com/admin/#get" target="_blank">获取授权</a></span>
            <span><a href="http://www.layui.com/admin/pro/" target="_blank">在线演示</a></span>
            <span><a href="http://www.layui.com/admin/" target="_blank">前往官网</a></span>
        </p>
    </div>
</div>

<script src="/static/admin/layui/layui.js"></script>

<script>
    if (self.location !== top.location) {
        top.location = self.location;
    }
    layui.config({
        base: '/static/admin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'user'], function () {
        var $ = layui.$
            , form = layui.form;
        //回车提交
        $(document).keydown(function (e) {
            if (e.keyCode === 13) {
                $("#LAY-user-login-submit").trigger("click");
            }
        });
        //提交
        form.on('submit(LAY-user-login-submit)', function (obj) {
            //请求登入接口
            var loginInfo = obj.field;
            $.ajax({
                url:'<?php echo url("Admin/Login/login"); ?>',
                data:{'username':loginInfo.username,'password':loginInfo.password},
                type: "post",
                dataType:'json',
                success:function(re){
                    if(re.status){
                        layer.msg(re.msg,{icon:1,time:1000},function(){
                            location.href="<?php echo url('Admin/index/index'); ?>";
                        })
                    }else{
                        layer.msg(re.msg,{icon:5,time:2000});
                    }
                }
            });
        });
    });

</script>
</body>
</html>