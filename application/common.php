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
//打印函数
function p($data){
    echo "<pre style='font-size:14px;padding:10px 20px;background:#FFB7DD'>";
    print_r($data);
    echo "</pre>";
}

//基于layui修改弹框消息美化
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