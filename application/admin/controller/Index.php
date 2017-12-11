<?php
namespace app\admin\controller;
class Index extends Base
{
    /**
     * 构造方法
     */
    public function _auto()
    {

    }

    /**
     * 默认方法
     */
    public function index()
    {
        // Get
        if ($this->request->isGet())
        {
            // 渲染模板输出
            return $this->fetch('index');
        }
    }

    /**
     * 退出
     */
    public function logout()
    {
        // Get
        if ($this->request->isGet())
        {
            session(null);
            header("Location:/admin/Login/index");
            die;
        }
    }
}
