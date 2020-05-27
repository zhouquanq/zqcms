<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"D:\wamp64\www\zqcms\public/../application/admin\view\flink\index.html";i:1590488640;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\header.html";i:1590488640;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\script.html";i:1590488640;}*/ ?>
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
<div class="layui-fluid">
    <div class="layui-card">
<!--        <div class="layui-form layui-card-header layuiadmin-card-header-auto">-->
<!--            <div class="layui-form-item">-->
<!--                <div class="layui-inline">-->
<!--                    <label class="layui-form-label">新标签名</label>-->
<!--                    <div class="layui-input-inline">-->
<!--                        <input type="text" name="tagname" placeholder="请输入新标签名" autocomplete="off" class="layui-input">-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="layui-inline">-->
<!--                    <button class="layui-btn layuiadmin-btn-admin" lay-submit lay-filter="article-search">-->
<!--                        <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>-->
<!--                    </button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
                <button class="layui-btn layuiadmin-btn-flink" data-type="batchdel">删除</button>
                <button class="layui-btn layuiadmin-btn-flink" data-type="add">添加</button>
            </div>
            <table id="flinks" lay-filter="flinks"></table>
            <script type="text/html" id="flink_status">
                {{#  if(d.is_show == '显示'){ }}
                <button class="layui-btn layui-btn-xs layui-btn-radius">显示</button>
                {{#  } else { }}
                <button class="layui-btn layui-btn-warm layui-btn-xs layui-btn-radius">隐藏</button>
                {{#  } }}
            </script>
            <script type="text/html" id="flink_bar">
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i
                        class="layui-icon layui-icon-edit"></i>编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i
                        class="layui-icon layui-icon-delete"></i>删除</a>
            </script>
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
    }).use(['index', 'contlist', 'table'], function () {
        var $ = layui.$
            , form = layui.form
            , table = layui.table;

        //加载表格
        table.render({
            elem: '#flinks'
            ,url:"<?php echo url('Admin/Flink/getflinks'); ?>"
            ,align:'center'
            ,page:1
            ,cols: [[
                {type:'checkbox'}
                ,{field:'fid', title: 'ID', sort: true, align: 'center', width: 60}
                ,{field:'fname',  title: '友链名'}
                ,{field:'msg',  title: '友链信息'}
                ,{field:'addtime',  title: '添加时间', width: 160, templet: "<div>{{layui.util.toDateString(d.addtime*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>", unresize: true, align: 'center'}
                ,{field:'sort',  title: '排序', width: 80, align: 'center', width: 60}
                ,{field:'logo',  title: '图片'}
                ,{field:'url',  title: '地址'}
                ,{field:'is_show',width:80,title:'状态',templet: '#flink_status', sort: true, unresize: true, align: 'center'}
                ,{field:'operate',width:150,title:'操作', toolbar: '#flink_bar', unresize: true, align: 'center'}
            ]]
        });
        
        //监听搜索
        form.on('submit(add-tag)', function (data) {

        });

        //点击事件
        var flink = {
            batchdel: function () {
                var checkStatus = table.checkStatus('flinks')
                    , checkData = checkStatus.data; //得到选中的数据

                if (checkData.length === 0) {
                    return layer.msg('请选择数据');
                }
                var fids = "";
                for (i in checkData){
                    fids += checkData[i]['fid'] + ",";
                }
                layer.confirm('确定删除吗？', function (index) {
                    $.ajax({
                        url:'<?php echo url("admin/flink/do_delAll"); ?>',
                        data:{'fids':fids},
                        type: "post" ,
                        dataType:'json',
                        success:function(re){
                            if(re.status){
                                table.reload('flinks');
                                layer.msg(re.msg,{icon:1,time:2000});
                            }else{
                                layer.msg(re.msg,{icon:5,time:2000});
                            }
                        }
                    });
                });
            },
            add: function(){
                layer.open({
                    type: 2
                    , title: '添加友链'
                    , content: "<?php echo url('admin/flink/add'); ?>"
                    , area: ['580px', '540px']
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var othis = layero.find('iframe').contents().find("#layuiadmin-app-form-flink")
                            , fname = othis.find('input[name="fname"]').val()
                            , msg = othis.find('input[name="msg"]').val()
                            , sort = othis.find('input[name="sort"]').val()
                            , logo = othis.find('input[name="logo"]').val()
                            , url = othis.find('input[name="url"]').val()
                            , status = othis.find('input[name="is_show"]:checked').val();

                        var is_show;
                        status == "on" ? is_show = "显示" : is_show = "隐藏";

                        $.ajax({
                            url:'<?php echo url("admin/flink/do_add"); ?>',
                            data:{
                                'fname':fname
                                ,'msg':msg
                                ,'sort':sort
                                ,'logo':logo
                                ,'url':url
                                ,'is_show':is_show
                            },
                            type: "post" ,
                            dataType:'json',
                            success:function(re){
                                if(re.status){
                                    layer.msg(re.msg,{icon:1,time:2000});
                                    table.reload('flinks');
                                    layer.close(index); //关闭弹层
                                }else{
                                    layer.msg(re.msg,{icon:5,time:2000});
                                }
                            }
                        });
                    }
                });
            }

        };

        //工具栏监听事件
        table.on('tool(flinks)', function(obj){
            var fid = obj.data.fid;
            //删除
            if(obj.event === 'del'){
                layer.confirm('确定删除友链么？', function(index){
                    $.ajax({
                        url:'<?php echo url("admin/flink/do_del"); ?>',
                        data:{'fid':fid},
                        type: "post",
                        dataType:'json',
                        success:function(re){
                            if(re.status){
                                table.reload('flinks');
                                layer.msg(re.msg,{icon:1,time:2000});
                            }else{
                                layer.msg(re.msg,{icon:5,time:2000});
                            }
                        }
                    });
                });
            }//修改fid
            else if(obj.event === 'edit'){
                layer.open({
                    type: 2
                    ,title: '修改友链信息'
                    ,content: '<?php echo url("admin/flink/edit"); ?>?fid=' + fid
                    ,area: ['580px', '540px']
                    ,btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var othis = layero.find('iframe').contents().find("#layuiadmin-app-form-flink")
                            , fname = othis.find('input[name="fname"]').val()
                            , msg = othis.find('input[name="msg"]').val()
                            , sort = othis.find('input[name="sort"]').val()
                            , logo = othis.find('input[name="logo"]').val()
                            , url = othis.find('input[name="url"]').val()
                            , status = othis.find('input[name="is_show"]:checked').val();
                        var is_show;
                        status == "on" ? is_show = "显示" : is_show = "隐藏";
                        $.ajax({
                            url:'<?php echo url("admin/flink/do_edit"); ?>?fid=' + fid,
                            data:{
                                'fname':fname
                                ,'msg':msg
                                ,'sort':sort
                                ,'logo':logo
                                ,'url':url
                                ,'is_show':is_show
                            },
                            type: "post" ,
                            dataType:'json',
                            success:function(re){
                                if(re.status){
                                    layer.msg(re.msg,{icon:1,time:2000});
                                    table.reload('flinks');
                                    layer.close(index); //关闭弹层
                                }else{
                                    layer.msg(re.msg,{icon:5,time:2000});
                                }
                            }
                        });
                    }
                });
            }
        });

        $('.layui-btn.layuiadmin-btn-flink').on('click', function () {
            var type = $(this).data('type');
            flink[type] ? flink[type].call(this) : '';
        });
    });
</script>
</body>
</html>

