<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:69:"D:\wamp64\www\zqcms\public/../application/admin\view\index\index.html";i:1590488640;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\header.html";i:1590488640;s:58:"D:\wamp64\www\zqcms\application\admin\view\common\top.html";i:1590488640;s:58:"D:\wamp64\www\zqcms\application\admin\view\common\nav.html";i:1590488640;s:60:"D:\wamp64\www\zqcms\application\admin\view\common\label.html";i:1590488640;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\script.html";i:1590488640;}*/ ?>
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

<body class="layui-layout-body">
<div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
        <!--顶部区域-->
        <div class="layui-header">
    <!-- 头部区域 -->
    <ul class="layui-nav layui-layout-left">
        <li class="layui-nav-item layadmin-flexible" lay-unselect>
            <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
                <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
            </a>
        </li>
        <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="http://cms.test/" target="_blank" title="前台">
                <i class="layui-icon layui-icon-website"></i>
            </a>
        </li>
        <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;" layadmin-event="refresh" title="刷新">
                <i class="layui-icon layui-icon-refresh-3"></i>
            </a>
        </li>
    </ul>
    <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">

        <li class="layui-nav-item" lay-unselect>
            <a lay-href="app/message/index.html" layadmin-event="message" lay-text="消息中心">
                <i class="layui-icon layui-icon-notice"></i>

                <!-- 如果有新消息，则显示小圆点 -->
                <span class="layui-badge-dot"></span>
            </a>
        </li>
        <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="theme">
                <i class="layui-icon layui-icon-theme"></i>
            </a>
        </li>
        <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="note">
                <i class="layui-icon layui-icon-note"></i>
            </a>
        </li>
        <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="fullscreen">
                <i class="layui-icon layui-icon-screen-full"></i>
            </a>
        </li>
        <li class="layui-nav-item" lay-unselect>
            <a href="javascript:;">
                <cite>贤心</cite>
            </a>
            <dl class="layui-nav-child">
                <dd><a lay-href="set/user/info.html">基本资料</a></dd>
                <dd><a lay-href="set/user/password.html">修改密码</a></dd>
                <hr>
                <dd style="text-align: center;"><a lay-href="<?php echo url('Admin/Login/loginOut'); ?>">退出</a></dd>
            </dl>
        </li>

        <li class="layui-nav-item layui-hide-xs" lay-unselect>
            <a href="javascript:;" layadmin-event="about"><i
                    class="layui-icon layui-icon-more-vertical"></i></a>
        </li>
        <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-unselect>
            <a href="javascript:;" layadmin-event="more"><i class="layui-icon layui-icon-more-vertical"></i></a>
        </li>
    </ul>
</div>
        <!--左侧导航-->
        <!-- 侧边菜单 -->
<div class="layui-side layui-side-menu">
    <div class="layui-side-scroll">
        <div class="layui-logo" lay-href="<?php echo url('Admin/index/console'); ?>">
            <span>Admin</span>
        </div>

        <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu"
            lay-filter="layadmin-system-side-menu">
            <li data-name="home" class="layui-nav-item layui-nav-itemed">
                <a href="javascript:;" lay-tips="主页" lay-direction="2">
                    <i class="layui-icon layui-icon-home"></i>
                    <cite>主页</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="console" class="layui-this">
                        <a lay-href="<?php echo url('Admin/index/console'); ?>">控制台</a>
                    </dd>
                </dl>
            </li>
            <li data-name="user" class="layui-nav-item">
                <a href="javascript:;" lay-tips="用户" lay-direction="2">
                    <i class="layui-icon layui-icon-user"></i>
                    <cite>用户</cite>
                </a>
                <dl class="layui-nav-child">
                    <!--<dd>-->
                    <!--<a lay-href="user/user/list.html">网站用户</a>-->
                    <!--</dd>-->
                    <dd>
                        <a lay-href="<?php echo url('Admin/User/index'); ?>">用户管理</a>
                    </dd>
                </dl>
            </li>
            <li data-name="app" class="layui-nav-item">
                <a href="javascript:;" lay-tips="分类" lay-direction="2">
                    <i class="layui-icon layui-icon-app"></i>
                    <cite>分类</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="content">
                        <a lay-href="<?php echo url('Admin/Category/index'); ?>">分类管理</a>
                    </dd>
                </dl>
            </li>
            <li data-name="app" class="layui-nav-item">
                <a href="javascript:;" lay-tips="标签" lay-direction="2">
                    <i class="layui-icon layui-icon-app"></i>
                    <cite>标签</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="content">
                        <a lay-href="<?php echo url('Admin/Tag/index'); ?>">标签管理</a>
                    </dd>
                </dl>
            </li>
            <li data-name="app" class="layui-nav-item">
                <a href="javascript:;" lay-tips="文章" lay-direction="2">
                    <i class="layui-icon layui-icon-app"></i>
                    <cite>文章</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="content">
                        <a lay-href="<?php echo url('Admin/Article/index'); ?>">文章管理</a>
                    </dd>
                </dl>
            </li>
            <li data-name="app" class="layui-nav-item">
                <a href="javascript:;" lay-tips="友链" lay-direction="2">
                    <i class="layui-icon layui-icon-app"></i>
                    <cite>友链</cite>
                </a>
                <dl class="layui-nav-child">
                    <dd data-name="content">
                        <a lay-href="<?php echo url('Admin/Flink/index'); ?>">友情链接</a>
                    </dd>
                </dl>
            </li>
        </ul>
    </div>
</div>
        <!--标签管理-->
        <!-- 页面标签 -->
<div class="layadmin-pagetabs" id="LAY_app_tabs">
    <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
    <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
    <div class="layui-icon layadmin-tabs-control layui-icon-down">
        <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
            <li class="layui-nav-item" lay-unselect>
                <a href="javascript:;"></a>
                <dl class="layui-nav-child layui-anim-fadein">
                    <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                    <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                    <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
                </dl>
            </li>
        </ul>
    </div>
    <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
        <ul class="layui-tab-title" id="LAY_app_tabsheader">
            <li lay-id="home/console.html" lay-attr="home/console.html" class="layui-this"><i
                    class="layui-icon layui-icon-home"></i></li>
        </ul>
    </div>
</div>

        <!-- 主体内容 -->
        <div class="layui-body" id="LAY_app_body">
            <td><input type="checkbox" name="" lay-skin="primary"></td>
            <div class="layadmin-tabsbody-item layui-show">
                <iframe src="<?php echo url('Admin/index/console'); ?>" frameborder="0" class="layadmin-iframe"></iframe>
            </div>
        </div>

        <!-- 辅助元素，一般用于移动设备下遮罩 -->
        <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
</div>

<!--基础script区域-->
<script src="/static/admin/layui/layui.js"></script>


<script>
    layui.config({
        base: '/static/admin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index']);
</script>

</body>
</html>


