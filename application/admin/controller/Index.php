<?php
namespace app\admin\controller;

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