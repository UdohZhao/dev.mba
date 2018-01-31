<?php
namespace app\index\controller;
class Websitewap extends Base
{
    public $paid;
    public $pid;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->paid = input('?param.paid') ? input('param.paid') : 0;
        $this->pid = input('?param.pid') ? input('param.pid') : 0;
        $this->assign('pid',$this->pid);
        $this->assign('paid',$this->paid);
    }

    /**
     * PC端文章页面
     */
    public function websitewap()
    {
        // 读取当前栏目名称
        $this->data['programaCname'] = db('programa')->where('id',$this->pid)->value('cname');
        // 读取当前文章标题
        $this->data['programa_articleTitle'] = strip_tags(db('programa_article')->where('id',$this->paid)->value('title'));
        // 根据当前栏目文章id查询
        $this->data['programa_articleData'] = db('programa_article')->where('id',$this->paid)->find();
        // var_dump($this->data['programaCname']);
        // die;
        // 模板变量赋值
        $this->assign('data',$this->data);
        // 渲染模板输出
        return $this->fetch('websitewap');
    }

}
