<?php
namespace app\app\controller;
class Message extends Base
{
    public $type;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->type = input('?get.type') ? input('get.type') : 0;
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
            $this->data['programa_articleData'] = db('programa_article')->where('status',0)->where('type',$this->type)->order('ctime desc')->field('content',true)->paginate(config('paging'),false,['query' => request()->param()]);
            // 模板变量赋值
            $this->assign('data',$this->data);
            // 渲染模板输出
            return $this->fetch('message');
        }
    }
}
