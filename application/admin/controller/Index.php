<?php
namespace app\admin\controller;
class Index extends Base
{
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->assign('active','Index');
        $this->assign('action','Index');
    }

    /**
     * 默认方法
     */
    public function index()
    {
        // Get
        if ($this->request->isGet())
        {
            // 读取访问量
            $data['website_pvCount'] = db('website_pv')->value('pv');
<<<<<<< HEAD
            dump($data);
            die;
=======

>>>>>>> liujie

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
