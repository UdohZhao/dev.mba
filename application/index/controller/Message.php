<?php
namespace app\index\controller;
class Message extends Base
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
    public function Message()
    {
        // Get
        if ($this->request->isGet()) {
            // 渲染模板输出
            return $this->fetch('message');
        }
    }
}
