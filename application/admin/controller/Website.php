<?php
namespace app\admin\controller;
class Website extends Base
{
    /**
     * 构造方法
     */
    public function _auto()
    {

    }

    /**
     * 添加站点信息页面
     */
    public function add()
    {
        // Get
        if ($this->request->isGet())
        {
            // 渲染模板输出
            return $this->fetch('add');
        }
    }

}
