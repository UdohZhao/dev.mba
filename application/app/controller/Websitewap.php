<?php
namespace app\app\controller;
class Websitewap extends Base
{
    public $paid;
    /**
     * 构造方法
     */
    public function _auto()
    {
        $this->paid = input('?get.paid') ? input('get.paid') : 0;
        $this->pid = input('?get.pid') ? input('get.pid') : 0;
        $this->assign('pid',$this->pid);
        $this->assign('paid',$this->paid);
    }

    /**
     * 移动端文章页面
     */
    public function websitewap()
    {
        // 读取当前栏目名称
        $this->data['programaCname'] = db('programa')->where('id',$this->pid)->value('cname');
        // 读取当前文章标题
        $this->data['programa_articleTitle'] = strip_tags(db('programa_article')->where('id',$this->paid)->value('title'));
        // 根据当前栏目文章id查询
        $this->data['programa_articleData'] = db('programa_article')->where('id',$this->paid)->find();

        // 模板变量赋值
        $this->assign('data',$this->data);
        // 渲染模板输出
        return $this->fetch('websitewap');
    }
}
