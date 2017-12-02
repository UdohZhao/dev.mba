<?php
namespace app\app\controller;
class websitewap extends Base
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
    public function websitewap()
    {
        // Get
        if ($this->request->isGet()) {
            // 渲染模板输出
            return $this->fetch('websitewap');
        }
    }
}
