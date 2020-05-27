<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"D:\wamp64\www\zqcms\public/../application/admin\view\flink\edit.html";i:1590488640;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\header.html";i:1590488640;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\script.html";i:1590488640;}*/ ?>
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

<div class="layui-form" lay-filter="layuiadmin-form-tags" id="layuiadmin-app-form-flink"
     style="padding-top: 30px;">
    <div class="layui-form-item">
        <label class="layui-form-label">友链名</label>
        <div class="layui-input-inline">
            <input type="text" name="fname" lay-verify="required" value="<?php echo $oldflink['fname']; ?>" placeholder="请输入标签名" autocomplete="off"
                   class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">友链信息</label>
        <div class="layui-input-inline">
            <input type="text" name="msg" lay-verify="required" value="<?php echo $oldflink['msg']; ?>" placeholder="请输入标签名" autocomplete="off"
                   class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">友链排序</label>
        <div class="layui-input-inline">
            <input type="text" name="sort" lay-verify="required" value="<?php echo $oldflink['sort']; ?>" placeholder="请输入标签名" autocomplete="off"
                   class="layui-input">
            <div class="layui-form-mid layui-word-aux">排序值必须是数字且是1 ~ 100</div>
        </div>

    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">友链地址</label>
        <div class="layui-input-inline">
            <input type="test" name="url" lay-verify="required|url" value="<?php echo $oldflink['url']; ?>" placeholder="https://www.baidu.com" autocomplete="off"
                   class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">友链图片</label>
        <div class="layui-input-inline">
            <input name="logo" id="flink_img" placeholder="图片地址" value="<?php echo $oldflink['logo']; ?>"
                   disabled class="layui-input">
        </div>
        <div class="layui-input-inline layui-btn-container layui-upload" style="width: auto;">
            <button type="button" class="layui-btn layui-btn-primary" id="LAY_ArticleUpload">
                <i class="layui-icon">&#xe67c;</i>上传图片
            </button>
            <button class="layui-btn layui-btn-primary" layadmin-event="avartatPreview">查看图片
            </button>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">友链状态</label>
        <div class="layui-input-inline">
            <input type="checkbox" lay-filter="switch" name="is_show" lay-skin="switch" <?php if($oldflink['is_show'] == "显示"): ?>checked<?php endif; ?> lay-text="显示|隐藏">
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
    }).use(['index', 'form', 'upload'], function () {
        var $ = layui.$
            , form = layui.form
            ,upload = layui.upload;

        //执行实例
        upload.render({
            elem: '#LAY_ArticleUpload' //绑定元素
            ,url: "<?php echo url('Admin/Article/upload'); ?>" //上传接口
            ,done: function(res){
                //预读本地文件示例，不支持ie8
                if(res.status = 1){
                    //上传成功
                    $('#flink_img').val(res.saveName);
                    return layer.msg(res.msg);
                }else{
                    return layer.msg(res.msg);
                }
            }
            ,error: function(res){
                //如果上传失败
                return layer.msg('上传失败');
            }
        });


    })
</script>
</body>
</html>