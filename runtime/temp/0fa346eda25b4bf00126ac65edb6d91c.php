<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"D:\wamp64\www\zqcms\public/../application/admin\view\category\edit.html";i:1590488640;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\header.html";i:1590488640;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\script.html";i:1590488640;}*/ ?>
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
<body>

<div class="layui-form" lay-filter="layuiadmin-form-tags" id="layuiadmin-app-form-cate"
     style="padding-top: 30px;">
    <div class="layui-form-item">
        <label class="layui-form-label">所属分类</label>
        <div class="layui-input-inline">
            <select name="pid" lay-verify="">
                <option value="0">顶级分类</option>
                <?php if(is_array($cateTree) || $cateTree instanceof \think\Collection || $cateTree instanceof \think\Paginator): $i = 0; $__LIST__ = $cateTree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo $vo['cid']; ?>"  <?php if($oldCate['pid'] == $vo['cid']): ?> selected <?php endif; ?> ><?php echo $vo['html']; ?>— <?php echo $vo['cname']; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                <!--<option value="021" disabled>上海（禁用效果）</option>-->
                <!--<option value="0571" selected>杭州</option>-->
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">分类名</label>
        <div class="layui-input-inline">
            <input type="text" name="cname" lay-verify="required" value="<?php echo $oldCate['cname']; ?>" placeholder="请输入分类名" autocomplete="off"
                   class="layui-input">
        </div>

    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">排序</label>
        <div class="layui-input-inline">
            <input type="text" name="csort" lay-verify="required" value="<?php echo $oldCate['csort']; ?>" placeholder="排序" autocomplete="off"
                   class="layui-input" min="0" max="100">
        </div>
    </div>
</div>

<!--基础script区域-->
<script src="/static/admin/layui/layui.js"></script>

<script>
    layui.config({
        base: '/static/admin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form'], function () {
        var $ = layui.$
            , form = layui.form;
    })
</script>
</body>
</html>