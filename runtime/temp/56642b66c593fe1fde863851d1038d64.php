<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"D:\wamp64\www\zqcms\public/../application/admin\view\tag\index.html";i:1590488640;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\header.html";i:1590488640;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\script.html";i:1590488640;}*/ ?>
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
        <div class="layui-form layui-card-header layuiadmin-card-header-auto">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">新标签名</label>
                    <div class="layui-input-inline">
                        <input type="text" name="tagname" placeholder="请输入新标签名" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <button class="layui-btn layuiadmin-btn-comm" data-type="reload" lay-submit
                            lay-filter="add-tag">
                        <!--<i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>-->
                        <i class="layui-icon layui-icon-add-1 layuiadmin-button-btn" style="position: relative;top: -2px;"></i>添加标签
                    </button>
                </div>
            </div>
        </div>
        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
                <button class="layui-btn layuiadmin-btn-comm" data-type="batchdel">删除</button>
            </div>
            <table id="tags" lay-filter="tags"></table>
            <script type="text/html" id="action_bar">
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
            elem: '#tags'
            ,url:"<?php echo url('Admin/Tag/getTags'); ?>"
            ,align:'center'
            ,page:1
            ,cols: [[
                {type:'checkbox'}
                ,{field:'tid', title: 'ID', sort: true, align: 'center', width: 80}
                ,{field:'tagname',  title: '标签名'}
                ,{field:'operate',width:150,title:'操作', align: 'center', toolbar: '#action_bar'}
            ]]
        });

        //监听搜索
        form.on('submit(add-tag)', function (data) {
            var tagname = data.field.tagname;
            //监听提交
            $.ajax({
                url:'<?php echo url("Admin/tag/do_add"); ?>',
                data:{'tagname':tagname},
                type: "post" ,
                dataType:'json',
                success:function(re){
                    if(re.status){
                        layer.msg(re.msg,{icon:1,time:2000});
                        table.reload('tags');
                        layer.close(index); //关闭弹层
                    }else{
                        layer.msg(re.msg,{icon:5,time:2000});
                    }
                }
            });
            //执行重载
            // table.reload('LAY-app-content-comm', {
            //     where: field
            // });
        });

        //点击事件
        var active = {
            batchdel: function () {
                var checkStatus = table.checkStatus('tags')
                    , checkData = checkStatus.data; //得到选中的数据

                if (checkData.length === 0) {
                    return layer.msg('请选择数据');
                }
                var tids = "";
                for (i in checkData){
                    tids += checkData[i]['tid'] + ",";
                }
                layer.confirm('确定删除吗？', function (index) {
                    $.ajax({
                        url:'<?php echo url("Admin/Tag/do_delAll"); ?>',
                        data:{'tids':tids},
                        type: "post" ,
                        dataType:'json',
                        success:function(re){
                            if(re.status){
                                table.reload('tags');
                                layer.msg(re.msg,{icon:1,time:2000});
                            }else{
                                layer.msg(re.msg,{icon:5,time:2000});
                            }
                        }
                    });
                });
            }
        };

        //工具栏监听事件
        table.on('tool(tags)', function(obj){
            var tid = obj.data.tid;
            //删除
            if(obj.event === 'del'){
                layer.confirm('确定删除标签么？', function(index){
                    $.ajax({
                        url:'<?php echo url("Admin/Tag/do_del"); ?>',
                        data:{'tid':tid},
                        type: "post",
                        dataType:'json',
                        success:function(re){
                            if(re.status){
                                table.reload('tags');
                                layer.msg(re.msg,{icon:1,time:2000});
                            }else{
                                layer.msg(re.msg,{icon:5,time:2000});
                            }
                        }
                    });
                });
            }//修改
            else if(obj.event === 'edit'){
                layer.open({
                    type: 2
                    ,title: '修改标签信息'
                    ,content: '<?php echo url("Admin/Tag/edit"); ?>?tid=' + tid
                    ,area: ['460px', '220px']
                    ,btn: ['确定', '取消']
                    ,yes: function(index, layero){
                        var othis = layero.find('iframe').contents().find("#layuiadmin-app-form-tags")
                            , tagname = othis.find('input[name="tagname"]').val();
                        //监听提交
                        $.ajax({
                            url:'<?php echo url("Admin/tag/do_edit"); ?>?tid=' + tid,
                            data:{'tagname':tagname},
                            type: "post" ,
                            dataType:'json',
                            success:function(re){
                                if(re.status){
                                    layer.msg(re.msg,{icon:1,time:2000});
                                    table.reload('tags');
                                    layer.close(index); //关闭弹层
                                }else{
                                    layer.msg(re.msg,{icon:5,time:2000});
                                }
                            }
                        });
                        submit.trigger('click');
                    }
                });
            }
        });

        $('.layui-btn.layuiadmin-btn-comm').on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
    });
</script>
</body>
</html>

