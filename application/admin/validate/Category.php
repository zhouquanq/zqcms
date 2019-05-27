<?php
namespace app\admin\validate;

use think\Validate;

class Category extends Validate
{
    protected $rule = [
        'cname' => 'require|max:10',
        'csort' => 'require|number|between:0,100',
    ];

    protected $message = [
        'cname.require'     => '分类名不能为空！',
        'cname.max'         => '分类名不能超过10位！',
        'csort.require'     => '排序不能为空！',
        'csort.number'      => '排序必须是数字！',
        'csort.between'     => '排序必须在0~100之间！',
    ];
}