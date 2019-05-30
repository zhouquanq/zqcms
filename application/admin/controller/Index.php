<?php
namespace app\admin\controller;
/**
 * Class Index 默认首页
 */
class Index extends Auth
{
    public function index()
    {
        return $this->fetch();
    }

    public function console()
    {
        return $this->fetch();
    }


}
