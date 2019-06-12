<?php
namespace app\admin\validate;

use think\Validate;

class Flink extends Validate
{
    protected $rule = [
        'fname' =>  'require|max:16',
        'msg'   =>  'require|max:20',
        'sort'  =>  'require|number|between:0,100',
        'url'   =>  'require|url',
    ];

    protected $message = [
        'fname.require' => '友链名不能为空！',
        'fname.max'     => '友链名不能超过16位！',
        'msg.require'   => '友链信息不能为空！',
        'msg.max'       => '友链信息不能超过20位！',
        'sort.require'  => '排序不能为空！',
        'sort.number'   => '排序值必须是数字！',
        'sort.between'  => '排序值必须在0 ~ 100！',
        'url.require'   => '友链地址不能为空！',
        'url.url'       => '友链地址格式不正确！',

    ];
}