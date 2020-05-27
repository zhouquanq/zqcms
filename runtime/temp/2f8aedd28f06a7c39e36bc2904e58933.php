<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:72:"D:\wamp64\www\zqcms\public/../application/admin\view\category\index.html";i:1590488640;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\header.html";i:1590488640;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\script.html";i:1590488640;}*/ ?>
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
        <div class="layui-card-header layuiadmin-card-header-auto">
            <button class="layui-btn layuiadmin-btn-cate" data-type="add">添加</button>
        </div>
        <div class="layui-card-body">
            <table id="category" lay-filter="category"></table>
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
        // ,treetable: 'treetable-lay/treetable'
    }).use(['index', 'table', 'treetable'], function () {
        var table = layui.table;
        var treetable = layui.treetable;
        //加载表格
        var renderTable = function(){
            treetable.render({
                treeColIndex: 1
                ,treeSpid: 0
                ,treeIdName: 'cid'
                ,treePidName: 'pid'
                ,treeDefaultClose: true
                ,treeLinkage: false
                ,elem: '#category'
                ,url:"<?php echo url('Admin/Category/getCategory'); ?>"
                ,page: false
                ,cols: [[
                    // {type: 'checkbox'}
                    {field: 'cid',  title: 'ID', width: 80, align: 'center'}
                    ,{field: 'cname',  title: '分类名'}
                    ,{field: 'csort',  align: 'center', title: '排序号'}
                    ,{field: 'is_show',  align: 'center', templet: function (d) {
                            if (d.is_show == 1) {
                                return '<button class="layui-btn layui-btn-xs layui-btn-radius">显示</button>';
                            } else {
                                return '<button class="layui-btn layui-btn-danger layui-btn-xs layui-btn-radius">隐藏</button>';
                            }
                        }, title: '显隐状态'
                    }
                    ,{templet: '#action_bar',  align: 'center', title: '操作'}
                ]]
            });
        };
        renderTable();

        var $ = layui.$, active = {
            add: function () {
                layer.open({
                    type: 2
                    , title: '添加分类'
                    , content: "<?php echo url('Admin/Category/add'); ?>"
                    , area: ['480px', '380px']
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var othis = layero.find('iframe').contents().find("#layuiadmin-app-form-cate")
                            , pid = othis.find('select[name="pid"]').val()
                            , cname = othis.find('input[name="cname"]').val()
                            , csort = othis.find('input[name="csort"]').val();
                        $.ajax({
                            url:'<?php echo url("Admin/Category/do_add"); ?>',
                            data:{
                                'pid':pid
                                ,'cname':cname
                                ,'csort':csort
                            },
                            type: "post" ,
                            dataType:'json',
                            success:function(re){
                                if(re.status){
                                    layer.msg(re.msg,{icon:1,time:2000});
                                    renderTable();
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
        table.on('tool(category)', function(obj){
            var cid = obj.data.cid;
            //删除
            if(obj.event === 'del'){
                layer.confirm('确定删除么？', function(index){
                    $.ajax({
                        url:'<?php echo url("Admin/Category/do_del"); ?>',
                        data:{'cid':cid},
                        type: "post",
                        dataType:'json',
                        success:function(re){
                            if(re.status){
                                renderTable();
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
                    ,title: '修改分类信息'
                    ,content: '<?php echo url("Admin/Category/edit"); ?>?cid=' + cid
                    ,area: ['480px', '380px']
                    ,btn: ['确定', '取消']
                    ,yes: function(index, layero){
                        var othis = layero.find('iframe').contents().find("#layuiadmin-app-form-tags")
                            , pid = othis.find('select[name="pid"]').val()
                            , cname = othis.find('input[name="cname"]').val()
                            , csort = othis.find('input[name="csort"]').val();
                        //监听提交
                        $.ajax({
                            url:'<?php echo url("Admin/Category/do_edit"); ?>?cid=' + cid,
                            data:{
                                'pid':pid
                                ,'cname':cname
                                ,'csort':csort
                            },
                            type: "post" ,
                            dataType:'json',
                            success:function(re){
                                if(re.status){
                                    layer.msg(re.msg,{icon:1,time:2000});
                                    renderTable();
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


        $('.layui-btn.layuiadmin-btn-cate').on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
    });
</script>
</body>
</html>
