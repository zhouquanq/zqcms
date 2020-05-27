<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"D:\wamp64\www\zqcms\public/../application/admin\view\article\index.html";i:1590488640;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\header.html";i:1590488640;s:61:"D:\wamp64\www\zqcms\application\admin\view\common\script.html";i:1590488640;}*/ ?>
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
                    <label class="layui-form-label">文章标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <button class="layui-btn layuiadmin-btn-admin" lay-submit lay-filter="article-search">
                        <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
                <button class="layui-btn layuiadmin-btn-admin" data-type="batchdel">删除</button>
                <button class="layui-btn layuiadmin-btn-admin" data-type="add">添加文章</button>
            </div>
            <table id="articles" lay-filter="articles"></table>
            <!--<script type="text/html" id="article_is_admin">-->
                <!--{{#  if(d.is_admin == '是'){ }}-->
                <!--<button class="layui-btn layui-btn-xs layui-btn-radius">管理员</button>-->
                <!--{{#  } else { }}-->
                <!--<button class="layui-btn layui-btn-warm layui-btn-xs layui-btn-radius">用户</button>-->
                <!--{{#  } }}-->
            <!--</script>-->
            <script type="text/html" id="article_status">
                {{#  if(d.status == '已发布'){ }}
                <button class="layui-btn layui-btn-xs layui-btn-radius">已发布</button>
                {{#  } else { }}
                <button class="layui-btn layui-btn-warm layui-btn-xs layui-btn-radius">未发布</button>
                {{#  } }}
            </script>
            <script type="text/html" id="action_bar">
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
                {{#  if(d.is_admin == '是'){ }}
                <a class="layui-btn layui-btn-disabled layui-btn-xs" ><i class="layui-icon layui-icon-delete"></i>删除</a>
                {{#  } else { }}
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
                {{#  } }}
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
    }).use(['index', 'useradmin', 'table'], function(){
        var $ = layui.$
            ,form = layui.form
            ,table = layui.table;
        //加载表格
        table.render({
            elem: '#articles'
            ,url:"<?php echo url('Admin/Article/getArticle'); ?>"
            ,align:'center'
            ,page:1
            ,cols: [[
                {type:'checkbox'}
                ,{field:'aid', title: 'ID', sort: true, width: 60, align: 'center'}
                ,{field:'title',  title: '标题'}
                ,{field:'digest',  title: '摘要'}
                ,{field:'attr',  title: '属性', width: 160, align: 'center', unresize: true}
                ,{field:'click',  title: '点击数', sort: true, width: 80, align: 'center'}
                ,{field:'author',  title: '作者', width: 100}
                ,{field:'addtime',  title: '添加时间', width: 160, templet: "<div>{{layui.util.toDateString(d.addtime*1000, 'yyyy-MM-dd HH:mm:ss')}}</div>", unresize: true, align: 'center'}
                ,{field:'status',width:80,title:'状态',templet: '#article_status', sort: true, unresize: true, align: 'center'}
                ,{field:'operate',width:150,title:'操作',toolbar:'#action_bar', unresize: true, align: 'center'}
            ]]
        });

        //工具栏监听事件
        table.on('tool(articles)', function(obj){
            var aid = obj.data.aid;
            //删除
            if(obj.event === 'del'){
                layer.confirm('确定删除么？', function(index){
                    $.ajax({
                        url:'<?php echo url("Admin/article/do_del"); ?>',
                        data:{'aid':aid},
                        type: "post",
                        dataType:'json',
                        success:function(re){
                            if(re.status){
                                table.reload('articles');
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
                    ,title: '修改文章'
                    ,content: '<?php echo url("Admin/article/edit"); ?>?aid=' + aid
                    ,area: ['720px', '750px']
                    ,btn: ['确定', '取消']
                    ,yes: function(index, layero){
                        var iframeWindow = window['layui-layer-iframe'+ index]
                            ,submitID = 'LAY-article-submit'
                            ,submit = layero.find('iframe').contents().find('#'+ submitID);
                        //监听提交
                        iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
                            var field = data.field; //获取提交的字段
                            var title,thumb,digest,category,content,attr,tag,status;

                            //所有属性
                            var attrs = new Array();
                            var num = 0;
                            for (var i=0; i<4; i++) {
                                var old_attr = "field.attrs"+i;
                                var new_attr = eval(old_attr);
                                if(typeof new_attr !== 'undefined'){
                                    attrs[num] = new_attr;
                                    num = num+1;
                                }
                            }
                            //所有标签
                            var tagCount=<?php echo $tagCount; ?>;
                            var tags = new Array();
                            var num = 0;
                            for (var i=0; i<=tagCount; i++) {
                                var old_tag = "field.tags"+i;
                                var new_tag = eval(old_tag);
                                if(typeof new_tag !== 'undefined'){
                                    tags[num] = new_tag;
                                    num = num+1;
                                }
                            }
                            title       = field.title;
                            digest      = field.digest;
                            category    = field.category;
                            thumb       = field.thumb;
                            status      = field.status ? '已发布' : '未发布';
                            attr        = attrs.join(",");
                            tag         = tags.join(",");
                            content     = field.content;
                            console.log(field);
                            $.ajax({
                                url:'<?php echo url("Admin/article/do_edit"); ?>?aid=' + aid,
                                data:{
                                    'title':title
                                    ,'digest':digest
                                    ,'category':category
                                    ,'thumb':thumb
                                    ,'status':status
                                    ,'attr':attr
                                    ,'tag':tag
                                    ,'content':content
                                },
                                type: "post" ,
                                dataType:'json',
                                success:function(re){
                                    if(re.status){
                                        layer.msg(re.msg,{icon:1,time:2000});
                                        table.reload('articles'); //数据刷新
                                        layer.close(index); //关闭弹层
                                    }else{
                                        layer.msg(re.msg,{icon:5,time:2000});
                                    }
                                }
                            });
                        });
                        submit.trigger('click');
                    }
                });
            }
        });

        //监听搜索
        form.on('submit(article-search)', function(data){
            var field = data.field;
            console.log(field);
            //执行重载
            table.reload('articles', {
                where: field
            });
        });

        //多选删除与添加用户
        var active = {
            batchdel: function(){
                var checkStatus = table.checkStatus('articles')
                    ,checkData = checkStatus.data; //得到选中的数据
                if(checkData.length === 0){
                    return layer.msg('请先选择数据！',{icon:3,time:2000});
                }
                var aids = "";
                for (i in checkData){
                    aids += checkData[i]['aid'] + ",";
                }
                layer.prompt({
                    formType: 1
                    ,title: '敏感操作，请验证口令'
                }, function(value, index){
                    layer.close(index);
                    layer.confirm('确定删除吗？', function(index) {
                        $.ajax({
                            url:'<?php echo url("Admin/article/do_delAll"); ?>',
                            data:{'aids':aids},
                            type: "post" ,
                            dataType:'json',
                            success:function(re){
                                if(re.status){
                                    table.reload('articles');
                                    layer.msg(re.msg,{icon:1,time:2000});
                                }else{
                                    layer.msg(re.msg,{icon:5,time:2000});
                                }
                            }
                        });
                    });
                });
            }
            ,add: function(){
                layer.open({
                    type: 2
                    ,title: '添加文章'
                    ,content: '<?php echo url("Admin/article/add"); ?>'
                    ,area: ['720px', '750px']
                    ,btn: ['确定', '取消']
                    ,yes: function(index, layero){
                        var iframeWindow = window['layui-layer-iframe'+ index]
                            ,submitID = 'LAY-article-submit'
                            ,submit = layero.find('iframe').contents().find('#'+ submitID);
                        //监听提交

                        iframeWindow.layui.form.on('submit('+ submitID +')', function(data){
                            var field = data.field; //获取提交的字段
                            var title,thumb,digest,category,content,attr,tag,status;

                            //所有属性
                            var attrs = new Array();
                            var num = 0;
                            for (var i=0; i<4; i++) {
                                var old_attr = "field.attrs"+i;
                                var new_attr = eval(old_attr);
                                if(typeof new_attr !== 'undefined'){
                                    attrs[num] = new_attr;
                                    num = num+1;
                                }
                            }
                            //所有标签
                            var tagCount=<?php echo $tagCount; ?>;
                            var tags = new Array();
                            var num = 0;
                            for (var i=0; i<=tagCount; i++) {
                                var old_tag = "field.tags"+i;
                                var new_tag = eval(old_tag);
                                if(typeof new_tag !== 'undefined'){
                                    tags[num] = new_tag;
                                    num = num+1;
                                }
                            }

                            title       = field.title;
                            digest      = field.digest;
                            category    = field.category;
                            thumb       = field.thumb;
                            status      = field.status ? '已发布' : '未发布';
                            attr        = attrs.join(",");
                            tag         = tags.join(",");
                            content     = field.content;
                           console.log(field);
                            $.ajax({
                                url:'<?php echo url("Admin/article/do_add"); ?>',
                                data:{
                                    'title':title
                                    ,'digest':digest
                                    ,'category':category
                                    ,'thumb':thumb
                                    ,'status':status
                                    ,'attr':attr
                                    ,'tag':tag
                                    ,'content':content
                                },
                                type: "post" ,
                                dataType:'json',
                                success:function(re){
                                    if(re.status){
                                        layer.msg(re.msg,{icon:1,time:2000});
                                        table.reload('articles'); //数据刷新
                                        layer.close(index); //关闭弹层
                                    }else{
                                        layer.msg(re.msg,{icon:5,time:2000});
                                    }
                                }
                            });
                        });
                        submit.trigger('click');
                    }
                });
                $(':focus').blur();
            }
        }
        $('.layui-btn.layuiadmin-btn-admin').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });

        layui.laytpl.toDateString = function(d, format){
            var date = new Date(d || new Date())
                ,ymd = [
                this.digit(date.getFullYear(), 4)
                ,this.digit(date.getMonth() + 1)
                ,this.digit(date.getDate())
            ]
                ,hms = [
                this.digit(date.getHours())
                ,this.digit(date.getMinutes())
                ,this.digit(date.getSeconds())
            ];

            format = format || 'yyyy-MM-dd HH:mm:ss';

            return format.replace(/yyyy/g, ymd[0])
                .replace(/MM/g, ymd[1])
                .replace(/dd/g, ymd[2])
                .replace(/HH/g, hms[0])
                .replace(/mm/g, hms[1])
                .replace(/ss/g, hms[2]);
        };

        //数字前置补零
        layui.laytpl.digit = function(num, length, end){
            var str = '';
            num = String(num);
            length = length || 2;
            for(var i = num.length; i < length; i++){
                str += '0';
            }
            return num < Math.pow(10, length) ? str + (num|0) : num;
        };
    });

</script>
</body>
</html>

