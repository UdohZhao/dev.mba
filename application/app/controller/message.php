<?php
namespace app\app\controller;
class Message extends Base
{
    public $pid;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->pid = input('?get.pid') ? input('get.pid') : 0;
    }

    /**
     * 移动端栏目列表页面
     */
    public function message()
    {
        // Get
        if ($this->request->isGet())
        {
            // 读取当前栏目下的文章列表
            $this->data['programa_articleData'] = db('programa_article')->where('status',0)->where('pid',$this->pid)->order('ctime desc')->field('content',true)->paginate(config('paging'));
            // 模板变量赋值
            $this->assign('data',$this->data);
            // 渲染模板输出
            return $this->fetch('message');
        }
    }
}
