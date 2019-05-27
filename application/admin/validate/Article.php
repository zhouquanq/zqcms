<?php
namespace app\admin\validate;

use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title'     =>  'require|max:100',
        'digest'    =>  'require|max:250',
        'category'  =>  'require',
        'content'   =>  'require'
    ];

    protected $message = [
        'title.require'     => '文章标题不能为空！',
        'title.max'         => '文章标题不能超过100字符！',
        'digest.require'    => '文章摘要不能为空！',
        'digest.max'        => '文章摘要不能超过250字符！',
        'category.require'  => '文章分类不能为空！',
        'content.require'   => '文章内容不能为空！',
    ];
}