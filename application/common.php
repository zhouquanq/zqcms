<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
// 打印函数
function p($data){
    // 定义样式
    $str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
    // 如果是boolean或者null直接显示文字；否则print
    if (is_bool($data)) {
        $show_data=$data ? 'true' : 'false';
    }elseif (is_null($data)) {
        $show_data='null';
    }else{
        $show_data=print_r($data,true);
    }
    $str.=$show_data;
    $str.='</pre>';
    echo $str;
}


// 基于layui修改弹框消息美化
function alert($msg='',$url='',$icon='',$time=3){
    $str='<script type="text/javascript" src="'.config('admin_static').'/script/js/jquery.min.js"></script><script type="text/javascript" src="'.config('admin_static').'/script/lib/layui/layui.js"></script>';//加载jquery和layui
    $str.='<script>$(layui.use(\'layer\', function(){layer.msg("'.$msg.'",{icon:'.$icon.',time:'.($time*1000).'}, function(){location.href="'.$url.'"})}));</script>';//主要方法
    return $str;
}

function unlimitedForLevel($cate,$html='　|　',$pid=0,$level=0){
    //建立空数组存储结果
    $arr = array();
    //循环$cate，如果这级的pid等于上一级的cid，就先压入数组，再找当前的下一级
    foreach ($cate as $v) {
        //查找当前分类是否有子分类
        if ($v['pid'] == $pid) {
            $v['level'] = $level + 1;
            $v['html'] = str_repeat($html, $level);
            $arr[] = $v;
            //递归合并数组
            $arr = array_merge($arr,unlimitedForLevel($cate,$html,$v['cid'],$level+1));
        }
    }
    return $arr;
}