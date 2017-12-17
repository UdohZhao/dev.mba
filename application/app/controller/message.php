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
        $this->pid = input('?get.pid') ? input('get.pid') : 0;
        $this->assign('type',$this->type);
        $this->assign('pid',$this->pid);
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
            if ($this->pid) 
            {

                // 读取当前栏目名称
                $this->data['programaCname'] = db('programa')->where('id',$this->pid)->value('cname');
                $this->data['programa_articleData'] = db('programa_article')->where('status',0)->where('pid',$this->pid)->order('ctime desc')->field('content',true)->paginate(config('paging'),false,['query' => request()->param()]);

            }
            else 
            {
                // 读取当前栏目名称
                $this->data['programaCname'] = db('programa')->where('type',$this->type)->value('cname');
                $this->data['programa_articleData'] = db('programa_article')->where('status',0)->where('type',$this->type)->order('ctime desc')->field('content',true)->paginate(config('paging'),false,['query' => request()->param()]);
            }
            // 模板变量赋值
            $this->assign('data',$this->data);
            // 渲染模板输出
            return $this->fetch('message');
        }
    }
}
